<?php
/**
 * TODO: Migration description
 *
 * @package migrations
 */
class m140217_093821_create_new_options extends CDbMigration
{

	public function up()
	{
	$this->execute("CREATE TABLE IF NOT EXISTS `products_new_option_values` (
    `products_new_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`products_new_value_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `products_new_option_values`
    --

INSERT INTO `products_new_option_values` (`products_new_value_id`, `value`) VALUES
    (1, '40'),
(2, '42'),
(3, '44'),
(4, '46'),
(5, '48'),
(6, '50'),
(7, '52'),
(8, 'S'),
(9, 'M'),
(10, 'L'),
(11, 'XL'),
(12, 'XXL'),
(13, 'XXXL');");

$this->execute("CREATE TABLE IF NOT EXISTS `products_to_new_options` (
  `products_options_values_id` int(11) unsigned NOT NULL DEFAULT '0',
  `products_options_values_name` varchar(255) NOT NULL,
  `products_new_value_id` int(11) NOT NULL,
  `products_new_options_values_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`products_options_values_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products_to_new_options`
--

INSERT INTO `products_to_new_options` (`products_options_values_id`, `products_options_values_name`, `products_new_value_id`, `products_new_options_values_name`) VALUES
(0, '4', 1, '40'),
(1, 'S', 8, 'S'),
(2, 'M', 9, 'M'),
(3, 'L', 9, 'M'),
(4, 'XL', 11, 'XL'),
(5, 'xs', 11, 'XL'),
(6, 'xxs', 12, 'XXL'),
(7, 'XXL', 12, 'XXL'),
(8, 'XXXL', 13, 'XXXL'),
(9, '56', 7, '52'),
(10, '38', 1, '40'),
(11, '40', 1, '40'),
(12, '42', 2, '42'),
(13, '44', 3, '44'),
(14, '46', 4, '46'),
(15, '48', 5, '48'),
(16, '50', 6, '50'),
(17, '52', 7, '52'),
(18, '54', 7, '52'),
(19, '56', 7, '52'),
(20, '58', 7, '52'),
(23, 'e30', 1, '40'),
(24, 'e32', 1, '40'),
(25, 'e34', 1, '40'),
(26, '60', 7, '52'),
(27, '62', 7, '52'),
(30, '68', 7, '52'),
(31, '4xl', 1, '40'),
(32, '5xl', 6, '50'),
(33, '6xl', 7, '52'),
(34, '7xl', 7, '52'),
(35, 'e36', 1, '40'),
(36, 'e38', 1, '40'),
(37, 'e40', 1, '40'),
(38, 'e42', 2, '42'),
(39, 'e44', 3, '44'),
(40, 'e46', 4, '46'),
(41, 'e48', 5, '48'),
(42, 'e50', 6, '50'),
(43, 'e52', 7, '52'),
(44, 'e54', 7, '52'),
(45, 'e56', 7, '52'),
(46, 'e58', 7, '52'),
(47, '40-42', 1, '40'),
(48, '42-44', 2, '42'),
(49, '44-46', 3, '44'),
(50, '46-48', 4, '46'),
(51, '48-50', 5, '48'),
(52, '50-52', 6, '50'),
(53, 'L-XL', 10, 'L'),
(54, '40-42 рост 158-164', 1, '40'),
(55, '44-46 рост 164-170', 3, '44'),
(56, '42-44-46', 2, '42'),
(57, '46-48-50', 4, '46'),
(58, '48-50 рост 170-176', 5, '48'),
(59, '56-58 рост 182-188', 7, '52'),
(60, '52-54 рост 176-182', 7, '52'),
(61, '60-62 рост 188-194', 7, '52'),
(62, 'XXL 46+', 12, 'XXL'),
(63, '42-44-46-48', 2, '42'),
(64, '', 1, '40'),
(66, '52-54', 7, '52'),
(67, '52-54', 7, '52'),
(68, 'XXXL (44-46)', 13, 'XXXL'),
(69, '3XL (44-46)/4XL(48-50)', 3, '44'),
(70, '3XL (46-48)/4XL (50-52)/5XL (54/56)', 4, '46'),
(71, 'XL (42)/2XL (44)/3XL (46)', 2, '42'),
(72, '2XL (44-46)/3XL (48-50)/4XL (52-54)', 3, '44'),
(73, '4XL (52-52)', 7, '52'),
(74, '', 1, '40'),
(75, 'xl (46-48)/2xl(48-50)', 4, '46'),
(76, '7', 1, '40'),
(77, '7,5', 1, '40'),
(78, '8', 1, '40'),
(79, '8,5', 1, '40'),
(80, '9', 1, '40'),
(81, '9,5', 1, '40'),
(82, '10', 1, '40'),
(83, '10,5', 1, '40'),
(84, '11', 1, '40'),
(85, '11,5', 1, '40'),
(86, '12', 1, '40'),
(87, '12,5', 1, '40'),
(88, '6', 1, '40'),
(89, '6,5', 1, '40'),
(90, '24', 1, '40'),
(91, '25', 1, '40'),
(92, '26', 1, '40'),
(93, '27', 1, '40'),
(95, '28', 1, '40'),
(96, '29', 1, '40'),
(97, '30', 1, '40'),
(98, '31', 1, '40'),
(99, '32', 1, '40'),
(100, '33', 1, '40'),
(101, '34', 1, '40'),
(102, '35', 1, '40'),
(103, '36', 1, '40'),
(104, '37', 1, '40'),
(105, '38', 1, '40'),
(106, '39', 1, '40'),
(107, '41', 1, '40'),
(108, '43', 2, '42'),
(109, '45', 3, '44'),
(110, '48-50-52', 5, '48'),
(111, '16', 1, '40'),
(112, '17', 1, '40'),
(113, '18', 1, '40'),
(114, '19', 1, '40'),
(115, '20', 1, '40'),
(116, '50x25', 6, '50'),
(117, '63x36', 7, '52'),
(118, '65x32', 7, '52'),
(119, '67x30', 7, '52'),
(120, '67x31', 7, '52'),
(121, '67x40', 7, '52'),
(122, '46-54', 4, '46'),
(123, 'ХХХL-54-56', 13, 'XXXL'),
(124, '56-58', 7, '56'),
(125, '58-60', 7, '58'),
(126, 'L-48-50', 10, 'L'),
(127, 'XL-50-52', 11, 'XL'),
(128, 'XXL-52-54', 12, 'XXL'),
(129, 'XXXL-54-56', 13, 'XXXL'),
(130, '4XL-54-56', 7, '54'),
(131, '5XL-56-58', 7, '56'),
(132, '6XL-58-60', 7, '58'),
(133, 'XXXXL', 13, 'XXXL'),
(134, 'B (75/80/85)', 7, '52'),
(135, 'C (80/85/90)', 7, '52'),
(136, 'D (90/95/100)', 7, '52'),
(137, 'А (75/80/85)', 7, '52'),
(138, '92', 7, '52'),
(139, '104', 7, '52'),
(140, '56 см', 7, '52'),
(141, '62 см', 7, '52'),
(142, '68 см', 7, '52'),
(143, '74 см', 7, '52'),
(144, '80 см', 7, '52'),
(145, '6-12 мес', 7, '52'),
(146, '12-18 мес', 7, '52'),
(147, '18-24 мес', 7, '52'),
(148, '70х40', 7, '52'),
(149, '62х38', 7, '52'),
(150, '60х40', 7, '52'),
(151, '67х29', 7, '52'),
(152, '69х41', 7, '52'),
(153, '55х37', 7, '52'),
(154, '60х35', 7, '52'),
(155, '98 см', 7, '52'),
(156, '110', 7, '52'),
(157, '56-62-68-74-80', 7, '56'),
(158, '0-1 год', 10, 'L'),
(159, '1-3 года', 10, 'L'),
(160, '3-4 года', 10, 'L'),
(161, '116', 7, '52'),
(162, '128', 7, '52'),
(163, '132', 7, '52'),
(164, '140', 7, '52'),
(165, '86-92', 7, '52'),
(166, '98-104', 7, '52'),
(167, '92-98', 7, '52'),
(168, 'C (75/80/85)', 7, '52'),
(169, '0-2', 10, 'L'),
(170, '2-4', 10, 'L'),
(171, '4-6', 10, 'L'),
(172, '6-8', 10, 'L'),
(173, '8-10', 10, 'L'),
(174, '10-12', 10, 'L'),
(175, '104-116', 10, 'L'),
(176, '50х25', 6, '50'),
(177, '65х32', 7, '52'),
(178, '67х40', 7, '52'),
(179, '116-128', 7, '52'),
(180, '48-50-52-54-56', 5, '48'),
(181, 'B (70/75/80)', 7, '52'),
(182, 'А (70/75/80)', 7, '52'),
(183, 'D (85/90/95)', 7, '52'),
(184, '10-14', 10, 'L'),
(185, '2-3 года', 10, 'L'),
(186, '4-5 лет', 10, 'L'),
(187, 'D (95/100/105)', 7, '52'),
(188, '36-44', 1, '40'),
(189, 'F', 10, 'L'),
(190, 'C (85/90/95)', 7, '52'),
(191, '12-14', 10, 'L'),
(192, 'D (70/75/80)', 7, '52'),
(193, '0-6 мес', 10, 'L'),
(194, '5-7', 10, 'L'),
(197, '7-9', 10, 'L'),
(198, '9-11', 10, 'L'),
(199, '92-104', 7, '52'),
(200, '88-92', 7, '52'),
(201, '44-46-48-50', 3, '44'),
(202, '50-52-54', 6, '50'),
(203, '13', 10, 'L'),
(204, '80 - 86', 7, '52'),
(205, '40-42-44', 1, '40'),
(206, '44-46-48', 3, '44'),
(207, 'AA (70/75/80)', 7, '52'),
(208, 'XXXXXL', 13, 'XXXL'),
(209, '2', 10, 'L'),
(210, '3', 10, 'L'),
(211, '4', 10, 'L'),
(212, '5', 10, 'L'),
(213, 'A (70/75/80)', 7, '52'),
(214, '64', 7, '52'),
(215, '66', 7, '52'),
(216, '68', 7, '52'),
(217, 'A (75/80/85)', 7, '52'),
(218, 'XXXL', 13, 'XXXL'),
(219, '70', 7, '52'),
(220, '72', 7, '52'),
(221, 'A (65/70/75)', 7, '52'),
(222, '74', 7, '52'),
(223, 'B (90/95/100)', 7, '52'),
(224, '4XL', 11, 'XL'),
(225, '5XL', 11, 'XL'),
(226, '6XL', 11, 'XL'),
(227, '7XL', 11, 'XL'),
(228, '8XL', 11, 'XL'),
(229, '9XL', 11, 'XL'),
(230, '10XL', 11, 'XL'),
(231, '128-140', 7, '52'),
(232, '140-152', 7, '52'),
(233, '152-164', 7, '52'),
(234, '61', 7, '52'),
(235, '91', 7, '52'),
(236, '91*102*65', 7, '52'),
(237, '107*104*69', 7, '52'),
(238, '183*203*30', 7, '52'),
(239, '114*51', 7, '52'),
(240, '99*191*30', 7, '52'),
(241, '137*191*30', 7, '52'),
(242, '152*203*22', 7, '52'),
(243, '137*191*22', 7, '52'),
(244, '99*191*22', 7, '52'),
(245, '76*191*22', 7, '52'),
(246, '152*203*23', 7, '52'),
(247, '193*108*38', 7, '52'),
(248, '236*114*41', 7, '52'),
(249, '295*137*43', 7, '52'),
(250, '244*76', 7, '52'),
(251, '305*76', 7, '52'),
(252, '366*91', 7, '52'),
(253, '147*33', 7, '52'),
(254, '148*40', 7, '52'),
(255, '168*41', 7, '52'),
(256, '188*46', 7, '52'),
(257, '159*50', 7, '52'),
(258, '305*183*50', 7, '52'),
(259, '114*25', 7, '52'),
(260, '122*25', 7, '52'),
(261, '183*51', 7, '52'),
(262, '188*71', 7, '52'),
(263, '52-54-56', 7, '52'),
(264, '54-56', 7, '54'),
(265, '56-58', 7, '56'),
(266, '58-60', 7, '58'),
(267, '60-62', 7, '52'),
(268, '62-64', 7, '52'),
(269, '36-38', 1, '40'),
(270, '38-40', 1, '40'),
(271, '32-34', 1, '40'),
(272, '34-36', 1, '40'),
(273, 'Рост170-176/размер44-46', 3, '44'),
(274, 'Рост170-176/размер48-50', 5, '48'),
(275, 'Рост170-176/размер52-54', 7, '52'),
(276, 'Рост170-176/размер56-58', 7, '56'),
(277, 'Рост170-176/размер60-62', 7, '52'),
(278, 'Рост182-188/размер44-46', 3, '44'),
(279, 'Рост182-188/размер48-50', 5, '48'),
(280, 'Рост182-188/размер52-54', 7, '52'),
(281, 'Рост182-188/размер56-58', 7, '52'),
(282, 'Рост182-188/размер60-62', 7, '52'),
(283, '52-54', 7, '52'),
(284, 'рост:104', 7, '52'),
(285, 'рост:110', 7, '52'),
(286, 'рост:116', 7, '52'),
(287, 'рост:122', 7, '52'),
(288, 'рост:128', 7, '52'),
(289, 'рост:134', 7, '52'),
(290, 'рост:140', 7, '52'),
(291, 'рост:146', 7, '52'),
(292, 'рост:152', 7, '52'),
(293, 'рост:158', 7, '52'),
(294, 'Рост170-177/размер44-46', 3, '44'),
(295, 'Рост170-177/размер48-50', 5, '48'),
(296, 'Рост170-177/размер52-54', 7, '52'),
(297, 'Рост182-189/размер48-50', 5, '48'),
(298, 'Рост182-189/размер52-54', 7, '52'),
(299, 'Рост182-189/размер56-58', 7, '56'),
(300, 'Рост182-189/размер60-62', 7, '52'),
(301, '38-40-42', 1, '40'),
(302, '34-36-38', 1, '40'),
(303, '34-36', 1, '40'),
(304, '30-32', 1, '40'),
(305, '32-34', 1, '40'),
(306, '36-38-40', 1, '40'),
(307, '22', 1, '40'),
(308, '134', 7, '52'),
(309, '122', 7, '52'),
(310, '146', 7, '52'),
(311, '152', 7, '52'),
(312, '158', 7, '52'),
(313, '104см', 7, '52'),
(314, '13,5', 7, '52'),
(315, '14', 7, '52'),
(316, '66', 7, '52'),
(317, '47', 4, '46'),
(318, '48', 5, '48'),
(319, 'B (80/85/90)', 7, '52'),
(320, '15', 1, '40'),
(321, '21', 1, '40'),
(322, '88-92 рост 3-4', 7, '52'),
(323, '96-100 рост 3-4', 7, '52'),
(324, '96-100 рост 5-6', 7, '52'),
(325, '104-108 рост 3-4', 7, '52'),
(326, '104-108 рост 5-6', 7, '52'),
(327, '112-116 рост 5-6', 7, '52'),
(328, '120-124 рост 5-6', 7, '52'),
(329, '86', 7, '52'),
(330, '96', 7, '52'),
(331, '80', 7, '52');");

	}

	public function down() 
	{

        $this->dropTable('products_to_new_options');
        $this->dropTable('products_new_option_values');
	}

}

