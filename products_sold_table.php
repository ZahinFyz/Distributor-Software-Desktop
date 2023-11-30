<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
}
require "partitions/_dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    // Add code to drop the existing 'products_sold' table
    $dropTableSQL = "DROP TABLE IF EXISTS products_sold";
    mysqli_query($connect, $dropTableSQL);

    // Create a dynamic SQL query to create the table with user-inputted dates
    $sql = "SET @sql = NULL;
            SELECT
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                        'SUM(CASE WHEN DSR_name = ''',
                        DSR_name,
                        ''' THEN Total_sale ELSE 0 END) AS ',
                        DSR_name
                    )
                ) INTO @sql
            FROM sales;

            SET @sql = CONCAT('CREATE TABLE if not exists Products_sold AS
                            SELECT Product_name, ', @sql, ', 
                                SUM(Total_sale) AS Total 
                            FROM sales 
                            WHERE Date BETWEEN ''$fromDate'' AND ''$toDate''
                            GROUP BY Product_name 
                            WITH ROLLUP
                            HAVING Product_name IS NOT NULL');

            PREPARE stmt FROM @sql;
            EXECUTE stmt;
            DEALLOCATE PREPARE stmt;";
    mysqli_multi_query($connect, $sql);
}

?>