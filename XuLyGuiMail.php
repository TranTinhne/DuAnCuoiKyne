<?php
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;

$from = $_POST['From'];
$to = $_POST['To'];
$subject = $_POST['subject'];
$notes = $_POST['Notes'];
$attachment = $_FILES['Attachment'];

$mail = new PHPMailer(true);

try {
    // Cấu hình SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'voquangthanh2004@gmail.com';
    $mail->Password = 'yaabdwynfprvipkt'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->CharSet = 'UTF-8'; 
    $mail->setFrom($from);
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $notes;

    if ($attachment['size'] > 0) {
        $mail->addAttachment($attachment['tmp_name'], $attachment['name']);
    }

    // Gửi email
    if ($mail->send()) {
        echo 'Email đã được gửi thành công';
        session_start();
        $_SESSION['mail'] = 'Gửi mail thành công.';
        header('Location: GuiMail.php');
    } else {
        echo 'Gửi email thất bại';
    }
} catch (Exception $e) {
    echo 'Lỗi khi gửi email: ', $mail->ErrorInfo;
}
?>