<?php
//authorization

//provera da li je admin prijavljen

if (!isset($_SESSION['courier'])) //ako courier session nije setovan
{
    //admin nije prijavljen

    $_SESSION['no-login-msg'] = "<div class='error text-center'>Please login to access Courier Panel</div>";
    //redirect na login page sa porukom
    header('location:' . SITEURL . 'employees/login-cr.php');
}
