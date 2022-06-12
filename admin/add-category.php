<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        
        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        
        ?>

        <!-- Forma za dodavanje kategorija -->

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


        <!-- Forma za dodavanje kategorija END -->
        <?php   
        
        //provera da li je submit kliknut
        if(isset($_POST['submit']))
        {
            //Uzimanje vrednosti iz forme
            $title=$_POST['title'];

            //za radio input, provera da li su stiklirani
            if(isset($_POST['featured']))
            {
                //uzimanje vrednosti iz forme
                $featured=$_POST['featured'];
            }
            else
            {
                //set default vrednost
                $featured="No";
            }
            if(isset($_POST['active']))
            {
                //uzimanje vrednosti iz forme
                $active=$_POST['active'];
            }
            else
            {
                //set default vrednost
                $active="No";
            }

            //Provera da li je slika izabrana
            if(isset($_FILES['image']['name']))
            {
                //upload slike
                //uzimanje imena slike, izvor i destinaciju
                $image_name=$_FILES['image']['name'];

                //Upload slike samo ako je slika izabrana
                if($image_name != "")
                {

                

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
                    header('location:'.SITEURL.'admin/add-category.php');
                    //stop procesa
                    die();
                }
            }
        }
            else
            {
                //nemoj upload sliku + image_name = blank
                $image_name="";
            }


            //Pravljenje SQL query-ja da se insertuju kategorije u bazu
            $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            //Execute query
            $res=mysqli_query($conn, $sql);

            //provera da li je query executovan 
            if($res==true)
            {
                //query je executovan i kategorija je dodata
                $_SESSION['add'] = "<div class='success'>Category Added successfully</div>'";
                //redirect na category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                //query nije executovan
                $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>'";
                //redirect na category page
                header('location:'.SITEURL.'admin/add-category.php');

            }
        }
        
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>