
--
-- Table structure for table `tkwp_adv_budget`
--

CREATE TABLE IF NOT EXISTS `tkwp_adv_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adv_budget_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;


--
-- Dumping data for table `tkwp_adv_budget`
--

INSERT INTO `tkwp_adv_budget` (`id`, `adv_budget_name`) VALUES
(1, 'NS QC Lớn'),
(2, 'NS QC Trung Bình'),
(3, 'NS QC Nhỏ'),
(4, 'NS QC không có'),
(5, 'Chưa phân loại NS');
