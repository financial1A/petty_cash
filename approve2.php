<?php

$servername = "localhost";
$username = "financia";
$password = "MoW2f050l;@dRA";
$dbname = "financia_Mileage";

$hod = $_GET['hod'];
$site =$_SESSION['site'] ;
$date = $_SESSION['date'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($hod === 'hod123') {
    // Update the "petty_cash" table with the approved status and finrep_time
    $sql = "UPDATE petty_cash SET HOD_approved = 1, HOD_time = NOW() WHERE $date AND $site";
    
    if ($conn->query($sql) === TRUE) {
        echo "Approved successfully!";

        // Send email to HOD
        $to = 'ishan_miriyagalla@toyota.lk'; // Replace with the HOD's email address
        $cc = 'vijith_samaraweera@tlpl1.onmicrosoft.com';
        $subject = 'Daily Petty Cash Verification';
        $message = 'The HOD has approved the Daily petty cash verification successfully.';
        
        // Set appropriate headers
        $headers = "From: financia@financialengineering.lk\r\n";
        $headers .= "Cc: $cc\r\n";
        // Add additional headers as needed
        
        if (mail($to, $subject, $message, $headers)) {
            echo "Email sent successfully!";
        } else {
            echo "Error sending email!";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        // Since there was an error in the database query, display an error message.
        // You can add any error handling logic here.
    }
} else {
    // If the code reaches this point, it means the HOD key was invalid, and the else block below will be executed.
    echo "<h1 style='color:red;'>Invalid Key!</h1> <br> <a href='index.php'><button style='width:50px;height:40px'>Back</button></a>";
}

$conn->close();
