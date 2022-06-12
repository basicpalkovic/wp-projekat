<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br>


        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }


        ?>
        <br><br>

        <!--Button to add admin-->

        <table class="tbl-full">
            <tr>
                <th>Num</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>

                <th>Status</th>
                <th>Cust Name</th>
                <th>Cust Contact</th>
                <th>Cust Address</th>
                <th>Actions</th>
            </tr>

            <?php

            //uzimanje podataka iz baze
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

            //execute query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);


            $sn = 1;
            if ($count > 0) {
                //postoje narudzbe
                while ($row = mysqli_fetch_assoc($res)) {
                    //uzimanje podataka iz tabele
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_address = $row['customer_address'];

            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>


                        <td>
                            <?php
                            //ordered, on delivery, delivered, cancelled
                            if ($status == "Ordered") {
                                echo "<label>$status</label>";
                            } elseif ($status == "Delivered") {
                                echo "<label style='color: green;'>$status</label>";
                            } elseif ($status == "Cancelled") {
                                echo "<label style='color: red;'>$status</label>";
                            }

                            ?>
                        </td>

                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id ?>" class="btn-secondary">Update Order</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                //nema narudzba
                echo "<tr><td colspan='2' class='error'>Orders not available.</td></tr>";
            }

            ?>



        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>