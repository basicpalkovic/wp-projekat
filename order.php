<?php include('login-check-cust.php'); ?>


<?php

//provera da li je food_id setovan
if (isset($_GET['food_id'])) {
    //uzimanje food_id i ostale detalje hrane
    $food_id = $_GET['food_id'];

    //uzimanje vrednosti izabrane hrane
    $sql = "SELECT * FROM tbl_food WHERE id = '$food_id'";

    //execute query
    $res = mysqli_query($conn, $sql);

    //count rows
    $count = mysqli_num_rows($res);

    //provera da li postoje podaci u tabeli
    if ($count == 1) {
        //imamo podatke
        //uzimanje podataka iz baze podataka
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        //nema hrane
        //redirect
        header('location:' . SITEURL);
    }
} else {
    //redirect sa porukom
    header('location:' . SITEURL);
}


?>

<!-- fOOD sEARCH  -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php

                    //provera da li slika postoji
                    if ($image_name == "") {
                        //slike nema
                        echo "<div class='error'>Image not available.</div>";
                    } else {
                        //slike ima
                    ?>

                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="food pic" class="img-responsive img-curve">
                    <?php
                    }

                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price"><?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>


                <div class="order-label">Phone</div>
                <input type="text" id="phone" name="phone">
                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Ulica, broj stana/kuce, sprat..." class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>


        <?php


        //provera da li je dugme kliknuto
        if (isset($_POST['submit'])) {
            //uzimanje svih podataka iz forme
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty; //ukupan iznos racuna
            $customer_name = $_SESSION['customer'];
            $phone = $_POST['phone'];
            $order_date = date("d-m-Y h:i:s");  //datum narucivanja i vreme
            $status = "Ordered"; // ordered, on delivery, delivered, cancelled

            $customer_address = $_POST['address'];

            //cuvanje ordera u bazi podataka
            //pravljenje sql-a za cuvanje podataka

            $sql2 = "INSERT INTO tbl_order SET
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    customer_name = '$customer_name',
                    customer_contact = '$phone',
                    order_date = '$order_date',
                    status = '$status',
                    customer_address = '$customer_address'
                ";

            //execute query
            $res2 = mysqli_query($conn, $sql2);

            //provera da li je query executovan
            if ($res2 == true) {
                //query je executovan uspesno
                $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                header('location:' . SITEURL);

                $sql3 = "SELECT email FROM tbl_customer WHERE username='$customer_name'";

                $res3 = mysqli_query($conn, $sql3);
                if ($res3 == true) {
                    $count3 = mysqli_num_rows($res3);
                    if ($count3 == 1) {
                        $row3 = mysqli_fetch_assoc($res3);
                        $email = $row3['email'];
                    }
                }
                $to = $email;
                $subject = "Order status";
                $message = "Your order has been accepted. Expect it within your doorstep in the about an hour.";
                $headers = "From: wowFood <palkovic44@gmail.com>\r\n";
                $headers .= "Reply-To: palkovic44@gmail.com\r\n";
                $headers .= "Content-type: text/html\r\n";

                mail($to, $subject, $message, $headers);
            } else {
                //nije uspelo da sacuva order
                $_SESSION['order'] = "<div class='error text-center'>Failed to Order food.</div>";
                header('location:' . SITEURL);
            }
        }





        ?>

    </div>
</section>
<!-- fOOD sEARCH END -->

<?php include('partials-front/footer.php'); ?>