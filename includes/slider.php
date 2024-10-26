<?php
// Truy vấn dữ liệu từ bảng slider
$sql = "SELECT id, hinhanh, mota, trangthai FROM slider WHERE trangthai = 'active'";
$result = $conn->query($sql);
?>

<div class="slider">
        <div class="col-md-12 col-lg-5 sliderinsite">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        if ($result->num_rows > 0) {
                            $active = true;
                            while($row = $result->fetch_assoc()) {
                                echo '<div class="carousel-item' . ($active ? ' active' : '') . ' rounded">';
                                echo '<img src="img/' . $row["hinhanh"] . '" class="img-fluid w-100 h-100 bg-secondary rounded" alt="Slide">';
                                echo '<a href="#" class="btn px-4 py-2 text-white rounded">' . $row["mota"] . '</a>';
                                echo '</div>';
                                $active = false;
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
</div>
<?php
// Đóng kết nối
$conn->close();
?>