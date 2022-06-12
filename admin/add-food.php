<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>


        <?php 
        /*if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }   */
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="Price of food">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" >


                        <?php   
                        
                        //php kod za prikaz kategorija
                        //1. SQL za prikaz svih aktivnih kategorija
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        //execute query
                        $res = mysqli_query($conn, $sql);

                        //count rows - provera da li postoje kategorije ili ne
                        $count=mysqli_num_rows($res);

                        //ako je count > 0 imamo kategoriju, inace nemamo
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //uzimanje vrednosti kategorija
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <option value="0">No category found</option>
                            <?php

                        }


                        //2.prikaz preko dropdown-a
                        
                        ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        
        //provera da li je dugme kliknuto
        if(isset($_POST['submit']))
        {
            //dodavanje food-a u bazu
            //1. Uzimanje podataka iz forme
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //provera da li su radio dugmati checkovani ili ne za active i featured
            //featured
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else
            {
                //default vrednost
                $featured = "No";
            }
            //active
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                //default vrednost
                $active = "No";
            }
            //2. Upload slike ako je izabrana
            //provera da li je slika uplodovana, upload slike samo ako je izabrana
            if(isset($_FILES['image']['name']))
            {
                //uzimanje podataka od izabrane slike
                $image_name = $_FILES['image']['name'];

                if($image_name !="")
                {
                    //slika je izabrana
                    //a - promena imena slike
                    $ext = end(explode('.', $image_name));

                    //pravljenje novog imena
                    $image_name = "Food-Name-".rand(0000, 9999).".".$ext;  //PR: Food-Name-7136.$ext

                    //b - upload slike
                    // uzimanje source patha i destination patha

                    //source path je trenutna lokacija slike
                    $src = $_FILES['image']['tmp_name'];

                    //destination path je lokacija gde ce slika biti sacuvana
                    $dst = "../images/food/".$image_name;

                    //upload slike
                    $upload = move_uploaded_file($src, $dst);

                    //provera da li je slika uplodovana
                    if($upload==false)
                    {
                        //nije uspeo upload slike
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Food image.</div>";
                        //redirect sa porukom
                        header('location:'.SITEURL.'admin/add-food.php');

                        //stop rada
                        die();

                    }


                }
                
            }
            else
            {
                $image_name = ""; //slika nije izabrana - default vrednost
            }


            //3. Insert u bazu podataka
            //SQL query za cuvanje podataka hrane u bazu
            
            $sql2 = "INSERT INTO tbl_food SET
            title='$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            ";
            //execute query
            $res2 = mysqli_query($conn, $sql2);

            //provera da li su podaci uneti
            if($res2 == true)
            {
                //podaci uneti
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                //redirect sa porukom
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                //podaci nisu uneti
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                //redirect sa porukom
                header('location:'.SITEURL.'admin/manage-food.php');

            }
            
        }
        
        
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>