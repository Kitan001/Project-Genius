<?php
session_start();
include 'database.php';
include 'php/config.php';
if(isset($_POST['submit'])){
    
    $name=$_POST['user_id'];
    $psrd=$_POST['password'];
    $sel="select * from `users` where username='".$name."' and password='".$psrd."'";
    $sel2="select * from `usertable` where username='".$name."' and password='".$psrd."'";
    $result=mysqli_query($con, $sel);
    
    $row=mysqli_fetch_array($result );
    
    
    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$name}'");
  if($row["category"] == "Student"){
   $result = mysqli_fetch_assoc($select_sql2);
   $_SESSION['unique_id'] = $result['unique_id'];
                            header("location:dashboardIndex.php");
                         }elseif($row["category"] == "Teacher"){
                           $result = mysqli_fetch_assoc($select_sql2);
                           $_SESSION['unique_id'] = $result['unique_id'];
                            header("location:dashboardIndex.php");
                         }else{
                            echo '<script>swal("Not A Vaild User")</script>';
                         }
   }
?>