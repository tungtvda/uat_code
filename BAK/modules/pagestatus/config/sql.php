CREATE TABLE IF NOT EXISTS `page_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `BGColor` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
