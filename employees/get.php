<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Courier panel</h2>
        <?php

        require("../config/constants.php");
        $number = 0;
        $sql = "SELECT COUNT(*) FROM tbl_order WHERE status='Ordered'";

        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $record = mysqli_fetch_row($result);

        $number = $record[0];

        if ($number == 1) {
            echo "<div class='mid'>You have $number orders.</div>";
        } else {
            echo "<div class='mid'>You have $number orders.</div>";
        }
