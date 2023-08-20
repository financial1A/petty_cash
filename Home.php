<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$userName=$_SESSION['username'] ;
?>


 
 
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap.js"></script>
<script src="bootstrap.min.js"></script>
<style>
  input{
    margin: 3.5px;
  }
  body {
      /* Linear gradient with two colors */
      background: linear-gradient(to bottom, white, #e1e1e1);
      /* For full height */
   
    }

  input, textarea{
    background-color:#e3e3e3; 
  }
</style>
<div class="container">
<h2 style="text-align: center;margin-top: 20px;text-transform: uppercase;">daily Physical Petty Cash Verification</h2>

  <form method="post" action="petty.php" id="PrintForm">
    <fieldset>
      <legend>Cash on Hand</legend>
      <?php
// Assuming you have already established a connection to the MySQL database
// For example:
//$conn = mysqli_connect("localhost", "financia", "MoW2f050l;@dRA", "financia_Mileage");

$servername = "localhost";
$username = "financia";
$password = "MoW2f050l;@dRA";
$dbname = "financia_Mileage";

// function verifyUserLogin($username, $loginKey)
// {
//     global $conn;

//     // Prepare the SQL query to retrieve the loginkey for the given username
//     $sql = "SELECT COUNT(*) AS count FROM users WHERE username = ? AND loginkey = ?";

//     // Prepare and bind the SQL statement
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "ss", $username, $loginKey);

//     // Execute the query
//     mysqli_stmt_execute($stmt);

//     // Bind the result to a variable
//     mysqli_stmt_bind_result($stmt, $count);

//     // Fetch the result (if any)
//     mysqli_stmt_fetch($stmt);

//     // Close the statement
//     mysqli_stmt_close($stmt);

//     // Check if there is a match in the database for the given loginkey and username
//     return $count > 0;
// }

// if (isset($_POST['login'])) {
//     // Get the user input from the form
//     $userName = $_POST['login_user'];
//     $userLoginKey = $_POST['login'];

//     // Verify the user login
//     if (verifyUserLogin($userName, $userLoginKey)) {
//         // Access granted, redirect to view1.php
//         echo '<label for="date">Date:</label>';
//         echo '<input type="date" id="date" name="date" required><br>';
//     } else {
//         // Invalid login, show an error message or redirect back to the login page
//         echo '<h1 style="color:red">No Access</h1>';
//     }
    
// }else{
//   echo '<h1 style="color:red">No Access</h1>';
// }


if (isset($_SESSION['username'])) {
    echo '<label for="date">Date:</label>';
 echo '<input type="date" id="date" name="date" required><br>';
}else{
    echo '<h1 style="color:red">No Access</h1>';
}

?>

<script>
  // Function to set the current date in the "Date" input field
  function setCurrentDate() {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, "0"); // Add leading zero if necessary
    const day = String(currentDate.getDate()).padStart(2, "0"); // Add leading zero if necessary
    const formattedDate = `${year}-${month}-${day}`;
    document.getElementById("date").value = formattedDate;
  }

  // Call the setCurrentDate function when the page loads
  setCurrentDate();
</script>

<label for="time">Time:</label>
<input type="time" id="time" name="time" required readonly><br>

<script>
  // Function to set the current time in the "Time" input field
  function setCurrentTime() {
    const currentTime = new Date();
    const hours = String(currentTime.getHours()).padStart(2, "0"); // Add leading zero if necessary
    const minutes = String(currentTime.getMinutes()).padStart(2, "0"); // Add leading zero if necessary
    const formattedTime = `${hours}:${minutes}`;
    document.getElementById("time").value = formattedTime;
  }

  // Call the setCurrentTime function when the page loads
  setCurrentTime();
</script>

      <label for="sub_ledger">Sub Ledger / Balance as per ERP:</label>
      <input type="text" id="sub_ledger" name="sub_ledger" required>
      <span style="padding-left:200px;"><label for="sit">Site:</label>
      <?php
// Replace with your database connection details
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

// Fetch data from site table
$sql = "SELECT sitename FROM site";
$result = $conn->query($sql);
?>

