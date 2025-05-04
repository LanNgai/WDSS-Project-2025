<?php
//PHP to handle the user changing their username.

    require "../../../templates/header_sessions.php";
    require "../../../functions/sanitizeData.php";
    require "../../../backend/DBconnect.php";

    //To sanitize user input.
    $user_username = clean($_POST['username']);
    $user_password = clean($_POST['password']);
    $id = $_SESSION['userLoginID'];

//Using user's ID to retrieve password from DB
$sql = "SELECT Password FROM login WHERE LoginID = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $database_password = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($user_username) && empty($user_password)) {
        echo "Please fill in all the fields!";
    } else {
      if (password_verify($user_password, $database_password['Password'])) {
          try {
              $sql = "UPDATE login
                SET Username = :username
                WHERE LoginID = :id";
              $stmt = $conn->prepare($sql);
              $stmt->bindValue(':id', $id, PDO::PARAM_INT);
              $stmt->bindValue(':username', $user_username, PDO::PARAM_STR);
              $stmt->execute();
              echo "<h1>Username updated successfully!</h1>";
              include "../../../templates/feedbackLinks.php";
          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
          }
      } else {
          echo "Wrong password!";
      }
    }

