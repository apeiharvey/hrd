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

/*Table structure for table `hrd_applicant` */

DROP TABLE IF EXISTS `hrd_applicant`;

CREATE TABLE `hrd_applicant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `url` text,
  `pengalaman` text NOT NULL,
  `id_vacancy_post` int(11) DEFAULT NULL,
  `resume` varchar(250) NOT NULL,
  `status_id` int(11) DEFAULT '1',
  `read_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_applicant_vacancy` (`id_vacancy_post`),
  CONSTRAINT `id_applicant_vacancy` FOREIGN KEY (`id_vacancy_post`) REFERENCES `hrd_vacancy_post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_applicant` */

insert  into `hrd_applicant`(`id`,`firstname`,`lastname`,`email`,`phone`,`url`,`pengalaman`,`id_vacancy_post`,`resume`,`status_id`,`read_by`,`created_at`,`updated_at`) values (1,'Johanes','Harvei','harvei@gmail.com','081212554','youtube.com/asdasdadadadadadad','test123',19,'asd.pdf',2,10,'0000-00-00 00:00:00','2017-07-13 01:45:19'),(2,'Tommy','Fernandez','tommy@gmail.com','081212121','youtube.com/tommyfernandezquiko','saya bekerja di ....\r\ndengan bidang...\r\nselama....\r\nalasan saya keluar...',19,'asd.pdf',1,6,'0000-00-00 00:00:00','2017-07-13 08:23:34'),(3,'Lebron','James','lebronjames@asd.com','054512413','youtube.com','saya lelah menjadi pemain basket',11,'asd.pdf',1,NULL,'0000-00-00 00:00:00',NULL),(4,'Louis','Ands','louis@louis.com','458451200','facebook.com','Saya menginginkan pekerjaan yang tetap dan lebih baik',12,'asd.pdf',1,NULL,'0000-00-00 00:00:00',NULL),(5,'Test','123','test@123.com','447874521','twitter.com','Hanya test',18,'',1,NULL,'0000-00-00 00:00:00',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_blog_category` */

