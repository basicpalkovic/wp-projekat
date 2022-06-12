<?php

include('../config/constants.php');
//1. Unistiti session

session_destroy(); //unset $_SESSION['admin'];

//2. Redirect na login page
header('location:'.SITEURL.'admin/login.php');


?>