<!--contentEdit.php-->
<!DOCTYPE html>
<html>
<head>
    <title>Content to edit</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

<?php
// Below I am connecting the database to this program
$config = include 'configure3.php';
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    die("There was a connection failure: " . $conn->connect_error);
}

// Below I am updating the content and making sure its going update whatever is in the boxes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content_id = $_POST['content_id'];
    $new_content = $_POST['new_content'];

    $sql = "UPDATE content SET content_text = '$new_content' WHERE id = $content_id";

    if ($conn->query($sql) === TRUE) {
        echo "This content was uploaded!!!!";
    } else {
        echo "there was an error updating the content: " . $conn->error;
    }
}

// Below I am grabbing the content and displaying it!
$sql = "SELECT * FROM content";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<center>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='content_id' value='{$row['id']}'>";
        echo "<label for='new_content'>Edit Content:</label>";
        echo "<textarea name='new_content' rows='4' cols='50'>{$row['content_text']}</textarea><br>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
        echo "<hr>";
        echo "</center";
    }
} else {
    echo "I cant find any content!";
}

$conn->close();
?>

</body>
</html>