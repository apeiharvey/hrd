/*
SQLyog Community v12.02 (64 bit)
MySQL - 5.5.37 : Database - hrd_recruitment
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hrd_recruitment` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `hrd_recruitment`;

/*Table structure for table `hrd_blog_category` */

DROP TABLE IF EXISTS `hrd_blog_category`;

CREATE TABLE `hrd_blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `name_alias` varchar(200) NOT NULL,
  `order` int(3) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_blog_category` */

insert  into `hrd_blog_category`(`id`,`name`,`name_alias`,`order`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (8,'News','News',1,1,'2017-07-10 04:03:27','2017-07-11 01:52:16',6,10);

/*Table structure for table `hrd_blog_post` */

DROP TABLE IF EXISTS `hrd_blog_post`;

CREATE TABLE `hrd_blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `content` text,
  `thumbnail` varchar(150) DEFAULT NULL,
  `view` int(10) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `order` int(3) DEFAULT NULL,
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_description` varchar(200) DEFAULT NULL,
  `meta_keywords` text,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `title_alias` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_blog_post` */

insert  into `hrd_blog_post`(`id`,`category_id`,`title`,`content`,`thumbnail`,`view`,`active`,`order`,`meta_title`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`,`created_by`,`updated_by`,`title_alias`) values (11,8,'Ibu Kota di Palangkaraya Masih Isu, Jangan Jual Tanah Dulu','<p>Liputan6.com, Palangka Raya - Pemerintah tengah menggodok sejumlah kajian dan pertimbangan terkait dengan rencana pemindahan ibu kota dari Jakarta. Beberapa kota di Indonesia masuk daftar sebagai calon ibu kota. Salah satunya Palangkaraya di Kalimantan Tengah (Kalteng). Menguatnya isu Palangkaraya sebagai salah satu kandidat ibu kota negara ternyata membuat para spekulan dan pemodal di Kalteng bergerak untuk menangguk untung dari bisnis jual beli tanah di tanah Dayak ini. &nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Akibatnya, saat ini harga tanah di Palangkaraya dan sekitarnya mulai melonjak tajam. Kondisi ini tentu sangat mengkhawatirkan, mengingat masyarakat nanti akan tergiur dan buru-buru menjual tanah.</p>','WzrFf.gif',43,1,1,'Ibu Kota di Palangkaraya Masih Isu, Jangan Jual Tanah Dulu','ibu - ibu berbicara','Isu','2017-07-07 02:56:20','2017-07-10 10:38:04',6,10,'ibu-kota-di-palangkaraya-masih-isu-jangan-jual-tanah-dulu'),(12,8,'8 Negara Ini Pernah Pindahkan Ibu Kota','<p>Liputan6.com, Jakarta - Pada awal September 2013, Presiden Susilo Bambang Yudhoyono (SBY) berkunjung ke Kazakhstan. Saat berada di negara itu, SBY mengungkapkan kekagumannya pada Astana, ibu kota Kazakhstan. Dia menilai, negara itu sukses memindahkan ibu kota negaranya dari Almaty ke Astana.</p>\r\n<p>Atas dasar itu pula, SBY kemudian punya keinginan untuk memindahkan ibu kota dari Jakarta ke daerah lain. Bahkan, SBY kemudian membentuk tim kecil guna mengkaji rencana tersebut. Kendati hasil kerja tim tersebut tak diketahui, wacana tentang pemindahan ibu kota negara itu kini kembali bergulir.</p>','aniH4.gif',29,1,2,'Ibu kota negara pindah','ibu kota negara pindah','ibu kota negara pindah','2017-07-07 02:58:35','2017-07-10 10:42:11',6,10,'8-negara-ini-pernah-pindahkan-ibu-kota'),(13,8,'Ridwan Kamil: Perubahan Itu Harus Dijemput, Bukan Ditunggu','<p>Liputan6.com, Jakarta - Wali Kota Bandung Ridwan Kamil mengakui Indonesia mengalami banyak kemajuan, meski di satu sisi perlu diakui Indonesia masih mengalami banyak permasalahan.</p>\r\n<p>Hal itu dikatakan wali kota yang akrab disapa Kang Emil itu saat menjadi pembicara dalam Supermentor 14 \'Abad 21 Sebagai Zaman Kecermelangan Indonesia\' di Djakarta Theater, Jakarta Pusat.</p>','DrtOh.gif',12,1,3,'Ridwan kamil berbicara','kata - kata ridwan kamil','Ridwan kamil berbicara','2017-07-07 03:01:56','2017-07-10 10:51:06',6,10,'ridwan-kamil-perubahan-itu-harus-dijemput-bukan-ditunggu'),(15,8,'Menyulap Kulit Kerang Menjadi Perhiasan Cantik','<p>Liputan6.com, Jakarta Tak pernah terpikirkan bagi mantan Dosen Institut Kesenian Jakarta (IKJ) Efdalius Ruswandi menjadi pengusaha kulit kerang. Dia berhasil menyulap limbah kulit berang yang tak digunakan tersebut menjadi perhiasan, asesoris dan souvenir yang kini telah diekspor ke beberapa negara seperti Dubai, Malaysia, Singapura, dan Belanda.</p>\r\n<p>Pria kelahiran Padang, Sumatera Barat, 58 tahun silam ini mulanya hanya seorang pekerja di perusahaan yang bergerak di bidang mutiara usai lepas dari pekerjaan sebagai dosen. Bosan menjadi pekerja, akhirnya dia memutuskan untuk mendirikan usaha kerajinan kulit kerang pada tahun 2000 dengan modal sebesar Rp20 juta dengan pekerja tetap sebanyak dua orang.</p>','EfyC6.gif',11,1,4,'Sulap kerang','Efdalius Ruswandi juaran sulap ke 2','sulap kerang','2017-07-07 03:05:43','2017-07-10 10:08:20',6,10,'menyulap-kulit-kerang-menjadi-perhiasan-cantik');

