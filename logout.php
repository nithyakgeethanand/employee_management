<?php
session_start();

// unset($_SESSION['ROLE']);
// unset($_SESSION['IS_LOGIN']);


$_SESSION['ROLE'] = null;
$_SESSION['IS_LOGIN'] = null;
$_SESSION['email'] = null;
$_SESSION['USERNAME'] = null;
// $_SESSION['user_role'] = null;

header("Location: index.php ");

?>