<?php
$conn = mysqli_connect("localhost","root","","pharmacy");
if(!$conn){
  die("Connection to the database lost...".mysqli_connect_error());
}
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $SQL = "SELECT * FROM admin WHERE username = '$username'";
  $res = mysqli_query($conn,$SQL);
  if(mysqli_num_rows($res)){
    echo"<script type = 'text/javascript'> 
      alert('Username already exists...');</script>";
  }
  else{
    $SQL = "INSERT INTO admin (username,password) VALUES ('$username','$password')";
    if(mysqli_query($conn,$SQL)){
    echo"<script type = 'text/javascript'> 
      alert('Please Login with your new credentials...');</script>";
    header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/login.php"); 
    }
    else {
    echo"<script type = 'text/javascript'> 
      alert('Account Creation Failed.Try Again...');</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign-Up | XYZ PHARMACY</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="spstyle.css">
    <link rel="stylesheet" href='fpstyle.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/0cc63ebc07.js" crossorigin="anonymous"></script>

  </head>
  <body>


    <!--sidebar end-->
   
    <div class="content content2" id='log'>
<section>
    <div class='top'><button class='but'><a href='login.php'>Back</a></button></div>
<hr>
    <div class='fcontain'>
    <center><form class='form' method = 'post' action = 'signup.php' >
 <h1>Add your User Details</h1>
<div><input class='fin in' type='email' placeholder='Email address' required></div>
<div><input type = 'text' placeholder = 'Username' name = 'username' class = 'fin in' required><div>
<div><input class='Tin in' name = 'password' type='password' placeholder='Password' required>
</select></div>
<div class='checkthird'><input type='checkbox' required><label class='ctl'>I accept Terms of Use and Privacy Policy</label>
</div>
<div><input type = 'submit' name = 'submit' class = 'reg' value = 'REGISTER'></div>
</form>
</center>
</div>
</section></div>
  </body>
</html>
