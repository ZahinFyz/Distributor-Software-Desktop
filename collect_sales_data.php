<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Sold</title>
    <style>
        body {
            color: white;
        }
        table {
            border-collapse: collapse;
            border: 2px solid white;
            width: auto;
            margin-left: 100px; 
            margin-top: 50px; 
        }

        th, td {
            border: 1px solid white; /* Set the border color and width */
            padding: 8px;
            text-align: left;
        }

        .title-row {
            background-color: #333; /* Set background color */
            color: white;
            font-size: 24px; /* Set font size */
            font-family: Arial, sans-serif; /* Set font family */
            font-weight: bold; /* Set font weight */
            padding: 12px; /* Set padding */
        }
    </style>
</head>
<body>
    <?php
    require "partitions/_dbconnect.php";

    $result = mysqli_query($connect, "SELECT * FROM Products_sold");

    if ($result && mysqli_num_rows($result) > 0) {
        $num_fields = mysqli_num_fields($result); // Get the number of columns

        echo "<table>";
        
        // Title row
        echo "<tr class='title-row'><td colspan='$num_fields'>Products Sold :</td></tr>";

        // Display column headers
        echo "<tr>";
        for ($i = 0; $i < $num_fields; $i++) {
            $field_info = mysqli_fetch_field_direct($result, $i);
            echo "<th>{$field_info->name}</th>";
        }
        echo "</tr>";

        // Display data rows
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found";
    }
    ?>
</body>
</html>
