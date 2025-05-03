<?php require "../templates/header_sessions.php" ?>
<title>Registration Page</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
<div class="registration-container">
    <h3>Register for an Account</h3>
    <form class="registration-form" method="post" action="register.php">
        Your username:
        <br>
        <input type="text" name="username" required>
        <br><br>
        Your Email:
        <br>
        <input type="text" name="email" required>
        <br><br>
        Your password:
        <br>
        <input type="password" name="password" required>
        <br><br>
        Verify password:
        <br>
        <input type="password" name="confirm_password" required>
        <br><br>
        <input type="submit" name="submit" value="submit">
    </form>
    <div class="links-container">
        <a href="../index.php">Go to Home Page</a><br><br>
        <a href="../login/login.php">Go to Login Page</a>
    </div>
</div>
</body>
</html>
