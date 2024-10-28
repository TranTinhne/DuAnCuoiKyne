<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sản phẩm</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .fruite-img img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .loading {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }
    </style>
</head>
<body>
    <!-- Loading indicator -->
    <div class="loading">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Sản phẩm</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5" id="categoryTabs">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-category="all">
                                <span class="text-dark" style="width: 130px;">Tất cả sản phẩm</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div id="productContainer" class="row g-4">
                <!-- Products will be loaded here -->
            </div>

            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center" id="pagination">
                    <!-- Pagination will be generated here -->
                </ul>
            </nav>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="product.js"></script>
</body>
</html>