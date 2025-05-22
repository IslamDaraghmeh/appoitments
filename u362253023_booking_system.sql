-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2025 at 08:28 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u362253023_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `url` text DEFAULT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1747338988),
('m130524_201442_init', 1747338990),
('m190124_110200_add_verification_token_column_to_user_table', 1747338990),
('m240515_000000_create_default_admin', 1747339147);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `mobile` int(10) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `role` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `full_name`, `mobile`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `role`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'د. وائل الشيخ', 0, 'YU6nZSlq083tbQN5YgVSY83zmyzajo9B', '$2y$13$uyU12tV5iYGPFHGXH6MBaeZIDkKS9VcuHd4ZQxq97Xfy8pfj5B9cG', NULL, 'admin@example.com', 10, 'ROLE_ADMIN', 1747339147, 1747339147, 'UmOh226KCP89WJjBi1Rcfe0u9wxmIH87_1747339147'),
(21, 'mahmoud', 'محمود', 598459515, '6oN9uYvYaF2UyMJhwc1CgKBRHivDyjxX', '$2y$13$eO/.LEaBp.GW8utEadjOkOKP.Gx3t5LIhsbOKiBnRUgtHd9VmQ3nO', 'URiBXvpLWPu4TvyjdfjFYrGW--JtwDjY_1747902051', NULL, 10, 'ROLE_USER', 1747634598, 1747902051, NULL),
(22, 'islam', 'اسلام الطوباسي', 566008007, '1zyxSAdSQHY3YhrE0ykdibPCHz-V_XrK', '$2y$13$fw1yfMU2S9SCi0scF3/VAuP5FIvAgJ3qRb/ywaDNR1DIbpxQSE4wS', NULL, NULL, 9, 'ROLE_USER', 1747758978, 1747764940, NULL),
(23, 'khalid', 'ولا حدا', 595135850, 'spcKlYfJWnrtrzU89DSvuOox7zWihulz', '$2y$13$WLCl9dE6aJDfiqrJEHKmBunlkGusnbP1gQkqTzKiuxiN0BSS4gXlm', NULL, NULL, 10, 'ROLE_USER', 1747766010, 1747766129, NULL),
(24, 'khalidww', 'asdasdasd', 595135850, 'LsJg9-3dMqvCpfLP-_37cLLgH5sY7avU', '$2y$13$MtEqgyz5lhQ2g7z4GD4MP.T155Q66xMhUOdSfzZGvnFHxll//YEJ6', NULL, NULL, 10, 'ROLE_USER', 1747766046, 1747766046, NULL),
(25, 'khalidwwqqqqqqq', 'asdasdasd', 595135850, 'EGhz_q-kWMhhdDMIou7NOFZcmVRCft5j', '$2y$13$3MlfhQA6/fEID9J4guTSne1aJw5S09NI2Z4IQtjBG.ZW58LqVgrLW', '6DABSVadllWqPiqRwRSuxGL1Idz-i0Kz_1747902108', NULL, 10, 'ROLE_USER', 1747766067, 1747902108, NULL),
(26, 'supportTest', 'AAAAAAAAAAAAAA', 595135850, 'U2DwIGAomzii9_jaVCcgOmuoYcVtXLnF', '$2y$13$EopbdUaiMBEZw/pleoO9ceWiHqF0ra5lo4H4nTc5obiH0XqDJAWJW', NULL, NULL, 9, 'ROLE_ADMIN', 1747766087, 1747767892, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `identity_number` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `full_name`, `identity_number`, `phone`, `email`, `position`, `notes`, `created_at`, `updated_at`) VALUES
(50, 'mahmoud abu sarary', '852368653', '0598459515', NULL, 'lkli', NULL, '2025-05-19 06:04:57', '2025-05-19 06:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `visit_date` date NOT NULL,
  `visit_time` time NOT NULL,
  `purpose` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `attachment_path` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `title`, `visit_date`, `visit_time`, `purpose`, `notes`, `status`, `attachment_path`, `created_at`, `updated_at`) VALUES
(28, 'test', '2025-05-20', '20:30:00', 'test', 'test', 'موعد جديد', '', '2025-05-20 16:50:32', '2025-05-20 16:50:32'),
(29, 'test02', '2025-05-20', '21:22:00', 'قبث', 'ق', 'موعد جديد', '', '2025-05-20 17:21:42', '2025-05-20 17:21:42'),
(30, 'test', '2025-05-20', '21:17:00', 'test', 'test', 'موعد جديد', 'uploads/visits/visit_682cbf03cbc84.png', '2025-05-20 17:42:25', '2025-05-20 17:42:25'),
(31, 'test', '2025-05-22', '11:29:00', 'تست', 'تست', 'موعد جديد', 'uploads/visits/visit_682ed76128ef1.png', '2025-05-22 07:50:55', '2025-05-22 07:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `visits_status`
--

CREATE TABLE `visits_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits_status`
--

INSERT INTO `visits_status` (`id`, `name`) VALUES
(1, 'قيد المراجعة'),
(2, 'موعد جديد'),
(3, 'تم');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits_status`
--
ALTER TABLE `visits_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `visits_status`
--
ALTER TABLE `visits_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
