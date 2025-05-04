<?php require_once "../../../templates/header.php" ?>

<title>Change Bio</title>
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
            <a href="changePassword.php">Change Password</a>
\            <a href="../logout.php">Logout</a>
        </div>
    </div>
</nav>
<div class="change-details-container">
    <h3>Change Account Details</h3>
    <!-- TODO: Write php file to handle bio change. -->
    <form class="change-details-form" method="post" action="../update/updateBio.php">
        Change your bio:
        <br>
        <?php
        try {
            require "../../../backend/DBconnect.php";
            require "../../../classes/UserProfile.class.php";
            require "../../../classes/User.class.php";
            
            $id = $_SESSION['userLoginID'];
            $sql = "SELECT login.Username, 
                            login.Email, 
                            login.Password,
                            profile.Bio,
                            profile.ProfileImage AS Picture
                            FROM login
                            JOIN user ON login.LoginID = user.UserLoginID
                            JOIN profile ON user.UserLoginID = profile.UserLoginID
                            WHERE login.LoginID = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo $e->getMessage();
        }

        $userProfile = new UserProfile($result["Bio"], $result["Picture"]);
        $user = new User($id, $result["Username"], $result["Email"], $result["Password"], $userProfile);
        $bio = $userProfile->getBio();
        ?>


        <textarea rows="10" cols="50" name="bio"><?php echo htmlspecialchars($bio); ?></textarea>
        <br><br>
        Your password:
        <br>
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" value="submit">
    </form>
</div>
</body>
</html>