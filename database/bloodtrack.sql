-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 02:23 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodtrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `crossmatch`
--

CREATE TABLE `crossmatch` (
  `id_crossmatch` bigint(20) UNSIGNED NOT NULL,
  `id_pelayanan` bigint(20) UNSIGNED NOT NULL,
  `id_penerimaan` bigint(20) UNSIGNED NOT NULL,
  `mayor` enum('+','-') COLLATE utf8mb4_unicode_ci NOT NULL,
  `minor` enum('+','-') COLLATE utf8mb4_unicode_ci NOT NULL,
  `autocontrol` enum('+','-') COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` enum('compatible','incompatible') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('transfusi','retur') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crossmatch`
--

INSERT INTO `crossmatch` (`id_crossmatch`, `id_pelayanan`, `id_penerimaan`, `mayor`, `minor`, `autocontrol`, `hasil`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '+', '+', '+', 'incompatible', NULL, '2024-12-03 12:45:11', '2024-12-03 12:45:11'),
(2, 1, 2, '-', '-', '-', 'compatible', 'retur', '2024-12-03 12:45:25', '2024-12-03 12:46:06'),
(3, 2, 1, '-', '-', '-', 'compatible', 'transfusi', '2024-12-03 12:47:27', '2024-12-03 12:47:39'),
(4, 3, 2, '-', '-', '+', 'incompatible', NULL, '2024-12-03 13:07:45', '2024-12-03 13:07:45'),
(5, 3, 4, '-', '-', '-', 'compatible', 'transfusi', '2024-12-03 13:08:13', '2024-12-03 13:09:42'),
(6, 4, 2, '-', '-', '-', 'compatible', 'retur', '2024-12-03 13:12:11', '2024-12-03 13:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `darah`
--

CREATE TABLE `darah` (
  `id_darah` bigint(20) UNSIGNED NOT NULL,
  `kode_darah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_darah` enum('Darah Biasa (Whole blood)','Packed Red Cell (PRC)','Plasma','Thrombocyte','Fresh Frozen Plasma') COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_darah` enum('A','B','O','AB') COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_maksimal` int(11) NOT NULL,
  `stok_minimal` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `darah`
--

INSERT INTO `darah` (`id_darah`, `kode_darah`, `jenis_darah`, `golongan_darah`, `stok_maksimal`, `stok_minimal`, `harga_beli`, `harga_jual`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '678315-KDDRH', 'Darah Biasa (Whole blood)', 'A', 10, 2, 435000, 435000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(2, '765913-KDDRH', 'Darah Biasa (Whole blood)', 'B', 5, 2, 440000, 440000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(3, '955542-KDDRH', 'Darah Biasa (Whole blood)', 'O', 8, 2, 440000, 440000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(4, '215928-KDDRH', 'Darah Biasa (Whole blood)', 'AB', 5, 2, 430000, 430000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(5, '328983-KDDRH', 'Packed Red Cell (PRC)', 'A', 7, 2, 450000, 450000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(6, '687689-KDDRH', 'Packed Red Cell (PRC)', 'B', 6, 2, 450000, 450000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(7, '439704-KDDRH', 'Packed Red Cell (PRC)', 'O', 9, 2, 450000, 450000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(8, '408078-KDDRH', 'Packed Red Cell (PRC)', 'AB', 4, 2, 450000, 450000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(9, '336680-KDDRH', 'Plasma', 'A', 6, 2, 400000, 400000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(10, '530653-KDDRH', 'Plasma', 'B', 5, 2, 400000, 400000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(11, '120299-KDDRH', 'Plasma', 'O', 7, 2, 400000, 400000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(12, '649248-KDDRH', 'Plasma', 'AB', 4, 2, 400000, 400000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(13, '531711-KDDRH', 'Thrombocyte', 'A', 3, 1, 470000, 470000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(14, '312860-KDDRH', 'Thrombocyte', 'B', 4, 1, 470000, 470000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(15, '232229-KDDRH', 'Thrombocyte', 'O', 5, 1, 470000, 470000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(16, '363763-KDDRH', 'Thrombocyte', 'AB', 3, 1, 470000, 470000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(17, '432460-KDDRH', 'Fresh Frozen Plasma', 'A', 8, 3, 500000, 500000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(18, '603078-KDDRH', 'Fresh Frozen Plasma', 'B', 7, 3, 500000, 500000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(19, '370661-KDDRH', 'Fresh Frozen Plasma', 'O', 9, 3, 500000, 500000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(20, '937896-KDDRH', 'Fresh Frozen Plasma', 'AB', 6, 3, 500000, 500000, '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` bigint(20) UNSIGNED NOT NULL,
  `kode_dokter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dokter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `kode_dokter`, `nama_dokter`, `no_telepon`, `alamat`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '648902-KDDKTR', 'Dr. Andi Pratama', '081234567890', 'Jl. Merdeka No. 12, Jakarta', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(2, '478224-KDDKTR', 'Dr. Budi Santoso', '082345678901', 'Jl. Mawar No. 5, Surabaya', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(3, '259182-KDDKTR', 'Dr. Citra Wulandari', '083456789012', 'Jl. Kenanga No. 20, Bandung', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(4, '498504-KDDKTR', 'Dr. Dian Permata', '084567890123', 'Jl. Melati No. 14, Yogyakarta', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(5, '620920-KDDKTR', 'Dr. Endah Sari', '085678901234', 'Jl. Anggrek No. 7, Semarang', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(6, '900738-KDDKTR', 'Dr. Fajar Ramadhan', '086789012345', 'Jl. Cemara No. 10, Medan', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(7, '321802-KDDKTR', 'Dr. Gita Larasati', '087890123456', 'Jl. Flamboyan No. 2, Malang', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(8, '951845-KDDKTR', 'Dr. Hadi Pranoto', '088901234567', 'Jl. Cendana No. 8, Palembang', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(9, '179892-KDDKTR', 'Dr. Indra Wijaya', '089012345678', 'Jl. Bambu No. 15, Denpasar', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(10, '151958-KDDKTR', 'Dr. Joko Sulistyo', '081098765432', 'Jl. Sawo No. 11, Makassar', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` bigint(20) UNSIGNED NOT NULL,
  `kode_kurir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kurir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `kode_kurir`, `nama_kurir`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '353114-KDKRR', 'Andi Setiawan', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(2, '824177-KDKRR', 'Budi Hartono', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(3, '824550-KDKRR', 'Siti Nurhaliza', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(4, '605334-KDKRR', 'Rini Pratiwi', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(5, '253500-KDKRR', 'Agus Santoso', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, 'bloodtrack', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` bigint(20) UNSIGNED NOT NULL,
  `kode_pasien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pasien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_darah` enum('A','B','O','AB') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `kode_pasien`, `nik`, `nama_pasien`, `golongan_darah`, `jenis_kelamin`, `tanggal_lahir`, `no_telepon`, `alamat`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '837283-KDPSN', '357901230001', 'Ahmad Subekti', 'A', 'laki-laki', '1985-04-12', '081234567890', 'Jl. Merpati No. 45, Wonoasih', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(2, '728743-KDPSN', '357902340002', 'Fitri Handayani', 'B', 'perempuan', '1990-09-25', '081334567891', 'Jl. Kenanga No. 12, Bantaran', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(3, '960971-KDPSN', '357903450003', 'Siti Nur Azizah', 'O', 'perempuan', '1978-02-17', '081234578901', 'Jl. Melati No. 30, Leces', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(4, '704353-KDPSN', '357904560004', 'Budi Santoso', 'B', 'laki-laki', '1982-11-11', '081244578902', 'Jl. Mawar No. 8, Dringu', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(5, '115863-KDPSN', '357905670005', 'Lilis Kurniasari', 'O', 'perempuan', '1995-06-07', '081254578903', 'Jl. Dahlia No. 15, Sumber', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(6, '976745-KDPSN', '357906780006', 'Arif Setiawan', 'O', 'laki-laki', '1989-03-14', '081264578904', 'Jl. Anggrek No. 22, Krejengan', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(7, '614302-KDPSN', '357907890007', 'Dewi Anggraini', 'B', 'perempuan', '1975-12-05', '081274578905', 'Jl. Flamboyan No. 10, Kraksaan', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(8, '664469-KDPSN', '357908910008', 'Hasan Prasetyo', 'O', 'laki-laki', '1992-07-19', '081284578906', 'Jl. Cempaka No. 5, Maron', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(9, '412676-KDPSN', '357909120009', 'Ratna Sari Dewi', 'A', 'perempuan', '1980-10-30', '081294578907', 'Jl. Kemuning No. 18, Besuk', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(10, '127200-KDPSN', '357910330010', 'Dedi Firmansyah', 'A', 'laki-laki', '1998-01-22', '081304578908', 'Jl. Sukun No. 27, Gending', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id_pelayanan` bigint(20) UNSIGNED NOT NULL,
  `rekam_medis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pasien` bigint(20) UNSIGNED NOT NULL,
  `id_ruangan` bigint(20) UNSIGNED NOT NULL,
  `id_dokter` bigint(20) UNSIGNED NOT NULL,
  `diagnosa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pelayanan` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id_pelayanan`, `rekam_medis`, `id_pasien`, `id_ruangan`, `id_dokter`, `diagnosa`, `tanggal_pelayanan`, `created_at`, `updated_at`) VALUES
(1, '759889-RM', 1, 2, 3, 'anemia', '2024-12-03', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(2, '701845-RM', 1, 1, 1, 'anemia', '2024-12-03', '2024-12-03 12:46:48', '2024-12-03 12:46:48'),
(3, '951571-RM', 9, 1, 2, 'anemia', '2024-12-03', '2024-12-03 13:06:47', '2024-12-03 13:06:47'),
(4, '634464-RM', 9, 1, 1, 'anemia', '2024-12-04', '2024-12-03 13:11:49', '2024-12-03 13:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `penerima`
--

CREATE TABLE `penerima` (
  `id_penerima` bigint(20) UNSIGNED NOT NULL,
  `kode_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penerima`
--

INSERT INTO `penerima` (`id_penerima`, `kode_penerima`, `nama_penerima`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '942088-KDPNRM', 'Andika Pratama', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(2, '137016-KDPNRM', 'Eko Wibowo', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(3, '201688-KDPNRM', 'Budi Santoso', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(4, '750895-KDPNRM', 'Maya Sari', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(5, '819179-KDPNRM', 'Dian Kusuma', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan`
--

CREATE TABLE `penerimaan` (
  `id_penerimaan` bigint(20) UNSIGNED NOT NULL,
  `kode_penerimaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_darah` bigint(20) UNSIGNED NOT NULL,
  `id_pmi` bigint(20) UNSIGNED NOT NULL,
  `id_kurir` bigint(20) UNSIGNED NOT NULL,
  `id_penerima` bigint(20) UNSIGNED NOT NULL,
  `no_kantong` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tanggal_aftap` date NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penerimaan`
--

INSERT INTO `penerimaan` (`id_penerimaan`, `kode_penerimaan`, `id_darah`, `id_pmi`, `id_kurir`, `id_penerima`, `no_kantong`, `tanggal_terima`, `tanggal_aftap`, `tanggal_kadaluarsa`, `status`, `created_at`, `updated_at`) VALUES
(1, '833537-KDPNRM', 1, 1, 1, 1, 'A369372', '2024-11-13', '2024-11-12', '2024-12-12', '0', '2024-12-03 12:45:01', '2024-12-03 12:47:39'),
(2, '150213-KDPNRM', 1, 2, 2, 2, 'A201646', '2024-11-13', '2024-11-12', '2024-12-12', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(3, '467034-KDPNRM', 5, 3, 3, 3, 'A324727', '2024-11-13', '2024-11-12', '2024-12-12', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(4, '112276-KDPNRM', 5, 4, 4, 4, 'A108912', '2024-11-13', '2024-11-12', '2024-12-12', '0', '2024-12-03 12:45:01', '2024-12-03 13:09:42'),
(5, '281158-KDPNRM', 5, 5, 5, 5, 'A202897', '2024-11-13', '2024-11-12', '2024-12-12', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(6, '207270-KDPNRM', 5, 6, 1, 1, 'A850739', '2024-11-13', '2024-11-12', '2024-12-12', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(7, '484701-KDPNRM', 5, 7, 2, 2, 'A442482', '2024-11-13', '2024-11-12', '2024-12-12', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(8, '786264-KDPNRM', 2, 7, 2, 2, 'A155348', '2024-11-13', '2024-11-12', '2024-12-12', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(9, '550471-KDPNRM', 2, 7, 2, 2, 'A383382', '2024-11-13', '2024-11-12', '2024-12-02', '1', '2024-12-03 12:45:01', '2024-12-03 13:04:22'),
(10, '573765-KDPNRM', 1, 1, 1, 1, 'A123123', '2024-12-03', '2024-11-03', '2025-01-03', '1', '2024-12-03 13:01:36', '2024-12-03 13:01:36'),
(11, '820484-KDPNRM', 1, 1, 1, 1, 'Aqweqwe', '2024-12-03', '2024-12-01', '2025-01-03', '1', '2024-12-03 13:02:42', '2024-12-03 13:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` bigint(20) UNSIGNED NOT NULL,
  `kode_petugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_petugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` enum('admin','analis','bidan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `kode_petugas`, `nama_petugas`, `username`, `password`, `jabatan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '734677-KDPTGS', 'Lailatul Choiriyah', 'laila', '$2y$10$XkmElBLSPOktM3rYaezcx.JQBRsizjdCw7PLlNFAqIi3Q49ApVhV.', 'admin', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `pmi`
--

CREATE TABLE `pmi` (
  `id_pmi` bigint(20) UNSIGNED NOT NULL,
  `kode_pmi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pmi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pmi`
--

INSERT INTO `pmi` (`id_pmi`, `kode_pmi`, `nama_pmi`, `contact_person`, `alamat`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '988859-KDPMI', 'PMI Kota Surabaya', '081334278663', 'Jl. Embong Malang No.7-17, Surabaya', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(2, '234645-KDPMI', 'PMI Kabupaten Malang', '081334278663', 'Jl. Ahmad Yani No.32, Malang', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(3, '998349-KDPMI', 'PMI Kota Bandung', '081334278663', 'Jl. Aceh No.79, Bandung', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(4, '525003-KDPMI', 'PMI Kota Jakarta', '081334278663', 'Jl. Kramat Raya No.47, Jakarta Pusat', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(5, '647402-KDPMI', 'PMI Kabupaten Sleman', '081334278663', 'Jl. Magelang No.10, Sleman, Yogyakarta', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(6, '331149-KDPMI', 'PMI Kota Denpasar', '081334278663', 'Jl. Hayam Wuruk No.123, Denpasar', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(7, '440614-KDPMI', 'PMI Kabupaten Bogor', '081334278663', 'Jl. Pemuda No.25, Bogor', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(8, '306290-KDPMI', 'PMI Kota Semarang', '081334278663', 'Jl. Pandanaran No.15, Semarang', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(9, '219604-KDPMI', 'PMI Kabupaten Banyuwangi', '081334278663', 'Jl. Dr. Sutomo No.12, Banyuwangi', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(10, '814123-KDPMI', 'PMI Kota Makassar', '081334278663', 'Jl. AP Pettarani No.48, Makassar', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` bigint(20) UNSIGNED NOT NULL,
  `kode_ruangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ruangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `kode_ruangan`, `nama_ruangan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '444514-KDRNGN', 'Ruang Flamboyan', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(2, '599643-KDRNGN', 'Ruang Isolasi Khusus', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01'),
(3, '726656-KDRNGN', 'Ruang Dahlia', '1', '2024-12-03 12:45:01', '2024-12-03 12:45:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crossmatch`
--
ALTER TABLE `crossmatch`
  ADD PRIMARY KEY (`id_crossmatch`),
  ADD KEY `crossmatch_id_pelayanan_foreign` (`id_pelayanan`),
  ADD KEY `crossmatch_id_penerimaan_foreign` (`id_penerimaan`);

--
-- Indexes for table `darah`
--
ALTER TABLE `darah`
  ADD PRIMARY KEY (`id_darah`),
  ADD UNIQUE KEY `darah_kode_darah_unique` (`kode_darah`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD UNIQUE KEY `dokter_kode_dokter_unique` (`kode_dokter`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`),
  ADD UNIQUE KEY `kurir_kode_kurir_unique` (`kode_kurir`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `pasien_kode_pasien_unique` (`kode_pasien`),
  ADD UNIQUE KEY `pasien_nik_unique` (`nik`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id_pelayanan`),
  ADD UNIQUE KEY `pelayanan_rekam_medis_unique` (`rekam_medis`),
  ADD KEY `pelayanan_id_pasien_foreign` (`id_pasien`),
  ADD KEY `pelayanan_id_ruangan_foreign` (`id_ruangan`),
  ADD KEY `pelayanan_id_dokter_foreign` (`id_dokter`);

--
-- Indexes for table `penerima`
--
ALTER TABLE `penerima`
  ADD PRIMARY KEY (`id_penerima`),
  ADD UNIQUE KEY `penerima_kode_penerima_unique` (`kode_penerima`);

--
-- Indexes for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`id_penerimaan`),
  ADD UNIQUE KEY `penerimaan_kode_penerimaan_unique` (`kode_penerimaan`),
  ADD KEY `penerimaan_id_darah_foreign` (`id_darah`),
  ADD KEY `penerimaan_id_pmi_foreign` (`id_pmi`),
  ADD KEY `penerimaan_id_kurir_foreign` (`id_kurir`),
  ADD KEY `penerimaan_id_penerima_foreign` (`id_penerima`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `petugas_kode_petugas_unique` (`kode_petugas`),
  ADD UNIQUE KEY `petugas_username_unique` (`username`);

--
-- Indexes for table `pmi`
--
ALTER TABLE `pmi`
  ADD PRIMARY KEY (`id_pmi`),
  ADD UNIQUE KEY `pmi_kode_pmi_unique` (`kode_pmi`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`),
  ADD UNIQUE KEY `ruangan_kode_ruangan_unique` (`kode_ruangan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crossmatch`
--
ALTER TABLE `crossmatch`
  MODIFY `id_crossmatch` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `darah`
--
ALTER TABLE `darah`
  MODIFY `id_darah` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id_pelayanan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penerimaan`
--
ALTER TABLE `penerimaan`
  MODIFY `id_penerimaan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pmi`
--
ALTER TABLE `pmi`
  MODIFY `id_pmi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crossmatch`
--
ALTER TABLE `crossmatch`
  ADD CONSTRAINT `crossmatch_id_pelayanan_foreign` FOREIGN KEY (`id_pelayanan`) REFERENCES `pelayanan` (`id_pelayanan`),
  ADD CONSTRAINT `crossmatch_id_penerimaan_foreign` FOREIGN KEY (`id_penerimaan`) REFERENCES `penerimaan` (`id_penerimaan`);

--
-- Constraints for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD CONSTRAINT `pelayanan_id_dokter_foreign` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`),
  ADD CONSTRAINT `pelayanan_id_pasien_foreign` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `pelayanan_id_ruangan_foreign` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`);

--
-- Constraints for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD CONSTRAINT `penerimaan_id_darah_foreign` FOREIGN KEY (`id_darah`) REFERENCES `darah` (`id_darah`),
  ADD CONSTRAINT `penerimaan_id_kurir_foreign` FOREIGN KEY (`id_kurir`) REFERENCES `kurir` (`id_kurir`),
  ADD CONSTRAINT `penerimaan_id_penerima_foreign` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`),
  ADD CONSTRAINT `penerimaan_id_pmi_foreign` FOREIGN KEY (`id_pmi`) REFERENCES `pmi` (`id_pmi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
