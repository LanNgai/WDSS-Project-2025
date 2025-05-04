<!-- form to add a product -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AddProduct.css">
    <nav>
        <?php require "../../templates/topnav.php" ?>
    </nav>
    <title>Add New Product</title>
</head>
<body>
    <form method="post" action="postProduct.php" enctype="multipart/form-data" class="product-form">
        <div class="review">
            <h1 id="title">Add New Product</h1>

            <!-- input product name -->
            <div class="form-group">
                <label for="pName">Product Name*</label> <br>
                <input type="text" id="product_name" name="pName" required class="form-control">
            </div>

            <br>

            <!-- choose a category -->
            <div class="form-group">
                <label for="category">Category*</label> <br>
                <select id="product_type" name="category" required class="form-control">
                    <option value="">Select a category</option>
                    <option value="Toy">Toy</option>
                    <option value="Food">Food</option>
                    <option value="Litter">Litter</option>
                    <option value="Misc">Miscellaneous</option>
                </select>
            </div>

            <br>

            <!-- input manufacturer -->
            <div class="form-group">
                <label for="manufacturer">Manufacturer*</label> <br>
                <input type="text" id="manufacturer" name="manufacturer" required class="form-control">
            </div>

            <br>

            <!-- input description -->
            <div class="form-group">
                <label for="description">Product Description*</label> <br>
                <textarea id="description" name="description" rows="10" cols="50" required class="form-control"></textarea>
            </div>

            <br>

            <!-- input link to product -->
            <div class="form-group">
                <label for="product_link">Product Link (URL)*</label> <br>
                <input type="url" id="product_link" name="product_link" required class="form-control"
                       placeholder="https://example.com/product">
            </div>

            <br>

            <!-- select image -->
            <div class="form-group">
                <label for="product_image">Product Image*</label> <br>
                <input type="file" id="product_image" name="product_image" accept="image/*" required class="form-control">
            </div>

            <br>

            <div class="form-group">
                <input type="submit" value="Add Product" id="submit" class="btn-submit">
            </div>
        </div>
    </form>
<?php include '../../templates/footer.php'?>