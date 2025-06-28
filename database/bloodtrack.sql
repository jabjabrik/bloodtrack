-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 08:17 AM
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
(1, 1, 1, '-', '+', '-', 'incompatible', NULL, '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(2, 1, 2, '-', '-', '-', 'compatible', 'transfusi', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
(1, 'KDDRH-001', 'Darah Biasa (Whole blood)', 'A', 10, 2, 435000, 435000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(2, 'KDDRH-002', 'Darah Biasa (Whole blood)', 'B', 5, 2, 440000, 440000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(3, 'KDDRH-003', 'Darah Biasa (Whole blood)', 'O', 8, 2, 440000, 440000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(4, 'KDDRH-004', 'Darah Biasa (Whole blood)', 'AB', 5, 2, 430000, 430000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(5, 'KDDRH-005', 'Packed Red Cell (PRC)', 'A', 7, 2, 450000, 450000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(6, 'KDDRH-006', 'Packed Red Cell (PRC)', 'B', 6, 2, 450000, 450000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(7, 'KDDRH-007', 'Packed Red Cell (PRC)', 'O', 9, 2, 450000, 450000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(8, 'KDDRH-008', 'Packed Red Cell (PRC)', 'AB', 4, 2, 450000, 450000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(9, 'KDDRH-009', 'Plasma', 'A', 6, 2, 400000, 400000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(10, 'KDDRH-010', 'Plasma', 'B', 5, 2, 400000, 400000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(11, 'KDDRH-011', 'Plasma', 'O', 7, 2, 400000, 400000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(12, 'KDDRH-012', 'Plasma', 'AB', 4, 2, 400000, 400000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(13, 'KDDRH-013', 'Thrombocyte', 'A', 3, 1, 470000, 470000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(14, 'KDDRH-014', 'Thrombocyte', 'B', 4, 1, 470000, 470000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(15, 'KDDRH-015', 'Thrombocyte', 'O', 5, 1, 470000, 470000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(16, 'KDDRH-016', 'Thrombocyte', 'AB', 3, 1, 470000, 470000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(17, 'KDDRH-017', 'Fresh Frozen Plasma', 'A', 8, 3, 500000, 500000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(18, 'KDDRH-018', 'Fresh Frozen Plasma', 'B', 7, 3, 500000, 500000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(19, 'KDDRH-019', 'Fresh Frozen Plasma', 'O', 9, 3, 500000, 500000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(20, 'KDDRH-020', 'Fresh Frozen Plasma', 'AB', 6, 3, 500000, 500000, '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
(1, 'KDDKTR-001', 'Dr. Andi Pratama', '081234567890', 'Jl. Merdeka No. 12, Jakarta', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(2, 'KDDKTR-002', 'Dr. Budi Santoso', '082345678901', 'Jl. Mawar No. 5, Surabaya', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(3, 'KDDKTR-003', 'Dr. Citra Wulandari', '083456789012', 'Jl. Kenanga No. 20, Bandung', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(4, 'KDDKTR-004', 'Dr. Dian Permata', '084567890123', 'Jl. Melati No. 14, Yogyakarta', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(5, 'KDDKTR-005', 'Dr. Endah Sari', '085678901234', 'Jl. Anggrek No. 7, Semarang', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
(1, 'KDKRR-001', 'Andi Setiawan', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(2, 'KDKRR-002', 'Budi Hartono', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(3, 'KDKRR-003', 'Siti Nurhaliza', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(4, 'KDKRR-004', 'Rini Pratiwi', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(5, 'KDKRR-005', 'Agus Santoso', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
(1, 'KDPSN-001', '357901230001', 'Ahmad Subekti', 'A', 'laki-laki', '1985-04-12', '081234567890', 'Jl. Merpati No. 45, Wonoasih', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(2, 'KDPSN-002', '357902340002', 'Fitri Handayani', 'B', 'perempuan', '1990-09-25', '081334567891', 'Jl. Kenanga No. 12, Bantaran', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(3, 'KDPSN-003', '357903450003', 'Siti Nur Azizah', 'O', 'perempuan', '1978-02-17', '081234578901', 'Jl. Melati No. 30, Leces', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(4, 'KDPSN-004', '357904560004', 'Budi Santoso', 'B', 'laki-laki', '1982-11-11', '081244578902', 'Jl. Mawar No. 8, Dringu', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(5, 'KDPSN-005', '357905670005', 'Lilis Kurniasari', 'O', 'perempuan', '1995-06-07', '081254578903', 'Jl. Dahlia No. 15, Sumber', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(6, 'KDPSN-006', '357906780006', 'Arif Setiawan', 'O', 'laki-laki', '1989-03-14', '081264578904', 'Jl. Anggrek No. 22, Krejengan', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(7, 'KDPSN-007', '357907890007', 'Dewi Anggraini', 'B', 'perempuan', '1975-12-05', '081274578905', 'Jl. Flamboyan No. 10, Kraksaan', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(8, 'KDPSN-008', '357908910008', 'Hasan Prasetyo', 'O', 'laki-laki', '1992-07-19', '081284578906', 'Jl. Cempaka No. 5, Maron', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(9, 'KDPSN-009', '357909120009', 'Ratna Sari Dewi', 'A', 'perempuan', '1980-10-30', '081294578907', 'Jl. Kemuning No. 18, Besuk', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(10, 'KDPSN-010', '357910330010', 'Dedi Firmansyah', 'A', 'laki-laki', '1998-01-22', '081304578908', 'Jl. Sukun No. 27, Gending', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
  `jumlah_darah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pelayanan` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id_pelayanan`, `rekam_medis`, `id_pasien`, `id_ruangan`, `id_dokter`, `diagnosa`, `jumlah_darah`, `tanggal_pelayanan`, `created_at`, `updated_at`) VALUES
(1, 'RM-001', 1, 1, 1, 'anemia', '2', '2025-06-27', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
(1, 'KDPNR-001', 'Andika Pratama', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(2, 'KDPNR-002', 'Eko Wibowo', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(3, 'KDPNR-003', 'Budi Santoso', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(4, 'KDPNR-004', 'Maya Sari', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(5, 'KDPNR-005', 'Dian Kusuma', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
(1, 'KDPNRM-001', 1, 1, 1, 1, 'A664952', '2025-06-25', '2025-06-24', '2025-07-25', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(2, 'KDPNRM-002', 1, 1, 1, 1, 'A884809', '2025-06-25', '2025-06-24', '2025-07-25', '0', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(3, 'KDPNRM-003', 1, 1, 1, 1, 'A559931', '2025-06-25', '2025-06-24', '2025-07-25', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(4, 'KDPNRM-004', 2, 2, 2, 2, 'B135888', '2025-06-26', '2025-06-25', '2025-07-26', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(5, 'KDPNRM-005', 2, 2, 2, 2, 'B723432', '2025-06-26', '2025-06-25', '2025-07-26', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(6, 'KDPNRM-006', 2, 2, 2, 2, 'B864667', '2025-06-26', '2025-06-25', '2025-07-26', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(7, 'KDPNRM-007', 3, 3, 3, 3, 'O884497', '2025-06-27', '2025-06-26', '2025-07-27', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(8, 'KDPNRM-008', 3, 3, 3, 3, 'O694143', '2025-06-27', '2025-06-26', '2025-07-27', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(9, 'KDPNRM-009', 3, 3, 3, 3, 'O531348', '2025-06-27', '2025-06-26', '2025-07-27', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
  `jabatan` enum('admin','perawat','viewer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `kode_petugas`, `nama_petugas`, `username`, `password`, `jabatan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'KDPTGS-001', 'administator', 'admin', '$2y$12$alj0GQZJ68a26UURJkQUDuurhj1hJP9NEMF9OvZ.GeQoMCKSkG9Rq', 'admin', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(2, 'KDPTGS-002', 'perawat', 'perawat', '$2y$12$cyjmJdgqcBddAUnUtJWcteYz2EYbABhQolQ3/6FgDM4CvOxRpRFk.', 'perawat', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(3, 'KDPTGS-003', 'koordinator', 'koordinator', '$2y$12$P5wMkQpQWHbumus3bHe6s..RBJpAaSxGJfuz6h2Rv/NykPF2gwoiO', 'viewer', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(4, 'KDPTGS-004', 'direktur', 'direktur', '$2y$12$sfTWU9HagjMcXIbUapF/OOBfw746ulsCCv9H2wBGALu0Kt7vsL2S2', 'viewer', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
(1, 'KDPMI-001', 'PMI Kota Surabaya', '081334278663', 'Jl. Embong Malang No.7-17, Surabaya', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(2, 'KDPMI-002', 'PMI Kabupaten Malang', '081334278663', 'Jl. Ahmad Yani No.32, Malang', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(3, 'KDPMI-003', 'PMI Kota Bandung', '081334278663', 'Jl. Aceh No.79, Bandung', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(4, 'KDPMI-004', 'PMI Kota Jakarta', '081334278663', 'Jl. Kramat Raya No.47, Jakarta Pusat', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(5, 'KDPMI-005', 'PMI Kabupaten Sleman', '081334278663', 'Jl. Magelang No.10, Sleman, Yogyakarta', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(6, 'KDPMI-006', 'PMI Kota Denpasar', '081334278663', 'Jl. Hayam Wuruk No.123, Denpasar', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(7, 'KDPMI-007', 'PMI Kabupaten Bogor', '081334278663', 'Jl. Pemuda No.25, Bogor', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(8, 'KDPMI-008', 'PMI Kota Semarang', '081334278663', 'Jl. Pandanaran No.15, Semarang', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(9, 'KDPMI-009', 'PMI Kabupaten Banyuwangi', '081334278663', 'Jl. Dr. Sutomo No.12, Banyuwangi', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(10, 'KDPMI-010', 'PMI Kota Makassar', '081334278663', 'Jl. AP Pettarani No.48, Makassar', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
(1, 'KDRNGN-001', 'Ruang Flamboyan', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(2, 'KDRNGN-002', 'Ruang Isolasi Khusus', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28'),
(3, 'KDRNGN-003', 'Ruang Dahlia', '1', '2025-06-28 06:16:28', '2025-06-28 06:16:28');

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
  MODIFY `id_crossmatch` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `darah`
--
ALTER TABLE `darah`
  MODIFY `id_darah` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id_pelayanan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penerimaan`
--
ALTER TABLE `penerimaan`
  MODIFY `id_penerimaan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
