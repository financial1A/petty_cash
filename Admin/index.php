<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: https://wat-tlpl.financialengineering.lk/index.php');
    exit();
}else{
    

    // Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
// $servername = "localhost";
// $username = "financia";
// $password = "MoW2f050l;@dRA";
// $dbname = "financia_Mileage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    $username = $_SESSION['username'];

    // Check if the username exists in both tables
    $loginQuery = "SELECT username FROM control WHERE username = ?";
    $usersQuery = "SELECT username FROM users WHERE username = ?";

    $stmt = $conn->prepare($loginQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $loginCount = $stmt->num_rows;

    $stmt = $conn->prepare($usersQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $usersCount = $stmt->num_rows;

    if ($loginCount > 0 && $usersCount > 0) {
      header("location: Admin.php");
    } else {
        header("location: https://wat-tlpl.financialengineering.lk/index.php");
    }
}

$conn->close();




 

// Retrieve the username from the session
$username = $_SESSION['username'];
?>