<!-- productList.php-->
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<br>
    <center>
   <h2>Product List</h2>
   <br>
   <!-- What action does is it tells the browser which page to call-->
    <form action="cart.php" method="post">
        <?php include('get_product.php'); ?>
        <input type="submit" value="Add to Cart">
    </form>

    <h2>Shopping Cart</h2>
    <?php include('view_cart.php');         
    ?>

    <h2>Checkout</h2>
    <form action="checkout.php" method="post">
        <!--what "required" does is it makes sure the user inputs an email or else
        it doesn't proceed to the checkout page!-->
        Enter your email: <input type="email" name="email" required>
        <input type="submit" value="Checkout">
    </form>

    <h3><br><br><a href='https://localhost/homepage.html'>Logout!</a></h3>
    </center>
</body>
</html>