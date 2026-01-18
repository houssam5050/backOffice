<?php
include('db.php');
include('Sidebar.php');
$team = $pdo->query("SELECT * FROM team")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Team Members</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
      
    body {
        font-family: Arial, sans-serif;
        background: #f4f6fb;
        margin: 0;
    }

    /* Main content beside sidebar */
    .main-content {
        margin-left: 220px; /* SAME width as sidebar */
        padding: 30px;
        min-height: 100vh;
    }

    .container {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        min-width: 600px;
    }

    th, td {
        padding: 14px 18px;
        text-align: center;
    }

    th {
        background-color: #1b1b2f;
        color: #ffb400;
    }

    tr:nth-child(even) {
        background-color: #f9fafb;
    }

    tr:hover {
        background-color: #eef2ff;
    }

    .actions a {
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 14px;
        margin: 0 3px;
    }

    .edit {
        background-color: #22c55e;
        color: white;
    }

    .delete {
        background-color: #ef4444;
        color: white;
    }

    .links {
        text-align: center;
        margin-top: 20px;
    }

    .links a {
        margin: 0 10px;
        color: #1b1b2f;
        font-weight: bold;
        text-decoration: none;
    }


    </style>
</head>

<body>

<div class="main-content">
    <div class="container">
        <h2>Team Members</h2>

        <div class="links">
            <a href="add_team.php">➕ Add Member</a>
            
        </div>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Job</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($team as $t): ?>
                <tr>
                    <td><?= htmlspecialchars($t['fname']) ?></td>
                    <td><?= htmlspecialchars($t['lname']) ?></td>
                    <td><?= htmlspecialchars($t['job']) ?></td>
                    <td class="actions">
                        <a class="edit" href="edit_team.php?id=<?= $t['id'] ?>">Edit</a>
                        <a class="delete" href="delete_team.php?id=<?= $t['id'] ?>"
                           onclick="return confirm('Are you sure?')">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        
    </div>
</div>

</body>
