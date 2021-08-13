<?php
$country = $_GET['country'];
if($country!="") {
    $connection = mysqli_connect("localhost","root", "",'employee');
    $query_states = "SELECT * FROM state WHERE country_id = $country ";  
    $res = mysqli_query($connection, $query_states);
    echo "<select name='state_id'class='form-control'>";
    while($row = mysqli_fetch_array($res)) {
        $state_id = $row['states_id'];
        $state = $row['state_name'];

        echo "<option value='$state_id'>$state</option>";
    }
    echo "</select>";
}
?>