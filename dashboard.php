<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: ../index.php");
    exit;
}

include('db.php');
include('Sidebar.php');

$userCount = $pdo->query("SELECT COUNT(*) as count FROM users")->fetch(PDO::FETCH_ASSOC)['count'];
$productsCount = $pdo->query("SELECT COUNT(*) as count FROM products")->fetch(PDO::FETCH_ASSOC)['count'];
$teamCount = $pdo->query("SELECT COUNT(*) as count FROM team")->fetch(PDO::FETCH_ASSOC)['count'];
$orderCount = $pdo->query("SELECT COUNT(*) as count FROM orders")->fetch(PDO::FETCH_ASSOC)['count'];
$pendingOrders = $pdo->query("SELECT COUNT(*) as count FROM orders WHERE status = 'pending'")->fetch(PDO::FETCH_ASSOC)['count'];



$latestOrders = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

$recentTeam = $pdo->query("SELECT * FROM team ORDER BY id DESC LIMIT 4")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .main-content {
            margin-left: 220px;
            padding: 30px;
            min-height: 100vh;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            color: #1b1b2f;
            font-size: 28px;
            margin: 0;
        }

        .welcome-text {
            color: #666;
            font-size: 16px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 24px;
            color: white;
        }

        .users-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .team-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .orders-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .pending-icon {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        }

        .stat-info h3 {
            margin: 0;
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-info .number {
            font-size: 32px;
            font-weight: 700;
            margin: 5px 0;
            color: #1b1b2f;
        }

        .stat-info .change {
            font-size: 13px;
            color: #28a745;
            font-weight: 600;
        }

        /* Charts and Tables Section */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .dashboard-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .card-header h3 {
            margin: 0;
            color: #1b1b2f;
            font-size: 18px;
        }

        .view-all {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .view-all:hover {
            text-decoration: underline;
        }

        /* Market Data Card */
        .market-card {
            background: linear-gradient(135deg, #1b1b2f 0%, #16213e 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(27, 27, 47, 0.2);
        }

        .market-card h3 {
            color: #ffb400;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .market-table {
            width: 100%;
            border-collapse: collapse;
        }

        .market-table th {
            text-align: left;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffb400;
            font-weight: 600;
        }

        .market-table td {
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .market-table tr:last-child td {
            border-bottom: none;
        }

        .positive {
            color: #4ade80;
        }

        .negative {
            color: #f87171;
        }

        /* Orders Table */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th {
            text-align: left;
            padding: 12px 15px;
            background: #f8f9fa;
            color: #666;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .orders-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .orders-table tr:hover {
            background: #f8f9ff;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background: #d1e7dd;
            color: #0f5132;
        }

        /* Team Members */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .team-member {
            text-align: center;
            padding: 20px;
            background: #f8f9ff;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
            background: #edf0ff;
        }

        .member-avatar {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 600;
        }

        .member-name {
            font-weight: 600;
            margin-bottom: 5px;
            color: #1b1b2f;
        }

        .member-job {
            color: #666;
            font-size: 13px;
        }

        /* Footer */
        .dashboard-footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #eee;
            margin-top: 30px;
        }

        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="main-content">
        <div class="dashboard-header">
            <div>
                <h1>Dashboard Overview</h1>
                <p class="welcome-text">Welcome back! Here's what's happening with your store today.</p>
            </div>
            <div class="date-info">
                <?php echo date('l, F j, Y'); ?>
            </div>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon users-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Users</h3>
                    <div class="number"><?php echo $userCount; ?></div>
                    <div class="change">+2.5% from last month</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orders-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Products</h3>
                    <div class="number">
                        <?php echo $productsCount; ?>
                    </div>
                    <div class="change">+15% from last week</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon team-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stat-info">
                    <h3>Team Members</h3>
                    <div class="number"><?php echo $teamCount; ?></div>
                    <div class="change">Active team members</div>
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-icon orders-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Orders</h3>
                    <div class="number"><?php echo $orderCount; ?></div>
                    <div class="change">+15% from last week</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon pending-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3>Pending Orders</h3>
                    <div class="number"><?php echo $pendingOrders; ?></div>
                    <div class="change">Need attention</div>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="market-card">
                <h3><i class="fas fa-chart-line"></i> Market Overview</h3>
                <table class="market-table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Value</th>
                            <th>Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>house</td>
                            <td>49077.23</td>
                            <td class="positive">+1.21%</td>
                        </tr>
                        <tr>
                            <td>electronic</td>
                            <td>89943.92</td>
                            <td class="positive">+2.26%</td>
                        </tr>
                        <tr>
                            <td>sport</td>
                            <td>231.30</td>
                            <td class="positive">+0.13%</td>
                        </tr>
                        <tr>
                            <td>toys</td>
                            <td>3019.31</td>
                            <td class="positive">+2.82%</td>
                        </tr>
                        <tr>
                            <td>wepons</td>
                            <td>887.33</td>
                            <td class="negative">-0.48%</td>
                        </tr>
                        <tr>
                            <td>S&P 500</td>
                            <td>6875.62</td>
                            <td class="positive">+1.16%</td>
                        </tr>
                        <tr>
                            <td>NASDAQ</td>
                            <td>23224.83</td>
                            <td class="positive">+1.18%</td>
                        </tr>
                        <tr>
                            <td>S&P 100</td>
                            <td>3387.52</td>
                            <td class="positive">+0.98%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-receipt"></i> Recent Orders</h3>
                    <a href="orders.php" class="view-all">View All →</a>
                </div>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($latestOrders as $order): ?>
                            <tr>
                                <td>#<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></td>
                                <td>User #<?php echo $order['user_id']; ?></td>
                                <td><?php echo number_format($order['total'], 2); ?> MAD</td>
                                <td>
                                    <span class="status-badge status-<?php echo strtolower($order['status']); ?>">
                                        <?php echo $order['status']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-user-friends"></i> Team Members</h3>
                    <a href="team.php" class="view-all">View All →</a>
                </div>
                <div class="team-grid">
                    <?php foreach ($recentTeam as $member): ?>
                        <div class="team-member">
                            <div class="member-avatar">
                                <?php echo substr($member['email'], 0, 1); ?>
                            </div>
                            <div class="member-name">
                                <?php echo htmlspecialchars($member['email']); ?>
                            </div>
                            <div class="member-job">
                                <?php echo htmlspecialchars($member['job']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-pie"></i> Performance Summary</h3>
                </div>
                <div style="padding: 15px 0;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                        <div style="text-align: center;">
                            <div style="font-size: 32px; font-weight: 700; color: #1b1b2f;"><?php echo $orderCount; ?>
                            </div>
                            <div style="color: #666; font-size: 14px;">Total Orders</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 32px; font-weight: 700; color: #1b1b2f;"><?php
                            $totalRevenue = $pdo->query("SELECT SUM(total) as total FROM orders WHERE status = 'confirmed'")->fetch(PDO::FETCH_ASSOC)['total'];
                            echo number_format($totalRevenue ?: 0, 2);
                            ?> MAD</div>
                            <div style="color: #666; font-size: 14px;">Revenue</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 32px; font-weight: 700; color: #1b1b2f;"><?php
                            $avgOrder = $orderCount > 0 ? ($totalRevenue / $orderCount) : 0;
                            echo number_format($avgOrder, 2);
                            ?></div>
                            <div style="color: #666; font-size: 14px;">Avg. Order</div>
                        </div>
                    </div>

                    <div style="background: #f8f9fa; border-radius: 10px; padding: 20px;">
                        <h4 style="margin-top: 0; color: #666; font-size: 14px;">Quick Actions</h4>
                        <div style="display: flex; gap: 10px; margin-top: 15px;">
                            <a href="add_team.php"
                                style="flex: 1; background: #667eea; color: white; text-align: center; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                <i class="fas fa-user-plus"></i> Add Team
                            </a>
                            <a href="orders.php"
                                style="flex: 1; background: #10b981; color: white; text-align: center; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                <i class="fas fa-eye"></i> View Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="dashboard-footer">
            <p>© <?php echo date('Y'); ?> Store Dashboard. All rights reserved. | Last updated:
                <?php echo date('h:i A'); ?></p>
        </div>
    </div>

</body>

</html>