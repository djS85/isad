<?php
include_once "header.php";
session_start();

$product_ids = array();

if ( filter_input(INPUT_POST, 'add_to_cart') ) {

    if ( isset($_SESSION['cm_order']) ) {

        $count = count($_SESSION['cm_order']);

        $product_ids = array_column($_SESSION['cm_order'], 'id');

        // check if product with this id is already in array
        if ( !in_array(filter_input(INPUT_GET, 'id'), $product_ids) ) {
            $_SESSION['cm_order'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'qty')
            );
        }
        else {

            for ( $i = 0; $i < count($product_ids); $i++ ) {
                if ( $product_ids[$i] == filter_input(INPUT_GET, 'id')) {
                    $_SESSION['cm_order'][$i]['quantity'] += 1;
                }
            }

        }
//            print_r($product_ids);

    } else {
        // create customer order if no order exists
        $_SESSION['cm_order'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'qty')
        );
    }
}

$cm = $_SESSION['cm'];

?>

<title>MENU</title>

</head>

<body>

<!-- NAVIGATION BAR -->
<nav class="navbar">
    <a class="navbar-brand">
        <img src="../assets/img/coffee.png" width="32" height="32">
    </a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
    </ul>
    <div class="ml-auto">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="order.php">View Order</a>
            </li>
        </ul>
    </div>
</nav>

<!-- PAGE HEADING -->
<div class="container-fluid" align="center">
    <h1 class="page-head">
        <img src="../assets/img/coffee-cup.png" width="40" height="40">
        Food & Drink
        <img src="../assets/img/coffee-cup.png" width="40" height="40">
    </h1>
    <h4>
        <?php
        if (isset($_SESSION['username']) && isset($cm)) {
            echo "Hello " . $_SESSION['username'] . ' at Table ' . $cm->get_table() . "!!";
        } else {
            echo 'You have not entered a Name and Table number!!';
        }
        ?>
    </h4>
</div>

<br>

<div class="container-fluid">

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-10">

            <div class="container-fluid">
                <h2 class="page-head" style="font-family: 'Dancing Script', cursive;  font-size: 50pt;">
                    Drinks <img src="../assets/img/coffee.png" width="32" height="32">
                </h2>
            </div>

            <?php
            $products = getAll('products');

            foreach ( $products as $product ) :
                if ( $product['isDrink'] == 1 ) :
                    ?>
                    <div class="container" style="padding-top: 10pt;">
                        <form method="post" action="menu.php?action=add&id=<? echo $product['product_id']; ?>">
                            <div class="product">
                                <div class="row">
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                                    <div class="col-xs-3 col-sm-3 col-md-3" align="left">
                                        <h6><? echo $product['product_name'] ?></h6>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <h6>&pound; <? echo number_format($product['product_price'], 2); ?></h6>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <input type="hidden" name="name" value="<? echo $product['product_name']; ?>"/>
                                        <input type="hidden" name="price" value="<? echo $product['product_price']; ?>"/>
                                        <select class="form-control" id="sel1" name="qty">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <input type="submit" name="add_to_cart" class="btn btn-primary" value="Add"/>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                endif;
            endforeach;
            ?>

        </div>

        <div class="col-md-2">

        </div>

    </div>

    <div class="row" style="padding-top: 10pt;">

        <div class="col-xs-12 col-sm-12 col-md-10">

            <div class="container-fluid">
                <h2 class="page-head" style="font-family: 'Dancing Script', cursive; font-size: 50pt;">
                    Food <img src="../assets/img/cake.png" width="32" height="32">
                </h2>
            </div>

            <?php
            $products = getAll('products');

            foreach ( $products as $product ) :
                if ( $product['isDrink'] == 0 ) :
                    ?>
                    <div class="container" style="padding-top: 10pt;">
                        <form method="post" action="menu.php?action=add&id=<? echo $product['product_id']; ?>">
                            <div class="product">
                                <div class="row">
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                                    <div class="col-xs-3 col-sm-3 col-md-3" align="left">
                                        <h6><? echo $product['product_name'] ?></h6>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <h6>&pound; <? echo number_format($product['product_price'], 2); ?></h6>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <input type="hidden" name="name" value="<? echo $product['product_name']; ?>"/>
                                        <input type="hidden" name="price" value="<? echo $product['product_price']; ?>"/>
                                        <select class="form-control" id="sel1" name="qty">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <input type="submit" name="add_to_cart" class="btn btn-primary" value="Add"/>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                endif;
            endforeach;
            ?>

        </div>

        <div class="col-md-2">

        </div>

    </div>

</div>



</body>

<!--  stops the menu.php adding extra items to the order if the user refreshes the page  -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
include_once "footer.php";
?>
