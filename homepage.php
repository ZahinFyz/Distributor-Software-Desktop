<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Dashboard</title>
    
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #333; /* Adjust as needed */
        }

        .footer {
            background-color: transparent;
            border: none;
            color: white;
            padding: 0px;
            width: 100%;
            text-align: center;
            position: fixed;
            bottom: 0;
        }

        .grid-item {
            margin-bottom: 100px; /* Adjust this value as needed */
        }

        @media (max-width: 767px) {
            .grid-item {
                margin-bottom: 10px; /* Adjust this value as needed */
            }
        }
    </style>
</head>
<body class="bg-gray-800 text-white">

    <?php 
        session_start();
        if (!isset($_SESSION['loggedin'])) {
            header("location: login.php");
        }
        if (isset($_COOKIE['firstName'])) {
            $firstName = $_COOKIE['firstName'];
            $lastName = $_COOKIE['lastName'];
        }
    ?>

    <?php require 'partitions/_navi.php' ?>

    <div>
        <div class=" h-40 w-40 px-10">
            <div class="absolute top-12 left-8 py-5">
                <img class="rounded-full h-28 w-28 " src="img/profile.png" alt="">
            </div>
        </div>

        <div>
            <h1 class="px-10  text-2xl font-bold"><?php echo($_SESSION['firstname']) ?> <?php echo($_SESSION['username'])?><br>
            <div>
                <h1 class="font-light">
                    Distributor <br>
                    Basundhara RA,DHAKA </h1>
            </div>
        </div>
        <div class="py-7">
            <fieldset class="border-t border-t-slate-900 "></fieldset>
        </div>
        <div class="max-w-[1070px] mx-auto py-10">
            <div class="max-w-[1070px] mx-auto grid lg:grid-cols-4 md:grid-cols-2 gap-28">

                <a href="inventory.php">
                    <div class="grid-item text-black text-center shadow-lg bg-blue-200 rounded-3xl">
                        <div class="overflow-hidden">
                            <img src="img/inventory.png" class=" hover:scale-125 duration-500"/>
                        </div>
                        <div class="font-bold text-xl mb-2">Inventory</div>
                    </div> 
                </a>

                <a href="daily_sales.php">
                    <div class="grid-item text-black text-center shadow-lg bg-gray-200 rounded-3xl">
                        <div class="overflow-hidden rounded-2xl">
                            <img src="img/daily-report.png" class="hover:scale-125 duration-500"/>
                        </div>
                        <div class="font-bold text-xl mb-2">Daily Sales</div>
                    </div>
                </a>

                <a href="DSR.php">
                    <div class="grid-item text-black text-center shadow-lg bg-orange-200 rounded-3xl">
                        <div class="overflow-hidden">
                            <img src="img/businessman.png" class="hover:scale-125 duration-500"/>
                        </div>
                        <div class="font-bold text-xl mb-2">DSR</div>
                    </div>
                </a>

                <a href="Report.php">
                    <div class="grid-item text-black text-center shadow-lg bg-red-200 rounded-3xl">
                        <div class="overflow-hidden">
                            <img src="img/order2.png" class="hover:scale-125 duration-500"/>
                        </div>
                        <div class="font-bold text-xl mb-2">Report</div>
                    </div>
                </a>
            </div>
            <div class="py-7">
                <fieldset class="border-t border-t-slate-900 "></fieldset>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <?php require 'partitions/_footer.php' ?>
    </div>

</body>
</html>
