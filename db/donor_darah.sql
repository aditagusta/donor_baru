-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jun 2020 pada 05.12
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donor_darah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `USERNAME` int(10) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `area`
--

CREATE TABLE `area` (
  `ID_AREA` int(11) NOT NULL,
  `ID_KOTA` int(11) NOT NULL,
  `ID_KECAMATAN` int(11) NOT NULL,
  `NAMA_AREA` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `area`
--

INSERT INTO `area` (`ID_AREA`, `ID_KOTA`, `ID_KECAMATAN`, `NAMA_AREA`) VALUES
(437, 0, 9, 'jati');

-- --------------------------------------------------------

--
-- Struktur dari tabel `butuh_darah`
--

CREATE TABLE `butuh_darah` (
  `ID` int(11) NOT NULL,
  `NAMA` varchar(150) NOT NULL,
  `JENIS_KELAMIN` varchar(150) NOT NULL,
  `GOLONGAN_DARAH` varchar(150) NOT NULL,
  `UNIT` int(11) NOT NULL,
  `RUMAH_SAKIT` text NOT NULL,
  `KOTA` varchar(150) NOT NULL,
  `KODE_POS` varchar(150) NOT NULL,
  `NAMA_DOKTER` varchar(150) NOT NULL,
  `JADWAL_BUTUH` date NOT NULL,
  `NAMA_KONTAK` varchar(150) NOT NULL,
  `ALAMAT` text NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `KONTAK_1` varchar(150) NOT NULL,
  `KONTAK_2` varchar(150) NOT NULL,
  `TUJUAN` text NOT NULL,
  `FOTO` varchar(150) NOT NULL,
  `STATUS` int(11) NOT NULL,
  `WAKTU` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `butuh_darah`
--

INSERT INTO `butuh_darah` (`ID`, `NAMA`, `JENIS_KELAMIN`, `GOLONGAN_DARAH`, `UNIT`, `RUMAH_SAKIT`, `KOTA`, `KODE_POS`, `NAMA_DOKTER`, `JADWAL_BUTUH`, `NAMA_KONTAK`, `ALAMAT`, `EMAIL`, `KONTAK_1`, `KONTAK_2`, `TUJUAN`, `FOTO`, `STATUS`, `WAKTU`) VALUES
(3, 'edo', 'Laki-Laki', 'A2B', 2, 'by pass', 'pekanbaru', '62468', 'ina', '2020-05-09', 'riri', 'andalas', 'edo@gmail.com', '0865489870', '0835636890', 'mau', 'request_image/200pakai-helm.jpg', 1, '2020-05-24'),
(4, 'aira', 'Perempuan', 'O+', 2, 'yos', 'padang', '0808', 'abi', '2020-05-11', 'kidia', 'tarantang', 'aira@gmail.com', '08468954464', '08467000865', 'butuh', 'request_image/3345.jpg', 2, '2020-05-29'),
(5, 'redo', 'Laki-Laki', 'A2B', 9, 'yos', 'padang', '0808', 'KK', '2020-05-16', 'KK', 'KM', 'mellysa@gmail.com', '0890789777', '0788888888', 'VH', 'request_image/2941Bismillah.gif', 0, '0000-00-00'),
(6, 'redo', 'Laki-Laki', 'A2B', 9, 'yos', 'padang', '0808', 'KK', '2020-05-16', 'KK', 'KM', 'mellysa@gmail.com', '0890789777', '0788888888', 'VH', 'request_image/9611Bismillah.gif', 0, '0000-00-00'),
(7, 'ESA', 'Laki-Laki', 'A2-', 6, 'BUIUJN', 'KHJM', '9008908', 'JOIHJOI', '2020-05-17', 'JHJKJMK', 'NMUI', 'SONIA@gmail.com', '68998887', '214354657', 'NYUI', 'request_image/531pl92757-traffic_sign.jpg', 2, '2020-05-08'),
(28, 'PIA', 'Perempuan', 'AB+', 66, 'MJKIOLL', 'PADABG', '979800', 'BGRFT', '2020-06-24', '09999789798', 'BJHFYI', 'rahmat@gmail.com', '08996899697', '12345675445', 'BVEOLI', 'request_image/64620160324_162412.jpg', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `ID_KECAMATAN` int(11) NOT NULL,
  `NAMA_KECAMATAN` varchar(150) NOT NULL,
  `ID_PROVINSI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`ID_KECAMATAN`, `NAMA_KECAMATAN`, `ID_PROVINSI`) VALUES
(1, 'Padang Utara', 1),
(2, 'Padang Timur', 1),
(3, 'Padang Barat', 1),
(4, 'Padang Selatan', 1),
(5, 'Pauh', 1),
(6, 'Kuranji', 1),
(9, 'Nanggalo', 1),
(11, 'Lubuk Begalung', 1),
(12, 'Lubuk Kilangan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `ID_KOTA` int(11) NOT NULL,
  `ID_PROVINSI` int(11) NOT NULL,
  `NAMA_KOTA` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`ID_KOTA`, `ID_PROVINSI`, `NAMA_KOTA`) VALUES
(6, 1, 'Padang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendonor`
--

CREATE TABLE `pendonor` (
  `ID_DONOR` int(11) NOT NULL,
  `NAMA` varchar(150) NOT NULL,
  `NAMA_ORTU` varchar(150) NOT NULL,
  `JENIS_KELAMIN` varchar(150) NOT NULL,
  `DATA_LAHIR` date NOT NULL,
  `GOLONGAN_DARAH` varchar(150) NOT NULL,
  `BERAT_BADAN` int(11) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `ALAMAT` text NOT NULL,
  `AREA` varchar(150) NOT NULL,
  `KOTA` varchar(150) NOT NULL,
  `KODE_POS` varchar(150) NOT NULL,
  `KECAMATAN` varchar(150) NOT NULL,
  `PROVINSI` varchar(150) NOT NULL,
  `KONTAK_1` varchar(150) NOT NULL,
  `KONTAK_2` varchar(150) NOT NULL,
  `RELAWAN` text NOT NULL,
  `KELOMPOK_RELAWAN` text NOT NULL,
  `PENDONOR_BARU` varchar(150) NOT NULL,
  `JADWAL_DONOR` date NOT NULL,
  `FOTO` varchar(150) NOT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendonor`
--

INSERT INTO `pendonor` (`ID_DONOR`, `NAMA`, `NAMA_ORTU`, `JENIS_KELAMIN`, `DATA_LAHIR`, `GOLONGAN_DARAH`, `BERAT_BADAN`, `EMAIL`, `ALAMAT`, `AREA`, `KOTA`, `KODE_POS`, `KECAMATAN`, `PROVINSI`, `KONTAK_1`, `KONTAK_2`, `RELAWAN`, `KELOMPOK_RELAWAN`, `PENDONOR_BARU`, `JADWAL_DONOR`, `FOTO`, `STATUS`) VALUES
(60, 'cece', 'xswd', 'Pria', '2020-05-01', 'B+', 21, 'irut@gmail.com', 'kota besar', 'qqqqq', '11', '678900', 'Padang Utara', 'Sumatera Barat', '0089786755', '08978675564', 'Tidak', 'Nill', 'Tidak', '2020-05-07', 'donor_image/469meja-kantor-utama-expo-mp-120-20173_521.png', 1),
(129, 'RARA', 'MIMO', 'Pria', '2020-05-11', 'O-', 90, 'SONIA@gmail.com', 'BALAI BARU', 'XXXX', '', '97980', 'Lubuk Kilangan', 'Sumatera Barat', '084344236487', '083423321342', 'Tidak', '', 'Tidak', '2020-05-31', 'donor_image/587lima-r.jpg', 0),
(134, 'JOJO', 'CACA', 'Pria', '2020-05-10', 'A1B', 78, 'rahmat@gmail.com', 'OLPI', 'WEW', '6', '7678678', 'Lubuk Begalung', 'Sumatera Barat', '12321452456', '04436889099', 'Ya', 'UOP', 'Tidak', '2020-05-31', 'donor_image/734PEPRUS.jpg', 0),
(136, 'BUBU', 'NUNU', 'Pria', '2020-05-06', 'A+', 60, 'mellysa@gmail.com', 'NMBY', 'TRTE', '6', '97980', 'Padang Utara', 'Sumatera Barat', '0567899', '856347699', 'Ya', 'PMI', 'Tidak', '2020-05-31', 'donor_image/527IMG_20160323_195259.jpg', 0),
(137, 'PAULINA', 'BTYU', 'Perempuan', '2020-06-01', 'B-', 55, 'mellysa@gmail.com', 'KJPOJOIJ', 'NJU', '6', '0908908', 'Lubuk Begalung', 'Sumatera Barat', '08865786899', '09789798989', 'Ya', 'NHU', 'Ya', '2020-06-09', 'donor_image/40720160325_180907.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `ID` int(11) NOT NULL,
  `NAMA` varchar(150) NOT NULL,
  `KONTAK` text NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `PESAN` text NOT NULL,
  `STATUS` text NOT NULL,
  `WAKTU` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`ID`, `NAMA`, `KONTAK`, `EMAIL`, `PESAN`, `STATUS`, `WAKTU`) VALUES
(1, 'SARAH', '983562335678', 'SARAH@gmail.com', 'HAYYY', '0', '2020-05-08 09:22:13'),
(3, 'rahmat', '0945683212235', 'rahmat@gmail.com', 'excuse me...', '0', '2020-05-08 16:24:42'),
(5, 'DERA', '084567445567', 'rahmat@gmail.com', 'TESTING', '0', '2020-05-16 22:37:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `ID_PROVINSI` int(11) NOT NULL,
  `NAMA_PROVINSI` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`ID_PROVINSI`, `NAMA_PROVINSI`) VALUES
(1, 'Sumatera Barat');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indeks untuk tabel `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`ID_AREA`);

--
-- Indeks untuk tabel `butuh_darah`
--
ALTER TABLE `butuh_darah`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`ID_KECAMATAN`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`ID_KOTA`);

--
-- Indeks untuk tabel `pendonor`
--
ALTER TABLE `pendonor`
  ADD PRIMARY KEY (`ID_DONOR`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`ID_PROVINSI`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `area`
--
ALTER TABLE `area`
  MODIFY `ID_AREA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=438;

--
-- AUTO_INCREMENT untuk tabel `butuh_darah`
--
ALTER TABLE `butuh_darah`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `ID_KECAMATAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `ID_KOTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pendonor`
--
ALTER TABLE `pendonor`
  MODIFY `ID_DONOR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `ID_PROVINSI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
