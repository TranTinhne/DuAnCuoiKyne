<?php
// Include file kết nối cơ sở dữ liệu
include "includes/db_bangiay.inc";
?>

<div class="container-fluid fruite py-3">
    <div class="container ">
    <h3>Mua sắp theo môn thể thao</h3>
        <div>

            <div class="g-scrolling-carousel carousel-three s-bsport">
                <div class="items sbsport">
                    <?php
                    // Truy vấn dữ liệu từ bảng sanpham
                    $sql = "SELECT id, hinhanh, mota, trangthai FROM shopbysport WHERE trangthai = 'active'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="carousel-item sb-sport">';
                            echo '<img src="img/' . $row["hinhanh"] . '" class="img-fluid" alt="Slide">';
                            echo '<a href="#" class="btn px-4 py-2 text-white rounded txt">' . $row["mota"] . '</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "0 results";
                    }

                    // Đóng kết nối
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>