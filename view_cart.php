<!-- view_cart.php -->
<?php
// Display the items, quantities, names, prices, and totals in the shopping cart
session_start();

if (!empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $config = include 'configure1.php';
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "<form action='remove_item.php' method='post'>"; // Add a form for removing items
    echo "<table border='1'>";
    echo "<tr><th>Product Name</th><th>Quantity</th><th>Price</th><th>Total</th><th>Remove/Update</th></tr>";

    foreach ($cart as $productId => $quantity) {
        $sql = "SELECT name, price, availability FROM products WHERE id = $productId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $productName = $row["name"];
            $productPrice = $row["price"];
            $total = $productPrice * $quantity;

            echo "<tr>";
            echo "<td>{$productName}</td>";
            echo "<td><input type='number' name='quantity[$productId]' min='0' max='{$row["availability"]}' value='{$quantity}'></td>";
            echo "<td>{$productPrice}</td>";
            echo "<td>{$total}</td>";
            echo "<td><button type='submit' name='remove' value='{$productId}'>Update!</button></td>"; // Add Remove button
            echo "</tr>";
        }
    }

    echo "</table>";
    echo "</form>"; // Close the form
    echo "<p>Total: $" . calculateTotal($cart, $conn) . "</p>";
    $conn->close();
} else {
    echo "Your cart is empty.";
}

function calculateTotal($cart, $conn) {
    $total = 0;

    foreach ($cart as $productId => $quantity) {
        $sql = "SELECT price FROM products WHERE id = $productId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $productPrice = $row["price"];
            $total += $productPrice * $quantity;
        }
    }

    return $total;
}
?>