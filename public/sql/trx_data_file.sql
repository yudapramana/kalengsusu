-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: frodo-db.id.domainesia.com:3306
-- Generation Time: Sep 06, 2023 at 11:55 AM
-- Server version: 10.6.11-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kemena10_ppid`
--

-- --------------------------------------------------------

--
-- Table structure for table `trx_data_file`
--

--
-- Dumping data for table `trx_data_file`
--

INSERT INTO `trx_data_file` (`id_data_file`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `id_data_instansi`, `id_data_kategori`, `id_data_klasifikasi`, `id_data_sub_klasifikasi`, `nama_file`, `ext`, `url_file`, `tags`, `keterangan`, `hits`, `download`, `tahun`, `tempat`, `penanggung_jawab`, `akses`, `status`, `bentuk`) VALUES
(1, '2023-09-05 04:29:08', '2023-09-06 03:09:46', NULL, 'yudapramana', '', 1, 11, 2, 8, 'Renstra Kemenag Kab. Pesisir Selatan Tahun 2020 - 2024', 'pdf', 'https://ppid.kemenagpessel.com/storage/1/Renstra-Kemenag-Kab.-Pesisir-Selatan-Tahun-2020---2024.pdf', NULL, 'Rencana Strategis Kementerian Agama Kabupaten Pesisir Selatan Tahun 2020 - 2024', 8, 0, 2020, 'Painan', 'Kepala', 'private', 'publish', 'online'),
(2, '2023-09-05 04:32:19', '2023-09-06 03:39:46', NULL, 'yudapramana', '', 1, 2, 4, 3, 'LHKASN Kepala Kemenag Kab. Pesisir Selatan', 'pdf', 'https://ppid.kemenagpessel.com/storage/2/LHKASN-Kepala-Kemenag-Kab.-Pesisir-Selatan.pdf', NULL, 'Laporan Harta Kekayaan ASN Kepala Kantor Kantor Wilayah Kementerian Agama Prov. Sumatera Barat Tahun 2022', 4, 0, 2022, 'Painan', 'Kepala', 'private', 'publish', 'online'),
(3, '2023-09-05 04:35:01', '2023-09-05 05:07:32', NULL, 'yudapramana', '', 1, 11, 2, 8, 'Rencana Kerja Kemenag Kab. Pesisir Selatan Tahun 2022', 'pdf', 'https://ppid.kemenagpessel.com/storage/3/Rencana-Kerja-Kemenag-Kab.-Pesisir-Selatan-Tahun-2022.pdf', NULL, 'Rencana Kerja Kemenag Kab. Pesisir Selatan Tahun 2022', 2, 0, 2022, 'Painan', 'Kepala', 'private', 'publish', 'online'),
(4, '2023-09-05 04:40:39', '2023-09-06 03:35:39', NULL, 'yudapramana', '', 1, 2, 2, 9, 'Perjanjian Kerja Sama dengan SLB Negeri 1 Painan', 'pdf', 'https://ppid.kemenagpessel.com/storage/4/Perjanjian-Kerja-Sama-dengan-SLB-Negeri-1-Painan.pdf', NULL, 'Perjanjian Kerja Sama dengan SLB Negeri 1 Painan', 7, 0, 2023, 'Painan', 'Kepala', 'public', 'publish', 'cetak'),
(5, '2023-09-05 04:49:30', '2023-09-05 06:45:59', NULL, 'yudapramana', '', 1, 2, 2, 1, 'Standar Pelayanan dan SOP Kelompok Ramah Rentan Inklusif Tahun 2023', 'pdf', 'https://ppid.kemenagpessel.com/storage/5/Standar-Pelayanan-dan-SOP-Kelompok-Ramah-Rentan-Inklusif-Tahun-2023.pdf', NULL, 'Standar Pelayanan dan SOP Kelompok Ramah Rentan Inklusif Tahun 2023', 4, 1, 2023, 'Painan', 'Kepala', 'public', 'publish', 'online'),
(6, '2023-09-05 04:51:55', '2023-09-05 05:28:06', NULL, 'yudapramana', '', 1, 2, 1, 2, 'Laporan Kinerja Kakankemenag Kab. Pesisir Selatan Tahun 2022', 'pdf', 'https://ppid.kemenagpessel.com/storage/6/Laporan-Kinerja-Kakankemenag-Kab.-Pesisir-Selatan-Tahun-2022.pdf', NULL, 'Laporan Kinerja Kepala Kantor Kementerian Agama Kabupaten Pesisir Selatan Tahun 2022', 0, 0, 2022, 'Painan', 'Kepala', 'private', 'publish', 'online'),
(7, '2023-09-05 05:36:25', '2023-09-05 05:36:37', NULL, 'yudapramana', '', 1, 1, 3, 11, '7 Tips Keamanan Internet', 'pdf', 'https://ppid.kemenagpessel.com/storage/7/7-Tips-Keamanan-Internet.pdf', NULL, '7 Tips Keamanan Internet', 0, 0, 2022, 'Painan', 'Kepala', 'public', 'publish', 'online'),
(8, '2023-09-05 07:40:29', '2023-09-05 07:40:29', NULL, 'yudapramana', '', 3, 2, 1, 3, 'Laporan Keuangan Semester I Satker Bimas Islam Kankemenag Kab. Pessel', 'pdf', 'https://ppid.kemenagpessel.com/storage/8/Laporan-Keuangan-Semester-I-Satker-Bimas-Islam-Kankemenag-Kab.-Pessel.pdf', NULL, 'Laporan Keuangan Semester I 299628 (Satker Bimas Islam Kankemenag Kab. Pessel)', 0, 0, 2022, 'Painan', 'Kepala', 'private', 'draft', 'online'),
(9, '2023-09-05 07:43:55', '2023-09-05 07:43:55', NULL, 'yudapramana', '', 3, 2, 1, 3, 'Laporan Keuangan Semester I 299630 Direktorat Jenderal PHU', 'pdf', 'https://ppid.kemenagpessel.com/storage/9/Laporan-Keuangan-Semester-I-299630-Direktorat-Jenderal-PHU.pdf', NULL, 'Laporan Keuangan Semester I 299630 Direktorat Jenderal PHU', 0, 0, 2023, 'Painan', 'Kepala', 'public', 'draft', 'cetak'),
(10, '2023-09-05 08:08:08', '2023-09-06 00:28:55', NULL, 'yudapramana', '', 1, 2, 1, 1, 'Laporan Pelayanan PTSP Kemenag Pessel Tahun 2022', 'pdf', 'https://ppid.kemenagpessel.com/storage/10/Laporan-Pelayanan-PTSP-Kemenag-Pessel-Tahun-2022.pdf', NULL, 'Laporan Pelayanan PTSP Kementerian Agama Kabupaten Pesisir Selatan Tahun 2022', 4, 0, 2022, 'Painan', 'Kepala', 'public', 'draft', 'online');

--
-- Indexes for dumped tables
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
