-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tb_darah`;
CREATE TABLE `tb_darah` (
  `id_darah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_darah` varchar(255) NOT NULL,
  `ket` text NOT NULL,
  `stok` varchar(50) NOT NULL,
  PRIMARY KEY (`id_darah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tb_donor`;
CREATE TABLE `tb_donor` (
  `id_donor` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_darah` int(11) NOT NULL,
  `id_rs` int(11) DEFAULT NULL,
  `tgl_donor` datetime NOT NULL,
  `status` enum('Belum Diproses','Selesai Diproses','Dibatalkan','Ditunda') NOT NULL DEFAULT 'Belum Diproses',
  `tgl_booking` datetime NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_ortu` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_donor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tb_histori_darah`;
CREATE TABLE `tb_histori_darah` (
  `id_histori` int(11) NOT NULL AUTO_INCREMENT,
  `id_darah` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_catatan` date NOT NULL,
  PRIMARY KEY (`id_histori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tb_penyaluran`;
CREATE TABLE `tb_penyaluran` (
  `id_penyaluran` int(11) NOT NULL AUTO_INCREMENT,
  `id_donor` int(11) NOT NULL,
  `id_rs` int(11) NOT NULL,
  `tgl_penyaluran` date NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id_penyaluran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tb_permintaan`;
CREATE TABLE `tb_permintaan` (
  `id_permintaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_rs` int(11) NOT NULL,
  `id_darah` int(11) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `tgl_butuh` date NOT NULL,
  `status` enum('Belum Diproses','Sudah Diproses','Tertunda','Dibatalkan') NOT NULL DEFAULT 'Belum Diproses',
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_permintaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tb_pesan`;
CREATE TABLE `tb_pesan` (
  `id_pesan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tb_rs`;
CREATE TABLE `tb_rs` (
  `id_rs` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_rs` varchar(255) NOT NULL,
  `lokasi` text NOT NULL,
  `kontak` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-08-17 14:31:40
