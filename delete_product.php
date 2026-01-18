<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        header("Location: products.php");
        exit();
    } catch (PDOException $e) {
        echo "Error deleting product: " . $e->getMessage();
    }
} else {
    echo "No product ID provided.";
}
?>