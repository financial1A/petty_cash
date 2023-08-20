<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Retrieve the username from the session
$userName = $_SESSION['username'];
?>
<?php
$servername = "localhost";
$username = "financia";
$password = "MoW2f050l;@dRA";
$dbname = "financia_Mileage";



$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Prepare the SQL statement
$sql = "INSERT INTO petty_cash (site,pending_reimbursement,date, time, sub_ledger, notes, cash_5000, cash_2000, cash_1000, cash_500, cash_100, cash_50, cash_20, coins_10, coins_5, coins_2, coins_1, grand_total, unsettled_advance_voucher, reimbursement_not_received, grand_total_float, difference, reason, cashier_no, cashier_date, cashier_amount, audit_representative, approved, finrep_time, HOD_approved, HOD_time)
        VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters to the statement
$stmt->bind_param(
    "sdssssiiiiiiiiiiiiiiidsssdssdss",
    $site,
    $pending_reimbursement,
    $date,
    $time,
    $sub_ledger,
    $notes,
    $cash_5000,
    $cash_2000,
    $cash_1000,
    $cash_500,
    $cash_100,
    $cash_50,
    $cash_20,
    $coins_10,
    $coins_5,
    $coins_2,
    $coins_1,
    $grand_total,
    $unsettled_advance_voucher,
    $reimbursement_not_received,
    $grand_total_float,
    $difference,
    $reason,
    $cashier_no,
    $cashier_date,
    $cashier_amount,
    $audit_representative,
    $approved,
    $finrep_time,
    $HOD_approved,
    $HOD_time
);

// Set the values of the parameters
$site = $_POST['site'];
$pending_reimbursement = $_POST['pending_reimbursement'];
$date = $_POST['date'];
$time = $_POST['time'];
$sub_ledger = $_POST['sub_ledger'];
$notes = $_POST['notes'];
$cash_5000 = $_POST['cash_5000'];
$cash_2000 = $_POST['cash_2000'];
$cash_1000 = $_POST['cash_1000'];
$cash_500 = $_POST['cash_500'];
$cash_100 = $_POST['cash_100'];
$cash_50 = $_POST['cash_50'];
$cash_20 = $_POST['cash_20'];
$coins_10 = $_POST['coins_10'];
$coins_5 = $_POST['coins_5'];
$coins_2 = $_POST['coins_2'];
$coins_1 = $_POST['coins_1'];
$grand_total = $_POST['grand_total'];
$unsettled_advance_voucher = $_POST['unsettled_advance_voucher'];
$reimbursement_not_received = $_POST['reimbursement_not_received'];
$grand_total_float = $_POST['grand_total_float'];
$difference = $_POST['difference'];
$reason = $_POST['reason'];
 $cashier_no = $_SESSION['username'];
// $cashier_date = $_POST['cashier_date'];
// $cashier_amount = $_POST['cashier_amount'];
// $audit_representative = $_POST['audit_representative'];
// $approved = $_POST['approved'];
// $finrep_time = $_POST['finrep_time'];
// $HOD_approved = $_POST['HOD_approved'];
// $HOD_time = $_POST['HOD_time'];

// Execute the statement
if ($stmt->execute()) {
    echo "Petty Cash Updaded successfully! for $date  at $finrep_time";
} else {
   echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();


?>
