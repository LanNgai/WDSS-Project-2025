<?php
require "../../../templates/header_sessions.php";
include "../../../templates/footer.php";
require "../../../backend/DBconnect.php";


$user_email = $_POST['email'];
$user_password = $_POST['password'];
$id = $_SESSION['userLoginID'];

$sql = "SELECT Password FROM login WHERE LoginID = '$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$database_password = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($user_email) && !empty($user_password)) {
    if ($user_password = $database_password) {
        try {
            $sql = "UPDATE login
                SET Email = :email
                WHERE LoginID = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':email', $user_email);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            echo "Email updated successfully!";
            echo "<a href='..rofile.php'>Profile</a>";
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } else {

        echo "Wrong password!";
    }
} else {
    echo "Please fill in all the fields!";

}

