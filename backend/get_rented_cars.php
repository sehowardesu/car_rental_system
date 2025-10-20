<?php
require_once 'db.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost:5177"); // your React dev server
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}


$database = new Database();
$conn = $database->connect();

$user_id = $_GET['user_id'] ?? 0;

$stmt = $conn->prepare("
  SELECT cars.car_id, cars.car_name, cars.model, cars.plate_number
  FROM rented_cars
  JOIN cars ON rented_cars.car_id = cars.car_id
  WHERE rented_cars.user_id = ?
");
$stmt->execute([$user_id]);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($cars);
