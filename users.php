<?php
include('db.php');
include('Sidebar.php');

$using = $pdo->query("SELECT * FROM users ORDER BY id DESC");
$users = $using->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(to right, #e3f2fd, #e8eaf6);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
            padding: 25px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-size: 28px;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 18px;
            background: #007bff;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background-color: #1b1b2f;
            color: #ffb400;
            padding: 14px;
            font-size: 16px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            font-size: 25px;
            color: #333;
        }

        tr:nth-child(even) {
            background: #f5f5f5;
        }

        tr:hover {
            background: #eeeeee;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Users List</h2>

       

        <table border="4">
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>

            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['username']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>

</body>

</html>