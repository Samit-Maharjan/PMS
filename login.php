<?php
$conn = mysqli_connect("localhost","root","","pharmacy");
if(!$conn){
  die("Connection to the database lost...".mysqli_connect_error());
}
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $result = mysqli_query($conn,"SELECT * FROM admin WHERE username = '$username' and password = '$password'");
  if(mysqli_num_rows($result)>0){
    session_start();
    $_SESSION["logged_in"] = true;
    header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/homepage.php");
  }
  else
    echo '<script type = "text/javascript">
    alert("Incorrect Username or Password...");</script>';
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login | XYZ PHARMACY</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/0cc63ebc07.js" crossorigin="anonymous"></script>

  </head>
  <body>

   
    <!--sidebar end-->

    <div class="content" id='log'>

    <div class='top'><button class='but'><a href='homepagebefore.php'>Back</a></button></div>
    <hr>
      <center> 
      <h1>Log in</h1>
       <form class = 'form' method = 'post' action = 'login.php'>
          <input name = 'username' class = 'fin in' type = 'text' placeholder = 'Username' required><br>
          <input name = 'password' class = 'Tin in' type = 'password' placeholder = 'Password' required><br>
          <input name = 'submit' class = 'reg' type = 'submit' value = "Login"><br>
        </form>
        NEW USER? <a href = 'signup.php'><u>CREATE A NEW ACCOUNT</u></a><br><br>
  </center>
    </div>

  </body>
</html>