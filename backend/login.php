<?php
require_once 'db.php';
$database = new Database();
$conn = $database->connect();

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['email']) || empty($data['password'])) {
    echo json_encode(["success" => false, "message" => "Email and password required"]);
    exit;
}

$email = htmlspecialchars($data['email']);
$password = $data['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(":email", $email);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['fullname'] = $user['fullname'];
    $_SESSION['username'] = $user['username'] ?? '';
    $_SESSION['role'] = $user['role'] ?? 'user';

    echo json_encode([
        "success" => true,
        "userId" => $user['id'],
        "fullname" => $user['fullname'],
        "username" => $user['username'] ?? ''
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid email or password"]);
}
