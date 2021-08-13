
<?php

session_start(); 

include "database.php";

$userObj = new Admin();

?>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> 



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




<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  

<?php
if(isset($_POST['date'])) {
    
    // echo $start = $_POST['datestart'];
    // echo $end = $_POST['dateend'];

    $start = date("Y-m-d", strtotime($_POST['datestart']));
    $end = date("Y-m-d", strtotime($_POST['dateends']));


    $connection = mysqli_connect('localhost', 'root', '', 'employee');
    $query = "SELECT * FROM employee_details WHERE joining_date BETWEEN '$start 00:00:00' AND '$end 23:59:59' ";
    $result = mysqli_query($connection, $query);

}

?>


<div class="container-fluid">  
    <h3 class="card-header bg-success text-white">EMPLOYEE VIEWS</h3>  
    <br />  
    <div class="table-responsive">  
         <table id="employee_data" class="table table-bordered">  
              <thead>  
                   <tr>  
                        <th>ID</th>  
                        <!-- <th>EMP ID</th>   -->
                        <th>SALUTATION</th>  
                        <th>FIRST NAME</th>  
                        <th>LAST NAME</th>  
                        <th>EMAIL</th>  
                        <th>GENDER</th>  
                        <!-- <th>COUNTRY</th>   -->
                        <!-- <th>STATE</th>   -->
                        <!-- <th>CITY</th>   -->
                        <!-- <th>PINCODE</th>   -->
                        <th>DATE OF JOINING</th> 
                        <!-- <th>VIEW</th>   -->
                   </tr>  
              </thead>  
              <?php  
              while($row = mysqli_fetch_array($result))  
              {  
               $the_id = $row["id"];  
            //    $emp_id = $row["emp_id"];  
               $salutation = $row["salutation"];  
               $first_name = $row["first_name"];  
               $last_name = $row["last_name"];  
               $email = $row["email"];  
               $gender = $row["gender"];
            //    $country = $row["country"];
            //    $state = $row["state"];
            //    $city = $row["city"];
            //    $pincode = $row["pincode"];
            //    $is_deleted = $row["is_deleted"];
               $joining_date = $row["joining_date"];
               
               echo "<tr>";
               echo "<td>{$the_id}</td>";
            //    echo "<td>{$emp_id}</td>";
               echo "<td>{$salutation}</td>";
               echo "<td>{$first_name}</td>";
               echo "<td>{$last_name}</td>";
               echo "<td>{$email}</td>";
               echo "<td>{$gender}</td>";
            //    echo "<td>{$country}</td>";
            //    echo "<td>{$state}</td>";
            //    echo "<td>{$city}</td>";
            //    echo "<td>{$pincode}</td>";
               echo "<td>{$joining_date}</td>";
            //    echo "<td>{$is_deleted}</td>";
            //    echo "<td><a href='audit_view_employee.php?edit=$the_id'>view</a></td>";
               echo "</tr>";


              }  
              ?>  
         </table><br>
         <!-- <input type="button" class="btn btn-success" id="btnExport" value="Export" /> -->
         <a href="admin.php" class="btn btn-dark">Go Back</a>
    </div>  
</div> 
<script>
    // pdf
 $("body").on("click", "#btnExport", function () {
      html2canvas($('#exportsheet')[0], {
          onrendered: function (canvas) {
              var data = canvas.toDataURL();
              var docDefinition = {
                  content: [{
                      image: data,
                      width: 500
                  }]
              };
              pdfMake.createPdf(docDefinition).download("user-details.pdf");
          }
      });
});
</script>
