<?php
include('login-check-cust.php');
$customer = $_SESSION['customer'];

$sql3 = "SELECT * FROM tbl_customer WHERE username = '$customer'";

$res3 = mysqli_query($conn, $sql3);

if ($res3 == TRUE) {
    $count3 = mysqli_num_rows($res3);

    if ($count3 == 1) {
        $row3 = mysqli_fetch_assoc($res3);
        $id_customer = $row3['id_user'];
    }
}

?>

<section class="food-search text-center">
    <div class="container">

        <form action="" method="POST">
            <p>Leave us a comment!</p>
            <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
            <br>
            <input type="submit" name="submit" id="submit" value="submit" class="btn-primary">

        </form>

    </div>
</section>
<?php


if (isset($_POST['submit'])) {

    $sql = "SELECT * FROM tbl_customer WHERE username='$customer'";
    $comment = $_POST['comment'];

    $sql2 = "INSERT INTO tbl_comments SET
        customer='$customer',
        comment='$comment',
        id_customer = '$id_customer'";

    $res = mysqli_query($conn, $sql2);

    if ($res == TRUE) {
        //podaci uneti
        //Varijabla za prikaz poruke
        $_SESSION['comment'] = "<div class='success'>Comment Added Successfully</div>";

        //Redirect stranica
        header("location:" . SITEURL . 'all_comments.php');
    } else {
        //podaci nisu uneti tacno/uopste
        $_SESSION['comment'] = "<div class='error'>Failed to Add Comment. Try again.</div>";

        //Redirect stranica
        header("location:" . SITEURL . 'index.php');
    }
}
?>

<?php include("partials-front/footer.php"); ?>

</body>