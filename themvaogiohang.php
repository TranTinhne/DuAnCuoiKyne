<?php
include 'includes/db_bangiay.inc';

session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM sanpham WHERE MaSanPham = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if ($row) {
    // Kiểm tra xem giỏ hàng đã có session chưa
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        if (array_key_exists($id, $cart)) {
            // Nếu có thì tăng số lượng
            $_SESSION['cart'][$id]['soluong']++;
        } else {
            // Nếu chưa thì thêm vào giỏ hàng
            $_SESSION['cart'][$id] = array(
                "masanpham" => $row['MaSanPham'],
                "tensanpham" => $row['TenSanPham'],
                "hinhanh" => $row['hinhanh'],
                "gia" => $row['Gia'],
                "soluong" => 1
            );
        }
    } else {
        // Nếu giỏ hàng chưa có gì, khởi tạo giỏ hàng và lưu sách vừa chọn
        $_SESSION['cart'] = array();
        $_SESSION['cart'][$id] = array(
            "masanpham" => $row['MaSanPham'],
            "tensanpham" => $row['TenSanPham'],
            "hinhanh" => $row['hinhanh'],
            "gia" => $row['Gia'],
            "soluong" => 1
        );
    }

    // Chuyển hướng đến trang giỏ hàng
    header("Location: giohang.php");
}
?>
