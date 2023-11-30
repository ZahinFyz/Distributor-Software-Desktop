<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
}
require "partitions/_dbconnect.php";

// Check if the 'dsr' table exists
$table_check_sql = "SHOW TABLES LIKE 'dsr'";
$table_check_result = mysqli_query($connect, $table_check_sql);

if (mysqli_num_rows($table_check_result) > 0) {
    // The 'dsr' table exists, fetch names
    $sql = "SELECT Name FROM dsr";
    $result = mysqli_query($connect, $sql);
    $names = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $names[] = $row['Name'];
    }
} else {
    $names = array(); // Table doesn't exist, initialize empty array
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles/popup.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Daily Sales</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        .popup {
            max-height: 500px;
            overflow-y: auto;
        }

        .footer {
            color: #fff;
            text-align: center;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .name-button {
            background-color: #2d3748; /* bg-gray-800 equivalent */
            border: none;
            color: #fff;
            padding: 25px 400px; /* Increased padding */
            font-size: 1rem;
            margin: 5px;
            cursor: pointer;
            border-radius: 8px;
            transition: transform 0.2s; /* Adding transition for pop effect */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Adding box shadow */
            text-align: center;
        }

        .name-button:hover {
            background-color: #1a202c; /* Darker shade on hover */
            transform: translateY(-2px); /* Pop effect on hover */
        }
    </style>
</head>

<body class="bg-gray-800">

    <?php require 'partitions/_navi.php' ?>

    <div class="content">
        <h1 class="text-center font-bold text-6xl text-white">DSR List</h1>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="button-container">
                        <?php
                        foreach ($names as $name) {
                            echo "<a href='daily_sales_data.php?name=$name' class='name-button'>$name</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <?php require 'partitions/_footer.php' ?>
    </div>

</body>

</html>

