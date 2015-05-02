-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for komisiyudisial
DROP DATABASE IF EXISTS `komisiyudisial`;
CREATE DATABASE IF NOT EXISTS `komisiyudisial` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `komisiyudisial`;


-- Dumping structure for table komisiyudisial.tbl_agenda
DROP TABLE IF EXISTS `tbl_agenda`;
CREATE TABLE IF NOT EXISTS `tbl_agenda` (
  `id_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `text_id` text,
  `text_en` text,
  `address_id` text,
  `address_en` text,
  `time_id` varchar(255) DEFAULT NULL,
  `time_en` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_agenda`),
  KEY `FK_tbl_agenda_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_agenda_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_agenda: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_agenda` DISABLE KEYS */;
INSERT INTO `tbl_agenda` (`id_agenda`, `title_id`, `title_en`, `text_id`, `text_en`, `address_id`, `address_en`, `time_id`, `time_en`, `contact_person`, `modified_by`, `modified_date`) VALUES
	(1, 'Audiensi FH Universitas Kristen Satya Wacana', 'Audiensi FH Universitas Kristen Satya Wacana', 'Audiensi FH Universitas Kristen Satya Wacana', 'Audiensi FH Universitas Kristen Satya Wacana', 'Auditorium Lt. 4 ', 'Auditorium Lt. 4 ', '13.00 WIB - selesai', '13.00 WIB - selesai', 'Palinfo', 1, '2015-04-24 18:27:34'),
	(2, 'Audiensi Universitas Djanabadra', 'Audiensi Universitas Djanabadra', 'Audiensi Universitas Djanabadra', 'Audiensi Universitas Djanabadra', 'Auditorium Lt. 4 ', 'Auditorium Lt. 4 ', '13.00 WIB-selesai', '13.00 WIB-selesai ', 'Palinfo', 1, '2015-04-24 18:29:16');
/*!40000 ALTER TABLE `tbl_agenda` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_announcement
DROP TABLE IF EXISTS `tbl_announcement`;
CREATE TABLE IF NOT EXISTS `tbl_announcement` (
  `id_announcement` int(11) NOT NULL AUTO_INCREMENT,
  `expired_date` date NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `text_id` text,
  `text_en` text,
  `file` varchar(255) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_announcement`),
  KEY `FK_tbl_announcement_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_announcement_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_announcement: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_announcement` DISABLE KEYS */;
INSERT INTO `tbl_announcement` (`id_announcement`, `expired_date`, `title_id`, `title_en`, `text_id`, `text_en`, `file`, `modified_by`, `modified_date`) VALUES
	(1, '2015-04-23', 'sadsadsad', 'sdasdsad', '<p>\r\n	sadsadsad</p>\r\n', '<p>\r\n	asdsadsads</p>\r\n', 'ab27a-03-03-2015-10-57-33.png', 1, '2015-04-23 19:00:13'),
	(2, '2015-04-30', 'Test', 'test', '<p>\r\n	test</p>\r\n', '<p>\r\n	tets</p>\r\n', 'ec20a-10-04-2015-13-30-50.png', 1, '2015-04-23 19:08:08');
/*!40000 ALTER TABLE `tbl_announcement` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_article
DROP TABLE IF EXISTS `tbl_article`;
CREATE TABLE IF NOT EXISTS `tbl_article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `text_id` text,
  `text_en` text,
  `file` varchar(255) DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_article`),
  KEY `FK_tbl_article_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_article_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_article: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_article` DISABLE KEYS */;
INSERT INTO `tbl_article` (`id_article`, `title_id`, `title_en`, `text_id`, `text_en`, `file`, `modified_by`, `modified_date`) VALUES
	(1, 'Test Article', 'Test Article', 'Isi Article', 'Isi Article', NULL, 1, '2015-04-25 10:46:17');
/*!40000 ALTER TABLE `tbl_article` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_information_system
DROP TABLE IF EXISTS `tbl_information_system`;
CREATE TABLE IF NOT EXISTS `tbl_information_system` (
  `id_information_system` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `text_id` text NOT NULL,
  `text_en` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_information_system`),
  KEY `FK_tbl_information_system_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_information_system_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_information_system: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_information_system` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_information_system` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_laws
DROP TABLE IF EXISTS `tbl_laws`;
CREATE TABLE IF NOT EXISTS `tbl_laws` (
  `id_laws` int(11) NOT NULL AUTO_INCREMENT,
  `laws_id` varchar(255) NOT NULL,
  `laws_en` varchar(255) NOT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_laws`),
  KEY `FK_tbl_produk_hukum_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_produk_hukum_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_laws: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_laws` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_laws` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_laws_category
DROP TABLE IF EXISTS `tbl_laws_category`;
CREATE TABLE IF NOT EXISTS `tbl_laws_category` (
  `id_laws_category` int(11) NOT NULL AUTO_INCREMENT,
  `laws_category_id` varchar(255) NOT NULL,
  `laws_category_en` varchar(255) NOT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_laws_category`),
  KEY `FK_tbl_produk_hukum_kategori_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_produk_hukum_kategori_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_laws_category: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_laws_category` DISABLE KEYS */;
INSERT INTO `tbl_laws_category` (`id_laws_category`, `laws_category_id`, `laws_category_en`, `modified_by`, `modified_date`) VALUES
	(1, 'Undang-undang', '', 1, '2015-04-23 14:45:35'),
	(2, 'Peraturan', '', 1, '2015-04-23 14:45:45');
