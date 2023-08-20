<?php
ini_set('session.gc_maxlifetime', 600); // Set session timeout to 10 minutes (10 * 60 seconds)
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Initialize the failed login attempts counter
if (!isset($_SESSION['failed_attempts'])) {
    $_SESSION['failed_attempts'] = 0;
}

function isUsernameLocked($username)
{
    global $conn;

    $sql = "SELECT id FROM locked WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $numRows = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);

    return $numRows > 0;
}

function verifyUserLogin($username, $loginKey)
{
    global $conn;

    $sql = "SELECT loginkey FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashedPassword);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($hashedPassword === $loginKey) {
        return true;
    }

    return false;
}

// Check if the session has expired
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    // Session has expired, destroy the session and redirect to index
    session_unset();
    session_destroy();
    header("Location: index.php"); // Replace with your index page URL
    exit();
}

// Update the last activity time for the session
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_POST['login'])) {
    $userName = $_POST['login_user'];
    $userLoginKey = $_POST['login'];

    if (isUsernameLocked($userName)) {
        header("Location: contact.php"); // Redirect to the contact page if the username is locked
        exit();
    }


    if (verifyUserLogin($userName, $userLoginKey)) {
        $_SESSION['username'] = $userName;

        // Reset failed login attempts counter on successful login
        $_SESSION['failed_attempts'] = 0;

        // Capture login time, username, and IP address
        $loginTime = date('Y-m-d H:i:s');
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        // Insert login information into the newlogin table
        $sqlInsert = "INSERT INTO newlogin (username, login_time, ip_address) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sqlInsert);
        mysqli_stmt_bind_param($stmt, "sss", $userName, $loginTime, $ipAddress);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo('<html><head><script>setTimeout(function(){ location.href="Functions.php";},5000)</script><style>body{background-color:green;padding: 300px;color:white;}</style></head><body><h1>LOGIN SUCCESSFULL</h1> </body></html>');

       // header("Location: Functions.php"); // Redirect to the dashboard or another page
        exit();
    } else {
        $_SESSION['failed_attempts']++;

        if ($_SESSION['failed_attempts'] >= 3) {
            // Insert the locked username and lock time into the locked table
            $lockTime = date('Y-m-d H:i:s');
            $sqlInsertLocked = "INSERT INTO locked (username, lock_time) VALUES (?, ?)";
            $stmtLocked = mysqli_prepare($conn, $sqlInsertLocked);
            mysqli_stmt_bind_param($stmtLocked, "ss", $userName, $lockTime);
            mysqli_stmt_execute($stmtLocked);
            mysqli_stmt_close($stmtLocked);

            header("Location: contact.php"); // Redirect to the contact page after 3 failed attempts
            exit();
        }

        $error = "Invalid login credentials.";
        header("Location: index.php?error=$error"); // Redirect to the login page with error message
    }
}
?>





<!-- CREATE TABLE newlogin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    login_time DATETIME NOT NULL,
    ip_address VARCHAR(45) NOT NULL
); -->


<!-- 
CREATE TABLE locked (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    lock_time DATETIME NOT NULL
); -->
