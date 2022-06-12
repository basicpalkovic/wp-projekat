<?php

require("../config/constants.php");
$number = 0;
$sql = "SELECT * FROM tbl_order WHERE status = 'Ordered'";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

?>
<table id='deliveries'>
    <tr>
        <th>ID</th>
        <th>Foods</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Customer address</th>
        <th>Action</th>
    </tr>

    <?php

    $sql2 = "SELECT * FROM tbl_order WHERE status='Ordered'";

    $res = mysqli_query($conn, $sql2);

    $count = mysqli_num_rows($res);

    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
        }
    }
    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr ><td>$record[id]</td><td>$record[food]</td> <td>$record[qty]</td><td> $record[total]</td><td>$record[customer_address]</td>  ";

    ?> <br>
            <td>
                <form action="delivered.php?id=<?php echo $id; ?>" method="POST">
                    <input type="submit" id="submit" name="submit" value="submit">
                </form>
            </td>
            </tr>
    <?php

        }
    }

    ?>

</table>