<div class="topnav">
    <a href="../public/index.php">Home</a>
    <a href="../reviews/reviews.php">Reviews</a>
    <a href="../public/products/products.php">Products</a>

    <?php
    session_start();
        if ($_SESSION['Active'] && !$_SESSION['IsAdmin']) { ?>
            <a href="../public/login/displayProfile.php">Profile</a>

        <?php }
    ?>
</div>
<?php if (!$_SESSION['Active']) {?>
    <div>
        <a href="../public/login/login.php" style="float: right">Login</a>
    </div>
<?php } else {?>
    <div>
        <a href="../public/login/logout.php" style="float: right">Login Out</a>
    </div>
<?php }?>
