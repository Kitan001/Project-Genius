<?php
include 'database.php';
include 'php/config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php     
            $sqc="SELECT * FROM users where unique_id = {$_SESSION['unique_id']}";
            $sql = mysqli_query($con,$sqc );
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
             <!-- <li><i class="fa fa-bar-chart"></i></i><a href="#"></a></li>  -->
       </div>

        <div class="items2">
            <li><i class="fa fa-user"></i><a href="#">Profile</a></li>
            <li><i class="fa fa-cog"></i><a href="settings.php">Settings</a></li>
            <li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php">Log Out</a></li>
        </div>
    </section> 
  <section id="interface" >
         <div class="navigation" id="int">
            <div class="n1">
                <div>
                    <i id="menu-btn" class="fa fa-bars"></i>
                </div>
            </div>
        </div>
    <div class="hero">
        <div class="form-box">
        <div class="wrapper"> 
    <section class="form signup">
      <!-- <a href="dashboardIndex.php">Back</a> -->
      <header>Edit your details</header>
            <?php
            
            if(isset($_POST['submit'])){
                $fname = mysqli_real_escape_string($conn, $_POST['fname']);
                $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $DOB = mysqli_real_escape_string($conn, $_POST['dob']);
                $dept = mysqli_real_escape_string($conn, $_POST['dept']);
                $category = mysqli_real_escape_string($conn, $_POST['category']);
                $encrypt_pass = $password;
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name,"php/images/".$new_img_name)){
                                $ran_id = rand(time(), 100000000);
                                $status = "Active now";
                                $encrypt_pass = $password;
                                $insert_query = mysqli_query($conn, "UPDATE `users` set fname='$fname', lname='$lname',username='$username',  email='$email', password='$password',dob='$DOB',dept='$dept', img='$new_img_name', category='$category' where unique_id='$_POST[id]'");
                                $insert_queer = mysqli_query($conn, "UPDATE `Usertable` set username='$username',  email='$email', password='$password',status='$category' where unique_id='$_POST[id]'");
                            }
                            if($insert_query && $insert_queer){
                                echo "<script>swal('Successful Update')</script>";
                                echo "<script>location.href='dashboardIndex.php';</script>";
                            }
                            if(empty($_FILES['image'])){
                              echo "Cannot Input Empty image";
                            }
                        }
                    }
                }     
            }
            
                  ?>

      <form action="#" method="POST" class="bdata" enctype="multipart/form-data" autocomplete="off">
      <input type="text"  class="incoming_id" name="id" value="<?php echo $row['unique_id']; ?>" hidden>
        <div class="error-text"></div>
        <div class="field image">
          <label for="image" ><i class="fa fa-user-circle" onClick="triggerClick" id="profileDisplay" aria-hidden="true"></i></label>
          <input type="file" value="<?php echo $row['img']?>" onchange="displayImage(this)" id="image" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" value="<?php echo $row['fname']?>" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" value="<?php echo $row['lname']?>" required>
          </div>
        </div>
        <div class="field input">
          <label>Username</label>
          <input type="text"  name="username" value="<?php echo $row['username'] ?>" required>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="email"  name="email" value="<?php echo $row['email'] ?>" required>
        </div>
        <div class="field input">
          <label>Date Of Birth</label>
          <input type="date" name="dob" value="<?php echo $row['dob']?>" required>
        </div>
        <div class="field input">
          <label>Department</label>
          <select name="dept" id="" value="<?php echo $row['dept']?>">
          <option value="Select" >Select Department</option>
                <option value="Science">Science</option>
                <option value="Arts">Arts and Humanities</option>
                <option value="Commercial">Commercial</option>
          </select>
        </div>
        <div class="field input">
          <label>Category</label>
          <select name="category" id="" value="<?php echo $row['category']?>">
          <option value="Select" >Select</option>
                <option value="Student">Student</option>
                <option value="Teacher">Teacher</option>
          </select>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password"  name="password" value="<?php echo $row['password'] ?>" required>
          <i class="fas fa-eye"></i>
        </div>
        <input type="text" class="incoming_id" name="state" value="<?php echo $row['status']; ?>" hidden>
        <div class="field button">
          <input type="submit" name="submit" value="Save Details">
        </div>
      </form>
    
    </section>
  </div>


        </div>
    </div>
    
    
    <script>
        $('#menu-btn').click(function() {
            $('#menu').toggleClass("active");
        })
    </script>
</body>
</html>