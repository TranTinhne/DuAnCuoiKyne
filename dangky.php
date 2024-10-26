<?php
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

include 'includes/db_bangiay.inc';
$note = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $hoten = trim($_POST['HoTen']);
    $username = trim($_POST['TenDN']);
    $password = trim($_POST['MatKhau']);
    $email = trim($_POST['Email']);
    $diachi = trim($_POST['DiaChi']);
    $dienthoai = trim($_POST['DienThoai']);
    $ngaysinh = trim($_POST['NgaySinh']);
    
    // Kiểm tra dữ liệu không được rỗng
    if (empty($hoten) || empty($username) || empty($password) || empty($email) || empty($diachi) || empty($dienthoai) || empty($ngaysinh)) {
        $note = "Vui lòng điền đầy đủ thông tin.";
    } 
    else {
        // Kiểm tra tài khoản đã tồn tại hay chưa
        $sql = "SELECT * FROM KhachHang WHERE TaiKhoan = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $note = "Tên đăng nhập đã tồn tại.";
        } else {
            // Kiểm tra email đã tồn tại hay chưa
            $sql = "SELECT * FROM KhachHang WHERE Email = '$email'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $note = "Email đã tồn tại.";
            } else {
                // Lưu thông tin vào bảng KhachHang
                $sql = "INSERT INTO KhachHang (HoTen, TaiKhoan, MatKhau, Email, DiaChi, DienThoai, NgaySinh) 
                        VALUES ('$hoten', '$username', '$password', '$email', '$diachi', '$dienthoai', '$ngaysinh')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $note = "Đăng ký thành công!";
                    
                    // Gửi email thông báo bằng PHPMailer
                    $mail = new PHPMailer(true);
                    try {
                        // Cấu hình máy chủ SMTP
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'Trantinh28012004@gmail.com';
                        $mail->Password = 'xkuasjkkwkhlhqqz'; // Sử dụng mật khẩu ứng dụng
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        $mail->CharSet = 'UTF-8';

                        // Người gửi và người nhận
                        $mail->setFrom('Trantinh28012004@gmail.com', 'Your Website');
                        $mail->addAddress($email, $hoten);

                        // Nội dung email
                        $mail->isHTML(true);
                        $mail->Subject = 'Đăng Ký Tài Khoản Thành Công SachOnline'; 
                        $mail->Body    = "Chào $hoten,<br><br>Cảm ơn bạn đã đăng ký tài khoản tại trang web của chúng tôi.<br><br>Thông tin tài khoản của bạn:<br>Tên đăng nhập: $username<br>Email: $email<br><br>Trân trọng,<br>Đội ngũ hỗ trợ";
                        $mail->AltBody = "Chào $hoten,\n\nCảm ơn bạn đã đăng ký tài khoản tại trang web của chúng tôi.\n\nThông tin tài khoản của bạn:\nTên đăng nhập: $username\nEmail: $email\n\nTrân trọng,\nĐội ngũ hỗ trợ";

                        $mail->send();
                        $note .= " Email thông báo đã được gửi.";
                    } catch (Exception $e) {
                        $note .= " Đăng ký thành công nhưng không thể gửi email thông báo. Lỗi: {$mail->ErrorInfo}";
                    }
                } else {
                    $note = "Lỗi: " . $conn->error;
                }
            }
        }
    }
}
$conn->close();
?>

<div class="main">
    <form action="" method="POST" class="form" id="form-1">
        <h2>Đăng Ký</h2>
        <div class="spacer"></div>

        <!-- Hiển thị thông báo -->
        <?php if (!empty($note)): ?>
            <div class="alert"><?php echo $note; ?></div>
        <?php endif; ?>

        <div class="form-group">
            <label for="HoTen" class="form-label">Tên đầy đủ</label>
            <input id="HoTen" name="HoTen" type="text" placeholder="VD: Tran Tinh" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="TenDN" class="form-label">Tài khoản</label>
            <input id="TenDN" name="TenDN" type="text" placeholder="VD: Tranting123" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="Email" class="form-label">Email</label>
            <input id="Email" name="Email" type="text" placeholder="VD: email@domain.com" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="DiaChi" class="form-label">Địa chỉ</label>
            <input id="DiaChi" name="DiaChi" type="text" placeholder="" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="DienThoai" class="form-label">Điện thoại</label>
            <input id="DienThoai" name="DienThoai" type="text" placeholder="VD: 039*******" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="NgaySinh" class="form-label">Ngày sinh</label>
            <input id="NgaySinh" name="NgaySinh" type="date" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Mật khẩu</label>
            <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="MatKhau" class="form-label">Nhập lại mật khẩu</label>
            <input id="MatKhau" name="MatKhau" placeholder="Nhập lại mật khẩu" type="password" class="form-control">
            <span class="form-message"></span>
        </div>

        <button type="submit" class="form-submit">Đăng ký</button>
    </form>
</div>

<?php
$content = ob_get_clean();
include("includes/LayoutBanGiay.php");
?>