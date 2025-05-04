<?php
require "../../classes/Review.class.php";
require "../../templates/header.php";
require "../../functions/sanatizeData.php";
require "../../backend/DBconnect.php";

$search = '';
$category = '';
$whereClauses = [];
$params = [];
$reviews = [];

try {
    $sql = "SELECT r.*, p.*
            FROM reviews r JOIN products p 
            ON r.ProductID = p.ProductID";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

//search and filter
if (isset($_POST['submit'])) {
    try {
        //search
        if (!empty($_POST['search'])) {
            $search = trim($_POST['search']);
            $whereClauses[] = "p.ProductName LIKE :search";
            $params[':search'] = "%$search%";
        }
        //filter
        if (!empty($_POST['category'])) {
            $category = trim($_POST['category']);
            $whereClauses[] = "p.ProductType = :category";
            $params[':category'] = $category;
        }
        if (!empty($whereClauses)) {
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        }

        $stmt = $conn->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<link rel="stylesheet" href="css/Reviews.css">

<nav>
    <?php require "../../templates/topnav.php" ?>
</nav>
<?php if ($_SESSION['IsAdmin']) { ?>
<div class="add">
    <a href='writeReview.php'>Write a Review</a>
</div>
<?php } ?>
<h1>Product Reviews</h1>
<form method="post" class="search">
    <label for="search">Search by Product Name</label>
    <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>">

    <label for="category">Category</label>
    <select id="category" name="category">
        <option value="">All Categories</option>
        <option value="Toy">Toy</option>
        <option value="Food">Food</option>
        <option value="Litter">Litter</option>
        <option value="Misc">Miscellaneous</option>
    </select>

    <input type="submit" name="submit" value="View Results">
</form>

<?php
if (empty($reviews)) {
    echo "There are no reviews yet.";
} else {
    foreach ($reviews as $row) {
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


        if ($_SESSION['IsAdmin'] && $_SESSION['Active']) {
            echo "<div class='box'>";
            echo "<div class='thumbnail'>";
            $imagePath = $product->getProductImage() ? '../../data/images/' . $product->getProductImage() : '../../data/images/placeholders/PlaceHolderProduct.png';
            echo "<img src='" . $imagePath . "' alt='Product image'>";
            echo "</div>";

            $averageRating = ($review->getQtyRating() + $review->getPriceRating()) / 2;

            echo "<div class='review'>";
            echo "<strong>Category:</strong> " . $review->getProductType() . "<br>";
            echo "<strong>Product Name:</strong> " . $review->getProductName() . "<br>";
            echo "<strong>Quality Rating:</strong> " . $review->getQtyRating() . "/5<br>";
            echo "<strong>Price Rating:</strong> " . $review->getPriceRating() . "/5<br>";
            echo "<strong>Overall Rating:</strong> " . number_format($averageRating, 1) . "/5<br>";
            echo "<a href='productReview.php?id=" . $review->getReviewID() . "'class='view-button'>Read Full Review</a>";
            echo "<a href='updateReview.php?id=" . $review->getReviewID().  "' class='view-button'>Update</a>";
            echo "<a href='deleteReview.php?id=" . $review->getReviewID() . "'class='view-button' id='delete'>Delete</a>";
        } else {
            echo "<div class='box'>";
            echo "<div class='thumbnail'>";
            $imagePath = $product->getProductImage() ? '../../data/images/' . $product->getProductImage() : '../../data/images/placeholders/PlaceHolderProduct.png';
            echo "<img src='" . $imagePath . "' alt='Product image'>";
            echo "</div>";

            $averageRating = ($review->getQtyRating() + $review->getPriceRating()) / 2;

            echo "<div class='review'>";
            echo "<strong>Category:</strong> " . $review->getProductType() . "<br>";
            echo "<strong>Product Name:</strong> " . $review->getProductName() . "<br>";
            echo "<strong>Quality Rating:</strong> " . $review->getQtyRating() . "/5<br>";
            echo "<strong>Price Rating:</strong> " . $review->getPriceRating() . "/5<br>";
            echo "<strong>Overall Rating:</strong> " . number_format($averageRating, 1) . "/5<br>";
            echo "<a href='productReview.php?id=" . $review->getReviewID() . "'class='view-button'>Read Full Review</a>";
        }

        echo "</div>";
        echo "</div>";
    }
}
?>