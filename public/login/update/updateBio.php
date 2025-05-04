<?php
//PHP used to handle bio changes.
require "../../../functions/sanitizeData.php";
require "../../../templates/header_sessions.php";
require "../../../backend/DBconnect.php";

//Sanitizes user input from the bio text and password.
$user_bio = clean($_POST['bio']);
$user_password = clean($_POST['password']);
$id = $_SESSION['userLoginID'];// Gets user's ID.

//Gets password from DB using the user's ID.
$sql = "SELECT Password FROM login WHERE LoginID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$database_password = $stmt->fetch(PDO::FETCH_ASSOC);

//Checks if the bio and password fields are filled.
if (!empty($user_bio) && !empty($user_password)) {

    //Checks if the user entered password and DB password are the same.
        if (password_verify($user_password, $database_password['Password'])) {

        //sql to update profile with new bio.
        $sql = "UPDATE profile SET Bio = '$user_bio' WHERE UserLoginID = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        //Feedback for the user.
        echo "<h1>Successfully updated your bio!</h1>";
        echo "<h1>Click here to go back to <a href='../displayProfile.php'>your profile.</a></h1>";
    } else {
        echo "Wrong password!";
    }
} else {
    echo "Please fill all the fields.!";
}