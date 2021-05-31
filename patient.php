<?php
$conn = mysqli_connect("localhost","root","","pharmacy");
if(!$conn){
  die("Connection to the database lost...".mysqli_connect_error());
}
if(isset($_POST['submit'])){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phone = (int)$_POST['phone'];
  $addr = $_POST['address'];
  $sex = $_POST['gender'];
  $doctorid = (int)$_POST['doctor_id'];
  $sql = "SELECT * FROM patient WHERE (first_name = '$fname' or last_name = '$lname')";
  $res = mysqli_query($conn,$sql);
  if(mysqli_num_rows($res)){
    echo"<script type = 'text/javascript'> 
      alert('Username already exists...');</script>";
  }
  else{
    $sql = "INSERT INTO patient (first_name,last_name,gender,address,phone_no,doctor_id) VALUES ('$fname','$lname','$sex','$addr','$phone','$doctorid')";
    if(mysqli_query($conn,$sql)){
      echo"<script type = 'text/javascript'> 
      alert('Given Details have been added successfully...');</script>";
      header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/patient.php");
    }
    else{
      echo"<script type = 'text/javascript'> 
      alert('Failed to enter given details...');</script>";
    }
  }
}
$res = mysqli_query($conn,"SELECT * FROM patient ORDER BY patient_id ASC");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Patient | XYZ PHARMACY </title>
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
      <a href="Doctorsign.php"><i class='fas fa-user-md'></i><span>Doctor</span></a>
      <a href="Drugsign.php"><i class='fas fa-pills'></i><span>Drugs</span></a>
      <a href="patient.php" class = 'vis'><i class='fas fa-male'></i><span>Patient</span></a>
      <a href="employee.php"><i class='fas fa-user-nurse'></i><span>Employee</span></a>

      <a href="pharmacy.php"><i class='fas fa-hospital-symbol'></i><span>Pharmacy</span></a>
<a href="#"><i class="fas fa-question-circle"></i><span>Help</span></a>
   
</div>
    <!--sidebar end-->

    <div class="content" id='doc'>
      <div class='top'><button class='but'><a href='homepage.php'>Back</a></button>
      <button class='but' id='sup'><a href='prescribe.php'>Prescription</a></button></div>
    <div class='incontent'>
        <div class='inside'>
        <hr>
        <div class='fcontain'><center>
        <form method = 'post' class = 'form' action = 'patient.php'>

        <input class='in' id='in2' name = 'fname' placeholder='First Name' type='text'>
        <input class='in' id='in2' name = 'lname' placeholder='Last Name' type='text'>
        <input name='gender' class = 'in' id = 'in2' placeholder = 'M/F' type = 'text' required>
            <br><br>
        <input class='in sin' id='in2' name = 'address' placeholder='Address' type='text' required>
        <input class='in sin' id='in2' name = 'phone' placeholder='Phone Number' type='number' required>
        <br><br>
        <input class='in sin' id='in2' name = 'doctor_id' placeholder='Doctor ID' type='number' required>
        <input class='in sin' id='in2' name = 'insr' placeholder='Insurance Info' type='text' required>
      <br>  <input type =  'submit' class = 'reg' value = 'Add' name = 'submit'><br>
      </form></center><br><br>
      <center><h1>PATIENT DETAILS</h1></center>
      <section>
      <table class='maintable'>
          <tr>
            <th>Patient ID</th>
            <th>First Name</th>
            <th>Last Name</th> 
            <th>Gender</th>
            <th>Address</th>
            <th>Phone No.</th>
            <th>Doctor Name</th>
          </tr>
      <?php 
            while($rows = mysqli_fetch_assoc($res)){
              $did = $rows['doctor_id'];
              $rrows = mysqli_fetch_assoc(mysqli_query($conn,"SELECT first_name,last_name FROM doctor WHERE phy_id = '$did'"));
              $dname = $rrows['first_name'].' '.$rrows['last_name'];
              ?>
          <tr>
            <td><?php echo $rows['patient_id'];?></td>
            <td><?php echo $rows['first_name'];?></td>
            <td><?php echo $rows['last_name'];?></td>
            <td><?php echo $rows['gender'];?></td>
            <td><?php echo $rows['address'];?></td>
            <td><?php echo $rows['phone_no'];?></td>
            <td><?php echo $dname;?></td>
          </tr>
          <?php }?>
        </table></section>
        
        <br>
        </div>   </div>  </div>   

    </div>

  </body>
</html>
