<?php ob_start();
session_start();
?>
<?php include "Countdown.php" ?>
<?php include "sanphamgiamgia.php"?>


<?php include "includes/linelong.php" ?>

<?php include "danhsachsanpham.php" ?>

<?php include "danhsachsanphammonthethao.php"?>

<?php
$content = ob_get_clean();
include "includes/LayoutBanGiay.php";
?>