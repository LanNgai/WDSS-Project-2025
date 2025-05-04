<?php
require "../../../templates/header_sessions.php";
require "../../../functions/sanitizeData.php";
require "../../../backend/DBconnect.php";
require "../../../functions/passwordFunctions.php";

$new_pass = $_POST['new-password'];
$verify_pass = $_POST['verify-new-password'];
$old_password = $_POST['old-password'];
$id = $_SESSION['userLoginID'];

$sql = "SELECT Password FROM login WHERE LoginID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$database_password = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($new_pass) || empty($verify_pass) || empty($old_password)) {
    echo "Please enter all fields.";
} else {
    if ($new_pass != $verify_pass) {
        echo "New password did not match.";
    } else {
        if (!(password_verify($old_password, $database_password['Password']))) {
            echo "Old password is wrong.";
        } else {
            if (password_validation($new_pass)) {
                $hashed_password = hashPassword($new_pass);
                $sql = "UPDATE login SET Password = '$hashed_password' WHERE LoginID = '$id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                echo "<h1>Password updated.</h1>";
                include "../../../templates/feedbackLinks.php";
            } else {
                echo "Password does not meet requirements.";
            }
        }
    }
}

