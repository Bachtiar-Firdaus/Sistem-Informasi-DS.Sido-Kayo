-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2019 pada 15.02
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_desainyessi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hd`
--

CREATE TABLE `tbl_hd` (
  `no` int(11) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `photo` mediumtext NOT NULL,
  `judul` mediumtext NOT NULL,
  `isi` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hd`
--

INSERT INTO `tbl_hd` (`no`, `tanggal`, `photo`, `judul`, `isi`) VALUES
(4, '2019-06-06', 'afee1d25df674a88804f9dab608dcc8b.JPG', 'aa', 'daus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kd`
--

CREATE TABLE `tbl_kd` (
  `no` int(11) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `photo` mediumtext NOT NULL,
  `judul` mediumtext NOT NULL,
  `isi` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kd`
--

INSERT INTO `tbl_kd` (`no`, `tanggal`, `photo`, `judul`, `isi`) VALUES
(3, '03/06/6', '1561837208300.JPG', 'judulnya1', 'tulis isinya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_komentar`
--

CREATE TABLE `tbl_komentar` (
  `no` int(11) NOT NULL,
  `kd_komentar` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(100) NOT NULL,
  `isikomentar` varchar(500) NOT NULL,
  `photo` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order`
--

CREATE TABLE `tbl_order` (
  `no` int(11) NOT NULL,
  `id_order` mediumtext NOT NULL,
  `tanggal` mediumtext NOT NULL,
  `nama` mediumtext NOT NULL,
  `no_hp` mediumtext NOT NULL,
  `alamat` mediumtext NOT NULL,
  `produk` mediumtext NOT NULL,
  `kun` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_order`
--

INSERT INTO `tbl_order` (`no`, `id_order`, `tanggal`, `nama`, `no_hp`, `alamat`, `produk`, `kun`) VALUES
(19, 'aatbl_order', '2019-07-03', 'asu', '9779', 'asasa', 'aa', '2'),
(20, 'aatbl_order', '2019-07-05', 'asu', '9779', 'asasa', 'aa', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_saran`
--

CREATE TABLE `tbl_saran` (
  `no` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(100) NOT NULL,
  `isisaran` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_saran`
--

INSERT INTO `tbl_saran` (`no`, `tanggal`, `nama`, `isisaran`) VALUES
(15, '2019-07-02', 'daus2', '\r\ndayatganteng bangetbanget\r\n'),
(16, '2019-07-02', 'Ega Liyando', '\r\nkomentar anda masuk atau tidak ya ini aku gak yakin loh ..'),
(17, '2019-07-03', 'asu', '\r\ntes saran'),
(18, '2019-07-03', 'asu', '\r\ntes saran'),
(19, '2019-07-03', 'asu', '\r\ntes saran'),
(20, '2019-07-03', 'asu', '\r\ntes saran'),
(21, '2019-07-03', 'asu', '\r\nsadfsfd'),
(22, '2019-07-05', 'asu', '\r\nsayang amel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `no` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(10000) NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `photo` varchar(120) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`no`, `user`, `password`, `nama`, `alamat`, `nohp`, `photo`, `level`) VALUES
(3, 'admin', 'admin', 'daus1', 'daus', '09', '.jpg', 'ADMIN'),
(4, 'basing', '123', 'asu', 'asasa', '9779', 'fb06bfeb740e99e1c1a11b8ab8e36588.JPG', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_hd`
--
ALTER TABLE `tbl_hd`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tbl_kd`
--
ALTER TABLE `tbl_kd`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tbl_saran`
--
ALTER TABLE `tbl_saran`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_hd`
--
ALTER TABLE `tbl_hd`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_kd`
--
ALTER TABLE `tbl_kd`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_saran`
--
ALTER TABLE `tbl_saran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
