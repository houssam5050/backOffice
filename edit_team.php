<?php
include('db.php');

if (!isset($_GET['id'])) {
    header("Location: team.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $job = $_POST['job'];

    $sql = "UPDATE team 
            SET email = :email, password = :password, job = :job
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => $email,
        ':password' => $password,
        ':job' => $job,
        ':id' => $id
    ]);

    header("Location: team.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM team WHERE id = :id");
$stmt->execute([':id' => $id]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$member) {
    echo "Member not found";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Member</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: white;
            padding: 30px 35px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #4f46e5;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #22c55e;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4338ca;
        }

        .back {
            text-align: center;
            margin-top: 15px;
        }

        .back a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: bold;
        }

        .back a:hover {
            text-decoration: underline;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }
    </style>
</head>

<body>

    <div class="card">
        <h3>Edit Member</h3>

        <form method="post">
            <label>email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($member['email']) ?>" required>

            <label>password</label>
            <input type="password" name="password" placeholder="Leave blank to keep current password">
            <label>Role</label>
            <select name="job" required>
                <option value="">-- Select a role --</option>
                <option value="Admin" <?= $member['job'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                <option value="Manager" <?= $member['job'] == 'Manager' ? 'selected' : '' ?>>Manager</option>
                <option value="Delivery" <?= $member['job'] == 'Delivery' ? 'selected' : '' ?>>Delivery</option>
                <option value="Visitor" <?= $member['job'] == 'Delivery' ? 'selected' : '' ?>>Visitor</option>
            </select>

            <button type="submit">Update Member</button>
        </form>

        <div class="back">
            <a href="team.php">← Back to list</a>
        </div>
    </div>

</body>

</html>