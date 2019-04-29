-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2019 pada 16.00
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flower`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(50) NOT NULL,
  `kategori_ket` text NOT NULL,
  `kategori_gambar` varchar(50) NOT NULL DEFAULT 'defaultkat.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`, `kategori_ket`, `kategori_gambar`) VALUES
(10, 'Bouquets', 'Buket Bunga', '0_f3ee8418-870f-4b29-82e8-c9967d04486d_540_540.jpg'),
(11, 'Flower Stand', 'Bunga Hias', 'hbz-fashion-politics-index5-1522870340.jpg'),
(12, 'Flower Boards', 'Karangan Bunga', 'defaultkat.png'),
(13, 'Flower In Basket', 'Bunga keranjang', 'defaultkat.png'),
(14, 'Flower In Vase', 'Bunga di dalam vas', 'defaultkat.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `keranjang_id` int(11) NOT NULL,
  `produk_kode` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keranjang_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`keranjang_id`, `produk_kode`, `user_id`, `keranjang_qty`) VALUES
(5, 'PRD2361120189', 4, 1),
(6, 'PRD13311201810', 4, 1),
(7, 'PRD1261120187', 4, 1),
(8, 'PRD3811120186', 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `pembayaran_kode` int(11) NOT NULL,
  `pemesanan_kode` varchar(15) NOT NULL,
  `pembayaran_nama` varchar(50) DEFAULT NULL,
  `pembayaran_pesan` text,
  `pembayaran_status` enum('pending','selesai','belumbayar') DEFAULT 'pending',
  `pembayaran_method` enum('ditempat','transfer') NOT NULL,
  `pembayaran_tanggal` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `pembayaran_bukti` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`pembayaran_kode`, `pemesanan_kode`, `pembayaran_nama`, `pembayaran_pesan`, `pembayaran_status`, `pembayaran_method`, `pembayaran_tanggal`, `pembayaran_bukti`) VALUES
(2, 'INV90111182748', NULL, NULL, 'selesai', 'ditempat', '2018-12-18 00:30:15', NULL),
(3, 'INV5561118292', 'aa', NULL, 'selesai', 'transfer', '2019-04-27 11:23:50', 'IMG_0005.jpg'),
(5, 'INV7811218177', NULL, NULL, 'pending', 'ditempat', '2018-12-18 00:30:12', NULL),
(6, 'INV8504192564', 'aa', NULL, 'pending', 'transfer', '2019-04-25 18:52:08', 'IMG_9981.jpg'),
(7, 'INV5960419257', NULL, NULL, 'pending', 'ditempat', NULL, NULL),
(8, 'INV13304192768', NULL, NULL, 'belumbayar', 'transfer', NULL, NULL),
(9, 'INV56504192729', NULL, NULL, 'pending', 'ditempat', NULL, NULL),
(10, 'INV16604192755', NULL, NULL, 'pending', 'ditempat', NULL, NULL),
(11, 'INV37104192734', 'ega', NULL, 'selesai', 'transfer', '2019-04-27 12:16:58', '6.jpg'),
(12, 'INV90419296', NULL, NULL, 'pending', 'ditempat', NULL, NULL),
(13, 'INV27704192986', NULL, NULL, 'belumbayar', 'transfer', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `pemesanan_kode` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pemesanan_subtotal` int(11) NOT NULL,
  `pemesanan_ongkir` int(11) NOT NULL,
  `pemesanan_total` int(11) NOT NULL,
  `pemesanan_status` enum('waiting','selesai') NOT NULL DEFAULT 'waiting',
  `pemesanan_tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`pemesanan_kode`, `user_id`, `pemesanan_subtotal`, `pemesanan_ongkir`, `pemesanan_total`, `pemesanan_status`, `pemesanan_tanggal`) VALUES
