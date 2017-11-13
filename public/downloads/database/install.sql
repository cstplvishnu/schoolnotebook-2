-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2017 at 01:28 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school-l54`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicholidays`
--

CREATE TABLE `academicholidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('day','date') COLLATE utf8_unicode_ci NOT NULL,
  `day` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `reason` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `academics`
--

CREATE TABLE `academics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_year_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `academic_start_date` date NOT NULL,
  `academic_end_date` date NOT NULL,
  `show_in_list` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `academics`
--


-- --------------------------------------------------------

--
-- Table structure for table `academic_course`
--

CREATE TABLE `academic_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `course_parent_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `academic_course`
--


-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'male',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_type` enum('questions') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'questions',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificateissues`
--

CREATE TABLE `certificateissues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `roll_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `academic_year_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `course_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `certificate_data` text COLLATE utf8_unicode_ci,
  `certificate_type` enum('bonafide','tc') COLLATE utf8_unicode_ci NOT NULL,
  `reference_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `issued_by` bigint(20) UNSIGNED NOT NULL,
  `current_year` int(11) NOT NULL,
  `current_semister` int(11) NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificatetemplates`
--

CREATE TABLE `certificatetemplates` (
  `id` int(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `type` enum('content','header','footer','independent') NOT NULL,
  `updated_by` int(50) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'YU', 'Yugoslavia'),
(244, 'ZR', 'Zaire'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `couponcodes`
--

CREATE TABLE `couponcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount_type` enum('value','percent') COLLATE utf8_unicode_ci NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `minimum_bill` decimal(10,2) NOT NULL,
  `discount_maximum_amount` decimal(10,2) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_to` date NOT NULL,
  `usage_limit` int(11) NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `coupon_code_applicability` text COLLATE utf8_unicode_ci,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `couponcodes_usage`
--

CREATE TABLE `couponcodes_usage` (
  `id` bigint(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_cost` decimal(10,2) NOT NULL,
  `total_invoice_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` tinyint(4) NOT NULL DEFAULT '0',
  `course_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `course_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course_dueration` int(11) NOT NULL,
  `grade_system` enum('percentage','gpa') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'percentage',
  `is_having_semister` tinyint(4) NOT NULL DEFAULT '0',
  `is_having_elective_subjects` tinyint(4) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--


-- --------------------------------------------------------

--
-- Table structure for table `coursesemisters`
--

CREATE TABLE `coursesemisters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(10) UNSIGNED NOT NULL,
  `total_semisters` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coursesemisters`
--


-- --------------------------------------------------------

--
-- Table structure for table `course_subject`
--

CREATE TABLE `course_subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `course_parent_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `semister` int(11) NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `sessions_needed` int(11) NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

CREATE TABLE `emailtemplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('header','footer','content') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'content',
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `from_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_updated_by` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emailtemplates`
--

INSERT INTO `emailtemplates` (`id`, `title`, `slug`, `type`, `subject`, `content`, `from_email`, `from_name`, `record_updated_by`, `created_at`, `updated_at`) VALUES
(1, 'header', 'header', 'content', 'header', '<p>Email</p>\r\n<!-- Start of preheader -->\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n  <tbody>\r\n   <tr>\r\n      <td>\r\n      <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n       <tbody><!-- Spacing -->\r\n         <tr>\r\n            <td>&nbsp;</td>\r\n         </tr>\r\n         <!-- Spacing -->\r\n          <tr>\r\n            <td>If you cannot read this email, please <a href=\"#\"> click here </a></td>\r\n         </tr>\r\n         <!-- Spacing -->\r\n          <tr>\r\n            <td>&nbsp;</td>\r\n         </tr>\r\n         <!-- Spacing -->\r\n        </tbody>\r\n      </table>\r\n      </td>\r\n   </tr>\r\n </tbody>\r\n</table>\r\n<!-- End of preheader --><!-- start of header -->\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n  <tbody>\r\n   <tr>\r\n      <td>\r\n      <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n       <tbody>\r\n         <tr>\r\n            <td><!-- logo -->\r\n           <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:280px\">\r\n             <tbody>\r\n               <tr>\r\n                  <td>\r\n                  <p><a href=\"#\"><img alt=\"logo\" src=\"http://yoursite.com/public/uploads/settings/eKFhxlkXcMtX5xW.png\" /> </a></p>\r\n                  </td>\r\n               </tr>\r\n             </tbody>\r\n            </table>\r\n            <!-- End of logo --><!-- menu -->\r\n\r\n           <table align=\"right\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:280px\">\r\n              <tbody>\r\n               <tr>\r\n                  <td><a href=\"#\">HOME </a> | <a href=\"#\"> ABOUT </a> | <a href=\"#\"> SHOP </a></td>\r\n                 <td>&nbsp;</td>\r\n               </tr>\r\n             </tbody>\r\n            </table>\r\n            <!-- End of Menu --></td>\r\n         </tr>\r\n       </tbody>\r\n      </table>\r\n      </td>\r\n   </tr>\r\n </tbody>\r\n</table>\r\n<!-- end of header -->', 'no@noemail.com', 'Test', 1, '2016-07-19 06:23:14', '2016-12-16 11:39:35'),
(2, 'footer', 'footer', 'footer', 'footer', '<div class=\"block\">\r\n    <!-- Start of preheader -->\r\n    <table bgcolor=\"#f6f4f5\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" st-sortable=\"postfooter\" width=\"100%\">\r\n        <tbody>\r\n            <tr>\r\n                <td width=\"100%\">\r\n                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" width=\"580\">\r\n                        <tbody>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td height=\"5\" width=\"100%\">\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td align=\"center\" st-content=\"preheader\" style=\"font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999\" valign=\"middle\">\r\n                                    If you don\'t want to receive updates. please\r\n                                    <a class=\"hlite\" href=\"#\" style=\"text-decoration: none; color: #0db9ea\">\r\n                                        unsubscribe\r\n                                    </a>\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td height=\"5\" width=\"100%\">\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                        </tbody>\r\n                    </table>\r\n                </td>\r\n            </tr>\r\n        </tbody>\r\n    </table>\r\n    <!-- End of preheader -->\r\n</div>', 'no@noemail.com', 'Test', 2, '2016-07-19 06:24:08', '2016-07-19 06:30:21'),
(3, 'exam-result', 'exam-result', 'content', 'Exam Result', '', 'admin@gmail.com', 'Test', 1, '2016-07-19 06:37:51', '2016-12-12 06:18:17'),
(4, 'registration', 'registration', 'content', 'Welcome', '<!-- Full + text -->\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\n  <tbody>\n   <tr>\n      <td>\n      <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\n       <tbody>\n         <tr>\n            <td>&nbsp;</td>\n         </tr>\n         <tr>\n            <td>\n            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\n             <tbody><!-- title -->\n               <tr>\n                  <td style=\"text-align:left\">&nbsp;</td>\n               </tr>\n               <!-- end of title --><!-- Spacing -->\n               <tr>\n                  <td>&nbsp;</td>\n               </tr>\n               <!-- Spacing --><!-- content -->\n                <tr>\n                  <td style=\"text-align:left\">\n                  <p>Dear {{ $user_name }},<br />\n                 You have successfully registered with Academia.</p>\n\n                 <p>The credentials are</p>\n\n                  <p>Username: {{$username}} / {{$to_email}}</p>\n\n                  <p>Password: {{$password}}</p>\n\n                  <p>Enjoy the facilities provided by our system.</p>\n\n                 <p>Please contact admin for further details.</p>\n                  </td>\n               </tr>\n               <!-- end of content --><!-- Spacing -->\n               <tr>\n                  <td>&nbsp;</td>\n               </tr>\n               <!-- Spacing -->\n                <tr>\n                  <td>&nbsp;</td>\n               </tr>\n               <!-- button -->\n               <tr>\n                  <td>\n                  <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\n                   <tbody>\n                     <tr>\n                        <td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\n                     </tr>\n                   </tbody>\n                  </table>\n                  </td>\n               </tr>\n               <!-- /button --><!-- Spacing -->\n                <tr>\n                  <td>&nbsp;</td>\n               </tr>\n               <!-- Spacing -->\n              </tbody>\n            </table>\n            </td>\n         </tr>\n       </tbody>\n      </table>\n      </td>\n   </tr>\n </tbody>\n</table>\n', 'admin@academia.com', 'Academia Admin', 1, '2016-07-29 03:48:18', '2016-10-27 18:45:43'),
(5, 'subscription', 'subscription', 'content', 'Subscription Successfull', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n <tbody>\r\n   <tr>\r\n      <td>\r\n      <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n       <tbody>\r\n         <tr>\r\n            <td>&nbsp;</td>\r\n         </tr>\r\n         <tr>\r\n            <td>\r\n            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n              <tbody><!-- title -->\r\n               <tr>\r\n                  <td style=\"text-align:left\">&nbsp;</td>\r\n               </tr>\r\n               <!-- end of title --><!-- Spacing -->\r\n               <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing --><!-- content -->\r\n                <tr>\r\n                  <td style=\"text-align:left\">Dear {{ $username }},<br />\r\n                 You have successfully subscribed to {{ ucfirst($plan)}} plan with transaction {{$id}}. Enjoy the facilities provided by our system.</td>\r\n                </tr>\r\n               <!-- end of content --><!-- Spacing -->\r\n               <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing -->\r\n                <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- button -->\r\n               <tr>\r\n                  <td>\r\n                  <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n                   <tbody>\r\n                     <tr>\r\n                        <td style=\"background-color:#0db9ea; text-align:center\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n                     </tr>\r\n                   </tbody>\r\n                  </table>\r\n                  </td>\r\n               </tr>\r\n               <!-- /button --><!-- Spacing -->\r\n                <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing -->\r\n              </tbody>\r\n            </table>\r\n            </td>\r\n         </tr>\r\n       </tbody>\r\n      </table>\r\n      </td>\r\n   </tr>\r\n </tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Jack', 1, '2016-08-03 01:00:58', '2016-09-03 01:59:12'),
(6, 'offline_subscription_failed', 'offline-subscription-failed', 'content', 'Offline Subscription Failed', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n  <tbody>\r\n   <tr>\r\n      <td>\r\n      <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n       <tbody>\r\n         <tr>\r\n            <td>&nbsp;</td>\r\n         </tr>\r\n         <tr>\r\n            <td>\r\n            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n              <tbody><!-- title -->\r\n               <tr>\r\n                  <td style=\"text-align:left\">&nbsp;</td>\r\n               </tr>\r\n               <!-- end of title --><!-- Spacing -->\r\n               <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing --><!-- content -->\r\n                <tr>\r\n                  <td style=\"text-align:left\">\r\n                  <p>Dear {{ $username }},<br />\r\n                  Your attempt for offline subscription to {{ ucfirst($plan)}} plan is failed.</p>\r\n\r\n                  <p>Please find the admin comment</p>\r\n\r\n                  <p><u><strong>Admin Comment:</strong></u></p>\r\n\r\n                 <p>&nbsp;{{$admin_comment}}.</p>\r\n\r\n                  <p>Please contact admin for further details.</p>\r\n                  </td>\r\n               </tr>\r\n               <!-- end of content --><!-- Spacing -->\r\n               <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing -->\r\n                <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- button -->\r\n               <tr>\r\n                  <td>\r\n                  <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n                   <tbody>\r\n                     <tr>\r\n                        <td style=\"background-color:#0db9ea; text-align:center\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n                     </tr>\r\n                   </tbody>\r\n                  </table>\r\n                  </td>\r\n               </tr>\r\n               <!-- /button --><!-- Spacing -->\r\n                <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing -->\r\n              </tbody>\r\n            </table>\r\n            </td>\r\n         </tr>\r\n       </tbody>\r\n      </table>\r\n      </td>\r\n   </tr>\r\n </tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-15 10:31:47', '2016-10-18 14:36:14'),
(7, 'offline_subscription_success', 'offline-subscription-success', 'content', 'Offline Subscription Success', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n <tbody>\r\n   <tr>\r\n      <td>\r\n      <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n       <tbody>\r\n         <tr>\r\n            <td>&nbsp;</td>\r\n         </tr>\r\n         <tr>\r\n            <td>\r\n            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n              <tbody><!-- title -->\r\n               <tr>\r\n                  <td style=\"text-align:left\">&nbsp;</td>\r\n               </tr>\r\n               <!-- end of title --><!-- Spacing -->\r\n               <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing --><!-- content -->\r\n                <tr>\r\n                  <td style=\"text-align:left\">\r\n                  <p>Dear {{ $username }},<br />\r\n                  Your attempt for offline subscription to {{ ucfirst($plan)}} plan is success. &nbsp;</p>\r\n\r\n                  <p><u><strong>Admin Comment</strong></u></p>\r\n\r\n                  <p>&nbsp;{{$admin_comment}}.</p>\r\n\r\n                  <p>Please contact admin for further details.</p>\r\n                  </td>\r\n               </tr>\r\n               <!-- end of content --><!-- Spacing -->\r\n               <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing -->\r\n                <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- button -->\r\n               <tr>\r\n                  <td>\r\n                  <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n                   <tbody>\r\n                     <tr>\r\n                        <td style=\"background-color: rgb(13, 185, 234); text-align: justify;\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n                     </tr>\r\n                   </tbody>\r\n                  </table>\r\n                  </td>\r\n               </tr>\r\n               <!-- /button --><!-- Spacing -->\r\n                <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing -->\r\n              </tbody>\r\n            </table>\r\n            </td>\r\n         </tr>\r\n       </tbody>\r\n      </table>\r\n      </td>\r\n   </tr>\r\n </tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-15 10:35:32', '2016-10-18 14:27:15'),
(8, 'subscription_success', 'subscription-success', 'content', 'Your Subscription was Success', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n  <tbody>\r\n   <tr>\r\n      <td>\r\n      <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n       <tbody>\r\n         <tr>\r\n            <td>&nbsp;</td>\r\n         </tr>\r\n         <tr>\r\n            <td>\r\n            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n             <tbody><!-- title -->\r\n               <tr>\r\n                  <td style=\"text-align:left\">&nbsp;</td>\r\n               </tr>\r\n               <!-- end of title --><!-- Spacing -->\r\n               <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing --><!-- content -->\r\n                <tr>\r\n                  <td style=\"text-align:left\">\r\n                  <p>Dear {{ $username }},<br />\r\n                  Your subscription to {{ ucfirst($plan)}} plan is success. &nbsp;</p>\r\n\r\n                  <p>Please contact admin for further details.</p>\r\n                  </td>\r\n               </tr>\r\n               <!-- end of content --><!-- Spacing -->\r\n               <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing -->\r\n                <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- button -->\r\n               <tr>\r\n                  <td>\r\n                  <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n                   <tbody>\r\n                     <tr>\r\n                        <td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n                     </tr>\r\n                   </tbody>\r\n                  </table>\r\n                  </td>\r\n               </tr>\r\n               <!-- /button --><!-- Spacing -->\r\n                <tr>\r\n                  <td>&nbsp;</td>\r\n               </tr>\r\n               <!-- Spacing -->\r\n              </tbody>\r\n            </table>\r\n            </td>\r\n         </tr>\r\n       </tbody>\r\n      </table>\r\n      </td>\r\n   </tr>\r\n </tbody>\r\n</table>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-19 15:31:21', '2016-10-19 15:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `examseries`
--

CREATE TABLE `examseries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `cost` decimal(10,2) NOT NULL,
  `validity` int(11) NOT NULL,
  `total_exams` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examseries_data`
--

CREATE TABLE `examseries_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `examseries_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examtoppers`
--

CREATE TABLE `examtoppers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `percentage` decimal(10,2) NOT NULL,
  `rank` int(11) NOT NULL,
  `quiz_result_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feecategories`
--

CREATE TABLE `feecategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `course_parent_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(20) NOT NULL,
  `semister` int(20) NOT NULL,
  `total_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_installments` int(10) NOT NULL DEFAULT '1',
  `installment_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `other_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feecategories`
--


-- --------------------------------------------------------

--
-- Table structure for table `feecategory_particulars`
--

CREATE TABLE `feecategory_particulars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feecategory_id` bigint(20) UNSIGNED NOT NULL,
  `particular_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_refundable` tinyint(2) NOT NULL DEFAULT '0',
  `is_term_applicable` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feecategory_particulars`
--


-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `read_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feeparticular_paymets`
--

CREATE TABLE `feeparticular_paymets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feepayment_id` bigint(20) UNSIGNED NOT NULL,
  `feecategory_id` bigint(20) UNSIGNED NOT NULL,
  `feeparticular_id` bigint(20) UNSIGNED NOT NULL,
  `feecategory_particular_id` bigint(20) UNSIGNED NOT NULL,
  `is_schedule` tinyint(2) NOT NULL DEFAULT '0',
  `feeschedule_particular_id` bigint(20) UNSIGNED DEFAULT NULL,
  `feeschedule_id` bigint(20) UNSIGNED DEFAULT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `net_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_percentage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `term_number` int(10) DEFAULT NULL,
  `carry_forward` tinyint(2) NOT NULL DEFAULT '1',
  `previous_feecategory_id` bigint(20) UNSIGNED NOT NULL,
  `notes` text NOT NULL,
  `comments` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `payment_received_by` bigint(20) UNSIGNED NOT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `course_parent_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(10) NOT NULL DEFAULT '1',
  `semister` int(10) NOT NULL DEFAULT '0',
  `received_on` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feeparticular_paymets`
--

-- --------------------------------------------------------

--
-- Table structure for table `feepayments`
--

CREATE TABLE `feepayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `course_parent_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(10) NOT NULL DEFAULT '1',
  `semister` int(10) NOT NULL DEFAULT '0',
  `feecategory_id` bigint(20) UNSIGNED NOT NULL,
  `feecategory_title` varchar(255) NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `iseligible_for_discount` tinyint(2) NOT NULL DEFAULT '1',
  `discount_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount_title` varchar(255) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ishaving_fine` tinyint(2) NOT NULL DEFAULT '1',
  `fine_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fine_name` varchar(255) NOT NULL,
  `fine_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `previous_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_refundable` tinyint(2) NOT NULL DEFAULT '0',
  `refunded_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `refund_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `refund_description` text NOT NULL,
  `payment_mode` enum('cash','online','cheque','DD','other') NOT NULL DEFAULT 'cash',
  `payment_mode_name` varchar(255) NOT NULL,
  `payment_refrenceno` int(50) NOT NULL,
  `payment_notes` text NOT NULL,
  `payment_status` tinyint(2) NOT NULL DEFAULT '1',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_recevied_by` bigint(20) UNSIGNED NOT NULL,
  `any_extra_particular_added` tinyint(2) NOT NULL DEFAULT '0',
  `any_extra_discount_added` tinyint(2) NOT NULL DEFAULT '0',
  `will_referto_other` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feepayments`
--

-- --------------------------------------------------------

--
-- Table structure for table `feepayments_transactions`
--

CREATE TABLE `feepayments_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feepayment_id` bigint(20) UNSIGNED NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `transaction_no` int(50) NOT NULL,
  `payment_mode` enum('cash','online','cheque','DD','other') NOT NULL DEFAULT 'cash',
  `payment_mode_name` varchar(50) NOT NULL,
  `payment_refrenceno` int(50) NOT NULL,
  `payment_recevied_by` bigint(20) UNSIGNED NOT NULL,
  `payment_notes` text NOT NULL,
  `recevied_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feeschedules`
--

CREATE TABLE `feeschedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feecategory_id` bigint(20) UNSIGNED NOT NULL,
  `total_installments` int(10) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feeschedules`
--


-- --------------------------------------------------------

--
-- Table structure for table `feeschedule_particulars`
--

CREATE TABLE `feeschedule_particulars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feecategory_id` bigint(20) UNSIGNED NOT NULL,
  `feeschedule_id` bigint(20) UNSIGNED NOT NULL,
  `installment` int(10) NOT NULL DEFAULT '1',
  `total_installments` int(10) NOT NULL DEFAULT '1',
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feeschedule_particulars`
--


-- --------------------------------------------------------

--
-- Table structure for table `feeschedule_payments`
--

CREATE TABLE `feeschedule_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feepayment_id` bigint(20) UNSIGNED NOT NULL,
  `feecategory_id` bigint(20) UNSIGNED NOT NULL,
  `feeschedule_id` bigint(20) UNSIGNED NOT NULL,
  `feeschedule_particular_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_recevied_by` bigint(20) UNSIGNED NOT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `course_parent_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `net_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_percentage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `term_number` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `semister` int(10) NOT NULL,
  `received_on` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feeschedule_payments`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `percentage_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percentage_from` decimal(10,2) NOT NULL,
  `percentage_to` decimal(10,2) NOT NULL,
  `grade_points` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `percentage_title`, `grade_title`, `percentage_from`, `percentage_to`, `grade_points`, `created_at`, `updated_at`) VALUES
(1, 'Distinction', 'A+', '75.00', '100.00', '10.00', '2016-07-17 18:30:00', '2016-07-17 18:30:00'),
(2, 'First Class', 'A', '60.00', '74.99', '9.00', '2016-07-17 18:30:00', '2016-07-17 18:30:00'),
(3, 'Second Class', 'B', '50.00', '59.99', '7.00', '2016-07-17 18:30:00', '2016-07-17 18:30:00'),
(4, 'Third Class', 'C', '35.00', '49.99', '6.00', '2016-07-17 18:30:00', '2016-07-17 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Instructions', 'instructions', 'Carry your Hall Ticket', '2016-06-08 03:32:59', '2016-06-08 03:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_rtl` int(11) NOT NULL,
  `is_default` tinyint(2) NOT NULL DEFAULT '0',
  `phrases` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `phrases`, `created_at`, `updated_at`) VALUES
(3, 'Telugu', 'telugu', 'te', 0, 0, '{\"success\":\"\\u0c35\\u0c3f\\u0c1c\\u0c2f\\u0c02\",\"record_updated_successfully\":\"\\u0c30\\u0c3f\\u0c15\\u0c3e\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c35\\u0c3f\\u0c1c\\u0c2f\\u0c35\\u0c02\\u0c24\\u0c02\\u0c17\\u0c3e \\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c3f\\u0c02\\u0c1a\\u0c2c\\u0c21\\u0c3f\\u0c02\\u0c26\\u0c3f\",\"languages\":\"\\u0c2d\\u0c3e\\u0c37\\u0c32\\u0c41\",\"create\":\"\\u0c38\\u0c43\\u0c37\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"language\":\"\\u0c2d\\u0c3e\\u0c37\\u0c3e\",\"code\":\"\\u0c15\\u0c4b\\u0c21\\u0c4d\",\"is_rtl\":\"RTL \\u0c09\\u0c02\\u0c26\\u0c3f\",\"default_language\":\"\\u0c21\\u0c3f\\u0c2b\\u0c3e\\u0c32\\u0c4d\\u0c1f\\u0c4d \\u0c2d\\u0c3e\\u0c37\\u0c3e\",\"action\":\"\\u0c2f\\u0c3e\\u0c15\\u0c4d\\u0c37\\u0c28\\u0c4d\",\"site_title\":\"\\u0c38\\u0c46\\u0c56\\u0c1f\\u0c4d \\u0c36\\u0c40\\u0c30\\u0c4d\\u0c37\\u0c3f\\u0c15\",\"latest_users\":\"\\u0c24\\u0c3e\\u0c1c\\u0c3e \\u0c35\\u0c3f\\u0c28\\u0c3f\\u0c2f\\u0c4b\\u0c17\\u0c26\\u0c3e\\u0c30\\u0c41\\u0c32\\u0c41\",\"was_joined_as\":\"\\u0c17\\u0c3e \\u0c1a\\u0c47\\u0c30\\u0c3e\\u0c30\\u0c41 \\u0c1c\\u0c30\\u0c3f\\u0c17\\u0c3f\\u0c28\\u0c26\\u0c3f\",\"see_more\":\"\\u0c07\\u0c02\\u0c15\\u0c3e \\u0c1a\\u0c42\\u0c21\\u0c02\\u0c21\\u0c3f\",\"my_profile\":\"\\u0c28\\u0c3e \\u0c1c\\u0c40\\u0c35\\u0c28 \\u0c35\\u0c3f\\u0c35\\u0c30\\u0c23\",\"change_password\":\"\\u0c2a\\u0c3e\\u0c38\\u0c4d\\u0c35\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"logout\":\"\\u0c32\\u0c3e\\u0c17\\u0c4c\\u0c1f\\u0c4d\",\"dashboard\":\"\\u0c21\\u0c3e\\u0c37\\u0c4d\\u0c2c\\u0c4b\\u0c30\\u0c4d\\u0c21\\u0c4d\",\"users\":\"\\u0c35\\u0c3f\\u0c28\\u0c3f\\u0c2f\\u0c4b\\u0c17\\u0c26\\u0c3e\\u0c30\\u0c41\\u0c32\\u0c41\",\"roles\":\"\\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30\\u0c32\\u0c41\",\"fee_settings\":\"\\u0c2b\\u0c40\\u0c1c\\u0c41 \\u0c38\\u0c46\\u0c1f\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c17\\u0c41\\u0c32\\u0c41\",\"fee_categories\":\"\\u0c2b\\u0c40\\u0c1c\\u0c41 \\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"fee_category_allotment\":\"\\u0c2b\\u0c40\\u0c1c\\u0c41 \\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02 \\u0c05\\u0c32\\u0c3e\\u0c1f\\u0c4d\\u0c2e\\u0c46\\u0c02\\u0c1f\\u0c4d\",\"fee_particulars\":\"\\u0c2b\\u0c40\\u0c1c\\u0c41 \\u0c35\\u0c3f\\u0c35\\u0c30\\u0c2e\\u0c41\\u0c32\",\"fee_schedules\":\"\\u0c2b\\u0c40\\u0c1c\\u0c41 \\u0c37\\u0c46\\u0c21\\u0c4d\\u0c2f\\u0c42\\u0c32\\u0c4d\\u0c38\\u0c4d\",\"fines\":\"\\u0c2b\\u0c46\\u0c56\\u0c28\\u0c4d\\u0c38\\u0c4d\",\"discounts\":\"\\u0c21\\u0c3f\\u0c38\\u0c4d\\u0c15\\u0c4c\\u0c02\\u0c1f\\u0c4d\",\"master_settings\":\"\\u0c2e\\u0c3e\\u0c38\\u0c4d\\u0c1f\\u0c30\\u0c4d \\u0c38\\u0c46\\u0c1f\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c17\\u0c41\\u0c32\\u0c41\",\"religions_master\":\"\\u0c2e\\u0c24\\u0c3e\\u0c32\\u0c41 \\u0c2e\\u0c3e\\u0c38\\u0c4d\\u0c1f\\u0c30\\u0c4d\",\"academics_master\":\"\\u0c35\\u0c3f\\u0c26\\u0c4d\\u0c2f\\u0c3e\\u0c35\\u0c47\\u0c24\\u0c4d\\u0c24\\u0c32\\u0c41 \\u0c2e\\u0c3e\\u0c38\\u0c4d\\u0c1f\\u0c30\\u0c4d\",\"courses_master\":\"\\u0c15\\u0c4b\\u0c30\\u0c4d\\u0c38\\u0c41\\u0c32\\u0c41 \\u0c2e\\u0c3e\\u0c38\\u0c4d\\u0c1f\\u0c30\\u0c4d\",\"subjects_master\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c2e\\u0c41 \\u0c2e\\u0c3e\\u0c38\\u0c4d\\u0c1f\\u0c30\\u0c4d\",\"subject_topics\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c02 \\u0c1f\\u0c3e\\u0c2a\\u0c3f\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"course_subjects\":\"\\u0c15\\u0c4b\\u0c30\\u0c4d\\u0c38\\u0c41 \\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c2e\\u0c41\",\"email_templates\":\"\\u0c07\\u0c2e\\u0c46\\u0c2f\\u0c3f\\u0c32\\u0c4d \\u0c1f\\u0c46\\u0c02\\u0c2a\\u0c4d\\u0c32\\u0c47\\u0c1f\\u0c4d\\u0c32\\u0c28\\u0c41\",\"exams\":\"\\u0c2a\\u0c30\\u0c40\\u0c15\\u0c4d\\u0c37\\u0c32\\u0c41\",\"categories\":\"\\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"question_bank\":\"\\u0c2a\\u0c4d\\u0c30\\u0c36\\u0c4d\\u0c28 \\u0c2c\\u0c4d\\u0c2f\\u0c3e\\u0c02\\u0c15\\u0c4d\",\"quiz\":\"\\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c4d\",\"lms\":\"LMS\",\"content\":\"\\u0c15\\u0c02\\u0c1f\\u0c46\\u0c02\\u0c1f\\u0c4d\",\"study_materials\":\"\\u0c38\\u0c4d\\u0c1f\\u0c21\\u0c40 \\u0c2e\\u0c46\\u0c1f\\u0c40\\u0c30\\u0c3f\\u0c2f\\u0c32\\u0c4d\\u0c38\\u0c4d\",\"library\":\"\\u0c32\\u0c46\\u0c56\\u0c2c\\u0c4d\\u0c30\\u0c30\\u0c40\",\"asset_types\":\"\\u0c06\\u0c38\\u0c4d\\u0c24\\u0c3f \\u0c30\\u0c15\\u0c3e\\u0c32\\u0c41\",\"master_data\":\"\\u0c2e\\u0c41\\u0c16\\u0c4d\\u0c2f \\u0c38\\u0c2e\\u0c3e\\u0c1a\\u0c3e\\u0c30\",\"publishers\":\"\\u0c2a\\u0c2c\\u0c4d\\u0c32\\u0c3f\\u0c37\\u0c30\\u0c4d\\u0c38\\u0c4d\",\"authors\":\"\\u0c30\\u0c1a\\u0c2f\\u0c3f\\u0c24\\u0c32\\u0c41\",\"students\":\"\\u0c38\\u0c4d\\u0c1f\\u0c42\\u0c21\\u0c46\\u0c02\\u0c1f\\u0c4d\\u0c38\\u0c4d\",\"staff\":\"\\u0c38\\u0c4d\\u0c1f\\u0c3e\\u0c2b\\u0c4d\",\"school_hub\":\"\\u0c38\\u0c4d\\u0c15\\u0c42\\u0c32\\u0c4d \\u0c39\\u0c2c\\u0c4d\",\"attendance\":\"\\u0c39\\u0c3e\\u0c1c\\u0c30\\u0c41\",\"edit\":\"\\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c1a\\u0c41\",\"delete\":\"\\u0c24\\u0c4a\\u0c32\\u0c17\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"enable\":\"\\u0c2a\\u0c4d\\u0c30\\u0c3e\\u0c30\\u0c02\\u0c2d\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"set_default\":\"\\u0c38\\u0c46\\u0c1f\\u0c4d \\u0c21\\u0c3f\\u0c2b\\u0c3e\\u0c32\\u0c4d\\u0c1f\\u0c4d\",\"disable\":\"\\u0c21\\u0c3f\\u0c38\\u0c47\\u0c2c\\u0c41\\u0c32\\u0c4d\",\"admin_dashboard\":\"\\u0c05\\u0c21\\u0c4d\\u0c2e\\u0c3f\\u0c28\\u0c4d \\u0c21\\u0c3e\\u0c37\\u0c4d\\u0c2c\\u0c4b\\u0c30\\u0c4d\\u0c21\\u0c4d\",\"overall_users\":\"\\u0c2e\\u0c4a\\u0c24\\u0c4d\\u0c24\\u0c02\\u0c2e\\u0c40\\u0c26 \\u0c35\\u0c3f\\u0c28\\u0c3f\\u0c2f\\u0c4b\\u0c17\\u0c26\\u0c3e\\u0c30\\u0c41\\u0c32\\u0c41\",\"user_statistics\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15\\u0c30\\u0c3f \\u0c17\\u0c23\\u0c3e\\u0c02\\u0c15\\u0c3e\\u0c32\\u0c41\",\"user_details\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15\\u0c30\\u0c3f \\u0c35\\u0c3f\\u0c35\\u0c30\\u0c3e\\u0c32\\u0c41\",\"view_all\":\"\\u0c05\\u0c28\\u0c4d\\u0c28\\u0c40 \\u0c1a\\u0c42\\u0c21\\u0c41\",\"quiz_categories\":\"\\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c4d \\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"quizzes\":\"\\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c46\\u0c38\\u0c4d\",\"subjects\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c2e\\u0c41\",\"topics\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c3e\\u0c32\\u0c41\",\"questions\":\"\\u0c2a\\u0c4d\\u0c30\\u0c36\\u0c4d\\u0c28\\u0c32\\u0c41\",\"title\":\"\\u0c36\\u0c40\\u0c30\\u0c4d\\u0c37\\u0c3f\\u0c15\",\"dueration\":\"Dueration\",\"category\":\"\\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"is_paid\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c3f\\u0c38\\u0c4d\\u0c24\\u0c41\\u0c28\\u0c4d\\u0c28\\u0c2a\\u0c4d\\u0c2a\\u0c1f\\u0c3f\\u0c15\\u0c40\",\"total_marks\":\"\\u0c2e\\u0c4a\\u0c24\\u0c4d\\u0c24\\u0c02 \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c41\\u0c32\\u0c41\",\"update_questions\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23 \\u0c2a\\u0c4d\\u0c30\\u0c36\\u0c4d\\u0c28\",\"free\":\"\\u0c09\\u0c1a\\u0c3f\\u0c24\",\"paid\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c3f\\u0c02\\u0c2a\\u0c41\",\"create_quiz\":\"\\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c4d \\u0c38\\u0c43\\u0c37\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"list\":\"\\u0c1c\\u0c3e\\u0c2c\\u0c3f\\u0c24\\u0c3e\",\"quiz_title\":\"\\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c4d \\u0c36\\u0c40\\u0c30\\u0c4d\\u0c37\\u0c3f\\u0c15\",\"enter_value_in_minutes\":\"\\u0c35\\u0c3f\\u0c32\\u0c41\\u0c35 \\u0c2e\\u0c3f\\u0c28\\u0c3f\\u0c1f\\u0c4d\\u0c38\\u0c4d \\u0c32\\u0c4b \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d\",\"it will be updated by adding the questions\":\"\\u0c07\\u0c26\\u0c3f \\u0c2a\\u0c4d\\u0c30\\u0c36\\u0c4d\\u0c28\\u0c32\\u0c41 \\u0c1c\\u0c4b\\u0c21\\u0c3f\\u0c02\\u0c1a\\u0c21\\u0c02 \\u0c26\\u0c4d\\u0c35\\u0c3e\\u0c30\\u0c3e \\u0c05\\u0c2a\\u0c4d\\u0c21\\u0c47\\u0c1f\\u0c4d \\u0c05\\u0c35\\u0c41\\u0c24\\u0c41\\u0c02\\u0c26\\u0c3f\",\"pass_percentage\":\"\\u0c09\\u0c24\\u0c4d\\u0c24\\u0c40\\u0c30\\u0c4d\\u0c23\\u0c24 \\u0c36\\u0c3e\\u0c24\\u0c02\",\"no\":\"\\u0c24\\u0c4b\\u0c2c\\u0c41\\u0c1f\\u0c4d\\u0c1f\\u0c41\\u0c35\\u0c41\\u0c32\",\"yes\":\"\\u0c05\\u0c35\\u0c41\\u0c28\\u0c41\",\"description\":\"\\u0c35\\u0c3f\\u0c35\\u0c30\\u0c23\",\"add_language\":\"\\u0c2d\\u0c3e\\u0c37\\u0c3e \\u0c1c\\u0c4b\\u0c21\\u0c3f\\u0c02\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"language_title\":\"\\u0c2d\\u0c3e\\u0c37\\u0c3e \\u0c36\\u0c40\\u0c30\\u0c4d\\u0c37\\u0c3f\\u0c15\",\"language_code\":\"\\u0c2d\\u0c3e\\u0c37 \\u0c15\\u0c4b\\u0c21\\u0c4d\",\"supported_language_codes\":\"\\u0c2e\\u0c26\\u0c4d\\u0c26\\u0c24\\u0c41 \\u0c2d\\u0c3e\\u0c37 \\u0c15\\u0c4b\\u0c21\\u0c4d\\u0c32\\u0c41\",\"home\":\"\\u0c39\\u0c4b\\u0c2e\\u0c4d\",\"faqs\":\"FAQS\",\"about_us\":\"\\u0c2e\\u0c3e \\u0c17\\u0c41\\u0c30\\u0c3f\\u0c02\\u0c1a\\u0c3f\",\"contact_us\":\"\\u0c2e\\u0c2e\\u0c4d\\u0c2e\\u0c32\\u0c4d\\u0c28\\u0c3f \\u0c38\\u0c02\\u0c2a\\u0c4d\\u0c30\\u0c26\\u0c3f\\u0c02\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"email\":\"\\u0c07\\u0c2e\\u0c46\\u0c2f\\u0c3f\\u0c32\\u0c4d\",\"password\":\"\\u0c2a\\u0c3e\\u0c38\\u0c4d\\u0c35\\u0c30\\u0c4d\\u0c21\\u0c4d\",\"login\":\"\\u0c32\\u0c3e\\u0c17\\u0c3f\\u0c28\\u0c4d\",\"forgot_password\":\"\\u0c2a\\u0c3e\\u0c38\\u0c4d\\u0c35\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c2e\\u0c30\\u0c3f\\u0c1a\\u0c3f\\u0c2a\\u0c4b\\u0c2f\\u0c3e\\u0c30\\u0c3e\",\"register\":\"\\u0c28\\u0c2e\\u0c4b\\u0c26\\u0c41\",\"logged_out_successfully\":\"\\u0c35\\u0c3f\\u0c1c\\u0c2f\\u0c35\\u0c02\\u0c24\\u0c02\\u0c17\\u0c3e \\u0c32\\u0c3e\\u0c17\\u0c4d \\u0c05\\u0c35\\u0c41\\u0c1f\\u0c4d\",\"edit_subject\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c3e\\u0c28\\u0c4d\\u0c28\\u0c3f \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c1a\\u0c41\",\"update\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23\",\"subject_title\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c02 \\u0c36\\u0c40\\u0c30\\u0c4d\\u0c37\\u0c3f\\u0c15\",\"subject_code\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c02 \\u0c15\\u0c4b\\u0c21\\u0c4d\",\"is_lab\":\"\\u0c32\\u0c4d\\u0c2f\\u0c3e\\u0c2c\\u0c4d\",\"is_elective\":\"\\u0c28\\u0c3f\\u0c2f\\u0c4b\\u0c1c\\u0c3f\\u0c24 \\u0c09\\u0c02\\u0c26\\u0c3f\",\"maximum_marks\":\"\\u0c17\\u0c30\\u0c3f\\u0c37\\u0c4d\\u0c20 \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"pass_marks\":\"\\u0c2a\\u0c3e\\u0c38\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"subjects_list\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c2e\\u0c41 \\u0c1c\\u0c3e\\u0c2c\\u0c3f\\u0c24\\u0c3e\",\"sno\":\"sno\",\"subject\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c02\",\"max_marks\":\"\\u0c2e\\u0c3e\\u0c15\\u0c4d\\u0c38\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"parent\":\"\\u0c2e\\u0c3e\\u0c24\\u0c43\",\"add_user\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15\\u0c30\\u0c3f \\u0c1c\\u0c4b\\u0c21\\u0c3f\\u0c02\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"name\":\"\\u0c2a\\u0c47\\u0c30\\u0c41\",\"image\":\"\\u0c1a\\u0c3f\\u0c24\\u0c4d\\u0c30\\u0c02\",\"role\":\"\\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30\",\"view_profile\":\"\\u0c2a\\u0c4d\\u0c30\\u0c4a\\u0c2b\\u0c46\\u0c56\\u0c32\\u0c4d \\u0c1a\\u0c42\\u0c21\\u0c41\",\"update_details\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23 \\u0c35\\u0c3f\\u0c35\\u0c30\\u0c3e\\u0c32\\u0c41\",\"add_users\":\"\\u0c35\\u0c3f\\u0c28\\u0c3f\\u0c2f\\u0c4b\\u0c17\\u0c26\\u0c3e\\u0c30\\u0c41\\u0c32\\u0c28\\u0c41 \\u0c1c\\u0c4b\\u0c21\\u0c3f\\u0c02\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"select_role\":\"\\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30 \\u0c0e\\u0c02\\u0c1a\\u0c41\\u0c15\\u0c4b\\u0c02\\u0c21\\u0c3f\",\"user_roles\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15\\u0c30\\u0c3f \\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30\\u0c32\\u0c41\",\"permissions\":\"\\u0c05\\u0c28\\u0c41\\u0c2e\\u0c24\\u0c41\\u0c32\\u0c41\",\"add_role\":\"\\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30 \\u0c1c\\u0c4b\\u0c21\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"role_name\":\"\\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30 \\u0c2a\\u0c47\\u0c30\\u0c41\",\"display_name\":\"\\u0c2a\\u0c4d\\u0c30\\u0c26\\u0c30\\u0c4d\\u0c36\\u0c3f\\u0c24 \\u0c28\\u0c3e\\u0c2e\\u0c02\",\"list_roles\":\"\\u0c1c\\u0c3e\\u0c2c\\u0c3f\\u0c24\\u0c3e \\u0c2d\\u0c3e\\u0c26\\u0c4d\\u0c2f\\u0c24\\u0c32\\u0c41\",\"submit\":\"\\u0c38\\u0c2e\\u0c30\\u0c4d\\u0c2a\\u0c3f\\u0c02\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"religions\":\"\\u0c2e\\u0c24\\u0c3e\\u0c32\\u0c41\",\"pass_marks_cannot_be_greater_than_maximum_marks\":\"\\u0c2a\\u0c3e\\u0c38\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d \\u0c17\\u0c30\\u0c3f\\u0c37\\u0c4d\\u0c20 \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d \\u0c15\\u0c02\\u0c1f\\u0c47 \\u0c0e\\u0c15\\u0c4d\\u0c15\\u0c41\\u0c35 \\u0c09\\u0c02\\u0c21\\u0c15\\u0c42\\u0c21\\u0c26\\u0c41\",\"please_enter_valid_maximum_marks\":\"\\u0c26\\u0c2f\\u0c1a\\u0c47\\u0c38\\u0c3f \\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47 \\u0c17\\u0c30\\u0c3f\\u0c37\\u0c4d\\u0c20 \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d\",\"please_enter_valid_pass_marks\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47 \\u0c2a\\u0c3e\\u0c38\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d \\u0c1a\\u0c47\\u0c2f\\u0c02\\u0c21\\u0c3f\",\"deleted\":\"Deleted\",\"sorry\":\"Sorry\",\"cannot_delete_this_record_as\":\"Cannot Delete This Record As\",\"this_field_id_required\":\"\\u0c08 \\u0c2b\\u0c40\\u0c32\\u0c4d\\u0c21\\u0c4d id \\u0c05\\u0c35\\u0c38\\u0c30\\u0c02\",\"the_text_is_too_short\":\"\\u0c1f\\u0c46\\u0c15\\u0c4d\\u0c38\\u0c4d\\u0c1f\\u0c4d \\u0c1a\\u0c3e\\u0c32\\u0c3e \\u0c1a\\u0c3f\\u0c28\\u0c4d\\u0c28\\u0c26\\u0c3f\",\"the_text_is_too_long\":\"\\u0c35\\u0c1a\\u0c28\\u0c02 \\u0c1a\\u0c3e\\u0c32\\u0c3e \\u0c2a\\u0c4a\\u0c21\\u0c35\\u0c41\\u0c17\\u0c3e \\u0c09\\u0c02\\u0c26\\u0c3f\",\"this_field_is_required\":\"\\u0c08 \\u0c16\\u0c3e\\u0c33\\u0c40\\u0c28\\u0c3f \\u0c24\\u0c2a\\u0c4d\\u0c2a\\u0c28\\u0c3f\\u0c38\\u0c30\\u0c3f\\u0c17\\u0c3e \\u0c2a\\u0c42\\u0c30\\u0c3f\\u0c02\\u0c1a\\u0c35\\u0c32\\u0c46\\u0c28\\u0c41\",\"please_enter_valid_email\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47 \\u0c07\\u0c2e\\u0c46\\u0c2f\\u0c3f\\u0c32\\u0c4d \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d \\u0c1a\\u0c47\\u0c2f\\u0c02\\u0c21\\u0c3f\",\"settings\":\"\\u0c38\\u0c46\\u0c1f\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c17\\u0c41\\u0c32\\u0c41\",\"record_deleted_successfully\":\"\\u0c30\\u0c3f\\u0c15\\u0c3e\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c24\\u0c4a\\u0c32\\u0c17\\u0c3f\\u0c02\\u0c1a\\u0c3f\\u0c28 \\u0c35\\u0c3f\\u0c1c\\u0c2f\\u0c35\\u0c02\\u0c24\\u0c02\\u0c17\\u0c3e\",\"record_added_successfully\":\"\\u0c30\\u0c3f\\u0c15\\u0c3e\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c1a\\u0c47\\u0c30\\u0c4d\\u0c1a\\u0c2c\\u0c21\\u0c3f\\u0c02\\u0c26\\u0c3f \\u0c35\\u0c3f\\u0c1c\\u0c2f\\u0c35\\u0c02\\u0c24\\u0c02\\u0c17\\u0c3e\",\"exam_series\":\"\\u0c2a\\u0c30\\u0c40\\u0c15\\u0c4d\\u0c37\\u0c3e \\u0c38\\u0c3f\\u0c30\\u0c40\\u0c38\\u0c4d\",\"instructions\":\"\\u0c38\\u0c42\\u0c1a\\u0c28\\u0c32\\u0c28\\u0c41\",\"coupons\":\"\\u0c15\\u0c42\\u0c2a\\u0c28\\u0c4d\\u0c32\\u0c41\",\"add\":\"\\u0c1a\\u0c47\\u0c30\\u0c4d\\u0c1a\\u0c41\",\"contents\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f \\u0c38\\u0c42\\u0c1a\\u0c3f\\u0c15\",\"series\":\"\\u0c38\\u0c3f\\u0c30\\u0c40\\u0c38\\u0c4d\",\"notifications\":\"\\u0c2a\\u0c4d\\u0c30\\u0c15\\u0c1f\\u0c28\\u0c32\\u0c41\",\"messages\":\"\\u0c38\\u0c02\\u0c26\\u0c47\\u0c36\\u0c3e\\u0c32\\u0c41\",\"feedback\":\"\\u0c05\\u0c2d\\u0c3f\\u0c2a\\u0c4d\\u0c30\\u0c3e\\u0c2f\\u0c02\",\"couponcodes\":\"Couponcodes\",\"type\":\"\\u0c30\\u0c15\\u0c02\",\"discount\":\"\\u0c21\\u0c3f\\u0c38\\u0c4d\\u0c15\\u0c4c\\u0c02\\u0c1f\\u0c4d\",\"minimum_bill\":\"\\u0c15\\u0c28\\u0c40\\u0c38 \\u0c2c\\u0c3f\\u0c32\\u0c4d\",\"maximum_discount\":\"\\u0c17\\u0c30\\u0c3f\\u0c37\\u0c4d\\u0c1f \\u0c24\\u0c17\\u0c4d\\u0c17\\u0c3f\\u0c02\\u0c2a\\u0c41\",\"limit\":\"\\u0c2a\\u0c30\\u0c3f\\u0c2e\\u0c3f\\u0c24\\u0c3f\",\"status\":\"\\u0c38\\u0c4d\\u0c25\\u0c3f\\u0c24\\u0c3f\",\"lms_categories\":\"LMS \\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"create_coupon\":\"\\u0c15\\u0c42\\u0c2a\\u0c28\\u0c4d \\u0c38\\u0c43\\u0c37\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"invalid_input\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c28\\u0c3f \\u0c07\\u0c28\\u0c4d\\u0c2a\\u0c41\\u0c1f\\u0c4d\",\"coupon_code\":\"\\u0c15\\u0c42\\u0c2a\\u0c28\\u0c4d \\u0c15\\u0c4b\\u0c21\\u0c4d\",\"value\":\"\\u0c35\\u0c3f\\u0c32\\u0c41\\u0c35\",\"percent\":\"\\u0c36\\u0c3e\\u0c24\\u0c02\",\"discount_type\":\"\\u0c21\\u0c3f\\u0c38\\u0c4d\\u0c15\\u0c4c\\u0c02\\u0c1f\\u0c4d \\u0c1f\\u0c46\\u0c56\\u0c2a\\u0c4d\",\"discount_value\":\"\\u0c21\\u0c3f\\u0c38\\u0c4d\\u0c15\\u0c4c\\u0c02\\u0c1f\\u0c4d \\u0c35\\u0c3f\\u0c32\\u0c41\\u0c35\",\"enter_value\":\"\\u0c35\\u0c3f\\u0c32\\u0c41\\u0c35 \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d\",\"please_enter_valid_number\":\"\\u0c26\\u0c2f\\u0c1a\\u0c47\\u0c38\\u0c3f \\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47 \\u0c38\\u0c02\\u0c16\\u0c4d\\u0c2f\\u0c28\\u0c41 \\u0c28\\u0c2e\\u0c4b\\u0c26\\u0c41\",\"discount_maximum_amount\":\"\\u0c21\\u0c3f\\u0c38\\u0c4d\\u0c15\\u0c4c\\u0c02\\u0c1f\\u0c4d \\u0c17\\u0c30\\u0c3f\\u0c37\\u0c4d\\u0c1f \\u0c2e\\u0c4a\\u0c24\\u0c4d\\u0c24\\u0c02\",\"valid_from\":\"\\u0c28\\u0c41\\u0c02\\u0c21\\u0c3f \\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47\",\"valid_to\":\"\\u0c38\\u0c2e\\u0c4d\\u0c2e\\u0c24\\u0c2e\\u0c46\\u0c56\\u0c28\",\"usage_limit\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15 \\u0c2a\\u0c30\\u0c3f\\u0c2e\\u0c3f\\u0c24\\u0c3f\",\"create_series\":\"\\u0c38\\u0c3f\\u0c30\\u0c40\\u0c38\\u0c4d\\u0c28\\u0c41 \\u0c38\\u0c43\\u0c37\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"cost\":\"\\u0c16\\u0c30\\u0c40\\u0c26\\u0c41\",\"validity\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41\",\"total_exams\":\"\\u0c2e\\u0c4a\\u0c24\\u0c4d\\u0c24\\u0c02 \\u0c2a\\u0c30\\u0c40\\u0c15\\u0c4d\\u0c37\\u0c32\\u0c41\",\"total_questions\":\"\\u0c2e\\u0c4a\\u0c24\\u0c4d\\u0c24\\u0c02 \\u0c2a\\u0c4d\\u0c30\\u0c36\\u0c4d\\u0c28\\u0c32\\u0c41\",\"update_quizzes\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23 \\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c4d\\u0c32\\u0c41\",\"update_series_for\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23 \\u0c38\\u0c3f\\u0c30\\u0c40\\u0c38\\u0c4d\",\"exam_categories\":\"\\u0c2a\\u0c30\\u0c40\\u0c15\\u0c4d\\u0c37\\u0c3e \\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"saved_exams\":\"\\u0c38\\u0c47\\u0c35\\u0c4d \\u0c2a\\u0c30\\u0c40\\u0c15\\u0c4d\\u0c37\\u0c32\\u0c41\",\"no_data_available\":\"\\u0c21\\u0c47\\u0c1f\\u0c3e \\u0c05\\u0c02\\u0c26\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41\\u0c32\\u0c4b \\u0c32\\u0c47\\u0c35\\u0c41\",\"remove_all\":\"\\u0c05\\u0c28\\u0c4d\\u0c28\\u0c3f \\u0c24\\u0c40\\u0c38\\u0c3f\\u0c35\\u0c46\\u0c2f\\u0c4d\",\"marks\":\"\\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"import_excel\":\"\\u0c26\\u0c3f\\u0c17\\u0c41\\u0c2e\\u0c24\\u0c3f Excel\",\"edit_user\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15\\u0c30\\u0c3f \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c1a\\u0c41\",\"username\":\"\\u0c2f\\u0c42\\u0c1c\\u0c30\\u0c4d \\u0c2a\\u0c47\\u0c30\\u0c41\",\"phone\":\"\\u0c2b\\u0c4b\\u0c28\\u0c4d\",\"please_enter_valid_phone_number\":\"\\u0c26\\u0c2f\\u0c1a\\u0c47\\u0c38\\u0c3f \\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47 \\u0c2b\\u0c4b\\u0c28\\u0c4d \\u0c28\\u0c02\\u0c2c\\u0c30\\u0c4d \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d\",\"address\":\"\\u0c1a\\u0c3f\\u0c30\\u0c41\\u0c28\\u0c3e\\u0c2e\\u0c3e\",\"are_you_sure\":\"\\u0c2e\\u0c40\\u0c30\\u0c41 \\u0c1a\\u0c46\\u0c2a\\u0c4d\\u0c2a\\u0c47\\u0c26\\u0c3f \\u0c28\\u0c3f\\u0c1c\\u0c2e\\u0c3e\",\"you_will_not_be_able_to_recover_this_record\":\"\\u0c2e\\u0c40\\u0c30\\u0c41 \\u0c08 \\u0c30\\u0c3f\\u0c15\\u0c3e\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c15\\u0c4b\\u0c32\\u0c41\\u0c15\\u0c41\\u0c28\\u0c47\\u0c02\\u0c26\\u0c41\\u0c15\\u0c41 \\u0c35\\u0c41\\u0c02\\u0c21\\u0c26\\u0c41\",\"delete_it\":\"\\u0c26\\u0c3e\\u0c28\\u0c4d\\u0c28\\u0c3f \\u0c24\\u0c4a\\u0c32\\u0c17\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"cancel_please\":\"\\u0c30\\u0c26\\u0c4d\\u0c26\\u0c41 \\u0c26\\u0c2f\\u0c1a\\u0c47\\u0c38\\u0c3f\",\"your_record_has_been_deleted\":\"\\u0c2e\\u0c40 \\u0c30\\u0c3f\\u0c15\\u0c3e\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c24\\u0c4a\\u0c32\\u0c17\\u0c3f\\u0c02\\u0c1a\\u0c2c\\u0c21\\u0c3f\\u0c02\\u0c26\\u0c3f\",\"cancelled\":\"\\u0c30\\u0c26\\u0c4d\\u0c26\\u0c41\",\"your_record_is_safe\":\"\\u0c2e\\u0c40 \\u0c30\\u0c3f\\u0c15\\u0c3e\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c08\\u0c1c\\u0c4d \\u0c38\\u0c47\\u0c2b\\u0c4d\",\"academic_operations\":\"\\u0c05\\u0c15\\u0c21\\u0c2e\\u0c3f\\u0c15\\u0c4d \\u0c06\\u0c2a\\u0c30\\u0c47\\u0c37\\u0c28\\u0c4d\\u0c38\\u0c4d\",\"certificates\":\"\\u0c38\\u0c30\\u0c4d\\u0c1f\\u0c3f\\u0c2b\\u0c3f\\u0c15\\u0c46\\u0c1f\\u0c4d\\u0c32\\u0c41\",\"transfers\":\"\\u0c2c\\u0c26\\u0c3f\\u0c32\\u0c40\\u0c32\\u0c41\",\"timetable\":\"\\u0c38\\u0c2e\\u0c2f\\u0c2a\\u0c1f\\u0c4d\\u0c1f\\u0c3f\\u0c15\",\"upload_marks_\":\"\\u0c05\\u0c2a\\u0c4d\\u0c32\\u0c4b\\u0c21\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"payment_reports\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c3f\\u0c02\\u0c2a\\u0c41 \\u0c28\\u0c3f\\u0c35\\u0c47\\u0c26\\u0c3f\\u0c15\\u0c32\\u0c41\",\"online_payments\":\"\\u0c06\\u0c28\\u0c4d\\u0c32\\u0c46\\u0c56\\u0c28\\u0c4d \\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c3f\\u0c02\\u0c2a\\u0c41\\u0c32\\u0c41\",\"offline_payments\":\"\\u0c06\\u0c2b\\u0c4d\\u0c32\\u0c46\\u0c56\\u0c28\\u0c4d \\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c3f\\u0c02\\u0c2a\\u0c41\\u0c32\\u0c41\",\"export\":\"\\u0c0e\\u0c17\\u0c41\\u0c2e\\u0c24\\u0c3f\",\"transportation\":\"\\u0c30\\u0c35\\u0c3e\\u0c23\\u0c3e\",\"vechicles\":\"Vechicles\",\"vehicle_types\":\"\\u0c35\\u0c3e\\u0c39\\u0c28\\u0c32 \\u0c30\\u0c15\\u0c3e\\u0c32\\u0c41\",\"certificate_templates\":\"\\u0c38\\u0c30\\u0c4d\\u0c1f\\u0c3f\\u0c2b\\u0c3f\\u0c15\\u0c46\\u0c1f\\u0c4d \\u0c32\\u0c41\",\"update_strings\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23 \\u0c38\\u0c4d\\u0c1f\\u0c4d\\u0c30\\u0c3f\\u0c02\\u0c17\\u0c4d\\u0c38\\u0c4d\"}', '2016-05-24 23:11:51', '2017-01-02 07:55:22'),
(5, 'Arbic', 'arbic', 'ar', 1, 0, '{\"exam_analysis\":\"\\u062a\\u062d\\u0644\\u064a\\u0644 \\u0627\\u0644\\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\",\"analysis_by_exam\":\"\\u062a\\u062d\\u0644\\u064a\\u0644 \\u0628\\u0648\\u0627\\u0633\\u0637\\u0629 \\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\",\"of\":\"of\",\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646\",\"type\":\"\\u0627\\u0643\\u062a\\u0628\",\"dueration\":\"Dueration\",\"marks\":\"\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a\",\"attempts\":\"\\u0645\\u062d\\u0627\\u0648\\u0644\\u0627\\u062a\",\"action\":\"\\u0639\\u0645\\u0644\",\"site_title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"my_profile\":\"\\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"change_password\":\"\\u062a\\u063a\\u064a\\u064a\\u0631 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0633\\u0631\",\"logout\":\"\\u062e\\u0631\\u0648\\u062c\",\"dashboard\":\"\\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629\",\"children\":\"\\u0627\\u0644\\u0623\\u0637\\u0641\\u0627\\u0644\",\"add\":\"\\u0625\\u0636\\u0627\\u0641\\u0629\",\"list\":\"\\u0642\\u0627\\u0626\\u0645\\u0629\",\"exams\":\"\\u0627\\u0644\\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\\u0627\\u062a\",\"categories\":\"\\u0627\\u0644\\u0641\\u0626\\u0627\\u062a\",\"recent_activity\":\"\\u0622\\u062e\\u0631 \\u0646\\u0634\\u0627\\u0637\",\"home\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"faqs\":\"\\u0627\\u0644\\u0623\\u0633\\u0626\\u0644\\u0629 \\u0627\\u0644\\u0623\\u0643\\u062b\\u0631 \\u0634\\u064a\\u0648\\u0639\\u0627\",\"about_us\":\"\\u0645\\u0639\\u0644\\u0648\\u0645\\u0627\\u062a \\u0639\\u0646\\u0627\",\"contact_us\":\"\\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627\",\"email\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"password\":\"\\u0643\\u0644\\u0645\\u0647 \\u0627\\u0644\\u0633\\u0631\",\"login\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u062f\\u062e\\u0648\\u0644\",\"forgot_password\":\"\\u0647\\u0644 \\u0646\\u0633\\u064a\\u062a \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631\",\"register\":\"\\u062a\\u0633\\u062c\\u064a\\u0644\",\"quiz_categories\":\"\\u0645\\u0633\\u0627\\u0628\\u0642\\u0629 \\u0627\\u0644\\u0641\\u0626\\u0627\\u062a\",\"view_all\":\"\\u0645\\u0634\\u0627\\u0647\\u062f\\u0629 \\u0627\\u0644\\u0643\\u0644\",\"quizzes\":\"\\u0645\\u0633\\u0627\\u0628\\u0642\\u0627\\u062a\",\"admin_dashboard\":\"\\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u0645\\u0634\\u0631\\u0641\",\"overall_users\":\"\\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u0648\\u0646 \\u0627\\u0644\\u0639\\u0627\\u0645\",\"user_statistics\":\"\\u0627\\u0644\\u0627\\u062d\\u0635\\u0627\\u0626\\u064a\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"user_details\":\"\\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"users\":\"\\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\",\"subjects\":\"\\u0627\\u0644\\u0645\\u0648\\u0627\\u0636\\u064a\\u0639\",\"topics\":\"\\u0627\\u0644\\u0645\\u0648\\u0627\\u0636\\u064a\\u0639\",\"questions\":\"\\u0623\\u0633\\u0626\\u0644\\u0629\",\"latest_users\":\"\\u0623\\u062d\\u062f\\u062b \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\",\"was_joined_as\":\"\\u0648\\u0642\\u062f \\u0627\\u0646\\u0636\\u0645\\u062a \\u0625\\u0644\\u0649\",\"see_more\":\"\\u0634\\u0627\\u0647\\u062f \\u0627\\u0644\\u0645\\u0632\\u064a\\u062f\",\"languages\":\"\\u0627\\u0644\\u0644\\u063a\\u0627\\u062a\",\"roles\":\"\\u0627\\u0644\\u0623\\u062f\\u0648\\u0627\\u0631\",\"fee_settings\":\"\\u0625\\u0639\\u062f\\u0627\\u062f\\u0627\\u062a \\u0631\\u0633\\u0648\\u0645\",\"fee_categories\":\"\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0641\\u0626\\u0627\\u062a\",\"fee_category_allotment\":\"\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0641\\u0626\\u0629 \\u0627\\u0644\\u062a\\u062e\\u0635\\u064a\\u0635\",\"fee_particulars\":\"\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644 \\u0627\\u0644\\u0631\\u0633\\u0648\\u0645\",\"fee_schedules\":\"\\u062c\\u062f\\u0627\\u0648\\u0644 \\u0631\\u0633\\u0648\\u0645\",\"fines\":\"\\u0627\\u0644\\u063a\\u0631\\u0627\\u0645\\u0627\\u062a\",\"discounts\":\"\\u062e\\u0635\\u0648\\u0645\\u0627\\u062a\",\"master_settings\":\"\\u0625\\u0639\\u062f\\u0627\\u062f\\u0627\\u062a \\u0645\\u0627\\u0633\\u062a\\u0631\",\"religions_master\":\"\\u0627\\u0644\\u0623\\u062f\\u064a\\u0627\\u0646 \\u0645\\u0627\\u0633\\u062a\\u0631\",\"academics_master\":\"\\u0623\\u0643\\u0627\\u062f\\u064a\\u0645\\u064a\\u0648\\u0646 \\u0645\\u0627\\u0633\\u062a\\u0631\",\"courses_master\":\"\\u0645\\u0642\\u0631\\u0631\\u0627\\u062a \\u0627\\u0644\\u0645\\u0627\\u062c\\u0633\\u062a\\u064a\\u0631\",\"subjects_master\":\"\\u0627\\u0644\\u0645\\u0648\\u0627\\u0636\\u064a\\u0639 \\u0645\\u0627\\u0633\\u062a\\u0631\",\"subject_topics\":\"\\u062a\\u062e\\u0636\\u0639 \\u0645\\u0648\\u0627\\u0636\\u064a\\u0639\",\"course_subjects\":\"\\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a \\u0628\\u0627\\u0644\\u0637\\u0628\\u0639\",\"email_templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"question_bank\":\"\\u0627\\u0644\\u0628\\u0646\\u0643 \\u0633\\u0624\\u0627\\u0644\",\"quiz\":\"\\u0627\\u062e\\u062a\\u0628\\u0627\\u0631 \\u0642\\u0635\\u064a\\u0631\",\"lms\":\"LMS\",\"content\":\"\\u0645\\u062d\\u062a\\u0648\\u0649\",\"study_materials\":\"\\u0645\\u0648\\u0627\\u062f \\u062f\\u0631\\u0627\\u0633\\u064a\\u0629\",\"library\":\"\\u0645\\u0643\\u062a\\u0628\\u0629\",\"asset_types\":\"\\u0623\\u0646\\u0648\\u0627\\u0639 \\u0627\\u0644\\u0623\\u0635\\u0648\\u0644\",\"master_data\":\"\\u0627\\u0644\\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"publishers\":\"\\u0646\\u0627\\u0634\\u0631\\u064a\",\"authors\":\"\\u0627\\u0644\\u0643\\u062a\\u0627\\u0628\",\"students\":\"\\u0627\\u0644\\u0637\\u0644\\u0627\\u0628\",\"staff\":\"\\u0627\\u0644\\u0639\\u0627\\u0645\\u0644\\u064a\\u0646\",\"school_hub\":\"\\u0645\\u062d\\u0648\\u0631 \\u0627\\u0644\\u0645\\u062f\\u0631\\u0633\\u0629\",\"attendance\":\"\\u0627\\u0644\\u062d\\u0636\\u0648\\u0631\",\"create\":\"\\u062e\\u0644\\u0642\",\"category\":\"\\u0641\\u0626\\u0629\",\"is_paid\":\"\\u0645\\u062f\\u0641\\u0648\\u0639\",\"total_marks\":\"\\u0645\\u062c\\u0645\\u0648\\u0639 \\u0627\\u0644\\u062f\\u0631\\u062c\\u0627\\u062a\",\"update_questions\":\"\\u062a\\u062d\\u062f\\u064a\\u062b \\u0627\\u0644\\u0623\\u0633\\u0626\\u0644\\u0629\",\"edit\":\"\\u062a\\u062d\\u0631\\u064a\\u0631\",\"delete\":\"\\u062d\\u0630\\u0641\",\"free\":\"\\u062d\\u0631\",\"paid\":\"\\u062f\\u0641\\u0639\",\"create_quiz\":\"\\u0625\\u0646\\u0634\\u0627\\u0621 \\u0645\\u0633\\u0627\\u0628\\u0642\\u0629\",\"quiz_title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0625\\u062e\\u062a\\u0628\\u0627\\u0631\",\"enter_value_in_minutes\":\"\\u0623\\u062f\\u062e\\u0644 \\u0627\\u0644\\u0642\\u064a\\u0645\\u0629 \\u0641\\u064a \\u062f\\u0642\\u0627\\u0626\\u0642\",\"it_will_be_updated_by_adding_the_questions\":\"\\u0641\\u0633\\u064a\\u062a\\u0645 \\u062a\\u062d\\u062f\\u064a\\u062b\\u0647 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0623\\u0633\\u0626\\u0644\\u0629\",\"pass_percentage\":\"\\u062a\\u0645\\u0631\\u064a\\u0631 \\u0627\\u0644\\u0646\\u0633\\u0628\\u0629 \\u0627\\u0644\\u0645\\u0626\\u0648\\u064a\\u0629\",\"no\":\"\\u0644\\u0627\",\"yes\":\"\\u0646\\u0639\\u0645 \\u0641\\u0639\\u0644\\u0627\",\"description\":\"\\u0648\\u0635\\u0641\",\"language\":\"\\u0644\\u063a\\u0629\",\"code\":\"\\u0631\\u0645\\u0632\",\"is_rtl\":\"\\u063a\\u064a\\u0631 RTL\",\"default_language\":\"\\u0627\\u0644\\u0644\\u063a\\u0629 \\u0627\\u0644\\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a\\u0629\",\"enable\":\"\\u062a\\u0645\\u0643\\u064a\\u0646\",\"disable\":\"\\u062a\\u0639\\u0637\\u064a\\u0644\",\"set_default\":\"\\u0627\\u0644\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0625\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a\",\"success\":\"\\u0646\\u062c\\u0627\\u062d\",\"record_updated_successfully\":\"\\u0633\\u062c\\u0644 \\u0627\\u0644\\u062a\\u062d\\u062f\\u064a\\u062b \\u0628\\u0646\\u062c\\u0627\\u062d\",\"deleted\":\"Deleted\",\"sorry\":\"Sorry\",\"cannot_delete_this_record_as\":\"Cannot Delete This Record As\",\"add_user\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"name\":\"\\u0627\\u0633\\u0645\",\"image\":\"\\u0635\\u0648\\u0631\\u0629\",\"role\":\"\\u062f\\u0648\\u0631\",\"update_details\":\"\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644 \\u0627\\u0644\\u062a\\u062d\\u062f\\u064a\\u062b\",\"view\":\"\\u0631\\u0623\\u064a\",\"this_field_is_required\":\"\\u0647\\u0630\\u0647 \\u0627\\u0644\\u062e\\u0627\\u0646\\u0629 \\u0645\\u0637\\u0644\\u0648\\u0628\\u0647\",\"please_enter_valid_email\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0628\\u0631\\u064a\\u062f \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a \\u0635\\u062d\\u064a\\u062d\",\"the_text_is_too_short\":\"\\u0646\\u0635 \\u0642\\u0635\\u064a\\u0631 \\u0644\\u0644\\u063a\\u0627\\u064a\\u0629\",\"settings\":\"\",\"exam_series\":\"\\u0633\\u0644\\u0633\\u0644\\u0629 \\u0627\\u0644\\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\",\"instructions\":\"\\u062a\\u0639\\u0644\\u064a\\u0645\\u0627\\u062a\",\"coupons\":\"\\u0643\\u0648\\u0628\\u0648\\u0646\\u0627\\u062a\",\"contents\":\"\\u0645\\u062d\\u062a\\u0648\\u064a\\u0627\\u062a\",\"series\":\"\\u0633\\u0644\\u0633\\u0644\\u0629\",\"notifications\":\"\\u0627\\u0644\\u0625\\u0634\\u0639\\u0627\\u0631\\u0627\\u062a\",\"messages\":\"\\u0631\\u0633\\u0627\\u0626\\u0644\",\"feedback\":\"\\u0631\\u062f\\u0648\\u062f \\u0627\\u0644\\u0641\\u0639\\u0644\",\"update_strings\":\"\\u062a\\u062d\\u062f\\u064a\\u062b \\u0633\\u0644\\u0627\\u0633\\u0644\",\"lms_categories\":\"LMS \\u0627\\u0644\\u0641\\u0626\\u0627\\u062a\",\"update\":\"\\u062a\\u062d\\u062f\\u064a\\u062b\",\"import_excel\":\"\\u0627\\u0633\\u062a\\u064a\\u0631\\u0627\\u062f \\u0625\\u0643\\u0633\\u0644\",\"start_date\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0628\\u062f\\u0621\",\"end_date\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0627\\u0646\\u062a\\u0647\\u0627\\u0621\",\"url\":\"\\u0631\\u0627\\u0628\\u0637\",\"couponcodes\":\"Couponcodes\",\"discount\":\"\\u062e\\u0635\\u0645\",\"minimum_bill\":\"\\u0628\\u064a\\u0644 \\u0627\\u0644\\u062d\\u062f \\u0627\\u0644\\u0623\\u062f\\u0646\\u0649\",\"maximum_discount\":\"\\u0627\\u0644\\u062e\\u0635\\u0645 \\u0627\\u0644\\u0623\\u0642\\u0635\\u0649\",\"limit\":\"\\u062d\\u062f\",\"status\":\"\\u0627\\u0644\\u062d\\u0627\\u0644\\u0629\",\"edit_user\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0627\\u0644\\u0639\\u0636\\u0648\",\"the_text_is_too_long\":\"\\u0627\\u0644\\u0646\\u0635 \\u0637\\u0648\\u064a\\u0644 \\u062c\\u062f\\u0627\",\"invalid_input\":\"\\u0645\\u062f\\u062e\\u0644 \\u063a\\u064a\\u0631 \\u0635\\u0627\\u0644\\u062d\",\"select_role\":\"\\u062d\\u062f\\u062f \\u062f\\u0648\\u0631\",\"add_language\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0644\\u063a\\u0629\",\"language_title\":\"\\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0644\\u063a\\u0629\",\"language_code\":\"\\u0643\\u0648\\u062f \\u0627\\u0644\\u0644\\u063a\\u0629\",\"supported_language_codes\":\"\\u0631\\u0645\\u0648\\u0632 \\u0644\\u063a\\u0629 \\u0645\\u0639\\u062a\\u0645\\u062f\\u0629\",\"edit_language\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0627\\u0644\\u0644\\u063a\\u0629\",\"add_users\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\",\"create_category\":\"\\u0625\\u0646\\u0634\\u0627\\u0621 \\u0627\\u0644\\u0641\\u0626\\u0629\",\"category_name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u062a\\u0635\\u0646\\u064a\\u0641\",\"please_upload_valid_image_type\":\"\\u064a\\u0631\\u062c\\u0649 \\u062a\\u062d\\u0645\\u064a\\u0644 \\u0635\\u0627\\u0644\\u062d \\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0648\\u0631\\u0629\",\"edit_author\":\"\\u0627\\u0644\\u0643\\u0627\\u062a\\u0628 \\u062a\\u062d\\u0631\\u064a\\u0631\",\"question_subjects\":\"\\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a \\u0627\\u0644\\u0633\\u0624\\u0627\\u0644\",\"add_subject\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"subject\":\"\\u0645\\u0648\\u0636\\u0648\\u0639\",\"view_questions\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0623\\u0633\\u0626\\u0644\\u0629\",\"subject_title\":\"\\u064a\\u062e\\u0636\\u0639 \\u0639\\u0646\\u0648\\u0627\\u0646\",\"subject_code\":\"\\u0631\\u0645\\u0632 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"is_lab\":\"\\u0647\\u0648 \\u0645\\u062e\\u062a\\u0628\\u0631\",\"is_elective\":\"\\u063a\\u064a\\u0631 \\u0627\\u0644\\u0627\\u062e\\u062a\\u064a\\u0627\\u0631\\u064a\\u0629\",\"maximum_marks\":\"\\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0642\\u0635\\u0648\\u0649\",\"please_enter_valid_number\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0635\\u0627\\u0644\\u062d \\u0639\\u062f\\u062f\",\"pass_marks\":\"\\u0639\\u0644\\u0627\\u0645\\u0629 \\u0645\\u0631\\u0648\\u0631\",\"please_enter_valid_maximum_marks\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0642\\u0635\\u0648\\u0649 \\u0635\\u0627\\u0644\\u062d\",\"please_enter_valid_pass_marks\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0646\\u062c\\u0627\\u062d \\u0635\\u0627\\u0644\\u062d\\u0629\",\"pass_marks_cannot_be_greater_than_maximum_marks\":\"\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0646\\u062c\\u0627\\u062d \\u0644\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u0623\\u0646 \\u062a\\u0643\\u0648\\u0646 \\u0623\\u0643\\u0628\\u0631 \\u0645\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0642\\u0635\\u0648\\u0649\",\"topic\":\"\\u0645\\u0648\\u0636\\u0648\\u0639\",\"question\":\"\\u0633\\u0624\\u0627\\u0644\",\"difficulty\":\"\\u0635\\u0639\\u0648\\u0628\\u0629\",\"subjects_list\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a\",\"max_marks\":\"\\u0645\\u0627\\u0631\\u0643\\u0633 \\u0645\\u0627\\u0643\\u0633\",\"topics_list\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0636\\u064a\\u0639\",\"parent\":\"\\u0623\\u0635\\u0644\",\"from_email\":\"\\u0645\\u0646 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649\",\"from_name\":\"\\u0645\\u0646 \\u0627\\u0644\\u0627\\u0633\\u0645\",\"module\":\"\\u0648\\u062d\\u062f\\u0629\",\"key\":\"\\u0645\\u0641\\u062a\\u0627\\u062d\",\"add_setting\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0648\\u0636\\u0639\",\"edit_topic\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"select_parent\":\"\\u062d\\u062f\\u062f \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\",\"topic_name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"edit_template\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0642\\u0627\\u0644\\u0628\",\"welcome\":\"\\u0623\\u0647\\u0644\\u0627 \\u0628\\u0643\",\"are_you_sure\":\"\\u0647\\u0644 \\u0623\\u0646\\u062a \\u0648\\u0627\\u062b\\u0642\",\"you_will_not_be_able_to_recover_this_record\":\"\\u0623\\u0646\\u062a \\u0644\\u0646 \\u062a\\u0643\\u0648\\u0646 \\u0642\\u0627\\u062f\\u0631\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0633\\u062a\\u0631\\u062f\\u0627\\u062f \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0633\\u062c\\u0644\",\"delete_it\":\"\\u0627\\u062d\\u0630\\u0641\\u0647\",\"cancel_please\":\"\\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0631\\u062c\\u0627\\u0621\",\"your_record_has_been_deleted\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u062a\\u0645 \\u062d\\u0630\\u0641\",\"cancelled\":\"\\u062a\\u0645 \\u0627\\u0644\\u0627\\u0644\\u063a\\u0627\\u0621\",\"your_record_is_safe\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0622\\u0645\\u0646\\u0629\",\"payment_reports\":\"\\u062a\\u0642\\u0627\\u0631\\u064a\\u0631 \\u0627\\u0644\\u062f\\u0641\\u0639\",\"online_payments\":\"\\u0627\\u0644\\u0645\\u062f\\u0641\\u0648\\u0639\\u0627\\u062a \\u0639\\u0628\\u0631 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0631\\u0646\\u062a\",\"offline_payments\":\"\\u0627\\u0644\\u0645\\u062f\\u0641\\u0648\\u0639\\u0627\\u062a \\u062d\\u0627\\u0644\\u064a\\u0627\",\"export\":\"\\u062a\\u0635\\u062f\\u064a\\u0631\",\"sms\":\"\\u0631\\u0633\\u0627\\u0644\\u0629 \\u0642\\u0635\\u064a\\u0631\\u0629\",\"search_student\":\"\\u0627\\u0644\\u0628\\u062d\\u062b \\u0627\\u0644\\u0637\\u0644\\u0628\\u0629\",\" my_profile\":\"\\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\" change_password\":\"\\u062a\\u063a\\u064a\\u064a\\u0631 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0633\\u0631\",\" feedback\":\"\\u0631\\u062f\\u0648\\u062f \\u0627\\u0644\\u0641\\u0639\\u0644\",\" notifications\":\"\\u0627\\u0644\\u0625\\u0634\\u0639\\u0627\\u0631\\u0627\\u062a\",\"_messages\":\"\\u0631\\u0633\\u0627\\u0626\\u0644\",\"_languages\":\"\\u0627\\u0644\\u0644\\u063a\\u0627\\u062a\",\"_logout\":\"\\u062e\\u0631\\u0648\\u062c\",\"academic_operations\":\"\\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u0623\\u0643\\u0627\\u062f\\u064a\\u0645\\u064a\\u0629\",\"certificates\":\"\\u0634\\u0647\\u0627\\u062f\\u0627\\u062a\",\"transfers\":\"\\u0646\\u0642\\u0644\",\"timetable\":\"\\u0627\\u0644\\u062c\\u062f\\u0648\\u0644 \\u0627\\u0644\\u0632\\u0645\\u0646\\u064a\",\"offline_exams_\":\"\\u0627\\u0644\\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\\u0627\\u062a \\u0645\\u062a\\u0648\\u0627\\u062c\\u062f \\u062d\\u0627\\u0644\\u064a\\u0627\",\"certificate_templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0627\\u0644\\u0634\\u0647\\u0627\\u062f\\u0627\\u062a\",\"please_wait\":\"\\u0623\\u0631\\u062c\\u0648 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0638\\u0627\\u0631\"}', '2016-08-18 00:10:49', '2017-01-02 07:55:22');
INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `phrases`, `created_at`, `updated_at`) VALUES
(6, 'Tamil', 'tamil', 'ta', 0, 0, '{\"success\":\"\\u0bb5\\u0bc6\\u0bb1\\u0bcd\\u0bb1\\u0bbf\",\"record_updated_successfully\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1 \\u0bb5\\u0bc6\\u0bb1\\u0bcd\\u0bb1\\u0bbf\\u0b95\\u0bb0\\u0bae\\u0bbe\\u0b95 \\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"languages\":\"\\u0bae\\u0bc6\\u0bbe\\u0bb4\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"create\":\"\\u0b89\\u0bb0\\u0bc1\\u0bb5\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"language\":\"\\u0bae\\u0bc6\\u0bbe\\u0bb4\\u0bbf\",\"code\":\"\\u0b95\\u0bc1\\u0bb1\\u0bbf\\u0baf\\u0bc0\\u0b9f\\u0bc1\",\"is_rtl\":\"\\u0bb5\\u0bb2\\u0bae\\u0bbf\\u0bb0\\u0bc1\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0b87\\u0b9f\\u0bae\\u0bbe\\u0b95 \\u0b87\\u0bb0\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bbf\\u0bb1\\u0ba4\\u0bc1\",\"default_language\":\"\\u0b87\\u0baf\\u0bb2\\u0bcd\\u0baa\\u0bc1\\u0ba8\\u0bbf\\u0bb2\\u0bc8 \\u0bae\\u0bc6\\u0bbe\\u0bb4\\u0bbf\",\"action\":\"\\u0b85\\u0ba4\\u0bbf\\u0bb0\\u0b9f\\u0bbf\",\"deleted\":\"\\u0ba8\\u0bc0\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\",\"sorry\":\"\\u0bae\\u0ba9\\u0bcd\\u0ba9\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"cannot_delete_this_record_as\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4 \\u0b9a\\u0bbe\\u0ba4\\u0ba9\\u0bc8\\u0baf\\u0bc8 \\u0baa\\u0bc7\\u0bbe\\u0bb2\\u0bcd \\u0ba8\\u0bc0\\u0b95\\u0bcd\\u0b95 \\u0bae\\u0bc1\\u0b9f\\u0bbf\\u0baf\\u0bbe\\u0ba4\\u0bc1\",\"site_title\":\"\\u0ba4\\u0bb3 \\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"latest_users\":\"\\u0b9a\\u0bae\\u0bc0\\u0baa\\u0ba4\\u0bcd\\u0ba4\\u0bbf\\u0baf \\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"was_joined_as\":\"\\u0b8e\\u0ba9 \\u0b87\\u0ba3\\u0bc8\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0b95\\u0bc6\\u0bbe\\u0ba3\\u0bcd\\u0b9f\\u0ba9\\u0bb0\\u0bcd\",\"see_more\":\"\\u0bae\\u0bc7\\u0bb2\\u0bc1\\u0bae\\u0bcd \\u0baa\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\",\"my_profile\":\"\\u0b8e\\u0ba9\\u0bcd \\u0b9a\\u0bc1\\u0baf\\u0bb5\\u0bbf\\u0bb5\\u0bb0\\u0bae\\u0bcd\",\"change_password\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\\u0bb2\\u0bc8 \\u0bae\\u0bbe\\u0bb1\\u0bcd\\u0bb1\\u0bc1\",\"logout\":\"\\u0bb5\\u0bc6\\u0bb3\\u0bbf\\u0baf\\u0bc7\\u0bb1\\u0bc1\",\"dashboard\":\"\\u0b9f\\u0bbe\\u0bb7\\u0bcd\\u0baa\\u0bc7\\u0bbe\\u0bb0\\u0bcd\\u0b9f\\u0bc1\",\"users\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"roles\":\"\\u0baa\\u0bbe\\u0ba4\\u0bcd\\u0ba4\\u0bbf\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"fee_settings\":\"\\u0b95\\u0b9f\\u0bcd\\u0b9f\\u0ba3\\u0bae\\u0bcd \\u0b85\\u0bae\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"fee_categories\":\"\\u0b95\\u0b9f\\u0bcd\\u0b9f\\u0ba3\\u0bae\\u0bcd \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"fee_category_allotment\":\"\\u0b95\\u0b9f\\u0bcd\\u0b9f\\u0ba3\\u0bae\\u0bcd \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bc1 \\u0b92\\u0ba4\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc0\\u0b9f\\u0bc1\",\"fee_particulars\":\"\\u0b95\\u0b9f\\u0bcd\\u0b9f\\u0ba3\\u0bae\\u0bcd \\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"fee_schedules\":\"\\u0b95\\u0b9f\\u0bcd\\u0b9f\\u0ba3\\u0bae\\u0bcd \\u0bb5\\u0bbf\\u0bae\\u0bbe\\u0ba9 \\u0b95\\u0bbe\\u0bb2 \\u0b85\\u0b9f\\u0bcd\\u0b9f\\u0bb5\\u0ba3\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"fines\":\"\\u0b85\\u0baa\\u0bb0\\u0bbe\\u0ba4\\u0bae\\u0bcd\",\"discounts\":\"\\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"master_settings\":\"\\u0bae\\u0bbe\\u0bb8\\u0bcd\\u0b9f\\u0bb0\\u0bcd \\u0b85\\u0bae\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"religions_master\":\"\\u0bae\\u0ba4\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bbe\\u0bb8\\u0bcd\\u0b9f\\u0bb0\\u0bcd\",\"academics_master\":\"\\u0b95\\u0bb2\\u0bcd\\u0bb5\\u0bbf\\u0baf\\u0bbe\\u0bb3\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bbe\\u0bb8\\u0bcd\\u0b9f\\u0bb0\\u0bcd\",\"courses_master\":\"\\u0bae\\u0bc8\\u0ba4\\u0bbe\\u0ba9\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bbe\\u0bb8\\u0bcd\\u0b9f\\u0bb0\\u0bcd\",\"subjects_master\":\"\\u0baa\\u0bbe\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bbe\\u0bb8\\u0bcd\\u0b9f\\u0bb0\\u0bcd\",\"subject_topics\":\"\\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0bb3\\u0bcd \\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"course_subjects\":\"\\u0baa\\u0bbe\\u0b9f\\u0ba4\\u0bcd\\u0ba4\\u0bbf\\u0b9f\\u0bcd\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8\",\"email_templates\":\"\\u0bae\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0b9e\\u0bcd\\u0b9a\\u0bb2\\u0bcd \\u0bb5\\u0bbe\\u0bb0\\u0bcd\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"exams\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"categories\":\"\\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"question_bank\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf \\u0bb5\\u0b99\\u0bcd\\u0b95\\u0bbf\",\"quiz\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe\",\"lms\":\"LMS\",\"content\":\"\\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0b9f\\u0b95\\u0bcd\\u0b95\",\"study_materials\":\"\\u0b86\\u0baf\\u0bcd\\u0bb5\\u0bc1 \\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0b9f\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"library\":\"\\u0ba8\\u0bc2\\u0bb2\\u0b95\\u0bae\\u0bcd\",\"asset_types\":\"\\u0b9a\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"master_data\":\"\\u0baa\\u0bbf\\u0bb0\\u0ba4\\u0bbe\\u0ba9 \\u0ba4\\u0bb0\\u0bb5\\u0bc1\",\"publishers\":\"\\u0baa\\u0baa\\u0bcd\\u0bb3\\u0bbf\\u0bb7\\u0bb0\\u0bcd\\u0bb8\\u0bcd\",\"authors\":\"\\u0b86\\u0b9a\\u0bbf\\u0bb0\\u0bbf\\u0baf\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"students\":\"\\u0bae\\u0bbe\\u0ba3\\u0bb5\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"staff\":\"\\u0b8a\\u0bb4\\u0bbf\\u0baf\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"school_hub\":\"\\u0baa\\u0bb3\\u0bcd\\u0bb3\\u0bbf \\u0bae\\u0bc8\\u0baf\\u0bae\\u0bcd\",\"attendance\":\"\\u0bb5\\u0bb0\\u0bc1\\u0b95\\u0bc8\",\"edit\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b95\\u0bc1\",\"delete\":\"\\u0b85\\u0bb4\\u0bbf\",\"enable\":\"\\u0b87\\u0baf\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"set_default\":\"\\u0b87\\u0baf\\u0bb2\\u0bcd\\u0baa\\u0bbe\\u0b95 \\u0b85\\u0bae\\u0bc8\",\"disable\":\"\\u0bae\\u0bc1\\u0b9f\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"user_statistics\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd \\u0baa\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0bbf \\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"view_all\":\"\\u0b95\\u0bbe\\u0ba3\\u0bcd\\u0b95 \\u0b85\\u0ba9\\u0bc8\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"quiz_categories\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"quizzes\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8\",\"subjects\":\"\\u0baa\\u0bbe\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"topics\":\"\\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"questions\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"home\":\"\\u0bae\\u0bc1\\u0b95\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"faqs\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"about_us\":\"\\u0b8e\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0baa\\u0bb1\\u0bcd\\u0bb1\\u0bbf\",\"contact_us\":\"\\u0b8e\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\\u0baa\\u0bc1\",\"email\":\"\\u0bae\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0b9e\\u0bcd\\u0b9a\\u0bb2\\u0bcd\",\"password\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\",\"login\":\"\\u0b89\\u0bb3\\u0bcd \\u0ba8\\u0bc1\\u0bb4\\u0bc8\",\"forgot_password\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd \\u0bae\\u0bb1\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0bbf\\u0b9f\\u0bcd\\u0b9f\\u0bc0\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bbe\",\"register\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1\",\"this_field_id_required\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4 \\u0ba4\\u0bc1\\u0bb1\\u0bc8\\u0baf\\u0bbf\\u0bb2\\u0bcd \\u0b90\\u0b9f\\u0bbf \\u0ba4\\u0bc7\\u0bb5\\u0bc8\",\"please_enter_valid_email\":\"\\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0bae\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0b9e\\u0bcd\\u0b9a\\u0bb2\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"this_field_is_required\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4 \\u0ba4\\u0bc1\\u0bb1\\u0bc8\\u0baf\\u0bbf\\u0bb2\\u0bcd \\u0ba4\\u0bc7\\u0bb5\\u0bc8\",\"the_text_is_too_short\":\"\\u0b89\\u0bb0\\u0bc8 \\u0bae\\u0bbf\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd \\u0b9a\\u0bbf\\u0bb1\\u0bbf\\u0baf\\u0ba4\\u0bbe\\u0b95 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0ba4\\u0bc1\",\"settings\":\"\",\"are_you_sure\":\"\\u0ba8\\u0bc0 \\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\\u0bb5\\u0ba4\\u0bc1 \\u0b89\\u0bb1\\u0bc1\\u0ba4\\u0bbf\\u0baf\\u0bbe\",\"you_will_not_be_able_to_recover_this_record\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4\\u0baa\\u0bcd \\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bbf\\u0bb2\\u0bcd \\u0bae\\u0bc0\\u0b9f\\u0bcd\\u0b95 \\u0bae\\u0bc1\\u0b9f\\u0bbf\\u0baf\\u0bbe\\u0ba4\\u0bc1\",\"yes\":\"\\u0b86\\u0bae\\u0bcd\",\"delete_it\":\"\\u0ba8\\u0bc0\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"no\":\"\\u0b87\\u0bb2\\u0bcd\\u0bb2\\u0bc8\",\"cancel_please\":\"\\u0bb0\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0b95\",\"your_record_has_been_deleted\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1 \\u0ba8\\u0bc0\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"cancelled\":\"\\u0bb0\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"your_record_is_safe\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b9a\\u0bbe\\u0ba4\\u0ba9\\u0bc8\\u0baf\\u0bc8 \\u0baa\\u0bbe\\u0ba4\\u0bc1\\u0b95\\u0bbe\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0ba9\\u0ba4\\u0bc1\",\"exam_series\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"instructions\":\"\\u0bb5\\u0bb4\\u0bbf\\u0bae\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"coupons\":\"\\u0b95\\u0bc2\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"list\":\"\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0bbf\\u0baf\\u0bb2\\u0bcd\",\"add\":\"\\u0b95\\u0bc2\\u0b9f\\u0bcd\\u0b9f\\u0bc1\",\"contents\":\"\\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0bb3\\u0b9f\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"series\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"payment_reports\":\"\\u0b95\\u0bc6\\u0bbe\\u0b9f\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bb5\\u0bc1 \\u0b85\\u0bb1\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"online_payments\":\"\\u0b86\\u0ba9\\u0bcd\\u0bb2\\u0bc8\\u0ba9\\u0bcd \\u0b95\\u0bc6\\u0bbe\\u0b9f\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bb5\\u0bc1\",\"offline_payments\":\"\\u0ba8\\u0ba9\\u0bcd\\u0bb1\\u0bbf \\u0b9a\\u0bc6\\u0bb2\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\\u0bae\\u0bcd\",\"export\":\"\\u0b8f\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0bae\\u0ba4\\u0bbf\",\"notifications\":\"\\u0b85\\u0bb1\\u0bbf\\u0bb5\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"sms\":\"\\u0b8e\\u0bb8\\u0bcd\\u0b8e\\u0bae\\u0bcd\\u0b8e\\u0bb8\\u0bcd\",\"feedback\":\"\\u0b95\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"update_strings\":\"\\u0b9a\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"create_series\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bc8 \\u0b89\\u0bb0\\u0bc1\\u0bb5\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"title\":\"\\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"duration\":\"\\u0b95\\u0bbe\\u0bb2\\u0bae\\u0bcd\",\"category\":\"\\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"is_paid\":\"\\u0b9a\\u0bc6\\u0bb2\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bc1\\u0b95\\u0bbf\\u0bb1\\u0ba4\\u0bc1\",\"total_marks\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc6\\u0ba3\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"update_questions\":\"\\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1 \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"free\":\"\\u0b87\\u0bb2\\u0bb5\\u0b9a\",\"paid\":\"\\u0baa\\u0ba3\\u0bae\\u0bcd\",\"create_quiz\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe \\u0b89\\u0bb0\\u0bc1\\u0bb5\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"quiz_title\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe \\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"invalid_input\":\"\\u0ba4\\u0bb5\\u0bb1\\u0bbe\\u0ba9 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bc0\\u0b9f\\u0bc1\",\"the_text_is_too_long\":\"\\u0b89\\u0bb0\\u0bc8 \\u0bae\\u0bbf\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd \\u0ba8\\u0bc0\\u0bb3\\u0bae\\u0bbe\\u0b95 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0ba4\\u0bc1\",\"enter_value_in_minutes\":\"\\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1 \\u0ba8\\u0bbf\\u0bae\\u0bbf\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"please_enter_valid_number\":\"\\u0ba4\\u0baf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bc1 \\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0b8e\\u0ba3\\u0bcd\\u0ba3\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"it will be updated by adding the questions\":\"\\u0b85\\u0ba4\\u0bc1 \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd \\u0b9a\\u0bc7\\u0bb0\\u0bcd\\u0baa\\u0bcd\\u0baa\\u0ba4\\u0ba9\\u0bcd \\u0bae\\u0bc2\\u0bb2\\u0bae\\u0bcd \\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bc1\\u0bae\\u0bcd\",\"pass_percentage\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0b9a\\u0bcd\\u0b9a\\u0bbf \\u0b9a\\u0ba4\\u0bb5\\u0bc0\\u0ba4\\u0bae\\u0bcd\",\"negative_mark\":\"\\u0b8e\\u0ba4\\u0bbf\\u0bb0\\u0bcd\\u0bae\\u0bb1\\u0bc8 \\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\",\"instructions_page\":\"\\u0bb5\\u0bb4\\u0bbf\\u0bae\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"start_date\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0b95\\u0bcd\\u0b95 \\u0ba4\\u0bc7\\u0ba4\\u0bbf\",\"end_date\":\"\\u0b95\\u0b9f\\u0bc8\\u0b9a\\u0bbf \\u0ba4\\u0bc7\\u0ba4\\u0bbf\",\"select\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1\",\"validity\":\"\\u0b8f\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc6\\u0bbe\\u0bb3\\u0bcd\\u0bb3\\u0b95\\u0bcd\\u0b95\\u0bc2\\u0b9f\\u0bbf\\u0baf\",\"validity_in_days\":\"\\u0ba8\\u0bbe\\u0b9f\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b8f\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc6\\u0bbe\\u0bb3\\u0bcd\\u0bb3\\u0b95\\u0bcd \\u0b95\\u0bc2\\u0b9f\\u0bbf\\u0baf\",\"cost\":\"\\u0b9a\\u0bc6\\u0bb2\\u0bb5\\u0bc1\",\"description\":\"\\u0bb5\\u0bbf\\u0bb3\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"update_questions_for\":\"\\u0bae\\u0bc7\\u0bae\\u0bcd\\u0baa\\u0b9f\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bb2\\u0bcd \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"difficulty\":\"\\u0b95\\u0b9f\\u0bbf\\u0ba9\\u0bae\\u0bcd\",\"easy\":\"\\u0b8e\\u0bb3\\u0bbf\\u0ba4\\u0bbe\\u0b95\",\"medium\":\"\\u0ba8\\u0b9f\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bb0\",\"hard\":\"\\u0bb9\\u0bbe\\u0bb0\\u0bcd\\u0b9f\\u0bcd\",\"question_type\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf \\u0bb5\\u0b95\\u0bc8\",\"single_answer\":\"\\u0b92\\u0bb1\\u0bcd\\u0bb1\\u0bc8 \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"multi_answer\":\"\\u0bae\\u0bb2\\u0bcd\\u0b9f\\u0bbf \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"fill_in_the_blanks\":\"\\u0bb5\\u0bc6\\u0bb1\\u0bcd\\u0bb1\\u0bbf\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0ba8\\u0bbf\\u0bb0\\u0baa\\u0bcd\\u0baa\",\"match_the_following\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0ba8\\u0bcd\\u0ba4 \\u0baa\\u0bc7\\u0bbe\\u0b9f\\u0bcd\\u0b9f\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"paragraph\":\"\\u0baa\\u0ba4\\u0bcd\\u0ba4\\u0bbf\",\"video\":\"\\u0b95\\u0bbe\\u0ba3\\u0bc6\\u0bbe\\u0bb3\\u0bbf\",\"search_term\":\"\\u0ba4\\u0bc7\\u0b9f\\u0bb2\\u0bcd \\u0b95\\u0bbe\\u0bb2\",\"enter_search_term\":\"\\u0ba4\\u0bc7\\u0b9f\\u0bb2\\u0bcd \\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\\u0bb2\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"subject\":\"\\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0bb3\\u0bcd\",\"question\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\",\"type\":\"\\u0bb5\\u0b95\\u0bc8\",\"marks\":\"\\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc6\\u0ba3\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"saved_questions\":\"\\u0b9a\\u0bc7\\u0bae\\u0bbf\\u0ba4\\u0bcd\\u0ba4 \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"remove_all\":\"\\u0b85\\u0ba9\\u0bc8\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0ba8\\u0bc0\\u0b95\\u0bcd\\u0b95\",\"update\":\"\\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"import_excel\":\"\\u0b87\\u0bb1\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0ba4\\u0bbf \\u0b8e\\u0b95\\u0bcd\\u0b9a\\u0bc6\\u0bb2\\u0bcd\",\"add_user\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd \\u0b9a\\u0bc7\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\",\"name\":\"\\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bcd\",\"image\":\"\\u0baa\\u0b9f\",\"role\":\"\\u0baa\\u0b99\\u0bcd\\u0b95\\u0bc1\",\"import_users\":\"\\u0b87\\u0bb1\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0ba4\\u0bbf \\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"download_template\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bbf\\u0bb1\\u0b95\\u0bcd\\u0b95 \\u0b9f\\u0bc6\\u0bae\\u0bcd\\u0baa\\u0bcd\\u0bb3\\u0bc7\\u0b9f\\u0bcd\",\"upload\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc7\\u0bb1\\u0bcd\\u0bb1\\u0bc1\",\"upload_excel\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc7\\u0bb1\\u0bcd\\u0bb1\\u0bae\\u0bcd \\u0b8e\\u0b95\\u0bcd\\u0b9a\\u0bc6\\u0bb2\\u0bcd\",\"file_type_not_allowed\":\"\\u0b95\\u0bc7\\u0bbe\\u0baa\\u0bcd\\u0baa\\u0bc1 \\u0bb5\\u0b95\\u0bc8 \\u0b85\\u0ba9\\u0bc1\\u0bae\\u0ba4\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bb5\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bc8\",\"subjects_list\":\"\\u0baa\\u0bbe\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bbf\\u0bb2\\u0bcd \\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0bbf\\u0baf\\u0bb2\\u0bcd\",\"import\":\"\\u0b87\\u0bb1\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0ba4\\u0bbf\",\"id\":\"\\u0b85\\u0b9f\\u0bc8\\u0baf\\u0bbe\\u0bb3\\u0bae\\u0bcd\",\"max_marks\":\"\\u0bae\\u0bc7\\u0b95\\u0bcd\\u0bb8\\u0bcd \\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0bb8\\u0bcd\",\"pass_marks\":\"\\u0baa\\u0bbe\\u0bb8\\u0bcd \\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0bb8\\u0bcd\",\"total_exams\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"total_questions\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"update_quizzes\":\"\\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1 \\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8\",\"update_series_for\":\"\\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"exam_categories\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"exam_name\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bcd\",\"saved_exams\":\"\\u0b9a\\u0bc7\\u0bae\\u0bbf\\u0ba4\\u0bcd\\u0ba4 \\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"no_data_available\":\"\\u0ba4\\u0bb0\\u0bb5\\u0bc1 \\u0b8e\\u0ba4\\u0bc1\\u0bb5\\u0bc1\\u0bae\\u0bcd \\u0b95\\u0bbf\\u0b9f\\u0bc8\\u0b95\\u0bcd\\u0b95\\u0bb5\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bc8\",\"couponcodes\":\"Couponcodes\",\"discount\":\"\\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf\",\"minimum_bill\":\"\\u0b95\\u0bc1\\u0bb1\\u0bc8\\u0ba8\\u0bcd\\u0ba4\\u0baa\\u0b9f\\u0bcd\\u0b9a \\u0baa\\u0bbf\\u0bb2\\u0bcd\",\"maximum_discount\":\"\\u0b85\\u0ba4\\u0bbf\\u0b95\\u0baa\\u0b9f\\u0bcd\\u0b9a \\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf\",\"limit\":\"\\u0b85\\u0bb3\\u0bb5\\u0bc1\",\"status\":\"\\u0ba8\\u0bbf\\u0bb2\\u0bc8\\u0bae\\u0bc8\",\"question_subjects\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf \\u0baa\\u0bbe\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"import_questions\":\"\\u0b87\\u0bb1\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0ba4\\u0bbf \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"add_subject\":\"\\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0bb3\\u0bcd \\u0b9a\\u0bc7\\u0bb0\\u0bcd\",\"view_questions\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bc8\\u0b95\\u0bcd \\u0b95\\u0bbe\\u0ba3\\u0bcd\\u0b95\",\"examseries\":\"Examseries\",\"edit_coupon\":\"\\u0b95\\u0bc2\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bcd \\u0ba4\\u0bbf\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"coupon_code\":\"\\u0b95\\u0bc2\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bcd \\u0b95\\u0bc1\\u0bb1\\u0bbf\\u0baf\\u0bc0\\u0b9f\\u0bc1\",\"value\":\"\\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"percent\":\"\\u0b9a\\u0ba4\\u0bb5\\u0bc0\\u0ba4\\u0bae\\u0bcd\",\"discount_type\":\"\\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf \\u0bb5\\u0b95\\u0bc8\",\"discount_value\":\"\\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf \\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"enter_value\":\"\\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"discount_maximum_amount\":\"\\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf \\u0b85\\u0ba4\\u0bbf\\u0b95\\u0baa\\u0b9f\\u0bcd\\u0b9a \\u0b85\\u0bb3\\u0bb5\\u0bc1\",\"enter_maximum_amount\":\"\\u0b85\\u0ba4\\u0bbf\\u0b95\\u0baa\\u0b9f\\u0bcd\\u0b9a \\u0b85\\u0bb3\\u0bb5\\u0bc1 \\u0b9a\\u0bc7\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"valid_from\":\"\\u0b9a\\u0bc6\\u0bb2\\u0bcd\\u0bb2\\u0bc1\\u0baa\\u0b9f\\u0bbf\\u0baf\\u0bbe\\u0b95\\u0bc1\\u0bae\\u0bcd\",\"valid_to\":\"\\u0b9a\\u0bc6\\u0bb2\\u0bcd\\u0bb2\\u0bc1\\u0baa\\u0b9f\\u0bbf\\u0baf\\u0bbe\\u0b95\\u0bc1\\u0bae\\u0bcd\",\"usage_limit\":\"\\u0baa\\u0baf\\u0ba9\\u0bcd\\u0baa\\u0bbe\\u0b9f\\u0bc1 \\u0b95\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bcd\\u0b95\",\"enter_usage_limit_per_user\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd \\u0b92\\u0ba9\\u0bcd\\u0bb1\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc1 \\u0baa\\u0baf\\u0ba9\\u0bcd\\u0baa\\u0bbe\\u0b9f\\u0bc1 \\u0b95\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bcd\\u0b95 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"pending\":\"\\u0ba8\\u0bbf\\u0bb2\\u0bc1\\u0bb5\\u0bc8\\u0baf\\u0bbf\\u0bb2\\u0bcd\",\"total\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4\",\"overall_statistics\":\"\\u0b92\\u0b9f\\u0bcd\\u0b9f\\u0bc1\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0baa\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0bae\\u0bcd\",\"payments_reports_in\":\"\\u0baa\\u0ba3\\u0bae\\u0bcd \\u0b85\\u0bb1\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"payments\":\"\\u0b95\\u0bc6\\u0bbe\\u0b9f\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bb5\\u0bc1\",\"payment_statistics\":\"\\u0b95\\u0bc6\\u0bbe\\u0b9f\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bb5\\u0bc1 \\u0baa\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0baf\\u0bbf\\u0baf\\u0bb2\\u0bcd\",\"payment_monthly_statistics\":\"\\u0bae\\u0bbe\\u0ba4\\u0bbe\\u0ba8\\u0bcd\\u0ba4\\u0bbf\\u0bb0 \\u0baa\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0bae\\u0bcd\",\"feed_backs\":\"\\u0b8a\\u0b9f\\u0bcd\\u0b9f\\u0bae\\u0bcd \\u0bae\\u0bc1\\u0ba4\\u0bc1\\u0b95\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"posted_on\":\"posted On\",\"view\":\"\\u0b95\\u0bbe\\u0ba3\\u0bcd\\u0b95\",\"feedback_details\":\"\\u0b95\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"feedbacks\":\"\\u0baa\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0bc2\\u0b9f\\u0bcd\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8\",\"back\":\"\\u0bae\\u0bc0\\u0ba3\\u0bcd\\u0b9f\\u0bc1\\u0bae\\u0bcd\",\"module\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b95\\u0bc1\\u0ba4\\u0bbf\",\"key\":\"\\u0bae\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bbf\\u0baf\",\"demanding_quizzes\":\"\\u0b95\\u0bc7\\u0bbe\\u0bb0\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8\",\"demanding\":\"\\u0b95\\u0bc7\\u0bbe\\u0bb0\\u0bbf\",\"quizzes_usage\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8 \\u0baa\\u0baf\\u0ba9\\u0bcd\\u0baa\\u0bbe\\u0b9f\\u0bc1\",\"paid_quizzes_usage\":\"\\u0baa\\u0ba3\\u0bae\\u0bcd \\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8 \\u0baa\\u0baf\\u0ba9\\u0bcd\\u0baa\\u0bbe\\u0b9f\\u0bc1\",\"your_payment_was cancelled\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0ba3\\u0bae\\u0bcd \\u0bb0\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0baf\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"subscriptions_list\":\"\\u0b9a\\u0ba8\\u0bcd\\u0ba4\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0bbf\\u0baf\\u0bb2\\u0bcd\",\"plan_type\":\"\\u0ba4\\u0bbf\\u0b9f\\u0bcd\\u0b9f\\u0bae\\u0bcd \\u0bb5\\u0b95\\u0bc8\",\"paid_from\":\"\\u0b87\\u0bb0\\u0bc1\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0baa\\u0ba3\\u0bae\\u0bcd\",\"datetime\":\"\\u0ba4\\u0bc7\\u0ba4\\u0bbf \\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd\",\"my_bookmarks\":\"\\u0b8e\\u0ba9\\u0ba4\\u0bc1 \\u0baa\\u0bc1\\u0b95\\u0bcd\\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"analysis\":\"\\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"by_subjcet\":\"Subjcet \\u0bae\\u0bc2\\u0bb2\\u0bae\\u0bcd\",\"by_exam\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0bae\\u0bc2\\u0bb2\\u0bae\\u0bcd\",\"history\":\"\\u0bb5\\u0bb0\\u0bb2\\u0bbe\\u0bb1\\u0bc1\",\"subscriptions\":\"\\u0b9a\\u0ba8\\u0bcd\\u0ba4\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"add_setting\":\"\\u0b85\\u0bae\\u0bc8\\u0ba4\\u0bcd\\u0ba4\\u0bb2\\u0bcd \\u0b9a\\u0bc7\\u0bb0\\u0bcd\",\"introduction\":\"\\u0b85\\u0bb1\\u0bbf\\u0bae\\u0bc1\\u0b95\\u0bae\\u0bcd\",\"description_of_the_topic\":\"\\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0ba9\\u0bcd \\u0bb5\\u0bbf\\u0bb3\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"old_password\":\"\\u0baa\\u0bb4\\u0bc8\\u0baf \\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\",\"the_password_is_too_short\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd \\u0bae\\u0bbf\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd \\u0b9a\\u0bbf\\u0bb1\\u0bbf\\u0baf\\u0ba4\\u0bbe\\u0b95 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0ba4\\u0bc1\",\"new_password\":\"\\u0baa\\u0bc1\\u0ba4\\u0bbf\\u0baf \\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\",\"retype_password\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\\u0bb2\\u0bc8 \\u0bae\\u0bc0\\u0ba3\\u0bcd\\u0b9f\\u0bc1\\u0bae\\u0bcd \\u0ba4\\u0b9f\\u0bcd\\u0b9f\\u0b9a\\u0bcd\\u0b9a\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0b95\",\"password_and_confirm_password_does_not_match\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd \\u0b89\\u0bb1\\u0bc1\\u0ba4\\u0bbf \\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd \\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0ba8\\u0bcd\\u0ba4\\u0bb5\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bc8\",\"correct\":\"\\u0b9a\\u0bb0\\u0bbf\",\"wrong\":\"\\u0ba4\\u0bb5\\u0bb1\\u0bbe\\u0ba9\",\"not_answered\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bb3\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bb5\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bc8\",\"overall_performance\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4\\u0ba4\\u0bcd\\u0ba4\\u0bbf\\u0bb2\\u0bcd \\u0b9a\\u0bc6\\u0baf\\u0bb2\\u0bcd\\u0ba4\\u0bbf\\u0bb1\\u0ba9\\u0bcd\",\"performance\":\"\\u0b9a\\u0bc6\\u0baf\\u0bb2\\u0bcd\\u0ba4\\u0bbf\\u0bb1\\u0ba9\\u0bcd\",\"best_performance_in_all_quizzes\":\"\\u0b85\\u0ba9\\u0bc8\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8 \\u0b9a\\u0bbf\\u0bb1\\u0ba8\\u0bcd\\u0ba4 \\u0ba8\\u0b9f\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"view_analysis\":\"\\u0b95\\u0bbe\\u0ba3\\u0bcd\\u0b95 \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"edit_user\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd \\u0ba4\\u0bbf\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"username\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd\\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bcd\",\"select_role\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0baa\\u0b99\\u0bcd\\u0b95\\u0bc1\",\"phone\":\"\\u0ba4\\u0bc6\\u0bbe\\u0bb2\\u0bc8\\u0baa\\u0bc7\\u0b9a\\u0bbf\",\"please_enter_10-15_digit_mobile_number\":\"\\u0ba4\\u0baf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bc1 10-15 \\u0b87\\u0bb2\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd \\u0bae\\u0bc6\\u0bbe\\u0baa\\u0bc8\\u0bb2\\u0bcd \\u0b8e\\u0ba3\\u0bcd\\u0ba3\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"please_enter_valid_phone_number\":\"\\u0ba4\\u0baf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bc1 \\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0ba4\\u0bc6\\u0bbe\\u0bb2\\u0bc8\\u0baa\\u0bc7\\u0b9a\\u0bbf \\u0b8e\\u0ba3\\u0bcd\\u0ba3\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"address\":\"\\u0bae\\u0bc1\\u0b95\\u0bb5\\u0bb0\\u0bbf\",\"please_enter_your_address\":\"\\u0ba4\\u0baf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bc1 \\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bc1\\u0b95\\u0bb5\\u0bb0\\u0bbf\\u0baf\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"give_feedback\":\"\\u0b95\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0ba4\\u0bc6\\u0bb0\\u0bbf\\u0bb5\\u0bbf\",\"feedback_form\":\"\\u0b95\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0baa\\u0b9f\\u0bbf\\u0bb5\\u0bae\\u0bcd\",\"send\":\"\\u0b85\\u0ba9\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"account_settings\":\"\\u0b95\\u0ba3\\u0b95\\u0bcd\\u0b95\\u0bc1 \\u0b85\\u0bae\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"quiz_and_exam_series\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe \\u0bae\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0bae\\u0bcd \\u0baa\\u0bb0\\u0bc0\\u0b9f\\u0bcd\\u0b9a\\u0bc8 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"lms_categories\":\"LMS \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"time_spent_on_correct_answers\":\"\\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd \\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0b9a\\u0bc6\\u0bb2\\u0bb5\\u0bc1\",\"time_spent_on_wrong_answers\":\"\\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd \\u0ba4\\u0bb5\\u0bb1\\u0bbe\\u0ba9 \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0b9a\\u0bc6\\u0bb2\\u0bb5\\u0bc1\",\"overall_marks_analysis\":\"\\u0b92\\u0b9f\\u0bcd\\u0b9f\\u0bc1\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0bb8\\u0bcd \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"overall_subject_wise_analysis\":\"\\u0b92\\u0b9f\\u0bcd\\u0b9f\\u0bc1\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0bb3\\u0bcd \\u0bb5\\u0bbe\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0b95 \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"of\":\"\\u0b8e\\u0ba9\\u0bcd\\u0bb1\",\"spent_on_correct\":\"\\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0b9a\\u0bc6\\u0bb2\\u0bb5\\u0bc1\",\"spent_on_wrong\":\"\\u0ba4\\u0bb5\\u0bb1\\u0bbe\\u0ba9 \\u0b9a\\u0bc6\\u0bb2\\u0bb5\\u0bc1\",\"total_time\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd\",\"spent_time\":\"\\u0b95\\u0bb4\\u0bbf\\u0ba4\\u0bcd\\u0ba4 \\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd\",\"all_exams\":\"\\u0b85\\u0ba9\\u0bc8\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"dueration\":\"Dueration\",\"take_exam\":\"\\u0baa\\u0bb0\\u0bc0\\u0b9f\\u0bcd\\u0b9a\\u0bc8 \\u0b8e\\u0b9f\\u0bc1\\u0b95\\u0bcd\\u0b95\",\"mins\":\"mins\",\"please_read_the_instructions_carefully\":\"\\u0b95\\u0bb5\\u0ba9\\u0bae\\u0bbe\\u0b95 \\u0b85\\u0bb1\\u0bbf\\u0bb5\\u0bc1\\u0bb0\\u0bc8\\u0b95\\u0bb3\\u0bc8 \\u0baa\\u0b9f\\u0bbf\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0b95\\u0bc6\\u0bbe\\u0bb3\\u0bcd\\u0bb3\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"general_instructions\":\"\\u0baa\\u0bc6\\u0bbe\\u0ba4\\u0bc1 \\u0bb5\\u0bb4\\u0bbf\\u0bae\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"buy_now\":\"\\u0b87\\u0baa\\u0bcd\\u0baa\\u0bc7\\u0bbe\\u0ba4\\u0bc1 \\u0bb5\\u0bbe\\u0b99\\u0bcd\\u0b95\",\"checkout\":\"\\u0bb5\\u0bc6\\u0bb3\\u0bbf\\u0baf\\u0bc7\\u0bb1\\u0bc1\\u0ba4\\u0bb2\\u0bcd\",\"valid_for\":\"\\u0b9a\\u0bc6\\u0bb2\\u0bcd\\u0bb2\\u0bc1\\u0baa\\u0b9f\\u0bbf\\u0baf\\u0bbe\\u0b95\\u0bc1\\u0bae\\u0bcd\",\"days\":\"\\u0ba8\\u0bbe\\u0b9f\\u0bcd\\u0b95\\u0bb3\\u0bbf\\u0bb2\\u0bcd\",\"enter_coupon_code\":\"\\u0b95\\u0bc2\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bcd \\u0b95\\u0bc1\\u0bb1\\u0bbf\\u0baf\\u0bc0\\u0b9f\\u0bc1 \\u0ba8\\u0bc1\\u0bb4\\u0bc8\\u0baf\",\"apply\":\"\\u0bb5\\u0bbf\\u0ba3\\u0bcd\\u0ba3\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\",\"payu\":\"Payu\",\"paypal\":\"\\u0baa\\u0bc7\\u0baa\\u0bbe\\u0bb2\\u0bcd\",\"click_here_to_update_payment_details\":\"\\u0b95\\u0bc6\\u0bbe\\u0b9f\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bb5\\u0bc1 \\u0bb5\\u0bbf\\u0bb5\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95 \\u0b87\\u0b99\\u0bcd\\u0b95\\u0bc1 \\u0b95\\u0bbf\\u0bb3\\u0bbf\\u0b95\\u0bcd\",\"offline_payment\":\"\\u0ba8\\u0ba9\\u0bcd\\u0bb1\\u0bbf \\u0b9a\\u0bc6\\u0bb2\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\\u0ba4\\u0bb2\\u0bcd\",\"details\":\"\\u0bb5\\u0bbf\\u0bb5\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"billing_address\":\"\\u0baa\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bbf\\u0b99\\u0bcd \\u0bae\\u0bc1\\u0b95\\u0bb5\\u0bb0\\u0bbf\",\"limit_reached\":\"\\u0bb5\\u0bb0\\u0bc8\\u0baf\\u0bb1\\u0bc8\\u0baf\\u0bc8 \\u0b8e\\u0b9f\\u0bcd\\u0b9f\\u0bbf\\u0baf\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0ba4\\u0bc1\",\"hey_you_are_eligible_for_discount\":\"\\u0bb9\\u0bc7 \\u0baf\\u0bc2 \\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf \\u0ba4\\u0b95\\u0bc1\\u0ba4\\u0bbf\\u0baf\\u0bc1\\u0b9f\\u0bc8\\u0baf\\u0bb5\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b86\\u0bb5\\u0bb0\\u0bcd\",\"your_subscription_was_successfull\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b9a\\u0ba8\\u0bcd\\u0ba4\\u0bbe\\u0bb5\\u0bc8 \\u0bb5\\u0bc6\\u0bb1\\u0bcd\\u0bb1\\u0bbf\\u0b95\\u0bb0\\u0bae\\u0bbe\\u0b95\",\"please_accept_terms_and_conditions\":\"\\u0bb5\\u0bbf\\u0ba4\\u0bbf\\u0bae\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0bae\\u0bcd \\u0ba8\\u0bbf\\u0baa\\u0ba8\\u0bcd\\u0ba4\\u0ba9\\u0bc8\\u0b95\\u0bb3\\u0bcd \\u0ba4\\u0baf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bc1 \\u0b8f\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc6\\u0bbe\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"start_exam\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0b99\\u0bcd\\u0b95\",\"previous\":\"\\u0bae\\u0bc1\\u0ba8\\u0bcd\\u0ba4\\u0bc8\\u0baf\",\"next\":\"\\u0b85\\u0b9f\\u0bc1\\u0ba4\\u0bcd\\u0ba4\",\"clear_answer\":\"\\u0ba4\\u0bc6\\u0bb3\\u0bbf\\u0bb5\\u0bbe\\u0ba9 \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"bookmarks\":\"\\u0baa\\u0bc1\\u0b95\\u0bcd\\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0bb8\\u0bcd\",\"exam_duration\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0b95\\u0bbe\\u0bb2\\u0bae\\u0bcd\",\"hints\":\"\\u0b95\\u0bc1\\u0bb1\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"bookmark_this_question\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4\\u0b95\\u0bcd \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0baf\\u0bc8\\u0b95\\u0bcd \\u0baa\\u0bc1\\u0b95\\u0bcd\\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\",\"unbookmark_this_question\":\"Unbookmark \\u0b87\\u0ba8\\u0bcd\\u0ba4\\u0b95\\u0bcd \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0baf\\u0bc8\\u0b95\\u0bcd\",\"mark_for_review\":\"\\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd, \\u0bb5\\u0bbf\\u0bae\\u0bb0\\u0bcd\\u0b9a\\u0ba9\\u0bae\\u0bcd\",\"finish\":\"\\u0baa\\u0bbf\\u0ba9\\u0bbf\\u0bb7\\u0bcd\",\"summary\":\"\\u0b9a\\u0bc1\\u0bb0\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"answered\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"marked\":\"\\u0b95\\u0bc1\\u0bb1\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"not_visited\":\"\\u0bb5\\u0bbf\\u0b9c\\u0baf\\u0bae\\u0bcd\",\"consumed_time\":\"\\u0b89\\u0b9f\\u0bcd\\u0b95\\u0bc6\\u0bbe\\u0bb3\\u0bcd\\u0bb3\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bc1\\u0b95\\u0bbf\\u0bb1\\u0ba4\\u0bc1 \\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd\",\"result_for\":\"\\u0bae\\u0bc1\\u0b9f\\u0bbf\\u0bb5\\u0bc1\",\"score\":\"\\u0bb8\\u0bcd\\u0b95\\u0bc7\\u0bbe\\u0bb0\\u0bcd\",\"percentage\":\"\\u0b9a\\u0ba4\\u0bb5\\u0bbf\\u0ba4\\u0bae\\u0bcd\",\"grade\":\"\\u0ba4\\u0bb0\\u0bae\\u0bcd\",\"view_key\":\"\\u0b95\\u0bbe\\u0ba3\\u0bcd\\u0b95 \\u0bae\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bbf\\u0baf\",\"toppers_in_this_exam\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4 \\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bbf\\u0bb2\\u0bcd \\u0bae\\u0bc1\\u0ba4\\u0bb2\\u0bbf\\u0b9f\\u0ba4\\u0bcd\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"click on toper to compare your score\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bb8\\u0bcd\\u0b95\\u0bc7\\u0bbe\\u0bb0\\u0bcd \\u0b92\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b9f\\u0bcd\\u0b9f\\u0bc1 Toper \\u0b95\\u0bbf\\u0bb3\\u0bbf\\u0b95\\u0bcd \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0baf\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"answers\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"result\":\"\\u0bb5\\u0bbf\\u0bb3\\u0bc8\\u0bb5\\u0bbe\\u0b95\",\"time_limit\":\"\\u0ba8\\u0bc7\\u0bb0 \\u0bb5\\u0bb0\\u0bae\\u0bcd\\u0baa\\u0bbf\\u0bb1\\u0bcd\\u0b95\\u0bc1\",\"time_taken\":\"\\u0b8e\\u0b9f\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc6\\u0bbe\\u0ba3\\u0bcd\\u0b9f \\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd\",\"explanation\":\"\\u0bb5\\u0bbf\\u0bb3\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"exam_analysis\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"attempts\":\"\\u0bae\\u0bc1\\u0baf\\u0bb1\\u0bcd\\u0b9a\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"analysis_by_exam\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0bae\\u0bc2\\u0bb2\\u0bae\\u0bcd \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"children\":\"\\u0b95\\u0bc1\\u0bb4\\u0ba8\\u0bcd\\u0ba4\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"no_categories_available\":\"\\u0b95\\u0bbf\\u0b9f\\u0bc8\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0bcd \\u0b87\\u0bb2\\u0bcd\\u0bb2\\u0bc8 \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"click_here_to_change_your_preferences\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bb5\\u0bbf\\u0bb0\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bbe\\u0bb1\\u0bcd\\u0bb1 \\u0b87\\u0b99\\u0bcd\\u0b95\\u0bc7 \\u0b95\\u0bbf\\u0bb3\\u0bbf\\u0b95\\u0bcd \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0baf\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"record_added_successfully\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1 \\u0b9a\\u0bc7\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1 \\u0bb5\\u0bc6\\u0bb1\\u0bcd\\u0bb1\\u0bbf\\u0b95\\u0bb0\\u0bae\\u0bbe\\u0b95\",\"lms_series\":\"LMS \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"no_series_available\":\"\\u0b95\\u0bbf\\u0b9f\\u0bc8\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0bcd \\u0b8e\\u0ba8\\u0bcd\\u0ba4 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"edit_quiz\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe \\u0ba4\\u0bbf\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"messages\":\"\\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"academic_operations\":\"\\u0b95\\u0bb2\\u0bcd\\u0bb5\\u0bbf \\u0ba8\\u0b9f\\u0bb5\\u0b9f\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"certificates\":\"\\u0b9a\\u0bbe\\u0ba9\\u0bcd\\u0bb1\\u0bbf\\u0ba4\\u0bb4\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"transfers\":\"\\u0b87\\u0b9f\\u0bae\\u0bbe\\u0bb1\\u0bcd\\u0bb1\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"timetable\":\"\\u0b95\\u0bbe\\u0bb2 \\u0b85\\u0b9f\\u0bcd\\u0b9f\\u0bb5\\u0ba3\\u0bc8\",\"upload_marks_\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc7\\u0bb1\\u0bcd\\u0bb1\\u0bae\\u0bcd \\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0bb8\\u0bcd\",\"transportation\":\"\\u0baa\\u0bc7\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bb5\\u0bb0\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"vechicles\":\"Vechicles\",\"vehicle_types\":\"\\u0bb5\\u0bbe\\u0b95\\u0ba9 \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"certificate_templates\":\"\\u0b9a\\u0bbe\\u0ba9\\u0bcd\\u0bb1\\u0bbf\\u0ba4\\u0bb4\\u0bcd \\u0b9f\\u0bc6\\u0bae\\u0bcd\\u0baa\\u0bcd\\u0bb3\\u0bc7\\u0b9f\\u0bcd\\u0b95\\u0bb3\\u0bcd\"}', '2016-08-23 00:09:43', '2017-01-02 07:55:22'),
(7, 'Urdu', 'urdu', 'ur', 1, 0, '{\"success\":\"\\u06a9\\u0627\\u0645\\u06cc\\u0627\\u0628\\u06cc\",\"record_updated_successfully\":\"\\u0631\\u06cc\\u06a9\\u0627\\u0631\\u0688 \\u06a9\\u0627\\u0645\\u06cc\\u0627\\u0628\\u06cc \\u0633\\u06d2 \\u0627\\u067e \\u0688\\u06cc\\u0679\",\"languages\":\"\\u0632\\u0628\\u0627\\u0646\\u06cc\\u06ba\",\"create\":\"\\u0628\\u0646\\u0627\\u0646\\u0627\",\"language\":\"\\u0632\\u0628\\u0627\\u0646\",\"code\":\"\\u0636\\u0627\\u0628\\u0637\\u06d2\",\"is_rtl\":\"RTL \\u06c1\\u06d2\",\"default_language\":\"\\u0688\\u06cc\\u0641\\u0627\\u0644\\u0679 \\u0644\\u06cc\\u0646\\u06af\\u0648\\u0626\\u062c\",\"action\":\"\\u0639\\u0645\\u0644\",\"deleted\":\"\\u062d\\u0630\\u0641 \\u0634\\u062f\\u06c1\",\"sorry\":\"\\u0645\\u0639\\u0630\\u0631\\u062a\",\"cannot_delete_this_record_as\":\"\\u062d\\u0630\\u0641 \\u0646\\u06c1\\u06cc\\u06ba \\u06a9\\u0631 \\u0633\\u06a9\\u062a\\u06d2 \\u0627\\u0633 \\u0631\\u06cc\\u06a9\\u0627\\u0631\\u0688 \\u06a9\\u06d2 \\u0637\\u0648\\u0631 \\u067e\\u0631\",\"site_title\":\"\\u0648\\u06cc\\u0628 \\u0633\\u0627\\u0626\\u0679 \\u06a9\\u0627 \\u0639\\u0646\\u0648\\u0627\\u0646\",\"latest_users\":\"\\u062a\\u0627\\u0632\\u06c1 \\u062a\\u0631\\u06cc\\u0646 \\u0635\\u0627\\u0631\\u0641\\u06cc\\u0646\",\"was_joined_as\":\"\\u062c\\u06cc\\u0633\\u0627 \\u06a9\\u06c1 \\u0634\\u0627\\u0645\\u0644 \\u06a9\\u06cc\\u0627 \\u06af\\u06cc\\u0627 \\u062a\\u06be\\u0627\",\"see_more\":\"\\u062f\\u06cc\\u06a9\\u06be\\u06cc\\u06ba \\u0645\\u0632\\u06cc\\u062f\",\"my_profile\":\"\\u0645\\u06cc\\u0631\\u06cc \\u067e\\u0631\\u0648\\u0641\\u0627\\u0626\\u0644\",\"change_password\":\"\\u067e\\u0627\\u0633 \\u0648\\u0631\\u0688 \\u062a\\u0628\\u062f\\u06cc\\u0644 \\u06a9\\u0631\\u06cc\\u06ba\",\"logout\":\"\\u0644\\u0627\\u06af \\u0622\\u0648\\u0679\",\"dashboard\":\"\\u0688\\u06cc\\u0634 \\u0628\\u0648\\u0631\\u0688\",\"users\":\"\\u0635\\u0627\\u0631\\u0641\\u06cc\\u0646\",\"roles\":\"\\u06a9\\u0631\\u062f\\u0627\\u0631\",\"fee_settings\":\"\\u0641\\u06cc\\u0633 \\u062a\\u0631\\u062a\\u06cc\\u0628\\u0627\\u062a\",\"fee_categories\":\"\\u0641\\u06cc\\u0633 \\u062c\\u0627\\u062a\",\"fee_category_allotment\":\"\\u0641\\u06cc\\u0633 \\u0632\\u0645\\u0631\\u06c1 \\u062a\\u06cc\\u0646 \\u06c1\\u0644\\u0627\\u06a9\",\"fee_particulars\":\"\\u0641\\u06cc\\u0633 \\u062a\\u0641\\u0635\\u06cc\\u0644\\u0627\\u062a\",\"fee_schedules\":\"\\u0641\\u06cc\\u0633 \\u0634\\u06cc\\u0688\\u0648\\u0644\",\"fines\":\"\\u062c\\u0631\\u0645\\u0627\\u0646\\u06c1\",\"discounts\":\"\\u0688\\u0633\\u06a9\\u0627\\u0624\\u0646\\u0679\\u0633\",\"master_settings\":\"\\u0645\\u0627\\u0633\\u0679\\u0631 \\u062a\\u0631\\u062a\\u06cc\\u0628\\u0627\\u062a\",\"religions_master\":\"\\u0645\\u0630\\u0627\\u06c1\\u0628 \\u0645\\u0627\\u0633\\u0679\\u0631\",\"academics_master\":\"\\u0645\\u0627\\u06c1\\u0631\\u06cc\\u0646 \\u062a\\u0639\\u0644\\u06cc\\u0645 \\u0645\\u0627\\u0633\\u0679\\u0631\",\"courses_master\":\"\\u06a9\\u0648\\u0631\\u0633\\u0632 \\u0645\\u0627\\u0633\\u0679\\u0631\",\"subjects_master\":\"\\u0645\\u0636\\u0627\\u0645\\u06cc\\u0646 \\u0645\\u06cc\\u06ba \\u0645\\u0627\\u0633\\u0679\\u0631\",\"subject_topics\":\"\\u0645\\u0648\\u0636\\u0648\\u0639 \\u06a9\\u06d2 \\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a\",\"course_subjects\":\"\\u06a9\\u0648\\u0631\\u0633 \\u0645\\u0636\\u0627\\u0645\\u06cc\\u0646\",\"email_templates\":\"\\u0627\\u06cc \\u0645\\u06cc\\u0644 \\u0633\\u0627\\u0646\\u0686\\u06d2\",\"exams\":\"\\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\\u0627\\u062a\",\"categories\":\"\\u0627\\u0642\\u0633\\u0627\\u0645\",\"question_bank\":\"\\u0633\\u0648\\u0627\\u0644 \\u0628\\u06cc\\u0646\\u06a9\",\"quiz\":\"\\u06a9\\u0648\\u0626\\u0632\",\"lms\":\"LMS\",\"content\":\"\\u0645\\u0648\\u0627\\u062f\",\"study_materials\":\"\\u0645\\u0637\\u0627\\u0644\\u0639\\u06c1 \\u0645\\u0648\\u0627\\u062f\",\"library\":\"\\u0644\\u0627\\u0626\\u0628\\u0631\\u06cc\\u0631\\u06cc\",\"asset_types\":\"\\u0627\\u062b\\u0627\\u062b\\u06c1 \\u06a9\\u06cc \\u0627\\u0642\\u0633\\u0627 \\u0645\",\"master_data\":\"\\u0645\\u0627\\u0633\\u0679\\u0631 \\u0688\\u06cc\\u0679\\u0627\",\"publishers\":\"\\u0646\\u0627\\u0634\\u0631\\u06cc\\u0646\",\"authors\":\"\\u0645\\u0635\\u0646\\u0641\\u06cc\\u0646\",\"students\":\"\\u0637\\u0644\\u0628\\u0627\\u0621\",\"staff\":\"\\u0627\\u0633\\u0679\\u0627\\u0641\",\"school_hub\":\"\\u0633\\u06a9\\u0648\\u0644 \\u062d\\u0628\",\"attendance\":\"\\u062d\\u0627\\u0636\\u0631\\u06cc\",\"edit\":\"\\u062a\\u0635\\u06cc\\u062d\",\"delete\":\"\\u062d\\u0630\\u0641 \\u06a9\\u0631\\u06cc\\u06ba\",\"enable\":\"\\u0641\\u0639\\u0627\\u0644\",\"set_default\":\"\\u067e\\u06c1\\u0644\\u06d2 \\u0633\\u06d2 \\u0637\\u06d2 \\u0634\\u062f\\u06c1\",\"disable\":\"\\u063a\\u06cc\\u0631 \\u0641\\u0639\\u0627\\u0644 \\u06a9\\u0631\\u06cc\\u06ba\",\"user_statistics\":\"\\u06cc\\u0648\\u0632\\u0631 \\u06a9\\u06d2 \\u0627\\u0639\\u062f\\u0627\\u062f\\u0648\\u0634\\u0645\\u0627\\u0631\",\"view_all\":\"\\u0633\\u0628 \\u062f\\u06cc\\u06a9\\u06be\\u06cc\\u06ba\",\"quiz_categories\":\"\\u06a9\\u0648\\u0626\\u0632 \\u062c\\u0627\\u062a\",\"quizzes\":\"QUIZZES\",\"subjects\":\"\\u0645\\u0636\\u0627\\u0645\\u06cc\\u0646\",\"topics\":\"\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a\",\"questions\":\"\\u0633\\u0648\\u0627\\u0644\\u0627\\u062a\"}', '2016-08-23 04:38:33', '2017-01-02 07:55:22');
INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `phrases`, `created_at`, `updated_at`) VALUES
(9, 'English', 'english-1', 'en', 0, 1, '{\"games played or extra-curricular activities\":\"Games Played Or Extra-curricular Activities\",\"general conduct\":\"General Conduct\",\"date of application for certificate\":\"Date Of Application For Certificate\",\"date of issue certificate\":\"Date Of Issue Certificate\",\"reason for leaving the school\":\"Reason For Leaving The School\",\"any other remarks\":\"Any Other Remarks\",\"print\":\"Print\",\"date\":\"Date\",\"serial_no:\":\"Serial No:\",\"admission_no:\":\"Admission No:\",\"name of the pupil\":\"Name Of The Pupil\",\"fathers\\/guardians name\":\"Fathers\\/guardians Name\",\"mothers name\":\"Mothers Name\",\"nationality\":\"Nationality\",\"candidate belongs to schedule caste or schedule tribe\":\"Candidate Belongs To Schedule Caste Or Schedule Tribe\",\"date of first admission in the school with class\":\"Date Of First Admission In The School With Class\",\"date of birth according to the admission register\":\"Date Of Birth According To The Admission Register\",\"class in which the last studied with name\":\"Class In Which The Last Studied With Name\",\"school\\/board annual examination last taken and result\":\"School\\/board Annual Examination Last Taken And Result\",\"whether failed, if once\\/twice in the same class\":\"Whether Failed, If Once\\/twice In The Same Class\",\"whether qualified for promotion to higer class if so,to which class\":\"Whether Qualified For Promotion To Higer Class If So,to Which Class\",\"total number no.of working days\":\"Total Number No.of Working Days\",\"total number no.of days present\":\"Total Number No.of Days Present\",\"whether n_c_c cadet\\/boy scout\\/ girls guide\":\"Whether N C C Cadet\\/boy Scout\\/ Girls Guide\",\"whether ncc cadet\\/boy scout\\/ girls guide\":\"Whether Ncc Cadet\\/boy Scout\\/ Girls Guide\",\"whether ncc cadet\\/ boy scout\\/ girls guide\":\"Whether Ncc Cadet\\/ Boy Scout\\/ Girls Guide\",\"whether n_c_c cadet\\/ boy scout\\/ girls guide\":\"Whether N C C Cadet\\/ Boy Scout\\/ Girls Guide\",\"whether n.cc cadet\\/ boy scout\\/ girls guide\":\"Whether N.cc Cadet\\/ Boy Scout\\/ Girls Guide\",\"bonafide_certificate\":\"Bonafide Certificate\",\"select\":\"Select\",\"academic_operations\":\"Academic Operations\",\"certificates_dashboard\":\"Certificates Dashboard\",\"select_details\":\"Select Details\",\"certificate_type\":\"Certificate Type\",\"search\":\"Search\",\"image\":\"Image\",\"name\":\"Name\",\"roll_no\":\"Roll No\",\"admission_no\":\"Admission No\",\"class\":\"Class\",\"year\":\"Year\",\"semester\":\"Semester\",\"are_you_sure\":\"Are You Sure\",\"yes\":\"Yes\",\"delete_it\":\"Delete It\",\"no\":\"No\",\"cancel_please\":\"Cancel Please\",\"cancelled\":\"Cancelled\",\"your_record_is_safe\":\"Your Record Is Safe\",\"search_student\":\"Search Student\",\"latest_users\":\"Latest Users\",\"was_joined_as\":\"Was Joined As\",\"see_more\":\"See More\",\"my_profile\":\"My Profile\",\"change_password\":\"Change Password\",\"feedback\":\"Feedback\",\"notifications\":\"Notifications\",\"messages\":\"Messages\",\"languages\":\"Languages\",\"logout\":\"Logout\",\"dashboard\":\"Dashboard\",\"users\":\"Users\",\"attendance\":\"Attendance\",\"certificates\":\"Certificates\",\"transfers\":\"Transfers\",\"timetable\":\"Timetable\",\"offline_exams_\":\"Offline Exams \",\"class_attendance_report\":\"Class Attendance Report\",\"class_marks_report\":\"Class Marks Report\",\"exams\":\"Exams\",\"categories\":\"Categories\",\"question_bank\":\"Question Bank\",\"quiz\":\"Quiz\",\"exam_series\":\"Exam Series\",\"instructions\":\"Instructions\",\"coupons\":\"Coupons\",\"list\":\"List\",\"add\":\"Add\",\"contents\":\"Contents\",\"series\":\"Series\",\"master_settings\":\"Master Settings\",\"settings\":\"Settings\",\"religions_master\":\"Religions Master\",\"categories_master\":\"Categories Master\",\"academics_master\":\"Academics Master\",\"courses_master\":\"Courses Master\",\"course_subjects\":\"Course Subjects\",\"certificate_templates\":\"Certificate Templates\",\"email_templates\":\"Email Templates\",\"payment_reports\":\"Payment Reports\",\"online_payments\":\"Online Payments\",\"offline_payments\":\"Offline Payments\",\"export\":\"Export\",\"certificate_issues_histroy\":\"Certificate Issues Histroy\",\"select_user_to_view_details\":\"Select User To View Details\",\"purpose\":\"Purpose\",\"please_wait\":\"Please Wait\",\"invalid_setting\":\"Invalid Setting\",\"id_cards\":\"Id Cards\",\"lets_start\":\"Lets Start\",\"bonafide_certificates\":\"Bonafide Certificates\",\"user_statistics\":\"User Statistics\",\"success\":\"Success\",\"pending\":\"Pending\",\"total\":\"Total\",\"overall_statistics\":\"Overall Statistics\",\"payments_reports_in\":\"Payments Reports In\",\"demanding_quizzes\":\"Demanding Quizzes\",\"demanding\":\"Demanding\",\"quizzes\":\"Quizzes\",\"view_all\":\"View All\",\"academics\":\"Academics\",\"library\":\"Library\",\"courses\":\"Courses\",\"quizzes_usage\":\"Quizzes Usage\",\"paid_quizzes_usage\":\"Paid Quizzes Usage\",\"academic_operations_dashboard\":\"Academic Operations Dashboard\",\"offline_exams\":\"Offline Exams\",\"orientation\":\"Orientation\",\"update\":\"Update\",\"create\":\"Create\",\"key\":\"Key\",\"setting_key\":\"Setting Key\",\"tool_tip\":\"Tool Tip\",\"type\":\"Type\",\"total_options\":\"Total Options\",\"description\":\"Description\",\"option_value\":\"Option Value\",\"option_text\":\"Option Text\",\"make_default\":\"Make Default\",\"record_updated_successfully\":\"Record Updated Successfully\",\"zoomfactor\":\"Zoomfactor\",\"margin\":\"Margin\",\"format\":\"Format\",\"printable_file\":\"Printable File\",\"id_card_generation\":\"Id Card Generation\",\"print_header\":\"Print Header\",\"print_footer\":\"Print Footer\",\"print_date\":\"Print Date\",\"print_reference_number\":\"Print Reference Number\",\"module\":\"Module\",\"action\":\"Action\",\"edit\":\"Edit\",\"view\":\"View\",\"logo\":\"Logo\",\"content\":\"Content\",\"left_sign_image\":\"Left Sign Image\",\"right_sign_image\":\"Right Sign Image\",\"left_sign_name\":\"Left Sign Name\",\"right_sign_name\":\"Right Sign Name\",\"left_sign_designation\":\"Left Sign Designation\",\"right_sign_designation\":\"Right Sign Designation\",\"watermark_image\":\"Watermark Image\",\"bottom_middle_logo\":\"Bottom Middle Logo\",\"add_setting\":\"Add Setting\",\"title\":\"Title\",\"introduction\":\"Introduction\",\"description_of_the_topic\":\"Description Of The Topic\",\"record_added_successfully\":\"Record Added Successfully\",\"no_settings_available\":\"No Settings Available\",\"right_designation\":\"Right Designation\",\"exams_dashboard\":\"Exams Dashboard\",\"exam-series\":\"Exam-series\",\"quiz_categories\":\"Quiz Categories\",\"category\":\"Category\",\"you_will_not_be_able_to_recover_this_record\":\"You Will Not Be Able To Recover This Record\",\"deleted\":\"Deleted\",\"sorry\":\"Sorry\",\"cannot_delete_this_record_as\":\"Cannot Delete This Record As\",\"your_record_has_been_deleted\":\"Your Record Has Been Deleted\",\"delete\":\"Delete\",\"create_series\":\"Create Series\",\"duration\":\"Duration\",\"is_paid\":\"Is Paid\",\"total_marks\":\"Total Marks\",\"update_questions\":\"Update Questions\",\"free\":\"Free\",\"paid\":\"Paid\",\"create_quiz\":\"Create Quiz\",\"quiz_title\":\"Quiz Title\",\"this_field_is_required\":\"This Field Is Required\",\"the_text_is_too_short\":\"The Text Is Too Short\",\"the_text_is_too_long\":\"The Text Is Too Long\",\"subject\":\"Subject\",\"select_subject\":\"Select Subject\",\"online\":\"Online\",\"offline\":\"Offline\",\"quiz_type\":\"Quiz Type\",\"select_type\":\"Select Type\",\"offline_category\":\"Offline Category\",\"enter_value_in_minutes\":\"Enter Value In Minutes\",\"please_enter_valid_number\":\"Please Enter Valid Number\",\"it will be updated by adding the questions\":\"It Will Be Updated By Adding The Questions\",\"pass_percentage\":\"Pass Percentage\",\"negative_mark\":\"Negative Mark\",\"instructions_page\":\"Instructions Page\",\"start_date\":\"Start Date\",\"end_date\":\"End Date\",\"validity\":\"Validity\",\"validity_in_days\":\"Validity In Days\",\"cost\":\"Cost\",\"specific_classes\":\"Specific Classes\",\"applicable_to_specific\":\"Applicable To Specific\",\"academic_year\":\"Academic Year\",\"course\":\"Course\",\"already_item_available\":\"Already Item Available\",\"item_removed_successfully\":\"Item Removed Successfully\",\"update_questions_for\":\"Update Questions For\",\"subjects\":\"Subjects\",\"difficulty\":\"Difficulty\",\"easy\":\"Easy\",\"medium\":\"Medium\",\"hard\":\"Hard\",\"question_type\":\"Question Type\",\"single_answer\":\"Single Answer\",\"multi_answer\":\"Multi Answer\",\"fill_in_the_blanks\":\"Fill In The Blanks\",\"match_the_following\":\"Match The Following\",\"paragraph\":\"Paragraph\",\"video\":\"Video\",\"search_term\":\"Search Term\",\"enter_search_term\":\"Enter Search Term\",\"question\":\"Question\",\"marks\":\"Marks\",\"saved_questions\":\"Saved Questions\",\"remove_all\":\"Remove All\",\"edit_quiz\":\"Edit Quiz\",\"right_side_name\":\"Right Side Name\",\"right_side_sign\":\"Right Side Sign\",\"bonafide \\/ tc_certificates\":\"Bonafide \\/ Tc Certificates\",\"bonafide \\/_transfer_certificates\":\"Bonafide \\/ Transfer Certificates\",\"bonafide \\/_transfer_certificate\":\"Bonafide \\/ Transfer Certificate\",\"users_dashboard\":\"Users Dashboard\",\"owners\":\"Owners\",\"admins\":\"Admins\",\"students\":\"Students\",\"staff\":\"Staff\",\"librarians\":\"Librarians\",\"assistant_librarians\":\"Assistant Librarians\",\"parents\":\"Parents\",\"all_users\":\"All Users\",\"create_user\":\"Create User\",\"100\":\"100\",\"update_offline_exams_marks\":\"Update Offline Exams Marks\",\"import_excel\":\"Import Excel\",\"exam\":\"Exam\",\"year and semester\":\"Year And Semester\",\"maximum_marks\":\"Maximum Marks\",\"update_marks\":\"Update Marks\",\"select_offline_exams_details\":\"Select Offline Exams Details\",\"offline_exmas\":\"Offline Exmas\",\"selection_details\":\"Selection Details\",\"branch\":\"Branch\",\"get_details\":\"Get Details\",\"offline_exam_details\":\"Offline Exam Details\",\"marks_for\":\"Marks For\",\"sno\":\"Sno\",\"photo\":\"Photo\",\"marks_obtained\":\"Marks Obtained\",\"exam_status\":\"Exam Status\",\"pass\":\"Pass\",\"fail\":\"Fail\",\"reference_no\":\"Reference No\",\"oops...!\":\"Oops...!\",\"no_students_available\":\"No Students Available\",\"right_side_designation\":\"Right Side Designation\",\"name_of_the_pupil\":\"Name Of The Pupil\",\"edit_settings\":\"Edit Settings\",\"offline_exams_categories\":\"Offline Exams Categories\",\"offline_quiz_categories\":\"Offline Quiz Categories\",\"category_name\":\"Category Name\",\"add_category\":\"Add Category\",\"invalid_input\":\"Invalid Input\",\"edit_category\":\"Edit Category\",\"offline_exmas_quiz_categories\":\"Offline Exmas Quiz Categories\",\"offline_exmas_categories\":\"Offline Exmas Categories\",\"add_user\":\"Add User\",\"staff_id\":\"Staff Id\",\"job_title\":\"Job Title\",\"email\":\"Email\",\"edit_details\":\"Edit Details\",\"teacher\":\"Teacher\",\"staff_profile\":\"Staff Profile\",\"staff_list\":\"Staff List\",\"profile\":\"Profile\",\"general_details\":\"General Details\",\"personal_details\":\"Personal Details\",\"contact_details\":\"Contact Details\",\"date_of_join\":\"Date Of Join\",\"qualification\":\"Qualification\",\"experience (years)\":\"Experience (years)\",\"experience (months)\":\"Experience (months)\",\"experience_information\":\"Experience Information\",\"other_information\":\"Other Information\",\"first_name\":\"First Name\",\"middle_name\":\"Middle Name\",\"last_name\":\"Last Name\",\"date_of_birth\":\"Date Of Birth\",\"gender\":\"Gender\",\"male\":\"Male\",\"female\":\"Female\",\"blood_group\":\"Blood Group\",\"fathers_name\":\"Fathers Name\",\"mothers_name\":\"Mothers Name\",\"mother_tongue\":\"Mother Tongue\",\"address_lane1\":\"Address Lane1\",\"address_lane2\":\"Address Lane2\",\"city\":\"City\",\"state\":\"State\",\"country\":\"Country\",\"zipcode\":\"Zipcode\",\"mobile\":\"Mobile\",\"home_phone\":\"Home Phone\",\"father\\/guardian name\":\"Father\\/guardian Name\",\"father_\\/_guardian name\":\"Father \\/ Guardian Name\",\"father_\\/_guardian_name\":\"Father \\/ Guardian Name\",\"mother name\":\"Mother Name\",\"mother_name\":\"Mother Name\",\"candidate_belongs_to_schedule_caste_or_schedule_tribe\":\"Candidate Belongs To Schedule Caste Or Schedule Tribe\",\"date_of_first_admission_in_the_school_with_class\":\"Date Of First Admission In The School With Class\",\"date_of_birth_according_to_the_admission_register\":\"Date Of Birth According To The Admission Register\",\"class_in_which_the_last_studied_with_name\":\"Class In Which The Last Studied With Name\",\"school_\\/_board_annual_examination_last_taken_and_result\":\"School \\/ Board Annual Examination Last Taken And Result\",\"whether_failed,_if_once_\\/_twice_in_the_same_class\":\"Whether Failed, If Once \\/ Twice In The Same Class\",\"left_side_name\":\"Left Side Name\",\"show_left_side_name\":\"Show Left Side Name\",\"show_left_side_designation\":\"Show Left Side Designation\",\"show_left_side_image\":\"Show Left Side Image\",\"whether_qualified_for_promotion_to_higer_class_if_so,_to_which_class\":\"Whether Qualified For Promotion To Higer Class If So, To Which Class\",\"total_number_no.of_working_days\":\"Total Number No.of Working Days\",\"show_middle_name\":\"Show Middle Name\",\"show_left_side_sign\":\"Show Left Side Sign\",\"total_number_no.of_present_days\":\"Total Number No.of Present Days\",\"show_middle_designation\":\"Show Middle Designation\",\"show_middle_sign\":\"Show Middle Sign\",\"whether_ncc_cadet_\\/_boy_scout\\/_girls_guide\":\"Whether Ncc Cadet \\/ Boy Scout\\/ Girls Guide\",\"show_right_side_name\":\"Show Right Side Name\",\"show_right_side_designation\":\"Show Right Side Designation\",\"games_played_or_extra-_curricular_activities\":\"Games Played Or Extra- Curricular Activities\",\"show_right_side_sign\":\"Show Right Side Sign\",\"general_conduct\":\"General Conduct\",\"date_of_application_for_certificate\":\"Date Of Application For Certificate\",\"date_of_issue_certificate\":\"Date Of Issue Certificate\",\"total_number_no_of_working_days\":\"Total Number No Of Working Days\",\"total_number_no_of_present_days\":\"Total Number No Of Present Days\",\"water_mark_image\":\"Water Mark Image\",\"reason_for_leaving_the_school\":\"Reason For Leaving The School\",\"any_other_remarks\":\"Any Other Remarks\",\"show_watermark\":\"Show Watermark\",\"name_of_student\":\"Name Of Student\",\"father_guardian_name\":\"Father Guardian Name\",\"candidate_caste\":\"Candidate Caste\",\"date_of_admission_with_class\":\"Date Of Admission With Class\",\"last_class_studied\":\"Last Class Studied\",\"last_taken_exam_and_result\":\"Last Taken Exam And Result\",\"whether_failed_if_once_twice_in_the_same_class\":\"Whether Failed If Once Twice In The Same Class\",\"promotion_class\":\"Promotion Class\",\"total_working_days\":\"Total Working Days\",\"total_present_days\":\"Total Present Days\",\"ncc_boy_scout_girls_guide\":\"Ncc Boy Scout Girls Guide\",\"games_played_or_extra_curricular_activities\":\"Games Played Or Extra Curricular Activities\",\"date_of_apply\":\"Date Of Apply\",\"date_of_issue\":\"Date Of Issue\",\"reason\":\"Reason\",\"remarks\":\"Remarks\",\"import_marks\":\"Import Marks\",\"download_template\":\"Download Template\",\"upload\":\"Upload\",\"information_helper_for_excel_data\":\"Information Helper For Excel Data\",\"file_type_not_allowed\":\"File Type Not Allowed\",\"marks_report\":\"Marks Report\",\"total_class\":\"Total Class\",\"present\":\"Present\",\"absent\":\"Absent\",\"leave\":\"Leave\",\"no_data_available\":\"No Data Available\",\"student\":\"Student\",\"year-semester\":\"Year-semester\",\"admission_details\":\"Admission Details\",\"correct\":\"Correct\",\"wrong\":\"Wrong\",\"not_answered\":\"Not Answered\",\"overall_performance\":\"Overall Performance\",\"performance\":\"Performance\",\"best_performance_in_all_quizzes\":\"Best Performance In All Quizzes\",\"details\":\"Details\",\"student_users\":\"Student Users\",\"details_of\":\"Details Of\",\"reports\":\"Reports\",\"exam_history\":\"Exam History\",\"view_details\":\"View Details\",\"by_exam\":\"By Exam\",\"by_subject\":\"By Subject\",\"subscriptions\":\"Subscriptions\",\"certificate_settings\":\"Certificate Settings\",\"bonafide_certificates_contents\":\"Bonafide Certificates Contents\",\"bonafide_certificates_fields\":\"Bonafide Certificates Fields\",\"transfer_certificates_contents\":\"Transfer Certificates Contents\",\"transfer_certificates_fields\":\"Transfer Certificates Fields\",\"id_cards_contents\":\"Id Cards Contents\",\"id_cards_fields\":\"Id Cards Fields\",\"transfer_certificates_content\":\"Transfer Certificates Content\",\"transfer_certificates_cont\":\"Transfer Certificates Cont\",\"transfer_certificates_conten\":\"Transfer Certificates Conten\",\"bonafide_certificates_conten\":\"Bonafide Certificates Conten\",\"bonafide_certificate_content\":\"Bonafide Certificate Content\",\"transfer_certificate_content\":\"Transfer Certificate Content\",\"bonafide_certificatet_fields\":\"Bonafide Certificatet Fields\",\"bonafide_certificatet_con\":\"Bonafide Certificatet Con\",\"bonafide_certificatet_cont\":\"Bonafide Certificatet Cont\",\"bonafide_certificatet_conten\":\"Bonafide Certificatet Conten\",\"bonafide_certificate_conten\":\"Bonafide Certificate Conten\",\"bonafide_certificate_fields\":\"Bonafide Certificate Fields\",\"transfer_certificate_fields\":\"Transfer Certificate Fields\",\"id_card_contents\":\"Id Card Contents\",\"id_card_fields\":\"Id Card Fields\",\"question_subjects\":\"Question Subjects\",\"import_questions\":\"Import Questions\",\"add_subject\":\"Add Subject\",\"code\":\"Code\",\"view_questions\":\"View Questions\",\"bonafide_certificate_settings\":\"Bonafide Certificate Settings\",\"transfer_certificate_settings\":\"Transfer Certificate Settings\",\"total_exams\":\"Total Exams\",\"total_questions\":\"Total Questions\",\"update_quizzes\":\"Update Quizzes\",\"bonafide_certificate_seting\":\"Bonafide Certificate Seting\",\"bonafide__contents\":\"Bonafide  Contents\",\"bonafide_settings\":\"Bonafide Settings\",\"mastersettings_dashboard\":\"Mastersettings Dashboard\",\"religions\":\"Religions\",\"start_time\":\"Start Time\",\"end_time\":\"End Time\",\"default_sessions_needed\":\"Default Sessions Needed\",\"iamge\":\"Iamge\",\"student_profile\":\"Student Profile\",\"students_list\":\"Students List\",\"parent_login\":\"Parent Login\",\"info\":\"Info\",\"once_saved_the_admission_details_cannot_be_edited\\n\":\"Once Saved The Admission Details Cannot Be Edited\\n\",\"present_academic_details\":\"Present Academic Details\",\"current_academic_year\":\"Current Academic Year\",\"current_branch\":\"Current Branch\",\"current_course\":\"Current Course\",\"previous_educational_details\":\"Previous Educational Details\",\"highest_qualification\":\"Highest Qualification\",\"percentage\":\"Percentage\",\"year_passed\":\"Year Passed\",\"previous_institute_name\":\"Previous Institute Name\",\"institute_address\":\"Institute Address\",\"religion\":\"Religion\",\"guardian_name\":\"Guardian Name\",\"guardian_phone\":\"Guardian Phone\",\"relationship_with_guardian\":\"Relationship With Guardian\",\"guardian_email\":\"Guardian Email\",\"parent_login_details\":\"Parent Login Details\",\"parent_name\":\"Parent Name\",\"parent_user_name\":\"Parent User Name\",\"parent_email\":\"Parent Email\",\"password\":\"Password\",\"staff_users\":\"Staff Users\",\"lesson_plans\":\"Lesson Plans\",\"subject_preferences\":\"Subject Preferences\",\"student_attendance\":\"Student Attendance\",\"payment_statistics\":\"Payment Statistics\",\"payment_monthly_statistics\":\"Payment Monthly Statistics\",\"particulars\":\"Particulars\",\"general_instructions\":\"General Instructions\",\"attendance_date\":\"Attendance Date\",\"from\":\"From\",\"to\":\"To\",\"lesson_plans_for\":\"Lesson Plans For\",\"no_topics_available\":\"No Topics Available\",\"transfer_details\":\"Transfer Details\",\"edit_user\":\"Edit User\",\"username\":\"Username\",\"please_enter_valid_email\":\"Please Enter Valid Email\",\"role\":\"Role\",\"select_role\":\"Select Role\",\"phone\":\"Phone\",\"please_enter_10-15_digit_mobile_number\":\"Please Enter 10-15 Digit Mobile Number\",\"please_enter_valid_phone_number\":\"Please Enter Valid Phone Number\",\"billing_address\":\"Billing Address\",\"please_enter_your_address\":\"Please Enter Your Address\",\"exam_analysis_by_attempts\":\"Exam Analysis By Attempts\",\"attempts\":\"Attempts\",\"of\":\"Of\",\"mins\":\"Mins\",\"exam_attempts_and_score\":\"Exam Attempts And Score\",\"quiz_attempts\":\"Quiz Attempts\",\"result\":\"Result\",\"view_answers\":\"View Answers\",\"generate_certificate\":\"Generate Certificate\",\"answers\":\"Answers\",\"analysis\":\"Analysis\",\"time_limit\":\"Time Limit\",\"time_taken\":\"Time Taken\",\"previous\":\"Previous\",\"next\":\"Next\",\"timetable_for\":\"Timetable For\",\"sun\":\"Sun\",\"mon\":\"Mon\",\"tue\":\"Tue\",\"wed\":\"Wed\",\"thu\":\"Thu\",\"fri\":\"Fri\",\"sat\":\"Sat\",\"timetable_for_\":\"Timetable For \",\"leisure\":\"Leisure\",\"lab\":\"Lab\",\"completed_topics_list\":\"Completed Topics List\",\"no_list_available\":\"No List Available\",\"select_other_class\":\"Select Other Class\",\"please select the details\":\"Please Select The Details\",\"preferred_subjects\":\"Preferred Subjects\",\"elective\":\"Elective\",\"summary\":\"Summary\",\"labs\":\"Labs\",\"electives\":\"Electives\",\"subjects_list\":\"Subjects List\",\"success...!\":\"Success...!\",\"records_updated_successfully\":\"Records Updated Successfully\",\"students_dashboard\":\"Students Dashboard\",\"view_students\":\"View Students\",\"overall_subject_wise_analysis\":\"Overall Subject Wise Analysis\",\"marks_details\":\"Marks Details\",\"no_data_available_with_the_selection\":\"No Data Available With The Selection\",\"leasure\":\"Leasure\",\"break\":\"Break\",\"printed_on: \":\"Printed On: \",\"attendance_details\":\"Attendance Details\",\"view_summary\":\"View Summary\",\"attendance_summary\":\"Attendance Summary\",\"total_classes\":\"Total Classes\",\"its_okay\":\"Its Okay\",\"topics_completed\":\"Topics Completed\",\"transfer_list\":\"Transfer List\",\"semister\":\"Semister\",\"current_year\":\"Current Year\",\"current_semister\":\"Current Semister\",\"admin\":\"Admin\",\"ooops..\":\"Ooops..\",\"please_select_any_users\":\"Please Select Any Users\",\"emergency_no\":\"Emergency No\",\"no_users_available\":\"No Users Available\",\"from(admission_year-course-year-semester)\":\"From(admission Year-course-year-semester)\",\"from (_admission_year-course-year-semester)\":\"From ( Admission Year-course-year-semester)\",\"from (_admission_year-_course-_year-_semester)\":\"From ( Admission Year- Course- Year- Semester)\",\"to (_admission_year-_course-_year-_semester)\":\"To ( Admission Year- Course- Year- Semester)\",\"transfers_list\":\"Transfers List\",\"from <i>(_admission_year-_course-_year-_semester)<\\/i> \":\"From <i>( Admission Year- Course- Year- Semester)<\\/i> \",\"from (_admission_year-_course)\":\"From ( Admission Year- Course)\",\"to (_admission_year-_course)\":\"To ( Admission Year- Course)\",\"from (_admission_year)\":\"From ( Admission Year)\",\"to (_admission_year)\":\"To ( Admission Year)\",\"modules_helper\":\"Modules Helper\",\"help_link_text\":\"Help Link Text\",\"status\":\"Status\",\"add_helper\":\"Add Helper\",\"help_me\":\"Help Me\",\"is_enabled\":\"Is Enabled\",\"keyboard\":\"Keyboard\",\"backdrop\":\"Backdrop\",\"steps\":\"Steps\",\"element_id\":\"Element Id\",\"placement\":\"Placement\",\"sort_order\":\"Sort Order\",\"add_to_list\":\"Add To List\",\"element\":\"Element\",\"student_promotions\":\"Student Promotions\",\"cancel\":\"Cancel\",\"confirm\":\"Confirm\",\"is_completed\":\"Is Completed\",\"transfer_to_course\":\"Transfer To Course\",\"transfer_to_year\":\"Transfer To Year\",\"transfer_to_semister\":\"Transfer To Semister\",\"promoted\":\"Promoted\",\"detained\":\"Detained\",\"course_completed\":\"Course Completed\",\"transfer\":\"Transfer\",\"create_category\":\"Create Category\",\"enter_category_name\":\"Enter Category Name\",\"record_added_successfully_with_password \":\"Record Added Successfully With Password \",\"\\\\ncannot_send_email_to_user, please_check_your_server_settings\":\"\\\\ncannot Send Email To User, Please Check Your Server Settings\",\"timings_set\":\"Timings Set\",\"create_timetable\":\"Create Timetable\",\"timing_sets\":\"Timing Sets\",\"timetable_dashboard\":\"Timetable Dashboard\",\"prepare_timetable\":\"Prepare Timetable\",\"day\":\"Day\",\"remove\":\"Remove\",\"print_timetable\":\"Print Timetable\",\"enter_notes\":\"Enter Notes\",\"this_will_be_displayed_bottom_of_the_timetable\":\"This Will Be Displayed Bottom Of The Timetable\",\"schedule_table\":\"Schedule Table\",\"attendance_report\":\"Attendance Report\",\"subjects_reports\":\"Subjects Reports\",\"view_analysis\":\"View Analysis\",\"view_report\":\"View Report\",\"my_bookmarks\":\"My Bookmarks\",\"scheduled_exams\":\"Scheduled Exams\",\"by_subjcet\":\"By Subjcet\",\"history\":\"History\",\"lms\":\"Lms\",\"quizzes_dashboard\":\"Quizzes Dashboard\",\"student_list\":\"Student List\",\"payments\":\"Payments\",\"viewww\":\"Viewww\",\"all_exams\":\"All Exams\",\"dueration\":\"Dueration\",\"take_exam\":\"Take Exam\",\"select_template\":\"Select Template\",\"please_read_the_instructions_carefully\":\"Please Read The Instructions Carefully\",\"exam_name\":\"Exam Name\",\"please_accept_terms_and_conditions\":\"Please Accept Terms And Conditions\",\"start_exam\":\"Start Exam\",\"enable_back_side\":\"Enable Back Side\",\"days\":\"Days\",\"top_logo\":\"Top Logo\",\"account_settings\":\"Account Settings\",\"quiz_and_exam_series\":\"Quiz And Exam Series\",\"lms_categories\":\"Lms Categories\",\"academic_years\":\"Academic Years\",\"courses_dashboard\":\"Courses Dashboard\",\"allocate_courses\":\"Allocate Courses\",\"academic_courses\":\"Academic Courses\",\"course_list\":\"Course List\",\"record_deleted_successfully\":\"Record Deleted Successfully\",\"page_not_found\":\"Page Not Found\",\"ooops...!\":\"Ooops...!\",\"page not found\":\"Page Not Found\",\"ooops..!\":\"Ooops..!\",\"you_have_no_permission_to_access\":\"You Have No Permission To Access\",\"no topics available\":\"No Topics Available\",\"no_topics availble\":\"No Topics Availble\",\"topics\":\"Topics\",\"import_topics\":\"Import Topics\",\"add_course\":\"Add Course\",\"subject_master\":\"Subject Master\",\"subject_topics\":\"Subject Topics\",\"allocate_subject_to_course\":\"Allocate Subject To Course\",\"allocate_staff_to_course\":\"Allocate Staff To Course\",\"topics_list\":\"Topics List\",\"import\":\"Import\",\"parent\":\"Parent\",\"topic (id)\":\"Topic (id)\",\"front_first_item\":\"Front First Item\",\"allocate_staff_to_subject\":\"Allocate Staff To Subject\",\"allocate_staff_to_courses\":\"Allocate Staff To Courses\",\"add_or_edit_course_subjects\":\"Add Or Edit Course Subjects\",\"allocate_staff\":\"Allocate Staff\",\"subject_title\":\"Subject Title\",\"subject_code\":\"Subject Code\",\"pass_marks\":\"Pass Marks\",\"is_lab\":\"Is Lab\",\"is_elective\":\"Is Elective\",\"view_topics\":\"View Topics\",\"import_users\":\"Import Users\",\"front_second_item\":\"Front Second Item\",\"front_third_item\":\"Front Third Item\",\"front_fourth_item\":\"Front Fourth Item\",\"front_fifth_item\":\"Front Fifth Item\",\"front_sixth_item\":\"Front Sixth Item\",\"front_seventh_item\":\"Front Seventh Item\",\"front_total_fields\":\"Front Total Fields\",\"back_first_item_title\":\"Back First Item Title\",\"front_first_item_title\":\"Front First Item Title\",\"front_second_item_title\":\"Front Second Item Title\",\"front_third_item_title\":\"Front Third Item Title\",\"front_fourth_item_title\":\"Front Fourth Item Title\",\"front_fifth_item_title\":\"Front Fifth Item Title\",\"front_sixth_item_title\":\"Front Sixth Item Title\",\"front_seventh_item_title\":\"Front Seventh Item Title\",\"coupon_codes\":\"Coupon Codes\",\"discount\":\"Discount\",\"minimum_bill\":\"Minimum Bill\",\"maximum_discount\":\"Maximum Discount\",\"limit\":\"Limit\",\"back_first_item_text\":\"Back First Item Text\",\"back_second_item_title\":\"Back Second Item Title\",\"back_second_item_text\":\"Back Second Item Text\",\"time_spent_on_correct_answers\":\"Time Spent On Correct Answers\",\"time_spent_on_wrong_answers\":\"Time Spent On Wrong Answers\",\"overall_marks_analysis\":\"Overall Marks Analysis\",\"time\":\"Time\",\"spent_on_correct\":\"Spent On Correct\",\"spent_on_wrong\":\"Spent On Wrong\",\"spent_time\":\"Spent Time\",\"total_time\":\"Total Time\",\"time_is_shown_in_seconds\":\"Time Is Shown In Seconds\",\"back_third_item_title\":\"Back Third Item Title\",\"back_third_item_text\":\"Back Third Item Text\",\"back_fourth_item_title\":\"Back Fourth Item Title\",\"back_fourth_item_text\":\"Back Fourth Item Text\",\"clear_answer\":\"Clear Answer\",\"bookmarks\":\"Bookmarks\",\"exam_duration\":\"Exam Duration\",\"hints\":\"Hints\",\"unbookmark_this_question\":\"Unbookmark This Question\",\"bookmark_this_question\":\"Bookmark This Question\",\"mark_for_review\":\"Mark For Review\",\"finish\":\"Finish\",\"warning\":\"Warning\",\"do_not_press_back\\/refresh_button\":\"Do Not Press Back\\/refresh Button\",\"answered\":\"Answered\",\"marked\":\"Marked\",\"not_visited\":\"Not Visited\",\"consumed_time\":\"Consumed Time\",\"result_for\":\"Result For\",\"score\":\"Score\",\"view_key\":\"View Key\",\"allocate_subjects\":\"Allocate Subjects\",\"no_staff_alotted\":\"No Staff Alotted\",\"no_subjects_selected\":\"No Subjects Selected\",\"id\":\"Id\",\"course list\":\"Course List\",\"course_name\":\"Course Name\",\"grade_type\":\"Grade Type\",\"edit_semisters\":\"Edit Semisters\",\"years\":\"Years\",\"add_religion\":\"Add Religion\",\"owner\":\"Owner\",\" content\":\" Content\",\" dashboard\":\" Dashboard\",\" series\":\" Series\",\"total_items\":\"Total Items\",\"update_lms\":\"Update Lms\",\"examseries\":\"Examseries\",\"create_coupon\":\"Create Coupon\",\"coupon_code\":\"Coupon Code\",\"value\":\"Value\",\"percent\":\"Percent\",\"discount_type\":\"Discount Type\",\"discount_value\":\"Discount Value\",\"enter_value\":\"Enter Value\",\"enter_minimum_bill\":\"Enter Minimum Bill\",\"discount_maximum_amount\":\"Discount Maximum Amount\",\"enter_maximum_amount\":\"Enter Maximum Amount\",\"valid_from\":\"Valid From\",\"valid_to\":\"Valid To\",\"usage_limit\":\"Usage Limit\",\"enter_usage_limit_per_user\":\"Enter Usage Limit Per User\",\"from_email\":\"From Email\",\"from_name\":\"From Name\",\"export_payments_report\":\"Export Payments Report\",\"export_payment_records\":\"Export Payment Records\",\"download_excel\":\"Download Excel\",\"all_records\":\"All Records\",\"from_date\":\"From Date\",\"to_date\":\"To Date\",\"payment_type\":\"Payment Type\",\"all\":\"All\",\"payment_status\":\"Payment Status\",\"select_parent\":\"Select Parent\",\"course_title\":\"Course Title\",\"course_code\":\"Course Code\",\"duration_in_years\":\"Duration In Years\",\"grade_system\":\"Grade System\",\"is_having_semisters\":\"Is Having Semisters\",\"is_having_electives\":\"Is Having Electives\",\"add_subjects_to_course\":\"Add Subjects To Course\",\"courses_list\":\"Courses List\",\"load\":\"Load\",\"add_subject_to_course\":\"Add Subject To Course\",\"number_of_sessions_needed\":\"Number Of Sessions Needed\",\"template_1_logo\":\"Template 1 Logo\",\"institute_title\":\"Institute Title\",\"create_set\":\"Create Set\",\"academic_operatons\":\"Academic Operatons\",\"period_name\":\"Period Name\",\"enter_period_name\":\"Enter Period Name\",\"start_time_cannot_be_greater_than_or_equal_to_end_time\":\"Start Time Cannot Be Greater Than Or Equal To End Time\",\"start_time_must_be_greater_to_previous_end_time\":\"Start Time Must Be Greater To Previous End Time\",\"time_spent_correct_answers\":\"Time Spent Correct Answers\",\"time_spent_wrong_answers\":\"Time Spent Wrong Answers\",\"subject_wise_analysis\":\"Subject Wise Analysis\",\"in\":\"In\",\"attendance_for\":\"Attendance For\",\"notes\":\"Notes\",\"create_message\":\"Create Message\",\"inbox\":\"Inbox\",\"compose\":\"Compose\",\"send_message\":\"Send Message\",\"questions\":\"Questions\",\"fill_the_blanks\":\"Fill The Blanks\",\"first_admission_in_the_school\":\"First Admission In The School\",\"date_of_first_admission_in_the_school\":\"Date Of First Admission In The School\",\"first_admission_class_in_the_school_with_name\":\"First Admission Class In The School With Name\",\"date of first admission in the school\":\"Date Of First Admission In The School\",\" first admission class in the school with name\":\" First Admission Class In The School With Name\",\"completed\":\"Completed\",\"internal_marks\":\"Internal Marks\",\"external_marks\":\"External Marks\",\"please_enter_valid_internal_marks\":\"Please Enter Valid Internal Marks\",\"please_enter_valid_external_marks\":\"Please Enter Valid External Marks\",\"please_enter_valid_maximum_marks\":\"Please Enter Valid Maximum Marks\",\"please_enter_valid_pass_marks\":\"Please Enter Valid Pass Marks\",\"pass_marks_cannot_be_greater_than_maximum_marks\":\"Pass Marks Cannot Be Greater Than Maximum Marks\",\"add_topic\":\"Add Topic\",\"topic_name\":\"Topic Name\",\"category_deleted_successfully\":\"Category Deleted Successfully\",\"add_academic\":\"Add Academic\",\"academic_title\":\"Academic Title\",\"show_in_list\":\"Show In List\",\"payu\":\"Payu\",\"paypal\":\"Paypal\",\"messaging\":\"Messaging\",\"offline_payment\":\"Offline Payment\",\"push_notifications\":\"Push Notifications\",\"certificate\":\"Certificate\",\"show_foreign_key_constraint\":\"Show Foreign Key Constraint\",\"facebook_login\":\"Facebook Login\",\"google_plus_login\":\"Google Plus Login\",\"old_password\":\"Old Password\",\"the_password_is_too_short\":\"The Password Is Too Short\",\"new_password\":\"New Password\",\"retype_password\":\"Retype Password\",\"password_and_confirm_password_does_not_match\":\"Password And Confirm Password Does Not Match\",\"posted_on\":\"Posted On\",\"send_messageeee\":\"Send Messageeee\",\"please select the recipients\":\"Please Select The Recipients\",\"import_subjects\":\"Import Subjects\",\"children\":\"Children\",\"premium\":\"Premium\",\"subscriptions_list\":\"Subscriptions List\",\"plan_type\":\"Plan Type\",\"paid_from\":\"Paid From\",\"datetime\":\"Datetime\",\"it_includes\":\"It Includes\",\"lms_series\":\"Lms Series\",\"view_more\":\"View More\",\"items\":\"Items\",\"learning_management_series\":\"Learning Management Series\",\"buy_now\":\"Buy Now\",\"checkout\":\"Checkout\",\"item\":\"Item\",\"valid_for\":\"Valid For\",\"enter_coupon_code\":\"Enter Coupon Code\",\"apply\":\"Apply\",\"select_your_child\":\"Select Your Child\",\"click_here_to_update_payment_details\":\"Click Here To Update Payment Details\",\"billing_details\":\"Billing Details\",\"invalid_coupon\":\"Invalid Coupon\",\"hey_you_are_eligible_for_discount\":\"Hey You Are Eligible For Discount\",\"printable_ file\":\"Printable  File\",\"timetable_settings\":\"Timetable Settings\",\"printed_onnn: \":\"Printed Onnn: \",\"timetable__contents\":\"Timetable  Contents\",\"certificates_settings_dashboard\":\"Certificates Settings Dashboard\",\"hai\":\"Hai\",\"students_list_class_vice\":\"Students List Class Vice\",\"library_dashboard\":\"Library Dashboard\",\"book_returns_student\":\"Book Returns Student\",\"book_returns_staff\":\"Book Returns Staff\",\"asset_types\":\"Asset Types\",\"master_data\":\"Master Data\",\"publishers\":\"Publishers\",\"authors\":\"Authors\",\"library_users\":\"Library Users\",\"issue_asset\":\"Issue Asset\",\"maximum_allowed\":\"Maximum Allowed\",\"issued\":\"Issued\",\"eligible\":\"Eligible\",\"transactions\":\"Transactions\",\"books_taken\":\"Books Taken\",\"issue_book\":\"Issue Book\",\"general_info\":\"General Info\",\"contace_details\":\"Contace Details\",\"assets_on_issue\":\"Assets On Issue\",\"issued_on\":\"Issued On\",\"due_date\":\"Due Date\",\"library_issues\":\"Library Issues\",\"asset_details\":\"Asset Details\",\"please_enter_asset_reference_number\":\"Please Enter Asset Reference Number\",\"return_on\":\"Return On\",\"book_returns\":\"Book Returns\",\"academic_details\":\"Academic Details\",\"asset no\":\"Asset No\",\"asset_name\":\"Asset Name\",\"date-_issue\\/_return\":\"Date- Issue\\/ Return\",\"return\":\"Return\",\"department\":\"Department\",\"id_card_settings\":\"Id Card Settings\",\"offline_payment_form\":\"Offline Payment Form\",\"submit\":\"Submit\",\"offline_payment_instructions\":\"Offline Payment Instructions\",\"payment_details\":\"Payment Details\",\"your_request_was_submitted_to_admin\":\"Your Request Was Submitted To Admin\",\"success_list\":\"Success List\",\"user_name\":\"User Name\",\"plan\":\"Plan\",\"payment_gateway\":\"Payment Gateway\",\"updated_at\":\"Updated At\",\"offline_payment_details\":\"Offline Payment Details\",\"coupon_applied\":\"Coupon Applied\",\"after_discount\":\"After Discount\",\"created_at\":\"Created At\",\"comments\":\"Comments\",\"approve\":\"Approve\",\"reject\":\"Reject\",\"close\":\"Close\",\"record_was_updated_successfully\":\"Record Was Updated Successfully\",\"exam_aborted\":\"Exam Aborted\",\"students_completed_list_class_vice\":\"Students Completed List Class Vice\",\"students_completed_list\":\"Students Completed List\",\"course_completed_student_list\":\"Course Completed Student List\",\" categories\":\" Categories\",\"certificate_generation\":\"Certificate Generation\",\"certificate_for\":\"Certificate For\",\"improper_sheet_uploaded\":\"Improper Sheet Uploaded\",\"report\":\"Report\",\"failed\":\"Failed\",\"address\":\"Address\",\"sqlstate[23000]: integrity constraint violation: 1062 duplicate entry \'10b.techche00001\' for key \'roll_no\' (sql: insert into `students` (`admission_no`, `roll_no`, `academic_id`, `course_parent_id`, `course_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `date_of_join`, `gender`, `current_year`, `current_semister`, `user_id`, `updated_at`, `created_at`) values (aca1748, 10b.techche00001, 1, 3, 18, raghu, k, veer, 1984-12-12 00:00:00, 1999-12-12 00:00:00, male, 1, 1, 1748, 2017-01-13 16:12:04, 2017-01-13 16:12:04))\":\"Sqlstate[23000]: Integrity Constraint Violation: 1062 Duplicate Entry \'10b.techche00001\' For Key \'roll No\' (sql: Insert Into `students` (`admission No`, `roll No`, `academic Id`, `course Parent Id`, `course Id`, `first Name`, `middle Name`, `last Name`, `date Of Birth`, `date Of Join`, `gender`, `current Year`, `current Semister`, `user Id`, `updated At`, `created At`) Values (aca1748, 10b.techche00001, 1, 3, 18, Raghu, K, Veer, 1984-12-12 00:00:00, 1999-12-12 00:00:00, Male, 1, 1, 1748, 2017-01-13 16:12:04, 2017-01-13 16:12:04))\",\"sqlstate[23000]: integrity constraint violation: 1062 duplicate entry \'10b.techche00001\' for key \'roll_no\' (sql: insert into `students` (`admission_no`, `roll_no`, `academic_id`, `course_parent_id`, `course_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `date_of_join`, `gender`, `current_year`, `current_semister`, `user_id`, `updated_at`, `created_at`) values (aca1749, 10b.techche00001, 1, 3, 18, raghu, k, veer, 1984-12-12 00:00:00, 1999-12-12 00:00:00, male, 1, 1, 1749, 2017-01-13 16:12:17, 2017-01-13 16:12:17))\":\"Sqlstate[23000]: Integrity Constraint Violation: 1062 Duplicate Entry \'10b.techche00001\' For Key \'roll No\' (sql: Insert Into `students` (`admission No`, `roll No`, `academic Id`, `course Parent Id`, `course Id`, `first Name`, `middle Name`, `last Name`, `date Of Birth`, `date Of Join`, `gender`, `current Year`, `current Semister`, `user Id`, `updated At`, `created At`) Values (aca1749, 10b.techche00001, 1, 3, 18, Raghu, K, Veer, 1984-12-12 00:00:00, 1999-12-12 00:00:00, Male, 1, 1, 1749, 2017-01-13 16:12:17, 2017-01-13 16:12:17))\",\"sqlstate[23000]: integrity constraint violation: 1062 duplicate entry \'10b.techche00001\' for key \'roll_no\' (sql: insert into `students` (`admission_no`, `roll_no`, `academic_id`, `course_parent_id`, `course_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `date_of_join`, `gender`, `current_year`, `current_semister`, `user_id`, `updated_at`, `created_at`) values (aca1750, 10b.techche00001, 1, 3, 18, raghu, k, veer, 1984-12-12 00:00:00, 1999-12-12 00:00:00, male, 1, 1, 1750, 2017-01-13 16:18:38, 2017-01-13 16:18:38))\":\"Sqlstate[23000]: Integrity Constraint Violation: 1062 Duplicate Entry \'10b.techche00001\' For Key \'roll No\' (sql: Insert Into `students` (`admission No`, `roll No`, `academic Id`, `course Parent Id`, `course Id`, `first Name`, `middle Name`, `last Name`, `date Of Birth`, `date Of Join`, `gender`, `current Year`, `current Semister`, `user Id`, `updated At`, `created At`) Values (aca1750, 10b.techche00001, 1, 3, 18, Raghu, K, Veer, 1984-12-12 00:00:00, 1999-12-12 00:00:00, Male, 1, 1, 1750, 2017-01-13 16:18:38, 2017-01-13 16:18:38))\",\"sqlstate[23000]: integrity constraint violation: 1062 duplicate entry \'15b.techche00001\' for key \'roll_no\' (sql: insert into `students` (`admission_no`, `roll_no`, `academic_id`, `course_parent_id`, `course_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `date_of_join`, `gender`, `current_year`, `current_semister`, `user_id`, `updated_at`, `created_at`) values (aca1752, 15b.techche00001, 3, 3, 18, raghu, k, veer, 1984-12-12 00:00:00, 1999-12-12 00:00:00, male, 2, 1, 1752, 2017-01-13 16:26:47, 2017-01-13 16:26:47))\":\"Sqlstate[23000]: Integrity Constraint Violation: 1062 Duplicate Entry \'15b.techche00001\' For Key \'roll No\' (sql: Insert Into `students` (`admission No`, `roll No`, `academic Id`, `course Parent Id`, `course Id`, `first Name`, `middle Name`, `last Name`, `date Of Birth`, `date Of Join`, `gender`, `current Year`, `current Semister`, `user Id`, `updated At`, `created At`) Values (aca1752, 15b.techche00001, 3, 3, 18, Raghu, K, Veer, 1984-12-12 00:00:00, 1999-12-12 00:00:00, Male, 2, 1, 1752, 2017-01-13 16:26:47, 2017-01-13 16:26:47))\",\"please select required the details\":\"Please Select Required The Details\",\"this_record_is_in_use_in_other_modules\":\"This Record Is In Use In Other Modules\",\"date_of_exam\":\"Date Of Exam\",\"topic\":\"Topic\",\"view_all_users\":\"View All Users\",\"available_timesets\":\"Available Timesets\",\"library_masters\":\"Library Masters\",\"author\":\"Author\",\"publisher\":\"Publisher\",\"available\":\"Available\",\"edition\":\"Edition\",\"library_assets\":\"Library Assets\",\"eligible_for_fine\":\"Eligible For Fine\",\"fine_per_day\":\"Fine Per Day\",\"qualification_details\":\"Qualification Details\",\"experience\":\"Experience\",\"months\":\"Months\",\"create_asset\":\"Create Asset\",\"asset_type\":\"Asset Type\",\"is_eligible_for_fine\":\"Is Eligible For Fine\",\"is_having_max_fine_limit\":\"Is Having Max Fine Limit\",\"maximum_fine_amount\":\"Maximum Fine Amount\",\"maximum_issuable\":\"Maximum Issuable\",\"maximum_days_to_return\":\"Maximum Days To Return\",\"maximum_advanced_reservations\":\"Maximum Advanced Reservations\",\"edit_asset\":\"Edit Asset\",\"issuable\":\"Issuable\",\"days_to_return\":\"Days To Return\",\"create_master_asset\":\"Create Master Asset\",\"asset_belongs_to_subject\":\"Asset Belongs To Subject\",\"isbn_number\":\"Isbn Number\",\"actual_price\":\"Actual Price\",\"chargible_price_if_lost\":\"Chargible Price If Lost\",\"create_authors\":\"Create Authors\",\"author_name\":\"Author Name\",\"create_publisher\":\"Create Publisher\",\"assets_publishers\":\"Assets Publishers\",\"publisher_name\":\"Publisher Name\",\"librarian\":\"Librarian\",\"back\":\"Back\",\"collections\":\"Collections\",\"masters\":\"Masters\",\"damaged\":\"Damaged\",\"lost\":\"Lost\",\"generate_collection\":\"Generate Collection\",\"series_prefix\":\"Series Prefix\",\"generate\":\"Generate\",\"maximum_issues_student\":\"Maximum Issues Student\",\"maximum_issues_staff\":\"Maximum Issues Staff\",\"maximum_days_to_return_student\":\"Maximum Days To Return Student\",\"maximum_days_to_return_staff\":\"Maximum Days To Return Staff\",\"library_series_prefix\":\"Library Series Prefix\",\"library_series_number_length\":\"Library Series Number Length\",\"topper_percentage\":\"Topper Percentage\",\"barcode\":\"Barcode\",\"edit_master_asset\":\"Edit Master Asset\",\"your not assigned to any class\":\"Your Not Assigned To Any Class\",\"edit_author\":\"Edit Author\",\"course_completed_students_list_class_vice\":\"Course Completed Students List Class Vice\",\"edit_academic\":\"Edit Academic\",\"edit_course\":\"Edit Course\",\"reference_no.\":\"Reference No.\",\"eligiblity\":\"Eligiblity\",\"issue\":\"Issue\",\"asset_issued_successfully\":\"Asset Issued Successfully\",\"on_issue\":\"On Issue\",\"edit_subject\":\"Edit Subject\",\"subjects_listtt\":\"Subjects Listtt\",\"edit_topic\":\"Edit Topic\",\"upload_question\":\"Upload Question\",\"supported_formats are\":\"Supported Formats Are\",\"difficulty_level\":\"Difficulty Level\",\"hint\":\"Hint\",\"explanation\":\"Explanation\",\"time_to_spend\":\"Time To Spend\",\"in_seconds\":\"In Seconds\",\"answer_number\":\"Answer Number\",\"total_correct_answers\":\"Total Correct Answers\",\"total_blank_answers\":\"Total Blank Answers\",\"left_title\":\"Left Title\",\"right_title\":\"Right Title\",\"left_option\":\"Left Option\",\"add_exam_series\":\"Add Exam Series\",\"series_title\":\"Series Title\",\"please_upload_valid_image_type\":\"Please Upload Valid Image Type\",\"it will be updated by adding the exams\":\"It Will Be Updated By Adding The Exams\",\"short_description\":\"Short Description\",\"update_series_for\":\"Update Series For\",\"exam_categories\":\"Exam Categories\",\"saved_exams\":\"Saved Exams\",\"add_content\":\"Add Content\",\" contents\":\" Contents\",\"content_type\":\"Content Type\",\"resource_link\":\"Resource Link\",\"lms_file\":\"Lms File\",\"add_lms_series\":\"Add Lms Series\",\"lms_category\":\"Lms Category\",\"it will be updated by adding the lms items\":\"It Will Be Updated By Adding The Lms Items\",\"master_setup\":\"Master Setup\",\"master_setup_dashboard\":\"Master Setup Dashboard\",\"mastersettings.course.list\":\"Mastersettings.course.list\",\"edit_course_semister\":\"Edit Course Semister\",\"edit_semister\":\"Edit Semister\",\"improper_data_in_the_question\":\"Improper Data In The Question\",\"record_already_exists_with_this_title\":\"Record Already Exists With This Title\",\"operations_are_disabled_in_demo_version\":\"Operations Are Disabled In Demo Version\",\"no records available\":\"No Records Available\",\"no_categories_available\":\"No Categories Available\",\"click_here_to_change_your_preferences\":\"Click Here To Change Your Preferences\",\"_empty_\":\"\",\"edit_question\":\"Edit Question\",\"assistant_librarian\":\"Assistant Librarian\",\"language\":\"Language\",\"is_rtl\":\"Is Rtl\",\"default_language\":\"Default Language\",\"update_strings\":\"Update Strings\",\"enable\":\"Enable\",\"set_default\":\"Set Default\",\"disable\":\"Disable\",\"this_user_have_to_return\":\"This User Have To Return\",\"in_library\":\"In Library\",\"items_in_library\":\"Items In Library\",\"staff_is_allocated_to_some_course\":\"Staff Is Allocated To Some Course\",\"add_instructions\":\"Add Instructions\",\"improper_data_submitted\":\"Improper Data Submitted\",\"no_series_available\":\"No Series Available\",\"your_subscription_was_successfull\":\"Your Subscription Was Successfull\",\"edit_series\":\"Edit Series\",\"file_type\":\"File Type\",\"saved_items\":\"Saved Items\",\"edit_instruction\":\"Edit Instruction\",\"edit_template\":\"Edit Template\",\"welcome\":\"Welcome\",\"email content\":\"Email Content\",\"today\":\"Today\",\"no_item_selected\":\"No Item Selected\",\"url\":\"Url\",\"feed_backs\":\"Feed Backs\",\"password_reset_link_sent_to_email\":\"Password Reset Link Sent To Email\",\"reset_password\":\"Reset Password\",\"email_address\":\"Email Address\",\"confirm_password\":\"Confirm Password\",\"password_changed_successfully\":\"Password Changed Successfully\",\"cannot_remove_this_subject_as_allocated_to_staff\":\"Cannot Remove This Subject As Allocated To Staff\",\"note:\":\"Note:\",\"if do not update the student admission details, those students are available in all users list\":\"If Do Not Update The Student Admission Details, Those Students Are Available In All Users List\",\"all users list\":\"All Users List\",\"click here\":\"Click Here\",\"for all users list\":\"For All Users List\",\"if do not update the student admission details, those students are available in all users list.\":\"If Do Not Update The Student Admission Details, Those Students Are Available In All Users List.\",\"staff_removed_successfully\":\"Staff Removed Successfully\",\"cannot_remove_as_staff_is_assigned_to_classes\":\"Cannot Remove As Staff Is Assigned To Classes\",\"meta_description\":\"Meta Description\",\"meta_keywords\":\"Meta Keywords\",\"google_analytics\":\"Google Analytics\",\"messaging_system_for\":\"Messaging System For\",\"payu_merchant_key\":\"Payu Merchant Key\",\"payu_salt\":\"Payu Salt\",\"payu_working_key\":\"Payu Working Key\",\"payu_testmode\":\"Payu Testmode\",\"assets_information\":\"Assets Information\",\"change_status\":\"Change Status\",\"library_history\":\"Library History\",\"active\":\"Active\",\"inactive\":\"Inactive\",\"make_inactive\":\"Make Inactive\",\"are_you_sure_to_make_user_active\":\"Are You Sure To Make User Active\",\"are_you_sure_to_make_user_inactive\":\"Are You Sure To Make User Inactive\",\"status_changed_successfully\":\"Status Changed Successfully\",\"make_active\":\"Make Active\",\"library_books_details\":\"Library Books Details\",\"library_asset_no\":\"Library Asset No\",\"issue_on\":\"Issue On\",\"master_asset_name\":\"Master Asset Name\",\"asset_no\":\"Asset No\",\"students_list_class_wise\":\"Students List Class Wise\",\"course_completed_students_list_class_wise\":\"Course Completed Students List Class Wise\",\"site_title\":\"Site Title\",\"roles\":\"Roles\",\"fee_settings\":\"Fee Settings\",\"fee_categories\":\"Fee Categories\",\"fee_category_allotment\":\"Fee Category Allotment\",\"fee_particulars\":\"Fee Particulars\",\"fee_schedules\":\"Fee Schedules\",\"fines\":\"Fines\",\"discounts\":\"Discounts\",\"subjects_master\":\"Subjects Master\",\"study_materials\":\"Study Materials\",\"school_hub\":\"School Hub\",\"admin_dashboard\":\"Admin Dashboard\",\"overall_users\":\"Overall Users\",\"user_details\":\"User Details\",\"add_language\":\"Add Language\",\"language_title\":\"Language Title\",\"language_code\":\"Language Code\",\"supported_language_codes\":\"Supported Language Codes\",\"home\":\"Home\",\"faqs\":\"Faqs\",\"about_us\":\"About Us\",\"contact_us\":\"Contact Us\",\"login\":\"Login\",\"forgot_password\":\"Forgot Password\",\"register\":\"Register\",\"logged_out_successfully\":\"Logged Out Successfully\",\"max_marks\":\"Max Marks\",\"view_profile\":\"View Profile\",\"update_details\":\"Update Details\",\"add_users\":\"Add Users\",\"user_roles\":\"User Roles\",\"permissions\":\"Permissions\",\"add_role\":\"Add Role\",\"role_name\":\"Role Name\",\"display_name\":\"Display Name\",\"list_roles\":\"List Roles\",\"this_field_id_required\":\"This Field Id Required\",\"couponcodes\":\"Couponcodes\",\"upload_marks_\":\"Upload Marks \",\"transportation\":\"Transportation\",\"vechicles\":\"Vechicles\",\"vehicle_types\":\"Vehicle Types\",\"exam_analysis\":\"Exam Analysis\",\"analysis_by_exam\":\"Analysis By Exam\",\"recent_activity\":\"Recent Activity\",\"it_will_be_updated_by_adding_the_questions\":\"It Will Be Updated By Adding The Questions\",\"edit_language\":\"Edit Language\",\"sms\":\"Sms\",\" my_profile\":\" My Profile\",\" change_password\":\" Change Password\",\" feedback\":\" Feedback\",\" notifications\":\" Notifications\",\"_messages\":\" Messages\",\"_languages\":\" Languages\",\"_logout\":\" Logout\",\"staff_status\":\"Staff Status\",\"asset_status\":\"Asset Status\",\"pusher_app_id\":\"Pusher App Id\",\"pusher_key\":\"Pusher Key\",\"pusher_secret\":\"Pusher Secret\",\"one_signal_app_id\":\"One Signal App Id\",\"one_signal_subdomain_name\":\"One Signal Subdomain Name\",\"default\":\"Default\",\"one_signal_user_id\":\"One Signal User Id\",\"offline_payment_information\":\"Offline Payment Information\",\"mail_driver\":\"Mail Driver\",\"mail_host\":\"Mail Host\",\"mail_port\":\"Mail Port\",\"mail_username\":\"Mail Username\",\"mail_password\":\"Mail Password\",\"mail_encryption\":\"Mail Encryption\",\"currency\":\"Currency\",\"account_type\":\"Account Type\",\"site_logo\":\"Site Logo\",\"site_address\":\"Site Address\",\"site_city\":\"Site City\",\"site_favicon\":\"Site Favicon\",\"site_state\":\"Site State\",\"site_country\":\"Site Country\",\"site_zipcode\":\"Site Zipcode\",\"site_phone\":\"Site Phone\",\"system_timezone\":\"System Timezone\",\"academic_detailsss\":\"Academic Detailsss\",\"subjects_reportsss\":\"Subjects Reportsss\",\"are_you_sure_to_return_the_book\":\"Are You Sure To Return The Book\",\"student_book_return\":\"Student Book Return\",\"staff_book_return\":\"Staff Book Return\",\"edit_coupon\":\"Edit Coupon\",\"staff_inactive_list\":\"Staff Inactive List\",\"change_branch_and_course\":\"Change Branch And Course\",\"edit_branch_and_course\":\"Edit Branch And Course\",\"are_you_sure_to_make_damaged\":\"Are You Sure To Make Damaged\",\"are_you_sure_to_make_lost\":\"Are You Sure To Make Lost\",\"time_table_settings\":\"Time Table Settings\",\"cannot_remove_this_item_as_it_is_in_use\":\"Cannot Remove This Item As It Is In Use\",\"please_add_instances_for_this_item\":\"Please Add Instances For This Item\",\"no_records_available, please_add_instances_for_this_item\":\"No Records Available, Please Add Instances For This Item\",\"the_same_prefix_is_already_available\":\"The Same Prefix Is Already Available\",\"minutes\":\"Minutes\",\"add_notification\":\"Add Notification\",\"latest_quizzes\":\"Latest Quizzes\",\"latest\":\"Latest\",\"children_analysis\":\"Children Analysis\",\"click_here_to_list_subjects\":\"Click Here To List Subjects\",\"background_image\":\"Background Image\",\"create_template\":\"Create Template\",\"feedback_details\":\"Feedback Details\",\"feedbacks\":\"Feedbacks\",\"latest_students\":\"Latest Students\",\"latest_staff\":\"Latest Staff\",\"recent_online_payments\":\"Recent Online Payments\",\"recent_offline_payments\":\"Recent Offline Payments\",\"students_detained_list\":\"Students Detained List\",\"recent_quiz_takers\":\"Recent Quiz Takers\",\"current_theme\":\"Current Theme\",\"currency_code\":\"Currency Code\",\"default_theme\":\"Default Theme\",\"green_theme\":\"Green Theme\",\"red_theme\":\"Red Theme\",\"course_completed_students\":\"Course Completed Students\",\"detained_students_list_class_wise\":\"Detained Students List Class Wise\",\"add_total_blank_columns\":\"Add Total Blank Columns\",\"detained_student_list\":\"Detained Student List\",\"template\":\"Template\",\"please_update_master_setup_details_before_creating_users.\":\"Please Update Master Setup Details Before Creating Users.\",\"update_master_setup\":\"Update Master Setup\",\"please_update_master_setup_details\":\"Please Update Master Setup Details\",\"ok\":\"Ok\",\"login_page_title\":\"Login Page Title\",\"default_academic_year_id\":\"Default Academic Year Id\",\"default_parent_course_id\":\"Default Parent Course Id\",\"currency_symbol\":\"Currency Symbol\",\"is_having_semesters\":\"Is Having Semesters\",\"date_time\":\"Date Time\",\"roll_number\":\"Roll Number\",\"religion_name\":\"Religion Name\",\"edit_religion\":\"Edit Religion\",\"chargeable_price_if_lost\":\"Chargeable Price If Lost\",\"offline_exam_categories\":\"Offline Exam Categories\",\"are_you_sure_to_make_clear_image\":\"Are You Sure To Make Clear Image\",\"clear_image\":\"Clear Image\",\"edit_publisher\":\"Edit Publisher\",\"click_here\":\"Click Here\",\"to_change_your_settings\":\"To Change Your Settings\",\"number\":\"Number\",\"today\'s_classes\":\"Today\'s Classes\",\"lesson_plan_statistics\":\"Lesson Plan Statistics\",\"no_subjects_allotted\":\"No Subjects Allotted\",\"master_asset_details\":\"Master Asset Details\",\"status_details\":\"Status Details\",\"total_:\":\"Total :\",\"master_asset_name_:\":\"Master Asset Name :\",\"available:\":\"Available:\",\"asset_type_:\":\"Asset Type :\",\"total_issued_:\":\"Total Issued :\",\"author_name:\":\"Author Name:\",\"total_damaged_:\":\"Total Damaged :\",\"publisher_name_:\":\"Publisher Name :\",\"total_lost_:\":\"Total Lost :\",\"edition_:\":\"Edition :\",\"price:\":\"Price:\",\"total_issued\":\"Total Issued\",\"total_damaged\":\"Total Damaged\",\"total_lost\":\"Total Lost\",\"price\":\"Price\",\"student_book_returns\":\"Student Book Returns\",\"course_detained_list\":\"Course Detained List\",\"add_series\":\"Add Series\",\"give_feedback\":\"Give Feedback\",\"feedback_form\":\"Feedback Form\",\"send\":\"Send\",\"sorry_no_messages_available\":\"Sorry No Messages Available\",\"audio\":\"Audio\",\"scheduled_exam_marks\":\"Scheduled Exam Marks\",\"all_payments\":\"All Payments\",\"gateway\":\"Gateway\",\"quiz_name\":\"Quiz Name\",\"course_completed_list\":\"Course Completed List\",\"transfer_certificate\":\"Transfer Certificate\",\"select_course\":\"Select Course\",\"system_in_spring_fall_mode\":\"System In Spring Fall Mode\",\"education_system_in_spring_and_fall_mode\":\"Education System In Spring And Fall Mode\",\"spring\":\"Spring\",\"fall\":\"Fall\",\"none\":\"None\",\"student_belongs_to\":\"Student Belongs To\",\"please_check_your_email_master_settings\":\"Please Check Your Email Master Settings\",\"oops\":\"Oops\",\"invalid_record\":\"Invalid Record\",\"slug\":\"Slug\",\"add_categories_to_courses\":\"Add Categories To Courses\",\"fee_category\":\"Fee Category\",\"fee_amount\":\"Fee Amount\",\"refundable\":\"Refundable\",\"applicable_for\":\"Applicable For\",\"start\":\"Start\",\"end\":\"End\",\"scheduled_for\":\"Scheduled For\",\"create_fee_category\":\"Create Fee Category\",\"specific\":\"Specific\",\"create_particular\":\"Create Particular\",\"particular\":\"Particular\",\"amount\":\"Amount\",\"fee_refundable\":\"Fee Refundable\",\"applicable_to\":\"Applicable To\",\"create_schedule\":\"Create Schedule\",\"collection_title\":\"Collection Title\",\"add_fine\":\"Add Fine\",\"fine_name\":\"Fine Name\",\"add_discount\":\"Add Discount\",\"discount_name\":\"Discount Name\",\"discount_for\":\"Discount For\",\"select_category\":\"Select Category\",\"select_student\":\"Select Student\",\"edit_fee_category\":\"Edit Fee Category\",\"edit_fee_particular\":\"Edit Fee Particular\",\"coursess\":\"Coursess\",\"is_income\":\"Is Income\",\"assign_particulars\":\"Assign Particulars\",\"manage_particulars\":\"Manage Particulars\",\"create_fee_particular\":\"Create Fee Particular\",\"add_fee_particulars_to_\":\"Add Fee Particulars To \",\"add_fee_particulars_for_\":\"Add Fee Particulars For \",\"manage_fee_particulars_for_\":\"Manage Fee Particulars For \",\"updaterrrr\":\"Updaterrrr\",\"fee_terms\":\"Fee Terms\",\"is_term\":\"Is Term\",\"manage_schedules\":\"Manage Schedules\",\"schedule_title\":\"Schedule Title\",\"total_schedules\":\"Total Schedules\",\"start_date_for_term\":\"Start Date For Term\",\"end_date_for_term\":\"End Date For Term\",\"fee_schedules_for\":\"Fee Schedules For\",\"exclude_products\":\"Exclude Products\",\"first_assign_particulars_to_this_category\":\"First Assign Particulars To This Category\",\"first_assign_particulars_tomytest5\":\"First Assign Particulars Tomytest5\",\"first_assign_particulars_to mytest5_category\":\"First Assign Particulars To Mytest5 Category\",\"first_assign_particulars_to <strong>mytest5<\\/strong>_category\":\"First Assign Particulars To <strong>mytest5<\\/strong> Category\",\"fee_category_is_already_created_wiht_this_academic_details\":\"Fee Category Is Already Created Wiht This Academic Details\",\"first_assign_particulars_to 2015-2016-civil_category\":\"First Assign Particulars To 2015-2016-civil Category\",\"first_assign_particulars_to 2016-2017-mechanical_category\":\"First Assign Particulars To 2016-2017-mechanical Category\",\"first_assign_particulars_to mytest2_category\":\"First Assign Particulars To Mytest2 Category\",\"first_assign_particulars_to mytest4_category\":\"First Assign Particulars To Mytest4 Category\",\"pay_fee\":\"Pay Fee\",\"feecategories\":\"Feecategories\",\"pay_now\":\"Pay Now\",\"terms\":\"Terms\",\"enddate\":\"Enddate\",\"term\":\"Term\",\"paid_amount\":\"Paid Amount\",\"cash\":\"Cash\",\"cheque\":\"Cheque\",\"dd\":\"Dd\",\"other\":\"Other\",\"payment_way\":\"Payment Way\",\"other_paymentway\":\"Other Paymentway\",\"other_payment_way\":\"Other Payment Way\",\"student_name:\":\"Student Name:\",\"father_name:\":\"Father Name:\",\"branch:\":\"Branch:\",\"class:\":\"Class:\",\"year:\":\"Year:\",\"semister:\":\"Semister:\",\"student_details\":\"Student Details\",\"fee_details\":\"Fee Details\",\"balance\":\"Balance\",\"first_assign_particulars_to 2015-2016-civil-1st year-1st senister_category\":\"First Assign Particulars To 2015-2016-civil-1st Year-1st Senister Category\",\"registration_fee\":\"Registration Fee\",\"total_fee :\":\"Total Fee :\",\"total_installments :\":\"Total Installments :\",\"term :\":\"Term :\",\"now_paying\":\"Now Paying\",\"student_name :\":\"Student Name :\",\"father_name :\":\"Father Name :\",\"year :\":\"Year :\",\"semister :\":\"Semister :\",\"student_name\":\"Student Name\",\"father_name\":\"Father Name\",\"class \":\"Class \",\"total_to_pay\":\"Total To Pay\",\"first_assign_particulars_to 2015-2016-civil-1st year-1st semister_category\":\"First Assign Particulars To 2015-2016-civil-1st Year-1st Semister Category\",\"fee_paid_successfully\":\"Fee Paid Successfully\",\"payment_mode\":\"Payment Mode\",\"other_payment_mode\":\"Other Payment Mode\",\"improper_data\":\"Improper Data\",\"minimum_fee_accept_percentage\":\"Minimum Fee Accept Percentage\",\"fee\":\"Fee\",\"fee_management\":\"Fee Management\",\"fee_dashboard\":\"Fee Dashboard\",\"pay_reports\":\"Pay Reports\",\"fee_reports\":\"Fee Reports\",\"fee_shedules\":\"Fee Shedules\",\"total_installments\":\"Total Installments\",\"total_fee\":\"Total Fee\",\"installment_amount\":\"Installment Amount\",\"other_amount\":\"Other Amount\",\"final_fee\":\"Final Fee\",\"ooops\":\"Ooops\",\"undefined user\":\"Undefined User\",\"fee_particular_name\":\"Fee Particular Name\",\"pay_with_term\":\"Pay With Term\",\"term_fee\":\"Term Fee\",\"pay_amount\":\"Pay Amount\",\"fee_categories_list\":\"Fee Categories List\",\"undefined variable: feepayment\":\"Undefined Variable: Feepayment\",\"sqlstate[42s22]: column not found: 1054 unknown column \'received_on\' in \'field list\' (sql: update `feeparticular_paymets` set `feepayment_id` = 33, `paid_amount` = 1000, `balance` = 0, `paid_percentage` = 100, `updated_at` = 2017-06-02 14:27:01, `received_on` = 2017-06-02 14:27:01, `payment_recevied_by` = 1788 where `id` = 372)\":\"Sqlstate[42s22]: Column Not Found: 1054 Unknown Column \'received On\' In \'field List\' (sql: Update `feeparticular Paymets` Set `feepayment Id` = 33, `paid Amount` = 1000, `balance` = 0, `paid Percentage` = 100, `updated At` = 2017-06-02 14:27:01, `received On` = 2017-06-02 14:27:01, `payment Recevied By` = 1788 Where `id` = 372)\",\"fee_paid_history\":\"Fee Paid History\",\"fee_history\":\"Fee History\",\"receipt\":\"Receipt\",\"fee_paid_history_for_class_wise\":\"Fee Paid History For Class Wise\",\"class_fee_paid_history\":\"Class Fee Paid History\",\"select_feecategory\":\"Select Feecategory\",\"select_fee_category\":\"Select Fee Category\",\"fee_paid_list\":\"Fee Paid List\",\"fee_reports_class_wise\":\"Fee Reports Class Wise\",\"quiz_categoriesss\":\"Quiz Categoriesss\",\"first_assign_particulars_to test category_category\":\"First Assign Particulars To Test Category Category\",\"delete_schedules\":\"Delete Schedules\",\"are_you_sure_to_delete_schedules\":\"Are You Sure To Delete Schedules\",\"you_have_do_not_delete_this_schedules\":\"You Have Do Not Delete This Schedules\",\"you_do_not_delete_this_schedules\":\"You Do Not Delete This Schedules\",\"first_assign_particulars_to testcategoty-2_category\":\"First Assign Particulars To Testcategoty-2 Category\",\"in_active\":\"In Active\",\"first_assign_particulars_to 2016-2017-mechniacl1st year 1st sem_category\":\"First Assign Particulars To 2016-2017-mechniacl1st Year 1st Sem Category\",\"schedules_are_not_updated\":\"Schedules Are Not Updated\",\"schedules_deleted_successfully\":\"Schedules Deleted Successfully\",\"installments\":\"Installments\",\"connection could not be established with host adiyya@gmail.com [php_network_getaddresses: getaddrinfo failed: temporary failure in name resolution #0]\":\"Connection Could Not Be Established With Host Adiyya@gmail.com [php Network Getaddresses: Getaddrinfo Failed: Temporary Failure In Name Resolution #0]\",\"system_upgraded_successfully\":\"System Upgraded Successfully\",\"deleteee\":\"Deleteee\",\"software  have no topics, please add topics to upload questions\":\"Software  Have No Topics, Please Add Topics To Upload Questions\",\"updateee\":\"Updateee\",\"fee_particular_nameee\":\"Fee Particular Nameee\",\"fee_particular\":\"Fee Particular\",\"fee_particularsss\":\"Fee Particularsss\",\"clerks\":\"Clerks\",\"staff_book_returns\":\"Staff Book Returns\",\"total_to_payyy\":\"Total To Payyy\",\"undefined variable: remaining_amount\":\"Undefined Variable: Remaining Amount\",\"clerk\":\"Clerk\",\"first_assign_particulars_to 2017-2018-3rd year- 2nd sem_category\":\"First Assign Particulars To 2017-2018-3rd Year- 2nd Sem Category\",\"tc_will_give_if_fee_is_pending\":\"Tc Will Give If Fee Is Pending\",\"current_fee\":\"Current Fee\",\"previous_balance\":\"Previous Balance\",\"totalll\":\"Totalll\",\"totall\":\"Totall\",\"improper_selection\":\"Improper Selection\"}', '2016-08-30 00:41:02', '2017-01-02 07:55:22');
INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `phrases`, `created_at`, `updated_at`) VALUES
(12, 'Hindi', 'hindi', 'hi', 0, 0, '{\"success\":\"\\u0938\\u092b\\u0932\\u0924\\u093e\",\"record_updated_successfully\":\"\\u0930\\u093f\\u0915\\u093e\\u0930\\u094d\\u0921 \\u0938\\u092b\\u0932\\u0924\\u093e\\u092a\\u0942\\u0930\\u094d\\u0935\\u0915 \\u0905\\u092a\\u0921\\u0947\\u091f\",\"languages\":\"\\u092c\\u094b\\u0932\\u0940\",\"create\":\"\\u0938\\u0930\\u094d\\u091c\\u0928 \\u0915\\u0930\\u0928\\u093e\",\"language\":\"\\u092d\\u093e\\u0937\\u093e\",\"code\":\"\\u0915\\u094b\\u0921\",\"is_rtl\":\"Rtl \\u0939\\u0948\",\"default_language\":\"\\u092e\\u0941\\u0916\\u094d\\u092f \\u092d\\u093e\\u0937\\u093e\",\"action\":\"\\u0915\\u093e\\u0930\\u094d\\u092f\",\"are_you_sure\":\"\\u0915\\u094d\\u092f\\u093e \\u0906\\u092a\\u0915\\u094b \\u092f\\u0915\\u0940\\u0928 \\u0939\\u0948\",\"you_will_not_be_able_to_recover_this_record\":\"\\u0906\\u092a \\u0907\\u0938 \\u0930\\u093f\\u0915\\u0949\\u0930\\u094d\\u0921 \\u0920\\u0940\\u0915 \\u0915\\u0930\\u0928\\u0947 \\u092e\\u0947\\u0902 \\u0938\\u0915\\u094d\\u0937\\u092e \\u0928\\u0939\\u0940\\u0902 \\u0939\\u094b\\u0917\\u093e\",\"yes\":\"\\u0939\\u093e\\u0901\",\"delete_it\":\"\\u0907\\u0938\\u0947 \\u092e\\u093f\\u091f\\u093e\\u0913\",\"no\":\"\\u0928\\u0939\\u0940\\u0902\",\"cancel_please\":\"\\u0930\\u0926\\u094d\\u0926 \\u0915\\u0930\\u0947\\u0902\",\"deleted\":\"\\u0939\\u091f\\u093e\\u090f \\u0917\\u090f\",\"sorry\":\"\\u092e\\u093e\\u092b\\u093c \\u0915\\u0940\\u091c\\u093f\\u092f\\u0947\",\"cannot_delete_this_record_as\":\"\\u0928\\u0939\\u0940\\u0902 \\u0939\\u091f\\u093e \\u0938\\u0915\\u0924\\u0947 \\u0939\\u0948\\u0902 \\u0907\\u0938 \\u0930\\u093f\\u0915\\u0949\\u0930\\u094d\\u0921 \\u0915\\u0947 \\u0930\\u0942\\u092a \\u092e\\u0947\\u0902\",\"your_record_has_been_deleted\":\"\\u0906\\u092a\\u0915\\u093e \\u0930\\u093f\\u0915\\u0949\\u0930\\u094d\\u0921 \\u0928\\u0937\\u094d\\u091f \\u0915\\u0930 \\u0926\\u093f\\u092f\\u093e \\u0917\\u092f\\u093e \\u0939\\u0948\",\"cancelled\":\"\\u0930\\u0926\\u094d\\u0926\",\"your_record_is_safe\":\"\\u0905\\u092a\\u0928\\u0947 \\u0930\\u093f\\u0915\\u0949\\u0930\\u094d\\u0921 \\u0938\\u0941\\u0930\\u0915\\u094d\\u0937\\u093f\\u0924 \\u0939\\u0948\",\"search_student\":\"\\u0916\\u094b\\u091c\\u0947\\u0902 \\u091b\\u093e\\u0924\\u094d\\u0930\",\"latest_users\":\"\\u0928\\u0935\\u0940\\u0928\\u0924\\u092e \\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e\\u0913\\u0902\",\"was_joined_as\":\"\\u0915\\u0947 \\u0930\\u0942\\u092a \\u092e\\u0947\\u0902 \\u0936\\u093e\\u092e\\u093f\\u0932 \\u0939\\u094b \\u0917\\u092f\\u093e \\u0925\\u093e\",\"see_more\":\"\\u0914\\u0930 \\u0926\\u0947\\u0916\\u0947\\u0902\",\"my_profile\":\"\\u092e\\u0947\\u0930\\u0940 \\u092a\\u094d\\u0930\\u094b\\u092b\\u093e\\u0907\\u0932\",\"change_password\":\"\\u092a\\u093e\\u0938\\u0935\\u0930\\u094d\\u0921 \\u092c\\u0926\\u0932\\u0947\\u0902\",\"feedback\":\"\\u092a\\u094d\\u0930\\u0924\\u093f\\u0915\\u094d\\u0930\\u093f\\u092f\\u093e\",\"notifications\":\"\\u0938\\u0942\\u091a\\u0928\\u093e\\u090f\\u0902\",\"messages\":\"\\u0938\\u0902\\u0926\\u0947\\u0936\",\"logout\":\"\\u0932\\u094b\\u0917 \\u0906\\u0909\\u091f\",\"dashboard\":\"\\u0921\\u0948\\u0936\\u092c\\u094b\\u0930\\u094d\\u0921\",\"users\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e\",\"academic_operations\":\"\\u090f\\u0915\\u0947\\u0921\\u092e\\u093f\\u0915 \\u0938\\u0902\\u091a\\u093e\\u0932\\u0928\",\"attendance\":\"\\u0909\\u092a\\u0938\\u094d\\u0925\\u093f\\u0924\\u093f\",\"certificates\":\"\\u092a\\u094d\\u0930\\u092e\\u093e\\u0923 \\u092a\\u0924\\u094d\\u0930\",\"transfers\":\"\\u0938\\u094d\\u0925\\u093e\\u0928\\u093e\\u0902\\u0924\\u0930\\u0923\",\"timetable\":\"\\u0938\\u092e\\u092f \\u0938\\u093e\\u0930\\u0923\\u0940\",\"offline_exams_\":\"\\u0911\\u092b\\u0932\\u093e\\u0907\\u0928 \\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e\",\"class_attendance_report\":\"\\u0915\\u0915\\u094d\\u0937\\u093e \\u0909\\u092a\\u0938\\u094d\\u0925\\u093f\\u0924\\u093f \\u0915\\u0940 \\u0930\\u093f\\u092a\\u094b\\u0930\\u094d\\u091f\",\"exams\":\"\\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e\",\"categories\":\"\\u0936\\u094d\\u0930\\u0947\\u0923\\u093f\\u092f\\u093e\\u0901\",\"question_bank\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928 \\u092c\\u0948\\u0902\\u0915\",\"quiz\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928\\u094b\\u0924\\u094d\\u0924\\u0930\\u0940\",\"exam_series\":\"\\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e \\u0938\\u0940\\u0930\\u0940\\u091c\",\"instructions\":\"\\u0905\\u0928\\u0941\\u0926\\u0947\\u0936\",\"coupons\":\"\\u0915\\u0942\\u092a\\u0928\",\"list\":\"\\u0938\\u0942\\u091a\\u0940\",\"add\":\"\\u091c\\u094b\\u0921\\u093c\\u0928\\u093e\",\"contents\":\"\\u0905\\u0902\\u0924\\u0930\\u094d\\u0935\\u0938\\u094d\\u0924\\u0941\",\"series\":\"\\u0936\\u0943\\u0902\\u0916\\u0932\\u093e\",\"master_settings\":\"\\u092e\\u093e\\u0938\\u094d\\u091f\\u0930 \\u0938\\u0947\\u091f\\u093f\\u0902\\u0917\",\"settings\":\"\\u0938\\u0947\\u091f\\u093f\\u0902\\u0917\\u094d\\u0938\",\"religions_master\":\"\\u0927\\u0930\\u094d\\u092e \\u092e\\u093e\\u0938\\u094d\\u091f\\u0930\",\"academics_master\":\"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e\\u0935\\u093f\\u0926\\u094b\\u0902 \\u092e\\u093e\\u0938\\u094d\\u091f\\u0930\",\"courses_master\":\"\\u092a\\u093e\\u0920\\u094d\\u092f\\u0915\\u094d\\u0930\\u092e \\u092e\\u093e\\u0938\\u094d\\u091f\\u0930\",\"course_subjects\":\"\\u092a\\u093e\\u0920\\u094d\\u092f\\u0915\\u094d\\u0930\\u092e \\u0935\\u093f\\u0937\\u092f\\u094b\\u0902\",\"certificate_templates\":\"\\u092a\\u094d\\u0930\\u092e\\u093e\\u0923\\u092a\\u0924\\u094d\\u0930 \\u091f\\u0947\\u092e\\u094d\\u092a\\u0932\\u0947\\u091f\",\"email_templates\":\"\\u0908\\u092e\\u0947\\u0932 \\u091f\\u0947\\u092e\\u094d\\u092a\\u0932\\u0947\\u091f\\u094d\\u0938\",\"payment_reports\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0930\\u093f\\u092a\\u094b\\u0930\\u094d\\u091f\",\"online_payments\":\"\\u0911\\u0928\\u0932\\u093e\\u0907\\u0928 \\u092d\\u0941\\u0917\\u0924\\u093e\\u0928\",\"offline_payments\":\"\\u0911\\u092b\\u093c\\u0932\\u093e\\u0907\\u0928 \\u092d\\u0941\\u0917\\u0924\\u093e\\u0928\",\"export\":\"\\u0928\\u093f\\u0930\\u094d\\u092f\\u093e\\u0924\",\"please_wait\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u092a\\u094d\\u0930\\u0924\\u0940\\u0915\\u094d\\u0937\\u093e \\u0915\\u0930\\u0947\\u0902\",\"update_strings\":\"\\u0938\\u094d\\u091f\\u094d\\u0930\\u093f\\u0902\\u0917\\u094d\\u0938 \\u0905\\u092a\\u0921\\u0947\\u091f\",\"edit\":\"\\u0938\\u0902\\u092a\\u093e\\u0926\\u093f\\u0924 \\u0915\\u0930\\u0947\\u0902\",\"delete\":\"\\u092e\\u093f\\u091f\\u093e\\u0928\\u093e\",\"enable\":\"\\u0938\\u0915\\u094d\\u0937\\u092e \\u0915\\u0930\\u0947\\u0902\",\"set_default\":\"\\u0921\\u093f\\u092b\\u0949\\u0932\\u094d\\u091f \\u0938\\u0947\\u091f \\u0915\\u0930\\u0947\\u0902\",\"disable\":\"\\u0905\\u0915\\u094d\\u0937\\u092e\",\"user_statistics\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u0938\\u093e\\u0902\\u0916\\u094d\\u092f\\u093f\\u0915\\u0940\",\"pending\":\"\\u0905\\u092a\\u0942\\u0930\\u094d\\u0923\",\"total\":\"\\u0915\\u0941\\u0932\",\"overall_statistics\":\"\\u0915\\u0941\\u0932 \\u092e\\u093f\\u0932\\u093e\\u0915\\u0930 \\u0938\\u093e\\u0902\\u0916\\u094d\\u092f\\u093f\\u0915\\u0940\",\"payments_reports_in\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u092e\\u0947\\u0902 \\u0930\\u093f\\u092a\\u094b\\u0930\\u094d\\u091f\",\"demanding_quizzes\":\"\\u0915\\u0940 \\u092e\\u093e\\u0902\\u0917 \\u0915\\u0940 \\u0915\\u094d\\u0935\\u093f\\u091c\\u093c\",\"demanding\":\"\\u0915\\u0940 \\u092e\\u093e\\u0902\\u0917\",\"quizzes\":\"Quizzes\",\"view_all\":\"\\u0938\\u092d\\u0940 \\u0915\\u094b \\u0926\\u0947\\u0916\\u0947\\u0902\",\"academics\":\"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e\\u0935\\u093f\\u0926\\u094b\\u0902\",\"library\":\"\\u092a\\u0941\\u0938\\u094d\\u0924\\u0915\\u093e\\u0932\\u092f\",\"courses\":\"\\u092a\\u093e\\u0920\\u094d\\u092f\\u0915\\u094d\\u0930\\u092e\",\"quizzes_usage\":\"Quizzes \\u0909\\u092a\\u092f\\u094b\\u0917\",\"paid_quizzes_usage\":\"\\u0905\\u0926\\u093e \\u0915\\u094d\\u0935\\u093f\\u091c\\u093c \\u0909\\u092a\\u092f\\u094b\\u0917\",\"users_dashboard\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u0921\\u0948\\u0936\\u092c\\u094b\\u0930\\u094d\\u0921\",\"owners\":\"\\u0913\\u0928\\u0930\\u094d\\u0938\",\"admins\":\"\\u092c\\u0928\\u093e\\u0935\\u0947\\u0902\",\"students\":\"\\u091b\\u093e\\u0924\\u094d\\u0930\",\"staff\":\"\\u0938\\u094d\\u091f\\u093e\\u092b\\u093c\",\"librarians\":\"\\u092a\\u0941\\u0938\\u094d\\u0924\\u0915\\u093e\\u0932\\u092f\",\"assistant_librarians\":\"\\u0938\\u0939\\u093e\\u092f\\u0915 \\u092a\\u0941\\u0938\\u094d\\u0924\\u0915\\u093e\\u0932\\u092f\",\"parents\":\"\\u092e\\u093e\\u0924\\u093e-\\u092a\\u093f\\u0924\\u093e\",\"all_users\":\"\\u0938\\u092d\\u0940 \\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e\\u0913\\u0902\",\"create_user\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u092c\\u0928\\u093e\\u0907\\u092f\\u0947\",\"owner\":\"\\u092e\\u093e\\u0932\\u093f\\u0915\",\"import_excel\":\"\\u0906\\u092f\\u093e\\u0924 \\u090f\\u0915\\u094d\\u0938\\u0947\\u0932\",\"add_user\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u091c\\u094b\\u0921\\u093c\\u0947\\u0902\",\"name\":\"\\u0928\\u093e\\u092e\",\"image\":\"\\u091b\\u0935\\u093f\",\"email\":\"\\u0908\\u092e\\u0947\\u0932\",\"admin\":\"\\u0935\\u094d\\u092f\\u0935\\u0938\\u094d\\u0925\\u093e\\u092a\\u0915\",\"edit_user\":\"\\u092f\\u0942\\u091c\\u0930 \\u0915\\u094b \\u0938\\u0902\\u092a\\u093e\\u0926\\u093f\\u0924 \\u0915\\u0930\\u094b\",\"update\":\"\\u0905\\u0926\\u094d\\u092f\\u0924\\u0928\",\"invalid_setting\":\"\\u0905\\u092e\\u093e\\u0928\\u094d\\u092f \\u0938\\u0947\\u091f\\u093f\\u0902\\u0917\",\"this_field_is_required\":\"\\u092f\\u0939 \\u092b\\u093c\\u0940\\u0932\\u094d\\u0921 \\u0906\\u0935\\u0936\\u094d\\u092f\\u0915 \\u0939\\u0948\",\"the_text_is_too_short\":\"\\u092a\\u093e\\u0920 \\u092c\\u0939\\u0941\\u0924 \\u091b\\u094b\\u091f\\u093e \\u0939\\u0948\",\"the_text_is_too_long\":\"\\u0932\\u0947\\u0916 \\u092c\\u0939\\u0941\\u0924 \\u092c\\u0921\\u093c\\u093e \\u0939\\u0948\",\"invalid_input\":\"\\u0905\\u092e\\u093e\\u0928\\u094d\\u092f \\u0928\\u093f\\u0935\\u0947\\u0936\",\"username\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u0928\\u093e\\u092e\",\"please_enter_valid_email\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u092e\\u093e\\u0928\\u094d\\u092f \\u0908\\u092e\\u0947\\u0932 \\u0915\\u094b \\u0926\\u0930\\u094d\\u091c \\u0915\\u0930\\u0947\\u0902\",\"role\":\"\\u092d\\u0942\\u092e\\u093f\\u0915\\u093e\",\"select_role\":\"\\u092d\\u0942\\u092e\\u093f\\u0915\\u093e \\u0915\\u093e \\u091a\\u092f\\u0928\",\"phone\":\"\\u092b\\u093c\\u094b\\u0928\",\"please_enter_10-15_digit_mobile_number\":\"\\u0915\\u0943\\u092a\\u092f\\u093e 10-15 \\u0905\\u0902\\u0915 \\u092e\\u094b\\u092c\\u093e\\u0907\\u0932 \\u0928\\u0902\\u092c\\u0930 \\u0926\\u0930\\u094d\\u091c\",\"please_enter_valid_phone_number\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u090f\\u0915 \\u0935\\u0948\\u0927 \\u0928\\u0902\\u092c\\u0930 \\u0921\\u093e\\u0932\\u0947\\u0902\",\"billing_address\":\"\\u092c\\u093f\\u0932 \\u092d\\u0947\\u091c\\u0928\\u0947 \\u0915\\u093e \\u092a\\u0924\\u093e\",\"please_enter_your_address\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u0905\\u092a\\u0928\\u0947 \\u092a\\u0924\\u0947 \\u0926\\u0930\\u094d\\u091c\",\"file_type_not_allowed\":\"\\u092b\\u093c\\u093e\\u0907\\u0932 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u0940 \\u0905\\u0928\\u0941\\u092e\\u0924\\u093f \\u0928\\u0939\\u0940\\u0902\",\"admission_details\":\"\\u0926\\u093e\\u0916\\u093f\\u0932\\u093e \\u0935\\u093f\\u0935\\u0930\\u0923\",\"profile\":\"\\u092a\\u094d\\u0930\\u094b\\u092b\\u093e\\u0907\\u0932\",\"student\":\"\\u091b\\u093e\\u0924\\u094d\\u0930\",\"edit_details\":\"\\u0935\\u093f\\u0935\\u0930\\u0923 \\u0938\\u0902\\u092a\\u093e\\u0926\\u093f\\u0924 \\u0915\\u0930\\u0947\\u0902\",\"teacher\":\"\\u0905\\u0927\\u094d\\u092f\\u093e\\u092a\\u0915\",\"roll_no\":\"\\u0905\\u0928\\u0941\\u0915\\u094d\\u0930\\u092e\\u093e\\u0902\\u0915\",\"course\":\"\\u0915\\u094b\\u0930\\u094d\\u0938\",\"year-semester\":\"\\u0935\\u0930\\u094d\\u0937 \\u0938\\u0947\\u092e\\u0947\\u0938\\u094d\\u091f\\u0930\",\"staff_id\":\"\\u0938\\u094d\\u091f\\u093e\\u092b \\u0906\\u0908\\u0921\\u0940\",\"job_title\":\"\\u0928\\u094c\\u0915\\u0930\\u0940 \\u0915\\u093e \\u0928\\u093e\\u092e\",\"branch\":\"\\u0921\\u093e\\u0932\\u0940\",\"librarian\":\"\\u092a\\u0941\\u0938\\u094d\\u0924\\u0915\\u093e\\u0932\\u092f \\u0905\\u0927\\u094d\\u092f\\u0915\\u094d\\u0937\",\"assistant_librarian\":\"\\u0938\\u0939\\u093e\\u092f\\u0915 \\u0932\\u093e\\u0907\\u092c\\u094d\\u0930\\u0947\\u0930\\u093f\\u092f\\u0928\",\"parent\":\"\\u092e\\u093e\\u0924\\u093e-\\u092a\\u093f\\u0924\\u093e\",\"academic_operations_dashboard\":\"\\u090f\\u0915\\u0947\\u0921\\u092e\\u093f\\u0915 \\u0938\\u0902\\u091a\\u093e\\u0932\\u0928 \\u0921\\u0948\\u0936\\u092c\\u094b\\u0930\\u094d\\u0921\",\"offline_exams\":\"\\u0911\\u092b\\u0932\\u093e\\u0907\\u0928 \\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e\",\"module\":\"\\u092e\\u0949\\u0921\\u094d\\u092f\\u0942\\u0932\",\"key\":\"\\u0915\\u0941\\u0902\\u091c\\u0940\",\"description\":\"\\u0935\\u093f\\u0935\\u0930\\u0923\",\"view\":\"\\u0930\\u093e\\u092f\",\"library_dashboard\":\"\\u0932\\u093e\\u0907\\u092c\\u094d\\u0930\\u0947\\u0930\\u0940 \\u0921\\u0948\\u0936\\u092c\\u094b\\u0930\\u094d\\u0921\",\"book_returns_student\":\"\\u092a\\u0941\\u0938\\u094d\\u0924\\u0915 \\u0930\\u093f\\u091f\\u0930\\u094d\\u0928 \\u091b\\u093e\\u0924\\u094d\\u0930\",\"book_returns_staff\":\"\\u092a\\u0941\\u0938\\u094d\\u0924\\u0915 \\u0930\\u093f\\u091f\\u0930\\u094d\\u0928 \\u0938\\u094d\\u091f\\u093e\\u092b\",\"asset_types\":\"\\u090f\\u0938\\u0947\\u091f \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930\",\"master_data\":\"\\u092e\\u0941\\u0916\\u094d\\u092f \\u0906\\u0902\\u0915\\u0921\\u0947\",\"publishers\":\"\\u092a\\u094d\\u0930\\u0915\\u093e\\u0936\\u0915\",\"authors\":\"\\u0932\\u0947\\u0916\\u0915\",\"courses_dashboard\":\"\\u092a\\u093e\\u0920\\u094d\\u092f\\u0915\\u094d\\u0930\\u092e \\u0921\\u0948\\u0936\\u092c\\u094b\\u0930\\u094d\\u0921\",\"academic_years\":\"\\u0905\\u0915\\u093e\\u0926\\u092e\\u093f\\u0915 \\u0935\\u0930\\u094d\\u0937\",\"course_list\":\"\\u092a\\u093e\\u0920\\u094d\\u092f\\u0915\\u094d\\u0930\\u092e \\u0915\\u0940 \\u0938\\u0942\\u091a\\u0940\",\"add_course\":\"\\u0915\\u094b\\u0930\\u094d\\u0938 \\u091c\\u094b\\u0921\\u093c\\u0947\",\"subject_master\":\"\\u0935\\u093f\\u0937\\u092f \\u092e\\u093e\\u0938\\u094d\\u091f\\u0930\",\"subject_topics\":\"\\u0935\\u093f\\u0937\\u092f \\u0935\\u093f\\u0937\\u092f\\u094b\\u0902\",\"allocate_subject_to_course\":\"\\u0915\\u094b\\u0930\\u094d\\u0938 \\u0915\\u0930\\u0928\\u0947 \\u0915\\u0947 \\u0932\\u093f\\u090f \\u0935\\u093f\\u0937\\u092f \\u0915\\u093e \\u0906\\u0935\\u0902\\u091f\\u0928\",\"allocate_staff_to_course\":\"\\u0915\\u094b\\u0930\\u094d\\u0938 \\u0915\\u0930\\u0928\\u0947 \\u0915\\u0947 \\u0932\\u093f\\u090f \\u0915\\u0930\\u094d\\u092e\\u091a\\u093e\\u0930\\u093f\\u092f\\u094b\\u0902 \\u0915\\u093e \\u0906\\u0935\\u0902\\u091f\\u0928\",\"certificates_dashboard\":\"\\u092a\\u094d\\u0930\\u092e\\u093e\\u0923 \\u092a\\u0924\\u094d\\u0930 \\u0921\\u0948\\u0936\\u092c\\u094b\\u0930\\u094d\\u0921\",\"id_cards\":\"\\u092a\\u0930\\u093f\\u091a\\u092f \\u092a\\u0924\\u094d\\u0930\",\"lets_start\":\"\\u091a\\u0932\\u094b \\u0936\\u0941\\u0930\\u0942 \\u0915\\u0930\\u094b\",\"bonafide_certificates\":\"\\u0935\\u093e\\u0938\\u094d\\u0924\\u0935\\u093f\\u0915 \\u092a\\u094d\\u0930\\u092e\\u093e\\u0923 \\u092a\\u0924\\u094d\\u0930\",\"select\":\"\\u091a\\u0941\\u0928\\u0924\\u0947 \\u0939\\u0948\\u0902\",\"student_promotions\":\"\\u0935\\u093f\\u0926\\u094d\\u092f\\u093e\\u0930\\u094d\\u0925\\u0940 \\u092a\\u094d\\u0930\\u091a\\u093e\\u0930\",\"select_details\":\"\\u0935\\u093f\\u0935\\u0930\\u0923 \\u0915\\u093e \\u091a\\u092f\\u0928\",\"academic_year\":\"\\u0936\\u0948\\u0915\\u094d\\u0937\\u0923\\u093f\\u0915 \\u0935\\u0930\\u094d\\u0937\",\"year\":\"\\u0938\\u093e\\u0932\",\"semester\":\"\\u091b\\u092e\\u093e\\u0939\\u0940\",\"is_completed\":\"\\u092a\\u0942\\u0930\\u093e \\u0939\\u094b \\u0917\\u092f\\u093e \\u0939\\u0948\",\"transfer_to_course\":\"\\u0915\\u094b\\u0930\\u094d\\u0938 \\u0915\\u0947 \\u0932\\u093f\\u090f \\u0938\\u094d\\u0925\\u093e\\u0928\\u093e\\u0902\\u0924\\u0930\\u0923\",\"transfer_to_year\":\"\\u0938\\u093e\\u0932 \\u0915\\u0947 \\u0932\\u093f\\u090f \\u0938\\u094d\\u0925\\u093e\\u0928\\u093e\\u0902\\u0924\\u0930\\u0923\",\"transfer_to_semister\":\"Semister \\u0915\\u0947 \\u0932\\u093f\\u090f \\u0938\\u094d\\u0925\\u093e\\u0928\\u093e\\u0902\\u0924\\u0930\\u0923\",\"admission_no\":\"\\u090f\\u0921\\u092e\\u093f\\u0936\\u0928 \\u0928\\u0939\\u0940\\u0902\",\"remarks\":\"\\u091f\\u093f\\u092a\\u094d\\u092a\\u0923\\u093f\\u092f\\u094b\\u0902\",\"promoted\":\"\\u092a\\u094d\\u0930\\u091a\\u093e\\u0930\\u093f\\u0924\",\"detained\":\"\\u0939\\u093f\\u0930\\u093e\\u0938\\u0924 \\u092e\\u0947\\u0902 \\u0932\\u093f\\u092f\\u093e\",\"transfer\":\"\\u0939\\u0938\\u094d\\u0924\\u093e\\u0902\\u0924\\u0930\\u0923\",\"no_users_available\":\"\\u0915\\u094b\\u0908 \\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e\\u0913\\u0902 \\u0915\\u094b \\u0909\\u092a\\u0932\\u092c\\u094d\\u0927\",\"timings_set\":\"\\u0938\\u092e\\u092f \\u0928\\u093f\\u0930\\u094d\\u0927\\u093e\\u0930\\u093f\\u0924\",\"create_timetable\":\"\\u0938\\u092e\\u092f \\u0938\\u093e\\u0930\\u093f\\u0923\\u0940 \\u092c\\u0928\\u093e\\u090f\\u0902\",\"timetable_dashboard\":\"\\u0938\\u092e\\u092f \\u0938\\u093e\\u0930\\u093f\\u0923\\u0940 \\u0921\\u0948\\u0936\\u092c\\u094b\\u0930\\u094d\\u0921\",\"remove\":\"\\u0939\\u091f\\u093e\\u0928\\u093e\",\"lab\":\"\\u092a\\u094d\\u0930\\u092f\\u094b\\u0917\\u0936\\u093e\\u0932\\u093e\",\"print_timetable\":\"\\u092a\\u094d\\u0930\\u093f\\u0902\\u091f \\u0938\\u093e\\u0930\\u093f\\u0923\\u0940\",\"enter_notes\":\"\\u0928\\u094b\\u091f\\u094d\\u0938 \\u0926\\u0930\\u094d\\u091c\",\"this_will_be_displayed_bottom_of_the_timetable\":\"\\u092f\\u0939 \\u092a\\u094d\\u0930\\u0926\\u0930\\u094d\\u0936\\u093f\\u0924 \\u0938\\u092e\\u092f \\u0938\\u093e\\u0930\\u093f\\u0923\\u0940 \\u0915\\u0947 \\u0928\\u0940\\u091a\\u0947 \\u0939\\u094b \\u091c\\u093e\\u090f\\u0917\\u093e\",\"staff_list\":\"\\u0938\\u094d\\u091f\\u093e\\u092b \\u0938\\u0942\\u091a\\u0940\",\"search\":\"\\u0916\\u094b\\u091c\",\"schedule_table\":\"\\u0905\\u0928\\u0941\\u0938\\u0942\\u091a\\u0940 \\u091f\\u0947\\u092c\\u0932\",\"exam_analysis\":\"\\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e \\u0935\\u093f\\u0936\\u094d\\u0932\\u0947\\u0937\\u0923\",\"analysis_by_exam\":\"\\u0935\\u093f\\u0936\\u094d\\u0932\\u0947\\u0937\\u0923 \\u0915\\u0930\\u0915\\u0947 \\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e\",\"of\":\"\\u0915\\u093e\",\"title\":\"\\u0936\\u0940\\u0930\\u094d\\u0937\\u0915\",\"type\":\"\\u092a\\u094d\\u0930\\u0915\\u093e\\u0930\",\"dueration\":\"Dueration\",\"marks\":\"\\u0928\\u093f\\u0936\\u093e\\u0928\",\"attempts\":\"\\u092a\\u094d\\u0930\\u092f\\u093e\\u0938\",\"site_title\":\"\\u0915\\u094d\\u0937\\u0947\\u0924\\u094d\\u0930 \\u0936\\u0940\\u0930\\u094d\\u0937\\u0915\",\"children\":\"\\u092c\\u091a\\u094d\\u091a\\u0947\",\"recent_activity\":\"\\u0939\\u093e\\u0932 \\u0915\\u0940 \\u0917\\u0924\\u093f\\u0935\\u093f\\u0927\\u093f\",\"home\":\"\\u0918\\u0930\",\"faqs\":\"\\u092a\\u0942\\u091b\\u0947 \\u091c\\u093e\\u0928\\u0947 \\u0935\\u093e\\u0932\\u0947 \\u092a\\u094d\\u0930\\u0936\\u094d\\u0928\",\"about_us\":\"\\u0939\\u092e\\u093e\\u0930\\u0947 \\u092c\\u093e\\u0930\\u0947 \\u092e\\u0947\\u0902\",\"contact_us\":\"\\u0939\\u092e\\u0938\\u0947 \\u0938\\u0902\\u092a\\u0930\\u094d\\u0915 \\u0915\\u0930\\u0947\\u0902\",\"password\":\"\\u092a\\u093e\\u0938\\u0935\\u0930\\u094d\\u0921\",\"login\":\"\\u0932\\u0949\\u0917 \\u0907\\u0928 \\u0915\\u0930\\u0947\\u0902\",\"forgot_password\":\"\\u092a\\u093e\\u0938\\u0935\\u0930\\u094d\\u0921 \\u092d\\u0942\\u0932 \\u0917\\u090f\",\"register\":\"\\u0930\\u091c\\u093f\\u0938\\u094d\\u091f\\u0930\",\"quiz_categories\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928\\u094b\\u0924\\u094d\\u0924\\u0930\\u0940 \\u0936\\u094d\\u0930\\u0947\\u0923\\u093f\\u092f\\u093e\\u0901\",\"admin_dashboard\":\"\\u0935\\u094d\\u092f\\u0935\\u0938\\u094d\\u0925\\u093e\\u092a\\u0915 \\u0921\\u0948\\u0936\\u092c\\u094b\\u0930\\u094d\\u0921\",\"overall_users\":\"\\u0915\\u0941\\u0932 \\u092e\\u093f\\u0932\\u093e\\u0915\\u0930 \\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e\",\"user_details\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u0935\\u093f\\u0935\\u0930\\u0923\",\"subjects\":\"\\u0935\\u093f\\u0937\\u092f\\u094b\\u0902\",\"topics\":\"\\u0935\\u093f\\u0937\\u092f\",\"questions\":\"\\u092a\\u094d\\u0930\\u0936\\u0928\",\"roles\":\"\\u092d\\u0942\\u092e\\u093f\\u0915\\u093e\\u0913\\u0902\",\"fee_settings\":\"\\u0936\\u0941\\u0932\\u094d\\u0915 \\u0938\\u0947\\u091f\\u093f\\u0902\\u0917\",\"fee_categories\":\"\\u0936\\u0941\\u0932\\u094d\\u0915 \\u0936\\u094d\\u0930\\u0947\\u0923\\u093f\\u092f\\u093e\\u0901\",\"fee_category_allotment\":\"\\u0936\\u0941\\u0932\\u094d\\u0915 \\u0936\\u094d\\u0930\\u0947\\u0923\\u0940 \\u0906\\u092c\\u0902\\u091f\\u0928\",\"fee_particulars\":\"\\u0936\\u0941\\u0932\\u094d\\u0915 \\u092c\\u094d\\u092f\\u094c\\u0930\\u0947\",\"fee_schedules\":\"\\u0936\\u0941\\u0932\\u094d\\u0915 \\u0915\\u093e\\u0930\\u094d\\u092f\\u0915\\u094d\\u0930\\u092e\",\"fines\":\"\\u091c\\u0941\\u0930\\u094d\\u092e\\u093e\\u0928\\u093e\",\"discounts\":\"\\u091b\\u0942\\u091f\",\"subjects_master\":\"\\u0935\\u093f\\u0937\\u092f\\u094b\\u0902 \\u0915\\u0947 \\u092e\\u093e\\u0938\\u094d\\u091f\\u0930\",\"lms\":\"\\u090f\\u0932\\u090f\\u092e\\u090f\\u0938\",\"content\":\"\\u0938\\u093e\\u092e\\u0917\\u094d\\u0930\\u0940\",\"study_materials\":\"\\u0905\\u0927\\u094d\\u092f\\u092f\\u0928 \\u0938\\u093e\\u092e\\u0917\\u094d\\u0930\\u0940\",\"school_hub\":\"\\u0938\\u094d\\u0915\\u0942\\u0932 \\u0939\\u092c\",\"category\":\"\\u0935\\u0930\\u094d\\u0917\",\"is_paid\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0915\\u093f\\u092f\\u093e\",\"total_marks\":\"\\u0915\\u0941\\u0932 \\u092e\\u093e\\u0930\\u094d\\u0915\",\"update_questions\":\"\\u0938\\u0935\\u093e\\u0932 \\u0905\\u092a\\u0921\\u0947\\u091f\",\"free\":\"\\u092e\\u0941\\u0915\\u094d\\u0924\",\"paid\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0915\\u093f\\u092f\\u093e \\u0939\\u0948\",\"create_quiz\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928\\u094b\\u0924\\u094d\\u0924\\u0930\\u0940 \\u092c\\u0928\\u093e\\u090f\\u0902\",\"quiz_title\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928\\u094b\\u0924\\u094d\\u0924\\u0930\\u0940 \\u0936\\u0940\\u0930\\u094d\\u0937\\u0915\",\"enter_value_in_minutes\":\"\\u092e\\u0942\\u0932\\u094d\\u092f \\u092e\\u093f\\u0928\\u091f \\u092e\\u0947\\u0902 \\u0926\\u0930\\u094d\\u091c \\u0915\\u0930\\u0947\\u0902\",\"it_will_be_updated_by_adding_the_questions\":\"\\u092f\\u0939 \\u0938\\u0935\\u093e\\u0932 \\u091c\\u094b\\u0921\\u093c\\u0915\\u0930 \\u0905\\u0926\\u094d\\u092f\\u0924\\u0928 \\u0915\\u093f\\u092f\\u093e \\u091c\\u093e\\u090f\\u0917\\u093e\",\"pass_percentage\":\"\\u092a\\u093e\\u0938 \\u092a\\u094d\\u0930\\u0924\\u093f\\u0936\\u0924\",\"update_details\":\"\\u0905\\u0926\\u094d\\u092f\\u0924\\u0928 \\u0935\\u093f\\u0935\\u0930\\u0923\",\"lms_categories\":\"\\u090f\\u0932\\u090f\\u092e\\u090f\\u0938 \\u0936\\u094d\\u0930\\u0947\\u0923\\u093f\\u092f\\u093e\\u0901\",\"start_date\":\"\\u0906\\u0930\\u0902\\u092d \\u0915\\u0930\\u0928\\u0947 \\u0915\\u0940 \\u0924\\u093f\\u0925\\u093f\",\"end_date\":\"\\u0905\\u0902\\u0924\\u093f\\u092e \\u0924\\u093f\\u0925\\u093f\",\"url\":\"\\u092f\\u0942\\u0906\\u0930\\u090f\\u0932\",\"couponcodes\":\"Couponcodes\",\"discount\":\"\\u091b\\u0942\\u091f\",\"minimum_bill\":\"\\u0928\\u094d\\u092f\\u0942\\u0928\\u0924\\u092e \\u092c\\u093f\\u0932\",\"maximum_discount\":\"\\u0905\\u0927\\u093f\\u0915\\u0924\\u092e \\u091b\\u0942\\u091f\",\"limit\":\"\\u0939\\u0926\",\"status\":\"\\u0938\\u094d\\u0925\\u093f\\u0924\\u093f\",\"add_language\":\"\\u092d\\u093e\\u0937\\u093e \\u091c\\u094b\\u0921\\u093c\\u0947\",\"language_title\":\"\\u092d\\u093e\\u0937\\u093e \\u0936\\u0940\\u0930\\u094d\\u0937\\u0915\",\"language_code\":\"\\u092d\\u093e\\u0937\\u093e \\u0915\\u094b\\u0921\",\"supported_language_codes\":\"\\u0938\\u092e\\u0930\\u094d\\u0925\\u093f\\u0924 \\u092d\\u093e\\u0937\\u093e \\u0915\\u094b\\u0921\",\"edit_language\":\"\\u092d\\u093e\\u0937\\u093e \\u0915\\u094b \\u0938\\u0902\\u092a\\u093e\\u0926\\u093f\\u0924\",\"add_users\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u091c\\u094b\\u0921\\u093c\\u0947\\u0902\",\"create_category\":\"\\u0936\\u094d\\u0930\\u0947\\u0923\\u0940 \\u092c\\u0928\\u093e\\u090f\\u0902\",\"category_name\":\"\\u0936\\u094d\\u0930\\u0947\\u0923\\u0940 \\u0928\\u093e\\u092e\",\"please_upload_valid_image_type\":\"\\u0905\\u092a\\u0932\\u094b\\u0921 \\u0915\\u0943\\u092a\\u092f\\u093e \\u0935\\u0948\\u0927 \\u091b\\u0935\\u093f \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930\",\"edit_author\":\"\\u0932\\u0947\\u0916\\u0915 \\u0938\\u0902\\u092a\\u093e\\u0926\\u093f\\u0924 \\u0915\\u0930\\u0947\\u0902\",\"question_subjects\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928 \\u0935\\u093f\\u0937\\u092f\\u094b\\u0902\",\"add_subject\":\"\\u0935\\u093f\\u0937\\u092f \\u091c\\u094b\\u0921\\u093c\\u0928\\u0947\",\"subject\":\"\\u0935\\u093f\\u0937\\u092f\",\"view_questions\":\"\\u0938\\u0935\\u093e\\u0932\\u094b\\u0902 \\u0926\\u0947\\u0916\\u0947\\u0902\",\"subject_title\":\"\\u0935\\u093f\\u0937\\u092f \\u0936\\u0940\\u0930\\u094d\\u0937\\u0915\",\"subject_code\":\"\\u0935\\u093f\\u0937\\u092f \\u0915\\u094b\\u0921\",\"is_lab\":\"\\u092a\\u094d\\u0930\\u092f\\u094b\\u0917\\u0936\\u093e\\u0932\\u093e \\u0939\\u0948\",\"is_elective\":\"\\u0935\\u0948\\u0915\\u0932\\u094d\\u092a\\u093f\\u0915 \\u0939\\u0948\",\"maximum_marks\":\"\\u0905\\u0927\\u093f\\u0915\\u0924\\u092e \\u0905\\u0902\\u0915\",\"please_enter_valid_number\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u0935\\u0948\\u0927 \\u0938\\u0902\\u0916\\u094d\\u092f\\u093e \\u0926\\u0930\\u094d\\u091c\",\"pass_marks\":\"\\u0909\\u0924\\u094d\\u0924\\u0940\\u0930\\u094d\\u0923 \\u0905\\u0902\\u0915\",\"please_enter_valid_maximum_marks\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u092e\\u093e\\u0928\\u094d\\u092f \\u0905\\u0927\\u093f\\u0915\\u0924\\u092e \\u0905\\u0902\\u0915 \\u0926\\u0930\\u094d\\u091c\",\"please_enter_valid_pass_marks\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u092e\\u093e\\u0928\\u094d\\u092f \\u092a\\u093e\\u0938 \\u092e\\u093e\\u0930\\u094d\\u0915\\u094d\\u0938\",\"pass_marks_cannot_be_greater_than_maximum_marks\":\"\\u092a\\u093e\\u0938 \\u092e\\u093e\\u0930\\u094d\\u0915\\u094d\\u0938 \\u0905\\u0927\\u093f\\u0915\\u0924\\u092e \\u0905\\u0902\\u0915 \\u0938\\u0947 \\u0905\\u0927\\u093f\\u0915 \\u0928\\u0939\\u0940\\u0902 \\u0939\\u094b \\u0938\\u0915\\u0924\\u093e\",\"topic\":\"\\u0935\\u093f\\u0937\\u092f\",\"question\":\"\\u0938\\u0935\\u093e\\u0932\",\"difficulty\":\"\\u0915\\u0920\\u093f\\u0928\\u093e\\u0908\",\"subjects_list\":\"\\u0935\\u093f\\u0937\\u092f\\u094b\\u0902 \\u0938\\u0942\\u091a\\u0940\",\"max_marks\":\"\\u0905\\u0927\\u093f\\u0915\\u0924\\u092e \\u0905\\u0902\\u0915\",\"topics_list\":\"\\u0935\\u093f\\u0937\\u092f \\u0938\\u0942\\u091a\\u0940\",\"from_email\":\"\\u0908 - \\u092e\\u0947\\u0932 \\u0938\\u0947\",\"from_name\":\"\\u0928\\u093e\\u092e \\u0938\\u0947\",\"add_setting\":\"\\u0938\\u0947\\u091f\\u093f\\u0902\\u0917 \\u091c\\u094b\\u0921\\u093c\\u0947\\u0902\",\"edit_topic\":\"\\u0935\\u093f\\u0937\\u092f \\u0938\\u0902\\u092a\\u093e\\u0926\\u093f\\u0924 \\u0915\\u0930\\u0947\\u0902\",\"select_parent\":\"\\u091c\\u0928\\u0915 \\u0915\\u093e \\u091a\\u092f\\u0928\",\"topic_name\":\"\\u0935\\u093f\\u0937\\u092f \\u0928\\u093e\\u092e\",\"edit_template\":\"\\u0916\\u093e\\u0915\\u093e \\u0938\\u0902\\u092a\\u093e\\u0926\\u093f\\u0924 \\u0915\\u0930\\u0947\\u0902\",\"welcome\":\"\\u0938\\u094d\\u0935\\u093e\\u0917\\u0924 \\u0939\\u0947\",\"sms\":\"\\u090f\\u0938\\u090f\\u092e\\u090f\\u0938\",\" my_profile\":\"\\u092e\\u0947\\u0930\\u0940 \\u092a\\u094d\\u0930\\u094b\\u092b\\u093e\\u0907\\u0932\",\" change_password\":\"\\u092a\\u093e\\u0938\\u0935\\u0930\\u094d\\u0921 \\u092c\\u0926\\u0932\\u0947\\u0902\",\" feedback\":\"\\u092a\\u094d\\u0930\\u0924\\u093f\\u0915\\u094d\\u0930\\u093f\\u092f\\u093e\",\" notifications\":\"\\u0938\\u0942\\u091a\\u0928\\u093e\\u090f\\u0902\",\"_messages\":\"\\u0938\\u0902\\u0926\\u0947\\u0936\",\"_languages\":\"\\u092c\\u094b\\u0932\\u0940\",\"_logout\":\"\\u0932\\u094b\\u0917 \\u0906\\u0909\\u091f\",\"exams_dashboard\":\"\\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e \\u0921\\u0948\\u0936\\u092c\\u094b\\u0930\\u094d\\u0921\",\"quiz_bank\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928\\u094b\\u0924\\u094d\\u0924\\u0930\\u0940 \\u092c\\u0948\\u0902\\u0915\",\"exam-series\":\"\\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e \\u0938\\u0940\\u0930\\u0940\\u091c\",\"import_questions\":\"\\u0906\\u092f\\u093e\\u0924 \\u0938\\u0935\\u093e\\u0932\",\"single_answer\":\"\\u090f\\u0915 \\u091c\\u0935\\u093e\\u092c\",\"multi_answer\":\"\\u092e\\u0932\\u094d\\u091f\\u0940 \\u0909\\u0924\\u094d\\u0924\\u0930\",\"fill_the_blanks\":\"\\u0916\\u093e\\u0932\\u0940 \\u0938\\u094d\\u0925\\u093e\\u0928 \\u092d\\u0930\\u094b\",\"upload\":\"\\u0905\\u092a\\u0932\\u094b\\u0921\",\"question_type\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930\",\"bonafide_certificate\":\"\\u0935\\u093e\\u0938\\u094d\\u0924\\u0935\\u093f\\u0915 \\u092a\\u094d\\u0930\\u092e\\u093e\\u0923 \\u092a\\u0924\\u094d\\u0930\",\"class\":\"\\u0915\\u0915\\u094d\\u0937\\u093e\",\"purpose\":\"\\u0909\\u0926\\u094d\\u0926\\u0947\\u0936\\u094d\\u092f\",\"create_series\":\"\\u0938\\u0940\\u0930\\u0940\\u091c \\u092c\\u0928\\u093e\\u090f\\u0902\",\"duration\":\"\\u0905\\u0935\\u0927\\u093f\",\"library_users\":\"\\u092a\\u0941\\u0938\\u094d\\u0924\\u0915\\u093e\\u0932\\u092f \\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e\\u0913\\u0902\",\"first_name\":\"\\u092a\\u0939\\u0932\\u093e \\u0928\\u093e\\u092e\",\"last_name\":\"\\u0905\\u0902\\u0924\\u093f\\u092e \\u0928\\u093e\\u092e\"}', '2017-01-02 07:44:57', '2017-01-02 07:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `lessionplans`
--

CREATE TABLE `lessionplans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_subject_id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED NOT NULL,
  `is_completed` tinyint(4) NOT NULL DEFAULT '0',
  `completed_on` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `libraryassetinstances`
--

CREATE TABLE `libraryassetinstances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `library_prefix` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `series_prefix` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(50) NOT NULL,
  `library_master_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('available','issued','damaged','lost') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'available',
  `asset_type` enum('reference','staff','general') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'general',
  `record_updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `libraryassettypes`
--

CREATE TABLE `libraryassettypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_eligible_for_fine` tinyint(4) NOT NULL DEFAULT '0',
  `fine_per_day` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_having_max_fine_limit` tinyint(4) NOT NULL DEFAULT '0',
  `maximum_fine_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maximum_issuable` int(50) NOT NULL DEFAULT '2',
  `maximum_days_to_return` int(50) NOT NULL DEFAULT '7',
  `maximum_advanced_reservations` int(50) NOT NULL DEFAULT '10',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `libraryissues`
--

CREATE TABLE `libraryissues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `master_asset_id` bigint(20) UNSIGNED NOT NULL,
  `library_instance_id` bigint(20) UNSIGNED NOT NULL,
  `library_asset_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `issued_on` datetime NOT NULL,
  `due_date` date NOT NULL,
  `issue_type` enum('issue','renewal','return','lost') COLLATE utf8_unicode_ci NOT NULL,
  `is_late_returned` tinyint(4) NOT NULL DEFAULT '0',
  `days_late` int(11) NOT NULL,
  `total_file` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `paid_datetime` datetime DEFAULT NULL,
  `record_updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `return_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `librarymasters`
--

CREATE TABLE `librarymasters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_type_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `asset_belongs_to_subject` tinyint(4) NOT NULL DEFAULT '0',
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `publisher_id` bigint(20) UNSIGNED NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `edition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actual_price` decimal(10,2) NOT NULL,
  `chargible_price_if_lost` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `total_assets_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `total_assets_available` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `total_assets_issued` int(50) UNSIGNED NOT NULL DEFAULT '0',
  `total_assets_damaged` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `total_assets_lost` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `other` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lmscategories`
--

CREATE TABLE `lmscategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lmscategories`
--


-- --------------------------------------------------------

--
-- Table structure for table `lmscontents`
--

CREATE TABLE `lmscontents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `content_type` enum('file','video','audio','url','video_url','audio_url','iframe') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'file',
  `is_url` tinyint(1) NOT NULL DEFAULT '0',
  `file_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lmscontents`
--


-- --------------------------------------------------------

--
-- Table structure for table `lmsseries`
--

CREATE TABLE `lmsseries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `cost` decimal(10,2) NOT NULL,
  `validity` int(11) NOT NULL,
  `total_items` int(11) NOT NULL,
  `lms_category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lmsseries`
--


-- --------------------------------------------------------

--
-- Table structure for table `lmsseries_data`
--

CREATE TABLE `lmsseries_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lmsseries_id` bigint(20) UNSIGNED NOT NULL,
  `lmscontent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lmsseries_data`
--


-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messenger_participants`
--

CREATE TABLE `messenger_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_read` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messenger_threads`
--

CREATE TABLE `messenger_threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_06_03_064954_create_categories_table', 1),
('2016_06_03_065219_create_groups_table', 1),
('2016_06_03_065542_create_religions_table', 1),
('2016_06_03_124331_entrust_setup_tables', 1),
('2016_06_04_103906_create_staff_table', 1),
('2016_06_04_120754_create_departments_table', 1),
('2016_06_08_051533_create_subjects_table', 2),
('2016_06_08_055114_create_topics_table', 3),
('2016_06_08_060004_create_grades_table', 4),
('2016_06_08_061136_create_courses_table', 5),
('2016_06_08_061850_create_semisters_table', 5),
('2016_06_08_062918_create_academics_table', 6),
('2016_06_08_063211_create_academic_courses_table', 7),
('2016_06_08_084952_create_course_subject_table', 8),
('2016_06_08_105532_create_students_table', 9),
('2016_06_11_063359_create_feecategories_table', 10),
('2016_06_11_084226_create_feecategories_academiccours_table', 11),
('2016_06_11_133218_create_feeparticulars_table', 12),
('2016_06_13_053203_create_feeschedules_table', 13),
('2016_06_13_054213_create_feeschedules_academiccourses_table', 13),
('2016_06_15_173616_create_coursesemisters_table', 14),
('2016_06_21_071054_create_fines_table', 15),
('2016_06_21_081251_create_feediscounts_table', 16),
('2016_06_23_054631_create_questionbank_table', 17),
('2016_06_24_164447_create_libraryassettypes_table', 18),
('2016_06_25_010303_create_librarymasters_table', 19),
('2016_06_25_025855_create_authors_table', 20),
('2016_06_25_025920_create_publishers_table', 20),
('2016_06_25_142623_create_libraryassetinstances_table', 21),
('2016_06_28_052506_create_quizcategories_table', 22),
('2016_06_28_071010_create_quizzes_table', 23),
('2016_06_28_100819_create_questionbank_quizzes_table', 24),
('2016_07_02_010553_create_libraryissues_table', 24),
('2016_07_06_014807_create_lmscategories_table', 25),
('2016_07_06_033653_create_lmscontents_table', 26),
('2016_07_08_025939_create_subscriptions_table', 27),
('2014_10_28_175635_create_threads_table', 28),
('2014_10_28_175710_create_messages_table', 28),
('2014_10_28_180224_create_participants_table', 28),
('2014_11_03_154831_add_soft_deletes_to_participants_table', 28),
('2014_11_10_083449_add_nullable_to_last_read_in_participants_table', 28),
('2014_11_20_131739_alter_last_read_in_participants_table', 28),
('2014_12_04_124531_add_softdeletes_to_threads_table', 28),
('2016_07_18_091544_create_quizresults_table', 29),
('2016_07_19_102858_create_emailtemplates_table', 30),
('2016_07_20_042956_create_activity_log_table', 31),
('2016_07_27_091354_create_studentpromotions_table', 32),
('2016_07_27_120013_create_studentattendance_table', 33),
('2016_08_02_073034_create_packages_table', 34),
('2016_08_29_043256_create_settings_table', 35),
('2016_09_02_095405_create_instructions_table', 36),
('2016_09_05_091459_create_bookmarks_table', 37),
('2016_09_05_094520_create_examseries_table', 38),
('2016_09_07_105933_create_examseries_data_table', 39),
('2016_09_08_101822_create_payments_table', 40),
('2016_09_13_104746_create_couponcodes_table', 41),
('2016_09_16_160343_create_lmsseries_table', 42),
('2016_09_17_052834_create_notifications_table', 43),
('2016_09_21_105036_create_examtoppers_table', 44),
('2016_09_26_154438_create_feedbacks_table', 45),
('2016_10_13_120753_create_certifacates_table', 46),
('2016_11_08_154208_create_academicholidays_table', 47),
('2016_11_11_152540_create_subjectpreferences_table', 48),
('2016_11_11_170621_create_staffsubjectpreferences_table', 48),
('2016_11_18_102414_create_lessionplans_table', 49),
('2016_11_21_150439_create_quizapplicability_table', 50),
('2016_11_28_155556_create_certificateissues_table', 51),
('2016_11_30_150454_create_timingset_table', 52),
('2016_12_02_053525_create_timingsetdetails_table', 53),
('2016_12_02_144453_create_timingsetmap_table', 54),
('2016_12_05_181425_create_timetable_table', 55),
('2017_01_02_101856_create_modulehelper_table', 56),
('2017_01_04_181707_create_quizofflinecategories_table', 57);

-- --------------------------------------------------------

--
-- Table structure for table `modulehelper`
--

CREATE TABLE `modulehelper` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `help_link_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Help Me',
  `is_enabled` tinyint(4) NOT NULL DEFAULT '1',
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  `steps` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modulehelper`
--

INSERT INTO `modulehelper` (`id`, `title`, `slug`, `help_link_text`, `is_enabled`, `settings`, `steps`, `created_at`, `updated_at`) VALUES
(1, 'Add Academic', 'add-academic', 'Help', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1483355160447\",\"element\":\"#academic_year_title\",\"title\":\"Year Title\",\"content\":\"Academic year title\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1483358089212\",\"element\":\"#dp1\",\"title\":\"Select Start Date\",\"content\":\"Select academic year start date\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1483358142612\",\"element\":\"#dp2\",\"title\":\"Select End Date\",\"content\":\"Select academic year end date\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1484648854654\",\"element\":\".helper_step1\",\"title\":\"Show In List\",\"content\":\"Choose To The Year Should Display In,  Academic Year Selection List.\",\"placement\":\"top\",\"sort_order\":\"4\"},{\"id\":\"1484644713266\",\"element\":\".helper_step2\",\"title\":\"List\",\"content\":\"Click To See The Academic Years\",\"placement\":\"top\",\"sort_order\":\"5\"}]', '2017-01-02 06:39:45', '2017-01-17 10:28:55'),
(2, 'Users List', 'users-list', 'Help Me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1483363525771\",\"element\":\".helper_step1\",\"title\":\"Add User\",\"content\":\"Click to add user\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1483363635433\",\"element\":\"#helper_step2\",\"title\":\"View Profile\",\"content\":\"Click on user name to view profile\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1483420107566\",\"element\":\"#helper_step3\",\"title\":\"Do More\",\"content\":\"Click below to do more operations\",\"placement\":\"top\",\"sort_order\":\"3\"}]', '2017-01-02 13:15:47', '2017-01-03 05:29:03'),
(3, 'Create User', 'create-user', 'Help Me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1483421733646\",\"element\":\"#name\",\"title\":\"Name\",\"content\":\"Enter Name\",\"placement\":\"right\",\"sort_order\":\"1\"},{\"id\":\"1483421780644\",\"element\":\"#username\",\"title\":\"Username\",\"content\":\"Enter Username\",\"placement\":\"right\",\"sort_order\":\"2\"},{\"id\":\"1483421804900\",\"element\":\"#email\",\"title\":\"Email\",\"content\":\"Enter Email\",\"placement\":\"right\",\"sort_order\":\"3\"},{\"id\":\"1483421908275\",\"element\":\"#role_id\",\"title\":\"Role\",\"content\":\"Select the user role\",\"placement\":\"right\",\"sort_order\":\"4\"},{\"id\":\"1483423430397\",\"element\":\"#phone\",\"title\":\"phone\",\"content\":\"enter phone number\",\"placement\":\"right\",\"sort_order\":\"5\"},{\"id\":\"1483423500363\",\"element\":\"#address\",\"title\":\"address\",\"content\":\"enter user address\",\"placement\":\"right\",\"sort_order\":\"6\"},{\"id\":\"1483423542327\",\"element\":\"#image_input\",\"title\":\"image\",\"content\":\"upload the user image\",\"placement\":\"right\",\"sort_order\":\"7\"},{\"id\":\"1483423755786\",\"element\":\".helper_step1\",\"title\":\"all users list\",\"content\":\"to see all users\",\"placement\":\"right\",\"sort_order\":\"8\"}]', '2017-01-03 05:34:43', '2017-01-03 06:09:16'),
(4, 'Allocate Certificate', 'allocate-certificate', 'Helpme', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1483761469964\",\"element\":\"#certificate_type\",\"title\":\"Certificate Type\",\"content\":\"Select the certificate type\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1483761895748\",\"element\":\"#enter-details\",\"title\":\"Search \",\"content\":\"Search Student\",\"placement\":\"top\",\"sort_order\":\"2\"}]', '2017-01-07 03:56:50', '2017-01-17 05:51:54'),
(5, 'Quiz Category List', 'quiz-category -list', 'Helpme', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1483762708819\",\"element\":\".helper_step1\",\"title\":\"Create\",\"content\":\"click to add a category\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1483762822734\",\"element\":\"#helper_step2\",\"title\":\"Do More\",\"content\":\"Click to do more operations\",\"placement\":\"top\",\"sort_order\":\"2\"}]', '2017-01-07 04:15:29', '2017-01-07 04:23:52'),
(6, 'Create Category', 'create-quiz-category', 'Helpme', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1483763233670\",\"element\":\"#category\",\"title\":\"Name\",\"content\":\"Enter Category Name\",\"placement\":\"right\",\"sort_order\":\"1\"},{\"id\":\"1483763284879\",\"element\":\"#image_input\",\"title\":\"Image\",\"content\":\"Select the image\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1483763330904\",\"element\":\"#description\",\"title\":\"Description\",\"content\":\"Enter Description\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1483763412227\",\"element\":\".helper_step1\",\"title\":\"List\",\"content\":\"See tha all categories\",\"placement\":\"top\",\"sort_order\":\"4\"}]', '2017-01-07 04:25:22', '2017-01-07 04:30:13'),
(7, 'Offline Exams List', 'offlineexams-list', 'Helpme', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1483790037912\",\"element\":\".helper_step1\",\"title\":\"Excel\",\"content\":\"Import excel sheet\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1483790246722\",\"element\":\"#helper_step2\",\"title\":\"Particulars\",\"content\":\"Click to select exam details\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1483790297053\",\"element\":\"#helper_step3\",\"title\":\"Do More\",\"content\":\"Click to do more operations\",\"placement\":\"top\",\"sort_order\":\"3\"}]', '2017-01-07 11:53:18', '2017-01-07 11:58:17'),
(8, 'Academic Year', 'academic-year', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484644222708\",\"element\":\".helper_step1\",\"title\":\"Create\",\"content\":\"Add Academic Year\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484644395417\",\"element\":\"#helper_step2\",\"title\":\"View Branches\",\"content\":\"Click on year to view the branches\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484644436772\",\"element\":\"#helper_step3\",\"title\":\"Do More\",\"content\":\"Click to do more operations\",\"placement\":\"top\",\"sort_order\":\"3\"}]', '2017-01-17 09:06:04', '2017-01-17 09:13:58'),
(9, 'Courses List', 'courses-list', 'Helpme', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484645288983\",\"element\":\".helper_step1\",\"title\":\"Add Course\",\"content\":\"Click To Add Course\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484645326429\",\"element\":\"#helper_step2\",\"title\":\"Do More\",\"content\":\"Click To Do More Operations\",\"placement\":\"top\",\"sort_order\":\"2\"}]', '2017-01-17 09:25:53', '2017-01-17 09:30:09'),
(10, 'Add Course', 'create-course', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484645608823\",\"element\":\".helper_step1\",\"title\":\"View Courses\",\"content\":\"Click to View Courses.\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484645817343\",\"element\":\"#parent_id\",\"title\":\"Select Parent\",\"content\":\"Click To Select Parent Course. If Parent Course Is Not Avilale Select Option -Parent.\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484646049560\",\"element\":\"#course_title\",\"title\":\"Course Name\",\"content\":\"Click To Enter Course Name.\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1484646100461\",\"element\":\"#course_code\",\"title\":\"Course Code.\",\"content\":\"Click To Enter Course Code.\",\"placement\":\"top\",\"sort_order\":\"4\"},{\"id\":\"1484646231017\",\"element\":\"#course_duration\",\"title\":\"Course Dueration\",\"content\":\"Click To Select Course Dueration\",\"placement\":\"top\",\"sort_order\":\"5\"},{\"id\":\"1484646285379\",\"element\":\"#grade_system\",\"title\":\"Grade System\",\"content\":\"Click To Select Grade System\",\"placement\":\"top\",\"sort_order\":\"6\"},{\"id\":\"1484646395749\",\"element\":\".helper_step2\",\"title\":\"Choose\",\"content\":\"Choose To Course Having Semister or Not\",\"placement\":\"top\",\"sort_order\":\"7\"},{\"id\":\"1484646608236\",\"element\":\".helper_step3\",\"title\":\"Choose Electives\",\"content\":\"Choose The Course Having Electives Or Not\",\"placement\":\"top\",\"sort_order\":\"8\"},{\"id\":\"1484646662771\",\"element\":\".helper_step4\",\"title\":\"Description\",\"content\":\"Click Enter Some Description About Course\",\"placement\":\"top\",\"sort_order\":\"9\"}]', '2017-01-17 09:31:38', '2017-01-17 09:51:49'),
(11, 'Allocate Course To  Academic Year', 'allocate-course-to-academics', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484647503151\",\"element\":\".helper_step1\",\"title\":\"Academic Years\",\"content\":\"Click To View The Academic Years\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484647552794\",\"element\":\".helper_step2\",\"title\":\"Allocate Course\",\"content\":\"Drag The Courses From Course List ,To Academic Year\",\"placement\":\"top\",\"sort_order\":\"2\"}]', '2017-01-17 09:59:04', '2017-01-17 10:22:51'),
(12, 'Subjects List', 'subjects-list', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484649954620\",\"element\":\".helper_step2\",\"title\":\"Create Subject\",\"content\":\"Click To Create A Subject\",\"placement\":\"left\",\"sort_order\":\"2\"},{\"id\":\"1484650003857\",\"element\":\".helper_step1\",\"title\":\"Import\",\"content\":\"Click Import Subjects From Excel Sheet\",\"placement\":\"left\",\"sort_order\":\"1\"},{\"id\":\"1484650035964\",\"element\":\"#helper_step3\",\"title\":\"Do More\",\"content\":\"Click To Do More Operations\",\"placement\":\"left\",\"sort_order\":\"3\"}]', '2017-01-17 10:43:28', '2017-01-17 10:53:43'),
(13, 'Create Subject', 'create-subjects', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484650589096\",\"element\":\".helper_step1\",\"title\":\"Subjects List\",\"content\":\"Click To View Subjects List\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484650656766\",\"element\":\"#subject_title\",\"title\":\"Subject Title\",\"content\":\"Click To Enter Subject Title\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484650706217\",\"element\":\"#subject_code\",\"title\":\"Subject Code\",\"content\":\"Click To Enter Subject Code\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1484650886605\",\"element\":\".helper_step2\",\"title\":\"Lab Type\",\"content\":\"Choose ,The Subject Is Lab Or Not?\",\"placement\":\"top\",\"sort_order\":\"4\"},{\"id\":\"1484650953574\",\"element\":\".helper_step3\",\"title\":\"Elective Type\",\"content\":\"Choose, The Subject Is Elective Or Not?\",\"placement\":\"top\",\"sort_order\":\"5\"},{\"id\":\"1484651013134\",\"element\":\"#internal_marks\",\"title\":\"Internal Marks\",\"content\":\"Click To Enter Internal Marks\",\"placement\":\"top\",\"sort_order\":\"6\"},{\"id\":\"1484651062339\",\"element\":\"#external_marks\",\"title\":\"External Marks\",\"content\":\"Click To Enter External Marks\",\"placement\":\"top\",\"sort_order\":\"7\"},{\"id\":\"1484651125335\",\"element\":\"#maximum_marks\",\"title\":\"Maximum Marks\",\"content\":\"Click To Enter Maximum Marks\",\"placement\":\"top\",\"sort_order\":\"8\"},{\"id\":\"1484651175849\",\"element\":\"#pass_marks\",\"title\":\"Pass Marks\",\"content\":\"Click To Enter Pass Marks\",\"placement\":\"top\",\"sort_order\":\"9\"}]', '2017-01-17 10:54:54', '2017-01-17 11:06:17'),
(14, 'Allocate Subject To Course', 'allocate-subject-to-course', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484653645311\",\"element\":\".helper_step1\",\"title\":\"Courses\",\"content\":\"Click To View Courses List\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484653734854\",\"element\":\".helper_step2\",\"title\":\"Allocate Subjects\",\"content\":\"Drag The Subjects From Subject List To Course\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484654108570\",\"element\":\"#sessions\",\"title\":\"Sessions\",\"content\":\"Click To Enter Number of Classes Needed\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1484653874173\",\"element\":\".helper_step3\",\"title\":\"Update\",\"content\":\"Click To Update The List\",\"placement\":\"top\",\"sort_order\":\"4\"}]', '2017-01-17 11:43:11', '2017-01-17 11:56:21'),
(15, 'Courses List For Staff', 'courses-list-for-staff', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484654588311\",\"element\":\".helper_step1\",\"title\":\"Courses List\",\"content\":\"Add or Edit The Courses\",\"placement\":\"left\",\"sort_order\":\"1\"},{\"id\":\"1484654675870\",\"element\":\"#helper_step2\",\"title\":\"Academic Year\",\"content\":\"Click on Academic Year To Allocate Subject To Staff\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484654708424\",\"element\":\"#helper_step3\",\"title\":\"Do More\",\"content\":\"Click Here To Do More Operations\",\"placement\":\"top\",\"sort_order\":\"3\"}]', '2017-01-17 12:01:42', '2017-01-17 12:05:09'),
(16, 'Alloacate Staff To Subjects', 'allocate-staff-to-subjects', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484655088469\",\"element\":\".helper_step2\",\"title\":\"List\",\"content\":\"Click To View Academic Years For Staff Allocation\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484655177303\",\"element\":\".helper_step3\",\"title\":\"Allocate Staff\",\"content\":\"Drag The Staff From Staff List To Course Subjects\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484655222153\",\"element\":\".helper_step4\",\"title\":\"Delete\",\"content\":\"Click To Delete The Allocated Staff\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1484655272803\",\"element\":\".helper_step1\",\"title\":\"Update\",\"content\":\"Click To Update The List\",\"placement\":\"top\",\"sort_order\":\"4\"}]', '2017-01-17 12:08:09', '2017-01-17 12:15:06'),
(17, 'Topics List', 'topics-list', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484656059663\",\"element\":\".helper_step1\",\"title\":\"Add Topic\",\"content\":\"Create Topic Name\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484656198927\",\"element\":\"#helper_step3\",\"title\":\"Do More\",\"content\":\"Click Here To Do More Options\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484656246383\",\"element\":\".helper_step4\",\"title\":\"Import\",\"content\":\"Click Here To Import Topics List\",\"placement\":\"top\",\"sort_order\":\"3\"}]', '2017-01-17 12:23:04', '2017-01-17 12:31:22'),
(18, 'Create Topics', 'create-topics', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484656849524\",\"element\":\".helper_step1\",\"title\":\"Topics\",\"content\":\"Click Here To View The Topics\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484656891857\",\"element\":\"#subject\",\"title\":\"Subject\",\"content\":\"Click Here To Select The Subject\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484656989948\",\"element\":\"#parent\",\"title\":\"Parent Topic\",\"content\":\"Click Here To Select Parent Topic,If Parent Topic Is Not Available Select As Parent.\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1484657046000\",\"element\":\"#topic_name\",\"title\":\"Topic Name\",\"content\":\"Click Here To Enter Parent Name\",\"placement\":\"top\",\"sort_order\":\"4\"},{\"id\":\"1484657117811\",\"element\":\"#description\",\"title\":\"Description\",\"content\":\"Click To Enter Information About Topic\",\"placement\":\"top\",\"sort_order\":\"5\"}]', '2017-01-17 12:37:33', '2017-01-17 12:46:31'),
(19, 'Master SetupDashboard', 'mastersetup-dashboard', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484724527786\",\"element\":\".helper_step1\",\"title\":\"Academic Year\",\"content\":\"Click Here To Do Academic Mangment\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484724571459\",\"element\":\".helper_step2\",\"title\":\"Create Course\",\"content\":\"Click Here To Manage Courses List\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484724607648\",\"element\":\".helper_step3\",\"title\":\"Courses List\",\"content\":\"Click Here To View Courses List\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1484724683708\",\"element\":\".helper_step4\",\"title\":\"Subject Master\",\"content\":\"Click Here Create Subjects\",\"placement\":\"top\",\"sort_order\":\"4\"},{\"id\":\"1484724732089\",\"element\":\".helper_step5\",\"title\":\"Topics Listq\",\"content\":\"Click Here To Create Topics To Corresponding Subjects\",\"placement\":\"top\",\"sort_order\":\"5\"},{\"id\":\"1484724802692\",\"element\":\".helper_step6\",\"title\":\"Allocate To Course\",\"content\":\"Click Here To Allocate Subject ,To Course and Year\",\"placement\":\"top\",\"sort_order\":\"6\"},{\"id\":\"1484724844202\",\"element\":\".helper_step7\",\"title\":\"Allocate Staff\",\"content\":\"Click Here To Allocate Staff To Course\",\"placement\":\"top\",\"sort_order\":\"7\"}]', '2017-01-18 07:26:47', '2017-01-18 07:34:06'),
(20, 'Exams Dashboard', 'exams-dashboard', 'Helpme', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484820063234\",\"element\":\".helper_step1\",\"title\":\"Categories\",\"content\":\"Click here to manage Quiz Categories\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484820113226\",\"element\":\".helper_step2\",\"title\":\"Question Bank\",\"content\":\"Click to Create questions\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484820157271\",\"element\":\".helper_step3\",\"title\":\"Quizzes\",\"content\":\"Click here to manage Quizzes\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1484820217628\",\"element\":\".helper_step4\",\"title\":\"Offline Quiz Categories\",\"content\":\"Click to manage offline quiz categories\",\"placement\":\"top\",\"sort_order\":\"4\"},{\"id\":\"1484820259113\",\"element\":\".helper_step5\",\"title\":\"Exam Series\",\"content\":\"Click to manage exam series\",\"placement\":\"top\",\"sort_order\":\"5\"},{\"id\":\"1484820308086\",\"element\":\".helper_step6\",\"title\":\"Instructions\",\"content\":\"Click to manage instructions\",\"placement\":\"top\",\"sort_order\":\"6\"}]', '2017-01-19 09:59:35', '2017-01-19 10:05:09'),
(21, 'Exams Instructions', 'exams-instructions-list', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484823960618\",\"element\":\".helper_step1\",\"title\":\"Add Instruction\",\"content\":\"Click here to create instruction\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484823992631\",\"element\":\"#helper_step2\",\"title\":\"Do more\",\"content\":\"Click here to do more operations\",\"placement\":\"top\",\"sort_order\":\"2\"}]', '2017-01-19 11:05:14', '2017-01-19 11:06:48'),
(22, 'Add Instruction', 'add-instruction', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '', '2017-01-19 11:08:29', '2017-01-19 11:08:29'),
(23, 'Offline Exams Categories', 'list', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484887174961\",\"element\":\".helper_step1\",\"title\":\"Add Category\",\"content\":\"Click to create category\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484887211616\",\"element\":\"#helper_step2\",\"title\":\"Do more\",\"content\":\"Click here to do more operations\",\"placement\":\"top\",\"sort_order\":\"2\"}]', '2017-01-20 04:38:50', '2017-01-20 04:40:13'),
(24, 'Create Offline Exams Categories', 'create-category', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484887761531\",\"element\":\".helper_step1\",\"title\":\"View Categories\",\"content\":\"Click here to view categories\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484887817336\",\"element\":\"#title\",\"title\":\"Title\",\"content\":\"Click to enter Category Name\",\"placement\":\"top\",\"sort_order\":\"2\"}]', '2017-01-20 04:41:40', '2017-01-20 04:50:18'),
(25, 'Quizzes List', 'quiz-list', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484891026208\",\"element\":\".helper_step1\",\"title\":\"Add Quiz\",\"content\":\"Click to create Quiz\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484891073119\",\"element\":\".helper_step2\",\"title\":\"Exam Series\",\"content\":\"Click to view exam series\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484891124778\",\"element\":\"#helper_step3\",\"title\":\"Add Questions\",\"content\":\"Click on title to add questions for particular quiz\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1484891163681\",\"element\":\"#helper_step4\",\"title\":\"Do more\",\"content\":\"Click here to do more operations\",\"placement\":\"top\",\"sort_order\":\"4\"}]', '2017-01-20 05:41:56', '2017-01-20 05:46:05'),
(26, 'SMS Settings', 'sms_settings', 'sms-settings', 0, '{\"sms_driver\":{\"value\":\"nexmo\",\"type\":\"select\",\"extra\":{\"total_options\":\"3\",\"options\":{\"nexmo\":\"NEXMO\",\"plivo\":\"PLIVO\",\"twilio\":\"TWILIO\"}},\"tool_tip\":\"Select SMS driver\"},\"nexmo_key\":{\"value\":\"NEXMO_KEY\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"nexmo\":\"NEXMO\",\"plivo\":\"PLIVO\",\"twilio\":\"TWILIO\"}},\"tool_tip\":\"Nexmo API Key\"},\"nexmo_secret\":{\"value\":\"NEXMO_SECRET\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"nexmo\":\"NEXMO\",\"plivo\":\"PLIVO\",\"twilio\":\"TWILIO\"}},\"tool_tip\":\"Enter Nexmo Secret Key\"},\"plivo_auth_id\":{\"value\":\"PLIVO_AUTH_ID\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"nexmo\":\"NEXMO\",\"plivo\":\"PLIVO\",\"twilio\":\"TWILIO\"}},\"tool_tip\":\"Enter Plivo Auth ID\"},\"plivo_auth_token\":{\"value\":\"PLIVO_AUTH_TOKEN\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"nexmo\":\"NEXMO\",\"plivo\":\"PLIVO\",\"twilio\":\"TWILIO\"}},\"tool_tip\":\"Plivo Auth Token\"},\"twilio_sid\":{\"type\":\"text\",\"value\":\"TWILIO_SID\",\"extra\":\"\",\"tool_tip\":\"Twilio SID\"},\"twilio_token\":{\"type\":\"text\",\"value\":\"TWILIO_TOKEN\",\"extra\":\"\",\"tool_tip\":\"Twilio Token\"}}', 'Contains settings for SMS', '2017-01-25 05:10:09', '2017-01-25 05:30:16'),
(27, 'Users Dashboard', 'users-dashborad-list', 'Help me', 1, '{\"keyboard\":1,\"backdrop\":1}', '[{\"id\":\"1484907068366\",\"element\":\".helper_step1\",\"title\":\"Owner\",\"content\":\"Click to view owners list\",\"placement\":\"top\",\"sort_order\":\"1\"},{\"id\":\"1484907100291\",\"element\":\".helper_step2\",\"title\":\"Admin\",\"content\":\"Click to view admins list\",\"placement\":\"top\",\"sort_order\":\"2\"},{\"id\":\"1484907141873\",\"element\":\".helper_step3\",\"title\":\"Students\",\"content\":\"Click to view students list\",\"placement\":\"top\",\"sort_order\":\"3\"},{\"id\":\"1484907161016\",\"element\":\".helper_step4\",\"title\":\"Staff\",\"content\":\"Click to view staff list\",\"placement\":\"top\",\"sort_order\":\"4\"},{\"id\":\"1484907190222\",\"element\":\".helper_step5\",\"title\":\"Librarians\",\"content\":\"Click to view librarians list\",\"placement\":\"top\",\"sort_order\":\"5\"},{\"id\":\"1484907245638\",\"element\":\".helper_step6\",\"title\":\"Assistant Librarian\",\"content\":\"Click to view Assistant Librarians list\",\"placement\":\"top\",\"sort_order\":\"6\"},{\"id\":\"1484907279273\",\"element\":\".helper_step7\",\"title\":\"Parents\",\"content\":\"Click to view parents list\",\"placement\":\"top\",\"sort_order\":\"7\"},{\"id\":\"1484907301656\",\"element\":\".helper_step8\",\"title\":\"All Users\",\"content\":\"Click to view all users list\",\"placement\":\"top\",\"sort_order\":\"8\"},{\"id\":\"1484907331522\",\"element\":\".helper_step9\",\"title\":\"Add  User\",\"content\":\"Click here to Create User\",\"placement\":\"top\",\"sort_order\":\"9\"}]', '2017-01-20 10:08:51', '2017-01-20 10:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valid_from` date NOT NULL,
  `valid_to` date NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parenttimingsetmap`
--

CREATE TABLE `parenttimingsetmap` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `particulars`
--

CREATE TABLE `particulars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_income` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `particulars`
--


-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `plan_type` enum('combo','lms','exam','other') COLLATE utf8_unicode_ci NOT NULL,
  `payment_gateway` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid_by_parent` tinyint(1) NOT NULL DEFAULT '0',
  `paid_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `coupon_applied` tinyint(4) NOT NULL DEFAULT '0',
  `coupon_id` int(11) NOT NULL,
  `actual_cost` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `after_discount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_details` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_record` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `admin_comments` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publisher` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionbank`
--

CREATE TABLE `questionbank` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED NOT NULL,
  `question_tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question_type` enum('radio','checkbox','descriptive','blanks','match','para','video','audio') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'radio',
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `question_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question_file_is_url` tinyint(1) NOT NULL DEFAULT '0',
  `total_answers` int(10) UNSIGNED NOT NULL,
  `answers` text COLLATE utf8_unicode_ci NOT NULL,
  `total_correct_answers` int(50) NOT NULL DEFAULT '1',
  `correct_answers` text COLLATE utf8_unicode_ci NOT NULL,
  `marks` int(10) UNSIGNED NOT NULL,
  `time_to_spend` int(11) NOT NULL DEFAULT '1',
  `difficulty_level` enum('easy','medium','hard') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'easy',
  `hint` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `explanation` text COLLATE utf8_unicode_ci NOT NULL,
  `explanation_file` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questionbank`
--


-- --------------------------------------------------------

--
-- Table structure for table `questionbank_quizzes`
--

CREATE TABLE `questionbank_quizzes` (
  `id` int(10) UNSIGNED NOT NULL,
  `questionbank_id` bigint(20) UNSIGNED NOT NULL,
  `quize_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `marks` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizapplicability`
--

CREATE TABLE `quizapplicability` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `course_parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) UNSIGNED NOT NULL,
  `semister` int(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizcategories`
--

CREATE TABLE `quizcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizofflinecategories`
--

CREATE TABLE `quizofflinecategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizresults`
--

CREATE TABLE `quizresults` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `marks_obtained` int(10) NOT NULL DEFAULT '0',
  `negative_marks` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_marks` int(10) NOT NULL DEFAULT '0',
  `percentage` decimal(10,2) NOT NULL,
  `exam_status` enum('pass','fail','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `answers` text COLLATE utf8_unicode_ci NOT NULL,
  `subject_analysis` text COLLATE utf8_unicode_ci,
  `correct_answer_questions` text COLLATE utf8_unicode_ci,
  `wrong_answer_questions` text COLLATE utf8_unicode_ci,
  `not_answered_questions` text COLLATE utf8_unicode_ci,
  `time_spent_correct_answer_questions` text COLLATE utf8_unicode_ci NOT NULL,
  `time_spent_wrong_answer_questions` text COLLATE utf8_unicode_ci NOT NULL,
  `time_spent_not_answered_questions` text COLLATE utf8_unicode_ci NOT NULL,
  `percentage_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade_points` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(11) DEFAULT NULL,
  `total_users_for_this_quiz` int(11) DEFAULT NULL,
  `academic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `year` int(11) NOT NULL,
  `semister` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('online','offline') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'online',
  `offline` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `online` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dueration` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `cost` decimal(10,2) DEFAULT NULL,
  `validity` int(11) NOT NULL,
  `total_marks` int(20) UNSIGNED NOT NULL DEFAULT '0',
  `having_negative_mark` tinyint(1) NOT NULL DEFAULT '0',
  `negative_mark` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pass_percentage` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publish_results_immediately` tinyint(4) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `total_questions` int(50) NOT NULL,
  `instructions_page_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `applicable_to_specific` tinyint(1) NOT NULL DEFAULT '0',
  `offline_quiz_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `religion_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'Owner', 'Owner of this account', '2016-06-08 03:32:59', '2016-06-08 03:32:59'),
(2, 'admin', 'Admin', 'Admin of this Account', '2016-06-08 03:33:19', '2016-06-08 03:33:19'),
(3, 'staff', 'Staff', 'Staff User', '2016-11-04 23:44:22', '2016-11-04 23:44:22'),
(5, 'student', 'Student', 'Student User', '2016-06-08 04:01:54', '2016-06-08 04:01:54'),
(6, 'parent', 'Parent User', 'Parent Login', '2016-06-08 07:35:27', '2016-06-08 07:35:27'),
(7, 'librarian', 'Librarian', 'Library User', '2016-12-05 18:30:00', '2016-12-05 18:30:00'),
(8, 'assistant_librarian', 'Assistant Librarian', 'Assistant Librarian', '2016-12-07 01:45:12', '2016-12-07 01:45:12'),
(9, 'clerk', 'Clerk', 'Clerk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `semisters`
--

CREATE TABLE `semisters` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `course_id` bigint(11) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `total_semisters` int(11) NOT NULL,
  `semister_prefix` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `settings_data` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `key`, `slug`, `image`, `settings_data`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Email Settings', 'email_settings', 'email-settings', '', '{\"mail_driver\":{\"value\":\"smtp\",\"type\":\"select\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Driver\"},\"mail_host\":{\"value\":\"adiyya@gmail.com\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Host\"},\"mail_port\":{\"value\":\"21\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Port no\"},\"mail_username\":{\"value\":\"adiyya\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Username\"},\"mail_password\":{\"value\":\"123456\",\"type\":\"password\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Password\"},\"mail_encryption\":{\"value\":\"null\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Encryption\"}}', 'Contains all the settings related to emails', '2016-08-28 23:55:26', '2017-05-15 05:58:53'),
(4, 'Paypal Settings', 'paypal', 'paypal', '', '{\"email\":{\"value\":\"adiyya@gmail.com\",\"type\":\"email\",\"extra\":\"\",\"tool_tip\":\"Paypal Email\"},\"currency\":{\"value\":\"USD\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Default Currency\"},\"image\":{\"value\":\"gYiMM9e5g3H40dz.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Image to display at Paypal payment gateway\"},\"account_type\":{\"value\":\"sandbox\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"sandbox\":\"Sandbox\",\"live\":\"Live\"}},\"tool_tip\":\"Account Type Development (sandbox)\\/ Production (live)\"}}', 'Contains paypal config details', '2016-09-08 03:38:30', '2017-05-09 06:48:37'),
(5, 'PayU Settings', 'payu', 'payu', '', '{\"payu_merchant_key\":{\"value\":\"YOUR_PAYU_MERCHANT_KEY\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"PayU Merchent Key\"},\"payu_salt\":{\"value\":\"YOUR_PAYU_SALT\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"PayU Salt\"},\"payu_working_key\":{\"value\":\"YOUR_PAYU_WORKING_KEY\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"PayU Working Key\"},\"payu_testmode\":{\"value\":\"true\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"true\":\"Yes\",\"false\":\"No\"}},\"tool_tip\":\"Set PayU in Test Mode\"}}', 'Payu Settings', '2016-09-09 01:25:33', '2017-03-01 10:23:56'),
(6, 'Site Settings', 'site_settings', 'site-settings', '', '{\"site_title\":{\"value\":\"Menorah Academy System\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Site Title\"},\"login_page_title\":{\"value\":\"CST Management System\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Type Of Education System\"},\"site_logo\":{\"value\":\"l6kTPaR9jaifyoe.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Site Logo\"},\"site_address\":{\"value\":\"8929 Fremont Court \\r\\nMchenry, \\r\\nIL 60050\\r\\n\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Address\"},\"site_city\":{\"value\":\"Hyderabad\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"City\"},\"site_favicon\":{\"value\":\"FppoAuCMi7uXLIT.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Favicon\"},\"site_state\":{\"value\":\"Telangana\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"State\"},\"site_country\":{\"value\":\"India\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Country\"},\"site_zipcode\":{\"value\":\"500018\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Postal Code\"},\"site_phone\":{\"value\":\"9999988888\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Phone\"},\"system_timezone\":{\"value\":\"Asia\\/Kolkata\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Refer http:\\/\\/php.net\\/manual\\/en\\/timezones.php\"},\"background_image\":{\"value\":\"khdGHPReGFDSq9C.jpg\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Front background image\"},\"default_academic_year_id\":{\"value\":\"4\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Enter default academic year\"},\"default_parent_course_id\":{\"value\":\"6\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Enter default parent course ID\"},\"education_system_in_spring_and_fall_mode\":{\"value\":\"no\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"yes\":\"Yes\",\"no\":\"No\"}},\"tool_tip\":\"Select theme\"},\"current_theme\":{\"value\":\"default\",\"type\":\"select\",\"extra\":{\"total_options\":\"3\",\"options\":{\"default\":\"Default Theme\",\"red\":\"Red Theme\",\"green\":\"Green Theme\"}},\"tool_tip\":\"Select theme\"},\"currency_symbol\":{\"value\":\"$\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"default\":\"Default Theme\",\"red\":\"Red Theme\",\"green\":\"Green Theme\"}},\"tool_tip\":\"Add your currency symbol\"}}', 'Here you can manage the title, logo, favicon and all general settings', '2016-09-29 06:46:54', '2017-07-03 07:44:24'),
(7, 'Seo Settings', 'seo_settings', 'seo-settings-1', '', '{\"meta_description\":{\"type\":\"textarea\",\"value\":\"This is a online examination system\",\"extra\":\"\",\"tool_tip\":\"Site Meta Description\"},\"meta_keywords\":{\"type\":\"textarea\",\"value\":\"Exam system|exam|exams\",\"extra\":\"\",\"tool_tip\":\"Site Meta Keywords\"},\"google_analytics\":{\"type\":\"textarea\",\"value\":\"<!-- Google Analytics -->\\r\\n<script>\\r\\n(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){\\r\\n(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\\r\\nm=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\\r\\n})(window,document,\'script\',\'https:\\/\\/www.google-analytics.com\\/analytics.js\',\'ga\');\\r\\n\\r\\nga(\'create\', \'UA-XXXXX-Y\', \'auto\');\\r\\nga(\'send\', \'pageview\');\\r\\n<\\/script>\\r\\n<!-- End Google Analytics -->\",\"extra\":\"\",\"tool_tip\":\"Update your google analytics code\"}}', 'Contains all SEO settings', '2016-09-30 13:33:46', '2016-10-31 07:42:45'),
(8, 'Payment Gateways', 'payment_gateways', 'payment-gateways', '', '{\"offline_payment_information\":{\"value\":\"1) Pay the amount through DD\\/Check\\/Deposit in favor of Admin, Academia, India <br\\/>\\r\\n2) Update the Payment information in the below box <br\\/>\\r\\n3) Admin will validate the payment details and update your subscription <br\\/>\",\"type\":\"textarea\",\"extra\":{\"total_options\":\"2\",\"options\":{\"enable\":\"Enable\",\"disable\":\"Disable\"}},\"tool_tip\":\"Information related to offline payment\"}}', 'Contains all list of payment gateways in the system and the status of availability ', '2016-10-02 09:48:19', '2016-10-20 07:07:53'),
(9, 'Modules Management', 'module', 'module', '', '{\"payu\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable PayU Payment Gateway\"},\"paypal\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Paypal Payment Gateway\"},\"messaging\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Messaging Module\"},\"parent\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Parent Module\"},\"coupons\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Coupons Module\"},\"offline_payment\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Offline Payment Option\"},\"push_notifications\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Push Notifications\"},\"certificate\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Certificate Module\"},\"show_foreign_key_constraint\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"sho foreign key constraint message at delete operation\"},\"facebook_login\":{\"value\":0,\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Facebook Login\"},\"google_plus_login\":{\"value\":0,\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Google+ Login\"}}', 'You can enable or disable modules in the system', '2016-10-12 11:36:22', '2017-06-05 02:35:50'),
(11, 'Certificate', 'certificate', 'certificate', '', '{\"logo\":{\"value\":\"Yv7CQJWc663SUlR.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Header logo of certificate\"},\"content\":{\"value\":\"<span style=\\\"font-size:18px; font-style:italic;\\\">This is to certify that <b style=\\\"padding:0 10px; font-size:22px;\\\">{{$username}}<\\/b> Lorem Ipsum is simply dummy text <b style=\\\"padding:0 10px; font-size:22px;\\\">{{$course_name}}<\\/b> of the printing with score of <b style=\\\"padding:0 10px; font-size:22px;\\\">{{$marks}}<\\/b> and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took<\\/span>\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Content for the certificate\"},\"left_sign_image\":{\"value\":\"CbWZkuET6ivwbH9.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Left Sign Image\"},\"right_sign_image\":{\"value\":\"ITKaR4FJcEp8blq.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Right Sign Image\"},\"left_sign_name\":{\"value\":\"Prabhakar\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Left Sign Name\"},\"right_sign_name\":{\"value\":\"Jackk\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Right Sign Name\"},\"left_sign_designation\":{\"value\":\"Course Teacher\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Left Sign Designation\"},\"right_sign_designation\":{\"value\":\"Admin\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Right Sign Designation\"},\"watermark_image\":{\"value\":\"Ui7rcIVz6XFliHA.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Water Mark Image for transparent background\"},\"bottom_middle_logo\":{\"value\":\"Xnbf7A5pUDnseoH.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Bottom middle logo\"}}', 'This Module contains the settings for Certificate', '2016-10-13 06:57:36', '2017-03-01 10:22:10'),
(12, 'Social Logins', 'social_logins', 'social-logins', '', '{\"facebook_client_id\":{\"value\":\"649337055234832\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Facebook Client ID\"},\"facebook_client_secret\":{\"value\":\"5a67e2912d64971af65c4c05b0c6b2ae\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Facebook Client Secret\"},\"facebook_redirect_url\":{\"value\":\"http:\\/\\/conquerorslabs.com\\/exam2\\/auth\\/facebook\\/callback\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"It should be http (or) https:\\/\\/yourservername\\/auth\\/google\\/callback\"},\"google_client_id\":{\"value\":\"881078848150-i20jdtp5g3pg9i2p4tgts4ao5i1ja6cv.apps.googleusercontent.com\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Google Plus Client ID\"},\"Google_client_secret\":{\"value\":\"ndH8wRWVaB6Mv6pICFRPIhJr\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Google Client Secret Key\"},\"google_redirect_url\":{\"value\":\"http:\\/\\/conquerorslabs.com\\/exam2\\/auth\\/google\\/callback\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"http (or) https:\\/\\/yourserver.com\\/auth\\/google\\/callback\"}}', 'Add/Update Settings for Social Logins (Facebook and Google plus)', '2016-10-28 10:56:37', '2016-10-28 06:12:05'),
(13, 'Messaging System', 'messaging_system', 'messaging-system', '', '{\"messaging_system_for\":{\"value\":\"admin_student_staff\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"all\":\"All\",\"admin\":\"Admin and Student\",\"admin_student_staff\":\"Admin, Staff and Student\"}},\"tool_tip\":\"To whome you want to use this system\"}}', '', '2016-10-29 11:03:37', '2017-05-10 06:38:46'),
(14, 'Time Table', 'time_table', 'time-table', '', '{\"start_time\":{\"value\":\"9\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Enter the strat time to be shown in timetable management\"},\"end_time\":{\"value\":\"18\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Enter the end time to be shown in timetable management\"},\"default_sessions_needed\":{\"value\":\"60\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Default sessions needed at subject allocation\"}}', 'These will be used in timetable management', '2016-11-30 12:39:07', '2017-01-31 08:49:44'),
(15, 'Library Settings', 'library_settings', 'library-settings', '', '{\"maximum_issues_student\":{\"value\":\"2\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Maximum issues for student\"},\"maximum_issues_staff\":{\"value\":\"4\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Maximum Issues for Staff\"},\"maximum_days_to_return_student\":{\"value\":\"4\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Student maximum days to return\"},\"maximum_days_to_return_staff\":{\"value\":\"6\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Staff maximum days to retrun\"},\"library_series_prefix\":{\"value\":\"LIB\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Serial number prefix like college code\"},\"library_series_number_length\":{\"value\":\"3\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Length of series number\"}}', 'Contains all Library Settings', '2016-12-08 06:54:53', '2017-01-21 05:31:05'),
(16, 'Bonafide certificate settings', 'bonafide_settings', 'bonafide-settings', '', '{\r\n\r\n  \"print_header\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Print or ignore header\"\r\n  },\r\n  \"print_footer\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Print or ignore footer\"\r\n  },\r\n  \"print_date\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Print or ignore date on certificate\"\r\n },\r\n  \"print_reference_number\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Print or ignore reference number\"\r\n  },\r\n  \"right_sign_image\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show right sign image\"\r\n },\r\n  \"right_side_name\": {\r\n    \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show right side name\"\r\n  },\r\n  \"right_side_designation\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show right side designation\"\r\n },\r\n  \"show_watermark\": {\r\n   \"value\": 0,\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show watermark image\"\r\n  }\r\n}', 'Bonanide Certificate settings for printing options, certificate layouts etc', '2017-01-05 10:00:35', '2017-02-03 09:37:37'),
(17, 'Bonafide certificate content', 'bonafide_content', 'bonafide-content', '', '{\"logo\":{\"value\":\"GA9dwNccezqBMD1.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Certificate Logo\"},\"content\":{\"value\":\"   <td align=\\\"left\\\" style=\\\"padding: 5px 10px;  font-size:16px;\\\">\\r\\n            <p style=\\\"font-size: 16px; color: #333; line-height:30px;\\\">This is to certify that <strong style=\\\"font-size:18px; color:#007cff\\\"><u><i>{{$name}}<\\/i><\\/u><\\/strong> {{$child_title}} of {{$fathers_name}} residing at {{$address}} is a bonafide student of our school studying in\\r\\n\\r\\n             <strong style=\\\"font-size:18px; color:#007cff\\\"><u><i> {{$course_title}}<\\/i><\\/u><\\/strong>.<\\/p>\\r\\n            <p style=\\\"font-size: 16px; color: #333; line-height:30px;\\\"> {{$gender_title}} was very obedient, sincere and hardworking. {{$gender_title}} bears a good moral character.<\\/p>\\r\\n\\r\\n        <\\/td>\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Content of the certificate\"},\"right_designation\":{\"value\":\"Principal\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Right side designation name\"},\"right_side_name\":{\"value\":\"Jack\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Right side display name\"},\"right_side_sign\":{\"value\":\"ufhwpHyrlHTjqMf.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Right side sign image\"},\"watermark_image\":{\"value\":\"bZmdD5tB5E5IqtL.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Upload watermark image\"}}', 'This module contains the content and settings for bonafide certificate', '2017-01-05 10:38:31', '2017-03-01 10:23:13'),
(18, 'Transfer certificate fields', 'transfer_certificate_fields', 'transfer-certificate-fields', '', '{\"name_of_student\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display Name Of The Pupil\"},\"father_guardian_name\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display fathername \\/ Guardian name\"},\"mother_name\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display mother name\"},\"nationality\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display nationality\"},\"candidate_caste\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display caste\"},\"date_of_admission_with_class\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display date of join, class\"},\"date_of_birth\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display date of birth\"},\"last_class_studied\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Dispaly last studied class\"},\"last_taken_exam_and_result\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display board exam result\"},\"whether_failed_if_once_twice_in_the_same_class\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Dispaly Failed exam status\"},\"promotion_class\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Dispaly promotion class\"},\"total_working_days\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Total working days of year\"},\"total_present_days\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display present days\"},\"ncc_boy_scout_girls_guide\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Diaplay NCC or Scout or Guide details\"},\"games_played_or_extra_curricular_activities\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display other activities\"},\"general_conduct\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display conduct\"},\"date_of_apply\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Dispaly apply date\"},\"date_of_issue\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display issue date\"},\"reason\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display reason \"},\"remarks\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Dispaly remarks\"},\"first_admission_in_the_school\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Display First Admission in the schol\"}}', 'This module holds the management of the fields to display on the certificate', '2017-01-05 13:31:07', '2017-02-10 18:38:35'),
(19, 'Transfer certificate settings', 'transfer_certificate_settings', 'transfer-certificate-settings', '', '{\r\n\r\n  \"print_header\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Print header\"\r\n  },\r\n  \"print_footer\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Print footer\"\r\n  },\r\n  \"print_date\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Print date\"\r\n  },\r\n  \"print_reference_number\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Print reference number\"\r\n  },\r\n  \"show_left_side_name\": {\r\n    \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show left side name\"\r\n },\r\n  \"show_left_side_designation\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show left side designation\"\r\n  },\r\n  \"show_left_side_sign\": {\r\n    \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show left side image\"\r\n  },\r\n  \"show_middle_name\": {\r\n   \"value\": 0,\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show middle name\"\r\n  },\r\n  \"show_middle_designation\": {\r\n    \"value\": 0,\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show middle designation\"\r\n },\r\n  \"show_middle_sign\": {\r\n   \"value\": 0,\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show middle sign\"\r\n  },\r\n  \"show_right_side_name\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show right side name\"\r\n  },\r\n  \"show_right_side_designation\": {\r\n    \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"show right side designation\"\r\n },\r\n  \"show_right_side_sign\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show right side sign\"\r\n  },\r\n  \"show_watermark\": {\r\n   \"value\": \"1\",\r\n   \"type\": \"checkbox\",\r\n   \"extra\": {\r\n      \"total_options\": \"2\",\r\n     \"options\": {\r\n        \"1\": \"Show in browser\",\r\n       \"0\": \"Download file\"\r\n      }\r\n   },\r\n    \"tool_tip\": \"Show watermark\"\r\n  }\r\n}', 'This module holds the settings part for transfer certificate. The settings like printing options', '2017-01-06 04:29:52', '2017-03-30 07:04:26'),
(20, 'ID Cards Settings', 'id_card_settings', 'id-card-settings', '', '{\"top_logo\":{\"value\":\"Rou5cwCgNZKWSi9.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Upload logo\"},\"select_template\":{\"value\":\"template_2\",\"type\":\"select\",\"extra\":{\"total_options\":\"3\",\"options\":{\"template_1\":\"Template 1\",\"template_2\":\"Template 2\"}},\"tool_tip\":\"Select template\"},\"template_1_logo\":{\"value\":\"MdDQlAizGCSc5gS.png\",\"type\":\"file\",\"extra\":{\"total_options\":\"3\",\"options\":{\"template_1\":\"Template 1\",\"template_2\":\"Template 2\"}},\"tool_tip\":\"Logo for template 1\"},\"institute_title\":{\"value\":\"Menorah School\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"template_1\":\"Template 1\",\"template_2\":\"Template 2\"}},\"tool_tip\":\"Title of the institute to display on top\"},\"institute_address\":{\"value\":\"2014 Illinois Avenue  |   503-752-2429\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"template_1\":\"Template 1\",\"template_2\":\"Template 2\"}},\"tool_tip\":\"Institute address\"}}', 'This is used to setting the id card logo and address in idcard', '2017-01-07 06:09:36', '2017-05-17 07:04:05'),
(21, 'ID Card Fields', 'id_card_fields', 'id-card-fields', '', '{\"front_first_item_title\":{\"value\":\"Roll Number\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Front first item title\"},\"front_second_item_title\":{\"value\":\"Roll No\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Second item title\"},\"front_third_item_title\":{\"value\":\"Name\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Third item title\"},\"front_fourth_item_title\":{\"value\":\"Course\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Fourth item title\"},\"front_fifth_item_title\":{\"value\":\"Addr\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Fifth item title\"},\"front_sixth_item_title\":{\"value\":\"Blood Grp\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Sixth item title\"},\"front_seventh_item_title\":{\"value\":\"Emergency\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Seventh item title\"},\"front_first_item\":{\"value\":\"roll_no\",\"type\":\"select\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"First Item to display\"},\"front_second_item\":{\"value\":\"skip\",\"type\":\"select\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Second Item to display\"},\"front_third_item\":{\"value\":\"name\",\"type\":\"select\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Third Item to display\"},\"front_fourth_item\":{\"value\":\"course_title\",\"type\":\"select\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Fourth Item to display\"},\"front_fifth_item\":{\"value\":\"address_small\",\"type\":\"select\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Fifth Item to display\"},\"front_sixth_item\":{\"value\":\"blood_group\",\"type\":\"select\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Sixth Item to display\"},\"front_seventh_item\":{\"value\":\"home_phone\",\"type\":\"select\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Seventh Item to display\"},\"back_first_item_title\":{\"value\":\"Our Office\",\"type\":\"text\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Back first item title\"},\"back_first_item_text\":{\"value\":\"13-9-1\\/3\\/38 radhakrishna nagar zesh colony east maradpally hitech chit Hyderabad\",\"type\":\"text\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Back first item text\"},\"back_second_item_title\":{\"value\":\"Phone\",\"type\":\"text\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Back second title\"},\"back_second_item_text\":{\"value\":\"+91 9030046673, <br> +91 1234567891\",\"type\":\"text\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Second text\"},\"back_third_item_title\":{\"value\":\"Email\",\"type\":\"text\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Back third item title\"},\"back_third_item_text\":{\"value\":\"youremail@youremail.com <br> myemail@myemail.com\",\"type\":\"text\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Back third item text\"},\"back_fourth_item_title\":{\"value\":\"Website\",\"type\":\"text\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Back fourth item title\"},\"back_fourth_item_text\":{\"value\":\"www.google.com\",\"type\":\"text\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Back fourth item text\"},\"front_total_fields\":{\"value\":\"7\",\"type\":\"number\",\"extra\":{\"total_options\":\"15\",\"options\":{\"skip\":\"Skip\",\"admission_no\":\"Admission No.\",\"roll_no\":\"Roll No.\",\"name\":\"Name\",\"course_title\":\"Course Information\",\"fathers_name\":\"Fathers Name\",\"date_of_birth\":\"DOB\",\"address_full\":\"Address-Lane, City, State\",\"address_middle\":\"Address-Lane, City\",\"address_small\":\"Address-City, State\",\"gender\":\"Gender\",\"blood_group\":\"Blood Group\",\"email\":\"Email\",\"validity\":\"Validity information\",\"mobile\":\"Mobile Number\",\"home_phone\":\"Home Phone number\"}},\"tool_tip\":\"Enter first n fields to display on front\"}}', 'With this module you can manage the contents order and items on ID card', '2017-01-07 07:51:13', '2017-04-05 13:58:04'),
(22, 'Fee Settings', 'fee_settings', 'fee-setings', NULL, '{\"fee_terms\":{\"value\":\"3\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Enter Total Fee Terms\"},\"tc_will_give_if_fee_is_pending\":{\"value\":\"no\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"yes\":\"Yes\",\"no\":\"No\"}},\"tool_tip\":\"Select Option\"}}', 'All Fee Settings Data', NULL, '2017-07-06 23:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_parent_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `job_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_join` date DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` enum('single','married','divorced') COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fathers_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mothers_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mother_tongue` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address_lane1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_lane2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_experience_years` int(11) NOT NULL,
  `total_experience_month` int(11) NOT NULL,
  `experience_information` text COLLATE utf8_unicode_ci NOT NULL,
  `other_information` text COLLATE utf8_unicode_ci NOT NULL,
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  `extra_fields` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentattendance`
--

CREATE TABLE `studentattendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `roll_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `course_parent_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `semester` bigint(20) UNSIGNED NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `total_class` int(11) NOT NULL DEFAULT '1',
  `record_updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remarks` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentpromotions`
--

CREATE TABLE `studentpromotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('admission','promoted','detained','completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admission',
  `from_academic_id` int(11) NOT NULL,
  `from_course_parent_id` int(11) NOT NULL,
  `from_course_id` int(11) NOT NULL,
  `to_academic_id` int(11) NOT NULL,
  `to_course_parent_id` int(11) NOT NULL,
  `to_course_id` int(11) NOT NULL,
  `from_year` int(11) NOT NULL,
  `from_semister` int(11) NOT NULL,
  `to_year` int(11) NOT NULL,
  `to_semister` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `studentpromotions`
--


-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roll_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `course_parent_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_join` date DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` enum('single','married','divorced') COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fathers_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mothers_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mother_tongue` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `religion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_relation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_education` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_occupation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_income` decimal(10,2) NOT NULL,
  `parent_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_address_lane1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_address_lane2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_phone1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_phone2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_user_id` bigint(20) UNSIGNED NOT NULL,
  `guardian_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `guardian_phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `relationship_with_guardian` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `guardian_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address_lane1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_lane2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `previous_institute_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `previous_institute_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `previous_highest_qualification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `previous_highest_qualification_percentage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year_passing` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `current_year` int(11) NOT NULL,
  `current_semister` int(11) NOT NULL,
  `other_information` text COLLATE utf8_unicode_ci NOT NULL,
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  `extra_fields` text COLLATE utf8_unicode_ci,
  `record_updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_belongsto` enum('S','F') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--


-- --------------------------------------------------------

--
-- Table structure for table `subjectpreferences`
--

CREATE TABLE `subjectpreferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `maximum_marks` int(11) NOT NULL,
  `pass_marks` int(11) NOT NULL,
  `is_lab` tinyint(4) NOT NULL,
  `is_elective_type` tinyint(4) NOT NULL,
  `internal_marks` bigint(20) NOT NULL,
  `external_marks` bigint(20) NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--


-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_plan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL,
  `academic_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `day` int(11) NOT NULL,
  `timingset_id` bigint(20) UNSIGNED NOT NULL,
  `timingset_map_id` bigint(20) UNSIGNED NOT NULL,
  `timingset_details_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `semister` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timingset`
--

CREATE TABLE `timingset` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timingset`
--

INSERT INTO `timingset` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(8, 'Daily', 'daily', 'Daily Schedule', '2016-12-13 08:52:32', '2016-12-13 08:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `timingsetdetails`
--

CREATE TABLE `timingsetdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `timingset_id` bigint(20) UNSIGNED NOT NULL,
  `period_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_break` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timingsetmap`
--

CREATE TABLE `timingsetmap` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day` int(11) NOT NULL,
  `timingset_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `topic_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topics`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `login_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `role_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `stripe_active` tinyint(1) NOT NULL DEFAULT '0',
  `stripe_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_plan` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_brand` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `subscription_ends_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `slug`, `login_enabled`, `role_id`, `status`, `parent_id`, `image`, `phone`, `address`, `stripe_active`, `stripe_id`, `stripe_plan`, `paypal_email`, `card_brand`, `card_last_four`, `trial_ends_at`, `subscription_ends_at`, `remember_token`, `settings`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Owner', 'owner', 'owner@owner.com', '$2y$10$G5Ai9Ja8t.VjHR0EF2BRvuEaj1fGUgaF7vIRGYlz8yfr6s16YYG.y', 'owner', 1, 1, 1, NULL, '', '1236598774', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QuBphZzQcsj79vKSWvcBDb0J5EMijTHfTuhzePFzarvVXQmG1ce7hWh4rv25', NULL, NULL, '2017-02-06 01:50:04', '2017-03-01 04:32:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicholidays`
--
ALTER TABLE `academicholidays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `academics`
--
ALTER TABLE `academics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `academic_course`
--
ALTER TABLE `academic_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_id` (`academic_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `authors_slug_unique` (`slug`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `category_name` (`category_name`,`slug`);

--
-- Indexes for table `certificateissues`
--
ALTER TABLE `certificateissues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `issued_by` (`issued_by`);

--
-- Indexes for table `certificatetemplates`
--
ALTER TABLE `certificatetemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couponcodes`
--
ALTER TABLE `couponcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couponcodes_usage`
--
ALTER TABLE `couponcodes_usage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `coursesemisters`
--
ALTER TABLE `coursesemisters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course_subject`
--
ALTER TABLE `course_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_id` (`academic_id`),
  ADD KEY `course_parent_id` (`course_parent_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_department_code_unique` (`department_code`),
  ADD UNIQUE KEY `departments_slug_unique` (`slug`);

--
-- Indexes for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examseries`
--
ALTER TABLE `examseries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `examseries_data`
--
ALTER TABLE `examseries_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examseries_id` (`examseries_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `examtoppers`
--
ALTER TABLE `examtoppers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `quiz_result_id` (`quiz_result_id`),
  ADD KEY `quiz_id_2` (`quiz_id`),
  ADD KEY `quiz_result_id_2` (`quiz_result_id`);

--
-- Indexes for table `feecategories`
--
ALTER TABLE `feecategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_id` (`academic_id`,`course_parent_id`,`course_id`);

--
-- Indexes for table `feecategory_particulars`
--
ALTER TABLE `feecategory_particulars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feecategory_id` (`feecategory_id`,`particular_id`),
  ADD KEY `particular_id` (`particular_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feeparticular_paymets`
--
ALTER TABLE `feeparticular_paymets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feecategory_id` (`feecategory_id`,`feeparticular_id`,`feecategory_particular_id`,`feeschedule_particular_id`,`feeschedule_id`,`academic_id`,`course_parent_id`,`course_id`),
  ADD KEY `user_id` (`user_id`,`student_id`),
  ADD KEY `feeparticular_id` (`feeparticular_id`),
  ADD KEY `feecategory_particular_id` (`feecategory_particular_id`),
  ADD KEY `feeschedule_id` (`feeschedule_id`),
  ADD KEY `feeschedule_particular_id` (`feeschedule_particular_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `academic_id` (`academic_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `payement_recevied_by` (`payment_received_by`),
  ADD KEY `previous_feecategory_id` (`previous_feecategory_id`);

--
-- Indexes for table `feepayments`
--
ALTER TABLE `feepayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_id` (`academic_id`,`course_parent_id`,`course_id`,`feecategory_id`,`discount_id`,`fine_id`,`payment_recevied_by`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feepayments_transactions`
--
ALTER TABLE `feepayments_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feepayment_id` (`feepayment_id`,`payment_recevied_by`);

--
-- Indexes for table `feeschedules`
--
ALTER TABLE `feeschedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_categoryid` (`feecategory_id`);

--
-- Indexes for table `feeschedule_particulars`
--
ALTER TABLE `feeschedule_particulars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feecategory_id` (`feecategory_id`,`feeschedule_id`),
  ADD KEY `feeschedule_id` (`feeschedule_id`);

--
-- Indexes for table `feeschedule_payments`
--
ALTER TABLE `feeschedule_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feecategory_id` (`feecategory_id`,`feeschedule_id`,`feeschedule_particular_id`,`student_id`,`user_id`,`academic_id`,`course_parent_id`,`course_id`),
  ADD KEY `academic_id` (`academic_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `feeschedule_id` (`feeschedule_id`),
  ADD KEY `feeschedule_particular_id` (`feeschedule_particular_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payement_recevied_by` (`payment_recevied_by`),
  ADD KEY `feepayment_id` (`feepayment_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_group_unique` (`group`);

--
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `lessionplans`
--
ALTER TABLE `lessionplans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_subject_id` (`course_subject_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `libraryassetinstances`
--
ALTER TABLE `libraryassetinstances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `libraryassetinstances_asset_no_unique` (`asset_no`),
  ADD KEY `record_updated_by` (`record_updated_by`),
  ADD KEY `library_master_id` (`library_master_id`);

--
-- Indexes for table `libraryassettypes`
--
ALTER TABLE `libraryassettypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `libraryissues`
--
ALTER TABLE `libraryissues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`master_asset_id`,`library_instance_id`,`record_updated_by`),
  ADD KEY `master_asset_id` (`master_asset_id`),
  ADD KEY `library_instance_id` (`library_instance_id`),
  ADD KEY `record_updated_by` (`record_updated_by`);

--
-- Indexes for table `librarymasters`
--
ALTER TABLE `librarymasters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `librarymasters_slug_unique` (`slug`),
  ADD KEY `asset_type_id` (`asset_type_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `author_id` (`author_id`,`publisher_id`,`record_updated_by`),
  ADD KEY `publisher_id` (`publisher_id`),
  ADD KEY `record_updated_by` (`record_updated_by`);

--
-- Indexes for table `lmscategories`
--
ALTER TABLE `lmscategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lmscategories_slug_unique` (`slug`);

--
-- Indexes for table `lmscontents`
--
ALTER TABLE `lmscontents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lmscontents_slug_unique` (`slug`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `lmsseries`
--
ALTER TABLE `lmsseries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lms_category_id` (`lms_category_id`);

--
-- Indexes for table `lmsseries_data`
--
ALTER TABLE `lmsseries_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lmsseries_id` (`lmsseries_id`),
  ADD KEY `lmscontent_id` (`lmscontent_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_participants`
--
ALTER TABLE `messenger_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_threads`
--
ALTER TABLE `messenger_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulehelper`
--
ALTER TABLE `modulehelper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parenttimingsetmap`
--
ALTER TABLE `parenttimingsetmap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `particulars`
--
ALTER TABLE `particulars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publishers_publisher_unique` (`publisher`),
  ADD UNIQUE KEY `publishers_slug_unique` (`slug`),
  ADD KEY `record_updated_by` (`record_updated_by`);

--
-- Indexes for table `questionbank`
--
ALTER TABLE `questionbank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `questionbank_quizzes`
--
ALTER TABLE `questionbank_quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionbank_quizzes_questionbank_id_foreign` (`questionbank_id`),
  ADD KEY `quize_id` (`quize_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `quizapplicability`
--
ALTER TABLE `quizapplicability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `academic_id` (`academic_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `course_parent_id` (`course_parent_id`);

--
-- Indexes for table `quizcategories`
--
ALTER TABLE `quizcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quizcategories_slug_unique` (`slug`);

--
-- Indexes for table `quizofflinecategories`
--
ALTER TABLE `quizofflinecategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizresults`
--
ALTER TABLE `quizresults`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `academic_id` (`academic_id`),
  ADD KEY `course_parent_id` (`course_parent_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quizzes_slug_unique` (`slug`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `instructions_page_id` (`instructions_page_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `offline_quiz_category_id` (`offline_quiz_category_id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `religions_religion_name_unique` (`religion_name`),
  ADD UNIQUE KEY `religions_slug_unique` (`slug`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `semisters`
--
ALTER TABLE `semisters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`),
  ADD UNIQUE KEY `settings_slug_unique` (`slug`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_staff_id_unique` (`staff_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `studentattendance`
--
ALTER TABLE `studentattendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`,`academic_id`,`course_parent_id`,`course_id`,`subject_id`,`record_updated_by`),
  ADD KEY `semester` (`semester`),
  ADD KEY `academic_id` (`academic_id`),
  ADD KEY `record_updated_by` (`record_updated_by`),
  ADD KEY `studentattendance_ibfk_4` (`subject_id`);

--
-- Indexes for table `studentpromotions`
--
ALTER TABLE `studentpromotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`student_id`,`record_updated_by`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `record_updated_by` (`record_updated_by`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roll_no` (`roll_no`),
  ADD KEY `academic_id` (`academic_id`,`course_parent_id`,`course_id`,`user_id`,`parent_user_id`,`record_updated_by`),
  ADD KEY `course_parent_id` (`course_parent_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `parent_user_id` (`parent_user_id`),
  ADD KEY `record_updated_by` (`record_updated_by`),
  ADD KEY `students_ibfk_4` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `religion_id` (`religion_id`);

--
-- Indexes for table `subjectpreferences`
--
ALTER TABLE `subjectpreferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_id` (`academic_id`,`course_id`,`timingset_id`,`timingset_map_id`,`timingset_details_id`,`user_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `timingset_id` (`timingset_id`),
  ADD KEY `timingsetmap_id` (`timingset_map_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `timig_set_details_id` (`timingset_details_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `timingset`
--
ALTER TABLE `timingset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timingsetdetails`
--
ALTER TABLE `timingsetdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timingset_id` (`timingset_id`);

--
-- Indexes for table `timingsetmap`
--
ALTER TABLE `timingsetmap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_id` (`timingset_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id` (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicholidays`
--
ALTER TABLE `academicholidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `academics`
--
ALTER TABLE `academics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `academic_course`
--
ALTER TABLE `academic_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `certificateissues`
--
ALTER TABLE `certificateissues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `certificatetemplates`
--
ALTER TABLE `certificatetemplates`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `couponcodes`
--
ALTER TABLE `couponcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `couponcodes_usage`
--
ALTER TABLE `couponcodes_usage`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `coursesemisters`
--
ALTER TABLE `coursesemisters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `course_subject`
--
ALTER TABLE `course_subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `examseries`
--
ALTER TABLE `examseries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `examseries_data`
--
ALTER TABLE `examseries_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `examtoppers`
--
ALTER TABLE `examtoppers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feecategories`
--
ALTER TABLE `feecategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `feecategory_particulars`
--
ALTER TABLE `feecategory_particulars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feeparticular_paymets`
--
ALTER TABLE `feeparticular_paymets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `feepayments`
--
ALTER TABLE `feepayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `feepayments_transactions`
--
ALTER TABLE `feepayments_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `feeschedules`
--
ALTER TABLE `feeschedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `feeschedule_particulars`
--
ALTER TABLE `feeschedule_particulars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `feeschedule_payments`
--
ALTER TABLE `feeschedule_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `lessionplans`
--
ALTER TABLE `lessionplans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `libraryassetinstances`
--
ALTER TABLE `libraryassetinstances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `libraryassettypes`
--
ALTER TABLE `libraryassettypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `libraryissues`
--
ALTER TABLE `libraryissues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `librarymasters`
--
ALTER TABLE `librarymasters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lmscategories`
--
ALTER TABLE `lmscategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lmscontents`
--
ALTER TABLE `lmscontents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lmsseries`
--
ALTER TABLE `lmsseries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lmsseries_data`
--
ALTER TABLE `lmsseries_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messenger_participants`
--
ALTER TABLE `messenger_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messenger_threads`
--
ALTER TABLE `messenger_threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modulehelper`
--
ALTER TABLE `modulehelper`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parenttimingsetmap`
--
ALTER TABLE `parenttimingsetmap`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `particulars`
--
ALTER TABLE `particulars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questionbank`
--
ALTER TABLE `questionbank`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `questionbank_quizzes`
--
ALTER TABLE `questionbank_quizzes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizapplicability`
--
ALTER TABLE `quizapplicability`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizcategories`
--
ALTER TABLE `quizcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizofflinecategories`
--
ALTER TABLE `quizofflinecategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizresults`
--
ALTER TABLE `quizresults`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `semisters`
--
ALTER TABLE `semisters`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `studentattendance`
--
ALTER TABLE `studentattendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `studentpromotions`
--
ALTER TABLE `studentpromotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `subjectpreferences`
--
ALTER TABLE `subjectpreferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timingset`
--
ALTER TABLE `timingset`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `timingsetdetails`
--
ALTER TABLE `timingsetdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timingsetmap`
--
ALTER TABLE `timingsetmap`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1861;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_course`
--
ALTER TABLE `academic_course`
  ADD CONSTRAINT `academic_course_ibfk_1` FOREIGN KEY (`academic_id`) REFERENCES `academics` (`id`),
  ADD CONSTRAINT `academic_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `questionbank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `couponcodes_usage`
--
ALTER TABLE `couponcodes_usage`
  ADD CONSTRAINT `couponcodes_usage_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `couponcodes_usage_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `couponcodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coursesemisters`
--
ALTER TABLE `coursesemisters`
  ADD CONSTRAINT `coursesemisters_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `course_subject`
--
ALTER TABLE `course_subject`
  ADD CONSTRAINT `course_subject_ibfk_1` FOREIGN KEY (`academic_id`) REFERENCES `academics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_subject_ibfk_2` FOREIGN KEY (`course_parent_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_subject_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_subject_ibfk_4` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `examseries`
--
ALTER TABLE `examseries`
  ADD CONSTRAINT `examseries_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `quizcategories` (`id`);

--
-- Constraints for table `examseries_data`
--
ALTER TABLE `examseries_data`
  ADD CONSTRAINT `examseries_data_ibfk_1` FOREIGN KEY (`examseries_id`) REFERENCES `examseries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examseries_data_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `examtoppers`
--
ALTER TABLE `examtoppers`
  ADD CONSTRAINT `examtoppers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examtoppers_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `examtoppers_ibfk_3` FOREIGN KEY (`quiz_result_id`) REFERENCES `quizresults` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feecategory_particulars`
--
ALTER TABLE `feecategory_particulars`
  ADD CONSTRAINT `feecategory_particulars_ibfk_1` FOREIGN KEY (`feecategory_id`) REFERENCES `feecategories` (`id`),
  ADD CONSTRAINT `feecategory_particulars_ibfk_2` FOREIGN KEY (`particular_id`) REFERENCES `particulars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
