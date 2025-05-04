<?php
    session_start();
    require "../../backend/DBconnect.php";
    require "../../functions/sanatizeData.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // sanitise inputs
        $productID = (int)$_POST['productID'];
        $qualityRating = (int)$_POST['quality'];
        $priceRating = (int)$_POST['price'];
        $reviewText = clean($_POST['review']);

        //check if empty
        if (empty($productID) || empty($qualityRating) || empty($priceRating) || empty($reviewText)) {
            die("All fields are required.");
        }
        if ($qualityRating < 1 || $qualityRating > 5 || $priceRating < 1 || $priceRating > 5) {
            die("Ratings must be between 1 and 5.");
        }

        //sql query to add to database
        $sql = "INSERT INTO reviews (ProductID, AdminLoginID, QualityRating, PriceRating, ReviewText, DateAndTime)
                VALUES (:productID, :adminLoginID, :qualityRating, :priceRating, :reviewText, :dateAndTime)";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':productID' => $productID,
                ':adminLoginID' => $_SESSION['admin_id'],
                ':qualityRating' => $qualityRating,
                ':priceRating' => $priceRating,
                ':reviewText' => $reviewText,
                ':dateAndTime' => date('Y-m-d H:i:s')
            ]);
            header("Location: reviews.php?success=Review+added");
            exit();
        } catch (PDOException $e) {
            die("Error adding review: " . $e->getMessage());
        }
    } else {
        die("Invalid request method.");
    }
