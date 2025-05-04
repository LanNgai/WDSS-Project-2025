<?php require_once "../../../templates/header.php" ?>

    <!-- Used to change the user's email address -->
    <title>Change Email</title>
    <link rel="stylesheet" href="css/changeDetails.css">
</head>
<body>
<nav>
    <!-- Navigation Bar -->
    <?php require "../../../templates/changeDetailsTopnav.php" ?>
    <div class="accountnav">
        <button class="dropdownButton">Settings</button>
        <div class="dropdownContent">
            <a href="changeUsername.php">Change Username</a>
            <a href="changePassword.php">Change Password</a>
            <?php if (!$_SESSION['IsAdmin']) {?>
                <a href="changeBio.php">Edit Bio</a>
            <?php }?>
            <a href="../logout.php">Logout</a>
        </div>
    </div>
</nav>
<div class="change-details-container">
    <h3>Change Account Details</h3>
    <!-- Form to change email. -->
    <form class="change-details-form" method="post" action="../update/updateEmail.php">
        New Email:
        <br>
        <input type="email" name="email" required>
        <br><br>
        Your password:
        <br>
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" value="submit" name="submit">
    </form>
</div>
<?php include '../../../templates/footer.php'?>