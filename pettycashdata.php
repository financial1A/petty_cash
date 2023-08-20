<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'test';

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM petty_cash";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr>';
    $columns = $result->fetch_fields();
    foreach ($columns as $column) {
        echo '<th>' . $column->name . '</th>';
    }
    echo '</tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No records found.';
}

$conn->close();
?>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table th,
    table td {
        border: 1px solid #000; /* Add the desired border color here */
        padding: 8px; /* Add desired padding */
    }

    table th:last-child,
    table td:last-child {
        border-right: none; /* Remove the right border on the last column */
    }
</style>
