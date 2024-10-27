<?php ob_start();
session_start();
?>

<style>
    /* Đảm bảo bố cục flex khi màn hình nhỏ hơn */
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .col-md-6 {
        flex: 1;
        padding: 20px;
    }

    /* Ảnh sản phẩm */
    .thumbnail {
        padding: 10px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        max-width: 100%;
    }

    .thumbnail img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    /* Tên sản phẩm, mô tả và giá bán */
    .tensanpham {
        font-size: 24px;
        color: #343a40;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .motasach {
        font-size: 16px;
        color: #6c757d;
        margin-bottom: 15px;
    }

    .giaban {
        font-size: 18px;
        color: #28a745;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Nút Add to Cart */
    .addtocart a {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;

    }

    .addtocart a:hover {
        background-color: #0056b3;
    }

    .addtocart .glyphicon {
        margin-right: 5px;
    }

    /* Bố cục khi màn hình nhỏ */
    @media (max-width: 768px) {
        .row {
            flex-direction: column;
        }

        .col-md-6 {
            width: 100%;
        }
    }
</style>
<?php
include "includes/db_bangiay.inc";
if (isset($_GET['MaSanPham'])) {
    $maGiay = intval($_GET['MaSanPham']);
    // Lấy thông tin chi tiết của sách
    $sql = "SELECT TenSanPham, hinhanh, MoTa, NoiXuatXu, Gia FROM sanpham WHERE MaSanPham = " . $maGiay;

    $result = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($result);
} else {
    echo "Không tìm thấy sản phẩm.";
    exit;
}
?>
<div class="chitietsp-i">
    <div class="row text-center">
        <div class="col-md-5">
            <div class="thumbnail">
                <img src="img/<?php echo $book['hinhanh']; ?>"
                    alt="<?php echo htmlspecialchars($book['TenSanPham']); ?>">
            </div>
        </div>
        <div class="col-md-5 Tensp-i">
            <div class="Tensp-in">
                <h4 class="tensanpham-ch">
                    <?php echo htmlspecialchars($book['TenSanPham']); ?>
                </h4>
                <div class="motasach-ch">
                    <p><?php echo nl2br(htmlspecialchars($book['MoTa'])); ?></p>
                </div>
            </div>
            <div class="gia-sp">
                <p class="giaban">Giá bán: <span><?php echo number_format($book['Gia'], 0, ',', '.'); ?> VNĐ</span></p>
            </div>
            <div class="datmua-sp">
                <p class="datmua">
                    <a href="ThemVaoGioHang.php?id=<?php echo $maGiay; ?>&url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>"
                        class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Đặt mua
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid fruite py-3">
    <div class="container ">
        <?php include "danhsachsanphamxuhuong.php"; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'includes/LayoutBanGiay.php';
?>