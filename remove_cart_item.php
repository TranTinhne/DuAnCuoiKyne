<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    if (isset($_SESSION['cart'][$id])) {
        // Xóa sản phẩm khỏi giỏ hàng
        unset($_SESSION['cart'][$id]);
        
        // Tính toán tổng giá mới
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal += $item['gia'] * $item['soluong'];
        }
        
        echo json_encode([
            'success' => true,
            'subtotal' => $subtotal,
            'message' => 'Item removed successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Product not found in cart'
        ]);
    }
}
?>