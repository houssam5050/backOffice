<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Added</title>
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
            padding: 35px 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 420px;
            width: 100%;
        }

        .success {
            font-size: 22px;
            color: #16a34a;
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            margin-bottom: 30px;
        }

        .buttons a {
            display: block;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            transition: 0.2s;
        }

        .team {
            background-color: #4f46e5;
            color: white;
        }

        .team:hover {
            background-color: #4338ca;
        }

        .add {
            background-color: #22c55e;
            color: white;
        }

        .add:hover {
            background-color: #16a34a;
        }
    </style>
</head>

<body>

<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $job   = $_POST['job'];

    $sql = "INSERT INTO team (fname, lname, job) VALUES (:fname, :lname, :job)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fname' => $fname,
        ':lname' => $lname,
        ':job'   => $job
    ]);
}
?>

<div class="card">
    <div class="success"> Member Added Successfully!</div>
    <p>What would you like to do next?</p>

    <div class="buttons">
        <a class="team" href="team.php">View Team Members</a>
        <a class="add" href="add_team.php">Add Another Member</a>
    </div>
</div>

</body>
</html>
