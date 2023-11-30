<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
}
require "partitions/_dbconnect.php";

if (isset($_GET['name'])) {
    $dsr_name = $_GET['name'];
    $table_name = "p_" . $dsr_name;
    $m_table_name = "m_" . $dsr_name;

    $create_table_sql = "CREATE TABLE $table_name (
        Product_name VARCHAR(255),
        Rate DECIMAL(10,2),
        Issue_1 INT DEFAULT 0,
        Rtn_1 INT DEFAULT 0,
        Issue_2 INT DEFAULT 0,
        Rtn_2 INT DEFAULT 0,
        Issue_3 INT DEFAULT 0,
        Rtn_3 INT DEFAULT 0,
        Free INT DEFAULT 0,
        T_issue INT AS (Issue_1 + Issue_2 + Issue_3),
        T_rtn INT AS (Rtn_1 + Rtn_2 + Rtn_3),
        T_sale INT AS (T_issue - (T_rtn + Free)),
        Taka DECIMAL(10,2) AS (Rate * T_sale)
    )";
    $create_m_table_sql = "CREATE TABLE $m_table_name (
        Serial INT DEFAULT 1,
        Total_amount INT DEFAULT 0,
        Cash_sale_tk INT DEFAULT 0,
        Collection_tk INT DEFAULT 0,
        S_c INT AS (Cash_sale_tk + Collection_tk),
        Due_tk INT AS (Total_amount - (Cash_sale_tk + Collection_tk + Damage)),
        Damage INT DEFAULT 0,
        Date DATE DEFAULT CURRENT_DATE(),
        Net_deposit INT AS (S_c - Damage)
    )";

    if (mysqli_query($connect, $create_m_table_sql)) {
        // Table m_(dsr name) created successfully
    } else {
        // Handle table creation error if needed
    }

    

    if (mysqli_query($connect, $create_table_sql)) {
        $insert_data_sql = "INSERT INTO $table_name (Product_name, Rate)
                            SELECT product_name, rate FROM inventory";
        $insert_first_row_sql = "INSERT INTO $m_table_name (Serial, Total_amount, Cash_sale_tk, Collection_tk, Damage) VALUES (1, 0, 0, 0, 0)";
        mysqli_query($connect, $insert_first_row_sql);

        if (!mysqli_query($connect, $insert_data_sql)) {
            // Handle insert error if needed
        }
    } else {
        // Handle table creation error if needed
    }
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
    <title>DSR Name: <?php echo $dsr_name; ?></title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        .dsr-name {
            font-size: 1.5rem; /* Adjust the font size of DSR Name */
        }

        .name {
            font-size: 1.5rem; /* Adjust the font size of the name */
        }

        .box {
            border: 1px solid white;
            padding: 0;
            color: white;
            text-align: center;
        }

        .input-field {
            width: 80px; /* Adjust the width as needed */
            overflow: hidden;
            color: black;
        }
    </style>
</head>

