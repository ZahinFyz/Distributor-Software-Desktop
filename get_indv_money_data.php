<?php
require "partitions/_dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = $_GET["name"];
    $fromDate = $_GET["fromDate"];
    $toDate = $_GET["toDate"];

    $sql = "SELECT * FROM money WHERE DSR_name='$name'";

    if (!empty($fromDate) && !empty($toDate)) {
        $sql .= " AND Date BETWEEN '$fromDate' AND '$toDate'";
    }

    $result = mysqli_query($connect, $sql);

    $data = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    echo json_encode($data);
}
?>
