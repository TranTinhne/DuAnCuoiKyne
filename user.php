<?php ob_start();
session_start(); ?>
<script type="text/javascript">
  window.tailwind.config = {
    darkMode: ['class'],
    theme: {
      extend: {
        colors: {
          border: 'hsl(var(--border))',
          input: 'hsl(var(--input))',
          ring: 'hsl(var(--ring))',
          background: 'hsl(var(--background))',
          foreground: 'hsl(var(--foreground))',
          primary: {
            DEFAULT: 'hsl(var(--primary))',
            foreground: 'hsl(var(--primary-foreground))'
          },
          secondary: {
            DEFAULT: 'hsl(var(--secondary))',
            foreground: 'hsl(var(--secondary-foreground))'
          },
          destructive: {
            DEFAULT: 'hsl(var(--destructive))',
            foreground: 'hsl(var(--destructive-foreground))'
          },
          muted: {
            DEFAULT: 'hsl(var(--muted))',
            foreground: 'hsl(var(--muted-foreground))'
          },
          accent: {
            DEFAULT: 'hsl(var(--accent))',
            foreground: 'hsl(var(--accent-foreground))'
          },
          popover: {
            DEFAULT: 'hsl(var(--popover))',
            foreground: 'hsl(var(--popover-foreground))'
          },
          card: {
            DEFAULT: 'hsl(var(--card))',
            foreground: 'hsl(var(--card-foreground))'
          },
        },
      }
    }
  }
</script>
<div class="container container-background information">
  <div class="row">
    <div class="col-md-3">
      <ul class="list_acc">
        <li class="active">
          <a href="" class=""> Thông Tin Cá Nhân</a>
        </li>
        <li class="">
          <a href="" class=""> Đổi mật khẩu</a>
        </li>
        <li class="">
          <a href="" class=""> Nạp tiền</a>
        </li>
        <li class="">
          <a href="" class="">Lịch sử nạp tiền</a>
        </li>
        <li class="">
          <a href="" class="">Lịch sử thanh toán</a>
        </li>
        <li class="">
          <a href="" class="">Thoát</a>
        </li>
      </ul>
    </div>
    <div class="col-md-7">
     <?php include "thongtincanhan.php" ?>
     <?php include "doimatkhau.php" ?>
    </div>



    <?php
    $content = ob_get_clean();
    include 'includes/LayoutBanGiay.php'; // Include the layout template
    ?>