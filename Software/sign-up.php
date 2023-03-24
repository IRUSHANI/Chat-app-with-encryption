<?php
session_start();
include 'dbh.php';

if(isset($_POST['uname'])){
    $uname=$_POST['uname'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $confirm_pass=$_POST['confirm_pass'];
    
    if($pass == $confirm_pass){
        $sql= "insert into signup(uname,email,pass,confirm_pass)values ('$uname','$email','$pass',$confirm_pass)";
        $result=$conn->query($sql);
        header("Location:index.php");
    }
    else{
        echo "<p style='color:red; text-align:center;'> Please Re-confirm your password </p>";
    }




}


?>