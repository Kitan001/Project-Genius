<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/styles/Reg.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <!-- <div class="social-icons">
                <a href="#"> <img src="fb.jpg" alt=""></a>
                <a href="#"> <img src="Gg.png" alt=""></a>
                <a href="#"><img src="Tw.png" alt=""></a>
            </div> -->


            <form id="login" action="process-login.php" method="post" class="input-group">
                <input name="user_id" type="text" class="input-field" placeholder="Username" required>
                <div class="field input ">
                <input type="password" class="input-field" name="password" placeholder="Enter password" required>
                <!-- <i class="fa fa-eye" aria-hidden="true"></i> -->
                 </div>
                <!-- <input type="checkbox"  class="check-box" id="">
                <label for="checkbox">Remember Password</label><br> -->
                <!-- <p>No account? <a href="" onclick="register()">Create Account</a></p> -->
                <button type="submit" name="submit" class="submit-btn">Log In</button>
                
            </form>
            <?php
            include 'database.php';
            if(isset($_POST['submit'])){
                if(empty($_POST['user_id'])){
                    echo "<script>swal('Username is required')</script>";
                }elseif ( ! filter_var($_POST['email_id'], FILTER_VALIDATE_EMAIL)){
                    echo "<script>swal('Valid Email Required')</script>";
                }elseif(strlen($_POST['password']) < 6 ){
                    echo "<script>swal('password must be at least 6 characters')</script>";
                
                }elseif(! preg_match('/[a-z]/i', $_POST['password'])){
                    echo "<script>swal('password must contain at least a letter ')</script>" ;
                }elseif(! preg_match('/[0-9]/', $_POST['password'])){
                    echo "<script>swal('password must contain at least a number')</script>";
                }elseif($_POST['password'] !== $_POST['password_confirm']){
                    echo "<script>swal('Passwords must match')</script>";
                }elseif(empty($_POST['status'])){
                    echo "<script>swal('Fill In Your Status')</script>";
                }else{
                    $name= $_POST['user_id'];
                    $email=$_POST['email_id'];
                    $sqlQuery = "select * from `users` where email_id= '$email'";
                    $query= mysqli_query($con, $sqlQuery);
                    $sqlQuer = "select * from `users` where user_id= '$name'";
                    $quer= mysqli_query($con, $sqlQuer);
                    if (mysqli_num_rows($query) >0){
                        echo "<script>swal('Email already exists')</script>";
                    }
                    elseif(mysqli_num_rows($quer) >0){
                        echo "<script>swal('Username already exists')</script>";
                    }else{
                        $name= $_POST['user_id'];
                        $email=$_POST['email_id'];
                        $password= $_POST['password'];
                        $password_conf=$_POST['password_confirm'];
                    
                        $status=$_POST['status'];
                      
                        $sql="INSERT INTO `users` (user_id,email_id, password, password_confirm, status ) VALUES ('$name', '$email', '$password', '$password_conf', '$status')";
                        $result=mysqli_query($con, $sql);
                        if($result){
                            $sel="select * from `users` where status='".$status."'";
                        $result=mysqli_query($con, $sel);
                        $row=mysqli_fetch_array($result);
                        if($row["status"] == "Student"){
                            $_SESSION["user_id"]=$name;
                            header("location:student.html");
                         }elseif($row["status"] == "Teacher"){
                            $_SESSION["user_id"]=$name;
                            header("location:teacher.html");
                         }else{
                            echo '<script>swal("Not A Vaild User")</script>';
                         }
                    }
                    }
                }
            }
            ?>
       <div class="form">
       <form id="register" action="" method="post" class="input-group">
                <input type="text" name="user_id" class="input-field" placeholder="Username" >
                <input type="email" name="email_id" class="input-field" placeholder="Email Id" >
                <div class="field input ">
                <input type="password" class="input-field" name="password" placeholder="Enter password" required>
                <!-- <i class="fa fa-eye" aria-hidden="true"></i> -->
                 </div>
                <div class="field input ">
                <input type="password" class="input-field" name="password_confirm" placeholder="Enter password" required>
                <!-- <i class="fa fa-eye" aria-hidden="true"></i> -->
                 </div>
                <select class="input-field2" name="status" id="Status">
                <option value="Select">Select Status</option>
                <option value="Student">Student </option>
                <option value="Teacher">Teacher</option>
            </select>
                <!-- <a href="" onclick="login()">Login</a> -->
                <button type="submit" name="submit" class="submit-btn">Register</button>

            </form>
       </div>
        </div>
    </div>
   
    <script src="assets/scripts/index.js"></script>
</body>

</html>