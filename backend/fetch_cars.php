<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Dynamic CORS
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Allow-Credentials: true');
}
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit();

header('Content-Type: application/json');

require_once 'db.php';

try {
    $db = new Database();
    $conn = $db->connect();

    $stmt = $conn->query("SELECT car_id, car_name, model, price, year, plate_number, image, availability FROM cars");
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepend full URL for each car image
    $base_url = "http://localhost/car_rental/backend/images/"; // adjust path to your images folder
    foreach ($cars as &$car) {
        $car['image_url'] = $base_url . $car['image'];
    }

    echo json_encode($cars);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
