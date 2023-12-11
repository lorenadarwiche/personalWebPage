<!--cart.php-->
<?php
//What this program does is it adds the products the user selected
//and adds it to the cart!
session_start();
//this if statement checks if the user pressed the submited button 
// Check if the user pressed the submit button
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a product is selected
    if (isset($_POST['products']) && is_array($_POST['products'])) {
        // Loop through the selected items and update the cart
        foreach ($_POST['products'] as $productId => $productData) {
            // Grab the amount of items the user selected for the product
            // and check if it's not 0
            $quantity = isset($productData['quantity']) ? (int)$productData['quantity'] : 0;

            // If the product is selected, update the cart
            if ($quantity > 0) {
                // Store both the product ID and quantity in the cart
                $_SESSION['cart'][$productId] = isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId] + $quantity : $quantity;
            }
        }
    }
}

header("Location: dashboard.php");
exit();
?>