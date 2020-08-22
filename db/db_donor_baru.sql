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

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'admin\r\n');

DROP TABLE IF EXISTS `tb_darah`;
CREATE TABLE `tb_darah` (
  `id_darah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_darah` varchar(255) NOT NULL,
  `ket` text NOT NULL,
  `stok` varchar(50) NOT NULL,
  PRIMARY KEY (`id_darah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_darah` (`id_darah`, `nama_darah`, `ket`, `stok`) VALUES
(1,	'A+',	'Golongan Darah A+',	'20'),
(2,	'B+',	'Golongan Darah B+',	'9'),
(3,	'O+',	'Golongan Darah O+',	'3'),
(4,	'AB+',	'Golongan Darah AB+',	'3'),
(5,	'A1+',	'Golongan Darah A1+',	'3'),
(6,	'A2+',	'Golongan Darah A2+',	'3'),
(7,	'A1B+',	'Golongan Darah A1B+',	'3'),
(8,	'A2B+',	'Golongan Darah A2B+',	'3'),
(9,	'A-',	'Golongan Darah A-',	'3'),
(10,	'B-',	'Golongan Darah B-',	'3'),
(11,	'O-',	'Golongan Darah O-',	'3'),
(12,	'AB',	'Golongan Darah AB',	'3'),
(13,	'A1',	'Golongan Darah A1',	'3'),
(14,	'A2',	'Golongan Darah A2',	'3'),
(15,	'A1B',	'Golongan Darah A1B',	'3'),
(16,	'A2B',	'Golongan Darah A2B',	'3');

DROP TABLE IF EXISTS `tb_donor`;
CREATE TABLE `tb_donor` (
  `id_donor` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_darah` int(11) NOT NULL,
  `id_rs` int(11) DEFAULT NULL,
  `tgl_donor` datetime NOT NULL,
  `status` enum('Belum Diproses','Sudah Diproses','Dibatalkan','Sudah Disalurkan') NOT NULL DEFAULT 'Belum Diproses',
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
  `tgl_diberikan` date DEFAULT NULL,
  `id_permintaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_donor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_donor` (`id_donor`, `id_user`, `id_darah`, `id_rs`, `tgl_donor`, `status`, `tgl_booking`, `nama_lengkap`, `nama_ortu`, `jenis_kelamin`, `tgl_lahir`, `berat_badan`, `alamat`, `nohp`, `foto`, `keterangan`, `tgl_diberikan`, `id_permintaan`) VALUES
(1,	1,	1,	1,	'2020-08-15 15:27:22',	'Sudah Disalurkan',	'2020-08-15 00:00:00',	'',	'',	'Laki-laki',	'0000-00-00',	0,	'',	'',	'',	'Darah pendonor sudah disalurkan ke pasien bernama Similique illo archi, pasien rumah sakit Rumah Sakit pada tanggal 20 Agustus 2020 dengan kode permintaan P2-19082020021842',	'2020-08-20',	2),
(2,	1,	1,	NULL,	'1972-02-05 15:20:00',	'Sudah Disalurkan',	'2020-08-15 09:54:30',	'Illo ea nostrud solu',	'Veritatis praesentiu',	'Laki-laki',	'1989-01-11',	22,	'Ex impedit nihil qu',	'1212121212',	'150820095430644900.jpg',	'Darah pendonor sudah disalurkan ke pasien bernama Syahroel, pasien rumah sakit  pada tanggal 21 Agustus 2020 dengan kode permintaan P1-10102018000000',	'2020-08-21',	1);

DROP TABLE IF EXISTS `tb_histori_darah`;
CREATE TABLE `tb_histori_darah` (
  `id_histori` int(11) NOT NULL AUTO_INCREMENT,
  `id_darah` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_catatan` date NOT NULL,
  PRIMARY KEY (`id_histori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_histori_darah` (`id_histori`, `id_darah`, `jumlah`, `tgl_catatan`) VALUES
(1,	1,	1,	'2020-08-20'),
(2,	1,	-1,	'2020-08-20'),
(3,	1,	1,	'2020-08-20'),
(4,	1,	-1,	'2020-08-21');

DROP TABLE IF EXISTS `tb_permintaan`;
CREATE TABLE `tb_permintaan` (
  `id_permintaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_rs` int(11) NOT NULL,
  `id_darah` int(11) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tgl_permintaan` datetime NOT NULL,
  `tgl_butuh` date NOT NULL,
  `status` enum('Belum Diproses','Sudah Diproses','Dibatalkan') NOT NULL DEFAULT 'Belum Diproses',
  `keterangan` text,
  PRIMARY KEY (`id_permintaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_permintaan` (`id_permintaan`, `id_rs`, `id_darah`, `nama_pasien`, `tgl_lahir`, `jenis_kelamin`, `tgl_permintaan`, `tgl_butuh`, `status`, `keterangan`) VALUES
(1,	1,	1,	'Syahroel',	'2000-12-12',	'Laki-laki',	'2018-10-10 00:00:00',	'2020-08-10',	'Sudah Diproses',	'Darah sudah didapatkan dari pendonor bernama Illo ea nostrud solu jenis kelamin Laki-laki pada tanggal 21 Agustus 2020 dengan kode donor D2-15082020095430'),
(2,	1,	1,	'Similique illo archi',	'1990-07-06',	'Perempuan',	'2020-08-19 02:18:42',	'2020-08-10',	'Sudah Diproses',	'Darah sudah didapatkan dari pendonor bernama  jenis kelamin  pada tanggal 21 Agustus 2020 dengan kode donor D-01011970000000');

DROP TABLE IF EXISTS `tb_pesan`;
CREATE TABLE `tb_pesan` (
  `id_pesan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_pesan` (`id_pesan`, `nama`, `kontak`, `email`, `pesan`, `tgl_pesan`, `status`) VALUES
(1,	'Syahroel',	'086655778899',	'syahroel@gmail.com',	'Kentang',	'2020-08-14 00:00:00',	1),
(2,	'fosiwunyf',	'+1 (521) 849-5119',	'jukelik@mailinator.com',	'Voluptas amet sed temporibus nihil sunt asperiores consequuntur voluptate in architecto ipsam',	'2020-08-22 04:19:53',	0);

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

INSERT INTO `tb_rs` (`id_rs`, `username`, `password`, `nama_rs`, `lokasi`, `kontak`) VALUES
(1,	'rumah_sakit',	'7d28e0a3884cc87d3adaf92e8f29a6e3',	'Rumah Sakit',	'Kubu Marapalam',	'0812345678');

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

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `nohp`, `jenis_kelamin`) VALUES
(1,	'user',	'ee11cbb19052e40b07aac0ca060c23ee',	'user',	'user@mail.com',	'1231231221',	'Laki-laki');

-- 2020-08-22 09:00:05
