
--
-- Table structure for table `tkwp_company_status`
--

CREATE TABLE IF NOT EXISTS `tkwp_company_status` (
  `cst_id` int(11) NOT NULL,
  `cst_name` varchar(255) NOT NULL,
  `cst_note` varchar(255) NOT NULL,
  `cst_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`cst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tkwp_company_status`
--

INSERT INTO `tkwp_company_status` (`cst_id`, `cst_name`, `cst_note`, `cst_status`) VALUES
(1, 'Đang làm việc', '#0071cd', 1),
(2, 'Đăng ký', '#900099', 1),
(3, 'Không thành công', '#4a4a4a', 1),
(4, 'Đang liên lạc', '#0071cd', 1),
(5, 'Thành công', '#bb000a', 1),
(6, 'Chưa liên hệ', '#d85100', 1);
