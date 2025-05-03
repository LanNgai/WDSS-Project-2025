<?php
session_start();
require_once "../backend/DBconnect.php";

if (isset($_GET["id"])) {
    try {
        $id = $_GET["id"];

        $conn->beginTransaction();

        //delete review
        $sql = "DELETE FROM reviews WHERE reviewID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();


        $conn->commit();

        header("Location: reviews.php?success=" . urlencode("Review $id successfully deleted."));
        exit;
    } catch (PDOException $error) {
        $conn->rollBack();
        header("Location: products.php?error=" . urlencode("Error deleting review: " . $error->getMessage()));
        exit;
    }
} else {
    header("Location: reviews.php?error=" . urlencode("Invalid or missing review ID."));
    exit;
}
