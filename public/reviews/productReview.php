<?php
require "../../templates/header.php";
require "../../classes/Comment.class.php";
require "../../classes/Review.class.php";
require_once "../../classes/products.class.php";
require "../../backend/DBconnect.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing review ID.");
}

$reviewId = (int)$_GET['id'];

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
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($review->getProductName()); ?> - Review</title>
        <link rel="stylesheet" href="css/productReview.css">
    </head>
<body>
    <nav>
        <?php require "../../templates/topnav.php"?>
    </nav>

    <div class="box">
        <div class="thumbnail">
            <?php
            $imagePath = $product->getProductImage() ? '../../data/images/' . $product->getProductImage() : '../../data/images/placeholders/PlaceHolderProduct.png';
            echo "<img src='" . $imagePath . "' alt='Product Image'>";
            ?>
        </div>

        <div class="review">
            <h2><?php echo $review->getProductName(); ?></h2>
            <p><strong>Category:</strong> <?php echo $review->getProductType(); ?></p>
            <p><strong>Product Name:</strong> <?php echo $review->getProductName(); ?></p>
            <p><strong>Quality Rating:</strong> <?php echo $review->getQtyRating(); ?>/5</p>
            <p><strong>Price Rating:</strong> <?php echo $review->getPriceRating(); ?>/5</p>
            <?php $averageRating = ($review->getQtyRating() + $review->getPriceRating()) / 2; ?>
            <p><strong>Overall Rating:</strong> <?php echo number_format($averageRating, 1); ?>/5</p>
            <p><strong>Review:</strong> <?php echo $review->getReviewText(); ?></p>
            <p><a href="reviews.php" id="back">Back to All Reviews</a></p>
        </div>
    </div>

<?php

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    if (!$_SESSION['Active']) {
        die("You must be logged in to post a comment.");
    }

    $commentText = trim($_POST['comment']);
    $userLoginID = $_SESSION['userLoginID'];

    if (!empty($commentText)) {
        // Sanitize input
        $commentText = htmlspecialchars($commentText, ENT_QUOTES, 'UTF-8');

        // Create and save comment
        try {
            $comment = new Comment(
                null, // commentID will be auto-generated
                $commentText,
                date('Y-m-d H:i:s'), // Current datetime
                $reviewId,
                $userLoginID,
                0
            );

            Comment::save($comment);
        } catch (Exception $e) {
            die("Error saving comment: " . $e->getMessage());
        }
    }
}


// Display comments
echo "<div class='comment-box'>";
echo "<strong>Comments:</strong><br>";

try {
    $comments = Comment::loadByReviewId($reviewId);

    if (empty($comments)) {
        echo "<p class='no-comments'>There are no comments yet. Be the first to comment!</p>";
    } else {
        foreach ($comments as $comment) {
            $userLoginID = $comment->getUserLoginID();

            try {
                require "../../backend/DBconnect.php";

                $sql = "SELECT login.Username
                            FROM login
                            JOIN user ON login.LoginID = user.UserLoginID
                            JOIN profile ON user.UserLoginID = profile.UserLoginID
                            WHERE login.LoginID = :id";

                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $userLoginID, PDO::PARAM_INT);
                $stmt->execute();

                $userName = $stmt->fetch(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                echo $e->getMessage();
            }

            echo "<div class='individual'>";
            echo "<a href='../login/publicProfile.php?user_id=" . $userLoginID . "'><strong>" . $userName['Username'] . "</strong></a> ";
            echo "<small>" . htmlspecialchars($comment->getCommentDateAndTime()) . "</small></p>";
            echo "<p>" . htmlspecialchars($comment->getCommentText()) . "</p>";
            echo "</div>";
        }
    }
} catch (Exception $e) {
    echo "<p>Error loading comments: " . $e->getMessage() . "</p>";
}

echo "</div>";

// Display comment form only if logged in
if ($_SESSION['Active'] && !$_SESSION['IsAdmin']) { ?>
    <html>
    <form method="post">
        <label for="comment">Write your comment here: </label>
        <br>
        <textarea id="comment" name="comment" rows="3" cols="50" required></textarea><br>
        <input type="submit" value="Submit Comment">
    </form>
    </html>
<?php } elseif (!$_SESSION['Active'] && !$_SESSION['IsAdmin']) {?>
    <p>Please <a href="../../public/login/login.php">login</a> to post a comment.</p>
<?php } ?>

