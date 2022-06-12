<?php include("partials/menu.php");

$id = $_GET['id'];

$sql = "UPDATE tbl_customer SET
banned=1 
WHERE id_user=$id";

$res = mysqli_query($conn, $sql);

if ($res == true) {
    //admin obrisan

    //Pravljenje session varijable da prikaze poruku
    $_SESSION['delete'] = "<div class='success'>Customer banned Succesfully.</div>";

    //redirect na admin stranicu
    header('location:' . SITEURL . 'admin/manage-customer.php');
} else {
    //customer nije banovan


    //Pravljenje session varijable da prikaze poruku
    $_SESSION['delete'] = "<div class='error'>Failed to ban customer. Try Again.</div>";
    //redirect na admin stranicu
    header('location:' . SITEURL . 'admin/manage-customer.php');
}
