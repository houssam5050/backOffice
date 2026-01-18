<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        echo "Please fill in all fields.";
        exit();
    }

    
    $stmt = $pdo->prepare("SELECT * FROM login WHERE username = :username OR email = :email");
    $stmt->execute(['username' => $username, 'email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "Username or email is already in use.";
    } else {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $stmt = $pdo->prepare("INSERT INTO login (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        echo "Registration successful! You can now log in.";
    }
} else {
    echo "No form data submitted.";
}
?>
