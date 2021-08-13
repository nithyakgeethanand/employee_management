<?php 
// include "db.php";
session_start();
if(!isset($_SESSION['IS_LOGIN'])) {
  
  header("Location: index.php");
}

include "database.php";

$userObj = new Admin();


if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
  $deleteId = $_GET['deleteId'];
  $userObj->deleteRecordOfEmployee($deleteId);
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
    <title>Employee Details</title>
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
                  <li class="nav-item"><a class="nav-link active" href="admin.php">view employee</a></li>
                  <!-- <li class="nav-item"><a class="nav-link" href="admin.php">Add admin</a></li> -->
                  <li class="nav-item"><a class="nav-link " href="admin_view.php">view admin</a></li>
                  <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
              </ul>
          </div>
      </nav>
     

<div style="align:right;">
     <!-- <button type="button" name="add" id="add" class="btn btn-info">Add</button> -->
    
    
    </div>
    <div class="row mt-3 mb-2">
   
    <div class="col-md-10">

      <form action="date_filter.php" method="post">
              <input type="date" name="datestart"  id="inputdate">

              <input type="date" name="dateends"  id="inputdate">

              <input type="submit" value="Sort" name="date" class="btn btn-danger btn-sm">
      </form>
    </div>
    <div class="col-md-2">
      <a class="btn btn-primary" href="add_employee.php">Add New Employee</a>
    </div>
    </div>
    <div class="container-fluid">
    <table id="customersTable" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>Employee ID</th>
                <th>Salutation</th>
                <th>First Name</th>
                <th>last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Joining Date</th>
                <th>City</th>
                <th>Pincode</th>
                <th>Edit</th>  
                <th>Delete</th> 
                <th>View</th> 

                            
            </tr>
           
        </thead>
     
         <tbody>

         </tbody>
    </table>
    
    
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js" charset="utf8" type="text/javascript"></script> -->

    <script type="text/javascript">
    $(document).ready(function() {
        $("#customersTable").DataTable({
            "ajax": {
                "url": "./db.php",
                "dataSrc": "",
            },
            "columns" : [
                // {"data":"id"},
                {"data":"employee_id"},
                {"data":"salutation"},
                {"data":"first_name"},
                {"data":"last_name"},
                {"data":"email"},
                {"data":"gender"},
                {"data":"joining_date"},
                {"data":"city"},
                {"data":"pin"},
                
                // {"mRender": function ( data, type, row ) {
                //         return '<a href=view.php?statusId='+row.id+'><i class="fas fa-exchange-alt icon"></i></a>';}
                // },
                {"mRender": function ( data, type, row ) {
                        // return '<a href=edit.php?editId='+row.id+'>Edit</a>';}
                        return ' <a class="text-success ml-5" href=edit_employee.php?editId='+row.id+'><i class="far fa-edit icon"></i></a> ';}
                },
                {"mRender": function ( data, type, row ) {
                        return '<a class="text-danger ml-3" href=admin.php?deleteId='+row.id+'><i class="far fa-trash-alt icon"></i></a> ';}
                },
                {"mRender": function ( data, type, row ) {
                        return '<a  class="text-info ml-3" href=single_emp_view.php?viewId='+row.id+'><i class="far fa-eye icon"></i></a>';}
                }
            ]
        });
    });
    // $(document).ready(function() {
    //     $('#customersTable').dataTable({
    //         "processing": true,
    //         "ajax": "db.php",
    //         "columns": [
    //             {data: 'id'},
    //             {data: 'employee_id'},
    //             {data: 'salutation'},
    //             {data: 'first_name'},
    //             {data: 'last_name'},
    //             {data: 'email'},
    //             {data: 'gender'},
    //             {data: 'joining_date'},
    //             {data: 'city'},
    //             {data: 'pin'},
    //             {"mRender": function ( data, type, row ) {
    //                     return '<a href=view.php?statusId='+row.id+'><i class="fas fa-exchange-alt icon"></i></a>';}
    //             },

    //             {"mRender": function ( data, type, row ) {
    //                     // return '<a href=edit.php?editId='+row.id+'>Edit</a>';}
    //                     return ' <a href=edit.php?editId='+row.id+'><i class="far fa-edit icon"></i></a> ';}
    //             }
    //             // {data : '<i class="fas fa-trash-alt"></i>'}
                
                
    //         ]
    //     });
    // });

    $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
   html += '<td contenteditable id="data5"></td>';
   html += '<td contenteditable id="data6"></td>';
   html += '<td contenteditable id="data7"></td>';
   html += '<td contenteditable id="data8"></td>';
   html += '<td contenteditable id="data9"></td>';
   html += '<td contenteditable id="data10"></td>';
   html += '<td contenteditable id="data11"></td>';
 
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
  $('#customersTable tbody').prepend(html);
  });
    </script>

</body>
</html>