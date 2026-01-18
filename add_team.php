<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Member</title>
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
            background-color: #16a34a;
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
        <h3>Add New Member</h3>

        <form action="insert_team.php" method="post">
            <label>First Name</label>
            <input type="text" name="fname" required>

            <label>Last Name</label>
            <input type="text" name="lname" required>

            <label>Job</label>
            <input type="text" name="job" required>

            <button type="submit">Save Member</button>
        </form>

        <div class="back">
            <a href="team.php">← Back to list</a>
        </div>
    </div>

</body>

</html>