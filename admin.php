<?php

include 'database.php';
session_start();
if(!isset($_SESSION['username'])){
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>

<link rel="stylesheet" href="assets/css/style.css">
<title>Title</title>
</head>
<body>
<?php 
            $sql = mysqli_query($con, "SELECT * FROM Usertable ");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
<h1>Welcome <?php echo $row['username']?> </h1>


<a href="logout.php">Logout</a>
</body>
</html>