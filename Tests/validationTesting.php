<?php
//This file contains snippets of validation testing throughout our project.

//Function to sanitize input. Located in templates/footer.php
function clean ($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

//Located in update/login-validation.php
//This is to check if there is data in the input fields from the login page (login.php) and that the user password matches with the one store in the Database.
//Then it checks whether the user is a match to a regular user or an admin.
if (!empty($user_data) && $user_password == $user_data['Password']) {
    if($user_data['LoginID'] == $user_ID['UserLoginID']) {
        $_SESSION['Active'] = true;
        $_SESSION['userLoginID'] = $user_data['LoginID'];
        header("Location: displayProfile.php?id=" . $user_data['LoginID']);
        exit();
    } else if ($user_data['LoginID'] == $admin_ID['AdminLoginID']) {
        $_SESSION['Active'] = true;
        header("Location: adminPage.php?id=" . $user_data['LoginID']);
        exit();
    }
} else {
    echo "Invalid password.";
}

//Located in reviews/productReview.php
//Validates if the array storing reviews ($row) is empty or not.
try {
    $sql = "SELECT r.*, p.*
            FROM reviews r JOIN products p 
            ON r.ProductID = p.ProductID
            WHERE r.ReviewID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die("Review not found.");
    }
    $product = new Product(
        $row['ProductName'],
        $row['ProductType'],
        $row['ProductDescription'],
        $row['ProductManufacturer'],
        $row['ProductImage'],
        $row['ProductLink'],
        $row['ProductID'],
        $row['AdminLoginID']
    );
    $review = new Review(
        $row['ReviewID'],
        $row['ProductID'],
        $row['AdminLoginID'],
        $row['QualityRating'],
        $row['PriceRating'],
        $row['ReviewText'],
        $row['DateAndTime'],
        $product
    );
} catch (PDOException $e) {
    die("Error loading review: " . $e->getMessage());
}

//Location update/updateDetails.php
//The user is asked to enter the new password twice to confirm.
//It is then compared to see if it's a match.
if (empty($new_pass) || empty($verify_pass) || empty($old_password)) {
    echo "Please enter all fields.";
} else {
    if ($new_pass != $verify_pass) {
        echo "New password did not match.";
    } else {
        if (!($old_password = $database_password)) {
            echo "Old password is wrong.";
        } else {
            $sql = "UPDATE login SET Password = '$new_pass' WHERE LoginID = '$id'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            echo "Password updated.";
        }
    }
}

//Location: login/update/updatePassword.php
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