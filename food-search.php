<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH -->
<section class="food-search text-center">
    <div class="container">

        <?php
        //uzimanje search vrednosti
        $search = mysqli_real_escape_string($conn, $_POST['search']);





        ?>

        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH END-->



<!-- fOOD MEnu -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php




        //sql query za dobijanje hrane na osnovu searcha
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

        //execute query
        $res = mysqli_query($conn, $sql);

        //count rows
        $count = mysqli_num_rows($res);

        //provera da li je hrana dostupna
        if ($count > 0) {
            //hrana je dostupna
            while ($row = mysqli_fetch_assoc($res)) {
                //uzimanje podataka 
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">

                        <?php

                        //provera da li je slika ubacena
                        if ($image_name == "") {
                            //slika nije dostupna
                            echo "<div class='error'>Image not available.</div>";
                        } else {
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

                        <?php
                        if (isset($_SESSION['customer'])) { ?>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        <?php } ?>
                    </div>
                </div>

        <?php
            }
        } else {

            //nije dostupna
            echo "<div class='error'>Food not found</div>";
        }

        ?>




        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu END -->

<?php include('partials-front/footer.php'); ?>