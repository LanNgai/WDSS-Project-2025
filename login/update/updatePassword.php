<?php
require "../../templates/header_sessions.php";
include "../../templates/footer.php";
require "../../backend/DBconnect.php";

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
        if (!($old_password = $database_password)) {
            echo "Old password is wrong.";
        } else {
            if (password_validation($new_pass)) {
                $hashed_password = hashPassword($new_pass);
                $sql = "UPDATE login SET Password = '$hashed_password' WHERE LoginID = '$id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                echo "Password updated.";
            } else {
                echo "Password does not meet requirements.";
            }
        }
    }
}

//Function to validate passwords. the password given must have a number, a capital letter and a symbol.
function password_validation($password)
{
    //Check for at least one number
    $hasNumber = preg_match('/\d/', $password);

    //Check for at least one capital letter
    $hasCapital = preg_match('/[A-Z]/', $password);

    //Check for at least one symbol
    $hasSymbol = preg_match('/[^a-zA-Z0-9]/', $password);

    return ($hasNumber && $hasCapital && $hasSymbol);
}

//Function using php built-in password hash function.
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}