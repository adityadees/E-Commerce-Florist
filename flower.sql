-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2019 at 11:43 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(50) NOT NULL,
  `kategori_ket` text NOT NULL,
  `kategori_gambar` varchar(50) NOT NULL DEFAULT 'defaultkat.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`, `kategori_ket`, `kategori_gambar`) VALUES
(10, 'Bouquets', 'Buket Bunga', '0_f3ee8418-870f-4b29-82e8-c9967d04486d_540_540.jpg'),
(11, 'Flower Stand', 'Bunga Hias', 'hbz-fashion-politics-index5-1522870340.jpg'),
(12, 'Flower Boards', 'Karangan Bunga', 'defaultkat.png'),
(13, 'Flower In Basket', 'Bunga keranjang', 'defaultkat.png'),
(14, 'Flower In Vase', 'Bunga di dalam vas', 'defaultkat.png');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `keranjang_id` int(11) NOT NULL,
  `produk_kode` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keranjang_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `list_id` int(11) NOT NULL,
  `sk_id` int(11) NOT NULL,
  `list_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`list_id`, `sk_id`, `list_nama`) VALUES
(10, 7, 'Bunga Mawar'),
(11, 7, 'Bun'),
(12, 8, 'AC'),
(13, 8, 'Kipas Angin'),
(14, 9, 'Kain Hijab'),
(15, 9, 'Aksesoris Hijab'),
(16, 10, 'Jaket Levis'),
(17, 10, 'Jaket Kulit'),
(22, 13, 'Spion'),
(23, 13, 'Lampu'),
(24, 14, 'Oli Motor'),
(25, 14, 'Oli Mobil'),
(26, 15, 'Snack'),
(27, 15, 'Wafer'),
(28, 16, 'Bukan Kaleng Kaleng'),
(29, 16, 'Soda'),
(30, 17, 'Kompor Gas'),
(31, 17, 'Kompor Listrik'),
(32, 18, 'Gelas Anti Pecah'),
(33, 18, 'Gelas Gampang Pecah');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
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
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`pembayaran_kode`, `pemesanan_kode`, `pembayaran_nama`, `pembayaran_pesan`, `pembayaran_status`, `pembayaran_method`, `pembayaran_tanggal`, `pembayaran_bukti`) VALUES
(2, 'INV90111182748', NULL, NULL, 'selesai', 'ditempat', '2018-12-18 00:30:15', NULL),
(3, 'INV5561118292', 'budi', NULL, 'selesai', 'transfer', '2018-12-17 03:40:36', 'a168aed1818caefbc649299892d9af3c_(1).jpg'),
(4, 'INV1581218112', NULL, NULL, 'belumbayar', 'transfer', NULL, NULL),
(5, 'INV7811218177', NULL, NULL, 'pending', 'ditempat', '2018-12-18 00:30:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
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
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`pemesanan_kode`, `user_id`, `pemesanan_subtotal`, `pemesanan_ongkir`, `pemesanan_total`, `pemesanan_status`, `pemesanan_tanggal`) VALUES
('INV1581218112', 4, 290500, 0, 290500, 'waiting', '2018-12-12 00:05:05'),
('INV5561118292', 4, 2625, 5000, 7625, 'selesai', '2018-10-11 08:38:33'),
('INV7811218177', 4, 977400, 0, 977400, 'waiting', '2018-12-18 00:27:27'),
('INV90111182748', 4, 276400, 0, 276400, 'selesai', '2018-11-27 07:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_detailp`
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
-- Dumping data for table `pemesanan_detailp`
--

