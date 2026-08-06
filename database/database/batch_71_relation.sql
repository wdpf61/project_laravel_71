-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: project71_test
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `core_activity_logs`
--

DROP TABLE IF EXISTS `core_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_activity_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loggable_type` varchar(255) NOT NULL,
  `loggable_id` bigint(20) unsigned NOT NULL,
  `action` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `core_activity_logs_loggable_type_loggable_id_index` (`loggable_type`,`loggable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_activity_logs`
--

LOCK TABLES `core_activity_logs` WRITE;
/*!40000 ALTER TABLE `core_activity_logs` DISABLE KEYS */;
INSERT INTO `core_activity_logs` VALUES (1,'App\\Models\\User',4,'Updated profile picture','2026-08-04 04:33:22'),(2,'App\\Models\\Course',1,'Course syllabus published','2026-08-04 04:33:22');
/*!40000 ALTER TABLE `core_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_cache`
--

DROP TABLE IF EXISTS `core_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `core_cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_cache`
--

LOCK TABLES `core_cache` WRITE;
/*!40000 ALTER TABLE `core_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_cache_locks`
--

DROP TABLE IF EXISTS `core_cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `core_cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_cache_locks`
--

LOCK TABLES `core_cache_locks` WRITE;
/*!40000 ALTER TABLE `core_cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_classrooms`
--

DROP TABLE IF EXISTS `core_classrooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_classrooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `room_number` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_classrooms`
--

LOCK TABLES `core_classrooms` WRITE;
/*!40000 ALTER TABLE `core_classrooms` DISABLE KEYS */;
INSERT INTO `core_classrooms` VALUES (1,'Grade 12 Alpha','Room 301'),(2,'Lab Beta','Room 102');
/*!40000 ALTER TABLE `core_classrooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_comments`
--

DROP TABLE IF EXISTS `core_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `commentable_type` varchar(255) NOT NULL,
  `commentable_id` bigint(20) unsigned NOT NULL,
  `body` text NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `core_comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  KEY `core_comments_author_id_foreign` (`author_id`),
  CONSTRAINT `core_comments_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `core_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_comments`
--

LOCK TABLES `core_comments` WRITE;
/*!40000 ALTER TABLE `core_comments` DISABLE KEYS */;
INSERT INTO `core_comments` VALUES (1,'App\\Models\\Teacher',1,'Great teaching style, very inspiring!',4,'2026-08-04 04:33:22'),(2,'App\\Models\\Subject',2,'This curriculum requires advanced calculus background.',3,'2026-08-04 04:33:22');
/*!40000 ALTER TABLE `core_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_course_student`
--

DROP TABLE IF EXISTS `core_course_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_course_student` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) unsigned NOT NULL,
  `student_id` bigint(20) unsigned NOT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `core_course_student_course_id_foreign` (`course_id`),
  KEY `core_course_student_student_id_foreign` (`student_id`),
  CONSTRAINT `core_course_student_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `core_courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `core_course_student_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `core_students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_course_student`
--

LOCK TABLES `core_course_student` WRITE;
/*!40000 ALTER TABLE `core_course_student` DISABLE KEYS */;
INSERT INTO `core_course_student` VALUES (1,1,1,'2026-08-04 04:33:22'),(2,1,2,'2026-08-04 04:33:22'),(3,2,2,'2026-08-04 04:33:22'),(4,1,3,'2026-08-06 06:15:53'),(5,1,4,'2026-08-06 06:15:53'),(6,2,6,'2026-08-06 06:15:53'),(7,2,4,'2026-08-06 06:15:53'),(8,2,7,'2026-08-06 06:47:39');
/*!40000 ALTER TABLE `core_course_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_courses`
--

DROP TABLE IF EXISTS `core_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `classroom_id` bigint(20) unsigned NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `core_courses_teacher_id_foreign` (`teacher_id`),
  KEY `core_courses_subject_id_foreign` (`subject_id`),
  KEY `core_courses_classroom_id_foreign` (`classroom_id`),
  CONSTRAINT `core_courses_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `core_classrooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `core_courses_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `core_subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `core_courses_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `core_teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_courses`
--

LOCK TABLES `core_courses` WRITE;
/*!40000 ALTER TABLE `core_courses` DISABLE KEYS */;
INSERT INTO `core_courses` VALUES (1,1,1,1,'2026-2027'),(2,2,2,2,'2026-2027');
/*!40000 ALTER TABLE `core_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_failed_jobs`
--

DROP TABLE IF EXISTS `core_failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `core_failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_failed_jobs`
--

LOCK TABLES `core_failed_jobs` WRITE;
/*!40000 ALTER TABLE `core_failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_job_batches`
--

DROP TABLE IF EXISTS `core_job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_job_batches`
--

LOCK TABLES `core_job_batches` WRITE;
/*!40000 ALTER TABLE `core_job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_jobs`
--

DROP TABLE IF EXISTS `core_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `core_jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_jobs`
--

LOCK TABLES `core_jobs` WRITE;
/*!40000 ALTER TABLE `core_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_migrations`
--

DROP TABLE IF EXISTS `core_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_migrations`
--

LOCK TABLES `core_migrations` WRITE;
/*!40000 ALTER TABLE `core_migrations` DISABLE KEYS */;
INSERT INTO `core_migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_08_02_065657_create_products_table',2),(5,'2026_08_03_035911_create_students_table',3),(6,'2026_08_04_042328_create_school_tables',4);
/*!40000 ALTER TABLE `core_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_password_reset_tokens`
--

DROP TABLE IF EXISTS `core_password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_password_reset_tokens`
--

LOCK TABLES `core_password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `core_password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_products`
--

DROP TABLE IF EXISTS `core_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_products`
--

LOCK TABLES `core_products` WRITE;
/*!40000 ALTER TABLE `core_products` DISABLE KEYS */;
INSERT INTO `core_products` VALUES (1,'Laptop',50000,1,'laptop.jpg','Good',1,NULL,NULL),(2,'Xiaomi Redmi Note 15',43525,42,'https://via.placeholder.com/640x480.png/005555?text=technics+qui','Laboriosam voluptatibus voluptas consequuntur est. Vel in natus et vitae dolor ut totam. Aut porro velit tempore sit ea necessitatibus itaque non.',1,'1979-08-06 16:01:05','1976-04-08 12:34:18'),(3,'Asus ROG Strix',118637,24,'https://via.placeholder.com/640x480.png/0022dd?text=technics+provident','Expedita voluptatem rerum necessitatibus iste corrupti. Amet nihil sed ut qui voluptate earum ut et. Assumenda neque sit ratione suscipit minus. Quia beatae sit hic suscipit quasi nihil aut. Quam deserunt unde saepe dolores ut tenetur.',0,'2020-12-21 23:21:10','2013-10-22 16:04:39'),(4,'Apple iPhone 16 Pro',67915,34,'https://via.placeholder.com/640x480.png/00ffbb?text=technics+dolores','Nisi voluptatem ut occaecati. Cumque accusantium sunt et nobis et.',1,'2024-12-22 18:05:06','1985-02-19 20:21:49'),(5,'HP Pavilion Laptop',146299,43,'https://via.placeholder.com/640x480.png/007733?text=technics+enim','Deserunt commodi et illo blanditiis dignissimos. Sint sequi est delectus quis in praesentium. Consequatur qui recusandae voluptas amet.',0,'1982-06-18 01:58:30','2018-06-02 08:06:08'),(6,'Apple iPhone 16 Pro',78759,50,'https://via.placeholder.com/640x480.png/005566?text=technics+ullam','Dolores repellendus et aut molestiae consequatur consequatur ut. Tempore nam odio quas debitis. Aut exercitationem quis dolor magni. Vero inventore recusandae omnis amet voluptates et omnis.',0,'2019-12-14 02:20:55','2004-07-10 09:54:50'),(7,'Apple Watch Series 11',61097,46,'https://via.placeholder.com/640x480.png/003388?text=technics+cumque','Facilis molestiae placeat asperiores fugiat. Laboriosam amet voluptates voluptatum fugit. Assumenda aut modi fuga esse autem assumenda.',0,'1993-10-18 14:03:50','1999-08-29 19:15:17'),(8,'Samsung Galaxy S25',143264,11,'https://via.placeholder.com/640x480.png/00ddcc?text=technics+aut','Exercitationem qui numquam deserunt odit ut odio esse. Repellat nobis eos a beatae at. Sed eum dolor et et dolor dolor fugit. Culpa voluptatem eum voluptatibus et maxime.',1,'1993-03-02 06:31:11','1988-06-12 16:31:38'),(9,'Asus ROG Strix',52368,17,'https://via.placeholder.com/640x480.png/0011ff?text=technics+voluptatem','Debitis dolorem id rerum quia officiis qui. Voluptas assumenda sapiente dignissimos neque magnam. Consectetur est voluptatum quod reiciendis quia sunt.',1,'2005-04-11 17:03:49','2023-01-10 10:49:44'),(10,'Canon EOS R50',29883,31,'https://via.placeholder.com/640x480.png/000044?text=technics+consequatur','Enim at et quas sunt corrupti vel alias. Voluptas beatae ad deleniti molestiae ullam. Aut molestias cumque quam quod saepe.',0,'2005-12-03 07:25:34','2005-11-04 18:50:58'),(11,'Asus ROG Strix',111842,46,'https://via.placeholder.com/640x480.png/00dd44?text=technics+error','Ipsum veniam rem minima beatae quasi ut numquam. Vel id voluptatum debitis id est minus. Perspiciatis occaecati dolore neque commodi voluptatem. Totam laudantium mollitia facilis voluptatem dolores et vitae saepe.',1,'2013-05-29 12:02:15','2005-04-05 01:55:39'),(12,'Sony WH-1000XM5',119716,25,'https://via.placeholder.com/640x480.png/004488?text=technics+asperiores','Quis assumenda sit quos nisi accusantium omnis praesentium. Eligendi iusto odio voluptate consequatur eius provident aliquid. Impedit quia voluptates voluptate ullam mollitia odit. Vel in accusamus quam vel id quis et.',0,'1993-02-10 13:23:22','2017-06-06 09:04:55'),(13,'Apple Watch Series 11',40674,13,'https://via.placeholder.com/640x480.png/0044ff?text=technics+asperiores','Ad veritatis nulla explicabo repellendus saepe ut dolores ut. Dicta nisi deserunt dolores molestias quis. Aperiam amet consequatur ex necessitatibus.',0,'1998-02-08 16:13:53','2022-06-09 00:58:48'),(14,'Xiaomi Redmi Note 15',66142,35,'https://via.placeholder.com/640x480.png/009944?text=technics+eveniet','Officia vero id et. Dolorem hic praesentium commodi dolore quod perferendis dolorem. Ex nobis aspernatur et blanditiis quod perspiciatis aut. Est voluptas sed et aperiam ratione praesentium.',1,'1970-01-16 13:46:17','2020-05-30 09:37:29'),(15,'Apple iPhone 16 Pro',130633,18,'https://via.placeholder.com/640x480.png/003366?text=technics+odio','Ad distinctio repudiandae minus porro nostrum aliquam provident perferendis. Harum quae tenetur libero aut provident sed eum. Consequatur et et qui voluptate consequuntur consequatur id ut.',1,'2020-01-23 23:28:26','1994-08-19 02:32:58'),(16,'Apple Watch Series 11',127373,26,'https://via.placeholder.com/640x480.png/0077cc?text=technics+provident','Laudantium quo omnis repellat blanditiis. Neque sit provident vel exercitationem ratione dolorem nihil. Beatae eaque veritatis perferendis saepe ullam quo voluptatem qui. Sint accusantium modi expedita. A doloribus molestiae accusamus ut est fuga praesentium.',1,'1993-10-26 05:19:58','2018-03-15 11:42:00'),(17,'Logitech MX Master 3S',112031,24,'https://via.placeholder.com/640x480.png/000022?text=technics+animi','Voluptas dolorum expedita voluptatem quibusdam ducimus qui animi. Quia veritatis quis harum laboriosam. Ipsum aliquid sapiente doloribus est dolor voluptates esse. Velit ex et tempore sapiente ab corporis. Pariatur est sit architecto ut sequi quis.',0,'2017-05-09 19:44:29','1971-06-02 00:13:20'),(18,'Xiaomi Redmi Note 15',34797,48,'https://via.placeholder.com/640x480.png/00aadd?text=technics+ipsa','Occaecati quia dignissimos nisi aut cumque ipsam. Alias adipisci voluptatem possimus perspiciatis. Veniam hic non illo ratione officiis impedit eligendi. Modi veniam rerum voluptas illo mollitia.',0,'2014-08-31 06:10:13','1982-12-11 02:48:16'),(19,'HP Pavilion Laptop',146344,48,'https://via.placeholder.com/640x480.png/00eedd?text=technics+nostrum','Consequuntur earum ea nemo numquam nobis voluptatem delectus. Nihil porro eaque exercitationem est nihil. Quis sunt rem sint. Sapiente reprehenderit veritatis officia adipisci tenetur odio.',0,'1997-04-05 13:48:41','2013-04-08 05:04:45'),(20,'Dell Inspiron 15',74441,20,'https://via.placeholder.com/640x480.png/0000bb?text=technics+non','Ipsa qui ut quia cum dolores harum. Molestiae officiis ut ut temporibus. Velit odit asperiores illo sint porro. Ea dignissimos quasi molestias dolores.',0,'2022-09-20 14:59:26','1975-05-06 06:29:51'),(21,'Dell Inspiron 15',77351,25,'https://via.placeholder.com/640x480.png/007799?text=technics+dignissimos','Corrupti odio deserunt ullam omnis tenetur possimus. Est eligendi recusandae sit velit. Commodi dolorem qui asperiores quia sed est. Nemo et alias laudantium voluptas et cupiditate.',1,'1991-04-03 10:53:58','2023-06-04 20:23:10'),(22,'Canon EOS R50',148657,35,'https://via.placeholder.com/640x480.png/007766?text=technics+molestiae','Voluptatibus labore alias et. Neque vel magnam eveniet cum. Sint repellat neque quos neque repudiandae.',0,'1976-09-06 08:52:03','1986-09-30 22:04:15'),(23,'Samsung Galaxy S25',125761,17,'https://via.placeholder.com/640x480.png/00bb88?text=technics+quaerat','Rerum enim tenetur aut fugiat laborum magni expedita. Sint est aliquam et delectus minima voluptatem. Mollitia vitae voluptatem nam nam eligendi adipisci consequatur.',0,'1973-09-27 09:39:21','1986-05-06 12:02:56'),(24,'Asus ROG Strix',117097,17,'https://via.placeholder.com/640x480.png/002222?text=technics+dolorum','Ut repellendus et corporis architecto architecto beatae at aut. Quidem error in iure quia corrupti voluptatem sit. Qui quaerat neque quae id ab. Voluptate cumque omnis minima.',1,'1979-06-11 23:58:28','2022-09-22 07:20:33'),(25,'Samsung Galaxy S25',38473,48,'https://via.placeholder.com/640x480.png/008855?text=technics+voluptas','Quasi incidunt quos ducimus. Repellat enim laudantium consequuntur culpa nemo at sint. Et deleniti sit non expedita qui a doloremque.',0,'1979-08-03 10:59:00','1999-04-06 21:07:11'),(26,'Apple iPhone 16 Pro',92865,16,'https://via.placeholder.com/640x480.png/00bb44?text=technics+earum','Vel culpa sed dignissimos eveniet. Sit sequi quam consectetur.',1,'2002-06-08 17:42:30','1988-10-21 19:35:42'),(27,'Dell Inspiron 15',136533,43,'https://via.placeholder.com/640x480.png/00ffaa?text=technics+et','Necessitatibus nulla minima perspiciatis est at aut in. Voluptate et illo iure unde. Sequi rerum dolorem odio non dolorem consequatur facere.',1,'2020-07-17 07:56:34','2016-08-03 12:48:14'),(28,'Logitech MX Master 3S',141912,43,'https://via.placeholder.com/640x480.png/002277?text=technics+consequuntur','Qui sed est sapiente alias et eos. Maiores quia quo non et quisquam ea consequuntur accusantium. Soluta dolorum et aspernatur pariatur quis. Expedita blanditiis et voluptatem rerum aliquam quibusdam et.',0,'2000-02-22 23:52:27','2011-03-08 21:05:56'),(29,'Logitech MX Master 3S',68026,19,'https://via.placeholder.com/640x480.png/00ccbb?text=technics+nemo','Commodi quaerat aperiam sunt dicta error omnis. Ipsa fuga qui ex sed inventore. Expedita sit vero quis est. Dolores voluptatem et sit qui aspernatur.',0,'1985-09-08 04:04:20','2003-08-12 07:16:19'),(30,'Dell Inspiron 15',22561,16,'https://via.placeholder.com/640x480.png/002200?text=technics+est','Exercitationem et sit neque voluptatibus assumenda corrupti quos. Provident nisi quis repellat beatae cumque nam.',0,'1996-09-01 19:20:22','1976-11-26 14:12:18'),(31,'Xiaomi Redmi Note 15',60672,47,'https://via.placeholder.com/640x480.png/00aa33?text=technics+placeat','Iusto natus qui consectetur quidem. Facere sequi odio enim et et nemo in. Soluta voluptas praesentium dignissimos quos voluptatem et. Exercitationem aspernatur nihil itaque sapiente vero et ad.',0,'1977-01-02 04:52:55','2005-02-22 18:43:20'),(32,'Apple Watch Series 11',104349,46,'https://via.placeholder.com/640x480.png/004466?text=technics+impedit','Est molestias commodi vel nulla et est. Voluptatem quia illo ipsum alias explicabo perspiciatis. Quas magni nulla deleniti minima fugit.',1,'1974-03-07 09:30:07','2005-02-11 08:06:24'),(33,'Samsung Galaxy S25',44325,49,'https://via.placeholder.com/640x480.png/00aadd?text=technics+similique','Inventore aspernatur eos culpa illo dolor. Delectus adipisci voluptatem ipsam maiores molestiae quidem ex nemo. Deserunt et est dolorem ipsam temporibus sint ea. Ut reprehenderit voluptatem dolor qui. Dolor enim vero eum rem nemo nam voluptas.',1,'2006-05-16 01:37:07','1984-04-01 19:47:04'),(34,'HP Pavilion Laptop',62997,23,'https://via.placeholder.com/640x480.png/0077ee?text=technics+quo','Debitis deserunt ullam molestias ea. Dolores cum aut qui ut cumque doloribus et. Non et similique et corporis.',1,'1993-06-22 06:15:03','2012-08-21 20:20:03'),(35,'Apple Watch Series 11',143523,41,'https://via.placeholder.com/640x480.png/009900?text=technics+est','Vel autem rerum qui necessitatibus fugiat nihil quae. Nemo dicta aut et minima velit dolorem. Impedit dolorum facere sed atque occaecati.',0,'2025-02-13 13:36:26','1971-01-15 00:30:05'),(36,'HP Pavilion Laptop',46335,21,'https://via.placeholder.com/640x480.png/00cc99?text=technics+id','Non in labore reiciendis maiores sed ea doloremque. Cupiditate ipsam et atque velit natus. Maxime error quasi nam ea eius aut. Eveniet error reprehenderit et nisi nisi quas qui. Et voluptates enim magnam laudantium.',1,'1996-09-05 09:50:20','1978-09-18 01:24:38'),(37,'Asus ROG Strix',136593,44,'https://via.placeholder.com/640x480.png/003333?text=technics+dolor','Ut deleniti id minima ex similique. Eum qui eum dolorum laborum aliquam. Ducimus deserunt recusandae fuga est. Ut explicabo sint aliquam numquam pariatur.',0,'1972-07-27 17:07:02','1998-06-18 06:18:51'),(38,'Canon EOS R50',57098,17,'https://via.placeholder.com/640x480.png/003322?text=technics+quaerat','In sunt est sunt aut nostrum illum labore a. Ut aspernatur id id ipsam esse labore. Nemo quia in autem sed mollitia delectus perspiciatis.',0,'2018-10-25 18:04:39','1989-05-28 10:28:33'),(39,'Xiaomi Redmi Note 15',25441,21,'https://via.placeholder.com/640x480.png/008866?text=technics+voluptatum','Quas laborum libero iusto ut. Libero non at commodi molestiae distinctio. Ut ab aliquid autem et quisquam. Error itaque eveniet commodi.',0,'2014-11-22 08:27:28','2018-10-18 02:34:59'),(40,'HP Pavilion Laptop',143207,12,'https://via.placeholder.com/640x480.png/005500?text=technics+quibusdam','Omnis est debitis accusamus. Dolorem distinctio rerum aut et. Ipsa dolor dolorum possimus consequatur quibusdam deserunt.',0,'2014-02-24 20:28:07','1989-02-21 00:12:16'),(41,'Xiaomi Redmi Note 15',33054,43,'https://via.placeholder.com/640x480.png/00ee00?text=technics+ut','Neque natus sint explicabo magnam labore est magnam. Aperiam est veritatis consequatur praesentium pariatur odio rerum.',1,'1976-05-17 17:59:22','1995-01-14 21:09:29'),(42,'Logitech MX Master 3S',115176,11,'https://via.placeholder.com/640x480.png/003377?text=technics+corrupti','Asperiores et consequatur nisi est eligendi. Omnis officia numquam deserunt commodi cupiditate omnis a. Officia veniam dolorem voluptas.',1,'2014-06-04 12:56:55','1993-04-05 01:28:26'),(43,'Sony WH-1000XM5',54747,16,'https://via.placeholder.com/640x480.png/00dd33?text=technics+expedita','Incidunt quae id beatae corporis voluptas et. Nihil omnis quia hic. Reprehenderit harum maiores consectetur qui et doloremque. Sit rerum reiciendis sunt est quisquam cumque.',0,'2018-11-13 15:09:08','2013-03-14 11:32:14'),(44,'Xiaomi Redmi Note 15',80086,33,'https://via.placeholder.com/640x480.png/00ddbb?text=technics+consequatur','Libero dolorem suscipit et dolore. Perferendis illo assumenda consequatur totam aliquid asperiores id. Quisquam aut nostrum est eaque ex omnis.',0,'1988-12-28 17:37:39','1989-02-08 10:19:43'),(45,'Xiaomi Redmi Note 15',65933,12,'https://via.placeholder.com/640x480.png/009933?text=technics+doloribus','In iusto harum quia et nulla ut esse. Eligendi sed id et impedit.',0,'2003-09-15 12:58:15','1999-07-25 12:03:58'),(46,'Sony WH-1000XM5',55103,18,'https://via.placeholder.com/640x480.png/0011aa?text=technics+molestias','Voluptatibus quia voluptatem cum eligendi quisquam quasi quis. Dolor sed explicabo quo. In iste voluptate dolorem voluptatibus ut.',1,'1972-03-27 18:08:34','2001-12-01 20:07:41'),(47,'Apple Watch Series 11',73420,12,'https://via.placeholder.com/640x480.png/0088ff?text=technics+omnis','Et ut sit et. Officia quisquam officiis quod sed expedita explicabo magni officiis. Harum est error dolor similique deserunt. At consequatur illum dolor tempora vel.',1,'2021-06-30 05:17:33','1985-07-12 22:13:17'),(48,'Apple Watch Series 11',49308,35,'https://via.placeholder.com/640x480.png/000022?text=technics+et','Consequatur officiis totam in quia voluptatibus quibusdam. Qui aut reiciendis exercitationem quod dolores sed et. Sapiente nihil vel nobis explicabo doloremque quia dolorum. Quia et mollitia in ex magnam.',1,'1982-04-07 16:34:33','1978-07-06 22:44:55'),(49,'Canon EOS R50',27160,27,'https://via.placeholder.com/640x480.png/0088ff?text=technics+dicta','Ut dolor qui eos. Dolor qui nemo sit incidunt voluptates sint. Adipisci accusamus harum accusantium magnam qui voluptatem fugit. Et est officiis eligendi incidunt.',1,'2009-08-30 04:27:09','1987-12-15 00:55:34'),(50,'Apple iPhone 16 Pro',30110,36,'https://via.placeholder.com/640x480.png/002233?text=technics+cum','Consequatur adipisci provident vel sunt earum. Culpa eveniet ut amet quae qui nulla. Exercitationem aut rerum rerum ipsam dolores error.',1,'2000-09-13 08:37:13','2000-09-10 01:39:53'),(51,'Logitech MX Master 3S',78582,36,'https://via.placeholder.com/640x480.png/0077cc?text=technics+ex','Facere doloribus dolorem blanditiis quasi odit. In asperiores harum pariatur animi ut omnis reiciendis blanditiis. Voluptatem nihil tenetur exercitationem.',1,'2025-06-29 11:29:05','1971-04-02 20:15:05'),(52,'Logitech MX Master 3S',51247,26,'https://via.placeholder.com/640x480.png/002255?text=technics+qui','Et asperiores quam saepe qui eius alias occaecati perspiciatis. Aut qui tempore autem voluptate molestiae animi. Voluptate dolorem maiores a repudiandae sequi provident. Et assumenda aliquam numquam dolores.',0,'2019-08-03 00:29:39','1994-06-24 11:17:52'),(53,'Xiaomi Redmi Note 15',95283,14,'https://via.placeholder.com/640x480.png/00dd22?text=technics+aspernatur','Aut magnam ex eos dolores nam officia. Minima maiores praesentium voluptas molestiae quo quod quam. Est magnam iste optio corrupti voluptatem nulla voluptas. Aspernatur inventore sequi expedita nulla quisquam accusantium vitae laudantium.',1,'1984-05-03 02:19:19','2020-01-05 03:46:41'),(54,'Xiaomi Redmi Note 15',38901,26,'https://via.placeholder.com/640x480.png/002277?text=technics+ut','Voluptates tempora quidem veniam. Est sint cumque iusto eum iusto enim at. Nemo eos distinctio laborum pariatur qui corporis. Dolor esse non non ut qui.',0,'2015-10-14 09:50:16','2004-07-24 08:51:51'),(55,'Logitech MX Master 3S',76193,34,'https://via.placeholder.com/640x480.png/00aa11?text=technics+explicabo','Vel nostrum voluptatem beatae repellendus ut voluptate deleniti est. Qui itaque inventore possimus reprehenderit dolorum ducimus.',0,'1983-04-20 02:22:51','1991-03-28 19:51:16'),(56,'Apple Watch Series 11',128383,49,'https://via.placeholder.com/640x480.png/005544?text=technics+dicta','Quibusdam laudantium odio omnis tempore autem aut. Ipsa aut quia consequuntur consequuntur consequatur eveniet aut. Qui molestiae illum adipisci. Eveniet reiciendis sint et aut numquam nostrum perferendis itaque.',1,'2012-10-14 04:22:45','2002-09-05 04:42:22'),(57,'Sony WH-1000XM5',82916,30,'https://via.placeholder.com/640x480.png/00bbee?text=technics+quibusdam','Aperiam perspiciatis est quas nesciunt esse perspiciatis. Sequi placeat saepe maiores aut totam. Ad iusto quod est quae sed quisquam delectus.',1,'2024-01-21 03:16:52','1976-03-21 03:17:48'),(58,'HP Pavilion Laptop',111163,38,'https://via.placeholder.com/640x480.png/0000ee?text=technics+eaque','Est dicta repellat in aut placeat. Molestiae in in aspernatur dolorum vitae accusantium repellat. Enim fugit quaerat ipsam corporis. Aut a voluptates nulla consequatur. Cupiditate quo ab fugiat omnis.',1,'1992-09-25 00:48:06','1970-01-25 12:26:09'),(59,'Apple Watch Series 11',143867,27,'https://via.placeholder.com/640x480.png/0066aa?text=technics+voluptas','Qui rerum est consequatur laudantium. Et quod numquam quas omnis sit quae.',1,'2005-03-20 07:53:03','2021-01-15 21:22:28'),(60,'Canon EOS R50',83379,27,'https://via.placeholder.com/640x480.png/00dd44?text=technics+aut','Possimus commodi sed quaerat beatae ut suscipit. Velit recusandae eveniet ab qui qui et. Consequatur dolores vel ea.',1,'2009-04-21 03:45:17','1999-05-04 16:58:19'),(61,'Asus ROG Strix',110368,36,'https://via.placeholder.com/640x480.png/003355?text=technics+omnis','Placeat dolore ad mollitia dolor autem itaque et sit. Dolorem ad quaerat occaecati tenetur consequatur est nobis. Repellat rerum quod perferendis est.',1,'2009-03-15 08:21:04','1975-10-02 08:14:36'),(62,'Logitech MX Master 3S',107232,25,'https://via.placeholder.com/640x480.png/00ccbb?text=technics+fugiat','Ut odio sed harum atque in minima qui. Ipsum illo est rem consequatur et odit eius. Laudantium qui autem tempora qui maxime.',0,'1978-04-02 11:56:56','2026-07-25 04:12:23'),(63,'Xiaomi Redmi Note 15',62042,30,'https://via.placeholder.com/640x480.png/007711?text=technics+suscipit','Ipsam iure pariatur distinctio nesciunt ratione nostrum. Nobis debitis dolorum itaque. Qui ex nisi beatae ducimus ut assumenda.',0,'1992-06-10 21:46:11','2011-10-22 16:38:33'),(64,'Logitech MX Master 3S',126327,23,'https://via.placeholder.com/640x480.png/00ffff?text=technics+aut','Est qui et facilis commodi voluptatibus vero perspiciatis. Exercitationem non nulla dolorem voluptatem voluptates non qui. Sunt consequatur adipisci quia qui nulla aliquid.',0,'1991-12-28 15:33:24','1984-03-13 00:18:10'),(65,'Logitech MX Master 3S',21573,32,'https://via.placeholder.com/640x480.png/0033bb?text=technics+quo','Natus quis quisquam animi eum. Vero voluptatibus voluptatem nobis quam sit.',1,'2024-02-22 10:03:11','1978-05-16 10:12:27'),(66,'Xiaomi Redmi Note 15',107372,21,'https://via.placeholder.com/640x480.png/00dd66?text=technics+sed','Voluptatem iure ut ipsam consequatur cupiditate voluptas non. Numquam eum eos consequatur ducimus eveniet porro labore. Ut doloribus minus aperiam voluptate magnam possimus. Vitae nemo voluptates cupiditate temporibus.',1,'1985-11-29 07:15:23','2000-07-07 23:15:31'),(67,'HP Pavilion Laptop',95835,39,'https://via.placeholder.com/640x480.png/002255?text=technics+qui','Illum asperiores praesentium minima beatae voluptatem nulla aut. Ea accusamus et est reprehenderit aut. Enim sit hic qui voluptate.',0,'1977-04-13 09:00:22','2014-07-12 04:38:09'),(68,'Apple Watch Series 11',140032,13,'https://via.placeholder.com/640x480.png/0011ee?text=technics+ut','Porro quaerat consequuntur incidunt hic. Iusto eum quis facere voluptatem rerum nobis. Consequatur et hic velit necessitatibus. Ducimus laborum nostrum dolores.',1,'1989-06-20 01:04:22','1988-08-11 21:04:40'),(69,'Sony WH-1000XM5',135698,15,'https://via.placeholder.com/640x480.png/0044bb?text=technics+autem','Ut ratione fuga non amet nostrum. Occaecati velit eos fugiat quo perspiciatis aperiam. Voluptatibus aspernatur autem saepe possimus et.',0,'1981-10-04 23:27:18','1972-06-21 14:30:56'),(70,'Canon EOS R50',108399,15,'https://via.placeholder.com/640x480.png/0088ee?text=technics+voluptas','Eos officiis necessitatibus odit error eum inventore nam deserunt. Iusto excepturi sit eos magnam et dolorem et. Est totam aperiam expedita sit inventore impedit quibusdam ex.',1,'1977-01-19 19:18:24','2009-05-15 12:42:55'),(71,'HP Pavilion Laptop',123102,15,'https://via.placeholder.com/640x480.png/0055ee?text=technics+cum','Nulla non quasi a maiores aut. Dolores praesentium officia in et officia voluptates. Quaerat dolorem qui eaque commodi perferendis consectetur.',1,'1976-10-17 20:29:20','2002-06-28 07:37:19'),(72,'Xiaomi Redmi Note 15',119576,16,'https://via.placeholder.com/640x480.png/001133?text=technics+et','Eaque sapiente earum eum quos omnis dolorum totam. Amet quia cumque mollitia est eveniet amet ex. Nulla odit autem omnis at aut. Eius voluptatibus necessitatibus neque veritatis.',0,'2018-07-31 02:15:21','2002-07-28 08:02:53'),(73,'Sony WH-1000XM5',62709,16,'https://via.placeholder.com/640x480.png/008899?text=technics+aut','Ab sint doloremque nemo eos qui similique. Explicabo laudantium enim sunt sint sit rerum rerum. Suscipit eius in tempora at sunt molestiae. Ea sapiente qui sit ut laboriosam pariatur dolorum.',1,'2022-03-20 00:38:22','2021-01-15 08:34:23'),(74,'Samsung Galaxy S25',23139,11,'https://via.placeholder.com/640x480.png/005566?text=technics+at','In quis sed totam alias dolorum. Voluptas omnis est inventore sunt. Rerum officiis earum blanditiis rem cupiditate. A eum itaque soluta non cupiditate.',0,'1982-12-04 06:23:50','2018-04-15 11:38:09'),(75,'Samsung Galaxy S25',82694,47,'https://via.placeholder.com/640x480.png/00bbcc?text=technics+minus','Necessitatibus perferendis eum laudantium ut est perferendis. Quaerat aliquid quo nemo eos veritatis. Necessitatibus exercitationem quisquam a eos. Quis eum et natus.',0,'2014-08-17 16:30:41','2022-03-24 12:27:51'),(76,'Samsung Galaxy S25',99379,22,'https://via.placeholder.com/640x480.png/00aaee?text=technics+odio','Laboriosam voluptatem consequatur labore nihil temporibus. Rerum cupiditate aut enim ipsum vero perferendis exercitationem. Praesentium possimus velit excepturi beatae a quos omnis. Enim nostrum commodi modi praesentium. Corporis omnis voluptas rerum voluptates quisquam.',0,'1970-09-14 04:29:48','2000-01-05 17:58:11'),(77,'Asus ROG Strix',108814,50,'https://via.placeholder.com/640x480.png/004499?text=technics+pariatur','Quia alias et eveniet consequatur reiciendis. Quod sequi quo aperiam voluptatem quia. Et quaerat maxime omnis iure. Et modi odit aut vero soluta minus odit.',1,'2004-09-07 09:05:58','2025-02-03 10:56:51'),(78,'Dell Inspiron 15',39863,16,'https://via.placeholder.com/640x480.png/007733?text=technics+non','Est non et in ut qui fugit. Vel in et minus ducimus sed esse. Dolore nihil earum repudiandae facilis non dolorem.',0,'1970-12-20 19:26:29','2000-06-18 21:10:36'),(79,'Xiaomi Redmi Note 15',146912,12,'https://via.placeholder.com/640x480.png/00cc66?text=technics+nulla','Repudiandae soluta vel repellendus provident cumque eligendi. Molestias ratione in fuga totam. Qui perspiciatis sapiente sint laborum.',0,'2001-06-28 18:58:10','2002-03-24 15:19:36'),(80,'Logitech MX Master 3S',133563,34,'https://via.placeholder.com/640x480.png/0077aa?text=technics+laudantium','Hic minus fugit molestiae nostrum sit necessitatibus est. Nesciunt sapiente ut voluptatem doloribus repudiandae est. At necessitatibus ratione dolor et mollitia omnis quos. Eius voluptatem id ex et.',1,'2009-02-10 15:30:45','2011-12-15 02:51:43'),(81,'Apple iPhone 16 Pro',66377,29,'https://via.placeholder.com/640x480.png/0011ee?text=technics+et','Architecto quasi officiis ipsa quod officiis. Aut repellat maiores id. Ab alias officiis ut voluptates voluptatum voluptatibus. Accusantium voluptatum officiis reprehenderit minima id.',1,'2018-06-07 11:52:28','1977-10-28 05:05:21'),(82,'Sony WH-1000XM5',22989,18,'https://via.placeholder.com/640x480.png/005522?text=technics+nobis','Qui tenetur natus dolorum consectetur sit. Asperiores est quis neque officiis est sed repellat. Occaecati voluptas perferendis unde beatae.',1,'1983-11-11 22:07:00','1999-09-29 11:02:05'),(83,'Canon EOS R50',144648,29,'https://via.placeholder.com/640x480.png/0077dd?text=technics+et','Nobis dolor accusamus error non. Pariatur provident rerum qui harum nisi porro. Totam ut quo debitis. Cumque voluptates consectetur repellendus est quia praesentium velit. Ut distinctio vitae asperiores recusandae consequatur ex sit quidem.',0,'1971-04-23 07:10:05','1975-05-29 03:09:03'),(84,'Sony WH-1000XM5',127380,22,'https://via.placeholder.com/640x480.png/006655?text=technics+eaque','Dolore cum ab repudiandae aut fuga. Minus porro quia aut accusantium. Itaque iusto impedit nostrum totam soluta sapiente quos. Velit temporibus unde cum dolores in.',0,'1986-04-13 23:42:32','1973-04-14 00:55:00'),(85,'Xiaomi Redmi Note 15',114528,44,'https://via.placeholder.com/640x480.png/005577?text=technics+consequatur','Ut quidem laboriosam et neque ut. Beatae culpa et consequatur voluptatem est qui reprehenderit delectus. Corrupti ipsa enim incidunt.',0,'2016-07-19 04:41:48','1981-04-10 00:38:17'),(86,'Apple iPhone 16 Pro',73947,35,'https://via.placeholder.com/640x480.png/007755?text=technics+dolores','Veniam exercitationem blanditiis ut maxime doloribus accusantium. Deleniti delectus praesentium ex inventore sint. Similique rerum vel aut accusamus magnam eius omnis. Provident optio doloremque itaque quaerat. Eos nisi neque est consequatur ut ea.',1,'1999-07-26 10:49:51','2022-10-04 03:41:47'),(87,'Apple iPhone 16 Pro',59557,19,'https://via.placeholder.com/640x480.png/008811?text=technics+saepe','Explicabo nam asperiores velit molestiae. Voluptatem nihil dolore soluta asperiores. Aliquid omnis ab voluptates tempore fuga tempora.',1,'2014-05-23 11:01:52','1988-09-13 07:35:52'),(88,'Logitech MX Master 3S',24451,31,'https://via.placeholder.com/640x480.png/002288?text=technics+cum','Saepe iusto quo itaque est qui. Non incidunt sed laudantium corrupti debitis. Et delectus vel voluptatem et vero voluptatem fugit. Reprehenderit est similique aliquam voluptas.',1,'1982-09-25 22:32:43','1973-01-20 14:28:07'),(89,'Xiaomi Redmi Note 15',59125,48,'https://via.placeholder.com/640x480.png/00ff88?text=technics+quia','Delectus fugit adipisci natus earum et. Necessitatibus neque voluptate est dolor ipsa. Modi sed voluptatem aut consequatur.',1,'1995-05-25 01:17:41','1991-08-19 03:29:54'),(90,'Xiaomi Redmi Note 15',41835,30,'https://via.placeholder.com/640x480.png/007722?text=technics+omnis','Expedita nihil veritatis similique aut. Repellat nihil voluptatibus est aut et pariatur. Soluta aperiam rerum accusantium impedit exercitationem aut. Debitis quo ex saepe eligendi repellendus et qui.',1,'2013-11-27 07:49:59','1986-11-26 00:13:27'),(91,'Dell Inspiron 15',48885,43,'https://via.placeholder.com/640x480.png/005544?text=technics+repudiandae','Molestiae veniam quia voluptas. Vel autem iure et veritatis. Sed et sed autem sit. Nostrum totam delectus laborum non voluptatem ratione fuga.',0,'2015-11-21 20:26:56','1995-05-09 00:49:43'),(92,'Asus ROG Strix',121577,28,'https://via.placeholder.com/640x480.png/007755?text=technics+facere','Autem explicabo ea et velit voluptatem minus. Hic qui beatae necessitatibus nihil quo repudiandae enim est. Sunt et atque voluptatibus nihil iste. Enim maxime reprehenderit nobis iure dolor alias voluptas iste.',0,'1973-02-12 02:37:37','1970-04-03 13:40:21'),(93,'Samsung Galaxy S25',89384,23,'https://via.placeholder.com/640x480.png/007700?text=technics+repellat','Sed omnis et aspernatur dolor. Earum sit eos aliquid et quasi molestiae molestiae. Ex voluptas fugiat fugiat quia rerum.',1,'2008-10-27 09:14:34','1997-02-12 01:32:44'),(94,'Asus ROG Strix',103763,46,'https://via.placeholder.com/640x480.png/0066ee?text=technics+consequatur','Beatae enim voluptatum repellendus. Ut quo asperiores pariatur eos odit quia perspiciatis. Aliquid sed sequi repellat ut aut fugiat quia. Quia omnis numquam est qui sit.',1,'2003-09-22 12:52:47','1982-04-22 08:52:03'),(95,'Canon EOS R50',102524,31,'https://via.placeholder.com/640x480.png/0000ee?text=technics+animi','Voluptatum id porro nobis culpa. Voluptatem recusandae nihil voluptatem quo. Nihil et qui vero in aut atque. Sit mollitia modi architecto et aut soluta itaque. Facilis asperiores aperiam iusto quis nostrum quia unde.',1,'2011-06-18 07:20:24','1995-02-19 11:14:06'),(96,'Samsung Galaxy S25',47055,38,'https://via.placeholder.com/640x480.png/00aa00?text=technics+omnis','Labore quia aut ex hic. Cum ut praesentium fuga ut dolores. Enim asperiores dolorem et et quia et.',0,'2024-09-14 18:49:03','1999-05-28 19:25:21'),(97,'Apple iPhone 16 Pro',37091,44,'https://via.placeholder.com/640x480.png/00ffaa?text=technics+ut','Deserunt dolorum ipsam soluta enim voluptatem officia. Vero dolor et odio est non voluptate ut. Suscipit est vitae vel minus vitae ullam est.',0,'2019-10-06 20:52:27','2005-06-13 20:33:08'),(98,'Dell Inspiron 15',113211,33,'https://via.placeholder.com/640x480.png/00bb11?text=technics+voluptas','Voluptate rerum aut at neque. Quibusdam porro dolorem reprehenderit dicta laudantium molestiae autem ducimus. Laborum officia necessitatibus nesciunt exercitationem quisquam ipsa quia.',1,'1996-04-13 11:03:17','2012-05-28 02:42:56'),(99,'Asus ROG Strix',140606,11,'https://via.placeholder.com/640x480.png/002211?text=technics+eligendi','Sit ipsum in amet quis voluptatibus excepturi aut aut. Reiciendis nesciunt eos eum et aut saepe. Dicta fugit exercitationem molestiae maiores praesentium nesciunt. Enim voluptas fugiat deserunt cum.',0,'1970-12-19 06:23:30','1981-08-06 08:40:52'),(100,'Asus ROG Strix',141141,31,'https://via.placeholder.com/640x480.png/00aa88?text=technics+ut','Eveniet totam et beatae sit. Rerum earum voluptatem provident enim repellendus non libero. Labore quia fugiat debitis perspiciatis dolorem veritatis. Sint tempora quos animi hic.',0,'2021-05-13 08:58:59','1982-09-01 21:17:45'),(101,'Sony WH-1000XM5',78876,39,'https://via.placeholder.com/640x480.png/0044ff?text=technics+ut','Vel veniam suscipit doloribus non sint accusantium. Vitae consequatur recusandae nisi commodi et. Eaque velit reprehenderit dolores exercitationem voluptatem in laborum. Non corporis nisi quis quia.',1,'1989-05-03 09:33:38','1986-03-10 16:28:38'),(102,'Sony WH-1000XM5',20608,38,'https://via.placeholder.com/640x480.png/007766?text=technics+aut','Assumenda aspernatur dolore nostrum sint iure hic repellendus. Corporis unde accusamus at dolor ducimus expedita.',0,'2000-10-09 05:29:09','2008-08-02 22:26:01'),(103,'Apple Watch Series 11',109035,25,'https://via.placeholder.com/640x480.png/003399?text=technics+repellendus','Libero asperiores numquam enim rerum eaque aut. Ad eos id et voluptatem in qui. Qui aut architecto quasi inventore.',1,'1973-05-14 01:26:28','1989-01-06 04:04:02'),(104,'Sony WH-1000XM5',41570,13,'https://via.placeholder.com/640x480.png/00bb00?text=technics+voluptas','Quasi nihil sed culpa. Illo quia quos est in sint. Perferendis exercitationem omnis laborum ex. Et consequuntur culpa non quo quia eaque.',1,'1983-09-01 19:07:54','2002-07-30 14:47:19'),(105,'Asus ROG Strix',112020,17,'https://via.placeholder.com/640x480.png/00aa00?text=technics+assumenda','Sint id libero error voluptas quos maxime. Placeat beatae nam omnis in quisquam nihil est qui. Ut ipsum itaque aperiam velit similique odit labore repellendus. Dolores quidem inventore nemo omnis et soluta.',0,'2005-01-07 16:16:34','1981-08-05 23:18:12'),(106,'Xiaomi Redmi Note 15',56463,28,'https://via.placeholder.com/640x480.png/0022aa?text=technics+aut','Quasi est unde magnam quam. Odit omnis quaerat sit facere. Et molestiae et ratione hic qui magni et placeat. Molestiae quis deserunt qui animi.',0,'2022-08-22 23:17:26','1989-06-30 12:25:34'),(107,'Sony WH-1000XM5',130303,14,'https://via.placeholder.com/640x480.png/0066ee?text=technics+id','Sit iusto eaque fugit fugit alias. Corrupti eveniet molestiae necessitatibus molestiae dolorem culpa molestiae. Officia nisi ut itaque consectetur consectetur excepturi expedita.',0,'2015-02-01 19:21:04','2026-01-04 02:39:50'),(108,'Canon EOS R50',97132,32,'https://via.placeholder.com/640x480.png/001188?text=technics+at','Sed dignissimos aperiam sit fuga. Id amet nemo velit qui quam magni id. Tempora quidem in ipsam nisi beatae.',1,'1970-09-06 11:39:52','1989-10-02 00:44:21'),(109,'Canon EOS R50',76082,23,'https://via.placeholder.com/640x480.png/00aa11?text=technics+quo','Magnam magnam minima numquam non quo ut aut. Dignissimos aliquid explicabo nemo minima ratione voluptatem quasi. Itaque cum dicta magni et debitis odit nihil.',0,'2010-12-14 03:40:19','1988-03-13 02:19:37'),(110,'Canon EOS R50',94967,36,'https://via.placeholder.com/640x480.png/001111?text=technics+deserunt','Quaerat tempora eos blanditiis eos. Quaerat quam dolore in sunt. Consequuntur placeat nulla maiores numquam nulla. Eius impedit labore eum sunt eum occaecati id atque.',1,'1985-03-15 22:13:55','1982-02-12 19:26:10'),(111,'Apple Watch Series 11',132638,48,'https://via.placeholder.com/640x480.png/004411?text=technics+consequatur','Voluptatibus praesentium sit voluptas et. Soluta iure enim inventore illo qui.',1,'2009-10-03 16:29:16','2025-04-06 13:27:47');
/*!40000 ALTER TABLE `core_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_profiles`
--

DROP TABLE IF EXISTS `core_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `core_profiles_user_id_unique` (`user_id`),
  CONSTRAINT `core_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `core_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_profiles`
--

LOCK TABLES `core_profiles` WRITE;
/*!40000 ALTER TABLE `core_profiles` DISABLE KEYS */;
INSERT INTO `core_profiles` VALUES (1,1,'+1234567890','Head Admin & Coordinator','123 School Rd'),(2,2,'+1987654321','English & Philosophy Teacher','456 Poetry Ln'),(3,3,'+1122334455','Head of Science Department','789 Science Way'),(4,4,'+1555666777','High school senior with great responsibility','20 Ingram St'),(5,5,'+1999888777','Top student of class 2026','10 Gryffindor Tower');
/*!40000 ALTER TABLE `core_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_results`
--

DROP TABLE IF EXISTS `core_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_results` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) unsigned NOT NULL,
  `course_id` bigint(20) unsigned NOT NULL,
  `marks_obtained` decimal(5,2) NOT NULL,
  `grade` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `core_results_student_id_foreign` (`student_id`),
  KEY `core_results_course_id_foreign` (`course_id`),
  CONSTRAINT `core_results_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `core_courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `core_results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `core_students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_results`
--

LOCK TABLES `core_results` WRITE;
/*!40000 ALTER TABLE `core_results` DISABLE KEYS */;
INSERT INTO `core_results` VALUES (1,1,1,88.50,'A'),(2,2,1,99.00,'A+'),(3,2,2,100.00,'A+');
/*!40000 ALTER TABLE `core_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_roles`
--

DROP TABLE IF EXISTS `core_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_roles`
--

LOCK TABLES `core_roles` WRITE;
/*!40000 ALTER TABLE `core_roles` DISABLE KEYS */;
INSERT INTO `core_roles` VALUES (2,'Super Admin','Has full access to the entire system','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(3,'Admin','Manages users and system settings','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(4,'Manager','Manages departments and reports','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(5,'HR Manager','Handles employee management','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(6,'Accountant','Manages financial records','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(7,'Cashier','Handles sales transactions','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(8,'Sales Executive','Manages customer sales','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(9,'Marketing Executive','Promotes products and services','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(10,'Purchase Officer','Manages product purchasing','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(11,'Inventory Manager','Maintains stock and inventory','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(12,'Warehouse Manager','Controls warehouse operations','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(13,'Customer Support','Provides customer assistance','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(14,'Receptionist','Handles front desk activities','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(15,'Teacher','Manages classes and students','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(16,'Student','Can access learning materials','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(17,'Vendor','Supplies products to the company','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(18,'Supplier','Provides raw materials','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(19,'Delivery Man','Delivers customer orders','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(20,'Editor','Can edit website or blog content','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(21,'Guest','Has read-only access to public resources','2026-08-01 12:45:58','2026-08-01 12:45:58',NULL),(22,'Super Admin','Has full access to the entire system','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(23,'Admin','Manages users and system settings','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(24,'Manager','Manages departments and reports','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(25,'HR Manager','Handles employee management','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(26,'Accountant','Manages financial records','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(27,'Cashier','Handles sales transactions','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(28,'Sales Executive','Manages customer sales','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(29,'Marketing Executive','Promotes products and services','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(30,'Purchase Officer','Manages product purchasing','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(31,'Inventory Manager','Maintains stock and inventory','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(32,'Warehouse Manager','Controls warehouse operations','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(33,'Customer Support','Provides customer assistance','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(34,'Receptionist','Handles front desk activities','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(35,'Teacher','Manages classes and students','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(36,'Student','Can access learning materials','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(37,'Vendor','Supplies products to the company','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(38,'Supplier','Provides raw materials','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(39,'Delivery Man','Delivers customer orders','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL),(41,'Guest','Has read-only access to public resources','2026-08-01 12:46:18','2026-08-01 12:46:18',NULL);
/*!40000 ALTER TABLE `core_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_sessions`
--

DROP TABLE IF EXISTS `core_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `core_sessions_user_id_index` (`user_id`),
  KEY `core_sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_sessions`
--

LOCK TABLES `core_sessions` WRITE;
/*!40000 ALTER TABLE `core_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_students`
--

DROP TABLE IF EXISTS `core_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_number` varchar(100) DEFAULT NULL,
  `grade_lavel` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_students`
--

LOCK TABLES `core_students` WRITE;
/*!40000 ALTER TABLE `core_students` DISABLE KEYS */;
INSERT INTO `core_students` VALUES (1,'Jaunita Emard','419-885-4686','monahan.demetrius@pagac.com','2020','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2005-11-14 10:59:43','2026-08-02 23:09:02',NULL,5,'001','12'),(2,'Athena Lubowitz','+1.405.673.8625','maximillia81@krajcik.biz','2024','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1978-07-17 18:37:15','2026-08-02 23:07:44',NULL,6,'002','11'),(3,'Mrs. Amy Heathcote','(435) 582-8650','udouglas@yahoo.com','2022','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2015-07-16 23:51:12','1987-07-05 01:00:59',NULL,7,'003','11'),(4,'Prof. Kailyn Veum PhD','580.214.6968','walsh.francesco@schneider.com','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2011-05-25 19:37:03','2024-01-18 22:04:12',NULL,8,'004','12'),(5,'Kristy Quigley','1-609-966-0864','joana30@gmail.com','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1972-09-03 11:15:55','1972-06-02 09:09:09',NULL,9,'005','12'),(6,'Ms. Maryjane Langworth V','1-423-708-7472','marks.kyleigh@yahoo.com','2024','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2004-06-24 16:45:02','2007-03-03 11:28:55',NULL,NULL,NULL,'12'),(7,'Delfina Collier PhD','1-845-582-2965','antonette54@oreilly.com','2021','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1998-01-24 17:16:42','2025-03-08 07:39:35',NULL,NULL,NULL,NULL),(8,'Prof. Keanu Welch','+1.706.502.4633','ezemlak@hotmail.com','2020','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2013-09-14 18:24:26','1992-12-08 05:38:16',NULL,NULL,NULL,NULL),(9,'Katharina Glover','440-797-1756','leonora.watsica@yahoo.com','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1988-07-20 10:15:53','2024-05-16 12:08:40',NULL,NULL,NULL,NULL),(10,'Dr. Devonte Kling Jr.','1-937-565-0793','nhills@hirthe.com','2023','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','2019-06-06 01:20:12','1972-12-10 20:43:45',NULL,NULL,NULL,NULL),(11,'Brad Smitham','(820) 546-6495','allie.bartoletti@steuber.com','2020','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','2012-03-03 07:47:48','1983-02-23 03:32:59',NULL,NULL,NULL,NULL),(12,'Rosalee Wisoky IV','(520) 461-7322','pablo.jast@yahoo.com','2020','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1987-01-23 09:03:45','1992-03-29 10:08:43',NULL,NULL,NULL,NULL),(13,'Destini Hane','+1 (401) 289-5659','lessie89@wiegand.info','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1989-04-15 13:59:00','2004-12-29 15:02:02',NULL,NULL,NULL,NULL),(14,'Providenci Howell Jr.','1-937-450-7243','knikolaus@yahoo.com','2020','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','2006-03-02 10:36:00','1980-08-23 22:49:29',NULL,NULL,NULL,NULL),(15,'Dr. Stephany Leuschke PhD','(432) 560-0755','micheal10@yahoo.com','2022','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1972-07-02 21:21:40','2003-03-31 14:14:38',NULL,NULL,NULL,NULL),(16,'Liana Halvorson','+1-786-920-1464','miller.alayna@yahoo.com','2021','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1972-09-05 02:15:38','1991-12-28 02:11:52',NULL,NULL,NULL,NULL),(17,'Alicia Haley','1-563-878-0155','abernathy.tina@armstrong.info','2022','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','2020-04-04 06:26:56','2005-10-21 11:55:49',NULL,NULL,NULL,NULL),(18,'Michale O\'Connell','+1-386-439-7903','opagac@hotmail.com','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2001-11-07 04:53:59','2004-02-11 17:32:14',NULL,NULL,NULL,NULL),(19,'Thomas Hauck','(706) 771-9216','rylan81@rowe.com','2024','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1979-12-07 07:18:28','2000-02-23 00:48:46',NULL,NULL,NULL,NULL),(20,'Ruthie Denesik','862.321.1984','glover.santa@yahoo.com','2021','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','2001-02-13 01:59:11','1990-08-06 10:02:10',NULL,NULL,NULL,NULL),(21,'Lukas Predovic IV','+1-240-364-1450','kunze.tiara@yahoo.com','2023','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1989-09-24 04:52:33','2019-07-10 16:50:53',NULL,NULL,NULL,NULL),(22,'Dr. Claudine Altenwerth I','+1 (574) 563-0616','jaylon.hessel@yahoo.com','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1998-06-08 22:10:57','1990-08-02 19:48:54',NULL,NULL,NULL,NULL),(23,'Prof. Javier Fisher Jr.','1-484-922-5106','jairo.runte@hotmail.com','2021','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1980-07-24 11:57:33','1976-09-19 02:18:59',NULL,NULL,NULL,NULL),(24,'Jeremie Upton','762.754.6339','clarissa29@heaney.com','2021','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1976-02-01 00:59:30','1996-01-27 12:47:54',NULL,NULL,NULL,NULL),(25,'Chad Dooley','1-832-428-3265','colten.okeefe@yahoo.com','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','2023-06-03 09:42:53','2012-10-02 11:24:03',NULL,NULL,NULL,NULL),(26,'Miss Mozelle Fay Sr.','1-585-294-2202','dashawn.kuhlman@jacobson.biz','2023','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1972-12-25 08:26:01','1990-11-07 09:31:23',NULL,NULL,NULL,NULL),(27,'Bill Emard III','+17243075758','cindy40@streich.com','2024','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1998-04-05 23:25:17','1989-06-01 18:06:57',NULL,NULL,NULL,NULL),(28,'Kelli Streich','641-613-6402','jennifer.mertz@rogahn.biz','2024','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1970-12-24 07:52:27','1992-07-19 10:33:45',NULL,NULL,NULL,NULL),(29,'Bradley Satterfield','+1.636.652.3483','maximo19@fay.net','2022','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2018-10-30 10:29:09','2020-07-14 12:50:52',NULL,NULL,NULL,NULL),(30,'Miss Kristina Jakubowski','+1.929.803.4125','jeffry67@gmail.com','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1990-05-20 05:00:32','1989-03-12 11:07:16',NULL,NULL,NULL,NULL),(31,'Patience Kling PhD','+1 (612) 974-2215','nlakin@kuvalis.com','2022','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1974-08-26 06:48:00','1998-10-28 18:34:12',NULL,NULL,NULL,NULL),(32,'Mrs. Gabrielle Daugherty','551-689-6439','kshlerin.paul@denesik.com','2020','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1995-06-09 15:53:23','2005-07-23 11:18:54',NULL,NULL,NULL,NULL),(33,'Mr. Lyric Kuhn','(458) 759-6512','austyn14@yahoo.com','2024','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1994-10-02 16:39:32','2015-03-29 01:53:51',NULL,NULL,NULL,NULL),(34,'Marlon Strosin','740.353.9296','kaylin06@kling.net','2021','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2019-11-17 04:15:50','2010-09-16 01:37:16',NULL,NULL,NULL,NULL),(35,'Celia Ankunding','458.283.7675','magnolia46@block.com','2020','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2018-02-16 11:16:36','1987-05-30 03:02:41',NULL,NULL,NULL,NULL),(36,'Mrs. Rosanna Jenkins IV','+1-539-313-2251','igerlach@larkin.org','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1984-03-14 18:04:01','2008-09-20 10:50:56',NULL,NULL,NULL,NULL),(37,'Elizabeth Reichert','+1-406-258-5631','whitney.jacobi@gmail.com','2021','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','2001-04-08 06:51:57','1993-02-23 19:40:07',NULL,NULL,NULL,NULL),(38,'Dr. Dalton Corwin IV','1-341-581-5630','sterling.ward@hickle.org','2023','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2014-01-12 11:26:52','1982-07-27 11:58:50',NULL,NULL,NULL,NULL),(39,'Armand Braun','+1.248.579.7311','nicolas.howell@mayert.info','2021','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1993-03-29 06:03:54','2006-10-01 07:59:26',NULL,NULL,NULL,NULL),(40,'Prof. Jeffery Kozey','+1 (575) 342-0930','pouros.ulises@gmail.com','2020','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1998-01-22 04:43:56','1998-01-03 14:14:06',NULL,NULL,NULL,NULL),(41,'Dr. Dylan Stokes II','1-863-977-0496','gcrona@conn.com','2024','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1978-01-11 03:24:17','2003-09-05 08:34:11',NULL,NULL,NULL,NULL),(42,'Domenick Graham','1-332-523-1092','pietro.sipes@mills.biz','2021','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1995-03-06 16:26:54','2000-02-01 08:01:06',NULL,NULL,NULL,NULL),(43,'Lorine Reynolds PhD','1-513-491-5614','amueller@davis.com','2023','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2008-04-10 05:54:39','1972-11-30 02:18:15',NULL,NULL,NULL,NULL),(44,'Miss Tessie Anderson PhD','1-430-420-5855','ernser.mariam@legros.com','2024','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1997-08-25 03:21:33','1979-11-07 19:22:29',NULL,NULL,NULL,NULL),(45,'Prof. Gregorio Mills','+18314749645','jast.laron@yahoo.com','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1997-04-10 12:55:49','2011-01-06 22:37:51',NULL,NULL,NULL,NULL),(46,'Murl Monahan DVM','+1-732-853-6143','mertz.billie@gmail.com','2024','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','2003-02-09 10:03:44','2022-11-23 21:56:28',NULL,NULL,NULL,NULL),(47,'Irving Eichmann','1-470-854-8229','prince.heathcote@gmail.com','2021','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','1998-08-12 13:49:23','1976-05-10 22:26:19',NULL,NULL,NULL,NULL),(48,'Terrance Hilpert','571-853-4437','mozelle53@gmail.com','2020','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','2016-10-24 02:55:07','2003-02-22 21:14:43',NULL,NULL,NULL,NULL),(49,'Mr. Tillman Upton MD','(754) 434-3555','kihn.katharina@gmail.com','2025','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','0','2012-02-25 07:41:25','1999-07-28 23:32:26',NULL,NULL,NULL,NULL),(50,'Kamille Swaniawski','+1 (916) 685-8099','ocie.steuber@bailey.com','2020','https://images.unsplash.com/photo-1773332585698-cba3c91b73e4?ixid=M3w4MjcwNjd8MXwxfHNlYXJjaHwxfHxzdHVkZW50fGVufDB8fHx8MTc4NTczMDkyNHww&ixlib=rb-4.1.0&w=500&h=500&fit=max&q=80','1','1977-01-23 15:58:17','1996-11-14 22:47:06',NULL,NULL,NULL,NULL),(51,'Rashed','01222266','ashik@gmail.com','','Rashed1785737590tmp','1','2026-08-03 00:13:10','2026-08-03 00:13:10',NULL,NULL,NULL,NULL),(52,'Zahir Martin','+1 (756) 235-3889','sudih@mailinator.com','','Zahir Martin1785737762tmp','0','2026-08-03 00:16:02','2026-08-03 00:16:02',NULL,NULL,NULL,NULL),(53,'Roanna Valencia','+1 (913) 452-9209','motikok@mailinator.com','','Roanna Valencia1785737898.jpg','0','2026-08-03 00:18:18','2026-08-03 00:18:18',NULL,NULL,NULL,NULL),(54,'Wyoming Barker','+1 (889) 453-3856','gyqor@mailinator.com','2025','Wyoming Barker1785737949.jpg','0','2026-08-03 00:19:09','2026-08-03 21:49:25',NULL,NULL,NULL,NULL),(55,'Dr. Adaline Schmeler','269-286-7550','kailey.jerde@kreiger.com','2020','https://via.placeholder.com/640x480.png/002233?text=student+dolorem','0','2011-06-15 06:14:44','2005-01-30 15:19:26',NULL,NULL,NULL,NULL),(56,'Stephon Auer I','+1.321.583.6951','oral18@gmail.com','2024','https://via.placeholder.com/640x480.png/00bb99?text=student+ex','0','1985-02-04 23:21:37','1993-03-26 11:07:25',NULL,NULL,NULL,NULL),(57,'Neoma Jacobi','(901) 312-7797','ally.huel@fritsch.com','2024','https://via.placeholder.com/640x480.png/009933?text=student+aut','1','2022-08-12 03:45:01','1980-07-12 23:00:26',NULL,NULL,NULL,NULL),(58,'Ida Berge','1-360-224-4212','cristal72@yahoo.com','2024','https://via.placeholder.com/640x480.png/0055ee?text=student+aperiam','0','1998-07-24 09:26:24','2017-04-21 18:04:19',NULL,NULL,NULL,NULL),(59,'Dr. Hollis Hansen','206.353.7418','ryann44@hotmail.com','2025','https://via.placeholder.com/640x480.png/00ffbb?text=student+esse','0','1999-03-25 12:32:39','1970-06-12 11:07:20',NULL,NULL,NULL,NULL),(60,'Guiseppe Kutch','248-396-1220','lilly10@sipes.com','2020','https://via.placeholder.com/640x480.png/00cccc?text=student+sit','0','1975-07-04 19:52:18','2016-11-08 17:19:47',NULL,NULL,NULL,NULL),(61,'Eloy Altenwerth','+1 (850) 400-9792','skub@kub.com','2023','https://via.placeholder.com/640x480.png/007755?text=student+libero','1','1970-05-26 12:35:14','2020-11-19 10:13:09',NULL,NULL,NULL,NULL),(62,'Jamison Becker','+15808464963','allene36@nicolas.info','2022','https://via.placeholder.com/640x480.png/007722?text=student+neque','1','2005-03-25 06:07:26','1985-10-02 12:35:09',NULL,NULL,NULL,NULL),(63,'Jody Turcotte II','+1-754-323-5813','aniyah.jacobs@stoltenberg.com','2021','https://via.placeholder.com/640x480.png/00bb00?text=student+ea','1','1977-02-26 01:43:06','1989-08-17 16:08:56',NULL,NULL,NULL,NULL),(64,'Dr. Yasmin Koss','607.277.9930','kailee62@yahoo.com','2021','https://via.placeholder.com/640x480.png/002266?text=student+alias','0','1970-11-23 06:44:18','1989-07-16 07:14:12',NULL,NULL,NULL,NULL),(65,'Marjory Crona V','+1 (986) 509-8285','emmalee.kub@yahoo.com','2021','https://via.placeholder.com/640x480.png/00dd66?text=student+iusto','0','2010-01-10 03:38:31','2007-12-13 20:59:02',NULL,NULL,NULL,NULL),(66,'Dr. Helga Raynor','574.799.7017','klein.lexie@jaskolski.info','2021','https://via.placeholder.com/640x480.png/00ff77?text=student+corporis','0','2000-08-21 20:55:06','1980-07-22 23:18:18',NULL,NULL,NULL,NULL),(67,'Maida Kerluke','(207) 776-4928','alva19@hotmail.com','2021','https://via.placeholder.com/640x480.png/00ddff?text=student+qui','1','2017-10-23 22:07:48','1990-07-31 15:53:28',NULL,NULL,NULL,NULL),(68,'Ethyl Langworth','(616) 701-2449','brionna08@yahoo.com','2024','https://via.placeholder.com/640x480.png/00ccdd?text=student+officiis','1','1990-08-20 23:19:21','2011-04-11 08:55:57',NULL,NULL,NULL,NULL),(69,'Mckenzie Streich','1-830-596-1038','nina.aufderhar@powlowski.info','2025','https://via.placeholder.com/640x480.png/007755?text=student+repellendus','0','1976-02-16 17:47:26','1970-05-13 03:58:53',NULL,NULL,NULL,NULL),(70,'Jamaal Abbott Sr.','534-598-6035','jacynthe46@yahoo.com','2022','https://via.placeholder.com/640x480.png/00ffbb?text=student+odio','1','1982-01-24 12:17:32','2015-08-13 00:12:52',NULL,NULL,NULL,NULL),(71,'Jarrett Corkery','+1-341-625-0023','oswaldo.steuber@ernser.biz','2022','https://via.placeholder.com/640x480.png/00dd88?text=student+quo','1','2015-06-25 23:53:45','2010-08-08 13:43:09',NULL,NULL,NULL,NULL),(72,'Alexandrine Reichert V','+1.574.492.4643','curt75@thompson.biz','2024','https://via.placeholder.com/640x480.png/002277?text=student+sit','0','1997-09-05 17:39:41','2001-01-22 02:20:09',NULL,NULL,NULL,NULL),(73,'Leda Heidenreich','+18288130113','armstrong.sabrina@buckridge.org','2021','https://via.placeholder.com/640x480.png/0011cc?text=student+sunt','1','1998-08-19 13:36:21','1994-05-06 22:25:17',NULL,NULL,NULL,NULL),(74,'Beaulah Lebsack','(510) 729-2875','monahan.stephon@morissette.com','2020','https://via.placeholder.com/640x480.png/0055dd?text=student+numquam','0','2004-06-08 12:38:50','1995-01-18 11:55:39',NULL,NULL,NULL,NULL),(75,'Cristopher Bashirian','+1.641.672.1647','erdman.jevon@hotmail.com','2020','https://via.placeholder.com/640x480.png/0044aa?text=student+fugit','1','2021-03-04 11:25:00','2008-06-03 04:18:49',NULL,NULL,NULL,NULL),(76,'Ms. Rosalee Schneider','828.318.7771','hill.cyril@vandervort.com','2020','https://via.placeholder.com/640x480.png/00ffaa?text=student+autem','1','2019-10-03 03:35:02','1980-03-27 11:51:33',NULL,NULL,NULL,NULL),(77,'Augusta Donnelly','480.604.7121','precious66@walker.com','2023','https://via.placeholder.com/640x480.png/00ccbb?text=student+ipsa','1','1971-02-19 13:43:54','1976-09-20 09:25:35',NULL,NULL,NULL,NULL),(78,'Lisandro Johnston','972.247.6709','tschneider@hotmail.com','2024','https://via.placeholder.com/640x480.png/00aadd?text=student+placeat','1','1998-06-11 11:57:42','1978-11-12 07:29:36',NULL,NULL,NULL,NULL),(79,'Buford Rowe','(539) 317-7778','jeromy37@hahn.com','2021','https://via.placeholder.com/640x480.png/00dd00?text=student+error','0','2001-08-29 22:10:02','2009-05-29 00:34:43',NULL,NULL,NULL,NULL),(80,'Prof. Abelardo Baumbach MD','(650) 388-8767','ukohler@mccullough.com','2021','https://via.placeholder.com/640x480.png/0044bb?text=student+eum','0','1988-04-01 03:28:04','2008-07-09 05:05:31',NULL,NULL,NULL,NULL),(81,'Nicole Kessler','+16106396545','concepcion41@gmail.com','2020','https://via.placeholder.com/640x480.png/009933?text=student+ut','0','1984-11-29 19:30:35','2002-08-17 02:01:57',NULL,NULL,NULL,NULL),(82,'Mr. Titus Krajcik MD','985.391.0400','cary.wehner@wisoky.info','2021','https://via.placeholder.com/640x480.png/00aa44?text=student+accusantium','0','1972-08-31 10:25:25','1989-08-13 17:21:01',NULL,NULL,NULL,NULL),(83,'Kenyatta Gusikowski','502.646.5405','saul18@koch.com','2024','https://via.placeholder.com/640x480.png/001155?text=student+ea','1','1978-09-10 13:56:37','1991-05-24 07:56:19',NULL,NULL,NULL,NULL),(84,'Destany Wolff','1-303-557-9901','icartwright@gmail.com','2021','https://via.placeholder.com/640x480.png/00bbee?text=student+optio','0','2005-07-31 17:25:14','2000-12-17 04:24:59',NULL,NULL,NULL,NULL),(85,'Liana Fritsch','484.288.3704','spencer.jaleel@steuber.com','2024','https://via.placeholder.com/640x480.png/0077ff?text=student+iusto','0','1989-05-14 04:24:12','1972-05-10 13:58:48',NULL,NULL,NULL,NULL),(86,'Mrs. Belle Langosh I','+1.603.827.7441','kwaelchi@gmail.com','2022','https://via.placeholder.com/640x480.png/00aa00?text=student+non','1','1980-07-03 02:20:36','1994-06-30 17:31:33',NULL,NULL,NULL,NULL),(87,'Florida Beahan','253.344.5616','cassie.senger@yahoo.com','2023','https://via.placeholder.com/640x480.png/00dd44?text=student+nisi','1','1975-06-26 13:40:36','2022-06-12 04:56:02',NULL,NULL,NULL,NULL),(88,'Luisa Ledner','+1-661-404-3177','lehner.aileen@davis.org','2022','https://via.placeholder.com/640x480.png/0099ee?text=student+modi','1','1991-12-11 06:19:50','1994-02-01 19:55:04',NULL,NULL,NULL,NULL),(89,'Mrs. Krystina Osinski V','(562) 430-5216','emilia54@wintheiser.com','2023','https://via.placeholder.com/640x480.png/00ccee?text=student+rerum','0','2016-02-08 21:23:50','1972-02-25 09:24:57',NULL,NULL,NULL,NULL),(90,'Prof. Adolfo Abbott III','781.640.0837','rcarter@yahoo.com','2021','https://via.placeholder.com/640x480.png/0099bb?text=student+aliquam','1','2000-08-19 19:32:09','1996-07-26 17:31:31',NULL,NULL,NULL,NULL),(91,'Caterina Barton','+1 (754) 403-8848','madge.barton@ondricka.biz','2025','https://via.placeholder.com/640x480.png/0022cc?text=student+voluptatibus','0','1978-08-27 16:13:29','2000-11-17 18:04:53',NULL,NULL,NULL,NULL),(92,'Ashlynn Carter','234-883-1141','mozelle.mcglynn@hartmann.com','2020','https://via.placeholder.com/640x480.png/00ccff?text=student+dolor','0','2015-03-23 00:56:42','1977-05-20 01:09:42',NULL,NULL,NULL,NULL),(93,'Vilma Harvey I','+1.346.679.0575','welch.vance@gmail.com','2021','https://via.placeholder.com/640x480.png/0000cc?text=student+aperiam','0','2021-03-31 20:49:27','2003-06-27 20:33:51',NULL,NULL,NULL,NULL),(94,'Miss Ciara Dooley','678-576-9380','yokeefe@gmail.com','2025','https://via.placeholder.com/640x480.png/0022cc?text=student+ab','0','1990-09-06 12:11:14','2011-08-21 04:13:05',NULL,NULL,NULL,NULL),(95,'Lane Abshire','+1-323-886-1053','jarod02@hotmail.com','2023','https://via.placeholder.com/640x480.png/00ddbb?text=student+adipisci','0','1980-03-08 22:36:44','1995-10-22 11:42:53',NULL,NULL,NULL,NULL),(96,'Maida Rolfson PhD','+1-603-775-9183','diamond80@hotmail.com','2025','https://via.placeholder.com/640x480.png/00ccbb?text=student+nostrum','0','2008-05-28 13:04:21','2006-11-30 11:09:29',NULL,NULL,NULL,NULL),(97,'Dina Muller','959.638.7664','ezekiel00@gmail.com','2020','https://via.placeholder.com/640x480.png/00aa22?text=student+ea','1','2023-08-10 12:59:08','2024-05-01 21:21:15',NULL,NULL,NULL,NULL),(98,'Mr. Celestino Hagenes IV','+1-307-443-4728','brennon.kohler@herman.com','2020','https://via.placeholder.com/640x480.png/009900?text=student+consectetur','0','2014-11-11 03:46:06','1980-12-12 14:24:21',NULL,NULL,NULL,NULL),(99,'Dr. Arnold Hammes','+1-747-420-1564','tromp.aiden@thiel.com','2022','https://via.placeholder.com/640x480.png/008844?text=student+et','0','1990-11-14 16:15:14','1995-05-20 06:48:19',NULL,NULL,NULL,NULL),(100,'Katelynn Greenholt','425.650.6557','ukunze@hahn.com','2024','https://via.placeholder.com/640x480.png/00aaff?text=student+blanditiis','1','2011-07-17 01:06:20','2005-03-21 15:00:29',NULL,NULL,NULL,NULL),(101,'Macey Pagac I','+1-463-738-8468','linnea.turner@kemmer.net','2021','https://via.placeholder.com/640x480.png/0000ff?text=student+quibusdam','0','1994-09-06 05:04:39','2015-12-25 14:35:56',NULL,NULL,NULL,NULL),(102,'Mr. Rudolph Reichel','978.673.0624','elda.hahn@hotmail.com','2025','https://via.placeholder.com/640x480.png/00dd00?text=student+consequuntur','1','1970-02-27 03:00:56','2024-11-26 07:05:04',NULL,NULL,NULL,NULL),(103,'Karianne Koelpin','678-766-0551','flatley.melvin@hansen.net','2022','https://via.placeholder.com/640x480.png/00bbcc?text=student+et','0','2020-07-13 18:01:30','1973-06-17 01:42:12',NULL,NULL,NULL,NULL),(104,'Jeromy Bruen','+1 (951) 384-6325','kaci.sauer@hotmail.com','2022','https://via.placeholder.com/640x480.png/008822?text=student+quisquam','1','1975-05-01 22:03:24','1984-03-08 16:53:41',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `core_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_subjects`
--

DROP TABLE IF EXISTS `core_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_subjects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `core_subjects_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_subjects`
--

LOCK TABLES `core_subjects` WRITE;
/*!40000 ALTER TABLE `core_subjects` DISABLE KEYS */;
INSERT INTO `core_subjects` VALUES (1,'English Literature','ENG101'),(2,'Physics','PHY201');
/*!40000 ALTER TABLE `core_subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_teachers`
--

DROP TABLE IF EXISTS `core_teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_teachers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `employee_code` varchar(50) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `core_teachers_user_id_unique` (`user_id`),
  UNIQUE KEY `core_teachers_employee_code_unique` (`employee_code`),
  CONSTRAINT `core_teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `core_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_teachers`
--

LOCK TABLES `core_teachers` WRITE;
/*!40000 ALTER TABLE `core_teachers` DISABLE KEYS */;
INSERT INTO `core_teachers` VALUES (1,2,'EMP-001','Literature'),(2,3,'EMP-002','Advanced Physics');
/*!40000 ALTER TABLE `core_teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_users`
--

DROP TABLE IF EXISTS `core_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `core_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_users`
--

LOCK TABLES `core_users` WRITE;
/*!40000 ALTER TABLE `core_users` DISABLE KEYS */;
INSERT INTO `core_users` VALUES (1,'Sarah Connor','sarah.admin@school.com',NULL,NULL,NULL,NULL,NULL,1,'active'),(2,'John Keating','keating.teacher@school.com',NULL,NULL,NULL,NULL,NULL,2,'inactive'),(3,'Minerva McGonagall','mcgonagall.teacher@school.com',NULL,NULL,NULL,NULL,NULL,2,'active'),(4,'Peter Parker','peter.student@school.com',NULL,NULL,NULL,NULL,NULL,3,'active'),(5,'Hermione Granger','hermione.student@school.com',NULL,NULL,NULL,NULL,NULL,3,'inactive'),(6,'Sterling Botsford','issac.bogan@example.org','2026-08-05 22:12:40','$2y$12$JONqhWmcWlAa7HsuyfNne.CZFUw1YovWoPRVrczyEBJvu4vM7MeAi','4O5E0x5gmI','2026-08-05 22:12:42','2026-08-05 22:12:42',1,'inactive'),(7,'Elmo Pfannerstill','pansy.roob@example.net','2026-08-05 22:12:41','$2y$12$qQGK6SD.f7pbcFWMaGQRG.GWQywxTeCar7VLUegKyI1kffxQ6B5zG','R8XmkjPHQP','2026-08-05 22:12:42','2026-08-05 22:12:42',4,'active'),(8,'Dr. Darrion Grimes','hayden.ankunding@example.com','2026-08-05 22:12:41','$2y$12$RKnTQWPnvlsoN0K6l1iCQeFHBJiLC45fQFauTENNVB/xlYCzSaxyC','JynQ5zO8mH','2026-08-05 22:12:42','2026-08-05 22:12:42',1,'inactive'),(9,'Kody Crona','lemke.nikolas@example.com','2026-08-05 22:12:41','$2y$12$599pnMzu9wp5suAeYtMIvOz8G1yozW2JhPsywvWC7Vca.WdieUchW','zGeDTGR9pH','2026-08-05 22:12:42','2026-08-05 22:12:42',4,'inactive'),(10,'Andrew Effertz DDS','hward@example.com','2026-08-05 22:12:41','$2y$12$ycjFLbBWkwB7U6DzOe4jIuLWQ4TM/CXlrw4Llbv30pm4tXB.yelfS','RPoXi4lOLQ','2026-08-05 22:12:42','2026-08-05 22:12:42',3,'inactive');
/*!40000 ALTER TABLE `core_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-06 12:56:57