<select id="site" size="3" onchange="showCapital()">
    <option value="">SELECT ONE</option>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["sitename"] . '">' . $row["sitename"] . '</option>';
        }
    }
    ?>
</select>

<input id="sitename" name="site" readonly required>

<?php
$conn->close();
?>

<script>
        function showCapital() {
            var site = document.getElementById("site");
            var sitename = document.getElementById("sitename");
            
            sitename.value = site.value;
        }
    </script>
</span><br>

      <label for="notes">Notes:</label>
      <textarea id="notes" name="notes" rows="4" cols="50"></textarea><br>
      <div style="display: flex; flex-wrap: wrap;">
  <div style="flex: 50%; padding-right: 10px;">
    <label for="cash_5000">Rs. 5000 X</label>
    <input type="number" id="cash_5000" name="cash_5000" class="cash" min="0" step="1">
    <output id="cash_5000_total">0</output><br>

    <label for="cash_2000">Rs. 2000 X</label>
    <input type="number" id="cash_2000" name="cash_2000" class="cash" min="0" step="1">
    <output id="cash_2000_total">0</output><br>

    <label for="cash_1000">Rs. 1000 X</label>
    <input type="number" id="cash_1000" name="cash_1000" class="cash" min="0" step="1">
    <output id="cash_1000_total">0</output><br>

    <label for="cash_500">Rs. 500 X</label>
    <input type="number" id="cash_500" name="cash_500" class="cash" min="0" step="1">
    <output id="cash_500_total">0</output><br>
  </div>

  <div style="flex: 50%; padding-left: 10px;">
    <label for="cash_100">Rs. 100 X</label>
    <input type="number" id="cash_100" name="cash_100" class="cash" min="0" step="1">
    <output id="cash_100_total">0</output><br>

    <label for="cash_50">Rs. 50 X</label>
    <input type="number" id="cash_50" name="cash_50" class="cash" min="0" step="1">
    <output id="cash_50_total">0</output><br>

    <label for="cash_20">Rs. 20 X</label>
    <input type="number" id="cash_20" name="cash_20" class="cash" min="0" step="1">
    <output id="cash_20_total">0</output><br>
  </div>
</div>

<!-- Add more input fields for other denominations -->
<div style="display: flex; flex-wrap: wrap;">
  <div style="flex: 50%; padding-right: 10px;">
    <label for="coins_10" style="margin-right:60px">10 X</label>
    <input type="number" id="coins_10" class="coins" name="coins_10" min="0" step="1">
    <output id="coins_10_total">0</output><br>

    <label for="coins_5" style="margin-right:60px">5 X</label>
    <input type="number" id="coins_5" class="coins" name="coins_5" min="0" step="1">
    <output id="coins_5_total">0</output><br>
  </div>

  <div style="flex: 50%; padding-left: 10px;">
    <label for="coins_2">2 X</label>
    <input type="number" id="coins_2" class="coins" name="coins_2" min="0" step="1">
    <output id="coins_2_total">0</output><br>

    <label for="coins_1">1 X</label>
    <input type="number" id="coins_1" class="coins" name="coins_1" min="0" step="1">
    <output id="coins_1_total">0</output><br>
  </div>
</div>

