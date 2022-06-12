<?php include('partials-front/menu.php'); ?>
<link rel="stylesheet" href="css/style.css">
<div class="contact">
    <div class="text-center contact-text">
        <div class="col p-3">
            <h1>Register</h1>
            <form action="" method="post">
                <p>
                    <label for="registerUsername">Username</label>
                    <input type="text" class="form-control" id="registerUsername" placeholder="Enter username" name="username"><br><br>


                    <label for="registerFirstname">Firstname</label>
                    <input type="text" class="form-control" id="registerFirstname" placeholder="Enter firstname" name="firstname"><br><br>



                    <label for="registerLastname">Lastname</label>
                    <input type="text" class="form-control" id="registerLastname" placeholder="Enter lastname" name="lastname"><br><br>



                    <label for="registerEmail">E-mail address</label>
                    <input type="email" class="form-control" id="registerEmail" placeholder="Enter valid e-mail address" name="email"><br><br>



                    <label for="registerPassword">Password</label>
                    <input type="password" class="form-control" name="password" id="registerPassword" placeholder="Password (min 8 characters)"><br><br>



                    <label for="registerPasswordConfirm">Password confirm</label>
                    <input type="password" class="form-control" name="passwordConfirm" id="registerPasswordConfirm" placeholder="Password again"><br><br>


                    <input type="hidden" name="action" value="register">
                    <button type="submit" name="submit" class="btn btn-primary">Register</button><br><br>
                </p>
            </form>

        </div>
    </div>
</div>

<?php

//Uzimanje podataka i cuvanje u bazi podataka
//Provera da li je dugme kliknuto

if (isset($_POST['submit'])) {
    //1. uzimanje podataka iz forme
    if ($_POST['passwordConfirm'] == $_POST['password']) {
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = md5($_POST['password']); //Password Encryption

        //2. SQL query koji salje podatke u bazu
        $sql = "INSERT INTO tbl_customer SET
        username='$username',
        firstname='$firstname',
        lastname='$lastname',
        email='$email',
        password='$password'
        ";

        //3. Execute Query + cuvanje podataka u bazu

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4. Provera da li su podaci uneti u bazu
        if ($res == TRUE) {
            //podaci uneti
            //Varijabla za prikaz poruke
            $_SESSION['add'] = "<div class='success'>You Are Registered Successfully</div>";

            //Redirect stranica
            header("location:" . SITEURL . 'login.php');
        } else {
            //podaci nisu uneti tacno/uopste
            $_SESSION['add'] = "<div class='error'>Failed to Register. Try again.</div>";

            //Redirect stranica
            header("location:" . SITEURL . 'reg.php');
        }
    }
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>



<script src="js/script.js"></script>
<br><br>
<p>&emsp;&emsp; Return to <b><a href="login.php">LOGIN</a></b>.</p>