<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
        //1. Uzimanje ID-ja od izabranog admina
        $id = $_GET['id'];

        //2. Pravljenje SQL query-ja za pribavaljanje detalja admina
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //Execute query
        $res = mysqli_query($conn, $sql);

        //provera da li je query executovan
        if ($res == true) {
            //provera da li je podatak prisutan
            $count = mysqli_num_rows($res);
            //provera da li podaci o adminu postoje
            if ($count == 1) {
                //dobijanje podataka
                //echo 'Admin je u sistemu.';
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                //redirect na Manage Admin page
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }
        ?>


        <form action="" method="POST">
            <table class="tbl-30">

                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>


<?php

//provera da li je submit dugme kliknuto
if (isset($_POST['submit'])) {
    //echo "Button clicked.";
    //uzimanje svih vrednosti iz forme za update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //SQL query za update admina
    $sql = "UPDATE tbl_admin SET
     full_name='$full_name',
     username='$username'
     WHERE id='$id'";

    //Execute query
    $res = mysqli_query($conn, $sql);

    //Provera da li je query executovan
    if ($res == true) {
        //admin je uspesno updateovan
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
        //redirect na manage admin page
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        //admin nije updateovan
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin. Try again.</div>";
        //redirect na manage admin page
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}

?>
<?php include('partials/footer.php'); ?>