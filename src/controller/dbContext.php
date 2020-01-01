<?php
include "classes/customer.php";
include "classes/order.php";
session_start();

// sanitise the input.
function check_input($inp) {
    // extraneous whitespace etc.
    $inp = trim($inp);
    // remove slashes from the string.
    $inp = stripslashes($inp);
    // remove characters like the <> used as html tags.
    $inp = htmlspecialchars($inp);
    // return the cleaned up input.
    return $inp;
}

// return connection to database.
function getConn() {

    $servername = "127.0.0.1";
    $dbname     = "db_CoffeeShop";
    $username   = "djs";
    $pwd        = "pwd";

    $conn = new mysqli($servername, $username, $pwd, $dbname);

    if ( $conn->connect_error ) {
        die("Connection Failed: " . $conn->connect_error );
    }
//    else {
//        echo "Successfully connected!";
//    }

    return $conn;

}

function getOrdersByDateDesc() {

    $conn = getConn();

    $sql = "SELECT * FROM `orders` ORDER BY order_date DESC;";
    $orders = $conn->query($sql);

    if ( !empty($orders) ) {
        return $orders;
    }

    $conn->close();

}

function getProductNameByID($id) {

    $products = getAll('products');

//    var_dump($products);

    $product_name = "";

    foreach ( $products as $product ) {
        if ( $product['product_id'] == $id ) {
            $product_name = $product['product_name'];
        }
    }

    return $product_name;

}

function getOrderItemsByID($id) {

    $orderItems = getAll('orderItems');

    $order = array();

    foreach ( $orderItems as $item ) {
        if ( $item['order_id'] == $id ) {
            array_push($order, $item);
        }
    }

    return $order;

}


function getCustomerNameByID($id) {
    $cms = getAll('customers');

    $name = "";

    foreach ( $cms as $cm ) {
        if ( $cm['customer_id'] == $id ) {
            $name = $cm['customer_name'];
        }
    }

    return $name;

}

function getPriceByID($id) {

    $products = getAll('products');

    $price = 0.0;

    foreach ( $products as $product ) {
        if ( $product['product_id'] == $id ) {
            $price = $product['product_price'];
        }
    }

    return $price;

}

function getOrderTotalByID($id) {

    $orders = getAll('orders');

    $price = 0.0;

    foreach ( $orders as $order ) {
        if ( $order['order_id'] == $id ) {
            $price = $order['order_total'];
        }
    }

    return number_format($price, 2);

}

function getTableByID($id) {

    $cms = getAll('customers');

    $table = 0;

    foreach ( $cms as $cm ) {
        if ( $cm['customer_id'] == $id ) {
            $table = $cm['customer_table'];
        }
    }

    return $table;

}

function getAll($table) {

    $conn = getConn();

    $st = "SELECT * FROM ";

    switch ($table) {

        case 'products':
            $st = $st . 'products';
            break;
        case 'orders':
            $st = $st . 'orders';
            break;
        case 'customers':
            $st = $st . 'customers';
            break;
        case 'orderItems':
            $st = $st . 'orderItems';
            break;
        default:
            break;

    }

    $result = $conn->query($st);

    $conn->close();

    return $result;

}

function create_customer($id, $name, $table) {

    $cm = new customer();
    $cm->set_name($name);
    $cm->set_table($table);
    $cm->set_ID($id);

    return $cm;

}

function addCustomer($cm) {

    $conn = getConn();

    $sql = "INSERT INTO `customers` (customer_id, customer_name, customer_table) VALUES (?, ?, ?)";
    $st = $conn->prepare($sql);

    $st->bind_param('ssi', $cm->get_ID(), $cm->get_name(), $cm->get_table());

    $st->execute();

    $conn->close();

}

function addOrder($ord) {

//    var_dump($ord);

//    echo $ord->get_orderID();

    $conn = getConn();

    $sql = "INSERT INTO `orders` (order_id, customer_id, order_total) VALUES (?, ?, ?);";
    $st = $conn->prepare($sql);

    $st->bind_param('ssd', $ord->get_orderID(), $ord->get_cmID(), $ord->get_total());

    $st->execute();

    $items = array();

    $items = $ord->get_orderItems();

    $sql = "INSERT INTO `orderItems` (order_id, product_id, product_qty) VALUES (?, ?, ?); ";


    foreach ( $items as $item ) {
        $st = $conn->prepare($sql);
        $st->bind_param('sii', $ord->get_orderID(), $item['id'], $item['quantity']);
//        echo $item['id'];
        $st->execute();
    }

    $conn->close();

}

function delete_product($id) {

    $conn = getConn();
    $sql = "DELETE FROM `products` WHERE product_id = ?;";
    $st = $conn->prepare($sql);

    $st->bind_param('i', $id);
    $st->execute();

    $conn->close();

}

function update_product($id, $name, $price, $stock_qty, $restock, $isDrink) {

    $conn = getConn();
    $sql = "UPDATE `products` 
            SET product_name = ?, product_price = ?, stock_qty = ?, restock_qty = ?, isDrink = ?
            WHERE product_id = ?;";
    $st = $conn->prepare($sql);

    $st->bind_param('sdiiii', $name, $price, $stock_qty, $restock, $isDrink, $id);

    $st->execute();

    $conn->close();

}

function add_product($name, $price, $stock_qty, $restock_qty, $isDrink) {

    $conn = getConn();

    $sql = "INSERT INTO `products` (product_name, product_price, stock_qty, restock_qty, isDrink)
            VALUES (?, ?, ?, ?, ?);";

    $st = $conn->prepare($sql);

    $st->bind_param('sdiii', $name, $price, $stock_qty, $restock_qty, $isDrink);

    $st->execute();

    $conn->close();

}

