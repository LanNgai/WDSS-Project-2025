<?php
require "../../templates/header.php";
//This page is shown to offer feedback to the user that they have signed in as admin.
?>

<?php
    require "../../backend/config.php";
    require "login-validation.php";
    require "../../functions/sanitizeData.php";
    require "../../classes/UserProfile.class.php";
    require "../../classes/Login.class.php";
    require "../../classes/Admin.class.php";

    //gets the id used to sign in
session_start();
$id = $_SESSION['userLoginID'];
session_abort();
try {
    require "../../backend/DBconnect.php";

    $sql = "SELECT login.Username, 
                            login.Email, 
                            login.Password
                            FROM login
                            JOIN administrator ON login.LoginID = administrator.AdminLoginID
                            WHERE login.LoginID = :id";


    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}catch (PDOException $e){
    echo $e->getMessage();
}

$admin = new Admin($id, $result["Username"], $result["Email"], $result["Password"]);
?>
<title>
    <?= $admin->getUsername()."'s Profile" ?>
</title>
<link rel="stylesheet" href="css/account.css">
</head>
<body>
<!--Navigation Bar-->
<nav>
    <?php require_once('../../templates/changeDetailsTopnav.php');
    require_once ('../../templates/adminChangeNav.php');
    ?>

</nav>

<!--To display the admin's details.-->
<div class="overall-profile-container">
    <div class="profile-container">
        <div class="notice">
            <h1> Welcome <?= $admin->getUsername() ?>!  </h1>
            <h1> You are in admin mode! </h1>
        </div>
        <div class="profile-details">
            <h3>Your details: </h3>
            <h2 class="profile-name">
                Username: <?= $admin->getUsername(); ?>
            </h2>
            <h3 class="profile-email">
                Email Address: <?= $admin->getEmail(); ?>
            </h3>
        </div>
    </div>
</div>

<?php include '../../templates/footer.php'?>
