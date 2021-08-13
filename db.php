<?php 

$con = mysqli_connect("localhost","root","","employee");
$result = mysqli_query($con, "SELECT * FROM employee_details WHERE is_deleted=0 ");

// Add record into array

$rows = array();
while($row = mysqli_fetch_array($result)) {

    $rows[] = $row;
    // print_r($rows);
}
echo json_encode($rows);


// $HOST = "localhost";
// $USER = "root";
// $PASSWORD = "";
// $DBNAME = "employee";


// $connection = mysqli_connect($HOST,$USER,$PASSWORD,$DBNAME);

// if($connection) {
    // echo "we are connected";
// }

// fetch records
// $sql = "select * from employee_details";
// $result = mysqli_query($connection, $sql);

// while($row = mysqli_fetch_assoc($result)) {
//     $array[] = $row;
// }

// $dataset = array(
//     "echo" => 1,
//     "totalrecords" => count($array),
//     "totaldisplayrecords" => count($array),
//     "data" => $array
// );


// echo json_encode($array);

?>