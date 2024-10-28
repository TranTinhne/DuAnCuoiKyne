(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    // Fixed Navbar
    $(window).scroll(function () {
        if ($(window).width() < 992) {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow');
            } else {
                $('.fixed-top').removeClass('shadow');
            }
        } else {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow').css('top', -55);
            } else {
                $('.fixed-top').removeClass('shadow').css('top', 0);
            }
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonial carousel


    // vegetable carousel



    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })
    });



    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

    $(document).ready(function () {
        $('.countdown').final_countdown({
            start: '1362139200',
            end: '1388461320',
            now: '1387461319',
            selectors: {
                value_seconds: '.clock-seconds .val',
                canvas_seconds: 'canvas_seconds',
                value_minutes: '.clock-minutes .val',
                canvas_minutes: 'canvas_minutes',
                value_hours: '.clock-hours .val',
                canvas_hours: 'canvas_hours',
                value_days: '.clock-days .val',
                canvas_days: 'canvas_days'
            },
            seconds: {
                borderColor: '#7995D5',
                borderWidth: '6'
            },
            minutes: {
                borderColor: '#ACC742',
                borderWidth: '6'
            },
            hours: {
                borderColor: '#ECEFCB',
                borderWidth: '6'
            },
            days: {
                borderColor: '#FF9900',
                borderWidth: '6'
            }
        }, function () {
            // Finish callback
        });
    });
    $(document).ready(function () {
        $(".carousel .items").gScrollingCarousel();
        $(".carousel-two .items").gScrollingCarousel({
            mouseScrolling: false,
            draggable: true,
            snapOnDrag: false,
            mobileNative: false,
        });
        $(".carousel-three .items").gScrollingCarousel({
            scrollAmount: 'single'
        });
        $(".carousel-four .items").gScrollingCarousel({
            mouseScrolling: true,
            draggable: false,
            snapOnDrag: false,
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        let currentPage = 1;
        let currentCategory = 'all';
        const loading = document.querySelector('.loading');

        // Load sản phẩm ban đầu
        loadProducts(currentPage, currentCategory);

        // Xử lý click category
        document.getElementById('categoryTabs').addEventListener('click', function (e) {
            if (e.target.closest('[data-category]')) {
                e.preventDefault();
                const categoryEl = e.target.closest('[data-category]');
                currentCategory = categoryEl.dataset.category;
                currentPage = 1;

                // Update active state
                document.querySelectorAll('#categoryTabs [data-category]').forEach(el => {
                    el.classList.remove('active');
                });
                categoryEl.classList.add('active');

                loadProducts(currentPage, currentCategory);
            }
        });

        // Function để load sản phẩm
        function loadProducts(page, category) {
            loading.style.display = 'block';

            fetch(`products.php?page=${page}&category=${category}`)
                .then(response => response.json())
                .then(data => {
                    // Render categories nếu chưa có
                    if (document.querySelectorAll('#categoryTabs li').length <= 1) {
                        renderCategories(data.categories);
                    }

                    // Render products
                    renderProducts(data.products, data.categories);

                    // Render pagination
                    renderPagination(data.totalPages, data.currentPage);

                    loading.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error:', error);
                    loading.style.display = 'none';
                    alert('Có lỗi xảy ra khi tải dữ liệu!');
                });
        }

        // Render danh sách sản phẩm
        function renderProducts(products, categories) {
            const container = document.getElementById('productContainer');
            if (products.length === 0) {
                container.innerHTML = '<div class="col-12 text-center">Không có sản phẩm nào trong danh mục này</div>';
                return;
            }

            container.innerHTML = products.map(product => `
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <a href="chitietsp.php?MaSanPham=${product.MaSanPham}">
                                <img src="img/${product.hinhanh}" class="img-fluid w-100 rounded-top" alt="">
                            </a>
                        </div>
                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                            ${categories[product.MaLoaiSanPham]}
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>
                                <a href="chitietsp.php?MaSanPham=${product.MaSanPham}">
                                    ${product.TenSanPham}
                                </a>
                            </h4>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">
                                    ${new Intl.NumberFormat('vi-VN').format(product.Gia)} VND
                                </p>
                                <a href="ThemVaoGioHang.php?id=${product.MaSanPham}&url=${encodeURIComponent(window.location.href)}"
                                    class="btn border border-secondary rounded-pill px-3 text-primary">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Render categories
        function renderCategories(categories) {
            const container = document.getElementById('categoryTabs');
            Object.entries(categories).forEach(([id, name]) => {
                const li = document.createElement('li');
                li.className = 'nav-item';
                li.innerHTML = `
                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-category="${id}">
                        <span class="text-dark" style="width: 130px;">${name}</span>
                    </a>
                `;
                container.appendChild(li);
            });
        }

        // Render pagination
        function renderPagination(totalPages, currentPage) {
            const pagination = document.getElementById('pagination');
            let html = '';

            for (let i = 1; i <= totalPages; i++) {
                html += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>
                `;
            }

            pagination.innerHTML = html;

            // Add click handlers for pagination
            pagination.querySelectorAll('.page-link').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    currentPage = parseInt(this.dataset.page);
                    loadProducts(currentPage, currentCategory);
                });
            });
        }
    });

})(jQuery);

