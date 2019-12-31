<?php
include_once "header.php";
?>

<title>ADMIN</title>

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
<!--                <a class="nav-link" href="admin.php">Admin</a>-->
            </li>
        </ul>
    </div>
</nav>

<!-- PAGE HEADING -->
<div class="container-fluid" align="center">
    <h1 class="page-head">
        <img src="../assets/img/coffee-cup.png" width="40" height="40">
        Admin
        <img src="../assets/img/coffee-cup.png" width="40" height="40">
    </h1>
</div>


<div class="container-fluid" align="center">
    <div class="btn-group">
        <button type="button" class="btn btn-primary" onclick="location.href='order_view.php';">
            View Orders
        </button>
        <button type="button" class="btn btn-primary" onclick="location.href='product_view.php';">
            View Products
        </button>
    </div>
</div>


</body>

<?php
include_once "footer.php";
?>
