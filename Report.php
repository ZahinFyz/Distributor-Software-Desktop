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
        .button1 {
            position: absolute;
            top: 350px; /* Adjust as per your preference */
            left: 50%; /* Center horizontally */
            transform: translateX(-50%);
        }

        .button2 {
            position: absolute;
            top: 450px; /* Adjust as per your preference */
            left: 50%; /* Center horizontally */
            transform: translateX(-50%);
        }
        .button1, .button2 {
            background-color: #2D3748;
            color: white;
            border: 2px solid white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Added box-shadow */
        }       

        .button1:hover, .button2:hover {
            background-color: #4A5568;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3); /* Added box-shadow on hover */
        }


        
    </style>
</head>

<body class="bg-gray-800">

    <?php require 'partitions/_navi.php' ?>

    <div class="content">
    <div class="text-center my-4">
        <a href="Report_indv.php" class="btn btn-primary mx-2 button1">Individual Report</a>
        <a href="Report_collec.php" class="btn btn-primary mx-2 button2">Product Report</a>
    </div>
    <!-- Your main content goes here -->
</div>

</body>
</html>
