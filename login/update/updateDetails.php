<!DOCTYPE html>
<html>
<?php
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$confirm_password = $_POST['confirm_password'];

if (empty($username) || empty($password) || empty($confirm_password) || empty($email)) {
    die("All fields are required.");
}else{
    if ($password !== $confirm_password) {
        die("Passwords do not match.");

    }else if(!validateEmailFormat($email)){
        echo "The email address '$email' is invalid.";
    }
    else{
        echo "You Have Updated Your Details!";

        echo "<br>";
        echo "Click here to <a href='../login.php'>Login</a>";
    }
}

function validateEmailFormat($email) {
    // Regular expression for basic email validation
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    // Use preg_match to check if the email matches the pattern
    if (preg_match($pattern, $email)) {
        return true; // Email format is valid
    } else {
        return false; // Email format is invalid
    }
}
?>
</html>