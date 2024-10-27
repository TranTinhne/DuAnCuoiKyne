<?php ob_start();

include 'includes/db_bangiay.inc';
session_start();
$thongbao = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['TaiKhoan'];
  $password = $_POST['MatKhau'];
  if (empty($username) || empty($password)) {
    $thongbao = "Tên đăng nhập và mật khẩu không được trống.";
  } else {
    $sql = "SELECT * FROM nguoidung WHERE TaiKhoan = '$username' AND MatKhau = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
      $thongbao = "Tên đăng nhập hoặc mật khẩu không đúng.";
    } else {
      $_SESSION['user'] = mysqli_fetch_assoc($result);
      if ($remember) {
        $expire = time() + 60 * 60 * 24 * 30;
        setcookie('TaiKhoan', $username, $expire);
        setcookie('MatKhau', $password, $expire);
      } else {
        if (isset($_COOKIE['TaiKhoan'])) {
          $expire = time() - 60 * 60 * 24;
          setcookie('TaiKhoan', '', $expire);
          setcookie('MatKhau', '', $expire);
        }
      }
      $thongbao = "Đăng nhập thành công";
      header('Location: index.php');
    }
  }
}



?>

<title>Đăng Nhập</title>
</head>

<body>
  <div class="container-fluid service py-5">
    <div class="container py-5">
      <div class="login-wrap">
        <h2>Login</h2>

        <div class="form">
          <form action="dangnhap.php" method="POST">
            <input type="text" name="TaiKhoan" placeholder="Tên đăng nhập:" value="<?php if (isset($_COOKIE['TenDN']))
              echo $_COOKIE['TaiKhoan'] ?>" required />
              <input type="password" name="MatKhau" placeholder="Mật Khẩu" value="<?php if (isset($_COOKIE['MatKhau']))
              echo $_COOKIE['MatKhau'] ?>" required />
              <input type="checkbox" name="remember" id="remember" value="1" <?php if (isset($_COOKIE['TenDN']))
              echo "checked" ?> />
              <label class="remember" for="remember">Nhớ thông tin đăng nhập </label>
              <input type="submit" name="submit" value="Đăng nhập" />

              <a href="dangky.php">
                <p> Bạn không nhớ mật khẩu? Register </p>
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>


    <?php
            $content = ob_get_clean();

            include 'includes/LayoutBanGiay.php';
            ?>

</body>