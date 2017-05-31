
--
-- Table structure for table `tkwp_business`
--

CREATE TABLE IF NOT EXISTS `tkwp_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tkwp_business`
--

INSERT INTO `tkwp_business` (`id`, `business_type`) VALUES
(1, 'Công ty 100% vốn nước ngoài'),
(2, 'Công ty cổ phần'),
(3, 'Công ty hợp doanh'),
(4, 'Công ty liên doanh'),
(5, 'Công ty nhà nước'),
(6, 'Công ty trách nhiệm hữu hạn'),
(7, 'Doanh nghiệp tư nhân'),
(8, 'Hợp tác xã');
