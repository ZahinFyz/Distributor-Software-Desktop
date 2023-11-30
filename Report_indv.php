<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
}
require "partitions/_dbconnect.php";
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
                <?php
                $sql = "SELECT Name FROM dsr";
                $result = mysqli_query($connect, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['Name'] . "'>" . $row['Name'] . "</option>";
                    }
                }
                ?>
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
            <div id="moneyData"></div>
        </div>
        <script src="indv_sales_data.js"></script>
        <script src="indv_money_data.js"></script>
        
        
        


</body>
</html>
