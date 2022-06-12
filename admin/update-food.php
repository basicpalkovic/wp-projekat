<?php include('partials/menu.php'); ?>

<?php

//provera da li je id setovan
if (isset($_GET['id'])) {
    //uzimanje svih podataka
    $id = $_GET['id'];

    //sql query za uzimanje podataka
    $sql2 = "SELECT * FROM tbl_food WHERE id='$id'";

    //execute query
    $res2 = mysqli_query($conn, $sql2);

    //uzimanje podataka na osnovu query-ja
    $row2 = mysqli_fetch_assoc($res2);

    //uzimanje individualnih podataka hrane
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    //redirect na manage-food
    header('location:' . SITEURL . 'admin/manage-food.php');
}



?>



<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="25" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php

                        if ($current_image == "") {
                            //nema slike
                            echo "<div class='error'>Image not Added.</div>";
                        } else {
                            //slika postoji
                        ?>
                            <img src="<?php echo SITEURL ?>images/food/<?php echo $current_image ?>" alt="<?php echo $title ?>" width="150px">
                        <?php
                        }


                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select new image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php

                            //sql query za proveravanje active stanja
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //execute query
                            $res = mysqli_query($conn, $sql);

                            //count rows - provera da li ima ovakvih podataka
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                //kategorije postoje
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    //echo "<option value='$category_id'>$category_title</option>";
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                                }
                            } else {
                                //kategorije ne postoje
                                echo "<option value='0'>Category Not available</option>";
                            }


                            ?>


                            <option value="0">test category</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo 'checked';
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {
                                    echo 'checked';
                                } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo 'checked';
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                                    echo 'checked';
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">


                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>


        <?php

        if (isset($_POST['submit'])) {
            //echo "dugme kliknuto";

            //1. Uzimanje svih podataka iz forme
            $id = $_GET['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. Upload slike ako je izabrana
            //provera da li je upload dugme kliknuto ili ne
            if (isset($_FILES['image']['name'])) {
                //upload dugme stisnuto
                $image_name = $_FILES['image']['name'];

                //provera da li su fajlovi dostupni
                if ($image_name != "") {
                    //slika je dostupna
                    //A. Upload nove slike

                    //rename slike
                    $ext = end(explode('.', $image_name)); //uzima extension slike

                    $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext; //rename slike

                    //uzimanje src_path i dest_path
                    $src_path = $_FILES['image']['tmp_name']; //src path
                    $dest_path = "../images/food/" . $image_name; //dest path

                    $upload = move_uploaded_file($src_path, $dest_path);

                    //provera da li je slika uplodovana ili ne
                    if ($upload == false) {
                        //nije uspeo upload
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image.</div>";
                        //redirect na manage-food
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        //stop rada
                        die();
                    }
                    //3. Brisanje slike ako je nova slika uplodovana i trenutna slika postoji
                    //B. brisanje trenutne slike ako je dostupna
                    if ($current_image != "") {
                        //trenutna slika je dostupna
                        //brisanje slike
                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);

                        //provera da li je slika obrisana ili ne
                        if ($remove == false) {
                            //nije uspelo brisanje trenutne slike
                            $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                            //redirect na manage-food
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            //stop rada
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }




            $sql3 = "UPDATE tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE id='$id'
            ";


            //execute sql query
            $res3 = mysqli_query($conn, $sql3);

            //provera da li je query executovan ili ne
            if ($res3 == true) {
                //query executovan
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //nije uspesan update
                $_SESSION['update'] = "<div class='error'>Failed to Update food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }



        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>