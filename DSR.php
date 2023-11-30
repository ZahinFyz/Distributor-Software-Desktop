<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("location: login.php");
}
require "partitions/_dbconnect.php";
// Check if the table 'dsr' exists
$table_check_sql = "SHOW TABLES LIKE 'dsr'";
$table_check_result = mysqli_query($connect, $table_check_sql);

if (mysqli_num_rows($table_check_result) == 0) {
    // Table 'dsr' does not exist, create it
    $create_table_sql = "CREATE TABLE dsr (
        serial INT AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(255),
        Monthly_target INT,
        Father_name VARCHAR(255),
        Mother_name VARCHAR(255),
        Spouse_name VARCHAR(255),
        Present_address VARCHAR(255),
        Permanent_address VARCHAR(255),
        NID_number BIGINT,
        Phone_number INT,
        Local_guarantor_name VARCHAR(255),
        Local_guarantor_number INT
    )";

    if (mysqli_query($connect, $create_table_sql)) {
        echo "Table 'dsr' created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($connect);
    }
}
$sql = "SELECT * FROM dsr";
$result = mysqli_query($connect, $sql);
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
    <title>DSR</title>
    <style>
        .popup {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-gray-800 text-white">
    <?php require "partitions/_navi.php" ?>

    <main class="h-screen w-screen flex-none" id="blur">
        <h1 class="pt-5 text-center text-4xl font-bold">DSR</h1>
        <div class="flex justify-center mt-4">
            <div class="flex w-96 rounded-md bg-white">
                <input type="search" name="search" id="search" placeholder="search" class="focus-outline-none w-full rounded-none bg-transparent py-1 outline-none text-black" style="text-align: center;" onkeyup="searchFun()" />
            </div>
        </div>
        <div class="pt-5 flex justify-center">
    

</div>

        <div class="pt-5 flex justify-center">
            <table width="60%" class="table-fixed border-collapse border" id="myTable">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr class="">
                        <td>
                            <div class="mx-auto ml-4 h-28 w-24 pt-2"><img src="https://www.w3schools.com/howto/img_avatar.png" class="" /></div>
                        </td>
                        <td class="text-center text-3xl font-medium">
                            <a href="dsr_details.php?serial=<?php echo $row["serial"] ?>"><?php echo $row["Name"] ?></a>
                        </td>
                        <td class="text-center text-2xl font-normal">
                            TK. <a href="dsr_details.php?serial=<?php echo $row["serial"] ?>"><?php echo $row["Local_guarantor_number"] ?></a>
                        </td>
                        <td class="text-center">
                            <button class="delete-btn" data-id="<?php echo $row['serial']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <div>
            <div class="flex justify-end mx-[365px]">
                <button class="mt-4 rounded-xl bg-gray-50 pb-2 pl-3 pr-3 pt-2 font-medium text-gray-800" id="popup-show">Add DSR</button>
            </div>
            <br>
        </div>

        <?php require "partitions/_footer.php" ?>

    </main>

    <div class="text-black">
        <div class="popup">
            <div class="close-btn">X</div>
            <form method="POST" action="insert_dsr.php">
                <div class="form">
                    <h2>Add DSR</h2>
                    <div class="form-element">
                        <label for="name">DSR Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-element">
                        <label for="name">Monthly Target</label>
                        <input type="text" id="target" name="target" placeholder="Enter Target" required>
                    </div>
                    <div class="form-element">
                        <label for="address">Father's Name</label>
                        <input type="text" id="fatherName" name="fatherName" placeholder="Enter Father's Name" required>
                    </div>
                    <div class="form-element">
                        <label for="days">Mother's Name</label>
                        <input type="text" id="motherName" name="motherName" placeholder="Enter Mother's Name" required>
                    </div>
                    <div class="form-element">
                        <label for="products">Spouse's Name</label>
                        <input type="text" id="spouseName" name="spouseName" placeholder="Enter Spouse's Name" required>
                    </div>
                    <div class="form-element">
                        <label for="present_address">Present Address</label>
                        <input type="text" id="present_address" name="presentAddress" placeholder="Enter Present Address" required>
                    </div>
                    <div class="form-element">
                        <label for="permanent_address">Permanent Address</label>
                        <input type="text" id="permanent_address" name="permanentAddress" placeholder="Enter Permanent Address" required>
                    </div>
                    <div class="form-element">
                        <label for="nid">NID Number</label>
                        <input type="text" id="nid" name="nidNumber" placeholder="Enter NID Number" required>
                    </div>
                    <div class="form-element">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phoneNumber" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="form-element">
                        <label for="gurantor_name">Name of Local Guarantor</label>
                        <input type="text" id="gurantor_name" name="localGuarantorName" placeholder="Enter Name of Local Guarantor" required>
                    </div>
                    <div class="form-element">
                        <label for="gurantor_number">Monthly</label>
                        <input type="text" id="gurantor_number" name="localGuarantorNumber" placeholder="Enter Number of Local Guarantor" required>
                    </div>
                    <div class="form-element">
                        <button type="submit" name="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelector("#popup-show").addEventListener("click", function() {
            document.querySelector(".popup").classList.add("active");
        });

        document.querySelector(".popup .close-btn").addEventListener("click", function() {
            document.querySelector(".popup").classList.remove("active");
        });

        document.querySelector("#popup-show").addEventListener("click", function() {
            document.querySelector("#blur").classList.add("blur");
        });

        document.querySelector(".popup .close-btn").addEventListener("click", function() {
            document.querySelector("#blur").classList.remove("blur");
        });

        const searchFun = () => {
            let filter = document.getElementById('search').value.toUpperCase();
            let myTable = document.getElementById('myTable');

            let tr = myTable.getElementsByTagName('tr');

            for (var i = 0; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName('td')[1];

                if (td) {
                    let textValue = td.textContent || td.innerHTML;

                    if (textValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }

            }
        }
    </script>

    <script>
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                const serial = this.getAttribute("data-id");
                if (confirm("Are you sure you want to delete this entry?")) {
                    window.location.href = `delete_dsr.php?serial=${serial}`;
                }
            });
        });
    </script>

</body>

</html>
