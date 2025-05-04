<?php require "../../templates/header.php" ?>

<?php
    require "../../backend/config.php";
    include "login-validation.php";
    require "../../templates/footer.php";
    require "../../classes/UserProfile.class.php";
    require_once "../../classes/Login.class.php";
    require "../../classes/User.class.php";

    session_start();
    $id = $_SESSION['userLoginID'];
    session_abort();
    try {
        require "../../backend/DBconnect.php";

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
    ?>
    <title>
        <?= $user->getUsername()."'s Profile" ?>
    </title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body>
<nav>
    <div class="topnav">
        <a href="../index.php">Home</a>
        <a href="../reviews/reviews.php">Reviews</a>
        <a href="../products/products.php">Products</a>
    </div>
    <div class="accountnav">
        <button class="dropdownButton">Settings</button>
        <div class="dropdownContent">
            <a href="change/changeUsername.php">Change Username</a>
            <a href="change/changeEmail.php">Change Email</a>
            <a href="change/changePassword.php">Change Password</a>
            <a href="change/changeBio.php">Edit Bio</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</nav>
    <div class="overall-profile-container">
        <div class="profile-container">
            <img src="../../data/images/profilepic/<?= $userProfile->getPicture(); ?>" alt="Profile Picture" class="profile-picture"/>
            <div class="profile-details">
                <h2 class="profile-name">
                    <?= $user->getUsername(); ?>
                </h2>
                <h3 class="profile-email">
                    <?= $user->getEmail(); ?>
                </h3>
                <p class="profile-bio">
                    <?= $userProfile->getBio(); ?>
                </p>
            </div>
        </div>

        <div class="profile-comments-container">
        <?php
        require "../../classes/Comment.class.php";
            try {
            $comments = Comment::loadByUserId($id);

            if (empty($comments)) {
            echo "<p class='no-comments'>You have not made any comments yet.</p>";
            } else {
            foreach ($comments as $comment) {
            $userLoginID = $comment->getUserLoginID();

            try {
            require "../../backend/DBconnect.php";

            $sql = "SELECT login.Username
            FROM login
            JOIN user ON login.LoginID = user.UserLoginID
            JOIN profile ON user.UserLoginID = profile.UserLoginID
            WHERE login.LoginID = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $userLoginID, PDO::PARAM_INT);
            $stmt->execute();

            $userName = $stmt->fetch(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
            echo $e->getMessage();
            }

            ?> <div class='individual'> <?php
                echo "<p><strong>" . $userName['Username'] . "</strong> ";
                    echo "<small>" . htmlspecialchars($comment->getCommentDateAndTime()) . "</small></p>";
                echo "<p>" . htmlspecialchars($comment->getCommentText()) . "</p>";
                ?></div> <?php
            }
            }
            } catch (Exception $e) {
            echo "<p>Error loading comments: " . $e->getMessage() . "</p>";
            }  ?>
        </div>
    </div>
</body>
</html>