<?php
include('db.php');
include('Sidebar.php');

if (isset($_POST['delete_id'])) {
    $id = (int) $_POST['delete_id'];

    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: orders.php");
    exit;
}

if (isset($_POST['confirm_id'])) {
    $id = (int) $_POST['confirm_id'];

    $stmt = $pdo->prepare("UPDATE orders SET status = 'confirmed' WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: orders.php");
    exit;
}

$stmt = $pdo->query("
    SELECT id, user_id, product_id, total, status, quantity, created_at
    FROM orders
    ORDER BY created_at DESC
");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        h3 {
            color: #000000;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        thead {
            background-color: #1b1b2f;
            color: #ffb400;
        }

        th, td {
            padding: 14px 16px;
            text-align: center;
        }

        th {
            font-size: 14px;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f4ff;
        }

        tr:hover {
            background-color: #e6ebff;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .status.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status.completed {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status.cancelled {
            background-color: #f8d7da;
            color: #842029;
        }

        .total {
            font-weight: bold;
            color: #198754;
        }

        .date {
            font-size: 13px;
            color: #555;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
            }

            table {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<div class="content">
    <h3>Orders List</h3>

    <table>
        <thead>
            <tr>
                
                <th>User_Id</th>
                <th>Product_Id</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $o): ?>
            <tr>
                
                <td><?= $o['user_id'] ?></td>
                <td><?= $o['product_id'] ?></td>
                <td class="total"><?= $o['total'] ?> MAD</td>
                
                <td>
                    <span class="status <?= strtolower($o['status']) ?>">
                        <?= $o['status'] ?>
                    </span>
                </td>
                <td class="date"><?= $o['created_at'] ?></td>

                <td>
    <!-- CONFIRM -->
    <form method="POST" style="display:inline;">
        <input type="hidden" name="confirm_id" value="<?= $o['id'] ?>">
        <button type="submit" class="btn-confirm">
            ✔ Confirm
        </button>
    </form>

    <!-- DELETE -->
    <form method="POST" style="display:inline;"
          onsubmit="return confirm('Delete this order?')">
        <input type="hidden" name="delete_id" value="<?= $o['id'] ?>">
        <button type="submit" class="btn-delete">
            ❌ Delete
        </button>
    </form>
</td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
