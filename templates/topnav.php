<div class="topnav">
    <a href="http://localhost/WDSS-Project-2025/public/index.php">Home</a>
    <a href="http://localhost/WDSS-Project-2025/public/reviews/reviews.php">Reviews</a>
    <a href="http://localhost/WDSS-Project-2025/public/products/products.php">Products</a>

    <?php
    session_start();
        if ($_SESSION['Active'] && !$_SESSION['IsAdmin']) { ?>
            <a href="http://localhost/WDSS-Project-2025/public/login/displayProfile.php">Profile</a>

        <?php }
    ?>
</div>
<?php if (!$_SESSION['Active']) {?>
    <div>
        <a href="http://localhost/WDSS-Project-2025/public/login/login.php" style="float: right">Login</a>
    </div>
<?php } else {?>
    <div>
        <a href="http://localhost/WDSS-Project-2025/public/login/logout.php" style="float: right">Login Out</a>
    </div>
<?php }?>
