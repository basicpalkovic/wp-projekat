<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
<br>

<?php if(isset($_SESSION['add'])) //provera sessiona(da li je setovan)
            {
                echo $_SESSION['add'];//prikazivanje sessiono poruke
                unset($_SESSION['add']); //sklanjanje session poruke
            }
            
            
            ?>
            <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your full name"></td>                    
                </tr>
                <tr>
                <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>

                </tr>
            </table>
        </form>
    </div>
</div>

<?php  include('partials/footer.php'); ?>
<?php 

//Uzimanje podataka i cuvanje u bazi podataka
//Provera da li je dugme kliknuto

if(isset($_POST['submit']))
{
    //1. uzimanje podataka iz forme
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Encryption

    //2. SQL query koji salje podatke u bazu
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'";

    //3. Execute Query + cuvanje podataka u bazu
    
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. Provera da li su podaci uneti u bazu
    if($res==TRUE)
    {
        //podaci uneti
        //Varijabla za prikaz poruke
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        
        //Redirect stranica
        header("location:".SITEURL.'admin/manage-admin.php');
        
    }
    else{
        //podaci nisu uneti tacno/uopste
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin. Try again.</div>";
        
        //Redirect stranica
        header("location:".SITEURL.'admin/add-admin.php');
        
    }
    
}