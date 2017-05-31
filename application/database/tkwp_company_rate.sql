
--
-- Table structure for table `tkwp_company_rate`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rate_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tkwp_company_rate`
--

INSERT INTO `tkwp_company_rate` (`id`, `rate_name`) VALUES
(1, 'Rất tiềm năng'),
(2, 'Khách hàng tiềm năng'),
(3, 'Không tiềm năng'),
(4, 'Không phân loại');
