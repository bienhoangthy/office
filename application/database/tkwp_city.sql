
CREATE TABLE IF NOT EXISTS `tkwp_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tkwp_city`
--

INSERT INTO `tkwp_city` (`city_id`, `city_name`) VALUES
(1, 'Hà nội'),
(2, 'Tp. Hồ Chí Minh'),
(3, 'Đã Nẵng'),
(4, 'Đăk Lăk'),
(5, 'Hải Phòng '),
(6, 'Cần Thơ'),
(7, 'An Giang'),
(8, 'Bà Rịa - Vũng Tàu'),
(9, 'Bắc Giang'),
(10, 'Bắc Cạn'),
(11, 'Bạc Liêu'),
(12, 'Bắc Ninh'),
(13, 'Bến Tre'),
(14, 'Bình Định'),
(15, 'Lâm Đồng'),
(16, 'Đồng Nai'),
(17, 'Biên Hòa');
