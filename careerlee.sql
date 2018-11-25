-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2018 at 11:38 AM
-- Server version: 5.7.14
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `careerlee`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_ar` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `content_ar` text COLLATE utf8mb4_bin NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `content_en` text COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `applied_jobs`
--

CREATE TABLE `applied_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `applied_jobs`
--

INSERT INTO `applied_jobs` (`id`, `user_id`, `job_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2018-10-28 07:00:04', '2018-10-28 07:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `app_rates`
--

CREATE TABLE `app_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `app_rates`
--

INSERT INTO `app_rates` (`id`, `user_id`, `rate`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2018-10-25 22:44:06', '2018-10-25 22:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `course` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `duration` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `user_id`, `course`, `duration`, `created_at`, `updated_at`) VALUES
(1, 1, 'PHP', '3 months', '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(2, 1, 'Python', '3 months', '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(3, 2, 'PHP', '3 months', '2018-10-27 06:11:41', '2018-10-27 06:11:41'),
(4, 2, 'Python', '3 months', '2018-10-27 06:11:41', '2018-10-27 06:11:41'),
(46, 3, 'Python', '3 months', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(45, 3, 'PHP', '3 months', '2018-10-28 05:58:34', '2018-10-28 05:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `company_image` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `from` timestamp NOT NULL,
  `to` timestamp NULL DEFAULT NULL,
  `current` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `user_id`, `position`, `company_name`, `company_image`, `from`, `to`, `current`, `created_at`, `updated_at`) VALUES
(1, 1, 'CEO', 'Microsoft', 'Image File', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(2, 1, 'CEO', 'Google', 'Image File', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(3, 2, 'CEO', 'Microsoft', 'Image File', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-27 06:12:26', '2018-10-27 06:12:26'),
(4, 2, 'CEO', 'Google', 'Image File', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-27 06:12:26', '2018-10-27 06:12:26'),
(50, 3, 'Software Engineer', 'Google', '', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-28 05:59:19', '2018-10-28 05:59:19'),
(49, 3, 'Software Engineer', 'Microsoft', '', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-28 05:59:19', '2018-10-28 05:59:19'),
(48, 3, 'Software Engineer', 'Google', '', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(47, 3, 'Software Engineer', 'Microsoft', '', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(46, 1, 'CEO', 'Google', '', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-28 05:29:07', '2018-10-28 05:29:07'),
(45, 1, 'CEO', 'Microsoft', '', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-28 05:29:07', '2018-10-28 05:29:07'),
(44, 1, 'CEO', 'Google', '', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-28 05:23:53', '2018-10-28 05:23:53'),
(43, 1, 'CEO', 'Microsoft', '', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-28 05:23:53', '2018-10-28 05:23:53'),
(42, 1, 'CEO', 'Google', '', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-28 05:22:21', '2018-10-28 05:22:21'),
(41, 1, 'CEO', 'Microsoft', '', '2010-10-09 22:00:00', '2018-10-09 22:00:00', 0, '2018-10-28 05:22:21', '2018-10-28 05:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `job_id`, `created_at`, `updated_at`) VALUES
(6, 3, 1, '2018-10-28 07:23:14', '2018-10-28 07:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `feature_requests`
--

CREATE TABLE `feature_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `feature_requests`
--

INSERT INTO `feature_requests` (`id`, `user_id`, `job_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2018-10-27 22:40:04', '2018-10-27 22:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'ذكر', 'male', NULL, NULL),
(2, 'أنثى', 'female', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `helps`
--

CREATE TABLE `helps` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_ar` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `content_ar` text COLLATE utf8mb4_bin NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `content_en` text COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

CREATE TABLE `industries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `industries`
--

INSERT INTO `industries` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'تكنولوجيا المعلومات', 'Information Technology', NULL, NULL),
(2, 'أمن المعلومات', 'Information Security', NULL, NULL),
(3, 'علوم الحاسب', 'Computer Science', NULL, NULL),
(4, 'موارد بشرية', 'HR', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `requirements` text COLLATE utf8mb4_bin NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `start_salary` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `final_salary` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `salary_per` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `title`, `address`, `company_name`, `image`, `requirements`, `description`, `start_salary`, `final_salary`, `featured`, `salary_per`, `created_at`, `updated_at`) VALUES
(1, 1, 'Job title', 'Jaddah, Saudi Arabia', 'Company name', '', 'We are looking for UI/UX designer to join our family in our speed office in Sauldi Arabia', 'We are looking for UI/UX designer to join our family in our speed office in Sauldi Arabia', '5000', '10000', 0, 'month', '2018-10-26 00:39:12', '2018-10-26 00:39:12'),
(2, 1, 'Job title', 'Jaddah, Saudi Arabia', 'Company name', '', 'We are looking for UI/UX designer to join our family in our speed office in Sauldi Arabia', 'We are looking for UI/UX designer to join our family in our speed office in Sauldi Arabia', '5000', '10000', 0, 'month', '2018-10-26 00:47:13', '2018-10-26 00:47:13'),
(3, 1, 'Job title', 'Jaddah, Saudi Arabia', 'Company name', '', 'We are looking for UI/UX designer to join our family in our speed office in Sauldi Arabia', 'We are looking for UI/UX designer to join our family in our speed office in Sauldi Arabia', '5000', '10000', 0, 'month', '2018-10-26 00:47:25', '2018-10-26 00:47:25'),
(4, 1, 'Job title', 'Jaddah, Saudi Arabia', 'Company name', '', 'We are looking for UI/UX designer to join our family in our speed office in Sauldi Arabia', 'We are looking for UI/UX designer to join our family in our speed office in Sauldi Arabia', '5000', '10000', 0, 'month', '2018-10-26 00:47:44', '2018-10-26 00:47:44'),
(5, 1, 'Job title', 'Jaddah, Saudi Arabia', 'Company name', '', 'We are looking for UI/UX designer to join our family in our speed office in Sauldi Arabia', 'We are looking for UI/UX designer to join our family in our speed office in Sauldi Arabia', '5000', '10000', 0, 'month', '2018-10-26 00:48:13', '2018-10-26 00:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `job_invitations`
--

CREATE TABLE `job_invitations` (
  `id` int(10) UNSIGNED NOT NULL,
  `employer_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `job_invitations`
--

INSERT INTO `job_invitations` (`id`, `employer_id`, `employee_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2018-10-27 11:08:09', '2018-10-27 11:08:09'),
(2, 1, 3, 0, '2018-10-28 08:09:46', '2018-10-28 08:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `job_tags`
--

CREATE TABLE `job_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `job_tags`
--

INSERT INTO `job_tags` (`id`, `job_id`, `tag`, `created_at`, `updated_at`) VALUES
(1, 3, 'UI Designer', '2018-10-26 00:47:25', '2018-10-26 00:47:25'),
(2, 3, 'UX Designer', '2018-10-26 00:47:25', '2018-10-26 00:47:25'),
(3, 3, 'UI/UX', '2018-10-26 00:47:25', '2018-10-26 00:47:25'),
(4, 4, 'UI Designer', '2018-10-26 00:47:44', '2018-10-26 00:47:44'),
(5, 4, 'UX Designer', '2018-10-26 00:47:44', '2018-10-26 00:47:44'),
(6, 4, 'UI/UX', '2018-10-26 00:47:44', '2018-10-26 00:47:44'),
(7, 5, 'UI Designer', '2018-10-26 00:48:13', '2018-10-26 00:48:13'),
(8, 5, 'UX Designer', '2018-10-26 00:48:13', '2018-10-26 00:48:13'),
(9, 5, 'UI/UX', '2018-10-26 00:48:13', '2018-10-26 00:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `job_views`
--

CREATE TABLE `job_views` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `job_views`
--

INSERT INTO `job_views` (`id`, `user_id`, `job_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2018-10-28 06:32:10', '2018-10-28 06:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `maritals`
--

CREATE TABLE `maritals` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_22_133934_create_roles_table', 1),
(4, '2018_10_22_133956_create_courses_table', 2),
(5, '2018_10_22_134024_create_experiences_table', 2),
(6, '2018_10_22_134104_create_user_languages_table', 2),
(7, '2018_10_22_134130_create_companies_table', 2),
(8, '2018_10_22_134153_create_countries_table', 2),
(22, '2018_10_22_134207_create_jobs_table', 3),
(10, '2018_10_22_134233_create_user_preferences_table', 2),
(11, '2018_10_22_134258_create_job_views_table', 2),
(12, '2018_10_22_134318_create_favourites_table', 2),
(13, '2018_10_22_134343_create_applied_jobs_table', 2),
(14, '2018_10_22_134406_create_app_rates_table', 2),
(15, '2018_10_22_134424_create_notifications_table', 2),
(16, '2018_10_22_134448_create_abouts_table', 2),
(17, '2018_10_22_134514_create_helps_table', 2),
(18, '2018_10_22_205806_create_genders_table', 2),
(19, '2018_10_22_211331_create_maritals_table', 2),
(20, '2018_10_22_213336_create_job_tags_table', 2),
(23, '2018_10_25_202253_create_skills_table', 4),
(24, '2018_10_27_063314_create_user_educations_table', 5),
(25, '2018_10_27_084224_create_user_industries_table', 6),
(26, '2018_10_27_124948_create_job_invitations_table', 7),
(27, '2018_10_28_001736_create_feature_requests_table', 8),
(29, '2018_10_28_064201_create_user_locations_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `content_ar` text COLLATE utf8mb4_bin NOT NULL,
  `content_en` text COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `content_ar`, `content_en`, `created_at`, `updated_at`) VALUES
(1, 1, 'تم دعوتك إلى وظيفة جديدة', 'You\'ve been invited for a job', '2018-10-26 00:47:24', '2018-10-26 00:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'employee', NULL, NULL),
(2, 'employer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `skill` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `user_id`, `skill`, `created_at`, `updated_at`) VALUES
(1, 1, 'PHP', '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(2, 1, 'HTML', '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(3, 1, 'Javascript', '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(4, 1, 'Python', '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(5, 2, 'PHP', '2018-10-27 06:12:26', '2018-10-27 06:12:26'),
(6, 2, 'HTML', '2018-10-27 06:12:26', '2018-10-27 06:12:26'),
(7, 2, 'Javascript', '2018-10-27 06:12:26', '2018-10-27 06:12:26'),
(8, 2, 'Python', '2018-10-27 06:12:26', '2018-10-27 06:12:26'),
(86, 3, 'Algorithms', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(85, 3, 'Data Structure', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(84, 3, 'Python', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(83, 3, 'Javascript', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(82, 3, 'HTML', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(81, 3, 'PHP', '2018-10-28 05:58:34', '2018-10-28 05:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `marital_status` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `driving_license` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `lang` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `bio` text COLLATE utf8mb4_bin,
  `code` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `firebase` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `min_company_size` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `max_company_size` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `company_location` varchar(191) COLLATE utf8mb4_bin DEFAULT NULL,
  `job_match_notify` tinyint(1) NOT NULL DEFAULT '0',
  `job_expired_notify` tinyint(1) NOT NULL DEFAULT '0',
  `job_finder_notify` tinyint(1) NOT NULL DEFAULT '0',
  `birth_date` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `role_id`, `gender`, `marital_status`, `nationality`, `driving_license`, `status`, `address`, `image`, `phone`, `email`, `password`, `lang`, `bio`, `code`, `firebase`, `min_company_size`, `max_company_size`, `company_location`, `job_match_notify`, `job_expired_notify`, `job_finder_notify`, `birth_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tarek Ibrahim', 2, 'male', 'single', 'Saudian', '1', 1, 'asd-asd-asd', '94370815bd1d2194967e.jpg', '966530090080', 'mansour@gmail.com', '$2y$10$7Ww/haPGTgw0W9IZ8u7Om.hlg20QLOSfFMSyRk1bgLa3adSpFuRAW', 'en', NULL, NULL, 'test firebase', '30', '50', 'Saudi Arabia', 1, 1, 1, '2010-10-10', NULL, '2018-10-25 12:24:25', '2018-10-28 05:29:07'),
(2, 'Tarek Mahfouz', 2, '0', '0', NULL, '0', 1, NULL, 'default.png', '966030090080', NULL, '$2y$10$.1vtmWBJr4RDK0NeUsqfI.GKRndm1MfgrtobRd1zermf7LQj4jiX6', 'en', NULL, NULL, 'test firebase', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '2018-10-25 18:35:16', '2018-10-25 22:35:55'),
(3, 'Tarek Ibrahim', 1, 'male', 'single', NULL, '1', 1, 'asd-asd-asd', 'default.png', '966530090088', 'tarek@gmail.com', '$2y$10$2UMaKjn8xhtuUpCx.euw6ef8YodvFIZ7wYczf7kqCIs1xOnW.ffgS', 'en', NULL, '8460', 'test firebase', '30', '50', NULL, 1, 1, 1, '2010-10-10', NULL, '2018-10-28 05:38:03', '2018-10-28 05:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_educations`
--

CREATE TABLE `user_educations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `institution` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user_educations`
--

INSERT INTO `user_educations` (`id`, `user_id`, `institution`, `degree`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'FCI', 'very good', '2011-10-10', '2015-07-07', '2018-10-27 05:23:12', '2018-10-27 05:23:12'),
(2, 1, 'ITI', 'Exillent', '2015-10-10', '2016-07-07', '2018-10-27 05:23:12', '2018-10-27 05:23:12'),
(3, 2, 'FCI', 'very good', '2011-10-10', '2015-07-07', '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(4, 2, 'ITI', 'Exillent', '2015-10-10', '2016-07-07', '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(58, 3, 'ITI', 'Exillent', '2015-10-10', '2016-07-07', '2018-10-28 05:59:19', '2018-10-28 05:59:19'),
(57, 3, 'FCI', 'very good', '2011-10-10', '2015-07-07', '2018-10-28 05:59:19', '2018-10-28 05:59:19'),
(56, 3, 'ITI', 'Exillent', '2015-10-10', '2016-07-07', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(55, 3, 'FCI', 'very good', '2011-10-10', '2015-07-07', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(54, 1, 'ITI', 'Exillent', '2015-10-10', '2016-07-07', '2018-10-28 05:29:07', '2018-10-28 05:29:07'),
(53, 1, 'FCI', 'very good', '2011-10-10', '2015-07-07', '2018-10-28 05:29:07', '2018-10-28 05:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_industries`
--

CREATE TABLE `user_industries` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `industry_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user_industries`
--

INSERT INTO `user_industries` (`id`, `user_id`, `industry_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-10-27 07:02:00', '2018-10-27 07:02:00'),
(2, 1, 2, '2018-10-27 07:02:00', '2018-10-27 07:02:00'),
(3, 1, 3, '2018-10-27 07:02:00', '2018-10-27 07:02:00'),
(4, 2, 1, '2018-10-27 10:38:55', '2018-10-27 10:38:55'),
(5, 2, 2, '2018-10-27 10:38:55', '2018-10-27 10:38:55'),
(6, 2, 3, '2018-10-27 10:38:55', '2018-10-27 10:38:55'),
(24, 3, 3, '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(23, 3, 2, '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(22, 3, 1, '2018-10-28 05:58:34', '2018-10-28 05:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_languages`
--

CREATE TABLE `user_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user_languages`
--

INSERT INTO `user_languages` (`id`, `user_id`, `language`, `created_at`, `updated_at`) VALUES
(1, 1, 'Arabic', '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(2, 1, 'English', '2018-10-27 05:24:26', '2018-10-27 05:24:26'),
(3, 2, 'Arabic', '2018-10-27 06:12:26', '2018-10-27 06:12:26'),
(4, 2, 'English', '2018-10-27 06:12:26', '2018-10-27 06:12:26'),
(38, 3, 'English', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(37, 3, 'Arabic', '2018-10-28 05:58:34', '2018-10-28 05:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user_locations`
--

INSERT INTO `user_locations` (`id`, `user_id`, `location`, `created_at`, `updated_at`) VALUES
(1, 1, 'Saudi Arabia', '2018-10-28 05:02:22', '2018-10-28 05:02:22'),
(2, 1, 'Lebanon', '2018-10-28 05:02:22', '2018-10-28 05:02:22'),
(3, 3, 'Saudi Arabia', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(4, 3, 'Lebanon', '2018-10-28 05:58:34', '2018-10-28 05:58:34'),
(5, 3, 'Egypt', '2018-10-28 05:58:34', '2018-10-28 05:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_preferences`
--

CREATE TABLE `user_preferences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applied_jobs_user_id_foreign` (`user_id`),
  ADD KEY `applied_jobs_job_id_foreign` (`job_id`);

--
-- Indexes for table `app_rates`
--
ALTER TABLE `app_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_rates_user_id_unique` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_user_id_foreign` (`user_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiences_user_id_foreign` (`user_id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourites_user_id_foreign` (`user_id`),
  ADD KEY `favourites_job_id_foreign` (`job_id`);

--
-- Indexes for table `feature_requests`
--
ALTER TABLE `feature_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_requests_user_id_foreign` (`user_id`),
  ADD KEY `feature_requests_job_id_foreign` (`job_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `helps`
--
ALTER TABLE `helps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industries`
--
ALTER TABLE `industries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_user_id_foreign` (`user_id`);

--
-- Indexes for table `job_invitations`
--
ALTER TABLE `job_invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_invitations_employer_id_foreign` (`employer_id`);

--
-- Indexes for table `job_tags`
--
ALTER TABLE `job_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_tags_job_id_foreign` (`job_id`);

--
-- Indexes for table `job_views`
--
ALTER TABLE `job_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_views_user_id_foreign` (`user_id`),
  ADD KEY `job_views_job_id_foreign` (`job_id`);

--
-- Indexes for table `maritals`
--
ALTER TABLE `maritals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skills_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_gender_id_foreign` (`gender`),
  ADD KEY `users_marital_id_foreign` (`marital_status`);

--
-- Indexes for table `user_educations`
--
ALTER TABLE `user_educations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_educations_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_industries`
--
ALTER TABLE `user_industries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_industries_user_id_foreign` (`user_id`),
  ADD KEY `user_industries_industry_id_foreign` (`industry_id`);

--
-- Indexes for table `user_languages`
--
ALTER TABLE `user_languages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_languages_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_locations_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_preferences_user_id_foreign` (`user_id`),
  ADD KEY `user_preferences_company_id_foreign` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `app_rates`
--
ALTER TABLE `app_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `feature_requests`
--
ALTER TABLE `feature_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `helps`
--
ALTER TABLE `helps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `industries`
--
ALTER TABLE `industries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `job_invitations`
--
ALTER TABLE `job_invitations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `job_tags`
--
ALTER TABLE `job_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `job_views`
--
ALTER TABLE `job_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `maritals`
--
ALTER TABLE `maritals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_educations`
--
ALTER TABLE `user_educations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `user_industries`
--
ALTER TABLE `user_industries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user_languages`
--
ALTER TABLE `user_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_preferences`
--
ALTER TABLE `user_preferences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
