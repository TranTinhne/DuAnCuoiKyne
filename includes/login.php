<?php
if (isset($_SESSION['user'])) {

    $kh = $_SESSION['user'];
    ?>
    <div class="nav-item dropdown"></div>
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
            aria-haspopup="true">Xin chào: <?php echo $kh["HoTen"] ?><span class="caret"></span></a>
        <ul class="dropdown-menu m-0 bg-secondary rounded-0">
            <a href="dangxuat.php" class=" dropdown-item glyphicon glyphicon-user"> Đăng xuất</a>

        </ul>
    </li>

    <?php
} else {
    ?>
<div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
            aria-haspopup="true">Thông tin<span class="caret"></span></a>
        <ul class="dropdown-menu m-0 bg-secondary rounded-0">
            <a href="dangky.php" class=" dropdown-item glyphicon glyphicon-user "> Đăng ký</a> </>
            <li role="separator" class="divider"></li>
            <a href="dangnhap.php" class=" dropdown-item glyphicon glyphicon-log-in "> Đăng nhập</a>
        </ul>
    </div>
   
       
    
<?php } ?>