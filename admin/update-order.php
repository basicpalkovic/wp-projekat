<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>


        <?php
        //proveravanje da li je id postavljen ili ne
        if (isset($_GET['id'])) {
            //detalji narudzbine
            $id = $_GET['id'];

            //sql query za prikaz podataka ordera
            $sql = "SELECT * FROM tbl_order WHERE id = $id";

            //execute query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //detalji su dostupni
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status']; // ordered, delivered, cancelled

                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];

                $customer_address = $row['customer_address'];
            } else {
                //nisu dostupni
                //redirect
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        } else {
            //redirektovanje na manage-order
            header('location:' . SITEURL . 'admin/manage-order.php');
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>


                <tr>
                    <td>Price</td>
                    <td>
                        <b><?php echo $price; ?> RSD</b>

                    </td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td> <input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Ordered") {
                                        echo "selected";
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    } ?> value="Delivered">Delivered</option>
                            <option <?php if ($status == "Cancelled") {
                                        echo "selected";
                                    } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="customer_name" value="<?php echo $customer_name; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>



        <?php


        //provera da li je submit kliknut
        if (isset($_POST['submit'])) {
            //uzimanje vrednosti iz forme

            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];

            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];


            var_dump($customer_address);

            //azuriranje vrednosti

            $sql2 = "UPDATE tbl_order SET
                
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_address = '$customer_address'
                WHERE id = $id
                ";
            //execute query
            $res2 = mysqli_query($conn, $sql2);

            //provera da li su podaci azurirani
            if ($res2 == true) {
                //uspesno
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                //redirect
                header('location:' . SITEURL . 'admin/manage-order.php');
            } else {
                //neuspesno
                $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                //redirect
                header('location:' . SITEURL . 'admin/manage-order.php');
            }

            //redirect sa porukom
        }

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>