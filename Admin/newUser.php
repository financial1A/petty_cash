<?php
session_start();
if (!isset($_SESSION['username'])) {
   // header('Location: https://wat-tlpl.financialengineering.lk/index.php');
    exit();
}else{
    

    // Replace with your database connection details
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "test";
$servername = "localhost";
$username = "financia";
$password = "MoW2f050l;@dRA";
$dbname = "financia_Mileage";


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
     
    } else {
        header("location: https://wat-tlpl.financialengineering.lk/index.php");
    }
}

$conn->close();




 

// Retrieve the username from the session
$username = $_SESSION['username'];
?>









<?php
// Replace with your database connection details
$servername = "localhost";
$username = "financia";
$password = "MoW2f050l;@dRA";
$dbname = "financia_Mileage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements
    $stmt = $conn->prepare("INSERT INTO users (username, loginkey) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "<h1>New User Creation successful!</h1>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<a href="logout.php" style="padding-left: 80%;"><button>LogOut</button></a>

<div class="container">
<form action="newUser.php" method="POST">
<label for="username">UserName</label><br>
<input type="text" name="username" required>
<label for="password"></label>
<input type="number" name="password" required placeholder="password (0-9)">
<input type="submit" >
</form>

</div>