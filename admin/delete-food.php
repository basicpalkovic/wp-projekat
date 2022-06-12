<?php 
include('../config/constants.php');
//1. provera da li je vrednost setovana
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //brisanje
    //1. uzimanje ID i image_name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2. brisane slike ako postoji
    //provera da li slika postoji
    if($image_name!="")
    {
        //imamo sliku
        $path = "../images/food/".$image_name;

        //brisanje iz foldera
        $remove = unlink($path);

        //provera da li je slika izbrisana
        if($remove==false)
        {
            //slika se nije obrisala iz foldera
            $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
            //redirect sa porukom
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
    }
    

    //3. brisanje iz baze podataka
    $sql = "DELETE FROM tbl_food WHERE id='$id'";
    //execute query
    $res = mysqli_query($conn, $sql);

    //provera da li je query executovan
    if($res==true)
    {
        //food obrisan
        $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //food nije obrisan
        $_SESSION['delete'] = "<div class='error'>Failed to delete food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

    
}
else
{
    //redirect na manage-food
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}




?>