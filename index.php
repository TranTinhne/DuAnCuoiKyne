<?php ob_start();
session_start();
?>


<?php
$title = "Trang Chủ Vegefoods";
include "includes/db_bangiay.inc";
?>
<div class="container-fluid py-5 mb-5 hero-header">
    <?php include "includes/slider.php"; ?>
</div>

<div class="line">
</div>


<div class="container-fluid fruite py-3">
    <?php include "danhsachsanpham.php"; ?>
</div>

<div class="container-fluid fruite py-3">
    <div class="container ">
        <h3>Xu hướng thời trang</h3>
        <?php include "danhsachsanphamxuhuong.php"; ?>
    </div>
</div>

<div class="container-fluid fruite py-3">
    <div class="container ">
        <h3>Mua sắp theo môn thể thao</h3>
        <?php include "danhsachsanphammonthethao.php"; ?>
    </div>
</div>
<div class="container-fluid py-3 ">
    <div class="container py-5">
        <div class="video-abc">
            <div class="video-container">
                <div class="video-ytb">
                    <iframe class="Ytbin" width="560" height="315"
                        src="https://www.youtube.com/embed/Sc2QqS7tX40?autoplay=1&mute=1" title="YouTube video player"
                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
        encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid py-3">
    <div class="container">
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3917.0812726762797!2d106.71090961936707!3d10.957233359642334!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d751e024b99d%3A0x20b3f9b4c8fdc732!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBLaW5oIHThur8gLSBL4bu5IHRodeG6rXQgQsOsbmggRMawxqFuZw!5e0!3m2!1svi!2sus!4v1721199876008!5m2!1svi!2sus"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- Banner Section End -->
    </div>
</div>
<?php
$content = ob_get_clean();
include "includes/LayoutBanGiay.php";
?>