<?php
session_start();
require "../../classes/products.class.php";
require "../../backend/DBconnect.php";

// retrieve product info
$sql = "SELECT p.ProductID, p.ProductName, p.ProductType
        FROM products p
        LEFT JOIN reviews r ON p.ProductID = r.ProductID
        WHERE r.ReviewID IS NULL";
$stmt = $conn->prepare($sql);
$stmt->execute();
$unreviewedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../../templates/header.php'?>
        <link rel="stylesheet" href="css/WriteReview.css">
        <nav>
            <div class="topnav">
                <?php require "../../templates/topnav.php"?>
            </div>
        </nav>
        <title>Write a Review</title>
    </head>
    <body>
    <!-- form to write review -->
    <form method="post" action="postReview.php" enctype="multipart/form-data">
            <div class="review">
                <h1 id="title">Write a Review</h1>

                <label for="productID">Select a Product</label>
                <br>
                <!-- check if there is unreviewed products -->
                <?php if (empty($unreviewedProducts)): ?>
                    <p>No products available to review.</p>
                    <select id="productID" name="productID" disabled>
                        <option value="">-- Choose a Product --</option>
                    </select>
                <?php else: ?>
                    <select id="productID" name="productID" required>
                        <option value="">-- Choose a Product --</option>
                        <?php foreach ($unreviewedProducts as $product): ?>
                            <option value="<?php echo htmlspecialchars($product['ProductID']); ?>">
                                <?php echo htmlspecialchars($product['ProductName'] . " (" . $product['ProductType'] . ")"); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>

                <br><br>

                <label for="rating">Ratings (between 1 and 5):</label>
                <br>
                <div class="rating-container">
                    <div>
                        <label for="quality">Quality: </label>
                        <input type="number" id="quality" name="quality" min="1" max="5" required>
                    </div>
                    <div>
                        <label for="price">Price: </label>
                        <input type="number" id="price" name="price" min="1" max="5" required>
                    </div>
                </div>

                <br><br>

                <label>Write review of product</label>
                <br>
                <textarea id="review" name="review" rows="10" cols="50" required></textarea>

                <br><br>

                <input type="submit" value="Submit" id="submit" <?php echo empty($unreviewedProducts) ? 'disabled' : ''; ?>>
            </div>
        </form>
    </body>
</html>