<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $category = trim($_POST['category']);

    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
        echo "❌ Image upload failed.";
        exit();
    }

    $imageName = time() . "-" . basename( $_FILES['image']['name']);
    $targetPath = "uploads/" . $imageName;

    move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);

    try {
        $stmt = $pdo->prepare("INSERT INTO products (name, image, price, category)
        VALUES (:name, :image, :price, :category)");
        $stmt->execute([
            'name' => $name,
            'image' => $imageName,
            'price' => $price,
            'category' => $category
        ]);

        header("Location: products.php");
        exit();
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f9fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 380px;
            text-align: center;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #218838;
        }

        #previewImage {
            display: none;
            width: 130px;
            margin-top: 10px;
            border-radius: 10px;
        }

        .back-link {
            margin-top: 20px;
            display: block;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>➕ Add New Product</h2>

        <form action="add_product.php" method="POST" enctype="multipart/form-data">

            <label>Product Name:</label>
            <input type="text" name="name" required>

            <label>Product Image:</label>
            <input type="file" name="image" id="imageInput" accept="image/*" required>

            <img id="previewImage" alt="Preview">

            <label>Price (MAD):</label>
            <input type="number" step="0.01" name="price" required>

            <label>Category:</label>
            <input type="text" name="category" required>

            <button type="submit">Add Product</button>
        </form>

        <a href="products.php" class="back-link">⬅ Back to Product List</a>
    </div>


    <script>
        // IMAGE PREVIEW SCRIPT
        document.getElementById("imageInput").addEventListener("change", function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById("previewImage");

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = "block";
            }
        });
    </script>

</body>

</html>