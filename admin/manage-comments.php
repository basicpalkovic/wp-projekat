<?php include("partials/menu.php"); ?>
<!--Main content-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Comments</h1>
        <br>

        <?php

        if (isset($_SESSION['censure'])) {
            echo $_SESSION['censure'];
            unset($_SESSION['censure']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        ?>
        <br><br><br>
        <!--Button to add admin-->


        <br><br>
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Comment</th>
            </tr>

            <?php
            //Query za prikazivanje admina
            $sql = "SELECT * FROM tbl_comments";
            //Execute query
            $res = mysqli_query($conn, $sql);

            //provera da li je query executovan
            if ($res == TRUE) {
                //brojanje redova da bi proverili da li ima podataka u bazi
                $count = mysqli_num_rows($res); //funkcija za pribavljanje svih redova u bazi

                $sn = 1;  //pravljenje varijable i davanje te vrednosti

                //provera koliko ima redova
                if ($count > 0) {
                    //ima podataka
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //pribavljanje svih podataka iz baze koriscenjem while petlje


                        //pribavljanje individualnih podataka
                        $id_user = $rows['id_customer'];
                        $id_comment = $rows['id'];
                        $comment = $rows['comment'];
                        $customer = $rows['customer'];
                        //prikaz vrednosti iz nase tabele
            ?>
                        <tr>
                            <td><?php echo $sn++; ?> </td>
                            <td><?php echo $customer; ?></td>
                            <td><?php echo $comment; ?></td>

                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-comment.php?id_user=<?php echo $id_user; ?>&id_comment=<?php echo $id_comment; ?>" class="btn-primary">Mute comment</a>

                                <a href="<?php echo SITEURL; ?>admin/delete-comments.php?id_comment=<?php echo $id_comment ?>" class="btn-danger">Delete Comment</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    //nema podataka
                }
            }
            ?>

        </table>

    </div>
</div>
<!--Main content END-->

<?php include('partials/footer.php'); ?>