<?php require_once "../../../templates/header.php" ?>
    <title>Change Email</title>
    <link rel="stylesheet" href="css/changeDetails.css">
</head>
<body>
<nav>
    <div class="topnav">
        <a href="../../index.php">Home</a>
        <a href="../../reviews/reviews.php">Reviews</a>
        <a href="../../products/products.php">Products</a>
    </div>
    <div class="accountnav">
        <button class="dropdownButton">Settings</button>
        <div class="dropdownContent">
            <a href="changeUsername.php">Change Username</a>
            <a href="changePassword.php">Change Password</a>
            <a href="changeBio.php">Edit Bio</a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>
</nav>
<div class="change-details-container">
    <h3>Change Account Details</h3>
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
</body>
</html>