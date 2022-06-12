<?php include('partials/menu.php'); ?>



        <?php
        //1. Uzimanje ID-ja od izabranog admina
        $id_user = $_GET['id_user'];
        $id_comment = $_GET['id_comment'];



        //Execute query





        $sql = "UPDATE tbl_comments SET
    comment = 'ovaj komentar je cenzurisan'
    WHERE id_customer=$id_user AND id=$id_comment";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {

            //Provera da li je query executovan
            if ($res == true) {
                //admin je uspesno updateovan
                $_SESSION['update'] = "<div class='success'>Comment Updated Successfully</div>";

                $sql3 = "SELECT email FROM tbl_customer WHERE id_user=$id_user";

                $res3 = mysqli_query($conn, $sql3);
                if ($res3 == true) {
                    $count3 = mysqli_num_rows($res3);
                    if ($count3 == 1) {
                        $row3 = mysqli_fetch_assoc($res3);
                        $email = $row3['email'];
                    }
                }
                $to = $email;
                $subject = "Comment status";
                $message = "Your comment has been edited on our list. Please make sure you don't use forbidden words in our comment section.";
                $headers = "From: wowFood <palkovic44@gmail.com>\r\n";
                $headers .= "Reply-To: palkovic44@gmail.com\r\n";
                $headers .= "Content-type: text/html\r\n";

                mail($to, $subject, $message, $headers);


                //redirect na manage admin page
                header('location:' . SITEURL . 'admin/manage-comments.php');
            } else {
                //admin nije updateovan
                $_SESSION['update'] = "<div class='error'>Failed to Update Comment. Try again.</div>";
                //redirect na manage admin page
                header('location:' . SITEURL . 'admin/manage-comments.php');
            }
        }

        ?>
<?php include('partials/footer.php'); ?>