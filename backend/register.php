<?php
$origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
header("Access-Control-Allow-Origin: $origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit();

// =======================
// Include database connection
// =======================
require_once 'db.php';

$database = new Database();
$conn = $database->connect();

// =======================
// Get raw JSON input
// =======================
$data = json_decode(file_get_contents("php://input"), true);

// =======================
// Validate input
// =======================
if (
    !$data ||
    empty($data['fullname']) ||
    empty($data['username']) ||
    empty($data['contact_number']) ||
    empty($data['address']) ||
    empty($data['email']) ||
    empty($data['password'])
) {
    echo json_encode([
        "success" => false,
        "message" => "All fields are required."
    ]);
    exit;
}

// =======================
// Sanitize inputs
// =======================
$fullname = htmlspecialchars(strip_tags($data['fullname']));
$username = htmlspecialchars(strip_tags($data['username']));
$contact_number = htmlspecialchars(strip_tags($data['contact_number']));
$address = htmlspecialchars(strip_tags($data['address']));
$email = htmlspecialchars(strip_tags($data['email']));
$password = password_hash($data['password'], PASSWORD_DEFAULT);

try {
    // =======================
    // Check if email or username already exists
    // =======================
    $checkQuery = "SELECT id FROM users WHERE email = :email OR username = :username";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(":email", $email);
    $checkStmt->bindParam(":username", $username);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        echo json_encode([
            "success" => false,
            "message" => "Email or Username already exists."
        ]);
        exit;
    }

    // =======================
    // Insert new user
    // =======================
    $query = "INSERT INTO users 
                (fullname, username, contact_number, address, email, password) 
              VALUES 
                (:fullname, :username, :contact_number, :address, :email, :password)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":fullname", $fullname);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":contact_number", $contact_number);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    echo json_encode([
        "success" => true,
        "fullname" => $fullname,
        "message" => "Registration successful!"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}
?>
