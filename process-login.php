<?php
session_start();
include 'database.php';
if(isset($_POST['submit'])){
    
    $name=$_POST['user_id'];
    $psrd=$_POST['password'];
    $sel="select * from `users` where user_id='".$name."' and password='".$psrd."'";
    $result=mysqli_query($con, $sel);
    $row=mysqli_fetch_array($result);
    if($row["status"] == "Student"){
        $_SESSION["user_id"]=$name;
        // header("location:user.php");
        echo "Welcome Student";
     }elseif($row["status"] == "Teacher"){
        $_SESSION["user_id"]=$name;
        // header("location:admin.php");
        echo "Welcome Teacher";
     }else{
        echo"<script>swal('Invalid Credentials')</script>";
     }
}
?>