<script>
  // Function to calculate and display the totals for each coin denomination
  function calculateCoinTotals() {
    const coinsInputs = document.getElementsByClassName("coins");
    const cashInputs = document.getElementsByClassName("cash");

    // Loop through the coin inputs and calculate the total for each denomination
    for (let i = 0; i < coinsInputs.length; i++) {
      const coinsValue = parseFloat(coinsInputs[i].value) || 0;
      const coinsTotal = coinsValue * parseInt(coinsInputs[i].id.split("_")[1]);
      document.getElementById(coinsInputs[i].id + "_total").textContent = coinsTotal;
    }

    // Loop through the cash inputs and calculate the total for each denomination
    for (let i = 0; i < cashInputs.length; i++) {
      const cashValue = parseFloat(cashInputs[i].value) || 0;
      const cashTotal = cashValue * parseInt(cashInputs[i].id.split("_")[1]);
      document.getElementById(cashInputs[i].id + "_total").textContent = cashTotal;
    }

    // Calculate the Grand Total
    const coins_10 = parseFloat(document.getElementById("coins_10_total").textContent) || 0;
    const coins_5 = parseFloat(document.getElementById("coins_5_total").textContent) || 0;
    const coins_2 = parseFloat(document.getElementById("coins_2_total").textContent) || 0;
    const coins_1 = parseFloat(document.getElementById("coins_1_total").textContent) || 0;

    const cash_5000 = parseFloat(document.getElementById("cash_5000_total").textContent) || 0;
    const cash_2000 = parseFloat(document.getElementById("cash_2000_total").textContent) || 0;
    const cash_1000 = parseFloat(document.getElementById("cash_1000_total").textContent) || 0;
    const cash_500 = parseFloat(document.getElementById("cash_500_total").textContent) || 0;
    const cash_100 = parseFloat(document.getElementById("cash_100_total").textContent) || 0;
  const cash_50 = parseFloat(document.getElementById("cash_50_total").textContent) || 0;
  const cash_20 = parseFloat(document.getElementById("cash_20_total").textContent) || 0;

  const grand_total = coins_10 + coins_5 + coins_2 + coins_1 + cash_5000 + cash_2000 + cash_1000 + cash_500 + cash_100 + cash_50 + cash_20;


    // Update the Grand Total input value
    document.getElementById("grand_total").value = grand_total;
  }

  // Attach the calculateCoinTotals function to the oninput event of coin and cash inputs
  const coinsInputs = document.getElementsByClassName("coins");
  for (let i = 0; i < coinsInputs.length; i++) {
    coinsInputs[i].addEventListener("input", calculateCoinTotals);
  }

  const cashInputs = document.getElementsByClassName("cash");
  for (let i = 0; i < cashInputs.length; i++) {
    cashInputs[i].addEventListener("input", calculateCoinTotals);
  }

  // Call the calculateCoinTotals function initially to set the totals to 0
  calculateCoinTotals();
</script>

<label for="grand_total">Grand Total:</label>
<input type="text" id="grand_total" name="grand_total" required><br>




    <fieldset>
    <legend>Petty Cash Float</legend>
  <div style="display: flex; flex-wrap: wrap;">
    <div style="flex: 50%; padding-right: 10px;">
      <label for="unsettled_advance_voucher">Unsettled Advance Voucher:</label>
      <input type="number" id="unsettled_advance_voucher" name="unsettled_advance_voucher" min="0" step="1"><br>

      <label for="reimbursement_not_received">Immediate Reimbursement:</label>
      <input type="text" id="reimbursement_not_received" name="reimbursement_not_received" min="0" step="1"><br>

      <label for="pending_reimbursement">Pending Reimbursement :</label>
      <input type="text" id="pending_reimbursement" name="pending_reimbursement" required><br>


      <label for="grand_total_float" style="margin-right:60px">Grand Total :</label>
      <input type="text" id="grand_total_float" name="grand_total_float" required><br>

      <label for="Petty_Cash_float" style="margin-right:60px">Petty Cash Float:</label>
      <input type="text" id="Petty_Cash_float" name="Petty_Cash_float" value="300000" readonly required><br>
   
        <div style="flex: 50%; padding-left: 10px;">
      <label for="difference">Difference:</label>
      <input type="text" id="difference" name="difference" required><br>
      </div>

      <script>
        // Get references to the input fields
        const grandTotalInput = document.getElementById("grand_total_float");
        const pettyCashInput = document.getElementById("Petty_Cash_float");
        const differenceInput = document.getElementById("difference");

        // Add event listeners to recalculate the difference when inputs change
        grandTotalInput.addEventListener("input", calculateDifference);
        pettyCashInput.addEventListener("input", calculateDifference);

        function calculateDifference() {
            const grandTotal = parseFloat(grandTotalInput.value) || 0; // Parse float from input or default to 0
            const pettyCash = parseFloat(pettyCashInput.value) || 0;
            const calculatedDifference = grandTotal - pettyCash;

            differenceInput.value = calculatedDifference.toFixed(2); // Display the difference with 2 decimal places
        }
    </script>

  </div>
      <label for="reason">Reason:</label>
      <textarea id="reason" name="reason" rows="4" cols="50" style="height:100px"></textarea><br>
        </div></div>
    
    </fieldset>
    <script>
  // Function to update the Grand Total Float value
  function updateGrandTotalFloat() {
    // Get the values from the input fields
    const grandTotal = parseFloat(document.getElementById('grand_total').value) || 0;
    const unsettledAdvanceVoucher = parseFloat(document.getElementById('unsettled_advance_voucher').value) || 0;
    const reimbursementNotReceived = parseFloat(document.getElementById('reimbursement_not_received').value) || 0;
        const pending_reimbursement = parseFloat(document.getElementById('pending_reimbursement').value) || 0;

    // Calculate the Grand Total Float
    const grandTotalFloat = grandTotal + unsettledAdvanceVoucher + reimbursementNotReceived + pending_reimbursement;

    // Update the Grand Total Float input field
    document.getElementById('grand_total_float').value = grandTotalFloat.toFixed(2);
  }

  // Add event listeners to the input fields
  document.getElementById('grand_total').addEventListener('input', updateGrandTotalFloat);
  document.getElementById('unsettled_advance_voucher').addEventListener('input', updateGrandTotalFloat);
  document.getElementById('reimbursement_not_received').addEventListener('input', updateGrandTotalFloat);
    document.getElementById('pending_reimbursement').addEventListener('input', updateGrandTotalFloat);

  // Initial update of Grand Total Float value
  updateGrandTotalFloat();