INSERT INTO `pemesanan_detailp` (`pdp_id`, `pemesanan_kode`, `produk_kode`, `pdp_qty`, `pdp_bonus`, `pdp_harga`, `pdp_diskon`, `pdp_subtotal`) VALUES
(3, 'INV90111182748', 'PRD1261120187', 2, 1, 125000, 0, 250000),
(4, 'INV90111182748', 'PRD1941120181', 1, 0, 26400, 12, 26400),
(5, 'INV5561118292', 'PRD13311201810', 1, 0, 2625, 25, 2625),
(6, 'INV1581218112', 'PRD1261120187', 2, 1, 125000, 0, 250000),
(7, 'INV1581218112', 'PRD13311201810', 3, 0, 3500, 0, 10500),
(8, 'INV1581218112', 'PRD1941120181', 1, 0, 30000, 0, 30000),
(9, 'INV7811218177', 'PRD1261120187', 4, 2, 125000, 0, 500000),
(10, 'INV7811218177', 'PRD2841120189', 1, 0, 439000, 0, 439000),
(12, 'INV7811218177', 'PRD13311201810', 1, 0, 3500, 0, 3500);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_ship`
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
-- Dumping data for table `pemesanan_ship`
--

INSERT INTO `pemesanan_ship` (`ps_id`, `pemesanan_kode`, `ps_nama`, `ps_email`, `ps_tel`, `ps_alamat`) VALUES
(1, 'INV90111182748', 'tesadmin', 'admin@aaa.com33', '082222333', 'jl.aaa44411'),
(2, 'INV5561118292', 'AdityaDS', 'admin@aaa.com33', '082222333', 'jl.aaa44411'),
(3, 'INV1581218112', 'AdityaDS', 'admin@aaa.com33', '082222333', 'jl.aaa44411\r\n'),
(4, 'INV7811218177', 'AdityaDS', 'admin@aaa.com33', '082222333', 'jl.aaa444112');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
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
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_kode`, `sk_id`, `produk_parent`, `produk_nama`, `produk_harga`, `produk_ket`, `produk_up`, `produk_gambar`) VALUES
('PRD1261120187', 7, 'PRD13311201810', 'Antena Tv (SUPER JERNIH)BISA DIPUTAR 360 DERAJAT)', 125000, '# NEW PRODUCT #\r\n\r\n> SUDAH TERMASUK KABEL +-/- 10 METER\r\n> SUDAH TERMASUK BOOSTER DAN REMOTE\r\nCOCOK UNTUK DAERAH YANG SUSAH MENDAPATKAN SINYAL\r\n# BISA DI PUTAR 360 DERAJAT \r\n\r\nAntena Remote Digital berkualitas tinggi\r\nsangat mudah dan praktis dipasang untuk memperkuat dan memperjelas gambar pada layar televisi maupun kekuatan sinyal radio. Karena antenna ini mempermudah mendapatkan channel UHF / VHF TV dan FM Radio. Sangat efektif digunakan pada TV LED / digital maupun TV analog.\r\nPraktis dan sangat mudah dipasang.\r\n>>>BISA DI PASANG INDOOR DAN OUTDOOR<<', 'yes', '1.jpg'),
('PRD13311201810', 8, NULL, 'Bros Dagu Kecil Hijab Jilbab Aksesoris Wanita Korea Murah Terbaru', 3500, 'Bros Dagu Kecil Hijab Aksesoris Wanita Korea Murah Terbaru\r\n\r\nBEST SELLER.....\r\n\r\nBROS KECIL, BROS DAGU\r\nBros dagu dengan model yang cantik, kecil mungil, berkilauan dan elegant saat dipakai. \r\nBerfungsi sebagai pemanis untuk disematkan pada hijab / busana anda, membuat penampilan anda menjadi makin sempurna. \r\n\r\nTahan lama, hindari kontak dengan zat kimia, seperti parfum dan hand&body lotion.\r\n\r\nharga untuk 1 pcs\r\n\r\npilihan MODEL BOLEH CAMPUR\r\n\r\ncantumkan nomer model yang anda inginkan pada catatan untuk penjual. \r\nJika tidak, kami akan kirimkan secara random sesuai dengan stock yang tersedia.\r\n\r\nwarna dasar : silver\r\nmata : crystal putih bening\r\njarum : runcing', 'no', '2.jpg'),
('PRD1441120180', 9, NULL, 'Kabel Loop Out Antena TV', 14400, 'kabel loop antena biasa digunakan untuk menghubungkan perangkat TV ke Set Top Box / STB atau ke konektor antena dinding.\r\n\r\nUntuk pemasangan dari TV ke STB biasanya menggunakan jenis Male to Female, sedangkan pemasangan dari TV ke konektor antena dinding pilih male to male.\r\n\r\nkeunggulan produk kami\r\n1. Buatan sendiri jadi mutu jelas terjamin.\r\n2. Konektor Antena menggukanan jenis metalik yang lebih awet dibandingkan jenis PVC.\r\n3. Kabel menggunakan standar yang biasanya digunakan untuk parabola.\r\n4. Pemasangan terisolasi untuk menghindari konsleting antara kutup positif & negatif\r\n5. Stok selalu baru karena kami hanya membuat kabel loop jika ada pesanan saja.\r\n\r\nkonektor sesuai pesanan\r\n1. male to male\r\n2. male to female\r\n3. female to female\r\n\r\nPanjang Kabel Bisa memilih 1meter Atau 1,5meter\r\n\r\nJika tidak memberikan keterangan maka akan dikirim kabel konektor male to femalr (untuk set top box)', 'no', '3.jpg'),
('PRD1941120181', 10, NULL, 'Kipas Angin Mini fan / kipas angin portable / kipas angin gengam', 30000, 'Kapasitas Baterai : 2000mAh\r\nJenis Baterai : Battery 18650 lithium\r\nukuran produk : 150 x 130 x 42mm\r\nDaya Penggunaan :\r\n-- Kecepatan Pelan : 6 1/2 jam\r\n-- Kecepatan Sedang : 3 1/2 jam\r\n-- Kecepatan Maksimal : 1 1/2 jam\r\nAda Anti Slip pada kaki Kipas sehingga tidak mudah berpindah dari tempat nya.\r\n\r\nPaket Berisi :\r\n1 pc Head Kipas Angin\r\n1 pc Baterai (Khusus)\r\n1 pc Kabel data Micro\r\n\r\nFitur :\r\n1. Bentuk yang sempurna , dapat berotasi sampai dengan 330 drajat dan disesuaikan dengan penggunaan pribadi.\r\n\r\n2. Daya baterai : 2000mAh dengan 18650 lithium batteries\r\nOutput listrik 5V/1A, dan dapat juga digunakan sebagai PowerBank HP.\r\n\r\n3. Penampilan yang indah, detail cetakan yang menarik\r\n4. 3 Sayap kipas, Mudah dibawa, Hembusan yang kuat juga menjadikan alasan kenapa Anda harus membeli produk ini.\r\n\r\n5. Dengan Dinamo DC brushless tembaga yang memiliki keunggulan durabilitas yang lama, tidak terlalu panas dan efisiensi output kipas lebih baik.\r\n\r\n6. Bahan baku dari plastik ABS757 import , Hasil cetakan / kompresi yang baik, bermutu tinggi dan penampilan baik.\r\n7. Dengan sirkuit perlindungan built-in, kipas akan mati secara otomatis ketika sesuatu menyisipkan dan memblokir daun kipas untuk melindungi jari-jari Anda dari pemotongan', 'no', '4.jpg'),
('PRD2331120188', 13, NULL, 'Antenna Antena Tv outdoor dengan remote dan booster + kabel PF 850', 89500, 'Antena TV Outdoor dengan Remote + Booster dan + Kabel\r\n\r\nKeunggulan :\r\n1. Kokoh ( pipa alumunium yang awet ) dan dapat berputar 360 Derajat, sehingga memudahkan untuk mencari frekuensi dengan remote\r\n2. Dual frekuensi ( UHF / VHF ) \r\n3. Tahan terhadap cuaca hujan atau panas\r\n4. Motor remote tidak berisik\r\n5. Dilengkapi dengan remote control\r\n6. Dilengkapi juga dengan booster untuk memperkuat sinyal tangkapan\r\n\r\nCocok untuk Type TV : TV Tabung, Plasma, LCD, LED\r\n\r\nSpesifikasi:\r\n- Antena + Mesin Rotari \r\n- Kabel + Jack\r\n- Remote\r\nAntena TV Tipe : PF 850 Built in Booster For VHF / UHF \r\nChannels Gain : VHF (25dB), UHF (28dB) Channels : VHF (1-12), UHF (21-69) Impedance : 75 \r\nPower : AC 220V 50Hz \r\nBaterai Remote : 2x AAA (tidak termasuk dlm paket)\r\nSuper Performance : 25dB Gain PF 850 \r\nAntena TV dilengkapi remote control untuk mempermudah memindahkan arah antena sesuai keinginan. \r\nAntena ini dilengkapi dengan BOOSTER dan KABEL 3C Coaxial 10 meter. \r\nLow Noise PF 850 TV Remote Controlled Rotatting Antenna dapat menangkap siaran jarak jauh dengan tingkat gangguan rendah. \r\n\r\nNotes: Semua BARANG Telah Kami Periksa & Tes Bagus, Tidak dapat ditukar/ dikembalikan. Terima kasih. Selamat Berbelanja.', 'no', '7.jpg'),
('PRD2361120189', 14, NULL, 'baju tidur', 150000, '', 'no', '8.jpg'),
('PRD2831120186', 15, NULL, 'CELANA PENDEK / CELANA PENDEK KATUN / CELANA PENDEK PRIA', 70000, '', 'no', '9.jpg'),
('PRD2841120189', 16, NULL, 'Baju Kaos Motif Polos Raglan Reglan Baju Lengan Panjang Cowok Pria - Hijau Navy', 439000, '', 'no', '1.jpg'),
('PRD291120181', 17, NULL, 'Baju Tidur / Piyama / Baju Tidur Wanita Setelan', 35900, '', 'no', '2.jpg'),
('PRD32911201810', 18, NULL, 'JOGGER STRIPE PANTS', 70000, '', 'no', '3.jpg'),
('PRD331120183', 7, NULL, 'Kipas angin hello kitty / kipas angin duduk / kipas angin usb', 68000, 'Kipas angin hello kitty / kipas angin duduk / kipas angin usb', 'no', '4.jpg'),
('PRD3811120186', 8, NULL, 'Oli Mobil 1 SAE 5W30 API SN kemasan galon 4 liter', 550000, '', 'no', '5.jpg'),
('PRD421120186', 9, NULL, 'ARAL BASIC ENERGY 2T OLI SAMPING MOTOR (100% FROM GERMANY)', 88000, '', 'no', '6.jpg'),
('PRD4331120181', 10, NULL, 'jaket denim jeans Levis', 119000, 'jaket denim jeans Levis', 'no', '7.jpg'),
('PRD4831120185', 13, NULL, ' ANTENA /ANTENNA TV DIGITAL DALAM INDOOR MODEL PF HD.14 HD14', 350000, 'panjang kabel 120cm', 'no', '1.jpg'),
('PRD4931120183', 14, NULL, 'KABEL ANTENA TV 20 METER', 45000, 'Kabel Antena tv outdoor 20 meter\r\nsudah siap pakai tinggal colok karena sudah terpasang kepala nya langsung', 'no', '2.jpg'),
('PRD5061120185', 10, NULL, 'Lampu Mobil Led H4 Dual Beam Plug n Play', 584000, '', 'no', '3.jpg'),
('PRD541120181', 16, NULL, 'celana panjang sobek pria / celana panjang strech sobek pria - Cokelat Muda, 32', 225000, 'celana panjang sobek pria / celana panjang strech sobek pria - Cokelat Muda, 32', 'no', '4.jpg'),
('PRD6811201810', 17, NULL, 'jaket pria semi kulit 01 - Hitam, S', 150000, '', 'no', '5.jpg'),
('PRD7121120182', 18, NULL, 'Oli Yamalube Yamaha Matic Motor Oil 20 W 40 0.8L', 335000, '', 'no', '6.jpg'),
('PRD7211120180', 10, NULL, 'Jaket Jeans Jaket Levis Jaket Pria Jaket Grosir Jaket Murah', 125000, 'JAKET JEANS LEVI\'S\r\n\r\nWarna : BioBlitz / Biru Muda & BioWash / Biru Tua\r\n\r\nSize : M L XL\r\n\r\nPrediksi ukuran :\r\n\r\nM = Panjang 56 x Lebar dada 47-49 x Panjang tangan 57-58\r\n\r\nL = Panjang 58 x Lebar dada 48-50 x Panjang tangan 58\r\n\r\nXL = Panjang 60 x Lebar dada 52x Panjang tangan 58\r\n\r\n- Bahan Jeans Tebal / Denim\r\n\r\n- Terdapat tag kulit pada bagian punggung dalam jaket\r\n\r\n- Aksesoris dan Kancing terdapat logo levis ', 'no', '7.jpg'),
('PRD72311201810', 10, NULL, 'Tumblr Lamp / Lampu Tumblr / Lampu Natal / Lampu Hias LED 10 Meter', 29900, '', 'no', '8.jpg'),
('PRD7581120184', 9, NULL, 'celana cargo pendek celana pendek celana pdl', 95000, '', 'no', '9.jpg'),
('PRD7681120181', 10, NULL, 'Antena TV digital indoor outdoor PX DA - 5200', 133000, 'SPESIAL PROMO !!!\r\npacking rapi.\r\n\r\nbarang original, komplit n bergaransi resmi PX 18 BULAN.... \r\n\r\nbagi konsumen yg kurang mengerti dengan cara pemasangannya nanti bisa chat sama kita dan dengan senang hati akan kita pandu n bantu sampai bisa\r\n\r\ngaransi uang kembali 100 persen apabila barang yg di terima bukan original alias KW\r\n\r\nmodel terbaru dari PX DA 5700\r\n\r\nDigital TV Antenna Indoor / Outdoor DA-5200 \r\n\r\nDA-5200 adalah sebuah antena desain khusus untuk menerima sinyal digital terrestrial broadcasting. Dengan menggunakan teknologi dan sirkuit tingkat kebisingan rendah, akan memberikan daya terima sinyal yang baik. Dan desain yang menarik dan model yang bergaya,dimana akan bekerja sangat baik dengan STB (Set Top Box) Digital Anda.\r\n\r\nDengan model yang Anti Air dan tahan terhadap Sinar UV, Antena seri DA-5200 dapat dipasang pada dinding, jendela dan dengan disediakannya aksesoris kunci pada tiang, Anda dapat memasang DA-5200 pada tiang kayu atau tiang besi. Dengan mekanisme tiang antena multi arah, Anda dapat mengatur ke arah mana saja untuk mendapatkan sinyal yang terbaik.\r\n\r\nBila ingin mendapatkan informasi lebih lengkap mengenai produk DA-5200, baik mengenai perangkat dan solusinya. Hubungi kami dan tinggalkan nomer kontak Anda, Sales kami akan segera menghubungi Anda.\r\n\r\nFitur :\r\n* Desain yang menarik dan bergaya.\r\n* Metode Instalasi beragam, instalasi pada wall-mounted atau pole-mounted\r\n* UHF 470~870MHz\r\n* VHF 47~230MHz\r\n* Meningkatkan sinyal 203dB\r\n* Teknologi amplifier kebisingan rendah\r\n* Pengaturan Arah yang luas\r\n* Anti air dan tahan sinar UV and anti-UV housing\r\n\r\n\r\nisi box :\r\n1. main unit\r\n2. 3 meter antena kabel\r\n3. power inserter dan adaptor\r\n4. Dudukan antena yang fleksibel ke segala arah\r\n5. cable scrap untuk pengikat dudukan\r\n6. Stand\r\n7. manual book dan garansi card\r\n\r\nantena setiap daerah beda frekuensi n kalau ada yg dapat signal kurang bagus gak bisa komplen atau retur. makasih', 'no', '1.jpg'),
('PRD8581120186', 13, NULL, 'jaket pria moderen .semi kulit - Merah', 1650000, '', 'no', '4.jpg'),
('PRD8751120183', 14, NULL, 'Oli Gear - Mobil 1 Syn Gear Lube LS 75W-90 (1 liter)', 297000, '', 'no', '5.jpg'),
('PRD941120189', 15, NULL, 'Klip Turki Hijab Mutiara Lonjong / Clip Peniti Tuspin Jilbab Kerudung', 970, 'Klip Turki yang sedang hits membuat jilbab anda lebih awet karena kain tidak ditembus jarum atau peniti konvensional. \r\nPenggunaan juga mudah, cukup diselipkan dan didorong pada kerudung dibawah dagu, atau tempat yang lazim dipasang peniti atau jarum. ^_^ ', 'no', '6.jpg'),
('PRD9440107192', 16, 'PRD1261120187', 'Antena Super', 500000, 'asd', 'yes', '7.jpg'),
('PRD9631120183', 17, NULL, 'Antena PF Digital HDU-25 - Very High Gain serta Cocok untuk TV Analog dan TV Digital - Perak', 199900, 'PENTING: Order Antena PF HDU 25 TIDAK BISA PAKAI Gojek SAMEDAY / Grab SAMEDAY (JANGAN PILIH YANG 6 jam ya) karena ukurannya sangat besar (sebesar orang dewasa) sehingga tidak bisa dibawa oleh driver Sameday 6 jam yang juga bawa paket-paket lain.\r\n\r\nJadi cuma bisa pakai yang 3 jam (INSTANT) atau JNE ya..\r\n\r\nAntena PF Digital HDU-25 adalah versi tertinggi dengan daya tangkap sinyal PALING TINGGI dan PEKA dari keluarga PF. Jadi jangan heran dengan harganya yang relatif cukup mahal dibandingkan antena biasa\r\n\r\nAntena TV UHF PF HDU-25 ini Produk ASLI INDONESIA, dirancang khusus untuk TV Analog dan TV Digital DVB-T2 di Indonesia. \r\n\r\nFitur:\r\n- Kualitas tinggi dengan bahan alumunium, sangat baik dan peka terhadap sinyal TV analog dan digital DVB-T2\r\n- Didesain untuk menerima sinyal TV UHF, VHF, dan DVB-T2\r\n- Panjang antena 1,6 meter alias 160 cm (TERBESAR DI KELASNYA, antena ini SETINGGI ORANG DEWASA)\r\n- Ringan tapi kokoh dan Mudah dipasang\r\n- Didukung dengan lengan pengunci, sehingga antena tidak mudah roboh, miring, goyang, dan patah.\r\n- Terbukti SANGAT AWET\r\n\r\nFITUR UNGGULAN:\r\nMemiliki Gain (daya tangkap) sinyal yang sangat tinggi, yakni sekitar 7,6 dB ~ 13,7 dB\r\n\r\nBisa digunakan untuk:\r\n- Menerima siaran TV Analog biasa\r\n- Menerima siaran TV Digital (dengan syarat TV yang digunakan sudah berstandar DVB-T2 atau menggunakan Set Top Box DVB-T2)\r\n\r\nKelengkapan:\r\n- Antena\r\n- Lengan Pengunci\r\n\r\n<< FAQ >>\r\nCalon pembeli: mahal banget kok belum termasuk kabel, di toko ga sampe 100 ribu tuh\r\nYusuf Computer: antena ini panjangnya 1,6 meter (antena ini setinggi orang dewasa) berbahan FULL aluminum yang kokoh dengan kualitas premium VIP. Sudah beda kelasnya dibanding antena 100 ribuan\r\n\r\nCATATAN:\r\n- Antena PF HDU-25 ini juga bisa diambil di rumah saya di Bekasi Timur (buat janji terlebih dahulu ya via pesan Tokopedia)\r\n- Per Juni 2018, Barang GARANSI 100% AMAN sampai tujuan diasuransikan. Jika barang diterima rusak, uang dan ongkir akan dikembalikan 100% (hubungi seller max 24 jam setelah barang diterima)', 'no', '8.jpg'),
('PRD9791120184', 18, NULL, 'Kabel Antena TV 20 M', 28000, 'Kabel Antena TV 20 M\r\n\r\nMerk di gambar adalah Maxtron (Merk Tidak Terikat)\r\n\r\nKami akan mengirimkan merk lain dengan harga dan kualitas yang sama jika stok habis\r\n\r\nSudah termasuk 1 buah colokan ke TV\r\n\r\nDiameter kabel 6,5mm\r\n\r\n\r\nTERIMA KASIH Telah berbelanja di Toko Kami\r\n\r\n~~~ Love toko kami supaya anda lebih mudah menemukan perlengkapan dan keperluan rumah tercinta anda. Terima kasih. Salam', 'no', '9.jpg'),
('PRD9921120182', 13, NULL, 'Spion Motor Rep. RIZOMA CIRCUIT 744 NMAX AEROX XMAX VARIO CBR DLL', 345000, '', 'no', '1.jpg'),
('PRD9931120186', 9, NULL, 'AC midea portable 1pk type baru MPF - 09CRN', 3500000, 'AC Portable\r\n1 PK 900 Watt Kapasitas Pendinginan (Btu/h)9.000\r\nuntuk barang kami set 1kg , brng diantar pke supir toko ongkir jakarat 50rb , tanegrang bekasi 100rb , depok bogor tmbh 150rb , ongkir bsa di bayarkan cash ditempat setelah brng sampai\r\nAuto swing\r\nAuto restart fuction\r\nFashion design\r\nWashable filter\r\nTimer\r\nNo bucket design\r\nsleep mode\r\nSelf-diagnosis and auto-protection function\r\nDimensi:W430xD320xH720\r\nBerat:29 Kg', 'no', '2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `promo_id` int(11) NOT NULL,
  `produk_kode` varchar(15) NOT NULL,
  `promo_diskon` int(11) NOT NULL,
  `promo_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `promo_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`promo_id`, `produk_kode`, `promo_diskon`, `promo_start`, `promo_end`) VALUES
