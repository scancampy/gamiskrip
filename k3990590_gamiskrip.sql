-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2024 at 04:56 PM
-- Server version: 10.5.25-MariaDB-cll-lve
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `k3990590_gamiskrip`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatar_images`
--

CREATE TABLE `avatar_images` (
  `id` int(11) NOT NULL,
  `avatar` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatar_images`
--

INSERT INTO `avatar_images` (`id`, `avatar`) VALUES
(1, 'pic-1.jpg'),
(2, 'pic-2.jpg'),
(3, 'pic-3.png'),
(4, 'pic-4.jpg'),
(5, 'pic-5.png'),
(6, 'pic-6.png'),
(7, 'pic-7.jpg'),
(8, 'pic-8.jpg'),
(9, 'pic-9.png'),
(10, 'pic-10.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cluster_center`
--

CREATE TABLE `cluster_center` (
  `id` int(11) NOT NULL,
  `cluster_center_1` double NOT NULL,
  `cluster_center_2` double NOT NULL,
  `cluster_center_3` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cluster_center`
--

INSERT INTO `cluster_center` (`id`, `cluster_center_1`, `cluster_center_2`, `cluster_center_3`) VALUES
(0, 52.10666667, 8.12, 9.64),
(1, 36.96774194, 22.03225806, 3.666666667),
(2, 9.8, 48.75, 10.8),
(3, 50.53488372, 47.98837209, 4.534883721),
(4, 50.25, 47.82142857, 44.21428571);

-- --------------------------------------------------------

--
-- Table structure for table `cluster_course`
--

CREATE TABLE `cluster_course` (
  `id` int(11) NOT NULL,
  `cluster_id` int(11) NOT NULL,
  `course_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cluster_course`
--

INSERT INTO `cluster_course` (`id`, `cluster_id`, `course_id`) VALUES
(1, 0, '1604C162'),
(2, 0, '1604C29A'),
(3, 0, '1604C131'),
(4, 0, '1604C39D'),
(5, 0, '1604C39G'),
(6, 0, '1604C19G'),
(7, 0, '1604C39E'),
(8, 0, '1604C49G'),
(9, 0, '1604C19E'),
(10, 0, '1604C19D'),
(11, 0, '1604C441'),
(12, 0, '1604C39K'),
(13, 0, '1608C051'),
(14, 0, '1604C161'),
(15, 0, '1604C045'),
(16, 0, '1604C034'),
(17, 0, '1604C19F'),
(18, 0, '1604C024'),
(19, 0, '1604C063'),
(20, 0, '1604C251'),
(21, 0, '1604C052'),
(22, 0, '1604C051'),
(23, 0, '1604C031'),
(24, 0, '1604C044'),
(25, 0, '1604C151'),
(26, 0, '1604C141'),
(27, 0, '1604C033'),
(28, 0, '1604C054'),
(29, 0, '1604C043'),
(30, 1, '1604C19E'),
(31, 1, '1604C162'),
(32, 1, '1607C09C'),
(33, 1, '1604C131'),
(34, 1, '1604C261'),
(35, 1, '1604C49F'),
(36, 1, '1604C19F'),
(37, 1, '1604C19G'),
(38, 1, '1604C161'),
(39, 1, '1604C151'),
(40, 1, '1604C251'),
(41, 1, '1604C014'),
(42, 1, '1604C141'),
(43, 1, '1604C034'),
(44, 1, '1604C033'),
(45, 1, '1604C052'),
(46, 1, '1604C262'),
(47, 1, '1604C024'),
(48, 1, '1604C031'),
(49, 1, '1604C19I'),
(50, 1, '1600C106'),
(51, 1, '1604C044'),
(52, 1, '1604C054'),
(53, 1, '1604C063'),
(54, 1, '1604C051'),
(55, 1, '1604C043'),
(56, 2, '1604C261'),
(57, 2, '1604C251'),
(58, 2, '1604C19F'),
(59, 2, '1604C262'),
(60, 2, '1604C056'),
(61, 2, '1608C051'),
(62, 2, '1604C162'),
(63, 2, '1604C131'),
(64, 2, '1604C39A'),
(65, 2, '1604C024'),
(66, 2, '1604C051'),
(67, 2, '1604C034'),
(68, 3, '1604C39B'),
(69, 3, '1604C29A'),
(70, 3, '1604C161'),
(71, 3, '1604C162'),
(72, 3, '1604C39A'),
(73, 3, '1604C19D'),
(74, 3, '1604C19E'),
(75, 3, '1604C362'),
(76, 3, '1604C431'),
(77, 3, '1604C131'),
(78, 3, '1604C351'),
(79, 3, '1604C39K'),
(80, 3, '1604C39C'),
(81, 3, '1604C39E'),
(82, 3, '1604C39G'),
(83, 3, '1604C19G'),
(84, 3, '1604C39D'),
(85, 3, '1604C441'),
(86, 3, '1604C49E'),
(87, 3, '1604C331'),
(88, 3, '1608C051'),
(89, 3, '1604C361'),
(90, 3, '1604C49H'),
(91, 3, '1604C023'),
(92, 3, '1604C042'),
(93, 3, '1604C055'),
(94, 3, '1604C014'),
(95, 3, '1600C104'),
(96, 3, '1604C39F'),
(97, 3, '1604C056'),
(98, 3, '1604C051'),
(99, 3, '1604C052'),
(100, 3, '1604C063'),
(101, 3, '1604C034'),
(102, 3, '1604C054'),
(103, 3, '1604C141'),
(104, 3, '1604C043'),
(105, 3, '1604C024'),
(106, 4, '1604C39E'),
(107, 4, '1604C39B'),
(108, 4, '1604C39K'),
(109, 4, '1604C29A'),
(110, 4, '1604C362'),
(111, 4, '1604C19D'),
(112, 4, '1604C341'),
(113, 4, '1604C39C'),
(114, 4, '1604C39J'),
(115, 4, '1604C39G'),
(116, 4, '1604C19E'),
(117, 4, '1604C361'),
(118, 4, '1604C042'),
(119, 4, '1604C39D'),
(120, 4, '1604C162'),
(121, 4, '1604C055'),
(122, 4, '1604C49I'),
(123, 4, '1604C023'),
(124, 4, '1604C39A'),
(125, 4, '1604C331'),
(126, 4, '1604C031'),
(127, 4, '1604C056');

-- --------------------------------------------------------

--
-- Table structure for table `cluster_result`
--

CREATE TABLE `cluster_result` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cluster_code` int(11) NOT NULL,
  `encoding_course_1` int(11) NOT NULL,
  `encoding_course_2` int(11) NOT NULL,
  `encoding_course_3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cluster_result`
--

INSERT INTO `cluster_result` (`id`, `title`, `cluster_code`, `encoding_course_1`, `encoding_course_2`, `encoding_course_3`) VALUES
(1, 'Pembuatan Sistem Informasi Berbasis Web sebagai Inventory Control Gudang UD. Jago Aluminium', 0, 43, 6, 2),
(2, 'Pembuatan Sistem Informasi Pemesanan dan Pengiriman Toko Retail dengan Konfigurasi', 0, 43, 8, 6),
(3, 'Aplikasi Pembelajaran Matematika Untuk Ujian Sekolah Tingkat SMP Berbasis Mobile', 0, 67, 18, 4),
(4, 'Aplikasi Personal Health Assistant', 0, 46, 6, 4),
(5, 'Pembuatan Marketplace Sewa Menyewa Barang Berbasis Web', 0, 43, 2, 24),
(6, 'Pembuatan Aplikasi Sistem Penilaian Mata Kuliah Berbasis Outcome Based Education (EDU) pada Fakultas Teknik Universitas Surabaya', 0, 46, 2, 24),
(7, 'Pembuatan Sistem Informasi Manajemen Sekolah Pada Yayasan Karya Luhur Nusantara', 0, 46, 6, 24),
(8, 'Penggunaan Artificial Neural Network Sebagai Pengembangan Dari Finite State Machine Pada Enemy AI Dalam Game Adventure', 0, 63, 7, 18),
(9, 'Pembuatan Aplikasi Booking Lapangan Badminton di Surabaya Berbasis Android', 0, 43, 4, 23),
(10, 'Pembuatan Aplikasi Bantu Baca Kata Untuk Lansia', 0, 59, 18, 4),
(11, 'Pengembangan Sistem Informasi Perencanaan Keuangan dan Investasi Skala Kecil', 0, 46, 6, 24),
(12, 'Pembuatan Website untuk Survei Tracer Study Jurusan Teknik Informatika Universitas Surabaya', 0, 44, 3, 2),
(13, 'Pembuatan Mobile Application Untuk Media Pembelajaran Alternatif Berbasis Android', 0, 67, 18, 4),
(14, 'Perancangan Penjadwalan Pelayan yang Seimbang pada Gereja GKKAI-Tenggilis Berbasis Android', 0, 58, 26, 4),
(15, 'Pembuatan Aplikasi Marketplace Urban Farming Berbasis Mobile Application', 0, 43, 3, 4),
(16, 'Pembuatan Aplikasi Monitoring Komplain Berbasis Android', 0, 43, 3, 4),
(17, 'Pembuatan Aplikasi Generator Iklan Properti Untuk Agen Properti', 0, 59, 18, 4),
(18, 'Pembuatan Aplikasi Generator Sertifikat', 0, 59, 6, 4),
(19, 'Pembuatan Online Marketplace Jasa Laundry Berbasis Mobile', 0, 43, 3, 5),
(20, 'Pembuatan Aplikasi Mobile Untuk The Original Barbershop', 0, 43, 3, 5),
(21, 'Pembuatan Aplikasi Berbasis Web Untuk Manajemen Desain Arsitektur Rumah', 0, 46, 3, 2),
(22, 'Pembuatan Sistem Informasi Akuntansi pada Kapal Ferry', 0, 43, 3, 2),
(23, 'Pembuatan Website E-Commerce dengan Integrasi Payment Gateway Berbasis Blackchain', 0, 77, 14, 1),
(24, 'Pembuatan Mobile APPS Berbasis Android dengan Memanfaatkan Geolokasi untuk Pengawasan Proses Belajar Siswa', 0, 45, 3, 4),
(25, 'Pembuatan Aplikasi E-Planning Berbasis Website Untuk Pemerintah Kota Surabaya', 0, 61, 3, 2),
(26, 'Pembuatan Sistem Informasi Pariwisata Sebagai Media Panduan Wisata Untuk Kawasan Trawas Berbasis Mobile', 0, 45, 3, 5),
(27, 'Pembuatan Sistem Informasi Manajemen Aset di Dinas Kebersihan Kota Surabaya', 0, 61, 27, 3),
(28, 'Pembuatan Sistem Informasi Administrasi Pada Showroom Mobil Bekas', 0, 43, 3, 2),
(29, 'Pembuatan Aplikasi Crowd Reporting System Untuk Pemerintah Daerah', 0, 61, 24, 4),
(30, 'Pembuatan Aplikasi Generator Buku Wisuda Universitas Surabaya Berbasis Website', 0, 59, 18, 1),
(31, 'Pembuatan Aplikasi Pembelajaran Japanese-Language Proficiency Test Level NS pada Sistem Operasi Android', 0, 67, 18, 4),
(32, 'Pengembangan Software Perencanaan Kenaikan Jabatan Akademik dan Administrasi Sesuai Dengan Aturan Lokal dan Kopertis Tahun 2014 pada My dan Sinta Ubaya Berbasis Website', 0, 44, 6, 1),
(33, 'Pembuatan Aplikasi Administrasi Akademik di Bimbingan Belajar \"AO\"', 0, 43, 3, 2),
(34, 'Pembuatan Sistem Informasi Penitipan Anak pada Yayasan X Berbasis Website', 0, 46, 2, 24),
(35, 'Pembuatan Aplikasi Pemantau Kesuburan dan Masa Kehamilan Perempuan Berbasis Android', 0, 46, 4, 24),
(36, 'Sistem Informasi Jasa Penyewaan alat Fotografi pada Kurnia Kamera Probolinggo', 0, 43, 2, 24),
(37, 'Pembuatan Sistem Informasi Administrasi Pada Dinas Pemberdayaan Perempuan Perlindungan Anak dan Keluarga Berencana (DP3AKB)', 0, 43, 3, 2),
(38, 'Pembuatan Sistem Manajemen Pembelajaran Terpadu Berbasis Web Pada SMAN 1 Pandaan', 0, 46, 6, 2),
(39, 'Pembuatan Aplikasi Mobile Mengenai Fitnes Untuk Pemula', 0, 44, 6, 4),
(40, 'Sistem Informasi Pasien Rumah Sakit', 0, 43, 6, 24),
(41, 'Sistem Informasi Logistik Rumah Sakit', 0, 43, 6, 24),
(42, 'Pembuatan Sistem Rekam Medis Elektronik Dengan Memanfaatkan Cloud Computing', 0, 50, 6, 3),
(43, 'Pembuatan Platform Marketplace sebagai Wadah Transaksi karya Seni dan Interaksi Sosial', 0, 43, 6, 24),
(44, 'Pengembangan Aplikasi Basis Data Perhitungan Bahan Pembuatan Jalan Berbasis NLP', 0, 56, 24, 3),
(45, 'Pembuatan Aplikasi Game-Based Learning Pembelajaran Menghafal Al-Quran Bagi Pemula', 0, 67, 4, 18),
(46, 'Pembuatan Aplikasi Partitur Paduan Suara Berbasis Website', 0, 59, 6, 18),
(47, 'Pembuatan Sistem Informasi Manajemen Hubungan Pelanggan Perusahaan Keramik \"X\"', 0, 46, 6, 24),
(48, 'Pembuatan Game Pembelajaran Pengenalan Post Positif Dan Post Negatif Pada Media Sosial', 0, 67, 7, 18),
(49, 'Pembuatan Game Survival Interactive Story dengan Menggunakan Speech Recognition dan Accelerometer.', 0, 66, 4, 18),
(50, 'Pembuatan Game Virtual Life yang Memanfaatkan Speech Recognition', 0, 56, 7, 18),
(51, 'Pembuatan Game Tower Defense Menggunakan Algoritma A*', 0, 63, 7, 18),
(52, 'Pembuatan Web Database Dengan Fasilitas Multiple Sequence Alignment Menggunakan Metode Clustalw untuk DNA Sauropus Androgynus', 0, 59, 24, 2),
(53, 'Pembuatan Sistem Inventaris Toko Sparepart Mobil \"Universal Motor\" Berbasis Android', 0, 43, 6, 3),
(54, 'Pembuatan Aplikasi Desain Pakaian Batik', 0, 59, 6, 18),
(55, 'Pembuatan Sistem Informasi Tour and Travel dengan Fitur Custom Trip Berbasis Web', 0, 43, 6, 2),
(56, 'Perancangan Sistem Informasi Rekap Nilai Melalui Pengenalan Karakter Dalam Gambar Berbasis Telepon Genggam', 0, 59, 6, 4),
(57, 'Pembuatan Aplikasi Pembelajaran Bahasa Jepang Level Dasar Berbasis Android', 0, 59, 6, 4),
(58, 'Pembuatan Aplikasi \"Retail Self Scanner\" Berbasis Android untuk Swalayan Ommi Universitas Surabaya', 0, 43, 4, 24),
(59, 'Pembuatan Aplikasi Edukasi Aksara Jawa Interaktif Untuk Siswa Sekolah Dasar', 0, 67, 18, 4),
(60, 'Pembuatan Sistem Informasi Pelayanan Jasa Servis dan Penjualan Pembelian Spare Parts Motor pada Bengkel Sepeda Motor', 0, 43, 6, 24),
(61, 'Pembuatan Aplikasi Alat Bantu Menggambar Diagram Relasi Entitas Dengan Notasi Crow\'s Foot Menggunakan HTML 5 Canvas', 0, 59, 18, 6),
(62, 'Pembuatan Sistem Informasi Akuntansi Toko Roti \"Tirotti\"', 0, 42, 6, 2),
(63, 'Pembuatan Aplikasi Pembelajaran Unggah Ungguh Bahasa Jawa Berbasis Mobile', 0, 67, 18, 4),
(64, 'Pembuatan Website Forum Fotografi Berbasis Geolocation', 0, 45, 6, 2),
(65, 'Pembuatan E-Marketplace dengan Sistem Penjualan Lelang Terbuka', 0, 43, 6, 24),
(66, 'Pembuatan Aplikasi Interaktif Untuk Memvisualisasikan keyboard Mekanikal', 0, 59, 18, 3),
(67, 'Pembuatan Computer Vision System Untuk Pengukuran Volume dan Massa Telur Menggunakan Metode Cakram', 0, 59, 6, 4),
(68, 'Pembuatan Aplikasi Vector Drawing Berbasis HTML5', 0, 59, 6, 3),
(69, 'Pembuatan Game Dam-Dam-an Dengan Metode Alpha-Beta Pruning', 0, 63, 7, 18),
(70, 'Pembuatan Sistem Informasi Manajemen Surat Dan Dokumen di PT \"X\" Berbasis Web Dengan Pengecekan Tanda Tangan', 0, 46, 3, 2),
(71, 'Pembuatan Sistem Informasi Toko Multicabang \"A\"', 0, 43, 6, 24),
(72, 'Pembuatan Sistem Informasi Penjualan Dan Pembelian Untuk Distributor Peralatan Listrik \"X\" Berbasis Android', 0, 43, 6, 24),
(73, 'Pembuatan Sistem Informasi Penjadwalan Ibadah dan Bimbingan Konseling Berbasis Web pada Gereja \"X\"', 0, 61, 6, 2),
(74, 'Pembuatan Aplikasi Secured Chatting Berbasis Web', 0, 75, 3, 2),
(75, 'Pembuatan Sistem Informasi Surat Menyurat Dan Arsip Berbasis Web Pada Diskominfo Kota Tarakan', 0, 43, 6, 2),
(76, 'Pembuatan Sistem Informasi Pariwisata di Trenggalek dan Pencarian Jalur Terpendek Menggunakan Algoritma A- Star', 1, 45, 31, 2),
(77, 'Pembuatan Sistem Informasi Pemasaran dan Penjualan Apartemen Taman Sari Berbasis Web', 1, 43, 24, 2),
(78, 'Pembuatan Platform Uji Psikologi pada Situational Judgement Test (SJTs)', 1, 9, 6, 2),
(79, 'Pembuatan Sistem Informasi Terintegrasi Layanan Servis pada Bengkel Mobil Perorangan', 1, 43, 24, 2),
(80, 'Pembuatan Sistem Informasi Dosen Wali Jurusan Teknik Informatika Universitas Surabaya', 1, 43, 24, 2),
(81, 'Pembuatan Sistem Informasi Akademik Sekolah SMA Negeri 1 Tarakan', 1, 46, 24, 2),
(82, 'Aplikasi Buku Penghubung Untuk Siswa Sekolah Dasar Garam Terang Nusantara', 1, 43, 23, 5),
(83, 'Pembuatan Aplikasi Android Untuk Navigasi Dalam Ruangan Dengan Menggunakan Motion Sensor dan Accelerometer', 1, 19, 4, 18),
(84, 'Pembuatan Multiplayer Online Battle Arena Untuk Pengenalan Tokoh - Tokoh Pewayangan', 1, 15, 10, 18),
(85, 'Pembuatan Sistem Informasi Portal Pembelajaran Siswa Dengan Notifikasi Secara Berkala Menggunakan Metodologi Pendekatan Scrum', 1, 8, 18, 2),
(86, 'Pembuatan Sistem Cerdas Untuk Pendaftaran dan Penentuan Nomor Urut Pada Acara Pacuan Kuda Kabupaten Sumba Timur Berbasis Web', 1, 44, 26, 2),
(87, 'Pembuatan Website Untuk Sistem Media Survei Sampel dan Poling', 1, 43, 18, 2),
(88, 'Pembuatan Aplikasi E-Curhat Berbasis Android Untuk DP5A Kota Surabaya', 1, 43, 27, 4),
(89, 'Pembuatan Sistem Informasi Manajemen Proyek Pembangunan Pada Perumahan \"X\"', 1, 46, 27, 3),
(90, 'Pembuatan Sistem Informasi Penjualan dan Pembelian PT. RBF Sekawan Supply', 1, 43, 24, 2),
(91, 'Pembuatan Software Informasi Penilaian Safety Riding Untuk PT. Mitra Pinasthika Mulia (MPM)', 1, 43, 27, 2),
(92, 'Pembuatan Aplikasi Penyewaan Mainan Berbasis Android', 1, 43, 24, 4),
(93, 'Pembuatan Aplikasi Monitoring Pertumbuhan Bayi Berbasis Android', 1, 44, 24, 4),
(94, 'Pembuatan Aplikasi E-Catering Berbasis Mobile', 1, 43, 24, 4),
(95, 'Pembuatan Aplikasi Pengelola Finansial Keluarga Berbasis Android', 1, 43, 24, 4),
(96, 'Pembuatan Sistem Informasi Penjualan Rumah Bersubsidi untuk Developer Perumahan \"X\" Berbasis Website', 1, 43, 24, 2),
(97, 'Pembuatan Aplikasi Marketplace Untuk Kampus Berbasis Android', 1, 43, 24, 4),
(98, 'Sistem Pemesanan dan Pemasaran Travel di Pulau Lombok Berbasis Website', 1, 43, 24, 2),
(99, 'Pembuatan Sistem Informasi Penjualan Pembelian Sarang Walet dan Perlengkapan Walet Berbasis Web', 1, 43, 24, 2),
(100, 'Pembuatan Aplikasi Online Berbasis Web Kursus Mengemudi Mobil \"X\"', 1, 43, 24, 3),
(101, 'Pembuatan Sistem Manajemen Proyek Pembangunan Rumah PT. Gemilang Tata Graha', 1, 46, 27, 3),
(102, 'Pengembangan Sistem Informasi Akademik Berbasis Website pada Lembaga Kursus Al-Falah Surabaya', 1, 43, 24, 2),
(103, 'Pembuatan Sistem Informasi Penjualan Barang dan Jasa Perakitan Pada Toko Penjualan Ban dan Pelek', 1, 43, 24, 2),
(104, 'Pembuatan Sistem Informasi Akademik pada TK Dwi Matra Surabaya', 1, 46, 24, 2),
(105, 'Pembuatan Sistem Informasi Pengelolaan Proyek', 1, 46, 27, 3),
(106, 'Pembuatan Sistem Informasi E-Bengkel Berbasis Web', 1, 43, 24, 2),
(107, 'Pembuatan Sistem Informasi Akuntansi Multi Cabang Berbasis Web pada UD. X', 1, 42, 25, 2),
(108, 'Pembuatan Sistem Akuntansi pada PT. Hastex Berbasis Web', 1, 42, 24, 2),
(109, 'Pembuatan Aplikasi Marketplace Penjualan Tiket Event Pada Universitas Surabaya Berbasis Mobile', 1, 43, 24, 4),
(110, 'Pembuatan Website Manajemen Turnamen Esport Dota 2', 1, 46, 24, 2),
(111, 'Pembuatan Sistem Informasi Pengurusan Izin Mendirikan Bangunan', 1, 43, 24, 6),
(112, 'Pembuatan Whiteboard Digital dengan Socket.IO dan Redis', 1, 15, 6, 18),
(113, 'Pembuatan Sistem Informasi Jasa Catering CV. Aditya Bersama', 1, 43, 24, 3),
(114, 'Pembuatan M-Church Gereja Bethel Tabernakel Kristus Raja Damai', 1, 43, 24, 5),
(115, 'Pembuatan Sistem Informasi Penjualan, Pembelian dan Persediaan Berbasis Web pada Perusahaan Fudlesocks', 1, 43, 24, 2),
(116, 'Pengembangan Sistem Informasi Akademik Politeknik Ubaya', 1, 43, 24, 2),
(117, 'Pembuatan Sistem Informasi Pada Toko Listrik \"X\"', 1, 43, 24, 2),
(118, 'Pembuatan Website Manajemen Kejuaraan Futsal', 1, 46, 24, 2),
(119, 'Pembuatan Sistem Informasi Jual Beli di Toko Sinar Agung', 1, 43, 24, 2),
(120, 'Pembuatan Sistem Surat Tugas Online untuk Penugasan Mahasiswa Universitas Surabaya untuk Kegiatan Akademik dan Non Akademik', 1, 27, 24, 3),
(121, 'Pembuatan Sistem Informasi Penjualan Dan Pembelian Bunga Anggrek Di Desa Selotapak Kecamatan Trawas Mojokerto', 1, 43, 24, 2),
(122, 'Pembuatan Sistem Informasi Pelatihan Olahraga Berbasis Web', 1, 27, 24, 2),
(123, 'Pembuatan Web App Perwalian Fakultas Teknik Universitas Surabaya', 1, 27, 24, 5),
(124, 'Pembuatan Aplikasi Untuk Komunitas Mini 4WD', 1, 27, 24, 5),
(125, 'Pembuatan Sistem Informasi Perpustakaan Umum Kota Mojokerto', 1, 27, 24, 2),
(126, 'Pembuatan Sistem Informasi Akuntansi Penjualan dan Perakitan pada Toko Komputer \"X\" Berbasis Web', 1, 42, 24, 2),
(127, 'Pembuatan Sitem Informasi Pada Hotel \"X\"', 1, 43, 24, 3),
(128, 'Pembuatan Sistem Informasi Pembelian, Penjualan dan Produksi Mebel pada Toko \"X\"', 1, 43, 24, 2),
(129, 'Pembuatan Sistem Informasi Terpadu Komunitas Sahabat Kereta Api Surabaya', 1, 27, 24, 2),
(130, 'Pengembangan Program Performance Appraisal Untuk Karyawan Non Dosen Universitas Surabaya', 1, 44, 24, 2),
(131, 'Pembuatan Aplikasi Informasi Lapangan Olahraga Berbasis Android', 1, 27, 24, 4),
(132, 'Pembuatan Aplikasi Pembelian dan Penjualan Bahan-Bahan Bangunan Berbasis Android', 1, 43, 24, 4),
(133, 'Pembuatan Sistem Pengecekan Kelulusan Mahasiswa Berbasis Web di Fakultas Teknik Universitas Surabaya', 1, 44, 24, 2),
(134, 'Pembuatan Sistem Informasi Vila dan Restoran \"Ombak Putih Bungalows\" Berbasis Web', 1, 43, 24, 2),
(135, 'Pembuatan Sistem Informasi Inventory Direktorat Marketing and Public Relations Universitas Surabaya', 1, 46, 24, 2),
(136, 'Sistem Informasi Layanan Pencarian Pasangan Hidup Menurut Hukum Islam', 1, 27, 24, 2),
(137, 'Pembuatan Sistem Informasi Rental Mobil Eldaa Jaya', 1, 43, 24, 2),
(138, 'Pembuatan Sistem Informasi Akuntansi Berbasis Web Peralatan Dan Bahan-Bahan Kesehatan Gigi UD \"X\"', 1, 42, 24, 2),
(139, 'Pembuatan Sistem Informasi Lowongan Pekerjaan Berbasis Website Dengan Fitur Queueing', 1, 43, 33, 2),
(140, 'Pembuatan Game Multiplayer \"Puzzle Brain\" Berbasis Android', 1, 7, 14, 4),
(141, 'Pembuatan Sistem Informasi E-Surat Berbasis Web dan Mobile Dengan Menggunakan Phonegap Pada Fakultas Teknik Universitas Surabaya.', 1, 46, 24, 5),
(142, 'Pembuatan Sistem Aplikasi Penjualan Makanan Berbasis Web Pada Kantin Universitas Surabaya', 1, 43, 24, 2),
(143, 'Pembuatan Game Nonogram Multiplayer', 1, 15, 7, 14),
(144, 'Pembuatan Aplikasi Kuliah Online Secara Real Time Berbasis Web Dengan WebRTC', 1, 15, 6, 1),
(145, 'Komparasi Pemrograman Native Vs Cross Platform Dengan Studi Kasus Aplikasi Jual Beli', 1, 9, 5, 4),
(146, 'Pembuatan Sistem Informasi Penjualan dan Pembelian di Toko Disc \"X\"', 1, 43, 24, 2),
(147, 'Pembuatan Aplikasi GO-MOTOR', 1, 43, 24, 4),
(148, 'Pembuatan Game Digital Crime Village Online', 1, 15, 7, 18),
(149, 'Pembuatan Sistem Untuk Membantu Event Organizer Melaksanakan Wedding Event', 1, 46, 24, 3),
(150, 'Pembuatan Aplikasi \"Sharecipe\" Berbasis Android', 1, 27, 24, 4),
(151, 'Pembuatan Aplikasi Smart Patria untuk Organisasi Patria (Pemuda Theravadha Indonesia) Berbasis Android', 1, 27, 24, 4),
(152, 'Sistem Manajemen Penyimpanan dokumen', 1, 46, 24, 2),
(153, 'Pembuatan Aplikasi Music Grid Instrument', 1, 7, 6, 4),
(154, 'Pembuatan Media Informasi Sanggar Tari', 1, 44, 24, 2),
(155, 'Pembuatan Aplikasi Laundry \"X\" Berbasis Android', 1, 27, 24, 4),
(156, 'Pembuatan Sistem Informasi Administrasi Kegiatan Organisasi Mahasiswa Universitas Surabaya', 1, 46, 24, 3),
(157, 'Pembuatan Multiplayer Game Unblock Parking', 1, 15, 7, 14),
(158, 'Pembuatan Aplikasi Book Store untuk Android', 1, 27, 24, 4),
(159, 'Pembuatan Aplikasi Sistem Informasi Paket Modifikasi Motor dan Penjualan Sparepart Motor Racing', 1, 43, 24, 3),
(160, 'Pembuatan Sistem Informasi Penjualan, Pembelian dan Persewaan Barang di Toko \"X\"', 1, 43, 24, 3),
(161, 'Pembuatan Aplikasi Zaris (Zakat Mawaris) Berbasis Android', 1, 27, 24, 4),
(162, 'Pembuatan Website Penyewaan Prasarana Olahraga Berbasis Lapangan', 1, 43, 24, 2),
(163, 'Pembuatan Sistem Informasi Administrasi Ubaya Language Center', 1, 46, 24, 3),
(164, 'Marketplace Pendukung Bisnis Fotografi', 1, 43, 24, 3),
(165, 'Pembuatan Aplikasi Manajeman Keuangan untuk Pemasukan dan Pengeluaran Bulanan', 1, 46, 24, 3),
(166, 'Pembuatan Aplikasi Penilaian Non Akademik Mahasiswa di Stikes Yayasan RS DR. Soetomo Surabaya', 1, 9, 6, 2),
(167, 'Pembuatan Sistem Manajemen Dokumen Dinas Cipta Karya Berbasis Web', 1, 46, 24, 2),
(168, 'Pembuatan Sistem Informasi Kantor Notaris Juni Sulistyawati, S.H., M.Kn.', 1, 43, 24, 1),
(169, 'Pembuatan Aplikasi Virtual Reality untuk Pembelajaran Fisika Gerak Parabola', 2, 19, 34, 18),
(170, 'Penggunaan Kamera Virtual Adaptif Untuk Game Platformer', 2, 7, 66, 18),
(171, 'Integrasi Sistem Informasi Jual Beli Perusahaan Dagang Dengan Website E-Commerce Woocommerce', 2, 8, 43, 3),
(172, 'Pembuatan Configurable Enterprise System Untuk Pembelian Penjualan', 2, 8, 43, 6),
(173, 'Pembuatan Configurable Enterprise System Untuk Transaksi Pembayaran dan Retur Penjualan dan Pembelian', 2, 8, 43, 6),
(174, 'Pembuatan Configurable Enterprise Information System untuk Penggajian \n Kelulusan', 2, 8, 43, 6),
(175, 'Pembuatan Configurable Enterprise System Untuk Customer Relationship Management Pada Perusahaan Retail', 2, 8, 46, 6),
(176, 'Pembuatan Configurable Enterprise System Untuk Inventory Barang', 2, 8, 46, 6),
(177, 'Pembuatan Configurable Enterprise System Pelaporan Keuangan Perusahaan Dengan Rasio Solvabilitas dan Profitabilitas', 2, 8, 46, 6),
(178, 'Pembuatan Game Tower Offense \"10 November Battle\"', 2, 7, 66, 18),
(179, 'Pembuatan Configurable Enterprise System untuk Pelaporan Keuangan Dengan Ratio Keuangan Likuiditas', 2, 8, 46, 6),
(180, 'Pembuatan Configurable Enterprise System Untuk Jasa Persewaan', 2, 8, 43, 3),
(181, 'Pembuatan Configurable Enterprise System untuk Management Aset', 2, 8, 46, 3),
(182, 'Pembuatan Configurable System untuk Apotek', 2, 8, 43, 3),
(183, 'Pembuatan Mobile Game Virtual Pet Online', 2, 10, 66, 18),
(184, 'Pembuatan Aplikasi Astronomi Mengenai Sistem Tata Surya Dalam Galaksi Bimasakti Dengan Menggunakan Virtual Reality', 2, 19, 34, 18),
(185, 'Pembuatan Permainan \"Link Colour\" Berbasis Android', 2, 10, 66, 18),
(186, 'Pembuatan Game Simulasi First Person \"Cat 88\"', 2, 7, 55, 18),
(187, 'Pembuatan Aplikasi Permainan Bowling Berbasis Android', 2, 10, 66, 18),
(188, 'Implementasi Augmented Reality pada Materi Sistem Gerak Pasif pada Manusia.', 2, 19, 34, 18),
(189, 'Pembuatan Sistem Pengambilan Keputusan Penjualan Kendaraan Kredit Dengan Metode Weighted Product', 3, 41, 38, 3),
(190, 'Pembuatan Aplikasi Pendidikan Bahasa Inggris Grammer Tingkat Dasar Dengan Teknik Gamification', 3, 67, 66, 4),
(191, 'Pembuatan Aplikasi Mobile Supply chain management (SCM) untuk UMKM Toko Kelontong', 3, 42, 43, 4),
(192, 'Pembuatan Sistem Informasi Kependudukan Kantor Kepala Desa Tunggunjagir Berbasis Website', 3, 43, 46, 2),
(193, 'Sistem Informasi Produksi dengan Metode Exponetial Smoothing untuk Peramalan Produksi Toko Kue Family Multi Cabang', 3, 55, 49, 6),
(194, 'Pembuatan Sistem Penilaian Kinerja Karyawan dengan Metode Point Factor System', 3, 61, 43, 2),
(195, 'Pembuatan Aplikasi Sistem Penunjang Keputusan Pemilihan Sekolah Dasar Swasta di Surabaya', 3, 41, 49, 5),
(196, 'Pembuatan Sistem Informasi Pengelolaan Keuangan Daerah Kota Manado Berbasis Website', 3, 43, 46, 2),
(197, 'Pembuatan Sistem Peminjaman Lapangan Olahraga Berbasis Web', 3, 45, 46, 3),
(198, 'Pembuatan Website E-Commerce sebagai Media Penjualan Kosmetik dengan Rekomendasi Pemilihan Supplier Menggunakan Metode AHP, TOPSIS dan AHP TOPSIS', 3, 39, 43, 2),
(199, 'Pembuatan Purwarupa Home Automation System Berbasis Internet of Things Menggunakan Protokol Message Queuing Telemetry Transport', 3, 71, 72, 4),
(200, 'Pembuatan Sistem Berbasis Web untuk Koreksi Jawaban Essay Peserta Didik dengan Association Rules', 3, 39, 38, 2),
(201, 'Pembuatan Aplikasi Rekomendasi Pemilihan Kamar Kost', 3, 61, 45, 4),
(202, 'Pembuatan Sistem Remunerasi Dari Pasien BPJS RSUD Blambangan Berbasis Web', 3, 43, 46, 2),
(203, 'Aplikasi Jasa Bangunan Berbasis Android', 3, 46, 38, 4),
(204, 'Pembuatan Aplikasi Pencarian Salon dengan Metode Weighted Sum Method (WSM)', 3, 41, 38, 4),
(205, 'Pengembangan Fitur Testimoni yang Valid pada Marketplace', 3, 39, 61, 2),
(206, 'Pembuatan Aplikasi Manajemen Master Plan E-Government', 3, 43, 61, 6),
(207, 'Pembuatan Sistem Informasi dan Pengambilan Keputusan Pinjaman pada Koperasi Simpan Pinjam Purnawirawan Angkatan Laut (Kosipral) Surabaya dengan Metode AHP', 3, 41, 61, 6),
(208, 'Pengukuran Properti Fisis Daun Menggunakan Smartphone Android', 3, 60, 59, 4),
(209, 'Pembuatan Aplikasi Pembelajaran Statistika Deskripsi Dengan Penerapan Model Pembelajaran Mobile Learning', 3, 67, 32, 4),
(210, 'Pembuatan Aplikasi Pencarian Pekerjaan yang dapat memonitor Proses Lamaran Kerja Berbasis Android', 3, 46, 38, 2),
(211, 'Pembuatan Chatbot untuk Memberi Informasi Tentang Program Information Technology Dual Degree pada Jurusan Teknik Informatika Universitas Surabaya', 3, 56, 53, 2),
(212, 'Meeting Assitant System Berbasis Teknologi Speech-To-Text', 3, 56, 53, 4),
(213, 'Perancangan Sistem Presensi dengan Metode Pengenalan Wajah Secara Real Time Menggunakan Ekstraksi Fitur DTC dan LPC pada Tangkapan Obyek Single Camera', 3, 56, 54, 4),
(214, 'Implementasi Aplikasi Prediksi Pergerakan Saham dengan Metode Deep Learning', 3, 62, 54, 5),
(215, 'Sistem Manajemen Aktivitas dengan Penyesuaian Prioritas Secara Otomatis Menggunakan Metode SMART', 3, 46, 38, 2),
(216, 'Sistem Student Relationship Management Berbasis CRM Untuk Mahasiswa Universitas Surabaya', 3, 61, 46, 6),
(217, 'Pembuatan Aplikasi Untuk Menganalisis dan Menyelesaikan Soal Uji Hipotesis Rata - Rata Satu Populasi Dengan Metode Named-Entity Recognition', 3, 56, 53, 4),
(218, 'Aplikasi Text Mining Untuk Menghasilkan Pertanyaan Berdasarkan Bacaan di Alkitab Secara Otomatis', 3, 56, 38, 4),
(219, 'Sistem Monitoring Hasil Belajar Dan Konsultasi Mahasiswa Aktif Jurusan Teknik Informatika Universitas Surabaya', 3, 46, 43, 2),
(220, 'Pembuatan Aplikasi Rekomendasi Perencanaan Pengambilan Mata Kuliah Menggunakan Metode Weighted Sum Model', 3, 41, 39, 4),
(221, 'Pembuatan Aplikasi Berdasarkan Rekomendasi kado Berdasarkan Kepribadian seseorang dengan Menggunakan Fuzzy Logic', 3, 58, 39, 4),
(222, 'Pembuatan Sistem Presensi Kelas Online Menggunakan Face Recognition Berbasis Web', 3, 59, 54, 4),
(223, 'Pembuatan Sistem Perencanaan Keuangan Sebagai Sarana Meningkatkan Literasi Keuangan', 3, 44, 38, 6),
(224, 'Pembuatan Sistem Pendaftaran dan Pembayaran Ubaya Global Academy', 3, 43, 44, 2),
(225, 'Aplikasi Mobile Pengenalan Huruf Hiragana Menggunakan Convolutional Neural Network Untuk Pembelajaran', 3, 59, 54, 4),
(226, 'Pengembangan Sistem Informasi Manajemen Rantai Pasok Barang Bekas dan Perencanaan Keuangan pada UD Dua Saudara', 3, 42, 46, 24),
(227, 'Pengembangan Sistem Kursus Online Interaktif Berbasis Learning Management System', 3, 43, 46, 3),
(228, 'Pembuatan Smart Assistant System Untuk Event Organizer', 3, 41, 53, 4),
(229, 'Pembuatan Aplikasi Presensi dan Pemantauan Tamu Undangan Berbasis Teknologi Beacon', 3, 71, 72, 4),
(230, 'Pembuatan Aplikasi Visualisasi Path Loss Propagation Model Dengan Ray Tracing Berbasis HTML5', 3, 59, 53, 1),
(231, 'Sistem Informasi Pengelolaan Ruangan Berbasis Smart Room Pada universitas Surabaya', 3, 71, 72, 6),
(232, 'Pembuatan Website Administrasi Pendaftaran Online Untuk Pasien Rawat Jalan Pada Rumah Sakit Umum Daerah Dr.R. Soedarsono Pasuruan', 3, 43, 44, 2),
(233, 'Pembuatan Aplikasi Mobile e-RTRW', 3, 44, 43, 4),
(234, 'Pembuatan Aplikasi Simulasi Untuk Pembelajaran Logika Fuzzy', 3, 58, 55, 18),
(235, 'Pembuatan Sistem Informasi Penjualan Pembelian Dengan Peramalan Permintaan Barang Pada Toko Retail \"X\" Menggunakan Metode Decomposisi Cencus II', 3, 43, 49, 24),
(236, 'Pembuatan Sistem Informasi Administrasi pada Peternakan Ayam Broiler PT. Anugerah Kartika Agro Blitar', 3, 43, 44, 2),
(237, 'Pembuatan Game Bubble Shoot Pasangan Unsur Kimia Untuk SMA', 3, 67, 66, 18),
(238, 'Pembuatan Sistem Informasi Administrasi Dokumen Kredit di Bank \"X\"', 3, 43, 44, 2),
(239, 'Sistem Informasi Manajemen Kepanitiaan Kegiatan Pada Jurusan Teknik Informatika Ubaya', 3, 43, 46, 3),
(240, 'Pembuatan Aplikasi Sistem Akuaponik Berbasis Internet Of Things', 3, 71, 72, 4),
(241, 'Kamera Virtual Otomatis Untuk Visualisasi Kampus Dengan Pathfinding dan Behavior Tree', 3, 63, 31, 18),
(242, 'Pembuatan Aplikasi MakComblang Berbasis Android', 3, 39, 38, 4),
(243, 'Simulasi Jaringan Syaraf Tiruan Untuk Pembelajaran Jaringan Syaraf Tiruan di Jurusan Teknik Informatika Ubaya', 3, 59, 55, 18),
(244, 'Pembuatan Mobile Controlling System Pada Instansi Pemerintah Kota Surabaya', 3, 46, 61, 5),
(245, 'Pembuatan Sistem Informasi Manajemen Akademic Advisor Pada Fakultas Teknik Universitas Surabaya Dengan Pendekatan knowledge Based Management', 3, 61, 46, 2),
(246, 'Pembuatan Website Berbahasa Indonesia untuk Pencarian Resep Masakan dengan Metode Cosine Similarity', 3, 41, 62, 1),
(247, 'Pembuatan Sistem Informasi Posyandu di Kecamatan \"X\" Berbasis Web', 3, 43, 46, 3),
(248, 'Pembuatan SIstem Informasi Akuntansi Berbasis Website Perusahaan CV. Cipta Jujur Kreasi dengan Perhitungan HPP secara Average dan Depresiasi Aset', 3, 43, 46, 2),
(249, 'Pembuatan Sistem Informasi Produksi Berbasis Website dengan Studi Kasus pada Perusahaan Garmen dan Perusahaan Karpet', 3, 42, 43, 2),
(250, 'Pembuatan Aplikasi Perhitungan Pembagian Pendapatan Pada Transaksi Penjualan Properti Berbasis Website', 3, 61, 43, 2),
(251, 'Pembuatan Sistem Informasi Pengadaan Suku Cadang Berbasis Website pada PT. Bali Age', 3, 42, 43, 2),
(252, 'Pengembangan Sistem E-Supervision Pada Pemerintah Kota Surabaya', 3, 61, 46, 2),
(253, 'Pengembangan Sistem Informasi Pengelolaan Kegiatan Masjid Al-Falah Surabaya', 3, 43, 46, 3),
(254, 'Pembuatan Sistem Informasi Manajemen Populasi Satwa dalam Penangkaran di Jawa Timur', 3, 46, 43, 3),
(255, 'Pembuatan Aplikasi Pembelajaran Integral Tak Tentu', 3, 67, 30, 3),
(256, 'Pembuatan Sistem Penjualan Pembelian Pada UMKM Kerupuk Sidoarjo Berbasis Cloud Computing', 3, 50, 43, 6),
(257, 'Smart Modif Motor menggunakan Metode Analitycal Hierarchy Process', 3, 41, 49, 6),
(258, 'Pembuatan Sistem Informasi Supply Management Barang Pada Koperasi BRI Wilayah Madura Berbasis Website', 3, 42, 43, 2),
(259, 'Pembuatan Aplikasi Cryptosystem untuk Pengamanan File di Cloud Storage Berbasis Android', 3, 76, 50, 4),
(260, 'Pembuatan Website Sistem Rekomendasi Rute Perjalanan Wisata Untuk Destinasi Wisatawan Nusantara Di Eks-Karisidenan Madiun', 3, 41, 38, 2),
(261, 'Pembuatan Sistem Penjajaran Sepasang DNA Dengan Metode Needleman Wunsch dan Smith Waterman Untuk Mengetahui Derajat Kemiripan Untuk Sauropus Androgynus', 3, 59, 60, 6),
(262, 'Pembuatan Aplikasi Pencarian Coffee Shop di Surabaya Berbasis Web', 3, 41, 38, 1),
(263, 'Pembuatan Aplikasi Peramalan Jumlah Permintaan Sepatu pada PT \"X\" dengan Metode Dekomposisi', 3, 62, 49, 3),
(264, 'Pembuatan Aplikasi Mobile Pencarian Promo Kartu Kredit', 3, 41, 38, 4),
(265, 'Pembuatan Aplikasi Pengenalan Wajah Dengan Metode Principal Component Analysis Dalam Implementasi Sistem Presensi', 3, 59, 40, 4),
(266, 'Sistem Inspeksi Kualitas Visual Tomat Berdasarkan Ukuran dan Warna Menggunakan Jaringan Syaraf', 3, 59, 54, 3),
(267, 'Pembuatan Expert Advisor Trader Forex Dengan Algoritma Fibonacci', 3, 41, 49, 6),
(268, 'Pembuatan Web Pelayanan Pertanahan Khusus Pendaftaran Tanah Perorangan di Badan Pertanahan Nasional Kabupaten Sidoarjo', 3, 43, 44, 2),
(269, 'Pembuatan Sistem Pencarian Jasa Event Organizer Berbasis Website', 3, 41, 38, 2),
(270, 'Pembuatan Aplikasi Government Management Resource System Pada Pemerintah Kota Surabaya Berbasis Web Service', 3, 46, 61, 1),
(271, 'Pembuatan Sistem Pakar Dalam Menilai Mobil Bekas Menggunakan Fuzzy Logic', 3, 41, 58, 3),
(272, 'Pembuatan Sistem Informasi Pembelian, Produksi dan Penjualan Pabrik Tahu \"X\"', 3, 43, 61, 3),
(273, 'Pembuatan Media Pembelajaran Fisika Interaktif Pada Materi Kinematika Gerak Berbasis Web', 3, 67, 34, 3),
(274, 'Pembuatan Sistem Rekomendasi Dan Penjualan Paket Wisata di \"X\" Tour And Travel', 3, 41, 38, 6),
(275, 'Optimasi Kapasitas Transportasi Pendistribusian Barang Pada Toko Antara Jaya Dengan Metode Greedy', 4, 58, 49, 53),
(276, 'Pembuatan Sistem Pendukung Keputusan Pembelian Smartphone Android dengan Metode Simple Additive Weighting (SAW) dengan Mempertimbangkan Depresiasi Harga', 4, 41, 39, 49),
(277, 'Sistem Penunjang Keputusan Produk Kecantikan Dengan Metode Electre', 4, 41, 39, 49),
(278, 'Pembuatan Sistem Automatic Text Summarization pada Artikel Dengan Metode Latent Semantic Analysis', 4, 56, 53, 38),
(279, 'Aplikasi Pengenalan 20 Huruf Hanacaraka Menggunakan Metode Backpropagation untuk Siswa Kelas 3 Sekolah Dasar', 4, 67, 63, 54),
(280, 'Menentukan Preferensi Bahan Pustaka pada Pengadaan Koleksi di Perpustakaan dengan Frequent Pattern Growth (FP-Growth)', 4, 39, 41, 38),
(281, 'Aplikasi Rekomendasi Penempatan Barang Departemen Berdasarkan Pola Konsumsi Pelanggan menggunakan Frequent Pattern Growth di Departemen Store Plaza Batu', 4, 61, 39, 38),
(282, 'Automatic Text Summarization Berdasarkan Pendekatan Statistika pada Dokumen Berbahasa Indonesia', 4, 35, 39, 53),
(283, 'Pembuatan Aplikasi Rekomendasi Perencanaan Jadwal Kuliah Bagi Mahasiswa menggunakan Kombinasi Metode Depth First Search (DFS) dan Simple Multi Attribute Rating Technique (Smart)', 4, 39, 41, 53),
(284, 'Klasifikasi Tingkatan Bencana Alam Pada Suatu Daerah Berdasarkan Postingan di Media Sosial Dengan Metode K-Nearest Neighbor', 4, 62, 39, 54),
(285, 'Pembuatan Sistem Klasifikasi Pelamar Untuk Perusahaan Production Hous', 4, 62, 41, 54),
(286, 'Prediksi Kebutuhan Logistik Pada Korban Bencana Alam Dengan Metode Regresi linear', 4, 35, 49, 38),
(287, 'Analisis Sentimen Untuk Identifikasi Bantuan Pada Korban Bencana Alam di Indonesia Dengan Metode K-Means dan Naive Bayes', 4, 39, 62, 38),
(288, 'Sistem Perancangan Formasi Penyanyi Paduan Suara Universitas Surabaya Saat Tampil', 4, 41, 53, 49),
(289, 'Pembuatan Sistem Penjadwalan Shift dan Tugas Karyawan pada Swalayan \"Delta Mart\"', 4, 61, 58, 49),
(290, 'Pembuatan Sistem Pemesanan Persediaan Barang Pada PT. Media Bersama Sukses Dengan Moving Average dan Deterministic Order Quantity', 4, 61, 43, 32),
(291, 'Penentuan Pembimbing Tugas Akhir Bagi Mahasiswa Jurusan Teknik Informatika Universitas Surabaya Dengan Metode Dice Coeffiicient', 4, 39, 41, 53),
(292, 'Sistem Pendeteksi Konten Negatif di Twitter Menggunakan Metode K-Nearest Neighbor', 4, 39, 54, 38),
(293, 'Implementasi Algoritma Nearest Neighbour Untuk Penentuan Hukuman Maksimal Terhadap Pelanggaran Undang - Undang ITE di Facebook', 4, 35, 68, 54),
(294, 'Pembuatan Sistem Penjadwalan Mata Kuliah Jurusan Teknik Informatika Universitas Surabaya Dengan Menggunakan Algoritma Genetika', 4, 57, 58, 26),
(295, 'Pengembangan Customer Relationship Management Sistem Rekomendasi Pada Sistem Butik Online', 4, 61, 41, 38),
(296, 'Analisis Sentimen terhadap Ulasan Film Menggunakan Metode Naive Bayes Classifier', 4, 56, 32, 54),
(297, 'Pembuatan Aplikasi Simulasi Kesetimbangan dan Dinamika Rotasi Benda 3D Primitives', 4, 59, 55, 34),
(298, 'Pembuatan Aplikasi Perencanaan Rute Distribusi Barang Pada Distribution Center PT \"XYZ\" Cabang Jakarta Dengan Konsep Vehicle Routing Problem Berbasis Desktop', 4, 61, 45, 53),
(299, 'Pembuatan Sistem Informasi Pencarian Lokasi Praktik Dokter dan Apotek di Wilayah Rungkut dengan Metode Indexing', 4, 45, 43, 38),
(300, 'Sistem Penunjang Keputusan Pemilihan Kendaraan Mobil dan Sepeda Motor Menggunakan Metode K-Nearest Neighbor', 4, 41, 38, 32),
(301, 'Pembuatan Sistem Visi Komputer Untuk Memprediksi Volume Dan Penentuan Grade Telur Berdasarkan Ukuran Dengan Metode Jaringan Syaraf Tiruan Backpropagation', 4, 59, 58, 53),
(302, 'Penggunaan Algoritma Genetika untuk Sistem Penjadwalan Ujian Tugas Akhir Jurusan Teknik Informatika Universitas Surabaya', 4, 57, 58, 26);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `course_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `encoding_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `encoding_value`) VALUES
('1600C104', 'Mathematics', 30),
('1600C106', 'Aljabar Linier', 33),
('1604C014', 'Discrete Mathematics', 31),
('1604C023', 'Statistics', 32),
('1604C024', 'Human Computer Interaction', 18),
('1604C031', 'Data Structure', 26),
('1604C032', 'Computer Network', 13),
('1604C033', 'Database', 23),
('1604C034', 'Software Engineering', 6),
('1604C042', 'AI Fundamental', 53),
('1604C043', 'Web Programming', 1),
('1604C044', 'Distributed Programming', 14),
('1604C045', 'Information Security and Assurance', 75),
('1604C051', 'Full-Stack Programming', 3),
('1604C052', 'Native Mobile Programming', 4),
('1604C054', 'Hybrid Mobile Programming', 5),
('1604C055', 'Machine Learning', 54),
('1604C056', 'Physically Based Animation', 34),
('1604C063', 'Web Framework Programming', 2),
('1604C131', 'Management Information Systems', 46),
('1604C141', 'Applied Database', 24),
('1604C151', 'Database Management', 27),
('1604C161', 'Supply Chain Management Accounting System', 42),
('1604C162', 'Enterprise System Implementation', 43),
('1604C19D', 'Business Intelligence & Data Analytics', 61),
('1604C19E', 'Business Geography', 45),
('1604C19F', 'Enterprise Software Design Pattern', 8),
('1604C19G', 'IT for Knowledge Management', 44),
('1604C19I', 'Distributed Database', 25),
('1604C251', 'Game Programming', 7),
('1604C261', 'Mixed Reality', 19),
('1604C262', 'Mobile Game Programming', 10),
('1604C29A', 'Educational Games', 67),
('1604C29E', 'Immersive Computing', 20),
('1604C331', 'Data Mining', 38),
('1604C341', 'Applied Multivariate Analysis', 35),
('1604C351', 'Digital Image Processing', 60),
('1604C361', 'Operation Research', 49),
('1604C362', 'Intelligent Information Retrieval', 39),
('1604C39A', 'Modeling and Simulation', 55),
('1604C39B', 'Decision Support Systems', 41),
('1604C39C', 'Big Data Analytics', 62),
('1604C39D', 'Artificial Intelligence for Game', 63),
('1604C39E', 'Soft Computing', 58),
('1604C39F', 'Multimedia Information Retrieval', 40),
('1604C39G', 'Computer Vision', 59),
('1604C39J', 'Nature Inspired Optimization', 57),
('1604C39K', 'Natural Language Processing', 56),
('1604C431', 'Internet of Things', 71),
('1604C441', 'Cloud Computing', 50),
('1604C49E', 'Advanced Information Security Systems', 76),
('1604C49F', 'Advanced Computer Network', 15),
('1604C49G', 'Distributed Computing Security Model', 77),
('1604C49H', 'IoT Implementation', 72),
('1604C49I', 'Legal Security and Issues', 68),
('1607C09C', 'System Testing & Implementation', 9),
('1608C051', 'Game Concept and Design', 66);

-- --------------------------------------------------------

--
-- Table structure for table `diskusi_folder`
--

CREATE TABLE `diskusi_folder` (
  `id` int(11) NOT NULL,
  `folder_title` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` datetime NOT NULL,
  `created_by_user_id` int(11) NOT NULL,
  `parent_folder_id` int(11) DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diskusi_folder`
--

INSERT INTO `diskusi_folder` (`id`, `folder_title`, `created`, `created_by_user_id`, `parent_folder_id`, `notes`, `is_deleted`) VALUES
(1, 'Diskusi Bebas', '2024-05-02 07:17:25', 42, NULL, 'Ruang diskusi untuk membahas hal-hal bebas dan bertanggung jawab', 0),
(2, 'Seputar Tugas Akhir DSAI', '2024-05-02 07:18:10', 42, NULL, 'Ruang diskusi untuk membahas seputar tugas akhir pada program DSAI', 0),
(3, 'Topik Machine Learning', '2024-05-07 02:13:08', 42, 2, 'Tes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `emoticon`
--

CREATE TABLE `emoticon` (
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emoticon`
--

INSERT INTO `emoticon` (`code`) VALUES
('😀');

-- --------------------------------------------------------

--
-- Table structure for table `hexad_questions`
--

CREATE TABLE `hexad_questions` (
  `id` int(11) NOT NULL,
  `item` varchar(300) NOT NULL,
  `user_type` enum('socializer','philanthropist','free spirit','disruptor','achiever','players') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hexad_questions`
--

INSERT INTO `hexad_questions` (`id`, `item`, `user_type`) VALUES
(1, 'Berinteraksi dengan orang lain penting bagi saya.', 'socializer'),
(2, 'Saya merasa bahagia jika saya bisa membantu orang lain.', 'philanthropist'),
(3, 'Penting bagi saya untuk mengikuti jalan saya sendiri.', 'free spirit'),
(4, 'Saya suka menjadi bagian dari tim.', 'socializer'),
(5, 'Saya suka memprovokasi.', 'disruptor'),
(6, 'Saya sangat ambisius.', 'achiever'),
(7, 'Saya suka kompetisi di mana hadiah bisa dimenangkan.', 'players'),
(8, 'Penting bagi saya untuk merasa seperti bagian dari komunitas.', 'socializer'),
(9, 'Saya sering membiarkan rasa ingin tahu saya memandu saya.', 'free spirit'),
(10, 'Saya merasa senang mengambil peran sebagai mentor.', 'philanthropist'),
(11, 'Saya suka mempertanyakan status quo.', 'disruptor'),
(12, 'Lebih menyenangkan berada bersama orang lain daripada sendirian.', 'socializer'),
(13, 'Hadiah adalah cara yang bagus untuk memotivasi saya.', 'players'),
(14, 'Saya suka mencoba hal-hal baru.', 'free spirit'),
(15, 'Saya suka mengatasi rintangan.', 'achiever'),
(16, 'Saya memperhatikan kepentingan saya sendiri.', 'players'),
(17, 'Saya suka membantu orang lain untuk menyesuaikan diri di situasi baru.', 'philanthropist'),
(18, 'Saya melihat diri saya sebagai pemberontak.', 'disruptor'),
(19, 'Saya menikmati aktivitas kelompok.', 'socializer'),
(20, 'Penting bagi saya untuk selalu menyelesaikan tugas saya sepenuhnya.', 'achiever'),
(21, 'Saya lebih suka menetapkan tujuan saya sendiri.', 'free spirit'),
(22, 'Saya tidak suka mengikuti aturan.', 'disruptor'),
(23, 'Saya suka berbagi pengetahuan saya.', 'philanthropist'),
(24, 'Sulit bagi saya untuk melepaskan masalah sebelum menemukan solusinya.', 'achiever'),
(25, 'Pengembalian investasi penting bagi saya.', 'players'),
(26, 'Menjadi mandiri penting bagi saya.', 'free spirit'),
(27, 'Saya suka menguasai tugas yang sulit.', 'achiever'),
(28, 'Kesejahteraan orang lain penting bagi saya.', 'philanthropist'),
(29, 'Saya suka mengubah hal-hal dengan tangan saya sendiri.', 'disruptor'),
(30, 'Jika hadiahnya cukup, saya akan berusaha.', 'players');

-- --------------------------------------------------------

--
-- Table structure for table `hexad_questions_answer`
--

CREATE TABLE `hexad_questions_answer` (
  `hexad_questions_id` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hexad_questions_answer`
--

INSERT INTO `hexad_questions_answer` (`hexad_questions_id`, `answer`, `user_id`) VALUES
(1, 2, 1),
(2, 4, 1),
(3, 3, 1),
(4, 5, 1),
(5, 1, 1),
(6, 3, 1),
(7, 2, 1),
(8, 4, 1),
(9, 5, 1),
(10, 7, 1),
(11, 4, 1),
(12, 2, 1),
(13, 6, 1),
(14, 6, 1),
(15, 3, 1),
(16, 6, 1),
(17, 6, 1),
(18, 2, 1),
(19, 3, 1),
(20, 5, 1),
(21, 6, 1),
(22, 2, 1),
(23, 4, 1),
(24, 5, 1),
(25, 5, 1),
(26, 5, 1),
(27, 2, 1),
(28, 2, 1),
(29, 5, 1),
(30, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kesetaraan_course`
--

CREATE TABLE `kesetaraan_course` (
  `kesetaraan_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'kode mata kuliah lama',
  `course_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'kode mk di mk course'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kesetaraan_course`
--

INSERT INTO `kesetaraan_course` (`kesetaraan_id`, `course_id`) VALUES
('1604B043', '1604C043'),
('1604A043', '1604C043'),
('1604B063', '1604C063'),
('1604A053', '1604C063'),
('1604B051', '1604C051'),
('1604B052', '1604C052'),
('1604A061', '1604C052'),
('1604B054', '1604C054'),
('1604A071', '1604C054'),
('1604B034', '1604C034'),
('1604A036', '1604C034'),
('1604A045', '1604C034'),
('1604B251', '1604C251'),
('1604A201', '1604C251'),
('1604B19F', '1604C19F'),
('1607A052', '1607C09C'),
('1607B09B', '1607C09C'),
('1608A402', '1604C262'),
('1604B262', '1604C262'),
('1604A032', '1604C032'),
('1604B032', '1604C032'),
('1604A051', '1604C044'),
('1604B044', '1604C044'),
('1604A402', '1604C49F'),
('1604B49F', '1604C49F'),
('1604A042', '1604C024'),
('1604B024', '1604C024'),
('1604B261', '1604C261'),
('1604B29E', '1604C29E'),
('1607A021', '1604C033'),
('1604B033', '1604C033'),
('1604B141', '1604C141'),
('1604A031', '1604C031'),
('1604B031', '1604C031'),
('1604A106', '1604C151'),
('1604B151', '1604C151'),
('1600A104', '1600C104'),
('1600B104', '1600C104'),
('1604A023', '1604C014'),
('1604B023', '1604C014'),
('1604A055', '1604C023'),
('1604B035', '1604C023'),
('1600A104', '1600C106'),
('1600B106', '1600C106'),
('1600A304', '1604C056'),
('1604B053', '1604C056'),
('1604B341', '1604C341'),
('1604A063', '1604C331'),
('1604B331', '1604C331'),
('1604A308', '1604C362'),
('1604B362', '1604C362'),
('1604A203', '1604C39F'),
('1604B39F', '1604C39F'),
('1604A302', '1604C39B'),
('1604B39B', '1604C39B'),
('1604A105', '1604C161'),
('1604B161', '1604C161'),
('1604B162', '1604C162'),
('1604B19G', '1604C19G'),
('1604A107', '1604C19E'),
('1604B19E', '1604C19E'),
('1604A035', '1604C131'),
('1604B131', '1604C131'),
('1604A044', '1604C361'),
('1604B361', '1604C361'),
('1604B441', '1604C441'),
('1604A062', '1604C042'),
('1604B042', '1604C042'),
('1604A309', '1604C055'),
('1604B055', '1604C055'),
('1604A072', '1604C39A'),
('1604B39A', '1604C39A'),
('1604B39K', '1604C39K'),
('1604B39J', '1604C39J'),
('1604A307', '1604C39E'),
('1604B39E', '1604C39E'),
('1604A206', '1604C39G'),
('1604B39G', '1604C39G'),
('1604A202', '1604C351'),
('1604B351', '1604C351'),
('1607A101', '1604C19D'),
('1604B19D', '1604C19D'),
('1604A303', '1604C39C'),
('1604B39B', '1604C39C'),
('1604A305', '1604C39D'),
('1604B39D', '1604C39D'),
('1608B054', '1608C051'),
('1604B29A', '1604C29A'),
('1604B49I', '1604C49I'),
('1604B431', '1604C431'),
('1604B49H', '1604C49H'),
('1604A052', '1604C045'),
('1604B045', '1604C045'),
('1604A404', '1604C49E'),
('1604B49E', '1604C49E'),
('1604A401', '1604C49G'),
('1604B49G', '1604C49G');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `npk` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`npk`, `user_id`, `fullname`, `is_deleted`) VALUES
('208020', 2, 'Andre, M.Sc.', 0),
('219036', 3, 'Remy Giovanny Mangowal, M.T.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_bimbingan`
--

CREATE TABLE `log_bimbingan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `perihal_logs_id` int(11) NOT NULL,
  `judul` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `publikasi` varchar(15) NOT NULL DEFAULT 'rilis',
  `link_file` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tugas_akhir_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_bimbingan`
--

INSERT INTO `log_bimbingan` (`id`, `tanggal`, `perihal_logs_id`, `judul`, `keterangan`, `publikasi`, `link_file`, `tugas_akhir_id`) VALUES
(1, '2024-03-10 09:43:32', 1, 'Log 1', 'Log 1 Keterangan', 'rilis', 'http://gamiskrip.jitusolution.com', 1),
(2, '2024-04-02 02:08:45', 1, 'Log 2', 'Log 2', 'rilis', 'http://gamiskrip.jitusolution.com', 1),
(3, '2024-07-18 14:25:51', 2, 'Konsultasi BAB 3', 'Ini konsultasi bab 3', 'rilis', 'http://www.ubaya.ac.id', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_bimbingan_files`
--

CREATE TABLE `log_bimbingan_files` (
  `id` int(11) NOT NULL,
  `judul` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `log_bimbingan_id` int(11) NOT NULL,
  `nama_file` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_bimbingan_files`
--

INSERT INTO `log_bimbingan_files` (`id`, `judul`, `log_bimbingan_id`, `nama_file`) VALUES
(1, 'File Log 1A', 1, 'ad6b98d495232ad4833db851dc97f9c5.pdf'),
(2, 'File Log 1B', 1, 'cf99c99f4792b41605aa740158d50310.pdf'),
(6, 'wgmwgel', 3, 'e093d040000a0db5f4432640b9bbe5f3.pdf'),
(8, 'horthkt', 3, '5f64ffd8c6122be944fd6892da8b9a11.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `log_bimbingan_komentar`
--

CREATE TABLE `log_bimbingan_komentar` (
  `id` bigint(20) NOT NULL,
  `log_bimbingan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `komentar` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_bimbingan_komentar`
--

INSERT INTO `log_bimbingan_komentar` (`id`, `log_bimbingan_id`, `user_id`, `komentar`, `created`) VALUES
(1, 2, 2, 'afwaefw', '2024-04-01 07:53:47'),
(2, 1, 2, 'tes', '2024-04-02 01:25:04'),
(3, 1, 2, 'oop', '2024-04-02 01:25:10'),
(4, 1, 1, 'Balas', '2024-04-02 02:07:07'),
(5, 2, 1, 'Tes 123', '2024-04-02 02:09:08'),
(6, 3, 1, 'coba komen', '2024-07-17 09:22:21'),
(7, 1, 2, 'Saya dosen', '2024-07-24 05:52:10'),
(8, 1, 2, 'ceasa', '2024-07-24 06:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `master_player_type`
--

CREATE TABLE `master_player_type` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_player_type`
--

INSERT INTO `master_player_type` (`id`, `nama`) VALUES
(1, 'players'),
(2, 'socializer'),
(3, 'disruptor'),
(4, 'philantropist'),
(5, 'free_spirit'),
(6, 'achiever');

-- --------------------------------------------------------

--
-- Table structure for table `master_quest`
--

CREATE TABLE `master_quest` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `points` int(11) NOT NULL,
  `repeated_by` enum('daily','weekly','monthly','number') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_quest`
--

INSERT INTO `master_quest` (`id`, `label`, `description`, `points`, `repeated_by`) VALUES
(1, 'newposting', 'Perkenalkan dirimu di ruang diskusi; Ceritakan topik skripsimu di ruang diskusi; Bagikan tantangan yang kamu hadapi saat mengerjakan skripsi di ruang diskusi; ', 3, NULL),
(2, 'replyforum', 'Sumbangkan ide atau masukan terkait skripsi di ruang diskusi; Berpartisipasi dalam diskusi di ruang skripsi; ', 3, 'weekly'),
(3, 'askforhelp', 'Ajukan pertanyaan di ruang diskusi terkait skripsimu; Tanyakan sesuatu tentang skripsimu di ruang diskusi; Mintalah saran terkait skripsimu dengan mengirim pertanyaan di forum diskusi; Diskusikan masalah atau ide skripsimu dengan teman lain di ruang diskusi;', 2, NULL),
(4, 'answerhelp', 'Bantu jawab pertanyaan teman di ruang diskusi; Diskusikan solusi untuk pertanyaan teman di ruang diskusi; Berikan tanggapanmu terhadap pertanyaan teman di ruang diskusi; ', 3, NULL),
(5, 'sharearticle', 'Share artikel terkait skripsimu di ruang diskusi; Share literatur terkait skripsimu di ruang diskusi; Sebarkan artikel yang berkaitan dengan skripsimu ke dalam ruang diskusi; Share progress penelitian skripsimu untuk dibahas di ruang diskusi;', 3, NULL),
(6, 'sharewip', 'Share progress sementara pengerjaan skripsimu di ruang diskusi; Sudah sampai mana skripsimu? Share di ruang diskusi sekarang!; Update perjalanan skripsimu di forum diskusi, siapa tahu ada tips yang bermanfaat!; Tunjukkan progres skripsimu di forum diskusi dan dapatkan feedback dari teman-teman!; udah selesai bab berapa? Ayo post progresmu di ruang diskusi!', 3, 'weekly'),
(7, 'quoting', 'Quote post teman di ruang diskusi;', 1, NULL),
(8, 'liking', 'Memberi like pada post teman di ruang diskusi;', 1, 'number'),
(9, 'accessruangdiskusi', 'Mengakses ruang diskusi;', 1, 'daily'),
(10, 'accessprofile', 'Cek profil temanmu; Yuk, buka profil teman; Lihat profil teman;', 1, 'number'),
(11, 'writeingroupclan', 'Yuk diskusi di clanmu; Tulis chat di clan; Motivasi temanmu sesama clan, yuk chat di clan;', 1, 'weekly'),
(12, 'createweeklyplan', 'Plan ahead! Buat rencana mingguanmu; Selangkah lebih maju dengan perencanaan matang, yuk bikin rencana mingguanmu di weekly planner; Waktunya produktif! Susun weekly planner untuk skripsimu dan selesaikan target mingguan dengan tepat waktu!; Skripsi lancar, hidup teratur! Yuk, buat weekly planner dan susun target-targetmu dengan rapi.; Fokus dan terorganisir! Jadwalkan tugas-tugas skripsimu di weekly planner dan capai milestone setiap minggunya.;', 3, 'weekly'),
(13, 'finishweeklyplanner', 'Stay focus! Selesaikan weekly plan yang sudah kamu rencanakan; Fokus dan eksekusi! Lengkapi semua tugas dalam weekly planner skripsimu minggu ini.; Tunjukkan produktivitasmu! Rampungkan semua target di weekly planner skripsimu minggu ini.; Cek kembali weekly planmu, dan selesaikan semua yang sudah kamu rencanakan!;', 3, NULL),
(14, 'draftlogbimbingan', 'Buat draft log bimbingan dulu yuk, sebelum ditunjukkan ke dosbingmu; Rancang dulu draft log bimbinganmu, supaya tetap semangat dan konsisten; Persiapkan bimbingan dengan baik! Buat draft log bimbingan untuk membantu kamu tetap fokus dan terorganisir; Sebelum ke dosbing, siapkan dulu draft log bimbingan terbaikmu;', 2, NULL),
(15, 'logbimbingan', 'Tunjukkan progress skripsimu ke dosbing, tulis log bimbingan baru; Tetap semangat dan konsisten dengan rajin konsultasi ke dosbing. Tulis segera log bimbinganmu; Catat progress skripsimu ke log bimbingan; ', 3, 'weekly'),
(16, 'replylogbimbingan', 'Cek log bimbinganmu, dan berikan tanggapan/komentar; Bantu dosbing lebih paham terkait log bimbinganmu, tambahkan tanggapan/komentar yuk di log bimbingan; Balas tanggapan dosen di log bimbingan yuk;', 2, NULL),
(17, 'avatar', 'Ganti penampilanmu, ubah avatarmu yuk; Tampil beda, yuk ubah avatarmu sekarang!; Coba gaya baru! Ganti penampilan avatarmu dan lihat perubahanmu.; Pengen tampilan baru? Yuk, buat avatarmu lebih stylish!; Ganti penampilan, ganti energi! Ubah avatarmu dengan pilihan gaya baru.;', 3, NULL),
(18, 'login', 'Pastikan setiap hari kamu login ke gamiskrip; Login setiap hari untuk mekasimalkan manfaat dari gamiskrip;', 1, 'daily');

-- --------------------------------------------------------

--
-- Table structure for table `perihal_logs`
--

CREATE TABLE `perihal_logs` (
  `id` int(11) NOT NULL,
  `perihal` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perihal_logs`
--

INSERT INTO `perihal_logs` (`id`, `perihal`, `urutan`) VALUES
(1, 'Studi Literatur (BAB 1 &amp; 2)', 0),
(2, 'Analisis (BAB 3)', 0),
(3, 'Desain (BAB 4)', 0),
(4, 'Implementasi (BAB 5)', 0),
(5, 'Evaluasi (BAB 6)', 0),
(6, 'Kesimpulan (BAB 7)', 0),
(7, 'Lainnya', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quest_has_player_type`
--

CREATE TABLE `quest_has_player_type` (
  `quest_id` int(11) NOT NULL,
  `player_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quest_has_player_type`
--

INSERT INTO `quest_has_player_type` (`quest_id`, `player_type_id`) VALUES
(1, 2),
(2, 2),
(2, 4),
(3, 2),
(4, 2),
(4, 4),
(5, 6),
(6, 6),
(7, 5),
(8, 5),
(9, 5),
(10, 5),
(11, 2),
(11, 4),
(12, 6),
(13, 6),
(14, 6),
(15, 6),
(16, 6),
(17, 5);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `web_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `web_name`) VALUES
(1, 'Gamiskrip');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `nrp` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `players` double NOT NULL,
  `socializer` double NOT NULL,
  `disruptor` double NOT NULL,
  `philanthropist` double NOT NULL,
  `free_spirit` double NOT NULL,
  `achiever` double NOT NULL,
  `player_style` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`nrp`, `user_id`, `fullname`, `players`, `socializer`, `disruptor`, `philanthropist`, `free_spirit`, `achiever`, `player_style`, `is_deleted`) VALUES
('160418049', 11, 'Peter Jose', 0, 0, 0, 0, 0, 0, '', 0),
('160418090', 28, 'Kevin Eliansyah', 0, 0, 0, 0, 0, 0, '', 0),
('160418121', 23, 'Hafizh Furqon Purnomo', 0, 0, 0, 0, 0, 0, '', 0),
('160418122', 30, 'Gusakay Iqbhalino', 0, 0, 0, 0, 0, 0, '', 0),
('160419047', 24, 'Andreas Hartono', 0, 0, 0, 0, 0, 0, '', 0),
('160419053', 29, 'Chaniago Marcel', 0, 0, 0, 0, 0, 0, '', 0),
('160419068', 14, 'Teofilus Tri Haryadi', 0, 0, 0, 0, 0, 0, '', 0),
('160419073', 7, 'Adam Teguh Prayoga', 0, 0, 0, 0, 0, 0, '', 0),
('160419108', 33, 'Gilang Kusuma', 0, 0, 0, 0, 0, 0, '', 0),
('160419114', 26, 'Armando Diaz', 0, 0, 0, 0, 0, 0, '', 0),
('160419117', 34, 'Siti Ainun Lutfhia', 0, 0, 0, 0, 0, 0, '', 0),
('160419122', 22, 'Dendy Pratama', 0, 0, 0, 0, 0, 0, '', 0),
('160419127', 35, 'Alif Himawan', 0, 0, 0, 0, 0, 0, '', 0),
('160419128', 38, 'Naufal Muflih Ramadhan', 0, 0, 0, 0, 0, 0, '', 0),
('160419130', 39, 'Mario Vincent', 0, 0, 0, 0, 0, 0, '', 0),
('160419132', 32, 'Kevin Sihombing', 0, 0, 0, 0, 0, 0, '', 0),
('160419164', 31, 'Bayu Merta', 0, 0, 0, 0, 0, 0, '', 0),
('160420039', 12, 'Ardi Tirta Senjaya', 0, 0, 0, 0, 0, 0, '', 0),
('160420062', 21, 'Natanael Geraldi', 0, 0, 0, 0, 0, 0, '', 0),
('160420068', 17, 'Steven Natanael', 0, 0, 0, 0, 0, 0, '', 0),
('160420078', 20, 'Kevin Liemoa', 0, 0, 0, 0, 0, 0, '', 0),
('160420079', 19, 'Austin Lieandro', 0, 0, 0, 0, 0, 0, '', 0),
('160420082', 16, 'Henri Jayanata Kusuma', 0, 0, 0, 0, 0, 0, '', 0),
('160420086', 41, 'Rudi Novianto', 0, 0, 0, 0, 0, 0, '', 0),
('160420088', 5, 'Darrell Dominic Marsono Basuki', 0, 0, 0, 0, 0, 0, '', 0),
('160420095', 15, 'William Alexander Fahik', 0, 0, 0, 0, 0, 0, '', 0),
('160420097', 13, 'Jevon Gunawan', 0, 0, 0, 0, 0, 0, '', 0),
('160420112', 9, 'Steven Labina', 0, 0, 0, 0, 0, 0, '', 0),
('160420113', 36, 'Reinaldo Alvares', 0, 0, 0, 0, 0, 0, '', 0),
('160420117', 18, 'Yohan Teguh', 0, 0, 0, 0, 0, 0, '', 0),
('160420124', 25, 'Marcella Diva Viorent', 0, 0, 0, 0, 0, 0, '', 0),
('160420154', 37, 'Muhammad Adhim', 0, 0, 0, 0, 0, 0, '', 0),
('160421005', 6, 'Felicia F', 0, 0, 0, 0, 0, 0, '', 0),
('160421068', 40, 'Maahirah Nasywa Elfiana Putri', 0, 0, 0, 0, 0, 0, '', 0),
('208020', 1, 'Andre', 0, 0, 0, 0, 0, 0, '', 0),
('46938692', 43, 'Herman Template', 0, 0, 0, 0, 0, 0, '', 0),
('83923859275', 4, 'Ojog Jogon', 0, 0, 0, 0, 0, 0, '', 0),
('s160418019', 10, 'Dylan Sherwood Hanenkang', 0, 0, 0, 0, 0, 0, '', 0),
('s160420141', 27, 'Novanti Alfiha', 0, 0, 0, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `id` bigint(20) NOT NULL,
  `thread_title` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `thread_type` enum('general_discussion','ask_for_help','share_knowledge','share_wip') NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` datetime NOT NULL,
  `created_by_user_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `parent_folder_id` int(11) DEFAULT NULL,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`id`, `thread_title`, `thread_type`, `content`, `created`, `created_by_user_id`, `is_deleted`, `parent_folder_id`, `is_locked`) VALUES
(1, 'Tes Judul', 'general_discussion', 'Tes Isi', '2024-05-06 07:13:28', 1, 0, NULL, 0),
(2, 'Tes123', 'general_discussion', 'Tuliskan isi diskusi', '2024-05-07 01:35:56', 1, 0, 2, 0),
(3, 'Diskusi machine learning', 'general_discussion', 'Tes', '2024-05-07 02:15:52', 1, 0, 3, 0),
(4, 'Coba buat baru', 'general_discussion', 'wrkgwmg', '2024-07-13 06:02:50', 1, 0, NULL, 0),
(5, 'Coba ask for help', 'ask_for_help', 'Ask for help', '2024-08-29 02:14:30', 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `thread_files`
--

CREATE TABLE `thread_files` (
  `id` int(11) NOT NULL,
  `filename` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `thread_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thread_files`
--

INSERT INTO `thread_files` (`id`, `filename`, `title`, `thread_id`) VALUES
(1, '8601f1f8dff55ef3a2a66103cca67fe6.jpeg', 'ini gambar', 1),
(2, '4c48d8085ffbdfeb5ddc80141ff8a10b.pdf', 'ini pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `thread_likes`
--

CREATE TABLE `thread_likes` (
  `thread_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thread_likes`
--

INSERT INTO `thread_likes` (`thread_id`, `user_id`) VALUES
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `thread_likes_reply`
--

CREATE TABLE `thread_likes_reply` (
  `thread_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thread_likes_reply`
--

INSERT INTO `thread_likes_reply` (`thread_id`, `user_id`) VALUES
(2, 1),
(3, 1),
(24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `thread_read`
--

CREATE TABLE `thread_read` (
  `thread_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thread_read`
--

INSERT INTO `thread_read` (`thread_id`, `user_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 43),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `thread_reply`
--

CREATE TABLE `thread_reply` (
  `id` bigint(20) NOT NULL,
  `thread_id` bigint(20) NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thread_reply`
--

INSERT INTO `thread_reply` (`id`, `thread_id`, `content`, `created`, `created_by_user_id`) VALUES
(1, 3, '<p>Balas diskusi tes diatas</p><ul><li>123</li><li>4wt3</li><li>erhre</li></ul>', '2024-05-07 08:58:12', 43),
(2, 2, 'coba\r\n12\r\n3\r\n[code]var x = 10; [/code]\r\n[b]ini bold[/b]', '2024-07-14 07:48:41', 1),
(3, 2, '[del]ini coret[/del]', '2024-07-15 08:36:23', 1),
(4, 2, '[s]coret[/s]', '2024-07-15 08:36:49', 1),
(5, 2, '[list]\r\n    [*]Bulleted list\r\n    [*]Bulleted list\r\n    [*]Bulleted list\r\n[/list]', '2024-07-15 08:44:35', 1),
(6, 2, '[url]yahoo.com[/url]', '2024-07-15 09:01:46', 1),
(7, 2, '&amp;#x1F923;', '2024-07-15 09:13:31', 1),
(13, 2, '????', '2024-07-15 10:28:05', 1),
(14, 2, '????', '2024-07-15 10:29:22', 1),
(15, 2, '&#55357;&#56906;', '2024-07-15 10:34:01', 1),
(16, 2, '&amp;#128512;', '2024-07-16 06:15:14', 1),
(17, 2, '&#55357;&#56832;', '2024-07-16 06:15:24', 1),
(18, 2, '&amp;#55357;', '2024-07-16 06:20:43', 1),
(19, 2, '&#128512;&#128512;', '2024-07-16 06:20:54', 1),
(20, 2, '????', '2024-07-16 07:39:20', 1),
(21, 2, 'tes emoji &#128516;&#128515; &#128512;', '2024-07-17 05:41:10', 1),
(22, 1, '[code]var x = 10;[/code]', '2024-07-23 08:59:37', 1),
(23, 1, 'hj d\r\n&#128516;', '2024-07-23 08:59:58', 1),
(24, 4, 'tes 123', '2024-08-30 01:33:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tugas_akhir`
--

CREATE TABLE `tugas_akhir` (
  `id` int(11) NOT NULL,
  `judul` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `lecturer1_id` int(11) NOT NULL,
  `lecturer2_id` int(11) NOT NULL,
  `tanggal_st` date NOT NULL,
  `tanggal_akhir_st` date NOT NULL,
  `proposal_url` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas_akhir`
--

INSERT INTO `tugas_akhir` (`id`, `judul`, `student_id`, `lecturer1_id`, `lecturer2_id`, `tanggal_st`, `tanggal_akhir_st`, `proposal_url`, `created`, `is_active`, `is_deleted`) VALUES
(1, 'Tes', 1, 2, 3, '2023-01-01', '2024-08-22', 'https://drive.google.com/file/d/0B6US5WDOTSSDUVJOdUV0al9Ga2c/view?usp=drive_link&resourcekey=0-o1gpDVasjWKINjIxZyRFjg', '2024-07-11 09:31:51', 1, 0),
(2, 'Pembangunan Aplikasi Marketplace Penyewaan Alat Transportasi Menggunakan Metode AHP (Analytical Hearchy Process)', 34, 2, 3, '2024-04-07', '2024-09-07', 'https://docs.google.com/document/d/143Uu0gRKNpEYjZaCr5u-I1WqyDAstD8t/edit', '2024-04-20 00:31:19', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `avatar_image_filename` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `avatar_image_url` varchar(300) DEFAULT NULL,
  `user_id_avatar` varchar(300) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `user_type` enum('student','lecturer','admin','') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `password`, `avatar_image_filename`, `avatar_image_url`, `user_id_avatar`, `last_login`, `user_type`, `is_deleted`) VALUES
(1, 'andrenoto@yahoo.co.id', 'Andre', 'Andre', '$2y$10$j3v2OS7dfpH8EEEEKJpM9.HjfOJltDz0qsHa0bRfHsDkJk6ehXL/q', 'pic-2.jpg', 'https://models.readyplayer.me/66acd5b2cefab44aa9093523.png', '66a0b6a1ba97b5996aa01643', '2024-08-28 14:00:45', 'student', 0),
(2, 'andre@staff.ubaya.ac.id', 'Andre', 'Andre', '$2y$10$j3v2OS7dfpH8EEEEKJpM9.HjfOJltDz0qsHa0bRfHsDkJk6ehXL/q', '', '', NULL, '2024-07-24 05:51:42', 'lecturer', 0),
(3, 'remy.mangowal@staff.ubaya.ac.id', 'Remy', 'Giovanny Mangowal', '$2y$10$j3v2OS7dfpH8EEEEKJpM9.HjfOJltDz0qsHa0bRfHsDkJk6ehXL/q', '', '', NULL, '2024-02-13 13:28:07', 'lecturer', 0),
(4, 'ojog@gmail.com', 'Ojog', 'Jogon', '$2y$10$lV5.gmnJiEIXIHYL1XSM8uCSlgwt.O89YqswAOCookgJHaVWn0qpu', '', '', NULL, NULL, 'student', 0),
(5, 's160420088@student.ubaya.ac.id', 'Darrell', 'Dominic Marsono Basuki', '$2y$10$A..butFwbivUQaiQKOjfw.CoO4ISuhWvuOuZ3YXRWyI8/0ojGdXIO', '', '', NULL, '2024-03-11 12:53:31', 'student', 0),
(6, 's160421005@student.ubaya.ac.id', 'Felicia', 'F', '$2y$10$/ELjf2XwKKF60LJZHqb6guJRFjrDn9nfuHYePOkdP.ftzoL5/ryai', '', '', NULL, '2024-03-26 01:27:58', 'student', 0),
(7, 's160419073@gmail.com', 'Adam Teguh', 'Prayoga', '$2y$10$W9oXiZrBmNiD1rwpkmwtO.RgLAGGPEvYenNdwPOJzJAwpB479wskW', '', '', NULL, '2024-03-13 07:58:33', 'student', 0),
(8, 's160419073@student.ubaya.ac.id', 'Adam Teguh', 'Prayoga', '$2y$10$atH1iIcxu2hBIvGG5ijNQu8LdagofqnVF8RtIxFeqWBxNyTJEXDFy', '', '', NULL, NULL, 'student', 0),
(9, 's160420112@student.ubaya.ac.id', 'Steven', 'Labina', '$2y$10$4AsnbvAhBMikXaUSAAelD.LFYY32XdciZSq5ekZY7ylwwblKyKBFa', '', '', NULL, '2024-03-13 07:15:04', 'student', 0),
(10, 's160418019@student.ubaya.ac.id', 'Dylan Sherwood', 'Hanenkang', '$2y$10$0mtWz6nR63oQpZdvZk/BYuMutGSjEJtcTlIhC2uHXW8oA2ifUF0My', '', '', NULL, '2024-03-13 07:49:09', 'student', 0),
(11, 's160418049@student.ubaya.ac.id', 'Peter', 'Jose', '$2y$10$dqgZDwXkfqzb9hRF4GgyxeLD6zMXuSA8qALgj697rkrsdGFNzp3Bu', '', '', NULL, '2024-03-18 11:58:55', 'student', 0),
(12, 's160420039@student.ubaya.ac.id', 'Ardi Tirta', 'Senjaya', '$2y$10$Yo7V8hH/GzXjGt35W0YoSOwy7wI7z7pMrYQLXBcCfCbmG4zJV5BWy', '', '', NULL, '2024-03-25 11:26:21', 'student', 0),
(13, 's160420097@student.ubaya.ac.id', 'Jevon', 'Gunawan', '$2y$10$p5sXI4rBnJ1MtOTbBJArP.hkCP70zscSs/tusqssaZsyO2uNVgizW', '', '', NULL, '2024-03-26 05:05:36', 'student', 0),
(14, 's160419068@student.ubaya.ac.id', 'Teofilus', 'Tri Haryadi', '$2y$10$h24y5ZpjEQkiR/9xDvP8kuy65d.AYf4PFloAi.drSzdMQwAbHQ..y', '', '', NULL, '2024-04-16 12:57:12', 'student', 0),
(15, 's160420095@student.ubaya.ac.id', 'William', 'Alexander Fahik', '$2y$10$j7GjT7AeXN9jrz0VF02/hOC.9BbMPGcYY2mIT1VO8MtZhErwqXHR.', '', '', NULL, '2024-04-16 14:30:01', 'student', 0),
(16, 's160420082@student.ubaya.ac.id', 'Henri Jayanata', 'Kusuma', '$2y$10$ql4r/zudv/dDfUlhi2/HYeWLKisUZEn86ltthdm/BHyVSbDWwcUUC', '', '', NULL, '2024-04-16 17:57:55', 'student', 0),
(17, 's160420068@student.ubaya.ac.id', 'Steven', 'Natanael', '$2y$10$OpBJ/WDs2nWcRDjjK5vdv.SmV./bCik0VKkvK1jbNhZQuc9ElYdJm', '', '', NULL, '2024-04-17 01:48:56', 'student', 0),
(18, 's160420117@student.ubaya.ac.id', 'Yohan', 'Teguh', '$2y$10$a4M2XTq/ejV9Ag0WLYsdhOvJ/t6pS33Ux/bDCxXNkBHBsZmyB7qpG', '', '', NULL, '2024-04-17 03:40:35', 'student', 0),
(19, 's160420079@student.ubaya.ac.id', 'Austin', 'Lieandro', '$2y$10$MkwkdVSltl9cpkcH5X858OviDs7pC.b1pw9rK3YiBs5cyG9Xc4xAO', '', '', NULL, '2024-05-28 04:38:33', 'student', 0),
(20, 'S160420078@student.ubaya.ac.id', 'Kevin', 'Liemoa', '$2y$10$TxtF0xILNXZMxPzsieKAAOoU4zk71syE65ITj2Yl20x9hHTgEhD52', '', '', NULL, '2024-04-17 08:50:13', 'student', 0),
(21, 's160420062@student.ubaya.ac.id', 'Natanael', 'Geraldi', '$2y$10$0WzxAaBeYQib6v5O6PHSdOFQBrvFubHgBmkI1GzbuxdMCgiRsCrte', '', '', NULL, '2024-04-17 08:56:24', 'student', 0),
(22, 's160419122@student.ubaya.ac.id', 'Dendy', 'Pratama', '$2y$10$wNsqk14NNEDmRW6rjJQ4MeBLM6YieNCAmDvNTjixT3E25p73LTrEO', '', '', NULL, '2024-04-18 02:16:09', 'student', 0),
(23, 's160418121@student.ubaya.ac.id', 'Hafizh Furqon', 'Purnomo', '$2y$10$vPLMO/U.V9Iks8eSQ2J1gu7wVcsle4gFq6z7fO0ySBDFiTGhZBWGi', '', '', NULL, '2024-04-17 12:47:22', 'student', 0),
(24, 's160419047@student.ubaya.ac.id', 'Andreas', 'Hartono', '$2y$10$gEYBRQnDYVUyyc2Fo/isveB9oQGQTcvNg2qsGWaeZK8HqqdMi8Sy2', '', '', NULL, '2024-04-17 16:06:17', 'student', 0),
(25, 's160420124@student.ubaya.ac.id', 'Marcella Diva', 'Viorent', '$2y$10$WyQ/zcDAYQsBhlchkWWgtObtljakmQO8FX/eCMh0WTTeKt8Kx8Y5i', '', '', NULL, '2024-04-18 07:24:11', 'student', 0),
(26, 's160419114@student.ubaya.ac.id', 'Armando', 'Diaz', '$2y$10$8.c5AhX4KzKcXlM6T9ZSTuMzCjBGFNH.X18ENLQuPTfF3J4erPDqy', '', '', NULL, '2024-04-17 18:03:26', 'student', 0),
(27, 's160420141@student.ubaya.ac.id', 'Novanti', 'Alfiha', '$2y$10$ImCeofSW7BQm3/kwvuDfwOMYQqaOQDMQxaqnkaEUWLtCWgLoOKFZe', '', '', NULL, '2024-04-18 00:21:55', 'student', 0),
(28, 's160418090@student.ubaya.ac.id', 'Kevin', 'Eliansyah', '$2y$10$NY3HNGyuQe7OqbeCX7DvEeB2N9cbe59F5Lmzj3EY2Xmm089nFYGrO', '', '', NULL, '2024-04-18 01:08:17', 'student', 0),
(29, 's160419053@student.ubaya.ac.id', 'Chaniago', 'Marcel', '$2y$10$juCi4AyNiPgf9yICcN/kRuxQBJk2GDuBICNoX4Zf3iLs2FP44HdOy', '', '', NULL, '2024-04-18 02:28:26', 'student', 0),
(30, 's160418122@student.ubaya.ac.id', 'Gusakay', 'Iqbhalino', '$2y$10$LhK7JatsnUsVsQ9P1v.oRuea/aJcMEKbzo5WoclxGgg0vnQpH/Lm.', '', '', NULL, '2024-04-18 03:11:57', 'student', 0),
(31, 's160419164@student.ubaya.ac.id', 'Bayu', 'Merta', '$2y$10$YBI1OkE43YmZeLS9NaE78eP9tAFc6Yt3pG0dzubafQPHsC5a6UbDK', '', '', NULL, '2024-04-18 12:10:54', 'student', 0),
(32, 's160419132@student.ubaya.ac.id', 'Kevin', 'Sihombing', '$2y$10$1MdNpZnOvidReeepVxROue.mc9FEM2kJNiSaAMfrU202S2NCvta96', '', '', NULL, '2024-04-19 00:45:41', 'student', 0),
(33, 's160419108@student.ubaya.ac.id', 'Gilang', 'Kusuma', '$2y$10$MYWIeJqAuVvXrUMwxYcHfOKYrkvcOAl31lS00cBkEF.XPQzbaloY6', '', '', NULL, '2024-04-20 00:31:13', 'student', 0),
(34, 's160419117@student.ubaya.ac.id', 'Siti Ainun', 'Lutfhia', '$2y$10$bA5lrngquGq7US61nWWZDujpTZOgPNuL9hMwC67DRDCO0YU3D.ihm', '', '', NULL, '2024-04-20 07:04:36', 'student', 0),
(35, 's160419127@student.ubaya.ac.id', 'Alif', 'Himawan', '$2y$10$h/VMwYxAgVjpJq/BDwUsiuiN7gsWRl1MnsLo.it1VALRtxHjaHHMu', '', '', NULL, '2024-04-20 06:50:08', 'student', 0),
(36, 's160420113@student.ubaya.ac.id', 'Reinaldo', 'Alvares', '$2y$10$7n7NYbtxbmDjBDx2NYDcwei/rXoZbP4EYvqfLAa1FzYldEfvZprve', '', '', NULL, '2024-04-20 08:32:21', 'student', 0),
(37, 's160420154@student.ubaya.ac.id', 'Muhammad', 'Adhim', '$2y$10$Ts8h/ZMG69LIqLTFcUg3OOcMJ4CEv56bfPdvXmn5N3atK2vKUts3i', '', '', NULL, '2024-04-22 03:07:35', 'student', 0),
(38, 's160419128@student.ubaya.ac.id', 'Naufal', 'Muflih Ramadhan', '$2y$10$4bUSFrFLxVKIj/s3AFoMUeYLDbZQ2D4dgSNkradAt0mKLkLJb6CdC', '', '', NULL, '2024-04-23 10:07:25', 'student', 0),
(39, 's160419130@student.ubaya.ac.id', 'Mario', 'Vincent', '$2y$10$j3v2OS7dfpH8EEEEKJpM9.HjfOJltDz0qsHa0bRfHsDkJk6ehXL/q', '', 'https://models.readyplayer.me/66a1ba227b8266b46317b2a6.png', '66a1b9e158baf99efbf7c5d4', '2024-07-25 01:23:03', 'student', 0),
(40, 's160421068@student.ubaya.ac.id', 'Maahirah Nasywa Elfiana', 'Putri', '$2y$10$5YBFc9QUUIM1cNRtu8AGz.flBkvdGhYdooUl8ZeemYfGG9jE6Ok3K', '', '', NULL, '2024-04-29 09:14:45', 'student', 0),
(41, 's160420086@student.ubaya.ac.id', 'Rudi', 'Novianto', '$2y$10$NSPzT09BYH5bOu7pjcWhoOCk9tBVux6RAPfT96qYVsxi68vra8vYG', '', '', NULL, '2024-05-01 18:15:06', 'student', 0),
(42, 'admin@gamiskrip.com', 'Admin', 'Admin', '$2y$10$j3v2OS7dfpH8EEEEKJpM9.HjfOJltDz0qsHa0bRfHsDkJk6ehXL/q', '', '', NULL, '2024-05-07 02:12:49', 'admin', 0),
(43, 'herman@gamiskrip.com', 'Herman', 'Template', '$2y$10$eYXPvmonEzv6FnhhegUoEusD85vP6NI3SwJYe7h5Olh4yuvFdeJEy', 'pic-5.png', '', NULL, '2024-05-07 08:41:07', 'student', 0),
(44, 'aldivincent0@gmail.com', 'Aldi', 'Vincent', '$2y$10$SuYJ6IpS45hh2psXYiYISeGcdYJg9PoQCrfYSlgdmnL2f/J8BmRUK', 'pic-2.jpg', '', NULL, NULL, 'student', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_point`
--

CREATE TABLE `user_point` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `point_label_quest` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_quest`
--

CREATE TABLE `user_quest` (
  `id` int(11) NOT NULL,
  `quest_created_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `repeated_need` int(11) NOT NULL COMMENT 'jumlah repetisi yg dibutuhkan agar quest selesai',
  `repeated_by` enum('daily','weekly','monthly','') NOT NULL COMMENT 'repetisi quest berdasarkan daily/weekly/month/number',
  `last_repeat_date` datetime DEFAULT NULL COMMENT 'mencatat tanggal/jam terakhir user melakukan repetisi quest ini',
  `number_of_repetition_done` int(11) DEFAULT NULL COMMENT 'Jumlah repetisi yang sudah diselesaikan',
  `quest_rating` int(11) DEFAULT NULL,
  `quest_finished_date` datetime NOT NULL,
  `quest_status` enum('active','finished','cancelled','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_quest_matrix`
--

CREATE TABLE `user_quest_matrix` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `weight` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weekly_plan`
--

CREATE TABLE `weekly_plan` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tugas_akhir_id` int(11) NOT NULL,
  `start_week` date NOT NULL,
  `end_week` date NOT NULL,
  `plan` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weekly_plan`
--

INSERT INTO `weekly_plan` (`id`, `user_id`, `tugas_akhir_id`, `start_week`, `end_week`, `plan`, `is_done`) VALUES
(1, 1, 1, '2022-12-26', '2023-01-01', 'Preparasi', 0),
(2, 1, 1, '2022-12-26', '2023-01-01', 'Bimbingan pertama', 1),
(3, 1, 1, '0000-00-00', '0000-00-00', 'cek', 0),
(4, 1, 1, '0000-00-00', '0000-00-00', 'es', 0),
(5, 1, 1, '2023-01-23', '2023-01-29', 'tes', 1),
(6, 1, 1, '2023-01-16', '2023-01-22', 'tes 123', 0),
(14, 1, 1, '2023-01-30', '2023-02-05', 'cek', 0),
(15, 1, 1, '2023-01-30', '2023-02-05', '1234566', 0),
(20, 1, 1, '2022-12-26', '2023-01-01', 'Riset Teori Bla Bla', 0),
(21, 1, 1, '2023-01-02', '2023-01-08', 'tes 123', 1),
(22, 1, 1, '2023-01-02', '2023-01-08', 'wegwg', 1),
(23, 1, 1, '2023-01-02', '2023-01-08', 'wegweg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatar_images`
--
ALTER TABLE `avatar_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cluster_center`
--
ALTER TABLE `cluster_center`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cluster_course`
--
ALTER TABLE `cluster_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cluster_result`
--
ALTER TABLE `cluster_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `diskusi_folder`
--
ALTER TABLE `diskusi_folder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emoticon`
--
ALTER TABLE `emoticon`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `hexad_questions`
--
ALTER TABLE `hexad_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hexad_questions_answer`
--
ALTER TABLE `hexad_questions_answer`
  ADD PRIMARY KEY (`hexad_questions_id`,`user_id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`npk`);

--
-- Indexes for table `log_bimbingan`
--
ALTER TABLE `log_bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_bimbingan_files`
--
ALTER TABLE `log_bimbingan_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_bimbingan_komentar`
--
ALTER TABLE `log_bimbingan_komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_player_type`
--
ALTER TABLE `master_player_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_quest`
--
ALTER TABLE `master_quest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perihal_logs`
--
ALTER TABLE `perihal_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quest_has_player_type`
--
ALTER TABLE `quest_has_player_type`
  ADD PRIMARY KEY (`quest_id`,`player_type_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`nrp`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thread_files`
--
ALTER TABLE `thread_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thread_likes`
--
ALTER TABLE `thread_likes`
  ADD PRIMARY KEY (`thread_id`,`user_id`);

--
-- Indexes for table `thread_likes_reply`
--
ALTER TABLE `thread_likes_reply`
  ADD PRIMARY KEY (`thread_id`,`user_id`);

--
-- Indexes for table `thread_read`
--
ALTER TABLE `thread_read`
  ADD PRIMARY KEY (`thread_id`,`user_id`);

--
-- Indexes for table `thread_reply`
--
ALTER TABLE `thread_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_point`
--
ALTER TABLE `user_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_quest`
--
ALTER TABLE `user_quest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_quest_matrix`
--
ALTER TABLE `user_quest_matrix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_plan`
--
ALTER TABLE `weekly_plan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatar_images`
--
ALTER TABLE `avatar_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cluster_course`
--
ALTER TABLE `cluster_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `cluster_result`
--
ALTER TABLE `cluster_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `diskusi_folder`
--
ALTER TABLE `diskusi_folder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hexad_questions`
--
ALTER TABLE `hexad_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `log_bimbingan`
--
ALTER TABLE `log_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log_bimbingan_files`
--
ALTER TABLE `log_bimbingan_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `log_bimbingan_komentar`
--
ALTER TABLE `log_bimbingan_komentar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_player_type`
--
ALTER TABLE `master_player_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_quest`
--
ALTER TABLE `master_quest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `perihal_logs`
--
ALTER TABLE `perihal_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thread_files`
--
ALTER TABLE `thread_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `thread_reply`
--
ALTER TABLE `thread_reply`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tugas_akhir`
--
ALTER TABLE `tugas_akhir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_point`
--
ALTER TABLE `user_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_quest`
--
ALTER TABLE `user_quest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_quest_matrix`
--
ALTER TABLE `user_quest_matrix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weekly_plan`
--
ALTER TABLE `weekly_plan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
