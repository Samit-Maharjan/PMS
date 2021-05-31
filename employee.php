<?php
$conn = mysqli_connect("localhost","root","","pharmacy");
if(!$conn){
  die("Connection to the database lost...".mysqli_connect_error());
}
if(isset($_POST['submit'])){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phone = (int)$_POST['phone'];
  $phar_id = (int)$_POST['phar_id'];
  $sql = "SELECT * FROM employee WHERE (efirst_name = '$fname' or elast_name = '$lname')";
  $res = mysqli_query($conn,$sql);
  if(mysqli_num_rows($res)){
    echo"<script type = 'text/javascript'> 
      alert('Username already exists...');</script>";
  }
  else{
     $sql = "INSERT INTO employee (efirst_name,elast_name,ephone_no,pharm_id) VALUES ('$fname','$lname','$phone','$phar_id')";
    if(mysqli_query($conn,$sql)){
      echo"<script type = 'text/javascript'> 
      alert('Given Details have been added successfully...');</script>";
      header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/employee.php");
    }
    else{
      echo"<script type = 'text/javascript'> 
      alert('Failed to enter given details...');</script>";
    }
  }
}
$res = mysqli_query($conn,"SELECT * FROM employee ORDER BY emp_id ASC");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Employee | XYZ PHARMACY</title>
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
      <a href="patient.php"><i class='fas fa-male'></i><span>Patient</span></a>
      <a href="employee.php" class ='vis'><i class='fas fa-user-nurse'></i><span>Employee</span></a>

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
          <form class = 'form' action = 'employee.php' method = 'post'>

        <input class='in fin' placeholder='First Name' type='text' name = 'fname' required>
        <input class='in sin' placeholder='Last Name' type='text' name = 'lname' required>
        <input class='in sin' placeholder='Pharm_ID.' type ='number' name = 'phar_id' required>
        <input class='in sin' placeholder='Phone No.' type ='number' name = 'phone' required><br>
        <input class = 'reg' type = 'submit' value = 'Add' name = 'submit'>
        </form><br><br>
        <h1>EMPLOYEE DETAILS</h1>
        <section>
        <table class='maintable'>
          <tr>
            <th>Emp_ID</th>
            <th>First Name</th>
            <th>Last Name</th> 
            <th>Phone No.</th>
            <th>Pharmacy Name</th>
          </tr>
          <?php 
            while($rows = mysqli_fetch_assoc($res)){
               $pid = $rows['pharm_id'];
               $prows = mysqli_fetch_assoc(mysqli_query($conn,"SELECT phar_name FROM pharmacy1 WHERE phar_id = '$pid'"));
              ?>
          <tr>
            <td><?php echo $rows['emp_id'];?></td>
            <td><?php echo $rows['efirst_name'];?></td>
            <td><?php echo $rows['elast_name'];?></td>
            <td><?php echo $rows['ephone_no'];?></td>
            <td><?php echo $prows['phar_name'];?></td>
          </tr>
          <?php } ?>
        </table></section>
        </div>
        </center>
        <br>
        </div>   </div>  </div>   
    </div>

  </body>
</html>
