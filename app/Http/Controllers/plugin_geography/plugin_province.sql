SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for refprovince
-- ----------------------------
DROP TABLE IF EXISTS `plugin_province`;
CREATE TABLE `plugin_province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `psgcCode` varchar(255) DEFAULT NULL,
  `provDesc` text,
  `regCode` varchar(255) DEFAULT NULL,
  `provCode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of refprovince
-- ----------------------------
INSERT INTO `plugin_province` VALUES ('1', '012800000', 'ILOCOS NORTE', '01', '0128');
INSERT INTO `plugin_province` VALUES ('2', '012900000', 'ILOCOS SUR', '01', '0129');
INSERT INTO `plugin_province` VALUES ('3', '013300000', 'LA UNION', '01', '0133');
INSERT INTO `plugin_province` VALUES ('4', '015500000', 'PANGASINAN', '01', '0155');
INSERT INTO `plugin_province` VALUES ('5', '020900000', 'BATANES', '02', '0209');
INSERT INTO `plugin_province` VALUES ('6', '021500000', 'CAGAYAN', '02', '0215');
INSERT INTO `plugin_province` VALUES ('7', '023100000', 'ISABELA', '02', '0231');
INSERT INTO `plugin_province` VALUES ('8', '025000000', 'NUEVA VIZCAYA', '02', '0250');
INSERT INTO `plugin_province` VALUES ('9', '025700000', 'QUIRINO', '02', '0257');
INSERT INTO `plugin_province` VALUES ('10', '030800000', 'BATAAN', '03', '0308');
INSERT INTO `plugin_province` VALUES ('11', '031400000', 'BULACAN', '03', '0314');
INSERT INTO `plugin_province` VALUES ('12', '034900000', 'NUEVA ECIJA', '03', '0349');
INSERT INTO `plugin_province` VALUES ('13', '035400000', 'PAMPANGA', '03', '0354');
INSERT INTO `plugin_province` VALUES ('14', '036900000', 'TARLAC', '03', '0369');
INSERT INTO `plugin_province` VALUES ('15', '037100000', 'ZAMBALES', '03', '0371');
INSERT INTO `plugin_province` VALUES ('16', '037700000', 'AURORA', '03', '0377');
INSERT INTO `plugin_province` VALUES ('17', '041000000', 'BATANGAS', '04', '0410');
INSERT INTO `plugin_province` VALUES ('18', '042100000', 'CAVITE', '04', '0421');
INSERT INTO `plugin_province` VALUES ('19', '043400000', 'LAGUNA', '04', '0434');
INSERT INTO `plugin_province` VALUES ('20', '045600000', 'QUEZON', '04', '0456');
INSERT INTO `plugin_province` VALUES ('21', '045800000', 'RIZAL', '04', '0458');
INSERT INTO `plugin_province` VALUES ('22', '174000000', 'MARINDUQUE', '17', '1740');
INSERT INTO `plugin_province` VALUES ('23', '175100000', 'OCCIDENTAL MINDORO', '17', '1751');
INSERT INTO `plugin_province` VALUES ('24', '175200000', 'ORIENTAL MINDORO', '17', '1752');
INSERT INTO `plugin_province` VALUES ('25', '175300000', 'PALAWAN', '17', '1753');
INSERT INTO `plugin_province` VALUES ('26', '175900000', 'ROMBLON', '17', '1759');
INSERT INTO `plugin_province` VALUES ('27', '050500000', 'ALBAY', '05', '0505');
INSERT INTO `plugin_province` VALUES ('28', '051600000', 'CAMARINES NORTE', '05', '0516');
INSERT INTO `plugin_province` VALUES ('29', '051700000', 'CAMARINES SUR', '05', '0517');
INSERT INTO `plugin_province` VALUES ('30', '052000000', 'CATANDUANES', '05', '0520');
INSERT INTO `plugin_province` VALUES ('31', '054100000', 'MASBATE', '05', '0541');
INSERT INTO `plugin_province` VALUES ('32', '056200000', 'SORSOGON', '05', '0562');
INSERT INTO `plugin_province` VALUES ('33', '060400000', 'AKLAN', '06', '0604');
INSERT INTO `plugin_province` VALUES ('34', '060600000', 'ANTIQUE', '06', '0606');
INSERT INTO `plugin_province` VALUES ('35', '061900000', 'CAPIZ', '06', '0619');
INSERT INTO `plugin_province` VALUES ('36', '063000000', 'ILOILO', '06', '0630');
INSERT INTO `plugin_province` VALUES ('37', '064500000', 'NEGROS OCCIDENTAL', '06', '0645');
INSERT INTO `plugin_province` VALUES ('38', '067900000', 'GUIMARAS', '06', '0679');
INSERT INTO `plugin_province` VALUES ('39', '071200000', 'BOHOL', '07', '0712');
INSERT INTO `plugin_province` VALUES ('40', '072200000', 'CEBU', '07', '0722');
INSERT INTO `plugin_province` VALUES ('41', '074600000', 'NEGROS ORIENTAL', '07', '0746');
INSERT INTO `plugin_province` VALUES ('42', '076100000', 'SIQUIJOR', '07', '0761');
INSERT INTO `plugin_province` VALUES ('43', '082600000', 'EASTERN SAMAR', '08', '0826');
INSERT INTO `plugin_province` VALUES ('44', '083700000', 'LEYTE', '08', '0837');
INSERT INTO `plugin_province` VALUES ('45', '084800000', 'NORTHERN SAMAR', '08', '0848');
INSERT INTO `plugin_province` VALUES ('46', '086000000', 'SAMAR (WESTERN SAMAR)', '08', '0860');
INSERT INTO `plugin_province` VALUES ('47', '086400000', 'SOUTHERN LEYTE', '08', '0864');
INSERT INTO `plugin_province` VALUES ('48', '087800000', 'BILIRAN', '08', '0878');
INSERT INTO `plugin_province` VALUES ('49', '097200000', 'ZAMBOANGA DEL NORTE', '09', '0972');
INSERT INTO `plugin_province` VALUES ('50', '097300000', 'ZAMBOANGA DEL SUR', '09', '0973');
INSERT INTO `plugin_province` VALUES ('51', '098300000', 'ZAMBOANGA SIBUGAY', '09', '0983');
INSERT INTO `plugin_province` VALUES ('52', '099700000', 'CITY OF ISABELA', '09', '0997');
INSERT INTO `plugin_province` VALUES ('53', '101300000', 'BUKIDNON', '10', '1013');
INSERT INTO `plugin_province` VALUES ('54', '101800000', 'CAMIGUIN', '10', '1018');
INSERT INTO `plugin_province` VALUES ('55', '103500000', 'LANAO DEL NORTE', '10', '1035');
INSERT INTO `plugin_province` VALUES ('56', '104200000', 'MISAMIS OCCIDENTAL', '10', '1042');
INSERT INTO `plugin_province` VALUES ('57', '104300000', 'MISAMIS ORIENTAL', '10', '1043');
INSERT INTO `plugin_province` VALUES ('58', '112300000', 'DAVAO DEL NORTE', '11', '1123');
INSERT INTO `plugin_province` VALUES ('59', '112400000', 'DAVAO DEL SUR', '11', '1124');
INSERT INTO `plugin_province` VALUES ('60', '112500000', 'DAVAO ORIENTAL', '11', '1125');
INSERT INTO `plugin_province` VALUES ('61', '118200000', 'COMPOSTELA VALLEY', '11', '1182');
INSERT INTO `plugin_province` VALUES ('62', '118600000', 'DAVAO OCCIDENTAL', '11', '1186');
INSERT INTO `plugin_province` VALUES ('63', '124700000', 'COTABATO (NORTH COTABATO)', '12', '1247');
INSERT INTO `plugin_province` VALUES ('64', '126300000', 'SOUTH COTABATO', '12', '1263');
INSERT INTO `plugin_province` VALUES ('65', '126500000', 'SULTAN KUDARAT', '12', '1265');
INSERT INTO `plugin_province` VALUES ('66', '128000000', 'SARANGANI', '12', '1280');
INSERT INTO `plugin_province` VALUES ('67', '129800000', 'COTABATO CITY', '12', '1298');
INSERT INTO `plugin_province` VALUES ('68', '133900000', 'NCR, CITY OF MANILA, FIRST DISTRICT', '13', '1339');
INSERT INTO `plugin_province` VALUES ('69', '133900000', 'CITY OF MANILA', '13', '1339');
INSERT INTO `plugin_province` VALUES ('70', '137400000', 'NCR, SECOND DISTRICT', '13', '1374');
INSERT INTO `plugin_province` VALUES ('71', '137500000', 'NCR, THIRD DISTRICT', '13', '1375');
INSERT INTO `plugin_province` VALUES ('72', '137600000', 'NCR, FOURTH DISTRICT', '13', '1376');
INSERT INTO `plugin_province` VALUES ('73', '140100000', 'ABRA', '14', '1401');
INSERT INTO `plugin_province` VALUES ('74', '141100000', 'BENGUET', '14', '1411');
INSERT INTO `plugin_province` VALUES ('75', '142700000', 'IFUGAO', '14', '1427');
INSERT INTO `plugin_province` VALUES ('76', '143200000', 'KALINGA', '14', '1432');
INSERT INTO `plugin_province` VALUES ('77', '144400000', 'MOUNTAIN PROVINCE', '14', '1444');
INSERT INTO `plugin_province` VALUES ('78', '148100000', 'APAYAO', '14', '1481');
INSERT INTO `plugin_province` VALUES ('79', '150700000', 'BASILAN', '15', '1507');
INSERT INTO `plugin_province` VALUES ('80', '153600000', 'LANAO DEL SUR', '15', '1536');
INSERT INTO `plugin_province` VALUES ('81', '153800000', 'MAGUINDANAO', '15', '1538');
INSERT INTO `plugin_province` VALUES ('82', '156600000', 'SULU', '15', '1566');
INSERT INTO `plugin_province` VALUES ('83', '157000000', 'TAWI-TAWI', '15', '1570');
INSERT INTO `plugin_province` VALUES ('84', '160200000', 'AGUSAN DEL NORTE', '16', '1602');
INSERT INTO `plugin_province` VALUES ('85', '160300000', 'AGUSAN DEL SUR', '16', '1603');
INSERT INTO `plugin_province` VALUES ('86', '166700000', 'SURIGAO DEL NORTE', '16', '1667');
INSERT INTO `plugin_province` VALUES ('87', '166800000', 'SURIGAO DEL SUR', '16', '1668');
INSERT INTO `plugin_province` VALUES ('88', '168500000', 'DINAGAT ISLANDS', '16', '1685');