('INV13304192768', 7, 102625, 0, 102625, 'waiting', '2019-04-27 11:20:38'),
('INV16604192755', 8, 168000, 0, 168000, 'selesai', '2019-04-27 12:13:06'),
('INV27704192986', 8, 355250, 0, 355250, 'waiting', '2019-04-29 20:34:05'),
('INV37104192734', 8, 700000, 0, 700000, 'selesai', '2019-04-27 12:15:32'),
('INV5561118292', 4, 2625, 5000, 7625, 'selesai', '2018-10-11 08:38:33'),
('INV56504192729', 7, 24900, 5000, 29900, 'selesai', '2019-04-27 12:06:19'),
('INV5960419257', 4, 550000, 0, 550000, 'waiting', '2019-04-25 18:23:18'),
('INV7811218177', 4, 977400, 0, 977400, 'waiting', '2018-12-18 00:27:27'),
('INV8504192564', 4, 307875, 0, 307875, 'waiting', '2019-04-25 18:20:54'),
('INV90111182748', 4, 276400, 0, 276400, 'selesai', '2018-11-27 07:18:15'),
('INV90419296', 8, 68000, 0, 68000, 'waiting', '2019-04-29 19:19:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_detailp`
--

CREATE TABLE `pemesanan_detailp` (
  `pdp_id` int(11) NOT NULL,
  `pemesanan_kode` varchar(15) NOT NULL,
  `produk_kode` varchar(15) NOT NULL,
  `pdp_qty` int(11) NOT NULL,
  `pdp_bonus` int(11) NOT NULL,
  `pdp_harga` int(11) NOT NULL,
  `pdp_diskon` int(11) NOT NULL,
  `pdp_subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan_detailp`
--

INSERT INTO `pemesanan_detailp` (`pdp_id`, `pemesanan_kode`, `produk_kode`, `pdp_qty`, `pdp_bonus`, `pdp_harga`, `pdp_diskon`, `pdp_subtotal`) VALUES
(3, 'INV90111182748', 'PRD1261120187', 2, 1, 125000, 0, 250000),
(4, 'INV90111182748', 'PRD1941120181', 1, 0, 26400, 12, 26400),
(5, 'INV5561118292', 'PRD13311201810', 1, 0, 2625, 25, 2625),
(9, 'INV7811218177', 'PRD1261120187', 4, 2, 125000, 0, 500000),
(10, 'INV7811218177', 'PRD2841120189', 1, 0, 439000, 0, 439000),
(12, 'INV7811218177', 'PRD13311201810', 1, 0, 3500, 0, 3500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_ship`
--

CREATE TABLE `pemesanan_ship` (
  `ps_id` int(11) NOT NULL,
  `pemesanan_kode` varchar(15) NOT NULL,
  `ps_nama` varchar(50) NOT NULL,
  `ps_email` varchar(50) NOT NULL,
  `ps_tel` varchar(50) NOT NULL,
  `ps_alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan_ship`
--

INSERT INTO `pemesanan_ship` (`ps_id`, `pemesanan_kode`, `ps_nama`, `ps_email`, `ps_tel`, `ps_alamat`) VALUES
(1, 'INV90111182748', 'tesadmin', 'admin@aaa.com33', '082222333', 'jl.aaa44411'),
(2, 'INV5561118292', 'AdityaDS', 'admin@aaa.com33', '082222333', 'jl.aaa44411'),
(4, 'INV7811218177', 'AdityaDS', 'admin@aaa.com33', '082222333', 'jl.aaa444112'),
(5, 'INV8504192564', 'AdityaDS', 'admin@aaa.com33', '082222333', 'jl.aaa444112'),
(6, 'INV5960419257', 'rudi hartono', 'aa@aa.com', '222', 'asdsd'),
(7, 'INV13304192768', 'engga', 'engga@gmail.com', '1234', 'jl parameswara'),
(8, 'INV56504192729', 'engga', 'engga@gmail.com', '1234', 'jl parameswara'),
(9, 'INV16604192755', 'ega', 'ega@gmail.com', '082280568879', 'jl parameswara'),
(10, 'INV37104192734', 'ega', 'ega@gmail.com', '082280568879', 'jl parameswara'),
(11, 'INV90419296', 'ega', 'yy@gmail.com', '0987', 'jl parameswara'),
(12, 'INV27704192986', 'ega', 'ega@gmail.com', '082280568879', 'jl parameswara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `produk_kode` varchar(15) NOT NULL,
  `sk_id` int(11) NOT NULL,
  `produk_parent` varchar(15) DEFAULT NULL,
  `produk_nama` varchar(150) NOT NULL,
  `produk_harga` int(11) NOT NULL,
  `produk_ket` text NOT NULL,
  `produk_up` enum('yes','no') NOT NULL DEFAULT 'no',
  `produk_gambar` varchar(150) NOT NULL DEFAULT 'images/default.php'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`produk_kode`, `sk_id`, `produk_parent`, `produk_nama`, `produk_harga`, `produk_ket`, `produk_up`, `produk_gambar`) VALUES
('PRD1261120187', 7, 'PRD13311201810', 'Bunga Tulip', 125000, 'Bunga Tulip', 'yes', '1.jpg'),
('PRD13311201810', 8, 'PRD1261120187', 'Mawar Kuning', 3500, 'Mawar Kuning', 'yes', '02634f644b581dad5c3419c48ac4cf0b.jpg'),
('PRD1441120180', 9, 'PRD1261120187', 'Roses', 14400, 'Rosess', 'yes', '3.jpg'),
('PRD1941120181', 10, 'PRD1261120187', 'Edelwises', 30000, 'Edelwises', 'yes', '4.jpg'),
('PRD2331120188', 13, 'PRD1261120187', 'Lavender Ungu', 89500, 'Lavender Ungu', 'yes', '7.jpg'),
('PRD2361120189', 14, 'PRD1261120187', 'Melati Putih', 150000, '', 'yes', '8.jpg'),
('PRD2831120186', 15, 'PRD1261120187', 'Bunga Biru', 70000, '', 'yes', '9.jpg'),
('PRD2841120189', 16, 'PRD1261120187', 'Mawar Melati', 439000, '', 'yes', '03a13dc2834a1a81b8aeac8938d553e3.jpg'),
('PRD291120181', 17, 'PRD1261120187', 'Bunga Tiga Warna', 35900, '', 'yes', '20c1dbfdee6c8c4b8069b5fa166776a8.jpg'),
('PRD32911201810', 18, 'PRD1261120187', 'Bunga Tiga warna Warni', 70000, '11', 'yes', '40c31a2972c27a6ad591cc714a092ead.jpg'),
('PRD331120183', 7, 'PRD1261120187', 'Yellow Roses', 68000, 'Yellow Roses', 'yes', '8e1206eb3b42ff421f23013ce7a5c3e0.jpg'),
('PRD3811120186', 8, NULL, 'Roses Amalia', 550000, '', 'no', '5.jpg'),
('PRD421120186', 9, NULL, 'Backet Roses', 88000, '', 'no', '6.jpg'),
('PRD4331120181', 10, NULL, 'Bunga Mawar', 119000, 'Mawar harum mewangi', 'no', '7.jpg'),
('PRD4831120185', 13, NULL, 'Bunga 7 Rupa', 350000, 'Bunga untuk melayat', 'no', '1.jpg'),
('PRD4931120183', 14, NULL, 'Bunga Sakura', 45000, 'Bunga Sakura merah muda', 'no', '2.jpg'),
('PRD5061120185', 10, NULL, 'Melati Hijau', 584000, '', 'no', '3.jpg'),
('PRD541120181', 16, NULL, 'Bunga Melati', 225000, 'Bunga melati bagi yang lapar', 'no', '4.jpg'),
('PRD6811201810', 17, NULL, 'Kembang Kancil', 150000, '', 'no', '5.jpg'),
('PRD7121120182', 18, NULL, 'Kembang 7 warna', 335000, '', 'no', '6.jpg'),
('PRD7211120180', 10, NULL, 'Kembang 3 Warna', 125000, 'Kembang 3 warna cocok untuk pengantin baru', 'no', '7.jpg'),
('PRD72311201810', 10, NULL, 'Bunga Sakura', 29900, '', 'no', '8.jpg'),
('PRD7581120184', 9, NULL, 'Bunga Tulip', 95000, '', 'no', '9.jpg'),
('PRD7681120181', 10, NULL, 'Bunga Edels', 133000, 'Bunga Eldels terbaru', 'no', '1.jpg'),
('PRD8581120186', 13, NULL, 'Bunga Zaitun', 1650000, '', 'no', '4.jpg'),
('PRD8751120183', 14, NULL, 'Merah Kuning Flower', 297000, '', 'no', '5.jpg'),
('PRD941120189', 15, NULL, 'Bunga turki', 970, 'Bunga turki', 'no', '6.jpg'),
('PRD9440107192', 16, 'PRD1261120187', 'Bunga Zaitun', 500000, 'Bunga Zaitun', 'yes', '7.jpg'),
('PRD9631120183', 17, NULL, 'Bunga Kancil Putih', 199900, '', 'no', '8.jpg'),
('PRD9791120184', 18, NULL, 'Kembang 7 warna', 28000, 'Kembang 7 warna', 'no', '9.jpg'),
('PRD9921120182', 13, NULL, 'Bunga Merapi', 345000, '', 'no', '1.jpg'),
('PRD9931120186', 9, NULL, 'Bunga Kol', 3500000, '', 'no', '2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

CREATE TABLE `promo` (
  `promo_id` int(11) NOT NULL,
  `produk_kode` varchar(15) NOT NULL,
  `promo_diskon` int(11) NOT NULL,
  `promo_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `promo_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `promo`
--

INSERT INTO `promo` (`promo_id`, `produk_kode`, `promo_diskon`, `promo_start`, `promo_end`) VALUES
(5, 'PRD1261120187', 20, '2018-11-20 02:13:15', '2019-06-11 00:00:00'),
(6, 'PRD13311201810', 25, '2018-11-13 00:00:00', '2019-06-25 00:00:00'),
(7, 'PRD1941120181', 12, '2018-11-05 00:00:00', '2019-06-21 00:00:00'),
(8, 'PRD2361120189', 14, '2018-11-21 00:00:00', '2019-06-21 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `rekening_id` int(11) NOT NULL,
  `rekening_bank` varchar(25) NOT NULL,
  `rekening_nama` varchar(50) NOT NULL,
  `rekening_nomor` varchar(25) NOT NULL,
  `rekening_gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`rekening_id`, `rekening_bank`, `rekening_nama`, `rekening_nomor`, `rekening_gambar`) VALUES
(2, 'BRI', 'Engga Kurnia Putri', '0213152049', 'logo_bca.png'),
(3, 'BCA', 'Dian Nelvia Riza', '0212441641', 'logo_bca1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_judul` varchar(50) NOT NULL,
  `slider_ket` text NOT NULL,
  `slider_gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_judul`, `slider_ket`, `slider_gambar`) VALUES
(10, 'Slide 1', 'slide 1 slide 1 slide 1 slide 1 slide 1 slide 1 ', '0156de8490ee0690e4fe98e1bda14bdd.jpg'),
(12, '', '', '687c0da67b87281183c86d704a33ec21.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `sk_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `sk_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_kategori`
--

INSERT INTO `sub_kategori` (`sk_id`, `kategori_id`, `sk_nama`) VALUES
(7, 10, 'Bunga Asli'),
(8, 10, 'Bunga Imitasi'),
(9, 11, 'Bunga Dalam Ruangan'),
(10, 11, 'Bunga Luar Ruangan'),
(13, 12, 'Weeding Boards'),
(14, 12, 'Suka Cita'),
(15, 13, 'Basket Bucket'),
(16, 13, 'Basket Small'),
(17, 14, 'Vas Plastik'),
(18, 14, 'Vas Kaca');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(25) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_nama` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_tel` char(12) NOT NULL,
  `user_alamat` text NOT NULL,
  `user_jk` enum('L','P') NOT NULL,
  `user_role` enum('customer','admin','pemilik') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_nama`, `user_email`, `user_tel`, `user_alamat`, `user_jk`, `user_role`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'admin', 'admin@aaa.com33', '082222333', 'jl.aaa44411', 'L', 'admin'),
(4, 'adityads', '202cb962ac59075b964b07152d234b70', 'AdityaDS', 'admin@aaa.com33', '082371373347', 'jl.aaa444112', 'L', 'customer'),
(5, 'wayan', '202cb962ac59075b964b07152d234b70', 'Wayan', 'admin@aaa.com33', '082280568879', 'jl.aaa444', 'P', 'customer'),
(6, 'ranama', '202cb962ac59075b964b07152d234b70', 'Ranama', 'admin@aaa.com33', '082280681966', 'jl.aaa444', 'P', 'customer'),
(7, 'engga', '202cb962ac59075b964b07152d234b70', 'engga', 'engga@gmail.com', '1234', 'jl parameswara', 'P', 'customer'),
(8, 'ega', '698d51a19d8a121ce581499d7b701668', 'ega', 'ega@gmail.com', '082280568879', 'jl parameswara', 'P', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`keranjang_id`),
  ADD KEY `produk_kode` (`produk_kode`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaran_kode`),
  ADD KEY `pemesanan_kode` (`pemesanan_kode`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`pemesanan_kode`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `pemesanan_detailp`
--
ALTER TABLE `pemesanan_detailp`
  ADD PRIMARY KEY (`pdp_id`),
  ADD KEY `pemesanan_kode` (`pemesanan_kode`),
  ADD KEY `produk_kode` (`produk_kode`);

--
-- Indeks untuk tabel `pemesanan_ship`
--
ALTER TABLE `pemesanan_ship`
  ADD PRIMARY KEY (`ps_id`),
  ADD KEY `pemesanan_kode` (`pemesanan_kode`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_kode`),
  ADD KEY `list_id` (`sk_id`);

--
-- Indeks untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`promo_id`),
  ADD KEY `produk_kode` (`produk_kode`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`rekening_id`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indeks untuk tabel `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`sk_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `keranjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaran_kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pemesanan_detailp`
--
ALTER TABLE `pemesanan_detailp`
  MODIFY `pdp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pemesanan_ship`
--
ALTER TABLE `pemesanan_ship`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `promo`
--
ALTER TABLE `promo`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `rekening_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `sk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`produk_kode`) REFERENCES `produk` (`produk_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`pemesanan_kode`) REFERENCES `pemesanan` (`pemesanan_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan_detailp`
--
ALTER TABLE `pemesanan_detailp`
  ADD CONSTRAINT `pemesanan_detailp_ibfk_1` FOREIGN KEY (`pemesanan_kode`) REFERENCES `pemesanan` (`pemesanan_kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_detailp_ibfk_2` FOREIGN KEY (`produk_kode`) REFERENCES `produk` (`produk_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan_ship`
--
ALTER TABLE `pemesanan_ship`
  ADD CONSTRAINT `pemesanan_ship_ibfk_1` FOREIGN KEY (`pemesanan_kode`) REFERENCES `pemesanan` (`pemesanan_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`sk_id`) REFERENCES `sub_kategori` (`sk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `promo_ibfk_1` FOREIGN KEY (`produk_kode`) REFERENCES `produk` (`produk_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD CONSTRAINT `sub_kategori_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
