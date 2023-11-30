<?php
session_start();
require "partitions/_dbconnect.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $target = $_POST['target'];
    $fatherName = $_POST['fatherName'];
    $motherName = $_POST['motherName'];
    $spouseName = $_POST['spouseName'];
    $presentAddress = $_POST['presentAddress'];
    $permanentAddress = $_POST['permanentAddress'];
    $nidNumber = $_POST['nidNumber'];
    $phoneNumber = $_POST['phoneNumber'];
    $localGuarantorName = $_POST['localGuarantorName'];
    $localGuarantorNumber = $_POST['localGuarantorNumber'];

    $sql = "INSERT INTO dsr (Name, Monthly_target, Father_name, Mother_name, Spouse_name, Present_address, Permanent_address, NID_number, Phone_number, Local_guarantor_name, Local_guarantor_number)
            VALUES ('$name', '$target', '$fatherName', '$motherName', '$spouseName', '$presentAddress', '$permanentAddress', '$nidNumber', '$phoneNumber', '$localGuarantorName', '$localGuarantorNumber')";

    if (mysqli_query($connect, $sql)) {
        header("Location: dsr.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connect);
    }

    mysqli_close($connect);
}
?>
