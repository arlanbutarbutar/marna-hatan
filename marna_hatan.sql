-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Apr 2022 pada 14.51
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marna_hatan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_kursus`
--

CREATE TABLE `daftar_kursus` (
  `id_daftar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kursus` int(11) NOT NULL,
  `id_metode_bayar` int(11) NOT NULL,
  `id_status_bayar` int(11) NOT NULL DEFAULT 1,
  `bukti_bayar` varchar(100) NOT NULL,
  `tgl_kursus` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kursus`
--

CREATE TABLE `kursus` (
  `id_kursus` int(11) NOT NULL,
  `img_kursus` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `biaya` int(11) NOT NULL,
  `tgl_buat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_edit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_bayar`
--

CREATE TABLE `metode_bayar` (
  `id_metode` int(11) NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  `norek` varchar(50) NOT NULL,
  `an` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `metode_bayar`
--

INSERT INTO `metode_bayar` (`id_metode`, `metode_bayar`, `norek`, `an`) VALUES
(1, 'BNI', '24525422', 'MARNA HATAN'),
(2, 'BCA', '2352352', 'MARNA HATAN'),
(3, 'BRI', '3434235252352', 'MARNA HATAN'),
(4, 'Mandiri', '2524522523', 'MARNA HATAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_bayar`
--

CREATE TABLE `status_bayar` (
  `id_status_bayar` int(11) NOT NULL,
  `status_bayar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_bayar`
--

INSERT INTO `status_bayar` (`id_status_bayar`, `status_bayar`) VALUES
(1, 'Belum Bayar'),
(2, 'Proses Validasi'),
(3, 'Validasi Gagal'),
(4, 'Sudah Bayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT 2,
  `id_status` int(11) NOT NULL DEFAULT 1,
  `img_user` varchar(100) NOT NULL DEFAULT 'user.png',
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(75) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `ttl` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_status`, `img_user`, `username`, `first_name`, `last_name`, `email`, `password`, `nik`, `ttl`, `alamat`, `no_hp`, `date_created`) VALUES
(1, 1, 2, 'user.png', 'admin', 'super', 'admin', 'admin@gmail.com', '$2y$10$9DLXt0ziZfx1I.RHHSaFY.9D8L.8Fa/TLYFIEfbPNZfdP9Wxx6/JC', '1234567890123456', 'Kupang 12 Apr 2022', '-', '08110000000', '2022-04-12 14:43:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `roles` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id_role`, `roles`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_status`
--

CREATE TABLE `users_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_status`
--

INSERT INTO `users_status` (`id_status`, `status`) VALUES
(1, 'Akun Belum Aktif'),
(2, 'Akun Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar_kursus`
--
ALTER TABLE `daftar_kursus`
  ADD PRIMARY KEY (`id_daftar`),
  ADD KEY `id_kursus` (`id_kursus`),
  ADD KEY `id_metode_bayar` (`id_metode_bayar`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_status_bayar` (`id_status_bayar`);

--
-- Indeks untuk tabel `kursus`
--
ALTER TABLE `kursus`
  ADD PRIMARY KEY (`id_kursus`);

--
-- Indeks untuk tabel `metode_bayar`
--
ALTER TABLE `metode_bayar`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indeks untuk tabel `status_bayar`
--
ALTER TABLE `status_bayar`
  ADD PRIMARY KEY (`id_status_bayar`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_status` (`id_status`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `users_status`
--
ALTER TABLE `users_status`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `daftar_kursus`
--
ALTER TABLE `daftar_kursus`
  MODIFY `id_daftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kursus`
--
ALTER TABLE `kursus`
  MODIFY `id_kursus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `metode_bayar`
--
ALTER TABLE `metode_bayar`
  MODIFY `id_metode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `status_bayar`
--
ALTER TABLE `status_bayar`
  MODIFY `id_status_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users_status`
--
ALTER TABLE `users_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_kursus`
--
ALTER TABLE `daftar_kursus`
  ADD CONSTRAINT `daftar_kursus_ibfk_1` FOREIGN KEY (`id_kursus`) REFERENCES `kursus` (`id_kursus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `daftar_kursus_ibfk_2` FOREIGN KEY (`id_metode_bayar`) REFERENCES `metode_bayar` (`id_metode`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `daftar_kursus_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `daftar_kursus_ibfk_4` FOREIGN KEY (`id_status_bayar`) REFERENCES `status_bayar` (`id_status_bayar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `users_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `users_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
