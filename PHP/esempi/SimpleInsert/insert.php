<?php
$servername = "localhost";
$username = "root";
$password = "giovanni";
$dbname = "php_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect user input from the form
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$email = $_POST['email'];

// Prepare and execute SQL query to insert a new record
$sql = "INSERT INTO User (firstname, lastname, gender, address, email) VALUES ('$firstname', '$lastname', '$gender', '$address', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
