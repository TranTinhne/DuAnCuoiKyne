<?php
include 'includes/db_bangiay.inc';
session_start();
ob_start();

if (isset($_SESSION['user'])) {
    $khachHang = $_SESSION['TaiKhoan'];
    $hoTen = $khachHang['HoTen'] ?? '';
    $soDienThoai = $khachHang['DienThoai'] ?? '';
    $email = $khachHang['Email'] ?? '';
    $diaChi = $khachHang['DiaChi'] ?? '';
} else {
    header("Location: dangnhap.php");
    exit();
}

// Lấy thông tin giỏ hàng từ session
$cart = $_SESSION['cart'];
$tongTien = 0;
?>
<div class="datmua-i">
<div class="container">
    <div class="row">
        <!-- Left Column: Chi tiết đơn hàng -->
        <div class="col-md-6">
            <h3 class="mt-4">CHI TIẾT ĐƠN HÀNG</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width='5%'>STT</th>
                        <th width='40%'>Tên sản phẩm</th>
                        <th width='20%'>Hình ảnh</th>
                        <th width='15%'>Đơn giá (VNĐ)</th>
                        <th width='10%'>Số lượng</th>
                        <th width='10%'>Thành tiền (VNĐ)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($cart as $id => $sach) {
                        $tongTien += $sach['gia'] * $sach['soluong'];
                        echo "<tr>";
                        echo "<td class='text-center'>" . ++$i . "</td>";
                        echo "<td>" . htmlspecialchars($sach['tensanpham']) . "</td>";
                        echo "<td class='text-center'><img src='img/" . $sach['hinhanh'] . "' class='img-responsive' style='max-width: 100px;'></td>";
                        echo "<td class='text-center'>" . number_format($sach['gia'], 0, ',', '.') . "</td>";
                        echo "<td class='text-center'>" . $sach['soluong'] . "</td>";
                        echo "<td class='text-center'>" . number_format($sach['gia'] * $sach['soluong'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                    ?>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Tổng cộng:</strong></td>
                        <td colspan="2" class="text-center"><strong><?php echo number_format($tongTien, 0, ',', '.'); ?> VNĐ</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Right Column: Thông tin đặt hàng -->
        <div class="col-md-6">
            <h2 class="text-center my-4">Thông tin đặt hàng</h2>
            <form action="xacnhandathang.php" method="post">
                <div class="form-group">
                    <label for="hoTen">Họ và tên:</label>
                    <input type="text" class="form-control" id="hoTen" name="hoTen" value="<?php echo $hoTen; ?>" required>
                </div>
                <div class="form-group">
                    <label for="soDienThoai">Số điện thoại:</label>
                    <input type="tel" class="form-control" id="soDienThoai" name="soDienThoai" value="<?php echo $soDienThoai; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="diaChi">Địa chỉ:</label>
                    <input type="text" class="form-control" id="diaChi" name="diaChi" value="<?php echo $diaChi; ?>" required>
                </div>
                <div class="form-group">
                    <label for="ngayGiaoHang">Chọn ngày giao hàng:</label>
                    <input type="date" class="form-control" id="ngayGiaoHang" name="ngayGiaoHang" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-warning">Đặt hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php
$content = ob_get_clean();
include 'includes/LayoutBanGiay.php';
?>
