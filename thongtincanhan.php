<?php
if (isset($_SESSION['user'])) {

    $kh = $_SESSION['user'];
    ?>
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
<div class="container container-background informationin">
  <div class="row">
      <div class="detail_acc">
        <div class="fs20 mb-4">
          <strong>Thông Tin Tài Khoản</strong>
        </div>
        <div class="mb-4">
          <div class="row">
            <div class="col-md-9">
              <div class="mb-2 cl66 fs13">
                <strong>User Name</strong>
              </div>
              <div class="mb-3">
                <input type="text" class="txt_cm" disabled value="<?php echo $kh["HoTen"] ?>">
              </div>
              <div class="mb-2 cl66 fs13">
                <strong>Email</strong>
              </div>
              <div class="mb-3">
                <input type="text" class="txt_cm" disabled value="T<?php echo $kh["Email"] ?>">
              </div>
              <div class="mb-2 cl66 fs13">
                <strong>Tiền</strong>
              </div>
              <div class="mb-3">
                <input type="text" class="txt_cm" disabled value="0">
              </div>
              <div class="fs20 mb-4">
                <strong>Thông Tin Cá Nhân</strong>
              </div>
              <div class="mb-4">
                <form method="post"></form>
                <div class="row">
                  <input type="hidden" id="avatar" name="avatar" value>
                  <input type="hidden" id="inputDelImage" name="inputDelImage" value>

                  <div class="col-md-9">
                    <div class="mb-2 cl66 fs13">
                      <strong>Họ</strong>
                    </div>
                    <div class="mb-3">
                      <input type="text" placeholder="Họ" class="txt_cm" id="last_name" name="last_name" value>
                    </div>
                    <div class="mb-2 cl66 fs13">
                      <strong>Tên</strong>
                    </div>
                    <div class="mb-3">
                      <input type="text" placeholder="Tên" class="txt_cm" id="last_name" name="last_name" value>
                    </div>
                    <div class="mb-2 ">
                      <div class="d-flex align-items-center "> 
                        <strong class="cl66 fs13 mr-3">Giới Tính</strong>
                        <label class="d-flex align-items-center mr-4"> 
                          <input type="radio" class="rd_gen" name="gender"
                            checked=""> Con Trai</label>
                        <label class="d-flex align-items-center"> 
                          <input type="radio" name="gender" class="rd_gen"> Con
                          Gái</label>
                      </div>
                    </div>
                  </div>
                </div>
                <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded">Lưu</button>
                </d>
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <?php
} else {
    ?>
<?php } ?>
