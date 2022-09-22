<?php
session_start();
include 'database.php';
if(!isset($_SESSION['unique_id'])){
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
       <?php 
            $sql = mysqli_query($con, "SELECT * FROM users where unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
    <section id="menu">
    <div class="det">
    <img src="php/images/<?php echo $row['img']; ?>" alt="" class="profile-img">
    <h1 class="user"><?php echo $row['username']?></h1>
    </div>
        <div class="items">
            <li><i class="fa fa-tachometer"></i><a href="dashboardIndex.php">Community</a></li>
            <li><i class="fa fa-envelope"></i><a href="users.php">Chat</a></li>
            <li><i class="fa fa-calendar"></i><a href="#">My Library</a></li>
            <li><i class="fa fa-file"></i><a href="#">Lecture Rooms</a></li>
            <li><i class="fa fa-tasks"></i><a href="#">Daily Tasks</a></li>
            <!-- <li><i class="fa fa-bar-chart"></i></i><a href="#"></a></li> -->
        </div>

        <div class="items2">
            <li><i class="fa fa-user"></i><a href="#">Profile</a></li>
            <li><i class="fa fa-cog"></i><a href="settings.php">Settings</a></li>
            <li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php">Log Out</a></li>
        </div>
    </section>
 
    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <div>
                    <i id="menu-btn" class="fa fa-bars"></i>
                </div>
                <div class="text">

                    <span>Welcome, <?php echo $row['username'] ?></span>
             
                </div>
                <div class="search">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search">
                </div>
            </div>
            <div class="profile">
                <i class="fa fa-bell-o"></i>
                
                <a href="users.php">
                <i class="fa fa-comment-o"></i>
                </a>
            </div>
        </div>



        <div class="values">
           
       
            <div class="val-box">
                <i class="fa fa-user" aria-hidden="true"></i>
                <div>
                    <h3>Admin Profile</h3>
                    <span></span>
                </div>
            </div>
        </div>
    </section>

    <script>
        $('#menu-btn').click(function() {
            $('#menu').toggleClass("active");
        })
    </script>


</body>
</html>