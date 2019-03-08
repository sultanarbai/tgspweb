-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08 Mar 2019 pada 04.50
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nim` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `tanggal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nim`, `email`, `jurusan`, `gambar`, `tanggal`) VALUES
(15, 'king', '08221703365555', 'aku@gmail.com', 'sistem informasi', '5c807d5bc6ccd.jpg', 'Friday, 08-03-2019 07:27:43am'),
(16, 'kian', '0900', 'cat@gmail.com', 'sistem komputer', '5c8082f5329a7.jpg', 'Friday, 08-03-2019 07:28:03am'),
(17, 'mbek', '0988776', 'mbek@gmail.com', 'teknik informatika', '5c80846157abb.jpg', 'Friday, 08-03-2019 07:28:13am'),
(18, 'haha', '000000', 'haha@gmail.com', 'peternakan', '5c8084a18cd04.jpg', 'Friday, 08-03-2019 07:28:22am'),
(19, 'Wahyu ramadani', '087794', 'wahyu.cuyyy21@gmail.com', 'matematika', '5c8084fd7acf6.jpg', 'Friday, 08-03-2019 07:28:31am'),
(21, 'sultanan', '090311828345', 'sultanarbai@gmail.com', 'Sistem Informasi', '5c81a830bb9f6.jpg', 'Friday, 08-03-2019 07:27:32am'),
(22, 'kinarku', '0903748576', 'sultanarbai@gmail.com', 'Sistem Komputer', '5c81a8fecf971.jpg', '2019-03-08 06:29:24'),
(23, 'king arbai', '090909099', 'a@gmail.com', 'Sistem Komputer', '5c81aa1c66b0f.jpg', 'Friday, 08-03-2019 07:26:52am'),
(24, 'Wahyu ramadani', '08080808', 'sultanarbai@gmail.com', 'Sistem Informasi', '5c81adbee5b2d.jpg', '0000-00-00 00:00:00'),
(26, 'gggg', '0909090785', 'sultanarbai@gmail.com', 'Sistem Informasi', '5c81b14aee3a6.jpg', '0000-00-00 00:00:00'),
(27, 'Wahyu ramadani', '767577', 'wahyu.cuyyy21@gmail.com', 'Teknik Informatika', '5c81b5f3439f2.jpg', 'Friday, 08-03-2019 07:23:15am'),
(37, 'sultannnn', '09084536', 'sultanarbai@gmail.com', 'Sistem Informasi', '5c81d238f132f.jpg', 'Friday, 08-03-2019 09:23:52am'),
(38, 'sultan', '0904675', 'a@gmail.com', 'Sistem Komputer', '5c81d7915d50b.jpg', 'Friday, 08-03-2019 09:46:41am');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES
(1, 'sultan', '$2y$10$5LOHBaK7eu6k1MsH71EGteGjXQmxQds6yLIaXo3c/dXgZTzh.MSe.', ''),
(2, 'arbai', '$2y$10$kRokYL5ww81DMo3/4nGKz./1CNJzFnR5Ak2UewSOv31PSvv.kDW/K', ''),
(4, 'andi', '$2y$10$9IpfkSvt/BvaNussb8Mrxeb/EenFrra7BPF1v7FidzLsuHOIKE.q.', 'admin'),
(5, 'asd', '$2y$10$ly62N0k/AnWVJZNqaXcmvOPwXaEcgBr1fpTSjdFyPo7EoDTEnJ1AC', 'admin'),
(6, 'ucup', '$2y$10$avuS8ENNcOvRS2IcZ3hFMOLaWSN6PkcW8HU3xWW5uWcJ.fiRsPRNi', 'dosen'),
(7, 'suitan', '$2y$10$1jUqskLXIHWkBAMJWM1oUe9qgtxQiKB6KO0qz0RRg7sg7rycknqbW', 'mahasiswa'),
(8, 'root', '$2y$10$MSorGNjywzeKj6VA/WldWuR0laBSF0grXMv9krvTZBLAej8E5ZGzC', 'admin'),
(9, 'gggg', '$2y$10$lnEnphk/HWAA9FJekIAoteYpY6SSN99mihDFBTqi1uKzPs/.vldwi', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