/*!40000 ALTER TABLE `tbl_laws_category` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_link
DROP TABLE IF EXISTS `tbl_link`;
CREATE TABLE IF NOT EXISTS `tbl_link` (
  `id_link` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `text_id` text,
  `text_en` text,
  `url` varchar(255) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_link`),
  KEY `FK_tbl_link_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_link_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_link: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_link` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_news
DROP TABLE IF EXISTS `tbl_news`;
CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `text_id` text NOT NULL,
  `text_en` text NOT NULL,
  `picture` varchar(255) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_news`),
  KEY `FK_tbl_news_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_news_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_news: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_news` DISABLE KEYS */;
INSERT INTO `tbl_news` (`id_news`, `date`, `title_id`, `title_en`, `text_id`, `text_en`, `picture`, `modified_by`, `modified_date`) VALUES
	(1, '2015-04-18 00:00:00', 'Contempt of Court Pengaruhi Independensi Hakim', 'Contempt of Court Pengaruhi Independensi Hakim', '<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	<strong>Medan (Komisi Yudisial)</strong>&nbsp;&ndash; Pengaruh independensi hakim tidak hanya berasal dari faktor internal, yaitu dari diri hakim. Namun gangguan independensi juga berasal dari faktor eksternal yang berkaitan dengan problem kesadaran dan pengetahuan hukum masyarakat dalam proses beracara di pengadilan yang masih kurang. Salah satu bukti adalah perusakan sarana dan prasarana pengadilan oleh massa, ancaman dan demonstrasi yang berlebihan, hingga berujung kekerasan fisik terhadap hakim. Hal ini tentu dapat memengaruhi independensi hakim dalam memutus sebuah perkara di pengadilan.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Demikian paparan Ketua Bidang Sumber Daya Manusia, Advokasi, Hukum, Penelitian dan Pengembangan Komisi Yudisial (KY) Jaja Ahmad Jayus dalam pembukaan &ldquo;Diseminasi Perbuatan Merendahkan Kehormatan dan Keluhuran Martabat Hakim&rdquo; di Aula Pengadilan Tinggi Sumatera Utara, Medan, Kamis (09/04).</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Jaja menerangkan, sesuai Undang-Undang (UU) Nomor 18 Tahun 2011 Pasal 20 Ayat 1 huruf e, KY diberikan tugas melakukan langkah hukum atau langkah lain apabila ada orang /perorangan, kelompok atau badan hukum yang menggangu kredibilitas dan integritas hakim.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Untuk mengantisipasi kejadian yang berulang di dalam maupun di luar ruang persidangan, KY mendorong DPR bersama Pemerintah agar bisa melahirkan UU yang berkaitan dengan contempt of court. Diharapkan ini dapat mendorong Mahkamah Agung lebih cepat dalam mewujudkan peradilan yang berwibawa dan agung di tahun 2025,&rdquo; kata Jaja</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Sebagai langkah awal, lanjut Jaja, sebelumnya KY telah melakukan survei tentang perbuatan merendahkan kehormatan dan keluhuran martabat hakim terhadap 76 hakim di lingkungan pengadilan di Medan (PN, PA dan PTUN).</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Hasil survei menyatakan, dari 76 responden pernah mengalami ancaman atau teror sebanyak 26 responden, 16 responden pernah melihat dan mengalami perusakan, penghancuran, pembakaran sarana dan prasarana pengadilan, dan 5 responden pernah mengalami kekerasan fisik. Hal lain yang terungkap adalah seluruh responden menyatakan ketidakpuasan atas keamanan hakim dan anggarannya, serta sebanyak 30 responden menyatakan solusi untuk meminimalisir atau menghilangkannya adalah dengan menerbitkan regulasi tentang&nbsp;<em>Contempt of Court</em>. (KY/Aran/Festy)</div>\r\n', '<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	<strong>Medan (Komisi Yudisial)</strong>&nbsp;&ndash; Pengaruh independensi hakim tidak hanya berasal dari faktor internal, yaitu dari diri hakim. Namun gangguan independensi juga berasal dari faktor eksternal yang berkaitan dengan problem kesadaran dan pengetahuan hukum masyarakat dalam proses beracara di pengadilan yang masih kurang. Salah satu bukti adalah perusakan sarana dan prasarana pengadilan oleh massa, ancaman dan demonstrasi yang berlebihan, hingga berujung kekerasan fisik terhadap hakim. Hal ini tentu dapat memengaruhi independensi hakim dalam memutus sebuah perkara di pengadilan.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Demikian paparan Ketua Bidang Sumber Daya Manusia, Advokasi, Hukum, Penelitian dan Pengembangan Komisi Yudisial (KY) Jaja Ahmad Jayus dalam pembukaan &ldquo;Diseminasi Perbuatan Merendahkan Kehormatan dan Keluhuran Martabat Hakim&rdquo; di Aula Pengadilan Tinggi Sumatera Utara, Medan, Kamis (09/04).</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Jaja menerangkan, sesuai Undang-Undang (UU) Nomor 18 Tahun 2011 Pasal 20 Ayat 1 huruf e, KY diberikan tugas melakukan langkah hukum atau langkah lain apabila ada orang /perorangan, kelompok atau badan hukum yang menggangu kredibilitas dan integritas hakim.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Untuk mengantisipasi kejadian yang berulang di dalam maupun di luar ruang persidangan, KY mendorong DPR bersama Pemerintah agar bisa melahirkan UU yang berkaitan dengan contempt of court. Diharapkan ini dapat mendorong Mahkamah Agung lebih cepat dalam mewujudkan peradilan yang berwibawa dan agung di tahun 2025,&rdquo; kata Jaja</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Sebagai langkah awal, lanjut Jaja, sebelumnya KY telah melakukan survei tentang perbuatan merendahkan kehormatan dan keluhuran martabat hakim terhadap 76 hakim di lingkungan pengadilan di Medan (PN, PA dan PTUN).</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Hasil survei menyatakan, dari 76 responden pernah mengalami ancaman atau teror sebanyak 26 responden, 16 responden pernah melihat dan mengalami perusakan, penghancuran, pembakaran sarana dan prasarana pengadilan, dan 5 responden pernah mengalami kekerasan fisik. Hal lain yang terungkap adalah seluruh responden menyatakan ketidakpuasan atas keamanan hakim dan anggarannya, serta sebanyak 30 responden menyatakan solusi untuk meminimalisir atau menghilangkannya adalah dengan menerbitkan regulasi tentang&nbsp;<em>Contempt of Court</em>. (KY/Aran/Festy)</div>\r\n', '1f858-1diseminasi-medan.jpg', 1, '2015-04-18 08:52:01'),
	(2, '2015-04-23 00:00:00', 'Pengawasan Hakim Butuh Dukungan Masyarakat', 'Pengawasan Hakim Butuh Dukungan Masyarakat', '<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;&ndash; Komisi Yudisial (KY) menerima kunjungan mahasiswa dan dosen Fakultas Hukum Universitas Muhammadiyah Bengkulu (FH UMB) pada Selasa, (21/4). Kunjungan dalam rangka praktik kuliah lapangan itu ingin mengetahui tentang KY. Diterima oleh Tenaga Ahli KY Totok Wintarto yang didampingi Kepala Bidang Data dan Layanan Informasi Titik Ariyati, para mahasiswa FH UMB dijelaskan seputar wewenang dan tugas KY demi mewujudkan peradilan bersih.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Sesuai amanat undang-undang, KY memiliki dua wewenang utama, yaitu mengusulkan pengangkatan hakim agung dan hakim ad hoc di Mahkamah Agung kepada DPR untuk mendapatkan persetujuan dan wewenang lain dalam menjaga dan menegakkan kehormatan, keluhuran martabat, serta perilaku hakim.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Terkait melakukan pengawasan, KY menerima laporan masyarakat terkait dugaan pelanggaran Kode Etik dan Pedoman Perilaku Hakim (KEEPH). Bagi hakim yang terbukti melanggar KEPPH, KY mengusulkan penjatuhan sanksi, yaitu sanksi ringan, sedang dan berat.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Jika sanksinya ringan dan sedang, maka penjatuhan sanksi dari KY tersebut bersifat mengikat. Sedang kalau sanksinya berat, maka akan dibentuk Sidang Majelis Kehormatan Hakim,&rdquo; papar Totok.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Lebih lanjut Totok mengajak seluruh elemen masyarakat, termasuk mahasiswa, membantu KY untuk mengawasi hakim. &ldquo;Jika ada hakim yang diduga melanggar kode etik, sertakan bukti, lalu silakan laporkan kepada KY,&rdquo; pungkas Totok. (KY/Gaudi/Festy)</div>\r\n', '<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;&ndash; Komisi Yudisial (KY) menerima kunjungan mahasiswa dan dosen Fakultas Hukum Universitas Muhammadiyah Bengkulu (FH UMB) pada Selasa, (21/4). Kunjungan dalam rangka praktik kuliah lapangan itu ingin mengetahui tentang KY. Diterima oleh Tenaga Ahli KY Totok Wintarto yang didampingi Kepala Bidang Data dan Layanan Informasi Titik Ariyati, para mahasiswa FH UMB dijelaskan seputar wewenang dan tugas KY demi mewujudkan peradilan bersih.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Sesuai amanat undang-undang, KY memiliki dua wewenang utama, yaitu mengusulkan pengangkatan hakim agung dan hakim ad hoc di Mahkamah Agung kepada DPR untuk mendapatkan persetujuan dan wewenang lain dalam menjaga dan menegakkan kehormatan, keluhuran martabat, serta perilaku hakim.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Terkait melakukan pengawasan, KY menerima laporan masyarakat terkait dugaan pelanggaran Kode Etik dan Pedoman Perilaku Hakim (KEEPH). Bagi hakim yang terbukti melanggar KEPPH, KY mengusulkan penjatuhan sanksi, yaitu sanksi ringan, sedang dan berat.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Jika sanksinya ringan dan sedang, maka penjatuhan sanksi dari KY tersebut bersifat mengikat. Sedang kalau sanksinya berat, maka akan dibentuk Sidang Majelis Kehormatan Hakim,&rdquo; papar Totok.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Lebih lanjut Totok mengajak seluruh elemen masyarakat, termasuk mahasiswa, membantu KY untuk mengawasi hakim. &ldquo;Jika ada hakim yang diduga melanggar kode etik, sertakan bukti, lalu silakan laporkan kepada KY,&rdquo; pungkas Totok. (KY/Gaudi/Festy)</div>\r\n', '31a1a-5audiensi-muhammadiyah-.jpg', 1, '2015-04-23 19:11:56'),
	(3, '2015-04-30 00:00:00', 'Seleksi CHA, KY Tekankan Integritas dan Kapasitas', 'Seleksi CHA, KY Tekankan Integritas dan Kapasitas', '<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;- Ratusan mahasiswa yang didampingi Dosen Fakultas Hukum Universitas Janabadra, Yogyakarta berkunjung ke kantor Komisi Yudisial (KY) yang beralamat di Jalan Kramat Raya 57, Jakarta Pusat. Kunjungan dalam rangka Praktik Kerja Lapangan diterima oleh Tenaga Ahli bidang Anotasi Imran dan Kepala Bidang data dan Layanan Informasi Titik Ariyati.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Dalam paparannya, Imran menjelaskan kehadiran KY untuk mengembalikan kepercayaan masyarakat terhadap dunia peradilan. Sesuai amanat undang-undang, KY memiliki dua wewenang utama, yaitu mengusulkan pengangkatan hakim agung dan hakim ad hoc di Mahkamah Agung kepada DPR untuk mendapatkan persetujuan dan wewenang lain dalam menjaga dan menegakkan kehormatan, keluhuran martabat, serta perilaku hakim.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Terkait wewenang melakukan seleksi calon hakim agung, KY berhati-hati dengan menekankan integritas dan kapasitas calon hakim agung (CHA). Selanjutnya, CHA yang lulus wawancara akan diajukan kepada DPR untuk mendapatkan persetujuan.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Selain itu, lanjut Imron, KY juga mempunyai wewenang tambahan yang diberikan oleh UU Peradilan Umum, UU Peradilan Agama, dan UU Peradilan Tata Usaha Negara, yaitu melakukan seleksi pengangkatan hakim bersama dengan Mahkamah Agung (MA). Namun, beberapa waktu lalu IKAHI Pusat melakukan gugatan uji materi terhadap tiga UU tersebut.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Gugatan tersebut meminta MK membatalkan keterlibatan KY dalam seleksi pengangkatan hakim. Sementara itu, KY menganggap harus dilakukan bersama. Namun, KY tidak menjadi pihak langsung karena hanya terkait,&rdquo; imbuhnya.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Sementara wewenang lain, lanjut Imran, menjadikan Kode Etik dan &nbsp;Pedoman Perilaku Hakim (KEEPH) sebagai panduan dalam mengawasi hakim. KEEPH ini juga digunakan KY dalam menentukan jenis sanksi yang diberikan kepada hakim yang terbukti melanggar kode etik.&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Kalau sanksinya ringan, hakim terlapor hanya diberi teguran. Kalau sedang, diberi sanksi non palu. Sedangkan jika terbukti melakukan pelanggaran berat, maka si hakim terlapor diusulkan diberhentikan. Untuk memberhentikan hakim harus melalui mekanisme Sidang Majelis Kehormatan Hakim yang terdiri empat Anggota KY dan tiga Hakim Agung,&rdquo; tutup Imran. (KY/Kus/Festy)</div>\r\n', '<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;- Ratusan mahasiswa yang didampingi Dosen Fakultas Hukum Universitas Janabadra, Yogyakarta berkunjung ke kantor Komisi Yudisial (KY) yang beralamat di Jalan Kramat Raya 57, Jakarta Pusat. Kunjungan dalam rangka Praktik Kerja Lapangan diterima oleh Tenaga Ahli bidang Anotasi Imran dan Kepala Bidang data dan Layanan Informasi Titik Ariyati.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Dalam paparannya, Imran menjelaskan kehadiran KY untuk mengembalikan kepercayaan masyarakat terhadap dunia peradilan. Sesuai amanat undang-undang, KY memiliki dua wewenang utama, yaitu mengusulkan pengangkatan hakim agung dan hakim ad hoc di Mahkamah Agung kepada DPR untuk mendapatkan persetujuan dan wewenang lain dalam menjaga dan menegakkan kehormatan, keluhuran martabat, serta perilaku hakim.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Terkait wewenang melakukan seleksi calon hakim agung, KY berhati-hati dengan menekankan integritas dan kapasitas calon hakim agung (CHA). Selanjutnya, CHA yang lulus wawancara akan diajukan kepada DPR untuk mendapatkan persetujuan.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Selain itu, lanjut Imron, KY juga mempunyai wewenang tambahan yang diberikan oleh UU Peradilan Umum, UU Peradilan Agama, dan UU Peradilan Tata Usaha Negara, yaitu melakukan seleksi pengangkatan hakim bersama dengan Mahkamah Agung (MA). Namun, beberapa waktu lalu IKAHI Pusat melakukan gugatan uji materi terhadap tiga UU tersebut.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Gugatan tersebut meminta MK membatalkan keterlibatan KY dalam seleksi pengangkatan hakim. Sementara itu, KY menganggap harus dilakukan bersama. Namun, KY tidak menjadi pihak langsung karena hanya terkait,&rdquo; imbuhnya.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Sementara wewenang lain, lanjut Imran, menjadikan Kode Etik dan &nbsp;Pedoman Perilaku Hakim (KEEPH) sebagai panduan dalam mengawasi hakim. KEEPH ini juga digunakan KY dalam menentukan jenis sanksi yang diberikan kepada hakim yang terbukti melanggar kode etik.&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Kalau sanksinya ringan, hakim terlapor hanya diberi teguran. Kalau sedang, diberi sanksi non palu. Sedangkan jika terbukti melakukan pelanggaran berat, maka si hakim terlapor diusulkan diberhentikan. Untuk memberhentikan hakim harus melalui mekanisme Sidang Majelis Kehormatan Hakim yang terdiri empat Anggota KY dan tiga Hakim Agung,&rdquo; tutup Imran. (KY/Kus/Festy)</div>\r\n', '', 1, '2015-04-23 19:12:57'),
	(4, '2015-04-24 00:00:00', 'ICW Sampaikan Eksaminasi Publik Putusan Praperadilan Hakim Sarpin ke KY', 'ICW Sampaikan Eksaminasi Publik Putusan Praperadilan Hakim Sarpin ke KY', '<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;- Divisi Hukum dan Monitoring Peradilan Indonesia Corruption Watch (ICW) a bertandang ke kantor Komisi Yudisial Kamis (23/4/2015). Mereka terdiri dari &nbsp;Emerson Yuntho, Lalola Easter, dan Aradila Caesar yang datang ke KY itu bermaksud menyampaikan hasil eksaminasi publik terhadap putusan Hakim Sarpin Rizaldi dalam perkara praperadilan Komjen Budi Gunawan di Pengadilan Jakarta Selatan beberapa waktu lalu.&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Selain itu kata Emerson ICW juga meminta update terbaru perkembangan kasus dugaan pelanggaran kode etik Hakim Tunggal Pengadilan Negeri Jakarta Selatan yang menangani perkara praperadilan Komjen Budi Gunawan. Masih kata Emerson ICW juga menyampaikan hasil studi terhadap hakim-hakim yang menangani perkara korupsi dari tingkat pengadilan negeri, Pengadilan Tinggi hingka Kasasi di Mahkamah Agung.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Di sini kami ada tiga agenda. Yang pertama kami sampaikan hasil studi kami terhadap perkara-perkara korupsi yang ditangani oleh hakim-hakim di mahkamah Agung. Yang kedua kami sampaikan hasil hasil eksaminasi perkara praperadilan perkara Budi Gunawan. Yang ketiga, kita ingin mendapatkan update pemeriksaan Hakim Sarpin,&rdquo; kata Emerson saat bertemu dengan Ketua Bidang Hubungan Antara Lembaga dan Layanan Informasi KY Imam Anshori Saleh yang didamping Kepala Biro Umum Andi Djalal Latief.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Sementara itu Staf ICW yang lain &nbsp;Lalola Ester yang menjelaskan jika ICW dalam melakukan eksaminasi Publik tersebut melibatkan sejumlah guru besar dari berbagai Perguruan Tinggi di Indonesia. Di antaranya adalah Profesor Maria Emong dari UNPAD, Prof Hibnu Unsoed dan mantan KHN Prof Sahetapy. Hasil dari eksaminasi tersebut kata Lalola ada beberapa asas yang dilanggar.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Misalkan Proses praperadilan harusnya tidak memakan waktu selama itu. Ketika tahu itu bukan obyek peradilan. Dalam eksaminasi itu dibicarakan juga soal upaya hukum apa yang bisa dilakukan termasuk oleh KPK,&rdquo; katanya</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Sementara itu Komisioner KY Imam Anshori menyambut baik hasil eksaminasi publik atas putusan praperadilan Komjen Budi Gunawan. Menurut Imam, hasil eksaminasi publik tersebut akan menjadi masukan dalam rapat pleno dalam menentukan perkara Hakim Sarpin Rizaldi.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Kami sangat senang atas eksaminasi publik yang dilakukan ICW ini. Kami tidak mungkin tahu kalau tidak ada masukan-masukan dari ICW,&rdquo; imbuhnya</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Terkait dengan perkembangan kasus laporan Hakim Sarpin kata Imam KY saat ini tinggal meminta keterangan dari hakim terlapor. Sebelumnya KY sudah melayangkan pemanggilan pertama namun kata Imam hakim terlapor tidak datang memenuhi panggilan sesuai dengan waktu yang ditentukan. Terkait kekhawatiran menjadi preseden buruk, Imam meminta agar tidak perlu khawatir. Karena kalau tidak datang &nbsp;memenuhi panggilan KY, yang rugi malah hakim yang bersangkutan.(KY/Kus/TitiK)</div>\r\n', '<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;- Divisi Hukum dan Monitoring Peradilan Indonesia Corruption Watch (ICW) a bertandang ke kantor Komisi Yudisial Kamis (23/4/2015). Mereka terdiri dari &nbsp;Emerson Yuntho, Lalola Easter, dan Aradila Caesar yang datang ke KY itu bermaksud menyampaikan hasil eksaminasi publik terhadap putusan Hakim Sarpin Rizaldi dalam perkara praperadilan Komjen Budi Gunawan di Pengadilan Jakarta Selatan beberapa waktu lalu.&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Selain itu kata Emerson ICW juga meminta update terbaru perkembangan kasus dugaan pelanggaran kode etik Hakim Tunggal Pengadilan Negeri Jakarta Selatan yang menangani perkara praperadilan Komjen Budi Gunawan. Masih kata Emerson ICW juga menyampaikan hasil studi terhadap hakim-hakim yang menangani perkara korupsi dari tingkat pengadilan negeri, Pengadilan Tinggi hingka Kasasi di Mahkamah Agung.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Di sini kami ada tiga agenda. Yang pertama kami sampaikan hasil studi kami terhadap perkara-perkara korupsi yang ditangani oleh hakim-hakim di mahkamah Agung. Yang kedua kami sampaikan hasil hasil eksaminasi perkara praperadilan perkara Budi Gunawan. Yang ketiga, kita ingin mendapatkan update pemeriksaan Hakim Sarpin,&rdquo; kata Emerson saat bertemu dengan Ketua Bidang Hubungan Antara Lembaga dan Layanan Informasi KY Imam Anshori Saleh yang didamping Kepala Biro Umum Andi Djalal Latief.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Sementara itu Staf ICW yang lain &nbsp;Lalola Ester yang menjelaskan jika ICW dalam melakukan eksaminasi Publik tersebut melibatkan sejumlah guru besar dari berbagai Perguruan Tinggi di Indonesia. Di antaranya adalah Profesor Maria Emong dari UNPAD, Prof Hibnu Unsoed dan mantan KHN Prof Sahetapy. Hasil dari eksaminasi tersebut kata Lalola ada beberapa asas yang dilanggar.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Misalkan Proses praperadilan harusnya tidak memakan waktu selama itu. Ketika tahu itu bukan obyek peradilan. Dalam eksaminasi itu dibicarakan juga soal upaya hukum apa yang bisa dilakukan termasuk oleh KPK,&rdquo; katanya</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Sementara itu Komisioner KY Imam Anshori menyambut baik hasil eksaminasi publik atas putusan praperadilan Komjen Budi Gunawan. Menurut Imam, hasil eksaminasi publik tersebut akan menjadi masukan dalam rapat pleno dalam menentukan perkara Hakim Sarpin Rizaldi.</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&ldquo;Kami sangat senang atas eksaminasi publik yang dilakukan ICW ini. Kami tidak mungkin tahu kalau tidak ada masukan-masukan dari ICW,&rdquo; imbuhnya</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">\r\n	Terkait dengan perkembangan kasus laporan Hakim Sarpin kata Imam KY saat ini tinggal meminta keterangan dari hakim terlapor. Sebelumnya KY sudah melayangkan pemanggilan pertama namun kata Imam hakim terlapor tidak datang memenuhi panggilan sesuai dengan waktu yang ditentukan. Terkait kekhawatiran menjadi preseden buruk, Imam meminta agar tidak perlu khawatir. Karena kalau tidak datang &nbsp;memenuhi panggilan KY, yang rugi malah hakim yang bersangkutan.(KY/Kus/TitiK)</div>\r\n', 'e31fa-46audiensi-ky-icw.jpg', 1, '2015-04-24 16:56:07'),
	(5, '2015-04-29 00:00:00', 'FDHI Dukung KY mewujudkan UU Jabatan Hakim dan UU Contempt of Court', 'FDHI Dukung KY mewujudkan UU Jabatan Hakim dan UU Contempt of Court', '<p>\r\n	<strong style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">Jakarta (Komisi Yudisial)</strong><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">&nbsp;- Sekitar 15 perwakilan hakim dari berbagai wilayah di Indonesia yang tergabung dalam Forum Diskusi Hakim Indonesia (FDHI) melakukan audiensi di Komisi Yudisial (KY). Kehadiran FDHI ini diterima Ketua KY Suparman Marzuki dan Ketua Bidang Rekrutmen Hakim Taufiqqurohman Syahuri, yang didampingi oleh Plh Sekjen KY Andi Djalal Latief dan Kepala Biro Rekrutmen Heru Purnomo, (27/04).</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">Dalam pertemuan singkat yang dilakukan di Ruang Rapat KY ini, FDHI mengutarakan keinginan dan mendorong DPR, untuk segera mewujudkan Undang-Undang tentang Jabatan Hakim dan Undang-Undang tentang Perbuatan Merendahkan Keluhuran dan Martabat Hakim atau Contempt of Court (CoC) agar bisa dimasukkan dalam Prolegnas tahun 2016.</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">&ldquo;Kami menganggap kedua UU ini penting, karena bisa memperjelas status dan kedudukan hakim yang merupakan Pejabat Negara bukan PNS, serta menjamin profesionalisme dan independensi personal seorang hakim dalam melaksanakan tugas menegakkan hukum dan keadilan di Indonesia,&rdquo; tutur salah satu juru bicara FDHI yang berasal dari hakim PN Stabat.</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">Lebih lanjut FDHI juga memberikan masukan dan saran terhadap kedua RUU tersebut, dengan harapan bisa mengakomodir suara-suara para hakim se-Indonesia yang tergabung dalam FDHI.</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">Menanggapi apa yang menjadi pemikiran, keinginan dan inspirasi FDHI, Ketua KY Suparman Marzuki menegaskan bahwa KY dalam berbagai kesempatan sebelumnya telah mendorong berbagai pihak agar bisa mewujudkan kedua RUU tersebut menjadi UU.</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">&ldquo;KY secara konsisten terus mengawal dan mendorong baik DPR maupun pemerintah untuk memberikan kejelasan tentang status dan kedudukan hakim sebagai Pejabat Negara. Secara keseluruhan KY juga ingin menyempurnakan dari sisi ideologi terkait dengan sumber daya manusia, sistem rekrutmen, mutasi, dan promosi hakim bersama-sama MA secara transparan, akuntabel dan partisipatif, dan KY juga telah berhasil mendorong berbagai pihak untuk memperbaiki kesejahteraan hakim, hal ini semua merupakan kerangka besar KY dalam mendorong dan merealisasikan UU Jabatan Hakim dan Contempt of Court,&rdquo; kata Suparman di hadapan para perwakilan FDHI yang hadir.</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">&ldquo;Tentu saja langkah KY mulai dari konsepsi, draf akademik sampai dengan pembahasan pasal-pasal kedua RUU tersebut yang melibatkan berbagai unsur termasuk dari kajian akademik,&rdquo; tutur Suparman. (KY/Aran/Titik)</span></p>\r\n', '<p>\r\n	<strong style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">Jakarta (Komisi Yudisial)</strong><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">&nbsp;- Sekitar 15 perwakilan hakim dari berbagai wilayah di Indonesia yang tergabung dalam Forum Diskusi Hakim Indonesia (FDHI) melakukan audiensi di Komisi Yudisial (KY). Kehadiran FDHI ini diterima Ketua KY Suparman Marzuki dan Ketua Bidang Rekrutmen Hakim Taufiqqurohman Syahuri, yang didampingi oleh Plh Sekjen KY Andi Djalal Latief dan Kepala Biro Rekrutmen Heru Purnomo, (27/04).</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">Dalam pertemuan singkat yang dilakukan di Ruang Rapat KY ini, FDHI mengutarakan keinginan dan mendorong DPR, untuk segera mewujudkan Undang-Undang tentang Jabatan Hakim dan Undang-Undang tentang Perbuatan Merendahkan Keluhuran dan Martabat Hakim atau Contempt of Court (CoC) agar bisa dimasukkan dalam Prolegnas tahun 2016.</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">&ldquo;Kami menganggap kedua UU ini penting, karena bisa memperjelas status dan kedudukan hakim yang merupakan Pejabat Negara bukan PNS, serta menjamin profesionalisme dan independensi personal seorang hakim dalam melaksanakan tugas menegakkan hukum dan keadilan di Indonesia,&rdquo; tutur salah satu juru bicara FDHI yang berasal dari hakim PN Stabat.</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">Lebih lanjut FDHI juga memberikan masukan dan saran terhadap kedua RUU tersebut, dengan harapan bisa mengakomodir suara-suara para hakim se-Indonesia yang tergabung dalam FDHI.</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">Menanggapi apa yang menjadi pemikiran, keinginan dan inspirasi FDHI, Ketua KY Suparman Marzuki menegaskan bahwa KY dalam berbagai kesempatan sebelumnya telah mendorong berbagai pihak agar bisa mewujudkan kedua RUU tersebut menjadi UU.</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">&ldquo;KY secara konsisten terus mengawal dan mendorong baik DPR maupun pemerintah untuk memberikan kejelasan tentang status dan kedudukan hakim sebagai Pejabat Negara. Secara keseluruhan KY juga ingin menyempurnakan dari sisi ideologi terkait dengan sumber daya manusia, sistem rekrutmen, mutasi, dan promosi hakim bersama-sama MA secara transparan, akuntabel dan partisipatif, dan KY juga telah berhasil mendorong berbagai pihak untuk memperbaiki kesejahteraan hakim, hal ini semua merupakan kerangka besar KY dalam mendorong dan merealisasikan UU Jabatan Hakim dan Contempt of Court,&rdquo; kata Suparman di hadapan para perwakilan FDHI yang hadir.</span><br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;">&ldquo;Tentu saja langkah KY mulai dari konsepsi, draf akademik sampai dengan pembahasan pasal-pasal kedua RUU tersebut yang melibatkan berbagai unsur termasuk dari kajian akademik,&rdquo; tutur Suparman. (KY/Aran/Titik)</span></p>\r\n', '', 1, '2015-04-29 17:35:34');
