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






<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap.js"></script>
<script src="bootstrap.min.js"></script>
<title>Toyota Lanka Petty Cash Verification</title>
  <link rel="icon" type="image/ico" href="1.png">
<style>
  .a {
      /* Linear gradient with two colors */
      background: linear-gradient(to bottom, white, #e1e1e1);
      /* For full height */
   
    }
</style>

<div class="container" style="margin-top: 20px;">
 </form>

  <form method="post" action="view.php" >
  <label for="date">Date:</label>
  <input type="date" id="approve_date" name="date" required>
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
</span><br>
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

  <input type="submit" style="margin:20px;background-color:#e1a793;" value="VIEW PETTY CASH DETAILS">
</form>
<?php
// $servername = "localhost";
// $username = "financia";
// $password = "MoW2f050l;@dRA";
// $dbname = "financia_Mileage";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

if(isset($_POST['date'])) {
    // Sanitize and validate the input (assuming 'date' is in YYYY-MM-DD format)
    
    $date = $_POST['date'];
    $_SESSION['date']=$date;
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
        die("Invalid date format");
    }
} else {
    // If 'date' parameter is not set, use the current date
    $date = date('Y-m-d');
   
}


if(isset($_POST['site'])) {
  // Sanitize and validate the input (assuming 'date' is in YYYY-MM-DD format)
  
  $site = $_POST['site'];
  $_SESSION['site'] = $site;

} else {
  // If 'date' parameter is not set, use the current date
  $site = 'WAT';
 
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



  // Process the data when the 'date' is received
  // Your code here...

// Retrieve data from the "petty_cash" table
$sql = "SELECT * FROM petty_cash WHERE date = '$date' AND site ='$site'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Access the data using column names
        $id = $row['id'];
        $date = $row['date'];
$time = $row['time'];
$sub_ledger = $row['sub_ledger'];
$notes = $row['notes'];
$cash_5000 = $row['cash_5000'];
$cash_2000 = $row['cash_2000'];
$cash_1000 = $row['cash_1000'];
$cash_500 = $row['cash_500'];
$cash_100 = $row['cash_100'];
$cash_50 = $row['cash_50'];
$cash_20 = $row['cash_20'];
$coins_10 = $row['coins_10'];
$coins_5 = $row['coins_5'];
$coins_2 = $row['coins_2'];
$coins_1 = $row['coins_1'];
$grand_total = $row['grand_total'];
$unsettled_advance_voucher = $row['unsettled_advance_voucher'];
$reimbursement_not_received = $row['reimbursement_not_received'];
$grand_total_float = $row['grand_total_float'];
$difference = $row['difference'];
$reason = $row['reason'];
$cashier_no = $row['cashier_no'];
$cashier_date = $row['cashier_date'];
$cashier_amount = $row['cashier_amount'];
$audit_representative = $row['audit_representative'];
$approved = $row['approved'];
$finrep_time = $row['finrep_time'];
$HOD = $row['HOD_approved'];
$HOD_time = $row['HOD_time'];
$site = $row['site'];
$pending_reimbursement = $row['pending_reimbursement'];

        // Retrieve other column data in a similar way

        // Do something with the retrieved data
        function getColor($value) {
          return ($value == 1) ? 'green' : 'red';
      }
      
      $c_5000 = $cash_5000*5000;
      $c_2000 = $cash_2000*2000;
      $c_1000 = $cash_1000*1000;
      $c_500 = $cash_500*500;
      $c_100 = $cash_100*100;
      $c_50 = $cash_50*50;
      $c_20 = $cash_20*20;
      $co_10 = $coins_10*10;
      $co_5 = $coins_5*5;
      $co_2 = $coins_2*2;
      $co_1 = $coins_1*1;
     

      // Echo the results with appropriate colors
      echo "HOD Approved : <span style='color: " . getColor($HOD) . ";'>" . ($HOD == 1 ? 'Yes' : 'No') . "</span><br>";
      echo "Audit Representative Approved : <span style='color: " . getColor($approved) . ";'>" . ($approved == 1 ? 'Yes' : 'No') . "</span><br>";
      
     echo "Audit Representative  : " . $audit_representative . "<br><br><br><br>";
     echo "Site:   " . $site . "<br>";
     echo "Date:   " . $date . "<br>";
        echo "Time:  " . $time . "<br>";
        echo "Sub Ledger/ As Per ERP: " . $sub_ledger . "<br>";
       
        echo "grand_total: " . $grand_total . "<br>";
        echo "Advance_voucher: " . $unsettled_advance_voucher . "<br>";
        echo "Immediate_Petty_Cash_voucher: " . $reimbursement_not_received . "<br>";
        echo "Pending Reimbursement: " . $pending_reimbursement . "<br>";
        echo "grand_total: " . $grand_total . "<br>";

        echo "Cashier : " . $cashier_no ."<br>";

        echo "5000 x  :" . $cash_5000. "<span style='margin-left:60px;'> : $c_5000 </span>"."<br>";
        echo "2000 x  :" . $cash_2000. "<span style='margin-left:60px;'> : $c_2000 </span>"."<br>";
        echo "1000 x  :". $cash_1000. "<span style='margin-left:60px;'> : $c_1000 </span>"."<br>";
        echo "500 x   :". $cash_500. "<span style='margin-left:60px;'> : $c_500 </span>"."<br>";
        echo "100 x   :". $cash_100. "<span style='margin-left:60px;'> : $c_100 </span>"."<br>";
        echo "50 x    :". $cash_50. "<span style='margin-left:60px;'> : $c_50 </span>"."<br>";
        echo "20 x    :". $cash_20. "<span style='margin-left:60px;'> : $c_20 </span>"."<br>";
        
        echo "10 x   :". $coins_10. "<span style='margin-left:60px;'> : $co_10 </span>"."<br>";
        echo "5 x   :". $coins_5. "<span style='margin-left:60px;'> : $co_5 </span>"."<br>";
        echo "2 x    :". $coins_2. "<span style='margin-left:60px;'> : $co_2 </span>"."<br>";
        echo "1 x    :". $coins_1. "<span style='margin-left:60px;'> : $co_1 </span>"."<br>";

        

        echo "Reasons For Difference : " . $reason . "<br>";
        // Output other column data as needed
    }
} else {
    echo "No data found.";
}

$conn->close();
?>
</div>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<br><br><br><br><br><br>
<div style="display: flex; flex-wrap: wrap;" class="container a">
        <div style="flex: 50%; padding-right: 10px;">
  <form action="approve2.php">
  <input type="text" style="margin:20px;font-size:20px" id="hod" placeholder="KEY" name="hod"><br>
    <input style="margin:20px;padding: 10px;background-color:#9cccfe;" type="submit" value="HOD APPROVE">
  </form>
  </div>
  <div style="flex: 50%; padding-left: 10px;">
    <form action="approve1.php">
  <input type="text" id="audit_representative" style="margin:20px;font-size:20px" placeholder="Emp Number" name="audit_representative"><br>
    <input type="submit" style="margin:20px;padding: 10px;background-color:#9cccfe;" value="Audit/Finance Representative APPROVE">
  </form>
</div></div>
<footer style="text-align:center;">
    <p style="text-align:center;">&copy; 2023 Toyota Lanka. </p>
    <p></p>
  </footer>