</script>
    <!-- <fieldset>
      <legend>Cashier</legend>

      <label for="cashier_no" style="margin-right:60px">No:</label>
      <input type="text" id="cashier_no" name="cashier_no" required><br>

      <label for="cashier_date" style="margin-right:55px">Date:</label>
<input type="date" id="cashier_date" name="cashier_date" required><br>

<script>
  // Function to set the current date in the "Date" input field for cashier
  function setCashierDate() {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, "0"); // Add leading zero if necessary
    const day = String(currentDate.getDate()).padStart(2, "0"); // Add leading zero if necessary
    const formattedDate = `${year}-${month}-${day}`;
    document.getElementById("cashier_date").value = formattedDate;
  }

  // Call the setCashierDate function when the page loads
  setCashierDate();
</script>


      <label for="cashier_amount">Amount (Rs):</label>
      <input type="number" id="cashier_amount" name="cashier_amount" min="0" step="1"><br>
    </fieldset> -->

    <?php
// Assuming you have already established a connection to the MySQL database
// For example:
$conn = mysqli_connect("localhost", "financia", "MoW2f050l;@dRA", "financia_Mileage");

// function verifyUserLogin($username, $loginKey)
// {
//     global $conn;

//     // Prepare the SQL query to retrieve the loginkey for the given username
//     $sql = "SELECT COUNT(*) AS count FROM users WHERE username = ? AND loginkey = ?";

//     // Prepare and bind the SQL statement
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "ss", $username, $loginKey);

//     // Execute the query
//     mysqli_stmt_execute($stmt);

//     // Bind the result to a variable
//     mysqli_stmt_bind_result($stmt, $count);

//     // Fetch the result (if any)
//     mysqli_stmt_fetch($stmt);

//     // Close the statement
//     mysqli_stmt_close($stmt);

//     // Check if there is a match in the database for the given loginkey and username
//     return $count > 0;
// }



if (isset($_SESSION['username'])) {
    echo '   <input type="submit" style="margin:20px;margin-left:200px;background-color:#9cccfe;"  value="SEND TO APPROVAL">';
}else{
    echo '<h1 style="color:red">No Access</h1>';
}
?>


    <br><br><br>
 <!--
  </form>

  <form method="post" action="view.php" >
  <label for="date">Date:</label>
  <input type="date" id="approve_date" name="date" required><br>
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
 

  <input type="submit" style="margin:20px;background-color:#e1a793;" value="VIEW PETTY CASH DETAILS">
