<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "employee");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM admin INNER JOIN role ON admin.role_id = role.role_id WHERE is_deleted = 0 ";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Username</th>  
                         <th>First Name</th>  
                         <th>Last Name</th>  
                         <th>Email</th>
                         <th>Role</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
          <td>'.$row["user_name"].'</td>  
          <td>'.$row["first_name"].'</td>  
          <td>'.$row["last_name"].'</td>  
          <td>'.$row["email"].'</td>  
          <td>'.$row["role_name"].'</td>
     </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>