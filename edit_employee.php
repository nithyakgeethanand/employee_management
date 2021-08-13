<?php 
session_start();
if(!isset($_SESSION['IS_LOGIN'])) {
  
  header("Location: index.php");
}

include "database.php";

$userObj = new Admin();

// Edit employee record
if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $customer = $userObj->displayEmployeeRecordById($editId);
  }
  
  // Update Record in admin table
  if(isset($_POST['update'])) {
    // $userObj->updateData($_POST);
    $userObj->updateDataEmployee($_POST);
  }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Employee</title>
</head>
<body>
  <nav class="navbar navbar-expand-md bg-success navbar-dark">
          <a class="navbar-brand" href="#">Admin Dashboard</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav ml-auto">
                  <!-- <li class="nav-item"><a class="nav-link" href="add_employee.php">Add employee</a></li> -->
                  <li class="nav-item"><a class="nav-link" href="admin.php">view employee</a></li>
                  <!-- <li class="nav-item"><a class="nav-link" href="admin.php">Add admin</a></li> -->
                  <li class="nav-item"><a class="nav-link " href="admin_view.php">view admin</a></li>
                  <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
              </ul>
          </div>
      </nav>

    <!-- <h2 class="card-header bg-secondary text-white">Edit USER</h2> -->
    <form action="" method="POST" enctype="multipart/form-data">
<div class="container pt-5 pb-5 bg-light">

<hr><br>
<div class="row g-3">
  <div class="col-md-3">
      <label for="">Employee ID</label>
      <input type="text" value="<?php echo $customer['employee_id']; ?>" class="form-control"  placeholder="employeeid" required name="employeeid">
  </div>
  <div class="col-md-3">
      <label for="">Salutation</label>
      <select name="salutation" value="<?php echo $customer['salutation']; ?>" class="form-control" >
        <option value="Mr">Mr</option>
        <option value="Mrs">Mrs</option>
        <option value="Miss">Miss</option>
      </select>
  </div>
  <div class="col-md-3">
      <label for="">First Name</label>
      <input type="text" value="<?php echo $customer['first_name']; ?>" class="form-control"  placeholder="Firstname" required name="firstname">
  </div>
  <div class="col-md-3">
    <label for="">Last name</label>
    <input type="text"  value="<?php echo $customer['last_name']; ?>" class="form-control"  placeholder="Lastname" required name="lastname">
  </div>
  <!-- <div class="col-md-3">
    <label for="">Address</label>
    <input type="text" class="form-control"  placeholder="address" required name="address">
  </div> -->
</div>
<br>
<!-- end of row 1 -->

<div class="row g-3 ">
  <div class="col-md-6">
      <label for="">Email</label>
      <input type="email" value="<?php echo $customer['email']; ?>" class="form-control"  placeholder="Email" required name="email">
  </div>
  <div class="col-md-6">
      <label for="radio" class="form-label">Gender</label><br>
      
      <input type="radio" name="gender" value="male" checked /> male <?php echo ($customer['gender'] == 'male' ? 'This was selected!' : '');?> </br>
      <input type="radio" name="gender" value="female" /> female <?php echo ($customer['gender'] == 'female' ? 'This was selected!' : '');?> </br>

  </div>

  <div class="col-md-6">
      <label for="">Date of Joining</label> 
      <input type="date" value="<?php echo $customer['joining_date']; ?>" class="form-control"  placeholder="Date of Joining" name="dateofjoining">
  </div>
  <div class="col-md-6">
      <label for="">Resume</label>
      <input type="file" value="<?php echo $customer['resume']; ?>" class="form-control"  placeholder="Resume" required name="resume">
  </div>
</div><br>
<!-- end of row2 -->

<div class="row g-3">
  <div class="col-md-3">
    <label for="">Country</label>
      <select id="countrydd" name="country_id" class="form-control" onchange="change_country()">
        <option value="<?php echo $customer['country_id']; ?>"><?php echo 'selected:'.''. $customer['country_name']; ?></option>
            <?php
                $connection = mysqli_connect("localhost","root", "",'employee');
                $res = mysqli_query($connection, "SELECT * FROM country");
                while($row = mysqli_fetch_array($res)) {
                          ?>
                <option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
                <?php }?>
      </select>
  </div>
  <div class="col-md-3">
    <label for="">State</label>
    <div id="state">
      <select name="state_id" class="form-control">
        <option value="<?php echo $customer['state_id']; ?>"><?php echo $customer['state_name']; ?></option>
      </select>
  </div>
  </div>
  <div class="col-md-3">
    <label for="">City</label>
    <input type="text" value="<?php echo $customer['city']; ?>" class="form-control"  placeholder="City" required name="city">
  </div>
  <div class="col-md-3">
    <label for="">Pincode</label>
    <input type="text" value="<?php echo $customer['pin']; ?>" class="form-control"  placeholder="Pincode" required name="pincode">
  </div>
</div>
<br>
<!-- end of row3 -->
<div class="row ">
  <div class="col">
    <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
    <button type="submit" class="btn" style="background-color: teal;color:white" name="update">Submit</button>
    <!-- <button type="reset" class="btn btn-danger">Cancel</button> -->
  </div>
</div>
</form>

<script>
        function change_country() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "ajax.php?country="+document.getElementById("countrydd").value, false);
            xmlhttp.send(null);
            document.getElementById("state").innerHTML = xmlhttp.responseText;
        }
</script>
</div>

 
</body>
</html>