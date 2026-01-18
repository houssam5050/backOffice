<?php
include('db.php');

if (!isset($_GET['id'])) {
    header('Location: team.php');
    exit;
}
$id = $_GET['id'];

$sql = "DELETE FROM team WHERE  id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

header('Location: team.php');
exit;
?>