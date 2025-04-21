-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 21, 2025 at 11:38 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_dinamis`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `excerpt` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`article_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `title`, `slug`, `content`, `excerpt`, `image_path`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Tempat Wisata Tersembunyi di Malang: Di Balik Destinasi Populer', 'tempat-wisata-tersembunyi-malang', 'Sementara Jatim Park dan Batu Secret Zoo menarik ribuan wisatawan ke Kabupaten Malang setiap tahunnya, Kota Malang sendiri menyimpan banyak harta karun tersembunyi yang menunggu untuk ditemukan oleh para wisatawan petualang.\n\nDalam panduan komprehensif ini, kami menjelajahi lorong-lorong menawan Kampung Warna-Warni Jodipan, di mana rumah-rumah yang dicat dengan warna-warni cerah mengubah kawasan yang dulunya terpinggirkan menjadi landmark budaya yang menceritakan kisah revitalisasi komunitas. Dulu dianggap sebagai kawasan kumuh, kini desa warna-warni ini menjadi bukti bagaimana seni dapat mengubah komunitas.\n\nTak jauh dari pusat kota terdapat Air Terjun Coban Rondo, sebuah tempat perlindungan alami di mana derasnya air menyediakan tempat peristirahatan yang damai dari kehidupan perkotaan. Hutan di sekitarnya menawarkan kesempatan hiking yang sangat baik bagi para pecinta alam yang ingin mengalami keanekaragaman hayati Jawa Timur.\n\nArsitektur kolonial Malang layak mendapat perhatian khusus, dengan keindahan Ijen Boulevard yang memamerkan desain bergaya Belanda. Struktur-struktur bersejarah ini mencerminkan masa lalu kota yang kompleks dan evolusinya melalui berbagai periode sejarah Indonesia.\n\nBagi yang tertarik dengan wisata spiritual, Malang memiliki beberapa candi kuno yang tidak seramai candi-candi di daerah lain. Candi Singosari, yang berasal dari abad ke-13, menawarkan wawasan tentang warisan Hindu-Buddha Jawa Timur.\n\nSuasana universitas yang hidup di Malang juga menciptakan ruang budaya yang unik, dengan inisiatif yang dipimpin mahasiswa seperti perpustakaan komunitas, galeri seni, dan tempat pertunjukan menambah karakter dinamis kota ini.\n\nSeiring pariwisata berkelanjutan menjadi semakin penting, atraksi-atraksi yang kurang dikenal ini memberikan kesempatan untuk pertukaran budaya yang bermakna sambil mengurangi dampak lingkungan dari overtourism di destinasi populer.', 'Temukan atraksi tersembunyi Kota Malang yang menampilkan kekayaan warisan budaya, arsitektur kolonial, dan keindahan alamnya di luar kompleks wisata terkenal.', NULL, 'published', '2025-03-15 09:30:00', '2025-04-20 22:32:51', '2025-04-20 22:32:51'),
(2, 'Kekayaan Kuliner Malang: Perjalanan Gastronomi', 'kekayaan-kuliner-malang', 'Lanskap kuliner Malang menawarkan kanvas kaya rasa yang mencerminkan warisan budaya kota dan kelimpahan pertaniannya. Dari jajanan kaki lima hingga makanan tradisional, kota ini menyediakan pengalaman gastronomi yang layak untuk dikunjungi.\n\nProduk berbasis apel adalah salah satu ekspor kuliner Malang yang paling terkenal, berkat iklim sejuk di wilayah ini yang sempurna untuk budidaya apel. Dari jus apel segar hingga keripik apel dan kue-kue, buah ini tampil menonjol dalam makanan ringan dan makanan penutup lokal. Daerah Batu, tepat di luar kota Malang, khususnya terkenal dengan kebun apelnya.\n\nBakso Malang layak mendapat pengakuan khusus sebagai salah satu variasi sup bakso yang paling khas di Indonesia. Tidak seperti bakso standar yang ditemukan di seluruh negeri, Bakso Malang biasanya mencakup beberapa jenis bakso, mie kuning, soun, dan pangsit goreng, menciptakan hidangan yang kompleks dan memuaskan yang mewakili inovasi kuliner lokal.\n\nBagi yang memiliki selera manis, Malang menawarkan banyak makanan ringan tradisional seperti Terang Bulan, Pia, dan berbagai makanan penutup berbasis beras yang menampilkan keahlian para pembuat makanan lokal yang telah melestarikan resep-resep ini melalui generasi.\n\nBudaya kopi berkembang di Malang, dengan dataran tinggi di sekitarnya yang menghasilkan biji kopi berkualitas yang memasok banyak kafe di kota. Dari warung kopi tradisional hingga kedai kopi spesialti modern, kota ini menawarkan berbagai tempat untuk menikmati kopi yang ditanam secara lokal.\n\nAdegan kuliner juga mencerminkan sejarah multikultural Malang, dengan pengaruh dari tradisi Jawa, Madura, Tionghoa, dan Belanda menciptakan hidangan fusi yang unik untuk daerah tersebut. Pencampuran budaya ini terlihat jelas dalam hidangan seperti versi rawon Malang dan berbagai persiapan mie.\n\nPasar makanan seperti Pasar Besar dan pasar malam di seluruh kota memberikan pengalaman mendalam bagi para penjelajah kuliner, menawarkan kesempatan untuk mencicipi berbagai makanan khas dalam suasana yang autentik.', 'Jelajahi beragam rasa dari dunia kuliner Malang, dari bakso dan produk apel terkenalnya hingga makanan ringan tradisional dan inovasi kuliner yang sedang berkembang yang menjadikan kota ini surga bagi pecinta makanan.', NULL, 'published', '2025-04-02 14:45:00', '2025-04-20 22:32:51', '2025-04-20 22:32:51'),
(3, 'Inisiatif Hijau Kota Malang: Menciptakan Ruang Kota Berkelanjutan', 'inisiatif-hijau-kota-malang', 'Saat Indonesia menghadapi tantangan lingkungan yang semakin meningkat, Malang muncul sebagai pemimpin dalam keberlanjutan perkotaan melalui inisiatif hijau yang inovatif dan upaya konservasi yang dipimpin masyarakat yang mengubah lanskap kota.\n\nTaman Hutan Malabar mewakili salah satu proyek restorasi ekologi yang paling berhasil di kota ini. Dulunya area yang terdegradasi, hutan kota ini kini berfungsi sebagai penyerap karbon dan ruang rekreasi yang menunjukkan bagaimana alam dapat diintegrasikan kembali ke dalam lingkungan perkotaan. Jalur pejalan kaki dan fasilitas pendidikan di taman menjadikan pembelajaran lingkungan dapat diakses oleh penduduk dan pengunjung.\n\nProgram revitalisasi sungai Malang mengatasi masalah kritis polusi air yang memengaruhi banyak kota di Indonesia. Upaya pembersihan komunitas, sistem pengelolaan limbah yang lebih baik, dan penanaman riparian telah mulai mengembalikan kesehatan sungai-sungai kota dan mendorong kembalinya kehidupan akuatik ke perairan perkotaan.\n\nGerakan pertanian perkotaan berkembang di Malang, dengan kebun komunitas dan pertanian vertikal memberikan akses ke produk segar sambil mengurangi jejak karbon yang terkait dengan transportasi makanan. Inisiatif ini juga membantu mengatasi ketahanan pangan dan menciptakan ruang komunal di lingkungan yang sebelumnya membeton.\n\nProgram kota untuk meningkatkan ruang hijau publik telah melihat pengembangan taman kantong dan konversi lahan yang tidak digunakan menjadi taman mini. Upaya ini tidak hanya meningkatkan estetika kota tetapi juga memberikan manfaat ekologis seperti peningkatan penyerapan air hujan dan habitat satwa liar perkotaan.\n\nPendidikan lingkungan telah menjadi prioritas, dengan sekolah-sekolah di seluruh Malang menerapkan program keberlanjutan seperti pembuatan kompos, pengelolaan limbah, dan kebun sayur sekolah. Inisiatif pendidikan ini menanamkan kesadaran lingkungan pada generasi berikutnya warga Malang.\n\nKemitraan antara universitas, pemerintah kota, dan organisasi masyarakat telah memungkinkan pertukaran pengetahuan dan sumber daya yang mempercepat proyek-proyek hijau. Pendekatan kolaboratif ini memastikan bahwa inovasi lingkungan diimplementasikan secara efektif dan diadaptasi dengan kebutuhan lokal.\n\nMeskipun tantangan tetap ada, terutama terkait dengan urbanisasi dan perubahan iklim, proyek-proyek ini menunjukkan komitmen Malang terhadap masa depan yang berkelanjutan dan dapat menjadi model bagi kota-kota Indonesia lainnya yang menghadapi tantangan serupa.', 'Pelajari bagaimana Kota Malang menjadi pelopor dalam inisiatif keberlanjutan perkotaan melalui proyek-proyek hijau yang inovatif yang mengubah lanskap kota dan meningkatkan kualitas hidup penduduknya.', NULL, 'published', '2025-03-28 11:20:00', '2025-04-20 22:32:52', '2025-04-20 22:32:52'),
(4, 'Tradisi Pendidikan di Kota Malang: Dari Kolonial Hingga Kota Pendidikan', 'tradisi-pendidikan-malang', 'Malang telah lama dikenal sebagai kota pendidikan terkemuka di Indonesia, dengan sejarah panjang institusi akademik yang telah membentuk identitas kota ini selama berabad-abad. Dari sekolah kolonial Belanda hingga universitas modern yang dinamis, lanskap pendidikan Malang mencerminkan evolusi sistem pendidikan Indonesia.\n\nAwal sejarah pendidikan formal di Malang dapat ditelusuri kembali ke era kolonial, ketika pemerintah Belanda mendirikan sekolah-sekolah elit yang awalnya melayani anak-anak Eropa dan keluarga pribumi terpilih. Bangunan seperti HBS (Hogere Burger School) yang sekarang menjadi SMAN 1 Malang, memberikan bukti fisik dari era ini dan masih digunakan hingga hari ini.\n\nSelama era kemerdekaan awal, Malang melihat transformasi dan demokratisasi pendidikan, dengan institusi-institusi baru yang didirikan untuk memenuhi kebutuhan Indonesia yang merdeka. Universitas Brawijaya, salah satu universitas negeri terkemuka negara ini, didirikan pada tahun 1963 dan telah menjadi simbol kemajuan pendidikan nasional.\n\nPendidikan pesantren dan madrasah telah menjadi bagian integral dari tradisi pendidikan Malang, menciptakan sistem pendidikan paralel yang menyediakan baik pengetahuan agama maupun sekuler. Institusi-institusi seperti Universitas Islam Malang dan Universitas Islam Negeri Maulana Malik Ibrahim mewakili evolusi modern dari tradisi pendidikan Islam yang kaya ini.\n\nMalang juga terkenal dengan konsentrasi sekolah menengah kejuruan dan teknisnya, yang menyediakan lulusan dengan keterampilan praktis yang diperlukan untuk pasar kerja yang berkembang pesat. Sekolah-sekolah ini sering bekerja sama dengan industri lokal untuk menciptakan jalur langsung dari pendidikan ke pekerjaan.\n\nBudaya kehidupan mahasiswa yang semarak di kota ini menghasilkan berbagai inisiatif masyarakat dan komunitas kreatif yang memadukan pembelajaran akademis dengan keterlibatan masyarakat. Perpustakaan independen, kafe belajar, dan ruang kerja bersama yang dijalankan oleh mahasiswa dapat ditemukan di seluruh kota, menunjukkan hubungan antara institusi pendidikan formal dan aliran pengetahuan informal.\n\nSebagai kota universitas, Malang menarik mahasiswa dari seluruh Indonesia, menjadikannya tempat percampuran budaya di mana perspektif dan ide dari berbagai daerah bertemu dan bertukar. Keragaman ini memperkaya ruang intelektual kota dan berkontribusi pada karakter kosmopolitan Malang.\n\nSaat menghadapi era digital, institusi pendidikan Malang beradaptasi dengan teknologi baru dan metodologi pedagogis untuk tetap relevan dalam lanskap pendidikan global yang berkembang pesat. Inisiatif e-learning, penelitian kolaboratif internasional, dan kemitraan industri-akademik membentuk arah masa depan pendidikan di kota ini.', 'Telusuri evolusi Malang sebagai kota pendidikan terkemuka di Indonesia, dari akar kolonialnya hingga lanskap pendidikan kontemporer yang dinamis yang telah membentuk identitas kota dan berkontribusi pada pembangunan bangsa.', NULL, 'published', '2025-04-10 16:00:00', '2025-04-20 22:32:52', '2025-04-20 22:32:52'),
(5, 'Festival Budaya Malang: Merayakan Warisan dan Kreativitas', 'festival-budaya-malang', 'Malang menawarkan kalender acara budaya yang beragam sepanjang tahun, mencerminkan warisan budaya kaya dan semangat kreatif kota ini. Dari perayaan tradisional hingga festival kontemporer, acara-acara ini memberikan wawasan mendalam tentang identitas budaya Malang yang berkembang.\n\nFestival Malang Kembali menjadi sorotan kalender budaya kota, menghidupkan kembali era kolonial Malang melalui pameran foto bersejarah, tur berjalan kaki, dan pertunjukan yang menggambarkan kehidupan di masa lalu. Festival ini tidak hanya menarik wisatawan tetapi juga menghubungkan penduduk Malang dengan akar sejarah mereka.\n\nPertunjukan seni tradisional seperti wayang, tari topeng Malangan, dan ludruk secara teratur dipentaskan di tempat-tempat budaya seperti Taman Budaya Jawa Timur. Pertunjukan ini membantu melestarikan bentuk seni tradisional sambil membuka mereka kepada generasi baru penggemar.\n\nKerajinan lokal dirayakan melalui pameran dan lokakarya yang menampilkan teknik seperti batik Malangan, ukiran kayu, dan kerajinan keramik. Para pengrajin sering melakukan demonstrasi langsung, memungkinkan pengunjung untuk mengamati dan berpartisipasi dalam proses kreatif.\n\nMalang Flower Carnival menggabungkan warisan dengan kreativitas kontemporer, menampilkan kostum dan panggung bergerak yang dihiasi dengan bunga dan tanaman yang ditanam secara lokal. Acara tahunan ini menarik ribuan penonton dan telah menjadi simbol ekspresi artistik kota.\n\nPerayaan kuliner termasuk Festival Rujak Uleg dan berbagai festival makanan kaki lima yang menyoroti masakan lokal. Acara-acara ini tidak hanya memamerkan kelezatan kuliner tetapi juga berperan dalam melestarikan dan mengembangkan tradisi kuliner Malang.\n\nFestival musik dan sastra seperti Jazz Atas Awan dan Festival Sastra Malang menarik seniman nasional dan internasional, menciptakan platform untuk dialog kreatif dan pertukaran budaya yang melintasi batas geografis dan generasi.\n\nSebagai kota dengan populasi mahasiswa besar, Malang juga melihat banyak festival mahasiswa yang menampilkan seni eksperimental, musik indie, dan bentuk ekspresi budaya alternatif yang menantang konvensi dan mendorong batasan kreativitas.\n\nMelalui perayaan budaya ini, Malang mempertahankan hubungan dengan tradisinya sambil merangkul inovasi kreatif, menciptakan identitas budaya yang terus berkembang yang menghormati masa lalu sambil membangun masa depan.', 'Temukan kekayaan dan keragaman festival budaya Malang yang merayakan warisan tradisional kota dan kreativitas kontemporer, menawarkan pengalaman mendalam tentang identitas budaya yang dinamis di Jawa Timur.', NULL, 'draft', NULL, '2025-04-20 22:32:52', '2025-04-20 22:32:52'),
(6, 'PLTS Terapung Tempati 80 Hektare Waduk Karangkates', 'plts-terapung-tempati-80-hektare-waduk-karangkates', 'Sebab, swasembada energi merupakan salah satu fungsi utama bendungan.\r\n\r\nFirman menambahkan, laporan progres proyek PLTS terapung menyebutkan bahwa\r\n\r\npembangunan akan dimulai sekitar dua bulan ke depan atau Juni 2025.', 'KABUPATEN - Luas bagian Waduk Karangkates atau Bendungan Sutami yang akan ditempati Pembangkit Listrik Tenaga Surya (PLTS) terapung mencapai 80 hektare.\r\n\r\nKemungkinan besar posisinya akan beririsan dengan keramba jaring apung (KJA) milik para pembudi day', 'uploads/plts-terapung-tempati-80-hektare-waduk-karangkates-1745210529.png', 'published', '2025-04-21 04:42:09', '2025-04-21 04:42:09', '2025-04-21 04:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `article_author`
--

DROP TABLE IF EXISTS `article_author`;
CREATE TABLE IF NOT EXISTS `article_author` (
  `article_id` int NOT NULL,
  `author_id` int NOT NULL,
  PRIMARY KEY (`article_id`,`author_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article_author`
--

INSERT INTO `article_author` (`article_id`, `author_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 1),
(5, 2),
(5, 3),
(6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

DROP TABLE IF EXISTS `article_category`;
CREATE TABLE IF NOT EXISTS `article_category` (
  `article_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`article_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`article_id`, `category_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 1),
(3, 4),
(4, 2),
(4, 5),
(5, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bio` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`author_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `name`, `email`, `bio`, `created_at`) VALUES
(1, 'Budi Santoso', 'budi.santoso@example.com', 'Jurnalis budaya dengan keahlian dalam warisan dan pariwisata Indonesia dengan pengalaman lebih dari 8 tahun.', '2025-04-20 22:32:51'),
(2, 'Dewi Anggraini', 'dewi.anggraini@example.com', 'Penulis kuliner dan penjelajah makanan yang mengkhususkan diri dalam masakan Jawa Timur dan resep tradisional.', '2025-04-20 22:32:51'),
(3, 'Reza Pratama', 'reza.pratama@example.com', 'Jurnalis lingkungan yang fokus pada upaya konservasi dan inisiatif keberlanjutan di Indonesia.', '2025-04-20 22:32:51'),
(4, 'nanda', 'nandacantik@gmail.com', 'Penulis blog', '2025-04-21 04:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `slug`) VALUES
(1, 'Pariwisata', 'pariwisata'),
(2, 'Budaya', 'budaya'),
(3, 'Kuliner', 'kuliner'),
(4, 'Lingkungan', 'lingkungan'),
(5, 'Pendidikan', 'pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'nanda', 'nandacantik@gmail.com', '$2y$12$tUtKzg7w357QM2EU7sMlx.WkzgYchW3qn/Fb/.d8/viuLyVq6q9tO', '2025-04-21 04:39:52'),
(2, 'nandangambek', 'nands@gmail.com', '$2y$12$u0LuWCXjNKaIt9xx32xyHuk5CiQtEvVyF8NoAfxXqqKpUvLdyNJyW', '2025-04-21 11:38:15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
