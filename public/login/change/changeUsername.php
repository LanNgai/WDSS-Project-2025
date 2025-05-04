<?php require_once "../../../templates/header.php" ?>
    <!-- Used to change a user's username. -->
<title>Change Username</title>
    <link rel="stylesheet" href="css/changeDetails.css">
</head>
<body>
<!-- Navigation Bar -->
<nav>
    <?php require "../../../templates/changeDetailsTopnav.php" ?>
    <div class="accountnav">
        <button class="dropdownButton">Settings</button>
        <div class="dropdownContent">
            <a href="changeEmail.php">Change Email</a>
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
    <!-- Form to for the user to change their username. -->
    <form class="change-details-form" method="post" action="../update/updateUsername.php">
        New username:
        <br>
        <input type="text" name="username" required>
        <br><br>
        Your password:
        <br>
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" value="submit" name="submit">
    </form>
</div>
<?php include '../../../templates/footer.php'?>