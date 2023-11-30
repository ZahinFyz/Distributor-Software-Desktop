<?php
  session_start();
  if (!isset($_SESSION['loggedin'])) {
      header("location: login.php");
  }
  require "partitions/_dbconnect.php";
if (isset($_GET['serial'])) {
    $id = $_GET['serial'];
  }
  $sql = "SELECT * FROM dsr WHERE serial = '$id'";
	$result = mysqli_query($connect, $sql);

  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/orderstyle.css">
    <link rel="stylesheet" href="styles/popup.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>DSR Details</title>
</head>
<body class="">
    <?php require "partitions/_navi.php" ?>
    <div id="blur">
  <main class="min-h-screen bg-gray-800 text-white">
    <div class="">
    <div class="flex justify-center">
    <img class="w-[160px] rounded-full mt-5 " src="https://www.w3schools.com/howto/img_avatar.png">
    </div>
    <?php
              while($row = mysqli_fetch_assoc($result)) {
          ?>
  <h1 class="text-white text-center mt-2 font-serif"><?php echo $row["Name"] ?></h1>
  <p class=" text-white text-center text-xl">Distributor sales Representative</p>
  <div class="text-center font-mono">
  <a href="" class=" mx-1">Call.</a>
  <a href="" class=" mx-1">Email.</a>
  <a href="" class="">Massage.</a>
  </div>

  <div style="display: grid;justify-content: center;">
  <div class="mt-5 font-semibold mx-4 text-5xl">Details</div>
  <div class="pt-2">
    <table class="mx-4 border-collapse border">
      <tr>
        <td class="border p-2">Father's Name</td>
        <td class="border p-2"><?php echo $row["Father_name"] ?></td>
      </tr>
      <tr>
        <td class="border p-2">Mother's Name</td>
        <td class="border p-2"><?php echo $row["Mother_name"] ?></td>
      </tr>
      <tr>
        <td class="border p-2">Spouse's Name</td>
        <td class="border p-2"><?php echo $row["Spouse_name"] ?></td>
      </tr>
      <tr>
        <td class="border p-2">Present Address</td>
        <td class="border p-2"><?php echo $row["Present_address"] ?></td>
      </tr>
      <tr>
        <td class="border p-2">Permanent Address</td>
        <td class="border p-2"><?php echo $row["Permanent_address"] ?></td>
      </tr>
      <tr>
        <td class="border p-2">NID Number</td>
        <td class="border p-2"><?php echo $row["NID_number"] ?></td>
      </tr>
      <tr>
        <td class="border p-2">Phone Number</td>
        <td class="border p-2"><?php echo $row["Phone_number"] ?></td>
      </tr>
      <tr>
        <td class="border p-2">Local Guarantor Name</td>
        <td class="border p-2"><?php echo $row["Local_guarantor_name"] ?></td>
      </tr>
      <tr>
        <td class="border p-2">Local Guarantor Number</td>
        <td class="border p-2"><?php echo $row["Local_guarantor_number"] ?></td>
      </tr>
    </table>
  </div>
</div>


  <?php
              }
          ?>
  </div>
  </div>

  </main>
    <?php require "partitions/_footer.php" ?>
  </div>


<div class="text-black">
  <div class="popup">
    <div class="close-btn">
      X
    </div>
    <div class="form">
      <h2>Edit DSR</h2>
      <div class="form-element">
        <label for="name">DSR Name</label>
        <input type="text" id="name" placeholder="Enter Name">
      </div>
      <div class="form-element">
        <label for="products">Products</label>
        <input type="text" id="products" placeholder="Enter Products">
      </div>
      <div class="form-element">
        <label for="address">Location</label>
        <input type="text" id="address" placeholder="Enter Location">
      </div>
      <div class="form-element">
        <label for="days">Days</label>
        <input type="text" id="days" placeholder="Enter Days">
      </div>
      <div class="form-element">
        <button>Submit</button>
      </div>
    </div>
  </div>
</div>
<script>
  document.querySelector("#popup-show").addEventListener("click",function(){
    document.querySelector(".popup").classList.add("active");
  });

    document.querySelector(".popup .close-btn").addEventListener("click",function(){
    document.querySelector(".popup").classList.remove("active");
  });

  document.querySelector("#popup-show").addEventListener("click",function(){
    document.querySelector("#blur").classList.add("blur");
  });

  document.querySelector(".popup .close-btn").addEventListener("click",function(){
    document.querySelector("#blur").classList.remove("blur");
  });
</script>

</body>
</html>