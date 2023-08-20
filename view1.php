<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {


    header('Location: index.php');
    exit();
 
} else  {

    

    // Replace with your database connection detai
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


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
    $limitedAccess = "SELECT username FROM limusers WHERE username = ?";

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

    $stmt = $conn->prepare($limitedAccess);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $limCount = $stmt->num_rows;

    if ($loginCount > 0 && $usersCount > 0) {
      
    } elseif($limCount > 0 && $usersCount > 0) {
        
    }else {
        header("location: http://localhost/index.php");
    }
} 

$conn->close();


 

// Retrieve the username from the session
$userName = $_SESSION['username'];
?>




 <form method="post" action="view1.php" >
  <label for="date">Date:</label>
  <input type="date" id="approve_date" name="date" >
  <span style="padding-left:200px;"><label for="site">Site:</label>
  <select id="countries" size="3" onchange="showCapital()">
  <option value="">SELECT ONE</option>
<option value="WAT">WAT</option>
<option value="MAR">MAR</option>
<option value="MAT">MAT</option>

</select>
<input id="capital" name="site" readonly>


<script>
    function showCapital(){
        capital.value = countries.value;
    }
</script>
</span><br><!--
  <script>
  // Function to set the current date in the "Date" input field for cashier
  function setCashierDate() {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, "0"); // Add leading zero if necessary
    const day = String(currentDate.getDate()).padStart(2, "0"); // Add leading zero if necessary
    const formattedDate = `${year}-${month}-${day}`;
    document.getElementById("approve_date").value = formattedDate;
  }

  // Call the setCashierDate function when the page loads
  setCashierDate();
</script>
  <!-- Include other form fields as needed -->

  <input type="submit" style="margin:20px;background-color:#e1a793;" value="FIND RESULTS">
</form>
<span ><a href="view2.php"><button style="background-color:green;">View All</button></a></span>

<?php

if(isset($_POST['site'])) {
    // Sanitize and validate the input (assuming 'date' is in YYYY-MM-DD format)
    
    $site = $_POST['site'];
  
  } else {
    // If 'date' parameter is not set, use the current date
   $site = '';
  }

  if(isset($_POST['date'])) {
    // Sanitize and validate the input (assuming 'date' is in YYYY-MM-DD format)
    
    $date = $_POST['date'];
  
  } else {
    // If 'date' parameter is not set, use the current date
    $date = '';

  }


?>




