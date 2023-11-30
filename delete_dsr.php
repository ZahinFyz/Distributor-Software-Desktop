<?php
require "partitions/_dbconnect.php";

if (isset($_GET['serial'])) {
    $serial = $_GET['serial'];
    $sql = "DELETE FROM dsr WHERE serial='$serial'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        header("Location: DSR.php");
        exit(); // Ensure no further code execution after the redirection
    } else {
        echo "Error deleting record: " . mysqli_error($connect);
    }
} else {
    echo "Invalid request";
}
?>
