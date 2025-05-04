<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products Page</title>
    <link rel="stylesheet" href="css/products.css">
</head>
<body>
    <nav>
        <?php require "../../templates/topnav.php" ?>
    </nav>

    <!-- button to add product (only seen by admin) -->
    <?php if ($_SESSION['IsAdmin']) { ?>
    <div class="add">
        <a href="addProduct.php">Add a Product</a>
    </div>
    <?php } ?>

    <h1>Products</h1>
    <!-- search and filter -->
    <form method="post" class="search">
        <label for="search">Search by Product Name</label>
        <input type="text" id="search" name="search" value="<?php echo isset($search) ? htmlspecialchars($search) : ''; ?>">

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

        <div>
            <?php
            require_once "../../classes/products.class.php";
            require_once "../../backend/DBconnect.php";

            $search = '';
            $category = '';
            $whereClauses = [];
            $params = [];
            $products = [];

            try {
                //sql query to retrieve from database
                $sql = "SELECT *
                        FROM products";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }

            //search and filter
            if (isset($_POST['submit'])) {
                try {
                    //search
                    if (!empty($_POST['search'])) {
                        $search = trim($_POST['search']);
                        $whereClauses[] = "ProductName LIKE :search";
                        $params[':search'] = "%$search%";
                    }

                    //filter
                    if (!empty($_POST['category'])) {
                        $category = trim($_POST['category']);
                        $whereClauses[] = "ProductType = :category";
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
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $error) {
                    echo $sql . "<br>" . $error->getMessage();
                }
            }

            if (empty($products)) {
                echo "<p>No products to show yet.</p>";
            } else {
                foreach ($products as $row) {
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
                    ?>
                    <div class='box'>

                        <!-- display for admin -->
                        <?php if ($_SESSION['IsAdmin'] && $_SESSION['Active']) { ?>
                        <!-- product image -->
                        <div class='thumbnail'>
                                <?php
                                $imagePath = $product->getProductImage() ? '../../data/images/' . $product->getProductImage() : '../../data/images/placeholders/PlaceHolderProduct.png';
                                ?>
                                <img src="<?php echo $imagePath; ?>" alt="<?php echo $product->getProductName(); ?>">
                            </div>

                    <!-- display product info -->
                        <div class='product'>
                                <strong>Category:</strong> <?php echo $product->getProductType(); ?><br>
                                <strong>Product Name:</strong> <?php echo $product->getProductName(); ?><br>
                                <strong>Manufacturer:</strong> <?php echo $product->getProductManufacturer(); ?><br>
                                <a href='productDetail.php?id=<?php echo $product->getProductID(); ?>' class='view-button'>View Details</a>
                            <!-- button to update -->
                            <a href='updateProduct.php?id=<?php echo htmlspecialchars($product->getProductID()); ?>' class='view-button'>Update</a>
                            <!-- button to delete -->
                            <a href='deleteProduct.php?id=<?php echo htmlspecialchars($product->getProductID()); ?>' class='view-button' id="delete">Delete</a>
                            <!-- display for average user -->
                            <?php } else {?>
                                <div class='thumbnail'>
                                    <!-- product image -->
                                    <?php
                                    $imagePath = $product->getProductImage() ? '../../data/images/' . $product->getProductImage() : '../../data/images/placeholders/PlaceHolderProduct.png';
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" alt="<?php echo $product->getProductName(); ?>">
                                </div>
                            <!-- product details -->
                            <div class='product'>
                                    <strong>Category:</strong> <?php echo $product->getProductType(); ?><br>
                                    <strong>Product Name:</strong> <?php echo $product->getProductName(); ?><br>
                                    <strong>Manufacturer:</strong> <?php echo $product->getProductManufacturer(); ?><br>
                                    <a href='productDetail.php?id=<?php echo $product->getProductID(); ?>' class='view-button'>View Details</a>
                                    <?php }?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>