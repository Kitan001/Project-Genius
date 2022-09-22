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
    <title>Teacher Biodata</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="/assets/styles/style.css">
</head>
<body>
<?php 
            $sql = mysqli_query($con, "SELECT * FROM Usertable where unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
    
    
    <div class="hero">
        <div class="form-box">
        <div class="wrapper">
    <section class="form signup">
      <header>Fill in your details</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
      <input type="text" class="incoming_id" name="id" value="<?php echo $row['unique_id']; ?>" hidden>
        <div class="error-text"></div>
        <div class="field image">
          <label for="image"><i class="fa fa-user-circle" onClick="triggerClick" id="profileDisplay" aria-hidden="true"></i></label>
          <input type="file"  onchange="displayImage(this)" id="image" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Username</label>
          <input type="text" readonly name="username" value="<?php echo $row['username'] ?>" required>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="email" readonly name="email" value="<?php echo $row['email'] ?>" required>
        </div>
        <div class="field input">
          <label>Date Of Birth</label>
          <input type="date" name="dob"  required>
        </div>
        <div class="field input">
          <label>Department</label>
          <select name="dept" id="">
          <option value="Select">Select Department</option>
                <option value="Science">Science</option>
                <option value="Arts">Arts and Humanities</option>
                <option value="Commercial">Commercial</option>
          </select>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" readonly name="password" value="<?php echo $row['password'] ?>" required>
          <i class="fas fa-eye"></i>
        </div>
        <input type="text" class="incoming_id" name="state" value="<?php echo $row['status']; ?>" hidden>
        <div class="field button">
          <input type="submit" name="submit" value="Save Details">
        </div>
      </form>
      <div class="link"><a href="logout.php">Logout</a></div>
    </section>
  </div>


        </div>
    </div>
<script src="assets/scripts/biodata.js"></script>
<script src="javascript/signup.js"> </script>
</body>
</html>