<?php
session_start();
require_once "../../backend/DBconnect.php";
require_once "../../classes/Review.class.php";
require_once "../../classes/products.class.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: reviews.php?error=" . urlencode("Invalid or missing review ID."));
    exit;
}
$reviewId = (int)$_GET["id"];
$review = null;

try {
    // retrieve data
    $sql = "SELECT r.*, p.*
            FROM reviews r JOIN products p ON r.ProductID = p.ProductID
            WHERE r.ReviewID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $reviewId, PDO::PARAM_INT);
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

    } else {
        header("Location: reviews.php?error=" . urlencode("Review not found."));
        exit;
    }
} catch (PDOException $error) {
    header("Location: reviews.php?error=" . urlencode("Error fetching review: " . $error->getMessage()));
    exit;
}

//check submission info
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $qualityRating = isset($_POST['quality']) ? (int)$_POST['quality'] : 0;
    $priceRating = isset($_POST['price']) ? (int)$_POST['price'] : 0;
    $reviewText = trim($_POST['review'] ?? '');

    if ($qualityRating < 1 || $qualityRating > 5 || $priceRating < 1 || $priceRating > 5) {
        $error = "Ratings must be between 1 and 5.";
    } elseif (empty($reviewText)) {
        $error = "Review text is required.";
    } else {
        try {
            $sql = "UPDATE reviews
                    SET QualityRating = :quality, PriceRating = :price, ReviewText = :text, DateAndTime = NOW()
                    WHERE ReviewID = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':quality', $qualityRating, PDO::PARAM_INT);
            $stmt->bindValue(':price', $priceRating, PDO::PARAM_INT);
            $stmt->bindValue(':text', $reviewText, PDO::PARAM_STR);
            $stmt->bindValue(':id', $reviewId, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: reviews.php?success=" . urlencode("Review $reviewId successfully updated."));
            exit;
        } catch (PDOException $error) {
            $error = "Error updating review: " . $error->getMessage();
        }
    }
}
?>

<?php include '../../templates/header.php'?>
    <title>Update Review</title>
    <link rel="stylesheet" href="css/WriteReview.css">
</head>
<body>
<nav>
    <!-- navigation bar -->
    <?php require "../../templates/topnav.php"; ?>
    <div>
        <a href="../../public/login/login.php" style="float: right">Login</a>
    </div>
</nav>

<h1>Update Review</h1>
<?php
if (isset($error)) {
    echo "<p style='color: red; text-align: center;'>" . htmlspecialchars($error) . "</p>";
}
?>

<!-- form filled in with relevant review details -->
<form method="post" class="review-form">
    <div class="review">
        <h1 id="title">Update Review</h1>

        <p><strong>Product:</strong> <?php echo htmlspecialchars($review->getProductName()); ?> (<?php echo htmlspecialchars($review->getProductType()); ?>)</p>

        <br>

        <label for="rating">Ratings (between 1 and 5):</label>
        <br>
        <div class="rating-container">
            <div>
                <label for="quality">Quality: </label>
                <input type="number" id="quality" name="quality" min="1" max="5"  value="<?php echo htmlspecialchars($review->getQtyRating()); ?>" required>
            </div>
            <div>
                <label for="price">Price: </label>
                <input type="number" id="price" name="price" min="1" max="5" value="<?php echo htmlspecialchars($review->getPriceRating()); ?>" required>
            </div>
        </div>

        <br><br>

        <label>Write review of product</label>
        <br>
        <textarea id="review" name="review" rows="10" cols="50" required><?php echo htmlspecialchars($review->getReviewText()); ?></textarea>

        <br><br>

        <input type="submit" value="Update Review" id="submit" class="submit-button">
    </div>
</form>
</body>
</html>