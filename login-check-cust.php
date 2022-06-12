<?php
//authorization
include("partials-front/menu.php");
//provera da li je customer prijavljen

if (!isset($_SESSION['customer'])) //ako customer session nije setovan
{
    //customer nije prijavljen

    $_SESSION['no-login-msg'] = "<div class='error text-center'>Please login to order from our website</div>";
    //redirect na login page sa porukom
    header('location:' . SITEURL . 'login.php');
}
