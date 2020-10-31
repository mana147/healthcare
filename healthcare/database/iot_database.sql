-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 03, 2020 at 02:57 PM
-- Server version: 5.7.30-0ubuntu0.18.04.1-log
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iot_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `infobacsy`
--

CREATE TABLE `infobacsy` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sokhambenh`
--

CREATE TABLE `sokhambenh` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `chuan_doan` text CHARACTER SET utf8 NOT NULL,
  `nhip_tim` int(255) NOT NULL,
  `oxy` int(255) NOT NULL,
  `huyet_ap` int(255) NOT NULL,
  `nhiet_do` int(255) NOT NULL,
  `chieu_cao` int(255) NOT NULL,
  `can_nang` int(255) NOT NULL,
  `tuoi` int(255) NOT NULL,
  `gioi_tinh` char(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `don_thuoc` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sokhambenh`
--

INSERT INTO `sokhambenh` (`id`, `user_id`, `date`, `chuan_doan`, `nhip_tim`, `oxy`, `huyet_ap`, `nhiet_do`, `chieu_cao`, `can_nang`, `tuoi`, `gioi_tinh`, `don_thuoc`) VALUES
(1, 7, '2020-08-01', 'bệnh đau đầu ', 112, 313, 412, 23, 43, 23, 23, 'nam', '{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),
(2, 7, '2020-08-02', 'bệnh đâu chân', 32, 23, 13, 12, 123, 23, 23, 'nam', '{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),
(3, 7, '2020-08-03', 'Sốt mọc răng', 54, 123, 444, 123, 111, 23, 23, 'nam', '{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),
(4, 7, '2020-08-04', 'khám lại lần 3', 23, 123, 444, 123, 111, 23, 23, 'nam', '{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),
(5, 7, '2020-08-05', 'bệnh đau đầu ', 51, 123, 444, 123, 111, 23, 23, 'nam', '{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),
(6, 7, '2020-08-06', 'Sốt cảm lạnh', 66, 123, 444, 123, 111, 23, 23, 'nam', '{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),
(7, 7, '2020-08-07', 'khám lại lần 2', 99, 123, 444, 123, 111, 23, 23, 'nam', '{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),
(8, 7, '2020-08-08', 'Sốt do vi khuẩn', 94, 123, 444, 123, 111, 23, 23, 'nam', '{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),
(9, 7, '2020-08-09', 'bệnh tiểu đường tuýt 2', 3, 123, 123, 123, 123, 123, 123, 'nu', '{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}'),
(10, 7, '2020-08-10', 'bệnh tiểu đường tuýt 3', 55, 123, 123, 123, 123, 123, 123, 'nu', '{\"list\": [{\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}, {\"dv\": \"viên\", \"ld\": \"ngày uống 2 lần sau ăn\", \"sl\": 31, \"name\": \"thuốc đâu bụng\"}]}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_userhw` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_enable` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_userhw`, `name`, `password`, `email`, `level`, `updated_at`, `created_at`, `user_enable`) VALUES
(1, 'us01hw01', 'chungnt', '$2y$10$6v7bzYLNVGUf6f0NgfY/7.gNo8pTw481WvKvOuc1QDUAmca8uxh2m', 'toanchungk57m.uet@gmail.com', 'admin', '2020-08-21 09:36:13', '2020-08-21 09:36:13', '{\"id\": \"1\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),
(2, 'us02hw02', 'Pham Trung Hieu', '$2y$10$yHZWqjI1.TrNosmB1WtTM.cjWbvYmgwpaq8L1Z/m9XFnlES6NPCWW', 'phamhieu078@gmail.com', 'doctor', '2020-09-01 09:29:28', '2020-08-21 09:36:13', '{\"id\": \"2\", \"list\": [\"us10hw10\"]}'),
(3, 'us03hw03', 'admin1', '$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai', 'test0@gmail.com', 'admin', '2020-08-22 09:46:49', '2020-08-22 09:46:49', '{\"id\": \"3\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),
(4, 'us04hw04', 'doctor2', '$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai', 'test1@gmail.com', 'doctor', '2020-08-22 09:46:49', '2020-08-22 09:46:49', '{\"id\": \"4\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),
(5, 'us05hw05', 'doctor3', '$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai', 'test2@gmail.com', 'doctor', '2020-08-22 09:46:49', '2020-08-22 09:46:49', '{\"id\": \"5\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),
(6, 'us06hw06', 'doctor4', '$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai', 'test3@gmail.com', 'doctor', '2020-08-22 09:46:49', '2020-08-22 09:46:49', '{\"id\": \"6\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),
(7, 'us07hw07', 'user1', '$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai', 'test4@gmail.com', 'user', '2020-09-01 06:01:21', '2020-08-22 09:46:49', '{\"id\": \"7\", \"list\": [\"us04hw04\", \"us05hw05\", \"us06hw06\", \"us02hw02\"]}'),
(8, 'us08hw08', 'user2', '$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai', 'test5@gmail.com', 'user', '2020-08-22 09:46:49', '2020-08-22 09:46:49', '{\"id\": \"8\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),
(9, 'us09hw09', 'user3', '$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai', 'test6@gmail.com', 'user', '2020-08-22 09:46:49', '2020-08-22 09:46:49', '{\"id\": \"9\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),
(10, 'us10hw10', 'user4', '$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai', 'test7@gmail.com', 'user', '2020-08-22 09:46:49', '2020-08-22 09:46:49', '{\"id\": \"10\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),
(11, 'us11hw11', 'member1', '$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai', 'test8@gmail.com', 'member', '2020-08-22 09:46:49', '2020-08-22 09:46:49', '{\"id\": \"11\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),
(12, 'us12hw12', 'member2', '$2y$10$01UWrYhVm5EMXZdPPblSZO1gebS4nUdVuq37FxU/uuhudmZkNvoai', 'test9@gmail.com', 'member', '2020-08-22 09:46:49', '2020-08-22 09:46:49', '{\"id\": \"12\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}'),
(14, 'user', 'user10', '$2y$10$aZXGhMYujbdMCikO1iorculOdC0b667yXnF8pNaViFA0h1a6v13Km', 'test10@gmail.com', 'member', '2020-08-27 13:28:33', '2020-08-27 13:28:33', '{\"id\": \"14\", \"list\": [\"us03hw03\", \"us08hw08\", \"us02hw02\", \"us01hw01\"]}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `infobacsy`
--
ALTER TABLE `infobacsy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sokhambenh`
--
ALTER TABLE `sokhambenh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sokhambenh_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `infobacsy`
--
ALTER TABLE `infobacsy`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sokhambenh`
--
ALTER TABLE `sokhambenh`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sokhambenh`
--
ALTER TABLE `sokhambenh`
  ADD CONSTRAINT `sokhambenh_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
