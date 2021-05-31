<?php
$conn = mysqli_connect("localhost","root","","pharmacy");
if(!$conn){
  die("Connection to the database lost...".mysqli_connect_error());
}
if(isset($_POST['submit'])){
  $drug = (int)$_POST['drug'];
  $patient = (int)$_POST['patient'];
  $quant = (int)$_POST['quant'];
  $sql = "SELECT * FROM presc WHERE patient_pre_id = '$patient' AND drug_pre_id = '$drug'";
  $res = mysqli_query($conn,$sql);
  if(mysqli_num_rows($res)){
    echo"<script type = 'text/javascript'> 
      alert('Data already exists...');</script>";
  }
  else{
    $s = mysqli_fetch_assoc(mysqli_query($conn,"SELECT doctor_id FROM patient WHERE patient_id = '$patient'"));
    $p = $s['doctor_id'];
    $sql = "INSERT INTO presc (patient_pre_id,drug_pre_id,doctor_pre_id,date,quantity) VALUES ('$patient','$drug','$p',curdate(),'$quant')";
    if(mysqli_query($conn,$sql)){
      echo"<script type = 'text/javascript'> 
      alert('Given Details have been added successfully...');</script>";
      header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/prescribe.php");
    }
    else{
      echo"<script type = 'text/javascript'> 
      alert('Failed to enter given details...');</script>";
    }
  }
}
$res = mysqli_query($conn,"SELECT * FROM presc ORDER BY patient_pre_id ASC");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Prescription | XYZ PHARMACY</title>
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
       
            <div class='incontent'>
                <div class='inside'>
                <div class='top'><button class='but'><a href='patient.php'>Back</a></button></div>
                <hr>
                <div class='fcontain'><center><div><h3>Prescriptions</h3></div>
                <form method ='post' class = 'form' action = 'prescribe.php'>
                <input class='in sin' id='in2' placeholder='Patient Id' type='Number' name = 'patient' required>
                <input class='in sin' id='in2' placeholder='Drug Id' type='Number' name = 'drug' required>
                <input class='in sin' id='in2' placeholder='quantity' type='Number' name = 'quant' required>
              
              <br>  <input class='reg' type = 'submit' name = 'submit' value = 'Add'>
                <br><br>
              </form></center>
              </div>
              </form><br><br>
              <section>
                <center><h1>PRESCRIPTION DETAILS</h1>
          <table class='maintable'>
          <tr>
            <th>PID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Drug Name</th> 
            <th>Doctor Name</th>
            <th>Date</th>
            <th>Quantity</th>
          </tr>
          <?php 
            while($rows = mysqli_fetch_assoc($res)){
              ?>
          <tr>
            <td><?php echo $rows['patient_pre_id'];?></td>
            <?php
             $pid = $rows['patient_pre_id'];
             $drid = $rows['drug_pre_id'];
             $did = $rows['doctor_pre_id'];
             $prows = mysqli_fetch_assoc(mysqli_query($conn,"SELECT first_name,last_name FROM patient WHERE patient_id = '$pid'"));
             $qrows = mysqli_fetch_assoc(mysqli_query($conn,"SELECT drug_name FROM drug WHERE drug_id = '$drid'"));
             $rrows = mysqli_fetch_assoc(mysqli_query($conn,"SELECT first_name,last_name FROM doctor WHERE phy_id = '$did'"));
             $dname = $rrows['first_name'].' '.$rrows['last_name'];
             ?>
            <td><?php echo $prows['first_name'];?></td>
            <td><?php echo $prows['last_name'];?></td>
            <td><?php echo $qrows['drug_name'];?></td>
            <td><?php echo $dname;?></td>
            <td><?php echo $rows['date'];?></td>
            <td><?php echo $rows['quantity'].' gm';?></td>
          </tr>
          <?php } ?>
  </table>
  </section>
</center>
                <br>
                </div>   </div>  </div>   
       
       
        
            </div>
        

  </body>
</html>
