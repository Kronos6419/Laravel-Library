-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2026 at 07:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `user_id`, `title`, `author`, `genre`, `description`, `cover_image`, `created_at`, `updated_at`) VALUES
(1, 2, 'The Lord of the Rings', 'J.R.R. Tolkien', 'Fantasy', 'An epic high-fantasy novel following the hobbit Frodo Baggins and the Fellowship on a quest to destroy the One Ring and defeat the Dark Lord Sauron. A foundational work of modern fantasy literature.', 'book_covers/eTZaYcFXanWrrZ9sag45BSAuP6bKBgvbjVm4mXH2.jpg', '2026-06-28 16:16:20', '2026-06-28 16:29:33'),
(2, 2, 'The Name of the Wind', 'Patrick Rothfuss', 'Fantasy', 'The first book in the Kingkiller Chronicle, told in the voice of Kvothe — a legendary figure recounting his extraordinary life from gifted student at a magical university to celebrated adventurer.', 'book_covers/F3v7i4kCFoZGWgdm4xVIV4VDVmLkfGSMOW0wCk9b.jpg', '2026-06-28 16:16:20', '2026-06-28 16:29:17'),
(3, 3, 'A Wizard of Earthsea', 'Ursula K. Le Guin', 'Fantasy', 'A young boy with extraordinary magical talent attends a school for wizards, where his pride leads him to unleash a terrible shadow upon the world. A classic coming-of-age tale set in the archipelago of Earthsea.', 'book_covers/chKHXtVAK34ELSdHgnaL17k09lgk3tGn8QeUenj2.jpg', '2026-06-28 16:16:20', '2026-06-28 16:30:45'),
(4, 3, 'The Way of Kings', 'Brandon Sanderson', 'Fantasy', 'The opening volume of the Stormlight Archive, set in a world battered by devastating storms. Three characters are drawn together by ancient forces in this sweeping epic of war, politics, and magic.', 'book_covers/AnNFsBnwAYPqAHWXobHjBwUrHurkV4HcqZhncz1Q.jpg', '2026-06-28 16:16:20', '2026-06-28 16:31:28'),
(5, 4, 'Dune', 'Frank Herbert', 'Science Fiction', 'Set on the desert planet Arrakis, the only source of the most valuable substance in the universe. A sweeping saga of politics, religion, and ecology following Paul Atreides as his family assumes control of the planet.', 'book_covers/Pm9XQbi1fhgWVvb6S0F5ciCzWHOfCMc4gKpXKb3P.jpg', '2026-06-28 16:16:20', '2026-06-28 16:32:09'),
(6, 4, 'Neuromancer', 'William Gibson', 'Science Fiction', 'The novel that defined cyberpunk. A washed-up hacker is hired to pull off the ultimate heist, navigating a future of corporate intrigue, artificial intelligence, and virtual reality.', 'book_covers/E4bi04HCWY3lSfTF6lQkCPFIdYLvJg28hQtsU1zb.jpg', '2026-06-28 16:16:20', '2026-06-28 16:32:48'),
(7, 5, 'The Left Hand of Darkness', 'Ursula K. Le Guin', 'Science Fiction', 'A human envoy travels to the planet Gethen, whose inhabitants have no fixed biological sex. A landmark work exploring gender, politics, and humanity through the lens of an alien world.', 'book_covers/dvBU9xrgPmzI3jtEZ9YZjqsMlNgSaEfVc16TVWDR.jpg', '2026-06-28 16:16:20', '2026-06-28 16:33:22'),
(8, 5, 'Ender\'s Game', 'Orson Scott Card', 'Science Fiction', 'Gifted child Andrew Wiggin is recruited to a military school in space to prepare for an alien invasion. A gripping exploration of genius, manipulation, and the moral cost of war told through the eyes of a child.', 'book_covers/jE5haiKFiOdnnoQywf1q0Ig2lHuAfc8y0T5cUuX9.jpg', '2026-06-28 16:16:20', '2026-06-28 16:34:07'),
(9, 2, 'And Then There Were None', 'Agatha Christie', 'Mystery', 'Ten strangers are lured to an isolated island and murdered one by one. With no apparent killer among them, the survivors must unravel the mystery before they too are claimed. The best-selling mystery novel of all time.', 'book_covers/NiOqQ3tpWecNFyiJhfBKPJlMJIn6URk15ziwrgLZ.jpg', '2026-06-28 16:16:20', '2026-06-28 16:34:42'),
(10, 3, 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 'Mystery', 'A disgraced journalist and a brilliant hacker investigate the decades-old disappearance of a wealthy patriarch\'s niece, uncovering dark family secrets and a trail of violence in contemporary Sweden.', 'book_covers/LnHtorQMMhpMVHPVafPr4UXjgzlRfAfC2pwslOHN.jpg', '2026-06-28 16:16:20', '2026-06-28 16:35:11'),
(11, 4, 'In the Woods', 'Tana French', 'Mystery', 'A Dublin detective investigating the murder of a girl on an ancient archaeological site discovers disturbing connections to a childhood incident he has never been able to fully remember.', 'book_covers/JKArZd16paSXYFPL3oGNHBmM2KybBRoUYCYtNnlp.jpg', '2026-06-28 16:16:20', '2026-06-28 16:35:35'),
(12, 5, 'The Hound of the Baskervilles', 'Arthur Conan Doyle', 'Mystery', 'Sherlock Holmes investigates the legend of a supernatural hound haunting the Baskerville family on the Devon moors. Perhaps the most celebrated mystery novel ever written, combining gothic atmosphere with brilliant deduction.', 'book_covers/zONHCCxcg8zPNFDxrKrQmFRNOeGGROtcCg6LtXvl.jpg', '2026-06-28 16:16:20', '2026-06-28 16:36:42'),
(13, 2, 'Pride and Prejudice', 'Jane Austen', 'Romance', 'The story of Elizabeth Bennet and her complicated relationship with the proud and wealthy Mr. Darcy. A sharp, witty comedy of manners that remains the most beloved romance in the English language.', 'book_covers/daumeBoESQt72YhyCTH7p07PIBQNiFlj4Z550mei.jpg', '2026-06-28 16:16:20', '2026-06-28 16:37:11'),
(14, 3, 'Outlander', 'Diana Gabaldon', 'Romance', 'A British combat nurse in 1945 is swept back in time to 1743 Scotland, caught between two worlds and two men — her twentieth-century husband and a fierce young Highland warrior.', 'book_covers/Fht7Vbhe3KYgpEOjjGRGzglKd4tAKpGnD3d0ldI4.jpg', '2026-06-28 16:16:20', '2026-06-28 16:37:54'),
(15, 4, 'Jane Eyre', 'Charlotte Bronte', 'Romance', 'An orphaned girl of strong principle finds employment as a governess at Thornfield Hall, falling in love with the mysterious Mr. Rochester while confronting the dark secret he keeps hidden.', 'book_covers/FxOBWyKVDh02sFnbLN7os1bCtBK1uh3hVLBFvn68.jpg', '2026-06-28 16:16:20', '2026-06-28 16:38:33'),
(16, 5, 'The Shining', 'Stephen King', 'Horror', 'Jack Torrance takes a job as winter caretaker of the isolated Overlook Hotel with his wife and young son Danny, who possesses a psychic ability. As winter sets in, the hotel\'s evil presence begins to consume Jack.', 'book_covers/TWKPEMPS1a7K2N9HOzc9Qtm4JSphP9wstMEqJg2Q.jpg', '2026-06-28 16:16:20', '2026-06-28 16:39:25'),
(17, 2, 'Dracula', 'Bram Stoker', 'Horror', 'The definitive vampire novel, told through journals and letters as a group of friends battle the ancient Transylvanian count who has come to England. A masterpiece of gothic horror that defined the vampire myth.', 'book_covers/4aVZeSPb2nVy0O81QmhhfQQJwnm2XbdbeLH4Ipvo.jpg', '2026-06-28 16:16:20', '2026-06-28 16:39:53'),
(18, 3, 'Frankenstein', 'Mary Shelley', 'Horror', 'Young scientist Victor Frankenstein creates a sentient creature in an unorthodox experiment. Explores themes of creation, responsibility, and the consequences of playing god. The founding text of science fiction and horror.', 'book_covers/KiIk2XAUmT2WIUh7mmYZS1AmMPetXnWgHsMX9n0T.jpg', '2026-06-28 16:16:20', '2026-06-28 16:40:24'),
(19, 4, 'Mexican Gothic', 'Silvia Moreno-Garcia', 'Horror', 'A glamorous socialite travels to the Mexican countryside to rescue her cousin, discovering the crumbling High Place estate hides dark gothic secrets that threaten to consume everyone within its walls.', 'book_covers/Mgp1jDujLjWC7Hf9VU68eGxaiCdQii1qYoL3ZmAQ.jpg', '2026-06-28 16:16:20', '2026-06-28 16:41:43'),
(20, 5, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Non-Fiction', 'A sweeping narrative of humanity\'s creation and evolution, exploring how Homo sapiens came to dominate the planet through language, agriculture, science, and the shared myths that bind societies together.', 'book_covers/VfL2WcHbx9BmgLvYIEC4kSb8xuaGhxjuwl5iR1oY.jpg', '2026-06-28 16:16:20', '2026-06-28 16:42:20'),
(21, 2, 'The Body: A Guide for Occupants', 'Bill Bryson', 'Non-Fiction', 'A witty and fascinating tour of the human body, covering everything from the skin and brain to the immune system and the mysteries of sleep. Complex science made entertaining and accessible.', 'book_covers/V7aTz2zA1os4LzKb8TjNLNaQjoPEqL6UI8mE45MY.jpg', '2026-06-28 16:16:20', '2026-06-28 16:43:11'),
(22, 3, 'Thinking, Fast and Slow', 'Daniel Kahneman', 'Non-Fiction', 'Nobel Prize-winning psychologist Daniel Kahneman explores the two systems that drive the way we think — the fast intuitive System 1 and the slow deliberate System 2 — and how they shape our decisions.', 'book_covers/U8TACmqESllknBDmyNsU2Gt49chHpvUYNMfQr8Po.jpg', '2026-06-28 16:16:20', '2026-06-28 16:43:32'),
(23, 4, 'The Diary of a Young Girl', 'Anne Frank', 'Biography', 'The wartime diary kept by Anne Frank while hiding with her family in Nazi-occupied Amsterdam. Written between 1942 and 1944, it is one of the most widely read accounts of the Holocaust.', 'book_covers/VPtL6SkqyU0GIAh0SRXRPa14y6LbFi7WiiLB2ZE0.jpg', '2026-06-28 16:16:20', '2026-06-28 16:44:08'),
(24, 5, 'Leonardo da Vinci', 'Walter Isaacson', 'Biography', 'Drawing on thousands of pages of Leonardo\'s notebooks, Isaacson weaves a narrative connecting his art to his science, showing how his insatiable curiosity made him history\'s most inspired and innovative mind.', 'book_covers/byte6htZrSAJNw9hilCdItaCnLDr8WTNM6EGw2Bg.jpg', '2026-06-28 16:16:20', '2026-06-28 16:45:12'),
(25, 2, 'Just Kids', 'Patti Smith', 'Biography', 'Patti Smith\'s memoir of her formative years in New York City with photographer Robert Mapplethorpe, tracing their deep friendship and artistic development against a transformative era in American culture.', 'book_covers/tIgrWrTGxD66neIcGaihB1c7fSXmdbc7M2fBh978.jpg', '2026-06-28 16:16:20', '2026-06-28 16:46:12'),
(26, 3, 'Leaves of Grass', 'Walt Whitman', 'Poetry', 'Whitman\'s landmark collection celebrating democracy, nature, love, and friendship. Song of Myself — its most celebrated poem — is a joyous meditation on identity and the American spirit, first published in 1855.', 'book_covers/suq07AqHed5gS2RFt3S9Dax2moOtVDR2Ssee5219.jpg', '2026-06-28 16:16:20', '2026-06-28 16:46:49'),
(27, 4, 'Milk and Honey', 'Rupi Kaur', 'Poetry', 'A collection of poetry and prose about survival — violence, abuse, love, loss, and femininity — divided into four chapters that each explore a different pain and the journey of healing through it.', 'book_covers/iHIM9lACsbYiU430wwtr9ZJXOqQIeTjsnYlI2pyk.jpg', '2026-06-28 16:16:20', '2026-06-28 16:47:22'),
(28, 5, 'The Waste Land', 'T.S. Eliot', 'Poetry', 'First published in 1922, this modernist masterpiece is one of the most important poems of the twentieth century — a fragmented meditation on spiritual dryness and cultural disillusionment after the First World War.', 'book_covers/BBB5ckDoznnNdfByrWhpWDLovMM25zkDtFVDoGuF.jpg', '2026-06-28 16:16:20', '2026-06-28 16:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_26_230947_create_books_table', 1),
(5, '2026_06_26_000000_add_avatar_to_users_table', 1),
(6, '2026_06_26_000001_add_role_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AGX4y0qFtAgp5ezDAeDKIo9g4W2bwNhjKzFvSH7D', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEh5S0Q1elpjMjlZWmd0cWplMk5ZMjJzWlJEWkUyTmZsRzNEV1owbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYm9va3M/cGFnZT0xIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1782706583),
('cqcuh15uLn7g5Fcafh07u8fC7UIxcLUQAmEztk1X', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEZ5dlJMSFo1b3RoMEE4TUE4alFITXBHSDFjblkxaWV0bXNTUFdlSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYm9va3M/cGFnZT0zIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1782708516),
('KKt3KuC2h8GGR33Dn2xgdvX0W99jF6RIq9Oj3bIs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidzhHZHU2OGpKcEFqV25YQllWNlVCOVA4RXVNcFJ2b3hneDRDVUpCWCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2Jvb2tzP3BhZ2U9MyI7czo1OiJyb3V0ZSI7czoxNzoiYWRtaW4uYm9va3MuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1782711024),
('rt1WzaH0zk3UFdoJllO9mfWogtZBcVpAP0eVwkqX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXRzVEtjN0ZETW9RUDJ3ejNkamRFYTZ0RlB1VGpFRkdMc09SM1VSbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ib29rcyI7czo1OiJyb3V0ZSI7czoxMToiYm9va3MuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1782706582),
('sG18k64zOMCxk7Hi6CFXMzHUSEap1nBqTSG4nVCJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEI3Nm0zbjZiZWIyTlBVcG5ock5uM01hZFRlZm5kT3NSMFRueGZOaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvYm9va3M/cGFnZT0xIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1782707189),
('wPfW0hw4LGegW1Y3EqWSc6TlPE7HCdq5U0vmwy5k', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV0E2R3R1NDZWZ0xrdXkwdzdEQkQzNnJtaXBtbHdqWjhpbmIzQ0liayI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYm9va3MiO3M6NToicm91dGUiO3M6MTE6ImJvb2tzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1782708505),
('XMIktfxh9XepdCiC5rpqa358LRhsikBcTjcRIReT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiekZwc1BhS3h5Q25yR1VrQUV4bVpQZ2dNb3Rpc2lsWjNVZ3FRZ3kxcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ib29rcyI7czo1OiJyb3V0ZSI7czoxMToiYm9va3MuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1782707188);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `avatar`) VALUES
(1, 'admin', 'admin@thereadingroom.test', NULL, '$2y$12$hXBGj5lESd6yWOtjfFH7VeUEdNvyXtkFtZ5eo8vOnmmtwVo6g5Lri', 'admin', '4Xym03NP26ApKcxojm0IoN2CZaJgS9kzjikGMzV62dmrWDz6Om2tzQge4oct', '2026-06-28 16:16:19', '2026-06-28 16:16:19', NULL),
(2, 'eleanor_voss', 'eleanor@thereadingroom.test', NULL, '$2y$12$UScHptkrbkhyU7LaupK0c.Xn0IYAHq/Io9MtTydaaaJxKm161o4ii', 'user', NULL, '2026-06-28 16:16:19', '2026-06-28 16:16:19', NULL),
(3, 'marcus_reid', 'marcus@thereadingroom.test', NULL, '$2y$12$5ToQAdYYj/gqys.E/9.wpOELTJVfwv29S3mBhJ8KFIKvpPt7J.TBC', 'user', NULL, '2026-06-28 16:16:19', '2026-06-28 16:16:19', NULL),
(4, 'sofia_lane', 'sofia@thereadingroom.test', NULL, '$2y$12$iRFY3D5ufRmtB7V0cQUtj.Pp8g6fVQY4HhkvuCociNW/phZAzyJT2', 'user', NULL, '2026-06-28 16:16:20', '2026-06-28 16:16:20', NULL),
(5, 'james_okoro', 'james@thereadingroom.test', NULL, '$2y$12$rB44iGcp71Ua2BFvmmppB.yH8JNnVilUyMiEh0Ohi7qRgFP30vJ62', 'user', NULL, '2026-06-28 16:16:20', '2026-06-28 16:16:20', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
