<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php 
            
            //Prikaz svih kategorija koja su aktivna
            //sql query

            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

            //execute query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            //provera da li su kategorije dostupne
            if($count>0)
            {
                //kategorija je dostupna
                while($row=mysqli_fetch_assoc($res))
                {
                    //uzimanje svih vrednosti
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            
                            
                            if($image_name=="")
                            {
                                //slika nije dostupna
                                echo "<div class='error'>Image not found.</div>";
                            }
                            else
                            {
                                //slika je dostupna
                                ?>
                                <img src="<?php  echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve" height="300px">
                                <?php
                            }
                            
                            
                            ?>
                            

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
                    <?php 
                }
            }
            else
            {
                //kategorija nije dostupna
                echo "<div class='error'>Category not found.</div>";
            }
            
            
            ?>

            

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories END -->


    <?php include('partials-front/footer.php'); ?>