</form>
<br><br><br>
-->

<!--
  <fieldset>
  <legend>Audit/Finance Representative</legend>

  <label for="audit_representative">Representative Name:</label>
  <input type="text" id="audit_representative" name="audit_representative"><br>

  <button type="button" onclick="approveForm()">Approve</button>
</fieldset>

<script>
  function approveForm() {
    // Set the form action to process.php
    document.getElementById("myForm").action = "index.php";
    
    // Set the value of the approved field to 1
    document.getElementById("approved").value = 1;
    
    // Set the value of the finrep_time field to the current timestamp
    document.getElementById("finrep_time").value = new Date().toISOString();
    
    // Submit the form
    document.getElementById("myForm").submit();
  }
</script>

<fieldset>
  <legend>Branch In Charge</legend>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password"><br>

  <button type="button" onclick="checkPassword()">Approve</button>
</fieldset>

<script>
  function checkPassword() {
    // Get the password entered by the branch in charge
    var password = document.getElementById("password").value;
    
    // Perform password verification
    if (password === "123456") {
      // Set the form action to process.php
      document.getElementById("myForm").action = "process.php";
      
      // Set the value of the HOD field to the branch in charge's name
      document.getElementById("HOD").value = "Branch In Charge Name";
      
      // Set the value of the HOD_time field to the current date
      document.getElementById("HOD_time").value = new Date().toISOString().split('T')[0];
      
      // Submit the form
      document.getElementById("myForm").submit();
    } else {
      alert("Invalid password. Approval denied.");
    }
  }
</script>
-->

<form id="PrintList" >
    <input type="button" onclick="saveAndPrint()" value="Print" style="margin-left:200px;margin-bottom:200px;">
