<?php include('partials-front/menu.php'); ?>

<link rel="stylesheet" href="css/style.css">
<div class="contact">
    <div class="text-center contact-text">
        <div class="text-center contact-text">
            <h1>Login</h1><?php
                            if (isset($_SESSION['login'])) {
                                echo $_SESSION['login'];
                                unset($_SESSION['login']);
                            }
                            if (isset($_SESSION['no-login-msg'])) {
                                echo $_SESSION['no-login-msg'];
                                unset($_SESSION['no-login-msg']);
                            }

                            ?>
            <form action="" method="POST" class="text-center">
                <p>
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

            <br><br><b><a href="#" id="fl">Forgot your password?</a></b><br><br>
            <form action="forgotten.php" method="post" name="forget" id="forget" style="display:none">
                <div class="form-group">
                    <label for="forgetEmail">E-mail</label>
                    <input type="email" class="form-control" id="forgetEmail" placeholder="Enter your e-mail address" name="email">
                </div>
                <input type="hidden" name="action" value="forget">
                <button type="submit" class="btn btn-primary">Reset password</button>
                </p>
            </form>



        </div>

    </div>
</div>

<?php




//provera da li je submit kliknut
if (isset($_POST['submit'])) {
    //Uzimanje podataka iz login forme
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));


    //Provera da li username i password postoje
    $sql = "SELECT * FROM tbl_customer WHERE username='$username' AND password='$password'";
    //Execute query
    $res = mysqli_query($conn, $sql);

    // Count rows - provera da li admin postoji
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //admin postoji
        while ($row = mysqli_fetch_assoc($res)) {
            $banned = $row['banned'];
        }

        if ($banned == 0) {
            $_SESSION['customer'] = $username; //provera da li je admin prijavljen
            $_SESSION['login'] = "<div class='success'>Login Successfull, Welcome back, " . $_SESSION['customer'] . " </div>";

            //redirect na home page
            header('location:' . SITEURL . 'index.php');



            $_SESSION['customer'] = $username; //provera da li je admin prijavljen
            $_SESSION['login'] = "<div class='success'>Login Successfull, Welcome back, " . $_SESSION['customer'] . " </div>";

            //redirect na home page
            header('location:' . SITEURL . 'index.php');
        } else {
            //customer ne postoji
            $_SESSION['login'] = "<div class='error text-center'>Login not Successfull</div>";
            //redirect na home page
            header('location:' . SITEURL . 'login.php');
        }
    }
}


?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>



<script src="js/script.js"></script>
<hr>
<br><br>
<p>&emsp;&emsp; Do not have an account yet? Then <b><a href="reg.php">REGISTER NOW</a></b>!!!</p>