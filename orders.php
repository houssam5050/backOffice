<?php
include('db.php');
include('Sidebar.php');
$stmt = $pdo->query("SELECT * FROM orders");
$order = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
        }

        table {
            margin-top: 100px;
            border-collapse: collapse;

        }

        th,
        td {
            border: 2px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h3>orders list</h3>
    <br><br>

    <table border="2">
        <tr>
            <th>id</th>
            <th>user</th>
            <th>total</th>
            <th>status</th>
            <th>date</th>
            <th>Action</th>
        </tr>
        <?php foreach($order as $o): ?>
        <tr>
            <td><?= $o['id'] ?></td>
            <td><?= $o['user_id'] ?></td>
            <td><?= $o['total'] ?></td>
            <td><?= $o['status'] ?></td>
            <td><?= $o['created_at']?></td>
            <td>edit</td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>