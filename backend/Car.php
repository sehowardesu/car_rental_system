<?php
require_once 'db.php';

class Car {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllCars() {
        $stmt = $this->pdo->prepare("SELECT * FROM cars");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCar($brand, $model, $year, $price, $plate_number, $image) {
        $stmt = $this->pdo->prepare("
            INSERT INTO car (brand, model, year, price_per_day, plate_number, availability, image)
            VALUES (?, ?, ?, ?, ?, 1, ?)
        ");
        return $stmt->execute([$brand, $model, $year, $price, $plate_number, $image]);
    }

    public function updateCar($id, $brand, $model, $year, $price, $plate_number, $availability, $image) {
        $stmt = $this->pdo->prepare("
            UPDATE car SET brand=?, model=?, year=?, price_per_day=?, plate_number=?, availability=?, image=? 
            WHERE id=?
        ");
        return $stmt->execute([$brand, $model, $year, $price, $plate_number, $availability, $image, $id]);
    }

    public function deleteCar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM car WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
