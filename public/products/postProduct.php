<?php
    session_start();
    require "../../functions/sanatizeData.php";
    require "../../backend/DBconnect.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        //sanitise and retrieve form inputs
        $productName = clean($_POST['pName']);
        $productType = clean($_POST['category']);
        $manufacturer = clean($_POST['manufacturer']);
        $description = clean($_POST['description']);
        $productLink = filter_var(clean($_POST['product_link']), FILTER_SANITIZE_URL);

        if (empty($productName) || empty($productType) || empty($manufacturer) || empty($description) || empty($productLink)) {
            throw new Exception("All fields are required.");
        }

        $sql = "INSERT INTO products (AdminLoginID, ProductName, ProductType, ProductDescription, ProductManufacturer, ProductImage, ProductLink)
                VALUES (:adminLoginID, :productName, :productType, :description, :manufacturer, :productImage, :productLink)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':adminLoginID' => $_SESSION['admin_id'],
                ':productName' => $productName,
                ':productType' => $productType,
                ':description' => $description,
                ':manufacturer' => $manufacturer,
                ':productImage' => null,
                ':productLink' => $productLink
            ]);
            header("Location: products.php?success=Product+added");
            exit();
        } catch (PDOException $e) {
            die("Error adding product: " . $e->getMessage());
        }
    }
    else
    {
        die("Invalid request method.");
    }