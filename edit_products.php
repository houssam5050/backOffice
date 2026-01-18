<?php
include("db.php");

if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found!";
    exit();
}

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];


    $imageName = $product['image'];


    if (!empty($_FILES['image']['name'])) {


        $imageName = time() . "-" . basename($_FILES['image']['name']);
        $uploadPath = "uploads/" . $imageName;


        move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
    }

    $update = $pdo->prepare("
        UPDATE products 
        SET name = ?, price = ?, category = ?, image = ? 
        WHERE id = ?
    ");
    $update->execute([$name, $price, $category, $imageName, $id]);

    header("Location: products.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>

    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #f2f4f7;
            padding: 40px;
        }

        .edit-container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 20px;
        }

        .btn {
            background: #28a745;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }

        .back-btn {
            text-align: center;
            margin-top: 15px;
            display: block;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }
    </style>

</head>

<body>

    <div class="edit-container">
        <h2>✏ Edit Product</h2>

        <form method="POST" enctype="multipart/form-data">

            <label>Product Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>">

            <label>Price (MAD):</label>
            <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>">

            <label>Category:</label>
            <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>">

            <label>Current Image:</label><br>
            <img src="uploads/<?= $product['image'] ?>" width="120px" style="border-radius:8px;"><br><br>

            <label>Upload New Image (optional):</label>
            <input type="file" name="image" id="imageInput" accept="image/*">
            <button type="submit" name="update" class="btn">💾 Save Changes</button>
        </form>

        <a href="products.php" class="back-btn">⬅ Back</a>
    </div>

</body>

</html>