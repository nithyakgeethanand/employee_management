<?php 


session_start();
if(!isset($_SESSION['IS_LOGIN'])) {
  
  // echo $_SESSION['IS_LOGIN'];
  header("Location: index.php");
}

include "database.php";

$userObj = new Admin();

 if(isset($_POST['submit'])) {
  $username = trim($_POST['username']);
  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $email = trim($_POST['email']);
  $role_id = trim($_POST['role_id']);
  $error = [
      'username'=> '',
      'first_name'=> '',
      'last_name'=> ''
  ];
  if(strlen($username) < 4) {
      $error['username'] = 'Username needs to be longer';
  }
  if($username == '') {
      $error['username'] = 'Username cannot be empty';
  }
  // if($userObj->username_exists($username)) {
  //   $error['username'] = 'Username already exists, pick another one!!';
  // }
  if(strlen($first_name) < 4) {
    $error['first_name'] = 'Firstname needs to be longer';
  }
  if($first_name == '') {
    $error['first_name'] = 'Firstname cannot be empty';
  }
  if(strlen($last_name) < 4) {
    $error['last_name'] = 'Lastname needs to be longer';
  }
  if($last_name == '') {
    $error['last_name'] = 'Lastname cannot be empty';
  }
  if($email == '') {
    $error['email'] = 'Email cannot be empty';
  }
if($userObj->email_exists($email)) {
    $error['email'] = 'Email already exists!!!';
}
  foreach ($error as $key => $value) {
      if(empty($value)){
          unset($error[$key]);
      }
  }
  if(empty($error)) {
    $userObj->insertData($_POST);
  }

  // $userObj->insertData($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <script src="https://kit.fontawesome.com/745e131cff.js" crossorigin="anonymous"></script>
  
   
    <title>Adding New Admin</title>
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

<div class="container"> 
    <h2 class="text-left">ADD USER</h2>
    <form class="row g-3" method="POST" action="./add_admin.php">
        <div class="col-md-12">
            <label for="inputusername" class="text-left">Username</label>
            <input type="text" name="username" class="form-control" id="inputusername" placeholder="Enter Username" required>
            <p style="color: red;"><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
        </div>
        <div class="col-md-6">
            <label for="inputfirstname" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" id="inputfirstname" onkeyup="ValidateFirstname()" placeholder="Enter First Name" required>
            <p style="color: red;" id="lblErrorFirstname"><?php echo isset($error['first_name']) ? $error['first_name'] : '' ?></p>
          </div>
        <div class="col-md-6">
            <label for="inputlastname" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="inputlastname" onkeyup="validateLastname()" placeholder="Enter Last Name" required>
            <p style="color: red;" id="lblErrorLastname"><?php echo isset($error['last_name']) ? $error['first_name'] : '' ?></p>
          </div>
        <div class="col-md-6">
            <label for="txtEmail" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" id="txtEmail" onkeyup="ValidateEmail()" placeholder="Enter Email" required>
            <p style="color: red;" id="lblErrorEmail"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
        </div>
        <div class="col-md-6">
          <label for="user_role" class="form-label">User Role</label>
          <select name="role_id" class="form-control" id="role_id">

          <?php
// $query = "SELECT * FROM users INNER JOIN user_role ON users.role_id = user_role.rol_id ";
$connection = mysqli_connect('localhost', 'root', '', 'employee');
$query = "SELECT * FROM role ";
$select_role = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($select_role )) {
    $role_id = $row['role_id'];
    $role_title = $row['role_name'];
echo "<option value='$role_id'>{$role_title}</option>";
 }
?>    
       </select>
      </div>
        <div class="col-md-12">
            <button type="submit" name="submit" class="btn btn-primary">Add User</button>
            <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
    </form>
    </div>


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

function ValidateFirstname(){
    let firstname = document.getElementById("inputfirstname").value;
    let lblError = document.getElementById("lblErrorFirstname");
    lblError.innerHTML = "";
    let expr =/^[a-zA-Z]+$/;
    if(!expr.test(firstname)){
        lblError.innerHTML = "Invalid Firstname Format";
    }
  }

  function validateLastname(){
    let lastname = document.getElementById("inputlastname").value;
    let lblError = document.getElementById("lblErrorLastname");
    lblError.innerHTML = "";
    let expr =/^[a-zA-Z]+$/;
    if(!expr.test(lastname)){
        lblError.innerHTML = "Invalid Lastname Format";
    }
}

  </script>
</body>
</html>