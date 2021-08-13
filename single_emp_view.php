<?php

session_start();
if(!isset($_SESSION['IS_LOGIN'])) {
  
  header("Location: index.php");
}

include "database.php";

$userObj = new Admin();

if(isset($_GET['viewId']) && !empty($_GET['viewId'])) {
    $viewId = $_GET['viewId'];
    $customer = $userObj->displayEmployeeRecordById($viewId);
  }
  
  $userObj->displayData();

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



<div class="container mt-2" >
    <div class="row" id="exportsheet">
        <div class="card" style="width:100%">
        <div class="card-header bg-success text-white"><h4><b>User Details</b></h4></div>
        <div class="card-body">
        <p class="card-text">
        <div class="row">
                <div class="col-md-3">Employee_id:</div>
                <div class="col-md-6"><?php echo $customer['employee_id']; ?></div>
            </div><br>
            <div class="row">
                <div class="col-md-3">Salutation: </div>
                <div class="col-md-6"><?php echo $customer['salutation']; ?></div>
            </div><br>
            <div class="row">
                <div class="col-md-3">Name: </div>
                <div class="col-md-6"><?php echo $customer['first_name'].' '.$customer['last_name']; ?></div>
            </div><br>
            <div class="row">
                <div class="col-md-3">email:</div>
                <div class="col-md-6"><?php echo $customer['email']; ?></div>
            </div><br>
            <div class="row">
                <div class="col-md-3">Country</div>
                <div class="col-md-6"><?php echo $customer['country_name']; ?></div>
            </div><br>
            <div class="row">
                <div class="col-md-3">State</div>
                <div class="col-md-6"><?php echo $customer['state_name']; ?></div>
            </div><br>
            <div class="row">
                <div class="col-md-3">Pincode:</div>
                <div class="col-md-6"><?php echo $customer['pin']; ?></div>
            </div><br>
        </p>
        </div>
        </div>
    </div><br>
        <div class="row">
            <div class="col-10">
            <input type="button" id="btnExport" class="btn btn-danger" value="Generate PDF">
            <a href="admin.php" class="btn btn-primary">Back to Home</a>
            </div>
            <div class="col-2">

            <?php 
        $connection = mysqli_connect("localhost","root","","employee");
        $checkForPrevId = "SELECT * FROM employee_details WHERE id < $viewId ORDER BY id DESC ";
        $prev = mysqli_query($connection, $checkForPrevId);

        if($row = mysqli_fetch_array($prev)){
            $id = $row['id'];
            echo "<a href='single_emp_view.php?viewId={$id}' class='btn btn-success mr-2'>Previous</a>";
        }
        $checkForNextId = "SELECT * FROM employee_details WHERE id > $viewId ORDER BY id ASC ";
        $next = mysqli_query($connection,$checkForNextId);

        if($row = mysqli_fetch_array($next)){
            $id = $row['id'];
            echo "<a href='single_emp_view.php?viewId={$id}' class='btn btn-success' >Next</a>";
        }
       
        else{
            echo "";
        }
    

        ?>
            </div>
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
