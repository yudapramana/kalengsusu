-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: frodo-db.id.domainesia.com:3306
-- Generation Time: Sep 06, 2023 at 11:54 AM
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
-- Table structure for table `media`
--

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\TrxDataFile', 1, 'a0c3a61a-5e08-4715-b261-7c9e372859e3', 'data_file', 'Renstra Kemenag Kab. Pesisir Selatan Tahun 2020 - 2024', 'Renstra-Kemenag-Kab.-Pesisir-Selatan-Tahun-2020---2024.pdf', 'application/pdf', 'public', 'public', 16265296, '[]', '[]', '[]', '[]', 1, '2023-09-05 04:29:09', '2023-09-05 04:29:09'),
(2, 'App\\Models\\TrxDataFile', 2, '2f9def55-4d69-44ce-b10a-782af71e574c', 'data_file', 'LHKASN Kepala Kemenag Kab. Pesisir Selatan', 'LHKASN-Kepala-Kemenag-Kab.-Pesisir-Selatan.pdf', 'application/pdf', 'public', 'public', 93630, '[]', '[]', '[]', '[]', 2, '2023-09-05 04:32:19', '2023-09-05 04:32:19'),
(3, 'App\\Models\\TrxDataFile', 3, '468a9f84-8cf1-4f36-b728-e35f216cf16c', 'data_file', 'Rencana Kerja Kemenag Kab. Pesisir Selatan Tahun 2022', 'Rencana-Kerja-Kemenag-Kab.-Pesisir-Selatan-Tahun-2022.pdf', 'application/pdf', 'public', 'public', 1829207, '[]', '[]', '[]', '[]', 3, '2023-09-05 04:35:01', '2023-09-05 04:35:01'),
(4, 'App\\Models\\TrxDataFile', 4, 'a323fcf2-3867-49ce-b754-6dc462a09cda', 'data_file', 'Perjanjian Kerja Sama dengan SLB Negeri 1 Painan', 'Perjanjian-Kerja-Sama-dengan-SLB-Negeri-1-Painan.pdf', 'application/pdf', 'public', 'public', 962632, '[]', '[]', '[]', '[]', 4, '2023-09-05 04:40:39', '2023-09-05 04:40:39'),
(5, 'App\\Models\\TrxDataFile', 5, '03280a34-b3b0-40d6-83f0-44e766e18125', 'data_file', 'Standar Pelayanan dan SOP Kelompok Ramah Rentan Inklusif Tahun 2023', 'Standar-Pelayanan-dan-SOP-Kelompok-Ramah-Rentan-Inklusif-Tahun-2023.pdf', 'application/pdf', 'public', 'public', 1968743, '[]', '[]', '[]', '[]', 5, '2023-09-05 04:49:31', '2023-09-05 04:49:31'),
(6, 'App\\Models\\TrxDataFile', 6, 'c789f4bb-3e71-4042-9bc4-845bf3de4ef5', 'data_file', 'Laporan Kinerja Kakankemenag Kab. Pesisir Selatan Tahun 2022', 'Laporan-Kinerja-Kakankemenag-Kab.-Pesisir-Selatan-Tahun-2022.pdf', 'application/pdf', 'public', 'public', 8086752, '[]', '[]', '[]', '[]', 6, '2023-09-05 04:51:55', '2023-09-05 04:51:55'),
(7, 'App\\Models\\TrxDataFile', 7, 'cf6228e5-8299-4ad1-bedc-6dcfaa99861f', 'data_file', '7 Tips Keamanan Internet', '7-Tips-Keamanan-Internet.pdf', 'application/pdf', 'public', 'public', 547385, '[]', '[]', '[]', '[]', 7, '2023-09-05 05:36:25', '2023-09-05 05:36:25'),
(8, 'App\\Models\\TrxDataFile', 8, '374fd177-a188-407b-8f04-50d836d73b57', 'data_file', 'Laporan Keuangan Semester I Satker Bimas Islam Kankemenag Kab. Pessel', 'Laporan-Keuangan-Semester-I-Satker-Bimas-Islam-Kankemenag-Kab.-Pessel.pdf', 'application/pdf', 'public', 'public', 9767227, '[]', '[]', '[]', '[]', 8, '2023-09-05 07:40:29', '2023-09-05 07:40:29'),
(9, 'App\\Models\\TrxDataFile', 9, '4718e463-0978-47d9-83b7-0a04132e79b6', 'data_file', 'Laporan Keuangan Semester I 299630 Direktorat Jenderal PHU', 'Laporan-Keuangan-Semester-I-299630-Direktorat-Jenderal-PHU.pdf', 'application/pdf', 'public', 'public', 19195306, '[]', '[]', '[]', '[]', 9, '2023-09-05 07:43:55', '2023-09-05 07:43:55'),
(10, 'App\\Models\\TrxDataFile', 10, '43506ef5-7571-4c02-a449-9d41acac9daa', 'data_file', 'Laporan Pelayanan PTSP Kemenag Pessel Tahun 2022', 'Laporan-Pelayanan-PTSP-Kemenag-Pessel-Tahun-2022.pdf', 'application/pdf', 'public', 'public', 60859, '[]', '[]', '[]', '[]', 10, '2023-09-05 08:08:08', '2023-09-05 08:08:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
