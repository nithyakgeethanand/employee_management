<?php 

$con = mysqli_connect("localhost","root","","employee");
$result = mysqli_query($con, "SELECT * FROM admin INNER JOIN role ON admin.role_id = role.role_id WHERE is_deleted = 0 ");

// Add record into array

$rows = array();
while($row = mysqli_fetch_array($result)) {

    $rows[] = $row;
    // print_r($rows);
}
echo json_encode($rows);



?>