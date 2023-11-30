<?php
session_start();
require "partitions/_dbconnect.php";

if (isset($_GET['name'])) {
    $dsr_name = $_GET['name'];
    $m_table_name = "m_" . $dsr_name;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $total_amount = $_POST['Total_amount'];
        $cash_sale_tk = $_POST['Cash_sale_tk'];
        $collection_tk = $_POST['Collection_tk'];
        $damage = $_POST['Damage'];

        for ($i = 0; $i < count($total_amount); $i++) {
            $serial = $i + 1;
            $total_amount_value = $total_amount[$i];
            $cash_sale_tk_value = $cash_sale_tk[$i];
            $collection_tk_value = $collection_tk[$i];
            $damage_value = $damage[$i];

            $update_sql = "UPDATE $m_table_name 
                           SET Total_amount = $total_amount_value, 
                               Cash_sale_tk = $cash_sale_tk_value, 
                               Collection_tk = $collection_tk_value, 
                               Damage = $damage_value 
                           WHERE Serial = $serial";

            mysqli_query($connect, $update_sql);
        }
        echo '<script>window.location.href = "daily_sales_data.php?name=' . $_GET['name'] . '";</script>';
} else {
    header("Location: login.php");
    }
}
?>
