<?php
require "../../templates/header.php";

?>

<?php
    require "../../backend/config.php";
    require "login-validation.php";
    require "../../templates/footer.php";
    require "../../classes/UserProfile.class.php";
    require "../../classes/Login.class.php";
    require "../../classes/Admin.class.php";

$id = clean($_GET["id"]);
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
<link rel="stylesheet" href="css/account2.css">
</head>
<body>
<nav>
    <?php require_once('../../templates/topnav.php') ?>

</nav>
<h1> Welcome <?= $admin->getUsername() ?>!  </h1>

<h1> You are in admin mode! </h1>

</body>

