<?php
require_once 'db.php';

class User {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function login($emailOrUsername, $password){
        // Allow login with either email or username
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$emailOrUsername, $emailOrUsername]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            if(session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['username'] = $user['username']; // store username too
            $_SESSION['role'] = 'user';
            return true;
        }
        return false;
    }

    // Optional: get user info
    public function getUserById($id){
        $stmt = $this->pdo->prepare("SELECT id, fullname, username, email, contact_number, address FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
