<?php

include_once "header.php";
//include "../src/controller/classes/order.php";

session_start();

$order = array();

if ( isset($_SESSION['cm']) ) {
    $cm = $_SESSION['cm'];
}

$order = $_SESSION['cm_order'];

if (filter_input(INPUT_POST, 'remove_item')) {

    $id = $_POST['id'];

//    var_dump($id);
//    var_dump($_GET['id']);

    if ( count($_SESSION['cm_order']) <= 1 ) {
        unset($_SESSION['cm_order']);
    } else {
        $i = 0;
        foreach ( $_SESSION['cm_order'] as $item ) {
            if ( $item['id'] == $id ) {
//                echo $item['id'];
                unset($_SESSION['cm_order'][$i]);
                $_SESSION['cm_order'] = array_values($_SESSION['cm_order']);

            }
            $i ++;
        }
    }

    $order = $_SESSION['cm_order'];

}

if ( filter_input(INPUT_GET, 'delete_order') ) {
    unset($_SESSION['cm_order']);
    unset($order);
    if ( isset($_SESSION['order']) ) {
        unset($_SESSION['order']);
    }
}



?>

<title>YOUR ORDER</title>

</head>

<body>

<!-- NAVIGATION BAR -->
<nav class="navbar">
    <a class="navbar-brand">
        <img src="../assets/img/coffee.png" width="32" height="32">
    </a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="menu.php">Food & Drink</a>
        </li>
    </ul>

    <div class="ml-auto">
        <ul class="navbar-nav">
            <li class="nav-item">
                <form method="get">

                        <input type="submit" name="delete_order" class="btn btn-danger" value="Delete Order">
                    
                </form>
            </li>
        </ul>
    </div>
</nav>

<!-- PAGE HEADING -->
<div class="container-fluid" align="center">
    <h1 class="page-head">
        <img src="../assets/img/coffee-cup.png" width="40" height="40">
        Your Order
        <img src="../assets/img/coffee-cup.png" width="40" height="40">
    </h1>

        <?php
        if (isset($_SESSION['username']) && isset($cm)) {
            ?>
            <h4><? echo "Hello " . $_SESSION['username'] . ' at Table ' . $cm->get_table() . "!!"; ?></h4>
    <?php

        } else {
//            echo 'You need to enter a Name and Table Number!!';
        ?>
            <div class="container-fluid">
                <div class="card">
                    <h6>You have not entered any Details yet !!
                        <br>
                        <a href="index.php">Click Here</a>
                        <br>
                        to go back.
                    </h6>
                </div>
            </div>
    <?php


        }
        ?>

    <p>
        Click 'Submit Order' when you're ready.
    </p>
</div>



<div class="container-fluid">
    <div class="row">
<!--        <div class="col-sm-2 col-md-2"></div>-->

        <div class="col-sm-12 col-md-12">
            <?php

                if ( !empty($order) ) :
                    foreach ( $order as $item ) :

                    ?>
<!--                    <form method="post" action="order.php?id=--><?// echo $item['id']; ?><!--">-->
                    <form method="post" action="order.php">
                        <div class="container-fluid" style="padding-top: 10pt; font-size: 14px" align="center">
                            <div class="row">
                                <div class="col-sm-2 col-md-2" align="left">
                                    <p><? echo $item['name'] ?></p>
                                </div>
                                <div class="col-sm-2 col-md-2">
                                    <p>£ <? echo number_format($item['price'], 2) ?></p>
                                </div>
                                <div class="col-sm-1 col-md-1">
                                    <p>qty:</p>
                                </div>
                                <input type="hidden" id="id" name="id" value="<? echo $item['id'] ?>">
                                <div class="col-sm-1 col-md-1" align="left">
                                    <p><? echo $item['quantity'] ?></p>
                                </div>
                                <div class="col-sm-2 col-md-2">
                                    <input type="submit" class="btn btn-info" name="remove_item" value="Remove">
                                </div>
                            </div>
                        </div>
                    </form>

            <?php
                endforeach;

                foreach ( $order as $item ) {

                    $price = $item['price'];
                    $qty = $item['quantity'];

                    $total_price += $price * $qty;

                }

                endif;

            ?>
        </div>
    </div>

    <div class="row" style="padding-top: 10pt;">
        <div class="col-sm-2 col-md-2"></div>
        <div class="col-sm-2 col-md-2">
            <p>
                Order Total:
            </p>
        </div>
        <div class="col-sm-2 col-md-4" align="left">
            £ <? echo number_format($total_price, 2); ?>
        </div>
        <div class="col-sm-2 col-md-4"></div>
    </div>

</div>

<div class="container-fluid" align="center">
    <form method="post" action="conf.php">
<!--        <input type="hidden" value="--><?// echo $order ?><!--" name="order">-->
        <input type="hidden" value="<? echo $total_price ?>" name="total">
        <input type="hidden" value="<? if ( isset($cm) ) { echo  $cm->get_ID(); } ?>" name="cm_id">
        <input type="submit" class="btn btn-success" name="create_order" value="Submit Order">
    </form>
</div>


<div class="container" style="padding-top: 5pt;">

</div>

</body>

<!--  stops the menu.php/order.php adding extra items to the order if the user refreshes the page  -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
include_once "footer.php";
?>
