<?php
require_once __DIR__ . '/../Model/OrderModel.php';

class AdminOrderController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $month = $_GET['month'] ?? date('m');
        $year = $_GET['year'] ?? date('Y');
        $page = $_GET['page'] ?? 1;
        $limit = 10;

        $orders = $this->orderModel->getOrdersByMonthYear($month, $year, $page, $limit);
        $total = $this->orderModel->countOrdersByMonthYear($month, $year);
        $totalPages = ceil($total / $limit);

        include './App/Views/Admin/order_list.php';
    }
}