/*!40000 ALTER TABLE `tbl_news` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_pers_release
DROP TABLE IF EXISTS `tbl_pers_release`;
CREATE TABLE IF NOT EXISTS `tbl_pers_release` (
  `id_pers_release` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `text_id` varchar(255) DEFAULT NULL,
  `tent_en` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `midified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pers_release`),
  KEY `FK_tbl_pers_release_tbl_user` (`midified_by`),
  CONSTRAINT `FK_tbl_pers_release_tbl_user` FOREIGN KEY (`midified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Modul Siaran Pers';

-- Dumping data for table komisiyudisial.tbl_pers_release: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_pers_release` DISABLE KEYS */;
INSERT INTO `tbl_pers_release` (`id_pers_release`, `title_id`, `title_en`, `text_id`, `tent_en`, `file`, `midified_by`, `modified_date`) VALUES
	(1, 'Pers Release', 'Pers Release', 'Pers Release', 'Pers Release', NULL, 1, '2015-04-28 18:46:42');
/*!40000 ALTER TABLE `tbl_pers_release` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_polling
DROP TABLE IF EXISTS `tbl_polling`;
CREATE TABLE IF NOT EXISTS `tbl_polling` (
  `id_polling` int(11) NOT NULL AUTO_INCREMENT,
  `id_polling_category` int(11) NOT NULL,
  `polling_id` varchar(255) NOT NULL,
  `polling_en` varchar(255) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_polling`),
  KEY `FK_tbl_polling_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_polling_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_polling: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_polling` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_polling` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_polling_category
DROP TABLE IF EXISTS `tbl_polling_category`;
CREATE TABLE IF NOT EXISTS `tbl_polling_category` (
  `id_polling_category` int(11) NOT NULL AUTO_INCREMENT,
  `cateory_id` varchar(255) NOT NULL,
  `cateory_en` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_polling_category`),
  KEY `FK_tbl_polling_category_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_polling_category_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_polling_category: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_polling_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_polling_category` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_polling_result
DROP TABLE IF EXISTS `tbl_polling_result`;
CREATE TABLE IF NOT EXISTS `tbl_polling_result` (
  `id_polling_result` int(11) NOT NULL AUTO_INCREMENT,
  `id_polling` int(11) DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id_polling_result`),
  KEY `FK_tbl_polling_result_tbl_polling` (`id_polling`),
  CONSTRAINT `FK_tbl_polling_result_tbl_polling` FOREIGN KEY (`id_polling`) REFERENCES `tbl_polling` (`id_polling`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_polling_result: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_polling_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_polling_result` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_procurement
DROP TABLE IF EXISTS `tbl_procurement`;
CREATE TABLE IF NOT EXISTS `tbl_procurement` (
  `id_procurement` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `text_id` text,
  `text_en` text,
  `file` varchar(255) DEFAULT NULL,
  `midified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_procurement`),
  KEY `FK_tbl_auction_tbl_user` (`midified_by`),
  CONSTRAINT `FK_tbl_auction_tbl_user` FOREIGN KEY (`midified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_procurement: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_procurement` DISABLE KEYS */;
