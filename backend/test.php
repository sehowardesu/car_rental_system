<?php
header('Content-Type: application/json');
require_once 'db.php';

try {
    $db = new Database();
    $conn = $db->connect();

    $car_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if (!$car_id) {
        echo json_encode(null);
        exit;
    }

    $stmt = $conn->prepare("SELECT car_id, car_name, model, price, availability FROM cars WHERE car_id = :car_id");
    $stmt->execute(['car_id' => $car_id]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$car) {
        echo json_encode(null);
        exit;
    }

    // Return the car with exactly these keys
    echo json_encode([
        'car_id' => $car['car_id'],
        'car_name' => $car['car_name'],
        'model' => $car['model'],
        'price' => $car['price'],
        'availability' => $car['availability']
    ]);

} catch (Exception $e) {
    echo json_encode(null);
}
?>
