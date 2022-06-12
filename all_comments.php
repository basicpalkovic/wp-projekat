<?php include("partials-front/menu.php"); ?>

<link rel="stylesheet" href="css/comments.css">
<?php

//query za prikaz komentara
$sql2 = "SELECT * FROM tbl_comments";

//execute query
$res2 = mysqli_query($conn, $sql2);

?>
<p class="lac"><a href="../delivery/comments.php" class="btn-primary">Leave a comment!</a></p>
<div class="wrapper">
    <?php
    if ($res2 == true) {
        //count rows
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            //hrana dostupna
            while ($row2 = mysqli_fetch_assoc($res2)) {
                //uzimanje svih vrednosti
                $id = $row2['id'];
                $customer = $row2['customer'];
                $comment = $row2['comment'];

                //prikaz vrednosti iz tabele
    ?>

                <div class="comment-thread">
                    <!-- Comment 1 start -->
                    <div class="comment" id="comment-1">
                        <div class="comment-heading">

                            <div class="comment-info">
                                <a class="comment-author"><?php echo $customer; ?></a>

                            </div>
                        </div>

                        <div class="comment-body">
                            <p>
                                <?php echo $comment; ?>
                            </p>

                        </div>


                    </div>
                    <!-- Comment 1 end -->
                </div>




    <?php }
        } else {
        }
    }
    ?>
</div>

<?php
include("partials-front/footer.php");
?>