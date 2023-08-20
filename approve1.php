<?php

// $servername = "localhost";
// $username = "financia";
// $password = "MoW2f050l;@dRA";
// $dbname = "financia_Mileage";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";



// $password = $_POST['password'];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$audit_representative = $_GET["audit_representative"];
// Update the "petty_cash" table with the approved status and finrep_time
$sql = "UPDATE petty_cash WHERE SET audit_representative = $audit_representative, approved = 1, finrep_time = NOW()";

if ($conn->query($sql) === TRUE) {
    echo "Finance/Audit Representative Approved successfully!";
    // Send email to HOD
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    // Since there was an error in the database query, display an error message.
    // You can add any error handling logic here.
}




$conn->close();



// CREATE TABLE petty_cash (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     date DATE,
//     time TIME,
//     sub_ledger VARCHAR(50),
//     notes TEXT,
//     cash_5000 INT,
//     cash_2000 INT,
//     cash_1000 INT,
//     cash_500 INT,
//     cash_100 INT,
//     cash_50 INT,
//     cash_20 INT,
//     coins_10 INT,
//     coins_5 INT,
//     coins_2 INT,
//     coins_1 INT,
//     grand_total DECIMAL(10, 2),
//     unsettled_advance_voucher DECIMAL(10, 2),
//     reimbursement_not_received DECIMAL(10, 2),
//     grand_total_float DECIMAL(10, 2),
//     difference DECIMAL(10, 2),
//     reason TEXT,
//     cashier_no VARCHAR(20),
//     cashier_date DATE,
//     cashier_amount DECIMAL(10, 2),
//     audit_representative VARCHAR(50),
//     approved INT,
//     finrep_time TIMESTAMP,
//     HOD_approved VARCHAR(50),
//     HOD_time DATE
//   );
  