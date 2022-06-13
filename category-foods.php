<?php include('partials-front/menu.php'); ?>



<?php

//provera da li je id primljen
if (isset($_GET['category_id'])) {
    //category_id je setovan, uzimanje tog id-a
    $category_id = $_GET['category_id'];

    //uzimanje category title na osnovu category id-a
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

    //execute query
    $res = mysqli_query($conn, $sql);

    //uzimanje vrednosti iz baze
    $row = mysqli_fetch_assoc($res);

    //uzimanje title-a
    $category_title = $row['title'];
} else {
    //category_id nije setovan
    //redirect na index.php
    header('location:' . SITEURL);
}

?>

<!-- fOOD  -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>
</section>
<!-- fOOD END -->



<!-- fOOD MEnu -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php

        //sql query za uzimanje hrane na osnovu selektovane kategorije
        $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";

        //execute query
        $res2 = mysqli_query($conn, $sql2);

        //count rows
        $count2 = mysqli_num_rows($res2);

        //provera da li je hrana dostupna
        if ($count2 > 0) {

            //hrana je dostupna
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];


        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">


                        <?php

                        if ($image_name == "") {
                            //slika nije dostupna
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                            //sliak je dostupna

                        ?>

                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="food pic" class="img-responsive img-curve">
                        <?php
                        }

                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>


                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>

                    </div>
                </div>

        <?php
            }
        } else {
            //hrana nije dostupna
            echo "<div class='error'>Food not available.</div>";
        }


        ?>






        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu END-->

<?php include('partials-front/footer.php'); ?>