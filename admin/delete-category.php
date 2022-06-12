<?php
include('../config/constants.php');
//provera da li su id i image_name setovani
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //uzimanje vrednosti i brisane
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //brisane image fajla ako postoji
    if($image_name!="")
    {
        //slika postoji - brisanje slike
        $path = "../images/category/".$image_name;
        //brisanje slike
        $remove = unlink($path);


        //ako ne uspe da obrise sliku, prikazati error poruku i zaustaviti proces
        if($remove==false)
        {
            //session poruka
            $_SESSION['remove'] = "<div class='error'>Failed to Remove Category image.</div>";
            //redirect na manage-category page
            header('location:'.SITEURL.'admin/manage-category.php');
            //zaustavljanje procesa
            die();
        }
    }

    //brisane podataka iz baze
    //query za brisane podatka
    $sql = "DELETE FROM tbl_category WHERE id='$id'";

    //execute query
    $res=mysqli_query($conn, $sql);

    //provera da li su podaci obrisani
    if($res==true)
    {
        //posalji success poruku i redirect
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        //redirect na manage-category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        //posalji error poruku i redirect
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
        //redirect na manage-category
        header('location:'.SITEURL.'admin/manage-category.php');
    }

    


}
else
{
    //redirect na manage-category page
    header('location:'.SITEURL.'admin/manage-category.php');
}

?>