<?php
include_once "header.php";
//include "../src/controller/classes/order.php";

session_start();

if ( isset($_SESSION['order']) ) {
//    echo "Yay!!";
}

?>

<title>A TITLE</title>

</head>

<body>


<!-- NAVIGATION BAR -->
<nav class="navbar">
    <a class="navbar-brand">
        <img src="../assets/img/coffee.png" width="32" height="32">
    </a>
</nav>

<div class="container-fluid" align="center" style="padding-top: 30pt;">



    <?php
    if ( isset($_SESSION['cm_order']) && isset($_SESSION['username']) ) {
        if ( filter_input(INPUT_POST, 'create_order') ) {

            ?>

            <h4 align="center">
                Thank You For Your Order!!
            </h4>

            <p>
                Your Drinks and/or Food whill be with you shortly!!!
            </p>

            <?

            $cm_order = new order();

            $order_id = uniqid("Ord_");

//            var_dump($d);

            $_SESSION['order'] = new order();
            $_SESSION['order']->set_cmID($_POST['cm_id']);
            $_SESSION['order']->set_total($_POST['total']);
            $_SESSION['order']->set_orderItems($_SESSION['cm_order']);
            $_SESSION['order']->set_orderID($order_id);

            $cm_order = $_SESSION['order'];

            unset($_SESSION['cm_order']);
            unset($_SESSION['cm']);
            unset($_SESSION['username']);

            addOrder($_SESSION['order']);

            unset($_SESSION['order']);

        }
    } else {
        echo "Nothing in your order yet!!";
    }
    ?>

</div>

<div class="container-fluid" align="center">

    <form method="#" action="index.php">
        <input class="btn btn-success" type="submit" value="Return Home" >
    </form>

</div>

<?php

//var_dump($_SESSION['order']);

?>

</body>

<?php
include_once "footer.php";
?>