INSERT INTO `tbl_procurement` (`id_procurement`, `title_id`, `title_en`, `text_id`, `text_en`, `file`, `midified_by`, `modified_date`) VALUES
	(1, 'Lelang Terbuka', 'Lelang Terbuka', 'Lelang Terbuka', 'Lelang Terbuka', NULL, 1, '2015-04-28 18:45:32');
/*!40000 ALTER TABLE `tbl_procurement` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_publication
DROP TABLE IF EXISTS `tbl_publication`;
CREATE TABLE IF NOT EXISTS `tbl_publication` (
  `id_publication` int(11) NOT NULL AUTO_INCREMENT,
  `publication_date` date NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `text_id` text NOT NULL,
  `text_en` text NOT NULL,
  `cover` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `midified_by` int(10) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_publication`),
  KEY `FK_tbl_publikasi_tbl_user` (`midified_by`),
  CONSTRAINT `FK_tbl_publikasi_tbl_user` FOREIGN KEY (`midified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_publication: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_publication` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_publication` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_sitemap
DROP TABLE IF EXISTS `tbl_sitemap`;
CREATE TABLE IF NOT EXISTS `tbl_sitemap` (
  `id_sitemap` int(11) NOT NULL AUTO_INCREMENT,
  `sitemap_code` varchar(50) NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `css_class` varchar(255) DEFAULT NULL,
  `css_id` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort_no` int(2) DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_sitemap`),
  UNIQUE KEY `sitemap_code` (`sitemap_code`),
  KEY `FK_tbl_modul_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_modul_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_sitemap: ~16 rows (approximately)
/*!40000 ALTER TABLE `tbl_sitemap` DISABLE KEYS */;
INSERT INTO `tbl_sitemap` (`id_sitemap`, `sitemap_code`, `id_parent`, `name`, `description`, `title_id`, `title_en`, `url`, `css_class`, `css_id`, `icon`, `sort_no`, `modified_by`, `modified_date`) VALUES
	(7, '01', NULL, 'frontend', 'Frontend - Parent', 'Halaman Depan', 'Frontend Parent', '#', NULL, NULL, NULL, 0, 1, '2015-04-29 17:09:27'),
	(8, '01.01', 7, 'home', 'Frontend - Home', 'Home', 'Home', 'home', '', '', '', 1, 1, '2015-04-23 15:54:19'),
	(9, '01.02', 7, 'tentang_ky', 'Frontend - Tentang KY', 'Tentang KY', 'About KY', 'about_ky', '', '', '', 2, 1, '2015-04-23 15:55:37'),
	(10, '01.02.01', 9, 'sejarah_pembentukan', 'Frontend - Sejarah Pembentukan', 'Sejarah Pembentukan', 'History', 'history', '', '', '', 3, 1, '2015-04-23 15:55:45'),
	(11, '01.02.02', 9, 'visi_misi', 'Frontend -Visi dan Misi', 'Visi dan Misi', 'Vision and Mision', 'vision_and_mision', '', '', '', 4, 1, '2015-04-23 15:55:54'),
	(12, '01.03', 7, 'layanan publik', 'Frontend - Layanan Publik', 'Layanan Publik', 'Public Services', 'public_service', '', '', '', 5, 1, '2015-04-23 15:56:03'),
	(13, '01.04', 7, 'produk hukum', 'Frontend - Produk Hukum', 'Produk Hukum', 'Laws', 'laws', '', '', '', 6, 1, '2015-04-23 15:56:07'),
	(14, '01.05', 7, 'publikasi', 'Frontend - Publikasi', 'Publikasi', 'Publication', 'publication', '', '', '', 7, 1, '2015-04-23 15:56:13'),
	(15, '01.06', 7, 'berita', 'Frontend - Berita', 'Berita', 'News', 'news', '', '', '', 8, 1, '2015-04-23 15:56:18'),
	(16, '01.07', 7, 'hubungi_kami', 'Frontend - Hubungi Kami', 'Hubungi Kami', 'Contact Us', 'contact_us', '', '', '', 9, 1, '2015-04-23 15:56:25'),
	(17, '02', 0, 'administrator', 'Administrator', 'Administrator', 'Administrator', '#', '', '', '', 0, 1, '2015-04-23 15:53:59'),
	(18, '02.01', 17, 'dashboard', 'Administrator - Dashboard', 'Dashboard', 'Dashboard', 'dahboard', '', '', '', 1, 1, '2015-04-29 16:58:04'),
	(19, '02.02', 17, 'admin_news', 'Administrator - News', 'Berita', 'News', 'news', '', '', '', 2, 1, '2015-04-29 16:58:06'),
	(20, '02.03', 17, 'admin_announcement', 'Administrator - Announcement', 'Pengumuman', 'Announcement', 'announcement', '', '', '', 3, 1, '2015-04-29 16:58:08'),
	(22, '02.04', 17, 'sitemap', 'Administrator - Sitemap', 'Sitemap', 'Sitemap', 'sitemap', NULL, NULL, NULL, 10, 1, '2015-04-29 17:00:03'),
	(26, '02.05', 17, 'agenda', 'Administrator - Agenda', 'Agenda', 'Agenda', 'agenda', NULL, NULL, NULL, 6, 1, '2015-04-29 17:16:13'),
	(27, '02.06', 17, 'link', 'Administrator - Link', 'Link', 'Link', 'link', NULL, NULL, NULL, 7, 1, '2015-04-29 17:23:19');
