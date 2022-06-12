<?php 
    //authorization
    
    //provera da li je admin prijavljen

    if(!isset($_SESSION['admin'])) //ako admin session nije setovan
    {
        //admin nije prijavljen
        
        $_SESSION['no-login-msg'] = "<div class='error text-center'>Please login to access Admin Panel</div>";
        //redirect na login page sa porukom
        header('location:'.SITEURL.'admin/login.php');
    }
 

?>