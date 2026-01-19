<?php
session_start();
if (isset($_SESSION["account"])) {
    header("location: products/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #0d1b2a; /* dark blue */
        }
        .login-card {
            background-color: #ffffff;
            border-radius: 8px;
        }
        .login-title {
            color: #0d1b2a;
        }
        .icon-input {
            color: #f4a261; /* orange/yellow */
        }
        .btn-login {
            background-color: #f4a261;
            border: none;
            color: #0d1b2a;
        }
        .btn-login:hover {
            background-color: #e76f51;
            color: #fff;
        }
        .demo-text {
            color: #0d1b2a;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="min-height:100vh;">

<div class="card login-card p-4" style="width:100%; max-width:420px;">
    <h4 class="text-center login-title mb-2">
        <i class="bi bi-box-arrow-in-right icon-input"></i> Login
    </h4>
    <p class="text-center text-muted mb-4">Sign in to your account</p>

    <form action="db_login.php" method="POST">

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">
                <i class="bi bi-envelope icon-input"></i> Email
            </label>
            <input type="email" name="email" class="form-control" placeholder="Email address" required>
            <small class="demo-text">
                Demo: <strong>email@hh.com</strong>
            </small>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">
                <i class="bi bi-lock icon-input"></i> Password
            </label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <small class="demo-text">
                Demo password: <strong>email@hh.com</strong>
            </small>
        </div>

        <button type="submit" class="btn btn-login w-100 mt-2">
            <i class="bi bi-arrow-right-circle"></i> Sign In
        </button>

    </form>
</div>

</body>
</html>
