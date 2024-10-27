<?php
session_start();
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'includes/db_bangiay.inc';

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['TaiKhoan'])) {
    echo "<script>alert('Vui lòng đăng nhập trước khi đặt hàng.');</script>";
    echo "<script>window.location.href ='dangnhap.php';</script>";
    exit();
}
// Lấy thông tin người dùng từ session
$khachHang = $_SESSION['TaiKhoan'];
$makh = $khachHang['MaNguoiDung'];
$emailKhachHang = $khachHang['Email'];

// Kiểm tra nếu giỏ hàng rỗng
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Giỏ hàng của bạn đang trống!');</script>";
    echo "<script>window.location.href = 'giohang.php';</script>";
    exit();
}

$cart = $_SESSION['cart'];

try {
    $ngayDat = date("Y-m-d");
    $ngaygiaohang = date("Y-m-d", strtotime("+7 days")); // Giả sử ngày giao hàng là 7 ngày sau ngày đặt

    $sql = "INSERT INTO dondathang (DaThanhToan, TinhTrangGiaoHang, NgayDat, NgayGiao, MaKH)
            VALUES (0, 1, '$ngayDat', '$ngaygiaohang', '$makh')";
    $conn->query($sql);

    // Lấy ID của đơn đặt hàng vừa được thêm
    $maDonHang = $conn->insert_id;

    foreach ($cart as $idproduct => $product) {
        $soluong = $product['soluong'];
        $dongia = $product['gia'];
        // Sửa lại truy vấn để thêm đúng dữ liệu vào các cột của bảng chitietdathang
        $sql = "INSERT INTO chitietdathang (MaDonHang, MaSach, SoLuong, DonGia)
                VALUES ('$maDonHang', '$idproduct', '$soluong', '$dongia')";
        $conn->query($sql);
    }

    // Gửi email xác nhận đơn hàng
    $mail = new PHPMailer(true);

    try {
        // Cấu hình máy chủ
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Đặt máy chủ SMTP để gửi qua
        $mail->SMTPAuth = true;
        $mail->Username = 'voquangthanh2004@gmail.com'; // Tên đăng nhập SMTP
        $mail->Password = 'yaabdwynfprvipkt'; // Mật khẩu SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Người nhận
        $mail->setFrom('voquangthanh2004@gmail.com', 'H&T.Paraneit');
        $mail->addAddress($emailKhachHang); // Địa chỉ email của khách hàng

        // Nội dung
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "Xác nhận đơn hàng #$maDonHang";

        // Tạo nội dung email với bảng HTML
        $mail->Body = "
            <html>
            <head>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        padding: 10px;
                        text-align: left;
                        border-bottom: 1px solid #ddd;
                    }
                    th {
background-color: #f2f2f2;
                    }
                    .total {
                        font-weight: bold;
                    }
                </style>
            </head>
            <body>
                <h2>Cảm ơn quý khách đã đặt hàng tại cửa hàng H&T.Paraneit của chúng tôi.</h2>
                <p>Mã đơn hàng của quý khách là: <strong>$maDonHang</strong></p>
                <p>Ngày đặt hàng: <strong>$ngayDat</strong></p>
                <p>Chúng tôi sẽ liên hệ quý khách trong thời gian sớm nhất.</p>
                <h3>Chi tiết đơn hàng:</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá (VNĐ)</th>
                            <th>Thành tiền (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody>";

        // Thêm chi tiết sản phẩm vào bảng
        $tongTien = 0;
        foreach ($cart as $idproduct => $product) {
            $thanhTien = $product['gia'] * $product['soluong'];
            $tongTien += $thanhTien;
            $mail->Body .= "
                <tr>
                    <td>{$product['tensanpham']}</td>
                    <td>{$product['soluong']}</td>
                    <td>" . number_format($product['gia'], 0, ',', '.') . "</td>
                    <td>" . number_format($thanhTien, 0, ',', '.') . "</td>
                </tr>";
        }

        // Thêm tổng số tiền vào bảng
        $mail->Body .= "
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan='3' class='total'>Tổng số tiền:</td>
                            <td class='total'>" . number_format($tongTien, 0, ',', '.') . " VNĐ</td>
                        </tr>
                    </tfoot>
                </table>
            </body>
            </html>";

        $mail->send();
        echo 'Email đã được gửi thành công';
    } catch (Exception $e) {
        echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
    }

    // Xóa giỏ hàng sau khi đặt hàng thành công
    unset($_SESSION['cart']);
    echo "<h2 style='text-align:center;'>Đặt hàng thành công!</h2>";
    echo "<h3 style='text-align:center; font-weight:normal; font-style:italic;'>";
    echo "Đơn hàng của bạn đã được chúng tôi ghi nhận, <br>";
    echo "chúng tôi sẽ liên hệ quý khách trong thời gian sớm nhất<br>";
    echo "<div style='text-align:right; font-size:20px;'><a href='index.php'>Về trang chủ</a></div>";

} catch (Exception $e) {
    // Rollback nếu có lỗi xảy ra
    echo "<script>alert('Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại sau.');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
}
?>