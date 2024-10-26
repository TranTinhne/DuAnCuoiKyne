<?php
include "includes/db_bangiay.inc";

// Số sản phẩm mỗi trang
$products_per_page = 4; // Giới hạn 4 sản phẩm mỗi trang

// Tính toán tổng số sản phẩm
$sql_count = "SELECT COUNT(*) AS total FROM sanpham";
$result_count = $conn->query($sql_count);
$total_products = $result_count->fetch_assoc()['total'];

// Tính toán số trang
$total_pages = ceil($total_products / $products_per_page);

// Lấy trang hiện tại từ GET (mặc định là 1)
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, min($current_page, $total_pages)); // Đảm bảo trang hợp lệ

// Tính toán OFFSET
$offset = ($current_page - 1) * $products_per_page;

// Truy vấn dữ liệu sản phẩm với thông tin giảm giá
$sql_products = "
    SELECT sanpham.*, giamgia.discount_type, giamgia.discount_value
    FROM sanpham
    LEFT JOIN giamgia ON sanpham.MaSanPham = giamgia.MaSanPham 
        AND CURDATE() BETWEEN giamgia.start_date AND giamgia.end_date
    LIMIT $products_per_page OFFSET $offset
";
$result_products = $conn->query($sql_products);

$products = [];
if ($result_products->num_rows > 0) {
    while ($row = $result_products->fetch_assoc()) {
        $products[] = $row;
    }
}

// Truy vấn dữ liệu loại sản phẩm
$sql_categories = "SELECT * FROM loaisanpham";
$result_categories = $conn->query($sql_categories);

$categories = [];
if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[$row['MaLoaiSanPham']] = $row['TenLoaiSanPham'];
    }
}
?>
<style>
    .fruite-img img {
        width: 100%;
        height: 200px; /* Chiều cao cố định */
        object-fit: cover; /* Đảm bảo hình ảnh không bị méo */
    }
    .discount-tag {
        background-color: red;
        color: white;
        padding: 5px;
        position: absolute;
        top: 10px;
        right: 10px;
        border-radius: 5px;
        font-weight: bold;
    }
</style>
<div class="container py-5">
    <div class="tab-class text-center">
        <div class="row g-4">
            <div class="col-lg-4 text-start">
                <h1>Sản phẩm giảm giá</h1>
            </div>
            
        </div>
        <div class="tab-content">
            <div id="tab-all1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    <?php
                    foreach ($products as $product):
                        $giaGoc = $product['Gia'];
                        $giaSauGiam = $giaGoc;

                        // Kiểm tra nếu có giảm giá
                        if ($product['discount_type'] && $product['discount_value']) {
                            if ($product['discount_type'] === 'percentage') {
                                $giaSauGiam = $giaGoc - ($giaGoc * ($product['discount_value'] / 100));
                            } else if ($product['discount_type'] === 'fixed') {
                                $giaSauGiam = $giaGoc - $product['discount_value'];
                            }
                        }
                        ?>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item">
                                <div class="fruite-img">
                                    <img src="img/<?php echo $product['hinhanh']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                    <?php echo $categories[$product['MaLoaiSanPham']]; ?>
                                </div>

                                <!-- Nếu có giảm giá thì hiển thị nhãn giảm giá -->
                                <?php if ($giaSauGiam < $giaGoc): ?>
                                    <div class="discount-tag">Giảm giá!</div>
                                <?php endif; ?>

                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4><?php echo $product['TenSanPham']; ?></h4>
                                    <p><?php echo $product['MoTa']; ?></p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-0">
                                            <?php if ($giaSauGiam < $giaGoc): ?>
                                                <span class="text-danger text-decoration-line-through"><?php echo $giaGoc; ?> / VND</span>
                                                <span class="text-success"><?php echo $giaSauGiam; ?> / VND</span>
                                            <?php else: ?>
                                                <?php echo $giaGoc; ?> / VND
                                            <?php endif; ?>
                                        </p>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary">
                                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
       
    </div>
</div>
