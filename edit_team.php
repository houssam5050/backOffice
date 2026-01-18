<?php
include('db.php');

if (!isset($_GET['id'])) {
    header("Location: team.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $job   = $_POST['job'];

    $sql = "UPDATE team 
            SET fname = :fname, lname = :lname, job = :job
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fname' => $fname,
        ':lname' => $lname,
        ':job'   => $job,
        ':id'    => $id
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
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
            background-color: #4f46e5;
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
    </style>
</head>

<body>

<div class="card">
    <h3>Edit Member</h3>

    <form method="post">
        <label>First Name</label>
        <input type="text" name="fname" value="<?= htmlspecialchars($member['fname']) ?>" required>

        <label>Last Name</label>
        <input type="text" name="lname" value="<?= htmlspecialchars($member['lname']) ?>" required>

        <label>Job</label>
        <input type="text" name="job" value="<?= htmlspecialchars($member['job']) ?>" required>

        <button type="submit">Update Member</button>
    </form>

    <div class="back">
        <a href="team.php">← Back to list</a>
    </div>
</div>

</body>
</html>
