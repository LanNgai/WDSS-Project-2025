<?php require_once "../../../templates/header.php" ?>

<title>Change Password</title>
    <link rel="stylesheet" href="css/changeDetails.css">
</head>
<body>
<nav>
    <?php require "../../../templates/changeDetailsTopnav.php" ?>
    <div class="accountnav">
        <button class="dropdownButton">Settings</button>
        <div class="dropdownContent">
            <a href="changeUsername.php">Change Username</a>
            <a href="changeEmail.php">Change Email</a>
            <a href="changeBio.php">Edit Bio</a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>
</nav>
<div class="change-details-container">
    <h3>Change Account Details</h3>
    <form class="change-details-form" method="post" action="../update/updatePassword.php">
        <!-- TODO: add toggle password visibility -->
        New Password:
        <br>
        <input type="password" name="new-password" required>
        <br><br>
        Verify New Password:
        <br>
        <input type="password" name="verify-new-password" required>
        <br><br>
        Old Password:
        <br>
        <input type="password" name="old-password" required>
        <br><br>
        <input type="submit" value="submit">
    </form>
    <div>
        <p>Password must contain 1 capital letter, 1 symbol and 1 number.</p>
    </div>
</div>
</body>
</html>