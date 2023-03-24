<?php
session_start();
include 'dbh.php';

  if(isset($_POST['uname'])){
      $uname=$_POST['uname'];
      $pass=$_POST['pass'];

      $sql="select * from signup where uname='$uname'and pass='$pass'";

      $result= $conn->query($sql);
      if(!$row=$result->fetch_assoc()){
         echo"Wrong ";
         
      }
      else{
         echo "Done";
         $_SESSION['name']=$_POST['uname'];
         header("location:chat.php");
      }
   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
       <div class="card">
        <form action="#" class="login" method="POST">
            <div class="error-txt">This is an error message!!!</div>

          <div class="field">
             <label>User Name</label>
             <input type="text" placeholder="Enter your email address" name="uname">
          </div>

          <div class="field">
             <label>Password</label>
             <input type="text" placeholder="Password" name="pass">
          </div>

          <div class="field button">
             <input type="submit" value="Continue to chat">
         </div>

        </form>
        <div class="link">Not yet signed up? <a href="signup.php">Signup now </a></div>
       </div>
    </div>
       <script src="home.js"></script>
</body>
</html>