(5, 'PRD1261120187', 20, '2018-11-20 02:13:15', '2019-06-11 00:00:00'),
(6, 'PRD13311201810', 25, '2018-11-13 00:00:00', '2019-06-25 00:00:00'),
(7, 'PRD1941120181', 12, '2018-11-05 00:00:00', '2019-06-21 00:00:00'),
(8, 'PRD2361120189', 14, '2018-11-21 00:00:00', '2019-06-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `rekening_id` int(11) NOT NULL,
  `rekening_bank` varchar(25) NOT NULL,
  `rekening_nama` varchar(50) NOT NULL,
  `rekening_nomor` varchar(25) NOT NULL,
  `rekening_gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`rekening_id`, `rekening_bank`, `rekening_nama`, `rekening_nomor`, `rekening_gambar`) VALUES
(2, 'BRI', 'Aditya Dharmawan S', '11250368', 'Logo_BRI.png'),
(3, 'BCA', 'Aditya Dharmawan Saputra', '22263589608', '800px-BNI_logo_svg.png');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_judul` varchar(50) NOT NULL,
  `slider_ket` text NOT NULL,
  `slider_gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_judul`, `slider_ket`, `slider_gambar`) VALUES
(10, 'Slide 1', 'slide 1 slide 1 slide 1 slide 1 slide 1 slide 1 ', 'slide1-h1.jpg'),
(11, 'Slide 2', 'Slide 2 Slide 2 Slide 2 Slide 2 Slide 2 Slide 2 ', 'slide2-h1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `sk_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `sk_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kategori`
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
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_nama`, `user_email`, `user_tel`, `user_alamat`, `user_jk`, `user_role`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'admin', 'admin@aaa.com33', '082222333', 'jl.aaa44411', 'L', 'admin'),
(4, 'adityads', '202cb962ac59075b964b07152d234b70', 'AdityaDS', 'admin@aaa.com33', '082222333', 'jl.aaa444112', 'L', 'customer'),
(5, 'wayan', '202cb962ac59075b964b07152d234b70', 'Wayan', 'admin@aaa.com33', '082222333', 'jl.aaa444', 'P', 'admin'),
(6, 'ranama', '202cb962ac59075b964b07152d234b70', 'Ranama', 'admin@aaa.com33', '082280681966', 'jl.aaa444', 'P', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`keranjang_id`),
  ADD KEY `produk_kode` (`produk_kode`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `sk_id` (`sk_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaran_kode`),
  ADD KEY `pemesanan_kode` (`pemesanan_kode`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`pemesanan_kode`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pemesanan_detailp`
--
ALTER TABLE `pemesanan_detailp`
  ADD PRIMARY KEY (`pdp_id`),
  ADD KEY `pemesanan_kode` (`pemesanan_kode`),
  ADD KEY `produk_kode` (`produk_kode`);

--
-- Indexes for table `pemesanan_ship`
--
ALTER TABLE `pemesanan_ship`
  ADD PRIMARY KEY (`ps_id`),
  ADD KEY `pemesanan_kode` (`pemesanan_kode`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_kode`),
  ADD KEY `list_id` (`sk_id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`promo_id`),
  ADD KEY `produk_kode` (`produk_kode`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`rekening_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`sk_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `keranjang_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaran_kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemesanan_detailp`
--
ALTER TABLE `pemesanan_detailp`
  MODIFY `pdp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pemesanan_ship`
--
ALTER TABLE `pemesanan_ship`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `rekening_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `sk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`produk_kode`) REFERENCES `produk` (`produk_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`sk_id`) REFERENCES `sub_kategori` (`sk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`pemesanan_kode`) REFERENCES `pemesanan` (`pemesanan_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_detailp`
--
ALTER TABLE `pemesanan_detailp`
  ADD CONSTRAINT `pemesanan_detailp_ibfk_1` FOREIGN KEY (`pemesanan_kode`) REFERENCES `pemesanan` (`pemesanan_kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_detailp_ibfk_2` FOREIGN KEY (`produk_kode`) REFERENCES `produk` (`produk_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_ship`
--
ALTER TABLE `pemesanan_ship`
  ADD CONSTRAINT `pemesanan_ship_ibfk_1` FOREIGN KEY (`pemesanan_kode`) REFERENCES `pemesanan` (`pemesanan_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`sk_id`) REFERENCES `sub_kategori` (`sk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `promo_ibfk_1` FOREIGN KEY (`produk_kode`) REFERENCES `produk` (`produk_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD CONSTRAINT `sub_kategori_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
