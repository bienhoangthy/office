-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2015 at 11:00 AM
-- Server version: 5.5.31
-- PHP Version: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tsmedia001_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_adv_budget`
--

CREATE TABLE IF NOT EXISTS `tkwp_adv_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adv_budget_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adv_budget_status` tinyint(4) NOT NULL,
  `adv_budget_create` date NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tkwp_adv_budget`
--

INSERT INTO `tkwp_adv_budget` (`id`, `adv_budget_name`, `adv_budget_status`, `adv_budget_create`, `user`) VALUES
(1, 'NS QC Lớn', 1, '2015-03-31', 2),
(2, 'NS QC Trung Bình', 1, '2015-03-31', 2),
(3, 'NS QC Nhỏ', 1, '2015-03-31', 2),
(4, 'NS QC không có', 1, '2015-03-31', 2),
(5, 'Chưa phân loại NS', 1, '2015-03-31', 2),
(9, 'demo', 0, '2015-03-26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_area`
--

CREATE TABLE IF NOT EXISTS `tkwp_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area_parent` int(11) NOT NULL,
  `area_status` tinyint(4) NOT NULL,
  `area_orderby` int(11) NOT NULL,
  `area_cerate_date` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=67 ;

--
-- Dumping data for table `tkwp_area`
--

INSERT INTO `tkwp_area` (`id`, `area_name`, `area_parent`, `area_status`, `area_orderby`, `area_cerate_date`, `user`) VALUES
(2, 'Hà nội', 0, 1, 2, 0, 0),
(3, 'Hồ Chí Minh', 0, 1, 3, 0, 0),
(4, 'Đã Nẵng', 0, 1, 4, 0, 0),
(5, 'Đăk Lăk', 0, 1, 5, 0, 0),
(6, 'Hải Phòng', 0, 1, 6, 0, 0),
(7, 'Cần Thơ', 0, 1, 7, 0, 0),
(8, 'An Giang', 0, 1, 8, 0, 0),
(9, 'Bà Rịa - Vũng Tàu', 0, 1, 9, 0, 0),
(10, 'Bắc Giang', 0, 1, 10, 0, 0),
(11, 'Bắc Cạn', 0, 1, 11, 0, 0),
(12, 'Bạc Liêu', 0, 1, 12, 0, 0),
(13, 'Bắc Ninh', 0, 1, 13, 0, 0),
(14, 'Bến Tre', 0, 1, 14, 0, 0),
(15, 'Bình Định', 0, 1, 15, 0, 0),
(16, 'Lâm Đồng', 0, 1, 16, 0, 0),
(17, 'Đồng Nai', 0, 1, 17, 0, 0),
(18, 'Biên Hòa', 0, 1, 18, 0, 0),
(19, 'Bình Dương', 0, 1, 1, 0, 0),
(20, 'Bình Phước', 0, 1, 20, 0, 0),
(21, 'Bình Thuận', 0, 1, 21, 0, 0),
(22, 'Cà Mau', 0, 1, 22, 0, 0),
(23, 'Cao Bằng', 0, 1, 23, 0, 0),
(24, 'Đắk Nông', 0, 1, 24, 0, 0),
(25, 'Điện Biên', 0, 1, 25, 0, 0),
(26, 'Đồng Tháp', 0, 1, 26, 0, 0),
(27, 'Gia Lai', 0, 1, 27, 0, 0),
(28, 'Hà Giang', 0, 1, 28, 0, 0),
(29, 'Hà Nam', 0, 1, 29, 0, 0),
(30, 'Hà Tây', 0, 1, 30, 0, 0),
(31, 'Hà Tĩnh', 0, 1, 31, 0, 0),
(32, 'Hải Dương', 0, 1, 32, 0, 0),
(33, 'Hòa Bình', 0, 1, 33, 0, 0),
(34, 'Hậu Giang', 0, 1, 34, 0, 0),
(35, 'Hưng Yên', 0, 1, 35, 0, 0),
(36, 'Khánh Hòa', 0, 1, 36, 0, 0),
(37, 'Kiên Giang', 0, 1, 37, 0, 0),
(38, 'Kon Tum', 0, 1, 38, 0, 0),
(39, 'Lai Châu', 0, 1, 39, 0, 0),
(40, 'Lào Cai', 0, 1, 40, 0, 0),
(41, 'Lạng Sơn', 0, 1, 41, 0, 0),
(42, 'Long An', 0, 1, 42, 0, 0),
(43, 'Nam Định', 0, 1, 43, 0, 0),
(44, 'Nghệ An', 0, 1, 44, 0, 0),
(45, 'Ninh Bình', 0, 1, 45, 0, 0),
(46, 'Ninh Thuận', 0, 1, 46, 0, 0),
(47, 'Phú Thọ', 0, 1, 47, 0, 0),
(48, 'Phú Yên', 0, 1, 48, 0, 0),
(49, 'Quảng Bình', 0, 1, 49, 0, 0),
(50, 'Quảng Nam', 0, 1, 50, 0, 0),
(51, 'Quảng Ngãi', 0, 1, 51, 0, 0),
(52, 'Quảng Ninh', 0, 1, 52, 0, 0),
(53, 'Quảng Trị', 0, 1, 53, 0, 0),
(54, 'Sóc Trăng', 0, 1, 54, 0, 0),
(55, 'Sơn La', 0, 1, 55, 0, 0),
(56, 'Tây Ninh', 0, 1, 56, 0, 0),
(57, 'Thái Bình', 0, 1, 57, 0, 0),
(58, 'Thái Nguyên', 0, 1, 58, 0, 0),
(59, 'Thanh Hóa', 0, 1, 59, 0, 0),
(60, 'Thừa Thiên - Huế', 0, 1, 60, 0, 0),
(61, 'Tiền Giang', 0, 1, 61, 0, 0),
(62, 'Trà Vinh', 0, 1, 62, 0, 0),
(63, 'Tuyên Quang', 0, 1, 63, 0, 0),
(64, 'Vĩnh Long', 0, 1, 64, 0, 0),
(65, 'Vĩnh Phúc', 0, 1, 65, 0, 0),
(66, 'Yên Bái', 0, 1, 66, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_banks`
--

CREATE TABLE IF NOT EXISTS `tkwp_banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_status` tinyint(4) NOT NULL,
  `bank_create` date NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tkwp_banks`
--

INSERT INTO `tkwp_banks` (`id`, `bank_name`, `bank_status`, `bank_create`, `user`) VALUES
(1, 'Maritime Bank', 1, '2015-03-31', 1),
(2, 'DongA Bank', 1, '2015-03-31', 1),
(3, 'Vietcombank', 1, '2015-03-31', 1),
(4, 'Agribank', 1, '2015-03-31', 1),
(5, 'Eximbank', 1, '2015-03-31', 1),
(6, 'HDBank', 1, '2015-03-31', 1),
(7, 'MB Bank', 1, '2015-03-31', 1),
(8, 'Sacombank', 1, '2015-03-31', 1),
(9, 'VietBank', 1, '2015-03-31', 1),
(10, 'Vietinbank', 1, '2015-03-31', 1),
(11, 'BIDV', 1, '2015-03-31', 1),
(12, 'Techcombank', 1, '2015-03-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_business`
--

CREATE TABLE IF NOT EXISTS `tkwp_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_status` tinyint(4) NOT NULL,
  `business_create` date NOT NULL,
  `user` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tkwp_business`
--

INSERT INTO `tkwp_business` (`id`, `business_name`, `business_status`, `business_create`, `user`) VALUES
(1, 'Công ty 100% vốn nước ngoài', 1, '2015-03-31', 1),
(2, 'Công ty cổ phần', 1, '2015-03-31', 1),
(3, 'Công ty hợp doanh', 1, '2015-03-31', 1),
(4, 'Công ty liên doanh', 1, '2015-03-31', 1),
(5, 'Công ty nhà nước', 1, '2015-03-31', 1),
(6, 'Công ty trách nhiệm hữu hạn', 1, '2015-03-31', 1),
(7, 'Doanh nghiệp tư nhân', 1, '2015-03-31', 1),
(8, 'Hợp tác xã', 1, '2015-03-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_category`
--

CREATE TABLE IF NOT EXISTS `tkwp_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_parent` int(11) NOT NULL,
  `category_component` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_orderby` int(11) NOT NULL,
  `category_icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_status` tinyint(4) NOT NULL,
  `category_create_date` datetime NOT NULL,
  `category_update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_city`
--

CREATE TABLE IF NOT EXISTS `tkwp_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_status` tinyint(4) NOT NULL,
  `city_create` date NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tkwp_city`
--

INSERT INTO `tkwp_city` (`id`, `city_name`, `city_status`, `city_create`, `user`) VALUES
(1, 'Hà nội', 1, '2015-03-31', 1),
(2, 'Tp. Hồ Chí Minh', 1, '2015-03-31', 1),
(3, 'Đã Nẵng', 1, '2015-03-31', 1),
(4, 'Đăk Lăk', 1, '2015-03-31', 1),
(5, 'Hải Phòng ', 1, '2015-03-31', 1),
(6, 'Cần Thơ', 1, '2015-03-31', 1),
(7, 'An Giang', 1, '2015-03-31', 1),
(8, 'Bà Rịa - Vũng Tàu', 1, '2015-03-31', 1),
(9, 'Bắc Giang', 1, '2015-03-31', 1),
(10, 'Bắc Cạn', 1, '2015-03-31', 1),
(11, 'Bạc Liêu', 1, '2015-03-31', 1),
(12, 'Bắc Ninh', 1, '2015-03-31', 1),
(13, 'Bến Tre', 1, '2015-03-31', 1),
(14, 'Bình Định', 1, '2015-03-31', 1),
(15, 'Lâm Đồng', 1, '2015-03-31', 1),
(16, 'Đồng Nai', 1, '2015-03-31', 1),
(17, 'Biên Hòa', 1, '2015-03-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_com`
--

CREATE TABLE IF NOT EXISTS `tkwp_com` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_parent` int(11) NOT NULL,
  `com_com` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `com_orderby` int(11) NOT NULL,
  `com_status` tinyint(4) NOT NULL,
  `com_createdate` datetime NOT NULL,
  `com_updatedate` datetime NOT NULL,
  `com_alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tkwp_com`
--

INSERT INTO `tkwp_com` (`id`, `com_name`, `com_parent`, `com_com`, `com_type`, `com_orderby`, `com_status`, `com_createdate`, `com_updatedate`, `com_alias`, `com_tag`, `user`) VALUES
(1, 'Trang chủ', 0, 'home', '', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'trang-chu', 'trang chu', 0),
(2, 'Bài viết', 0, 'news', '', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'bai-viet', 'bai viet', 0),
(3, 'Danh sách', 2, 'news', 'list', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'danh-sach', 'danh sach', 0),
(4, 'Chi tiết', 2, 'news', 'detail', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'chi-tiet', 'chi tiet', 0),
(6, 'Liên hệ', 0, 'contact', '', 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'lien-he', 'lien he', 0),
(7, 'Hình ảnh', 0, 'album', '', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'album', 'album', 0),
(8, 'Video', 0, 'video', '', 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'video', 'video', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_comment`
--

CREATE TABLE IF NOT EXISTS `tkwp_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `com_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `com_parent` int(11) NOT NULL,
  `com_status` tinyint(4) NOT NULL,
  `com_create_date` datetime NOT NULL,
  `com_update_date` datetime NOT NULL,
  `user_post` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `com_title` (`com_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tkwp_comment`
--

INSERT INTO `tkwp_comment` (`id`, `news_id`, `com_title`, `com_detail`, `com_parent`, `com_status`, `com_create_date`, `com_update_date`, `user_post`, `user`) VALUES
(2, 171, 'Bài viết hay', 'xem bài viết này có gì đâu', 0, 4, '2015-02-26 19:33:09', '2015-03-02 17:11:31', 2, 2),
(3, 171, 'đường làng tôi quanh co quanh co quanh co quanh co .......!', 'Bạn chưa có hoạt động bình luận nào trên VnExpress.', 0, 2, '2015-02-26 19:37:09', '2015-02-26 19:37:09', 2, 2),
(4, 171, 'Ôtô suýt bay xuống cầu, khách nước ngoài ngất xỉu', 'Chiều 25/2, một ôtô chở khách du lịch nước ngoài đã tông dải phân cách rồi đâm đầu vào lan can cầu Lò Gốm trên đại lộ Võ Văn Kiệt, TP HCM.', 0, 3, '2015-02-26 19:37:09', '2015-02-26 19:56:17', 2, 2),
(5, 171, 'Đổ máu vì tranh cướp manh chiếu tại lễ hội Đúc Bụt', 'Lễ hội Đúc Bụt là hình thức sinh hoạt văn hoá dân gian lâu đời, nhằm ôn lại quá trình chiêu mộ nghĩa sĩ, tập hợp lực lượng, rèn đúc vũ khí của Ngọc Kinh công chúa - nữ tướng tài ba, trí dũng vẹn toàn hưởng ứng lời kêu gọi của Hai Bà Trưng đền nợ nước, trả thù nhà, diệt giặc Tô Định (những năm 40 sau CN).  Du khách và dân làng tham dự thường quan tâm nhất là màn cướp chiếu cói. 3 chiếc chiếu thể hiện khát vọng mưa thuận gió hòa, sinh sôi nảy nở. Nhiều người tin vào lời tương truyền rằng ai sở hữu được chiếc chiếu có gắn bó mạ xanh thì trong năm sẽ sinh con trai. Do đó thời gian gần đây, hàng năm lễ hội Đúc Bụt thường có cảnh hàng trăm thanh niên lao vào tranh cướp dù chỉ là những manh hay sợi chiếu và xảy ra nhiều hình ảnh phản cảm.\n\nBài viết: http://news.zing.vn/Do-mau-vi-tranh-cuop-manh-chieu-tai-le-hoi-Duc-But-post515934.html\n\nNguồn Zing News\n', 0, 3, '2015-02-26 21:07:30', '2015-03-02 17:11:26', 2, 2),
(6, 171, 'Say nồng cỗ Tết người Dao', 'Ngày Tết, người Dao ở Làng Công (Sông Lô, Vĩnh Phúc) nô nức tổ chức các lễ hội, hát điệu Sọong cô truyền thống và chếnh choáng trong men rượu bên mâm cỗ đầy ắp.', 0, 1, '2015-02-26 21:08:56', '2015-02-26 21:08:56', 2, 2),
(7, 185, 'OK', '12345', 0, 1, '2015-02-27 08:55:55', '2015-03-09 10:29:39', 2, 2),
(8, 185, 'hướng rewrite codeigniter', '+Khi bạn sử dụng route theo 2 cách trên thì nghĩa là bạn đã cố định đường dẫn theo những gì mà bạn đã khai báo. Tuy nhiên trong một số trường hợp chúng ta ko thể cố định dc những thông số mà chúng ta truyền vào thì chúng ta phải giải quyết như thế nào ? VD với bản tin bạn ko thể truyền cố định ID như vậy dc. CI đã cho chúng ta 2 phương pháp xử lý như sau:\n\n--- (:num) -> Đúng với bất kỳ ký tự số.\n--- (:any) -> Đúng với bất kỳ ký tự chữ.', 0, 1, '2015-02-27 10:16:56', '2015-03-09 10:29:24', 2, 2),
(9, 185, 'Hàng nghìn người ngồi giữa đường giải hạn sao La Hầu', ' cách trên thì nghĩa là bạn đã cố định đường dẫn theo những gì mà bạn đã khai báo. Tuy nhiên trong một số trường hợp chúng ta ko thể cố định dc những thông số mà chúng ta truyền vào thì chúng ta phải giải quyết như thế nào ? VD với bản tin bạn ko thể truyền cố định ID như vậy dc.', 0, 1, '2015-02-27 10:18:07', '2015-02-27 10:18:07', 4, 4),
(10, 236, 'Test bình luận', 'Bạn quan tâm và yêu thích chương trình truyền hình nào nhất?', 0, 3, '2015-02-28 09:51:16', '2015-03-02 17:16:13', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_company`
--

CREATE TABLE IF NOT EXISTS `tkwp_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_house` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdate` date DEFAULT NULL,
  `owner_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_typing` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `pos_status` int(11) NOT NULL,
  `company_type` int(11) NOT NULL,
  `company_rate` int(11) NOT NULL,
  `adv_budget` int(11) NOT NULL,
  `company_scale` int(11) NOT NULL,
  `business_type` int(11) NOT NULL,
  `company_sector` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `user_trash` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=92 ;

--
-- Dumping data for table `tkwp_company`
--

INSERT INTO `tkwp_company` (`id`, `company_name`, `short_name`, `company_name_en`, `company_address`, `city_house`, `phone`, `fax`, `website`, `email`, `tax_code`, `createdate`, `owner_name`, `account_bank`, `bank_id`, `user_id`, `user_typing`, `status`, `pos_status`, `company_type`, `company_rate`, `adv_budget`, `company_scale`, `business_type`, `company_sector`, `create_date`, `update_date`, `active`, `user_trash`) VALUES
(1, 'Công Ty TNHH Dược Phẩm Shin Poong Daewoo Việt Nam', '', '0', '7a, Tăng Bạt Hổ P. 12, Q. 5 Quận 5  TP. HCM', 2, '(08)38555377 - (061)3834711', '', '', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 0, 1, 0, 2, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(3, 'CÔNG TY TNHH DƯỢC PHẨM MINH QUÂN', '', '0', ': Quầy J10, 134/1 Tô Hiến Thành, Phường 15, Quận 10, Thành phố Hồ Chí Minh ', 2, '(08) 62726677', '', '', '', '', '0000-00-00', '', '', 0, 117, 117, 4, 0, 0, 3, 0, 3, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(5, 'Công ty CL Việt Nam', '', '0', '77 Tân Vĩnh, Phường 6, Quận 4, Tp. Hồ Chí Minh. ', 2, '(848) 3943 2665 ', '', 'http://www.clcorp.vn/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 1, 4, 0, 2, 0, 123, '2015-04-08', '0000-00-00', 1, 0),
(4, 'Công ty Dược Long An', 'Vacopharm', '0', 'Số 11-12A Đường số 4. Phường Bình Trị Đông B. Bình Tân', 2, '(08) 3 8172 775 ', '', 'http://www.vacopharm.com/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 1, 1, 0, 2, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(6, 'CÔNG TY TNHH MTV PHÂN PHỐI Ô TÔ DU LỊCH CHU LAI TRƯỜNG HẢI', '', '0', 'Nguyễn Văn Trỗi', 2, '0839977824', '', '', '', '', '0000-00-00', '', '', 0, 107, 107, 6, 0, 0, 2, 0, 0, 0, 69, '2015-04-08', '0000-00-00', 1, 0),
(7, 'CÔNG TY TNHH TM DƯỢC THUẬN GIA', '', '0', 'Gian hàng I4-I5, Số 134/1 Tô Hiến Thành, Q.10, TP.HCM', 2, ' 08. 3865 7985', '', 'http://www.thuangia.com.vn', '', '', '0000-00-00', '', '', 0, 117, 117, 5, 0, 0, 1, 0, 2, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(8, 'CÔNG TY TNHH SX - TM DÂY & CÁP ĐIỆN TÀI TRƯỜNG THÀNH', '', '0', ' 79/35 Âu Cơ, P. 14, Q. 11, Tp.HCM', 2, ' 08.3975.5232 ', '', 'http://www.taitruongthanh.com.vn/', '', '', '0000-00-00', '', '', 0, 107, 107, 1, 0, 0, 1, 0, 2, 0, 0, '2015-04-08', '0000-00-00', 1, 0),
(9, 'ádasd', '', '0', '', 0, '', '', '', '', '', '0000-00-00', '', '', 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, '2015-04-08', '2015-04-07', 0, 1),
(10, '	Công ty TNHH Dược Phẩm Thiên Khánh Pharm', '', '0', '2F Đường Phạm Hữu Chí, Phường 12, Quận 5, TP.HCM', 2, '(08).3957 1961', '', 'http://www.thienkhanhpharm.com/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 0, 3, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(11, 'DOANH NGHIỆP TƯ NHÂN ĐÔNG DƯỢC DÂN LỢI ', '', '0', '39 Đại lộ Hùng Vương, P.Cam Phúc Bắc, TP.Cam Ranh, Tỉnh Khánh Hòa ', 0, ' 058 3857 244', '', 'http://danloi.vn/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 0, 2, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(12, 'CÔNG TY CỔ PHẦN DƯỢC PHẨM SAVI	', '', '0', 'Lô Z.01-02-03a KCN/KCX Tân Thuận, P. Tân Thuận Đông, Q. 7, TP. Hồ Chí Minh', 2, '08 3 7700144 - ', '', 'http://www.savipharm.com.vn/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 1, 2, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(13, 'Công ty TNHH Nam Dược Phương Nam ', '', '0', 'C4B- Đường Bửu Long- Phường 15- Quận 10- TP.HCM', 2, '0838.625.650', '', 'http://namduoc.vn/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 0, 2, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(14, 'CÔNG TY CỔ PHẦN DƯỢC TRUNG ƯƠNG 3', '', '0', '115 Ngô Gia Tự, P. Hải Châu 1, Q. Hải Châu, Tp. Đà Nẵng', 3, '(05113) 817552 ', '', 'http://duoctw3.com/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 0, 2, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(15, 'CÔNG TY TNHH LIÊN DOANH T&A OGILVY  ', '', '0', '', 1, '0422206008', '', '', '', '', '0000-00-00', '', '', 0, 107, 107, 6, 0, 0, 2, 0, 0, 0, 133, '2015-04-08', '0000-00-00', 1, 0),
(16, 'CÔNG TY CỔ PHẦN DƯỢC DANAPHA', '', '0', '253 Dũng Sĩ Thanh Khê, Tp. Đà Nẵng', 3, '0511.3760129', '', 'http://www.danapha.com/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 0, 2, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(17, 'CÔNG TY CỔ PHẦN DƯỢC - TRANG THIẾT BỊ Y TẾ BÌNH ĐỊNH', 'BIDIPHAR', '0', '	498 Nguyễn Thái Học, Phường Quang Trung, Thành Phố Quy Nhon, Tỉnh Bình Định', 14, '+84 (56) 3846500', '', 'http://www.bidiphar.com/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 1, 2, 0, 2, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(18, 'Công ty CP Dược Phẩm TW2', 'coduphar', '0', 'Số 334 (số cũ 136) Tô Hiến Thành, Q.10, TP. HCM.', 2, '38665842', '', 'http://www.codupha.com.vn/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 1, 2, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(19, 'Công ty CP Dược phẩm OPC', '', '0', 'Ấp Tân Hóa, Xã Tân Vĩnh Hiệp, Thị xã Tân Uyên, Tỉnh Bình Dương ', 0, '06503632732', '', 'http://www.opcpharma.com/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 1, 2, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(20, 'Công ty BĐS Tân Kỷ Nguyên', 'TKNREAL', '0', 'Tầng trệt tòa nhà Kim Kim Hoàn Mỹ - 87 Trần Thiện Chánh, P12, Q10', 2, '0838625010', '', 'nhachothue123.com', '', '', '0000-00-00', '', '', 0, 85, 85, 5, 0, 0, 1, 0, 1, 0, 92, '2015-04-08', '0000-00-00', 1, 0),
(21, 'Công ty TNHH Thương Mại Dịch Vụ Saigon Network', '', '0', '70, Phan Đình Phùng, Phường 2, Quận Phú Nhuận, Tp. Hồ Chí Minh.', 2, '0968.566.911', '', 'http://www.sgnet.vn/', 'congnghethongtinvnn@gmail.com', '', '0000-00-00', '', '', 0, 106, 106, 1, 0, 1, 2, 5, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(23, 'Nhà thuốc Đông Y Đặng Nguyên Đường', '', '0', '240 Bạch Đằng – F.24, Q. Bình Thạnh –', 2, '083.899.6169', '', 'http://dangnguyenduong.vn/', '', '', '0000-00-00', '', '', 0, 53, 53, 6, 0, 1, 2, 0, 0, 0, 99, '2015-04-08', '0000-00-00', 1, 0),
(24, 'Doanh Nghiệp Tư Nhân Hoàng Sơn Dịch Vụ', '', '0', '43A1 Mạc Đĩnh Chi, P. Đa Kao, Q. 1,Tp. Hồ Chí Minh', 0, '0838296276', '', 'Không có', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 0, 7, 3, '2015-04-08', '0000-00-00', 1, 0),
(25, 'Công Ty TNHH Thương Mại Dịch Vụ XNK Đại Phát Tài', '', '0', '41/10 Trần Quý Cáp, P. 12, Q. Bình Thạnh,Tp. Hồ Chí Minh', 0, ' 0963321984', '', 'http://sieuthidogiadung.bizz.vn/', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 1, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(26, 'Công Ty CP Thế Giới Điện Tử Tâm Hoàn Châu', '', '0', '27A Trần Quang Khải, Quận 1, Tp Hồ Chí Minh', 0, '0932108687', '', 'http://www.eworld.com.vn/', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 0, 2, 4, '2015-04-08', '0000-00-00', 1, 0),
(27, ' Công ty CPTM Dược Phẩm Quang Minh ', 'QM.MEDIPHAR', '0', '4A, Lò Lu, Phường Trường Thạnh, Q.9, Tp. HCM', 2, '(08) 3.7300.167', '', '', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 1, 2, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(28, 'Công Ty CP Sài Gòn Triển Vọng - SAVISTA', '', '0', 'tầng 6 tòa nhà VIMADECO 163, Nguyễn Văn Trỗi, Phường 11, Quận Phú Nhuận, Tp. Hồ Chí Minh.', 2, ' (08) 38422172, 38423356', '', 'http://www.savista.com.vn', 'info@savista.com.vn', '', '0000-00-00', '', '', 0, 110, 110, 4, 0, 1, 4, 0, 0, 0, 96, '2015-04-08', '0000-00-00', 1, 0),
(29, 'Công ty CP Dược phẩm TW Vidipha', '', '0', '184/2 Lê Văn Sỹ, Phường 10, Quận Phú Nhuận, TP.Hồ Chí Minh', 2, '08 - 38 440 106', '', 'http://www.vidipha.com.vn/', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 1, 2, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(30, 'CÔNG TY TNHH TM - DV SEN VÀNG VIỆT', '', '0', '225/1/4 Nguyễn Đình Chiểu, Phường 5, Quận 3', 2, '0904397949', '', 'http://muchp.com/', 'ctymucinhoasen@gmail.com', '', '0000-00-00', '', '', 0, 114, 114, 1, 0, 0, 2, 0, 0, 6, 3, '2015-04-08', '0000-00-00', 1, 0),
(31, 'Công Ty TNHH Thương Mại Dịch Vụ Nguyên Phúc', '', '0', '3/5D Bình Thới, P. 11, Q. 11,Tp. Hồ Chí Minh', 0, '0839650085', '', 'Không có', '', '', '0000-00-00', '', '', 0, 114, 114, 1, 0, 0, 4, 0, 3, 0, 3, '2015-04-08', '0000-00-00', 1, 0),
(32, 'Công Ty TNHH Thương Mại Dịch Vụ Minh Thuật', '', '0', '446L Bùi Đình Túy, P. 12, Q. Bình Thạnh,Tp. Hồ Chí Minh', 0, '0838404479', '', 'Không có', '', '', '0000-00-00', '', '', 0, 114, 114, 1, 0, 0, 3, 0, 0, 6, 3, '2015-04-08', '0000-00-00', 1, 0),
(33, 'Công Ty TNHH Dịch Vụ Thương Mại Kỹ Thuật Số Tấn Phát', '', '0', '75 Trần Đình Xu, P. Cầu Kho, Q. 1,Tp. Hồ Chí Minh', 0, '0838386486', '', 'http://www.tanphatcopy.com/', '', '', '0000-00-00', '', '', 0, 114, 114, 4, 0, 0, 3, 0, 3, 0, 3, '2015-04-08', '0000-00-00', 1, 0),
(34, 'Trung Tâm Điện Lạnh Minh Khoa', '', '0', '84 Đỗ Xuân Hợp, P. Long A, Q. 9,Tp. Hồ Chí Minh', 0, '0973548759', '', 'http://dienlanhdienmaycuongnga.com/', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 3, 0, 1, 0, 4, '2015-04-08', '0000-00-00', 1, 0),
(35, 'Công Ty TNHH TM DV Hồng Tuyền', '', '0', '49 Hàm Nghi, P. Nguyễn Thái Bình, Q. 1,Tp. Hồ Chí Minh ', 0, '0937241276', '', 'Không có', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 1, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(36, 'Công Ty Cổ Phần Điện Tử Asanzo Việt Nam', '', '0', 'Lô 14/1, Đường 2A, KCN Vĩnh Lộc, Q. Bình Tân,Tp. Hồ Chí Minh', 0, '0909799345', '', 'http://asanzo.com.vn/', '', '', '0000-00-00', '', '', 0, 114, 114, 4, 0, 0, 4, 0, 2, 2, 4, '2015-04-08', '0000-00-00', 1, 0),
(37, 'Công Ty TNHH Thương Mại Phùng Thịnh', '', '0', '322 Nguyễn Thượng Hiền, P. 5, Q. Phú Nhuận,Tp. Hồ Chí Minh ', 0, '0835158291', '', 'http://phungthinh.com.vn/', '', '', '0000-00-00', '', '', 0, 114, 114, 1, 0, 0, 2, 0, 0, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(38, '	Công ty TNHH Dược Phẩm Thiên Khánh Pharm', '', '0', '2F Đường Phạm Hữu Chí, Phường 12, Quận 5, TP.HCM', 2, '(08).3957 1961 ', '', 'www.thienkhanhpharm.com', '', '', '0000-00-00', '', '', 0, 117, 117, 1, 0, 0, 2, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(39, 'CÔNG TY CỔ PHẦN THƯƠNG MẠI ĐẦU TƯ CÔNG NGHỆ SPS', '', '0', '202 , Nguyễn Xiển, Phường Hạ Đình, Quận Thanh Xuân, Hà nội.', 0, ' 0977770906-0904035225-0919002836', '', 'http://sps.vn/', 'myvt@sps.vn', '', '0000-00-00', '', '', 0, 106, 106, 1, 0, 0, 2, 0, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(40, 'Công Ty TNHH Sản Xuất Thương Mại Thắng Lợi Long', '', '0', '78/29 Cống Lở, P.15, Q. Tân Bình', 2, '(08)62968810 - 01699913868', '', 'thangloilong.com (hết hạn hosting, tên miền còn)', '', '', '0000-00-00', '', '', 0, 109, 109, 1, 0, 0, 2, 0, 0, 0, 124, '2015-04-08', '0000-00-00', 1, 0),
(41, 'Công Ty TNHH Điện Gia Dụng Vina', '', '0', '204 TTN08, P. Tân Thới Nhất, Q. 12,Tp. Hồ Chí Minh', 0, '0975311155', '', 'http://www.eha.vn/', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 0, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(42, 'Thiết kế Website TOPVIET', '', '0', 'Tp. Hồ Chí Minh.', 0, '0987450303', '', 'http://topviet.com.vn', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 3, 0, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(43, 'Công Ty TNHH Thương Mại Đầu Tư Thăng Long Việt Nam', '', '0', '389, Trương Định, Phường Tân Mai, Quận Hoàng Mai, Hà nội.', 0, '0972.126.126-0963.888.885', '', 'http://kenhdichvu.vn/', 'support@kenhdichvu.vn', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 2, 0, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(44, 'Công Ty TNHH Vương Linh', '', '0', '333/12/7 Lê Văn Sỹ, P. 1, Q. Tân Bình,Tp. Hồ Chí Minh ', 0, '0839911282', '', 'http://koreaking.com.vn/', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 3, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(45, 'Công Ty TNHH Một Thành Viên Thương Mại Đại Lộc Phát', '', '0', '125 Lũy Bán Bích, P. Tân Thới Hòa, Q. Tân Phú,Tp. Hồ Chí Minh', 0, '0913777633', '', 'http://www.alphalegend.com/', '', '', '0000-00-00', '', '', 0, 114, 114, 4, 0, 0, 4, 0, 3, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(46, 'CÔNG TY CỔ PHẦN NOBI VIỆT NAM', '', '0', 'Số 29 - ngách 105/8 - Láng Hạ, Đống Đa, Hà nội.', 0, '0983419983', '', 'http://nobi.vn/', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 2, 0, 0, 0, 0, '2015-04-08', '0000-00-00', 1, 0),
(47, 'Công Ty CP Đầu Tư & Phát Triển Đông Đô', '', '0', '74A Làng Tăng Phú, P. Tăng Nhơn Phú A, Q. 9,Tp. Hồ Chí Minh ', 0, '0839682282', '', 'http://fujicook.com.vn/', '', '', '0000-00-00', '', '', 0, 114, 114, 1, 0, 0, 2, 0, 3, 2, 4, '2015-04-08', '0000-00-00', 1, 0),
(48, 'Công Ty TNHH Sản Xuất Thương Mại Phát Triển Đông Dương', '', '0', '158/112 Phạm Văn Chiêu, P. 9, Q. Gò Vấp,Tp. Hồ Chí Minh ', 0, '0944186622', '', 'http://giadungdongduong.com/', '', '', '0000-00-00', '', '', 0, 114, 114, 1, 0, 0, 2, 0, 0, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(49, 'Công Ty TNHH Hồng Đạt', '', '0', '2969A Quốc Lộ 1A, Khu Phố 5, P. Tân Thới Nhất, Q. 12,Tp. Hồ Chí Minh', 0, '0835925242', '', 'Không có', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 3, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(50, 'Công Ty TNHH Thương Mại Tiện Dụng Gia Đình Sỉ Lẻ Việt Nam', '', '0', 'A27/17C, ấp 1, Quốc Lộ 50, Q. Bình Chánh,Tp. Hồ Chí Minh ', 0, '0968044205', '', 'http://thuytinhsanhsugiasi.com/', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 0, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(51, 'Công ty TNHH Dược Phẩm Sài gòn (SAGOPHA)', '', '0', '496/88 (số cũ: 94/1049B) Dương Quảng Hàm, P.6, Q. Gò Vấp', 0, ' 39841439 - 39841460', '', 'http://www.sagopha.com.vn (2011, flash)', '', '', '0000-00-00', '', '', 0, 109, 109, 1, 0, 0, 4, 0, 0, 0, 98, '2015-04-08', '0000-00-00', 1, 0),
(52, 'Công Ty Cổ Phần Mỹ Phẩm Mono', '', '0', '678/92 , Nguyễn ảnh Thủ,, Phường Cụm CN Quang Trung, Tp. Hồ Chí Minh.', 0, '(08)38863299', '', 'http://www.mono.vn', '', '', '0000-00-00', '', '', 0, 110, 110, 4, 0, 1, 4, 0, 0, 0, 128, '2015-04-08', '0000-00-00', 1, 0),
(53, 'Công Ty TNHH Du Lịch Hà Phương', '', '0', '273, Phạm Ngũ Lão, Phường Phạm Ngũ Lão, Quận 01, Tp. Hồ Chí Minh.', 2, '0935714768', '0903507179', 'hanhcafe.vn', 'hanhcafevietnam@gmail.com', '', '0000-00-00', '', '', 0, 110, 110, 4, 0, 1, 4, 0, 0, 0, 108, '2015-04-08', '0000-00-00', 1, 0),
(54, 'Công Ty Cổ Phần Sonadezi An Bình', '', '0', 'Số 113, 116 Lô C2, 9 KDC An Bình, Biên Hòa.', 17, '0909300319', '', 'http://sonadezianbinh.com.vn/', '', '', '0000-00-00', '', '', 0, 110, 110, 4, 0, 1, 4, 0, 0, 0, 92, '2015-04-08', '0000-00-00', 1, 0),
(55, 'Công Ty TNHH Thương Mại Chánh Hiệp Lợi', '', '0', '315 Xô Viết Nghệ Tĩnh, P. 24, Q. Bình Thạnh,Tp. Hồ Chí Minh ', 0, '0903612650', '', 'Không có', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 3, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(56, 'Công Ty TNHH Sản Xuất Thương Mại & Dịch Vụ Hà Minh Cường', '', '0', '221A Nguyễn Văn Quá, P. Đông Hưng Thuận, Q. 12,Tp. Hồ Chí Minh', 0, '0938205056', '', 'http://haminhcuong.com/', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 0, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(57, 'Công Ty TNHH Một Thành Viên Trần Nam', '', '0', '19/10 Đường Số 10, P. 8, Q. Gò Vấp,Tp. Hồ Chí Minh', 0, '0907869050', '', 'http://www.trannam.net/', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 0, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(58, 'Công ty TNHH Bao Bì Đạt Thuận', '', '0', '131/16, Đường Tây Lân, Phường Bình Trị Đông A, , Quận Bình Tân', 0, '(84.8) 3762 5293 ', '', 'dashunpacking.com', '', '', '0000-00-00', '', '', 0, 109, 109, 1, 0, 0, 4, 0, 0, 0, 121, '2015-04-08', '0000-00-00', 1, 0),
(59, 'Công Ty TNHH Thương Mại Xuất Nhập Khẩu Dịch Vụ Phú Quý', '', '0', '57A Đinh Bộ Lĩnh, P. 26, Q. Bình Thạnh', 0, '(08) 38993158', '', 'http://www.phuquy-vn.com (flash nh, 2010)', '', '', '0000-00-00', '', '', 0, 109, 109, 1, 0, 0, 4, 0, 0, 0, 125, '2015-04-08', '0000-00-00', 1, 0),
(60, 'Công Ty TNHH Thương Mại Nam Hưng Long', '', '0', '61-63A Võ Văn Tần, P. 6, Q. 3,Tp. Hồ Chí Minh', 0, '0908859876', '', 'Không có', '', '', '0000-00-00', '', '', 0, 114, 114, 4, 0, 0, 4, 0, 0, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(61, 'Cửa Hàng Ngọc Hà', '', '0', '1422 Đại lộ Võ Văn Kiệt, P. 1, Q. 6,Tp. Hồ Chí Minh', 0, '0907990889', '', 'http://www.cuahangngocha.com/', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 3, 0, 3, 0, 4, '2015-04-08', '0000-00-00', 1, 0),
(62, 'Chi Nhánh Công Ty TNHH MTV Thiên Phú Thành', '', '0', '  96 Độc Lập, P. Tân Thành, Q. Tân Phú', 0, '(08) 62547244', '', 'kitas.cpm.vn (hết hạn hosting)', 'kytai365@gmail.com', '', '0000-00-00', '', '', 0, 109, 109, 1, 0, 0, 4, 0, 0, 0, 40, '2015-04-08', '0000-00-00', 1, 0),
(63, 'Trung Tâm Phân Phối Bộ Lau Nhà Tín Phương', '', '0', '2439 QL20, Phương Lâm 2, Phú Lâm, Tân Phú,Tp. Hồ Chí Minh', 0, '0946755760', '', 'Không có', '', '', '0000-00-00', '', '', 0, 114, 114, 3, 0, 0, 4, 0, 3, 0, 4, '2015-04-08', '0000-00-00', 1, 0),
(64, 'Công Ty Cổ Phần Thiết Bị Điện Chân Truyền', '', '0', '168 Đường Linh Đông, KP. 4, P. Linh Đông, Q. Thủ Đức,Tp. Hồ Chí Minh', 0, '0933839405', '', 'http://www.chantruyen.com.vn', '', '', '0000-00-00', '', '', 0, 114, 114, 1, 0, 0, 4, 0, 0, 2, 4, '2015-04-08', '0000-00-00', 1, 0),
(65, 'Công Ty Cổ Phần Long Thiên', '', '0', '93 Đường Kênh 19-5, P. Sơn Kỳ, Q. Tân Phú,', 0, '08. 5434 0611 - 08. 5427 3494-0908195558', '', 'http://www.longthien.com.vn', '', '', '0000-00-00', '', '', 0, 109, 109, 1, 0, 0, 4, 0, 0, 0, 121, '2015-04-08', '0000-00-00', 1, 0),
(66, 'Công Ty TNHH MTV Thương Mại Dịch Vụ Điện Lạnh Ngô Hoàng', '', '0', '97 Đông Hưng Thuận , P. Đông Hưng Thuận, Q. 12,Tp. Hồ Chí Minh', 0, '0866756762', '', 'http://dienlanhngohoang.com/', '', '', '0000-00-00', '', '', 0, 114, 114, 1, 0, 0, 4, 0, 0, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(67, 'Công Ty TNHH Quốc Oai', '', '0', '43/18B ấp Tiền Lân, X. Bà Điểm, H. Hóc Môn', 0, '(08) 37128789', '', 'www.quocoai.vn (flash)', '', '', '0000-00-00', '', '', 0, 109, 109, 1, 0, 0, 4, 0, 0, 0, 121, '2015-04-08', '0000-00-00', 1, 0),
(68, 'CÔNG TY CỔ PHẦN DU LỊCH THANH NIÊN XUNG PHONG - V.Y.C Travel', '', '0', '178 - 180, Nguyen Cu Trinh, Quận 1, Tp. Hồ Chí Minh., Tp. Hồ Chí Minh', 0, '0936143341', '', 'http://www.vyctour.com/, http://www.vyctravel.com', '', '', '0000-00-00', '', '', 0, 106, 106, 1, 0, 0, 2, 0, 0, 0, 108, '2015-04-08', '0000-00-00', 1, 0),
(69, 'Công Ty TNHH Việt Thái Á', '', '0', 'C12 Gò Cẩm Đệm,Cư Xá Phú Thọ Hòa, P. 10, Q. Tân Bình,Tp. Hồ Chí Minh', 0, '0838601459', '', 'www.luckyhome.vn', '', '', '0000-00-00', '', '', 0, 114, 114, 1, 0, 0, 4, 0, 0, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(70, 'Công ty TNHH SX-TM Phúc Hảo', '', '0', '347 Hồ Văn Tắng, Ấp Cây Da, Xã Tân Phú Trung, Huyện Củ Chi', 0, '84.8.3 796 2614 - 84.8.3 796 3207 - 84.8.3 606 2398 – 84.8.3 606 2399', '', 'http://www.phuchaopackaging.com (flash, 2006)', '', '', '0000-00-00', '', '', 0, 109, 109, 1, 0, 0, 4, 0, 0, 0, 121, '2015-04-08', '0000-00-00', 1, 0),
(71, 'Công Ty TNHH Sản Xuất Thương Mại Giấy Lụa', '', '0', '86/4-6 Nguyễn Văn Trỗi, Phường 8, Quận Phú Nhuận', 0, '( 84-8 ) 3891 9888 -  3716 6868', '', 'www.papercanary.net- www.papercanary.vn (flash, load chậm)', '', '', '0000-00-00', '', '', 0, 109, 109, 1, 0, 0, 4, 0, 0, 0, 121, '2015-04-08', '0000-00-00', 1, 0),
(72, 'Công ty TNHH Công nghệ và Truyền thông DIM Group', '', '0', ' 23/79/23, Đinh Công Thượng, Quận Hoàng Mai, Hà nội', 0, '0988851156', '', ' http://dim.vn/', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(73, 'HAIPHONG IT GROUP (HIG)', '', '0', 'Tầng 2 số 464, Đã Năng, Quận Hải An, Hải Phòng', 0, ' 0904.945.840', '', ' http://websitehaiphong.com/', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(74, 'DUY ANH WEB', '', '0', '27, Chùa Láng, Phường Láng Thượng, Quận Đống Đa, Hà nội', 0, '0915.852.256–0985.852.256', '', 'http://duyanhweb.com/', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(75, 'CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ PHÁT TRIỂN GIẢI PHÁP CÔNG NGHỆ V&V', '', '0', 'Phòng 1706 Tòa nhà 57, Láng Hạ, Quận Đống Đa, Hà nội', 0, '0969254801', '', '', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(76, 'Công Ty TNHH Thương Mại Xuất Nhập Khẩu Thanh Kiều', '', '0', '54 Đường Số 5, P. Bình Hưng Hòa A, Q. Bình Tân,Tp. Hồ Chí Minh', 0, '0938456756', '', 'http://www.dienmaysaigon.vn/', '', '', '0000-00-00', '', '', 0, 114, 114, 1, 0, 0, 4, 0, 0, 6, 4, '2015-04-08', '0000-00-00', 1, 0),
(77, 'Công ty CP Truyền thông và Giải pháp Công nghệ DLC Việt Nam', '', '0', '45/462, Đường bưởi, Quận Ba đình, Hà nội.', 0, ' 0904237347-0915.808899', '', 'http://www.dlcvietnam.com - www.internet.org.vn - www.68.biz.vn', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(78, 'Công ty cổ phần Zone Media', '', '0', 'Tầng 3, Tòa nhà Indochina Riverside, 74, Bạch Đằng, Quận Hải Châu, Đã Nẵng.', 0, '05113600123', '', 'http://zonemedia.vn/', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(79, 'Công Ty Cổ Phần Vận Tải Và Dịch Vụ Du Lịch Phương Trang', '', '0', '292 Đinh Bộ Lĩnh, Phường 26, Q.Bình Thạnh, TP. HCM, Tp. Hồ Chí Minh.', 0, '0983980048', '', '', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 67, '2015-04-08', '0000-00-00', 1, 0),
(80, 'demxinh.vn', '', '0', 'Tp. Hồ Chí Minh.', 0, '0989937913-0936264324-0438337403', '', 'demxinh.vn', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 27, '2015-04-08', '0000-00-00', 1, 0),
(81, 'CÔNG TY CỔ PHẦN PHÁT TRIỂN KỸ THUẬT & THƯƠNG MẠI TÂN ĐỨC', '', '0', '103 , Pasteu, Quận 1, Tp. Hồ Chí Minh.', 0, ' 38220590/38230291/38229633', '', 'http://tdt-tanduc.com/', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 9, '2015-04-08', '0000-00-00', 1, 0),
(82, 'Công ty Thiết Kế Web QV', '', '0', '59/59 , Tân Hòa Đông, Phường 14, Quận 6, Tp. Hồ Chí Minh', 0, '0985212237', '', 'http://www.thietkewebsiteqv.com', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 9, '2015-04-08', '2015-04-08', 1, 0),
(83, 'NGUYỄN HẢI - KAIKO VIETNAM', '', '0', ' 443, Phạm Thế Hiển, Phường 3, Quận 8, Tp. Hồ Chí Minh.', 0, '0937324079', '', ' www.kaikovietnam.com', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 9, '2015-04-08', '2015-04-08', 1, 0),
(84, 'Công ty TNHH Thương Mại Thế Giới Châu Á', '', '0', '53, số 3, Phường Hiệp Bình Chánh, Quận Thủ Đức, Tp. Hồ Chí Minh.', 0, '0902004111', '', 'www.aworldtrade.com', '', '', '0000-00-00', '', '', 0, 106, 106, 5, 0, 0, 4, 0, 0, 0, 22, '2015-04-08', '2015-04-08', 1, 0),
(85, 'Sutunam Co., Ltd', '', '0', 'Tầng 17 tòa nhà C’land, 156, Xã Đàn II, Hà nội.', 0, '(04)3.5739.741', '', 'http://www.sutunam.vn/', '', '', '0000-00-00', '', '', 0, 106, 106, 4, 0, 0, 4, 0, 0, 0, 9, '2015-04-08', '2015-04-08', 1, 0),
(86, 'Công Ty TNHH Vận Tải Lâm Phát', '', '0', ' 488/23, Lê Trọng Tấn,, Phường Tây Thạnh, Quận Tân Phú, Tp. Hồ Chí Minh.', 2, '0862958238', '(08)62964330', ' http://vantailamphat.com', '', '', '0000-00-00', '', '', 0, 110, 110, 3, 0, 1, 4, 0, 0, 0, 71, '2015-04-08', '0000-00-00', 1, 0),
(87, 'CTY QUỐC NGHỆ TNHH THƯƠNG MẠI & DU LỊCH', '', '0', '39/7B, Hai Bà Trưng, Phường Bến Nghé, Quận 01, Tp. Hồ Chí Minh.', 0, '0838248901', '', 'www.quocnghetravel.com', 'namquoc@vnn.vn', '', '0000-00-00', '', '', 0, 110, 110, 3, 0, 1, 4, 0, 0, 0, 108, '2015-04-08', '0000-00-00', 1, 0),
(88, 'Chi Nhánh Công Ty Cổ Phần Cung Ứng Dịch Vụ Hàng Không', '', '0', ' 17, Hậu Giang, Phường 4, Quận Tân Bình, Tp. Hồ Chí Minh.', 2, '0838118683', '0838118683', 'Chưa có web', '', '', '0000-00-00', '', '', 0, 110, 110, 3, 0, 1, 4, 0, 0, 0, 68, '2015-04-08', '0000-00-00', 1, 0),
(89, 'CÔNG TY TNHH THƯƠNG MẠI & DU LỊCH ĐIỂM HOÀN MỸ', '', '0', '345/134, Trần Hưng Đạo, Phường Cầu Kho, Quận 01, Tp. Hồ Chí Minh.', 2, '(84.8)38386648', '(84.8)38386649', 'www.hmdestination.com ', 'info@hmdestination.com', '', '0000-00-00', '', '', 0, 110, 110, 1, 0, 1, 4, 0, 0, 0, 108, '2015-04-08', '0000-00-00', 1, 0),
(90, 'Công Ty TNHH Hóa Dầu Đệ Nhất (FPC)', '', '0', ' Lầu 1, Tòa Nhà Bích Phụng á Châu, Số 132, Đội cung, Phường 9, Quận 11, Tp. Hồ Chí Minh.', 2, '(08)66604500', '(08)54333548', ' http://sieuthidaunhot.com', 'sieuthidaunhot@gmail.com', '', '0000-00-00', '', '', 0, 110, 110, 4, 0, 1, 4, 0, 0, 0, 70, '2015-04-08', '0000-00-00', 1, 0),
(91, 'Công Ty TNHH Thương Mại Dịch Vụ Du Lịch An Thái', '', '0', '358, Lê Hồng Phong, Phường 1, Quận 10, Tp. Hồ Chí Minh.', 2, '0838330220', '', 'http://www.anthaitravel.net', '', '', '0000-00-00', '', '', 0, 110, 110, 4, 0, 1, 4, 0, 0, 0, 108, '2015-04-08', '2015-04-08', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_company_rate`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rate_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate_status` tinyint(4) NOT NULL DEFAULT '1',
  `rate_create` date NOT NULL,
  `user` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tkwp_company_rate`
--

INSERT INTO `tkwp_company_rate` (`id`, `rate_name`, `rate_color`, `rate_status`, `rate_create`, `user`) VALUES
(1, 'Rất tiềm năng', '#00b1e1', 1, '2015-04-08', 1),
(2, 'KH tiềm năng', '#8ac448', 1, '2015-04-08', 1),
(3, 'Không tiềm năng', '', 1, '2015-04-08', 1),
(4, 'Không phân loại', '#D5CECE', 1, '2015-04-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_company_scale`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_scale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scale_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scale_status` tinyint(4) NOT NULL DEFAULT '1',
  `scale_create` date NOT NULL,
  `user` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tkwp_company_scale`
--

INSERT INTO `tkwp_company_scale` (`id`, `scale_name`, `scale_status`, `scale_create`, `user`) VALUES
(1, 'Trung bình', 1, '0000-00-00', 1),
(2, 'Lớn', 1, '0000-00-00', 1),
(3, 'Bé', 1, '0000-00-00', 1),
(4, 'Chưa phân loại', 1, '2015-03-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_company_sector`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_parent` int(11) NOT NULL,
  `sector_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sector_status` tinyint(4) NOT NULL DEFAULT '1',
  `sector_create` date NOT NULL,
  `user` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sector_name` (`sector_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=135 ;

--
-- Dumping data for table `tkwp_company_sector`
--

INSERT INTO `tkwp_company_sector` (`id`, `sector_parent`, `sector_name`, `sector_status`, `sector_create`, `user`) VALUES
(1, 0, 'CÔNG NGHỆ', 1, '2015-04-07', 1),
(2, 1, 'Thiết bị nghe nhìn', 1, '2015-04-07', 1),
(3, 1, 'Thiết bị văn phòng', 1, '2015-04-07', 1),
(4, 1, 'Điện gia dụng', 1, '2015-04-07', 1),
(5, 1, 'Hitech', 1, '2015-04-07', 1),
(6, 1, 'Điện lạnh', 1, '2015-04-07', 1),
(7, 1, 'Phần mềm điện tử - điện tóan', 1, '2015-04-07', 1),
(8, 1, 'Phần mềm game', 1, '2015-04-07', 1),
(9, 1, 'Giải pháp công nghệ', 1, '2015-04-07', 1),
(10, 1, 'Hãng máy tính', 1, '2015-04-07', 1),
(11, 1, 'Công ty phân phối', 1, '2015-04-07', 1),
(12, 1, 'Cửa hàng linh kiện', 1, '2015-04-07', 1),
(13, 0, 'GIẢI TRÍ', 1, '2015-04-07', 1),
(14, 13, 'Khu vui chơi - giải trí - Công viên', 1, '2015-04-07', 1),
(15, 13, 'Karaoke', 1, '2015-04-07', 1),
(16, 13, 'Phòng thu âm', 1, '2015-04-07', 1),
(17, 13, 'Game', 1, '2015-04-07', 1),
(18, 13, 'Rạp chiếu phim', 1, '2015-04-07', 1),
(19, 0, 'NỘI THẤT', 1, '2015-04-07', 1),
(20, 19, 'Giấy dán tường', 1, '2015-04-07', 1),
(21, 19, 'Thiết bị vệ sinh', 1, '2015-04-07', 1),
(22, 19, 'Công ty SX và cung cấp nội thất', 1, '2015-04-07', 1),
(23, 19, 'Nội thất văn phòng', 1, '2015-04-07', 1),
(24, 19, 'Nội thất nhà ở', 1, '2015-04-07', 1),
(25, 19, 'Nội thất nhà bếp', 1, '2015-04-07', 1),
(26, 19, 'Công ty tư vấn', 1, '2015-04-07', 1),
(27, 19, 'Chăn, ra, gối, nệm', 1, '2015-04-07', 1),
(28, 0, 'Siêu thị', 1, '2015-04-07', 1),
(29, 28, 'Điện máy', 1, '2015-04-07', 1),
(30, 28, 'Tiêu dùng', 1, '2015-04-07', 1),
(31, 28, 'Di động', 1, '2015-04-07', 1),
(32, 28, 'Mua sắm', 1, '2015-04-07', 1),
(33, 0, 'Tiền tệ', 1, '2015-04-07', 1),
(34, 33, 'Tài chính', 1, '2015-04-07', 1),
(35, 33, 'Ngân hàng', 1, '2015-04-07', 1),
(36, 33, 'Chứng khoán', 1, '2015-04-07', 1),
(37, 33, 'Bảo hiểm', 1, '2015-04-07', 1),
(38, 0, 'THỜI TRANG', 1, '2015-04-07', 1),
(39, 38, 'Quần áo', 1, '2015-04-07', 1),
(40, 38, 'Giày dép', 1, '2015-04-07', 1),
(41, 38, 'Đồng hồ', 1, '2015-04-07', 1),
(42, 38, 'Mắt kính', 1, '2015-04-07', 1),
(43, 38, 'Đồ lót', 1, '2015-04-07', 1),
(44, 38, 'Gift shop', 1, '2015-04-07', 1),
(45, 38, 'Thời trang mẹ - bé', 1, '2015-04-07', 1),
(46, 38, 'Áo cưới - áo dài', 1, '2015-04-07', 1),
(47, 38, 'Trang sức', 1, '2015-04-07', 1),
(48, 38, 'Đồ thể thao', 1, '2015-04-07', 1),
(49, 38, 'Quần áo nam', 1, '2015-04-07', 1),
(50, 38, 'Phụ kiện', 1, '2015-04-07', 1),
(51, 0, 'TM ĐIỆN TỬ', 1, '2015-04-07', 1),
(52, 51, 'Coupon', 1, '2015-04-07', 1),
(53, 51, 'Web Bán hàng trực tuyến', 1, '2015-04-07', 1),
(54, 0, 'THỰC PHẨM', 1, '2015-04-07', 1),
(55, 54, 'Thực phẩm đóng gói', 1, '2015-04-07', 1),
(56, 54, 'Bánh kẹo', 1, '2015-04-07', 1),
(57, 54, 'Dầu ăn', 1, '2015-04-07', 1),
(58, 54, 'Rựơu - Bia', 1, '2015-04-07', 1),
(59, 54, 'Nước ngọt - Nước suối', 1, '2015-04-07', 1),
(60, 54, 'Sữa', 1, '2015-04-07', 1),
(61, 54, 'Mì gói', 1, '2015-04-07', 1),
(62, 54, 'Kem', 1, '2015-04-07', 1),
(63, 54, 'Trà - coffee', 1, '2015-04-07', 1),
(64, 54, 'Yến sào', 1, '2015-04-07', 1),
(65, 54, 'Gia vị', 1, '2015-04-07', 1),
(66, 0, 'VẬN TẢI', 1, '2015-04-07', 1),
(67, 66, 'Logictic', 1, '2015-04-07', 1),
(68, 66, 'Hàng không', 1, '2015-04-07', 1),
(69, 66, 'ôtô - xe máy', 1, '2015-04-07', 1),
(70, 66, 'Dầu nhớt', 1, '2015-04-07', 1),
(71, 66, 'Chuyển phát nhanh', 1, '2015-04-07', 1),
(72, 0, 'VIỆC LÀM', 1, '2015-04-07', 1),
(73, 72, 'Rao vặt', 1, '2015-04-07', 1),
(74, 0, 'XÂY DỰNG', 1, '2015-04-07', 1),
(75, 74, 'Sơn ', 1, '2015-04-07', 1),
(76, 74, 'Cửa', 1, '2015-04-07', 1),
(77, 74, 'VLXD - Xi Măng', 1, '2015-04-07', 1),
(78, 74, 'Hệ thống giám sát', 1, '2015-04-07', 1),
(79, 74, 'Sắt thép', 1, '2015-04-07', 1),
(80, 74, 'Khóa sắt', 1, '2015-04-07', 1),
(81, 74, 'Tư vấn thiết kế', 1, '2015-04-07', 1),
(82, 74, 'PCCC', 1, '2015-04-07', 1),
(83, 0, 'ẨM THỰC - NHÀ HÀNG', 1, '2015-04-07', 1),
(84, 83, 'Nhà hàng Âu, Á', 1, '2015-04-07', 1),
(85, 83, 'FastFood', 1, '2015-04-07', 1),
(86, 83, 'Buffet', 1, '2015-04-07', 1),
(87, 83, 'Quán coffee, trà sữa, kem', 1, '2015-04-07', 1),
(88, 83, 'Nhà hàng tiệc cứơi', 1, '2015-04-07', 1),
(89, 83, 'Lẩu', 1, '2015-04-07', 1),
(90, 0, 'BĐS', 1, '2015-04-07', 1),
(91, 90, 'Sàn giao dịch', 1, '2015-04-07', 1),
(92, 90, 'Công ty KD BĐS', 1, '2015-04-07', 1),
(93, 90, 'Trung tâm thương mại', 1, '2015-04-07', 1),
(94, 90, 'Khu quy hoạch', 1, '2015-04-07', 1),
(95, 90, 'Khu CN - Khu dô thị dân cư - Tòa nhà - Biệt thự ', 1, '2015-04-07', 1),
(96, 90, 'Tư vấn BĐS', 1, '2015-04-07', 1),
(97, 0, 'Y TẾ', 1, '2015-04-07', 1),
(98, 97, 'Thuốc các loại', 1, '2015-04-07', 1),
(99, 97, 'Thực phẩm chức năng', 1, '2015-04-07', 1),
(100, 97, 'Bệnh viện', 1, '2015-04-07', 1),
(101, 97, 'Nha Khoa', 1, '2015-04-07', 1),
(102, 97, 'Phụ Khoa', 1, '2015-04-07', 1),
(103, 97, 'Phòng khám - Đông y', 1, '2015-04-07', 1),
(104, 0, 'ĐIỆN THOẠI', 1, '2015-04-07', 1),
(105, 104, 'Công ty phân phối Điện thoại', 1, '2015-04-07', 1),
(106, 104, 'Cửa hàng - hãng điện thoại', 1, '2015-04-07', 1),
(107, 0, 'DU LỊCH', 1, '2015-04-07', 1),
(108, 107, 'Tour - Công ty du lịch', 1, '2015-04-07', 1),
(109, 107, 'Khách sạn - Resort', 1, '2015-04-07', 1),
(110, 107, 'Đồ dùng du lịch', 1, '2015-04-07', 1),
(111, 0, 'GIÁO DỤC', 1, '2015-04-07', 1),
(112, 111, 'Đại học - Cao đẳng - Trung cấp - Sau đại học', 1, '2015-04-07', 1),
(113, 111, 'Trường Quốc tế', 1, '2015-04-07', 1),
(114, 111, 'Trung tâm đào tạo', 1, '2015-04-07', 1),
(115, 111, 'Trung tâm anh ngữ - CNTT', 1, '2015-04-07', 1),
(116, 111, 'Tư vấn du học', 1, '2015-04-07', 1),
(117, 111, 'Đào tạo kỹ năng mềm', 1, '2015-04-07', 1),
(118, 111, 'Trường mầm non', 1, '2015-04-07', 1),
(119, 111, 'Các trung tâm phát triển', 1, '2015-04-07', 1),
(120, 0, 'TIÊU DÙNG', 1, '2015-04-07', 1),
(121, 120, 'Giấy', 1, '2015-04-07', 1),
(122, 120, 'tiêu dùng gia dụng', 1, '2015-04-07', 1),
(123, 120, 'Hóa mỹ phẩm tiêu dùng gia đình', 1, '2015-04-07', 1),
(124, 120, 'văn phòng phẩm', 1, '2015-04-07', 1),
(125, 120, 'đồ dùng nhà bếp', 1, '2015-04-07', 1),
(126, 120, 'Nhựa', 1, '2015-04-07', 1),
(127, 0, 'LÀM ĐẸP', 1, '2015-04-07', 1),
(128, 127, 'Mỹ phẩm', 1, '2015-04-07', 1),
(129, 127, 'Nước hoa', 1, '2015-04-07', 1),
(130, 127, 'Hóa mỹ phẩm', 1, '2015-04-07', 1),
(131, 127, 'Thẩm mỹ viện', 1, '2015-04-07', 1),
(132, 127, 'Beauty Salon', 1, '2015-04-07', 1),
(133, 0, 'Agency', 1, '2015-04-07', 1),
(134, 0, 'Khác', 1, '2015-04-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_company_status`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cst_name` varchar(255) NOT NULL,
  `cst_note` varchar(255) NOT NULL,
  `cst_status` tinyint(4) NOT NULL,
  `cst_create` date NOT NULL,
  `user` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tkwp_company_status`
--

INSERT INTO `tkwp_company_status` (`id`, `cst_name`, `cst_note`, `cst_status`, `cst_create`, `user`) VALUES
(1, 'Đang làm việc', '#0071cd', 1, '0000-00-00', 1),
(3, 'Không thành công', '#4a4a4a', 1, '0000-00-00', 1),
(4, 'Đang liên lạc', '#0071cd', 1, '0000-00-00', 1),
(5, 'Thành công', '#bb000a', 1, '0000-00-00', 1),
(6, 'Chưa liên hệ', '#d85100', 1, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_company_type`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type_status` tinyint(4) NOT NULL,
  `type_create` date NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tkwp_company_type`
--

INSERT INTO `tkwp_company_type` (`id`, `type_name`, `type_status`, `type_create`, `user`) VALUES
(1, 'Trực tiếp', 1, '2015-04-01', 1),
(2, 'Đại lý', 1, '2015-04-01', 1),
(3, 'Đại lý và trực tiếp', 1, '2015-04-01', 1),
(4, 'Chưa phân loại', 1, '2015-04-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_company_work`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_date` date NOT NULL,
  `time` time NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `employee_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `infocontact_id` int(11) NOT NULL,
  `contact_content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `status_work` tinyint(4) NOT NULL DEFAULT '1',
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

--
-- Dumping data for table `tkwp_company_work`
--

INSERT INTO `tkwp_company_work` (`id`, `create_date`, `time`, `phone`, `employee_name`, `infocontact_id`, `contact_content`, `status`, `status_work`, `user`) VALUES
(1, '2015-04-07', '09:40:00', '0908615159', 'Vũ Lan Chi', 1, 'Alo anh Tuấn trao đổi thông tin bên anh sử dụng loại BK nào? Anh cho biết bên anh thường sử dụng loại đục 4F8 - 100Y. Cũng có khi sử dụng in logo nhưng lâu lắm mới dùng đến', 5, 1, 107),
(4, '2015-04-07', '10:14:00', '08 6272 6677', 'Vũ Lan Chi', 3, 'cty vẫn còn nhiều sản phẩm, khi nào hết thì mua. Ko có ai phụ trách chính, ai mua cũng được. Nhân viên ko bik sử dụng email', 5, 1, 107),
(5, '2015-04-07', '10:39:00', '0943305522', 'Vũ Lan Chi', 4, 'Alo anh Hiền hỏi thăm phần báo giá đã gởi cho anh. Anh nói tính thêm trục in sẽ cao hơn so với đơn vị cũ, vì hiện giờ bên đó cũng cung cấp tốt cho anh ==> book lịch hẹn gặp anh vào 2h30 chiều ngày mai để trao đổi kỹ hơn về giá cả', 5, 1, 107),
(6, '2015-04-07', '14:38:00', '0904313260', 'Vũ Lan Chi', 20, 'Gởi thông tin về chương trình 30/4', 1, 1, 107),
(7, '2015-04-07', '14:44:00', '0904313260', 'Vũ Lan Chi', 20, 'alo nhắc anh checks mail và trao đổi thêm thông tin về chương trình 30/4. Anh sẽ checks và xem xét cụ thể để phản hồi sớm những thông tin trên', 5, 1, 107),
(8, '2015-04-07', '14:55:00', '(08).3957 1961', 'Vũ Lan Chi', 21, 'alo chị Mai hỏi thăm thông tin nhưng chị Mai cho biết công ty đã có nhà cung cấp và không muốn thay đổi. Hỏi thăm thông tin là bên chị sử dụng loại 6F đục 100Y. Thuyết phục chị cho địa chỉ email để gởi thông tin giá cả trước', 5, 1, 107),
(9, '2015-04-07', '15:05:00', '058 3857 244', 'Vũ Lan Chi', 22, 'alo gặp chị Huệ hỏi thăm thông tin. Chị cho biết Sếp trực tiếp làm mấy việc này nhưng để chị hỏi thăm lại vì chị cũng không biết gì cả. Hỏi xin thông tin Sếp thì chị nói mai gọi lại', 6, 1, 107),
(10, '2015-04-07', '15:22:00', '08 3 7700144 -', 'Vũ Lan Chi', 23, 'Alo xin được thông tin người liên hệ thu mua BK là anh Trung', 6, 1, 107),
(11, '2015-04-07', '17:01:00', '0908615159', 'Vũ Lan Chi', 1, 'Gởi báo giá mẫu BK đục 4F8 - 100Y', 7, 1, 107),
(12, '2015-04-07', '17:27:00', '05113817552', 'Vũ Lan Chi', 26, 'alo hỏi thăm được bik chi nhánh Hồ Chí Minh do chị Thảo phụ trách. Nhà máy Đà nẵng do chị Nguyệt phụ trách. Xin số liên hệ', 6, 1, 107),
(13, '2015-04-08', '09:06:00', '0927222929', 'Vũ Lan Chi', 32, 'alo chị Nga báo đã gởi mẫu lại cho chị. Nhờ chị nhận giúp', 5, 1, 107),
(14, '2015-04-08', '09:17:00', '06503632732', 'Vũ Lan Chi', 34, 'chị Thành cho biết công ty sử dụng loại 5F, 6F in logo nhưng hiện đã có đơn vị cung cấp, vẫn thuyết phục chị xin email để gởi giá tham khảo', 5, 1, 107),
(15, '2015-04-08', '09:33:00', '0838625010', 'Nguyễn Thụy Hoài My', 35, 'Khách hàng đống ý các điều khoản hợp đồng, giảm giá cho khách hàng còn 19.000.000 . Chiều nay khi nào có GĐ ở công ty thì mang hợp đồng qua ký', 5, 1, 85),
(16, '2015-04-07', '15:40:00', '0982678910', 'Đào Thái Nhật Ngân', 36, 'Anh Triết nói hiện anh hok có ở tp để kiểm tra nữa, anh đnag đi triển khai mấy cái server có các tỉnh, khi nào anh về tp anh alo, rồi anh em mình cafe trao đổi kĩ hơn, rồi chốt hợp đồng luôn', 5, 1, 106),
(17, '2015-04-08', '09:55:00', '0963321984', 'Phạm Thùy An', 37, 'Hiện tại công ty chưa có nhu cầu thiết kế lại website mới', 5, 1, 114),
(18, '2015-05-08', '10:07:00', '0963321984', 'Phạm Thùy An', 37, 'Liên lạc lại với khách hàng', 5, 0, 114),
(19, '2015-04-08', '10:06:00', '38665842', 'Vũ Lan Chi', 38, 'alo anh Hải hỏi thăm thông tin. Anh Hải với anh Hùng cùng thu mua luôn. Bên anh thường sử dụng loại 6F trong đục có in logo và ko in logo. Loại logo lấy tầm 1000 cuộn sử dụng trong 1 tháng đến 1 tháng rưỡi. Loại ko in thì khoảng 400 cuộn/ đợt. Xin thông tin email và book cuộc hẹn gặp vào ngày mai. Sáng mai sẽ gọi lại hen gặp. Anh Hải nói đến lúc nào cũng đc, gặp anh Hùng hoặc anh Hải', 5, 1, 107),
(20, '2015-04-08', '10:15:00', '0838296276', 'Phạm Thùy An', 39, 'Đã có số điện thoại của anh Sơn, GĐ công ty, số điện thoại: 0903647620', 5, 1, 114),
(21, '2015-04-08', '10:20:00', '0932108687', 'Phạm Thùy An', 42, 'Không nghe máy', 5, 1, 114),
(22, '2015-04-08', '10:23:00', '0838422172', 'Nguyễn Thị Trúc Ly', 43, 'Liên hệ lại sau', 6, 1, 110),
(23, '2015-04-08', '10:24:00', '0932108687', 'Phạm Thùy An', 42, 'Khách hàng nói gửi mail để tham khảo thông tin trước, tuy nhiên là công ty chưa có kế hoạch thiết kế lại website mới trong thời gian này.', 5, 1, 114),
(24, '2015-04-08', '10:34:00', '0903647620', 'Phạm Thùy An', 44, 'Hiện tại công ty chưa có nhu cầu thiết kế website mới', 5, 1, 114),
(25, '2015-04-08', '10:39:00', '38 440 106', 'Vũ Lan Chi', 45, 'Có vẻ lớn tuổi. Cực kỳ khó tính. Cố gắng lắm mới vào để nói chuyện được. Hỏi được bên anh sử dụng loại 4F8 va 1F in logo. Anh ko có thời gian nói chuyện, cho email gởi giá xem rồi cúp máy', 5, 1, 107),
(26, '2015-04-08', '10:42:00', '0935131979', 'Vũ Lan Chi', 19, 'Bên chị sử dụng ok chỉ có điều màu ko được thích lắm. Chị hỏi thêm loại 100Y - báo giá 9100. Chị cho bik đơn sau lấy cho chị loại màu đục hơn - với hàng đợt vừa rồi màng kéo tốt hơn cả loại đưa mẫu. Qua đầu sau alo chị lấy hàng tiếp', 5, 1, 107),
(27, '2015-04-08', '10:45:00', '0904397949', 'Phạm Thùy An', 46, 'Đã book được lịch hẹn với khách hàng vào 4h30 chiều thứ 6, tại Công ty Sen Vàng Việt, đem theo một số mẫu website để anh Băng tham khảo.', 5, 1, 114),
(28, '2015-04-08', '10:56:00', '0839650085', 'Phạm Thùy An', 47, 'Đã xin được số điện thoại của GĐ là anh Vỹ, 0903715176', 5, 1, 114),
(29, '2015-04-08', '11:11:00', '0838404479', 'Phạm Thùy An', 48, 'Đã xin được số điện thoại của anh Hoàng bộ phận kỹ thuật', 5, 1, 114),
(30, '2015-04-08', '11:29:00', '0973548759', 'Phạm Thùy An', 50, 'Hiện tại công ty chưa có nhu cầu thiết kế website mới', 5, 1, 114),
(31, '2015-04-08', '11:32:00', '0909721158', 'Vũ Lan Chi', 51, 'alo chị Như trao đổi về sản phẩm, chị cho bik bên chị thường sử dụng loại BK đục 4F8. Hà Nội làm phần in logo nên trong Nam ko làm. XIn thông tin gởi mail cho chị tham khảo giá', 5, 1, 107),
(32, '2015-04-08', '12:03:00', '39571962', 'Vũ Lan Chi', 56, 'chị Mai cho bik bên chị sử dụng loại BK 6F - 100Y đục. ', 5, 1, 107),
(33, '2015-04-09', '13:49:00', '0838625010', 'Tình Văn Nguyễn', 35, 'test', 1, 0, 1),
(34, '2015-04-08', '13:49:00', '0977770906', 'Đào Thái Nhật Ngân', 57, 'Anh Mỹ từ tết tới giờ chưa lên server nào mới, colo thì đó giwof làm bên FPT, anh đnag tìm kiếm colo mới để khi lên server mới đẽ hơn, anh nói cứ gửi báo giá colo cho anh đi, nhiều khi KH cần anh giới thiệu cho, với lại server anh mua trức tiếp tại nhà cung cấp tại Hà nội luôn, chứ hok mua lại, mua lịa qua trung giao hành hok có tốt lắm. 2 sdt mobi a bị hư dt rôi giờ tạm thời xài viettel', 5, 1, 106),
(35, '2015-04-08', '13:52:00', '0987450303', 'Đào Thái Nhật Ngân', 59, 'ANh Linh đã bỏ mảng web luôn rồi, hok kinh doanh nữa', 5, 1, 106),
(36, '2015-04-08', '10:00:00', '0987450303', 'Đào Thái Nhật Ngân', 59, 'ANh Linh đã bỏ mảng web luôn rồi, hok kinh doanh nữa', 5, 1, 106),
(37, '2015-04-08', '10:02:00', '0972.126.126', 'Đào Thái Nhật Ngân', 60, 'ANh Huề nói anh Dùng bên VDC cũng quen rồi, hok muốn dùng sang bên khác, nhưng chia sẽ với anh hôm bữa anh có nói cái dự án nào nhỏ nhỏ thì anh chueyenr qua cho Ngân. anh nói vậy gửi vào mail anh đi, anh coi thử có dự án nào phù hợp hok anh chuyển qua rồi anh báo cho', 5, 1, 106),
(38, '2015-04-08', '10:11:00', '0983419983', 'Đào Thái Nhật Ngân', 63, 'Anh Sơn hỏi ratas kĩ vè bên mình, anh nói bên anh làm về bên dịch vụ thiết kế web nên cần rất nhiều dịch vụ nên gửi mail cho anh tất cả giá cả cũng như thông tin anh xem xét nếu phù hợp anh sẽ liên hệ', 5, 1, 106),
(39, '2015-04-08', '14:23:00', '0937241276', 'Phạm Thùy An', 52, 'Đang bận gọi lại sau.', 5, 1, 114),
(40, '2015-04-08', '14:25:00', '0909799345', 'Phạm Thùy An', 53, 'Khách hàng đang bận gọi điện thoại lại sau', 5, 1, 114),
(41, '2015-04-08', '14:37:00', '0835158291', 'Phạm Thùy An', 54, 'Gửi hợp đồng báo giá dịch vụ tên miền và hosting qua mail cho c.Thảo tham khảo giá', 5, 1, 114),
(42, '2015-04-08', '14:40:00', '0975311155', 'Phạm Thùy An', 58, 'Số điện thoại di động ko liên lạc được, gọi vào số điện thoại bàn cho trên Trang Vàng 0862966510 cũng là số điện thoại sai', 5, 1, 114),
(43, '2015-04-08', '14:45:00', '0839911282', 'Phạm Thùy An', 61, 'Hiện tại công ty chưa có nhu cầu', 5, 1, 114),
(44, '2015-04-08', '14:49:00', '0913777633', 'Phạm Thùy An', 62, 'Không nghe máy (Website ko truy cập được)', 5, 1, 114),
(45, '2015-04-08', '15:00:00', '0839682282', 'Phạm Thùy An', 64, 'Tên miền công ty hết hạn vào ngày 5/10/2015, đang sử dụng dịch vụ hosting của Vhost, gửi mail báo giá tên miền và hosting qua mail cho chị Kiều tham khảo', 5, 1, 114),
(46, '2015-04-08', '15:05:00', '0937241276', 'Phạm Thùy An', 52, 'Công ty đã tìm được đối tác thiết kế website mới', 5, 1, 114),
(47, '2015-04-08', '15:16:00', '0944186622', 'Phạm Thùy An', 65, 'Gửi mail báo giá hosting và tên miền cho anh Đạt tham khảo.', 5, 1, 114),
(48, '2015-04-08', '15:24:00', '0835925242', 'Phạm Thùy An', 66, 'Công ty chuyên phân phối hàng bán sỉ cho các đại lý và siêu thị điện máy vì vậy không sử dụng website', 5, 1, 114),
(49, '2015-04-08', '15:35:00', '0968044205', 'Phạm Thùy An', 70, 'Website công ty chạy theo công nghệ cũ và chèn hình theo dạng Flash nhưng chị Nguyên nói rằng thiết kế theo yêu cầu của GĐ.', 5, 1, 114),
(50, '2015-04-08', '15:41:00', '0903612650', 'Phạm Thùy An', 71, 'Đã có website mới', 5, 1, 114),
(51, '2015-04-08', '15:50:00', '0938205056', 'Phạm Thùy An', 72, 'Công ty đã chưa có nhu cầu thiết kế lại website', 5, 1, 114),
(52, '2015-04-08', '15:56:00', '0907869050', 'Phạm Thùy An', 73, 'Đã nhờ công ty của bạn thiết kế xong website mới, cũng như sử dụng trọn gói dịch vụ hosting do công ty đó cung cấp, ko sử dụng website www.trannam.net', 5, 1, 114),
(53, '2015-04-08', '16:04:00', '(08)38993158', 'Nguyễn Thị Kiều Ngân', 74, 'cty ko bo phn IT, tự nói chưa có nhu cầu. bữa khác gọi lại bắng cách khác', 6, 1, 109),
(54, '2015-04-08', '16:04:00', '(08)38993158', 'Nguyễn Thị Kiều Ngân', 74, 'ko co bo phan IT, ko cho thong tin, tu noi ko co nhu cau, bua khac goi lai', 6, 1, 109),
(55, '2015-04-08', '16:08:00', '(84.8) 3762 5293 ', 'Nguyễn Thị Kiều Ngân', 75, 'ko biết ai pt web. lan khac goi lai', 6, 1, 109),
(56, '2015-04-08', '16:08:00', '(84.8) 3762 5293 ', 'Nguyễn Thị Kiều Ngân', 75, 'ko biết ai pt. lan khac goi lai', 6, 1, 109),
(57, '2015-04-08', '16:09:00', '0908859876', 'Phạm Thùy An', 76, 'Đã nghỉ việc ko còn làm tại Nam Hưng Long', 5, 1, 114),
(58, '2015-04-08', '16:10:00', '0854495746', 'Phạm Thùy An', 77, 'Không nghe máy', 5, 1, 114),
(59, '2015-04-08', '16:16:00', '0907990889', 'Phạm Thùy An', 78, 'Chị Hà nói cửa hàng không còn nhu cầu sử dụng website nên đã ngưng sử dụng website cuahangngocha.com', 5, 1, 114),
(60, '2015-04-08', '16:21:00', '0946755760', 'Phạm Thùy An', 79, 'Công ty đã tìm được đối tác thiết kế website mới', 5, 1, 114),
(61, '2015-04-08', '16:27:00', '0933839405', 'Phạm Thùy An', 80, 'Anh Duy đang chạy xe máy ngoài đường, không tiện nghe máy, sáng mai gọi lại', 5, 1, 114),
(62, '2015-04-08', '16:37:00', '0866756762', 'Phạm Thùy An', 81, 'Công ty đã thiết kế website mới có tên ngohoang.vn, tên miền này chuẩn bị hết hạn vào 14/8/2015, sẽ liên lạc lại để chào bán tên miền', 5, 1, 114),
(63, '2015-04-08', '16:44:00', ' 0936143341', 'Đào Thái Nhật Ngân', 82, 'Chị OAnh cho biết mail đã nhận được rồi, mà bên nội bộ có 1 chút xíu vấn đề lục đục, nên VPS sẽ có 1 số thay đổi nhỏ, chị cngx đang cố gắng trao đổi và thúc đẩy sếp luôn, khi nào sếp ok hết rồi chị sẽ phản hồi cho', 5, 1, 106),
(64, '2015-04-08', '16:47:00', '0838601459', 'Phạm Thùy An', 83, 'Ngày mai sẽ liên lạc lại vào số điện thoại văn phòng 0839744263, gặp GĐ là anh Huỳnh Quang Thái để trao đổi thêm về website', 5, 1, 114),
(65, '2015-04-08', '16:16:00', '0988851156', 'Đào Thái Nhật Ngân', 84, 'Không bắt máy', 5, 1, 106),
(66, '2015-04-08', '15:56:00', ' 0904.945.840', 'Đào Thái Nhật Ngân', 85, 'Anh Trung cho biết hiện bên anh chưa có nhu cầu, nói anh mình có 2 con VPS đang khuyến mãi, nêu shok lấy thì cũng tiếc, anh nói vậy gửi mail cho anh đi, để anh coi thử', 5, 1, 106),
(67, '2015-04-08', '16:46:00', '0915.852.256', 'Đào Thái Nhật Ngân', 86, 'Nh cho biết về server anh đang di bên Long vân, anh nói nó đi đâu về CLoud tại VN mà, giá nó lại tốt nữa, giấ trên thị trường hok ai bằng nó, vậy nói anh để gửi mail cho anh tham khảo qua giá bên mình. anh hỏi qua 1 con, bên mình 1tr5 bên đó khoảng 600 thui', 5, 1, 106),
(68, '2015-04-08', '15:57:00', '0438560777', 'Đào Thái Nhật Ngân', 87, 'Gọi tới số bàn được lễ tân cho biết, hiện giờ người phù trách đnag đi ra ngoài, được biết người phụ trách tên là Tuyết', 6, 1, 106),
(69, '2015-04-08', '15:31:00', '0904237347', 'Đào Thái Nhật Ngân', 89, 'Anh Linh đang họp, đang bị sếp la hay sao á, nên mai gọi lại', 5, 1, 106),
(70, '2015-04-08', '15:28:00', '05113600123', 'Đào Thái Nhật Ngân', 91, 'HIện tại anh Phương đi ra ngoài rồi, anh Phương hay đi thị trường hok bjk khi nào về hết, xin số dt di dộng anh Phương 0914002002', 6, 1, 106),
(71, '2015-04-08', '15:28:00', '0914002002', 'Đào Thái Nhật Ngân', 92, 'Anh Phương đang đi ngoài đường, hiên này anh đang sử dung server và chỉ có nhu cầu về server thôi, nen gwuir cho anh bảng báo giá server cho anh đi', 5, 1, 106),
(72, '2015-04-08', '17:00:00', '0839784730', 'Phạm Thùy An', 90, 'Hiện tại công ty đã thiết kế thêm 1 website khác là http://dienmaythanhkieu.com/, nhưng vẫn sử dụng cả website http://www.dienmaysaigon.vn/. Tuy nhiên website dienmaysaigon.vn ko truy cập được, có thể do gói hosting nên ngày mai sẽ gọi lại để chào bán gói hosting. (Website 2tr, tặng hosting 1 năm)', 5, 1, 114),
(73, '2015-04-08', '15:16:00', '0917030030', 'Đào Thái Nhật Ngân', 93, 'Ông này rất khó chịu, ổng nói giọng khó chịu khi nà ổng cần thì ổng liên hệ, còn hok làm việc vwois nhạn viên của ổng, chứ ổng hok có làm việc đâu,', 5, 1, 106),
(74, '2015-04-08', '15:13:00', '0989937913', 'Đào Thái Nhật Ngân', 94, 'Gọi hok dc, cái gọi lại, mình bận hok bắt máy, giờ gọi lại thì không bắt máy', 5, 1, 106),
(75, '2015-04-08', '15:10:00', '38229633', 'Đào Thái Nhật Ngân', 95, 'Gặp lễ tân chuyển máy cho chị Loan, Chị Loan nói, chị coi quá giá hết rồi, giá bên mình ao qua, giá mình đưa chị bằng giá chị báng lẻ luôn, nên chắc hok hợp tác được đâu, Khi nào deal được giá thì alo chị', 5, 1, 106),
(76, '2015-04-08', '15:03:00', '0985212237', 'Đào Thái Nhật Ngân', 96, 'Anh Vương cho biết mail Ngân anh không có nhận được, anh  có ktra mà hok có thấy, anh đnag ngồi máy tình né, ngân gửi ghi tiêu đề là tên Ngân luôn đi, để anh check nhen. gửi liền đi, đang ngồi máy nè', 5, 1, 106),
(77, '2015-04-08', '21:02:00', '0907537513', 'Đào Thái Nhật Ngân', 97, 'Anh Hậu nói anh hok nhận được mail, anh hỏi mail mình tên gi để anh check, anh check rồi vẫn hok thấy mail, nên gửi lại cho anh đi, cả VPS, server luôn nhen. cả 2 cái đó anh đều cần', 5, 1, 106),
(78, '2015-04-08', '14:24:00', '0902004111', 'Đào Thái Nhật Ngân', 98, 'Gọi cho anh LOH nhắc về việc gia hạn. anh nói giờ ktra lạo xem anh xài hết bao nhiều rồi báo anh, để anh biết tại anh tính tăng thêm dung lượng', 5, 1, 106),
(79, '2015-04-08', '14:45:00', '0902004111', 'Đào Thái Nhật Ngân', 98, 'Thái Nhật NgânSau khi kiểm tra lại anh còn như lên đên 25GB, nhuwg anh nói anh muốn tăng lên 100GB luôn, báo giá cho anh, với lại anh than phiền hồi lúc mấy bữa hơn 1 tháng PHP không chạy được, hỗ trợ tăng anh 1 tháng bù lại 1 tháng PHP bị lỗi đó, báo giá anh lên 560/tháng   bản quyền plesk. anh nói gửi mail cho anh . để anh theo dõi cho dễ', 5, 1, 106),
(80, '2015-04-08', '11:11:00', '(04)3.5739.741', 'Đào Thái Nhật Ngân', 99, 'Gặp được chị này, chị này cho biết hiện ngườii phụ trách hok có ở đây, sếp là nười nước ngoài. xin được mail gửi mail vào chào server rtanguy@sutunam.vn', 6, 1, 106);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_company_work_status`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_work_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wk_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wk_bg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wk_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wk_icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wk_name` (`wk_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tkwp_company_work_status`
--

INSERT INTO `tkwp_company_work_status` (`id`, `wk_name`, `wk_bg`, `wk_color`, `wk_icon`, `user`) VALUES
(1, 'Email HSNL', '#8E00E1', '#fff', 'ico-mail-send', 1),
(2, 'Gặp trực tiếp', '#ed5466', '#fff', 'ico-coffee', 1),
(3, 'Chờ gặp', '#63d3e9', '#fff', 'ico-busy2', 1),
(5, 'Điện thoại trực tiếp', '#91c854', '#fff', 'ico-phone4', 1),
(6, 'Điện thoại tìm  người liên hệ', '#BEE592', '#fff', ' ico-phone', 1),
(7, 'Email báo giá', '#00b1e1', '#fff', 'ico-envelop', 1),
(8, 'Email hậu HĐ', '#427583', '#fff', 'ico-mail4', 1),
(9, 'Điện thoại báo KH check mail', '#5EE01E', '#fff', 'ico-contact-remove2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_config`
--

CREATE TABLE IF NOT EXISTS `tkwp_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `config_value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `config_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `config_create` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `config_name` (`config_name`),
  KEY `config_value` (`config_value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tkwp_config`
--

INSERT INTO `tkwp_config` (`id`, `config_name`, `config_value`, `config_note`, `config_create`, `user`) VALUES
(1, 'config_company', 'TS Media', 'Tên công ty', '2015-04-06 11:34:37', 1),
(3, 'config_address', '161-163 Trần Quốc Thảo, Quận 3, TP HCM', 'Địa chỉ công ty', '2015-04-06 11:35:04', 1),
(4, 'config_phone', '0822 476 759', 'Điện thoại', '2015-04-06 11:35:46', 1),
(5, 'config_hotline', ' 0916 . 891 . 287', 'Hotline', '2015-04-06 11:36:19', 1),
(6, 'config_giayphepdangky', ' ', 'Giấy phép đăng ký', '2015-04-06 11:36:32', 1),
(7, 'config_tongbientap', 'Nguyễn Thị Hồng Tuyết', 'Giám đốc', '2015-04-06 11:36:47', 1),
(8, 'config_ip', '115.78.239.14', 'IP Công ty', '2015-04-06 12:01:11', 1),
(9, 'config_email_send', 'vantinh@ioi.vn', 'Mail gửi thông báo', '2015-04-08 08:40:30', 1),
(10, 'config_email_server', 'mail.ioi.vn', 'Server Email', '2015-04-08 08:49:02', 1),
(11, 'config_email_pass', 'manhhuy1991', 'Pass cấu hình gửi mail', '2015-04-08 08:49:57', 1),
(12, 'config_email_port', '25', 'Port nhận mail', '2015-04-08 08:58:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_department`
--

CREATE TABLE IF NOT EXISTS `tkwp_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `department_parent` int(11) NOT NULL,
  `department_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `department_order` int(11) NOT NULL,
  `department_create` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_name` (`department_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tkwp_department`
--

INSERT INTO `tkwp_department` (`id`, `department_name`, `department_parent`, `department_note`, `department_order`, `department_create`, `user`) VALUES
(1, 'Phòng ban giám đốc', 0, 'ban giam doc', 1, '2015-02-04 08:08:33', 0),
(2, 'Phòng kỹ thuật', 0, 'Kỹ thuật dự án', 2, '2015-02-04 08:09:01', 0),
(4, 'Phòng kinh doanh', 0, '', 3, '2015-04-04 11:26:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_event`
--

CREATE TABLE IF NOT EXISTS `tkwp_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `event_create_date` datetime NOT NULL,
  `event_update_date` datetime NOT NULL,
  `event_status` tinyint(4) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_name` (`event_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tkwp_event`
--

INSERT INTO `tkwp_event` (`id`, `event_name`, `event_detail`, `event_create_date`, `event_update_date`, `event_status`, `user`) VALUES
(1, 'Xuân 2015', 'Xuân Ất Mùi', '2015-02-26 10:00:41', '2015-02-26 10:00:41', 1, 2),
(2, 'Sự kiện 8/3', 'Ngày quốc tế phụ nữ việt nam', '2015-02-26 10:03:50', '2015-02-26 10:03:50', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_feedback`
--

CREATE TABLE IF NOT EXISTS `tkwp_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feedback_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `feedback_status` tinyint(4) NOT NULL,
  `feedback_create_date` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `feedback_title` (`feedback_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tkwp_feedback`
--

INSERT INTO `tkwp_feedback` (`id`, `feedback_title`, `feedback_detail`, `feedback_status`, `feedback_create_date`, `user`) VALUES
(10, 'Kinh doanh- Thông tin người liên hệ', 'Mở cập nhật thông tin người liên hệ cho kinh doanh', 1, '2015-04-07 14:24:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_getauto_site`
--

CREATE TABLE IF NOT EXISTS `tkwp_getauto_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `host` tinytext NOT NULL,
  `url` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `table_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_pattern` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_content_left` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_content_right` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pattern_bound` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `page_num` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_dir` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `begin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `end` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `createdate_get` datetime NOT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tkwp_getauto_site`
--

INSERT INTO `tkwp_getauto_site` (`id`, `name`, `host`, `url`, `extra`, `table_name`, `image_pattern`, `image_content_left`, `image_content_right`, `pattern_bound`, `category_id`, `page_num`, `image_dir`, `tag`, `begin`, `end`, `createdate_get`, `createdate`, `updatedate`, `user`) VALUES
(9, 'Giải trí', 'http://vnexpress.net/', 'http://giaitri.vnexpress.net/', '.title_news a', '', '.thumb a.txt_link img', '', '', 'ul.list_news li', 22, '', 'media/upload/file/news', '.block_tag a', '', '', '2015-02-28 08:26:54', '2015-02-28 08:26:46', '2015-02-28 08:26:46', 2),
(10, 'Đời sống', 'http://vnexpress.net/', 'http://doisong.vnexpress.net/page/2.html', '.title_news a', '', '.thumb a.txt_link img', '', '', 'ul.list_news li', 53, '', 'media/upload/file/news', '.block_tag a', '', '', '2015-03-03 11:25:32', '2015-03-03 11:25:27', '2015-03-03 11:25:27', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_getauto_site_structure`
--

CREATE TABLE IF NOT EXISTS `tkwp_getauto_site_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `field_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `element_delete` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tkwp_getauto_site_structure`
--

INSERT INTO `tkwp_getauto_site_structure` (`id`, `site_id`, `field_name`, `extra`, `element_delete`) VALUES
(26, 9, 'news_name', '.title_news h1', ''),
(27, 9, 'news_detail', '.fck_detail', ''),
(33, 10, 'news_detail', '.fck_detail', ''),
(32, 10, 'news_name', '.title_news h1', '');

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_group`
--

CREATE TABLE IF NOT EXISTS `tkwp_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `group_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `group_order` int(11) NOT NULL,
  `group_create` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_name` (`group_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tkwp_group`
--

INSERT INTO `tkwp_group` (`id`, `group_name`, `group_note`, `group_order`, `group_create`, `user`) VALUES
(1, 'Administrator', 'Quyền cao nhất trong CMS', 1, '2015-02-04 07:20:47', 0),
(2, 'Phòng kế toán', 'Cho phép đăng quản lý thu chi công ty', 2, '2015-02-04 07:30:47', 1),
(3, 'Phòng kinh doanh', 'Quản lý nhân viên kinh doanh', 4, '2015-02-05 19:36:36', 1),
(5, 'Phòng giám đốc', 'Xem được tất cả hoạt động công ty', 3, '2015-02-05 21:23:35', 1),
(6, 'Phòng kỷ thuật', '', 5, '2015-04-06 10:27:38', 1),
(7, 'Phòng nhân sự', '', 7, '2015-04-06 14:49:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_group_action`
--

CREATE TABLE IF NOT EXISTS `tkwp_group_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gc_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gc_value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gc_order` int(11) NOT NULL,
  `gc_create` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gc_name` (`gc_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `tkwp_group_action`
--

INSERT INTO `tkwp_group_action` (`id`, `gc_name`, `gc_value`, `gc_order`, `gc_create`, `user`) VALUES
(1, 'Danh sách menu', 'menu_index', 2, '2015-02-04 21:35:42', 0),
(2, 'Dashboard', 'home_index', 1, '2015-02-04 21:46:37', 0),
(3, 'Thêm mới menu', 'menu_add', 3, '2015-02-04 21:36:05', 0),
(4, 'Cập nhật menu', 'menu_edit', 4, '2015-02-05 18:59:43', 0),
(5, 'Xóa menu', 'menu_delete', 4, '2015-02-05 20:17:21', 0),
(6, 'Tạo alias menu', 'menu_aj_aliasmenu', 6, '2015-02-05 19:51:33', 0),
(7, 'Danh sách bài viết', 'news_index', 1, '2015-02-05 20:23:52', 0),
(8, 'Thêm mới bài viết', 'news_add', 2, '2015-02-05 20:01:01', 0),
(9, 'Cập nhật bài viết', 'news_edit', 0, '2015-02-05 20:01:28', 0),
(10, 'Xóa bài viết', 'news_delete', 3, '2015-02-05 20:01:52', 0),
(11, 'Tạo alias bài viết', 'news_aj_aliasnews', 5, '2015-02-05 20:03:48', 0),
(12, 'Danh sách', 'getauto_index', 1, '2015-02-05 20:23:36', 0),
(13, 'Thêm mới lấy tin tự động', 'getauto_add', 2, '2015-02-05 20:07:01', 0),
(14, 'Cập nhật lấy tin tự động', 'getauto_edit', 3, '2015-02-05 20:09:15', 0),
(15, 'Xóa lấy tin tự động', 'getauto_delete', 4, '2015-02-05 20:09:35', 0),
(16, 'Danh sách config', 'config_index', 1, '2015-02-05 20:23:22', 0),
(17, 'Thêm mới config', 'config_add', 2, '2015-02-05 20:11:27', 0),
(18, 'Cập nhật config', 'config_edit', 3, '2015-02-05 20:11:47', 0),
(19, 'Xóa config', 'config_delete', 4, '2015-02-05 20:12:03', 0),
(20, 'Danh sách group level', 'group_index', 1, '2015-02-05 20:23:42', 0),
(21, 'Thêm mới group level', 'group_add', 1, '2015-02-05 20:13:31', 0),
(22, 'Cập nhật group level', 'group_edit', 3, '2015-02-05 20:13:47', 0),
(23, 'Xóa group level', 'group_delete', 4, '2015-02-05 20:14:04', 0),
(24, 'Danh sách group action', 'groupaction_index', 1, '2015-02-05 20:23:47', 0),
(25, 'Thêm mới group action', 'groupaction_add', 2, '2015-02-05 20:16:25', 0),
(26, 'Cập nhật group action', 'groupaction_edit', 3, '2015-02-05 20:16:41', 0),
(27, 'Xóa group action', 'groupaction_delete', 4, '2015-02-05 20:16:53', 0),
(28, 'Danh sách phòng ban ', 'department_index', 1, '2015-02-05 20:23:28', 0),
(29, 'Thêm mới phòng ban', 'department_add', 2, '2015-02-05 20:20:36', 0),
(30, 'Cập nhật phòng ban', 'department_edit', 3, '2015-02-05 20:20:50', 0),
(31, 'Xóa phòng ban', 'department_delete', 4, '2015-02-05 20:21:09', 0),
(32, 'Quyền truy cập', 'permission_index', 1, '2015-02-05 20:22:47', 0),
(33, 'Quản lý nhân viên', 'user_index', 0, '2015-02-24 14:58:15', 0),
(34, 'Thêm mới nhân viên', 'user_add', 0, '2015-02-24 14:58:34', 0),
(35, 'Cập nhật nhân viên', 'user_edit', 0, '2015-02-24 14:58:47', 0),
(36, 'Xóa nhân viên', 'user_delete', 0, '2015-02-24 15:07:42', 0),
(37, 'Danh sách dịch thuật', 'translate_index', 0, '2015-04-06 17:11:39', 1),
(38, 'Thêm mới dịch', 'translate_add', 0, '2015-04-06 17:14:25', 1),
(39, 'Cập nhật dịch thuật', 'translate_edit', 0, '2015-04-06 17:15:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_history_login`
--

CREATE TABLE IF NOT EXISTS `tkwp_history_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `history_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `history_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `history_department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `history_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `history_time` datetime NOT NULL,
  `history_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `history_version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `history_platform` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Dumping data for table `tkwp_history_login`
--

INSERT INTO `tkwp_history_login` (`id`, `history_username`, `history_group`, `history_department`, `history_ip`, `history_time`, `history_agent`, `history_version`, `history_platform`) VALUES
(1, 'lanchi@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-07 08:38:40', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(2, 'lanchi@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-07 08:53:14', 'Firefox', '37.0', 'Unknown Windows OS'),
(3, 'vantinh@ioi.vn', 'Administrator', 'Phòng kỹ thuật', '115.78.239.14', '2015-04-07 09:23:41', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(4, 'lanchi@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-07 09:50:47', 'Firefox', '37.0', 'Unknown Windows OS'),
(5, 'thaotrang@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-07 09:55:45', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(6, 'vantinh@ioi.vn', 'Administrator', 'Phòng kỹ thuật', '115.78.239.14', '2015-04-07 10:17:10', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(7, 'lanchi@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-07 10:47:09', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(8, 'thaotrang@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-07 11:44:59', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(9, 'vantinh@ioi.vn', 'Administrator', 'Phòng kỹ thuật', '115.78.239.14', '2015-04-07 13:53:47', 'Firefox', '37.0', 'Unknown Windows OS'),
(10, 'vantinh@ioi.vn', 'Administrator', 'Phòng kỹ thuật', '115.78.239.14', '2015-04-07 17:57:24', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(11, 'vantinh@ioi.vn', 'Administrator', 'Phòng kỹ thuật', '115.78.239.14', '2015-04-08 08:22:39', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(12, 'lanchi@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 08:31:09', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(13, 'vantinh@ioi.vn', 'Administrator', 'Phòng kỹ thuật', '115.78.239.14', '2015-04-08 08:34:37', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(14, 'mylinh@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:05:49', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(15, 'vantinh@ioi.vn', 'Administrator', 'Phòng kỹ thuật', '115.78.239.14', '2015-04-08 09:13:21', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(16, 'mylinh@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:13:47', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(17, 'vantinh@ioi.vn', 'Administrator', 'Phòng kỹ thuật', '115.78.239.14', '2015-04-08 09:14:07', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(18, 'hoaimy@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:16:44', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(19, 'nhatngan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:20:44', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(20, 'hoaimy@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:22:08', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(21, 'hoaimy@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:23:18', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(22, 'mylinh@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:26:24', 'Firefox', '37.0', 'Unknown Windows OS'),
(23, 'nhatngan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:28:09', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(24, 'mylinh@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:32:40', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(25, 'mylinh@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:34:06', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(26, 'tranxuan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:39:05', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(27, 'trucly@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:39:15', 'Chrome', '41.0.2272.107', 'Unknown Windows OS'),
(28, 'thuyan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:39:16', 'Firefox', '22.0', 'Unknown Windows OS'),
(29, 'kieungan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:39:46', 'Firefox', '36.0', 'Unknown Windows OS'),
(30, 'tranxuan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:40:55', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(31, 'trucly@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:42:16', 'Chrome', '41.0.2272.107', 'Unknown Windows OS'),
(32, 'thuyan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:42:39', 'Firefox', '22.0', 'Unknown Windows OS'),
(33, 'thuyan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:46:20', 'Firefox', '22.0', 'Unknown Windows OS'),
(34, 'kieungan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:50:03', 'Firefox', '36.0', 'Unknown Windows OS'),
(35, 'thuyan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 09:50:18', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(36, 'mylinh@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 12:05:46', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(37, 'trucly@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 13:41:11', 'Chrome', '41.0.2272.107', 'Unknown Windows OS'),
(38, 'nhatngan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 13:45:10', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(39, 'kieungan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 13:46:29', 'Firefox', '36.0', 'Unknown Windows OS'),
(40, 'thuyan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 13:47:56', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(41, 'nhatngan@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 16:38:53', 'Chrome', '41.0.2272.118', 'Unknown Windows OS'),
(42, 'trucly@ioi.vn', 'Phòng kinh doanh', 'Phòng kinh doanh', '115.78.239.14', '2015-04-08 17:22:38', 'Chrome', '41.0.2272.107', 'Unknown Windows OS');

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_infocontact`
--

CREATE TABLE IF NOT EXISTS `tkwp_infocontact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_name_call` double NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_note` text COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

--
-- Dumping data for table `tkwp_infocontact`
--

INSERT INTO `tkwp_infocontact` (`id`, `company_id`, `contact_name`, `contact_name_call`, `contact_phone`, `contact_email`, `contact_position`, `contact_note`, `user`) VALUES
(1, 1, 'Tuấn', 1, '0908615159', 'tuantoday@yahoo.com', 'thu mua', '', 107),
(4, 4, 'Hiền', 1, '0943305522', 'hienpkd@gmail.com', 'Phòng kinh doanh', 'Phụ trách thu mua trên vp công ty', 107),
(3, 3, 'không có', 1, '08 6272 6677', '', '', 'Ai nghe máy cũng được', 107),
(5, 4, 'báu', 1, '0', 'bauvacopharm@yahoo.com.vn', '', 'ở dưới nhà máy', 107),
(6, 5, 'Mỹ', 2, '0', '', 'Phòng thu mua', 'Thường ở cty vào buổi sáng', 107),
(7, 5, 'Hà', 2, '0', '', 'Trưởng phòng Mar', 'Người dễ chịu, thân thiện', 107),
(8, 6, 'Trần Bảo Nam', 1, '0933805603  ', 'baonam.kia01@gmail.com', 'sales', 'Đang làm sale bên Mazda cộng hòa', 107),
(9, 6, 'Trần Anh Tuấn', 1, '093 880 6073  ', 'trananhtuan2@thaco.com.vn', '', 'peugeot ', 107),
(10, 6, 'Nguyễn Hằng Phương', 1, '0938807200 ', 'nguyenhangphuong@vinamazda.vn', '0938807200 ', 'Mazda 2, 3', 107),
(11, 6, 'Nguyễn Phú Tân ', 1, '093380 5222 ', 'nguyenphutan@thaco.com.vn', 'TP Mar', '', 107),
(12, 6, 'Nguyễn Tấn Ninh ', 1, '0906 968 320  ', 'nguyentanninh@thaco.com.vn', 'Phụ trách PR', 'Đã lập gia đình, hay lên các trang báo phụ nữ để tìm thông tin cho vợ', 107),
(13, 6, 'Kha', 1, '093380 5678 ', '', 'Tổng giám đốc', '', 107),
(14, 6, 'Minh', 1, '093380 5187 ', '', 'Phó Tổng giám đốc', '', 107),
(15, 6, 'Lê Thanh Huân', 1, '0938428661 ', 'lethanhhuan@thaco.com.vn', 'Phụ trách Mar', 'Nhãn ô tô', 107),
(16, 6, 'Huỳnh Tư Duy', 1, '0908 502306 ', 'huynhtuduy@thaco.com.vn', 'Phụ trách Mar ở tổng cty', 'sinh năm 84', 107),
(17, 6, 'Võ Việt Khánh', 1, '0938805 281 ', 'vovietkhanh@vinamazda.vn', 'Phụ trách Mazda khu vực phía Nam', '', 107),
(18, 6, 'Phạm Văn Tài', 1, '0', '', 'Tổng giám đốc nhà máy', '', 107),
(19, 7, 'Tình', 2, '0935131979', 'tinhtran@thuangiapharma.com', 'Phòng thu mua', '', 107),
(20, 8, 'Trãi', 1, '0904313260', 'nguyentraiqn04@gmail.com', 'Phụ trách Mar', '', 107),
(21, 10, 'Mai', 3, '0', 'mai2507@yahoo.com', '', '', 107),
(22, 11, 'Huệ', 3, '0', '', '', 'Nhân viên bên dưới', 107),
(23, 12, 'Trung', 1, '0', '', 'Phòng thu mua', 'Ext: 113', 107),
(24, 14, 'thảo', 3, '0838685166', '', 'thu mua', 'Ở Hồ Chí Minh', 107),
(25, 14, 'Nguyệt', 3, '05113897866', '', 'thu mua', 'chi nhánh Đà Nẵng', 107),
(26, 14, 'Hà', 3, '05113817552', '', 'lễ tân', 'Nói chuyện dễ chịu', 107),
(27, 15, 'Nguyễn Thụy Vi ', 3, '0977794171 ', 'thuyvi.nguyen@ogilvy.com', 'account manager ', 'Bài PR', 107),
(28, 15, 'Nguyễn Khánh Vân ', 3, '0', 'khanhvan.nguyen@ogilvy.com', 'Account Executive ', '', 107),
(29, 15, 'Phạm Phương Mai ', 3, '0917 121818  ', 'phuongmai.pham@ogilvy.com', 'Account Executive ', '', 107),
(30, 15, 'Võ Thanh Hiền ', 3, '0912 21 1804 ', 'thanhhien.vo@ogilvy.com', 'Account Executive ', '', 107),
(31, 16, 'Kế', 1, '0934999834', 'nhukedn@yahoo.com', 'p kế hoạch', '', 107),
(32, 17, 'Nga', 3, '0927222929', 'thuynga.kh@bidiphar.com', 'p thu mua', '', 107),
(33, 18, 'Hùng', 1, '38665842', '', 'thu mua vp phẩm', '', 107),
(34, 19, 'Thành', 3, '0', 'danglethanh88@gmail.com', 'kế hoạch -c ung ứng', 'Ext: 179', 107),
(35, 20, 'Huy', 1, '0838625010', '', '', '', 85),
(36, 21, 'Triết', 1, '0982678910', 'congnghethongtinvnn@gmail.com', 'Giám đốc', '', 106),
(37, 25, 'Lê Đức Tài', 1, '0963321984', 'daiphattai1984@gmail.com', 'Giám đốc', '', 114),
(38, 18, 'Hải', 1, '38665842', 'ngohung0206@yahoo.com', 'thu mua vp phẩm', 'dễ chịu. Nói chuyện thân thiện, cũng lớn tuổi', 107),
(39, 24, 'Chưa biết', 3, '0838296276', '', 'Lễ tân', '', 114),
(40, 27, 'Thu', 1, '01285619099', 'nguyenminhthu012@gmail.com', 'thu mua', 'chung phòng anh Nam', 107),
(41, 27, 'Nam', 1, '0', '', 'thu mua', 'hay đi công tác', 107),
(42, 26, 'Hồ Thanh Khiêm', 1, '0932108687', 'thanhkhiem05@gmail.com', 'Nhân viên IT', '', 114),
(43, 28, 'Chưa biết', 3, '0838422172', '', 'Lễ tân', 'Lễ tân không cho gặp anh chị đảm trách web, bảo để thông tin lại rồi liên hệ lại sau.', 110),
(44, 24, 'Phạm Ngọc Sơn', 1, '0903647620', 'phamngocson62@ymail.com', 'Giám đốc', 'Hiện tại công ty chưa có nhu cầu thiết kế website mới', 114),
(45, 29, 'Tuấn', 1, '0', 'vidipha@hcm.vnn.vn', 'p kế hoạch', '', 107),
(46, 30, 'Phan Vi Băng', 0, '0904397949', 'ctymucinhoasen@gmail.com', 'Giám đốc', '', 114),
(47, 31, 'Chưa biết', 3, '0839650085', '', 'Lễ tân', '', 114),
(48, 32, 'Thư', 3, '0978696428', '', 'Nhân viên văn phòng', 'Số đt của a. Hoàng: 0908821010', 114),
(49, 33, 'Chưa biết', 1, '0838386486', '', 'CSKH', '', 114),
(50, 34, 'Huỳnh Thị Kiều Nga', 3, '0973548759', 'huynhkieunga_90@yahoo.com', 'Giám đốc', '', 114),
(51, 13, 'Như', 3, '0909721158', 'dohuynhnhu@namduoc.vn', 'thu mua', 'Hà Nội làm phần in logo. trong nam chỉ thu mua loại ko in logo', 107),
(52, 35, 'Tô Kim Tuyền', 3, '0937241276', '', 'Giám đốc', '', 114),
(53, 36, 'Phạm Văn Tam', 1, '0909799345', 'phamtam503@gmail.com', 'Giám đốc', '', 114),
(54, 37, 'Dương Thanh Thảo', 3, '0835158291', 'duongthanhthaopt@yahoo.com', 'Kế toán', 'Ngày 22/06/2015 hết hạn tên miền, đang sử dụng dịch vụ củ PA. ', 114),
(55, 38, 'Mai', 3, '39571962', 'mai2507@yahoo.com', 'thu mua', '', 107),
(56, 38, 'Mai', 3, '39571962', 'mai2507@yahoo.com', 'thu mua', '', 107),
(57, 39, 'Mỹ', 1, '0977770906', 'myvt@sps.vn', '', '', 106),
(58, 41, 'Đào Đức Hạnh', 1, '0975311155', '', 'Giám đốc Kinh Doanh', 'Website đang trong quá trình xây dựng', 114),
(59, 42, 'Linh', 1, '0987450303', '', '', '', 106),
(60, 43, 'Huề', 1, '0972.126.126', 'support@kenhdichvu.vn', '', '', 106),
(61, 44, 'Ngô Thị My', 3, '0839911282', 'ngomy@koreaking.com.vn', 'Trợ Lý', '', 114),
(62, 45, 'Đỗ Đức Thắng', 1, '0913777633', '', 'Giám đốc', '', 114),
(63, 46, 'Sơn', 1, '0983419983', 'sonkt@nobi.vn', '', '', 106),
(64, 47, 'Kiều', 3, '0839682282', 'ntkk76@yahoo.com', 'Nhân viên IT', '', 114),
(65, 48, 'Đạt', 1, '0944186622', 'giadungdongduong@gmail.com', 'Giám đốc', 'Công ty sử dụng dịch vụ thiết kế website và hosting của Nina. Tên miền hết thời gian gia hạn vào ngày 29/6/2015, website vẫn đi theo công nghệ cũ chèn hình ảnh dạng Flash', 114),
(66, 49, 'Chưa biết', 3, '0835925242', '', 'Lễ tân', '', 114),
(67, 52, 'Ngọc', 3, '(08)38863299', 'ngocmono1811@gmail.com', 'Phụ trách', 'Bên công ty sắp hết hạn tên miền, có ý định đổi dịch vụ hosting luôn, gửi những thông tin của công ty sang cho chị đi, chị xem xét.', 110),
(68, 53, 'Liêm', 1, '0935714768', 'hanhcafevietnam@gmail.com', 'Phụ trách', 'CHị Hạnh chuyển máy sang anh Lâm, anh cũng mới vào làm ở công ty thôi, nên thông tin về web của công ty anh cũng chưa nắm rõ, tương lai anh muốn mở rộng chức năng của web, trình lên sếp, em ở đơn vị nào gửi mail cho anh tham khảo rồi anh liên hệ lại.', 110),
(69, 54, 'Lan', 3, '0909300319', '', 'Phụ trách', 'Chị đang đi công tác, mai gọi lại.', 110),
(70, 50, 'Nguyên', 3, '0968044205', '', 'Nhân viên IT', '', 114),
(71, 55, 'Ngô Phước Hà', 1, '0903612650', '', 'Giám đốc', '', 114),
(72, 56, 'Hà', 3, '0938205056', '', 'Giám đốc', '', 114),
(73, 57, 'Trần Quang Thành', 1, '0907869050', '', 'Giám đốc', '', 114),
(74, 59, 'chưa biết', 0, '(08)38993158', '', 'tiếp tân', 'hơi khó chịu', 109),
(75, 58, 'chưa biết', 0, '(84.8) 3762 5293 ', '', 'tiếp tân', 'cai gi cung ko biết hết', 109),
(76, 60, 'Tuấn', 1, '0908859876', '', 'Nhân viên HCNS', '', 114),
(77, 60, 'Chưa biết', 0, '0854495746', '', '', '', 114),
(78, 61, 'Nguyễn Thị Phượng', 3, '0907990889', '', 'Chủ Cửa Hàng', '', 114),
(79, 63, 'Vũ Duy Phương', 1, '0946755760', '', '', '', 114),
(80, 64, 'Vũ Thế Duy', 1, '0933839405', '', 'Phó Giám Đốc', '', 114),
(81, 66, 'Chưa biết', 1, '0866756762', '', 'Quản lý website', '', 114),
(82, 68, 'Oanh', 3, ' 0936143341', 'kazuoanh@gmail.com', '', '', 106),
(83, 69, 'Chưa biết', 1, '0838601459', '', 'Nhân viên văn phòng', '', 114),
(84, 72, 'Tuấn', 1, '0988851156', 'tuankim@dim.vn', '', '', 106),
(85, 73, 'Trung', 1, ' 0904.945.840', '', '', '', 106),
(86, 74, 'Duy Anh', 1, '0915.852.256', '', '', '', 106),
(87, 75, 'Lễ tân', 4, '0438560777', '', '', '', 106),
(88, 76, 'Hồ Công Thành', 1, '0938456756', '', 'Giám đốc', '', 114),
(89, 77, 'Linh', 1, '0904237347', '', '', '', 106),
(90, 76, 'Chưa biết', 1, '0839784730', '', 'CSKH', '', 114),
(91, 78, 'Điện thoại bàn', 4, '05113600123', '', '', '', 106),
(92, 78, 'Phương', 1, '0914002002', 'thanhphuongtran93@gmail.com', '', '', 106),
(93, 79, 'Bình', 1, '0917030030', '', '', '', 106),
(94, 80, 'Thủy', 3, '0989937913', 'thuydn@demxinh.vn', '', '', 106),
(95, 81, 'Lễ tân', 0, '38229633', '', '', '', 106),
(96, 82, 'Vương', 1, '0985212237', 'phuvuongtranit@gmail.com', '', '', 106),
(97, 83, 'Hâu', 1, '0907537513', 'hau.pct@kaikovietnam.com', '', '', 106),
(98, 84, 'Loh', 1, '0902004111', 'loh@mail.com.my', 'Giám đốc', '', 106),
(99, 85, 'Điện thoại bàn', 4, '(04)3.5739.741', '', '', '', 106),
(100, 86, 'Lâm', 1, '0862958238', 'vantailamphat@gmail.com', 'Phụ trách', 'Không có nhu cầu', 110),
(101, 87, 'Kim', 3, '0838248901', 'namquoc@vnn.vn', 'Phụ trách', 'Không có nhu cầu', 110),
(102, 88, 'Chưa biết', 4, '0838118683', '', 'Chưa biết', 'sai số', 110),
(103, 89, 'Chưa biết', 1, '0838386648', 'info@hmdestination.com', 'Lễ tân', 'Anh Kiên phụ trách về rồi, mai gọi lại', 110),
(104, 90, 'Bình', 1, '0866604500', 'sieuthidaunhot@gmail.com', 'Phụ trách', 'Bên anh có đơn vị ký hợp đồng 3,4 rồi hết hạn tên miền, hosting họ sẽ tự động gửi mail nhắc, nếu bên em có giá tốt hơn thì gửi mail anh xem đi.', 110),
(105, 91, 'Chưa biết', 3, '0838330220', '', 'Lễ tân', 'Không nghe máy', 110);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_mailto`
--

CREATE TABLE IF NOT EXISTS `tkwp_mailto` (
  `id` int(11) NOT NULL,
  `mailto_fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailto_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailto_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailto_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailto_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailto_content` text COLLATE utf8_unicode_ci NOT NULL,
  `mailto_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailto_create_date` datetime NOT NULL,
  `mailto_status` tinyint(4) NOT NULL,
  `mailto_read` tinyint(4) NOT NULL,
  `mailto_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_mailto_send`
--

CREATE TABLE IF NOT EXISTS `tkwp_mailto_send` (
  `id` int(11) NOT NULL,
  `mailto_send_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailto_send_content` text COLLATE utf8_unicode_ci NOT NULL,
  `mailto_send_attach_file` text COLLATE utf8_unicode_ci NOT NULL,
  `mailto_send_list_user` text COLLATE utf8_unicode_ci NOT NULL,
  `mailto_send_create_date` int(11) NOT NULL,
  `mailto_send_status` tinyint(4) NOT NULL,
  `controller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_menu`
--

CREATE TABLE IF NOT EXISTS `tkwp_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_link_id` tinyint(4) NOT NULL,
  `menu_alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_com` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_view` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_orderby` int(11) NOT NULL,
  `menu_status` tinyint(11) NOT NULL,
  `menu_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_xml` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_create_date` datetime NOT NULL,
  `menu_update_date` datetime NOT NULL,
  `menu_seo_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_seo_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_seo_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=73 ;

--
-- Dumping data for table `tkwp_menu`
--

INSERT INTO `tkwp_menu` (`id`, `menu_name`, `menu_link_id`, `menu_alias`, `menu_link`, `menu_detail`, `menu_parent`, `menu_com`, `menu_view`, `menu_orderby`, `menu_status`, `menu_picture`, `menu_xml`, `menu_create_date`, `menu_update_date`, `menu_seo_title`, `menu_seo_description`, `menu_seo_keyword`, `user`) VALUES
(67, 'Thời cuộc', 1, 'thoi-cuoc', '', '', 1, 'news', 'list', 1, 1, '', '', '2015-01-28 03:38:11', '2015-01-28 03:58:03', '', '', '', 0),
(2, 'Mới và nóng', 1, 'moi-va-nong', '', '', 67, 'news', 'list', 1, 1, '', '', '2015-01-28 03:38:33', '2015-01-28 03:38:33', '', '', '', 0),
(3, 'Giới và phát triển', 1, 'gioi-va-phat-trien', '', '', 67, 'news', 'list', 2, 1, '', '', '2015-01-28 03:38:58', '2015-01-28 03:38:58', '', '', '', 0),
(4, 'Nhịp đời', 1, 'nhip-doi', '', '', 67, 'news', 'list', 3, 1, '', '', '2015-01-28 03:39:35', '2015-01-28 03:39:35', '', '', '', 0),
(5, '8 Web', 1, '8-web', '', '', 67, 'news', 'list', 4, 1, '', '', '2015-01-28 03:46:16', '2015-01-28 03:46:16', '', '', '', 0),
(6, 'Khỏe', 1, 'khoe', '', '', 1, 'news', 'list', 2, 1, '', '', '2015-01-28 03:47:39', '2015-01-28 03:47:39', '', '', '', 0),
(7, 'Phòng mạch nữ', 1, 'phong-mach-nu', '', '', 6, 'news', 'list', 1, 1, '', '', '2015-01-28 03:48:05', '2015-01-28 03:48:05', '', '', '', 0),
(8, 'Thuốc Eva', 1, 'thuoc-eva', '', '', 6, 'news', 'list', 2, 1, '', '', '2015-01-28 03:48:22', '2015-01-28 03:48:22', '', '', '', 0),
(9, 'Thai giáo', 1, 'thai-giao', '', '', 6, 'news', 'list', 3, 1, '', '', '2015-01-28 03:48:39', '2015-01-28 03:48:39', '', '', '', 0),
(10, 'TMK', 1, 'tmk', '', '', 6, 'news', 'list', 4, 1, '', '', '2015-01-28 03:49:02', '2015-01-28 03:49:02', '', '', '', 0),
(11, 'Nam học bí ẩn', 1, 'nam-hoc-bi-an', '', '', 6, 'news', 'list', 5, 1, '', '', '2015-01-28 03:49:22', '2015-01-28 03:49:22', '', '', '', 0),
(12, 'Gym', 1, 'gym', '', '', 6, 'news', 'list', 6, 1, '', '', '2015-01-28 03:49:39', '2015-01-28 03:49:39', '', '', '', 0),
(13, 'Nhật ký bệnh viện', 1, 'nhat-ky-benh-vien', '', '', 6, 'news', 'list', 7, 1, '', '', '2015-01-28 03:49:58', '2015-01-28 03:53:36', '', '', '', 0),
(14, 'Đẹp', 1, 'dep', '', '', 1, 'news', 'list', 3, 1, '', '', '2015-01-28 03:50:48', '2015-01-28 03:50:48', '', '', '', 0),
(15, 'Duyên', 1, 'duyen', '', '', 14, 'news', 'list', 1, 1, '', '', '2015-01-28 03:51:05', '2015-01-28 03:51:05', '', '', '', 0),
(16, 'Nhan sắc', 1, 'nhan-sac', '', '', 14, 'news', 'list', 2, 1, '', '', '2015-01-28 03:51:25', '2015-01-28 03:51:25', '', '', '', 0),
(17, 'Phong cách', 1, 'phong-cach', '', '', 14, 'news', 'list', 3, 1, '', '', '2015-01-28 03:51:50', '2015-01-28 03:51:50', '', '', '', 0),
(18, 'Nước hoa Gallery', 1, 'nuoc-hoa-gallery', '', '', 14, 'news', 'list', 4, 1, '', '', '2015-01-28 03:52:10', '2015-01-28 03:52:10', '', '', '', 0),
(19, 'Mười vạn mẹo', 1, 'muoi-van-meo', '', '', 14, 'news', 'list', 5, 1, '', '', '2015-01-28 03:52:36', '2015-01-28 03:52:36', '', '', '', 0),
(20, 'Showbit', 1, 'showbit', '', '', 14, 'news', 'list', 6, 1, '', '', '2015-01-28 03:53:16', '2015-01-28 03:53:16', '', '', '', 0),
(21, 'Miss Photo', 1, 'miss-photo', '', '', 14, 'news', 'list', 7, 1, '', '', '2015-01-28 03:54:04', '2015-01-28 03:54:04', '', '', '', 0),
(22, 'Yêu', 1, 'yeu', '', '', 1, 'news', 'list', 4, 1, '', '', '2015-01-28 03:54:37', '2015-01-28 03:54:37', '', '', '', 0),
(23, 'Sao Hỏa - Sao Kim', 1, 'sao-hoa-sao-kim', '', '', 22, 'news', 'list', 1, 1, '', '', '2015-01-28 03:55:09', '2015-01-28 03:55:09', '', '', '', 0),
(24, 'Kĩ năng yêu', 1, 'ki-nang-yeu', '', '', 22, 'news', 'list', 2, 1, '', '', '2015-01-28 03:55:29', '2015-01-28 03:55:29', '', '', '', 0),
(25, 'Cưới', 1, 'cuoi', '', '', 22, 'news', 'list', 3, 1, '', '', '2015-01-28 03:56:06', '2015-01-28 03:56:06', '', '', '', 0),
(26, 'Gia đình trẻ', 1, 'gia-dinh-tre', '', '', 22, 'news', 'list', 4, 1, '', '', '2015-01-28 03:56:27', '2015-01-28 03:56:27', '', '', '', 0),
(27, 'Đơn & Đa', 1, 'don-da', '', '', 22, 'news', 'list', 5, 1, '', '', '2015-01-28 03:57:13', '2015-01-28 03:57:13', '', '', '', 0),
(28, 'Chuyện tình', 1, 'chuyen-tinh', '', '', 22, 'news', 'list', 6, 1, '', '', '2015-01-28 03:57:36', '2015-01-28 03:57:36', '', '', '', 0),
(29, 'Yêu bằng tai', 1, 'yeu-bang-tai', '', '', 22, 'news', 'list', 7, 1, '', '', '2015-01-28 03:59:17', '2015-01-28 03:59:17', '', '', '', 0),
(30, 'Thanh tâm', 1, 'thanh-tam', '', '', 1, 'news', 'list', 5, 1, '', '', '2015-01-28 04:20:47', '2015-01-28 04:20:47', '', '', '', 0),
(31, 'Bản tin thanh tâm', 1, 'ban-tin-thanh-tam', '', '', 30, 'news', 'list', 1, 1, '', '', '2015-01-28 04:21:05', '2015-01-28 04:21:05', '', '', '', 0),
(32, 'Thanh Tâm tư vấn', 1, 'thanh-tam-tu-van', '', '', 30, 'news', 'list', 2, 1, '', '', '2015-01-28 04:22:29', '2015-01-28 04:22:29', '', '', '', 0),
(33, 'Thử làm thanh tâm', 1, 'thu-lam-thanh-tam', '', '', 30, 'news', 'list', 3, 1, '', '', '2015-01-28 04:22:45', '2015-01-28 04:22:45', '', '', '', 0),
(34, 'CLB kết bạn', 1, 'clb-ket-ban', '', '', 30, 'news', 'list', 4, 1, '', '', '2015-01-28 04:23:09', '2015-01-28 04:23:09', '', '', '', 0),
(35, 'Chân dung "mã số"', 1, 'chan-dung-ma-so', '', '', 30, 'news', 'list', 5, 1, '', '', '2015-01-28 04:23:40', '2015-01-28 04:23:40', '', '', '', 0),
(36, 'Thông thái', 1, 'thong-thai', '', '', 1, 'news', 'list', 6, 1, '', '', '2015-01-28 04:24:02', '2015-01-28 04:24:02', '', '', '', 0),
(37, 'Bí quyết thành công', 1, 'bi-quyet-thanh-cong', '', '', 36, 'news', 'list', 1, 1, '', '', '2015-01-28 04:24:23', '2015-01-28 04:24:23', '', '', '', 0),
(38, 'Chuyện "người giàu"', 1, 'chuyen-nguoi-giau', '', '', 36, 'news', 'list', 2, 1, '', '', '2015-01-28 04:31:42', '2015-01-28 04:31:42', '', '', '', 0),
(39, 'Công nghệ tay mềm', 1, 'cong-nghe-tay-mem', '', '', 36, 'news', 'list', 3, 1, '', '', '2015-01-28 04:32:55', '2015-01-28 04:32:55', '', '', '', 0),
(40, 'Tốc độ', 1, 'toc-do', '', '', 36, 'news', 'list', 4, 1, '', '', '2015-01-28 04:33:10', '2015-01-28 04:33:10', '', '', '', 0),
(41, 'Không biết hỏi ai', 1, 'khong-biet-hoi-ai', '', '', 36, 'news', 'list', 5, 1, '', '', '2015-01-28 04:33:27', '2015-01-28 04:33:27', '', '', '', 0),
(42, 'Camera phụ huynh', 1, 'camera-phu-huynh', '', '', 1, 'news', 'list', 7, 1, '', '', '2015-01-28 04:33:50', '2015-01-28 04:33:50', '', '', '', 0),
(43, 'Soi 24/7', 1, 'soi-247', '', '', 42, 'news', 'list', 1, 1, '', '', '2015-01-28 04:34:19', '2015-01-28 04:34:19', '', '', '', 0),
(44, 'Làm mẹ thiên tài', 1, 'lam-me-thien-tai', '', '', 42, 'news', 'list', 2, 1, '', '', '2015-01-28 04:34:44', '2015-01-28 04:34:44', '', '', '', 0),
(45, 'Cha - con', 1, 'cha-con', '', '', 42, 'news', 'list', 3, 1, '', '', '2015-01-28 04:35:11', '2015-01-28 04:35:11', '', '', '', 0),
(46, 'Từ điển 10x', 1, 'tu-dien-10x', '', '', 42, 'news', 'list', 4, 1, '', '', '2015-01-28 04:35:32', '2015-01-28 04:35:32', '', '', '', 0),
(47, 'Đồng tiền khôn', 1, 'dong-tien-khon', '', '', 1, 'news', 'list', 8, 1, '', '', '2015-01-28 04:35:59', '2015-01-28 04:35:59', '', '', '', 0),
(48, 'Giá chợ hôm nay', 1, 'gia-cho-hom-nay', '', '', 47, 'news', 'list', 1, 1, '', '', '2015-01-28 04:36:19', '2015-01-28 04:36:19', '', '', '', 0),
(49, 'Dịch vụ gia đình', 1, 'dich-vu-gia-dinh', '', '', 47, 'news', 'list', 2, 1, '', '', '2015-01-28 04:36:46', '2015-01-28 04:36:46', '', '', '', 0),
(50, 'Sale', 1, 'sale', '', '', 47, 'news', 'list', 3, 1, '', '', '2015-01-28 04:37:01', '2015-01-28 04:37:01', '', '', '', 0),
(51, 'Khách hàng thông thái', 1, 'khach-hang-thong-thai', '', '', 47, 'news', 'list', 4, 1, '', '', '2015-01-28 04:37:22', '2015-01-28 04:37:22', '', '', '', 0),
(52, 'Tiếng nói "thượng đế"', 1, 'tieng-noi-thuong-de', '', '', 47, 'news', 'list', 5, 1, '', '', '2015-01-28 04:39:07', '2015-01-28 04:39:07', '', '', '', 0),
(53, 'Sống chậm', 1, 'song-cham', '', '', 1, 'news', 'list', 9, 1, '', '', '2015-01-28 04:39:30', '2015-01-28 04:39:30', '', '', '', 0),
(54, 'Khéo - Khiếu', 1, 'kheo-khieu', '', '', 53, 'news', 'list', 1, 1, '', '', '2015-01-28 04:40:24', '2015-01-28 04:40:24', '', '', '', 0),
(55, 'Cân bằng cuộc sống', 1, 'can-bang-cuoc-song', '', '', 53, 'news', 'list', 2, 1, '', '', '2015-01-28 04:40:45', '2015-01-28 04:40:45', '', '', '', 0),
(56, 'Đi - Đến', 1, 'di-den', '', '', 53, 'news', 'list', 3, 1, '', '', '2015-01-28 04:41:04', '2015-01-28 04:41:04', '', '', '', 0),
(57, '"Trao yêu thương - nhân hạnh phúc"', 1, 'trao-yeu-thuong-nhan-hanh-phuc', '', '', 53, 'news', 'list', 4, 1, '', '', '2015-01-28 04:41:41', '2015-01-28 04:41:41', '', '', '', 0),
(58, 'Hạnh phúc có thật', 1, 'hanh-phuc-co-that', '', '', 53, 'news', 'list', 5, 1, '', '', '2015-01-28 04:41:59', '2015-01-28 04:41:59', '', '', '', 0),
(59, 'Góc tâm hồn', 1, 'goc-tam-hon', '', '', 1, 'news', 'list', 10, 1, '', '', '2015-01-28 04:42:22', '2015-01-28 04:42:22', '', '', '', 0),
(60, 'Nốt nhạc mềm', 1, 'not-nhac-mem', '', '', 59, 'news', 'list', 1, 1, '', '', '2015-01-28 04:43:10', '2015-01-28 04:43:10', '', '', '', 0),
(61, 'Màn hình Zero inch', 1, 'man-hinh-zero-inch', '', '', 59, 'news', 'list', 2, 1, '', '', '2015-01-28 04:43:39', '2015-01-28 04:43:39', '', '', '', 0),
(62, 'Truyện kể', 1, 'truyen-ke', '', '', 59, 'news', 'list', 3, 1, '', '', '2015-01-28 04:43:56', '2015-01-28 04:43:56', '', '', '', 0),
(63, 'Blog', 1, 'blog', '', '', 59, 'news', 'list', 4, 1, '', '', '2015-01-28 04:44:12', '2015-01-28 04:44:12', '', '', '', 0),
(64, 'Kho báu', 1, 'kho-bao', '', '', 1, 'news', 'list', 11, 1, '', '', '2015-01-28 04:44:29', '2015-01-28 04:44:29', '', '', '', 0),
(65, 'Bách khoa thư phụ nữ', 1, 'bach-khoa-thu-phu-nu', '', '', 64, 'news', 'list', 1, 1, '', '', '2015-01-28 04:44:55', '2015-01-28 04:44:55', '', '', '', 0),
(66, 'Links', 1, 'links', '', '', 64, 'news', 'list', 2, 1, '', '', '2015-01-28 04:45:15', '2015-01-28 04:45:15', '', '', '', 0),
(1, 'Menu main', 1, 'menu-main', '', '', 0, 'home', '', 1, 1, '/media/upload/file/tu-bo-hoa-cam-tay-cho-co-dau-3.jpg', '', '2015-01-28 04:46:54', '2015-02-26 15:43:46', '', '', '', 2),
(68, 'Menu footer', 1, 'menu-footer', '', '', 0, 'news', 'list', 2, 1, '', '', '2015-01-28 04:48:46', '2015-01-28 04:48:46', '', '', '', 0),
(69, 'Tuyển dụng', 1, 'tuyen-dung', '', '', 68, 'news', 'list', 1, 1, '', '', '2015-01-28 04:49:18', '2015-01-28 04:49:18', '', '', '', 0),
(70, 'Quảng cáo', 1, 'quang-cao', '', '', 68, 'news', 'list', 2, 1, '', '', '2015-01-28 04:49:32', '2015-01-28 04:49:32', '', '', '', 0),
(71, 'Liên hệ', 1, 'lien-he', '', '', 68, 'contact', '', 3, 1, '', '', '2015-01-28 04:50:00', '2015-01-28 04:50:00', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_message`
--

CREATE TABLE IF NOT EXISTS `tkwp_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ms_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ms_content` text COLLATE utf8_unicode_ci NOT NULL,
  `ms_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ms_department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ms_userid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ms_status` tinyint(4) NOT NULL DEFAULT '1',
  `ms_create_date` datetime NOT NULL,
  `ms_update_date` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ms_title` (`ms_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tkwp_message`
--

INSERT INTO `tkwp_message` (`id`, `ms_title`, `ms_content`, `ms_group`, `ms_department`, `ms_userid`, `ms_status`, `ms_create_date`, `ms_update_date`, `user`) VALUES
(9, 'Gửi thông báo lỗi hoặc hiện tượng bất thường trên CRM khi quá 10 phút', '<p style="text-align: center;"><img src="http://data.ioi.vn/media/upload/file/gui_thong_bao_loi.png" alt="" width="800" /></p>', '', '', '', 1, '2015-04-08 00:00:00', '2015-04-08 17:52:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_news`
--

CREATE TABLE IF NOT EXISTS `tkwp_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_type` tinyint(4) NOT NULL,
  `news_event` int(11) NOT NULL,
  `news_parent` int(11) NOT NULL,
  `news_orderby` int(11) NOT NULL,
  `news_search` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_summary` text COLLATE utf8_unicode_ci NOT NULL,
  `news_detail` longtext COLLATE utf8_unicode_ci,
  `news_view` int(11) NOT NULL,
  `news_hot` tinyint(4) NOT NULL,
  `news_vip` tinyint(4) NOT NULL,
  `news_home` tinyint(4) NOT NULL,
  `news_comment` tinyint(4) NOT NULL,
  `news_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_seo_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_seo_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_seo_description` text COLLATE utf8_unicode_ci NOT NULL,
  `news_status` tinyint(4) NOT NULL,
  `news_status_note` text COLLATE utf8_unicode_ci NOT NULL,
  `news_begin_date` datetime NOT NULL,
  `news_end_date` datetime NOT NULL,
  `news_create_date` datetime NOT NULL,
  `news_update_date` datetime NOT NULL,
  `news_source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_lang` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `news_name` (`news_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=277 ;

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_permission`
--

CREATE TABLE IF NOT EXISTS `tkwp_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gc_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `per_create` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `tkwp_permission`
--

INSERT INTO `tkwp_permission` (`id`, `gc_id`, `group_id`, `per_create`, `user`) VALUES
(1, 17, 1, '2015-02-05 20:57:11', 0),
(2, 17, 4, '2015-02-05 20:57:35', 0),
(3, 18, 1, '2015-02-05 21:09:56', 0),
(5, 19, 1, '2015-02-05 21:10:54', 0),
(6, 16, 1, '2015-02-05 21:11:06', 0),
(7, 29, 1, '2015-02-05 21:11:12', 0),
(8, 31, 1, '2015-02-05 21:11:13', 0),
(9, 30, 1, '2015-02-05 21:11:14', 0),
(10, 28, 1, '2015-02-05 21:11:14', 0),
(11, 13, 1, '2015-02-05 21:11:15', 0),
(12, 15, 1, '2015-02-05 21:11:18', 0),
(13, 14, 1, '2015-02-05 21:11:19', 0),
(14, 12, 1, '2015-02-05 21:11:19', 0),
(15, 21, 1, '2015-02-05 21:11:20', 0),
(16, 23, 1, '2015-02-05 21:11:20', 0),
(17, 22, 1, '2015-02-05 21:11:21', 0),
(18, 20, 1, '2015-02-05 21:11:21', 0),
(19, 27, 1, '2015-02-05 21:11:23', 0),
(20, 25, 1, '2015-02-05 21:11:23', 0),
(21, 3, 1, '2015-02-05 21:11:24', 0),
(22, 2, 1, '2015-02-05 21:11:25', 0),
(23, 24, 1, '2015-02-05 21:11:25', 0),
(24, 26, 1, '2015-02-05 21:11:26', 0),
(25, 6, 1, '2015-02-05 21:11:27', 0),
(26, 5, 1, '2015-02-05 21:11:27', 0),
(27, 4, 1, '2015-02-05 21:11:28', 0),
(28, 1, 1, '2015-02-05 21:11:28', 0),
(29, 8, 1, '2015-02-05 21:11:30', 0),
(30, 11, 1, '2015-02-05 21:11:31', 0),
(31, 10, 1, '2015-02-05 21:11:32', 0),
(32, 9, 1, '2015-02-05 21:11:32', 0),
(33, 7, 1, '2015-02-05 21:11:33', 0),
(34, 32, 1, '2015-02-05 21:11:34', 0),
(35, 1, 12, '2015-02-05 21:15:11', 0),
(38, 19, 5, '2015-02-05 21:33:41', 0),
(39, 18, 5, '2015-02-05 21:33:55', 0),
(40, 16, 5, '2015-02-05 21:34:12', 0),
(42, 29, 5, '2015-02-05 21:35:17', 0),
(43, 31, 5, '2015-02-05 21:35:20', 0),
(45, 27, 5, '2015-02-05 21:38:02', 0),
(46, 30, 5, '2015-02-05 21:39:08', 0),
(47, 28, 5, '2015-02-05 21:39:12', 0),
(48, 13, 5, '2015-02-05 21:39:13', 0),
(49, 15, 5, '2015-02-05 21:41:14', 0),
(50, 14, 5, '2015-02-05 21:41:16', 0),
(51, 17, 5, '2015-02-05 21:42:42', 0),
(52, 12, 5, '2015-02-05 21:43:33', 0),
(53, 21, 5, '2015-02-05 21:43:34', 0),
(54, 22, 5, '2015-02-05 21:43:35', 0),
(55, 23, 5, '2015-02-05 21:44:00', 0),
(56, 20, 5, '2015-02-05 21:44:01', 0),
(57, 25, 5, '2015-02-05 21:44:01', 0),
(58, 24, 5, '2015-02-05 21:44:04', 0),
(59, 26, 5, '2015-02-05 21:44:04', 0),
(60, 2, 5, '2015-02-05 21:44:16', 0),
(61, 17, 2, '2015-02-05 21:44:45', 0),
(68, 19, 2, '2015-02-05 21:46:49', 0),
(69, 18, 2, '2015-02-05 21:46:50', 0),
(70, 16, 2, '2015-02-05 21:46:55', 0),
(71, 29, 2, '2015-02-05 21:46:57', 0),
(72, 17, 3, '2015-02-05 21:47:36', 0),
(73, 19, 3, '2015-02-05 21:47:37', 0),
(74, 18, 3, '2015-02-05 21:47:38', 0),
(75, 16, 3, '2015-02-05 21:47:43', 0),
(76, 29, 3, '2015-02-05 21:47:45', 0),
(77, 31, 2, '2015-02-05 21:48:09', 0),
(78, 31, 3, '2015-02-05 21:48:23', 0),
(79, 17, 6, '2015-02-12 09:57:04', 0),
(80, 34, 1, '2015-02-24 14:58:58', 0),
(81, 35, 1, '2015-02-24 14:58:58', 0),
(82, 33, 1, '2015-02-24 14:58:59', 0),
(83, 36, 1, '2015-02-25 17:42:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_translate`
--

CREATE TABLE IF NOT EXISTS `tkwp_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translate_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `translate_type` int(11) NOT NULL,
  `translate_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `translate_create_date` date NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `translate_name` (`translate_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tkwp_translate`
--

INSERT INTO `tkwp_translate` (`id`, `translate_name`, `translate_type`, `translate_code`, `translate_create_date`, `user`) VALUES
(6, 'Thêm mới', 1, 'them_moi', '2015-03-02', 2),
(7, 'Xem thêm', 1, 'xem_them', '2015-04-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_translate_lang`
--

CREATE TABLE IF NOT EXISTS `tkwp_translate_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `translate_lang` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `translate_id` int(11) NOT NULL,
  `translate_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tkwp_translate_lang`
--

INSERT INTO `tkwp_translate_lang` (`id`, `translate_lang`, `translate_id`, `translate_name`) VALUES
(12, 'en', 6, 'Add'),
(11, 'vn', 6, 'Thêm mới'),
(13, 'vn', 7, 'Xem thêm'),
(14, 'en', 7, 'Read more');

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_user`
--

CREATE TABLE IF NOT EXISTS `tkwp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_password` char(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_parent` int(11) NOT NULL,
  `user_group` int(11) NOT NULL,
  `user_department` int(11) NOT NULL,
  `user_position` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_gender` tinyint(4) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_hotline` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_yahoo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_google` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_twitter` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_skype` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_intro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_createdate` datetime NOT NULL,
  `user_updatedate` datetime NOT NULL,
  `user_folder` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_status` tinyint(4) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=118 ;

--
-- Dumping data for table `tkwp_user`
--

INSERT INTO `tkwp_user` (`id`, `user_username`, `user_password`, `user_fullname`, `user_parent`, `user_group`, `user_department`, `user_position`, `user_gender`, `user_birthday`, `user_address`, `user_hotline`, `user_email`, `user_yahoo`, `user_google`, `user_facebook`, `user_twitter`, `user_skype`, `user_intro`, `user_website`, `user_avatar`, `user_createdate`, `user_updatedate`, `user_folder`, `user_status`, `user`) VALUES
(1, 'vantinh@ioi.vn', 'e10adc3949ba59abbe56e057f20f883e', 'Tình Văn Nguyễn', 12, 1, 2, 'Phòng dự án', 1, '2015-02-24', '161 Tran Quoc Thao, QUan 3', '0909 977 920', 'vantinh@ioi.vn', 'nguyenvantinh91@gmail.com', 'http://google.com.vn', 'https://www.facebook.com/?_rdr', 'https://twitter.com/?lang=vi', 'tinhnguyenvan91', 'sinh ra long an', 'http://www.tinhnguyenvan.blogspot.com/', '/media/upload/file/hosonhanvien/image.jpg', '2015-02-24 14:20:17', '2015-04-08 09:00:25', '', 1, 1),
(31, 'daothithuhao93@gmail.com', '5f0d9a2ec5a568d387bdf31eaaee82d0', 'Đào Thị Thu Hảo', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '26/3F đường Xuân Hợp Phước Long A, Q.9 TP.HCM', '0929428053', 'daothithuhao93@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(47, 'thuthuy@ioi.vn', '25f9e794323b453885f5181f1b624d0b', 'Trần Thị Thu Thủy', 3, 6, 2, 'Nhân viên đồ họa', 0, '0000-00-00', '599 CMT8, P.15, Q.10, HCM city', '0168 247 0001', 'thuthuy@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 10:31:27', '', 4, 1),
(50, 'vanltt.hht@gmail.com', '0d6fbf627f3bcd0ee2baee6e374a8e68', 'Lê Thị Thanh Vân', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '17.07 Lô N, nhà G, Chung cư Bình Khánh, Quận 2, Tp.HCM', '0942645178', 'vanltt.hht@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(49, 'nguyenthiphuongthao219@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Phương Thảo', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '377/43L CMT8, Phường 12, Quận 10, Tp. HCM', '01657457499', 'nguyenthiphuongthao219@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(3, 'truongson@ioi.vn', '8721b76e180276359043be6bda6cd78c', 'Nguyễn Trường Sơn', 12, 5, 1, 'Trưởng phòng', 1, '0000-00-00', '910A Chung cư An Sương, Phường Trung Mỹ Tây, Quận 12, Tp.Hồ Chí Minh', '0917448271', 'truongson@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-08 17:54:16', '', 1, 1),
(22, 'sarramy90@yahoo.com', '386253724966b278c757c68f320d924c', 'Vũ Thị Ngọc Mỹ', 107, 3, 4, 'Nhân viên kinh doanh', 0, '0000-00-00', '59 Phạm Văn Chiêu, Quận Gò Vấp, Tp. Hồ Chí Minh', '01226963804', 'sarramy90@yahoo.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(25, 'thanhxuan2115@gmail.com', '7736cd8690578b39d693b0cf1b111a2f', 'Hồ Thị Thanh Xuân', 107, 3, 4, 'Nhân viên kinh doanh', 0, '0000-00-00', '60/8 Quốc lộ 13, Phường 26, Q. Bình Thạnh, Tp. Hồ Chí Minh', '0937719980', 'thanhxuan2115@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(7, 'vuonghung1986@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Vương Huỳnh Ngọc Hùng', 107, 3, 4, 'Nhân viên kinh doanh', 0, '0000-00-00', '106/26/63 Ấp 7, Xã Xuân Thới Thượng, Hóc Môn, Tp. Hồ Chí Minh', '0985330049', 'vuonghung1986@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(52, 'beng09tn1@gmail.com', '6783f4651647e053521d2f0601e53d54', 'Trần Thị Thanh Thủy', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '344/2/4 Nguyễn Văn Nghi, Phường 7, Q. Gò Vấp, Tp. HCM', '0979669656', 'beng09tn1@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(56, 'trandiu210@gmail.com', '088ead73b48a3ccda95be6ffd136fd2a', 'Trần Thị Dịu', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', 'Thủ Đức, Tp. HCM', '01673618797', 'trandiu210@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(51, 'hoangtrang1709@gmail.com', '24d927718aee02791f95b2e1c165d3f6', 'Hoàng Thị Thùy Trang', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '164 Trần Văn Dư, Phường 13, Quận Tân Bình, Tp. Hồ Chí Minh', '0972696413', 'hoangtrang1709@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(32, 'phamlongnghia@gmail.com', 'c4d33836dc209ad6d1f48fe39083ef6b', 'Phạm Long Nghĩa', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '102, Chiến Thắng, Phường 9, Quận Phú Nhuận', '0934552879', 'phamlongnghia@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(12, 'hongtuyet@ioi.vn', '3d867f541ce3b9f439927a71e2893490', 'Nguyễn Thị Hồng Tuyết', 0, 5, 1, 'Giám đốc điều hành', 0, '0000-00-00', '910A Chung cư An Sương, P.Trung Mỹ Tây, Quận 12, Tp.HCM', '0938059468', 'hongtuyet@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-08 17:54:36', '', 1, 1),
(55, 'letrinh12py@gmail.com', 'ed856b00c33bdfb0ed1bb587939d54d6', 'Lê Thị Bích Trinh', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '209 Quốc lộ 13, phường 26, quận Bình Thạnh, Tp. HCM', '0933581306', 'letrinh12py@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(53, 'mylinh@ioi.vn', '9f42cc73a794d94280859d95e0b0c0d6', 'Vũ Thị Mỹ Linh', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '229, Đường số 19, P. Bình Trị Đông B, Q. Bình Tân, Tp. HCM', '01648849039', 'mylinh@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-08 09:33:30', '', 1, 1),
(54, 'vansongtran@gmail.com', '4e3f8711f56115f06e893f387d3f8a33', 'Trần Văn Song', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '07 Đường 24, Khu phố 4, Quận 2, Tp. HCM', '01286233545', 'vansongtran@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 4, 1),
(85, 'hoaimy@ioi.vn', '39397381d1634421e23b7807f1fd1c77', 'Nguyễn Thụy Hoài My', 53, 3, 4, 'Nhân viên', 0, '0000-00-00', '404B Phan Văn Hân.Phường 17.Quận Bình Thạnh.Tp.Hồ Chí Minh', '0903100172', 'hoaimy@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-08 09:22:37', '', 1, 1),
(93, 'hoangcao306@gmail.com', '1bbd886460827015e5d605ed44252251', 'Cao Cẩm Hoàng', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '198 Bùi Thị Xuân, P3, Q.Tân Bình', '01265636450', 'hoangcao306@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 10:07:36', '', 4, 1),
(106, 'nhatngan@ioi.vn', 'd4dc491bdeb1a81a7ae40bf06e8eb943', 'Đào Thái Nhật Ngân', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '0974229922', 'nhatngan@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-08 09:27:09', '', 1, 1),
(91, 'hrm@ioi.vn', 'c955897cd3c067146cac36da4a3afbac', 'Nguyễn Cổ Thanh Liêm', 107, 3, 4, 'Trưởng Phòng Kinh Doanh', 0, '0000-00-00', '', '0906680486', 'hrm@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 10:08:23', '', 4, 1),
(92, 'mipham@ioi.vn', '9af112114dc7acd6fbc45c228d37b663', 'Phạm Thị Trà Mi', 12, 2, 4, 'Nhân Viên Kế Toán', 0, '0000-00-00', '53 Đường số 28, P6, Q. Gò Vấp', '01267831588', 'mipham@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 10:32:09', '', 4, 1),
(105, 'sales03@ioi.vn', '29c3eea3f305d6b823f562ac4be35217', 'Lê Nguyễn Hạnh Nguyên', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '0000000', 'sales03@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 10:04:12', '', 4, 1),
(104, 'sales04@ioi.vn', 'dd4b21e9ef71e1291183a46b913ae6f2', 'Trần Mộng Nhi', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '01217926963', 'sales04@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 10:08:16', '', 4, 1),
(102, 'sales05@ioi.vn', 'bc208b4944004cf8ebfbbdb6eda356a6', 'Trần Lê Hoài Trang', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '01655784381', 'sales05@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 10:08:57', '', 4, 1),
(99, 'trangnguyenkhang.bank@gmail.com', '29c3eea3f305d6b823f562ac4be35217', 'Trang Nguyên Khang', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '01212194191', 'trangnguyenkhang.bank@gmail.com', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 10:09:02', '', 4, 1),
(117, 'thaotrang@ioi.vn', '5f9adcb9a0364d26fba29ed520e6dc58', 'Vũ Thảo Trang', 107, 3, 4, 'Kinh doanh băng keo', 0, '0000-00-00', '', '', 'thaotrang@ioi.vn', '', '', '', '', '', '', '', '', '2015-04-06 11:12:49', '2015-04-06 11:12:49', '', 1, 1),
(107, 'lanchi@ioi.vn', '02bc5b3bc03bb5b648b12f5c17ccb2de', 'Vũ Lan Chi', 12, 3, 4, 'Trưởng Phòng Kinh Doanh', 0, '0000-00-00', '', '', 'lanchi@ioi.vn', '', '', '', '', '', '', '', '', '2015-04-06 10:15:38', '2015-04-06 10:16:59', '', 1, 1),
(108, 'danthanh@ioi.vn', '8f3ead8a9beca41a13586b8abbc63734', 'Đan Thanh', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '', 'danthanh@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 10:36:24', '', 4, 1),
(109, 'kieungan@ioi.vn', '3cdf319c76f38f852d19859acb639d1f', 'Nguyễn Thị Kiều Ngân', 85, 3, 4, 'Nhân viên', 0, '0000-00-00', 'kieungan', '', 'kieungan@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-08 09:42:01', '', 1, 1),
(110, 'trucly@ioi.vn', '670f0bc368e7b313c5e9dedb8b6cc5be', 'Nguyễn Thị Trúc Ly', 85, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '', 'trucly@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-08 09:40:48', '', 1, 1),
(111, 'tranxuan@ioi.vn', '54deb51442648daff2b1012ffe3bf5c9', 'Trần thị Xuân', 106, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '', 'tranxuan@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-08 09:40:28', '', 1, 1),
(112, 'ngocanh@ioi.vn', '25f9e794323b453885f5181f1b624d0b', 'Nguyễn Thị Ngọc Anh', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '', 'ngocanh@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 11:00:50', '', 4, 1),
(113, 'honghanh@ioi.vn', '25f9e794323b453885f5181f1b624d0b', 'Lê Hồng Hạnh', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '01647313800', 'honghanh@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 11:01:11', '', 4, 1),
(114, 'thuyan@ioi.vn', 'f03d4854848716a1087ee0bdbe549594', 'Phạm Thùy An', 85, 3, 4, 'Nhân Viên', 0, '0000-00-00', '', '', 'thuyan@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-08 09:40:23', '', 1, 1),
(115, 'thuydung@ioi.vn', '25f9e794323b453885f5181f1b624d0b', 'An Thị Thùy Dung', 107, 3, 4, 'Nhân viên', 0, '0000-00-00', '', '0938898321', 'thuydung@ioi.vn', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2015-04-06 11:11:58', '', 4, 1),
(116, 'quochuy@ioi.vn', '1d075a591ab19f36b2d927dab80bcb9b', 'Lê Quốc Huy', 3, 3, 2, 'Nhân viên', 1, '0000-00-00', '', '', 'quochuy@ioi.vn', '', '', '', '', '', '', '', '', '2015-04-06 10:28:25', '2015-04-06 10:29:52', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_vote`
--

CREATE TABLE IF NOT EXISTS `tkwp_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `vote_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vote_content` text COLLATE utf8_unicode_ci NOT NULL,
  `vote_status` tinyint(4) NOT NULL,
  `vote_note_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vote_create_date` date NOT NULL,
  `vote_update_date` date NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vote_name` (`vote_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tkwp_vote`
--

INSERT INTO `tkwp_vote` (`id`, `menu_id`, `vote_name`, `vote_content`, `vote_status`, `vote_note_status`, `vote_create_date`, `vote_update_date`, `user`) VALUES
(1, 7, 'Bình chọn điện thoại 2015', 'Dòng điện thoại nào tốt nhất năm 2015', 1, '', '2015-03-03', '2015-03-05', 2),
(2, 12, 'Sự kiên bóng đá 2015', 'Chị Nguyễn Thu Hằng - Giám đốc Công ty cổ phần truyền thông IFM cảm thấy lo lắng bởi vòng eo ngấn mỡ sau Tết. ', 2, '', '2015-03-03', '2015-07-15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tkwp_vote_reply`
--

CREATE TABLE IF NOT EXISTS `tkwp_vote_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_id` int(11) NOT NULL,
  `reply_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reply_orderby` int(11) NOT NULL,
  `reply_status` tinyint(4) NOT NULL,
  `reply_view` int(11) NOT NULL,
  `reply_create_date` datetime NOT NULL,
  `reply_update_date` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reply_name` (`reply_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tkwp_vote_reply`
--

INSERT INTO `tkwp_vote_reply` (`id`, `vote_id`, `reply_name`, `reply_orderby`, `reply_status`, `reply_view`, `reply_create_date`, `reply_update_date`, `user`) VALUES
(1, 2, 'Việt Nam vô địch', 1, 1, 10, '2015-03-03 17:21:57', '2015-03-03 17:21:57', 2),
(2, 2, 'Đức thắng Việt Nam', 2, 1, 90, '2015-03-03 17:34:23', '2015-03-03 17:34:23', 2),
(3, 2, 'Việt Nam Hòa Đức', 3, 1, 2, '2015-03-03 17:47:12', '2015-03-03 17:47:12', 2),
(5, 1, 'Điện thoai IP4 tốt nhât', 1, 1, 0, '2015-03-03 17:53:45', '2015-03-03 17:53:45', 2),
(6, 1, 'Điện thoại samsung tốt nhất', 2, 1, 0, '2015-03-03 17:54:16', '2015-03-03 17:54:16', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
