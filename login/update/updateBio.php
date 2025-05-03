<?php
require "../../templates/footer.php";
require "../../templates/header_sessions.php";
require "../../backend/DBconnect.php";

$user_bio = clean($_POST['bio']);
$user_password = clean($_POST['password']);
$id = $_SESSION['userLoginID'];

$sql = "SELECT Password FROM login WHERE LoginID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$database_password = $stmt->fetch(PDO::FETCH_ASSOC);

if ($database_password['Password'] == $user_password) {
    if (!empty($user_bio) && !empty($user_password)) {
        $sql = "UPDATE profile SET Bio = '$user_bio' WHERE UserLoginID = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo "Successfully updated your bio!";
    } else {
        echo "Please fill all the fields.!";
    }
} else {
    echo "Wrong password!";
}