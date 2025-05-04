<?php //This is the login page.
require "../../templates/header.php"
?>
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<!--Navigation Bar-->
<nav>
    <?php require "../../templates/topnav.php" ?>
</nav>
    <?php
    //checks if user is logged in already
        if(!$_SESSION['Active']){?>
            <div class="login-container">
        <h3>Login</h3>
<!--Form to login.-->
        <form class="login-form" method="post" action="login-validation.php">
                Your username:
            <br>
            <input type="text" name="username" required>
            <br><br>
            Your Email:
            <br>
            <input type="email" name="email" required>
            <br><br>
            Your password:
            <br>
            <input type="password" name="password" required>
            <br><br>
            <input type="submit" name="submit" value="submit">
        </form>
<!--Links to register and go back to the home page.-->
        <div class="links-container">
            <p>No account? <a href="../registration/registration.php">Register Here!</a></p>
            <a href="../index.php">Go to Home Page</a>
        </div>
    </div>
        <?php } else{?>
        <div class="login-container">
            <h3>You are already logged in!</h3>
        </div>
            <div class="links-container">
                <p>No account? <a href="../registration/registration.php">Register Here!</a></p>
                <a href="../index.php">Go to Home Page</a>
            </div>
        <?php } ?>

<?php include '../../templates/footer.php'?>

