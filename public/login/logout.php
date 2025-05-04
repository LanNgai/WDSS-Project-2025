<?php require "../../templates/header_sessions.php" ?>
<title> Logout </title>
<link rel="stylesheet" href="../index.css">
</head>
<body>
<?php
    $_SESSION['Active'] = false;
    $_SESSION['IsAdmin'] = false;
    echo "<h1>You have logged out of your account</h1>";
?>
<h2>Go back to the homepage: <a href="../index.php">Click here!</a></h2>
<?php include '../../templates/footer.php'?>