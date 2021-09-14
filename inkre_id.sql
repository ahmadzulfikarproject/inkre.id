-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Sep 2021 pada 06.21
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inkre.id`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `absen_id` int(11) NOT NULL,
  `absen_pin` int(11) DEFAULT NULL,
  `absen_nip` int(10) DEFAULT NULL,
  `absen_kode_absen` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  `absen_status` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `absen_jam_kerja` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `absen_date` datetime DEFAULT NULL,
  `absen_masuk` datetime DEFAULT NULL,
  `absen_pulang` datetime DEFAULT NULL,
  `absen_keterangan` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `tgl_posting` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_jam_kerja`
--

CREATE TABLE `absen_jam_kerja` (
  `id_absen_jam_kerja` int(5) NOT NULL,
  `name_jam_kerja` varchar(100) NOT NULL,
  `tgl_posting` datetime NOT NULL DEFAULT current_timestamp(),
  `position` int(8) NOT NULL DEFAULT 100,
  `slug` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absen_jam_kerja`
--

INSERT INTO `absen_jam_kerja` (`id_absen_jam_kerja`, `name_jam_kerja`, `tgl_posting`, `position`, `slug`) VALUES
(1, 'non shift', '2018-12-06 15:44:44', 100, 'non-shift'),
(2, 'Cuti Istri Melahirkan Cuti Khusus', '2018-12-06 15:44:55', 100, 'cuti-istri-melahirkan-cuti-khusus'),
(3, 'Cuti Hamil Cuti Khusus', '2018-12-06 15:45:11', 100, 'cuti-hamil-cuti-khusus'),
(4, 'shift2', '2018-12-06 15:45:19', 100, 'shift2'),
(5, 'shift3', '2018-12-06 15:45:20', 100, 'shift3'),
(6, 'shift1', '2018-12-06 15:45:20', 100, 'shift1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_status`
--

CREATE TABLE `absen_status` (
  `id_absen_status` int(11) NOT NULL,
  `kode_absen_status` varchar(20) NOT NULL,
  `name_absen_status` varchar(100) NOT NULL,
  `tgl_posting` datetime NOT NULL DEFAULT current_timestamp(),
  `position` int(8) NOT NULL DEFAULT 100
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absen_status`
--

INSERT INTO `absen_status` (`id_absen_status`, `kode_absen_status`, `name_absen_status`, `tgl_posting`, `position`) VALUES
(1, '-1', 'Hadir', '0000-00-00 00:00:00', 0),
(2, '0', 'Tidak Hadir', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `adjacency_groups`
--

CREATE TABLE `adjacency_groups` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `adjacency_groups`
--

INSERT INTO `adjacency_groups` (`id`, `name`, `slug`) VALUES
(2, 'menuutama', 'menuutama'),
(3, 'Top Menu', 'top-menu'),
(4, 'Admin', 'admin'),
(5, 'products', 'products'),
(6, 'All Products', 'all-products'),
(7, 'products', 'products');

-- --------------------------------------------------------

--
-- Struktur dari tabel `adjacency_lists`
--

CREATE TABLE `adjacency_lists` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` mediumint(8) UNSIGNED NOT NULL DEFAULT 100,
  `parent_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` smallint(4) UNSIGNED NOT NULL,
  `icon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `adjacency_lists`
--

INSERT INTO `adjacency_lists` (`id`, `name`, `url`, `position`, `parent_id`, `group_id`, `icon`, `level`, `code`) VALUES
(12, 'Home', 'http://localhost/inkre.id/', 1, 0, 2, 'fa-list', 'manager', ''),
(13, 'About', 'page/detail/about-us', 2, 0, 2, 'fa-plus-circle', 'manager', ''),
(24, 'Contact us', 'contact', 14, 0, 2, 'fa-plus-circle', 'manager', ''),
(25, 'Update', 'berita', 13, 0, 2, 'fa-list', 'manager', ''),
(29, 'Home', 'http://localhost/alphajayatehnik.co.id/', 100, 0, 3, '', '', ''),
(30, 'About Us', 'page/detail/profil-perusahaan', 100, 0, 3, '', '', ''),
(31, 'Contact', 'contact/detail/multi-jaya-diesel', 100, 0, 3, 'fa-plus-circle', '', ''),
(32, 'Schedules', 'schedules', 100, 0, 3, '', '', ''),
(33, 'Navigation', 'navigation', 9, 0, 4, 'fa-bars', 'admin', ''),
(40, 'Latest News', 'news', 7, 0, 4, 'fa-newspaper', 'manager', 'berita'),
(42, 'Setting Website', 'settings', 11, 0, 4, 'fa-sliders-h', 'manager', ''),
(43, 'Contact us', 'contacts/edit_contact/1', 8, 0, 4, 'fa-phone', 'manager', ''),
(45, 'Pages', 'pages', 12, 0, 4, 'fa-file-alt', 'manager', 'page'),
(46, 'Dashboard', 'dashboard', 1, 0, 4, 'fa-tachometer', 'manager', ''),
(48, 'Pesan Masuk', 'data', 15, 0, 4, 'fa-envelope-open', 'manager', 'enquiry'),
(49, 'Slide', 'slide', 13, 0, 4, 'fa-image', 'manager', 'slide'),
(50, 'Clients', 'clients', 6, 0, 4, 'fa-address-card', 'manager', 'clients'),
(57, 'Categories', 'categories', 10, 0, 4, 'fa-plus-circle', 'admin', ''),
(59, 'Services', 'services', 11, 0, 2, 'fa-list', 'manager', ''),
(61, 'Services', 'services', 5, 0, 4, 'fa-cogs', 'manager', 'services'),
(82, 'Projects', 'projects', 4, 0, 4, 'fa-list-alt', 'manager', 'projects'),
(85, 'Menu', 'navigation/view/menuutama', 14, 0, 4, 'fa-bars', 'manager', ''),
(102, 'Profile', 'pages/edit_pages/1', 2, 0, 4, 'fa-list', 'manager', ''),
(108, 'Store', '#', 16, 0, 4, 'fa-list-alt', 'manager', ''),
(115, 'Projects', 'projects', 10, 0, 2, 'fa-list-alt', 'manager', ''),
(117, 'Clients', 'clients', 12, 0, 2, 'fa-list-alt', 'manager', ''),
(118, 'Products', 'Products', 3, 0, 4, 'fa-list-alt', 'manager', ''),
(119, 'Products', '#', 3, 0, 2, 'fa-list-alt', 'manager', ''),
(120, 'Tiang PJU', 'products/categories/tiang-pju', 5, 119, 2, 'fa-list-alt', 'manager', ''),
(121, 'Lampu PJU', 'products/categories/lampu-pju', 6, 119, 2, 'fa-list-alt', 'manager', ''),
(122, 'Jasa Instalasi', 'products/categories/jasa-instalasi', 7, 119, 2, 'fa-list-alt', 'manager', ''),
(123, 'Security System', 'products/categories/security-system', 8, 119, 2, 'fa-list-alt', 'manager', ''),
(124, 'Solar Tracker', 'products/categories/solar-tracker', 9, 119, 2, 'fa-list-alt', 'manager', ''),
(125, 'Semua Produk', 'products', 4, 119, 2, 'fa-list-alt', 'manager', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(5) NOT NULL,
  `tema` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tema_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_agenda` text COLLATE latin1_general_ci NOT NULL,
  `tempat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pengirim` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tgl_posting` date NOT NULL,
  `jam` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `id_album` int(5) NOT NULL,
  `jdl_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `album_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gbr_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`id_album`, `jdl_album`, `album_seo`, `gbr_album`, `aktif`) VALUES
(21, 'Kartun', 'kartun', '476928sonic.jpg', ''),
(20, 'Pernikahan', 'pernikahan', '146667nikah.jpg', 'Y'),
(18, 'Bayi', 'bayi', '246551silvestree.jpg', 'Y'),
(12, 'Ilustrator', 'ilustrator', '987701family.jpg', 'Y'),
(19, 'Binatang', 'binatang', '391479burung.jpg', 'Y'),
(17, 'Arsitektur', 'arsitektur', '741638arche090.jpg', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `attachment`
--

CREATE TABLE `attachment` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `post_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `attachment`
--

INSERT INTO `attachment` (`id`, `id_post`, `file_name`, `uploaded_on`, `status`, `post_type`) VALUES
(6, 27, 'catalog_product.pdf', '2018-09-12 11:30:29', '1', 'products');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banner`
--

CREATE TABLE `banner` (
  `id_banner` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `banner`
--

INSERT INTO `banner` (`id_banner`, `judul`, `url`, `gambar`, `tgl_posting`) VALUES
(4, 'Fresh Book', 'https://members.phpmu.com', 'banner2.jpg', '2009-02-05'),
(7, 'Cinema 21', 'https://members.phpmu.com', 'banner.png', '2008-02-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_tag` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `judul` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `slug` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `judul_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `headline` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `isi_berita` text COLLATE latin1_general_ci DEFAULT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `jam` time NOT NULL,
  `gambar` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `dibaca` int(5) DEFAULT NULL,
  `berita_views` int(11) DEFAULT 0,
  `tag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `meta_title` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `meta_keywords` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `meta_description` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `id_categories` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita_tagmap`
--

CREATE TABLE `berita_tagmap` (
  `id_tagmap` int(5) NOT NULL,
  `tags_id` int(5) NOT NULL,
  `id_berita` int(5) NOT NULL,
  `post_type` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita_tagmap`
--

INSERT INTO `berita_tagmap` (`id_tagmap`, `tags_id`, `id_berita`, `post_type`) VALUES
(1, 2, 16, 'berita');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita_tags`
--

CREATE TABLE `berita_tags` (
  `tags_id` int(5) NOT NULL,
  `tags_title` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tags_description` text DEFAULT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita_tags`
--

INSERT INTO `berita_tags` (`tags_id`, `tags_title`, `slug`, `updated_at`, `created_at`, `tags_description`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, '', '0', '2019-05-01 07:38:00', '2019-05-01 21:38:00', NULL, '', '', '', ''),
(2, 'sewa genset di jakarta', 'sewa-genset-di-jakarta', '2019-05-08 10:13:28', '2019-05-09 00:13:28', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(5) NOT NULL,
  `name_cabang` varchar(100) NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_cabang` text NOT NULL,
  `tgl_posting` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(100) NOT NULL,
  `position` int(8) NOT NULL DEFAULT 100
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `name_cabang`, `slug`, `isi_cabang`, `tgl_posting`, `gambar`, `position`) VALUES
(1, '', '0', '', '2018-12-06 13:23:05', '', 100),
(2, '\0$\0\0Operator', 'operator', '', '2018-12-06 13:23:06', '', 100),
(3, '\02\0\0\0\0', '2', '', '2018-12-06 13:23:06', '', 100),
(4, '\0$\0\0Manager', 'manager', '', '2018-12-06 13:23:07', '', 100),
(5, 'Bekasi', 'bekasi', '', '2018-12-06 13:37:29', '', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories_groups`
--

CREATE TABLE `categories_groups` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `categories_groups`
--

INSERT INTO `categories_groups` (`id`, `name`, `slug`) VALUES
(5, 'products', 'products'),
(6, 'Services', 'services'),
(7, 'Projects', 'projects'),
(8, 'clients', 'clients'),
(9, 'Berita', 'berita'),
(10, 'Gallery', 'gallery'),
(11, 'sertifikat', 'sertifikat'),
(12, 'departement', 'departement'),
(13, 'Jabatan', 'jabatan'),
(14, 'Pendidikan', 'pendidikan'),
(15, 'Jenis Kelamin', 'jenis-kelamin'),
(16, 'Agama', 'agama'),
(17, 'Status Karyawan', 'status-karyawan'),
(18, 'Histori Promosi', 'histori-promosi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories_lists`
--

CREATE TABLE `categories_lists` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `position` mediumint(8) UNSIGNED NOT NULL DEFAULT 100,
  `parent_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` smallint(4) UNSIGNED NOT NULL,
  `icon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `categories_lists`
--

INSERT INTO `categories_lists` (`id`, `name`, `slug`, `position`, `parent_id`, `group_id`, `icon`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(8, 'Tiang PJU', 'tiang-pju', 100, 0, 5, 'fa-list-alt', '', '', '', ''),
(9, 'Lampu PJU', 'lampu-pju', 100, 0, 5, 'fa-list-alt', '', '', '', ''),
(10, 'Jasa Instalasi', 'jasa-instalasi', 100, 0, 5, 'fa-list-alt', '', '', '', ''),
(11, 'Security System', 'security-system', 100, 0, 5, 'fa-list-alt', '', '', '', ''),
(12, 'Solar Tracker', 'solar-tracker', 100, 0, 5, 'fa-list-alt', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `catmap`
--

CREATE TABLE `catmap` (
  `id_catmap` int(5) NOT NULL,
  `categories_id` int(5) NOT NULL,
  `id_post` int(5) NOT NULL,
  `post_type` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `chapter`
--

CREATE TABLE `chapter` (
  `chapter_id` int(7) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text DEFAULT NULL,
  `subject_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `chapter`
--

INSERT INTO `chapter` (`chapter_id`, `name`, `description`, `subject_id`) VALUES
(1, 'Perusahaan dan alamat', NULL, 0),
(2, 'Produk CMP', NULL, 0),
(3, 'Layanan', NULL, 0),
(4, 'Aspek K3L', NULL, 0),
(5, 'Lain-lain', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `client`
--

CREATE TABLE `client` (
  `id_client` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_client` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `client`
--

INSERT INTO `client` (`id_client`, `judul`, `slug`, `isi_client`, `tgl_posting`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(20, 'Bostik - alpha Jaya Tehnik', 'bostik-alpha-jaya-tehnik', '', '2018-07-11', '29962058b3_1531300421_bostik_alpha_jaya_tehnik.png', '', '', ''),
(19, 'Basf Waterproofing_alpha Jaya Tehnik', 'basf-waterproofing_alpha-jaya-tehnik', '', '2018-07-11', '426bce2c34_1531300176_basf_waterproofing_alpha_jaya_tehnik.JPG', '', '', ''),
(21, 'Fosrog waterproofing  - alpha jaya tehnik', 'fosrog-waterproofing-alpha-jaya-tehnik', '', '2018-07-11', '8bdac4b7d1_1531300541_fosrog_waterproofing__alpha_jaya_tehnik.JPG', '', '', ''),
(23, 'Mapei waterproofing _alpha jaya tehnik', 'mapei-waterproofing-_alpha-jaya-tehnik', '', '2018-07-11', '816b7232e7_1531300609_mapei_waterproofing__alpha_jaya_tehnik.JPG', '', '', ''),
(24, 'Sika_alpha jaya tehnik', 'sika_alpha-jaya-tehnik', '', '2018-07-11', '5f1768d54f_1531300677_sika_alpha_jaya_tehnik.png', '', '', ''),
(25, 'Ultrachem waterproofing', 'ultrachem-waterproofing', '', '2018-07-11', 'acd1964ad3_1531300703_ultrachem_waterproofing.JPG', '', '', ''),
(26, 'Waterproofing Casali_alpha jaya tehnik', 'waterproofing-casali_alpha-jaya-tehnik', '', '2018-07-11', '24d209baa0_1531300724_waterproofing_casali_alpha_jaya_tehnik.JPG', '', '', ''),
(27, 'Waterproofing Pentens_alpha jaya tehnik', 'waterproofing-pentens_alpha-jaya-tehnik', '', '2018-08-25', 'e8364013e0_1535202348_IMG-20180423-WA0018.jpg', '', '', ''),
(28, 'Injeksi PU', 'injeksi-pu', '<p>sdasdad</p>', '2018-08-25', '73191c2871_1535202365_IMG-20180423-WA0022.jpg', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `clients`
--

CREATE TABLE `clients` (
  `id_clients` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_tag` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id_brand` int(5) NOT NULL,
  `judul` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_clients` text CHARACTER SET utf8 DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `meta_description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `clients_views` int(11) DEFAULT 1,
  `username` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `price` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_categories` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `clients_tagmap`
--

CREATE TABLE `clients_tagmap` (
  `id_tagmap` int(5) NOT NULL,
  `tags_id` int(5) NOT NULL,
  `id_clients` int(5) NOT NULL,
  `post_type` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `clients_tags`
--

CREATE TABLE `clients_tags` (
  `tags_id` int(5) NOT NULL,
  `tags_title` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tags_description` text DEFAULT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 NOT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `info` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `wa` varchar(100) DEFAULT NULL,
  `fb` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `ig` varchar(100) DEFAULT NULL,
  `gplus` varchar(100) DEFAULT NULL,
  `lin` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`id_contact`, `nama`, `slug`, `alamat`, `phone`, `mobile`, `fax`, `email`, `link`, `lokasi`, `info`, `tgl_posting`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`, `wa`, `fb`, `twitter`, `ig`, `gplus`, `lin`) VALUES
(1, ' PT Inter Nusa Kreasindo', 'pt-inter-nusa-kreasindo', '<p>Jl. Raya Pondok Rajeg, Ruko Multazam No. 5 Rt. 03 Rw. 03 Cibinong Kab. Bogor Jawa Barat Kode POS 16914</p>', '082211333714', '0812-9339-8093', '', 'info@inkre.id,anwar.benyas@gmail.com', '', '-6.108126, 106.988767', '', '2021-09-13', 'fac99418db_1631525188_pju.jpg', '', '', '', '0812-9339-8093', '', '', '', 'https://www.youtube.com/', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `course_id` int(4) NOT NULL,
  `year` varchar(4) NOT NULL DEFAULT '',
  `pwd` varchar(20) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`course_id`, `year`, `pwd`, `visible`, `status`) VALUES
(1, '2005', NULL, 1, 'ok'),
(2, '2009', 'sdsds', 1, 'dsdsd'),
(3, '2007', 'sdsds', 1, 'dsdsd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `address` varchar(50) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `country` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `FirstName`, `LastName`, `phone`, `address`, `city`, `country`) VALUES
(1, 'Carine ', 'Schmitt', '40.32.2555', '54, rue Royale', 'Nantes', 'France'),
(2, 'Jean', 'King', '7025551838', '8489 Strong St.', 'Las Vegas', 'USA'),
(3, 'Peter', 'Ferguson', '03 9520 4555', '636 St Kilda Road', 'Melbourne', 'Australia'),
(4, 'Janine ', 'Labrune', '40.67.8555', '67, rue des Cinquante Otages', 'Nantes', 'France'),
(5, 'Jonas ', 'Bergulfsen', '07-98 9555', 'Erling Skakkes gate 78', 'Stavern', 'Norway'),
(6, 'Susan', 'Nelson', '4155551450', '5677 Strong St.', 'San Rafael', 'USA'),
(7, 'Zbyszek ', 'Piestrzeniewicz', '(26) 642-7555', 'ul. Filtrowa 68', 'Warszawa', 'Poland'),
(8, 'Roland', 'Keitel', '+49 69 66 90 2555', 'Lyonerstr. 34', 'Frankfurt', 'Germany'),
(9, 'Julie', 'Murphy', '6505555787', '5557 North Pendale Street', 'San Francisco', 'USA'),
(10, 'Kwai', 'Lee', '2125557818', '897 Long Airport Avenue', 'NYC', 'USA'),
(11, 'Diego ', 'Freyre', '(91) 555 94 44', 'C/ Moralzarzal, 86', 'Madrid', 'Spain'),
(12, 'Christina ', 'Berglund', '0921-12 3555', 'Berguvsvägen  8', 'Luleå', 'Sweden'),
(13, 'Jytte ', 'Petersen', '31 12 3555', 'Vinbæltet 34', 'Kobenhavn', 'Denmark'),
(14, 'Mary ', 'Saveley', '78.32.5555', '2, rue du Commerce', 'Lyon', 'France'),
(15, 'Eric', 'Natividad', '+65 221 7555', 'Bronz Sok.', 'Singapore', 'Singapore'),
(16, 'Jeff', 'Young', '2125557413', '4092 Furth Circle', 'NYC', 'USA'),
(17, 'Kelvin', 'Leong', '2155551555', '7586 Pompton St.', 'Allentown', 'USA'),
(18, 'Juri', 'Hashimoto', '6505556809', '9408 Furth Circle', 'Burlingame', 'USA'),
(19, 'Wendy', 'Victorino', '+65 224 1555', '106 Linden Road Sandown', 'Singapore', 'Singapore'),
(20, 'Veysel', 'Oeztan', '+47 2267 3215', 'Brehmen St. 121', 'Bergen', 'Norway  '),
(21, 'Keith', 'Franco', '2035557845', '149 Spinnaker Dr.', 'New Haven', 'USA'),
(22, 'Isabel ', 'de Castro', '(1) 356-5555', 'Estrada da saúde n. 58', 'Lisboa', 'Portugal'),
(23, 'Martine ', 'Rancé', '20.16.1555', '184, chaussée de Tournai', 'Lille', 'France'),
(24, 'Marie', 'Bertrand', '(1) 42.34.2555', '265, boulevard Charonne', 'Paris', 'France'),
(25, 'Jerry', 'Tseng', '6175555555', '4658 Baden Av.', 'Cambridge', 'USA'),
(26, 'Julie', 'King', '2035552570', '25593 South Bay Ln.', 'Bridgewater', 'USA'),
(27, 'Mory', 'Kentary', '+81 06 6342 5555', '1-6-20 Dojima', 'Kita-ku', 'Japan'),
(28, 'Michael', 'Frick', '2125551500', '2678 Kingston Rd.', 'NYC', 'USA'),
(29, 'Matti', 'Karttunen', '90-224 8555', 'Keskuskatu 45', 'Helsinki', 'Finland'),
(30, 'Rachel', 'Ashworth', '(171) 555-1555', 'Fauntleroy Circus', 'Manchester', 'UK'),
(31, 'Dean', 'Cassidy', '+353 1862 1555', '25 Maiden Lane', 'Dublin', 'Ireland'),
(32, 'Leslie', 'Taylor', '6175558428', '16780 Pompton St.', 'Brickhaven', 'USA'),
(33, 'Elizabeth', 'Devon', '(171) 555-2282', '12, Berkeley Gardens Blvd', 'Liverpool', 'UK'),
(34, 'Yoshi ', 'Tamuri', '(604) 555-3392', '1900 Oak St.', 'Vancouver', 'Canada'),
(35, 'Miguel', 'Barajas', '6175557555', '7635 Spinnaker Dr.', 'Brickhaven', 'USA'),
(36, 'Julie', 'Young', '6265557265', '78934 Hillside Dr.', 'Pasadena', 'USA'),
(37, 'Brydey', 'Walker', '+612 9411 1555', 'Suntec Tower Three', 'Singapore', 'Singapore'),
(38, 'Frédérique ', 'Citeaux', '88.60.1555', '24, place Kléber', 'Strasbourg', 'France'),
(39, 'Mike', 'Gao', '+852 2251 1555', 'Bank of China Tower', 'Central Hong Kong', 'Hong Kong'),
(40, 'Eduardo ', 'Saavedra', '(93) 203 4555', 'Rambla de Cataluña, 23', 'Barcelona', 'Spain'),
(41, 'Mary', 'Young', '3105552373', '4097 Douglas Av.', 'Glendale', 'USA'),
(42, 'Horst ', 'Kloss', '0372-555188', 'Taucherstraße 10', 'Cunewalde', 'Germany'),
(43, 'Palle', 'Ibsen', '86 21 3555', 'Smagsloget 45', 'Århus', 'Denmark'),
(44, 'Jean ', 'Fresnière', '(514) 555-8054', '43 rue St. Laurent', 'Montréal', 'Canada'),
(45, 'Alejandra ', 'Camino', '(91) 745 6555', 'Gran Vía, 1', 'Madrid', 'Spain'),
(46, 'Valarie', 'Thompson', '7605558146', '361 Furth Circle', 'San Diego', 'USA'),
(47, 'Helen ', 'Bennett', '(198) 555-8888', 'Garden House', 'Cowes', 'UK'),
(48, 'Annette ', 'Roulet', '61.77.6555', '1 rue Alsace-Lorraine', 'Toulouse', 'France'),
(49, 'Renate ', 'Messner', '069-0555984', 'Magazinweg 7', 'Frankfurt', 'Germany'),
(50, 'Paolo ', 'Accorti', '011-4988555', 'Via Monte Bianco 34', 'Torino', 'Italy'),
(51, 'Daniel', 'Da Silva', '+33 1 46 62 7555', '27 rue du Colonel Pierre Avia', 'Paris', 'France'),
(52, 'Daniel ', 'Tonini', '30.59.8555', '67, avenue de l\'Europe', 'Versailles', 'France'),
(53, 'Henriette ', 'Pfalzheim', '0221-5554327', 'Mehrheimerstr. 369', 'Köln', 'Germany'),
(54, 'Elizabeth ', 'Lincoln', '(604) 555-4555', '23 Tsawassen Blvd.', 'Tsawassen', 'Canada'),
(55, 'Peter ', 'Franken', '089-0877555', 'Berliner Platz 43', 'München', 'Germany'),
(56, 'Anna', 'O\'Hara', '02 9936 8555', '201 Miller Street', 'North Sydney', 'Australia'),
(57, 'Giovanni ', 'Rovelli', '035-640555', 'Via Ludovico il Moro 22', 'Bergamo', 'Italy'),
(58, 'Adrian', 'Huxley', '+61 2 9495 8555', 'Monitor Money Building', 'Chatswood', 'Australia'),
(59, 'Marta', 'Hernandez', '6175558555', '39323 Spinnaker Dr.', 'Cambridge', 'USA'),
(60, 'Ed', 'Harrison', '+41 26 425 50 01', 'Rte des Arsenaux 41 ', 'Fribourg', 'Switzerland'),
(61, 'Mihael', 'Holz', '0897-034555', 'Grenzacherweg 237', 'Genève', 'Switzerland'),
(62, 'Jan', 'Klaeboe', '+47 2212 1555', 'Drammensveien 126A', 'Oslo', 'Norway  '),
(63, 'Bradley', 'Schuyler', '+31 20 491 9555', 'Kingsfordweg 151', 'Amsterdam', 'Netherlands'),
(64, 'Mel', 'Andersen', '030-0074555', 'Obere Str. 57', 'Berlin', 'Germany'),
(65, 'Pirkko', 'Koskitalo', '981-443655', 'Torikatu 38', 'Oulu', 'Finland'),
(66, 'Catherine ', 'Dewey', '(02) 5554 67', 'Rue Joseph-Bens 532', 'Bruxelles', 'Belgium'),
(67, 'Steve', 'Frick', '9145554562', '3758 North Pendale Street', 'White Plains', 'USA'),
(68, 'Wing', 'Huang', '5085559555', '4575 Hillside Dr.', 'New Bedford', 'USA'),
(69, 'Julie', 'Brown', '6505551386', '7734 Strong St.', 'San Francisco', 'USA'),
(70, 'Mike', 'Graham', '+64 9 312 5555', '162-164 Grafton Road', 'Auckland  ', 'New Zealand'),
(71, 'Ann ', 'Brown', '(171) 555-0297', '35 King George', 'London', 'UK'),
(72, 'William', 'Brown', '2015559350', '7476 Moss Rd.', 'Newark', 'USA'),
(73, 'Ben', 'Calaghan', '61-7-3844-6555', '31 Duncan St. West End', 'South Brisbane', 'Australia'),
(74, 'Kalle', 'Suominen', '+358 9 8045 555', 'Software Engineering Center', 'Espoo', 'Finland'),
(75, 'Philip ', 'Cramer', '0555-09555', 'Maubelstr. 90', 'Brandenburg', 'Germany'),
(76, 'Francisca', 'Cervantes', '2155554695', '782 First Street', 'Philadelphia', 'USA'),
(77, 'Jesus', 'Fernandez', '+34 913 728 555', 'Merchants House', 'Madrid', 'Spain'),
(78, 'Brian', 'Chandler', '2155554369', '6047 Douglas Av.', 'Los Angeles', 'USA'),
(79, 'Patricia ', 'McKenna', '2967 555', '8 Johnstown Road', 'Cork', 'Ireland'),
(80, 'Laurence ', 'Lebihan', '91.24.4555', '12, rue des Bouchers', 'Marseille', 'France'),
(81, 'Paul ', 'Henriot', '26.47.1555', '59 rue de l\'Abbaye', 'Reims', 'France'),
(82, 'Armand', 'Kuger', '+27 21 550 3555', '1250 Pretorius Street', 'Hatfield', 'South Africa'),
(83, 'Wales', 'MacKinlay', '64-9-3763555', '199 Great North Road', 'Auckland', 'New Zealand'),
(84, 'Karin', 'Josephs', '0251-555259', 'Luisenstr. 48', 'Münster', 'Germany'),
(85, 'Juri', 'Yoshido', '6175559555', '8616 Spinnaker Dr.', 'Boston', 'USA'),
(86, 'Dorothy', 'Young', '6035558647', '2304 Long Airport Avenue', 'Nashua', 'USA'),
(87, 'Lino ', 'Rodriguez', '(1) 354-2555', 'Jardim das rosas n. 32', 'Lisboa', 'Portugal'),
(88, 'Braun', 'Urs', '0452-076555', 'Hauptstr. 29', 'Bern', 'Switzerland'),
(89, 'Allen', 'Nelson', '6175558555', '7825 Douglas Av.', 'Brickhaven', 'USA'),
(90, 'Pascale ', 'Cartrain', '(071) 23 67 2555', 'Boulevard Tirou, 255', 'Charleroi', 'Belgium'),
(91, 'Georg ', 'Pipps', '6562-9555', 'Geislweg 14', 'Salzburg', 'Austria'),
(92, 'Arnold', 'Cruz', '+63 2 555 3587', '15 McCallum Street', 'Makati City', 'Philippines'),
(93, 'Maurizio ', 'Moroni', '0522-556555', 'Strada Provinciale 124', 'Reggio Emilia', 'Italy'),
(94, 'Akiko', 'Shimamura', '+81 3 3584 0555', '2-2-8 Roppongi', 'Minato-ku', 'Japan'),
(95, 'Dominique', 'Perrier', '(1) 47.55.6555', '25, rue Lauriston', 'Paris', 'France'),
(96, 'Rita ', 'Müller', '0711-555361', 'Adenauerallee 900', 'Stuttgart', 'Germany'),
(97, 'Sarah', 'McRoy', '04 499 9555', '101 Lambton Quay', 'Wellington', 'New Zealand'),
(98, 'Michael', 'Donnermeyer', ' +49 89 61 08 9555', 'Hansastr. 15', 'Munich', 'Germany'),
(99, 'Maria', 'Hernandez', '2125558493', '5905 Pompton St.', 'NYC', 'USA'),
(100, 'Alexander ', 'Feuer', '0342-555176', 'Heerstr. 22', 'Leipzig', 'Germany'),
(101, 'Dan', 'Lewis', '2035554407', '2440 Pompton St.', 'Glendale', 'USA'),
(102, 'Martha', 'Larsson', '0695-34 6555', 'Åkergatan 24', 'Bräcke', 'Sweden'),
(103, 'Sue', 'Frick', '4085553659', '3086 Ingle Ln.', 'San Jose', 'USA'),
(104, 'Roland ', 'Mendel', '7675-3555', 'Kirchgasse 6', 'Graz', 'Austria'),
(105, 'Leslie', 'Murphy', '2035559545', '567 North Pendale Street', 'New Haven', 'USA'),
(106, 'Yu', 'Choi', '2125551957', '5290 North Pendale Street', 'NYC', 'USA'),
(107, 'Martín ', 'Sommer', '(91) 555 22 82', 'C/ Araquil, 67', 'Madrid', 'Spain'),
(108, 'Sven ', 'Ottlieb', '0241-039123', 'Walserweg 21', 'Aachen', 'Germany'),
(109, 'Violeta', 'Benitez', '5085552555', '1785 First Street', 'New Bedford', 'USA'),
(110, 'Carmen', 'Anton', '+34 913 728555', 'c/ Gobelas, 19-1 Urb. La Florida', 'Madrid', 'Spain'),
(111, 'Sean', 'Clenahan', '61-9-3844-6555', '7 Allen Street', 'Glen Waverly', 'Australia'),
(112, 'Franco', 'Ricotti', '+39 022515555', '20093 Cologno Monzese', 'Milan', 'Italy'),
(113, 'Steve', 'Thompson', '3105553722', '3675 Furth Circle', 'Burbank', 'USA'),
(114, 'Hanna ', 'Moos', '0621-08555', 'Forsterstr. 57', 'Mannheim', 'Germany'),
(115, 'Alexander ', 'Semenov', '+7 812 293 0521', '2 Pobedy Square', 'Saint Petersburg', 'Russia'),
(116, 'Raanan', 'Altagar,G M', '+ 972 9 959 8555', '3 Hagalim Blv.', 'Herzlia', 'Israel'),
(117, 'José Pedro ', 'Roel', '(95) 555 82 82', 'C/ Romero, 33', 'Sevilla', 'Spain'),
(118, 'Rosa', 'Salazar', '2155559857', '11328 Douglas Av.', 'Philadelphia', 'USA'),
(119, 'Sue', 'Taylor', '4155554312', '2793 Furth Circle', 'Brisbane', 'USA'),
(120, 'Thomas ', 'Smith', '(171) 555-7555', '120 Hanover Sq.', 'London', 'UK'),
(121, 'Valarie', 'Franco', '6175552555', '6251 Ingle Ln.', 'Boston', 'USA'),
(122, 'Tony', 'Snowden', '+64 9 5555500', 'Arenales 1938 3\'A\'', 'Auckland  ', 'New Zealand');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departement`
--

CREATE TABLE `departement` (
  `id_departement` int(5) NOT NULL,
  `name_departement` varchar(100) NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_departement` text NOT NULL,
  `tgl_posting` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(100) NOT NULL,
  `position` int(8) NOT NULL DEFAULT 100
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `departement`
--

INSERT INTO `departement` (`id_departement`, `name_departement`, `slug`, `isi_departement`, `tgl_posting`, `gambar`, `position`) VALUES
(1, 'Engineering', 'engineering', '', '2018-12-06 15:44:44', '', 100),
(2, 'Produksi', 'produksi', '', '2018-12-06 15:44:45', '', 100),
(3, 'QSHE', 'qshe', '', '2018-12-06 15:44:46', '', 100),
(4, 'PSD', 'psd', '', '2018-12-06 15:44:50', '', 100),
(5, 'Marketing', 'marketing', '', '2018-12-06 15:44:50', '', 100),
(6, 'ME', 'me', '', '2018-12-06 15:44:51', '', 100),
(7, 'Finance', 'finance', '', '2018-12-06 15:44:52', '', 100),
(8, 'GA', 'ga', '', '2018-12-06 15:44:56', '', 100),
(9, 'HRD', 'hrd', '', '2018-12-06 15:45:01', '', 100),
(10, 'PPIC', 'ppic', '', '2018-12-06 15:45:03', '', 100),
(11, 'IT', 'it', '', '2018-12-06 15:45:07', '', 100),
(12, 'Purchasing', 'purchasing', '', '2018-12-06 15:45:08', '', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `download`
--

CREATE TABLE `download` (
  `id_download` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_file` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `hits` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `download`
--

INSERT INTO `download` (`id_download`, `judul`, `nama_file`, `tgl_posting`, `hits`) VALUES
(3, 'Membuat Shopping Cart dengan PHP', 'shopping cart.pdf', '2009-02-17', 3),
(5, 'Skrip Captcha', 'captcha.rar', '2009-02-06', 2),
(1, 'Kalender Tahun 2009', 'kalender2009.rar', '2009-02-06', 8),
(8, 'Wallpaper PHP', 'PHP_weapon.jpg', '2009-10-28', 4),
(9, 'Slide  Pemrograman VBA Excell', 'Excell_VBA.ppt', '2009-11-03', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int(5) NOT NULL,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `message` text COLLATE latin1_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `enquiry`
--

INSERT INTO `enquiry` (`id`, `name`, `email`, `phone`, `subjek`, `message`, `date`) VALUES
(10, 'Nurhardianti', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'fdfdsfsdfs df dfsdfsd f', '2021-09-13 23:19:28'),
(9, 'Nurhardianti', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'asdasd asd asd aasd as', '2021-09-13 23:18:42'),
(8, 'Nurhardianti', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'asdasd asd asd aasd as', '2021-09-13 23:18:34'),
(7, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'sdasdasdasd asdasd asda sdas dasdasd asdas dasd as da', '2021-09-13 23:17:35'),
(11, 'Nurhardianti', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry cc', 'sdasdasdasdasdsadsa', '2021-09-13 23:22:01'),
(12, 'Nurhardianti', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry cc', 'okehhhhhh', '2021-09-13 23:26:20'),
(13, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'apakah berhasil ', '2021-09-13 23:35:54'),
(14, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'apakah berhasil ', '2021-09-13 23:36:47'),
(15, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'fsdfd d', '8654', '2021-09-13 23:54:49'),
(16, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'dasdasdsdasda', '2021-09-14 00:03:36'),
(17, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'dasdasdsdasda', '2021-09-14 00:03:39'),
(18, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'sadasdasdas as ', '2021-09-14 08:40:42'),
(19, 'Nurhardianti', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry cc', 'sfsdf dsf sdf sdfsdfs s', '2021-09-14 08:44:26'),
(20, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'dasdas das dasd ads ', '2021-09-14 09:07:03'),
(21, 'Nurhardianti', 'fikarcare4u@gmail.com', '087888370521', 'berhasilkah?', 'coba kita lihat', '2021-09-14 09:07:47'),
(22, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'er tert ertert erte ', '2021-09-14 09:09:48'),
(23, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'xasdasdasd', '2021-09-14 09:12:24'),
(24, 'Ahmad Zulfikar', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'xasdasdasd', '2021-09-14 09:12:26'),
(25, 'Nurhardianti', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'sasdasd', '2021-09-14 09:15:22'),
(26, 'Nurhardianti', 'fikarcare4u@gmail.com', '087888370521', 'test email enquiry', 'sasdasd', '2021-09-14 09:15:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `exam_papers`
--

CREATE TABLE `exam_papers` (
  `paper_id` int(7) NOT NULL,
  `title` varchar(70) NOT NULL,
  `description` text DEFAULT NULL,
  `rules` text DEFAULT NULL,
  `semester` varchar(10) NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `subject_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `exam_papers`
--

INSERT INTO `exam_papers` (`paper_id`, `title`, `description`, `rules`, `semester`, `starttime`, `endtime`, `visible`, `status`, `subject_id`) VALUES
(1, 'Kuisioner Pelanggan', '<p>\n	Dalam rangka memberikan produk &amp; layanan yang terbaik, kami mohon Bapak / Ibu dapat memberikan penilaian atas kinerja kami dengan cara memberikan tanda pada kotak pertanyaan dibawah ini. Penilaian yang Bapak / Ibu berikan sangat membantu kami dalam meningkatkan layanan dan kami sangat berterima kasih apabila kuesioner di isi dengan objektif dan keadaan sesungguhnya.</p>\n', '<p>\n	Pilihlah jawab pada kotak sesuai dengan pengalaman anda kepada kami</p>\n', '1', '2019-05-16 07:00:00', '2019-05-16 08:00:00', 1, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `post_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `files`
--

INSERT INTO `files` (`id`, `id_post`, `file_name`, `uploaded_on`, `status`, `post_type`) VALUES
(1, 9, '695ff8d1c9_1536601890_fedea746cd0ecb257a1249d3a2a80bb1.jpg', '2018-09-10 19:51:30', '1', 'gallery'),
(2, 9, 'f5852ac8c5_1536601890_fedea746cd0ecb257a1249d3a2a80bb1_2.jpg', '2018-09-10 19:51:30', '1', 'gallery'),
(3, 9, '652445e35d_1536601890_fedea746cd0ecb257a1249d3a2a80bb1_3.jpg', '2018-09-10 19:51:30', '1', 'gallery'),
(4, 9, 'ed670e51ef_1536601890_fedea746cd0ecb257a1249d3a2a80bb1_4.jpg', '2018-09-10 19:51:30', '1', 'gallery'),
(5, 10, '7eda037591_1536603101_258ee2700b8562b5d51ebf2117179b3d.jpg', '2018-09-10 20:11:41', '1', 'gallery'),
(6, 10, 'a0b3e9355a_1536603101_258ee2700b8562b5d51ebf2117179b3d_2.jpg', '2018-09-10 20:11:41', '1', 'gallery'),
(7, 10, 'ae812e94bb_1536603101_258ee2700b8562b5d51ebf2117179b3d_3.jpg', '2018-09-10 20:11:41', '1', 'gallery'),
(8, 10, 'e74964011b_1536603101_258ee2700b8562b5d51ebf2117179b3d_4.jpg', '2018-09-10 20:11:41', '1', 'gallery'),
(9, 11, 'ed1392cb3b_1536717460_d0d354668f69293e040aa69de3140c78.jpg', '2018-09-12 03:57:40', '1', 'gallery'),
(10, 11, '57e8af5fe3_1536717460_d0d354668f69293e040aa69de3140c78_2.jpg', '2018-09-12 03:57:41', '1', 'gallery'),
(11, 11, '2ad07d4e5f_1536717461_d0d354668f69293e040aa69de3140c78_3.jpg', '2018-09-12 03:57:41', '1', 'gallery'),
(16, 1, 'ef60df818b_1536717777_45e8f4939bc3bd36e4b87ab1e324d227.jpg', '2018-09-12 04:02:57', '1', 'gallery'),
(17, 1, '19aa011124_1536717777_45e8f4939bc3bd36e4b87ab1e324d227_2.jpg', '2018-09-12 04:02:57', '1', 'gallery'),
(18, 1, '8cdff2e407_1536717777_45e8f4939bc3bd36e4b87ab1e324d227_3.jpg', '2018-09-12 04:02:57', '1', 'gallery'),
(19, 1, '0ffa009076_1536717777_45e8f4939bc3bd36e4b87ab1e324d227_4.jpg', '2018-09-12 04:02:57', '1', 'gallery'),
(20, 1, 'de119178a5_1536717777_45e8f4939bc3bd36e4b87ab1e324d227_5.jpg', '2018-09-12 04:02:58', '1', 'gallery'),
(21, 1, 'cd45b87a76_1536717778_45e8f4939bc3bd36e4b87ab1e324d227_6.jpg', '2018-09-12 04:02:58', '1', 'gallery'),
(22, 1, 'ea5f065748_1536717778_45e8f4939bc3bd36e4b87ab1e324d227_7.jpg', '2018-09-12 04:02:58', '1', 'gallery'),
(23, 1, 'b3449c4daa_1536717778_45e8f4939bc3bd36e4b87ab1e324d227_8.jpg', '2018-09-12 04:02:58', '1', 'gallery'),
(65, 12, '6fbcf51418_1536759777_8012f255a337782bffaadea968723f36.jpg', '2018-09-12 15:42:57', '1', 'gallery'),
(66, 12, '98fece9b7c_1536759777_8012f255a337782bffaadea968723f36_2.jpg', '2018-09-12 15:42:57', '1', 'gallery'),
(67, 12, 'b8c09827bc_1536759777_8012f255a337782bffaadea968723f36_3.jpg', '2018-09-12 15:42:57', '1', 'gallery'),
(68, 12, '2c01e89110_1536759777_8012f255a337782bffaadea968723f36_4.jpg', '2018-09-12 15:42:58', '1', 'gallery'),
(94, 54, '26a1bdef48_1537803187_fc34f61d23b74be53ee07d469bd32064_XL.jpg', '2018-09-24 17:33:07', '1', 'services'),
(95, 54, 'fe67d98aa8_1537803187_ffee2447b152494b43d9816faaea83c8.jpg', '2018-09-24 17:33:08', '1', 'services'),
(102, 51, '1bdac498b9_1538922927_2_gx8w8t.jpg', '2018-10-07 16:35:27', '1', 'services'),
(103, 51, 'c39c13d5ff_1538922927_corporate-buildings-m.jpg', '2018-10-07 16:35:28', '1', 'services'),
(127, 47, '9db4cfcdde_1540871390_fc34f61d23b74be53ee07d469bd32064_XL.jpg', '2018-10-30 04:49:50', '1', 'services'),
(128, 47, 'e5eece8783_1540871390_ffee2447b152494b43d9816faaea83c8.jpg', '2018-10-30 04:49:50', '1', 'services'),
(135, 33, 'ef58ac1aa1_1540871965_2_gx8w8t.jpg', '2018-10-30 10:59:26', '1', 'berita'),
(136, 33, '2d61d071f0_1540871966_corporate-buildings-m.jpg', '2018-10-30 10:59:27', '1', 'berita'),
(137, 2, '9c4344fc31_1596696834_4510549_coffee_cup_wallpapers.jpg', '2020-08-06 13:53:55', '1', 'gallery'),
(138, 2, '80084411a9_1596696835_wp1923704.jpg', '2020-08-06 13:53:56', '1', 'gallery'),
(139, 2, '345de5b14a_1596696836_yG5VOP.jpg', '2020-08-06 13:53:56', '1', 'gallery'),
(149, 0, 'c4c6236f45_1596698834_bg4.jpg', '2020-08-06 14:27:14', '1', 'gallery'),
(150, 0, 'e3d5d045a5_1596698834_slide2.jpg', '2020-08-06 14:27:15', '1', 'gallery'),
(151, 0, '4d15be1679_1596698835_slide3.jpg', '2020-08-06 14:27:15', '1', 'gallery'),
(152, 13, '6e2c215a66_1596699268_bg4.jpg', '2020-08-06 14:34:29', '1', 'gallery'),
(153, 13, 'fa87f49c75_1596699269_slide2.jpg', '2020-08-06 14:34:29', '1', 'gallery'),
(154, 13, '0b003756d9_1596699269_slide3.jpg', '2020-08-06 14:34:29', '1', 'gallery');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_tag` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id_brand` int(5) NOT NULL,
  `judul` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_gallery` text CHARACTER SET utf8 DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `galleryfoto` varchar(255) DEFAULT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `meta_description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `gallery_views` int(11) DEFAULT 1,
  `username` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `price` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_categories` int(5) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_tagmap`
--

CREATE TABLE `gallery_tagmap` (
  `id_tagmap` int(5) NOT NULL,
  `tags_id` int(5) NOT NULL,
  `id_gallery` int(5) NOT NULL,
  `post_type` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery_tags`
--

CREATE TABLE `gallery_tags` (
  `tags_id` int(5) NOT NULL,
  `tags_title` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tags_description` text DEFAULT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'anggota', ''),
(4, 'superadmin', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hubungi`
--

CREATE TABLE `hubungi` (
  `id_hubungi` int(5) NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `hubungi`
--

INSERT INTO `hubungi` (`id_hubungi`, `nama`, `email`, `phone`, `subjek`, `pesan`, `tanggal`) VALUES
(10, 'dfdfd', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'dfdf sd s ', '0000-00-00'),
(11, 'AHMAD', 'sdasdda@fsdf.com', '02132328832', 'gtranslate', 'dfdsfs sd sdf s ', '0000-00-00'),
(12, 'AHMAD', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'dsdsd ', '0000-00-00'),
(13, 'AHMAD', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'baaru', '2018-03-15'),
(14, 'AHMAD Zulfikar', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'sadsdsd asd a', '2018-03-15'),
(15, 'AHMAD', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'sdsdcasdcasdcacscdaca', '2018-03-15'),
(16, 'AHMAD', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'sdsdcasdcasdcacscdaca', '2018-03-15'),
(17, 'AHMAD Zulfikar', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'kkjkkhk hj h h ', '2018-03-15'),
(18, 'AHMAD Zulfikar', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'ff ff', '2018-03-15'),
(19, 'AHMAD Zulfikar', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'ffddddfdf df d d', '2018-03-15'),
(20, 'AHMAD Zulfikar', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'ppppppppppppppppppppppppppppppp', '2018-03-15'),
(21, 'AHMAD Zulfikar', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'sfdsfsdf', '2018-03-15'),
(22, 'AHMAD Zulfikar', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'tttttttttttttttttttt', '2018-03-15'),
(23, 'AHMAD', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'dfsdfsdf', '2018-03-15'),
(24, 'sdsadsad', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'dsfsdfsdf', '2018-03-15'),
(25, 'AHMAD', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'dfsdfsfs', '2018-03-15'),
(26, 'AHMAD', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'dfdsfsd sd s s', '2018-03-15'),
(27, 'AHMAD Zulfikar', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'fdfsdfsf', '2018-03-15'),
(28, 'AHMAD Zulfikar', 'sdasdda@fsdf.com', '02132328832', 'Hit Counter', 'ghfghfhf', '2018-03-15'),
(32, 'Waterproofing Coating Dinding', 'fikarcare4u@gmail.com', '', 'CV. Alpha Jaya Tehnik', 'asdsdsadas sd asd sad asd as as dad ', '2018-08-07'),
(33, 'Waterproofing Coating Dinding', 'fikarcare4u@gmail.com', '', 'CV. Alpha Jaya Tehnik', 'asdsdsadas sd asd sad asd as as dad ', '2018-08-07'),
(34, 'Injeksi PU', 'fikarcare4u@gmail.com', '', 'CV. Alpha Jaya Tehnik', 'gfgfdgdfgd fgd fgdfgdfg dfg dfg df d d ', '2018-08-07'),
(35, 'ahmad zulfikar', 'ahmadzulfikar@gmail.com', '02112313123', 'contoh email', 'asdsadsadasd asda sdas das', '2018-08-07'),
(36, 'ahmad zulfikar', 'ahmadzulfikar@gmail.com', '02112313123', 'contoh email', 'asdsadsadasd asda sdas das', '2018-08-07'),
(37, 'percobaan kirim email', 'ahmadzulfikar@gmail.com', '02112313123', 'contoh email', 'sdsadsd sadsa dsadsd asd sad sad asd sad sad as da sa dasd sa', '2018-08-07'),
(38, 'percobaan kirim email', 'ahmadzulfikar@gmail.com', '02112313123', 'contoh email', 'sdsadsd sadsa dsadsd asd sad sad asd sad sad as da sa dasd sa', '2018-08-07'),
(39, 'ahmad zulfikar', 'ahmadzulfikar@gmail.com', '02112313123', 'contoh email', 'dsfsfsdfdsfs df dsf sdf sdf sdf sdf sdf sd s', '2018-08-07'),
(40, 'jajal email', 'ahmadzulfikar@gmail.com', '02112313123', 'contoh email', 'sdsads ds adsa das dsad as ds ds', '2018-08-07'),
(41, 'percobaan kirim email', 'ahmadzulfikar@gmail.com', '02112313123', 'contoh email fffffffffff', 'dfdsf sdfs dfsdfsdfsdfsdf sd s', '2018-08-08'),
(42, 'ahmad zulfikar', 'ahmadzulfikar@gmail.com', '02112313123', 'aku coba email lagi', 'sdasd asdasdasd asd as a', '2018-08-08'),
(43, 'apakah berhasil', 'ahmadzulfikar@gmail.com', '02112313123', 'contoh email fffffffffff', 'dsadsa das dasd asd asd as a', '2018-08-08'),
(44, 'nurhardianti', 'nurhardianti90@yahoo.co.id', '02112313123', 'contoh email', 'jhjhj hjhj hj hjh j hjh jh j hj h j', '2018-08-08'),
(45, 'nurhardianti', 'nurhardianti90@yahoo.co.id', '02112313123', 'contoh email fffffffffff', 'sd asda sdasd asd asdas dasd asda sd as', '2018-08-08'),
(46, 'ahmad zulfikar', 'fikarcare4u@gmail.com', '02112313123', 'contoh email', 'sadsadas dasdasd asd as a sdasda s da', '2018-08-08'),
(47, 'ahmad zulfikar', 'nurhardianti90@yahoo.co.id', '02112313123', 'contoh email fffffffffff', 'dfsdf sdfs dfsdfsdfsdfsd fs fs', '2018-08-08'),
(48, 'percobaan kirim email', 'nurhardianti90@yahoo.co.id', '02112313123', 'contoh email fffffffffff', 'fgfdg dg dfgdfg d', '2018-08-08'),
(49, 'ahmad zulfikar', 'nurhardianti90@yahoo.co.id', '02112313123', 'contoh email fffffffffff', 'fdsfsd fsdf sdf sdfs df sf s', '2018-08-08'),
(50, 'ahmad zulfikar', 'nurhardianti90@yahoo.co.id', '02112313123', 'contoh email fffffffffff', 'safasfsafasfas as a as asa  a', '2018-08-08'),
(51, 'percobaan kirim email', 'nurhardianti90@yahoo.co.id', '02112313123', 'percobaan kirim email via website alphajayatehnik.co.id', 'fdfdsfdsfsd fsdf sdf sdfdsfds fdsf sdf', '2018-08-08'),
(52, 'ahmad zulfikar', 'nurhardianti90@yahoo.co.id', '087888370521', 'percobaan kirim email via website alphajayatehnik.co.id', 'Using SMTP server is always a good idea to send email from the script. Sometimes PHP', '2018-08-08'),
(53, 'ahmad zulfikar', 'nurhardianti90@yahoo.co.id', '02112313123', 'contoh email fffffffffff', 'dfsdfsdf sdf sdfsdf sdf s', '2018-08-08'),
(54, 'ahmad zulfikar', 'nurhardianti90@yahoo.co.id', '02112313123', 'contoh email fffffffffff', 'sdfdgdg gdfsdfsdfsdf sdfsd fsd s', '2018-08-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` int(5) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `alamat_website` varchar(100) NOT NULL,
  `meta_title` varchar(200) DEFAULT NULL,
  `meta_deskripsi` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `header` varchar(50) NOT NULL,
  `headerlogo` varchar(50) NOT NULL,
  `img_profil` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_website`, `alamat_website`, `meta_title`, `meta_deskripsi`, `meta_keyword`, `favicon`, `logo`, `header`, `headerlogo`, `img_profil`, `icon`) VALUES
(1, 'Arjuna Electric', 'http://rentalgensetjakarta.net/', 'SEWA GENSET MURAH JABODETABEK', 'SEWA GENSET MURAH JABODETABEK Jasa Sewa Genset Silent Murah Jakarta, Kami menyediakan Jasa Sewa Genset Silent mulai dari kapasitas 25 kva - 1250 kva. Jasa Sewa Genset Silent kami siap melayani untuk wilayah seluruh indonesia', '', 'favicon.ico', 'arjunaelectric2.png', 'power-surge-merl.jpg', '38865790-innovation-wallpapers-innovations-wallpap', 'FB_IMG_1553665812750.jpg', 'arjunaelectric1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(5) NOT NULL,
  `name_jabatan` varchar(100) NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_jabatan` text NOT NULL,
  `tgl_posting` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(100) NOT NULL,
  `position` int(8) NOT NULL DEFAULT 100
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `name_jabatan`, `slug`, `isi_jabatan`, `tgl_posting`, `gambar`, `position`) VALUES
(2, 'Operator', 'operator', '', '2018-11-08 00:00:00', '032566fcea_1541698800_cnth.jpg', 100),
(3, 'staff', 'staff', '', '2018-11-08 00:00:00', 'c432795690_1541698820_corporate-buildings-m.jpg', 100),
(4, 'Supervisor', 'supervisor', '', '2018-11-10 00:12:51', '', 100),
(5, 'Manager', 'manager', '', '2018-11-10 00:12:59', '', 100),
(6, 'Foreman', 'foreman', '', '2018-11-10 00:13:03', '', 100),
(7, 'Leader', 'leader', '', '2018-12-05 23:53:28', '', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `katajelek`
--

CREATE TABLE `katajelek` (
  `id_jelek` int(11) NOT NULL,
  `kata` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `ganti` varchar(60) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `katajelek`
--

INSERT INTO `katajelek` (`id_jelek`, `kata`, `ganti`) VALUES
(4, 'sex', 's**'),
(2, 'bajingan', 'b*******'),
(3, 'bangsat', 'b******');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `kategori_seo`, `aktif`) VALUES
(19, 'Teknologi', 'teknologi', 'Y'),
(2, 'Olahraga', 'olahraga', 'Y'),
(22, 'Politik', 'politik', 'Y'),
(23, 'Hiburan', 'hiburan', 'Y'),
(31, 'Genset Silent', 'genset-silent', 'Y'),
(32, 'Genset Open', 'genset-open', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(5) NOT NULL,
  `id_berita` int(5) NOT NULL,
  `nama_komentar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_komentar` text COLLATE latin1_general_ci NOT NULL,
  `tgl` date NOT NULL,
  `jam_komentar` time NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_berita`, `nama_komentar`, `url`, `isi_komentar`, `tgl`, `jam_komentar`, `aktif`) VALUES
(12, 71, 'Wisnu', 'wisnu.wordpress.com', 'pertamax', '2009-02-02', '08:10:23', 'Y'),
(13, 71, 'Adrian', 'adrian.blogspot.com', 'CR 7 emang idola gua, melesat terus ya prestasinya.', '2009-02-02', '09:06:01', 'Y'),
(15, 79, 'Armen', 'detik.com', 'ahmadinejad emang idolaku', '2009-02-03', '10:05:20', 'Y'),
(17, 74, 'Lukman', 'hakim.com', 'apakah browser google secanggih search enginenya?', '2009-02-21', '10:12:23', 'Y'),
(34, 92, 'Rudi', 'bukulokomedia.com', ' Kalau  tentang  gue,  kapan  dibuat  filmnya  ya?   ', '2009-10-28', '21:21:21', 'Y'),
(22, 77, 'Raihan', 'bukulokomedia.com', 'mas .. tolong kirimin source code proyek lokomedia&nbsp; ke email saya di raihan@gmail.com', '2009-08-25', '16:30:00', 'Y'),
(23, 77, 'Wawan', 'bukulokomedia.com', 'woi .. kunjungin dong website saya di http://bukulokomedia.com, jangan lupa kasih komen dan sarannya ya.', '2009-08-25', '16:31:50', 'Y'),
(36, 93, 'Lukman', 'google.com', 'tes  kata-kata  jelek  sex   ', '2009-11-04', '10:04:26', 'Y'),
(65, 85, 'hilman', 'antonhilman.com', ' emang  sih,  windows  7  lebih  cepat  dibandingkan  vista,  tapi  masih  banyak  bug  bung.   ', '2010-01-15', '04:16:25', 'Y'),
(66, 78, 'ronaldinho', 'ronaldino.com', ' ronaldo  pantas  mendapatkannya  tahun  ini  dan  kayaknya  tahun  depan  masih  menjadi  miliknya.   ', '2010-01-15', '04:18:08', 'Y'),
(67, 99, 'lukman', 'bukulokomedia.com', ' tes   ', '2010-02-11', '02:42:46', 'Y'),
(69, 99, 'fathan', 'bukulokomedia.com', 'keduax', '2010-02-15', '07:44:12', 'Y'),
(70, 99, 'Rianto', 'bukulokomedia.com', ' kok  nggak  ada  yang  pertamax  ..  langsung  keduax  sih.   ', '2010-05-16', '11:33:26', 'Y'),
(72, 99, 'lokomedia', 'bukulokomedia.com', ' test  paging  komentar   ', '2012-01-03', '17:50:14', 'Y'),
(73, 99, 'husada', 'bukulokomedia.com', ' perbaikan  paging  halaman  komentar   ', '2012-01-03', '17:53:03', 'Y'),
(74, 99, 'hendra', 'bukulokomedia.com', ' iya  kemarin  sudah  saya  coba  yang  CMS  Lokomedia  versi  1.5,  paging  komentarnya  masih  error.   ', '2012-01-03', '17:53:59', 'Y'),
(75, 99, 'lukman', 'bukulokomedia.com', ' @  husada  dan  hendra:  terimakasih  atas  perbaikan  bugnya.   ', '2012-01-03', '17:54:41', 'Y'),
(76, 99, 'lokomedia', 'bukulokomedia.com', ' pada  versi  1.5.5,  bug  paging  halaman  komentar  sudah  diperbaiki.   ', '2012-01-03', '17:55:27', 'Y'),
(77, 99, 'hendra', 'bukulokomedia.com', ' paging  halaman  komentar  sudah  berjalan  dengan  baik,  thanks  lokomedia   ', '2012-01-03', '17:56:12', 'Y'),
(92, 124, 'Lukmanul', 'bukulokomedia.com', 'Tes  komentar  pakai  url  <a target=\"_blank\" rel=\"nofollow\" href=\"http://bukulokomedia.com\">http://bukulokomedia.com</a>&nbsp;', '2012-05-02', '11:27:28', 'Y'),
(95, 121, 'Robby Prihandaya', 'https://phpmu.com', 'Sepakan Hamka masih bisa ditepis Bounthisanh, tapi bola disambar oleh Arief Suyono dan terciptalah gol kelima Indonesia. Ini adalah gol kedua Arief dalam turnamen ini.', '2017-05-10', '03:46:19', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mainmenu`
--

CREATE TABLE `mainmenu` (
  `id_main` int(5) NOT NULL,
  `nama_menu` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `adminmenu` enum('Y','N') NOT NULL,
  `arrange` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mainmenu`
--

INSERT INTO `mainmenu` (`id_main`, `nama_menu`, `link`, `aktif`, `adminmenu`, `arrange`) VALUES
(2, 'Beranda', '', 'Y', 'N', 1),
(3, 'Profil', '#', 'Y', 'N', 2),
(4, 'Schedules', 'agenda', 'Y', 'N', 5),
(5, 'Berita', '#', 'Y', 'N', 4),
(6, 'Download', 'download', 'N', 'N', 0),
(7, 'Galeri Foto', 'gallery', 'N', 'N', 0),
(8, 'Hubungi Kami', 'hubungi', 'Y', 'N', 9),
(14, 'Setting Web', '', 'N', 'Y', 0),
(15, 'Setting Menu', '', 'N', 'Y', 1),
(16, 'Manajemen Berita', '', 'N', 'Y', 3),
(54, 'Hubungi Kami', 'administrator/pesanmasuk', 'N', 'Y', 3),
(53, 'Interaksi', '', 'N', 'Y', 6),
(52, 'Media', '', 'N', 'Y', 7),
(59, 'Banner', 'administrator/banner', 'N', 'Y', 8),
(61, 'Training Program', 'Training Program', 'Y', 'N', 3),
(62, 'Consulting', 'Consulting', 'Y', '', 6),
(63, 'Employing', 'Employing', 'Y', '', 7),
(64, 'Equipment', 'Equipment', 'Y', '', 8),
(65, 'Manajemen Halaman', '#', 'N', 'Y', 4),
(66, 'Our Services', '#', 'Y', 'N', 10),
(67, 'Navigation', 'administrator/navigation/', 'N', 'Y', 0),
(68, 'Schedules', 'administrator/schedules', 'N', 'Y', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('user','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`, `link_seo`) VALUES
(2, 'Manajemen User', '?module=user', '', '', 'N', 'user', 'Y', 1, ''),
(18, 'Berita', '?module=berita', '', '', 'Y', 'user', 'Y', 6, 'semua-berita.html'),
(19, 'Banner', '?module=banner', '', '', 'Y', 'admin', 'Y', 9, ''),
(37, 'Profil', '?module=profil', '<b>Bukulokomedia.com</b> merupakan website resmi dari penerbit Lokomedia yang bermarkas di Jl. Arwana No.24 Minomartani Yogyakarta 55581. Dirintis pertama kali oleh Lukmanul Hakim pada tanggal 14 Maret 2008.<br><br>Produk unggulan dari penerbit Lokomedia adalah buku-buku serta aksesoris bertema PHP (<span style=\"font-weight: bold; font-style: italic;\">PHP: Hypertext Preprocessor</span>) yang merupakan pemrograman Internet paling handal saat ini.\r\n', 'gedungku.jpg', 'N', 'admin', 'N', 3, 'profil-kami.html'),
(10, 'Manajemen Modul', '?module=modul', '', '', 'N', 'admin', 'Y', 2, ''),
(31, 'Kategori', '?module=kategori', '', '', 'Y', 'admin', 'Y', 5, ''),
(33, 'Poling', '?module=poling', '', '', 'Y', 'admin', 'Y', 10, ''),
(34, 'Tag (Label)', '?module=tag', '', '', 'N', 'admin', 'Y', 7, ''),
(35, 'Komentar', '?module=komentar', '', '', 'Y', 'admin', 'Y', 8, ''),
(36, 'Download', '?module=download', '', '', 'Y', 'admin', 'Y', 11, 'semua-download.html'),
(40, 'Hubungi Kami', '?module=hubungi', '', '', 'Y', 'admin', 'Y', 12, 'hubungi-kami.html'),
(41, 'Agenda', ' ?module=agenda', '', '', 'Y', 'user', 'Y', 31, 'semua-agenda.html'),
(42, 'Shoutbox', '?module=shoutbox', '', '', 'Y', 'admin', 'Y', 13, ''),
(43, 'Album', '?module=album', '', '', 'N', 'admin', 'Y', 14, ''),
(44, 'Galeri Foto', '?module=galerifoto', '', '', 'Y', 'admin', 'Y', 15, ''),
(45, 'Templates', '?module=templates', '', '', 'N', 'admin', 'Y', 16, ''),
(46, 'Kata Jelek', '?module=katajelek', '', '', 'N', 'admin', 'Y', 17, ''),
(47, 'RSS', '-', '', '', 'Y', 'admin', 'N', 18, ''),
(48, 'YM', '-', '', '', 'Y', 'admin', 'N', 19, ''),
(49, 'Indeks Berita', '-', '', '', 'Y', 'admin', 'N', 20, ''),
(50, 'Kalender', '-', '', '', 'Y', 'admin', 'N', 21, ''),
(51, 'Statistik User', '-', '', '', 'Y', 'admin', 'N', 22, ''),
(52, 'Pencarian', '-', '', '', 'Y', 'admin', 'N', 23, ''),
(53, 'Berita Teratas', '-', '', '', 'Y', 'admin', 'N', 24, ''),
(54, 'Arsip Berita', '-', '', '', 'Y', 'admin', 'N', 25, ''),
(55, 'Berita Sebelumnya', '-', '', '', 'Y', 'admin', 'N', 26, ''),
(60, 'Sekilas Info', '?module=sekilasinfo', '', '', 'Y', 'admin', 'Y', 13, ''),
(57, 'Menu Utama', '?module=menuutama', '', '', 'Y', 'admin', 'Y', 28, ''),
(58, 'Sub Menu', '?module=submenu', '', '', 'Y', 'admin', 'Y', 29, ''),
(59, 'Halaman Statis', '?module=halamanstatis', '', '', 'Y', 'admin', 'Y', 30, ''),
(61, 'Identitas Website', '?module=identitas', '', '', 'N', 'admin', 'Y', 4, ''),
(62, 'product', '?module=product', '', '', 'Y', 'admin', 'Y', 0, ''),
(63, 'products', '?module=products', '', '', 'Y', 'admin', 'Y', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pages`
--

CREATE TABLE `pages` (
  `id_pages` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_pages` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pages`
--

INSERT INTO `pages` (`id_pages`, `judul`, `slug`, `isi_pages`, `tgl_posting`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 'About Us', 'about-us', '<p class=\"center\">Berbisnis bagi kami adalah bukan semata mata hanya mencari keuntungan yang besar, akan tetapi prioritas utama adalah mengedepankan kepuasan bagi klien, atas kualitas produk dan jasa, serta efisiensi biaya, ketepatan waktu, dan perawatan purna jual. Dengan didukung sumber daya manusia yang berpengalaman dan inovatif serta bertanggung jawab, Kami berkomitmen menjadikan PT. Internusa Kreasindo, siap bersaing dan memberikan produk dan layanan terbaik, bagi seluruh konsumen.</p>\r\n<h3 class=\"center\">Visi</h3>\r\n<p class=\"center\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<h3 class=\"center\">Misi</h3>\r\n<p class=\"center\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2021-09-14', 'f6cba83f98_1631533132_Tiang_PJU.jpg', '', '', ''),
(46, 'Carrier', 'carrier', '', '2021-09-14', '9e949125fa_1631524458_hamzah_ismael_2HRZdRbowY8_unsplash.jpg', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll_options`
--

CREATE TABLE `payroll_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll_settings`
--

CREATE TABLE `payroll_settings` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `no_npwp` varchar(255) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `jam_istirahat1` time NOT NULL,
  `lama_istirahat1` int(11) NOT NULL,
  `jam_istirahat2` time NOT NULL,
  `lama_istirahat2` int(11) NOT NULL,
  `jam_istirahat3` time NOT NULL,
  `lama_istirahat3` int(11) NOT NULL,
  `uang_makan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `payroll_settings`
--

INSERT INTO `payroll_settings` (`id`, `logo`, `company_name`, `address`, `phone`, `fax`, `email`, `city`, `no_npwp`, `jam_masuk`, `jam_pulang`, `jam_istirahat1`, `lama_istirahat1`, `jam_istirahat2`, `lama_istirahat2`, `jam_istirahat3`, `lama_istirahat3`, `uang_makan`) VALUES
(1, 'logo.png', 'Fikar Web Design', '<p>\n	234 St. Washington</p>\n', '+622 000 111 222', '+622 222 111 333', 'fikarcare4u@gmail.com', 'Bandung', '34.345.567.78.789.09', '08:00:00', '17:00:00', '13:00:00', 1, '18:00:00', 1, '01:00:00', 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `poling`
--

CREATE TABLE `poling` (
  `id_poling` int(5) NOT NULL,
  `pilihan` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `rating` int(5) NOT NULL DEFAULT 0,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `poling`
--

INSERT INTO `poling` (`id_poling`, `pilihan`, `status`, `rating`, `aktif`) VALUES
(1, 'Internet Explorer', 'Jawaban', 24, 'Y'),
(2, 'Mozilla Firefox', 'Jawaban', 81, 'Y'),
(3, 'Google Chrome', 'Jawaban', 21, 'Y'),
(4, 'Opera', 'Jawaban', 22, 'Y'),
(8, 'Apa Browser Favorit Anda?', 'Pertanyaan', 0, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id_products` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_tag` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id_brand` int(5) NOT NULL,
  `judul` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_products` text CHARACTER SET utf8 NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(100) CHARACTER SET utf8 NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) CHARACTER SET utf8 NOT NULL,
  `dibaca` int(5) DEFAULT 1,
  `products_views` int(11) DEFAULT 0,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `price` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_categories` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id_products`, `id_kategori`, `id_tag`, `id_brand`, `judul`, `slug`, `isi_products`, `created_time`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`, `dibaca`, `products_views`, `username`, `price`, `id_categories`) VALUES
(1, 0, '', 0, 'Tiang listrik', 'tiang-listrik', '<p>Lampu jalan atau dikenal juga sebagai Penerangan Jalan Umum (PJU) adalah lampu yang digunakan untuk penerangan jalan dimalam hari sehingga mempermudah pejalan kaki, pesepeda dan pengendara kendaraan dapat melihat dengan lebih jelas jalan/medan yang akan dilalui pada malam hari, sehingga dapat meningkatkan keselamatan lalu lintas dan keamanan dari para pengguna jalan dari kegiatan/aksi kriminal.<br /><br />Penerangan jalan di kawasan perkotaan mempunyai fungsi antara lain :</p>\r\n<ul>\r\n<li>Menghasilkan kekontrasan antara obyek dan permukaan jalan</li>\r\n<li>Sebagai alat bantu navigasi pengguna jalan</li>\r\n<li>Meningkatkan keselamatan dan kenyamanan pengguna jalan, khususnya pada malam hari Mendukung keamanan lingkungan</li>\r\n<li>Memberikan keindahan lingkungan jalan.</li>\r\n</ul>', '2021-09-14 09:32:50', '8ccb4c8a5b_1631526605_tianglistrik.jpg', 'Tiang listrik', '', 'Lampu jalan atau dikenal juga sebagai Penerangan Jalan Umum (PJU) adalah lampu yang digunakan untuk penerangan jalan dimalam hari sehingga mempermudah pejalan kaki, pesepeda dan pengendara kendaraan d', 1, 11, 'admin', NULL, 8),
(2, 0, '', 0, 'Solar Tracker', 'solar-tracker', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', '2021-09-14 09:32:40', 'b6d6aa43ba_1631526700_solartracker.jpg', 'Solar Tracker', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 1, 4, 'admin', NULL, 12),
(3, 0, '', 0, 'Welding', 'welding', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', '2021-09-14 09:32:31', '463850b407_1631527115_Welding.jpg', 'Welding', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 1, 2, 'admin', NULL, 10),
(4, 0, '', 0, 'Monopole', 'monopole', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', '2021-09-14 09:32:24', '599dc224c1_1631527144_Monopole.jpg', 'Monopole', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 1, 12, 'admin', NULL, 8),
(5, 0, '', 0, 'Hightmast', 'hightmast', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', '2021-09-14 09:32:17', '235607fe28_1631527178_Hightmast.jpg', 'Hightmast', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 1, 6, 'admin', NULL, 8),
(6, 0, '', 0, 'Tiang PJU', 'tiang-pju', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', '2021-09-14 09:32:07', 'b6d1a001a5_1631527227_Tiang_PJU.jpg', 'Tiang PJU', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 1, 29, 'admin', NULL, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products_tagmap`
--

CREATE TABLE `products_tagmap` (
  `id_tagmap` int(5) NOT NULL,
  `tags_id` int(5) NOT NULL,
  `id_products` int(5) NOT NULL,
  `post_type` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products_tags`
--

CREATE TABLE `products_tags` (
  `tags_id` int(5) NOT NULL,
  `tags_title` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tags_description` text DEFAULT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `products_tags`
--

INSERT INTO `products_tags` (`tags_id`, `tags_title`, `slug`, `updated_at`, `created_at`, `tags_description`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, '', '0', '2021-09-13 09:50:05', '2021-09-13 16:50:05', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id_projects` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_tag` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id_brand` int(5) NOT NULL,
  `judul` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_projects` text CHARACTER SET utf8 DEFAULT NULL,
  `lokasi` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `meta_description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `projects_views` int(11) DEFAULT 1,
  `username` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `price` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_categories` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects_tagmap`
--

CREATE TABLE `projects_tagmap` (
  `id_tagmap` int(5) NOT NULL,
  `tags_id` int(5) NOT NULL,
  `id_projects` int(5) NOT NULL,
  `post_type` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects_tags`
--

CREATE TABLE `projects_tags` (
  `tags_id` int(5) NOT NULL,
  `tags_title` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tags_description` text DEFAULT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `position` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `promo`
--

INSERT INTO `promo` (`id_promo`, `judul`, `slug`, `isi_promo`, `tgl_posting`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`, `position`) VALUES
(9, 'Amor Tower - Pakuwon Residences', 'amor-tower-pakuwon-residences', '<p>A new Icon in The Heart of Bekasi</p>', '2020-01-27', '3d00a97fad_1579844342_20191015105457_video_378.jpg', '', '', '', 6),
(25, 'pakuwon', 'pakuwon', '<p>sadas asd a</p>', '0000-00-00', 'b9ee3a7536_1595780072_72a819b2c335b9850ddabda4da966cc0.jpg', '', '', '', 4),
(24, 'Siap Kirim 24 Jam Jabodetabek zzzzzzzzzzz', 'siap-kirim-24-jam-jabodetabek-zzzzzzzzzzz', '<p>sd sad asd zzzzzzzzzzzz</p>', '0000-00-00', 'ce1025445e_1595777340_yG5VOP.jpg', 'Siap Kirim 24 Jam Jabodetabek', '', 'sd sad asd ', 5),
(26, 'manager', 'manager', '', '0000-00-00', '231d686ae2_1595815192_hero_bg_4.jpg', '', '', '', 3),
(27, 'admin', 'admin', '', '0000-00-00', '8bb87e065f_1595816023_hero_bzg_1.jpg', '', '', '', 8),
(28, 'Hubungi Kami', 'hubungi-kami', '', '0000-00-00', '544dc10744_1595816080_img_3.jpg', '', '', '', 2),
(29, 'PAKUWON RESIDENCE BEKASI', 'pakuwon-residence-bekasi', '', '0000-00-00', '9914c975f7_1595819982_hero_bg_3.jpg', '', '', '', 7),
(30, 'sasass', 'sasass', '', '0000-00-00', 'dd795957d5_1595822359_img_5.jpg', '', '', '', 1),
(31, 'coba aja', 'coba-aja', '', '0000-00-00', '33e5491bea_1595825144_person_6.jpg', '', '', '', 9),
(32, 'Siap Kirim 24 Jam Jabodetabek zzzzz', 'siap-kirim-24-jam-jabodetabek-zzzzz', '', '0000-00-00', 'e9aa02efe4_1595833681_1026881.jpg', '', '', '', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `question_id` int(10) NOT NULL,
  `question` text DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `chapter_id` int(7) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `field_type` varchar(50) NOT NULL,
  `choice1` varchar(255) DEFAULT NULL,
  `choice2` varchar(255) DEFAULT NULL,
  `choice3` varchar(255) DEFAULT NULL,
  `choice4` varchar(255) DEFAULT NULL,
  `choice5` varchar(255) DEFAULT NULL,
  `choice6` varchar(255) DEFAULT NULL,
  `answer_choice` varchar(20) DEFAULT NULL,
  `answer_numeric` varchar(20) DEFAULT NULL,
  `answer_boolean` varchar(20) DEFAULT NULL,
  `required` int(1) NOT NULL DEFAULT 1,
  `paper_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `type`, `status`, `chapter_id`, `created_by`, `created_time`, `field_type`, `choice1`, `choice2`, `choice3`, `choice4`, `choice5`, `choice6`, `answer_choice`, `answer_numeric`, `answer_boolean`, `required`, `paper_id`) VALUES
(1, '<p>\n	Dari mana anda memperoleh informasi tentang Cahaya Metal Perkasa ?</p>\n', NULL, NULL, 1, NULL, NULL, '', 'Website', 'Relasi', 'Brosur ', 'Lainnya', NULL, NULL, NULL, NULL, NULL, 0, 1),
(2, '<p>\n	Apakah anda pernah berkunjung ke lokasi pabrik CMP ?</p>\n', NULL, NULL, 1, NULL, NULL, '', 'Seringkali', 'Pernah', 'Belum pernah ', 'Rencana', NULL, NULL, NULL, NULL, NULL, 0, 1),
(3, '<p>\n	Apakah anda puas dengan produk yang anda pesan (sesuai dengan mutu/spesifikasi) ?</p>\n', NULL, NULL, 2, NULL, NULL, '', 'Sangat puas', 'Puas', 'Cukup puas', 'Kurang puas', NULL, NULL, NULL, NULL, NULL, 0, 1),
(4, '<p>\n	Apakah anda merasa perlu untuk berkunjung ke lokasi pabrik ?</p>\n', 'radio', NULL, 1, NULL, NULL, '', 'Sangat perlu', 'Perlu', 'Terkadang perlu', 'Tidak perlu', NULL, NULL, NULL, NULL, NULL, 0, 1),
(5, '<p>\n	Apakah alamat pabrik CMP sulit ditemukan ?</p>\n', 'radio', NULL, 1, NULL, NULL, '', 'Sangat mudah', 'Mudah', 'Cukup mudah', 'Sulit', NULL, NULL, NULL, NULL, NULL, 0, 1),
(6, '<p>\n	Saran anda tentang lokasi dan alamat CMP</p>\n', 'comment', NULL, 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(7, '<p>\n	Apakah anda pernah menerima produk cacat yang kami kirim ?</p>\n', 'radio', '1', 2, NULL, NULL, '', 'Tidak pernah', 'Kadang-2', 'Pernah', 'Sering', NULL, NULL, NULL, NULL, NULL, 0, 1),
(8, '<p>\n	Apakah anda memperoleh panduan/pedoman atau manual pemasangan produk CMP ?</p>\n', 'radio', '1', 2, NULL, NULL, '', 'Selalu dapat', 'Dapat', 'Pernah dapat', 'Tidak pernah dapa', NULL, NULL, NULL, NULL, NULL, 0, 1),
(9, '<p>\n	Apakah harga produk CMP lebih murah dibandingkan perusahaan lain ?</p>\n', 'radio', '1', 2, NULL, NULL, '', 'Lebih murah', 'Cukup murah', 'Kadang2 lebih murah', 'Lebih mahal', NULL, NULL, NULL, NULL, NULL, 0, 1),
(10, '<p>\n	Saran anda tentang aspek produk :</p>\n', 'comment', '1', 2, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(11, '<p>\n	Apakah anda puas dengan layanan dari Bagian Marketing atau Gudang Pengiriman ?</p>\n', 'radio', '1', 3, NULL, NULL, '', 'Sangat puas', 'Puas', 'Kurang puas', 'Sangat Kurang puas', NULL, NULL, NULL, NULL, NULL, 0, 1),
(12, '<p>\n	Apakah produk yang anda pesan selalu diterima tepat waktu ?</p>\n', 'radio', '1', 3, NULL, NULL, '', 'Selalu tepat waktu', 'Tepat waktu', 'Kadang2 tepat waktu', 'Tidak pernah tepat waktu', NULL, NULL, NULL, NULL, NULL, 0, 1),
(13, '<p>\n	Apakah produk yang anda pesan selalu tepat jumlah saat diterima dilokasi perusahaan anda ?</p>\n', 'radio', '1', 3, NULL, NULL, '', 'Selalu tepat jumlah', 'Tepat jumlah', 'Kadang2 saja tepat jumlah', 'Tidak pernah tepat jumlah', NULL, NULL, NULL, NULL, NULL, 0, 1),
(14, '<p>\n	Apakah anda puas dengan layanan dokumen yang diserahkan CMP kepada anda ?</p>\n', 'radio', '1', 3, NULL, NULL, '', 'Sangat puas', 'Puas', 'Cukup puas ', 'Kurang puas', NULL, NULL, NULL, NULL, NULL, 0, 1),
(15, '<p>\n	Saran anda tentang aspek layanan :</p>\n', 'comment', '1', 3, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(16, '<p>\n	Apakah anda merasa aman berkunjung ke PT. CMP ?</p>\n', 'radio', '1', 4, NULL, NULL, '', 'Sangat aman', 'Aman', 'Kurang aman', 'Sangat Kurang aman', NULL, NULL, NULL, NULL, NULL, 0, 1),
(17, '<p>\n	Apakah cara kami melakukan packing / loading produk anda sudah sesuai standar K3L ?</p>\n', 'radio', '1', 4, NULL, NULL, '', 'Selalu sesuai standar', 'sesuai standar', 'Kadang2 sesuai standar', 'Tidak pernah sesuai standar', NULL, NULL, NULL, NULL, NULL, 0, 1),
(18, '<p>\n	Saran anda tentang aspek K3L :</p>\n', 'comment', '1', 4, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(19, '<p>\n	Apa alasan anda membeli produk CMP ?</p>\n', 'comment', '1', 5, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_boolean`
--

CREATE TABLE `question_boolean` (
  `id` int(10) NOT NULL,
  `answer` varchar(20) NOT NULL,
  `question_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_choice`
--

CREATE TABLE `question_choice` (
  `id` int(10) NOT NULL,
  `choice1` text NOT NULL,
  `choice2` text NOT NULL,
  `choice3` text DEFAULT NULL,
  `choice4` text DEFAULT NULL,
  `choice5` text DEFAULT NULL,
  `choice6` text DEFAULT NULL,
  `answer` varchar(20) NOT NULL,
  `question_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_numerical`
--

CREATE TABLE `question_numerical` (
  `id` int(10) NOT NULL,
  `answer` varchar(20) NOT NULL,
  `question_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedules`
--

CREATE TABLE `schedules` (
  `id_schedules` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `slug` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `judul_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `headline` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `isi_schedules` text COLLATE latin1_general_ci NOT NULL,
  `lokasi` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `jam_mulai` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT 1,
  `tag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `meta_title` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(200) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `lft` int(11) UNSIGNED NOT NULL,
  `rgt` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sections`
--

INSERT INTO `sections` (`id`, `lft`, `rgt`, `title`, `modified`) VALUES
(1, 1, 38, 'ROOT', '2018-03-07 05:14:38'),
(127, 2, 3, 'Home', '2012-05-31 06:59:48'),
(128, 4, 9, 'Computer', '2012-05-31 06:59:50'),
(129, 12, 13, 'Mobil', '2012-05-31 06:59:50'),
(130, 14, 23, 'Internet', '2012-05-31 06:59:50'),
(131, 24, 25, 'Security', '2012-05-31 06:59:50'),
(132, 10, 11, 'Tech', '2012-05-31 06:59:50'),
(133, 5, 6, 'Hardware', '2012-05-31 06:59:50'),
(134, 7, 8, 'Software', '2012-05-31 06:59:50'),
(135, 15, 16, 'Social Networks', '2012-05-31 06:59:50'),
(136, 17, 18, 'Video Sharing', '2012-05-31 06:59:50'),
(137, 21, 22, 'Web Applications', '2012-05-31 06:59:50'),
(138, 19, 20, 'Blogs', '2012-05-31 06:59:50'),
(139, 26, 27, 'menu 1', '2018-03-07 05:07:47'),
(140, 28, 29, 'menu 1', '2018-03-07 05:08:06'),
(141, 30, 31, 'dsdsdsdasdsd', '2018-03-07 05:08:14'),
(142, 32, 33, 'dsdsdsdasdsd', '2018-03-07 05:08:21'),
(143, 34, 35, 'mitrawahanaindonesia', '2018-03-07 05:13:11'),
(144, 36, 37, 'coba fikar', '2018-03-07 05:14:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekilasinfo`
--

CREATE TABLE `sekilasinfo` (
  `id_sekilas` int(5) NOT NULL,
  `info` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `sekilasinfo`
--

INSERT INTO `sekilasinfo` (`id_sekilas`, `info`, `tgl_posting`, `gambar`) VALUES
(1, 'Anak yang mengalami gangguan tidur, cenderung memakai obat2an dan alkohol berlebih saat dewasa.', '2010-04-11', 'news5.jpg'),
(2, 'WHO merilis, 30 persen anak-anak di dunia kecanduan menonton televisi dan bermain komputer.', '2010-04-11', 'news4.jpg'),
(3, 'Menurut peneliti di Detroit, orang yang selalu tersenyum lebar cenderung hidup lebih lama.', '2010-04-11', 'news3.jpg'),
(4, 'Menurut United Stated Trade Representatives, 25% obat yang beredar di Indonesia adalah palsu.', '2010-04-11', 'news2.jpg'),
(5, 'Presiden AS Barack Obama memesan Nasi Goreng di restoran Bali langsung dari Amerika', '2010-04-11', 'news1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_tag` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id_brand` int(5) NOT NULL,
  `judul` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_sertifikat` text CHARACTER SET utf8 DEFAULT NULL,
  `tgl_posting` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `meta_description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `sertifikat_views` int(11) DEFAULT 1,
  `username` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `price` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_categories` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `id_kategori`, `id_tag`, `id_brand`, `judul`, `slug`, `isi_sertifikat`, `tgl_posting`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`, `sertifikat_views`, `username`, `price`, `id_categories`) VALUES
(1, 0, '', 0, 'Cheerson Hobby ', 'cheerson-hobby', '', '2019-03-04 15:53:11', '320c7ae582_1551689590_Cheerson-Logo.jpg', '', '', '', 0, 'admin', '', 0),
(2, 0, '', 0, 'Walkera', 'walkera', '', '2019-03-04 15:54:04', '180c06ecd0_1551689644_walkera-logo-e1424242288604.jpg', '', '', '', 0, 'admin', '', 0),
(3, 0, '', 0, 'UDI RC Toys', 'udi-rc-toys', '', '2019-03-04 15:54:31', '18f49dcc34_1551689671_udi-LOGO-e1424241433194.png', '', '', '', 0, 'admin', '', 0),
(4, 0, '', 0, 'Syma Toys', 'syma-toys', '', '2019-03-04 15:54:48', '98a92de8d8_1551689688_syma-LOGO-e1424240768837.png', '', '', '', 0, 'admin', '', 0),
(5, 0, '', 0, 'JJRC (JJRC Toy Co. Ltd)', 'jjrc-jjrc-toy-co-ltd', '', '2019-03-04 15:55:11', 'de293800ec_1551689711_jjrc-logo.jpg', '', '', '', 0, 'admin', '', 0),
(6, 0, '', 0, 'Blade', 'blade', '', '2019-03-04 15:55:27', '81fa748eca_1551689727_BLADE_logo-e1424239070840.jpg', '', '', '', 0, 'admin', '', 0),
(7, 0, '', 0, 'Hubsan', 'hubsan', '', '2019-03-04 15:55:42', '023b0eb723_1551689742_hubsan-logo.jpg', '', '', '', 0, 'admin', '', 0),
(8, 0, '', 0, 'Autel Robotics', 'autel-robotics', '', '2019-03-04 15:55:59', '76d2383897_1551689759_AUTEL.jpg', '', '', '', 0, 'admin', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat_tagmap`
--

CREATE TABLE `sertifikat_tagmap` (
  `id_tagmap` int(5) NOT NULL,
  `tags_id` int(5) NOT NULL,
  `id_sertifikat` int(5) NOT NULL,
  `post_type` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat_tags`
--

CREATE TABLE `sertifikat_tags` (
  `tags_id` int(5) NOT NULL,
  `tags_title` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tags_description` text DEFAULT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id_services` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_tag` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id_brand` int(5) NOT NULL,
  `judul` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_services` text CHARACTER SET utf8 NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(100) CHARACTER SET utf8 NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) CHARACTER SET utf8 NOT NULL,
  `dibaca` int(5) DEFAULT 1,
  `services_views` int(11) DEFAULT 0,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `price` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_categories` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id_services`, `id_kategori`, `id_tag`, `id_brand`, `judul`, `slug`, `isi_services`, `created_time`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`, `dibaca`, `services_views`, `username`, `price`, `id_categories`) VALUES
(3, 0, '', 0, 'Instalasi PJU', 'instalasi-pju', '<p>Lampu jalan atau dikenal juga sebagai Penerangan Jalan Umum (PJU) adalah lampu yang digunakan untuk penerangan jalan dimalam hari sehingga mempermudah pejalan kaki, pesepeda dan pengendara kendaraan dapat melihat dengan lebih jelas jalan/medan yang akan dilalui pada malam hari, sehingga dapat meningkatkan keselamatan lalu lintas dan keamanan dari para pengguna jalan dari kegiatan/aksi kriminal.<br /><br />Penerangan jalan di kawasan perkotaan mempunyai fungsi antara lain :</p>\r\n<ul>\r\n<li>Menghasilkan kekontrasan antara obyek dan permukaan jalan</li>\r\n<li>Sebagai alat bantu navigasi pengguna jalan</li>\r\n<li>Meningkatkan keselamatan dan kenyamanan pengguna jalan, khususnya pada malam hari Mendukung keamanan lingkungan</li>\r\n<li>Memberikan keindahan lingkungan jalan.</li>\r\n</ul>\r\n<p>&nbsp;</p>', '2021-09-14 11:07:06', '277da6e14d_1631524695_pju.jpg', '', '', '', 1, 17, 'admin', NULL, 0),
(4, 0, '', 0, 'Instalasi Listrik', 'instalasi-listrik', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor</p>', '2021-09-14 11:07:34', 'fdafb86d9d_1631524954_listrik.jpg', '', '', '', 1, 6, 'admin', NULL, 0),
(5, 0, '', 0, 'Kontruksi', 'kontruksi', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor</p>', '2021-09-14 11:07:45', '653bd7a90a_1631524972_konstruksi.jpg', '', '', '', 1, 14, 'admin', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `services_tagmap`
--

CREATE TABLE `services_tagmap` (
  `id_tagmap` int(5) NOT NULL,
  `tags_id` int(5) NOT NULL,
  `id_services` int(5) NOT NULL,
  `post_type` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `services_tags`
--

CREATE TABLE `services_tags` (
  `tags_id` int(5) NOT NULL,
  `tags_title` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tags_description` text DEFAULT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `services_tags`
--

INSERT INTO `services_tags` (`tags_id`, `tags_title`, `slug`, `updated_at`, `created_at`, `tags_description`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, '', '0', '2020-08-19 00:43:52', '0000-00-00 00:00:00', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `tab` varchar(50) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `options` varchar(200) NOT NULL,
  `required` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`name`, `value`, `tab`, `field_type`, `options`, `required`) VALUES
('admin_email', 'fikarcare4u@gmail.com', 'email', 'text', '', 1),
('allow_comments', '1', 'comments', 'dropdown', '1=yes|0=no', 1),
('allow_registrations', 'true', 'users', 'dropdown', 'true=yes|false=no', 1),
('base_controller', 'pages', 'general', 'dropdown', 'blog=blog|pages=pages', 1),
('blog_description', 'A blog application written with CodeIgniter. Requires PHP and MySQL', 'general', 'text', '', 0),
('category_list_limit', '10', 'limits', 'dropdown', '10=10|20=20|30=30', 1),
('email_activation', 'true', 'users', 'dropdown', 'true=yes|false=no', 1),
('links_per_box', '10', 'limits', 'dropdown', '10=10|20=20|30=30', 1),
('mail_protocol', 'mail', 'email', 'dropdown', 'mail=mail|smtp=smtp|sendmail=sendmail', 1),
('manual_activation', 'false', 'users', 'dropdown', 'true=yes|false=no', 1),
('meta_description', '', 'seo', 'text', '', 0),
('meta_keyword', '', 'seo', 'text', '', 0),
('meta_title', '', 'seo', 'text', '', 0),
('mod_non_user_comments', '1', 'comments', 'dropdown', '1=yes|0=no', 1),
('mod_user_comments', '0', 'comments', 'dropdown', '1=yes|0=no', 1),
('months_per_archive', '10', 'limits', 'dropdown', '10=10|20=20|30=30', 1),
('posts_per_page', '10', 'limits', 'dropdown', '10=10|20=20|30=30', 1),
('recaptcha_private_key', '', 'captcha', 'text', '', 0),
('recaptcha_site_key', '', 'captcha', 'text', '', 0),
('sendmail_path', '/usr/sbin/sendmail', 'email', 'text', '', 0),
('server_email', 'fikarcare4u@gmail.com', 'email', 'text', '', 1),
('site_background', 'solartracker.jpg', 'general', 'image', '', 0),
('site_bg1', 'Hightmast.jpg', 'general', 'image', '', 0),
('site_description', ' General Contractor and Fabricator tiang lampu PJU dan lampu PJU solar panel dan battery', 'general', 'text', '', 0),
('site_favicon', 'logo-inkre_id.jpeg', 'general', 'image', '', 0),
('site_header', 'tianglistrik.jpg', 'general', 'image', '', 0),
('site_icon', 'logo-inkre_id.jpeg', 'general', 'image', '', 0),
('site_logo', 'site_logo_logo-inkre_id.jpeg', 'general', 'image', '', 0),
('site_name', 'PT Inter Nusa Kreasindo', 'general', 'text', '', 1),
('site_url', 'https://inkre.id/', 'general', 'text', '', 1),
('smtp_crypto', 'tls', 'email', 'dropdown', 'tls=TLS|ssl=SSL', 0),
('smtp_host', '', 'email', 'text', '', 0),
('smtp_pass', '', 'email', 'text', '', 0),
('smtp_port', '', 'email', 'text', '', 0),
('smtp_user', '', 'email', 'text', '', 0),
('use_honeypot', '0', 'captcha', 'dropdown', '1=yes|0=no', 1),
('use_recaptcha', '0', 'captcha', 'dropdown', '1=yes|0=no', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shoutbox`
--

CREATE TABLE `shoutbox` (
  `id_shoutbox` int(5) NOT NULL,
  `nama` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `website` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `shoutbox`
--

INSERT INTO `shoutbox` (`id_shoutbox`, `nama`, `website`, `pesan`, `tanggal`, `jam`, `aktif`) VALUES
(1, 'lukman', 'lukman.com', 'tes :-) aja ;-D ha ha ha <:D>', '2009-11-02', '00:00:00', 'Y'),
(2, 'hakim', 'hakim.com', 'tes :-) aja ;-D ha ha ha <:D>\r\ndfa\r\nfdas\r\nfdsa\r\nfdasf\r\n:-(', '2009-11-02', '00:00:00', 'Y'),
(5, 'iin', 'uin-suka.ac.id', 'tes aja euy ;-D boiii', '2016-10-20', '08:21:39', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slide`
--

CREATE TABLE `slide` (
  `id_slide` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_slide` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `position` int(8) NOT NULL DEFAULT 100
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slide`
--

INSERT INTO `slide` (`id_slide`, `judul`, `slug`, `isi_slide`, `tgl_posting`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`, `position`) VALUES
(24, 'PT Inter Nusa Kreasindo', 'pt-inter-nusa-kreasindo', '<p>General Contractor and Fabricator tiang lampu PJU dan lampu PJU solar panel dan battery</p>', '0000-00-00', 'f47cd9622a_1631528015_Monopole.jpg', 'Siap Kirim 24 Jam Jabodetabek', '', 'sd sad asd ', 1),
(28, 'Produsen Tiang Lampu PJU', 'produsen-tiang-lampu-pju', '<p>membuat dan melakukan pemasangan&nbsp;Tiang Lampu PJU berkualiatas</p>', '0000-00-00', 'ff63d427e3_1631535362_lampu_pju.jpg', 'Produsen Tiang Lampu PJU', '', 'membuat dan melakukan pemasangan Tiang Lampu PJU berkualiatas', 100),
(29, 'Mengutamakan Keselamatan', 'mengutamakan-keselamatan', '<p>keselamatan pekerja dan lingkukang sekitar dan produk yang aman digunakan.</p>', '0000-00-00', 'a092d3d2ce_1631535787_safetyfirst.jpg', 'Mengutamakan Keselamatan', '', 'keselamatan pekerja dan lingkukang sekitar dan produk yang aman digunakan.', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slides_groups`
--

CREATE TABLE `slides_groups` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `slides_groups`
--

INSERT INTO `slides_groups` (`id`, `name`, `slug`) VALUES
(1, 'home', 'home');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slides_lists`
--

CREATE TABLE `slides_lists` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `position` mediumint(8) UNSIGNED NOT NULL DEFAULT 100,
  `parent_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` smallint(4) UNSIGNED NOT NULL,
  `icon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_posting` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `slides_lists`
--

INSERT INTO `slides_lists` (`id`, `name`, `slug`, `content`, `position`, `parent_id`, `group_id`, `icon`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`, `tgl_posting`) VALUES
(2, 'ganti Lorem Ipsum placeholder text aaaaaaaaaaaaaaaa', 'ganti-lorem-ipsum-placeholder-text-aaaaaaaaaaaaaaaa-1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quam vulputate dignissim suspendisse in est ante in nibh mauris. Morbi tincidunt ornare massa eget egestas purus viverra accumsan. Neque vitae tempus quam pellentesque. Sit amet venenatis urna cursus eget nunc. Massa eget egestas purus viverra accumsan. Pharetra pharetra massa massa ultricies mi quis hendrerit. A erat nam at lectus. Tempus imperdiet nulla malesuada pellentesque elit. Quis imperdiet massa tincidunt nunc pulvinar sapien. Tincidunt dui ut ornare lectus sit amet est. Parturient montes nascetur ridiculus mus mauris vitae ultricies.</p>\r\n<p>Morbi tristique senectus et netus. Lectus proin nibh nisl condimentum. Quis hendrerit dolor magna eget est lorem ipsum. Nunc vel risus commodo viverra maecenas accumsan. Vel turpis nunc eget lorem dolor sed viverra ipsum. Pretium lectus quam id leo in vitae turpis massa. Mus mauris vitae ultricies leo integer. Ultricies tristique nulla aliquet enim tortor at. Felis donec et odio pellentesque diam. Id nibh tortor id aliquet. Eleifend donec pretium vulputate sapien. Senectus et netus et malesuada fames ac turpis egestas sed. Purus faucibus ornare suspendisse sed nisi lacus sed viverra. Ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget. Lacus sed turpis tincidunt id aliquet risus feugiat. Velit euismod in pellentesque massa placerat duis ultricies lacus sed. Ultrices vitae auctor eu augue ut lectus. Eget aliquet nibh praesent tristique.</p>', 2, 0, 1, 'fa-list', '59a8ee2c6d_1535540706_cnth.jpg', '', '', '', '2018-08-29'),
(3, 'Polyoretane', 'polyoretane-1', '', 3, 0, 1, 'fa-list', '83ac019986_1535542435_fc34f61d23b74be53ee07d469bd32064_XL.jpg', '', '', '', '0000-00-00'),
(4, 'Waterproofing Coating', 'waterproofing-coating-1', '<p>sdasdasdad</p>', 1, 0, 1, 'fa-list', 'bf3cfa4044_1535539712_2_gx8w8t.jpg', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slide_groups`
--

CREATE TABLE `slide_groups` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `slide_groups`
--

INSERT INTO `slide_groups` (`id`, `name`, `slug`) VALUES
(1, 'Slideshow', 'slideshow');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slide_lists`
--

CREATE TABLE `slide_lists` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `position` mediumint(8) UNSIGNED NOT NULL DEFAULT 100,
  `parent_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` smallint(4) UNSIGNED NOT NULL,
  `icon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_posting` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `slide_lists`
--

INSERT INTO `slide_lists` (`id`, `name`, `slug`, `content`, `position`, `parent_id`, `group_id`, `icon`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`, `tgl_posting`) VALUES
(1, 'Projectsku', 'projectsku', '', 1, 0, 1, 'fa-list', '', '', '', '', '0000-00-00'),
(2, 'contoh slideshow', 'contoh-slideshow', '', 2, 0, 1, 'fa-list-alt', '', '', '', '', '0000-00-00'),
(3, 'Type 2 Badroom new', 'type-2-badroom-new', '', 3, 0, 1, 'fa-list-alt', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staffs`
--

CREATE TABLE `staffs` (
  `staffs_id` int(11) NOT NULL,
  `staffs_nip` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `staffs_kode_absen` varchar(5) CHARACTER SET latin1 NOT NULL,
  `staffs_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `staffs_alias` varchar(50) CHARACTER SET latin1 NOT NULL,
  `staffs_address` text CHARACTER SET latin1 NOT NULL,
  `staffs_email` varchar(30) CHARACTER SET latin1 NOT NULL,
  `staffs_email_alternatif` varchar(30) CHARACTER SET latin1 NOT NULL,
  `staffs_phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `staffs_mobile` varchar(20) CHARACTER SET latin1 NOT NULL,
  `staffs_status_pajak` varchar(10) CHARACTER SET latin1 NOT NULL,
  `staffs_status_nikah` varchar(50) CHARACTER SET latin1 NOT NULL,
  `staffs_status_karyawan` int(5) DEFAULT NULL,
  `staffs_cabang` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `staffs_departement` int(5) DEFAULT NULL,
  `staffs_jabatan` int(5) DEFAULT NULL,
  `staffs_photo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `staffs_birthdate` date NOT NULL,
  `staffs_birthplace` varchar(20) CHARACTER SET latin1 NOT NULL,
  `staffs_sex` varchar(10) CHARACTER SET latin1 NOT NULL,
  `staffs_pendidikan` varchar(100) CHARACTER SET latin1 NOT NULL,
  `staffs_golongan_darah` varchar(5) CHARACTER SET latin1 NOT NULL,
  `staffs_agama` varchar(100) CHARACTER SET latin1 NOT NULL,
  `staffs_jumlah_anak` int(5) NOT NULL,
  `staffs_name_bank` varchar(100) CHARACTER SET latin1 NOT NULL,
  `staffs_name_rekening` varchar(100) CHARACTER SET latin1 NOT NULL,
  `staffs_no_rekening` int(15) NOT NULL,
  `staffs_family_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `staffs_family_phone` varchar(100) CHARACTER SET latin1 NOT NULL,
  `staffs_family_hubungan` varchar(100) CHARACTER SET latin1 NOT NULL,
  `staffs_password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `staffs_bpjs_tk` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `staffs_bpjs_ks` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `staffs_referensi` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `staffs_histori_promosi` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `staffs_hire_date` date DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `tgl_posting` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `id_categories` int(5) DEFAULT NULL,
  `staffs_jam_kerja` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `staffs`
--

INSERT INTO `staffs` (`staffs_id`, `staffs_nip`, `staffs_kode_absen`, `staffs_name`, `staffs_alias`, `staffs_address`, `staffs_email`, `staffs_email_alternatif`, `staffs_phone`, `staffs_mobile`, `staffs_status_pajak`, `staffs_status_nikah`, `staffs_status_karyawan`, `staffs_cabang`, `staffs_departement`, `staffs_jabatan`, `staffs_photo`, `staffs_birthdate`, `staffs_birthplace`, `staffs_sex`, `staffs_pendidikan`, `staffs_golongan_darah`, `staffs_agama`, `staffs_jumlah_anak`, `staffs_name_bank`, `staffs_name_rekening`, `staffs_no_rekening`, `staffs_family_name`, `staffs_family_phone`, `staffs_family_hubungan`, `staffs_password`, `staffs_bpjs_tk`, `staffs_bpjs_ks`, `staffs_referensi`, `staffs_histori_promosi`, `staffs_hire_date`, `slug`, `tgl_posting`, `gambar`, `id_categories`, `staffs_jam_kerja`) VALUES
(7, '0320912', '', 'A FAHRUL RODJI', 'A FAHRUL RODJI', 'Kp. Cilangkap Rt. 003 Rw. 013 Cilangkap Tapos', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Lina', '021-8362-6722', 'Saudara', '', NULL, NULL, NULL, NULL, '2012-11-30', 'a-fahrul-rodji', '2018-12-06 15:41:32', NULL, NULL, 1),
(48, '1691116', '', 'ABADUL MAROMI', 'ABADUL MAROM', 'Kampung Ciketing barat Rt. 003 Rw. 001 kelurahan ciketing udik bantar gebang bekasi', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Sumanan', '', 'Teman', '', NULL, NULL, NULL, NULL, '2016-12-05', 'abadul-maromi', '2018-12-06 15:41:32', NULL, NULL, 1),
(2, '0050909', '', 'ABDU ROHMAN', 'ABDU ROHMAN', 'Jln. Gang Asem Rt. 003 Rw. 012 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Rinawati', '0857-8125-2710', 'Pasangan', '', NULL, NULL, NULL, NULL, '2016-11-25', 'abdu-rohman', '2018-12-06 15:41:32', NULL, NULL, 1),
(49, '1781116', '', 'ABDUL AZIS', 'ABDUL AZIS', 'Jln. Tipar cakung Kp. Sukapura Rt. 011 Rw. 001 No. 31 B Cilincing Jakarta Utara', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Dede Syarif Hidayat', '', '', '', NULL, NULL, NULL, NULL, '2016-11-24', 'abdul-azis', '2018-12-06 15:41:32', NULL, NULL, 1),
(1, '0530114', '', 'ABDUL MUFID', 'ABDUL MUFID', 'Jl. Pasir Ciganjur Jagakarsa Cilandak', '', '', '', '', '', 'Menikah', NULL, '5', 1, 3, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-24', 'abdul-mufid', '2018-12-06 15:41:32', NULL, NULL, 1),
(50, '1421114', '', 'ADAM MALIK Y', 'ADAM MALIK Y', 'Jln. Narogong Pangkalan 5 Rt. 01 Rw. 06 Ds. Cikiwul Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Miskat', '0896-6702-0010', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-25', 'adam-malik-y', '2018-12-06 15:41:32', NULL, NULL, 1),
(51, '1040813', '', 'ADANG', 'ADAN', 'Kampung Ciketing Timur Rt. 001 Rw. 004 Kelurahan Ciketing Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-26', 'adang', '2018-12-06 15:41:32', NULL, NULL, 1),
(3, '0631014', '', 'AGUNG PRAYITNO', 'AGUNG PRAYITNO', 'Perum Pesona Prima Karanggan Blok A5 No. 11 Rt. 07 Rw. 04 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 3, 4, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-26', 'agung-prayitno', '2018-12-06 15:41:32', NULL, NULL, 1),
(4, '0150411', '', 'AGUNG SETIYO B', 'AGUNG SETIYO B', 'Rawa Lumbu Timur Terusan No. 50 B Rt. 05 Rw. 33 Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 3, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'B+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-27', 'agung-setiyo-b', '2018-12-06 15:41:32', NULL, NULL, 1),
(53, '11090717', '', 'AGUS HARIYANTO', 'AGUS HARIYANTO', 'Kampung Walahir Desa Nambo Kec. Kelapa Nunggal Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Mutami', '0878-7444-1856', '', '', NULL, NULL, NULL, NULL, '2016-11-28', 'agus-hariyanto', '2018-12-06 15:41:32', NULL, NULL, 1),
(5, '1060813', '', 'AGUS PRIYONO', 'AGUS PRIYONO', 'Perumahan Villa Gading Harapan desa kebalen kec. Babelan Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, 'Darma Jaya', '0878-8734-4983', '', '', NULL, NULL, NULL, NULL, '2016-11-28', 'agus-priyono', '2018-12-06 15:41:32', NULL, NULL, 1),
(52, '1641015', '', 'AGUS TIO P', 'AGUS TIO P', 'Desa Limus Nunggal Rt. 01 Rw. 03 Kec. Cilengsi Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-27', 'agus-tio-p', '2018-12-06 15:41:32', NULL, NULL, 1),
(6, '0621014', '', 'AHDI SUPRIADI', 'AHDI SUPRIAD', 'Gunung Putri Rt. 001 Rw. 012 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 2, 5, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-29', 'ahdi-supriadi', '2018-12-06 15:41:32', NULL, NULL, 1),
(8, '0250212', '', 'AHMAD FIRDAUS', 'AHMAD FIRDAU', 'Kp. Limus Nunggal Rt. 002 Rw. 003 Limus Nunggal Cileungsi Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMP', 'A+', 'Islam', 3, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-01', 'ahmad-firdaus', '2018-12-06 15:41:32', NULL, NULL, 1),
(54, '1651015', '', 'AHMAD HILMI', 'AHMAD HILMI', 'Kampung baru Rt. 02 Rw. 08 Kel. Cakung Barat Jakarta Jakarta Timur', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Hilmi', '0896-7641-9566', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-29', 'ahmad-hilmi', '2018-12-06 15:41:32', NULL, NULL, 1),
(55, '0501013', '', 'AHMAD RIYANT', 'AHMAD RIYANTO', 'Perum Taman Rahayu 7 Blok C8 No. 218 Rt. 06 Rw. 08 Ciketing Udik Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', NULL, '5', 9, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-30', 'ahmad-riyant', '2018-12-06 15:41:32', NULL, NULL, 4),
(56, '1161013', '', 'AJI ARSADI', 'AJI ARSADI', 'Jln. Okta No.58 Rt. 03 Rw. 03 Ciketing Udik Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Anan S', '0812-8322-6029', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-01', 'aji-arsadi', '2018-12-06 15:41:32', NULL, NULL, 1),
(58, '1731116', '', 'ALDI ALFARID', 'ALDI ALFARID', 'Jln. Kemandoran Rt. 06 Rw. 22 Pekayon Jaya Bekasi', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Saipul Anwar', '', '', '', NULL, NULL, NULL, NULL, '2016-12-02', 'aldi-alfarid', '2018-12-06 15:41:32', NULL, NULL, 1),
(59, '0660215', '', 'ALEX ALIYUDIN', 'ALEX ALIYUDI', 'Villa Mas Garden Blok C. 211 Rt. 002 Rw. 010 Kel. Perwira Kecamatan Bekasi Utara', '', '', '', '', '', 'Menikah', NULL, '5', 9, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-03', 'alex-aliyudin', '2018-12-06 15:41:32', NULL, NULL, 5),
(60, '1450215', '', 'ALLIQ KH', 'ALLIQ KH', 'Kampung Ciketing Udak Bantar Gebang Bekasi', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Muntianah', '0878-8910-0170', '', '', NULL, NULL, NULL, NULL, '2016-12-04', 'alliq-kh', '2018-12-06 15:41:32', NULL, NULL, 1),
(61, '0850817', '', 'ALMUTIA LIMA', 'ALMUTIA LIMA', 'Kp. Bojong Jln. Kenanga Raya No. 71 Rt. 01 Rw. 021 Abadi Jaya Kecamatan Sukma Jaya', '', '', '', '', '', 'Belum menikah', NULL, '5', 5, 3, '', '2018-12-06', '', 'Perempuan', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Anissha Mardatillah', '', '', '', NULL, NULL, NULL, NULL, '2016-12-05', 'almutia-lima', '2018-12-06 15:41:32', NULL, NULL, 1),
(90, '1141013', '', 'AMAN ANGKASA P', 'AMAN ANGKASA P', 'Ciketing Barat Rt. 03 Rw. 03 Ciketing Udik Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Anan', '', '', '', NULL, NULL, NULL, NULL, '2016-12-02', 'aman-angkasa-p', '2018-12-06 15:41:32', NULL, NULL, 1),
(62, '1751116', '', 'ANDI TRIANTO', 'ANDI TRIANTO', 'Jln. Arteri tol cibitung desa suka danau cikarang jawa barat', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Sanpardi', '0821-3813-6731', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-24', 'andi-trianto', '2018-12-06 15:41:32', NULL, NULL, 1),
(63, '1910317', '', 'ANDIK WAHYUDI', 'ANDIK WAHYUDI', 'Kampung Ciketing Udik Rt. 03 Rw. 02 Bantar Gebang Bekasi', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-25', 'andik-wahyudi', '2018-12-06 15:41:32', NULL, NULL, 1),
(64, '1721116', '', 'ANGGI JUNIKA', 'ANGGI JUNIKA', 'Gunung Putri Utara Rt. 02 Rw. 012 Gunung Putri Bogor', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Sanan', '', '', '', NULL, NULL, NULL, NULL, '2016-11-26', 'anggi-junika', '2018-12-06 15:41:32', NULL, NULL, 1),
(10, '0381112', '', 'ANNISHA M', 'ANNISHA M', 'Komplek Mutiara Juanda Blok F 24 Rt. 008 Rw. 019 Desa Abdi Jaya Depok', '', '', '', '', '', 'Menikah', NULL, '5', 5, 5, '', '2018-12-06', '', 'Perempuan', 'D III', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-03', 'annisha-m', '2018-12-06 15:41:32', NULL, NULL, NULL),
(65, '0590314', '', 'AQUILIZA MORA', 'AQUILIZA MORA', 'Cicadas Rt.01 Rw. 05 Gunung Putri Bogor', '', '', '', '', '', 'Belum menikah', NULL, '5', 9, 3, '', '2018-12-06', '', 'Perempuan', 'D I', 'A+', 'Islam', 0, '', '', 0, 'Yuli Rushanti', '0812-1164-6107', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-27', 'aquiliza-mora', '2018-12-06 15:41:32', NULL, NULL, 1),
(11, '0730915', '', 'ARDIAN', 'ARDIAN', 'Gunung Putri Rt. 001 Rw. 003 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', 0, '5', 6, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-04', 'ardian', '2018-12-06 15:41:32', NULL, NULL, 1),
(12, '0211211', '', 'ARIEF HAMBALI', 'ARIEF HAMBALI', 'Jln. Cengkeh No. 2 Rt. 05 Rw. 02 Desa Lubang Buaya Cipayung', '', '', '', '', '', 'Menikah', NULL, '5', 7, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-05', 'arief-hambali', '2018-12-06 15:41:32', NULL, NULL, 1),
(66, '1540815', '', 'ARY SUJONO', 'ARY SUJONO', 'Kp. Sarongge Rt. 015 Rw. 07 No. 10 De. Jati Sari Cileungsi Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-28', 'ary-sujono', '2018-12-06 15:41:32', NULL, NULL, 1),
(67, '1801116', '', 'ASEP SHAHRUDIN', 'ASEP SHAHRUDIN', 'Jln. Sedap Selera No. 21 Rt. 003 Rw. 003 Ciketing Udik Bantar Gebang Bekasi', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-29', 'asep-shahrudin', '2018-12-06 15:41:32', NULL, NULL, 1),
(68, '0810117', '', 'ASWAD', 'ASWA', 'Gang Swadaya Rt. 005 Rt. 002 Sukapura Cilincing Jakarta Utara', '', '', '', '', '', 'Menikah', NULL, '5', 9, 3, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-30', 'aswad', '2018-12-06 15:41:32', NULL, NULL, 4),
(13, '0751015', '', 'BADRU SALAM', 'BADRU SALAM', 'Gunung Putri Utara Rt. 01 Rw. 012 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 7, 6, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-24', 'badru-salam', '2018-12-06 15:41:32', NULL, NULL, 1),
(69, '1490415', '', 'BUDI MARYANTO', 'BUDI MARYANTO', 'Desa Pasir Angin Rt. 03 Rw. 04 Pasir Angin Cileungsi Bogor', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Sugiyanti', '0857-1817-1915', 'Saudara', '', NULL, NULL, NULL, NULL, '2016-11-24', 'budi-maryanto', '2018-12-06 15:41:32', NULL, NULL, 1),
(70, '0650215', '', 'CAMIN', 'CAMI', 'Kampung Kranggan Rt. 10 Rw. 06 Kel. Jati Sampurna Bekasi', '', '', '', '', '', 'Menikah', NULL, '5', 7, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 3, '', '', 0, 'Mani', '0858-8205-7783', 'Saudara', '', NULL, NULL, NULL, NULL, '2016-11-25', 'camin', '2018-12-06 15:41:32', NULL, NULL, 1),
(71, '0840417', '', 'CHOIRUL FATIKIN', 'CHOIRUL FATIKIN', 'Jerukan Rt. 05 Rw. 07 Dukuh Bayat Klaten Jawa Tengah', '', '', '', '', '', 'Belum menikah', NULL, '5', 2, 3, '', '2018-12-06', '', 'Laki-Laki', 'D III', 'A+', 'Islam', 0, '', '', 0, 'Edy Rohmad Widadi', '', '', '', NULL, NULL, NULL, NULL, '2016-11-26', 'choirul-fatikin', '2018-12-06 15:41:32', NULL, NULL, 1),
(72, '1590915', '', 'DADAN NURJAMAN', 'DADAN NURJAMAN', 'Genteng Rt. 02 Rw. 01 Pasanggrahan Sumedang Selatan', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-27', 'dadan-nurjaman', '2018-12-06 15:41:32', NULL, NULL, 1),
(14, '0391112', '', 'DENI SYAMSUDIN', 'DENI SYAMSUDIN', 'Gunung Putri Selatan Rt. 04 Rw. 02 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 7, 3, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-25', 'deni-syamsudin', '2018-12-06 15:41:32', NULL, NULL, 1),
(15, '0400713', '', 'DHENDHI BAGUS', 'DHENDHI BAGUS', 'Mandi Raja Kulon Rt. 06 Rw. 06 Mandi Raja Kulon Banjar Negara', '', '', '', '', '', 'Menikah', NULL, '5', 5, 3, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-26', 'dhendhi-bagus', '2018-12-06 15:41:32', NULL, NULL, 1),
(73, '11080717', '', 'DODI MULYADI', 'DODI MULYADI', 'Jln Tipar Cakung Kampung Baru Rt. 005 Rw. 008 Cakung Barat', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Marwih', '021-4683-5234', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-28', 'dodi-mulyadi', '2018-12-06 15:41:32', NULL, NULL, 1),
(16, '0240212', '', 'EDI SALIRO', 'EDI SALIRO', 'Kampung Limus Nunggal Rt. 01 Rw. 03 Cileungsi Bogor', '', '', '', '', '', 'Menikah', 0, '5', 4, 7, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-27', 'edi-saliro', '2018-12-06 15:41:32', NULL, NULL, 1),
(17, '0670515', '', 'EDY ROHMAD W', 'EDY ROHMAD W', 'Perum Griya Bukit Jaya Blok C 16 No. 18 Desa Tlajung Udik Gunung Putri Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 1, 3, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-28', 'edy-rohmad-w', '2018-12-06 15:41:32', NULL, NULL, 1),
(74, '1230314', '', 'EFENDI', 'EFENDI', 'Perum Taman Rahayu Blok D9 No. 80 Taman Rahayu Setu Cikarang', '', '', '', '', '', 'Menikah', 0, '5', 4, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, 'Enjang', '0822-1155-3807', '', '', NULL, NULL, NULL, NULL, '2016-11-29', 'efendi', '2018-12-06 15:41:32', NULL, NULL, 1),
(76, '1320914', '', 'FATKHUR R', 'FATKHUR R', 'Dusun Mangsulan Desa Jambon Kec. Pulokulon Grobogan Jawa TEngah', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Sri Wulandari', '0857-1572-9972', 'Saudara', '', NULL, NULL, NULL, NULL, '2016-12-01', 'fatkhur-r', '2018-12-06 15:41:32', NULL, NULL, 1),
(77, '1210314', '', 'FEBRIANGGA', 'FEBRIANGGA', 'Kp. Bojongsari Rt. 01 Rw. 02 Jati Sari Jati Asih Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Masda', '021-8344-3042', 'Saudara', '', NULL, NULL, NULL, NULL, '2016-12-02', 'febriangga', '2018-12-06 15:41:32', NULL, NULL, 1),
(18, '0480913', '', 'GALIH AL K', 'GALIH AL K', 'Kampung Kedung Hilir Suka Manah Cugenang Cianjur', '', '', '', '', '', 'Menikah', NULL, '5', 8, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Hendrayono', '0858-6336-9943', 'Saudara', '', NULL, NULL, NULL, NULL, '2016-11-29', 'galih-al-k', '2018-12-06 15:41:32', NULL, NULL, 1),
(78, '1611015', '', 'HANING MAHAWI', 'HANING MAHAWI D', 'Jl. RA Kartini Gg. Mawar Rt. 07 Rw. 03 Bekasi Timur Margahayu Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 3, '', '', 0, 'Sudaryono', '', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-03', 'haning-mahawi', '2018-12-06 15:41:32', NULL, NULL, 1),
(19, '0330912', '', 'HASANUDIN', 'HASANUDIN', 'Desa Nagrak Rt. 05 Rw. 03 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SD', 'A+', 'Islam', 3, '', '', 0, 'Suryana', '0877-8289-6779', 'Saudara', '', NULL, NULL, NULL, NULL, '2016-11-30', 'hasanudin', '2018-12-06 15:41:32', NULL, NULL, 1),
(80, '1480415', '', 'HENDI IRAWANSYAH', 'HENDI IRAWANSYA', 'Gunung Putri Utara Rt. 01 Rw. 013 Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-04', 'hendi-irawansyah', '2018-12-06 15:41:32', NULL, NULL, 1),
(20, '0270412', '', 'HERDYAN ADI', 'HERDYAN ADI N', 'Jln. Kesatuan No. 102 Desa Kukusan - Beji Depok', '', '', '', '', '', 'Menikah', NULL, '5', 5, 4, '', '2018-12-06', '', 'Laki-Laki', 'D III', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-01', 'herdyan-adi', '2018-12-06 15:41:32', NULL, NULL, NULL),
(21, '0090909', '', 'HERMANTO', 'HERMANTO', 'Kampung Limus Nunggal Rt. 04 Rw. 03 Cileungsi Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 7, '', '2018-12-06', '', 'Laki-Laki', 'SD', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-02', 'hermanto', '2018-12-06 15:41:32', NULL, NULL, 1),
(81, '1530815', '', 'HERY PRASTANTO', 'HERY PRASTANTO', 'Mangsulan Rt. 02 Rw. 04 Desa Jambon Pulokulon Jawa Tangah', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Mulyono', '0852-0179-0725', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-05', 'hery-prastanto', '2018-12-06 15:41:32', NULL, NULL, 1),
(82, '1681116', '', 'IMRON', 'IMRO', 'Pekon Pardasuka Rt. 001 Rw. 002 Kel Pardasuka Kota Agung', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-24', 'imron', '2018-12-06 15:41:32', NULL, NULL, 1),
(83, '0680515', '', 'INDRA PUJAMBAK', 'INDRA PUJAMBAK', 'Griya Pratama Mas Blok D 11 No 25 Rt. 10 Rw. 07 Cikarageman Setu Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 4, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, 'Mansyurmi', '0813-1460-6370', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-25', 'indra-pujambak', '2018-12-06 15:41:32', NULL, NULL, 1),
(84, '1821116', '', 'INDRA SETIADI', 'INDRA SETIADI', 'Ciketing Udik Rt. 03 Rw. 02 Bantar Gebang  Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-26', 'indra-setiadi', '2018-12-06 15:41:32', NULL, NULL, 1),
(85, '1381114', '', 'INDRA SURYANA', 'INDRA SURYAN', 'Gunung Putri Selatan Rt. 001 Rw. 008 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Riska', '0838-19777-217', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-27', 'indra-suryana', '2018-12-06 15:41:32', NULL, NULL, 1),
(86, '0690515', '', 'IRPAN', 'IRPA', 'Kampung Kamurang Rt. 03 Rw. 02 Citeurep Bogor', '', '', '', '', '', 'Menikah', 0, '5', 8, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, 'Rudi Irawan Putra', '', '', '', NULL, NULL, NULL, NULL, '2016-11-28', 'irpan', '2018-12-06 15:41:32', NULL, NULL, 1),
(87, '1050813', '', 'JHULANG ANDY S', 'JHULANG ANDY S', 'Kavling Bulak Perwira 2 Bekasi Jawa Barat', '', '', '', '', '', 'Menikah', 0, '5', 3, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Sutarmi', '085-880713700', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-29', 'jhulang-andy-s', '2018-12-06 15:41:32', NULL, NULL, 1),
(88, '1270314', '', 'JOKO SUPRIANTO', 'JOKO SUPRIANTO', 'Kp. Padurenan Rt. 03 Rw. 03 Duren Jaya Bekasi', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-30', 'joko-suprianto', '2018-12-06 15:41:32', NULL, NULL, 1),
(22, '0340912', '', 'JUMINO', 'JUMINO', 'Kampung Limus Nunggal Rt. 02 Rw. 03 Cileungsi Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SD', 'A+', 'Islam', 2, '', '', 0, 'Sarwono', '0815-1415-5468', '', '', NULL, NULL, NULL, NULL, '2016-12-03', 'jumino', '2018-12-06 15:41:32', NULL, NULL, 1),
(23, '0740915', '', 'KUNCONO', 'KUNCON', 'Jln. Rambutan Rt. 003 Rw.010 Karanggan Gunung Putri Bogor', '', '', '', '', '', 'Menikah', 0, '5', 6, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-04', 'kuncono', '2018-12-06 15:41:32', NULL, NULL, 1),
(89, '1470415', '', 'KUSNADI ARYA P', 'KUSNADI ARYA P', 'Kampung Kamurang Rt. 03 Rw. 02 Citerup Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Rudi Irawan Putra', '', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-01', 'kusnadi-arya-p', '2018-12-06 15:41:32', NULL, NULL, 1),
(9, '1621015', '', 'M DARMA G', 'M DARMA G', 'Gunung Putri Rt. 01 Rw. 013 Gunung Putri Bogor', '', '', '', '', '', 'Belum menikah', 0, '5', 4, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Suherman', '087770425158', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-02', 'm-darma-g', '2018-12-06 15:41:32', NULL, NULL, 1),
(125, '1250218', '', 'M FATHUR RAHMAN', 'M FATHUR RAHMA', 'Jln. Pulo Gebang No. 04 Rt. 013 Rw. 004 Cakung Jakarta Timur', '', '', '', '', '', 'Menikah', NULL, '5', 7, 3, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 1, '', '', 0, 'Maratul Basyitoh', '089653176837', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-02', 'm-fathur-rahman', '2018-12-06 15:41:32', NULL, NULL, 1),
(127, '1270318', '', 'M FITRA YULIAN', 'M FITRA YULIANT', 'Bojong Menteng RT.001 RW 006 Kel. Bojong Menteng Kec. Rawa Lumbu Kota Bekasi', '', '', '', '', '', 'Belum menikah', 0, '5', 8, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'B+', 'Islam', 0, '', '', 0, 'Fafa MD', '081311223361', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-03', 'm-fitra-yulian', '2018-12-06 15:41:32', NULL, NULL, 1),
(96, '0430713', '', 'M RUDI PURNAMA', 'M RUDI P', 'Kampung Sukamakmur Ciomas Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 9, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-25', 'm-rudi-purnama', '2018-12-06 15:41:32', NULL, NULL, 6),
(26, '0710815', '', 'M SHALEH', 'M SHALEH', 'Tipar Cakung Jakarta Timur', '', '', '', '', '', 'Menikah', NULL, '5', 9, 5, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-25', 'm-shaleh', '2018-12-06 15:41:32', NULL, NULL, 1),
(99, '1550815', '', 'M SHOLEKAN', 'M SHOLEKAN', 'Dusun Pasir Angin RT. 03 Rw. 04 Pasir Angin cileungsi Bogor', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-28', 'm-sholekan', '2018-12-06 15:41:32', NULL, NULL, 1),
(24, '0120810', '', 'M YAMIN', 'M YAMIN', 'Desa Pahlawan Setia Rt. 02 Rw. 01 Taruma Jaya Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 7, '', '2018-12-06', '', 'Laki-Laki', 'SMP', 'A+', 'Islam', 3, '', '', 0, 'Andi Sopian', '', '', '', NULL, NULL, NULL, NULL, '2016-12-05', 'm-yamin', '2018-12-06 15:41:32', NULL, NULL, 1),
(91, '1500415', '', 'MAARIZ RIZKI M', 'MAARIZ RIZKI M', 'Griya Pratama Mas Blok D8 Rt. 008 Rw. 007', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Suanci', '081219207677', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-03', 'maariz-rizki-m', '2018-12-06 15:41:32', NULL, NULL, 1),
(93, '1601015', '', 'MAHMUDI', 'MAHMUD', 'PErum Taman Rahayu Regency Blok C9 No. 224 Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 4, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-04', 'mahmudi', '2018-12-06 15:41:32', NULL, NULL, 1),
(94, '1120913', '', 'MAMAN', 'MAMA', 'Perum Senopati Blok D3 No. 8 Rt. 004 Rw. 005 sumur Batu Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-05', 'maman', '2018-12-06 15:41:32', NULL, NULL, 1),
(95, '1361114', '', 'MARJUKI', 'MARJUKI', 'Kampung Ciketing Udik Rt. 03 Rw. 03 Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'H . Samin', '0838-7576-1921', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-24', 'marjuki', '2018-12-06 15:41:32', NULL, NULL, 1),
(97, '1130913', '', 'MOH FAJAR', 'MOH FAJAR', 'Bakom Desa Limus Nunggal Cileungsi Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Sami', '081-9081-52675', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-26', 'moh-fajar', '2018-12-06 15:41:32', NULL, NULL, 1),
(98, '1791116', '', 'MOH GOJALI', 'MOH GOJALI', 'Kp. Ciketing Rt. 003 Rw. 007 Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-27', 'moh-gojali', '2018-12-06 15:41:32', NULL, NULL, 1),
(25, '1070913', '', 'MUCHASIN', 'MUCHASIN', 'Medan Satria Rt. 04 Rw. 03 Medan Satria Pondok Ungu Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Maryati', '0813-2848-9642', '', '', NULL, NULL, NULL, NULL, '2016-11-24', 'muchasin', '2018-12-06 15:41:32', NULL, NULL, 1),
(27, '0360912', '', 'MULYADI', 'MULYAD', 'Kp. Limus Nunggal Rt. 001 Rw. 003 Cileungsi Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMP', 'A+', 'Islam', 2, '', '', 0, 'Ranah Kurniasih', '0857-7262-3376', 'Pasangan', '', NULL, NULL, NULL, NULL, '2016-11-26', 'mulyadi', '2018-12-06 15:41:32', NULL, NULL, 1),
(100, '0830117', '', 'MUNGKAS MAULANA', 'MUNGKAS MAULANA', 'Gunung Putri Selatan Rt. 02 Rw. 08 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 9, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-29', 'mungkas-maulana', '2018-12-06 15:41:32', NULL, NULL, 5),
(128, '1280418', '', 'MUTHI KUSUMA S', 'MUTHI KUSUMA S', 'Jln. Lumbu Barat V No. 106 Rt. 004 Rw. 010 Rawa Lumbu Bekasi', '', '', '', '', '', 'Belum menikah', NULL, '5', 9, 3, '', '2018-12-06', '', 'Perempuan', 'SMA', 'O+', 'Islam', 0, '', '', 0, 'Arno Saswirachman', '08159921265', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-04', 'muthi-kusuma-s', '2018-12-06 15:41:32', NULL, NULL, 1),
(101, '1711116', '', 'NOERCAHYADI', 'NOERCAHYADI', 'Kranggan Mutia Rt. 001 Rw. 001 Kec. Gunung Putri Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-30', 'noercahyadi', '2018-12-06 15:41:32', NULL, NULL, 1),
(28, '1341114', '', 'NUR FEBRIYANTO', 'NUR FEBRIYANTO', 'Perum Limus Pratama Jln. Palem Raya Blok C7 No. 8 Limus Nunggal Cileungsi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Teguh Widodo', '0822-9701-0368', 'Teman', '', NULL, NULL, NULL, NULL, '2016-11-27', 'nur-febriyanto', '2018-12-06 15:41:32', NULL, NULL, 1),
(29, '0641014', '', 'NUR SALIM', 'NUR SALIM', 'Perum Pesona Prima Kranggan Blok A5 No. 1 Rt. 07 Rw. 04', '', '', '', '', '', 'Menikah', NULL, '5', 10, 3, '', '2018-12-06', '', 'Laki-Laki', 'D I', 'A+', 'Islam', 3, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-28', 'nur-salim', '2018-12-06 15:41:32', NULL, NULL, 1),
(30, '0370912', '', 'NURHASANUDIN', 'NURHASANUDIN', 'Kampung Tlajung Rt. 001 Rw. 007 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 10, 7, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-29', 'nurhasanudin', '2018-12-06 15:41:32', NULL, NULL, 1),
(31, '0130111', '', 'OKI WIJANARKO', 'OKI WIJANARK', 'Legenda Wisata zona Galileo Blok L9 No. 10 Wanaherang', '', '', '', '', '', 'Menikah', NULL, '5', 7, 5, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 2, '', '', 0, 'Kendarningrum', '021-862-1110', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-30', 'oki-wijanarko', '2018-12-06 15:41:32', NULL, NULL, 1),
(75, '0460913', '', 'PAIZAL', 'PAIZAL', 'Kp. Ciketing Udik Timur Rt. 001 Rw. 004 Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', NULL, '5', 9, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 3, '', '', 0, 'Herry', '', '', '', NULL, NULL, NULL, NULL, '2016-11-30', 'paizal', '2018-12-06 15:41:32', NULL, NULL, 6),
(32, '0770116', '', 'PANGGAH N', 'PANGGAH N', 'Komplek TNI AD Gang Nangka Rt. 005 Rw. 012 Tapos Depok Jawa Barat', '', '', '', '', '', 'Menikah', NULL, '5', 5, 3, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 0, '', '', 0, 'Reni Heriyati', '0813-8275-626', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-01', 'panggah-n', '2018-12-06 15:41:32', NULL, NULL, 1),
(102, '0800816', '', 'PITOYO', 'PITOYO', 'Komplek TWP TNI AL Blok D 17 No. 4 Rt. 001 Rw. 021 Ciangsana Gunung Putri Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 9, 6, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 5, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-01', 'pitoyo', '2018-12-06 15:41:32', NULL, NULL, 1),
(103, '0790716', '', 'RAFIN AKBAR', 'RAFIN AKBAR V', 'Jln Pulo Sirih Utara Raya Blok DA No. 111 RT. 01  Rw. 014 Pekayon Jaya Bekasi', '', '', '', '', '', 'Belum menikah', NULL, '5', 11, 3, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 0, '', '', 0, 'Nuraini', '0813-1674-0369', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-02', 'rafin-akbar', '2018-12-06 15:41:32', NULL, NULL, 1),
(104, '1570815', '', 'RAHMAT HIDAYAT', 'RAHMAT HIDAYAT', 'Kampung Pisang Batu Rt. 001 Rw. 001 Pahlawan Setia', '', '', '', '', '', 'Menikah', 0, '5', 4, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'M. Yamin', '', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-03', 'rahmat-hidayat', '2018-12-06 15:41:32', NULL, NULL, 1),
(105, '1430215', '', 'RANGGA MAULANA', 'RANGGA MAULANA', 'Jln. KH. Nasir Kampung Lemper Rt. 03 Rw. 06 Citeurep Bogor', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-24', 'rangga-maulana', '2018-12-06 15:41:32', NULL, NULL, 1),
(106, '0861017', '', 'RENDI ROKHMAN', 'RENDI ROKHMAN', 'Jln. Anggoro Manis No. 4 Rt. 49 Rw. 02 Manis Rejo Madiun', '', '', '', '', '', 'Menikah', NULL, '5', 1, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-25', 'rendi-rokhman', '2018-12-06 15:41:32', NULL, NULL, 1),
(107, '0700515', '', 'RIDWAN SEPTIAN', 'RIDWAN SEPTIAN', 'Kampung Tengah Rt. 02 Rw. 05 Desa Cileungsi Bogor', '', '', '', '', '', 'Belum menikah', NULL, '5', 12, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-26', 'ridwan-septian', '2018-12-06 15:41:32', NULL, NULL, 1),
(33, '0720915', '', 'ROHMAN', 'ROHMAN', 'Gunung Putri Rt. 01 Rw. 013', '', '', '', '', '', 'Menikah', NULL, '5', 6, 7, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-02', 'rohman', '2018-12-06 15:41:32', NULL, NULL, 1),
(108, '1661015', '', 'RONI HERYANA', 'RONI HERYANA', 'Gunung Putri Rt. 01 Rw. 13 Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, 'Nana Diana', '085210507134', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-27', 'roni-heryana', '2018-12-06 15:41:32', NULL, NULL, 1),
(34, '0540214', '', 'RUDI IRAWAN', 'RUDI IRAWAN P', 'Kampung Kamurang Rt. 03 Rw. 02 Citereup Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 8, 7, '', '2018-12-06', '', 'Laki-Laki', 'D III', 'A+', 'Islam', 1, '', '', 0, 'Khotimah', '0857-2136-6331', 'Pasangan', '', NULL, NULL, NULL, NULL, '2016-12-03', 'rudi-irawan', '2018-12-06 15:41:32', NULL, NULL, 1),
(109, '1260314', '', 'RUDI SAJIM', 'RUDI SAJIM', 'Kampung ciketing Barat Rt. 02 Rw. 03 Ciketing Udik', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-28', 'rudi-sajim', '2018-12-06 15:41:32', NULL, NULL, 1),
(110, '11110717', '', 'RULI ADITIAR', 'RULI ADITIAR', 'Jln. Manggis 2 Kampung Poncol Bulak Rt. 07 Rw. 04 Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Saipul Anwar', '', '', '', NULL, NULL, NULL, NULL, '2016-11-29', 'ruli-aditiar', '2018-12-06 15:41:32', NULL, NULL, 1),
(111, '1670116', '', 'RULLY IMANTO', 'RULLY IMANTO', 'Kampung Rawa Kalong Rt. 01 Rw. 04 No. 49 A', '', '', '', '', '', 'Menikah', 0, '5', 4, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 3, '', '', 0, 'Nur Salim', '', '', '', NULL, NULL, NULL, NULL, '2016-11-30', 'rully-imanto', '2018-12-06 15:41:32', NULL, NULL, NULL),
(112, '0871017', '', 'SAEFULLAH', 'SAEFULLAH', 'Kampung Muara Gembong Rt. 001 Rw. 004 Desa Pantai Sederhana Kec. Muara Gembong Bekasi', '', '', '', '', '', 'Menikah', NULL, '5', 9, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, 'Irpan', '', '', '', NULL, NULL, NULL, NULL, '2016-12-01', 'saefullah', '2018-12-06 15:41:32', NULL, NULL, 4),
(35, '0600514', '', 'SAIFUL ANWAR', 'SAIFUL ANWAR', 'Jln.Kemandoran No.22 Rt. 06 Rw. 22 Pekayon Bekasi', '', '', '', '', '', 'Menikah', NULL, '5', 11, 7, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-04', 'saiful-anwar', '2018-12-06 15:41:32', NULL, NULL, 1),
(113, '1181013', '', 'SAMIN SUDRAJAT', 'SAMIN SUDRAJAT', 'Kampung Ciketing Barat Rt. 003 Rw. 003 Ciketing Udik', '', '', '', '', '', 'Menikah', 0, '5', 3, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Nuri Susanti', '0857-7795-4578', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-02', 'samin-sudrajat', '2018-12-06 15:41:32', NULL, NULL, 1),
(36, '0350912', '', 'SANAN', 'SANA', 'Gunung Putri Bogor Rt. 001 Rw. 013', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMP', 'A+', 'Islam', 1, '', '', 0, 'Supriyatna', '0877-7035-3300', 'Teman', '', NULL, NULL, NULL, NULL, '2016-12-05', 'sanan', '2018-12-06 15:41:32', NULL, NULL, 1),
(129, '1290618', '', 'SANDRYANT', 'SANDRYANT', 'Jln. Cikunir Raya No. 10 Rt. 001 Rw 003 Jakamulya Bekasi Selatan', '', '', '', '', '', 'Belum menikah', NULL, '5', 8, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Rachmad Wahyudi', '', 'Tetangga', '', NULL, NULL, NULL, NULL, '2016-12-05', 'sandryant', '2018-12-06 15:41:32', NULL, NULL, 1),
(37, '0220112', '', 'SANTOSO', 'SANTOS', 'Mutiara Gading Timur Blok C15 No. 10 Mustika Jaya', '', '', '', '', '', 'Menikah', NULL, '5', 12, 5, '', '2018-12-06', '', 'Laki-Laki', 'S1', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-24', 'santoso', '2018-12-06 15:41:32', NULL, NULL, 1),
(114, '1811116', '', 'SARMAN', 'SARMAN', 'Kampung Sambi doyong Rt. 002 Rw. 004 Gunung Kaler', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Rudi Sajim', '', '', '', NULL, NULL, NULL, NULL, '2016-12-03', 'sarman', '2018-12-06 15:41:32', NULL, NULL, 1),
(115, '1440215', '', 'SIDIK NURDIANS', 'SIDIK NURDIANSA', 'Desa Jati Sari Rt. 015 Rw. 07 Cileungsi Bogor', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, 'Dian Nursanti', '087738266133', '', '', NULL, NULL, NULL, NULL, '2016-12-04', 'sidik-nurdians', '2018-12-06 15:41:32', NULL, NULL, 1),
(116, '1741116', '', 'SIGIT GUNAWA', 'SIGIT GUNAWA', 'Pondok Ungu Rt. 002 Rw. 003 Medan Satria  Bekasi', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-05', 'sigit-gunawa', '2018-12-06 15:41:32', NULL, NULL, 1),
(117, '1190214', '', 'SITI MASITOH', 'SITI MASITOH', 'Ciketing Barat Rt. 03 Rw. 02 Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 8, 2, '', '2018-12-06', '', 'Perempuan', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-24', 'siti-masitoh', '2018-12-06 15:41:32', NULL, NULL, 1),
(38, '0490913', '', 'SITI RESIKAFAT', 'SITI RESIKAFATI', 'Griya Kenari Mas Blok D10 No. 19 Rt. 04 Rw. 10 Cileungsi Kidul', '', '', '', '', '', 'Menikah', NULL, '5', 7, 3, '', '2018-12-06', '', 'Perempuan', 'D III', 'A+', 'Islam', 1, '', '', 0, 'Wawan Riswandi', '0877-7031-0189', '', '', NULL, NULL, NULL, NULL, '2016-11-25', 'siti-resikafat', '2018-12-06 15:41:32', NULL, NULL, 1),
(39, '0040909', '', 'SODERI', 'SODERI', 'Kp. Cicadas Gunung Putri Bogor', '', '', '', '', '', 'Menikah', NULL, '5', 12, 3, '', '2018-12-06', '', 'Laki-Laki', 'D III', 'A+', 'Islam', 1, '', '', 0, 'Ari Kuncoro', '', '', '', NULL, NULL, NULL, NULL, '2016-11-26', 'soderi', '2018-12-06 15:41:32', NULL, NULL, 1),
(40, '0780116', '', 'SRI LESTARI', 'SRI LESTARI', 'Perum Permata Trias Jln Berlian 3 Blok B2 No.30 Cibitung Bekasi RT.009 RW. 026', '', '', '', '', '', 'Menikah', NULL, '5', 9, 3, '', '2018-12-06', '', 'Perempuan', 'S1', 'AB+', 'Islam', 3, '', '', 0, 'Wahyuningsih', '021-88323909', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-11-27', 'sri-lestari', '2018-12-06 15:41:32', NULL, NULL, 1),
(41, '0550214', '', 'SRI NOVIANI', 'SRI NOVIANI', 'Kp. Babakan Rt. 02 Rw. 09 Ds. Bubulak Kec. Bogor Barat', '', '', '', '', '', 'Menikah', NULL, '5', 7, 3, '', '2018-12-06', '', 'Perempuan', 'S1', 'A+', 'Islam', 1, '', '', 0, 'Nde Oktavia Deviani', '0813-1601-7787', 'Saudara', '', NULL, NULL, NULL, NULL, '2016-11-28', 'sri-noviani', '2018-12-06 15:41:32', NULL, NULL, 3),
(42, '0111109', '', 'SUDARYONO', 'SUDARYONO', 'Jl. RA Kartini GG Mawar VIII Rt. 007 Rw. 003 Margahayu Bekasi Timur', '', '', '', '', '', 'Menikah', 0, '5', 2, 6, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-29', 'sudaryono', '2018-12-06 15:41:32', NULL, NULL, 1),
(118, '1090913', '', 'SUJANA', 'SUJANA', 'Taman Rahayu Regency B11 No. 232 Rt. 01 / 08', '', '', '', '', '', 'Menikah', 0, '5', 4, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Tuti Ayani', '082-1246-80305', '', '', NULL, NULL, NULL, NULL, '2016-11-25', 'sujana', '2018-12-06 15:41:32', NULL, NULL, 1),
(119, '1701116', '', 'SUJARWANTO', 'SUJARWANTO', 'Karang Petir Rt. 02 Rw. 05 Kalimanah Purbalingga', '', '', '', '', '', 'Belum menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-26', 'sujarwanto', '2018-12-06 15:41:32', NULL, NULL, 1),
(43, '0520114', '', 'SUMANAN', 'SUMANA', 'Taman ahayu Regency Blok 14 No. 331 Ciketing Udik Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 4, 2, '', '2018-12-06', '', 'Laki-Laki', 'D III', 'A+', 'Islam', 3, '', '', 0, 'Ahmad Rianto', '0813-8478-8902', 'Tetangga', '', NULL, NULL, NULL, NULL, '2016-11-30', 'sumanan', '2018-12-06 15:41:32', NULL, NULL, 1),
(120, '1520615', '', 'SUNANDAR', 'SUNANDAR', 'Kampung Ciketing Udik Rt. 001 Rw. 002 Kel. Sumur Batu', '', '', '', '', '', 'Menikah', 0, '5', 8, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, 'Aji Arsadi', '', '', '', NULL, NULL, NULL, NULL, '2016-11-27', 'sunandar', '2018-12-06 15:41:32', NULL, NULL, 1),
(121, '1560815', '', 'SUPRIYATNA', 'SUPRIYATNA', 'Gunung Putri Utara Rt. 001 Rw. 013 Gunung Putri Bogor', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-28', 'supriyatna', '2018-12-06 15:41:32', NULL, NULL, 1),
(44, '0511113', '', 'SUPRONO EDHI', 'SUPRONO EDHI', 'Pondok Ungu Permai Sektor V Blok H2 No. 74 Babelan  Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 8, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Purwo Pramono', '0821-2270-0094', 'Keluarga', '', NULL, NULL, NULL, NULL, '2016-12-01', 'suprono-edhi', '2018-12-06 15:41:32', NULL, NULL, 1),
(45, '0140111', '', 'TONI HADI W', 'TONI HADI W', 'Jln Raya Narong KM. 15 Pangkalan 6 Gang PP Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 4, 6, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, 'Sukini', '0852-3326-9283', 'Pasangan', '', NULL, NULL, NULL, NULL, '2016-12-02', 'toni-hadi-w', '2018-12-06 15:41:32', NULL, NULL, 1),
(122, '1510415', '', 'TRI UTOMO', 'TRI UTOMO', 'Graha Prima Blok M9 64 Rt. 01 Rw. 25 Desa Mabun Jaya Tambun Selatan', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Agus Suryanto', '0813-894-77812', '', '', NULL, NULL, NULL, NULL, '2016-11-29', 'tri-utomo', '2018-12-06 15:41:32', NULL, NULL, 1),
(123, '1870217', '', 'UDIN NURDIN', 'UDIN NURDIN', 'Kampung Ciketing Selatan Rt. 03 Rw. 06 Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 8, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 2, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-11-30', 'udin-nurdin', '2018-12-06 15:41:32', NULL, NULL, 1),
(130, '1301018', '', 'UMAR JAELANI', 'UMAR JAELANI', '', '', '', '', '', '', 'Menikah', NULL, '5', 3, 3, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, NULL, 'umar-jaelani', '2018-12-06 15:41:32', NULL, NULL, 1),
(46, '11710113', '', 'WISNUGROHO', 'WISNUGROHO', 'Ciketing Udik Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 4, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Sukino', '0878-8904-0593', 'Saudara', '', NULL, NULL, NULL, NULL, '2016-12-03', 'wisnugroho', '2018-12-06 15:41:32', NULL, NULL, 1),
(124, '1580815', '', 'YOGI ANDREAN', 'YOGI ANDREAN', 'Dusun Karang Anyar Rt. 016 Rw. 003 Kel Kebon Danas Kecamatan Pusaka Jaya', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, '2016-12-01', 'yogi-andrean', '2018-12-06 15:41:32', NULL, NULL, 1),
(47, '1110913', '', 'YUDI ERIYANTO', 'YUDI ERIYANTO', 'Ciketing Udik Rt. 002 Rw. 004 Ciketing Udik Bantar Gebang Bekasi', '', '', '', '', '', 'Menikah', 0, '5', 2, 2, '', '2018-12-06', '', 'Laki-Laki', 'SMA', 'A+', 'Islam', 1, '', '', 0, 'Yuni Megawati', '0823-0019-4419', '', '', NULL, NULL, NULL, NULL, '2016-12-04', 'yudi-eriyanto', '2018-12-06 15:41:32', NULL, NULL, 1),
(131, '1311118', '', 'RULI IMANTO', '', '', '', '', '', '', '', '', NULL, '5', 4, 2, '', '0000-00-00', '', '', '', '', '', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, NULL, 'ruli-imanto', '2018-12-06 15:46:05', NULL, NULL, 1),
(132, '1321118', '', 'MAHMUDI', '', '', '', '', '', '', '', '', NULL, '5', 4, 2, '', '0000-00-00', '', '', '', '', '', 0, '', '', 0, '', '', '', '', NULL, NULL, NULL, NULL, NULL, 'mahmudi', '2018-12-06 15:46:05', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `staffs_tagmap`
--

CREATE TABLE `staffs_tagmap` (
  `id_tagmap` int(5) NOT NULL,
  `tags_id` int(5) NOT NULL,
  `staffs_id` int(5) NOT NULL,
  `post_type` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `staffs_tags`
--

CREATE TABLE `staffs_tags` (
  `tags_id` int(5) NOT NULL,
  `tags_title` varchar(100) CHARACTER SET latin1 NOT NULL,
  `slug` varchar(200) CHARACTER SET latin1 NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tags_description` text CHARACTER SET latin1 DEFAULT NULL,
  `gambar` varchar(100) CHARACTER SET latin1 NOT NULL,
  `meta_title` varchar(200) CHARACTER SET latin1 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET latin1 NOT NULL,
  `meta_description` varchar(200) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `statistik`
--

CREATE TABLE `statistik` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL DEFAULT 1,
  `online` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `statistik`
--

INSERT INTO `statistik` (`ip`, `tanggal`, `hits`, `online`) VALUES
('127.0.0.2', '2009-09-11', 1, '1252681630'),
('127.0.0.1', '2009-09-11', 17, '1252734209'),
('127.0.0.3', '2009-09-12', 8, '1252817594'),
('127.0.0.1', '2009-10-24', 8, '1256381921'),
('127.0.0.1', '2009-10-26', 108, '1256620074'),
('127.0.0.1', '2009-10-27', 52, '1256686769'),
('127.0.0.1', '2009-10-28', 124, '1256792223'),
('127.0.0.1', '2009-10-29', 9, '1256828032'),
('127.0.0.1', '2009-10-31', 3, '1257047101'),
('127.0.0.1', '2009-11-01', 85, '1257113554'),
('127.0.0.1', '2009-11-02', 11, '1257207543'),
('127.0.0.1', '2009-11-03', 165, '1257292312'),
('127.0.0.1', '2009-11-04', 59, '1257403499'),
('127.0.0.1', '2009-11-05', 10, '1257433172'),
('127.0.0.1', '2009-11-11', 13, '1258006911'),
('127.0.0.1', '2009-11-12', 10, '1258048069'),
('127.0.0.1', '2009-11-14', 14, '1258222519'),
('127.0.0.1', '2009-11-17', 2, '1258473856'),
('127.0.0.1', '2009-11-19', 16, '1258635469'),
('127.0.0.1', '2009-11-21', 4, '1258863505'),
('127.0.0.1', '2009-11-25', 3, '1259216216'),
('127.0.0.1', '2009-11-26', 1, '1259222467'),
('127.0.0.1', '2009-11-30', 11, '1259651841'),
('127.0.0.1', '2009-12-02', 9, '1259746407'),
('127.0.0.1', '2009-12-03', 17, '1259906128'),
('127.0.0.1', '2009-12-10', 69, '1260423794'),
('127.0.0.1', '2009-12-12', 26, '1260560082'),
('127.0.0.1', '2009-12-11', 5, '1260508621'),
('127.0.0.1', '2009-12-13', 8, '1260716786'),
('127.0.0.1', '2009-12-14', 9, '1260772698'),
('127.0.0.1', '2009-12-15', 9, '1260837158'),
('127.0.0.1', '2009-12-16', 7, '1260905627'),
('127.0.0.1', '2009-12-17', 48, '1261026791'),
('127.0.0.1', '2009-12-18', 11, '1261088534'),
('127.0.0.1', '2009-12-22', 3, '1261477278'),
('127.0.0.1', '2009-12-25', 2, '1261686043'),
('127.0.0.1', '2009-12-26', 29, '1261835507'),
('127.0.0.1', '2009-12-27', 7, '1261920445'),
('127.0.0.1', '2009-12-28', 3, '1261965611'),
('127.0.0.1', '2009-12-29', 21, '1262024011'),
('127.0.0.1', '2009-12-30', 24, '1262146708'),
('127.0.0.1', '2010-01-01', 12, '1262286131'),
('127.0.0.1', '2010-01-03', 38, '1262529325'),
('127.0.0.1', '2010-01-12', 89, '1263264291'),
('127.0.0.1', '2010-01-14', 54, '1263482540'),
('127.0.0.1', '2010-01-15', 57, '1263506901'),
('127.0.0.1', '2010-02-11', 30, '1265831568'),
('127.0.0.1', '2010-02-13', 2, '1266032303'),
('127.0.0.1', '2010-02-14', 3, '1266115347'),
('127.0.0.1', '2010-02-15', 15, '1266195235'),
('127.0.0.1', '2010-02-18', 1, '1266499945'),
('127.0.0.1', '2010-02-22', 5, '1266856332'),
('127.0.0.1', '2010-02-25', 46, '1267103145'),
('127.0.0.1', '2010-05-12', 10, '1273654648'),
('127.0.0.1', '2010-05-16', 195, '1274026185'),
('127.0.0.1', '2010-05-17', 2, '1274029517'),
('127.0.0.1', '2010-05-19', 1, '1274279374'),
('127.0.0.1', '2010-05-27', 16, '1274967085'),
('127.0.0.1', '2010-05-30', 4, '1275192045'),
('127.0.0.1', '2010-05-31', 13, '1275271939'),
('127.0.0.1', '2010-06-05', 1, '1275676869'),
('127.0.0.1', '2010-06-06', 2, '1275842170'),
('127.0.0.1', '2010-06-15', 3, '1276572924'),
('127.0.0.1', '2010-06-22', 206, '1277221605'),
('127.0.0.1', '2010-08-02', 17, '1280754660'),
('127.0.0.1', '2010-08-20', 7, '1282285305'),
('127.0.0.1', '2010-08-30', 21, '1283185430'),
('127.0.0.1', '2010-08-31', 53, '1283207455'),
('127.0.0.1', '2010-09-02', 133, '1283402651'),
('127.0.0.1', '2010-09-05', 35, '1283702206'),
('127.0.0.1', '2010-09-13', 10, '1284370291'),
('127.0.0.1', '2010-09-17', 12, '1284662303'),
('127.0.0.1', '2010-09-22', 2, '1285091212'),
('127.0.0.1', '2010-09-23', 47, '1285254071'),
('127.0.0.1', '2010-09-26', 32, '1285512806'),
('127.0.0.1', '2010-09-27', 48, '1285529871'),
('127.0.0.1', '2011-01-19', 18, '1295395096'),
('127.0.0.1', '2011-01-21', 6, '1295580166'),
('127.0.0.1', '2011-01-22', 3, '1295639704'),
('127.0.0.1', '2011-01-25', 2, '1295895420'),
('127.0.0.1', '2011-01-27', 20, '1296145564'),
('127.0.0.1', '2011-01-28', 5, '1296150116'),
('127.0.0.1', '2011-02-01', 10, '1296555613'),
('127.0.0.1', '2011-02-02', 1, '1296657225'),
('127.0.0.1', '2011-02-05', 3, '1296875908'),
('127.0.0.1', '2011-02-07', 5, '1297090649'),
('127.0.0.1', '2011-02-09', 182, '1297254341'),
('127.0.0.1', '2011-02-10', 268, '1297355704'),
('127.0.0.1', '2011-02-16', 6, '1297824002'),
('127.0.0.1', '2011-02-17', 2, '1297945065'),
('127.0.0.1', '2011-12-28', 12, '1325081007'),
('127.0.0.1', '2011-12-29', 13, '1325167281'),
('127.0.0.1', '2011-12-31', 34, '1325296088'),
('127.0.0.1', '2012-01-02', 1, '1325449458'),
('127.0.0.1', '2012-01-03', 55, '1325601219'),
('127.0.0.1', '2012-01-04', 1, '1325630436'),
('127.0.0.1', '2012-02-08', 86, '1328720292'),
('127.0.0.1', '2012-02-09', 110, '1328798857'),
('127.0.0.1', '2012-02-10', 87, '1328871532'),
('127.0.0.1', '2012-02-11', 16, '1328899301'),
('127.0.0.1', '2012-03-31', 87, '1333186737'),
('127.0.0.1', '2012-04-01', 69, '1333248528'),
('127.0.0.1', '2012-04-02', 9, '1333338582'),
('127.0.0.1', '2012-04-03', 31, '1333456570'),
('127.0.0.1', '2012-04-04', 2, '1333498207'),
('127.0.0.1', '2012-04-05', 5, '1333628029'),
('127.0.0.1', '2012-04-08', 22, '1333871463'),
('127.0.0.1', '2012-04-09', 109, '1333972788'),
('127.0.0.1', '2012-04-10', 70, '1334024998'),
('127.0.0.1', '2012-05-01', 8, '1335889888'),
('127.0.0.1', '2012-05-02', 17, '1335935829'),
('127.0.0.1', '2012-05-27', 6, '1338133681'),
('127.0.0.1', '2012-05-29', 22, '1338304361'),
('127.0.0.1', '2012-05-30', 5, '1338389383'),
('127.0.0.1', '2012-05-31', 5, '1338408772'),
('127.0.0.1', '2012-06-01', 5, '1338567612'),
('127.0.0.1', '2012-07-01', 10, '1341152776'),
('127.0.0.1', '2012-07-29', 12, '1343572702'),
('127.0.0.1', '2012-07-30', 15, '1343658587'),
('127.0.0.1', '2012-07-31', 179, '1343743877'),
('127.0.0.1', '2012-08-03', 11, '1344000498'),
('127.0.0.1', '2012-08-08', 28, '1344364863'),
('127.0.0.1', '2012-08-09', 7, '1344477542'),
('127.0.0.1', '2012-08-10', 1, '1344601882'),
('::1', '2016-10-18', 6, '1476804903'),
('::1', '2016-10-19', 8, '1476875211'),
('::1', '2016-10-20', 3, '1476945959'),
('::1', '2016-10-29', 317, '1477747478'),
('::1', '2016-10-30', 1, '1477784305'),
('::1', '2017-05-09', 20, '1494349047'),
('::1', '2017-05-10', 237, '1494421263'),
('::1', '2017-07-03', 159, '1499045917'),
('::1', '2018-01-18', 99, '1516291100'),
('::1', '2018-01-31', 14, '1517377692'),
('::1', '2018-02-03', 38, '1517671320'),
('::1', '2018-02-05', 9, '1517841086'),
('::1', '2018-02-12', 32, '1518443388'),
('::1', '2018-02-13', 4, '1518497507'),
('::1', '2018-02-17', 1, '1518801127'),
('::1', '2018-02-25', 34, '1519577937'),
('::1', '2018-02-26', 58, '1519584716'),
('::1', '2018-02-28', 46, '1519834907'),
('::1', '2018-03-01', 77, '1519920680'),
('192.168.43.1', '2018-03-01', 8, '1519903721'),
('::1', '2018-03-02', 24, '1520009623'),
('::1', '2018-03-03', 198, '1520096385'),
('::1', '2018-03-04', 87, '1520182764'),
('::1', '2018-03-05', 205, '1520268071'),
('::1', '2018-03-06', 3, '1520346052'),
('::1', '2018-03-07', 46, '1520428995'),
('::1', '2018-03-08', 2, '1520511907'),
('::1', '2018-03-09', 2, '1520589960'),
('::1', '2018-03-11', 1, '1520770527'),
('::1', '2018-03-12', 195, '1520873921'),
('::1', '2018-03-13', 647, '1520955236'),
('192.168.43.1', '2018-03-13', 14, '1520902335'),
('::1', '2018-03-14', 80, '1521014249'),
('::1', '2018-03-15', 203, '1521127082'),
('::1', '2018-03-16', 75, '1521212606'),
('::1', '2018-03-17', 48, '1521256647'),
('::1', '2018-03-19', 45, '1521478100'),
('::1', '2018-03-20', 369, '1521563245'),
('192.168.43.1', '2018-03-20', 4, '1521483707'),
('::1', '2018-03-21', 45, '1521632375'),
('::1', '2018-03-22', 116, '1521706693'),
('::1', '2018-03-27', 17, '1522143730'),
('::1', '2018-03-28', 391, '1522256380'),
('::1', '2018-03-29', 31, '1522335869'),
('::1', '2018-03-30', 32, '1522372630'),
('::1', '2018-03-31', 485, '1522507740'),
('::1', '2018-04-01', 534, '1522593354'),
('192.168.43.1', '2018-04-01', 48, '1522589683'),
('::1', '2018-04-02', 569, '1522690852'),
('::1', '2018-04-03', 14, '1522691065'),
('::1', '2018-04-18', 24, '1524029676'),
('::1', '2018-04-19', 15, '1524114795'),
('::1', '2018-04-22', 42, '1524401816'),
('::1', '2018-04-23', 148, '1524466852'),
('::1', '2018-04-24', 94, '1524554011'),
('::1', '2018-04-26', 249, '1524761704'),
('::1', '2018-04-27', 96, '1524804617'),
('::1', '2018-04-28', 84, '1524877820'),
('::1', '2018-04-30', 286, '1525048498'),
('::1', '2018-04-29', 4, '1525037757'),
('::1', '2018-05-03', 44, '1525381021'),
('::1', '2018-05-04', 2, '1525467832'),
('::1', '2018-05-05', 53, '1525507797'),
('::1', '2018-05-07', 284, '1525681450'),
('192.168.43.1', '2018-05-07', 15, '1525677785'),
('::1', '2018-05-08', 1290, '1525796303'),
('192.168.43.1', '2018-05-08', 345, '1525796186'),
('192.168.43.149', '2018-05-08', 1, '1525768845'),
('::1', '2018-05-09', 211, '1525853694'),
('192.168.43.1', '2018-05-09', 47, '1525846662'),
('::1', '2018-05-10', 96, '1525945276'),
('::1', '2018-05-11', 31, '1526062892'),
('::1', '2018-05-12', 1, '1526087069'),
('::1', '2018-05-13', 3, '1526221802'),
('127.0.0.1', '2018-05-14', 1, '1526274709'),
('::1', '2018-05-14', 206, '1526314041'),
('::1', '2018-05-16', 77, '1526495638'),
('::1', '2018-05-18', 468, '1526658136'),
('192.168.43.1', '2018-05-18', 84, '1526655799'),
('::1', '2018-05-19', 30, '1526737907'),
('::1', '2018-05-20', 368, '1526831197'),
('::1', '2018-05-21', 284, '1526890318'),
('192.168.43.1', '2018-05-21', 35, '1526890834'),
('::1', '2018-05-24', 134, '1527174307'),
('::1', '2018-05-25', 156, '1527273880'),
('::1', '2018-05-28', 21, '1527479643'),
('::1', '2018-05-29', 50, '1527602389'),
('::1', '2018-05-30', 30, '1527657783'),
('::1', '2018-05-31', 28, '1527738890'),
('::1', '2018-06-01', 18, '1527825232'),
('::1', '2018-06-02', 3, '1527919856'),
('::1', '2018-06-06', 24, '1528290674'),
('::1', '2018-06-07', 275, '1528397595'),
('::1', '2018-06-08', 50, '1528392960'),
('::1', '2018-06-09', 762, '1528578349'),
('::1', '2018-06-10', 296, '1528636692'),
('::1', '2018-06-22', 132, '1529682898'),
('::1', '2018-06-25', 24, '1529909525'),
('::1', '2018-06-26', 349, '1530034267'),
('::1', '2018-06-27', 78, '1530122210'),
('::1', '2018-07-11', 348, '1531311051'),
('::1', '2018-07-12', 937, '1531412665'),
('::1', '2018-07-13', 217, '1531504934'),
('::1', '2018-07-16', 15, '1531718086'),
('::1', '2018-07-20', 59, '1532102269'),
('::1', '2018-07-21', 35, '1532198766'),
('::1', '2018-07-22', 311, '1532282127'),
('::1', '2018-07-23', 187, '1532318683'),
('::1', '2018-07-24', 275, '1532458816'),
('::1', '2018-07-25', 147, '1532490542'),
('::1', '2018-07-26', 990, '1532629523'),
('::1', '2018-07-27', 69, '1532676016'),
('::1', '2018-07-28', 299, '1532794847'),
('::1', '2018-07-29', 138, '1532873535'),
('::1', '2018-07-30', 31, '1532945997'),
('::1', '2018-07-31', 55, '1533056136'),
('::1', '2018-08-03', 389, '1533314397'),
('::1', '2018-08-05', 63, '1533481068'),
('::1', '2018-08-07', 342, '1533636227'),
('::1', '2018-08-08', 220, '1533736659'),
('::1', '2018-08-09', 4, '1533802137'),
('::1', '2018-08-10', 50, '1533899514'),
('::1', '2018-08-15', 8, '1534341955'),
('::1', '2018-08-18', 50, '1534606362'),
('::1', '2018-08-20', 41, '1534791056'),
('::1', '2018-08-21', 769, '1534872541'),
('::1', '2018-08-22', 3120, '1534958932'),
('127.0.0.1', '2018-08-22', 1, '1534954547'),
('::1', '2018-08-23', 108, '1534996528'),
('::1', '2018-08-24', 370, '1535137007'),
('::1', '2018-08-25', 531, '1535208115'),
('::1', '2018-08-26', 272, '1535317526'),
('::1', '2018-08-27', 64, '1535348725'),
('::1', '2018-08-28', 293, '1535487346'),
('::1', '2018-08-29', 312, '1535549913'),
('::1', '2018-08-30', 643, '1535648318'),
('::1', '2018-08-31', 186, '1535733189'),
('::1', '2018-09-01', 70, '1535820559'),
('::1', '2018-09-01', 70, '1535820559'),
('::1', '2018-09-02', 16, '1535904784'),
('::1', '2018-09-03', 619, '1536003629'),
('::1', '2018-09-04', 295, '1536077367'),
('::1', '2018-09-05', 697, '1536169947'),
('::1', '2018-09-06', 110, '1536210449'),
('::1', '2018-09-07', 78, '1536322181'),
('::1', '2018-09-08', 58, '1536381743'),
('::1', '2018-09-09', 163, '1536514396'),
('::1', '2018-09-10', 37, '1536603402'),
('::1', '2018-09-12', 649, '1536773123'),
('::1', '2018-09-13', 188, '1536820938'),
('::1', '2018-09-14', 96, '1536891281'),
('::1', '2018-09-15', 167, '1537018612'),
('::1', '2018-09-16', 134, '1537126576'),
('::1', '2018-09-16', 134, '1537126576'),
('::1', '2018-09-17', 344, '1537200239'),
('::1', '2018-09-18', 5, '1537286504'),
('::1', '2018-09-21', 246, '1537520682'),
('::1', '2018-09-22', 107, '1537607602'),
('::1', '2018-09-24', 169, '1537814164'),
('::1', '2018-09-26', 23, '1537963865'),
('::1', '2018-10-07', 56, '1538924702'),
('::1', '2018-10-07', 56, '1538924702'),
('::1', '2018-10-09', 35, '1539054724'),
('::1', '2018-10-09', 35, '1539054724'),
('::1', '2018-10-10', 25, '1539186556'),
('::1', '2018-10-11', 5, '1539222454'),
('::1', '2018-10-12', 56, '1539319337'),
('::1', '2018-10-18', 1, '1539828026'),
('::1', '2018-10-30', 35, '1540917808'),
('::1', '2018-11-01', 26, '1541074922'),
('::1', '2018-11-02', 27, '1541176398'),
('::1', '2018-11-04', 72, '1541355914'),
('::1', '2018-11-08', 184, '1541709605'),
('::1', '2018-11-09', 87, '1541786887'),
('::1', '2018-11-17', 5, '1542463059'),
('::1', '2018-11-18', 33, '1542564090'),
('::1', '2018-11-19', 9, '1542647567'),
('::1', '2018-11-21', 4, '1542783500'),
('::1', '2018-11-24', 2, '1543074842'),
('::1', '2018-11-25', 11, '1543164711'),
('::1', '2018-11-27', 98, '1543340081'),
('::1', '2018-11-28', 2, '1543426375'),
('::1', '2018-12-01', 224, '1543696676'),
('::1', '2018-12-02', 157, '1543772499'),
('::1', '2018-12-03', 32, '1543835874'),
('::1', '2018-12-05', 230, '1544043932'),
('::1', '2018-12-06', 95, '1544101956'),
('::1', '2018-12-08', 20, '1544252210'),
('::1', '2018-12-10', 15, '1544459054'),
('::1', '2018-12-11', 3, '1544537084'),
('::1', '2018-12-12', 15, '1544582667'),
('::1', '2018-12-12', 15, '1544582667'),
('::1', '2018-12-14', 3, '1544811786'),
('::1', '2018-12-15', 11, '1544884210'),
('::1', '2018-12-15', 11, '1544884210'),
('::1', '2018-12-18', 2, '1545115611'),
('::1', '2018-12-20', 28, '1545317797'),
('::1', '2019-01-03', 7, '1546530480'),
('::1', '2019-01-25', 6, '1548398115'),
('::1', '2019-01-28', 106, '1548694906'),
('::1', '2019-02-06', 5, '1549438188'),
('::1', '2019-03-04', 153, '1551692534'),
('::1', '2019-03-07', 3, '1551964894'),
('::1', '2019-03-11', 14, '1552310440'),
('::1', '2019-03-12', 33, '1552367225'),
('::1', '2019-03-17', 154, '1552811681'),
('::1', '2019-03-19', 531, '1553019890'),
('192.168.43.1', '2019-03-19', 27, '1553013622'),
('::1', '2019-03-22', 56, '1553235347'),
('::1', '2019-03-27', 61, '1553707653'),
('::1', '2019-03-27', 61, '1553707653'),
('::1', '2019-03-28', 17, '1553784852'),
('::1', '2019-03-31', 1, '1554067970'),
('192.168.43.1', '2019-04-01', 1, '1554145530'),
('::1', '2019-04-09', 18, '1554781550'),
('::1', '2019-04-13', 110, '1555178523'),
('::1', '2019-04-14', 32, '1555219034'),
('::1', '2019-04-18', 131, '1555593642'),
('::1', '2019-04-19', 44, '1555666974');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_karyawan`
--

CREATE TABLE `status_karyawan` (
  `id_status_karyawan` int(5) NOT NULL,
  `name_status_karyawan` varchar(100) NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `isi_status_karyawan` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `position` int(8) NOT NULL DEFAULT 100
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_karyawan`
--

INSERT INTO `status_karyawan` (`id_status_karyawan`, `name_status_karyawan`, `slug`, `isi_status_karyawan`, `tgl_posting`, `gambar`, `position`) VALUES
(1, 'Kontrak', 'kontrak', '', '2018-11-08', '', 100),
(2, 'Tetap', 'tetap', '', '2018-11-08', '', 100),
(3, 'Harian', 'harian', '', '2018-11-08', '', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(5) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `shortname` varchar(15) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active',
  `course_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenu`
--

CREATE TABLE `submenu` (
  `id_sub` int(5) NOT NULL,
  `nama_sub` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_main` int(5) NOT NULL,
  `id_submain` int(11) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `adminsubmenu` enum('Y','N') NOT NULL,
  `arrange` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `submenu`
--

INSERT INTO `submenu` (`id_sub`, `nama_sub`, `link_sub`, `id_main`, `id_submain`, `aktif`, `adminsubmenu`, `arrange`) VALUES
(3, 'Struktur Organisasi', 'page/detail/struktur-organisasi', 3, 0, 'Y', 'N', NULL),
(4, 'Ekonomi', 'berita/kategori/ekonomi', 5, 0, 'N', 'N', NULL),
(5, 'Hiburan', 'berita/kategori/hiburan', 5, 0, 'Y', 'N', NULL),
(6, 'Olahraga', 'berita/kategori/olahraga', 5, 0, 'Y', 'N', NULL),
(7, 'Politik', 'berita/kategori/politik', 5, 0, 'Y', 'N', NULL),
(8, 'Teknologi', 'berita/kategori/teknologi', 5, 0, 'Y', 'N', NULL),
(11, 'Manajemen Modul', 'administrator/manajemenmodul', 14, 0, 'N', 'Y', NULL),
(10, 'Identitas Web', 'administrator/identitaswebsite', 14, 0, 'N', 'Y', NULL),
(12, 'Manajemen User', 'administrator/manajemenuser', 14, 0, 'N', 'Y', NULL),
(13, 'Manajemen Template', 'administrator/templatewebsite', 14, 0, 'N', 'Y', NULL),
(14, 'Menu Utama', 'administrator/menuutama', 15, 0, 'N', 'Y', NULL),
(15, 'Sub Menu', 'administrator/submenu', 15, 0, 'N', 'Y', NULL),
(16, 'Kategori Berita', 'administrator/kategoriberita', 16, 0, 'N', 'Y', NULL),
(17, 'Berita', 'administrator/berita', 16, 0, 'N', 'Y', NULL),
(18, 'Komentar', 'administrator/komentar', 16, 0, 'N', 'Y', NULL),
(19, 'Halaman Statis', 'administrator/halamanbaru', 16, 0, 'N', 'Y', NULL),
(20, 'Tag / Label', 'administrator/tagberita', 16, 0, 'N', 'Y', NULL),
(21, 'Sensor Kata', 'administrator/sensorkata', 16, 0, 'N', 'Y', NULL),
(22, 'Album', 'administrator/album', 52, 0, 'N', 'Y', NULL),
(23, 'Galeri Foto', 'administrator/galeri', 52, 0, 'N', 'Y', NULL),
(24, 'Download', 'administrator/download', 52, 0, 'N', 'Y', NULL),
(25, 'Agenda', 'administrator/agenda', 53, 0, 'N', 'Y', NULL),
(26, 'Poling', 'administrator/polling', 53, 0, 'N', 'Y', NULL),
(27, 'Sekilas Info', 'administrator/sekilasinfo', 53, 0, 'N', 'Y', NULL),
(30, 'ShoutBox', 'administrator/shoutbox', 53, 0, 'N', 'Y', NULL),
(37, 'Company', 'page/detail/profil-perusahaan', 3, 0, 'Y', 'Y', NULL),
(38, 'Ijin Operasional', 'page/detail/ijin-operasional-permata-safety', 3, 0, 'Y', 'N', NULL),
(39, 'Visi & Misi Permata Safety', 'page/detail/visi-misi-permata-safety', 3, 0, 'Y', 'N', NULL),
(40, 'Tambah Halaman', 'administrator/tambah_halamanbaru', 65, 0, 'N', 'Y', NULL),
(41, 'Jasa Konsultasi SMK3', 'page/detail/jasa-konsultasi-smk3', 66, 0, 'Y', 'N', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(5) NOT NULL,
  `nama_tag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tag_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `count` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `tag`
--

INSERT INTO `tag` (`id_tag`, `nama_tag`, `tag_seo`, `count`) VALUES
(1, 'Palestina', 'palestina', 7),
(2, 'Gaza', 'gaza', 11),
(9, 'Tenis', 'tenis', 5),
(10, 'Sepakbola', 'sepakbola', 7),
(8, 'Laskar Pelangi', 'laskar-pelangi', 2),
(11, 'Amerika', 'amerika', 18),
(12, 'George Bush', 'george-bush', 3),
(13, 'Browser', 'browser', 9),
(14, 'Google', 'google', 3),
(15, 'Israel', 'israel', 5),
(16, 'Komputer', 'komputer', 24),
(17, 'Film', 'film', 9),
(19, 'Mobil', 'mobil', 0),
(21, 'Gayus', 'gayus', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagmap`
--

CREATE TABLE `tagmap` (
  `id_tagmap` int(5) NOT NULL,
  `tags_id` int(5) NOT NULL,
  `id_berita` int(5) NOT NULL,
  `post_type` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tagmap`
--

INSERT INTO `tagmap` (`id_tagmap`, `tags_id`, `id_berita`, `post_type`) VALUES
(1, 1, 36, 'services');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tags`
--

CREATE TABLE `tags` (
  `tags_id` int(5) NOT NULL,
  `tags_title` varchar(100) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tags_description` text DEFAULT NULL,
  `gambar` varchar(100) NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tags`
--

INSERT INTO `tags` (`tags_id`, `tags_title`, `slug`, `updated_at`, `created_at`, `tags_description`, `gambar`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 'services tags', 'services-tags', '2018-09-03 03:17:35', '0000-00-00 00:00:00', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `templates`
--

CREATE TABLE `templates` (
  `id_templates` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pembuat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `folder` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `templates`
--

INSERT INTO `templates` (`id_templates`, `judul`, `pembuat`, `folder`, `aktif`) VALUES
(1, 'Default', 'Lukmanul Hakim', 'default', 'N'),
(17, 'pt-cmp', 'ahmad zulfikar', 'pt-cmp', 'N'),
(14, 'bisnis', 'Ahmad Zulfikar', 'bisnis', 'N'),
(15, 'alfajayatehnik', 'Ahmad Zulfikar', 'alfajayatehnik', 'N'),
(16, 'alfajayatehnikfix', 'fikarcare4u@gmail.com', 'alfajayatehnikfix', 'N'),
(18, 'logistics', 'Ahmad Zulfikar', 'logistics', 'N'),
(19, 'Pakuwon', 'Ahmad Zulfikar', 'pakuwon', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(2, '::1', 'admin', '$2y$12$fHx82oXiCqX39GPnNuS/jOsPIRWLxiqbGDNDV1IMnfx9LSh3zlJQ6', 'fikarcare4u@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1554102397, 1631586154, 1, 'Ahmad', 'Zulfikar', 'Fikar Web Design', '087888370521'),
(3, '::1', 'manager', '$2y$12$Vnee7XhzhGQm.hv7RYvB2O7Xk.ygjk6MDcTWqDxj.J/GZu6qSdX3C', 'info@multijayadiesel.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1556469346, 1559317579, 1, 'Abdul', 'Rohman', 'Multi Jaya Diesel', '087888370521');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(7, 2, 1),
(8, 2, 2),
(9, 2, 4),
(23, 3, 1),
(24, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`absen_id`);

--
-- Indeks untuk tabel `absen_jam_kerja`
--
ALTER TABLE `absen_jam_kerja`
  ADD PRIMARY KEY (`id_absen_jam_kerja`);

--
-- Indeks untuk tabel `absen_status`
--
ALTER TABLE `absen_status`
  ADD PRIMARY KEY (`id_absen_status`);

--
-- Indeks untuk tabel `adjacency_groups`
--
ALTER TABLE `adjacency_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `adjacency_lists`
--
ALTER TABLE `adjacency_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`);

--
-- Indeks untuk tabel `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `berita_tagmap`
--
ALTER TABLE `berita_tagmap`
  ADD PRIMARY KEY (`id_tagmap`);

--
-- Indeks untuk tabel `berita_tags`
--
ALTER TABLE `berita_tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indeks untuk tabel `categories_groups`
--
ALTER TABLE `categories_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories_lists`
--
ALTER TABLE `categories_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indeks untuk tabel `catmap`
--
ALTER TABLE `catmap`
  ADD PRIMARY KEY (`id_catmap`);

--
-- Indeks untuk tabel `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`chapter_id`);

--
-- Indeks untuk tabel `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indeks untuk tabel `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_clients`);

--
-- Indeks untuk tabel `clients_tagmap`
--
ALTER TABLE `clients_tagmap`
  ADD PRIMARY KEY (`id_tagmap`);

--
-- Indeks untuk tabel `clients_tags`
--
ALTER TABLE `clients_tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Indeks untuk tabel `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id_download`);

--
-- Indeks untuk tabel `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `exam_papers`
--
ALTER TABLE `exam_papers`
  ADD PRIMARY KEY (`paper_id`);

--
-- Indeks untuk tabel `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indeks untuk tabel `gallery_tagmap`
--
ALTER TABLE `gallery_tagmap`
  ADD PRIMARY KEY (`id_tagmap`);

--
-- Indeks untuk tabel `gallery_tags`
--
ALTER TABLE `gallery_tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hubungi`
--
ALTER TABLE `hubungi`
  ADD PRIMARY KEY (`id_hubungi`);

--
-- Indeks untuk tabel `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `katajelek`
--
ALTER TABLE `katajelek`
  ADD PRIMARY KEY (`id_jelek`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mainmenu`
--
ALTER TABLE `mainmenu`
  ADD PRIMARY KEY (`id_main`);

--
-- Indeks untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indeks untuk tabel `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id_pages`);

--
-- Indeks untuk tabel `payroll_options`
--
ALTER TABLE `payroll_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indeks untuk tabel `payroll_settings`
--
ALTER TABLE `payroll_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `poling`
--
ALTER TABLE `poling`
  ADD PRIMARY KEY (`id_poling`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_products`);

--
-- Indeks untuk tabel `products_tagmap`
--
ALTER TABLE `products_tagmap`
  ADD PRIMARY KEY (`id_tagmap`);

--
-- Indeks untuk tabel `products_tags`
--
ALTER TABLE `products_tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_projects`);

--
-- Indeks untuk tabel `projects_tagmap`
--
ALTER TABLE `projects_tagmap`
  ADD PRIMARY KEY (`id_tagmap`);

--
-- Indeks untuk tabel `projects_tags`
--
ALTER TABLE `projects_tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indeks untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indeks untuk tabel `question_boolean`
--
ALTER TABLE `question_boolean`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `question_choice`
--
ALTER TABLE `question_choice`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `question_numerical`
--
ALTER TABLE `question_numerical`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id_schedules`);

--
-- Indeks untuk tabel `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lft` (`lft`),
  ADD KEY `rgt` (`rgt`);

--
-- Indeks untuk tabel `sekilasinfo`
--
ALTER TABLE `sekilasinfo`
  ADD PRIMARY KEY (`id_sekilas`);

--
-- Indeks untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`);

--
-- Indeks untuk tabel `sertifikat_tagmap`
--
ALTER TABLE `sertifikat_tagmap`
  ADD PRIMARY KEY (`id_tagmap`);

--
-- Indeks untuk tabel `sertifikat_tags`
--
ALTER TABLE `sertifikat_tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_services`);

--
-- Indeks untuk tabel `services_tagmap`
--
ALTER TABLE `services_tagmap`
  ADD PRIMARY KEY (`id_tagmap`);

--
-- Indeks untuk tabel `services_tags`
--
ALTER TABLE `services_tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`name`);

--
-- Indeks untuk tabel `shoutbox`
--
ALTER TABLE `shoutbox`
  ADD PRIMARY KEY (`id_shoutbox`);

--
-- Indeks untuk tabel `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indeks untuk tabel `slides_groups`
--
ALTER TABLE `slides_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slides_lists`
--
ALTER TABLE `slides_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slide_groups`
--
ALTER TABLE `slide_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slide_lists`
--
ALTER TABLE `slide_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staffs_id`);

--
-- Indeks untuk tabel `staffs_tagmap`
--
ALTER TABLE `staffs_tagmap`
  ADD PRIMARY KEY (`id_tagmap`);

--
-- Indeks untuk tabel `staffs_tags`
--
ALTER TABLE `staffs_tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indeks untuk tabel `status_karyawan`
--
ALTER TABLE `status_karyawan`
  ADD PRIMARY KEY (`id_status_karyawan`);

--
-- Indeks untuk tabel `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indeks untuk tabel `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indeks untuk tabel `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indeks untuk tabel `tagmap`
--
ALTER TABLE `tagmap`
  ADD PRIMARY KEY (`id_tagmap`);

--
-- Indeks untuk tabel `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indeks untuk tabel `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id_templates`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `absen_jam_kerja`
--
ALTER TABLE `absen_jam_kerja`
  MODIFY `id_absen_jam_kerja` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `absen_status`
--
ALTER TABLE `absen_status`
  MODIFY `id_absen_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `adjacency_groups`
--
ALTER TABLE `adjacency_groups`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `adjacency_lists`
--
ALTER TABLE `adjacency_lists`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `attachment`
--
ALTER TABLE `attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `banner`
--
ALTER TABLE `banner`
  MODIFY `id_banner` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `berita_tagmap`
--
ALTER TABLE `berita_tagmap`
  MODIFY `id_tagmap` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `berita_tags`
--
ALTER TABLE `berita_tags`
  MODIFY `tags_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `categories_groups`
--
ALTER TABLE `categories_groups`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `categories_lists`
--
ALTER TABLE `categories_lists`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `catmap`
--
ALTER TABLE `catmap`
  MODIFY `id_catmap` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `chapter`
--
ALTER TABLE `chapter`
  MODIFY `chapter_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `clients`
--
ALTER TABLE `clients`
  MODIFY `id_clients` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `clients_tagmap`
--
ALTER TABLE `clients_tagmap`
  MODIFY `id_tagmap` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `clients_tags`
--
ALTER TABLE `clients_tags`
  MODIFY `tags_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT untuk tabel `departement`
--
ALTER TABLE `departement`
  MODIFY `id_departement` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `download`
--
ALTER TABLE `download`
  MODIFY `id_download` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `exam_papers`
--
ALTER TABLE `exam_papers`
  MODIFY `paper_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gallery_tagmap`
--
ALTER TABLE `gallery_tagmap`
  MODIFY `id_tagmap` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gallery_tags`
--
ALTER TABLE `gallery_tags`
  MODIFY `tags_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `hubungi`
--
ALTER TABLE `hubungi`
  MODIFY `id_hubungi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_identitas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `katajelek`
--
ALTER TABLE `katajelek`
  MODIFY `id_jelek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mainmenu`
--
ALTER TABLE `mainmenu`
  MODIFY `id_main` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `id_pages` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `payroll_options`
--
ALTER TABLE `payroll_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `payroll_settings`
--
ALTER TABLE `payroll_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `poling`
--
ALTER TABLE `poling`
  MODIFY `id_poling` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id_products` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `products_tagmap`
--
ALTER TABLE `products_tagmap`
  MODIFY `id_tagmap` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products_tags`
--
ALTER TABLE `products_tags`
  MODIFY `tags_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `id_projects` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `projects_tagmap`
--
ALTER TABLE `projects_tagmap`
  MODIFY `id_tagmap` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `projects_tags`
--
ALTER TABLE `projects_tags`
  MODIFY `tags_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `question_boolean`
--
ALTER TABLE `question_boolean`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `question_choice`
--
ALTER TABLE `question_choice`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `question_numerical`
--
ALTER TABLE `question_numerical`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id_schedules` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT untuk tabel `sekilasinfo`
--
ALTER TABLE `sekilasinfo`
  MODIFY `id_sekilas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `sertifikat_tagmap`
--
ALTER TABLE `sertifikat_tagmap`
  MODIFY `id_tagmap` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sertifikat_tags`
--
ALTER TABLE `sertifikat_tags`
  MODIFY `tags_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id_services` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `services_tagmap`
--
ALTER TABLE `services_tagmap`
  MODIFY `id_tagmap` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `services_tags`
--
ALTER TABLE `services_tags`
  MODIFY `tags_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `shoutbox`
--
ALTER TABLE `shoutbox`
  MODIFY `id_shoutbox` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `slide`
--
ALTER TABLE `slide`
  MODIFY `id_slide` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `slides_groups`
--
ALTER TABLE `slides_groups`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `slides_lists`
--
ALTER TABLE `slides_lists`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `slide_groups`
--
ALTER TABLE `slide_groups`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `slide_lists`
--
ALTER TABLE `slide_lists`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staffs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT untuk tabel `staffs_tagmap`
--
ALTER TABLE `staffs_tagmap`
  MODIFY `id_tagmap` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `staffs_tags`
--
ALTER TABLE `staffs_tags`
  MODIFY `tags_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `status_karyawan`
--
ALTER TABLE `status_karyawan`
  MODIFY `id_status_karyawan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id_sub` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tagmap`
--
ALTER TABLE `tagmap`
  MODIFY `id_tagmap` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `tags_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `templates`
--
ALTER TABLE `templates`
  MODIFY `id_templates` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
