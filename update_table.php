<?php
session_start();
require "partitions/_dbconnect.php";

if (isset($_SESSION['loggedin']) && isset($_GET['name']) && isset($_POST['Issue_1']) && isset($_POST['Rtn_1']) && isset($_POST['Issue_2']) && isset($_POST['Rtn_2']) && isset($_POST['Issue_3']) && isset($_POST['Rtn_3']) && isset($_POST['Free'])) {
    $table_name = "p_" . $_GET['name'];

    $Issue_1 = $_POST['Issue_1'];
    $Rtn_1 = $_POST['Rtn_1'];
    $Issue_2 = $_POST['Issue_2'];
    $Rtn_2 = $_POST['Rtn_2'];
    $Issue_3 = $_POST['Issue_3'];
    $Rtn_3 = $_POST['Rtn_3'];
    $Free = $_POST['Free'];

    for ($i = 0; $i < count($Issue_1); $i++) {
        $update_data_sql = "UPDATE $table_name SET 
                            Issue_1 = $Issue_1[$i], 
                            Rtn_1 = $Rtn_1[$i], 
                            Issue_2 = $Issue_2[$i], 
                            Rtn_2 = $Rtn_2[$i], 
                            Issue_3 = $Issue_3[$i], 
                            Rtn_3 = $Rtn_3[$i], 
                            Free = $Free[$i]
                            WHERE Product_name = (SELECT Product_name FROM $table_name LIMIT $i, 1)"; 
        mysqli_query($connect, $update_data_sql);
    }

    echo '<script>window.location.href = "daily_sales_data.php?name=' . $_GET['name'] . '";</script>';
} else {
    header("Location: login.php");
}
?>
