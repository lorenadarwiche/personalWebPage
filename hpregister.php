<!--hpregister.php-->
<?php
// This connection is in case of hackers! It connects to a different file!
$config = include 'configure2.php';
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //this block grabs the information in the text box for both username and password through POST
    $userRegistration = $_POST['userRegistration'];
    $passRegistration = $_POST['passRegistration'];
    
    //in this case, passwordHash hashes, or hides, the password that is being registered
    $passwordHash = password_hash($passRegistration, PASSWORD_DEFAULT);

    //This inserts the users information into the database that I have created in 000webhostapp
    $sql = "INSERT INTO users (username, password) VALUES ('$userRegistration', '$passwordHash')";

    //what this block does is that it tells you if you have registered correctly or not!
    if ($conn->query($sql) === TRUE) {
        echo "<center><br><br><h2>You have successfully registered!!</h2></center>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="styling.css">
        </head>
        <body>
            <title>Register</title>
            <br>
            <h2><a href="https://localhost.com/homepage.html">Go back to homepage to log right back in!</a>
            </h2>
    </body>
</html>