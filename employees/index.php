<?php include('partials/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Orders</title>
    <link rel="stylesheet" href="../css/employees.css">
</head>

<body>

    <div id="total"><img src="../images/ajax_loader.gif" alt="loading"></div>

    <div class="mid">
        <input type="button" id="gam" value="get all orders">
        <input type="button" id="clear" value="minimize all orders">
    </div>
    <div id="all"></div>
    <script type="text/javascript">
        var $ = function(id) {
            return document.getElementById(id);
        }

        window.addEventListener('load', init);

        function init() {
            setTimeout(loadData, 1000);
            setInterval(loadData, 10000);
            $("gam").addEventListener('click', function() {
                getAllMessages()
            });
            $("clear").addEventListener('click', function() {
                clearMessages()
            });
        }


        function loadData() {
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            }

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    $("total").innerHTML = xmlhttp.responseText;
                }
            };

            xmlhttp.open("GET", "get.php", true);
            xmlhttp.send();
        }

        function getAllMessages() {
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            }

            xmlhttp.onreadystatechange = function() {
                $('all').innerHTML = '<img src="../images/ajax_loader.gif" >';
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    $('all').innerHTML = xmlhttp.responseText;
                    loadData();
                }
            };

            xmlhttp.open("GET", "get2.php", true);
            xmlhttp.send();
        }

        function clearMessages() {
            $('all').innerHTML = "";
        }
    </script>
    <br>
    <?php

    //uzimanje podataka iz baze
    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

    //execute query
    $res = mysqli_query($conn, $sql);

    //count rows
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        //postoje narudzbe
        while ($row = mysqli_fetch_assoc($res)) {
            //uzimanje podataka iz tabele
            $id = $row['id'];

    ?>


    <?php
        }
    }
    ?>


    <?php if (isset($_SESSION['delivered'])) {
        echo $_SESSION['delivered'];
        unset($_SESSION['delivered']);
    }
    ?>

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" /></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" /></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png" /></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <strong>Sergej Bogovic</strong> & <b>Luka Basic Palkovic</b></p>

        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>


</html>