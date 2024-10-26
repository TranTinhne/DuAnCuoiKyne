<?php
  //ob_start(); 
  //$title="Gửi Mail"
?>

<?php
session_start();
if (isset($_SESSION["mail"])) {
    echo "<h2 style='color:red;'>" . $_SESSION["mail"] . "</h2>";
    unset($_SESSION["mail"]);
}
?>

<div>
  <form action="XuLyGuiMail.php" name="SendMail" method="post" enctype="multipart/form-data">
    <div>Người gửi:</div>
    <input name="From" type="email" required />
    
    <div>Người nhận:</div>
    <input name="To" type="email" required />
    
    <div>Tiêu đề:</div>
    <input name="subject" type="text" required />
    
    <div>Nội dung:</div>
    <textarea name="Notes" rows="4"></textarea>
    
    <div>File đính kèm:</div>
    <input name="Attachment" type="file" />
    
    <hr />
    <input type="submit" value="Gửi" />
  </form>
</div>

<?php
 $content = ob_get_clean(); 
  include 'includes/LayoutBanGiay.php';
?>