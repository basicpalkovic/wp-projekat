<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br><br>

        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        

        ?>
        <br><br>

        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <!-- <th>Description</th>-->
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>

            </tr>

            <?php


            //SQL query za prikaz svih informacija
            $sql = "SELECT * FROM tbl_food";

            //execute query

            $res = mysqli_query($conn, $sql);

            //count rows - da li postoje podaci
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {
                //ima hrane u bazi
                //uzimanje podataka iz baze i prikazivanje

                while ($row = mysqli_fetch_assoc($res)) {
                    //individualni podaci iz kolona
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    //$description = $row['description'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>
                        <td>
                            <?php

                            //provera da li slika postoji ili ne
                            if ($image_name == "") {
                                //nemamo sliku - error poruka
                                echo "<div class='error'>No image Found</div>";
                            } else {
                                //imamo sliku
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="150px" alt="food-pic">
                            <?php
                            }

                            ?>
                        </td>
                        <!--<td><?php //echo $description; ?></td>-->
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                //nema hrane u bazi
                echo "<tr><td colspan='7' class='error'>Food not Added Yet! </td></tr>";
            }

            ?>


        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>