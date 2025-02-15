-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 02:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bangiay`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `MaDonHang` int(11) NOT NULL,
  `MaSanPham` int(11) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL CHECK (`SoLuong` > 0),
  `DonGia` decimal(9,2) DEFAULT NULL CHECK (`DonGia` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitietdathang`
--

INSERT INTO `chitietdathang` (`MaDonHang`, `MaSanPham`, `SoLuong`, `DonGia`) VALUES
(3, 3, 14, 1500000.00),
(4, 3, 14, 1500000.00),
(5, 3, 14, 1500000.00),
(6, 3, 14, 1500000.00),
(7, 3, 2, 1500000.00),
(7, 6, 1, 3100000.00),
(7, 8, 1, 1100000.00),
(8, 3, 1, 1500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `dondathang`
--

CREATE TABLE `dondathang` (
  `MaDonDatHang` int(11) NOT NULL,
  `MaNguoiDung` int(11) DEFAULT NULL,
  `DaThanhToan` tinyint(1) NOT NULL DEFAULT 0,
  `TinhTrangGiaoHang` enum('chua_giao','da_giao','huy') NOT NULL DEFAULT 'chua_giao',
  `NgayDat` date NOT NULL,
  `NgayGiao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dondathang`
--

INSERT INTO `dondathang` (`MaDonDatHang`, `MaNguoiDung`, `DaThanhToan`, `TinhTrangGiaoHang`, `NgayDat`, `NgayGiao`) VALUES
(2, 6, 0, 'chua_giao', '2024-10-28', '2024-11-04'),
(3, 6, 0, 'chua_giao', '2024-10-28', '2024-11-04'),
(4, 6, 0, 'chua_giao', '2024-10-28', '2024-11-04'),
(5, 6, 0, 'chua_giao', '2024-10-28', '2024-11-04'),
(6, 6, 0, 'chua_giao', '2024-10-28', '2024-11-04'),
(7, 6, 0, 'chua_giao', '2024-10-28', '2024-11-04'),
(8, 6, 0, 'chua_giao', '2024-10-28', '2024-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `Ten` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Review` text DEFAULT NULL,
  `Rate` int(11) DEFAULT NULL CHECK (`Rate` between 1 and 5),
  `MaSanPham` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `NgayFeedback` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `Ten`, `Email`, `Review`, `Rate`, `MaSanPham`, `MaNguoiDung`, `NgayFeedback`) VALUES
(1, 'Trọng', 'alice@example.com', 'Thực phẩm sạch', 5, 1, 1, '2024-10-15 12:37:17'),
(2, 'Thành', 'bob@example.com', 'Chất lượng ok mà mắc', 4, 2, 2, '2024-10-15 12:37:17'),
(3, 'Hào', 'charlie@example.com', 'Dở nha', 2, 2, 3, '2024-10-15 12:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `giamgia`
--

CREATE TABLE `giamgia` (
  `MaGiamGia` varchar(20) NOT NULL,
  `discount_type` enum('fixed','percentage') DEFAULT NULL,
  `discount_value` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `MaSanPham` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giamgia`
--

INSERT INTO `giamgia` (`MaGiamGia`, `discount_type`, `discount_value`, `start_date`, `end_date`, `MaSanPham`) VALUES
('DISCOUNT10', 'percentage', 10.00, '2024-10-01', '2024-10-31', 1),
('DISCOUNT15', 'percentage', 15.00, '2024-10-01', '2024-10-31', 3),
('DISCOUNT20', 'fixed', 20.00, '2024-10-01', '2024-10-31', 2),
('DISCOUNT25', 'fixed', 20.00, '2024-10-01', '2024-10-31', 4);

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `MaLoaiSanPham` int(11) NOT NULL,
  `TenLoaiSanPham` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`MaLoaiSanPham`, `TenLoaiSanPham`) VALUES
(1, 'Nam'),
(2, 'Nữ');

-- --------------------------------------------------------

--
-- Table structure for table `mienphivanchuyen`
--

CREATE TABLE `mienphivanchuyen` (
  `MaMienPhiVanChuyen` int(11) NOT NULL,
  `free_shipping_type` enum('fixed','category','order') DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `min_order_value` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `MaSanPham` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mienphivanchuyen`
--

INSERT INTO `mienphivanchuyen` (`MaMienPhiVanChuyen`, `free_shipping_type`, `start_date`, `end_date`, `min_order_value`, `category_id`, `MaSanPham`) VALUES
(1, 'fixed', '2024-10-01', '2024-10-31', 100.00, NULL, NULL),
(2, 'category', '2024-10-01', '2024-10-31', NULL, 1, NULL),
(3, 'order', '2024-10-01', '2024-10-31', 50.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaNguoiDung` int(11) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `TaiKhoan` varchar(50) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `DiaChi` text DEFAULT NULL,
  `DienThoai` varchar(15) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `LoaiTaiKhoan` enum('khach_hang','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`MaNguoiDung`, `HoTen`, `TaiKhoan`, `MatKhau`, `Email`, `DiaChi`, `DienThoai`, `NgaySinh`, `LoaiTaiKhoan`) VALUES
(1, 'Trọng', 'alice', 'password123', 'huutrong8a4@gmail.com', 'Hà Nội', '1234567890', '1990-01-01', 'khach_hang'),
(2, 'Thành', 'bob', 'password123', 'bob@example.com', 'TP.HCM', '0987654321', '1992-02-02', 'khach_hang'),
(3, 'Hào', 'charlie', 'password123', 'charlie@example.com', 'Đà Nẵng', '0912345678', '1994-03-03', 'khach_hang'),
(4, 'Trương Gia Huy', 'Huy1234', 'Huy1234', 'huyt9889@gmail.com', 'BD', '0987654321', '2024-10-24', 'khach_hang'),
(6, 'Tran Tinh', 'Tinh1234', 'Tinh1234', 'trantinh28012004@gmail.com', 'bd', '0987654321', '2024-10-23', 'khach_hang');

-- --------------------------------------------------------

--
-- Table structure for table `nhan`
--

CREATE TABLE `nhan` (
  `MaNhanHieu` int(11) NOT NULL,
  `TenNhanHieu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhan`
--

INSERT INTO `nhan` (`MaNhanHieu`, `TenNhanHieu`) VALUES
(1, 'Nike'),
(2, 'PUMA'),
(3, 'Adidas'),
(4, 'ASISC'),
(5, 'Converse');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSanPham` int(11) NOT NULL,
  `TenSanPham` varchar(100) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `MoTa` text DEFAULT NULL,
  `Gia` decimal(10,2) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `SoLuongDaBan` int(11) DEFAULT 0,
  `NoiXuatXu` varchar(100) DEFAULT NULL,
  `ChatLuong` varchar(50) DEFAULT NULL,
  `MaLoaiSanPham` int(11) DEFAULT NULL,
  `MaNhanHieu` varchar(50) DEFAULT NULL,
  `Xuhuong` int(11) DEFAULT NULL,
  `mau` varchar(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSanPham`, `TenSanPham`, `hinhanh`, `MoTa`, `Gia`, `SoLuong`, `SoLuongDaBan`, `NoiXuatXu`, `ChatLuong`, `MaLoaiSanPham`, `MaNhanHieu`, `Xuhuong`, `mau`, `size`) VALUES
(1, 'Chuck Taylor All Star', 'Chuck-Taylor-All-Star.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2100000.00, 150, 3, 'Đức', 'Cao cấp', 1, '5', 1, 'Đỏ', NULL),
(2, 'Chuck 70 Sketch', 'Chuck-70-Sketch.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2300000.00, 100, 5, 'Đức', 'Cao cấp', 1, '5', 0, 'Vàng', NULL),
(3, 'Chuck 70 Plus', 'Chuck-70-Plus.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 1500000.00, 250, 8, 'Đức', 'Thường', 1, '5', 1, 'Vàng', NULL),
(4, 'Chuck 70 Multi Heart.png', 'Converse-x-Comme-des-Garçons-PLAY-Chuck-70-Multi-Heart.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 3200000.00, 200, 7, 'Đức', 'Cao cấp', 1, '5', 1, 'Xanh', NULL),
(5, 'Converse x DRKSHDW DBL DRKSTR OVERDYE Chuck 70', 'Converse-x-DRKSHDW-DBL-DRKSTR-OVERDYE-Chuck-70.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2600000.00, 120, 10, 'Đức', 'Cao cấp', 1, '5', 0, 'Xanh', NULL),
(6, 'Converse x Comme des Garçons Chuck 70', 'Converse-x-Comme-des-Garçons-Chuck-70.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 3100000.00, 150, 5, 'Đức', 'Cao cấp', 1, '5', 1, 'Xanh', NULL),
(7, 'Converse x CDG Chuck 70', 'Converse-x-CDG-Chuck-70.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 3100000.00, 120, 6, 'Đức', 'Cao cấp', 1, '5', 0, 'Đỏ', NULL),
(8, 'Chuck Taylor All Star High Street\r\n', 'Chuck-Taylor-All-Star-High-Street.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 1100000.00, 200, 10, 'Đức', 'Thường', 1, '5', 0, 'Đỏ', NULL),
(11, 'Run Star Trainer', 'Run-Star-Trainer.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 1900000.00, 20, 7, 'Đức', 'Thường', 2, '5', 0, 'Đỏ', NULL),
(12, 'Chuck Taylor All Star Lift', 'Chuck-Taylor-All-Star-Lift.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2900000.00, 20, 10, 'Đức', 'Cao cấp', 2, '5', 1, 'Đỏ', NULL),
(13, 'Run Star Hike', 'Run-Star-Hike.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2100000.00, 36, 9, 'Đức', 'Cao cấp', 2, '5', 0, 'Vàng', NULL),
(14, 'Chuck 70', 'Chuck-70.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2500000.00, 20, 5, 'Đức', 'Cao cấp', 2, '5', 1, 'Xanh', NULL),
(15, 'Chuck Taylor All Star Lugged Heel', 'Chuck-Taylor-All-Star-Lugged-Heel.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2000000.00, 40, 27, 'Đức', 'Cao cấp', 2, '5', 0, 'Xanh', NULL),
(16, 'Run Star Legacy', 'Run-Star-Legacy.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2900000.00, 10, 4, 'Đức', 'Cao cấp', 2, '5', 0, 'Vàng', NULL),
(17, 'Chuck 70 De Luxe Heel', 'Chuck-70 De-Luxe-Heel.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 3100000.00, 10, 9, 'Đức', 'Cao cấp', 2, '5', 0, 'Vàng', NULL),
(18, 'Chuck Taylor All Star Modern Lift Platform Canvas', 'Chuck-Taylor-All-Star-Modern-Lift Platform-Canvas.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2200000.00, 59, 35, 'Đức', 'Cao cấp', 2, '5', 0, 'Vàng', NULL),
(19, 'Chuck Taylor All Star Modern Lift Platform Canvas', 'Chuck-Taylor-All-Star-Modern-Lift Platform-Canvas.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2100000.00, 30, 26, 'Đức', 'Cao cấp', 2, '5', 0, 'Vàng', NULL),
(20, 'Nike Air VaporMax 2023 Flyknit', 'AIR+VAPORMAX+2023+FK.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 4900000.00, 29, 8, 'Mỹ', 'Cao cấp', 1, '1', 0, 'Vàng', NULL),
(21, 'Air Jordan Legacy 312 Low', 'AIR+JORDAN+LEGACY+312+LOW.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 3600000.00, 20, 4, 'Mỹ', 'Cao cấp', 1, '1', 0, 'Vàng', NULL),
(22, 'Nike Air Max SC', 'NIKE+AIR+MAX+SC.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2100000.00, 78, 2, 'Mỹ', 'Cao cấp', 1, '1', 0, 'Vàng', NULL),
(23, 'Nike P-6000\r\n', 'NIKE+P-6000.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2900000.00, 20, 10, 'Mỹ', 'Cao cấp', 1, '1', 0, 'Đỏ', NULL),
(24, 'Nike Air Max Excee', 'NIKE+AIR+MAX+EXCEE.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 2900000.00, 78, 66, 'Mỹ', 'Cao cấp', 1, '1', 0, 'Đỏ', NULL),
(25, 'Nike Revolution 7 EasyOn', 'NIKE+REVOLUTION+7+EASYON.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 1700000.00, 100, 49, 'Mỹ', 'Thường', 1, '1', 0, 'Đỏ', NULL),
(26, 'Nike Zoom Vomero 5\r\n', 'NIKE+ZOOM+VOMERO+5.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 4700000.00, 20, 15, 'Mỹ', 'Cao cấp', 1, '1', 0, 'Đỏ', NULL),
(27, 'Nike SB Force 58\r\n', 'NIKE+SB+FORCE+58.png', 'Mua giá trên app sẽ mắc hơn bên ngoài shop, hãy liên hệ riêng với shopp để có giá ưu đãi.', 1600000.00, 80, 69, 'Mỹ', 'Thường', 1, '1', 0, 'Đỏ', NULL),
(28, 'Nike Court Vision Low Next Nature\r\n', 'W+NIKE+COURT+VISION+LO+NN.png', NULL, 1900000.00, 90, 54, 'Mỹ', 'Thường', 2, '1', 0, NULL, NULL),
(29, 'Nike Air Force 1 Dance\r\n', 'W+AIR+FORCE+1+DANCE.png', NULL, 3829000.00, 36, 6, 'Mỹ', 'Cao cấp', 2, '1', 0, NULL, NULL),
(31, 'Nike Air Force 1 \'07\r\n', 'WMNS+AIR+FORCE+1+\'07.png', NULL, 2267000.00, 80, 67, 'Mỹ', 'Cao cấp', 2, '1', 0, NULL, NULL),
(32, 'Nike P-6000\r\n', 'WMNS+NIKE+P-6000.png', NULL, 3239000.00, 80, 45, 'Mỹ', 'Cao cấp', 2, '1', 0, NULL, NULL),
(33, 'Nike Zoom Vomero Roam\r\n', 'W+NIKE+ZOOM+VOMERO+ROAM.jpg', NULL, 5279000.00, 80, 5, 'Mỹ', 'Cao cấp', 2, '1', 0, NULL, NULL),
(34, 'Nike Air Force 1 Shadow\r\n', 'W+AF1+SHADOW.png', NULL, 3519000.00, 80, 58, 'Mỹ', 'Cao cấp', 2, '1', 0, NULL, NULL),
(35, 'Air Jordan 1 Low\r\n', 'WMNS+AIR+JORDAN+1+LOW.jpg', NULL, 3239000.00, 80, 52, 'Mỹ', 'Cao cấp', 2, '1', 0, NULL, NULL),
(36, 'Nike Free Metcon 6\r\n', 'W+NIKE+FREE+METCON+6.png', NULL, 3519000.00, 80, 45, 'Mỹ', NULL, 2, '1', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopbysport`
--

CREATE TABLE `shopbysport` (
  `id` int(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `mota` text DEFAULT NULL,
  `trangthai` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopbysport`
--

INSERT INTO `shopbysport` (`id`, `hinhanh`, `mota`, `trangthai`) VALUES
(1, 'Football.jpg', 'Football', 'active'),
(2, 'Running.jpg', 'Running', 'active'),
(3, 'Basketball.jpg', 'Basketball', 'active'),
(4, 'Dance.jpg', 'Dance', 'active'),
(5, 'Skateboarding.jpg', 'Skateboarding', 'active'),
(6, 'Yoga.jpg', 'Yoga', 'active'),
(7, 'Tennis.jpg', 'Tennis', 'active'),
(8, 'Gym and Training.jpg', 'Gym and Training', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `mota` text DEFAULT NULL,
  `trangthai` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `hinhanh`, `mota`, `trangthai`) VALUES
(1, 'Slider1.png', 'Converse', 'active'),
(2, 'Slider2.png', 'NIKE', 'active'),
(3, 'Slider3.png', 'PUMA', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`MaDonHang`,`MaSanPham`),
  ADD KEY `MaSanPham` (`MaSanPham`);

--
-- Indexes for table `dondathang`
--
ALTER TABLE `dondathang`
  ADD PRIMARY KEY (`MaDonDatHang`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_MaSanPham` (`MaSanPham`),
  ADD KEY `idx_MaNguoiDung` (`MaNguoiDung`);

--
-- Indexes for table `giamgia`
--
ALTER TABLE `giamgia`
  ADD PRIMARY KEY (`MaGiamGia`),
  ADD KEY `fk_product` (`MaSanPham`);

--
-- Indexes for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`MaLoaiSanPham`);

--
-- Indexes for table `mienphivanchuyen`
--
ALTER TABLE `mienphivanchuyen`
  ADD PRIMARY KEY (`MaMienPhiVanChuyen`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `MaSanPham` (`MaSanPham`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaNguoiDung`),
  ADD UNIQUE KEY `TaiKhoan` (`TaiKhoan`);

--
-- Indexes for table `nhan`
--
ALTER TABLE `nhan`
  ADD PRIMARY KEY (`MaNhanHieu`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSanPham`),
  ADD KEY `fk_loai_san_pham` (`MaLoaiSanPham`);

--
-- Indexes for table `shopbysport`
--
ALTER TABLE `shopbysport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dondathang`
--
ALTER TABLE `dondathang`
  MODIFY `MaDonDatHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `MaLoaiSanPham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mienphivanchuyen`
--
ALTER TABLE `mienphivanchuyen`
  MODIFY `MaMienPhiVanChuyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `MaNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nhan`
--
ALTER TABLE `nhan`
  MODIFY `MaNhanHieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSanPham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `shopbysport`
--
ALTER TABLE `shopbysport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dondathang`
--
ALTER TABLE `dondathang`
  ADD CONSTRAINT `dondathang_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_product` FOREIGN KEY (`MaSanPham`) REFERENCES `sanpham` (`MaSanPham`),
  ADD CONSTRAINT `fk_feedback_user` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`);

--
-- Constraints for table `giamgia`
--
ALTER TABLE `giamgia`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`MaSanPham`) REFERENCES `sanpham` (`MaSanPham`);

--
-- Constraints for table `mienphivanchuyen`
--
ALTER TABLE `mienphivanchuyen`
  ADD CONSTRAINT `mienphivanchuyen_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `loaisanpham` (`MaLoaiSanPham`),
  ADD CONSTRAINT `mienphivanchuyen_ibfk_2` FOREIGN KEY (`MaSanPham`) REFERENCES `sanpham` (`MaSanPham`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_loai_san_pham` FOREIGN KEY (`MaLoaiSanPham`) REFERENCES `loaisanpham` (`MaLoaiSanPham`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
