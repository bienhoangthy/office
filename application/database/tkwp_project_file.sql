
--
-- Table structure for table `tkwp_project_file`
--

CREATE TABLE IF NOT EXISTS `tkwp_project_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_status` tinyint(4) NOT NULL,
  `file_create` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `tkwp_project_file`
--

INSERT INTO `tkwp_project_file` (`id`, `pro_id`, `file_name`, `file_status`, `file_create`, `user`) VALUES
(24, 4, '141024_092154_phim_tat_thuong_dung_trong_sublime_text.png', 1, 1414142515, 1),
(25, 4, '141024_094250_2602508_Windows10_official.png', 1, 1414143770, 1),
(28, 4, '141024_104103_slider-7.png', 1, 1414147263, 1),
(29, 4, '141024_104103_10710962_10202847165075429_904120129434878677_n.jpg', 1, 1414147264, 1),
(30, 4, '141028_020012_aaaa.png', 1, 1414479612, 1),
(31, 5, '141028_021250_4-ky-thuat-ban-hang-loi-thoi.gif', 1, 1414480371, 1),
(32, 5, '141028_021837_Control Panel DNStourmoila.com .png', 1, 1414480717, 1),
(33, 5, '141028_021838_Control Panel DNStourmoila.net.png', 1, 1414480718, 1),
(34, 5, '141028_022939_icon_social.png', 1, 1414481380, 1),
(35, 9, '141105_052156_Forgot Password.png', 1, 1415182916, 1),
(36, 146, '141107_095220_Gui yeu cau.jpg', 1, 1415328741, 1),
(37, 146, '141107_095221_Trang con.jpg', 1, 1415328741, 1),
(38, 146, '141107_095221_Trang Chu.jpg', 1, 1415328741, 1),
(39, 146, '141107_095221_Trang con 2.jpg', 1, 1415328741, 1),
(40, 146, '141107_095221_All Page.jpg', 1, 1415328741, 1),
(41, 146, '141107_095221_Nhung cho can Doi Mau.jpg', 1, 1415328741, 1),
(42, 6, '141107_110714_Layout-DEVS---03---Detail---News.jpg', 1, 1415333234, 1),
(43, 6, '141107_110715_Layout-DEVS---01---Home---Fix-v1.jpg', 1, 1415333235, 1),
(44, 9, '141107_115847_Danh sách tin tức   CMS.png', 1, 1415336327, 1),
(45, 9, '141107_115848_Demo.png', 1, 1415336328, 1),
(46, 9, '141111_031732_Shoping Cart.png', 1, 1415693852, 1),
(47, 9, '141112_101219_Form Mail - Chuyên mục tư vấn.png', 1, 1415761940, 1),
(48, 9, '141112_101220_Form - Chuyên mục tư vấn.png', 1, 1415761940, 1),
(49, 9, '141112_101220_Trả lời hỏi đáp - trong Admin - Gmail.png', 1, 1415761940, 1),
(50, 132, '141117_041707_Cập nhật Menu Website   CMS.png', 1, 1416215827, 1);
