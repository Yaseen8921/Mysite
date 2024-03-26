<?php

include 'connect.php';

if(isset($_POST['submit'])){

   $Name = mysqli_real_escape_string($conn, $_POST['Name']);
   $Mob = mysqli_real_escape_string($conn, $_POST['Mob']);
   $Address = mysqli_real_escape_string($conn, $_POST['Address']);
   $Pincode = mysqli_real_escape_string($conn, $_POST['Pincode']);
   $Password = mysqli_real_escape_string($conn, md5($_POST['Password']));
   $select = mysqli_query($conn, "SELECT * FROM `user_info` WHERE Mob = '$Mob' AND Password = '$Password'") or die('query fail');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `user_info`(Name, Mob, Address, Pincode, Password) VALUES('$Name', '$Mob', '$Address','$Pincode','$Password')") or die('query ENDO');
      $message[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f0f0f0;
    }

    .container {
      width: 300px;
      padding: 20px;
      background: #f0f0f0;
      border-radius: 15px;
      box-shadow: 10px 10px 20px #c4c4c4, -10px -10px 20px #ffffff;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    h1 {
      text-align: center;
    }

    input {
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background: #f0f0f0;
    }

    button {
      background-color: #ffc000;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #e0ab00;
    }
  </style>
</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
  <div class="container">
    <form action=""method ="POST">
      <h1>Registration</h1>
      
      <input type="text" id="Name" name="Name" placeholder="Name" required>
      <input type="text" id="Mob" name="Mob" placeholder="Mob" required>
      <input type="text" id="Address" name="Address" placeholder="Address" required>
      <input type="number" id="Pincode" name="Pincode" placeholder="Pincode" required>
      <input type="Password" id="Password" name="Password" placeholder="Password" required>
      <button type="submit" name="submit" class="btn">Register</button>
    </form>
  </div>
</body>
</html>
