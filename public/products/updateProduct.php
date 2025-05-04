<?php
require_once "../../backend/DBconnect.php";
require_once "../../classes/Product.class.php";

//check if valid ID
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: products.php?error=" . urlencode("Invalid or missing product ID."));
    exit;
}

$productId = (int)$_GET["id"];
$product = null;

try {
    //sql query to retrieve product details
    $sql = "SELECT *
            FROM products WHERE ProductID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
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
    } else {
        header("Location: products.php?error=" . urlencode("Product not found."));
        exit;
    }
} catch (PDOException $error) {
    header("Location: products.php?error=" . urlencode("Error fetching product: " . $error->getMessage()));
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productName = trim($_POST['pName'] ?? '');
    $productType = trim($_POST['category'] ?? '');
    $productDescription = trim($_POST['description'] ?? '');
    $productManufacturer = trim($_POST['manufacturer'] ?? '');
    $productLink = trim($_POST['product_link'] ?? '');
    $productImage = $product->getProductImage();

    //check if everything is filled out
    if (empty($productName) || empty($productType) || empty($productDescription) || empty($productManufacturer) || empty($productLink)) {
        $error = "All required fields must be filled.";
    } elseif (!in_array($productType, ['Toy', 'Food', 'Litter', 'Miscellaneous'])) {
        $error = "Invalid product type.";
    } elseif (!filter_var($productLink, FILTER_VALIDATE_URL)) {
        $error = "Invalid product link URL.";
    } else {
        try {
            //sql query to update product details
            $sql = "UPDATE products
                    SET ProductName = :name, ProductType = :type, ProductDescription = :description,
                        ProductManufacturer = :manufacturer, ProductImage = :image, ProductLink = :link
                    WHERE ProductID = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $productName, PDO::PARAM_STR);
            $stmt->bindValue(':type', $productType, PDO::PARAM_STR);
            $stmt->bindValue(':description', $productDescription, PDO::PARAM_STR);
            $stmt->bindValue(':manufacturer', $productManufacturer, PDO::PARAM_STR);
            $stmt->bindValue(':image', $productImage, PDO::PARAM_STR);
            $stmt->bindValue(':link', $productLink, PDO::PARAM_STR);
            $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: products.php?success=" . urlencode("Product $productId successfully updated."));
            exit;
        } catch (PDOException $error) {
            $error = "Error updating product: " . $error->getMessage();
        }
    }
}
?>

<?php include '../../templates/header.php'?>
<title>Update Product</title>
    <link rel="stylesheet" href="css/AddProduct.css">
</head>
<body>
<nav>
    <!-- navigation bar -->
    <?php require "../../templates/topnav.php"; ?>
</nav>

<?php
if (isset($error)) {
    echo "<p style='color: red; text-align: center;'>" . htmlspecialchars($error) . "</p>";
}
?>

<!-- form filled in with product details -->
<form method="post">
    <div class="product">
        <h1 id="title">Update Product</h1>

        <div class="form-group">
            <label for="pName">Product Name</label> <br>
            <input type="text" id="product_name" name="pName" value="<?php echo htmlspecialchars($product->getProductName()); ?>" required class="form-control">
        </div>

        <br>

        <div class="form-group">
            <label for="category">Category</label> <br>
            <select id="category" name="category" required class="form-control">
                <option value="">Select a category</option>
                <option value="Toy" <?php echo $product->getProductType() === 'Toy' ? 'selected' : ''; ?>>Toy</option>
                <option value="Food" <?php echo $product->getProductType() === 'Food' ? 'selected' : ''; ?>>Food</option>
                <option value="Litter" <?php echo $product->getProductType() === 'Litter' ? 'selected' : ''; ?>>Litter</option>
                <option value="Miscellaneous" <?php echo $product->getProductType() === 'Miscellaneous' ? 'selected' : ''; ?>>Miscellaneous</option>
            </select>
        </div>

        <br>

        <div class="form-group">
            <label for="manufacturer">Manufacturer</label> <br>
            <input type="text" id="manufacturer" name="manufacturer" value="<?php echo htmlspecialchars($product->getProductManufacturer()); ?>" required class="form-control">
        </div>

        <br>

        <div class="form-group">
            <label for="description">Product Description</label> <br>
            <textarea id="description" name="description" rows="10" cols="50" required class="form-control"><?php echo htmlspecialchars($product->getProductDescription()); ?></textarea>
        </div>

        <br>

        <div class="form-group">
            <label for="product_link">Product Link (URL)</label> <br>
            <input type="url" id="product_link" name="product_link" value="<?php echo htmlspecialchars($product->getProductLink()); ?>" required class="form-control"
                   placeholder="https://example.com/product">
        </div>

        <br>

        <div class="form-group">
            <label for="product_image">Product Image (Current: <?php echo htmlspecialchars($product->getProductImage() ?: 'None'); ?>)</label>
            <input type="file" id="product_image" name="product_image" accept="image/*" class="form-control">
        </div>

        <br>

        <div class="form-group">
            <input type="submit" value="Update Product" id="submit" class="btn-submit">
        </div>
    </div>
</form>
<?php include '../../templates/footer.php'?>