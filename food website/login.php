<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);

   $select_users = mysqli_query($conn, "SELECT * FROM `regiser` WHERE email = '$email' AND pass = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);
      if($row['user'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin.php');

      }else{

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
         $message[] = 'login success';}
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>login</title>
        <link rel="stylesheet" href="style36.css">
    </head>
    <body>
   






        <div class="wrapper">
        <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span style="color:red;">'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
        <h1>Login</h1>
        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="   email">
            <input type="password" name="password" placeholder="   password">
            <button type="submit" name="submit">Login</button>
        </form>

        <div class="member">
            Not a member? <a href="signup.PHP">
                <u> Register Now </u>
            </a>
            
        </div>
    </div>
    </body>

    </html>