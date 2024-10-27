<?php session_start(); ?>

<div class="giohang-i">
    <div class="cart-container">
        <?php if (!empty($_SESSION['cart'])) { ?>
            <h1 class="cart-title">Giỏ hàng</h1>
            <div class="cart-content">
                <div class="cart-items">
                    <?php
                    $subtotal = 0;
                    foreach ($_SESSION['cart'] as $id => $product) {
                        $subtotal += $product['gia'] * $product['soluong'];
                    ?>
                        <div class="cart-item" data-price="<?php echo $product['gia']; ?>" id="item-<?php echo $id; ?>">
                            <div class="product-image">
                                <img src="img/<?php echo $product['hinhanh']; ?>" alt="<?php echo $product['tensanpham']; ?>">
                            </div>
                            <div class="product-details">
                                <h2 class="product-name"><?php echo $product['tensanpham']; ?></h2>
                                <p class="product-category">Shop</p>
                            </div>
                            <div class="product-actions">
                                <div class="quantity-controls">
                                    <button class="trash-btn" onclick="decreaseQuantity(<?php echo $id; ?>)">
                                        <i class="trash-icon">🗑️</i>
                                    </button>
                                    <input type="number" name="soluong[<?php echo $id; ?>]"
                                           value="<?php echo $product['soluong']; ?>" 
                                           min="1"
                                           class="quantity-input"
                                           data-id="<?php echo $id; ?>"
                                           onchange="updateQuantity(<?php echo $id; ?>, this.value)">
                                    <button class="add-btn" onclick="increaseQuantity(<?php echo $id; ?>)">
                                        <i class="add-icon">+</i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-price">
                                <?php echo number_format($product['gia'], 0, ',', '.'); ?>₫
                            </div>
                        </div>
                    <?php } ?>
                </div>
                
                <div class="cart-summary">
                    <h2>Tổng </h2>
                    <div class="summary-row">
                        <span>Tổng tiền</span>
                        <span id="subtotal"><?php echo number_format($subtotal, 0, ',', '.'); ?>₫</span>
                    </div>
                    <div class="summary-row">
                        <span>Dự kiến Giao hàng & Xử lý</span>
                        <span> Miễn phí</span>
                    </div>
                    <div class="summary-row total">
                        <span>Tổng cộng</span>
                        <span id="total"><?php echo number_format($subtotal, 0, ',', '.'); ?>₫</span>
                    </div>
                    <button class="checkout-btn guest" onclick="window.location.href='datmua.php'">Đặt hàng</button>
                </div>
            </div>
        <?php } else { ?>
            <div class="empty-cart">
                <h2>Your bag is empty</h2>
                <a href="index.php" class="continue-shopping">Continue Shopping</a>
            </div>
        <?php } ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include "includes/LayoutBanGiay.php";
?>
<script>
function decreaseQuantity(id) {
    let input = document.querySelector(`input[name="soluong[${id}]"]`);
    let currentQty = parseInt(input.value);
    
    if (currentQty <= 1) {
        removeItem(id);
    } else {
        updateQuantity(id, currentQty - 1);
    }
}

function increaseQuantity(id) {
    let input = document.querySelector(`input[name="soluong[${id}]"]`);
    let currentQty = parseInt(input.value);
    updateQuantity(id, currentQty + 1);
}

function removeItem(id) {
    fetch('remove_cart_item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            const itemElement = document.getElementById(`item-${id}`);
            itemElement.remove();
            updateTotals();
            checkEmptyCart();
        }
    });
}

function updateQuantity(id, newQuantity) {
    let input = document.querySelector(`input[name="soluong[${id}]"]`);
    input.value = newQuantity;

    fetch('update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}&quantity=${newQuantity}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            updateTotals();
        }
    });
}

function updateTotals() {
    let subtotal = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        let price = parseInt(item.dataset.price);
        let quantity = parseInt(item.querySelector('.quantity-input').value);
        subtotal += price * quantity;
    });

    document.getElementById('subtotal').textContent = formatCurrency(subtotal);
    document.getElementById('total').textContent = formatCurrency(subtotal);
}

function checkEmptyCart() {
    if (document.querySelectorAll('.cart-item').length === 0) {
        const cartContent = document.querySelector('.cart-content');
        cartContent.innerHTML = `
            <div class="empty-cart">
                <h2>Your bag is empty</h2>
                <a href="index.php" class="continue-shopping">Continue Shopping</a>
            </div>
        `;
    }
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', { 
        style: 'currency', 
        currency: 'VND',
        maximumFractionDigits: 0
    }).format(amount);
}

// Thêm event listener cho nút đặt hàng khi trang được load
document.addEventListener('DOMContentLoaded', function() {
    const checkoutButton = document.querySelector('.checkout-btn.guest');
    if (checkoutButton) {
        checkoutButton.addEventListener('click', function() {
            // Kiểm tra xem giỏ hàng có sản phẩm không
            const cartItems = document.querySelectorAll('.cart-item');
            if (cartItems.length > 0) {
                window.location.href = 'datmua.php';
            } else {
                alert('Giỏ hàng của bạn đang trống!');
            }
        });
    }
});
</script>

