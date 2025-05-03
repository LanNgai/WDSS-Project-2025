<?php
session_start();
require_once "../backend/DBconnect.php";

if (isset($_GET["id"])) {
    try {
        $id = $_GET["id"];

        $conn->beginTransaction();

        //delete review of product
        $sql = "DELETE FROM reviews WHERE ProductID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        //delete product
        $sql = "DELETE FROM products WHERE ProductID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $conn->commit();

        header("Location: products.php?success=" . urlencode("Product $id successfully deleted."));
        exit;
    } catch (PDOException $error) {
        $conn->rollBack();
        header("Location: products.php?error=" . urlencode("Error deleting product: " . $error->getMessage()));
        exit;
    }
} else {
    header("Location: products.php?error=" . urlencode("Invalid or missing product ID."));
    exit;
}
?>