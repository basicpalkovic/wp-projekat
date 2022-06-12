<?php include('partials/menu.php');  ?>

<!--Main content-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Courier</h1>
        <br>

        <?php if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //prikazivanje session poruke
            unset($_SESSION['add']); //sklanjanje session poruke
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; // --
            unset($_SESSION['delete']); // --
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; // --
            unset($_SESSION['update']); // --
        }
        if (isset($_SESSION['customer-not-found'])) {
            echo $_SESSION['customer-not-found']; // --
            unset($_SESSION['customer-not-found']); // --
        } ?>

        <br><br><br>


        <br><br>
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Banned</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query za prikazivanje admina
            $sql = "SELECT * FROM tbl_customer";
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
                        $id = $rows['id_user'];
                        $first_name = $rows['firstname'];
                        $last_name = $rows['lastname'];
                        $username = $rows['username'];
                        $email = $rows['email'];
                        $banned = $rows['banned'];


                        //prikaz vrednosti iz nase tabele
            ?>
                        <tr>
                            <td><?php echo $sn++; ?> </td>
                            <td><?php echo $first_name; ?></td>
                            <td><?php echo $last_name; ?></td>
                            <td><?php echo $username ?></td>
                            <td><?php echo $email  ?></td>
                            <td><?php
                                if ($banned == 0) {
                                    $yesno = "No";
                                    echo $yesno;
                                } else {
                                    $yesno = "Yes";
                                    echo $yesno;
                                }


                                ?></td>
                            <td>

                                <?php if ($yesno == "Yes") {
                                ?>
                                    <a href="<?php echo SITEURL; ?>admin/unban-customer.php?id=<?php echo $id ?>" class="btn-secondary">UNBAN</a>
                        </tr>
                    <?php
                                } else {
                    ?>
                        <a href="<?php echo SITEURL; ?>admin/ban-customer.php?id=<?php echo $id ?>" class="btn-danger">BAN</a>
                        </td>
                    <?php } ?>


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