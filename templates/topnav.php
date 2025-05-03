<div class="topnav">
    <a href="../index.php">Home</a>
    <a href="../reviews/reviews.php">Reviews</a>
    <a href="../products/products.php">Products</a>

    <?php
    session_start();
        if ($_SESSION['Active'] && !$_SESSION['IsAdmin']) { ?>
            <a href="../login/displayProfile.php">Profile</a>

        <?php }
    ?>
</div>
<?php if (!$_SESSION['Active']) {?>
    <div>
        <a href="../login/login.php" style="float: right">Login</a>
    </div>
<?php } else {?>
    <div>
        <a href="../login/logout.php" style="float: right">Login Out</a>
    </div>
<?php }?>
