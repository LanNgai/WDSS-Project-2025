<?php
//PHP to handle email changes.

require "../../../templates/header_sessions.php";
require "../../../functions/sanitizeData.php";
require "../../../backend/DBconnect.php";

//Sanitize user input.
$user_email = trim($_POST['email']);
$user_password = clean($_POST['password']);
$id = clean($_SESSION['userLoginID']);

//Get password stored in DB using user's ID.
$sql = "SELECT Password FROM login WHERE LoginID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$database_password = $stmt->fetch(PDO::FETCH_ASSOC);

//Check if all fields are filled out.
if (!empty($user_email) && !empty($user_password)) {
    //Check if password is correct.
    if (password_verify($user_password, $database_password['Password'])) {
        try {
            //Sql statement to update email.
            $sql = "UPDATE login
                SET Email = :email
                WHERE LoginID = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':email', $user_email);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            //Feedback for user.
            echo "<h1>Email updated successfully!</h1>";
            include "../../../templates/feedbackLinks.php";
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } else {

        echo "Wrong password!";
    }
} else {
    echo "Please fill in all the fields!";

}

