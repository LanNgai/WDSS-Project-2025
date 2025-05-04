<?php
//PHP to handle password changes.

require "../../../templates/header_sessions.php";
require "../../../functions/sanitizeData.php";
require "../../../backend/DBconnect.php";
require "../../../functions/passwordFunctions.php";

//Clean user input.
$new_pass = clean($_POST['new-password']);
$verify_pass = clean($_POST['verify-new-password']);
$old_password = clean($_POST['old-password']);
$id = clean($_SESSION['userLoginID']);

//Using user's ID to retrieve password from DB
$sql = "SELECT Password FROM login WHERE LoginID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$database_password = $stmt->fetch(PDO::FETCH_ASSOC);

//Check if all fields are filled.
if (empty($new_pass) || empty($verify_pass) || empty($old_password)) {
    echo "Please enter all fields.";
} else {
    //Check if new password matches the second time it's typed out.
    if ($new_pass != $verify_pass) {
        echo "New password did not match.";
    } else {
        //Check if the old password is valid.
        if (!(password_verify($old_password, $database_password['Password']))) {
            echo "Old password is wrong.";
        } else {
            //check if the new password is up to the requirements.
            if (password_validation($new_pass)) {
                $hashed_password = hashPassword($new_pass);//hashes password to be stored in the DB.
                $sql = "UPDATE login SET Password = '$hashed_password' WHERE LoginID = '$id'";//updates the password.
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                //Feedback for the user.
                echo "<h1>Password updated.</h1>";
                include "../../../templates/feedbackLinks.php";
            } else {
                echo "Password does not meet requirements.";
            }
        }
    }
}

