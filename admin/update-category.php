<?php include('partials/menu.php');  ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

    <?php  
    
    //provera da li je id setovan
    if(isset($_GET['id']))
    {
        //uzimanje id i ostalih vrednosti
        $id=$_GET['id'];
        //sql query za ostale vrednosti
        $sql = "SELECT * FROM tbl_category WHERE id=$id";

        //execute query
        $res=mysqli_query($conn, $sql);

        //count rows za proveru da li id postoji
        $count=mysqli_num_rows($res);
        //broj 1 je zato sto postoji samo 1 takav ID
        if($count==1)
        {
            //uzimanje podataka
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured=$row['featured'];
            $active = $row['active'];
        }
        else
        {
            //redirect na manage-category sa porukom
            $_SESSION['no-catg-found'] = "<div class='error'>Category not Found.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        //redirect na manage-category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    
    
    ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title  ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                    <?php    
                    
                    if($current_image != "")
                    {
                        //prikaz slike
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php  echo $current_image ?>" width="150px">
                        <?php
                    }
                    else
                    {
                        //prikaz poruke
                        echo "<div class='error'>Image not Added</div>";
                    }
                    ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}; ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        //da li je submit kliknut
        if(isset($_POST['submit']))
        {
            //1. uzimanje vrednosti iz forme
            $id=$_POST['id'];
            $title=$_POST['title'];
            $current_image=$_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. update nove slike ako je selektovana
            //provera da li je slika selektovana
            if(isset($_FILES['image']['name']))
            {
                //uzimanje detalja slike
                $image_name = $_FILES['image']['name'];

                //provera da li je slika izabrana
                if($image_name !="")
                {
                    //slika je izabrana
                    //upload nove slike

                    //auto rename za slike
                //uzimanje extensiona od slike(jpg, png, gif, etc.) "food1.jpg"
                $ext = end(explode('.', $image_name));

                //rename slike
                $image_name="food_category_".rand(000, 999).'.'.$ext;//PR: food_category_813.jpg


                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/category/".$image_name;

                //konacan upload slike
                $upload=move_uploaded_file($source_path, $destination_path);

                //provera da li je slika uplodovana
                //ako nije, onda se proces stopira i vrsi se redirect sa error porukom
                if($upload==false)
                {
                    $_SESSION['upload']="<div class='error'>Failed to upload image. </div>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-category.php');
                    //stop rada
                    die();
                }

                    //brisanje stare slike ako postoji
                    if($current_image!=""){
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);

                    //provera da li je slika obrisana
                    //ako ne uspe da izbrise, prikazi poruku i zaustavi rad

                    if($remove==false)
                    {
                        //nije uspelo da obrise sliku
                        $_SESSION['failed-rem'] = "<div class='error'>Failed to Remove Current Image.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        die();//stop rada
                    }
                    }
                }
                else{
                    $image_name = $current_image;
                }
            }
            else
            {
                $image_name = $current_image;
            }
            //3. update u bazi podataka
            $sql2 = "UPDATE tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                WHERE id='$id'
                ";

                //execute query
                $res2=mysqli_query($conn, $sql2);

            //4. redirect na manage-category page
            //provera da li je query executovan
            if($res2==true)
            {
                //kategorija updateovana
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                //redirect sa porukom
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else{
                //nije updateovana
                $_SESSION['update'] = "<div class='error'>Failed to update Category.</div>";
               //redirect sa porukom
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        }
        
        
        ?>
    </div>
</div>

<?php include('partials/footer.php');  ?>