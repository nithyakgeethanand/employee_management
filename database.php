<?php 
 class Admin {

    
		private $servername = "localhost";
		private $username   = "root";
		private $password   = "";
		private $database   = "employee";
		public  $con;


		// Database Connection 
		public function __construct()
		{
		    $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
		    if(mysqli_connect_error()) {
			 trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
		    }else{
			return $this->con;
		    }
		}

        public function insertData($post)
        {
            // echo "hai";
            $username = $this->con->real_escape_string($_POST['username']);
            $first_name = $this->con->real_escape_string($_POST['first_name']);
            $last_name = $this->con->real_escape_string($_POST['last_name']);
            $email = $this->con->real_escape_string($_POST['email']);
            $role_id = $this->con->real_escape_string($_POST['role_id']);
            $created_at = $this->con->real_escape_string(date('Y-m-d'));
            $bytes = openssl_random_pseudo_bytes(2);
            $user_password = bin2hex($bytes);
            // $created = $_SESSION['USERNAME'];
            // $query="INSERT INTO users (username,first_name,last_name,email) VALUES('$username','$first_name','$last_name','$email' ) ";
            $query = "INSERT INTO admin (user_name,first_name,last_name,email,password,role_id,created_at) VALUES ('$username', '$first_name', '$last_name', '$email', '$user_password', '$role_id', '$created_at' )";
            $sql = $this->con->query($query);
            // if(!$sql) {
            //  echo("QUERY FAILED" . $this -> con -> error);
            // }
            if ($sql==true) {
                header("Location:./admin_view.php?msg1=insert");
            }else{
                echo "Registration failed try again " .mysqli_connect_error();
            }
        }

        public function updateData($postData)
        {
            $username = $this->con->real_escape_string($_POST['username']);
            $first_name = $this->con->real_escape_string($_POST['first_name']);
            $last_name = $this->con->real_escape_string($_POST['last_name']);
            $email = $this->con->real_escape_string($_POST['email']);
            $role_id = $this->con->real_escape_string($_POST['role_id']);
            $updated_at = $this->con->real_escape_string(date('Y-m-d'));
            $id = $this->con->real_escape_string($_POST['id']);
            // $updated = $_SESSION['USERNAME'];
            if (!empty($id) && !empty($postData)) {
            $query = "UPDATE admin SET user_name = '$username', first_name = '$first_name', last_name = '$last_name', email = '$email', role_id = '$role_id', updated_at = '$updated_at'  WHERE id = '$id' ";
            $sql = $this->con->query($query);
            // if(!$sql) {
            //  echo("QUERY FAILED" . $this -> con -> error);
            // }
            if ($sql==true) {
                header("Location:./admin_view.php?msg2=update");
            }else{
                echo "Registration updated failed try again!";
            }
            }
        }

        public function displayRecordById($id)
        {
            // $query = "SELECT * FROM users WHERE id = '$id'";
            $query = "SELECT * FROM admin INNER JOIN role ON admin.role_id = role.role_id  WHERE id = '$id' ";
            $result = $this->con->query($query);
            if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
            }else{
            echo "Record not found";
            }
        }

        public function deleteRecord($id)
		{
			$query = "UPDATE admin SET is_deleted = '1' WHERE id = '$id' ";
		    // $query = "DELETE FROM users WHERE id = '$id'";
		    $sql = $this->con->query($query);
		if ($sql==true) {
			header("Location:./admin_view.php?msg3=delete");
		}else{
			echo "Record does not delete try again";
		    }
		}

        public function login($posting) {
            session_start();
            $error = '';
            $email = $this->con->real_escape_string($_POST['email']);
            $password = $this->con->real_escape_string($_POST['password']);
            // $role_id = $this->con->real_escape_string($_POST['role_id']);
            $sql = "SELECT * FROM admin WHERE email = '$email' and password = '$password' ";
            $query = $this->con->query($sql);
            if ($query->num_rows > 0) {
                $row = $query->fetch_assoc();
                $_SESSION['ROLE'] = $row['role_id'];
                $_SESSION['IS_LOGIN'] = 'yes';
                // $_SESSION['USERNAME'] = $row['username'];
                if($row['role_id'] == 1) {
                    $_SESSION['email'] = $email;
                    // $_SESSION['USERNAME'] = $row['username'];
                    header("Location: admin_view.php");
                }
                // if($row['role_id'] == 2) {
                //  $_SESSION['email'] = $email;
                //  header("Location: view.php");
                // }
                else {
                    $error = 'Please use correct login';
                    // $_SESSION['Error'] = "You left one or more of the required fields.";
                }
            } 

        }

        public function insertNewEmployee($postNew)
        {
            // echo "hai";
            // $username = $this->con->real_escape_string($_POST['username']);
            $employeeid = $this->con->real_escape_string($_POST['employeeid']);
            $salutation = $this->con->real_escape_string($_POST['salutation']);
            $first_name = $this->con->real_escape_string($_POST['firstname']);
            $last_name = $this->con->real_escape_string($_POST['lastname']);
            $email = $this->con->real_escape_string($_POST['email']);
            $gender = $this->con->real_escape_string($_POST['gender']);
            $dateofjoining = $this->con->real_escape_string($_POST['dateofjoining']);
            //$resume = $this->con->real_escape_string($_POST['resume']);
            $country = $this->con->real_escape_string($_POST['country_id']);
            $state = $this->con->real_escape_string($_POST['state_id']);
            $city = $this->con->real_escape_string($_POST['city']);
            $pin = $this->con->real_escape_string($_POST['pincode']);
            $created_at = $this->con->real_escape_string(date('Y-m-d'));

            // $bytes = openssl_random_pseudo_bytes(2);
            // $user_password = bin2hex($bytes);
            // $created = $_SESSION['USERNAME'];
            // $query="INSERT INTO users (username,first_name,last_name,email) VALUES('$username','$first_name','$last_name','$email' ) ";
            $query = "INSERT INTO employee_details (employee_id,salutation,first_name,last_name,email,gender, joining_date,country_id,state_id,city,pin,created_at) VALUES ('$employeeid', '$salutation','$first_name' ,'$last_name', '$email', '$gender', '$dateofjoining',  '$country', '$state', '$city', '$pin', '$created_at' )";
            $sql = $this->con->query($query);
            // if(!$sql) {
            //  echo("QUERY FAILED" . $this -> con -> error);
            // }
            if ($sql==true) {
                header("Location:./admin.php?msg1=insert");
            }else{
                echo "Registration failed try again " .mysqli_connect_error();
            }
        }

        public function displayEmployeeRecordById($idNew)
        {
            // $query = "SELECT * FROM users WHERE id = '$id'";
            $query = "SELECT * FROM employee_details INNER JOIN state ON employee_details.state_id = state.states_id INNER JOIN country ON state.country_id = country.country_id WHERE id = $idNew ";
            // $query = "SELECT * FROM employee_details WHERE id = $idNew ";
            $result = $this->con->query($query);
            if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
            }else{
            echo "Record not found";
            }
        }

        public function updateDataEmployee($postDataNew)
        {
            $employeeid = $this->con->real_escape_string($_POST['employeeid']);
            $salutation = $this->con->real_escape_string($_POST['salutation']);
            $first_name = $this->con->real_escape_string($_POST['firstname']);
            $last_name = $this->con->real_escape_string($_POST['lastname']);
            $email = $this->con->real_escape_string($_POST['email']);
            $gender = $this->con->real_escape_string($_POST['gender']);
            $dateofjoining = $this->con->real_escape_string($_POST['dateofjoining']);
            //$resume = $this->con->real_escape_string($_POST['resume']);
            $country = $this->con->real_escape_string($_POST['country_id']);
            $state = $this->con->real_escape_string($_POST['state_id']);
            $city = $this->con->real_escape_string($_POST['city']);
            $pin = $this->con->real_escape_string($_POST['pincode']);
            // $created_at = $this->con->real_escape_string(date('Y-m-d'));
            $id = $this->con->real_escape_string($_POST['id']);

            // $updated = $_SESSION['USERNAME'];
            if (!empty($id) && !empty($postDataNew)) {
            $query = "UPDATE employee_details SET employee_id = '$employeeid', salutation = '$salutation', first_name = '$first_name', last_name = '$last_name', email = '$email', gender = '$gender', joining_date = '$dateofjoining', country_id = '$country', state_id = '$state', city = '$city', pin = '$pin'  WHERE id = '$id' ";
            $sql = $this->con->query($query);
            // if(!$sql) {
            //  echo("QUERY FAILED" . $this -> con -> error);
            // }
            if ($sql==true) {
                header("Location:./admin.php?msg2=update");
            }else{
                echo "Registration updated failed try again!";
            }
            // if(!$sql) {
			// 	echo("QUERY FAILED" . $this -> con -> error);
			// }
            }
        }

        public function deleteRecordOfEmployee($id)
		{
			$query = "UPDATE employee_details SET is_deleted = '1' WHERE id = '$id' ";
		    // $query = "DELETE FROM users WHERE id = '$id'";
		    $sql = $this->con->query($query);
		if ($sql==true) {
			header("Location:./admin.php?msg3=delete");
		}else{
			echo "Record does not delete try again";
		    }
		}

        function email_exists($post){
		
			$email = $this->con->real_escape_string($_POST['email']);
			$query = "SELECT email from admin WHERE email = '$email'";
			$sql = $this->con->query($query);;
		
			if ($sql->num_rows > 0) {
				return true;
			} else {
				return false;
			}
		}

        public function changeStatus($id)
        {
            $select = "select * from admin where id={$id}";
            $result = $this->con->query($select);
            $row = $result->fetch_assoc();
            $status = $row['is_activate'];
            if($status === 'activate')
            {
                $query = "update admin set is_activate ='deactivate' where id={$id}";
                $sql = $this->con->query($query);
                if ($sql==true) {
                    header("Location:./admin_view.php?msg4=active");
                }else{
                    echo "Status does not updated try again";
                }
            }
            else if($status === 'deactivate')
            {
                $query = "update admin set is_activate ='activate' where id={$id}";
                $sql = $this->con->query($query);
                if ($sql==true) {
                    header("Location:./admin_view.php?msg4=active");
                }else{
                    echo "Status does not updated try again";
                }
            }
        }

        function email_existsEmployee($post){
		
			$email = $this->con->real_escape_string($_POST['email']);
			$query = "SELECT email from employee_details WHERE email = '$email'";
			$sql = $this->con->query($query);;
		
			if ($sql->num_rows > 0) {
				return true;
			} else {
				return false;
			}
		}

        function employeeid_exists($post){
		
			$empid = $this->con->real_escape_string($_POST['employeeid']);
			$query = "SELECT employee_id from employee_details WHERE employee_id = '$empid'";
			$sql = $this->con->query($query);;
		
			if ($sql->num_rows > 0) {
				return true;
			} else {
				return false;
			}
		}

        public function displayData()
        {
            // $query = "SELECT * FROM users where is_deleted = '0' ";
            $query = "SELECT * FROM employee_details INNER JOIN state ON employee_details.state_id = state.states_id INNER JOIN country ON state.country_id = country.country_id  ";
            $result = $this->con->query($query);
            if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
            }else{
            echo "No found records";
            }
        }

        
    }
// if($name == $dbname && $pass == $dbpassword) { }

?>