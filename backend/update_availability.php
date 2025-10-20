<?php
require_once 'db.php'; // your PDO connection file

if (isset($_POST['car_id'], $_POST['availability'])) {
    $car_id = $_POST['car_id'];
    $availability = $_POST['availability']; // 1 or 2

    $stmt = $pdo->prepare("UPDATE cars SET availability = ? WHERE id = ?");
    if ($stmt->execute([$availability, $car_id])) {
        echo json_encode(["success" => true, "message" => "Car availability updated."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Missing parameters."]);
}
