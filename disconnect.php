<?php 
include('common.php');
session_destroy();
header("Location:login.php");
die();
?>