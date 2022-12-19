-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Des 2022 pada 15.20
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nocturnal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `galangdana`
--

CREATE TABLE `galangdana` (
  `id_dana` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `waktu` date NOT NULL,
  `jenis` int(11) NOT NULL,
  `target` int(255) NOT NULL,
  `cerita` varchar(255) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `galangdana`
--

INSERT INTO `galangdana` (`id_dana`, `username`, `judul`, `tujuan`, `nama`, `waktu`, `jenis`, `target`, `cerita`, `gambar`) VALUES
(30, 'admin', 'Banjir Bandang Sumedang: Lokasi, Penyebab, Jumlah Korban Jiwa', 'Sumedang', 'Doma(Donasi Bersama)', '2023-12-16', 2, 100000000, 'Ada dua korban yang dilaporkan hilang akibat banjir di Dusun Cisurupan, Desa Sawahdadap, Kecamatan Cimanggung, Sumedang, Jawa Barat. Tim SAR gabungan berhasil menemukan keduanya dalam keadaan meninggal dunia pada Minggu (18/12/2022).', 'banjir.png'),
(31, 'admin', 'Terjangan Lahar Dingin Gunung Semeru Akibatkan Sumberlangsep Terisolir', 'Dusun Sumberlangsep, Desa Jugosari, Kecamatan Candipuro, Kabupaten Lumajang, Jawa Timur', 'Doma(Donasi Bersama)', '2023-11-01', 2, 500000000, '\"Lahar dingin ini lebih besar dari sebelum-sebelumnya. Dari tadi pagi pak kepala desa sudah standby untuk memantau masyarakat yang di sebelah sana di Dusun Sumberlangsep. Sekarang tidak ada pilihan, jembatan harus tutup,\"', '14.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_donasi`
--

CREATE TABLE `jenis_donasi` (
  `id_jenis` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_donasi`
--

INSERT INTO `jenis_donasi` (`id_jenis`, `nama`) VALUES
(1, 'medis'),
(2, 'bencana alam'),
(3, 'zakat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode`
--

CREATE TABLE `metode` (
  `id_metode` int(3) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `metode`
--

INSERT INTO `metode` (`id_metode`, `nama`) VALUES
(1, 'Gopay'),
(2, 'Link aja'),
(3, 'Dana'),
(4, 'QRIS'),
(5, 'BSI'),
(6, 'BCA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(11) NOT NULL,
  `id_dana` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nominal` int(255) NOT NULL,
  `metode` int(3) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `doa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`id_payment`, `id_dana`, `username`, `nominal`, `metode`, `nama`, `email`, `doa`) VALUES
(20, 31, 'sumbul', 30000, 1, 'muhammad sumbul', 'sumbul@gmail.com', 'Semoga diberi keselamatan dan lekas sembuh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `profil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id_profil`, `username`, `profil`) VALUES
(3, 'sumbul', '639edb4fc67d0.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `nama` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_tlpn` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`nama`, `username`, `tgl_lahir`, `email`, `no_tlpn`, `password`) VALUES
('admin', 'admin', '2022-12-24', 'admin@gmail.com', '021313434333', '$2y$10$vVUpQ69rMI4DLkcpbrXjT.oA00H/7FvIh/O8X9rilXx852fAzgXEm'),
('muhammad sumbul', 'sumbul', '2022-11-28', 'sumbul@gmail.com', '0213134342', '$2y$10$8Wb4OmwTP.iIcNNf8PrcHumN2EPPzxjPpNXuMtvzpS3XAxU9MKMHi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `galangdana`
--
ALTER TABLE `galangdana`
  ADD PRIMARY KEY (`id_dana`),
  ADD KEY `jenis` (`jenis`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `jenis_donasi`
--
ALTER TABLE `jenis_donasi`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `metode`
--
ALTER TABLE `metode`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_dana` (`id_dana`),
  ADD KEY `metode` (`metode`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `galangdana`
--
ALTER TABLE `galangdana`
  MODIFY `id_dana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `jenis_donasi`
--
ALTER TABLE `jenis_donasi`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `metode`
--
ALTER TABLE `metode`
  MODIFY `id_metode` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `galangdana`
--
ALTER TABLE `galangdana`
  ADD CONSTRAINT `galangdana_ibfk_1` FOREIGN KEY (`jenis`) REFERENCES `jenis_donasi` (`id_jenis`),
  ADD CONSTRAINT `galangdana_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`id_dana`) REFERENCES `galangdana` (`id_dana`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`metode`) REFERENCES `metode` (`id_metode`),
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
