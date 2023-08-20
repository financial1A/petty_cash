<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$userName=$_SESSION['username'] ;
?>

<?php


// Assuming you have already established a connection to the MySQL database
// $servername = "localhost";
// $username = "financia";
// $password = "MoW2f050l;@dRA";
// $dbname = "financia_Mileage";
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "test";


// $conn = new mysqli($servername, $username, $password, $dbname);
// function verifyUserLogin($username, $loginKey)
// {
//     global $conn;

//     $sql = "SELECT loginkey FROM users WHERE username = ?";
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "s", $username);
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_bind_result($stmt, $hashedPassword);
//     mysqli_stmt_fetch($stmt);
//     mysqli_stmt_close($stmt);

//     if ($hashedPassword === $loginKey) {
//         return true;
//     }

//     return false;
// }

// if (isset($_SESSION['username'])) {
//    // $userName = $_POST['login_user'];
//   //  $userLoginKey = $_POST['login'];
//     $_SESSION['username'] = $userName;
//     header('Location: Home.php');

//     if (verifyUserLogin($userName, $userLoginKey)) {
//         $_SESSION['username'] = $userName;
//         // header("Location: Functions.php"); // Redirect to the dashboard or another page
//         // exit();
//     } else {
//       if (!isset($_SESSION['username'])) {
//         header('Location: index.php');
//         exit();
//     }
//         $error = "Invalid login credentials.";
//     }
// }
?>



<?php
// session_start();

// Check if the user is not logged in
// if (!isset($_SESSION['username'])) {
//     header('Location: index.php');
//     exit();
// }

// Retrieve the username from the session
//$userName = $_SESSION['username'];
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<div class="container" style="margin-top:50px;">

<a href="Home.php"><button class="btn btn-success"><h3>Petty Cash Daily Verification</h3></button></a>


<a href="view2.php"><button class="btn btn-success"><h3>Daily Verifications</h3></button></a>
<a href="view.php"><button class="btn btn-success"><h3>Set Approvals</h3></button></a>
<a href="Admin/index.php"><button class="btn btn-success"><h3>Administrator</h3></button></a>

</div>