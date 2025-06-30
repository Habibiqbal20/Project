-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 06:10 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tesya_lobster`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `nama_admin`, `no_telp`, `email`, `password`) VALUES
(1, 'Tesya Lobster Admin 1', '087859443751', 'habibiqballubis@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `foto_komentar`
--

CREATE TABLE `foto_komentar` (
  `ID` int(11) NOT NULL,
  `kode_unik` varchar(100) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `foto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto_komentar`
--

INSERT INTO `foto_komentar` (`ID`, `kode_unik`, `id_barang`, `foto`) VALUES
(76, 'UNQ-20250527-SKYL03', '27', '6835d4ffad9af.jpg'),
(77, 'UNQ-20250531-LVG0A2', '27', '683a91ec979ec.jpg'),
(78, 'UNQ-20250531-LVG0A2', '27', '683a91ec981eb.jpg'),
(79, 'UNQ-20250531-LVG0A2', '27', '683a91ec98a2a.jpg'),
(80, 'UNQ-20250531-01GXPT', '27', '683a9225c80dc.jpg'),
(81, 'UNQ-20250531-01GXPT', '27', '683a9225c86ef.jpg'),
(82, 'UNQ-20250531-01GXPT', '27', '683a9225c8c38.jpg'),
(83, 'UNQ-20250531-5CXN3V', '27', '683a92c68c620.jpg'),
(84, 'UNQ-20250531-UDU7EG', '27', '683a933cb2d49.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `foto_produk`
--

CREATE TABLE `foto_produk` (
  `ID` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `uniq_code` varchar(20) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto_produk`
--

INSERT INTO `foto_produk` (`ID`, `product_name`, `uniq_code`, `gambar`) VALUES
(66, 'Lobster 5 CM', 'UNQ-20250527-C4EDA8', '6846f8f6a0e5d.jpg'),
(67, 'Lobster 6 CM', 'UNQ-20250605-P0QOLQ', '6846fb91e4391.jpg'),
(68, 'Lobster 7 CM', 'UNQ-20250605-NT9MPE', '6846fc05ae05e.jpg'),
(69, 'Lobster 8 CM', 'UNQ-20250605-I1ZGRT', '6846fc8f65796.jpg'),
(70, 'Lobster 9 CM', 'UNQ-20250605-RP5NM5', '6846fcca92c22.jpg'),
(71, 'Lobster10  CM', 'UNQ-20250609-8VF3VR', '6846fd1fa96d3.jpg'),
(72, 'Lobster 11 CM', 'UNQ-20250609-VXS62S', '6846fd3ddb342.jpg'),
(96, 'Lobster 5 CM', 'UNQ-20250527-C4EDA8', '684d9f8f57834.jpg'),
(98, 'Lobster 6 CM', 'UNQ-20250605-P0QOLQ', '684d9feddeb0e.jpg'),
(99, 'Lobster 7 CM', 'UNQ-20250605-NT9MPE', '684d9ffd6f152.jpg'),
(100, 'Lobster 8 CM', 'UNQ-20250605-I1ZGRT', '684da008732bd.jpg'),
(101, 'Lobster 9 CM', 'UNQ-20250605-RP5NM5', '684da0142e44d.jpg'),
(102, 'Lobster10  CM', 'UNQ-20250609-8VF3VR', '684da0242ccd8.jpg'),
(103, 'Lobster 11 CM', 'UNQ-20250609-VXS62S', '684da03174139.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `ID` int(11) NOT NULL,
  `kode_unik` varchar(100) NOT NULL,
  `id_barang` varchar(12) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `komentar` varchar(250) NOT NULL,
  `rating` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`ID`, `kode_unik`, `id_barang`, `nama_user`, `tanggal`, `komentar`, `rating`) VALUES
(98, 'UNQ-20250529-X7PNGZ', '26', 'Winsnu', '2025-05-29', 'Lobsternya bagus dan sehat', '5'),
(115, 'UNQ-20250605-MRHLJ4', '37', 'Fiqri', '2025-06-05', 'Bagus untuk hiasan', '5'),
(117, 'UNQ-20250605-WZ0PCD', '37', 'Zidan ', '2025-06-05', 'Mantapp', '4');

-- --------------------------------------------------------

--
-- Table structure for table `kotak_saran`
--

CREATE TABLE `kotak_saran` (
  `ID` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `WhatsApp` varchar(15) NOT NULL,
  `Saran` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kotak_saran`
--

INSERT INTO `kotak_saran` (`ID`, `Nama`, `WhatsApp`, `Saran`) VALUES
(3, 'anonymous', '085476211687', 'BISMILLAH ACC');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `stok` varchar(15) NOT NULL,
  `price` varchar(30) NOT NULL,
  `uniq_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `product_name`, `description`, `stok`, `price`, `uniq_code`) VALUES
