<?php
$conn = mysqli_connect("localhost","root","","pharmacy");
if(!$conn){
  die("Connection to the database lost...".mysqli_connect_error());
}
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $manuf = $_POST['manuf'];
  $exp = (int)$_POST['exp'];
  $sql = "SELECT * FROM drug WHERE drug_name = '$name'";
  $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)){
    echo"<script type = 'text/javascript'> 
      alert('Drug name already exists...');</script>";
  }
  else{
    $sql = "INSERT INTO drug (drug_name,manufacturer,expiry_age) VALUES ('$name','$manuf','$exp')";
    if(mysqli_query($conn,$sql)){
      echo"<script type = 'text/javascript'> 
      alert('Given Details have been added successfully...');</script>";
      header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/Drugsign.php");
    }
    else{
      echo"<script type = 'text/javascript'> 
      alert('Failed to enter given details...');</script>";
    }
  }
}
$res = mysqli_query($conn,"SELECT * FROM drug");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Drug | XYZ PHARMACY</title>
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
      <a href="Drugsign.php" class = 'vis'><i class='fas fa-pills'></i><span>Drugs</span></a>
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
          <form class = 'form' method = 'post' action = 'Drugsign.php'>

        <div class='fdiv'><input name = 'name' class='in fin' placeholder='Drug Name' type='text' required></div>
        <div class='fdiv'><input class='in fin' name = 'manuf' placeholder='Manufactured by' type='text' required></div>
       <div class='fdiv'><input class='in fin' placeholder = 'Expiry Date in Months' name = 'exp' type='number' required></div>
        <input type = 'submit' name = 'submit' class = 'reg' value = 'Add'><br>
        </form><br><br>
        <h1><center>DRUG DETAILS</center></h1>
        <section>
        <table class='maintable'>
          <tr>
            <th>Drug ID</th>
            <th>Drug Name</th>
            <th>Manufacturer</th>
            <th>Expiry Date</th>
          </tr>
          <?php 
            while($rows = mysqli_fetch_assoc($res)){
              ?>
          <tr>
            <td><?php echo $rows['drug_id'];?></td>
            <td><?php echo $rows['drug_name'];?></td>
            <td><?php echo $rows['manufacturer'];?></td>
            <td><?php echo $rows['expiry_age'].' months';?></td>
          </tr>
          <?php } ?>
        </table></section>
        </center>
        <br>
        </div>   </div>  </div>   </form>
    </div>

  </body>
</html>
