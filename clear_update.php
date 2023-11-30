<?php
session_start();
require "partitions/_dbconnect.php";

if (isset($_GET['name'])) {
    $dsr_name = $_GET['name'];
    $table_name = "p_" . $dsr_name;
    $m_table_name = "m_" . $dsr_name;

    // Inserting values from p_(dsr name) table to sales table
    $select_data_sql = "SELECT * FROM $table_name WHERE Issue_1 > 0 OR Rtn_1 > 0 OR Issue_2 > 0 OR Rtn_2 > 0 OR Issue_3 > 0 OR Rtn_3 > 0 OR Free > 0";
    $result = mysqli_query($connect, $select_data_sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $product_name = $row['Product_name'];
        $free = $row['Free'];
        $total_sale = $row['T_sale'];
        $taka = $row['Taka'];
        $date = date('Y-m-d');

        $insert_sales_sql = "INSERT INTO sales (DSR_name, Product_name, Free, Total_sale, Taka, Date) VALUES ('$dsr_name', '$product_name', $free, $total_sale, $taka, '$date')";
        mysqli_query($connect, $insert_sales_sql);

        // Subtracting T_sale from inventory
        $subtract_inventory_sql = "UPDATE inventory SET Stock = Stock - $total_sale WHERE product_name = '$product_name'";
        mysqli_query($connect, $subtract_inventory_sql);
    }

    // Inserting values from m_(dsr name) table to money table
    $select_m_data_sql = "SELECT * FROM $m_table_name";
    $result_m_data = mysqli_query($connect, $select_m_data_sql);

    while ($row_m_data = mysqli_fetch_assoc($result_m_data)) {
        $total_amount = $row_m_data['Total_amount'];
        $cash_sale_tk = $row_m_data['Cash_sale_tk'];
        $collection_tk = $row_m_data['Collection_tk'];
        $s_c = $row_m_data['S_c'];
        $due_tk = $row_m_data['Due_tk'];
        $damage = $row_m_data['Damage'];
        $date_m = $row_m_data['Date'];
        $net_deposit = $row_m_data['Net_deposit'];

        $insert_money_sql = "INSERT INTO money (DSR_name, Total_sold, Cash_sale_tk, Collection_tk, S_c, Due_tk, Damage, Date, Net_deposit) VALUES ('$dsr_name', $total_amount, $cash_sale_tk, $collection_tk, $s_c, $due_tk, $damage, '$date_m', $net_deposit)";
        mysqli_query($connect, $insert_money_sql);
    }

    // Drop p_(dsr name) and m_(dsr name) tables
    $drop_p_table_sql = "DROP TABLE $table_name";
    $drop_m_table_sql = "DROP TABLE $m_table_name";
    
    mysqli_query($connect, $drop_p_table_sql);
    mysqli_query($connect, $drop_m_table_sql);

    // Redirect back to the page with a success message
    header("Location: daily_sales_data.php?name=$dsr_name&success=1");
} else {
    header("Location: login.php");
}
?>
