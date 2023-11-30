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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/orderstyle.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Daily Sales</title>
    <style>
        /* Add this CSS to your existing style block */

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px; /* Set a maximum width for the table */
            
        }

        th, td {
            border: 1px solid #fff;
            padding: 8px;
            color: #fff;
        }

        th {
            background-color: #333;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        .salesman-box {
            width: 200px;
            overflow-y: auto;
            padding: 10px;
            margin-left: 100px; /* Adjusted margin */
            margin-top : 10px;
            
        }

        .salesman-label{
            color: #fff;
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .date-selection{
            display: flex;
            align-items: center;
            margin-left: 350px; /* Adjusted margin */
            margin-top: -39px;
        }

        .date-selection label {
            color: #fff;
            font-size: 1rem;
            margin-bottom: 5px;
            margin-left : 5px;
        }
        .date-selection {
            color: #666; /* Adjust the color as per your preference */
        }

        .date-selection input {
            margin-left: 5px;
        }

        .footer {
            color: #fff;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
            background-color: #333;
            padding: 10px 0;
        }
    </style>
</head>

<body class="bg-gray-800">

    <?php require 'partitions/_navi.php' ?>

    <div class="content">
    <div class="salesman-box">
            <label for="salesmanSelect" class="salesman-label">Salesman : </label>
            <select id="salesmanSelect">
                <option value="all">All</option>
                
            </select>
            
        </div>
        <div class="date-selection">
            <label for="fromDate">From :</label>
            <input type="date" id="fromDate" name="fromDate">
            
            <label for="toDate">To :</label>
            <input type="date" id="toDate" name="toDate">
        </div>
        <div id="dataContainer">
            <div id="salesData"></div>
            
        </div>
        <div id="dynamic-table"></div>
        <script src="collect_sales_data.js"></script>
        

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fromDateInput = document.getElementById('fromDate');
    const toDateInput = document.getElementById('toDate');

    fromDateInput.addEventListener('change', updateSalesData);
    toDateInput.addEventListener('change', updateSalesData);

    function updateSalesData() {
        const fromDate = fromDateInput.value;
        const toDate = toDateInput.value;

        if (fromDate && toDate) {
            // Send an AJAX request to update the sales data
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'products_sold_table.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('salesData').innerHTML = xhr.responseText;
                }
            }
            xhr.send(`fromDate=${fromDate}&toDate=${toDate}`);
        }
    }
});
</script>
<script>
function updateTable() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("dynamic-table").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "collect_sales_data.php", true);
    xhttp.send();
}

// Call updateTable every 5 seconds (5000 milliseconds)
setInterval(updateTable, 500);
</script>

        
        
</body>
</html>