<body class="bg-gray-800">
    <?php require 'partitions/_navi.php' ?>
    <div class="content">
        <h1 class="text-center font-bold text-6xl text-white">
            <span class="dsr-name">DSR Name:</span>
            <span class="name"><?php echo $dsr_name; ?></span>
        </h1>
    </div>
    <div class="container mt-5">
        <h2 class="text-white mb-4">Sales memo for <?php echo $dsr_name; ?></h2>
        <form id="dataForm" action="update_table.php?name=<?php echo $dsr_name; ?>" method="post">
            <div class="table-responsive">
                <table class="table table-bordered text-white">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Rate</th>
                            <th>Issue 1</th>
                            <th>Rtn 1</th>
                            <th>Issue 2</th>
                            <th>Rtn 2</th>
                            <th>Issue 3</th>
                            <th>Rtn 3</th>
                            <th>Free</th>
                            <th>Total Issue</th>
                            <th>Total Return</th>
                            <th>Total Sale</th>
                            <th>Taka</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select_data_sql = "SELECT * FROM $table_name";
                        $result = mysqli_query($connect, $select_data_sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['Product_name']}</td>";
                            echo "<td>{$row['Rate']}</td>";
                            echo "<td><input type='number' name='Issue_1[]' value='{$row['Issue_1']}' class='input-field' onchange='submitForm()'></td>";
                            echo "<td><input type='number' name='Rtn_1[]' value='{$row['Rtn_1']}' class='input-field' onchange='submitForm()'></td>";
                            echo "<td><input type='number' name='Issue_2[]' value='{$row['Issue_2']}' class='input-field' onchange='submitForm()'></td>";
                            echo "<td><input type='number' name='Rtn_2[]' value='{$row['Rtn_2']}' class='input-field' onchange='submitForm()'></td>";
                            echo "<td><input type='number' name='Issue_3[]' value='{$row['Issue_3']}' class='input-field' onchange='submitForm()'></td>";
                            echo "<td><input type='number' name='Rtn_3[]' value='{$row['Rtn_3']}' class='input-field' onchange='submitForm()'></td>";
                            echo "<td><input type='number' name='Free[]' value='{$row['Free']}' class='input-field' onchange='submitForm()'></td>";
                            echo "<td>{$row['T_issue']}</td>";
                            echo "<td>{$row['T_rtn']}</td>";
                            echo "<td>{$row['T_sale']}</td>";
                            echo "<td>{$row['Taka']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="12" class="text-leftt">Total :</td>
                            <?php
                            $select_data_sql = "SELECT SUM(Taka) AS total_taka FROM $table_name";
                            $result = mysqli_query($connect, $select_data_sql);
                            $row = mysqli_fetch_assoc($result);
                            $total_taka = $row['total_taka'];
                            ?>
                            <td><?php echo number_format($total_taka, 2); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>


        <h2 class="text-white mt-5 mb-4">Money info for <?php echo $dsr_name; ?></h2>
<form id="dataForm2" action="update_m_table.php?name=<?php echo $dsr_name; ?>" method="post">
    <div class="table-responsive">
        <table class="table table-bordered text-white">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Total Amount</th>
                    <th>Cash Sale Tk</th>
                    <th>Collection Tk</th>
                    <th>Cash Sale + Collection</th>
                    <th>Due Tk</th>
                    <th>Damage</th>
                    <th>Net Deposit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_m_data_sql = "SELECT * FROM $m_table_name";
                $result_m_data = mysqli_query($connect, $select_m_data_sql);

                while ($row_m_data = mysqli_fetch_assoc($result_m_data)) {
                    echo "<tr>";
                    echo "<td>{$row_m_data['Serial']}</td>";
                    echo "<td><input type='number' name='Total_amount[]' value='{$row_m_data['Total_amount']}' class='input-field' onchange='submitForm2()'></td>";
                    echo "<td><input type='number' name='Cash_sale_tk[]' value='{$row_m_data['Cash_sale_tk']}' class='input-field' onchange='submitForm2()'></td>";
                    echo "<td><input type='number' name='Collection_tk[]' value='{$row_m_data['Collection_tk']}' class='input-field' onchange='submitForm2()'></td>";
                    echo "<td>{$row_m_data['S_c']}</td>";
                    echo "<td>{$row_m_data['Due_tk']}</td>";
                    echo "<td><input type='number' name='Damage[]' value='{$row_m_data['Damage']}' class='input-field' onchange='submitForm2()'></td>";
                    echo "<td>{$row_m_data['Net_deposit']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</form>
<div class="mt-5 text-right">
    <button id="clearAndUpdate" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Clear and Update
    </button>
</div>


    </div>

    <script>
        function submitForm() {
            document.getElementById("dataForm").submit();
        }
        function submitForm2() {
        document.getElementById("dataForm2").submit();
        }
        document.getElementById('clearAndUpdate').addEventListener('click', function() {
        var dsrName = '<?php echo $dsr_name; ?>';
        window.location.href = 'clear_update.php?name=' + dsrName;
    });
    </script>
</body>

</html>