(26, 'Lobster 5 CM', 'Lobster Air Tawar berukuran 5 cm yang cocok untuk budidaya pemula maupun kolektor hias. Dengan warna yang cerah dan aktif bergerak, lobster ini sangat ideal untuk dipelihara dalam akuarium maupun kolam pembesaran. Lobster ukuran ini masih muda dan memiliki pertumbuhan yang cepat jika dirawat dengan baik.\r\n\r\nKeunggulan:\r\n→ Ukuran ideal untuk starter budidaya\r\n\r\n→ Aktif dan mudah beradaptasi\r\n\r\n→ Cocok untuk akuarium hias atau kolam', 'Tersedia ', '2000', 'UNQ-20250527-C4EDA8'),
(37, 'Lobster 6 CM', 'Lobster air tawar berukuran 6 cm ini sangat cocok bagi Anda yang ingin memulai budidaya serius ataupun menambah koleksi lobster berwarna menarik. Dengan tubuh yang mulai berkembang dan aktivitas yang tinggi, lobster ini siap dipelihara di kolam pembesaran atau akuarium yang cukup luas. Ukuran ini merupakan tahap pertumbuhan yang cepat jika diberikan perawatan optimal.\r\n\r\nKeunggulan:\r\n→ Sudah melewati fase kritis pertumbuhan awal\r\n\r\n→ Gerak aktif dan responsif\r\n\r\n→ Cocok untuk pemula yang ingin langsung ke tahap pembesaran', 'Tersedia ', '4000', 'UNQ-20250605-P0QOLQ'),
(38, 'Lobster 7 CM', 'Ukuran lobster 7 cm sangat ideal untuk pembudidaya menengah yang ingin panen lebih cepat. Dengan warna yang semakin mencolok dan ukuran tubuh yang mulai besar, lobster ini menunjukkan daya tahan yang baik dan pertumbuhan yang stabil. Cocok untuk budidaya intensif maupun dipelihara sebagai hiasan eksklusif di akuarium besar.\r\n\r\nKeunggulan:\r\n→ Lebih tahan terhadap perubahan lingkungan\r\n\r\n→ Warna lebih cerah dan menarik\r\n\r\n→ Cocok untuk pemeliharaan lanjutan atau pemanenan mendekati', 'Tersedia ', '5000', 'UNQ-20250605-NT9MPE'),
(39, 'Lobster 8 CM', 'Lobster air tawar dengan panjang 14–15 cm sudah berada di fase remaja dewasa, siap dijadikan indukan atau dipanen untuk konsumsi. Gerakannya tetap aktif, dengan warna yang sudah dominan sesuai jenisnya. Sangat cocok untuk pembudidaya yang membutuhkan pasokan lobster dewasa dengan kualitas prima.\r\n\r\nKeunggulan:\r\n→ Ukuran mendekati siap panen\r\n\r\n→ Cocok sebagai calon indukan\r\n\r\n→ Tahan terhadap kondisi air yang beragam', 'Tersedia ', '7000', 'UNQ-20250605-I1ZGRT'),
(40, 'Lobster 9 CM', 'Lobster ukuran 16–18 cm merupakan lobster dewasa yang siap panen atau dijadikan indukan unggulan. Dengan ukuran besar, warna tajam, dan daya tahan tinggi, lobster ini sangat cocok untuk keperluan konsumsi, pembibitan, atau sebagai koleksi eksklusif.\r\n\r\nKeunggulan:\r\n→ Siap panen dan bernilai jual tinggi\r\n\r\n→ Cocok sebagai indukan produktif\r\n\r\n→ Warna dan postur tubuh sangat menarik', 'Tersedia ', '10000', 'UNQ-20250605-RP5NM5'),
(43, 'Lobster10  CM', '', 'Tersedia ', '11000', 'UNQ-20250609-8VF3VR'),
(44, 'Lobster 11 CM', '', 'Tersedia ', '12000', 'UNQ-20250609-VXS62S');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `ID` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `uniq_code` varchar(20) NOT NULL,
  `balasan` varchar(200) NOT NULL,
  `tanggal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`ID`, `id_barang`, `uniq_code`, `balasan`, `tanggal`) VALUES
(8, '37', 'UNQ-20250605-MRHLJ4', 'Terima kasih kak sudah membeli', '2025-06-05'),
(9, '37', 'UNQ-20250605-WZ0PCD', 'Terima kasih kak', '2025-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ID` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `services` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ID`, `image`, `services`, `description`) VALUES
(7, 'premium quality product guaranteed-2.png', 'Kualitas Terbaik', 'Lobster air tawar dengan kualitas terbaik serta layanan pelanggan pelatihan yang ramah dengan harga yang terjangkau dan ramah di kantong.'),
(8, 'training2.png', 'Pelatihan Budidaya', 'Selain menjual lobster, kami juga memberikan kepada anda pelatihan budidaya lobster, tentang bagaimana melakukan budidaya lobster yang baik dan benar.'),
(9, 'package-1.png', 'Pengiriman Cepat', 'Nikmati kenyamanan pengiriman cepat untuk lobster pilihan Anda. Dengan layanan terpercaya kami, lobster berkualitas tiba tepat waktu, memenuhi harapan pengiriman.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `user_type`, `nama_user`, `password`, `email`) VALUES
(1, 'User', 'habib', '123 ', 'habibiqballubis20@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `foto_komentar`
--
ALTER TABLE `foto_komentar`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kotak_saran`
--
ALTER TABLE `kotak_saran`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `foto_komentar`
--
ALTER TABLE `foto_komentar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `kotak_saran`
--
ALTER TABLE `kotak_saran`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
