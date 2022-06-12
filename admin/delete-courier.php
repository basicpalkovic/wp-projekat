<?php

include('../config/constants.php');


//1. Uzimanje ID-admina koji ce se brisati
$id = $_GET['id'];

//2. Pravljenje SQL query-ja za brisanje admina
$sql = "DELETE FROM tbl_courires WHERE id=$id";

//Execute query
$res = mysqli_query($conn, $sql);


//3. Redirect stranica - prikaz da li je admin izbrisan
//Provera da li je query executovan
if ($res == true) {
    //admin obrisan

    //Pravljenje session varijable da prikaze poruku
    $_SESSION['delete'] = "<div class='success'>Courier Deleted Succesfully.</div>";

    //redirect na admin stranicu
    header('location:' . SITEURL . 'admin/manage-courier.php');
} else {
    //admin se nije obrisao
    //echo 'Failed to delete Admin';

    //Pravljenje session varijable da prikaze poruku
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Courier. Try Again.</div>";
    //redirect na admin stranicu
    header('location:' . SITEURL . 'admin/manage-courier.php');
}
