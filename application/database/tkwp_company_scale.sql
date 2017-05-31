
--
-- Table structure for table `tkwp_company_scale`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_scale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scale_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tkwp_company_scale`
--

INSERT INTO `tkwp_company_scale` (`id`, `scale_name`) VALUES
(1, 'Trung bình'),
(2, 'Lớn'),
(3, 'Bé'),
(4, 'Chưa phân loại');