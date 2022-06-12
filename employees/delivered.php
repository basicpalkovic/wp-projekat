<?php
require "../config/constants.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "SELECT * FROM tbl_order WHERE id='$id'";


    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $status = $row['status'];
    } else {
        header('location:' . SITEURL . 'employees/index.php');
    }
} else {
    header('location:' . SITEURL . 'employees/index.php');
}



if (isset($_POST['submit'])) {

    $status = $_POST['status'];

    $sql2 = "UPDATE tbl_order SET
status = 'Delivered' WHERE id = $id";

    $res2 = mysqli_query($conn, $sql2);

    //provera da li su podaci azurirani
    if ($res2 == true) {
        //uspesno
        $_SESSION['delivered'] = "<div class='success'>Delivered Successfully.</div>";
        //redirect
        header('location:' . SITEURL . 'employees/index.php');
    } else {
        //neuspesno
        $_SESSION['delivered'] = "<div class='error'>Failed to Deliver.</div>";
        //redirect
        header('location:' . SITEURL . 'employees/index.php');
    }

    //redirect sa porukom
}
