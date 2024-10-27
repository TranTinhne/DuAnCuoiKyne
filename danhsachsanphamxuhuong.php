<?php
// Include file kết nối cơ sở dữ liệu
include "includes/db_bangiay.inc";
?>

<div>
    <div class="g-scrolling-carousel carousel-three">
        <div class="items">
            <?php
            // Truy vấn dữ liệu từ bảng sanpham với điều kiện xuhuong = 1
            $sql = "SELECT hinhanh, TenSanPham, Gia FROM sanpham WHERE xuhuong = 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Lặp qua từng hàng dữ liệu
                while($row = $result->fetch_assoc()) {
                    
                    echo '<a href="chitietsp.php" target="_blank">';
                    echo '<img src="img/' . $row["hinhanh"] . '" alt="' . $row["TenSanPham"] . '">';
                    echo '<div class="item-text">';
                    echo '<p>' . $row["TenSanPham"] . '</p>';
                    echo '<p class="price">' . number_format($row["Gia"], 0, ',', '.') . '₫</p>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo "Không có sản phẩm nào.";
            }

            // Đóng kết nối
            $conn->close();
            ?>
        </div>
    </div>
</div>
