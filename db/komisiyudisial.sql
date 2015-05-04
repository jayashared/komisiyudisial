/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : komisiyudisial

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2015-05-05 03:41:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_agenda`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_agenda`;
CREATE TABLE `tbl_agenda` (
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

-- ----------------------------
-- Records of tbl_agenda
-- ----------------------------
INSERT INTO `tbl_agenda` VALUES ('1', 'Audiensi FH Universitas Kristen Satya Wacana', 'Audiensi FH Universitas Kristen Satya Wacana', 'Audiensi FH Universitas Kristen Satya Wacana', 'Audiensi FH Universitas Kristen Satya Wacana', 'Auditorium Lt. 4 ', 'Auditorium Lt. 4 ', '13.00 WIB - selesai', '13.00 WIB - selesai', 'Palinfo', '1', '2015-04-24 18:27:34');
INSERT INTO `tbl_agenda` VALUES ('2', 'Audiensi Universitas Djanabadra', 'Audiensi Universitas Djanabadra', 'Audiensi Universitas Djanabadra', 'Audiensi Universitas Djanabadra', 'Auditorium Lt. 4 ', 'Auditorium Lt. 4 ', '13.00 WIB-selesai', '13.00 WIB-selesai ', 'Palinfo', '1', '2015-04-24 18:29:16');

-- ----------------------------
-- Table structure for `tbl_announcement`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_announcement`;
CREATE TABLE `tbl_announcement` (
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

-- ----------------------------
-- Records of tbl_announcement
-- ----------------------------
INSERT INTO `tbl_announcement` VALUES ('1', '2015-04-23', 'sadsadsad', 'sdasdsad', '<p>\r\n	sadsadsad</p>\r\n', '<p>\r\n	asdsadsads</p>\r\n', 'ab27a-03-03-2015-10-57-33.png', '1', '2015-04-23 19:00:13');
INSERT INTO `tbl_announcement` VALUES ('2', '2015-04-30', 'Test', 'test', '<p>\r\n	test</p>\r\n', '<p>\r\n	tets</p>\r\n', 'ec20a-10-04-2015-13-30-50.png', '1', '2015-04-23 19:08:08');

-- ----------------------------
-- Table structure for `tbl_article`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_article`;
CREATE TABLE `tbl_article` (
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

-- ----------------------------
-- Records of tbl_article
-- ----------------------------
INSERT INTO `tbl_article` VALUES ('1', 'Test Article', 'Test Article', '<p>\r\n	Isi Article</p>\r\n', '<p>\r\n	Isi Article</p>\r\n', '', '1', '2015-05-03 16:42:41');

-- ----------------------------
-- Table structure for `tbl_information_system`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_information_system`;
CREATE TABLE `tbl_information_system` (
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

-- ----------------------------
-- Records of tbl_information_system
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_laws`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laws`;
CREATE TABLE `tbl_laws` (
  `id_laws` int(11) NOT NULL AUTO_INCREMENT,
  `laws_id` varchar(255) NOT NULL,
  `laws_en` varchar(255) NOT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_laws`),
  KEY `FK_tbl_produk_hukum_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_produk_hukum_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_laws
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_laws_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laws_category`;
CREATE TABLE `tbl_laws_category` (
  `id_laws_category` int(11) NOT NULL AUTO_INCREMENT,
  `laws_category_id` varchar(255) NOT NULL,
  `laws_category_en` varchar(255) NOT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_laws_category`),
  KEY `FK_tbl_produk_hukum_kategori_tbl_user` (`modified_by`),
  CONSTRAINT `FK_tbl_produk_hukum_kategori_tbl_user` FOREIGN KEY (`modified_by`) REFERENCES `tbl_user` (`id_user`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_laws_category
-- ----------------------------
INSERT INTO `tbl_laws_category` VALUES ('1', 'Undang-undang', '', '1', '2015-04-23 14:45:35');
INSERT INTO `tbl_laws_category` VALUES ('2', 'Peraturan', '', '1', '2015-04-23 14:45:45');

-- ----------------------------
-- Table structure for `tbl_link`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_link`;
CREATE TABLE `tbl_link` (
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

-- ----------------------------
-- Records of tbl_link
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_news`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_news`;
CREATE TABLE `tbl_news` (
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

-- ----------------------------
-- Records of tbl_news
-- ----------------------------
INSERT INTO `tbl_news` VALUES ('1', '2015-04-18 00:00:00', 'Contempt of Court Pengaruhi Independensi Hakim', 'Contempt of Court Pengaruhi Independensi Hakim', '<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	<strong>Medan (Komisi Yudisial)</strong>&nbsp;&ndash; Pengaruh independensi hakim tidak hanya berasal dari faktor internal, yaitu dari diri hakim. Namun gangguan independensi juga berasal dari faktor eksternal yang berkaitan dengan problem kesadaran dan pengetahuan hukum masyarakat dalam proses beracara di pengadilan yang masih kurang. Salah satu bukti adalah perusakan sarana dan prasarana pengadilan oleh massa, ancaman dan demonstrasi yang berlebihan, hingga berujung kekerasan fisik terhadap hakim. Hal ini tentu dapat memengaruhi independensi hakim dalam memutus sebuah perkara di pengadilan.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Demikian paparan Ketua Bidang Sumber Daya Manusia, Advokasi, Hukum, Penelitian dan Pengembangan Komisi Yudisial (KY) Jaja Ahmad Jayus dalam pembukaan &ldquo;Diseminasi Perbuatan Merendahkan Kehormatan dan Keluhuran Martabat Hakim&rdquo; di Aula Pengadilan Tinggi Sumatera Utara, Medan, Kamis (09/04).</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Jaja menerangkan, sesuai Undang-Undang (UU) Nomor 18 Tahun 2011 Pasal 20 Ayat 1 huruf e, KY diberikan tugas melakukan langkah hukum atau langkah lain apabila ada orang /perorangan, kelompok atau badan hukum yang menggangu kredibilitas dan integritas hakim.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Untuk mengantisipasi kejadian yang berulang di dalam maupun di luar ruang persidangan, KY mendorong DPR bersama Pemerintah agar bisa melahirkan UU yang berkaitan dengan contempt of court. Diharapkan ini dapat mendorong Mahkamah Agung lebih cepat dalam mewujudkan peradilan yang berwibawa dan agung di tahun 2025,&rdquo; kata Jaja</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Sebagai langkah awal, lanjut Jaja, sebelumnya KY telah melakukan survei tentang perbuatan merendahkan kehormatan dan keluhuran martabat hakim terhadap 76 hakim di lingkungan pengadilan di Medan (PN, PA dan PTUN).</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Hasil survei menyatakan, dari 76 responden pernah mengalami ancaman atau teror sebanyak 26 responden, 16 responden pernah melihat dan mengalami perusakan, penghancuran, pembakaran sarana dan prasarana pengadilan, dan 5 responden pernah mengalami kekerasan fisik. Hal lain yang terungkap adalah seluruh responden menyatakan ketidakpuasan atas keamanan hakim dan anggarannya, serta sebanyak 30 responden menyatakan solusi untuk meminimalisir atau menghilangkannya adalah dengan menerbitkan regulasi tentang&nbsp;<em>Contempt of Court</em>. (KY/Aran/Festy)</div>\r\n', '<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	<strong>Medan (Komisi Yudisial)</strong>&nbsp;&ndash; Pengaruh independensi hakim tidak hanya berasal dari faktor internal, yaitu dari diri hakim. Namun gangguan independensi juga berasal dari faktor eksternal yang berkaitan dengan problem kesadaran dan pengetahuan hukum masyarakat dalam proses beracara di pengadilan yang masih kurang. Salah satu bukti adalah perusakan sarana dan prasarana pengadilan oleh massa, ancaman dan demonstrasi yang berlebihan, hingga berujung kekerasan fisik terhadap hakim. Hal ini tentu dapat memengaruhi independensi hakim dalam memutus sebuah perkara di pengadilan.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Demikian paparan Ketua Bidang Sumber Daya Manusia, Advokasi, Hukum, Penelitian dan Pengembangan Komisi Yudisial (KY) Jaja Ahmad Jayus dalam pembukaan &ldquo;Diseminasi Perbuatan Merendahkan Kehormatan dan Keluhuran Martabat Hakim&rdquo; di Aula Pengadilan Tinggi Sumatera Utara, Medan, Kamis (09/04).</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Jaja menerangkan, sesuai Undang-Undang (UU) Nomor 18 Tahun 2011 Pasal 20 Ayat 1 huruf e, KY diberikan tugas melakukan langkah hukum atau langkah lain apabila ada orang /perorangan, kelompok atau badan hukum yang menggangu kredibilitas dan integritas hakim.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Untuk mengantisipasi kejadian yang berulang di dalam maupun di luar ruang persidangan, KY mendorong DPR bersama Pemerintah agar bisa melahirkan UU yang berkaitan dengan contempt of court. Diharapkan ini dapat mendorong Mahkamah Agung lebih cepat dalam mewujudkan peradilan yang berwibawa dan agung di tahun 2025,&rdquo; kata Jaja</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Sebagai langkah awal, lanjut Jaja, sebelumnya KY telah melakukan survei tentang perbuatan merendahkan kehormatan dan keluhuran martabat hakim terhadap 76 hakim di lingkungan pengadilan di Medan (PN, PA dan PTUN).</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Hasil survei menyatakan, dari 76 responden pernah mengalami ancaman atau teror sebanyak 26 responden, 16 responden pernah melihat dan mengalami perusakan, penghancuran, pembakaran sarana dan prasarana pengadilan, dan 5 responden pernah mengalami kekerasan fisik. Hal lain yang terungkap adalah seluruh responden menyatakan ketidakpuasan atas keamanan hakim dan anggarannya, serta sebanyak 30 responden menyatakan solusi untuk meminimalisir atau menghilangkannya adalah dengan menerbitkan regulasi tentang&nbsp;<em>Contempt of Court</em>. (KY/Aran/Festy)</div>\r\n', '1f858-1diseminasi-medan.jpg', '1', '2015-04-18 08:52:01');
INSERT INTO `tbl_news` VALUES ('2', '2015-04-23 00:00:00', 'Pengawasan Hakim Butuh Dukungan Masyarakat', 'Pengawasan Hakim Butuh Dukungan Masyarakat', '<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;&ndash; Komisi Yudisial (KY) menerima kunjungan mahasiswa dan dosen Fakultas Hukum Universitas Muhammadiyah Bengkulu (FH UMB) pada Selasa, (21/4). Kunjungan dalam rangka praktik kuliah lapangan itu ingin mengetahui tentang KY. Diterima oleh Tenaga Ahli KY Totok Wintarto yang didampingi Kepala Bidang Data dan Layanan Informasi Titik Ariyati, para mahasiswa FH UMB dijelaskan seputar wewenang dan tugas KY demi mewujudkan peradilan bersih.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Sesuai amanat undang-undang, KY memiliki dua wewenang utama, yaitu mengusulkan pengangkatan hakim agung dan hakim ad hoc di Mahkamah Agung kepada DPR untuk mendapatkan persetujuan dan wewenang lain dalam menjaga dan menegakkan kehormatan, keluhuran martabat, serta perilaku hakim.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Terkait melakukan pengawasan, KY menerima laporan masyarakat terkait dugaan pelanggaran Kode Etik dan Pedoman Perilaku Hakim (KEEPH). Bagi hakim yang terbukti melanggar KEPPH, KY mengusulkan penjatuhan sanksi, yaitu sanksi ringan, sedang dan berat.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Jika sanksinya ringan dan sedang, maka penjatuhan sanksi dari KY tersebut bersifat mengikat. Sedang kalau sanksinya berat, maka akan dibentuk Sidang Majelis Kehormatan Hakim,&rdquo; papar Totok.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Lebih lanjut Totok mengajak seluruh elemen masyarakat, termasuk mahasiswa, membantu KY untuk mengawasi hakim. &ldquo;Jika ada hakim yang diduga melanggar kode etik, sertakan bukti, lalu silakan laporkan kepada KY,&rdquo; pungkas Totok. (KY/Gaudi/Festy)</div>\r\n', '<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;&ndash; Komisi Yudisial (KY) menerima kunjungan mahasiswa dan dosen Fakultas Hukum Universitas Muhammadiyah Bengkulu (FH UMB) pada Selasa, (21/4). Kunjungan dalam rangka praktik kuliah lapangan itu ingin mengetahui tentang KY. Diterima oleh Tenaga Ahli KY Totok Wintarto yang didampingi Kepala Bidang Data dan Layanan Informasi Titik Ariyati, para mahasiswa FH UMB dijelaskan seputar wewenang dan tugas KY demi mewujudkan peradilan bersih.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Sesuai amanat undang-undang, KY memiliki dua wewenang utama, yaitu mengusulkan pengangkatan hakim agung dan hakim ad hoc di Mahkamah Agung kepada DPR untuk mendapatkan persetujuan dan wewenang lain dalam menjaga dan menegakkan kehormatan, keluhuran martabat, serta perilaku hakim.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Terkait melakukan pengawasan, KY menerima laporan masyarakat terkait dugaan pelanggaran Kode Etik dan Pedoman Perilaku Hakim (KEEPH). Bagi hakim yang terbukti melanggar KEPPH, KY mengusulkan penjatuhan sanksi, yaitu sanksi ringan, sedang dan berat.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Jika sanksinya ringan dan sedang, maka penjatuhan sanksi dari KY tersebut bersifat mengikat. Sedang kalau sanksinya berat, maka akan dibentuk Sidang Majelis Kehormatan Hakim,&rdquo; papar Totok.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Lebih lanjut Totok mengajak seluruh elemen masyarakat, termasuk mahasiswa, membantu KY untuk mengawasi hakim. &ldquo;Jika ada hakim yang diduga melanggar kode etik, sertakan bukti, lalu silakan laporkan kepada KY,&rdquo; pungkas Totok. (KY/Gaudi/Festy)</div>\r\n', '31a1a-5audiensi-muhammadiyah-.jpg', '1', '2015-04-23 19:11:56');
INSERT INTO `tbl_news` VALUES ('3', '2015-04-30 00:00:00', 'Seleksi CHA, KY Tekankan Integritas dan Kapasitas', 'Seleksi CHA, KY Tekankan Integritas dan Kapasitas', '<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;- Ratusan mahasiswa yang didampingi Dosen Fakultas Hukum Universitas Janabadra, Yogyakarta berkunjung ke kantor Komisi Yudisial (KY) yang beralamat di Jalan Kramat Raya 57, Jakarta Pusat. Kunjungan dalam rangka Praktik Kerja Lapangan diterima oleh Tenaga Ahli bidang Anotasi Imran dan Kepala Bidang data dan Layanan Informasi Titik Ariyati.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Dalam paparannya, Imran menjelaskan kehadiran KY untuk mengembalikan kepercayaan masyarakat terhadap dunia peradilan. Sesuai amanat undang-undang, KY memiliki dua wewenang utama, yaitu mengusulkan pengangkatan hakim agung dan hakim ad hoc di Mahkamah Agung kepada DPR untuk mendapatkan persetujuan dan wewenang lain dalam menjaga dan menegakkan kehormatan, keluhuran martabat, serta perilaku hakim.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Terkait wewenang melakukan seleksi calon hakim agung, KY berhati-hati dengan menekankan integritas dan kapasitas calon hakim agung (CHA). Selanjutnya, CHA yang lulus wawancara akan diajukan kepada DPR untuk mendapatkan persetujuan.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Selain itu, lanjut Imron, KY juga mempunyai wewenang tambahan yang diberikan oleh UU Peradilan Umum, UU Peradilan Agama, dan UU Peradilan Tata Usaha Negara, yaitu melakukan seleksi pengangkatan hakim bersama dengan Mahkamah Agung (MA). Namun, beberapa waktu lalu IKAHI Pusat melakukan gugatan uji materi terhadap tiga UU tersebut.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Gugatan tersebut meminta MK membatalkan keterlibatan KY dalam seleksi pengangkatan hakim. Sementara itu, KY menganggap harus dilakukan bersama. Namun, KY tidak menjadi pihak langsung karena hanya terkait,&rdquo; imbuhnya.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Sementara wewenang lain, lanjut Imran, menjadikan Kode Etik dan &nbsp;Pedoman Perilaku Hakim (KEEPH) sebagai panduan dalam mengawasi hakim. KEEPH ini juga digunakan KY dalam menentukan jenis sanksi yang diberikan kepada hakim yang terbukti melanggar kode etik.&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Kalau sanksinya ringan, hakim terlapor hanya diberi teguran. Kalau sedang, diberi sanksi non palu. Sedangkan jika terbukti melakukan pelanggaran berat, maka si hakim terlapor diusulkan diberhentikan. Untuk memberhentikan hakim harus melalui mekanisme Sidang Majelis Kehormatan Hakim yang terdiri empat Anggota KY dan tiga Hakim Agung,&rdquo; tutup Imran. (KY/Kus/Festy)</div>\r\n', '<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;- Ratusan mahasiswa yang didampingi Dosen Fakultas Hukum Universitas Janabadra, Yogyakarta berkunjung ke kantor Komisi Yudisial (KY) yang beralamat di Jalan Kramat Raya 57, Jakarta Pusat. Kunjungan dalam rangka Praktik Kerja Lapangan diterima oleh Tenaga Ahli bidang Anotasi Imran dan Kepala Bidang data dan Layanan Informasi Titik Ariyati.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Dalam paparannya, Imran menjelaskan kehadiran KY untuk mengembalikan kepercayaan masyarakat terhadap dunia peradilan. Sesuai amanat undang-undang, KY memiliki dua wewenang utama, yaitu mengusulkan pengangkatan hakim agung dan hakim ad hoc di Mahkamah Agung kepada DPR untuk mendapatkan persetujuan dan wewenang lain dalam menjaga dan menegakkan kehormatan, keluhuran martabat, serta perilaku hakim.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Terkait wewenang melakukan seleksi calon hakim agung, KY berhati-hati dengan menekankan integritas dan kapasitas calon hakim agung (CHA). Selanjutnya, CHA yang lulus wawancara akan diajukan kepada DPR untuk mendapatkan persetujuan.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Selain itu, lanjut Imron, KY juga mempunyai wewenang tambahan yang diberikan oleh UU Peradilan Umum, UU Peradilan Agama, dan UU Peradilan Tata Usaha Negara, yaitu melakukan seleksi pengangkatan hakim bersama dengan Mahkamah Agung (MA). Namun, beberapa waktu lalu IKAHI Pusat melakukan gugatan uji materi terhadap tiga UU tersebut.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Gugatan tersebut meminta MK membatalkan keterlibatan KY dalam seleksi pengangkatan hakim. Sementara itu, KY menganggap harus dilakukan bersama. Namun, KY tidak menjadi pihak langsung karena hanya terkait,&rdquo; imbuhnya.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Sementara wewenang lain, lanjut Imran, menjadikan Kode Etik dan &nbsp;Pedoman Perilaku Hakim (KEEPH) sebagai panduan dalam mengawasi hakim. KEEPH ini juga digunakan KY dalam menentukan jenis sanksi yang diberikan kepada hakim yang terbukti melanggar kode etik.&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Kalau sanksinya ringan, hakim terlapor hanya diberi teguran. Kalau sedang, diberi sanksi non palu. Sedangkan jika terbukti melakukan pelanggaran berat, maka si hakim terlapor diusulkan diberhentikan. Untuk memberhentikan hakim harus melalui mekanisme Sidang Majelis Kehormatan Hakim yang terdiri empat Anggota KY dan tiga Hakim Agung,&rdquo; tutup Imran. (KY/Kus/Festy)</div>\r\n', '', '1', '2015-04-23 19:12:57');
INSERT INTO `tbl_news` VALUES ('4', '2015-04-24 00:00:00', 'ICW Sampaikan Eksaminasi Publik Putusan Praperadilan Hakim Sarpin ke KY', 'ICW Sampaikan Eksaminasi Publik Putusan Praperadilan Hakim Sarpin ke KY', '<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;- Divisi Hukum dan Monitoring Peradilan Indonesia Corruption Watch (ICW) a bertandang ke kantor Komisi Yudisial Kamis (23/4/2015). Mereka terdiri dari &nbsp;Emerson Yuntho, Lalola Easter, dan Aradila Caesar yang datang ke KY itu bermaksud menyampaikan hasil eksaminasi publik terhadap putusan Hakim Sarpin Rizaldi dalam perkara praperadilan Komjen Budi Gunawan di Pengadilan Jakarta Selatan beberapa waktu lalu.&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Selain itu kata Emerson ICW juga meminta update terbaru perkembangan kasus dugaan pelanggaran kode etik Hakim Tunggal Pengadilan Negeri Jakarta Selatan yang menangani perkara praperadilan Komjen Budi Gunawan. Masih kata Emerson ICW juga menyampaikan hasil studi terhadap hakim-hakim yang menangani perkara korupsi dari tingkat pengadilan negeri, Pengadilan Tinggi hingka Kasasi di Mahkamah Agung.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Di sini kami ada tiga agenda. Yang pertama kami sampaikan hasil studi kami terhadap perkara-perkara korupsi yang ditangani oleh hakim-hakim di mahkamah Agung. Yang kedua kami sampaikan hasil hasil eksaminasi perkara praperadilan perkara Budi Gunawan. Yang ketiga, kita ingin mendapatkan update pemeriksaan Hakim Sarpin,&rdquo; kata Emerson saat bertemu dengan Ketua Bidang Hubungan Antara Lembaga dan Layanan Informasi KY Imam Anshori Saleh yang didamping Kepala Biro Umum Andi Djalal Latief.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Sementara itu Staf ICW yang lain &nbsp;Lalola Ester yang menjelaskan jika ICW dalam melakukan eksaminasi Publik tersebut melibatkan sejumlah guru besar dari berbagai Perguruan Tinggi di Indonesia. Di antaranya adalah Profesor Maria Emong dari UNPAD, Prof Hibnu Unsoed dan mantan KHN Prof Sahetapy. Hasil dari eksaminasi tersebut kata Lalola ada beberapa asas yang dilanggar.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Misalkan Proses praperadilan harusnya tidak memakan waktu selama itu. Ketika tahu itu bukan obyek peradilan. Dalam eksaminasi itu dibicarakan juga soal upaya hukum apa yang bisa dilakukan termasuk oleh KPK,&rdquo; katanya</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Sementara itu Komisioner KY Imam Anshori menyambut baik hasil eksaminasi publik atas putusan praperadilan Komjen Budi Gunawan. Menurut Imam, hasil eksaminasi publik tersebut akan menjadi masukan dalam rapat pleno dalam menentukan perkara Hakim Sarpin Rizaldi.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Kami sangat senang atas eksaminasi publik yang dilakukan ICW ini. Kami tidak mungkin tahu kalau tidak ada masukan-masukan dari ICW,&rdquo; imbuhnya</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Terkait dengan perkembangan kasus laporan Hakim Sarpin kata Imam KY saat ini tinggal meminta keterangan dari hakim terlapor. Sebelumnya KY sudah melayangkan pemanggilan pertama namun kata Imam hakim terlapor tidak datang memenuhi panggilan sesuai dengan waktu yang ditentukan. Terkait kekhawatiran menjadi preseden buruk, Imam meminta agar tidak perlu khawatir. Karena kalau tidak datang &nbsp;memenuhi panggilan KY, yang rugi malah hakim yang bersangkutan.(KY/Kus/TitiK)</div>\r\n', '<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	<strong>Jakarta (Komisi Yudisial)</strong>&nbsp;- Divisi Hukum dan Monitoring Peradilan Indonesia Corruption Watch (ICW) a bertandang ke kantor Komisi Yudisial Kamis (23/4/2015). Mereka terdiri dari &nbsp;Emerson Yuntho, Lalola Easter, dan Aradila Caesar yang datang ke KY itu bermaksud menyampaikan hasil eksaminasi publik terhadap putusan Hakim Sarpin Rizaldi dalam perkara praperadilan Komjen Budi Gunawan di Pengadilan Jakarta Selatan beberapa waktu lalu.&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Selain itu kata Emerson ICW juga meminta update terbaru perkembangan kasus dugaan pelanggaran kode etik Hakim Tunggal Pengadilan Negeri Jakarta Selatan yang menangani perkara praperadilan Komjen Budi Gunawan. Masih kata Emerson ICW juga menyampaikan hasil studi terhadap hakim-hakim yang menangani perkara korupsi dari tingkat pengadilan negeri, Pengadilan Tinggi hingka Kasasi di Mahkamah Agung.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Di sini kami ada tiga agenda. Yang pertama kami sampaikan hasil studi kami terhadap perkara-perkara korupsi yang ditangani oleh hakim-hakim di mahkamah Agung. Yang kedua kami sampaikan hasil hasil eksaminasi perkara praperadilan perkara Budi Gunawan. Yang ketiga, kita ingin mendapatkan update pemeriksaan Hakim Sarpin,&rdquo; kata Emerson saat bertemu dengan Ketua Bidang Hubungan Antara Lembaga dan Layanan Informasi KY Imam Anshori Saleh yang didamping Kepala Biro Umum Andi Djalal Latief.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Sementara itu Staf ICW yang lain &nbsp;Lalola Ester yang menjelaskan jika ICW dalam melakukan eksaminasi Publik tersebut melibatkan sejumlah guru besar dari berbagai Perguruan Tinggi di Indonesia. Di antaranya adalah Profesor Maria Emong dari UNPAD, Prof Hibnu Unsoed dan mantan KHN Prof Sahetapy. Hasil dari eksaminasi tersebut kata Lalola ada beberapa asas yang dilanggar.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Misalkan Proses praperadilan harusnya tidak memakan waktu selama itu. Ketika tahu itu bukan obyek peradilan. Dalam eksaminasi itu dibicarakan juga soal upaya hukum apa yang bisa dilakukan termasuk oleh KPK,&rdquo; katanya</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Sementara itu Komisioner KY Imam Anshori menyambut baik hasil eksaminasi publik atas putusan praperadilan Komjen Budi Gunawan. Menurut Imam, hasil eksaminasi publik tersebut akan menjadi masukan dalam rapat pleno dalam menentukan perkara Hakim Sarpin Rizaldi.</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&ldquo;Kami sangat senang atas eksaminasi publik yang dilakukan ICW ini. Kami tidak mungkin tahu kalau tidak ada masukan-masukan dari ICW,&rdquo; imbuhnya</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">\r\n	Terkait dengan perkembangan kasus laporan Hakim Sarpin kata Imam KY saat ini tinggal meminta keterangan dari hakim terlapor. Sebelumnya KY sudah melayangkan pemanggilan pertama namun kata Imam hakim terlapor tidak datang memenuhi panggilan sesuai dengan waktu yang ditentukan. Terkait kekhawatiran menjadi preseden buruk, Imam meminta agar tidak perlu khawatir. Karena kalau tidak datang &nbsp;memenuhi panggilan KY, yang rugi malah hakim yang bersangkutan.(KY/Kus/TitiK)</div>\r\n', 'e31fa-46audiensi-ky-icw.jpg', '1', '2015-04-24 16:56:07');
INSERT INTO `tbl_news` VALUES ('5', '2015-04-29 00:00:00', 'FDHI Dukung KY mewujudkan UU Jabatan Hakim dan UU Contempt of Court', 'FDHI Dukung KY mewujudkan UU Jabatan Hakim dan UU Contempt of Court', '<p>\r\n	<strong style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">Jakarta (Komisi Yudisial)</strong><span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">&nbsp;- Sekitar 15 perwakilan hakim dari berbagai wilayah di Indonesia yang tergabung dalam Forum Diskusi Hakim Indonesia (FDHI) melakukan audiensi di Komisi Yudisial (KY). Kehadiran FDHI ini diterima Ketua KY Suparman Marzuki dan Ketua Bidang Rekrutmen Hakim Taufiqqurohman Syahuri, yang didampingi oleh Plh Sekjen KY Andi Djalal Latief dan Kepala Biro Rekrutmen Heru Purnomo, (27/04).</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">Dalam pertemuan singkat yang dilakukan di Ruang Rapat KY ini, FDHI mengutarakan keinginan dan mendorong DPR, untuk segera mewujudkan Undang-Undang tentang Jabatan Hakim dan Undang-Undang tentang Perbuatan Merendahkan Keluhuran dan Martabat Hakim atau Contempt of Court (CoC) agar bisa dimasukkan dalam Prolegnas tahun 2016.</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">&ldquo;Kami menganggap kedua UU ini penting, karena bisa memperjelas status dan kedudukan hakim yang merupakan Pejabat Negara bukan PNS, serta menjamin profesionalisme dan independensi personal seorang hakim dalam melaksanakan tugas menegakkan hukum dan keadilan di Indonesia,&rdquo; tutur salah satu juru bicara FDHI yang berasal dari hakim PN Stabat.</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">Lebih lanjut FDHI juga memberikan masukan dan saran terhadap kedua RUU tersebut, dengan harapan bisa mengakomodir suara-suara para hakim se-Indonesia yang tergabung dalam FDHI.</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">Menanggapi apa yang menjadi pemikiran, keinginan dan inspirasi FDHI, Ketua KY Suparman Marzuki menegaskan bahwa KY dalam berbagai kesempatan sebelumnya telah mendorong berbagai pihak agar bisa mewujudkan kedua RUU tersebut menjadi UU.</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">&ldquo;KY secara konsisten terus mengawal dan mendorong baik DPR maupun pemerintah untuk memberikan kejelasan tentang status dan kedudukan hakim sebagai Pejabat Negara. Secara keseluruhan KY juga ingin menyempurnakan dari sisi ideologi terkait dengan sumber daya manusia, sistem rekrutmen, mutasi, dan promosi hakim bersama-sama MA secara transparan, akuntabel dan partisipatif, dan KY juga telah berhasil mendorong berbagai pihak untuk memperbaiki kesejahteraan hakim, hal ini semua merupakan kerangka besar KY dalam mendorong dan merealisasikan UU Jabatan Hakim dan Contempt of Court,&rdquo; kata Suparman di hadapan para perwakilan FDHI yang hadir.</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">&ldquo;Tentu saja langkah KY mulai dari konsepsi, draf akademik sampai dengan pembahasan pasal-pasal kedua RUU tersebut yang melibatkan berbagai unsur termasuk dari kajian akademik,&rdquo; tutur Suparman. (KY/Aran/Titik)</span></p>\r\n', '<p>\r\n	<strong style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">Jakarta (Komisi Yudisial)</strong><span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">&nbsp;- Sekitar 15 perwakilan hakim dari berbagai wilayah di Indonesia yang tergabung dalam Forum Diskusi Hakim Indonesia (FDHI) melakukan audiensi di Komisi Yudisial (KY). Kehadiran FDHI ini diterima Ketua KY Suparman Marzuki dan Ketua Bidang Rekrutmen Hakim Taufiqqurohman Syahuri, yang didampingi oleh Plh Sekjen KY Andi Djalal Latief dan Kepala Biro Rekrutmen Heru Purnomo, (27/04).</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">Dalam pertemuan singkat yang dilakukan di Ruang Rapat KY ini, FDHI mengutarakan keinginan dan mendorong DPR, untuk segera mewujudkan Undang-Undang tentang Jabatan Hakim dan Undang-Undang tentang Perbuatan Merendahkan Keluhuran dan Martabat Hakim atau Contempt of Court (CoC) agar bisa dimasukkan dalam Prolegnas tahun 2016.</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">&ldquo;Kami menganggap kedua UU ini penting, karena bisa memperjelas status dan kedudukan hakim yang merupakan Pejabat Negara bukan PNS, serta menjamin profesionalisme dan independensi personal seorang hakim dalam melaksanakan tugas menegakkan hukum dan keadilan di Indonesia,&rdquo; tutur salah satu juru bicara FDHI yang berasal dari hakim PN Stabat.</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">Lebih lanjut FDHI juga memberikan masukan dan saran terhadap kedua RUU tersebut, dengan harapan bisa mengakomodir suara-suara para hakim se-Indonesia yang tergabung dalam FDHI.</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">Menanggapi apa yang menjadi pemikiran, keinginan dan inspirasi FDHI, Ketua KY Suparman Marzuki menegaskan bahwa KY dalam berbagai kesempatan sebelumnya telah mendorong berbagai pihak agar bisa mewujudkan kedua RUU tersebut menjadi UU.</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">&ldquo;KY secara konsisten terus mengawal dan mendorong baik DPR maupun pemerintah untuk memberikan kejelasan tentang status dan kedudukan hakim sebagai Pejabat Negara. Secara keseluruhan KY juga ingin menyempurnakan dari sisi ideologi terkait dengan sumber daya manusia, sistem rekrutmen, mutasi, dan promosi hakim bersama-sama MA secara transparan, akuntabel dan partisipatif, dan KY juga telah berhasil mendorong berbagai pihak untuk memperbaiki kesejahteraan hakim, hal ini semua merupakan kerangka besar KY dalam mendorong dan merealisasikan UU Jabatan Hakim dan Contempt of Court,&rdquo; kata Suparman di hadapan para perwakilan FDHI yang hadir.</span><br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<br style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\" />\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 11.6999998092651px; line-height: 16.8999996185303px; text-align: justify;\">&ldquo;Tentu saja langkah KY mulai dari konsepsi, draf akademik sampai dengan pembahasan pasal-pasal kedua RUU tersebut yang melibatkan berbagai unsur termasuk dari kajian akademik,&rdquo; tutur Suparman. (KY/Aran/Titik)</span></p>\r\n', '', '1', '2015-04-29 17:35:34');

-- ----------------------------
-- Table structure for `tbl_pers_release`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pers_release`;
CREATE TABLE `tbl_pers_release` (
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

-- ----------------------------
-- Records of tbl_pers_release
-- ----------------------------
INSERT INTO `tbl_pers_release` VALUES ('1', 'Pers Release', 'Pers Release', 'Pers Release', 'Pers Release', null, '1', '2015-04-28 18:46:42');

-- ----------------------------
-- Table structure for `tbl_polling`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_polling`;
CREATE TABLE `tbl_polling` (
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

-- ----------------------------
-- Records of tbl_polling
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_polling_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_polling_category`;
CREATE TABLE `tbl_polling_category` (
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

-- ----------------------------
-- Records of tbl_polling_category
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_polling_result`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_polling_result`;
CREATE TABLE `tbl_polling_result` (
  `id_polling_result` int(11) NOT NULL AUTO_INCREMENT,
  `id_polling` int(11) DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id_polling_result`),
  KEY `FK_tbl_polling_result_tbl_polling` (`id_polling`),
  CONSTRAINT `FK_tbl_polling_result_tbl_polling` FOREIGN KEY (`id_polling`) REFERENCES `tbl_polling` (`id_polling`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_polling_result
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_procurement`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_procurement`;
CREATE TABLE `tbl_procurement` (
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

-- ----------------------------
-- Records of tbl_procurement
-- ----------------------------
INSERT INTO `tbl_procurement` VALUES ('1', 'Lelang Terbuka', 'Lelang Terbuka', 'Lelang Terbuka', 'Lelang Terbuka', null, '1', '2015-04-28 18:45:32');

-- ----------------------------
-- Table structure for `tbl_publication`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_publication`;
CREATE TABLE `tbl_publication` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_publication
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_sitemap`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sitemap`;
CREATE TABLE `tbl_sitemap` (
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_sitemap
-- ----------------------------
INSERT INTO `tbl_sitemap` VALUES ('7', '01', null, 'frontend', 'Frontend - Parent', 'Halaman Depan', 'Frontend Parent', '#', null, null, null, '0', '1', '2015-04-29 17:09:27');
INSERT INTO `tbl_sitemap` VALUES ('8', '01.01', '7', 'home', 'Frontend - Home', 'Home', 'Home', 'home', '', '', '', '1', '1', '2015-04-23 15:54:19');
INSERT INTO `tbl_sitemap` VALUES ('9', '01.02', '7', 'tentang_ky', 'Frontend - Tentang KY', 'Tentang KY', 'About KY', 'about_ky', '', '', '', '2', '1', '2015-04-23 15:55:37');
INSERT INTO `tbl_sitemap` VALUES ('10', '01.02.01', '9', 'sejarah_pembentukan', 'Frontend - Sejarah Pembentukan', 'Sejarah Pembentukan', 'History', 'history', '', '', '', '3', '1', '2015-04-23 15:55:45');
INSERT INTO `tbl_sitemap` VALUES ('11', '01.02.02', '9', 'visi_misi', 'Frontend -Visi dan Misi', 'Visi dan Misi', 'Vision and Mision', 'vision_and_mision', '', '', '', '4', '1', '2015-04-23 15:55:54');
INSERT INTO `tbl_sitemap` VALUES ('12', '01.03', '7', 'layanan publik', 'Frontend - Layanan Publik', 'Layanan Publik', 'Public Services', 'public_service', '', '', '', '5', '1', '2015-04-23 15:56:03');
INSERT INTO `tbl_sitemap` VALUES ('13', '01.04', '7', 'produk hukum', 'Frontend - Produk Hukum', 'Produk Hukum', 'Laws', 'laws', '', '', '', '6', '1', '2015-04-23 15:56:07');
INSERT INTO `tbl_sitemap` VALUES ('14', '01.05', '7', 'publikasi', 'Frontend - Publikasi', 'Publikasi', 'Publication', 'publication', '', '', '', '7', '1', '2015-04-23 15:56:13');
INSERT INTO `tbl_sitemap` VALUES ('15', '01.06', '7', 'berita', 'Frontend - Berita', 'Berita', 'News', 'news', '', '', '', '8', '1', '2015-04-23 15:56:18');
INSERT INTO `tbl_sitemap` VALUES ('16', '01.07', '7', 'hubungi_kami', 'Frontend - Hubungi Kami', 'Hubungi Kami', 'Contact Us', 'contact_us', '', '', '', '9', '1', '2015-04-23 15:56:25');
INSERT INTO `tbl_sitemap` VALUES ('17', '02', '0', 'administrator', 'Administrator', 'Administrator', 'Administrator', '#', '', '', '', '0', '1', '2015-04-23 15:53:59');
INSERT INTO `tbl_sitemap` VALUES ('18', '02.01', '17', 'dashboard', 'Administrator - Dashboard', 'Dashboard', 'Dashboard', 'dahboard', '', '', '', '1', '1', '2015-04-29 16:58:04');
INSERT INTO `tbl_sitemap` VALUES ('19', '02.02', '17', 'admin_news', 'Administrator - News', 'Berita', 'News', 'news', '', '', '', '2', '1', '2015-04-29 16:58:06');
INSERT INTO `tbl_sitemap` VALUES ('20', '02.03', '17', 'admin_announcement', 'Administrator - Announcement', 'Pengumuman', 'Announcement', 'announcement', '', '', '', '3', '1', '2015-04-29 16:58:08');
INSERT INTO `tbl_sitemap` VALUES ('22', '02.04', '17', 'sitemap', 'Administrator - Sitemap', 'Sitemap', 'Sitemap', 'sitemap', null, null, null, '15', '1', '2015-05-04 19:39:49');
INSERT INTO `tbl_sitemap` VALUES ('26', '02.05', '17', 'agenda', 'Administrator - Agenda', 'Agenda', 'Agenda', 'agenda', null, null, null, '6', '1', '2015-04-29 17:16:13');
INSERT INTO `tbl_sitemap` VALUES ('27', '02.06', '17', 'link', 'Administrator - Link', 'Link', 'Link', 'link', null, null, null, '7', '1', '2015-04-29 17:23:19');
INSERT INTO `tbl_sitemap` VALUES ('28', '02.07', '17', 'Video', 'Link Video', 'Video', 'Video', 'video', null, null, null, '8', '1', '2015-05-03 14:07:29');
INSERT INTO `tbl_sitemap` VALUES ('29', '02.08', '17', 'Artikel', 'Artikel', 'Artikel', 'Article', 'artikel', null, null, null, '9', '1', '2015-05-03 15:17:17');
INSERT INTO `tbl_sitemap` VALUES ('30', '02.09', '17', 'Kategori Hukum', 'Kategori Hukum', 'Kategori Hukum', 'Law\'s Category', 'Kategorihukum', null, null, null, '10', '1', '2015-05-04 21:48:29');
INSERT INTO `tbl_sitemap` VALUES ('31', '02.10', '17', 'Hukum', 'Hukum', 'Hukum', 'Law', 'hukum', null, null, null, '11', '1', '2015-05-04 21:51:16');
INSERT INTO `tbl_sitemap` VALUES ('32', '02.11', '17', 'adminpublikasi', 'Administrator Publikasi', 'Publikasi', 'Publication', 'publikasi', null, null, null, '12', '1', '2015-05-05 03:30:27');

-- ----------------------------
-- Table structure for `tbl_slider`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_slider`;
CREATE TABLE `tbl_slider` (
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

-- ----------------------------
-- Records of tbl_slider
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_static_content`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_static_content`;
CREATE TABLE `tbl_static_content` (
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

-- ----------------------------
-- Records of tbl_static_content
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'admin', 'admin@email.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- ----------------------------
-- Table structure for `tbl_video`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_video`;
CREATE TABLE `tbl_video` (
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

-- ----------------------------
-- Records of tbl_video
-- ----------------------------

-- ----------------------------
-- View structure for `tbl_user_view`
-- ----------------------------
DROP VIEW IF EXISTS `tbl_user_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tbl_user_view` AS select `u`.`id_user` AS `id_user`,`u`.`email` AS `email`,`u`.`password` AS `password` from `tbl_user` `u` ;

-- ----------------------------
-- View structure for `view_tbl_sitemap`
-- ----------------------------
DROP VIEW IF EXISTS `view_tbl_sitemap`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tbl_sitemap` AS select `s`.`id_sitemap` AS `id_sitemap`,`s`.`sitemap_code` AS `sitemap_code`,`s`.`id_parent` AS `id_parent`,`s`.`name` AS `name`,`s`.`description` AS `description`,`s`.`title_id` AS `title_id`,`s`.`title_en` AS `title_en`,`s`.`url` AS `url`,`s`.`css_class` AS `css_class`,`s`.`css_id` AS `css_id`,`s`.`icon` AS `icon`,`s`.`sort_no` AS `sort_no`,`s`.`modified_by` AS `modified_by`,`s`.`modified_date` AS `modified_date`,round((length(replace(`s`.`sitemap_code`,'.','')) / 2),0) AS `sitemap_level`,concat(`s`.`sitemap_code`,' - ',`s`.`description`) AS `parent` from `tbl_sitemap` `s` ;
