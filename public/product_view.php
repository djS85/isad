<?php
include_once "header.php";
session_start();

$products = getAll('products');


if (filter_input(INPUT_POST, 'del_product')) {
    $id = $_POST['d_id'];
    delete_product($id);
    $products = getAll('products');
}


if (filter_input(INPUT_POST, 'update_product')) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $restock = $_POST['restock'];
    $isDrink = $_POST['isDrink'];
    update_product($id, $name, $price, $stock, $restock, $isDrink);
    $products = getAll('products');
}


if (filter_input(INPUT_POST, 'add_product')) {
    $name = $_POST['add_name'];
    $price = $_POST['add_price'];
    $stock = $_POST['add_stock'];
    $restock = $_POST['add_restock'];
    $isDrink = $_POST['add_isDrink'];
    add_product($name, $price, $stock, $restock, $isDrink);
    $products = getAll('products');
}


?>

<title>Product View</title>

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
        Products
    </h1>
</div>

<div class="container-fluid">
    <h3>Drinks</h3>
    <table class="table table-striped" style="text-shadow: none; background-color: whitesmoke;" align="center">

        <thead>
        <tr style="color: black;">
            <th>ID</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Restock</th>
            <th>Drink=1</th>
        </tr>
        </thead>
        <tbody style="color: black;">
        <?php
        foreach ( $products as $product ) :
            if ( $product['isDrink'] == 1 ) :
            ?>

            <tr>
                <td><? echo $product['product_id'] ?></td>
                <td><? echo $product['product_name'] ?></td>
                <td><? echo '£' . number_format($product['product_price'], 2); ?></td>
                <td><? echo $product['stock_qty'] ?></td>
                <td><? echo $product['restock_qty'] ?></td>
                <td><? echo $product['isDrink'] ?></td>
            </tr>

        <?php
            endif;
        endforeach;
        ?>
        </tbody>

    </table>
</div>

<br>

<div class="container-fluid">
    <h3>Food</h3>
    <table class="table table-striped" style="text-shadow: none; background-color: whitesmoke;" align="center">

        <thead>
        <tr style="color: black;">
            <th>ID</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Restock</th>
            <th>Drink=1</th>
        </tr>
        </thead>
        <tbody style="color: black;">
        <?php
        foreach ( $products as $product ) :
            if ( $product['isDrink'] == 0 ) :
                ?>

                <tr>
                    <td><? echo $product['product_id'] ?></td>
                    <td><? echo $product['product_name'] ?></td>
                    <td><? echo '£' . number_format($product['product_price'], 2); ?></td>
                    <td><? echo $product['stock_qty'] ?></td>
                    <td><? echo $product['restock_qty'] ?></td>
                    <td><? echo $product['isDrink'] ?></td>
                </tr>

            <?php
            endif;
        endforeach;
        ?>
        </tbody>

    </table>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="container-fluid">
                <form method="post" action="product_view.php">
                    <h3>Delete Product by ID</h3>
                    <label for="d_id">ID:</label>
                    <input type="number" name="d_id">
                    <br>
                    <input class="btn btn-danger" type="submit" name="del_product" value="Delete">
                </form>



            </div>
        </div>

        <div class="col-md-4">
            <div class="container-fluid">
                <h3>Update Product by ID</h3>
                <form method="post" action="product_view.php">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="id">ID</label>
                            <label for="name">Name</label>
                            <label for="price">Price</label>
                            <label for="stock">Stock</label>
                            <label for="restock">Restock</label>
                            <label for="isDrink">isDrink</label>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="id" required>
                            <input type="text" name="name" required>
                            <input type="text" name="price" required>
                            <input type="number" name="stock" required>
                            <input type="number" name="restock" required>
                            <input type="number" name="isDrink" max="1" min="0" required>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <input class="btn btn-primary" type="submit" name="update_product" value="Update">
                    </div>
                </form>
            </div>


        </div>

        <div class="col-md-4">
            <div class="container-fluid">
                <h3>Add Product</h3>
                <form method="post" action="product_view.php">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="add_name">Name</label>
                            <label for="add_price">Price</label>
                            <label for="add_stock">Stock</label>
                            <label for="add_restock">Restock</label>
                            <label for="add_isDrink">isDrink</label>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="add_name" required>
                            <input type="text" name="add_price" required>
                            <input type="number" name="add_stock" required>
                            <input type="number" name="add_restock" required>
                            <input type="number" name="add_isDrink" max="1" min="0" required>
                        </div>
                        <div class="col-md-7"></div>
                    </div>
                    <div class="row">
                        <input class="btn btn-primary" type="submit" name="add_product" value="Add Product">
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>





</body>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>



<?php
include_once "footer.php";

?>
