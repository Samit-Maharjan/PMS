<?php
$conn = mysqli_connect("localhost","root","","pharmacy");
if(!$conn){
  die("Connection to the database lost...".mysqli_connect_error());
}
if(isset($_POST['submit'])){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $special = $_POST['speciality'];
  $sql = "SELECT * FROM doctor WHERE (first_name = '$fname' or last_name = '$lname')";
  $res = mysqli_query($conn,$sql);
  if(mysqli_num_rows($res)){
    echo"<script type = 'text/javascript'> 
      alert('Username already exists...');</script>";
  }
  else{
    $sql = "INSERT INTO doctor (first_name,last_name,speciality) VALUES ('$fname','$lname','$special')";
    if(mysqli_query($conn,$sql)){
      echo"<script type = 'text/javascript'> 
      alert('Given Details have been added successfully...');</script>";
      header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/Doctorsign.php");
    }
    else{
      echo"<script type = 'text/javascript'> 
      alert('Failed to enter given details...');</script>";
    }
  }
}
$res = mysqli_query($conn,"SELECT * FROM doctor ORDER BY phy_id ASC");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Doctor | XYZ PHARMACY</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/0cc63ebc07.js" crossorigin="anonymous"></script>

  </head>
  <body>

    <input type="checkbox" id="check">
    <!--header area start-->
    <header>
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
        <h3><span>XYZ PHARMACY</span></h3>
      </div>
      <div class="right_area">
        <a href="#" class="logout_btn">Logout</a>
      </div>
    </header>
    <!--header area end-->
    <!--sidebar start-->
    <div class="sidebar">
      
      <a href="homepage.php"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="Doctorsign.php" class = 'vis'><i class='fas fa-user-md'></i><span>Doctor</span></a>
      <a href="Drugsign.php"><i class='fas fa-pills'></i><span>Drugs</span></a>
      <a href="patient.php"><i class='fas fa-male'></i><span>Patient</span></a>
      <a href="employee.php"><i class='fas fa-user-nurse'></i><span>Employee</span></a>

      <a href="pharmacy.php"><i class='fas fa-hospital-symbol'></i><span>Pharmacy</span></a>
<a href="#"><i class="fas fa-question-circle"></i><span>Help</span></a>
   
</div>
    <!--sidebar end-->

   
     
      <div class="content" id='doc'>
        <div class='incontent'>
        <div class='inside'>
        <div class='top'><button class='but'><a href='homepage.php'>Back</a></button></div>
        <hr>
        <div class='fcontain'>
          <center>
        <form method = 'post' action = 'Doctorsign.php' class = 'form'>
        <div><input class='in fin' placeholder='First Name' type='text' name = 'fname' required></div>
        <div><input class='in sin' placeholder='Last Name' type='text' name = 'lname' required></div>
        <div><select name="speciality" class="in fin" required>
          <label>Speciality</label>
          <option selected disabled>Speciality</option>
          <option>Phyisician</option>
          <option>Surgeon</option>
          <option>Gynaecologist</option>
          <option>Cardiologist</option>
        </select></div>
        <input type =  'submit' class = 'reg' value = 'Add' name = 'submit'><br>
        </form><br><br>
        <section>
          <h1><center>DOCTOR DETAILS</center></h1>
        <table class='maintable'>
          <tr>
            <th>Phy_ID</th>
            <th>First Name</th>
            <th>Last Name</th> 
            <th>Speciality</th>
          </tr>
          <?php 
            if($res)
            while($rows = mysqli_fetch_assoc($res)){
              ?>
          <tr>
            <td><?php echo $rows['phy_id'];?></td>
            <td><?php echo $rows['first_name'];?></td>
            <td><?php echo $rows['last_name'];?></td>
            <td><?php echo $rows['speciality'];?></td>
          </tr>
          <?php } ?>
        </table></section>
        </center>
        <br>
        </div>   
      </div>  
    </div>   
    </div>
  </body>
</html>
