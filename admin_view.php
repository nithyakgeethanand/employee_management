<?php 

session_start();
if(!isset($_SESSION['IS_LOGIN'])) {
  
  header("Location: index.php");
}


// include "db.php";

include "database.php";

$userObj = new Admin();

if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $userObj->deleteRecord($deleteId);
}

if(isset($_GET['statusId']) && !empty($_GET['statusId'])) {
    $statusId = $_GET['statusId'];
    $userObj->changeStatus($statusId);
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/745e131cff.js" crossorigin="anonymous"></script>
    <!-- sweet alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.js"></script>
    <title>Employee DetailsL</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
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
                  <li class="nav-item"><a class="nav-link active" href="admin_view.php">view admin</a></li>
                  <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
              </ul>
          </div>
      </nav>
     

<!-- <div class="navbar" style="background-color: #9ea7f8;">
    <h2>Admin</h2>
    <a href="logout.php" style="margin-left:100px">Logout</a>

</div> -->

<!-- <h2 style="text-align:center;">Datatables Server</h2> -->

<div style="align:right;">
     <!-- <button type="button" name="add" id="add" class="btn btn-info">Add</button> -->


   <a href="add_admin.php" class="btn btn-primary mt-3 mr-3 mb-1" style="float:right;">Add Users</a>
     
     <!-- <a href="admin.php">Display Employee List</a> -->
     
    </div> 
    <table id="customersTable" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
               
                <th>First Name</th>
                <th>last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Status Change</th>
                <th>Edit</th>  
                <th>Delete</th> 
                            
            </tr>
           
        </thead>
       
         <tbody>

         </tbody>
    </table>

    <form method="post" action="export.php">
     <!-- <input type="submit" name="export" class="btn btn-success" value="Export" /> -->
     <input type="submit" id="btnExport" class="btn btn-success" name="export" value="Export as Excel">
    </form>
    
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js" charset="utf8" type="text/javascript"></script> -->

    <script type="text/javascript">
    $(document).ready(function() {
        $("#customersTable").DataTable({
            "ajax": {
                "url": "./admin_data.php",
                "dataSrc": "",
            },
            "columns" : [
                {"data":"id"},
                {"data":"first_name"},
                {"data":"last_name"},
                {"data":"email"},
                {"data":"role_name"},
                {"data":"is_activate"},
            
                {"mRender": function ( data, type, row ) {
                        return '<a class="text-success ml-5" href=admin_view.php?statusId='+row.id+'><i class="fas fa-exchange-alt icon"></i></a>';}
                },
                {"mRender": function ( data, type, row ) {
                        // return '<a href=edit.php?editId='+row.id+'>Edit</a>';}
                        return ' <a class="text-warning ml-3" href=admin_edit.php?editId='+row.id+'><i class="far fa-edit icon"></i></a> ';}
                },
                {"mRender": function ( data, type, row ) {
                        return '<a class="text-danger ml-3" href=admin_view.php?deleteId='+row.id+'><i class="far fa-trash-alt icon"></i></a> ';}
                }
                // {"mRender": function ( data, type, row ) {
                //         return '<a href=admin_view.php?viewId='+row.id+'><i class="far fa-eye icon"></i></a>';}
                // }
            ]
        });
    });
 

  
    </script>

</body>
</html>