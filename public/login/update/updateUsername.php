<?php
    require "../../../templates/header_sessions.php";
    require "../../../functions/sanatizeData.php";
    require "../../../backend/DBconnect.php";

    $user_username = clean($_POST['username']);
    $user_password = clean($_POST['password']);
    $id = $_SESSION['userLoginID'];

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
              echo "<h1>Updated successfully!</h1>";
              echo "<h1><a href='../displayProfile.php'>Profile</a></h1>";
          } catch(PDOException $error) {
              echo $sql . "<br>" . $error->getMessage();
          }
      } else {
          echo "Wrong password!";
      }
    }

