<!--hplogin.php-->
<?php


// This block of code creates a database connection as its needed to grab 
//the contents in the database itself, e.g., to verify they registered!
//This is a security measure in case of hackers!
$config = include 'configure2.php';
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userLogin = $_POST['userLogin'];
    $passLogin = $_POST['passLogin'];
    //this looks through all of the columns in the database and checks if 
    //the user put in the correct information for the login!
    $sql = "SELECT * FROM users WHERE username = '$userLogin'";
    $result = $conn->query($sql);

    //If the password and username is correct, then the users receives
    //the correct information to proceed to the shopping cart or they can edit some content!
    //a dashboard is created so the users can see both contentEdit.php and 
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($passLogin, $row['password'])) {
            // Unset the cart here
            session_start();
            unset($_SESSION['cart']);
            header("Location: dashboard.php");
        } 
        //If the password is wrong, it will tell the user that the password is wrong
        //and it will provide links back to the mainpage and the homepage!
        else {
            echo "<center><br><br><h1>Type in the right password next time! grrrrr!</h1> </center>";
            echo "<center><br><h2><a href='https://localhost/homepage.html'>Go back to Homepage to login again!</a></h2></center>";
    
        }
    } 
     //If the Username is wrong, it will tell the user that the password is wrong
    //and it will provide links back to the mainpage and the homepage!
    else {
        echo "<center><br><br><br><h1>Username could not be found! Try again! :) </h1></center>";
        echo "<center><h2><br><a href='https://localhost/homepage.html'>Go back to Homepage to login again!</a></h2></center>";

    }
}


$conn->close();
?>


<DOCTYPE html>
    <html>
        <body>
            <title>login</title>
            <br><br>
    </body>
</html>