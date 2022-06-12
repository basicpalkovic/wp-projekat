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
        if (isset($_SESSION['courier-not-found'])) {
            echo $_SESSION['courier-not-found']; // --
            unset($_SESSION['courier-not-found']); // --
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match']; // --
            unset($_SESSION['pwd-not-match']); // --
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd']; // --
            unset($_SESSION['change-pwd']); // --
        }
        ?>
        <br><br><br>
        <!--Button to add admin-->
        <a href="add-courires.php" class="btn-primary">Add Courier</a>

        <br><br>
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query za prikazivanje admina
            $sql = "SELECT * FROM tbl_courires";
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
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
                        $email = $rows['email'];
                        $phone = $rows['phone'];

                        //prikaz vrednosti iz nase tabele
            ?>
                        <tr>
                            <td><?php echo $sn++; ?> </td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $phone  ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password-cr.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-couriers.php?id=<?php echo $id; ?>" class="btn-secondary">Update Courier</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-courier.php?id=<?php echo $id ?>" class="btn-danger">Delete Courier</a>
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