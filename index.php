<?php 

 include "database.php";

 $userObj = new Admin();

 if(isset($_POST['login'])){
     $userObj->login($_POST);
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Employee Managment System</title>
</head>
<body>
    <div class="container">
        <nav class="header mt-2">
            <h1 class="text-primary">Employee Management System</h1>
        </nav>
        
    <div>
        <br>
       
       

        <!--Login -->
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <img class="img-responsive" src="images/index.jpg" alt="image" style="max-width:110%;">
                </div>


                <div class="well text-center col-sm mt-5" >
                <h4 class="text-primary">Login</h4> <br>
                <form action="index.php" method="post" class="form-group" id="login-form">
                <div class="form-group mx-sm-5 mb-2">
                    <!-- <div class="col-xs-2"> -->
                    <input name="email" type="text" class="form-control" placeholder="Enter Email"><br>
                    <!-- </div> -->
                </div>

                <div class="form-group mx-sm-5 mb-2">
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    <!-- <span class="input-group-btn"> -->
                    <br><button class="btn btn-primary" name="login" type="submit">Submit
                    </button><br>
                    <br><a href="#">Forgot Password</a>
                    <!-- </span> -->
                </div>

                </form><!--search form-->
                <!-- /.input-group -->
                </div>
                </div>
            </div>
        </div>

     
    
      
</body>
</html>