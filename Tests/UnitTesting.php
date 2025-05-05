<?php

//This is the Unit Test script.
require "../classes/User.class.php";
require_once "../classes/Login.class.php";
require "../classes/Product.class.php";
require "../classes/Review.class.php";
require "../classes/UserProfile.class.php";
require "../classes/Admin.class.php";


$bio = "This is the bio in the unit test";
$picture = "placeholder_pfp.jpg";
$id = 1;
$name = "Testing";
$email = "testing@gmail.com";
$password = "testing";

$userProfile = new UserProfile($bio, $picture);
$login = new Login($id, $name, $email, $password);
$user = new User($id, $name, $email, $password, $userProfile);
$admin = new Admin($id, $name, $email, $password);


$productName = "Testing Product Class";
$productType = "Testing Product Type";
$productDescription = "Testing Product Description";
$productManufacturer  = "Testing Product Manufacturer";
$productImage = "Testing Product Image";
$productLink = "Testing Product Link";
$productID = 2;
$adminLoginID = 3;

$product = new Product($productName, $productType, $productDescription, $productManufacturer, $productImage, $productLink, $productID, $adminLoginID);

$reviewID = 4;
$qualityRating = 4;
$priceRating = 5;
$reviewText = "Testing Review";
$dateCreated = date("Y-m-d H:i:s");

$review = new Review($reviewID, $productID, $adminLoginID, $qualityRating, $priceRating, $reviewText, $dateCreated, $product);

//Testing inheritance, getUsername(), getEmail(), getPassword() are inherited from Login class.
echo "Testing inheritance with Login and User classes.<br>User class";
var_dump($user->getUsername());
echo "<br>";
var_dump($user->getEmail());
echo "<br>";
var_dump($user->getPassword());
echo "<br>";
echo "<br>Admin class";

var_dump($admin->getUsername());
echo "<br>";
var_dump($admin->getEmail());
echo "<br>";
var_dump($admin->getPassword());
echo "<br><br>";

//Testing Composition, $userProfile object is there in $user.
echo "Testing composition in User Class<br>";
var_dump($user->getProfile());

//Testing Composition, $product is in $review.
echo "Testing composition in User Class<br>";
echo "Product ID: ";
var_dump($review->getProductID());
echo "<br>";
var_dump($review->getProductName());
echo "<br>";
var_dump($review->getProductImage());
echo "<br>";
var_dump($review->getProductType());
echo "<br><br>";

//Testing Review Class.
echo "Testing Review Class<br>";
echo "Admin ID: ";
var_dump($review->getAdminLoginID());
echo "<br>";
var_dump($review->getReviewText());
echo "<br>";
echo "Date Created: ";
var_dump($review->getDateCreated());
echo "<br>";
echo "Quality Rating: ";
var_dump($review->getQtyRating());
echo "<br>";
echo "Price Rating: ";
var_dump($review->getPriceRating());
echo "<br>";

