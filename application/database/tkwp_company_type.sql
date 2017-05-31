
--
-- Table structure for table `tkwp_company_type`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tkwp_company_type`
--

INSERT INTO `tkwp_company_type` (`id`, `type_name`) VALUES
(1, 'Trực tiếp'),
(2, 'Đại lý'),
(3, 'Đại lý và trực tiếp'),
(4, 'Chưa phân loại');

--
-- Table structure for table `tkwp_company_type`
--
