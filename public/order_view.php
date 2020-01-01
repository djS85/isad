<?php
include_once "header.php";
?>

<title>Order View</title>

</head>

<body>

<nav class="navbar">
    <a class="navbar-brand">
        <img src="../assets/img/coffee.png" width="32" height="32">
    </a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="admin.php">Admin Home</a>
        </li>
    </ul>
</nav>

<div class="container-fluid" align="center">
    <h1 class="page-head">
        Orders
    </h1>
</div>

<div class="container-fluid" align="center">

    <table class="table table-striped" style="text-shadow: none; background-color: whitesmoke;">

        <thead>
        <tr style="color: black;" >
            <th>Order ID</th>
            <th>Customer ID</th>
            <th>Order Date</th>
            <th>Order Total</th>
            <th>Customer Name</th>
            <th>Table No.</th>
        </tr>
        </thead>

        <tbody style="color: black;">
            <?php
//                $orders = getAll('orders');

                $orders = getOrdersByDateDesc();



                foreach ( $orders as $order ) :
                    $name = getCustomerNameByID($order['customer_id']);
                    $table = getTableByID($order['customer_id']);
                    ?>


                    <tr>
                        <td><? echo $order['order_id']; ?></td>
                        <td><? echo $order['customer_id']; ?></td>
                        <td><? echo $order['order_date']; ?></td>
                        <td>£<? echo number_format($order['order_total'], 2); ?></td>
                        <td><? echo $name; ?></td>
                        <td><? echo $table; ?></td>
                    </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>
</div>

<div class="container-fluid">
    <h5>Get Order By ID:</h5>
    <form method="post">
        <label for="order_id">Order ID:</label>
        <input type="text" name="order_id">
        <input class="btn btn-primary" type="submit" name="get_orderItems">
    </form>

</div>

<br>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <table class="table table-striped" style="text-shadow: none; background-color: whitesmoke;">

                <thead>
                <tr style="color: black;">
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price (each)</th>
                </tr>
                </thead>

                <tbody>

                <?php
                if ( filter_input(INPUT_POST, 'get_orderItems') ) :
                    $id = $_POST['order_id'];
                    $orderItems = getOrderItemsByID($id);
                    $total = getOrderTotalByID($id);

                    ?>
                        <h4>Items on order: <? echo $id; ?></h4>
                <?php

                    foreach ( $orderItems as $item ) :
                        $product_name = getProductNameByID($item['product_id']);
                        $price = getPriceByID($item['product_id']);
//                        $total = getPriceByID($id);
                        ?>

                        <tr>
                            <td><? echo $product_name; ?></td>
                            <td><? echo $item['product_qty']; ?></td>
                            <td>£<? echo number_format($price, 2); ?></td>
                        </tr>

                    <?php
                    endforeach;
                endif;
                ?>
                </tbody>

                <thead>
                    <tr>
                        <th>Total: </th>

                        <?php
                            if ( isset($total) ) {

                                ?>
                                <td>£<? echo $total; ?></td>
                        <?php

                            }
                        ?>
                    </tr>
                </thead>

            </table>
        </div>
        <div class="col-md-4"></div>
    </div>



</div>


</body>

<?php
include_once "footer.php";
?>
