<?php
include_once "header.php";
session_start();

?>

<title>HOME</title>

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
                <a class="nav-link" href="admin.php">Admin</a>
            </li>
        </ul>
    </div>
</nav>

<!-- PAGE HEADING -->
<div class="container-fluid" align="center">
    <h1 class="page-head">
        Welcome
    </h1>
</div>

<div class="container-fluid">
    <div class="row">

        <div class="col-xs-3 col-sm-3 col-md-3"></div>

        <div class="col-xs-6 col-sm-6 col-md-6">

            <div class="container-fluid" align="center">
                <h3>
                    Please Enter Your Name and Table Number:
                </h3>
            </div>

            <!-- CUSTOMER SIGN IN FORM -->
            <form method="post" action="#">

                <div class="container form-group">

                    <div class="row" style="margin: 5pt;">

                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <label for="customer_name">Name: </label>
                        </div>

                        <div class="col-xs-10 col-sm-10 col-md-10">
                            <input class="form-control" type="text" id="customer_name" name="name" required>
                        </div>

                    </div>

                    <div class="row" style="margin: 5pt;">

                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <label for="table_number">Table: </label>
                        </div>

                        <div class="col-xs-10 col-sm-10 col-md-10">
                            <input class="form-control" type="number" id="table_number" name="table"
                                   min="1" max="12" required>
                        </div>

                    </div>

                    <div class="container-fluid" align="center">
                        <button class="btn btn-info">Submit</button>
                    </div>

                    <?php
                        // when button is pressed on the form.
                        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                            $name = check_input($_POST['name']);
                            $table = check_input($_POST['table']);

                            $cm_ID = uniqid("CM_");

//                            echo $cm_ID;

                            $cm = create_customer($cm_ID, $name, $table);
                            addCustomer($cm);

                            var_dump($cm);

                            $_SESSION['username'] = $cm->get_name();
                            $_SESSION['table'] = $cm->get_table();


                            $_SESSION['cm'] = $cm;
                        }
                    ?>

                </div>
            </form>

        </div>

    </div>

    <div class="col-xs-3 col-sm-3 col-md-3"></div>

</div>

</body>

<?php
include_once "footer.php";
?>
