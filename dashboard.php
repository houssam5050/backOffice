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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <title>Dashboard</title>
    <style>
           body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f2f4f8;
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
    </style>
</head>
<body>
   



     <div class="content">
        <h2>Dashboard Overview</h2>

        <div class="cards-container">
            <div class="card-box">
                <h3>💰 Total Earnings</h3>
                <p><?= $total_earnings ?></p>
            </div>
            <div class="card-box">
                <h3>📈 Sales Growth</h3>
                <p><?= $sales_growth ?></p>
            </div>
            <div class="card-box">
                <h3>📦 Total Products</h3>
                <p><?= $total_products ?></p>
            </div>
            <div class="card-box">
                <h3>🌐 Admin</h3>
                <p><?= $total_users ?></p>
            </div>
            <div class="card-box">
                <h3>🛒 New Orders</h3>
                <p><?= $new_orders ?></p>
            </div>
            <div class="card-box">
                <h3>🚚 Pending Shipments</h3>
                <p><?= $pending_shipments ?></p>
            </div>
        </div>
</body>
</html>