<?php
include 'connect.php';
session_start();
$user_id = $_SESSION['user_id'];

$select_user = mysqli_query($conn, "SELECT * FROM `user_info` WHERE id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select_user) > 0){
    $fetch_user = mysqli_fetch_assoc($select_user);
}
?>

<html>
    <head>
        <title>CAB BOOKIK</title>
  <style>
   
</style>
<link rel="stylesheet" href="css/indexstyle.css">
<body>

    <h1>
<p> Name : <span><?php echo isset($fetch_user['Name']) ? $fetch_user['Name'] : ''; ?></span> </p>
<p> Mob : <span><?php echo isset($fetch_user['Mob']) ? $fetch_user['Mob'] : ''; ?></span> </p>
</h1>
<div class="">  
   <a href="index.php" class="btn ">Back</a>
</div>
</head>
</html>