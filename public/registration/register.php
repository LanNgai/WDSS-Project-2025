<?php
global $host, $dbname, $password, $user, $options;
if(isset($_POST["submit"])) {

    require "../../backend/config.php";
    include "../../templates/footer.php";

    $new_user = array(
        'username' => clean($_POST["username"]),
        'email' => clean($_POST["email"]),
        'password' => clean($_POST["password"])
    );

    $confirm_password = clean($_POST["confirm_password"]);

    if (empty($new_user['username']) || empty($new_user['password']) || empty($new_user['email']) || empty($confirm_password)) {
        die("All fields are required.");
    }else{
        if ($new_user['password'] !== $confirm_password) {
            die("Passwords do not match.");
        }
        else{
            try{
                $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, $options);

                $sql = sprintf("INSERT INTO %s (%s) values (%s)", "user",
                    implode(", ", array_keys($new_user)),
                    ":" . implode(", :", array_keys($new_user)));
                $stmt = $conn->prepare($sql);
                $stmt->execute($new_user);

                echo "You have successfully registered!";

                echo "<br>";
                echo "Click here to <a href='../login/login.php'>Login</a>";

            }
            catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
}






