<?php
include "includes/db_bangiay.inc";

// Số sản phẩm mỗi trang
$products_per_page = 8;

// Tính toán tổng số sản phẩm
$sql_count = "SELECT COUNT(*) AS total FROM sanpham";
$result_count = $conn->query($sql_count);
$total_products = $result_count->fetch_assoc()['total'];

// Tính toán số trang
$total_pages = ceil($total_products / $products_per_page);

// Lấy trang hiện tại từ GET (mặc định là 1)
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$current_page = max(1, min($current_page, $total_pages)); // Đảm bảo trang hợp lệ

// Tính toán OFFSET
$offset = ($current_page - 1) * $products_per_page;

// Truy vấn dữ liệu sản phẩm với LIMIT và OFFSET
$sql_products = "SELECT * FROM sanpham LIMIT $products_per_page OFFSET $offset";
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
        height: 200px;
        /* Chiều cao cố định */
        object-fit: cover;
        /* Đảm bảo hình ảnh không bị méo */
    }
</style>
<div class="container py-5">
    <div class="tab-class text-center">
        <div class="row g-4">
            <div class="col-lg-4 text-start">
                <h1>Sản phẩm</h1>
            </div>
            <div class="col-lg-8 text-end">
                <ul class="nav nav-pills d-inline-flex text-center mb-5">
                    <li class="nav-item">
                        <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-all">
                            <span class="text-dark" style="width: 130px;">Tất cả sản phẩm</span>
                        </a>
                    </li>
                    <?php foreach ($categories as $category_id => $category_name): ?>
                        <li class="nav-item">
                            <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill"
                                href="#tab-<?php echo $category_id; ?>">
                                <span class="text-dark" style="width: 130px;"><?php echo $category_name; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div id="tab-all" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    <?php
                    foreach ($products as $product):
                        ?>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <a href="chitietsp.php?MaSanPham=<?php echo $product['MaSanPham']; ?>">
                                                <img src="img/<?php echo $product['hinhanh']; ?>"
                                                    class="img-fluid w-100 rounded-top" alt="">
                                            </a>
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                            style="top: 10px; left: 10px;">
                                            <?php echo $categories[$product['MaLoaiSanPham']]; ?>
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>
                                                <a href="chitietsp.php?MaSanPham=<?php echo $product['MaSanPham']; ?>">
                                                    <?php echo $product['TenSanPham']; ?>
                                                </a>
                                            </h4>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0"><?php echo $product['Gia']; ?> </p>
                                                <a href="ThemVaoGioHang.php?id=<?php echo $product['MaSanPham']; ?>&url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>"
                                                    class="btn border border-secondary rounded-pill px-3 text-primary">
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
            <?php foreach ($categories as $category_id => $category_name): ?>
                <div id="tab-<?php echo $category_id; ?>" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <?php
                        foreach ($products as $product):
                            if ($product['MaLoaiSanPham'] == $category_id):
                                ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <a href="chitietsp.php?MaSanPham=<?php echo $product['MaSanPham']; ?>">
                                                <img src="img/<?php echo $product['hinhanh']; ?>"
                                                    class="img-fluid w-100 rounded-top" alt="">
                                            </a>
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                            style="top: 10px; left: 10px;">
                                            <?php echo $categories[$product['MaLoaiSanPham']]; ?>
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>
                                                <a href="chitietsp.php?MaSanPham=<?php echo $product['MaSanPham']; ?>">
                                                    <?php echo $product['TenSanPham']; ?>
                                                </a>
                                            </h4>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0"><?php echo $product['Gia']; ?> </p>
                                                <a href="ThemVaoGioHang.php?id=<?php echo $product['MaSanPham']; ?>&url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>"
                                                    class="btn border border-secondary rounded-pill px-3 text-primary">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($i === $current_page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>