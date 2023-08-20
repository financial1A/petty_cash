<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: https://wat-tlpl.financialengineering.lk/index.php');
    exit();
} else {
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
        exit();
    }
}
?>















<div class="container">
<h1>Administration</h1><br>
<a href="logout.php" style="padding-left: 80%;"><button>LogOut</button></a><br><br><br><br>



<style>
    a {
        
       
        margin: 20px;
    }

</style>

<a href="controlUser.php"><button><h2>
    Create Control User
</h2></button></a>
<a href="newUser.php"><button><h2>Create User</h2></button></a>
<a href="changePassword.php"><button><h2>Change User Password</h2></button></a>
<a href="cUsers.php"><button><h2>View Control User With Password</h2></button></a>
<a href="users.php"><button>
    <h2>View Users Password</h2></button></a>
<a href="delete.php"><button><h2>Delete User</h2></button></a>
<a href="newsite.php"><button><h2>Add New Site</h2></button></a>
<a href="limuser.php"><button><h2>Create Type2 User</h2></button></a>
<a href="locked.php"><button><h2>Unlock User</h2></button></a>

</div>
