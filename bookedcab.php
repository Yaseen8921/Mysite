<?php
include 'connect.php';
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAB BOOKING</title>
</head>
<body>
  <?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAB BOOKING</title>
    <link rel="stylesheet" href="css/bookedstyle.css">
</head>
<body>
  <?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
<h1 class="heading">BOOKED CAB</h1>

<table>
   <thead>
      <th>IMAGE</th>
      <th>CAB NAME </th>
      <th>CAB NUMBER </th>
      <th>PRICE</th>
      <th>PICKUP</th>
      <th>DROP</th>
      <th>TIME</th>
      <th>KM</th>
      <th>TOTAL PRICE</th>
      <th>ACTION</th>
   </thead>
   <tbody>
   <?php
      $bookedcab_query = mysqli_query($conn, "SELECT * FROM `bookedcab` WHERE user_id = '$user_id'") or die('query failed');
      $grand_total = 0;
      if(mysqli_num_rows($bookedcab_query) > 0){
         while($fetch_bookedcab = mysqli_fetch_assoc($bookedcab_query)){
   ?>
      <tr>
         <td><img src="image/taxi-toyota-travel-services-500x500.jpg<?php echo $fetch_bookedcab['image']; ?>" height="100" alt="Cab image"></td>
         <td><?php echo $fetch_bookedcab['cabname']; ?></td>
         <td><?php echo $fetch_bookedcab['cabnumber']; ?></td>
         <td><?php echo $fetch_bookedcab['price']; ?>/-</td>
         <td><?php echo $fetch_bookedcab['pickup']; ?></td>
         <td><?php echo $fetch_bookedcab['drop']; ?></td>
         <td><?php echo $fetch_bookedcab['time']; ?></td>
         <td><?php echo $fetch_bookedcab['km']; ?></td>
         <td><?php echo $sub_total = ($fetch_bookedcab['price'] * $fetch_bookedcab['km']); ?>/-</td>
         <td><a href="index.php?remove=<?php echo $fetch_bookedcab['id']; ?>" class="delete-btn" onclick="return confirm('remove item from book?');">remove</a></td>
      </tr>
   <?php
      $grand_total = $sub_total;
         }
      }else{
         echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no booking </td></tr>';
      }
   ?>
   <tr class="table-bottom">
      <td colspan="4">grand total :</td>
      <td><?php echo $grand_total; ?>/-</td>
</tbody>
</table>

<div class="">  
   <a href="index.php" class="btn ">Back</a>
</div>
</body>
</html>
