DROP TABLE IF EXISTS `kabkota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kabkota` (
  `id_kabkota` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `province_id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aktif` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id_kabkota`),
  KEY `regencies_province_id_index` (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kabkota`
--

LOCK TABLES `kabkota` WRITE;
/*!40000 ALTER TABLE `kabkota` DISABLE KEYS */;
INSERT INTO `kabkota` VALUES ('0','13','NO DATA','1'),('1301','13','KABUPATEN KEPULAUAN MENTAWAI','1'),('1302','13','KABUPATEN PESISIR SELATAN','1'),('1303','13','KABUPATEN SOLOK','1'),('1304','13','KABUPATEN SIJUNJUNG','1'),('1305','13','KABUPATEN TANAH DATAR','1'),('1306','13','KABUPATEN PADANG PARIAMAN','1'),('1307','13','KABUPATEN AGAM','1'),('1308','13','KABUPATEN LIMA PULUH KOTA','1'),('1309','13','KABUPATEN PASAMAN','1'),('1310','13','KABUPATEN SOLOK SELATAN','1'),('1311','13','KABUPATEN DHARMASRAYA','1'),('1312','13','KABUPATEN PASAMAN BARAT','1'),('1371','13','KOTA PADANG','1'),('1372','13','KOTA SOLOK','1'),('1373','13','KOTA SAWAH LUNTO','1'),('1374','13','KOTA PADANG PANJANG','1'),('1375','13','KOTA BUKITTINGGI','1'),('1376','13','KOTA PAYAKUMBUH','1'),('1377','13','KOTA PARIAMAN','1');
/*!40000 ALTER TABLE `kabkota` ENABLE KEYS */;
UNLOCK TABLES;
