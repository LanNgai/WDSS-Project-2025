<?php require "../../templates/header.php" ?>

<?php
require "../../backend/config.php";
include "login-validation.php";
require "../../templates/footer.php";
require "../../classes/UserProfile.class.php";
require "../../classes/Login.class.php";
require "../../classes/User.class.php";

if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
    die("Invalid user ID.");
}
$id = (int)$_GET['user_id'];;


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
<link rel="stylesheet" href="css/account2.css">
</head>
<body>
<nav>
    <?php require "../../templates/topnav.php" ?>
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

