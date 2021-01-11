-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jul 2020 pada 18.04
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakuwon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_promo` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `position` int(8) NOT NULL DEFAULT 100
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `promo`
--

INSERT INTO `promo` (`id_promo`, `judul`, `slug`, `isi_promo`, `tgl_posting`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`, `position`) VALUES
(9, 'Amor Tower - Pakuwon Residences', 'amor-tower-pakuwon-residences', '<p>A new Icon in The Heart of Bekasi</p>', '2020-01-27', '3d00a97fad_1579844342_20191015105457_video_378.jpg', '', '', '', 3),
(20, 'Hubungi Kami', 'hubungi-kami', '', '2020-07-26', '8bc71b8328_1595766174_promo3.jpg', '', '', '', 2),
(24, 'Siap Kirim 24 Jam Jabodetabek zzzzzzzzzzz', 'siap-kirim-24-jam-jabodetabek-zzzzzzzzzzz', '<p>sd sad asd zzzzzzzzzzzz</p>', '0000-00-00', 'ce1025445e_1595777340_yG5VOP.jpg', 'Siap Kirim 24 Jam Jabodetabek', '', 'sd sad asd ', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
