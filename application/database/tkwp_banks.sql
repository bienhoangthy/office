
--
-- Table structure for table `tkwp_banks`
--

CREATE TABLE IF NOT EXISTS `tkwp_banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tkwp_banks`
--

INSERT INTO `tkwp_banks` (`id`, `bank_name`) VALUES
(1, 'Maritime Bank'),
(2, 'DongA Bank'),
(3, 'Vietcombank'),
(4, 'Agribank'),
(5, 'Eximbank'),
(6, 'HDBank'),
(7, 'MB Bank'),
(8, 'Sacombank'),
(9, 'VietBank'),
(10, 'Vietinbank'),
(11, 'BIDV'),
(12, 'Techcombank');