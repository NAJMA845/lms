<?php
class PlanManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPlanById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM subscription_plans WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updatePlan($id, $data) {
        $sql = "UPDATE subscription_plans SET 
                title = ?, 
                amount = ?, 
                duration = ?,
                updated_at = CURRENT_TIMESTAMP 
                WHERE id = ?";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sdii",
            $data['title'],
            $data['amount'],
            $data['duration'],
            $id
        );
        
        return $stmt->execute();
    }
}
?>