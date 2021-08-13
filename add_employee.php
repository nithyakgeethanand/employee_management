<?php 

session_start();
if(!isset($_SESSION['IS_LOGIN'])) {
  
  header("Location: index.php");
}

include "database.php";

$userObj = new Admin();

// if(isset($_POST['add_employee'])) {
//   $userObj->insertNewEmployee($_POST);
// }



if(isset($_POST['add_employee'])) {
  $employeeid = trim($_POST['employeeid']);
  $first_name = trim($_POST['firstname']);
  $last_name = trim($_POST['lastname']);
  $email = trim($_POST['email']);
  $date = trim($_POST['dateofjoining']);
  $country = trim($_POST['country_id']);
  // $state = trim($_POST['state']);
  $city = trim($_POST['city']);
  $pin = trim($_POST['pincode']);

        $error = [
            'username'=> '',
            'firstname'=> '',
            'lastname'=> '',
            'email' => '',
            'dateofjoining' =>'',
            'country_id' =>'',
            'state' =>'',
            'city'=>'',
            'pincode'=>''

        ];
        
      if($employeeid == '') {
          $error['username'] = 'Employee Id cannot be empty';
      }
      if($userObj->employeeid_exists($employeeid)) {
        $error['username'] = 'Employee ID Already Exists!!!';
    }
  // if($userObj->username_exists($username)) {
  //   $error['username'] = 'Username already exists, pick another one!!';
  // }
 
    if($first_name == '') {
      $error['firstname'] = 'Firstname cannot be empty';
    }
  
    if($last_name == '') {
      $error['lastname'] = 'Lastname cannot be empty';
    }
    if($email == '') {
      $error['email'] = 'Invalid Email';
    }
    if($userObj->email_existsEmployee($email)) {
        $error['email'] = 'Invalid Email!!!';
    }
    if($email == '') {
      $error['email'] = 'Invalid Email';
    }

    if($city == '') {
      $error['city'] = 'City cannot be empty';
    }
    if($pin == '') {
      $error['pincode'] = 'Pincode cannot be empty';
    }
    foreach ($error as $key => $value) {
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)) {
      $userObj->insertNewEmployee($_POST);
    }
    

  // $userObj->insertData($_POST);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add_form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- Popper JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/745e131cff.js" crossorigin="anonymous"></script>
  
   
    <!-- datatables -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.js"></script> -->
    <title>Employee Details</title>
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css"> -->
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

<form action="" method="POST" enctype="multipart/form-data">
<div class="container pt-5 pb-3 bg-light">
<h2>Employee Registration Form</h2>
<hr><br>
<div class="row g-3">
  <div class="col-md-3">
      <label for="">Employee ID</label>
      <input type="text" class="form-control"  placeholder="employeeid"  name="employeeid">
      <p style="color: red;"><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
  </div>
  <div class="col-md-3">
      <label for="">Salutation</label>
      <select name="salutation" class="form-control" >
        <option value="Mr">Mr</option>
        <option value="Mrs">Mrs</option>
        <option value="Miss">Miss</option>
      </select>
  </div>
  <div class="col-md-3">
      <label for="">First Name</label>
      <input type="text" class="form-control"  placeholder="Firstname"  name="firstname">
      <p style="color: red;"><?php echo isset($error['firstname']) ? $error['firstname'] : '' ?></p>
  </div>
  <div class="col-md-3">
    <label for="">Last name</label>
    <input type="text" class="form-control"  placeholder="Lastname"  name="lastname">
    <p style="color: red;"><?php echo isset($error['lastname']) ? $error['lastname'] : '' ?></p>
  </div>
  <!-- <div class="col-md-3">
    <label for="">Address</label>
    <input type="text" class="form-control"  placeholder="address" required name="address">
  </div> -->
</div>
<br>
<!-- end of row 1 -->

<div class="row g-3 ">
  <div class="col-md-3">
      <label for="">Email</label>
      <input type="email" class="form-control"  placeholder="Email" name="email" id="txtEmail" onkeyup="ValidateEmail();">
      <p style="color: red;" id="lblErrorEmail" ><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
  </div>
  <div class="col-md-3">
      <label for="">Gender</label>
      <div class=" d-flex">
           <div class="form-check">
           <input type="radio" checked name="gender" value="Male">
              <label class="form-check-label">Male&nbsp;&nbsp;</label>
            </div>
            <div class="form-check">
            <input type="radio" name="gender" value="Female">
              <label class="form-check-label" >Female&nbsp;&nbsp; </label>
            </div>
            <div class="form-check">
            <input type="radio" name="gender" value="other">
              <label class="form-check-label">Other</label>
            </div>
      </div>
  </div>
  <div class="col-md-3">
      <label for="">Date of Joining</label> 
      <input type="date" class="form-control"  placeholder="Date of Joining"  name="dateofjoining">
  </div>
  <div class="col-md-3">
      <label for="">Resume</label>
      <input type="file" class="form-control"  placeholder="Resume" name="resume">
  </div>
</div><br>
<!-- end of row2 -->

<div class="row g-3">
  <div class="col-md-3">
    <label for="">Country</label>
      <select id="countrydd" name="country_id" class="form-control" onchange="change_country()">
        <option value="">---select country---</option>
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
      <select class="form-control">
        <option selected>---select states---</option>
      </select>
  </div>
  </div>
  <div class="col-md-3">
    <label for="">City</label>
    <input type="text" class="form-control"  placeholder="City"  name="city">
    <p style="color: red;"><?php echo isset($error['city']) ? $error['city'] : '' ?></p>
  </div>
  <div class="col-md-3">
    <label for="">Pincode</label>
    <input type="text" class="form-control"  placeholder="Pincode"  name="pincode">
    <p style="color: red;"><?php echo isset($error['pincode']) ? $error['pincode'] : '' ?></p>
  </div>
</div>
<br>
<!-- end of row3 -->
<div class="row ">
  <div class="col">
    <button type="submit" class="btn btn-success" name="add_employee">Submit</button>
    <button type="reset" class="btn btn-danger">Cancel</button>
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
<script>
  function ValidateEmail() {
    var email = document.getElementById("txtEmail").value;
    var lblError = document.getElementById("lblErrorEmail");
    lblError.innerHTML = "";
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (!expr.test(email)) {
        lblError.innerHTML = "Invalid email address";
    }
}
</script>

</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>