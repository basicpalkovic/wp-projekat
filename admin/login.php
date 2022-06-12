<?php include('../config/constants.php') ?>

<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="../adminstyle/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>

        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-msg']))
            {
                echo $_SESSION['no-login-msg'];
                unset($_SESSION['no-login-msg']);
            }
        
        ?>
        <br><br>

        <!-- Login forma-->

        <form action="" method="POST" class="text-center">
            Username: 
            <br>
            <input type="text" name="username" placeholder="Enter username">
            <br><br>
            Password:
            <br>
            <input type="password" name="password" placeholder="Enter password">
            <br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>

        <!-- Login forma END-->

        <p class="text-center">Created by: <strong>Sergej Bogovic</strong> & <strong>Luka Basic Palkovic</strong></p>
    </div>
</body>

</html>

<?php 

//provera da li je submit kliknut
if(isset($_POST['submit']))
{
    //Uzimanje podataka iz login forme
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    //Provera da li username i password postoje
    $sql ="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    //Execute query
    $res = mysqli_query($conn, $sql);

    // Count rows - provera da li admin postoji
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //admin postoji
        $_SESSION['login'] = "<div class='success'>Login Successfull</div>";
        $_SESSION['admin'] = $username; //provera da li je admin prijavljen

        //redirect na home page
        header('location:'.SITEURL.'admin/index.php');
    }
    else
    {
        //admin ne postoji
        $_SESSION['login'] = "<div class='error text-center'>Login not Successfull</div>";
        //redirect na home page
        header('location:'.SITEURL.'admin/login.php');
    }
}

?>