<?php require "../templates/header.php" ?>
        <title> Cat's Delight </title>
        <link rel="stylesheet" href="index.css">
    </head>

    <body>
        <nav>
            <div class="topnav">
                <a href="index.php">Home</a>
                <a href="http://localhost/WDSS-Project-2025/public/reviews/reviews.php">Reviews</a>
                <a href="http://localhost/WDSS-Project-2025/public/products/products.php">Products</a>
                <?php
                session_start();
                if ($_SESSION['Active'] && !$_SESSION['IsAdmin']) { ?>
                    <a href="login/displayProfile.php">Profile</a>
                <?php }
                ?>
            </div>
            <?php if (!$_SESSION['Active']) {?>
                <div>
                    <a href="login/login.php" style="float: right">Login</a>
                </div>
            <?php } else {?>
                <div>
                    <a href="login/logout.php" style="float: right">Login Out</a>
                </div>
            <?php }?>
        </nav>
        <h1 class="title"> Cat's Delight </h1>

        <div class="box">
            <div class="text">
                <h2> About us </h2>
                <text class="description">Lorem ipsum odor amet, consectetuer adipiscing elit. Accumsan nam orci ac odio mattis cras integer. Fames mi litora fusce porttitor facilisis. Risus tellus cubilia natoque habitant convallis sem nisl. Pharetra magnis auctor mi neque convallis dictumst interdum. Felis fermentum turpis magna facilisi facilisis euismod dolor. Imperdiet ex risus aptent quam feugiat mus. Leo ad varius tempor; sollicitudin ligula potenti rutrum. Ridiculus sodales molestie ex ridiculus quam tincidunt cursus inceptos.</text>
            </div>
            <div>
                <img src="Biscuit.jpg" alt="Picture of Biscuit the cat" class="image">
            </div>
        </div>

        <div class="box">
            <div class="text">
                <h2> Our Goal </h2>
                <text class="description">Lorem ipsum odor amet, consectetuer adipiscing elit. Accumsan nam orci ac odio mattis cras integer. Fames mi litora fusce porttitor facilisis. Risus tellus cubilia natoque habitant convallis sem nisl. Pharetra magnis auctor mi neque convallis dictumst interdum. Felis fermentum turpis magna facilisi facilisis euismod dolor. Imperdiet ex risus aptent quam feugiat mus. Leo ad varius tempor; sollicitudin ligula potenti rutrum. Ridiculus sodales molestie ex ridiculus quam tincidunt cursus inceptos.</text>
            </div>
            <div>
                <img src="Laila.jpg" alt="Picture of Laila the cat" class="image">
            </div>
        </div>
<?php include '../templates/footer.php'?>