<?php
if (isset($_POST['login'])) {
    // Get the user input from the form
    $userLoginKey = $_POST['login'];
    $userName = $_POST['login_user'];

    // Check if the user login key matches "hod123"
    if (($userLoginKey === "" && $userName === "") || 
        ($userLoginKey === "" && $userName === "")) {
        // User is logged in, proceed to show the page content
        // Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your database credentials
        $servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";



$conn = new mysqli($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM petty_cash WHERE date=$date AND site=$site ORDER BY date DESC";
        $result = mysqli_query($conn, $sql);

        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "    <title>Petty Cash Historical Figures</title>";
        echo "    <style>";
        echo "        table {";
        echo "            border-collapse: collapse;";
        echo "            width: 200%;";
        echo "        }";
        echo "        th, td {";
        echo "            border: 1px solid black;";
        echo "            padding: 8px;";
        echo "            text-align: left;";
        echo "        }";
        echo "    </style>";
        echo "</head>";
        echo "<body>";
        echo "    <h1>Petty Cash Historical Figures</h1>";
        echo "    <table>";
        echo "        <tr>";
        echo "            <th></th>";
        echo "            <th>Date</th>";
        echo "            <th>Time</th>";
        echo "            <th>Site</th>";
        echo "            <th>Sub Ledger /ERP</th>";
        echo "            <th>Cash 5000</th>";
        echo "            <th>Cash 2000</th>";
        echo "            <th>Cash 1000</th>";
        echo "            <th>Cash 500</th>";
        echo "            <th>Cash 100</th>";
        echo "            <th>Cash 50</th>";
        echo "            <th>Cash 20</th>";
        echo "            <th>Coin 10</th>";
        echo "            <th>Coin 5</th>";
        echo "            <th>Coin 2</th>";
        echo "            <th>Coin 1</th>";
        echo "            <th>Grand Total</th>";
        echo "            <th>Unsettled Advance Voucher</th>";
        echo "            <th>Reimbursement Not Received</th>";
        echo "            <th>Grand Total Float</th>";
        echo "            <th>Difference</th>";
        echo "            <th>Pending Reimbursement</th>";
        echo "            <th>Reasons/Notes</th>";
        echo "            <th>HOD Approval</th>";
        echo "            <th>Fin/Audit Rep. Approval</th>";
     
        echo "        </tr>";

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "        <tr>";
                echo "            <td>" . $row['id'] . "</td>";
                echo "            <td>" . $row['date'] . "</td>";
                echo "            <td>" . $row['time'] . "</td>";
                echo "            <td>" . $row['site'] . "</td>";
                echo "            <td>" . $row['sub_ledger'] . "</td>";
                echo "            <td>" . $row['cash_5000'] . "</td>";
                echo "            <td>" . $row['cash_2000'] . "</td>";
                echo "            <td>" . $row['cash_1000'] . "</td>";
                echo "            <td>" . $row['cash_500'] . "</td>";
                echo "            <td>" . $row['cash_100'] . "</td>";
                echo "            <td>" . $row['cash_50'] . "</td>";
                echo "            <td>" . $row['cash_20'] . "</td>";
                echo "            <td>" . $row['coins_10'] . "</td>";
                echo "            <td>" . $row['coins_5'] . "</td>";
                echo "            <td>" . $row['coins_2'] . "</td>";
                echo "            <td>" . $row['coins_1'] . "</td>";
                echo "            <td>" . $row['grand_total'] . "</td>";
                echo "            <td>" . $row['unsettled_advance_voucher'] . "</td>";
                echo "            <td>" . $row['reimbursement_not_received'] . "</td>";
                echo "            <td>" . $row['grand_total_float'] . "</td>";
                echo "            <td>" . $row['difference'] . "</td>";
                echo "            <td>" . $row['pending_reimbursement'] . "</td>";
                echo "            <td>" . $row['reason'] . "</td>";
                echo "            <td>" . $row['HOD_approved'] . "</td>";
                echo "            <td>" . $row['approved'] . "</td>";
                // Add more columns as needed
                echo "        </tr>";
            }
        } else {
            echo "        <tr><td colspan='17'>No data found</td></tr>";
        }

        echo "    </table>";
        echo "</body>";
        echo "</html>";

        mysqli_close($conn);
        } else {
        // User login key is incorrect, show an error message
        echo "<h1 style='color:red;'>Error:  Access denied.</h1>";
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";



$conn = new mysqli($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM petty_cash WHERE date=$date AND site=$site ORDER BY date DESC";
    $result = mysqli_query($conn, $sql);

    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
    echo "    <title>Petty Cash Historical Figures</title>";
    echo "    <style>";
    echo "        table {";
    echo "            border-collapse: collapse;";
    echo "            width: 200%;";
    echo "        }";
    echo "        th, td {";
    echo "            border: 1px solid black;";
    echo "            padding: 8px;";
    echo "            text-align: left;";
    echo "        }";
    echo "    </style>";
    echo "</head>";
    echo "<body>";
    echo "    <h1>Petty Cash Historical Figures</h1>";
    echo "    <table>";
    echo "        <tr>";
    echo "            <th></th>";
    echo "            <th>Date</th>";
    echo "            <th>Time</th>";
    echo "            <th>Site</th>";
    echo "            <th>Sub Ledger /ERP</th>";
    echo "            <th>Cash 5000</th>";
    echo "            <th>Cash 2000</th>";
    echo "            <th>Cash 1000</th>";
    echo "            <th>Cash 500</th>";
    echo "            <th>Cash 100</th>";
    echo "            <th>Cash 50</th>";
    echo "            <th>Cash 20</th>";
    echo "            <th>Coin 10</th>";
    echo "            <th>Coin 5</th>";
    echo "            <th>Coin 2</th>";
    echo "            <th>Coin 1</th>";
    echo "            <th>Grand Total</th>";
    echo "            <th>Unsettled Advance Voucher</th>";
    echo "            <th>Reimbursement Not Received</th>";
    echo "            <th>Grand Total Float</th>";
    echo "            <th>Difference</th>";
    echo "            <th>Pending Reimbursement</th>";
    echo "            <th>Reasons/Notes</th>";
    echo "        </tr>";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "        <tr>";
            echo "            <td>" . $row['id'] . "</td>";
            echo "            <td>" . $row['date'] . "</td>";
            echo "            <td>" . $row['time'] . "</td>";
            echo "            <td>" . $row['site'] . "</td>";
            echo "            <td>" . $row['sub_ledger'] . "</td>";
            echo "            <td>" . $row['cash_5000'] . "</td>";
            echo "            <td>" . $row['cash_2000'] . "</td>";
            echo "            <td>" . $row['cash_1000'] . "</td>";
            echo "            <td>" . $row['cash_500'] . "</td>";
            echo "            <td>" . $row['cash_100'] . "</td>";
            echo "            <td>" . $row['cash_50'] . "</td>";
            echo "            <td>" . $row['cash_20'] . "</td>";
            echo "            <td>" . $row['coins_10'] . "</td>";
            echo "            <td>" . $row['coins_5'] . "</td>";
            echo "            <td>" . $row['coins_2'] . "</td>";
            echo "            <td>" . $row['coins_1'] . "</td>";
            echo "            <td>" . $row['grand_total'] . "</td>";
            echo "            <td>" . $row['unsettled_advance_voucher'] . "</td>";
            echo "            <td>" . $row['reimbursement_not_received'] . "</td>";
            echo "            <td>" . $row['grand_total_float'] . "</td>";
            echo "            <td>" . $row['difference'] . "</td>";
            echo "            <td>" . $row['pending_reimbursement'] . "</td>";
            echo "            <td>" . $row['reason'] . "</td>";
            // Add more columns as needed
            echo "        </tr>";
        }
    } else {
        echo "        <tr><td colspan='17'>No data found</td></tr>";
    }

    echo "    </table>";
    echo "</body>";
    echo "</html>";

    mysqli_close($conn);
}
// $servername = "localhost";
// $username = "financia";
// $password = "MoW2f050l;@dRA";
// $dbname = "financia_Mileage";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



  $sql = "SELECT * FROM petty_cash WHERE date='$date' OR( (date OR date='$date') AND ( site OR site='$site')) ORDER BY date DESC,site DESC";
 // $sql = "SELECT * FROM petty_cash WHERE date  AND site ORDER BY date DESC";


