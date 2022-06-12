<?php include('partials-front/menu.php'); ?>





<!-- fOOD sEARCH -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH END -->



<?php

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}



?>

<!-- CAtegories  -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>



        <?php

        //SQL query za prikazivanje kategorija iz baze podataka
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

        //execute query
        $res = mysqli_query($conn, $sql);

        //count rows za proveru da li tabela ima podataka
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //kategorije postoje
            while ($row = mysqli_fetch_assoc($res)) {
                //uzimanje vrednosti - title, image_name i id
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];

        ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //provera da li slika postoji ili ne
                        if ($image_name == "") {
                            //prikazi poruku ako slike nema
                            echo "<div class='error'>Image not available</div>";
                        } else {
                            //slika postoji
                        ?>
                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name ?>" alt="Pizza" class="img-responsive img-curve" height="500px">
                        <?php
                        }

                        ?>


                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            //kategorije ne postoje
            echo "<div class='error'>No categories currently available.</div>";
        }

        ?>





        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories END -->

<!-- fOOD MEnu  -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        //uzimanje podataka hrane iz baze podataka koji su activei featured
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

        //execute query
        $res2 = mysqli_query($conn, $sql2);

        //count rows
        $count2 = mysqli_num_rows($res2);

        //provera da li je hrana dostupna ili ne
        if ($count2 > 0) {
            //hrana dostupna
            while ($row2 = mysqli_fetch_assoc($res2)) {
                //uzimanje svih vrednosti
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php

                        //provera da li je slika dostupna ili ne
                        if ($image_name == "") {
                            //slika nije dostupna
                            echo "<div class='error'>No image added.</div>";
                        } else {
                            //slika je dostupna
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
            //hrana nije dostupna
            echo "<div class='error'>Food not available.</div>";
        }

        ?>





        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu END -->

<?php include('partials-front/footer.php'); ?>

<?php