</form>
    <script>
        function saveAndPrint() {
            // Handle form submission and save the data to local storage
            const formData = new FormData(document.getElementById('PrintForm'));

            const applicationData = {
                name: formData.get('coins_1'),
                date: formData.get('date'),
                sub_ledger: formData.get('sub_ledger'),
                cash_5000: formData.get('cash_5000'),
                cash_2000: formData.get('cash_2000'),
                cash_1000: formData.get('cash_1000'),
                cash_500: formData.get('cash_500'),
                cash_100: formData.get('cash_100'),
                cash_50: formData.get('cash_50'),
                cash_20: formData.get('cash_20'),
                coins_10: formData.get('coins_10'),
                coins_5: formData.get('coins_5'),
                coins_2: formData.get('coins_2'),
                coins_1: formData.get('coins_1'),
                grand_total: formData.get('grand_total'),
                unsettled_advance_voucher: formData.get('unsettled_advance_voucher'),
                reimbursement_not_received: formData.get('reimbursement_not_received'),
                grand_total_float: formData.get('grand_total_float'),
                difference: formData.get('difference'),
                reason: formData.get('reason'),
                site:formData.get('site'),

            };

            localStorage.setItem('ApplicationData', JSON.stringify(applicationData));

            let ten = applicationData.name *10;
            let f5000 = applicationData.cash_5000*5000;
            let f2000 = applicationData.cash_2000*2000;
            let f1000 = applicationData.cash_1000*1000;
            let f500 = applicationData.cash_500*500;
            let f100 = applicationData.cash_100*100;
            let f50 = applicationData.cash_50*50;
            let f20 = applicationData.cash_20*20;
            let f10 = applicationData.coins_10*10;
            let f5 = applicationData.coins_10*5;
            let f2 = applicationData.coins_10*2;
            let f1 = applicationData.coins_10*1;





            //HTML page


            // Open a new window and print the summary
            const printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Petty Cash Summary</title></head><body>');
            printWindow.document.write('<h1 style="padding-left:150px;">Daily Petty Cash Verification </h1>');
            printWindow.document.write('<h5 style="padding-left:50px;">Head Office <span style="padding-left:270px;">'+applicationData.date+'</span></h5>');
            printWindow.document.write('<h5 style="padding-left:50px;">337, <span style="padding-left:300px;">'+applicationData.site+'</span></h5>');
            printWindow.document.write('<h5 style="padding-left:50px;">Negombo Road, </h5>');
            printWindow.document.write('<h5 style="padding-left:50px;padding-bottom:30px;">Wattala. </h5>');
            printWindow.document.write('<p style="padding-left:50px;">Sub Ledger/ERP:...... ' + applicationData.sub_ledger +'</p>');
            printWindow.document.write('<p style="padding-left:50px;">5000 x :............. ' + applicationData.cash_5000 +'..... = '+f5000+ '<span style="padding-left:250px">10 x .........'+applicationData.coins_10+"..... = "+f10+"</span></p>");
            printWindow.document.write('<p style="padding-left:50px;">2000 x :............. ' + applicationData.cash_2000 +'..... = '+f2000+ '<span style="padding-left:250px">5 x .........'+applicationData.coins_5+"..... = "+f5+"</span></p>");
            printWindow.document.write('<p style="padding-left:50px;">1000 x :............. ' + applicationData.cash_1000 +'..... = '+f1000+ '<span style="padding-left:250px">2 x .........'+applicationData.coins_2+"..... = "+f2+"</span></p>");
            printWindow.document.write('<p style="padding-left:50px;">500 x :.............. ' + applicationData.cash_500 +'..... = '+f500+ '<span style="padding-left:250px">1 x .........'+applicationData.coins_1+"..... = "+f1+"</span></p>");
            printWindow.document.write('<p style="padding-left:50px;">100 x :.............. ' + applicationData.cash_100 +'..... = '+f100+ '</p>');
            printWindow.document.write('<p style="padding-left:50px;">50 x :............... ' + applicationData.cash_50 +' .....= '+f50+ '</p>');
            printWindow.document.write('<p style="padding-left:50px;">20 x :............... ' + applicationData.cash_20 +'..... = '+f20+ '</p>');


            printWindow.document.write('<p style="padding-left:50px;">Total / Cash On Hand:................. ' + applicationData.grand_total + '</p>');
            printWindow.document.write('<p style="padding-left:50px;">Unsettled Advance Voucher:.... ' + applicationData.unsettled_advance_voucher + '</p>');
            printWindow.document.write('<p style="padding-left:50px;">Immediate Reimbursement:......... ' + applicationData.reimbursement_not_received + '</p>');
            printWindow.document.write('<p style="padding-left:50px;">Grand Total :................. ' + applicationData.grand_total_float + '</p>');
            printWindow.document.write('<p style="padding-left:50px;">Difference:.......................... ' + applicationData.difference + '</p>');
            printWindow.document.write('<p style="padding-left:50px;">Reason:................................. ' + applicationData.reason + '</p>');
            printWindow.document.write('<p style="padding-top:100px;">..........................................<span style="padding-left:60px;"></span>..........................................<span style="padding-left:60px;">..........................................</span></p>');
            printWindow.document.write('<p style="padding-left:50px;">Cashier<span style="padding-left:120px;"></span>Audit/Finance Representative<span style="padding-left:110px;">HOD</span></p>');
            printWindow.document.write('<footer style="text-align:center;padding-top:100px;"><p>&copy; 2023 Toyota Lanka.</p><p></p></footer>');
           
            printWindow.document.write('</body></html>');

            printWindow.document.close();
            printWindow.print();
        }











        // Attach the saveAndPrint function to the form's submit event
        document.getElementById('PrintList').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent form submission
            saveAndPrint();
        });

        // On page load, check if there is saved application data and fill the form fields
        const savedApplicationData = localStorage.getItem('ApplicationData');

        if (savedApplicationData) {
            // const parsedData = JSON.parse(savedApplicationData);
            // document.getElementById('name').value = parsedData.name;
            // document.getElementById('email').value = parsedData.email;
            // document.getElementById('phone').value = parsedData.phone;
            // document.getElementById('position').value = parsedData.position;
        }
    </script>

      </div>