$result = mysqli_query($conn, $sql);

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "    <title>Petty Cash Historical Figures</title>";
echo "    <style>";
echo "        table {";
echo "            border-collapse: collapse;";
echo "            width: 200%;";
echo "        }";
echo "        th, td {";
echo "            border: 1px solid black;";
echo "            padding: 8px;";
echo "            text-align: left;";
echo "        }";
echo "    </style>";
echo "</head>";
echo "<body>";
echo "    <h1>Petty Cash Historical Figures</h1>";
echo "    <table>";
echo "        <tr>";
echo "            <th></th>";
echo "            <th>Date</th>";
echo "            <th>Time</th>";
echo "            <th>Site</th>";
echo "            <th>Sub Ledger /ERP</th>";
echo "            <th>Cash 5000</th>";
echo "            <th>Cash 2000</th>";
echo "            <th>Cash 1000</th>";
echo "            <th>Cash 500</th>";
echo "            <th>Cash 100</th>";
echo "            <th>Cash 50</th>";
echo "            <th>Cash 20</th>";
echo "            <th>Coin 10</th>";
echo "            <th>Coin 5</th>";
echo "            <th>Coin 2</th>";
echo "            <th>Coin 1</th>";
echo "            <th>Grand Total</th>";
echo "            <th>Unsettled Advance Voucher</th>";
echo "            <th>Reimbursement Not Received</th>";
echo "            <th>Grand Total Float</th>";
echo "            <th>Difference</th>";
echo "            <th>Pending Reimbursement</th>";
echo "            <th>Reasons/Notes</th>";
echo "            <th>HOD Approval</th>";
echo "            <th>Fin/Audit Rep. Approval</th>";
echo "        </tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "        <tr>";
        echo "            <td>" . $row['id'] . "</td>";
        echo "            <td>" . $row['date'] . "</td>";
        echo "            <td>" . $row['time'] . "</td>";
        echo "            <td>" . $row['site'] . "</td>";
        echo "            <td>" . $row['sub_ledger'] . "</td>";
        echo "            <td>" . $row['cash_5000'] . "</td>";
        echo "            <td>" . $row['cash_2000'] . "</td>";
        echo "            <td>" . $row['cash_1000'] . "</td>";
        echo "            <td>" . $row['cash_500'] . "</td>";
        echo "            <td>" . $row['cash_100'] . "</td>";
        echo "            <td>" . $row['cash_50'] . "</td>";
        echo "            <td>" . $row['cash_20'] . "</td>";
        echo "            <td>" . $row['coins_10'] . "</td>";
        echo "            <td>" . $row['coins_5'] . "</td>";
        echo "            <td>" . $row['coins_2'] . "</td>";
        echo "            <td>" . $row['coins_1'] . "</td>";
        echo "            <td>" . $row['grand_total'] . "</td>";
        echo "            <td>" . $row['unsettled_advance_voucher'] . "</td>";
        echo "            <td>" . $row['reimbursement_not_received'] . "</td>";
        echo "            <td>" . $row['grand_total_float'] . "</td>";
        echo "            <td>" . $row['difference'] . "</td>";
        echo "            <td>" . $row['pending_reimbursement'] . "</td>";
        echo "            <td>" . $row['reason'] . "</td>";
        echo "            <td>" . $row['HOD_approved'] . "</td>";
        echo "            <td>" . $row['approved'] . "</td>";
        // Add more columns as needed
        echo "        </tr>";
    }
} else {
    echo "        <tr><td colspan='17'>No data found</td></tr>";
}

echo "    </table>";
echo "</body>";
echo "</html>";

mysqli_close($conn);
?>


<!-- ALTER TABLE petty_cash
ADD pending_reimbursement DECIMAL(10, 2) DEFAULT 0.00; -->
