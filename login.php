<?php

include 'connect.php';
session_start();

if(isset($_POST['submit'])){

   $Mob = mysqli_real_escape_string($conn, $_POST['Mob']);
   $Password = mysqli_real_escape_string($conn, md5($_POST['Password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_info` WHERE Mob = '$Mob' AND Password = '$Password'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = 'incorrect password or Mob!';
   }

}

?>
    <html>
        <head>
            <title>
                Login</title>
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
    
.message {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    margin: 10px auto;
    border-radius: 5px;
    cursor: pointer;
}

.message:hover {
    opacity: 0.8;
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
      <h1>Login Now</h1>
      <input type="text" id="Mob" name="Mob" placeholder="Mob" required>   
      <input type="Password" id="Password" name="Password" placeholder="Password" required>
      <p>don't have an account? <a href="Register.php">register now</a></p>
      <button type="submit" name="submit" class="btn">Login</button>
    </form>
  </div>
</body>
</html>
