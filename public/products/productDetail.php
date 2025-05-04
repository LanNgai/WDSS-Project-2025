<?php
require_once "../../classes/Product.class.php";
require_once "../../templates/header.php";
require "../../functions/sanitizeData.php";
require_once "../../backend/DBconnect.php";

//check if valid ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing product ID.");
}

$productID = (int)$_GET['id'];

try {
    //sql query to fetch from database
    $sql = "SELECT ProductID, ProductName, ProductType, ProductDescription, ProductManufacturer, ProductImage, ProductLink, AdminLoginID
            FROM products
            WHERE ProductID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $productID, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //check if product exists
    if (!$row) {
        die("Product not found.");
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
} catch (PDOException $e) {
    die("Error loading product: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product->getProductName()); ?> - Product Details</title>
    <link rel="stylesheet" href="css/productDetail.css">
</head>
<body>
<!-- navigation bar -->
    <nav>
        <?php require "../../templates/topnav.php" ?>

    </nav>

    <div class="box">
        <div class="thumbnail">
            <!-- get image -->
            <?php
            $imagePath = $product->getProductImage() ? '../../data/images/' . $product->getProductImage() : '../../data/images/placeholders/PlaceHolderProduct.png';
            echo "<img src='" . $imagePath . "' alt='Product Image'>";
            ?>
        </div>

        <!-- display product information from database -->
        <div class="product-info">
            <h2><?php echo $product->getProductName(); ?></h2>
            <p><strong>Category:</strong> <?php echo $product->getProductType(); ?></p>
            <p><strong>Description:</strong> <?php echo $product->getProductDescription(); ?></p>
            <p><strong>Manufacturer:</strong> <?php echo $product->getProductManufacturer(); ?></p>
            <?php if ($product->getProductLink()): ?>
                <p><strong>More Info:</strong> <a href="<?php echo $product->getProductLink(); ?>" target="_blank">Visit Manufacturer Site</a></p>
            <?php endif; ?>
            <p><a href="products.php" id="back">Back to All Products</a></p>
        </div>
    </div>
<?php include '../../templates/footer.php'?>