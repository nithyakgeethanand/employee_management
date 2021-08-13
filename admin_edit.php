<?php 
session_start();
if(!isset($_SESSION['IS_LOGIN'])) {
  
  header("Location: index.php");
}

include "database.php";

$userObj = new Admin();

// Edit admin record
if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $customer = $userObj->displayRecordById($editId);
  }
  
  // Update Record in admin table
  if(isset($_POST['update'])) {
    // $userObj->updateData($_POST);
    $userObj->updateData($_POST);
  }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Admin</title>
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

   <br>
    <form class="row g-3" method="POST" action="./admin_edit.php">
<div class="col-md-12">
    <label for="inputusername" class="form-label">USERNAME</label>
    <input type="text" name="username" value="<?php echo $customer['user_name']; ?>" class="form-control" id="inputusername" placeholder="Enter Username">
    </div>
    <div class="col-md-6">
            <label for="inputfirstname" class="form-label">First Name</label>
            <input type="text" name="first_name" value="<?php echo $customer['first_name']; ?>" class="form-control" id="inputfirstname" placeholder="Enter First Name">
        </div>
        <div class="col-md-6">
            <label for="inputlastname" class="form-label">Last Name</label>
            <input type="text" name="last_name" value="<?php echo $customer['first_name']; ?>" class="form-control" id="inputlastname" placeholder="Enter Last Name">
        </div>
        <div class="col-md-6">
            <label for="inputemail" class="form-label">Email</label>
            <input type="text" name="email" value="<?php echo $customer['email']; ?>" class="form-control" id="inputemail" placeholder="Enter Email">
        </div>
    <div class="col-md-6">
          <label for="user_role" class="form-label">User Role</label>
          <select name="role_id"  class="form-control" id="user_role">
          <option value="<?php if(isset($customer['role_id'])) { echo $customer['role_id']; } ?>"><?php echo $customer['role_name']; ?></option>
          <?php 
          if($customer['role_name'] == 'HR') {
             echo "<option value='2'>AUDITOR</option>";
          } else {
            echo "<option value='1'>HR</option>";
          }
      ?>
       </select>
      </div>
      <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
      <div class="col-md-12 mt-3">
            <button type="submit" name="update" class="btn btn-primary">Add User</button>
        </div>
    <!-- <input type="submit" name="update" class="btn btn-primary" style="float:right;" value="Submit"> -->
  </form>
</div>

 
</body>
</html>