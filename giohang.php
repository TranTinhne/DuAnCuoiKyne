<?php
session_start();
?>
<?php if (!empty($_SESSION['cart'])) { ?>
<style>
    body {
    background-color: #f8f9fa;
}

h1 {
    font-family: 'Arial', sans-serif;
    color: #343a40;
}

    .table th, .table td {
    vertical-align: middle;
}

.table img {
    border-radius: 8px; /* Làm góc hình ảnh tròn */
}

.table tbody tr:hover {
    background-color: #f8f9fa; /* Hiệu ứng hover cho hàng */
}

.btn-danger {
    border-radius: 20px; /* Làm góc nút xóa tròn */
}
.btn {
    border-radius: 25px; /* Làm góc nút tròn */
    padding: 10px 20px; /* Khoảng cách trong nút */
    border: none; /* Không có đường viền */
    transition: background-color 0.3s, transform 0.3s; /* Hiệu ứng chuyển đổi */
    font-weight: bold; /* Chữ đậm */
}

.btn-primary {
    background-color: #007bff; /* Màu xanh dương */
    color: #fff; /* Màu chữ trắng */
}

.btn-primary:hover {
    background-color: #0056b3; /* Màu nền khi di chuột */
    transform: translateY(-2px); /* Đưa nút lên khi di chuột */
}

.btn-success {
    background-color: #28a745; /* Màu xanh lá cây */
    color: #fff; /* Màu chữ trắng */
}

.btn-success:hover {
    background-color: #218838; /* Màu nền khi di chuột */
    transform: translateY(-2px); /* Đưa nút lên khi di chuột */
}

.btn-danger {
    background-color: #dc3545; /* Màu đỏ */
    color: #fff; /* Màu chữ trắng */
}

.btn-danger:hover {
    background-color: #c82333; /* Màu nền khi di chuột */
    transform: translateY(-2px); /* Đưa nút lên khi di chuột */
}

.btn-warning {
    background-color: #ffc107; /* Màu vàng */
    color: #fff; /* Màu chữ trắng */
}

.btn-warning:hover {
    background-color: #e0a800; /* Màu nền khi di chuột */
    transform: translateY(-2px); /* Đưa nút lên khi di chuột */
}

</style>
<form action="capnhat.php" method="post">
<table class="table table-bordered table-striped">
    <thead>
        <tr class="text-center">
            <th width="5%">STT</th>
            <th width="40%">Tên sản phẩm</th>
            <th width="20%">Hình</th>
            <th width="15%">Giá (VNĐ)</th>
            <th width="10%">Số lượng</th>
            <th width="10%">Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $s = 0;
        foreach ($_SESSION['cart'] as $id => $product) {
            $s += $product['gia'] * $product['soluong'];
            echo "<tr>";
            echo "<td class='text-center'>" . ++$i . "</td>";
            echo "<td>" . $product['tensanpham'] . "</td>";
            echo "<td><img src='img/" . $product['hinhanh'] . "' class='img-responsive' style='width: 100px;'></td>";
            echo "<td class='text-center'>" . number_format($product['gia'], 0, ',', '.') . "</td>";
            echo "<td class='text-center'><input type='number' name='soluong[" . $id . "]' value='" . $product['soluong'] . "' class='form-control' style='width: 60px; text-align: center;'></td>";
            echo "<td class='text-center'><a href='xoasp.php?id=" . $product['masanpham'] . "' class='btn btn-danger btn-sm'>Xóa</a></td>";
            echo "</tr>";
        }
        ?>
    <tr>
        <td colspan="6" class="text-right">
            <strong>Tổng số tiền: <?php echo number_format($s, 0, ',', '.'); ?> VNĐ</strong>
        </td>
    </tr>
    <tr>
    <td colspan="6" class="text-center">
        <input type="submit" value="Cập nhật" class="btn btn-primary">
        <input type="button" value="Mua tiếp" class="btn btn-success" 
               onclick="window.location='index.php'">
        <input type="button" value="Hủy giỏ hàng" class="btn btn-danger"
               onclick="window.location='huygiohang.php'">
        <input type="button" value="Đặt mua" class="btn btn-warning"
               onclick="window.location='datmua.php'">
    </td>
</tr>
</tbody>
</table>
</form>
<?php } else { ?>
<h2 class="text-center">Giỏ hàng trống</h2>
<div class="text-center">
    <a href="index.php" class="btn btn-info">Quay về</a>
</div>
<?php } ?>
<?php
$content = ob_get_clean();
include 'includes/LayoutBanGiay.php';
?>