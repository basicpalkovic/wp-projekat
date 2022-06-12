<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>


        <?php
        
        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-catg-found']))
        {
            echo $_SESSION['no-catg-found'];
            unset($_SESSION['no-catg-found']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-rem']))
        {
            echo $_SESSION['failed-rem'];
            unset($_SESSION['failed-rem']);
        }

        
        
        ?>
        <br><br>
            <!--Button za pravljenje kategorija-->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>Num</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>

                </tr>

                <?php
                    //query za prikaz svih kategorija
                    $sql="SELECT * FROM tbl_category";

                    //Execute Query
                    $res=mysqli_query($conn, $sql);

                    //Count rows
                    $count=mysqli_num_rows($res);

                    //pravvljenje Serial number
                    $sn=1;

                    //provera da li imamo podataka u bazi
                    if($count>0)
                    {
                        //imamo podatke
                        //uzimanje podataka i prikazivanje
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                        ?>
                <tr>
                    <td><?php echo $sn++ ?> </td>
                    <td><?php echo $title ?></td>

                    <td>
                        <?php
                            //provera da li image_name postoji
                            if($image_name!="")
                            {
                                //prikazi sliku
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="food-pic" width="100px">

                                <?php
                            }
                            else
                            {
                                //prikazi poruku
                                echo "<div class='error'>Failed to Load image.</div>";
                            }
                        
                        ?>
                    </td>

                    <td><?php echo $featured ?></td>
                    <td><?php echo $active ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id ?>" class="btn-secondary">Update Category</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn-danger">Delete Category</a>
                    </td>
                </tr>
                        <?php

                        }

                    }
                    else
                    {
                        //nemamo podatke u bazi

                        ?>
                            <tr>
                                <td colspan="6"><dov class="error">No category Added</dov></td>
                            </tr>



                        <?php
                    }

                ?>
                
                
            </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>