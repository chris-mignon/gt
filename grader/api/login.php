<?php
session_start();
require_once "../db.php";

$email = $_POST['email'];
$pass = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if(!$user || !password_verify($pass, $user['password_hash'])){
    echo json_encode(["success" => false, "error" => "Invalid login"]);
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];

echo json_encode(["success" => true]);
