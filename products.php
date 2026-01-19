<?php
include('db.php');
include('Sidebar.php');

$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_earnings = "30955$";
$sales_growth = "+55%";
$total_products = count($products);
$total_users = "Houssam Hamdan";
$new_orders = 24;
$pending_shipments = 15;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f2f4f8;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 220px;
            height: 100%;
            background-color: #1b1b2f;
            color: #fff;
            padding-top: 60px;
            z-index: 1000;
            transition: 0.3s;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #ffb400;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #ddd;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar a:hover,
        .sidebar .active {
            background-color: #ffb400;
            color: #1b1b2f;
            border-radius: 8px;
        }

        /* Content */
        .content {
            margin-left: 220px;
            padding: 60px 30px;
        }

        /* Cards */
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }

        .card-box {
            flex: 1 1 220px;
            background: linear-gradient(145deg, #ffffff, #e3f2fd);
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: 0.3s;
        }

        .card-box:hover {
            transform: translateY(-5px);
        }

        .card-box h3 {
            font-size: 18px;
            color: #1b1b2f;
        }

        .card-box p {
            font-size: 22px;
            font-weight: bold;
            color: #0d47a1;
        }

        /* Table */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 700px;
            background: #fff;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #1b1b2f;
            color: #ffb400;
        }

        tr:hover {
            background-color: #e3f2fd;
        }

        td img {
            max-width: 70px;
            height: auto;
        }

        .actions a {
            padding: 6px 12px;
            margin: 4px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .edit {
            background-color: #4caf50;
        }

        .delete {
            background-color: #f44336;
        }

        /* Button */
        .button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 30px;
            background: linear-gradient(135deg, #facc15, #f59e0b);
            color: #7c2d12;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .button:hover {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            color: #fff;
        }

        /* MOBILE FIXES */
        @media (max-width: 768px) {
            .sidebar {
                left: -220px; /* hidden by default */
            }

            .sidebar.show {
                left: 0; /* show when toggled */
            }

            .content {
                margin-left: 0;
                padding: 20px 15px;
            }

            .cards-container {
                flex-direction: column;
            }

            .card-box {
                width: 100%;
            }

            .button {
                width: 100%;
                justify-content: center;
            }

            /* Hamburger menu button */
            .mobile-menu {
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 2000;
                background: #ffb400;
                color: #1b1b2f;
                border: none;
                padding: 10px 12px;
                border-radius: 8px;
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

 

    <div class="content">
     

        <h2>🛍 Recent Products</h2>
        <a href="add_product.php" class="button">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>
        <br><br>

        <div class="table-responsive">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><img src="uploads/<?= htmlspecialchars($product['image']) ?>"></td>
                        <td><?= htmlspecialchars($product['price']) ?> MAD</td>
                        <td><?= htmlspecialchars($product['category']) ?></td>
                        <td class="actions">
                            <a href="edit_products.php?id=<?= $product['id'] ?>" class="edit">Edit</a>
                            <a href="delete_product.php?id=<?= $product['id'] ?>" class="delete"
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>

</body>
</html>