/*!40000 ALTER TABLE `tbl_sitemap` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_slider
DROP TABLE IF EXISTS `tbl_slider`;
CREATE TABLE IF NOT EXISTS `tbl_slider` (
  `id_slider` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `text_id` text,
  `text_en` text,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_slider`),
  KEY `FK_tbl_slider_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_slider_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_slider: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_slider` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_slider` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_static_content
DROP TABLE IF EXISTS `tbl_static_content`;
CREATE TABLE IF NOT EXISTS `tbl_static_content` (
  `id_static_content` int(11) NOT NULL AUTO_INCREMENT,
  `static_content` varchar(255) NOT NULL,
  `text_ina` text NOT NULL,
  `text_eng` text NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_static_content`),
  KEY `FK_tbl_static_content_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_static_content_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_static_content: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_static_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_static_content` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_user
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`id_user`, `username`, `email`, `password`) VALUES
	(1, 'admin', 'admin@email.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;


-- Dumping structure for table komisiyudisial.tbl_video
DROP TABLE IF EXISTS `tbl_video`;
CREATE TABLE IF NOT EXISTS `tbl_video` (
  `id_video` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL DEFAULT '0',
  `text_id` text,
  `text_en` text,
  `embed` varchar(4000) NOT NULL DEFAULT '0',
  `modified_by` int(10) DEFAULT '0',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_video`),
  KEY `FK_tbl_video_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_video_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table komisiyudisial.tbl_video: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_video` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_video` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
