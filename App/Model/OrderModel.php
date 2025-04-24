<?php
require_once __DIR__ . '/../../Core/database.php';
class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function getAllOrders()
    {
        $stmt = $this->db->prepare("SELECT * FROM orders ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOrder($userId, $totalAmount)
    {
        $sql = "INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, 'Đặt hàng')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $totalAmount]);
        return $this->db->lastInsertId();
    }

        public function addOrderItem($orderId, $productId, $quantity, $price)
    {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$orderId, $productId, $quantity, $price]);
    }

    public function getOrdersByUserId($userId)
    {
    $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrdersByMonthYear($month, $year, $page, $limit)
    {
    $offset = ($page - 1) * $limit;
    $stmt = $this->db->prepare("SELECT * FROM orders WHERE MONTH(created_at) = ? AND YEAR(created_at) = ? ORDER BY id DESC LIMIT ?, ?");
    $stmt->execute([$month, $year, $offset, $limit]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countOrdersByMonthYear($month, $year)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM orders WHERE MONTH(created_at) = ? AND YEAR(created_at) = ?");
        $stmt->execute([$month, $year]);
        return $stmt->fetchColumn();
    }



   
}
