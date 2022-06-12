<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Old Password: </td>
                    <td>
                        <input type="password" name="old_password" placeholder="Input old password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" placeholder="Input new password"></td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Input new password again"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>


<?php

//provera da li je dugme kliknuto
if (isset($_POST['submit'])) {

    //1. Uzimanje podataka iz forme
    $id = $_POST['id'];
    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Provera da li ID i password postoje
    $sql = "SELECT * FROM tbl_courires WHERE id='$id' AND password='$old_password'";
    //Execute querry
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //admin postoji

            //3. provera da li su new password i confirm password isti
            if ($new_password == $confirm_password) {
                //update password
                $sql2 = "UPDATE tbl_courires SET
                password='$new_password'
                WHERE id=$id";

                //Execute query
                $res2 = mysqli_query($conn, $sql2);

                //provera da li je query executovan
                if ($res2 == true) {
                    //prikaz success poruke
                    $_SESSION['change-pwd'] = "<div class='success'>Password changed succesfully.</div>";
                    //redirect
                    header('location:' . SITEURL . 'admin/manage-courier.php');
                } else {
                    //redirect na manage-admin page sa errom porukom
                    $_SESSION['change-pwd'] = "<div class='error'>Password did NOT change. Try again.</div>";
                    //redirect
                    header('location:' . SITEURL . 'admin/manage-courier.php');
                }
            } else {
                //redirect na manage-admin page sa error porukom
                $_SESSION['pwd-not-match'] = "<div class='error'>Passwords did not match.</div>";
                //redirect
                header('location:' . SITEURL . 'admin/manage-courier.php');
            }
        } else {
            //admin ne postoji
            $_SESSION['admin-not-found'] = "<div class='error'>Courier not found.</div>";
            //redirect
            header('location:' . SITEURL . 'admin/manage-courier.php');
        }
    }



    //4. Promena passworda ako je prethodno sve tacno
}

?>


<?php include('partials/footer.php'); ?>