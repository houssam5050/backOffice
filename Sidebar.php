<?php
session_start();


if (isset($_SESSION['team_id'])) {
    $stm = $pdo->prepare('SELECT * FROM team WHERE id = :id');
    $stm->execute(['id' => $_SESSION['team_id']]);
    $team = $stm->fetch(PDO::FETCH_ASSOC);

    if ($team) {
        $_SESSION['team'] = $team;
    }
}

$teamJob = isset($_SESSION['team']['job']) ? $_SESSION['team']['job'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <title>Admin Panel</title>
    <style>
     
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
    </style>
</head>

<body>
    <button class="mobile-menu d-md-none" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <div class="sidebar">
        <h3>🛍 Admin Panel</h3>

        <?php if ($teamJob === 'Admin' || $teamJob === 'manager'): ?>
        <?php elseif ($teamJob === 'visitor'): ?>
                <a href="dashboard.php"><i class="bi bi-house-door" disabled></i> Dashboard</a>
        <?php endif ?>
            <a href="dashboard.php"><i class="bi bi-house-door"></i> Dashboard</a>

        <a href="products.php"><i class="bi bi-box-seam"></i> Products</a>
        <a href="users.php"><i class="bi bi-people"></i> Users</a>
        <a href="orders.php"><i class="bi bi-bag"></i> Orders</a>
        <a href="team.php"><i class="bi bi-people"></i> Team</a>
        <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.left = sidebar.style.left === '0px' ? '-220px' : '0px';
        }
    </script>
</body>

</html>