<?php
include "includes/db_bangiay.inc";
header('Content-Type: application/json');

$products_per_page = 8;

// Lấy trang từ request
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$category_id = isset($_GET['category']) ? $_GET['category'] : 'all';

// Tính total và offset
$sql_count = "SELECT COUNT(*) AS total FROM sanpham";
if ($category_id !== 'all') {
    $sql_count .= " WHERE MaLoaiSanPham = '$category_id'";
}
$result_count = $conn->query($sql_count);
$total_products = $result_count->fetch_assoc()['total'];
$total_pages = ceil($total_products / $products_per_page);
$offset = ($page - 1) * $products_per_page;

// Query sản phẩm
$sql_products = "SELECT * FROM sanpham";
if ($category_id !== 'all') {
    $sql_products .= " WHERE MaLoaiSanPham = '$category_id'";
}
$sql_products .= " LIMIT $products_per_page OFFSET $offset";

$result_products = $conn->query($sql_products);
$products = [];

while ($row = $result_products->fetch_assoc()) {
    $products[] = $row;
}

// Query categories
$sql_categories = "SELECT * FROM loaisanpham";
$result_categories = $conn->query($sql_categories);
$categories = [];

while ($row = $result_categories->fetch_assoc()) {
    $categories[$row['MaLoaiSanPham']] = $row['TenLoaiSanPham'];
}

echo json_encode([
    'products' => $products,
    'categories' => $categories,
    'totalPages' => $total_pages,
    'currentPage' => $page
]);