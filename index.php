<?php
include 'connect.php';
session_start();
$user_id = $_SESSION['user_id'];



if(isset($_POST['book_now'])){
   $cab_cabname = mysqli_real_escape_string($conn, $_POST['cab_cabname']);
   $cab_cabnumber = mysqli_real_escape_string($conn, $_POST['cab_cabnumber']);
   $cab_price = mysqli_real_escape_string($conn, $_POST['cab_price']);
   $cab_km = mysqli_real_escape_string($conn, $_POST['cab_km']);
   $cab_pickup = mysqli_real_escape_string($conn, $_POST['cab_pickup']);
   $cab_drop = mysqli_real_escape_string($conn, $_POST['cab_drop']);
   $cab_time = mysqli_real_escape_string($conn, $_POST['cab_time']); 
   $cab_image = mysqli_real_escape_string($conn, $_POST['cab_image']);
   $cab_dname = mysqli_real_escape_string($conn, $_POST['cab_dname']); 
   $cab_dnumber = mysqli_real_escape_string($conn, $_POST['cab_dnumber']);

   $select_bookedcab = mysqli_query($conn, "SELECT * FROM `bookedcab` WHERE cabname = '$cab_cabname' AND user_id = '$user_id'") or die(mysqli_error($conn));

   if(mysqli_num_rows($select_bookedcab) > 0){
      $message[] = 'Booking already added to Bookedcab!';
   }else{
      $insert_query = "INSERT INTO `bookedcab`(user_id, cabname, cabnumber, price, km, pickup, `drop`, `time`, `image`) VALUES ('$user_id', '$cab_cabname', '$cab_cabnumber', '$cab_price', '$cab_km', '$cab_pickup', '$cab_drop', '$cab_time', '$cab_image')";
      mysqli_query($conn, $insert_query) or die(mysqli_error($conn));
      $message[] = 'Booking added to Bookedcab!';
   }
}

if(isset($_POST['update_bookedcab'])){
   $update_km = mysqli_real_escape_string($conn, $_POST['bookedcab_km']);
   $update_id = mysqli_real_escape_string($conn, $_POST['bookedcab_id']);
   mysqli_query($conn, "UPDATE `bookedcab` SET km = '$update_km' WHERE id = '$update_id'") or die(mysqli_error($conn));
   $message[] = 'book km updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = mysqli_real_escape_string($conn, $_GET['remove']);
   mysqli_query($conn, "DELETE FROM `bookedcab` WHERE id = '$remove_id'") or die(mysqli_error($conn));
   header('location:index.php');
   exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAB BOOKING</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
    <nav>
        <ul>
          <h1>  <li>CAB BOOKING</li></h1>
          <h4>
            <li><a href="login.php">LOG OUT </a></li>
            <li><a href="profile.php">PROFILE</a></li>
            <li><a href="pyment.php">PAYMENT</a></li>
            <li><a href="bookedcab.php">BOOKED CAB</a></li>
</h4>
        </ul>
    </nav>


    <h1 class="heading">Available Cab</h1>
    <div class="box-container">

    <?php
       $select_cab = mysqli_query($conn, "SELECT * FROM `cabdetails`") or die('query failed');
       if(mysqli_num_rows($select_cab) > 0){
          while($fetch_cab = mysqli_fetch_assoc($select_cab)){
    ?>
       <form method="post" class="box" action="">
          <img src="image/taxi-toyota-travel-services-500x500.jpg<?php echo $fetch_cab['image']; ?>" alt="CAB IMAGE">
          <div  class="cabname"><?php echo $fetch_cab['cabname']; ?></div>
          <div class="cabnumber"><?php echo $fetch_cab['cabnumber']; ?></div>
          <div class="dname"><?php echo $fetch_cab['dname']; ?></div>
          <div class="dnumber"><?php echo $fetch_cab['dnumber']; ?></div>
          <div class="price"><?php echo $fetch_cab['price']; ?>/-</div>

          Select the KM<input type="number" min="1" name="cab_km" value="1"><br>
          Pickup Address<input type="text" name="cab_pickup" value=""><br>
          Drop Address<input type="text" name="cab_drop" value=""><br>
          Pickup Time<input type="time" name="cab_time" value="">
          <input type="hidden" name="cab_image" value="<?php echo $fetch_cab['image']; ?>">
          <input type="hidden" name="cab_cabname" value="<?php echo $fetch_cab['cabname']; ?>">
          <input type="hidden" name="cab_cabnumber" value="<?php echo $fetch_cab['cabnumber']; ?>">
          <input type="hidden" name="cab_dname" value="<?php echo $fetch_cab['dname']; ?>">
          <input type="hidden" name="cab_dnumber" value="<?php echo $fetch_cab['dnumber']; ?>">
          <input type="hidden" name="cab_price" value="<?php echo $fetch_cab['price']; ?>">
          <br>
          <input type="submit"  name="book_now" value="book_now" class="btn">
       </form>
    <?php
       };
    };
    ?>
 
    </div>

    
</body>
</html>


