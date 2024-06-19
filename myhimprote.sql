-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2024 pada 16.48
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myhimprote`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `email` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`email`, `nama`, `departemen`, `jabatan`, `role`, `profile_image`) VALUES
('faridakhwan57@gmail.com', 'Haikal Rijaldi Putra', 'Departemen D', 'Staff Muda', 'user', 'https://lh3.googleusercontent.com/a/ACg8ocIo-r4rAhrXK362N2Pu3qDsd3RQjDvBt_wNWIhNw2aFFV4-kq53=s96-c'),
('faridakhwan57@students.unnes.ac.id', 'Farid Akhwan', 'Departemen F', 'Staff Muda', 'admin', 'https://lh3.googleusercontent.com/a/ACg8ocKLKMIp5r8TwWu4QW9fqP6iiNkjerzBib5cn9FE0_5L2915Ab0=s96-c');

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id`, `nama`, `program_id`) VALUES
(1, 'Publikasi dan Dokumentasi', 1),
(2, 'Acara', 1),
(3, 'Konsumsi', 1),
(4, 'Perlengkapan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaprogramdivisi`
--

CREATE TABLE `penggunaprogramdivisi` (
  `email_pengguna` varchar(255) NOT NULL,
  `program_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penggunaprogramdivisi`
--

INSERT INTO `penggunaprogramdivisi` (`email_pengguna`, `program_id`, `divisi_id`) VALUES
('faridakhwan57@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `konten` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `validasi` tinyint(1) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `divisi_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `post`
--

INSERT INTO `post` (`id`, `judul`, `konten`, `tanggal`, `validasi`, `program_id`, `divisi_id`, `file`, `kategori`) VALUES
(1, 'Pengumuman Rapat Persiapan', 'Rapat persiapan acara Elektro Bersuara 2024 akan dilaksanakan pada tanggal 20 Juni 2024.', '2024-06-15', 1, 1, 1, 'rapat_persiapan.docx', 'Persiapan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `programkerja`
--

CREATE TABLE `programkerja` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `ketua_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `programkerja`
--

INSERT INTO `programkerja` (`id`, `nama`, `deskripsi`, `ketua_email`) VALUES
(1, 'Elektro Bersuara 2024', 'Elektro Bersuara 2024 adalah forum inisiatif HIMPROTE Fakultas Teknik Universitas Negeri Semarang, membuka ruang bagi mahasiswa Teknik Elektro untuk menyampaikan aspirasi dan solusi inovatif kepada pihak birokrasi. Melalui dialog konstruktif, kami berharap menjembatani kesenjangan antara mahasiswa dan birokrasi, menciptakan lingkungan akademik yang inklusif dan responsif. Kegiatan ini bukan hanya wacana, tapi langkah konkret menuju perubahan positif bagi kemajuan bersama.', 'faridakhwan57@students.unnes.ac.id'),
(4, 'Ngopi Manis', 'Ngopa Ngopi', 'faridakhwan57@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indeks untuk tabel `penggunaprogramdivisi`
--
ALTER TABLE `penggunaprogramdivisi`
  ADD PRIMARY KEY (`email_pengguna`,`program_id`,`divisi_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `divisi_id` (`divisi_id`);

--
-- Indeks untuk tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `divisi_id` (`divisi_id`);

--
-- Indeks untuk tabel `programkerja`
--
ALTER TABLE `programkerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ketua_email` (`ketua_email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `programkerja`
--
ALTER TABLE `programkerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD CONSTRAINT `divisi_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programkerja` (`id`);

--
-- Ketidakleluasaan untuk tabel `penggunaprogramdivisi`
--
ALTER TABLE `penggunaprogramdivisi`
  ADD CONSTRAINT `penggunaprogramdivisi_ibfk_1` FOREIGN KEY (`email_pengguna`) REFERENCES `akun` (`email`),
  ADD CONSTRAINT `penggunaprogramdivisi_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programkerja` (`id`),
  ADD CONSTRAINT `penggunaprogramdivisi_ibfk_3` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`);

--
-- Ketidakleluasaan untuk tabel `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programkerja` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`);

--
-- Ketidakleluasaan untuk tabel `programkerja`
--
ALTER TABLE `programkerja`
  ADD CONSTRAINT `programkerja_ibfk_1` FOREIGN KEY (`ketua_email`) REFERENCES `akun` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
