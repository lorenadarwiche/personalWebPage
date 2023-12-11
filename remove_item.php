<!--remove_item.php-->
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    $productIdToRemove = $_POST['remove'];

    // Check if the product ID exists in the cart
    if (isset($_SESSION['cart'][$productIdToRemove])) {
        // If a quantity is specified, update the quantity; otherwise, remove the product
        if (isset($_POST['quantity'][$productIdToRemove])) {
            $newQuantity = (int)$_POST['quantity'][$productIdToRemove];
            
            // Validate the new quantity
            $config = include 'configure1.php';
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
            
            $sql = "SELECT availability FROM products WHERE id = $productIdToRemove";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $maxQuantity = $row["availability"];
                
                if ($newQuantity >= 0 && $newQuantity <= $maxQuantity) {
                    // Update the quantity in the cart
                    $_SESSION['cart'][$productIdToRemove] = $newQuantity;
                }
            }
            
            $conn->close();
        } else {
            // Remove the entire product
            unset($_SESSION['cart'][$productIdToRemove]);
        }
    }
}

header("Location: cart.php"); // Redirect back to the cart page
exit();
?>