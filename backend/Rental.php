<!-- <?php
require_once 'db.php';

class Rental {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    // Rent a car for a specific user
    public function rentCar($user_id, $car_id) {
        try {
            // Check if car is available
            $stmt = $this->pdo->prepare("SELECT availability FROM car WHERE id = ?");
            $stmt->execute([$car_id]);
            $car = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$car || !$car['availability']) {
                return false; // Car not available
            }

            // Begin transaction to ensure data consistency
            $this->pdo->beginTransaction();

            // Insert rental record
            $stmt = $this->pdo->prepare("
                INSERT INTO rentals (user_id, car_id, rent_date)
                VALUES (?, ?, NOW())
            ");
            $rentalOk = $stmt->execute([$user_id, $car_id]);

            // Update car availability
            if ($rentalOk) {
                $stmt = $this->pdo->prepare("UPDATE car SET availability =  WHERE id = ?");
                $stmt->execute([$car_id]);
                $this->pdo->commit();
                return true;
            } else {
                $this->pdo->rollBack();
                return false;
            }

        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    // Get all rentals made by a specific user
    public function getRentalsByUser($user_id) {
        $stmt = $this->pdo->prepare("
            SELECT r.*, c.brand, c.model, c.plate_number
            FROM rentals r
            JOIN car c ON r.car_id = c.id
            WHERE r.user_id = ?
            ORDER BY r.rent_date DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?> -->
