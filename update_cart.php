<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['soluong'] = $quantity;
        
        // Tính toán tổng giá mới
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal += $item['gia'] * $item['soluong'];
        }
        
        echo json_encode([
            'success' => true,
            'subtotal' => $subtotal,
            'message' => 'Cart updated successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Product not found in cart'
        ]);
    }
}
?>