<?php include './App/Views/Layout/adminHeader.php'; ?>

<h2 class="mb-4">Danh sách đơn hàng</h2>

<form method="get" class="form-inline mb-3">
    <input type="hidden" name="url" value="adminorder/index">
    <label class="mr-2">Tháng</label>
    <select name="month" class="form-control mr-2">
        <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?= $i ?>" <?= $i == $month ? 'selected' : '' ?>><?= $i ?></option>
        <?php endfor; ?>
    </select>
    <label class="mr-2">Năm</label>
    <select name="year" class="form-control mr-2">
        <?php for ($y = 2022; $y <= date('Y'); $y++): ?>
            <option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>><?= $y ?></option>
        <?php endfor; ?>
    </select>
    <button class="btn btn-primary">Lọc</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Mã đơn</th>
            <th>Tên KH</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td>#<?= $order['id'] ?></td>
            <td><?= $order['customer_name'] ?? '-' ?></td>
            <td><?= $order['created_at'] ?></td>
            <td><?= number_format($order['total'], 0) ?> VNĐ</td>
            <td><?= $order['status'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<nav>
  <ul class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
            <a class="page-link" href="?url=adminorder/index&month=<?= $month ?>&year=<?= $year ?>&page=<?= $i ?>"><?= $i ?></a>
        </li>
    <?php endfor; ?>
  </ul>
</nav>

<?php include './App/Views/Layout/adminFooter.php'; ?>
