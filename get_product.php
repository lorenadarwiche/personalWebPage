<!-- get_product.php-->
<?php
// This block makes the connection to the database I created in MySQl

// In your PHP files
$config = include 'configure1.php';
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//this block grabs the information about the products and puts it into the page
$sql = "SELECT id, name, price, availability FROM products";
$result = $conn->query($sql);

//this checks if the products are available in the database
if ($result->num_rows > 0) {
    //this just loops through each product in the database!
    while ($row = $result->fetch_assoc()) {
        //this just shows the product's info and provides a field where you can input the quantity of items you want!
        //it also sets a limit to the amount of items you want
        //for example, for the apple charger, you can only grab 8 items
        //as that the amount of apple chargers that are available!
        echo "<label for='quantity{$row["id"]}'>{$row["name"]} - Price: {$row["price"]}</label>";
        echo "   <input type='number' name='products[{$row["id"]}][quantity]' id='quantity{$row["id"]}' min='0' max='{$row["availability"]}' value='0'>";
        echo "<br>";
    }
} else {
    //this would be the message that would show if theres no items available!
    echo "No products available.";
}

$conn->close();
?>