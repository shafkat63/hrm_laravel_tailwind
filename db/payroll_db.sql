-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2025 at 01:20 PM
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
-- Database: `payroll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `joining_date` varchar(40) DEFAULT NULL,
  `shift` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `religion` int(11) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `is_married` tinyint(1) DEFAULT 0,
  `spouse_name` varchar(255) DEFAULT NULL,
  `marriage_date` varchar(255) DEFAULT NULL,
  `has_siblings` varchar(3) DEFAULT NULL,
  `no_of_brothers` int(11) DEFAULT NULL,
  `no_of_sisters` int(11) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `nid_photo_front` varchar(255) DEFAULT NULL,
  `nid_photo_back` varchar(255) DEFAULT NULL,
  `primary_mobile` varchar(20) NOT NULL,
  `emergency_contact` varchar(20) DEFAULT NULL,
  `primary_email` varchar(255) NOT NULL,
  `official_mail` varchar(40) DEFAULT NULL,
  `blood_group` int(11) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `is_experienced` tinyint(1) DEFAULT 0,
  `designation` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `uid`, `name`, `father_name`, `mother_name`, `dob`, `joining_date`, `shift`, `gender`, `religion`, `photo`, `signature`, `marital_status`, `is_married`, `spouse_name`, `marriage_date`, `has_siblings`, `no_of_brothers`, `no_of_sisters`, `nationality`, `national_id`, `nid_photo_front`, `nid_photo_back`, `primary_mobile`, `emergency_contact`, `primary_email`, `official_mail`, `blood_group`, `height`, `weight`, `status`, `present_address`, `permanent_address`, `is_experienced`, `designation`, `department`, `create_by`, `created_at`, `update_by`, `updated_at`) VALUES
(1102050, '3d4adb90-1ee0-446b-a94a-cd2304368208', 'Saiful Hasan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'employeee/profile/4522021d-812b-42bd-85f0-f2a7c2f7df42.webp', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '016747927', NULL, 'saifulhasan.srlbd@gmail.com', NULL, NULL, NULL, NULL, 'A', NULL, NULL, 0, '15', '1', NULL, '2025-09-17 04:01:11', NULL, '2025-09-17 04:01:11');

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
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` varchar(255) DEFAULT '#',
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT '#',
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `icon`, `url`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, '#', 'DashBoard', 'bi bi-grid', '#', 'active', '5', '2025-02-25 03:08:40', '5', '2025-02-25 04:12:11'),
(2, '1', 'Dashboard', '#', '/dashboard', 'active', '5', '2025-02-25 03:09:09', NULL, '2025-10-13 09:55:27'),
(3, '#', 'Web Setup', 'bi bi-menu-button-wide', '#', 'active', '5', '2025-02-25 04:15:13', NULL, NULL),
(4, '#', 'Setup', 'bi bi-folder-check', '#', 'active', '5', '2025-02-25 04:22:40', '5', '2025-02-25 04:26:15'),
(5, '4', 'Department', '#', '/department', 'active', '5', '2025-02-25 04:22:58', NULL, NULL),
(6, '4', 'Designation', '#', '/designation', 'active', '5', '2025-02-25 04:23:13', NULL, NULL),
(7, '4', 'District', '#', '/district', 'active', '5', '2025-02-25 04:27:13', NULL, NULL),
(8, '4', 'Degree', '#', '/degree', 'active', '5', '2025-02-25 04:27:28', NULL, NULL),
(9, '4', 'Blood Group', '#', '/bloodgroup', 'active', '5', '2025-02-25 04:27:46', NULL, NULL),
(10, '4', 'Occupation', '#', '/occupation', 'active', '5', '2025-02-25 04:28:02', NULL, NULL),
(11, '4', 'Relationship', '#', '/relationship', 'active', '5', '2025-02-25 04:28:18', NULL, NULL),
(12, '4', 'Religion', '#', '/religion', 'active', '5', '2025-02-25 04:28:31', NULL, NULL),
(13, '4', 'Employee', '#', '/employee', 'active', '5', '2025-02-25 04:28:49', '5', '2025-02-25 05:24:05'),
(14, '#', 'User Config', 'bi bi-people-fill', '#', 'active', '5', '2025-02-25 04:53:59', NULL, NULL),
(16, '14', 'Users', '#', '/User', 'active', '5', '2025-02-25 04:58:00', NULL, NULL),
(17, '14', 'Roles', '#', '/roles', 'active', '5', '2025-02-25 04:58:33', NULL, '2025-10-13 09:17:37'),
(18, '14', 'Permission', '#', '/Permission', 'active', '5', '2025-02-25 04:58:49', NULL, NULL),
(19, '#', 'Attendance', 'bi bi-person-fill-check', '#', 'active', '5', '2025-02-25 05:00:32', NULL, NULL),
(20, '19', 'Attendance', '#', '/attendance', 'active', '5', '2025-02-25 05:00:52', NULL, NULL),
(21, '3', 'Menu', '#', '/menu', 'active', '5', '2025-02-25 05:01:45', NULL, NULL),
(22, '#', 'Leave Setup', 'bi bi-gear', '#', 'active', '5', '2025-02-25 05:25:46', NULL, NULL),
(23, '22', 'Leave Application Form', '#', '/leave/create', 'active', '5', '2025-02-25 05:26:46', NULL, NULL),
(24, '22', 'Leave Year', '#', '/leaveyear', 'active', '5', '2025-02-25 05:27:09', NULL, NULL),
(25, '22', 'Leave Application', '#', '/leave', 'active', '5', '2025-02-25 05:27:41', NULL, NULL),
(26, '22', 'Leave Setup', '#', '/leavesetup', 'active', '5', '2025-02-25 05:28:07', NULL, NULL),
(27, '22', 'Leave Balance', '#', '/leavebalance', 'active', '5', '2025-02-25 05:28:37', NULL, NULL),
(28, '22', 'Holidays', '#', '/holidays', 'active', '5', '2025-02-25 05:28:53', NULL, NULL),
(29, '22', 'Leave  Type', '#', '/leavetype', 'active', '5', '2025-02-25 05:29:32', NULL, NULL),
(30, '#', 'Report', 'bi bi-file-earmark-spreadsheet-fill', '#', 'active', '5', '2025-02-25 05:30:49', NULL, NULL),
(31, '#', 'Hardware and Network', 'bi bi-motherboard', '#', 'active', '5', '2025-02-26 00:15:45', NULL, NULL),
(32, '31', 'Hardware', '#', '/hardware', 'active', '5', '2025-02-26 00:20:50', NULL, NULL),
(33, '31', 'Network', '#', '/network', 'active', '5', '2025-02-26 00:21:07', NULL, NULL),
(34, '31', 'Hardware Assign', '#', '/hardwareassign', 'active', '5', '2025-02-26 00:21:38', NULL, NULL),
(35, '31', 'Components', '#', '/components', 'active', '5', '2025-02-26 00:21:55', NULL, NULL),
(36, '31', 'Type and Size', '#', '/typesize', 'active', '5', '2025-02-26 00:22:22', NULL, NULL),
(37, '31', 'Hardware maintenance', '#', '/hardwaremaintenance', 'active', '5', '2025-02-26 00:22:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_assign`
--

CREATE TABLE `menu_assign` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'A',
  `create_by` varchar(20) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(20) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_assign`
--

INSERT INTO `menu_assign` (`id`, `menu`, `role_id`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(5, 'on', '4', '1', '5', '2025-02-25 03:45:06', NULL, NULL),
(6, '1', '4', '1', '5', '2025-02-25 03:45:06', NULL, NULL),
(7, '2', '4', '1', '5', '2025-02-25 03:45:06', NULL, NULL),
(90, 'on', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(91, '1', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(92, '2', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(93, '3', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(94, '21', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(95, '4', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(96, '5', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(97, '6', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(98, '7', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(99, '8', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(100, '9', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(101, '10', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(102, '11', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(103, '12', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(104, '13', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(105, '14', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(106, '16', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(107, '17', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(108, '18', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(109, '19', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(110, '20', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(111, '22', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(112, '23', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(113, '24', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(114, '25', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(115, '26', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(116, '27', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(117, '28', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(118, '29', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(119, '30', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(120, '31', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(121, '32', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(122, '33', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(123, '34', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(124, '35', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(125, '36', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(126, '37', '5', '1', '5', '2025-02-26 03:05:36', NULL, NULL),
(127, '1', '6', '1', '5', '2025-03-06 03:25:06', NULL, NULL),
(128, '2', '6', '1', '5', '2025-03-06 03:25:06', NULL, NULL),
(129, '22', '6', '1', '5', '2025-03-06 03:25:06', NULL, NULL),
(130, '23', '6', '1', '5', '2025-03-06 03:25:06', NULL, NULL),
(135, '22', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL),
(136, '24', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL),
(137, '25', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL),
(138, '26', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL),
(139, '27', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL),
(140, '28', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL),
(141, '29', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL),
(142, '31', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL),
(143, '32', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL),
(144, '34', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL),
(145, '36', '7', '1', '5', '2025-09-10 03:21:56', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_01_105725_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(4, 'App\\Models\\User', 15),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 11),
(6, 'App\\Models\\User', 10),
(6, 'App\\Models\\User', 16),
(6, 'App\\Models\\User', 18),
(6, 'App\\Models\\User', 19),
(6, 'App\\Models\\User', 21),
(6, 'App\\Models\\User', 22),
(6, 'App\\Models\\User', 23),
(6, 'App\\Models\\User', 28),
(6, 'App\\Models\\User', 29),
(6, 'App\\Models\\User', 31),
(6, 'App\\Models\\User', 33),
(6, 'App\\Models\\User', 34),
(6, 'App\\Models\\User', 35),
(6, 'App\\Models\\User', 36),
(6, 'App\\Models\\User', 37),
(6, 'App\\Models\\User', 41),
(6, 'App\\Models\\User', 44),
(6, 'App\\Models\\User', 45),
(6, 'App\\Models\\User', 46),
(6, 'App\\Models\\User', 47),
(6, 'App\\Models\\User', 48),
(6, 'App\\Models\\User', 49),
(6, 'App\\Models\\User', 50),
(6, 'App\\Models\\User', 51),
(6, 'App\\Models\\User', 53),
(6, 'App\\Models\\User', 54),
(6, 'App\\Models\\User', 55),
(6, 'App\\Models\\User', 57),
(6, 'App\\Models\\User', 58),
(6, 'App\\Models\\User', 61),
(6, 'App\\Models\\User', 67),
(6, 'App\\Models\\User', 69),
(6, 'App\\Models\\User', 70),
(6, 'App\\Models\\User', 71),
(6, 'App\\Models\\User', 72),
(6, 'App\\Models\\User', 73),
(6, 'App\\Models\\User', 82),
(6, 'App\\Models\\User', 83),
(6, 'App\\Models\\User', 84),
(6, 'App\\Models\\User', 85),
(6, 'App\\Models\\User', 86),
(6, 'App\\Models\\User', 87),
(6, 'App\\Models\\User', 88),
(6, 'App\\Models\\User', 89),
(6, 'App\\Models\\User', 90),
(6, 'App\\Models\\User', 91),
(6, 'App\\Models\\User', 92),
(6, 'App\\Models\\User', 95),
(6, 'App\\Models\\User', 96),
(6, 'App\\Models\\User', 97),
(6, 'App\\Models\\User', 98),
(6, 'App\\Models\\User', 99),
(6, 'App\\Models\\User', 100),
(6, 'App\\Models\\User', 101),
(6, 'App\\Models\\User', 102),
(6, 'App\\Models\\User', 103),
(6, 'App\\Models\\User', 104),
(6, 'App\\Models\\User', 106),
(6, 'App\\Models\\User', 107),
(6, 'App\\Models\\User', 110),
(6, 'App\\Models\\User', 111),
(6, 'App\\Models\\User', 112),
(6, 'App\\Models\\User', 115),
(6, 'App\\Models\\User', 116),
(6, 'App\\Models\\User', 119),
(6, 'App\\Models\\User', 120),
(6, 'App\\Models\\User', 121),
(6, 'App\\Models\\User', 124),
(6, 'App\\Models\\User', 154),
(6, 'App\\Models\\User', 155),
(6, 'App\\Models\\User', 159),
(6, 'App\\Models\\User', 160),
(6, 'App\\Models\\User', 161),
(6, 'App\\Models\\User', 174),
(6, 'App\\Models\\User', 175),
(6, 'App\\Models\\User', 181),
(7, 'App\\Models\\User', 119),
(7, 'App\\Models\\User', 138),
(7, 'App\\Models\\User', 183);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(21, 'view_sidemenu', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(22, 'create_sidemenu', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(23, 'update_sidemenu', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(24, 'delete_sidemenu', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(33, 'view_user', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(34, 'create_user', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(35, 'update_user', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(36, 'delete_user', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(41, 'view_permission', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(42, 'create_permission', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(43, 'update_permission', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(44, 'delete_permission', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(65, 'view_dashboard', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(66, 'create_dashboard', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(67, 'update_dashboard', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(68, 'delete_dashboard', 'web', '2024-09-03 02:27:09', '2024-09-03 02:27:09'),
(69, 'Admin', 'web', '2024-10-27 05:21:33', '2024-10-27 05:21:33'),
(70, 'view_bloodgroup', 'web', '2024-11-24 04:34:38', '2024-11-24 04:34:38'),
(71, 'create_bloodgroup', 'web', '2024-11-24 04:39:15', '2024-11-24 04:39:15'),
(72, 'update_bloodgroup', 'web', '2024-11-24 04:40:10', '2024-11-24 04:40:10'),
(73, 'delete_bloodgroup', 'web', '2024-11-24 04:40:28', '2024-11-24 04:40:28'),
(74, 'create_department', 'web', '2024-11-24 05:10:50', '2024-11-24 05:10:50'),
(75, 'view_department', 'web', '2024-11-24 05:11:00', '2024-11-24 05:11:00'),
(76, 'update_department', 'web', '2024-11-24 05:11:08', '2024-11-24 05:11:08'),
(77, 'delete_department', 'web', '2024-11-24 05:11:16', '2024-11-24 05:11:16'),
(78, 'create_designation', 'web', '2024-11-25 00:25:20', '2024-11-25 00:25:20'),
(79, 'view_designation', 'web', '2024-11-25 00:25:27', '2024-11-25 00:25:27'),
(80, 'update_designation', 'web', '2024-11-25 00:25:35', '2024-11-25 00:25:35'),
(81, 'delete_designation', 'web', '2024-11-25 00:25:44', '2024-11-25 00:25:44'),
(82, 'create_district', 'web', '2024-11-25 00:25:59', '2024-11-25 00:25:59'),
(83, 'view_district', 'web', '2024-11-25 00:26:06', '2024-11-25 00:26:06'),
(84, 'update_district', 'web', '2024-11-25 00:26:13', '2024-11-25 00:26:13'),
(85, 'delete_district', 'web', '2024-11-25 00:26:21', '2024-11-25 00:26:21'),
(86, 'create_employee', 'web', '2024-11-25 00:26:31', '2024-11-25 00:26:31'),
(87, 'view_employee', 'web', '2024-11-25 00:26:39', '2024-11-25 00:26:39'),
(88, 'update_employee', 'web', '2024-11-25 00:26:46', '2024-11-25 00:26:46'),
(89, 'delete_employee', 'web', '2024-11-25 00:26:56', '2024-11-25 00:26:56'),
(90, 'create_occupation', 'web', '2024-11-25 00:27:15', '2024-11-25 00:27:15'),
(91, 'view_occupation', 'web', '2024-11-25 00:27:24', '2024-11-25 00:27:24'),
(92, 'update_occupation', 'web', '2024-11-25 00:27:32', '2024-11-25 00:27:32'),
(93, 'delete_occupation', 'web', '2024-11-25 00:27:41', '2024-11-25 00:27:41'),
(94, 'create_relationship', 'web', '2024-11-25 00:27:54', '2024-11-25 00:27:54'),
(95, 'view_relationship', 'web', '2024-11-25 00:28:04', '2024-11-25 00:28:04'),
(96, 'update_relationship', 'web', '2024-11-25 00:28:12', '2024-11-25 00:28:12'),
(97, 'delete_relationship', 'web', '2024-11-25 00:28:22', '2024-11-25 00:28:22'),
(98, 'create_religion', 'web', '2024-11-25 00:28:35', '2024-11-25 00:28:35'),
(99, 'view_religion', 'web', '2024-11-25 00:28:43', '2024-11-25 00:28:43'),
(100, 'update_religion', 'web', '2024-11-25 00:28:52', '2024-11-25 00:28:52'),
(101, 'delete_religion', 'web', '2024-11-25 00:29:03', '2024-11-25 00:29:03'),
(102, 'create_attendance', 'web', '2024-11-25 00:29:19', '2024-11-25 00:29:19'),
(103, 'view_attendance', 'web', '2024-11-25 00:29:27', '2024-11-25 00:29:27'),
(104, 'update_attendance', 'web', '2024-11-25 00:29:34', '2024-11-25 00:29:34'),
(105, 'delete_attendance', 'web', '2024-11-25 00:29:43', '2024-11-25 00:29:43'),
(106, 'create_holidays', 'web', '2024-11-25 00:34:45', '2024-11-25 00:34:45'),
(107, 'view_holidays', 'web', '2024-11-25 00:34:52', '2024-11-25 00:34:52'),
(108, 'update_holidays', 'web', '2024-11-25 00:34:59', '2024-11-25 00:34:59'),
(109, 'delete_holidays', 'web', '2024-11-25 00:35:09', '2024-11-25 00:35:09'),
(110, 'create_leave', 'web', '2024-11-25 00:35:22', '2024-11-25 00:35:22'),
(111, 'view_leave', 'web', '2024-11-25 00:35:29', '2024-11-25 00:35:29'),
(112, 'update_leave', 'web', '2024-11-25 00:35:36', '2024-11-25 00:35:36'),
(113, 'delete_leave', 'web', '2024-11-25 00:35:43', '2024-11-25 00:35:43'),
(114, 'create_leaveYear', 'web', '2024-11-25 00:36:42', '2024-11-25 00:36:42'),
(115, 'view_leaveYear', 'web', '2024-11-25 00:36:49', '2024-11-25 00:36:49'),
(116, 'update_leaveYear', 'web', '2024-11-25 00:36:58', '2024-11-25 00:36:58'),
(117, 'delete_leaveYear', 'web', '2024-11-25 00:37:09', '2024-11-25 00:37:09'),
(118, 'view_test', 'web', '2025-02-26 00:36:24', '2025-02-26 00:36:24'),
(119, 'create_test', 'web', '2025-02-26 00:36:24', '2025-02-26 00:36:24'),
(120, 'update_test', 'web', '2025-02-26 00:36:24', '2025-02-26 00:36:24'),
(121, 'delete_test', 'web', '2025-02-26 00:36:24', '2025-02-26 00:36:24'),
(122, 'Test', 'web', '2025-02-26 01:01:29', '2025-02-26 01:01:29'),
(128, 'view_roles', 'web', '2025-02-26 01:11:11', '2025-02-26 01:11:11'),
(129, 'create_roles', 'web', '2025-02-26 01:11:11', '2025-02-26 01:11:11'),
(130, 'update_roles', 'web', '2025-02-26 01:11:11', '2025-02-26 01:11:11'),
(131, 'delete_roles', 'web', '2025-02-26 01:11:11', '2025-02-26 01:11:11'),
(132, 'view_menu', 'web', '2025-02-26 01:26:06', '2025-02-26 01:26:06'),
(133, 'create_menu', 'web', '2025-02-26 01:26:06', '2025-02-26 01:26:06'),
(134, 'update_menu', 'web', '2025-02-26 01:26:06', '2025-02-26 01:26:06'),
(135, 'delete_menu', 'web', '2025-02-26 01:26:06', '2025-02-26 01:26:06'),
(136, 'view_degree', 'web', '2025-02-26 01:33:38', '2025-02-26 01:33:38'),
(137, 'create_degree', 'web', '2025-02-26 01:33:38', '2025-02-26 01:33:38'),
(138, 'update_degree', 'web', '2025-02-26 01:33:38', '2025-02-26 01:33:38'),
(139, 'delete_degree', 'web', '2025-02-26 01:33:38', '2025-02-26 01:33:38'),
(140, 'view_components', 'web', '2025-02-26 01:39:51', '2025-02-26 01:39:51'),
(141, 'create_components', 'web', '2025-02-26 01:39:52', '2025-02-26 01:39:52'),
(142, 'update_components', 'web', '2025-02-26 01:39:52', '2025-02-26 01:39:52'),
(143, 'delete_components', 'web', '2025-02-26 01:39:52', '2025-02-26 01:39:52'),
(144, 'view_hardwareassign', 'web', '2025-02-26 02:51:15', '2025-02-26 02:51:15'),
(145, 'create_hardwareassign', 'web', '2025-02-26 02:51:15', '2025-02-26 02:51:15'),
(146, 'update_hardwareassign', 'web', '2025-02-26 02:51:15', '2025-02-26 02:51:15'),
(147, 'delete_hardwareassign', 'web', '2025-02-26 02:51:15', '2025-02-26 02:51:15'),
(148, 'view_hardware', 'web', '2025-02-26 02:52:17', '2025-02-26 02:52:17'),
(149, 'create_hardware', 'web', '2025-02-26 02:52:17', '2025-02-26 02:52:17'),
(150, 'update_hardware', 'web', '2025-02-26 02:52:17', '2025-02-26 02:52:17'),
(151, 'delete_hardware', 'web', '2025-02-26 02:52:17', '2025-02-26 02:52:17'),
(152, 'view_hardwaremaintenance', 'web', '2025-02-26 02:52:52', '2025-02-26 02:52:52'),
(153, 'create_hardwaremaintenance', 'web', '2025-02-26 02:52:52', '2025-02-26 02:52:52'),
(154, 'update_hardwaremaintenance', 'web', '2025-02-26 02:52:52', '2025-02-26 02:52:52'),
(155, 'delete_hardwaremaintenance', 'web', '2025-02-26 02:52:52', '2025-02-26 02:52:52'),
(156, 'view_network', 'web', '2025-02-26 02:53:22', '2025-02-26 02:53:22'),
(157, 'create_network', 'web', '2025-02-26 02:53:22', '2025-02-26 02:53:22'),
(158, 'update_network', 'web', '2025-02-26 02:53:22', '2025-02-26 02:53:22'),
(159, 'delete_network', 'web', '2025-02-26 02:53:22', '2025-02-26 02:53:22'),
(160, 'view_typesize', 'web', '2025-02-26 02:56:43', '2025-02-26 02:56:43'),
(161, 'create_typesize', 'web', '2025-02-26 02:56:44', '2025-02-26 02:56:44'),
(162, 'update_typesize', 'web', '2025-02-26 02:56:44', '2025-02-26 02:56:44'),
(163, 'delete_typesize', 'web', '2025-02-26 02:56:44', '2025-02-26 02:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(7, 'App\\Models\\User', 160, 'EmployeeApp', '997bf8cfb7817572518334adfcbfd5542ff8a6e9278296577c2fb98f6805d37f', '[\"*\"]', NULL, NULL, '2025-09-15 02:12:34', '2025-09-15 02:12:34'),
(8, 'App\\Models\\User', 174, 'EmployeeApp', '54f3f11e1c2d1d28a7531b21d6550a16fae04d01d3c8030aa44a475d13bcbdcc', '[\"*\"]', NULL, NULL, '2025-09-15 03:55:01', '2025-09-15 03:55:01'),
(9, 'App\\Models\\User', 175, 'EmployeeApp', '714f0b65cf7abd088bacdba0735353448af58005b497083de557fbe316fcf642', '[\"*\"]', NULL, NULL, '2025-09-15 04:11:03', '2025-09-15 04:11:03'),
(25, 'App\\Models\\User', 5, 'EmployeeApp', '74910ac392ec38db7195dc678f97c4d2d27834f2ef111edab45f3ef750ac8dc6', '[\"*\"]', NULL, NULL, '2025-09-16 06:02:01', '2025-09-16 06:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `processor_generation`
--

CREATE TABLE `processor_generation` (
  `id` int(11) NOT NULL,
  `gen_name` varchar(222) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `processor_generation`
--

INSERT INTO `processor_generation` (`id`, `gen_name`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, '1st Gen', 'active', '2024-12-10 01:49:20', '2024-12-10 01:49:20', 5, 5),
(2, '2nd Gen', 'active', '2024-12-10 02:17:01', '2024-12-10 02:17:01', 5, 5),
(3, '11 Gen', 'active', '2024-12-12 04:25:46', '2024-12-12 04:25:46', 5, 5),
(4, '12 Generation', 'active', '2024-12-12 05:53:18', '2024-12-12 05:53:18', 5, 5),
(5, '13 Gen', 'active', '2024-12-12 05:55:46', '2024-12-12 05:55:46', 5, 5),
(6, '14th Gen', 'active', '2024-12-16 23:27:48', '2024-12-16 23:27:48', 5, 5),
(7, '15th Gen', 'active', '2024-12-16 23:41:22', '2024-12-16 23:41:22', 5, 5),
(8, '9th gen', 'active', '2024-12-17 02:53:53', '2024-12-17 02:53:53', 5, 5),
(9, '7th Gen', 'active', '2024-12-18 04:59:18', '2024-12-18 04:59:18', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(4, 'Admin', 'web', '2024-09-04 01:06:53', '2024-09-04 01:06:53'),
(5, 'Root', 'web', '2024-09-09 02:21:14', '2024-09-09 02:21:14'),
(6, 'Employee', 'web', '2024-09-21 04:09:19', '2024-10-25 23:24:36'),
(7, 'HR', 'web', '2024-11-24 03:46:23', '2024-11-24 03:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(21, 4),
(21, 5),
(22, 4),
(22, 5),
(23, 4),
(23, 5),
(24, 5),
(33, 4),
(33, 5),
(33, 7),
(34, 4),
(34, 5),
(34, 7),
(35, 4),
(35, 5),
(35, 7),
(36, 5),
(41, 4),
(41, 5),
(41, 6),
(42, 4),
(42, 5),
(42, 6),
(43, 4),
(43, 5),
(43, 6),
(44, 5),
(65, 4),
(65, 5),
(65, 6),
(65, 7),
(66, 4),
(66, 5),
(66, 6),
(66, 7),
(67, 4),
(67, 5),
(67, 6),
(67, 7),
(68, 5),
(68, 6),
(68, 7),
(69, 5),
(70, 4),
(70, 5),
(70, 7),
(71, 4),
(71, 5),
(71, 7),
(72, 4),
(72, 5),
(72, 7),
(73, 5),
(74, 4),
(74, 5),
(74, 7),
(75, 4),
(75, 5),
(75, 7),
(76, 4),
(76, 5),
(76, 7),
(77, 5),
(78, 4),
(78, 5),
(78, 7),
(79, 4),
(79, 5),
(79, 7),
(80, 4),
(80, 5),
(80, 7),
(81, 5),
(82, 4),
(82, 5),
(82, 7),
(83, 4),
(83, 5),
(83, 7),
(84, 4),
(84, 5),
(84, 7),
(85, 5),
(86, 4),
(86, 5),
(86, 7),
(87, 4),
(87, 5),
(87, 7),
(88, 4),
(88, 5),
(88, 7),
(89, 5),
(90, 4),
(90, 5),
(90, 7),
(91, 4),
(91, 5),
(91, 7),
(92, 4),
(92, 5),
(92, 7),
(93, 5),
(94, 4),
(94, 5),
(94, 7),
(95, 4),
(95, 5),
(95, 7),
(96, 4),
(96, 5),
(96, 7),
(97, 5),
(98, 4),
(98, 5),
(98, 7),
(99, 4),
(99, 5),
(99, 7),
(100, 4),
(100, 5),
(100, 7),
(101, 5),
(102, 4),
(102, 5),
(102, 7),
(103, 4),
(103, 5),
(103, 7),
(104, 4),
(104, 5),
(104, 7),
(105, 5),
(106, 4),
(106, 5),
(106, 7),
(107, 4),
(107, 5),
(107, 7),
(108, 4),
(108, 5),
(108, 7),
(109, 5),
(110, 4),
(110, 5),
(110, 6),
(110, 7),
(111, 4),
(111, 5),
(111, 6),
(111, 7),
(112, 4),
(112, 5),
(112, 6),
(112, 7),
(113, 5),
(114, 4),
(114, 5),
(114, 7),
(115, 4),
(115, 5),
(115, 7),
(116, 4),
(116, 5),
(116, 7),
(117, 5),
(118, 4),
(118, 5),
(119, 4),
(119, 5),
(120, 4),
(120, 5),
(121, 5),
(128, 4),
(128, 5),
(129, 4),
(129, 5),
(130, 4),
(130, 5),
(131, 5),
(132, 4),
(132, 5),
(133, 4),
(133, 5),
(134, 4),
(134, 5),
(135, 5),
(136, 4),
(136, 5),
(137, 4),
(137, 5),
(138, 4),
(138, 5),
(138, 7),
(139, 5),
(140, 4),
(140, 5),
(140, 7),
(141, 4),
(141, 5),
(142, 4),
(142, 5),
(142, 7),
(143, 5),
(143, 7),
(144, 4),
(144, 5),
(144, 7),
(145, 4),
(145, 5),
(145, 7),
(146, 4),
(146, 5),
(146, 7),
(147, 5),
(147, 7),
(148, 4),
(148, 5),
(148, 7),
(149, 4),
(149, 5),
(149, 7),
(150, 4),
(150, 5),
(150, 7),
(151, 5),
(151, 7),
(152, 4),
(152, 5),
(152, 7),
(153, 4),
(153, 5),
(153, 7),
(154, 4),
(154, 5),
(154, 7),
(155, 5),
(155, 7),
(156, 4),
(156, 5),
(156, 7),
(157, 4),
(157, 5),
(157, 7),
(158, 4),
(158, 5),
(158, 7),
(159, 5),
(159, 7),
(160, 4),
(160, 5),
(161, 4),
(161, 5),
(161, 7),
(162, 4),
(162, 5),
(162, 7),
(163, 5),
(163, 7);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GTetq2nKdVoF4HRb9AMl3Fv3J3IiOLq5U811hmzq', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVkR3bENzYXlyenNmRnRUSmI2SXp5N1p1c0hZMGtuZ2M1Rk5WQXQzTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1760597442);

-- --------------------------------------------------------

--
-- Table structure for table `sms_web_sidebar_menu`
--

CREATE TABLE `sms_web_sidebar_menu` (
  `id` bigint(20) NOT NULL,
  `uid` varchar(36) DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL,
  `is_collapsed` tinyint(1) DEFAULT 0,
  `is_heading` tinyint(1) DEFAULT 0,
  `permission_id` bigint(20) DEFAULT 0,
  `status` varchar(10) DEFAULT 'I',
  `create_by` varchar(10) DEFAULT NULL,
  `create_date` varchar(20) DEFAULT NULL,
  `update_by` varchar(10) DEFAULT NULL,
  `update_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sms_web_sidebar_menu`
--

INSERT INTO `sms_web_sidebar_menu` (`id`, `uid`, `parent_id`, `name`, `icon`, `url`, `order`, `is_collapsed`, `is_heading`, `permission_id`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
(1, '04befafd-dfd0-4eec-b4d7-62825975d3f5', NULL, 'Dashboard', 'bi bi-grid', 'Dashboard', 1, 0, 0, 5, 'A', NULL, NULL, '5', '2024-09-09 11:24:36'),
(3, 'e7608767-119d-414a-8f5a-eab8afcfff18', NULL, 'Web Setup', 'bi bi-person-gear', '#', 3, 1, 0, 0, 'A', NULL, NULL, '5', '2024-10-27 12:43:06'),
(4, '05aecfb6-f5b5-4496-94e2-a6d65bb02c90', 3, 'Side Menu', 'bi bi-circle', 'SidebarNav', 1, 0, 0, 0, 'A', NULL, NULL, '5', '2024-10-28 05:46:35'),
(11, '59ebdca8-b889-4ec9-8ff6-22966d423137', NULL, 'User Config', 'bi bi-people-fill', '#', 5, 1, 0, 0, 'A', '1010', '2024-09-01 08:26:21', '1010', '2024-09-01 08:56:26'),
(13, '71d5ac51-a43d-4cd8-82e6-d12e81153c99', 11, 'User Info', 'bi bi-person-lines-fill', 'User', 2, 0, 0, 0, 'A', '1010', '2024-09-01 08:50:26', '1010', '2024-09-01 12:12:16'),
(14, '65c69934-50af-444a-96a0-0fe8c0c8f4e0', 11, 'User Roles', 'bi bi-person-lines-fill', 'Roles', 3, 0, 0, 0, 'A', '1010', '2024-09-01 08:51:46', '1010', '2024-09-01 11:48:57'),
(15, '35732e13-6bf8-4bfd-9d0f-a5fccb528af1', 11, 'Permission', 'bi', 'Permission', 5, 0, 0, 0, 'A', '1010', '2024-09-01 08:52:12', '4', '2024-09-03 06:58:53'),
(17, 'c034233a-5e12-432b-be7d-ca2b5375b663', NULL, 'Header Page', '', '', 7, NULL, 1, 0, 'A', NULL, NULL, NULL, NULL),
(19, '3d2c11b0-a15c-461e-bccc-f6214cc96b3f', NULL, 'Setup', 'bi bi-gear-wide-connected', '#', 4, 1, 0, 0, 'A', '5', '2024-09-11 09:13:09', NULL, NULL),
(20, '6f1531f7-5116-40a8-9494-567c460ba54c', 19, 'Department', 'bi bi-house-door', 'department', 1, 0, 0, 0, 'A', '5', '2024-09-11 09:14:17', NULL, NULL),
(21, '5666a805-414e-4e04-af35-d3559e5ab100', 19, 'Designation', 'bi bi-person', 'designation', 2, 0, 0, 0, 'A', '5', '2024-09-11 09:15:35', NULL, NULL),
(22, '86424200-4e76-4924-9f3b-c3f011d9d759', 19, 'District', '#', 'district', 3, 0, 0, 0, 'A', '5', '2024-09-11 09:34:49', NULL, NULL),
(23, 'df4feb07-b84f-4ea4-8c1b-b1a3a76ede46', 19, 'Blood Group', 'f', 'bloodgroup', 4, 0, 0, 0, 'A', '5', '2024-09-11 10:44:49', NULL, NULL),
(24, '9bcceb2d-264e-402f-b647-352935019ea6', 19, 'Occupation', '#', 'occupation', 5, 0, 0, 0, 'A', '5', '2024-09-12 05:35:15', NULL, NULL),
(25, '2b43c9d3-8909-42d5-b5e4-2cd7a06a9ca5', 19, 'Relationship', '#', 'relationship', 6, 0, 0, 0, 'A', '5', '2024-09-12 05:52:12', NULL, NULL),
(26, '404bbcfc-ea0e-4fa3-b8a4-cf5dff11f0e7', 19, 'Religion', '#', 'religion', 7, 0, 0, 0, 'A', '5', '2024-09-14 05:14:34', '5', '2024-09-14 05:16:47'),
(27, '004fd490-f74c-4ba2-a35e-b10d73c31c8d', 19, 'Employee', '#', 'employee', 8, 0, 0, 0, 'A', '5', '2024-09-14 08:41:32', NULL, NULL),
(28, '2f61cbb2-9f73-4453-9dc2-57cf658c5313', NULL, 'Attendance', 'bi bi-person-fill-check', '#', 5, 1, 0, 0, 'A', '5', '2024-09-23 10:26:58', '5', '2024-11-24 05:33:11'),
(29, '360e0000-e6aa-4445-8d14-590acc236034', 28, 'Attendance', '#', 'attendance', 1, 0, 0, 0, 'A', '5', '2024-09-23 10:27:36', NULL, NULL),
(30, 'a436d377-1854-413a-b9a3-bf08d73cfbe6', NULL, 'Test', 'bi bi-airplane-fill', '#', 7, 0, 0, 0, 'Deleted', '5', '2024-10-27 10:49:45', '5', '2024-11-26 10:10:29'),
(31, '5ae5172e-1c4f-4387-8f03-5347f63855e1', 3, 'Top Menu', 'bi', '#', 2, 0, 0, 0, 'Deleted', '5', '2024-10-27 10:56:12', '5', '2024-11-27 05:49:35'),
(32, '46e8223d-5367-4727-9ac8-46ff6ae2d2a0', 3, 'Side Nav', 'bi', '#', 3, 0, 0, 0, 'Deleted', '5', '2024-10-27 10:57:33', '5', '2024-11-27 05:49:44'),
(33, 'da17b005-922a-42fe-895e-9f448a09eec1', NULL, 'Leave Setup', 'bi bi-gear', '#', 5, 1, 0, 0, 'A', '5', '2024-11-18 06:06:32', '5', '2024-11-19 11:52:50'),
(34, 'a555c00b-3ee8-4970-8af7-00d48a164421', 33, 'Leave Application Form', 'bi bi-person-gear', 'leave/create', 1, 1, 0, 0, 'A', '5', '2024-11-19 11:50:03', '5', '2024-11-19 11:50:56'),
(35, 'bb3ef461-dd8f-4d52-8913-dca12b2d021f', 33, 'Leave Year', '#', 'leaveyear', 1, 0, 0, 0, 'A', '5', '2024-11-20 05:46:04', NULL, NULL),
(36, '292fa0cd-9a1c-4c7e-9c70-908d52573e1d', 33, 'Holidays', '#', 'holidays', 3, 0, 0, 0, 'A', '5', '2024-11-20 07:48:35', NULL, NULL),
(37, '08ebca89-3a32-4586-acb6-07fee3db5075', 28, 'Employee Data', '#', 'employeedata', 2, 0, 0, 0, 'A', '5', '2024-11-24 07:24:48', NULL, NULL),
(38, '44ddb76a-c282-41d5-b9c7-ea3021f8fe22', NULL, 'Reports', 'bi bi-file-earmark-spreadsheet-fill', '#', 6, 1, 0, 0, 'A', '5', '2024-11-27 06:51:57', '5', '2024-11-27 06:53:01'),
(39, 'b186fd70-4923-4042-abb4-5c0ea67bf050', 19, 'Degree', '#', 'degree', 3, 0, 0, 0, 'A', '5', '2024-12-01 07:59:51', NULL, NULL),
(40, 'd9d81a4a-0d5d-4db9-8e51-1545f4dc542a', 33, 'Leave Application', '#', 'leave', 1, 0, 0, 0, 'A', '5', '2024-12-02 07:42:41', '5', '2024-12-02 09:20:31'),
(41, 'e2586f0f-7fa3-4293-8ad6-2162ab7082a3', 38, 'Individual Reports', '#', 'individualreports', 1, 0, 0, 0, 'A', '5', '2024-12-07 06:50:41', NULL, NULL),
(42, 'c6ef956e-21f6-4893-a3cf-44946d7ee61c', 38, 'All Employees Reports', '.', 'allemployeesreports', 2, 0, 0, 0, 'A', '5', '2024-12-07 06:51:50', '5', '2024-12-07 06:52:17'),
(43, 'd32afc48-fa65-4ba4-9f68-30ddc4f5a384', NULL, 'Hardware and Network', 'bi bi-motherboard', '#', 6, 0, 0, 0, 'A', '5', '2024-12-08 07:34:25', '5', '2024-12-08 07:35:03'),
(44, 'e946e0fe-4c12-435d-baed-cdfdf973196f', 43, 'Hardware', '#', 'hardware', 1, 0, 0, 0, 'A', '5', '2024-12-08 07:35:37', NULL, NULL),
(45, '51ee7dc7-a481-44ed-8a8d-937f6d5f89cc', 43, 'Network', '#', 'network', 2, 0, 0, 0, 'A', '5', '2024-12-08 07:36:10', NULL, NULL),
(46, '307f76c0-2d18-4255-9ac4-6cb812b1c29e', 43, 'Components', '#', 'components', 3, 0, 0, 0, 'A', '5', '2024-12-10 08:41:25', NULL, NULL),
(47, 'e98c8fd7-999b-4e76-960e-f41ee55ab067', 43, 'Type/Size', '#', 'typesize', 4, 0, 0, 0, 'A', '5', '2024-12-10 09:12:55', NULL, NULL),
(48, '6f458d16-bf57-404d-ac51-e6310e4dc7c5', 43, 'Hardware Assign', '#', 'hardwareassign', 2, 0, 0, 0, 'A', '5', '2024-12-24 07:01:22', NULL, NULL),
(49, 'bf577da1-dfe5-43a5-b84e-7f7d40ec7b11', 43, 'Hardware Maintenance', '#', 'hardwaremaintenance', 6, 0, 0, 0, 'A', '5', '2025-01-05 09:36:19', NULL, NULL),
(50, 'd172452e-77c6-4bdd-a637-c019ef1470d4', 33, 'Leave Type', '#', 'leavetype', 3, 0, 0, 0, 'A', '5', '2025-01-07 06:13:26', NULL, NULL),
(51, '721e96f5-a42d-41e0-9f2e-c765e50a4bc1', 3, 'Menu Assign', '#', 'menuassign', 2, 0, 0, 0, 'A', '5', '2025-01-22 06:54:58', NULL, NULL),
(52, '875f7f32-ab72-4e6d-ab54-8a34d16a1aa6', 33, 'Leave Setup', '#', 'leavesetup', 1, 0, 0, 0, 'A', '5', '2025-01-23 10:43:49', NULL, NULL),
(53, '11ef35b6-afb7-43a5-8a7c-6706b078d0ae', 33, 'Leave Balance', '#', 'leavebalance', 2, 0, 0, 0, 'A', '5', '2025-01-26 09:35:47', NULL, NULL),
(54, 'b9451ab8-6de1-4a81-8799-74a8b4c6fd81', 3, 'Menu', '#', '/menu', 2, 0, 0, 0, 'A', '5', '2025-02-26 07:13:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_size`
--

CREATE TABLE `type_size` (
  `id` int(11) NOT NULL,
  `components_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(222) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_size`
--

INSERT INTO `type_size` (`id`, `components_id`, `name`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'DDR3', 'A', '2024-12-10 04:34:34', '2024-12-10 04:34:34', 5, NULL),
(2, 2, 'HDD', 'A', '2024-12-10 04:40:04', '2024-12-10 04:40:04', 5, NULL),
(3, NULL, 'DDR5', 'A', '2024-12-17 03:18:54', '2024-12-19 00:51:48', 5, NULL),
(4, 1, 'DDR4', 'A', '2024-12-17 03:21:45', '2024-12-19 01:03:35', 5, NULL),
(6, 2, 'SSD', 'A', '2024-12-19 01:03:51', '2024-12-19 01:03:51', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` varchar(36) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `name`, `phone`, `email`, `photo`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `latitude`, `longitude`) VALUES
(5, '4d33c03d-a283-4bc3-8322-4d5e7fa168de', 'Super Admin', '010000000', 'superadmin@gmail.com', NULL, 'A', '2024-09-04 01:04:32', '$2y$12$f/D1stmGvccC3xBXA/cEHekoUkSldce/WWgfVooeNDkTutdgfX5jm', NULL, '2024-09-04 01:04:32', '2025-10-16 00:05:39', '23.7426003', '90.4138613'),
(119, '55912478-74d5-4c5f-ab72-92ef67db75da', 'Abidur Rahman Dhali Abir', '01684924439', 'abirdhali6876@gmail.com', 'photos/am3ws8VbXACY6jhxLYUf1WW3PMM3mJndXrIzzq8m.jpg', NULL, NULL, '$2y$10$nGV8Pj7O/2HMf5EDUHevauAfLQ1g3Gm8o922qRY0lgt0XQ15t2r9C', NULL, '2024-11-17 03:30:43', '2025-06-14 01:33:11', '', ''),
(138, 'cd845858-8cbd-4737-92d6-a5b83ff338f4', 'Human Resource Management', '3424', 'hr@srl.com.bd', 'photos/V8KCstAqivCTMptnqWx0q8fOtoioeCnzrx3UFv2j.jpg', NULL, NULL, '$2y$10$JFAkNqxlXHG7BRMdq2gKkug2NuHE3.P7MmfhDujQ7yDXLNRyOR/VK', NULL, '2025-01-14 01:17:35', '2025-06-14 01:34:49', '', ''),
(181, '13400146-4137-493b-bf9d-8ff7fe0d69b5', 'Saiful Hasan', '016747927', 'saifulhasan.srlbd@gmail.com', 'employeee/profile/4522021d-812b-42bd-85f0-f2a7c2f7df42.webp', 'A', NULL, '$2y$12$jNjTZ8ZF3/ERuJVoCVSwXepBUC/SrUaehupBCjPIy9kPo7H3HVIY.', NULL, '2025-09-17 04:01:11', '2025-09-17 04:01:11', '23.7919', '90.4245'),
(183, '58b856d8-55b9-42dc-bf40-aae012321c1b', 'Test', '112', 'testing@gmail.com', 'photos/igGvJk2s1wTCI4mWQlxJ5OvCiGgTHrhcFdJJ7fdS.webp', '1', NULL, '$2y$12$R572HxHrs9AZwb7FrYAE2eaMz8g3BhwUmA2NUI7x1ovw8ZHtcWN9K', NULL, '2025-10-15 05:50:32', '2025-10-15 05:50:32', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_assign`
--
ALTER TABLE `menu_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `processor_generation`
--
ALTER TABLE `processor_generation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `last_activity` (`last_activity`);

--
-- Indexes for table `sms_web_sidebar_menu`
--
ALTER TABLE `sms_web_sidebar_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_size`
--
ALTER TABLE `type_size`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1102051;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `menu_assign`
--
ALTER TABLE `menu_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `processor_generation`
--
ALTER TABLE `processor_generation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sms_web_sidebar_menu`
--
ALTER TABLE `sms_web_sidebar_menu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `type_size`
--
ALTER TABLE `type_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