insert  into `hrd_blog_category`(`id`,`name`,`name_alias`,`order`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (8,'News','News',1,1,'2017-07-10 04:03:27','2017-07-13 15:38:27',6,10),(18,'Blog','blog',2,1,'2017-07-14 08:55:52','2017-07-14 08:55:52',6,NULL);

/*Table structure for table `hrd_blog_post` */

DROP TABLE IF EXISTS `hrd_blog_post`;

CREATE TABLE `hrd_blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `title_alias` varchar(200) DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_blog_post` (`category_id`),
  CONSTRAINT `id_blog_post` FOREIGN KEY (`category_id`) REFERENCES `hrd_blog_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_blog_post` */

insert  into `hrd_blog_post`(`id`,`category_id`,`title`,`title_alias`,`content`,`thumbnail`,`view`,`active`,`order`,`meta_title`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (11,8,'Ibu Kota di Palangkaraya Masih Isu, Jangan Jual Tanah Dulu','ibu-kota-di-palangkaraya-masih-isu-jangan-jual-tanah-dulu','<p>Liputan6.com, Palangka Raya - Pemerintah tengah menggodok sejumlah kajian dan pertimbangan terkait dengan rencana pemindahan ibu kota dari Jakarta. Beberapa kota di Indonesia masuk daftar sebagai calon ibu kota. Salah satunya Palangkaraya di Kalimantan Tengah (Kalteng). Menguatnya isu Palangkaraya sebagai salah satu kandidat ibu kota negara ternyata membuat para spekulan dan pemodal di Kalteng bergerak untuk menangguk untung dari bisnis jual beli tanah di tanah Dayak ini. &nbsp;&nbsp;</p>\r\n<p>Akibatnya, saat ini harga tanah di Palangkaraya dan sekitarnya mulai melonjak tajam. Kondisi ini tentu sangat mengkhawatirkan, mengingat masyarakat nanti akan tergiur dan buru-buru menjual tanah.</p>','WzrFf.jpg',66,1,1,'Ibu Kota di Palangkaraya Masih Isu','ibu - ibu berbicara','Isu','2017-07-07 02:56:20','2017-07-14 09:35:30',6,6),(12,8,'8 Negara Ini Pernah Pindahkan Ibu Kota','8-negara-ini-pernah-pindahkan-ibu-kota','<p>Liputan6.com, Jakarta - Pada awal September 2013, Presiden Susilo Bambang Yudhoyono (SBY) berkunjung ke Kazakhstan. Saat berada di negara itu, SBY mengungkapkan kekagumannya pada Astana, ibu kota Kazakhstan. Dia menilai, negara itu sukses memindahkan ibu kota negaranya dari Almaty ke Astana.</p>\r\n<p>Atas dasar itu pula, SBY kemudian punya keinginan untuk memindahkan ibu kota dari Jakarta ke daerah lain. Bahkan, SBY kemudian membentuk tim kecil guna mengkaji rencana tersebut. Kendati hasil kerja tim tersebut tak diketahui, wacana tentang pemindahan ibu kota negara itu kini kembali bergulir.</p>','aniH4.jpg',78,1,2,'Ibu kota negara pindah','ibu kota negara pindah','ibu kota negara pindah','2017-07-07 02:58:35','2017-07-14 09:36:16',6,10),(13,8,'Ridwan Kamil: Perubahan Itu Harus Dijemput, Bukan Ditunggu','ridwan-kamil-perubahan-itu-harus-dijemput-bukan-ditunggu','<p>Liputan6.com, Jakarta - Wali Kota Bandung Ridwan Kamil mengakui Indonesia mengalami banyak kemajuan, meski di satu sisi perlu diakui Indonesia masih mengalami banyak permasalahan.</p>\r\n<p>Hal itu dikatakan wali kota yang akrab disapa Kang Emil itu saat menjadi pembicara dalam Supermentor 14 \'Abad 21 Sebagai Zaman Kecermelangan Indonesia\' di Djakarta Theater, Jakarta Pusat.</p>','DrtOh.jpg',42,1,3,'Ridwan kamil berbicara','kata - kata ridwan kamil','Ridwan kamil berbicara','2017-07-07 03:01:56','2017-07-13 06:22:11',6,10),(15,8,'Menyulap Kulit Kerang Menjadi Perhiasan Cantik','menyulap-kulit-kerang-menjadi-perhiasan-cantik','<p>Liputan6.com, Jakarta Tak pernah terpikirkan bagi mantan Dosen Institut Kesenian Jakarta (IKJ) Efdalius Ruswandi menjadi pengusaha kulit kerang. Dia berhasil menyulap limbah kulit berang yang tak digunakan tersebut menjadi perhiasan, asesoris dan souvenir yang kini telah diekspor ke beberapa negara seperti Dubai, Malaysia, Singapura, dan Belanda.</p>\r\n<p>Pria kelahiran Padang, Sumatera Barat, 58 tahun silam ini mulanya hanya seorang pekerja di perusahaan yang bergerak di bidang mutiara usai lepas dari pekerjaan sebagai dosen. Bosan menjadi pekerja, akhirnya dia memutuskan untuk mendirikan usaha kerajinan kulit kerang pada tahun 2000 dengan modal sebesar Rp20 juta dengan pekerja tetap sebanyak dua orang.</p>','EfyC6.jpg',20,1,4,'Sulap kerang','Efdalius Ruswandi juaran sulap ke 2','sulap kerang','2017-07-07 03:05:43','2017-07-12 17:26:20',6,10),(27,18,'Agar Anda Tetap Sehat Selama Liburan','agar-anda-tetap-sehat-selama-liburan','<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\"><strong>Agar Anda Tetap Sehat Selama Liburan</strong></span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">Libur panjang akhir tahun sudah di depan mata. Waktunya bersantai di rumah atau mencari suasana baru di luar kota. Sebuah survei lama menyebut, mereka yang bisa memanfaatkan liburan dengan baik akan lebih produktif saat tiba waktunya bekerja. Sebab, liburan membuat relaks dan menurunkan stres. Tubuh pun lebih sehat. Tapi di sisi lain, liburan juga bisa membuat malas bahkan sakit. Jika itu yang terjadi, jangan salahkan libur panjang. Anda harus mampu mengelola waktu libur sehingga tak terlalu melelahkan atau</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">justru melenakan. Jangan sampai, usai libur Anda justru menemui dokter.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\"><em><strong>Jaga makanan</strong></em></span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\">&ldquo;<span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\"><em>You are what you eat&rdquo; </em></span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">Sakit yang paling sering terjadi saat dan setelah liburan adalah</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">gangguan pencernaan. Jika bukan maag yang kambuh, maka diare. Ari menerangkan, itu karena lazimnya orang tidak peduli soal konsumsi makanan dan minuman selama liburan. Apalagi, Natal dan tahun baru waktunya berkunjung ke rumah saudara dan berpesta. Anda harus memperhatikan kebersihan makanan</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">dan kualitasnya. Selain yang tidak higienis, penyebab diare biasanya makanan pedas atau seafood yang tidak disimpan dalam kondisi beku. Selain itu, makanan berlemak, kafein, dan cokelat yang dikonsumsi berlebihan juga bisa menyebabkan refluks, yakni balik arahnya isi lambung ke kerongkongan atau baliknya empedu dari usus dua belas jari ke lambung. Anda juga sebaiknya membatasi konsumsi manis dan asin.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\"><em><strong>Konsumsi air putih</strong></em></span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">Jangan mentang-mentang banyak makanan lezat tersaji selama liburan, lantas Anda terus-terusan mengunyah dan melupakan kewajiban mengonsumsi air putih delapan sampai 10 gelas per hari. Air sangat penting untuk tubuh, agar Anda terhindar dari penyakit seperti ginjal. Kekurangan cairan tubuh hanya dua persen saja, sudah menyebabkan Anda kurang konsentrasi dan mudah mengantuk. Lebih tinggi, kekurangan</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">sekitar lima persen, bisa menyebabkan sakit kepala. Kekurangan cairan di atas 10 persen jauh lebih</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">bahaya lagi. Lingkungan yang dingin, jika Anda berlibur ke gunung atau terus berada dalam ruangan berpenyejuk udara, bukan berarti tidak membuat dehidrasi. Rasa haus memang jarang muncul dalam kondisi itu, tetapi Anda tetap membutuhkan minimal dua liter air putih setiap hari.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\"><em><strong>Tetap olahraga</strong></em></span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">Liburan memang waktu untuk bersantai dan malas-malasan, mumpung tidak terganggu beban pekerjaan. Tetapi, jangan lupa untuk tetap berolahraga. Apalagi jika Anda getol makan makanan manis, berlemak, dan berkolesterol tinggi saat liburan. Olahraga wajib hukumnya. Itu yang biasanya meningkatkan berat badan</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">selama liburan. Kelebihan berat badan berbahaya bagi kesehatan. Jika terus makan sambil duduk diam</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">menonton televisi, membaca, atau bermain <em>game online</em>, bisa-bisa Anda obesitas.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">Disarankan tetap berolahraga, apa pun bentuknya. Yang penting Anda melakukan aktivitas fisik. &ldquo;Minimal</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">jalan kaki selama minimal 30 menit tiap hari, agar tetap bugar dan sehat,&rdquo; ia menyarankan dalam rilisnya.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\"><em><strong>Antisipasi cuaca</strong></em></span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Segoe UI,sans-serif;\"><span style=\"font-size: large;\">Sesuaikan busana yang Anda bawa untuk berlibur, dengan cuaca atau kondisi setempat. Perubahan cuacana yang ekstrem juga bisa menyebabkan Anda jatuh sakit. Minimal flu, bahkan bisa sampai demam dan penyakit mengganggu lainnya. Jangan sampai, waktunya bekerja Anda malah izin sakit. &ldquo;Selama liburan kita harus mengantisipasi cuaca yang tidak bersahabat. Baju dingin atau sweater harus tetap dibawa jika berlibur, untuk mengantisipasi cuaca dingin yang terjadi tiba-tiba setelah cuaca panas. Anda juga harus menyiapkan obat-obatan pribadi yang diperlukan selama liburan. Jangan mentang-mentang liburan, Anda lantas melupakan obat yang wajib dikonsumsi atau menjaga makanan sehat untuk menjaga stamina tubuh.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\">&nbsp;</p>\r\n<p>&nbsp;</p>','a5xeO.jpeg',3,1,5,'sehat selama liburan','cara agar tetap sehat selama liburan','sehat','2017-07-14 09:03:11','2017-07-14 09:45:52',6,6),(28,8,'Ace Selenggarakan Health & Gym Exhibition Pameran Alat Gym Untuk Rumah','ace-selenggarakan-health--gym-exhibition-pameran-alat-gym-untuk-rumah','<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Sebagai pusat kebutuhan perlengkapan rumah tangga dan gaya hidup, ACE untuk pertama kalinya menyelenggarakan HEALTH &amp; GYM EXHIBITION, pameran alat gym untuk rumah terlengkap di East Atrium Living World Alam Sutera tanggal 2-7 Mei 2017. Helen Widjaja, Merchandising General Manager PT ACE Hardware Indonesia, Tbk menjelaskan &ldquo;Saat ini sudah banyak masyarakat yang sadar akan pentingnya kesehatan dan mulai menerapkan pola gaya hidup sehat dalam keseharian, salah satunya dengan melakukan olah raga. Namun tidak sedikit masyarakat yang memiliki hambatan untuk berolahraga di gym atau fitness center dengan alasan keterbatasan waktu, jarak antara rumah dan lokasi fitness center, hingga kurangnya privacy jika berolahraga di tempat umum. </span></span><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Untuk itu, ACE mengadakan HEALTH &amp; GYM EXHIBITION yang menghadirkan beragam alat gym sebagai solusi untuk berolahraga di rumah dengan optimal namun tetap nyaman&rdquo;. Pameran ini menyediakan bermacam produk gym dengan merek terkenal asal Amerika seperti </span></span><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">BOWFLEX, SCHWINN, NAUTILUS, KINETIC dan BERWYN dengan harga yang kompetitif. Produk tersebut antaralain sepeda statis dan treadmill untuk kardio yaitu olah raga yang meningkatkan denyut jantung, koleksi multigym yaitu alat yang bisa melakukan beberapa gerakan untuk pembentukan tubuh, serta koleksi alat olahraga lainnya seperti perlengkapan thai boxing, ring basket hingga tenis meja. Seluruh produk yang dihadirkan sangat sesuai untuk digunakan di rumah karena memiliki desain yang ringkas sehingga tidak mengonsumsi banyak lahan, mudah disimpan dan dipindahkan, serta menggunakan daya listrik yang </span></span><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">rendah. </span></span></p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\" align=\"LEFT\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Pada kesempatan ini ACE juga memperkenalkan secara khusus dua jenis produk gym dengan keunggulan yang lebih, yaitu MAX TRAINER M3 merek BOWFLEX yaitu alat gym yang menggabungkan antara fungsi treadmill (latihan untuk kaki) dan eliptical (latihan untuk tangan) sehingga dapat membakar kalori 2,5 kali lebih besar hanya dalam dalam waktu 14 menit. Alat ini memaksimalkan manfaat kardio untuk memperbaiki kerja jantung, daya tahan tubuh dan stamina. Selanjutnya adalah BODY LIFT MULTI GYM merek BERWYN yang sangat sesuai untuk proses pembentukan tubuh, karena dengan alat ini kita dapat melakukan beberapa gerakan untuk membentuk pundak, lengan, dada, punggung, perut dan kaki. Kelebihan lainnya adalah alat ini tidak menggunakan plat pemberat, melainkan proporsi yang dapat diatur mulai dari 10% hingga 150% dari berat tubuh, sehingga selain efektif dan aman saat digunakan, alat ini juga ringan sehingga mudah untuk dipindahkan.</span></span></p>\r\n<p>&nbsp;</p>','7wd7Q.jpeg',3,1,5,'Ace Selenggarakan Health & Gym Exhibition Pameran Alat Gym Untuk Rumah','Ace Selenggarakan Health & Gym Exhibition Pameran Alat Gym Untuk Rumah','gym,health,sehat,pameran,exhibition','2017-07-14 09:15:05','2017-07-14 09:37:25',6,NULL),(29,8,'Toys Kingdom Luncurkan Maskot TIGGI Si Anak Harimau Sumatera','toys-kingdom-luncurkan-maskot-tiggi-si-anak-harimau-sumatera','<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Toys Kingdom secara resmi memperkenalkan maskot perdananya yang diberi nama TIGGI pada hari Jumat 24 Maret 2017. Peluncuran ini dilakukan dalam acara Toys Kingdom Smile Festival yang berlangsung di The Garden Living World Alam Sutera.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">TIGGI merupakan perwujudan dari anak harimau Sumatera yang hanya ada di Indonesia dengan karakter yang kuat yaitu berani berpetualang, selalu ingin tahu, selalu gembira, suka mengusili temannya tapi baik hati, selalu membuat teman-temannya tersenyum, dan hidup dengan kawanan yang diharapkan mampu mencerminkan kehidupan sosial yang baik dan juga pemimpin yang bertanggungjawab serta pintar. </span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Respon pelanggan luar biasa, dan program ini sangat baik dilakukan sebagai inspirasi kepada anak-anak </span></span> <span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">untuk berbagi sejak usia dini.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; line-height: 150%;\">&nbsp;</p>','C80RR.jpeg',2,1,7,'Toys Kingdom Luncurkan Maskot TIGGI Si Anak Harimau Sumatera','Toys Kingdom Luncurkan Maskot TIGGI Si Anak Harimau Sumatera','toys,maskot,harimau,toys kingdom','2017-07-14 09:17:52','2017-07-14 09:36:12',6,NULL),(30,8,'Apakah Vape mengandung nikotin seperti rokok?','apakah-vape-mengandung-nikotin-seperti-rokok','<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\"><strong>Apakah Vape mengandung nikotin seperti rokok?</strong></span></span></p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\">&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Menghisap rokok elektrik atau kerap disebut vape saat ini menjadi tren di kalangan masyarakat luas. (Thinkstock) Sebagian besar orang menganggap vape lebih baik dari pada rokok karena tak mengandung nikotin, sehingga memiliki risiko kesehatan yang lebih minim. Benarkah demikian? Simak penjelasan seputar rokok elektrik berikut ini. Vape tidak bebas nikotin. Sejatinya, vape memang bukan menghasilkan asap, melainkan uap air. Cairan vape (e-liquid) dipanaskan oleh elemen pemanas dalam vape kemudian menghasilkan uap air yang Anda hisap. Meski tidak menghasilkan asap, bukan berarti vape tak mengandung nikotin.</span></span></p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Vape atau rokok elektrik tetap mengandung nikotin dan zat kimia lain yang berbahaya. Perlu Anda ketahui, komponen utama dari vape adalah cairan yang berada dalam tabung. Cairan vape terbuat dari nikotin yang diekstrak dari tembakau, kemudian dicampur dengan bahan dasar, seperti propilen glikol, perasa, pewarna dan bahan kimia lainnya. Zat perasa yang terdapat dalam cairan vape juga mengandung karsinogen dan bahan kimia beracun, seperti formaldehida dan asetaldehida. Selain itu, mekanisme penguapan cairan vape juga menyebabkan munculnya logam beracun dalam ukuran nanopartikel.</span></span></p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Pengujian yang dilakukan oleh Food and Drug Administration (FDA)pada tahun 2009 menemukan bahwa cartridge yang berlabel bebas nikotin ternyata mengandung nikotin. Hampir semua rokok elektrik mengandung nikotin. Bahkan beberapa produk rokok elektrik yang diklaim bebas nikotin ternyata juga mengandung nikotin. Selain itu, penelitian lain yang dilakukan tahun 2014 menemukan bahwa jumlah nikotin yang tercantum dalam kemasan cairan isi ulang vape beberapa berbeda dengan jumlah nikotin yang terkandung di dalamnya.</span></span></p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Jadi, hati-hati bagi Anda yang suka mengisap rokok elektrik atau bagi Anda yang baru mau mencobanya. Jangan </span></span><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">terlalu percaya dengan label kemasan yang mengklaim bebas nikotin. Ingatlah, semakin banyak kandungan nikotin dalam cairan rokok elektrik, semakin besar pula risiko Anda untuk mengalami kecanduan.</span></span></p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\">&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\"><strong>Kadar nikotin dalam cairan vape</strong></span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Biasanya kadar nikotin dalam cairan rokok elektrik tertera dalam satuan mg/ml atau miligram per milimeter. </span></span></p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Misalnya, dalam satu kemasan cairan rokok elektrik tertera keterangan nikotin sebesar 12 mg, artinya dalam produk tersebut mengandung 12 mg nikotin di setiap mililiter cairan. Jadi, jika cairan rokok elektrik berjumlah 30 ml, maka kandungan nikotinnya adalah 360 mg (30 x 12).Ada juga yang memberi keterangan kadar nikotin dalam persen (%). Ini sebenarnya sama saja dengan yang memberi keterangan dalam miligram (mg). Misalnya, jika dalam kemasan tertera kadar nikotin sebesar 2,4%, itu sama saja dengan kadar nikotin 24 gram. Hanya saja cara membacanya adalah setiap tetes cairan rokok elektrik mengandung 2,4% nikotin. Sekarang Anda sudah tahu bagaimana cara membacanya. Jadi, jangan salah mengartikan kadar nikotin dalam satu botol cairan rokok elektrik. Mungkin Anda menganggap angkanya kecil, tapi jangan lupa dikalikan per mililiter cairan. </span></span></p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Jika dijumlahkan angkanya menjadi besar bukan?</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\"><strong>Bahaya nikotin</strong></span></span></p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">Selain dapat menyebabkan kecanduan, nikotin juga dapat menyebabkan berbagai masalah kesehatan. Pada ibu hamil, paparan nikotin selama kehamilan dapat membahayakan kesehatan janin dalam kandungan. Hal ini dapat berdampak dalam jangka waktu lama bagi fungsi otak dan paru-paru bayi yang sedang berkembang. Selain itu, paparan nikotin juga dapat menyebabkan bayi mempunyai berat badan lahir rendah (BBLR), kelahiran prematur, bayi lahir mati (stillbirth), dan sindrom kematian bayi mendadak (SIDS). Remaja muda yang sudah menggunakan rokok elektrik dapat mengalami gangguan kognitif dan perilaku, termasuk berdampak pada ingatan dan perhatian. Pada anak dan remaja, paparan nikotin dapat berdampak negatif terhadap perkembangan otak. Efek nikotin pada otak manusia dapat berdampak jangka panjang.Anak atau orang dewasa yang menelan, menghirup, atau menyerap cairan rokok elektrik melalui kulit atau matanya dapat mengalami keracunan. Mengkonsumsi nikotin dalam dosis tinggi juga dapat menyebabkan keracunan. Hal ini ditandai dengan gejala mual, muntah, kejang, dan depresi pernapasan pada kasus keracunan nikotin yang parah. Bahkan cairan nikotin yang tertelan dapat menyebabkan kematian, terutama pada anak-anak.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm;\" align=\"JUSTIFY\"><span style=\"font-family: Calibri,sans-serif;\"><span style=\"font-size: small;\">(Sumber: Arinda Veratamala) </span></span></p>','WFQYo.jpeg',0,1,8,'Apakah Vape mengandung nikotin seperti rokok?','Apakah Vape mengandung nikotin seperti rokok?','Vape,Rokok,Nikotin','2017-07-14 09:20:12','2017-07-14 09:43:46',6,6);

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

insert  into `hrd_company_category`(`id`,`name`,`name_alias`,`thumbnail`,`order`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (8,'E-Commerce','E-commerce','NQPFx.png',3,1,'2017-07-07 02:23:39','2017-07-13 08:45:49',6,6),(9,'Service and Property','S&P','SqqA1.png',1,1,'2017-07-07 02:24:02','2017-07-13 13:20:26',6,6),(10,'Food and Beverages','F&B','SZ4tM.png',2,1,'2017-07-07 02:25:20','2017-07-13 13:20:26',6,6),(11,'Retail','Retail','WJaZV.png',4,1,'2017-07-07 02:26:33','2017-07-13 13:20:13',6,6),(12,'Manufacturing','Manufacturing','H6klY.png',5,1,'2017-07-07 02:27:46','2017-07-13 13:20:13',6,6),(15,'Industrial','Industrial','HPla4.png',6,1,'2017-07-11 03:06:53','2017-07-13 13:20:13',10,6);

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
  KEY `id` (`id`),
  KEY `id_company_post` (`category_id`),
  CONSTRAINT `id_company_post` FOREIGN KEY (`category_id`) REFERENCES `hrd_company_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_company_post` */

insert  into `hrd_company_post`(`id`,`category_id`,`title`,`thumbnail`,`url`,`active`,`order`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (9,8,'Rupa-Rupa','2MA3V.png','ruparupa.com',1,1,'0000-00-00 00:00:00','2017-07-11 03:24:03',10,10),(10,8,'Klik MRO Industrial Supply','BAj8C.png','klikmro.com',1,2,'2017-07-11 03:14:14','2017-07-11 03:14:14',10,NULL),(11,9,'Living World','ShQZF.png','living-world',1,3,'2017-07-11 03:15:18','2017-07-11 03:15:18',10,NULL),(12,9,'Living Plaza','jq5kO.png','living-plaza',1,4,'2017-07-11 03:15:42','2017-07-11 03:15:42',10,NULL),(13,9,'PT. Multi Rentalindo','CKoGL.png','multi-rentalindo',1,5,'2017-07-11 03:16:10','2017-07-11 03:16:10',10,NULL),(14,9,'Pet Kingdom','jxWZP.png','pet-kingdom',1,6,'2017-07-11 03:16:31','2017-07-13 13:16:23',10,NULL),(15,10,'Chatime','HWfx8.png','chatime',1,7,'2017-07-11 03:17:01','2017-07-13 13:16:23',10,NULL),(16,10,'Cupbop Korean BBQ','FN1A5.png','cupbop',1,8,'2017-07-11 03:17:31','2017-07-13 13:16:23',10,NULL),(17,10,'Kepiting Cak Gundul 1992','fp8Qj.png','kepiting-cak-gundul',1,9,'2017-07-11 03:18:02','2017-07-13 13:16:23',10,NULL),(19,11,'Ace Hardware','r2Ukv.png','ace-hardware',1,10,'2017-07-11 03:18:49','2017-07-13 13:16:23',10,NULL),(20,11,'Bike Colony','S5wWw.png','bike-colony',1,11,'2017-07-11 03:19:09','2017-07-13 13:16:23',10,NULL),(21,11,'Dr. Kong','LeavM.png','dr-kong',1,12,'2017-07-11 03:19:38','2017-07-13 13:16:23',10,NULL),(22,11,'Informa','P2SnT.png','informa',1,13,'2017-07-11 03:20:00','2017-07-13 13:16:23',10,NULL),(23,11,'Pendopo','IJzQj.png','pendopo',1,14,'2017-07-11 03:20:19','2017-07-13 13:16:23',10,NULL),(24,11,'Toys Kingdom','7uqZh.png','toys-kingdom',1,15,'2017-07-11 03:20:40','2017-07-13 13:16:23',10,NULL),(25,12,'Golden Dacron','rm3kG.png','golden-dacron',1,16,'2017-07-11 03:21:23','2017-07-13 13:16:23',10,NULL),(26,15,'Kaeser','5A6PR.png','kaeser',1,17,'2017-07-11 03:21:56','2017-07-13 13:16:23',10,NULL),(27,15,'Kawan Lama','TIjcY.png','kawan-lama',1,18,'2017-07-11 03:22:13','2017-07-13 13:16:23',10,NULL),(28,15,'Kawan Lama Internusa','Oof1S.png','kawan-lama-internusa',1,19,'2017-07-11 03:22:36','2017-07-13 13:16:23',10,NULL),(29,15,'Krisbow','rIPxb.png','krisbow',1,20,'2017-07-11 03:22:52','2017-07-13 13:16:23',10,NULL),(30,15,'PT. Miller','nLddC.png','miller',1,21,'2017-07-11 03:23:15','2017-07-13 13:16:30',10,10),(31,15,'Sensorindo','uNJmi.png','sensorindo',1,22,'2017-07-11 03:23:31','2017-07-13 13:16:30',10,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_company_value` */

insert  into `hrd_company_value`(`id`,`name`,`description`,`content`,`thumbnail`,`active`,`order`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (8,'Our People','ELITE','<div><b>E</b>xcellence\r</div><div><b>L</b>eadership\r</div><div><b>I</b>ntegrity\r</div><div><b>T</b>eamwork\r</div><div><b>E</b>nthusiasm</div>','J8YNk.gif',1,4,'2017-07-05 09:08:31','2017-07-14 03:06:19',6,6),(9,'Our Place','COSY','<div><b>C</b>lean\r</div><div><b>O</b>rganized\r</div><div><b>S</b>afe\r</div><div><b>Y</b>ours</div>','lN6bI.gif',1,3,'2017-07-06 02:10:18','2017-07-14 03:31:10',6,6),(13,'Our Service','HELPFUL','<div><b>H</b>ello\r</div><div><b>E</b>nergetic\r</div><div><b>L</b>istening\r</div><div><b>P</b>olite\r</div><div><b>F</b>riendly\r</div><div><b>U</b>nderstanding\r</div><div><b>L</b>ending Hand</div>','PH5xk.png',1,2,'2017-07-11 01:46:49','2017-07-14 03:31:43',6,6),(14,'Our Product','QSV','<div><b>Q</b>uality Professional\r</div><div><b>S</b>election Great\r</div><div><b>V</b>alue Exceptional</div>','1msAO.gif',1,1,'2017-07-11 01:49:11','2017-07-14 03:33:44',6,6),(15,'Way Of Works','SBF','<div><b>S</b>marter\r</div><div><b>B</b>etter\r</div><div><b>F</b>aster</div>','9qOSt.gif',1,5,'2017-07-11 01:50:02','2017-07-14 03:34:15',6,6);

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

insert  into `hrd_contents`(`id`,`name`,`value`,`created_at`,`updated_at`) values (1,'about_us','<p style=\"margin-top: 0.05cm; margin-bottom: 0.05cm; line-height: 150%;\">&nbsp;</p>\r\n<p style=\"margin-top: 0.05cm; margin-bottom: 0.05cm; line-height: 150%;\"><a name=\"_GoBack\"></a> <span style=\"font-family: Times New Roman,serif;\"><span style=\"font-size: small;\">Kawan Lama Group telah berdiri sejak tahun 1955 dan sampai saat ini sudah memiliki beberapa bidang usaha yang bergerak dalam sektor Retail, Industrial, Food and Beverage, Service, Properti dan E-commerce. Selama lebih dari setengah abad, Kawan Lama terus tumbuh dan berkembang hingga menaungi lebih dari 25.000 karyawan.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-top: 0.05cm; margin-bottom: 0.05cm; line-height: 150%;\"><span style=\"font-family: Times New Roman,serif;\"><span style=\"font-size: small;\">Visi Kawan Lama adalah menjadi perusahaan WORLD CLASS dalam komersial dan peralatan industri. Sementara misinya menjadi mitra bagi para pelanggan dan rekan bisnis dalam menyediakan peralatan dan mesin profesional dengan keunggulan layanan yang luar biasa. Tenaga kerja di Kawan Lama mengusung nilai ELITE yakni selalu unggul dalam memberikan pelayanan terbaik kepada pelanggan. </span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-top: 0.05cm; margin-bottom: 0.05cm; line-height: 150%;\"><span style=\"font-family: Times New Roman,serif;\"><span style=\"font-size: medium;\"><span style=\"font-size: small;\">Kawan Lama Group juga berpartisipasi aktif dalam membangun bangsa melalui Corporate Social Responsibility. Beberapa kegiatan CSR yang pernah terlaksana antara lain kepedulian terhadap bencana alam, program membersihkan Borobudur dan Prambanan, kompetisi metrologi nasional untuk siswa dan masih banyak lagi. </span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-top: 0.05cm; margin-bottom: 0.05cm; line-height: 150%;\"><span style=\"font-family: Cambria,serif;\"><span style=\"font-size: small;\">Visi Kawan Lama adalah menjadi perusahaan WORLD CLASS dalam komersial dan peralatan industri. Sementara misinya menjadi mitra bagi para pelanggan dan rekan bisnis dalam menyediakan peralatan dan mesin profesional dengan keunggulan layanan yang luar biasa. Tenaga kerja di Kawan Lama mengusung nilai ELITE yakni selalu unggul dalam memberikan pelayanan terbaik kepada pelanggan. </span></span></p>\r\n<p>&nbsp;</p>\r\n<p style=\"margin-top: 0.05cm; margin-bottom: 0.05cm; line-height: 150%;\"><span style=\"font-family: Cambria,serif;\"><span style=\"font-size: small;\">Kawan Lama Group juga berpartisipasi aktif dalam membangun bangsa melalui Corporate Social Responsibility. Beberapa kegiatan CSR yang pernah terlaksana antara lain kepedulian terhadap bencana alam, program membersihkan Borobudur dan Prambanan, kompetisi metrologi nasional untuk siswa dan masih banyak lagi.</span></span></p>\r\n<p>&nbsp;</p>','2017-06-22 10:05:51','2017-07-14 09:33:04'),(2,'what_success','<p>&ldquo;We make a living by what we get, We make a life by what we give.&rdquo;</p>','2017-06-22 10:05:58','2017-07-14 09:31:36'),(3,'video_url','https://www.youtube.com/embed/XGSy3_Czz8k','2017-06-22 10:06:31','2017-07-06 03:11:13'),(4,'home_header','pUyar.jpg','2017-06-22 10:07:40','2017-07-10 10:59:41'),(5,'contact_us_header','b6xsQ.jpg','2017-06-22 10:07:44','2017-07-11 16:10:32'),(6,'gallery_header','aN4NE.jpg','2017-06-22 10:07:59','2017-07-11 16:11:20'),(7,'email_approve','qweqeq\r\nqewqeq\r\nqweqewq','0000-00-00 00:00:00','2017-07-04 07:10:19'),(8,'email_reject','qweqeqeq','0000-00-00 00:00:00','2017-07-04 07:10:19'),(9,'home_search_word','{\"title\":\"a\",\"description\":\"sasas\"}','0000-00-00 00:00:00','2017-07-06 10:57:21'),(10,'remove-single-home_header','n','2017-07-04 07:07:51','2017-07-04 07:07:51'),(11,'remove-single-contact_us_header','n','2017-07-04 07:07:51','2017-07-04 07:07:51'),(12,'remove-single-gallery_header','n','2017-07-04 07:07:51','2017-07-04 07:07:51'),(13,'home_search_word_title','We Are Elites','0000-00-00 00:00:00','2017-07-10 10:54:10'),(14,'home_search_word_description','Unity in Diversity','0000-00-00 00:00:00','2017-07-10 10:56:23'),(15,'what_success_author','Sir. Winston Churchil','0000-00-00 00:00:00','2017-07-11 08:40:24'),(16,'what_success_author_department',NULL,'0000-00-00 00:00:00','2017-07-14 09:31:36');

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_gallery` */

insert  into `hrd_gallery`(`id`,`title`,`thumbnail`,`active`,`order`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (3,'party','Capture3.gif',1,1,'0000-00-00 00:00:00','2017-07-13 13:09:53',NULL,NULL),(4,'jalan-jalan','3giYc.jpeg',1,2,'0000-00-00 00:00:00','2017-07-13 13:09:54',NULL,10),(5,'kegiatan kantor','Capture5.jpg',1,3,'0000-00-00 00:00:00','2017-07-13 13:09:55',NULL,NULL),(6,'keluarga besar','0jrI8.jpeg',1,4,'0000-00-00 00:00:00','2017-07-13 13:09:55',NULL,10),(37,'Sepedaan','tyTcR.jpeg',1,5,'2017-07-10 04:41:31','2017-07-13 13:09:56',6,NULL),(38,'Yoga','8ROEe.jpeg',1,6,'2017-07-10 04:49:32','2017-07-13 13:09:57',6,NULL),(41,'Cricket','Ny4aD.jpeg',1,7,'2017-07-11 09:56:33','2017-07-13 13:09:58',10,NULL),(42,'Kayak','1OmUd.jpeg',1,8,'2017-07-11 09:56:47','2017-07-13 13:09:59',10,NULL),(43,'Football','eAI0r.jpeg',1,9,'2017-07-11 09:57:14','2017-07-13 13:21:40',10,NULL),(44,'kayak','L8XTM.jpeg',1,10,'2017-07-11 09:57:33','2017-07-13 13:21:40',10,NULL);

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

insert  into `hrd_settings`(`id`,`name`,`value`,`created_at`,`updated_at`) values (1,'web_name','Kawan Lama','2017-06-21 14:39:15','2017-06-21 07:41:32'),(2,'place_name','Gedung Kawan Lama','2017-07-13 09:37:26','0000-00-00 00:00:00'),(3,'email','recruitment@kawanlamacorp.com','2017-07-14 16:35:08','2017-07-14 09:37:19'),(4,'address','Jl. Puri Kencana No. 1, Kembangan – Jakarta 11610','2017-07-14 16:35:08','2017-07-14 09:37:19'),(5,'latitude','-6.1905156','2017-07-10 09:21:58','2017-06-21 07:41:32'),(7,'remove-single-uploadHeader','n','2017-06-21 07:16:27','2017-06-21 07:16:27'),(8,'maintenance','0','2017-07-13 15:58:06','2017-07-13 09:00:17'),(9,'whitelist_ip','192.136.12.12','2017-07-13 17:32:45','2017-07-13 10:34:56'),(10,'meta_title','asd','2017-06-21 14:39:16','2017-06-21 07:41:32'),(11,'meta_keywords','adsa\r\nasd','2017-06-22 09:43:38','2017-06-22 02:45:54'),(13,'longitude','106.7435614','2017-07-10 09:22:07','2017-06-21 07:41:32'),(16,'logo_header','oRR0R22.png','2017-07-12 16:09:53','2017-07-10 04:22:20'),(17,'logo_footer','fPqz4.png','2017-07-10 11:20:08','2017-07-10 04:22:20'),(18,'meta_description','test saja','2017-06-21 07:55:48','2017-06-21 07:55:48'),(21,'remove-single-logo_header','n','2017-06-22 02:45:54','2017-06-22 02:45:54'),(22,'remove-single-logo_footer','n','2017-06-22 02:45:54','2017-06-22 02:45:54');

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

insert  into `hrd_social_media`(`id`,`name`,`thumbnail`,`url`,`order`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (1,'Facebook','P1NDf.png','https://www.facebook.com/Recruitment-Kawan-Lama-Group-848395245218798/',2,1,'0000-00-00 00:00:00','2017-07-14 09:38:18',2,6),(13,'Linked In','m6iNj.png','linked.in',3,1,'2017-07-06 02:27:48','2017-07-13 15:27:53',6,NULL),(16,'Instagram','ReBkt.png','https://www.instagram.com/jobkawanlamagroup/',4,1,'2017-07-06 08:35:15','2017-07-14 09:41:53',10,6),(17,'Youtube','xiJv9.png','youtube.com',1,1,'2017-07-06 08:37:11','2017-07-13 15:27:53',10,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_users` */

insert  into `hrd_users`(`id`,`name`,`email`,`password`,`last_login`,`remember_token`,`created_at`,`updated_at`) values (6,'admin','admin@admin.com','$2y$10$5YQgHxovM0uTBdbQlXjOauA4vsnBqZszu.pcxMC/GZjCGfP/3rOUG',NULL,'ROW5cT8iEdHHEKEocQuOgrsFP7VuekLPZPhnhlJl2p8ZIvrW6sqL9jaMPqId','2017-07-05 03:45:14','2017-07-14 12:43:11'),(10,'Harvei','harvei@gmail.com','$2y$10$hwvgmIBVUg4V1/nGyO6HQeOOm5eufi9hKtAkWHLh74/s45WZzojym',NULL,'GdXZpyJmkvkpcMMiPcbqPghgi3bRLtEVWZ476DL7eaDuTqM3Kwh90TNSFu6G','2017-07-06 02:35:52','2017-07-13 17:36:07'),(18,'Tommy','tommy@tommy.com','$2y$10$LI4FKBmHtXfNOdXSMvADaOTi2Vvcl8sxatCxIF95LdseEYBsDjJY.',NULL,NULL,'2017-07-13 09:43:48','2017-07-13 09:43:48');

/*Table structure for table `hrd_vacancy_category` */

DROP TABLE IF EXISTS `hrd_vacancy_category`;

CREATE TABLE `hrd_vacancy_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `name_alias` varchar(200) NOT NULL,
  `category_alias` varchar(200) DEFAULT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `order` int(3) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_vacancy_category` */

insert  into `hrd_vacancy_category`(`id`,`name`,`name_alias`,`category_alias`,`thumbnail`,`order`,`active`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (2,'Human Resources','HRD','human-resources','HR-04-256.png',1,1,'2017-07-05 09:09:20','2017-07-13 09:14:26',6,10),(3,'E-Commerce B2B','E-Commerce B2B','ecommerce-b2b','94086-200.png',5,1,'2017-07-06 02:14:12','2017-07-14 09:47:25',6,6),(6,'Audit','Audit','audit','579725-200.png',6,1,'2017-07-11 08:48:06','2017-07-13 08:52:42',10,NULL),(7,'Business Process Improvement','BPI','business-process-improvement','aMK3d.jpg',2,1,'2017-07-11 08:48:45','2017-07-13 08:50:28',10,NULL),(8,'Building Management','BM','building-management','image006.png',7,1,'2017-07-11 08:49:11','2017-07-14 06:03:04',10,6),(9,'Business','Business','business','parcerias2.png',3,1,'2017-07-11 08:50:02','2017-07-13 17:21:02',10,10),(10,'E-Commerce','E-Commerce','ecommerce','371351-200.png',4,1,'2017-07-11 08:50:48','2017-07-13 17:21:02',10,10);

/*Table structure for table `hrd_vacancy_post` */

DROP TABLE IF EXISTS `hrd_vacancy_post`;

CREATE TABLE `hrd_vacancy_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `post_alias` varchar(200) DEFAULT NULL,
  `description` text,
  `responsibilities` text,
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
  KEY `id_vacancy_post` (`category_id`),
  CONSTRAINT `id_vacancy_post` FOREIGN KEY (`category_id`) REFERENCES `hrd_vacancy_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `hrd_vacancy_post` */

insert  into `hrd_vacancy_post`(`id`,`category_id`,`title`,`post_alias`,`description`,`responsibilities`,`requirements`,`active`,`order`,`meta_title`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`,`created_by`,`updated_by`) values (4,2,'Human Resource Development','human-resource-development','hrd','hrd','hrd',1,2,'hrd','hrd','hrd','2017-07-05 09:09:55','2017-07-13 17:22:07',6,6),(5,10,'Mobile Developer','mobile-developer','MobDev','Android studio','Android studio',1,1,'IT','Mobile Developer','Mobile Developer','2017-07-06 02:19:24','2017-07-13 17:22:07',6,10),(9,6,'Internal/Inventory Audit','internalinventory-audit','Kawan Lama Group is the holding company of various business units in the fields of: industrial equipments, furniture, home improvement, and lifestyle; with over 20000 employees, &nbsp;we are ready to achieve the top.','Handle all process in internal audit and make a final report','\r\nBachelor Degree in any major\r\nHave experience min. 2 years as auditor/QA in Foods &amp; Beverages\r\nComputer literate, good in detail and analytical skill\r\nWilling to travel\r\n',1,3,'audit','audit','audit','2017-07-11 08:52:14','2017-07-11 08:52:14',10,NULL),(10,7,'Business Process Improvement Analyst','business-process-improvement-analyst','Kawan Lama Group is the holding company of various business units in the fields of: industrial equipments, furniture, home improvement, and lifestyle; with over 20000 employees, &nbsp;we are ready to achieve the top.','\r\nAnalyze current business process with the objective of identifying opportunities for improving efficiency and control\r\nDrafting operational SOP, handle document the to be business processes and working instruction in detail and descriptive\r\n','\r\nBachelor Degree majoring Industrial Engineering/Information Technology or equivalent\r\nUnderstanding Business Process Improvement (BPI) &amp; Standard Operational Procedure (SOP)\r\nHave experience min. 1 year in the related field\r\nComputer literate, familiar with Ms. Visio\r\n',1,4,'BPI','BPI','BPI','2017-07-11 08:54:07','2017-07-11 08:54:07',10,NULL),(11,8,'Receptionist','receptionist','&nbsp; Kawan Lama Group is the holding company of various business units in the fields of: industrial equipments, furniture, home improvement, and lifestyle; with over 20000 employees, &nbsp;we are ready to achieve the top.','Responsible for answering and routing calls Greeting visitors and handling inquiries from the public Faxing documentation Responsible for coordinating incoming and outgoing mail','Diploma or Bachelor\'s Degree in any field Excellent communication skill Excellent customer service telephone skills Good Analytical abilities',1,5,'Receptionist','Receptionist','Receptionist','2017-07-11 08:55:03','2017-07-11 09:01:40',10,10),(12,9,'Secretary','secretary','&nbsp; Kawan Lama Group is the holding company of various business units in the fields of: industrial equipments, furniture, home improvement, and lifestyle; with over 20000 employees, &nbsp;we are ready to achieve the top.','Responsible for daily secretarial support such as filling document, correspondences, minutes of meeting Preparing presentation slide or reports Manage meeting schedule, prepare meeting materials, booking rooms and facilities Maintain scheduling and event calendars Arrange and confirm appointments Responsible to all correspondence and communication with related business','Diploma / Bachelor Degree in secretary Have experience min. 3 years in the related field (as secretary / personal assistant) Fluent in English (able to speak Mandarin is an advantage) Computer literate',1,6,'Secretary','Secretary','Secretary','2017-07-11 08:56:16','2017-07-11 09:01:22',10,10),(13,10,'E-Merchandiser Officer','emerchandiser-officer','Kawan Lama Group is the holding company of various business units in the fields of: industrial equipments, furniture, home improvement, and lifestyle; with over 20000 employees, &nbsp;we are ready to achieve the top.','Handle e-commerce marketing projects and programs to augment direct sales initiatives','Bachelor Degree in Mechanical / Mechatronic / Electrical Engineering Fresh Graduates are welcome to apply',1,7,'E-Merchandise Officer','E-Merchandiser Officer','E-Merchandiser Officer','2017-07-11 08:57:06','2017-07-12 13:56:49',10,10),(14,10,'E-commerce Business Analyst','ecommerce-business-analyst','E-commerce Business Analyst','Responsible to analyze engine ranking, advertising campaign results and branding across a website Provide up to date and complete information Create website development specifications and business requirements','Bachelor Degree majoring in business management/online marketing/information technology Proficient in web analytics software and search engine rules Computer literate Experience in E-commerce business or Digital Agency',1,8,'E-commerce Business Analyst','E-commerce Business Analyst','E-commerce Business Analyst','2017-07-11 08:57:48','2017-07-11 09:00:31',10,10),(15,10,'Social Media Manager','social-media-manager','&nbsp; Kawan Lama Group is the holding company of various business units in the fields of: industrial equipments, furniture, home improvement, and lifestyle; with over 20000 employees, &nbsp;we are ready to achieve the top.','Manage website development, social media campaigns, media placements, blogger activations, digital PR campaigns, etc Develop and maintain a comprehensive social media strategy Monitor the impact of social media campaigns and generates reports that detail performance metrics for all active social media platforms','Bachelor Degree any field and have 5 years working experience in the related field Experience building and managing social media Understanding of consumer behavior, strong passion for digital marketing, online communities, social networking Experience with social media paid advertising',1,9,'Social Media Manager','Social Media Manager','Social Media Manager','2017-07-11 08:58:29','2017-07-11 09:00:48',10,10),(16,10,'UI/UX Designer','uiux-designer','UI/UX Designer','- Execute all visual design stages from concept to final hand-off to engineering- Create wireframes, storyboards, user flows, process flows and site maps to effectively communicate interaction and design ideas- Identify design problems and devise solutions','- Strong knowledge of ux design E-commerce- Strong knowledge &amp; skill in HTML5, CSS, Photoshop &amp; Sketch- Ability to use heat map &amp; A/B testing to make data driven decisions- Ability to solve problems creatively and effectively- Up to date with latest UI trends, techniques, and technologies',1,10,'UI/UX Designer','UI/UX Designer','UI/UX Designer','2017-07-11 09:00:17','2017-07-11 09:00:17',10,NULL),(17,8,'Building Coordinator - Pet Kingdom','building-coordinator--pet-kingdom','Building Coordinator - Pet Kingdom','\r\n\r\nMaintenance and monitor equipment in the building\r\n\r\n\r\nMonitoring daily operation of the building\r\n\r\n\r\nPrioritizes, fulfills maintenance requests, and solve building problems\r\n\r\n\r\nEvent management reports\r\n\r\n','\r\n\r\nExperience in general maintenance and good knowledge of building systems\r\n\r\n\r\nHave minimal 3 years experience in building management/general affair\r\n\r\n\r\nHave problem solving ability relating to building security\r\n\r\n',1,11,'Building Coordinator - Pet Kingdom','Building Coordinator - Pet Kingdom','Building Coordinator - Pet Kingdom','2017-07-11 09:39:57','2017-07-11 09:39:57',10,NULL),(18,8,'Building Maintenance – Pet Kingdom','building-maintenance--pet-kingdom','Building Maintenance &ndash; Pet Kingdom','\r\n\r\nMaintenance and solve problem relating equipments and facilities\r\n\r\n\r\nRoutine maintenance office electrical, air conditioning systems\r\n\r\n\r\nRegular maintenance of any machinery used in the building\r\n\r\n','\r\n\r\nMale, Max 35 year old\r\n\r\n\r\nHave experience as Technician (AC/Plumbing/Electrical/Civil/General)\r\n\r\n\r\nWilling to work with shift schedule\r\n\r\n',1,12,'Building Maintenance – Pet Kingdom','Building Maintenance – Pet Kingdom','Building Maintenance &ndash; Pet Kingdom','2017-07-11 09:41:55','2017-07-11 09:41:55',10,NULL),(19,3,'Internship Information Technology','internship-information-technology','Internship Information Technology','Internship Information Technology','Bachelor\'s Degree majoring Information Technology/System Engineering/Computer Science in progress (last semester) Computer literate Responsible for assisting technology team Strong technical skills including understanding of software development Have good knowledge about Website development, Mobile Application development Have ability to fix trouble shooting software and hardware Have good knowledge about SEO, E-commerce',1,13,'Internship Information Technology','Internship Information Technology','Internship Information Technology','2017-07-11 09:43:18','2017-07-11 09:44:15',10,10),(20,10,'Freelance SEO Writer','freelance-seo-writer','Freelance SEO Writer','Freelance SEO Writer','- Writing compelling content that meets prime search engine standards- Good creative expression with words- Good research skills and fast typing speed- Writing articles for various topics to catch the search engine eyes with keyword densities- Formatting the keywords into a code to be easily picked up by search engines- Conducting research for new keywords, and write copy that increases the search engine traffic',1,14,'Freelance SEO Writer','Freelance SEO Writer','Freelance SEO Writer','2017-07-11 09:43:56','2017-07-11 09:44:29',10,10),(21,10,'Industrial E-Commerce Expert','industrial-ecommerce-expert','&nbsp;\r\nKawan Lama Group is the holding company of various business units in the fields of:&nbsp;industrial equipments, furniture, home improvement, and lifestyle;&nbsp;with over 20000 employees, &nbsp;we are ready to achieve the top.','Assist in the development and implementation of E-Commerce projects for the company','\r\nBachelor Degree in Mechanical, Electrical, Mechatronic, Electronic Engineering\r\nFresh Graduates are welcome to apply\r\nHave a good knowledge of procurement process\r\nUnderstand traditional business and e-commerce B2B\r\nHave a national scale industrial experience\r\nAble to explore industrial experience\r\nFluent in English\r\n',1,15,'Industrial E-Commerce Expert','Industrial E-Commerce Expert','Industrial E-Commerce Expert','2017-07-11 09:45:15','2017-07-11 09:45:15',10,NULL),(22,2,'HR Administration','hr-administration','HR Administration','\r\n\r\nAdminister HR-related documentation\r\n\r\n\r\nEnsure the relevant HR database is up to date, accurate and complies with legislation\r\n\r\n\r\nMaintains human resources records by recording new hires, transfers, terminations, changes in job classifications, merit increases; tracking vacation, sick, and personal time.\r\n\r\n','\r\n\r\nDiploma / Bachelor Degree in any field\r\n\r\n\r\n\r\n\r\nHave experience min. 1 years in the related field is required for this position.\r\n\r\n\r\nFresh Graduates are welcome to apply\r\n\r\n\r\nComputer literate and good in detail\r\n\r\n',1,16,'HR Administration','HR Administration','HR Administration','2017-07-11 09:46:26','2017-07-11 09:46:26',10,NULL),(23,3,'Communication & Brand Coordinator','communication--brand-coordinator','<p>Communication &amp; Brand Coordinator</p>','<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Responsibilities :</span></p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Strategically to create and build brand awareness internal to external communication and relationship</span></p>\r\n</li>\r\n<li>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Search and build communities as a part of mouth of mouth communication</span></p>\r\n</li>\r\n<li>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Coordinate with media as a apart of relation for publication</span></p>\r\n</li>\r\n<li>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Responsible to direct and indirect announcement to external</span></p>\r\n</li>\r\n<li>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Build company image strategic to explore market</span></p>\r\n</li>\r\n<li>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Maximize communication and publication budget</span></p>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>','<p>&nbsp;</p>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Requirements :</span></p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Bachelor Degree in any major</span></p>\r\n</li>\r\n<li>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Have 4 years experience as Marketing Communication / Brand Communication</span></p>\r\n</li>\r\n<li>\r\n<p style=\"margin-bottom: 0cm; font-weight: normal;\"><span style=\"font-family: Segoe UI,sans-serif;\">Have experience in E-commerce industry</span></p>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>',1,16,'e-commerce b2b','e-commerce b2b','<p>e-commerce b2b, communication</p>','2017-07-14 09:49:25','2017-07-14 09:49:25',6,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
