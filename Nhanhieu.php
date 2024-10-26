<?php
ob_start();
session_start();

// Include the database connection
include 'includes/db_bangiay.inc'; 

// Get the brand ID (MaNhanHieu) from the URL and sanitize it
$manhanhieu = isset($_GET['id']) ? (int)$_GET['id'] : 0; 

if ($manhanhieu <= 0) {
    echo "Mã nhãn hiệu không hợp lệ.";
    exit;
}

// SQL query to fetch products based on the selected brand
$sql = "SELECT MaSanPham, TenSanPham, AnhSanPham, GiaBan FROM sanpham WHERE MaNhanHieu = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $manhanhieu);
$stmt->execute();
$result = $stmt->get_result();

// Query to fetch the brand name
$sql_nhanhieu = "SELECT TenNhanHieu FROM nhan WHERE MaNhanHieu = ?";
$stmt_nhanhieu = $conn->prepare($sql_nhanhieu);
$stmt_nhanhieu->bind_param("i", $manhanhieu);
$stmt_nhanhieu->execute();
$result_nhanhieu = $stmt_nhanhieu->get_result();

if (!$result_nhanhieu || $result_nhanhieu->num_rows == 0) {
    echo "Lỗi: Nhãn hiệu không tồn tại.";
    exit;
}

$chude = $result_nhanhieu->fetch_assoc(); // Fetch the brand name
?>

<h2 class="text-center">SẢN PHẨM THEO NHÃN HIỆU: <?php echo htmlspecialchars($chude['TenNhanHieu']); ?></h2>
<hr>
<div class="row text-center">
    <?php
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $i++;
    ?>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-6 <?php if ($i % 3 == 0) echo "hidden-xs"; ?>">
            <div class="thumbnail">
                <img src="Images/<?php echo htmlspecialchars($row['AnhSanPham']); ?>" alt="Thumbnail Image"
                     class="img-responsive img-rounded imgbook zoom-image" style="width:400px;">
                <div class="caption">
                    <h4 style="min-height: 70px;">
                        <a href="Chitietsanpham.php?id=<?php echo $row['MaSanPham']; ?>"><?php echo htmlspecialchars($row['TenSanPham']); ?></a>
                    </h4>
                    <p>
                        <a href="ThemVaoGioHang.php?id=<?php echo $row['MaSanPham']; ?>&url=<?php 
                            $currentUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
                            echo urlencode($currentUrl); ?>" class="btn btn-primary" role="button">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
                            <?php echo number_format($row['GiaBan'], 0, ',', '.'); ?> ₫
                        </a>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php
$content = ob_get_clean();
include 'includes/LayoutBanGiay.php'; // Include the layout template
?>

<!-- Style for zoom effect -->
<style>
.zoom-image {
    width: 300px;
    transition: transform 0.3s ease;
}

.zoom-image:hover {
    transform: scale(1.1);
}
</style>