/*Table structure for table `hrd_company_category` */

DROP TABLE IF EXISTS `hrd_company_category`;

CREATE TABLE `hrd_company_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `name_alias` varchar(200) NOT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `order` int(3) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_company_category` */

insert  into `hrd_company_category`(`id`,`name`,`name_alias`,`thumbnail`,`order`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (8,'E-Commerce','E-commerce','8UOlA.gif',1,1,'2017-07-07 02:23:39','2017-07-11 03:07:40',6,10),(9,'Service and Property','S&P','aMvKD.gif',2,1,'2017-07-07 02:24:02','2017-07-11 03:05:44',6,10),(10,'Food and Beverages','F&B','Jwi6t.gif',3,1,'2017-07-07 02:25:20','2017-07-11 03:05:37',6,10),(11,'Retail','Retail','kJ1x3.gif',4,1,'2017-07-07 02:26:33','2017-07-11 03:07:24',6,10),(12,'Manufacturing','Manufacturing','8et6J.gif',5,1,'2017-07-07 02:27:46','2017-07-11 03:07:09',6,10),(15,'Industrial','Industrial','6ZikT.png',6,1,'2017-07-11 03:06:53','2017-07-11 03:06:53',10,NULL);

/*Table structure for table `hrd_company_post` */

DROP TABLE IF EXISTS `hrd_company_post`;

CREATE TABLE `hrd_company_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `thumbnail` text,
  `url` varchar(150) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `order` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_company_post` */

insert  into `hrd_company_post`(`id`,`category_id`,`title`,`thumbnail`,`url`,`active`,`order`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (9,8,'Rupa-Rupa','2MA3V.png','ruparupa.com',1,1,'0000-00-00 00:00:00','2017-07-11 03:24:03',10,10),(10,8,'Klik MRO Industrial Supply','BAj8C.png','klikmro.com',1,2,'2017-07-11 03:14:14','2017-07-11 03:14:14',10,NULL),(11,9,'Living World','ShQZF.png','living-world',1,3,'2017-07-11 03:15:18','2017-07-11 03:15:18',10,NULL),(12,9,'Living Plaza','jq5kO.png','living-plaza',1,4,'2017-07-11 03:15:42','2017-07-11 03:15:42',10,NULL),(13,9,'PT. Multi Rentalindo','CKoGL.png','multi-rentalindo',1,5,'2017-07-11 03:16:10','2017-07-11 03:16:10',10,NULL),(14,9,'Pet Kingdom','jxWZP.png','pet-kingdom',1,7,'2017-07-11 03:16:31','2017-07-11 03:16:31',10,NULL),(15,10,'Chatime','HWfx8.png','chatime',1,8,'2017-07-11 03:17:01','2017-07-11 03:17:01',10,NULL),(16,10,'Cupbop Korean BBQ','FN1A5.png','cupbop',1,9,'2017-07-11 03:17:31','2017-07-11 03:17:31',10,NULL),(17,10,'Kepiting Cak Gundul 1992','fp8Qj.png','kepiting-cak-gundul',1,10,'2017-07-11 03:18:02','2017-07-11 03:18:02',10,NULL),(18,10,'Ubud Paradise','KQQpI.png','ubud-paradise',1,11,'2017-07-11 03:18:18','2017-07-11 03:18:18',10,NULL),(19,11,'Ace Hardware','r2Ukv.png','ace-hardware',1,12,'2017-07-11 03:18:49','2017-07-11 03:18:49',10,NULL),(20,11,'Bike Colony','S5wWw.png','bike-colony',1,13,'2017-07-11 03:19:09','2017-07-11 03:19:09',10,NULL),(21,11,'Dr. Kong','LeavM.png','dr-kong',1,14,'2017-07-11 03:19:38','2017-07-11 03:19:38',10,NULL),(22,11,'Informa','P2SnT.png','informa',1,15,'2017-07-11 03:20:00','2017-07-11 03:20:00',10,NULL),(23,11,'Pendopo','IJzQj.png','pendopo',1,16,'2017-07-11 03:20:19','2017-07-11 03:20:19',10,NULL),(24,11,'Toys Kingdom','7uqZh.png','toys-kingdom',1,17,'2017-07-11 03:20:40','2017-07-11 03:20:40',10,NULL),(25,12,'Golden Dacron','rm3kG.png','golden-dacron',1,18,'2017-07-11 03:21:23','2017-07-11 03:21:23',10,NULL),(26,15,'Kaeser','5A6PR.png','kaeser',1,19,'2017-07-11 03:21:56','2017-07-11 03:21:56',10,NULL),(27,15,'Kawan Lama','TIjcY.png','kawan-lama',1,20,'2017-07-11 03:22:13','2017-07-11 03:22:13',10,NULL),(28,15,'Kawan Lama Internusa','Oof1S.png','kawan-lama-internusa',1,21,'2017-07-11 03:22:36','2017-07-11 03:22:36',10,NULL),(29,15,'Krisbow','rIPxb.png','krisbow',1,22,'2017-07-11 03:22:52','2017-07-11 03:22:52',10,NULL),(30,15,'PT. Miller','nLddC.png','miller',1,23,'2017-07-11 03:23:15','2017-07-11 03:23:45',10,10),(31,15,'Sensorindo','uNJmi.png','sensorindo',1,24,'2017-07-11 03:23:31','2017-07-11 03:23:31',10,NULL);

/*Table structure for table `hrd_company_value` */

DROP TABLE IF EXISTS `hrd_company_value`;

CREATE TABLE `hrd_company_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `content` text,
  `thumbnail` varchar(150) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `order` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_company_value` */

insert  into `hrd_company_value`(`id`,`name`,`description`,`content`,`thumbnail`,`active`,`order`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (8,'Our People','ELITE','Excellence\r\nLeadership\r\nIntegrity\r\nTeamwork\r\nEnthusiasm','J8YNk.gif',1,3,'2017-07-05 09:08:31','2017-07-11 03:27:32',6,10),(9,'Our Place','COSY','Clean\r\nOrganized\r\nSafe\r\nYours','lN6bI.gif',1,2,'2017-07-06 02:10:18','2017-07-11 03:27:43',6,10),(13,'Our Service','HELPFUL','<p>Hello</p>\r\n<p>Energetic</p>\r\n<p>Listening</p>\r\n<p>Polite</p>\r\n<p>Friendly</p>\r\n<p>Understanding</p>\r\n<p>Lending Hand</p>','PH5xk.png',1,1,'2017-07-11 01:46:49','2017-07-11 01:46:49',6,NULL),(14,'Our Product','QSV','<p>Quality Professional</p>\r\n<p>Selection Great</p>\r\n<p>Value Exceptional</p>','1msAO.gif',1,4,'2017-07-11 01:49:11','2017-07-11 01:49:11',6,NULL),(15,'Way Of Works','SBF','<p>Smarter</p>\r\n<p>Better</p>\r\n<p>Faster</p>','9qOSt.gif',1,5,'2017-07-11 01:50:02','2017-07-11 01:50:02',6,NULL);

/*Table structure for table `hrd_contents` */

DROP TABLE IF EXISTS `hrd_contents`;

CREATE TABLE `hrd_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `value` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_contents` */

insert  into `hrd_contents`(`id`,`name`,`value`,`created_at`,`updated_at`) values (1,'about_us','Hanya Test','2017-06-22 10:05:51','2017-07-10 02:40:49'),(2,'what_success','&ldquo;We make a living by what we get, We make a life by what we give&rdquo;','2017-06-22 10:05:58','2017-07-11 02:21:39'),(3,'video_url','https://www.youtube.com/embed/XGSy3_Czz8k','2017-06-22 10:06:31','2017-07-06 03:11:13'),(4,'home_header','pUyar.jpg','2017-06-22 10:07:40','2017-07-10 10:59:41'),(5,'contact_us_header','b6xsQ.jpeg','2017-06-22 10:07:44','2017-07-10 02:34:20'),(6,'gallery_header','aN4NE.jpeg','2017-06-22 10:07:59','2017-07-10 02:34:20'),(7,'email_approve','qweqeq\r\nqewqeq\r\nqweqewq','0000-00-00 00:00:00','2017-07-04 07:10:19'),(8,'email_reject','qweqeqeq','0000-00-00 00:00:00','2017-07-04 07:10:19'),(9,'home_search_word','{\"title\":\"a\",\"description\":\"sasas\"}','0000-00-00 00:00:00','2017-07-06 10:57:21'),(10,'remove-single-home_header','n','2017-07-04 07:07:51','2017-07-04 07:07:51'),(11,'remove-single-contact_us_header','n','2017-07-04 07:07:51','2017-07-04 07:07:51'),(12,'remove-single-gallery_header','n','2017-07-04 07:07:51','2017-07-04 07:07:51'),(13,'home_search_word_title','We Are Elites','0000-00-00 00:00:00','2017-07-10 10:54:10'),(14,'home_search_word_description','Unity in Diversity','0000-00-00 00:00:00','2017-07-10 10:56:23'),(15,'what_success_author','Sir. Winston Churchil','0000-00-00 00:00:00','2017-07-11 08:40:24'),(16,'what_success_author_department','','0000-00-00 00:00:00','2017-07-11 02:29:51');

/*Table structure for table `hrd_gallery` */

DROP TABLE IF EXISTS `hrd_gallery`;

CREATE TABLE `hrd_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `thumbnail` varchar(150) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `order` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_gallery` */

insert  into `hrd_gallery`(`id`,`title`,`thumbnail`,`active`,`order`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (2,'bukber karyawan','Capture2.jpg',1,1,'0000-00-00 00:00:00','2017-07-10 08:04:08',NULL,6),(3,'party','Capture3.gif',1,3,'0000-00-00 00:00:00','2017-07-06 15:47:15',NULL,NULL),(4,'jalan-jalan','Capture4.jpg',1,4,'0000-00-00 00:00:00','2017-07-06 15:50:53',NULL,NULL),(5,'kegiatan kantor','Capture5.jpg',1,5,'0000-00-00 00:00:00','2017-07-06 15:52:47',NULL,NULL),(6,'keluarga besar','Capture6.png',1,6,'0000-00-00 00:00:00',NULL,NULL,NULL),(37,'Sepedaan','tyTcR.jpeg',1,1,'2017-07-10 04:41:31','2017-07-10 04:41:31',6,NULL),(38,'Yoga','8ROEe.jpeg',1,2,'2017-07-10 04:49:32','2017-07-10 04:49:32',6,NULL);

/*Table structure for table `hrd_settings` */

DROP TABLE IF EXISTS `hrd_settings`;

CREATE TABLE `hrd_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `value` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_settings` */

insert  into `hrd_settings`(`id`,`name`,`value`,`created_at`,`updated_at`) values (1,'web_name','Kawan Lama','2017-06-21 14:39:15','2017-06-21 07:41:32'),(2,'alamat','asdesadas','2017-06-20 13:34:42','0000-00-00 00:00:00'),(3,'email','KawanLama@asd.com','2017-06-21 14:39:15','2017-06-21 07:41:32'),(4,'address','Puri Kembangan, Jakarta Barat','2017-07-10 10:09:31','2017-07-10 03:11:43'),(5,'latitude','-6.1905156','2017-07-10 09:21:58','2017-06-21 07:41:32'),(7,'remove-single-uploadHeader','n','2017-06-21 07:16:27','2017-06-21 07:16:27'),(8,'maintenance','1','2017-07-07 10:55:06','2017-07-07 03:57:18'),(9,'whitelist_ip','192.136.12.1','2017-06-21 14:39:16','2017-06-21 07:41:32'),(10,'meta_title','asd','2017-06-21 14:39:16','2017-06-21 07:41:32'),(11,'meta_keywords','adsa\r\nasd','2017-06-22 09:43:38','2017-06-22 02:45:54'),(12,'uploadHeader','C:\\xampp\\tmp\\php5D29.tmp','2017-06-21 07:33:43','2017-06-21 07:33:43'),(13,'longitude','106.7435614','2017-07-10 09:22:07','2017-06-21 07:41:32'),(16,'logo_header','oRR0R.png','2017-07-10 11:20:08','2017-07-10 04:22:20'),(17,'logo_footer','fPqz4.png','2017-07-10 11:20:08','2017-07-10 04:22:20'),(18,'meta_description','test saja','2017-06-21 07:55:48','2017-06-21 07:55:48'),(21,'remove-single-logo_header','n','2017-06-22 02:45:54','2017-06-22 02:45:54'),(22,'remove-single-logo_footer','n','2017-06-22 02:45:54','2017-06-22 02:45:54');

/*Table structure for table `hrd_social_media` */

DROP TABLE IF EXISTS `hrd_social_media`;

CREATE TABLE `hrd_social_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `thumbnail` varchar(150) NOT NULL,
  `url` text NOT NULL,
  `order` int(3) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_social_media` */

insert  into `hrd_social_media`(`id`,`name`,`thumbnail`,`url`,`order`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (1,'Facebook','P1NDf.png','https://facebook.com/',1,1,'0000-00-00 00:00:00','2017-07-06 08:36:22',2,10),(12,'Twitter','dBgpL.png','twitter.com',5,1,'2017-07-05 08:54:45','2017-07-06 08:36:14',6,10),(13,'Linked In','m6iNj.png','linked.in',2,1,'2017-07-06 02:27:48','2017-07-06 02:27:48',6,NULL),(16,'Instagram','ReBkt.png','instagram.com',4,1,'2017-07-06 08:35:15','2017-07-06 08:36:01',10,10),(17,'Youtube','xiJv9.png','youtube.com',5,1,'2017-07-06 08:37:11','2017-07-06 08:37:11',10,NULL);

/*Table structure for table `hrd_users` */

DROP TABLE IF EXISTS `hrd_users`;

CREATE TABLE `hrd_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_users` */

insert  into `hrd_users`(`id`,`name`,`email`,`password`,`last_login`,`remember_token`,`created_at`,`updated_at`) values (6,'admin','admin@admin.com','$2y$10$5YQgHxovM0uTBdbQlXjOauA4vsnBqZszu.pcxMC/GZjCGfP/3rOUG',NULL,'anlnK4OORCefQWOxI6WvN40BEtKkktj9ArxhmA2fD8UM6S2H4Ek2nDmevC6C','2017-07-05 03:45:14','2017-07-10 15:00:58'),(10,'Harvei','harvei@gmail.com','$2y$10$hwvgmIBVUg4V1/nGyO6HQeOOm5eufi9hKtAkWHLh74/s45WZzojym',NULL,'Lb7AtNochE2pOigqw6jEP52zqcKL4eFLWb2G2Zx631YLDkfEZE5Kn7WvOCX4','2017-07-06 02:35:52','2017-07-10 17:42:10');

/*Table structure for table `hrd_vacancy_category` */

DROP TABLE IF EXISTS `hrd_vacancy_category`;

CREATE TABLE `hrd_vacancy_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `name_alias` varchar(200) NOT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `order` int(3) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_vacancy_category` */

insert  into `hrd_vacancy_category`(`id`,`name`,`name_alias`,`thumbnail`,`order`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (2,'Human Capital','HRD','100x100.jpg',2,1,'2017-07-05 09:09:20','2017-07-11 02:17:13',6,10),(3,'Mobile Developer','IT','SJ9xV.png',3,1,'2017-07-06 02:14:12','2017-07-06 02:14:12',6,NULL);

/*Table structure for table `hrd_vacancy_post` */

DROP TABLE IF EXISTS `hrd_vacancy_post`;

CREATE TABLE `hrd_vacancy_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` text,
  `responsibilities` varchar(150) DEFAULT NULL,
  `requirements` text,
  `active` tinyint(1) DEFAULT NULL,
  `order` int(3) DEFAULT NULL,
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_description` varchar(200) DEFAULT NULL,
  `meta_keywords` text,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `hrd_company_post_ibfk_2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_vacancy_post` */

insert  into `hrd_vacancy_post`(`id`,`category_id`,`title`,`description`,`responsibilities`,`requirements`,`active`,`order`,`meta_title`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (4,2,'Lowker HRD','hrd','hrd','hrd',1,5,'hrd','hrd','hrd','2017-07-05 09:09:55','2017-07-06 10:35:16',6,6),(5,3,'Mobile Developer','MobDev','Android studio','Android studio',1,3,'IT','Mobile Developer','Mobile Developer','2017-07-06 02:19:24','2017-07-06 02:19:24',6,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
