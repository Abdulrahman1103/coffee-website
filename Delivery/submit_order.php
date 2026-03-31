<?php
$host = 'localhost';
$username = "root";
$password =  '' ;
$dbname = "login";


$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$address = $_POST['address'];

// Insert data into database
$sql = "INSERT INTO delivery_info (name, address) VALUES ('$name', '$address')";
if ($conn->query($sql) === TRUE) {
    echo "your name and address placed successfully! now go to order some coffe to complet your Deilvery ";
    echo '<a href="http://localhost/program/coffee%20website/Order%20now/PHP.php">Click here to order coffee</a>'; 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>