-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016 年 12 月 25 日 04:17
-- サーバのバージョン： 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esoft`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `earea`
--

CREATE TABLE `earea` (
  `避難所番号` int(11) NOT NULL,
  `位置` geometry NOT NULL,
  `名称` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `住所` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `海抜` int(11) DEFAULT NULL,
  `施設の種類` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `収容人数` int(11) DEFAULT NULL,
  `地震災害` tinyint(1) NOT NULL DEFAULT '0',
  `暴風災害` tinyint(1) NOT NULL DEFAULT '0',
  `水害` tinyint(1) NOT NULL DEFAULT '0',
  `その他` tinyint(1) NOT NULL DEFAULT '0',
  `津波災害` tinyint(1) NOT NULL DEFAULT '0',
  `備考` text CHARACTER SET utf8 COLLATE utf8_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- テーブルのデータのダンプ `earea`
--

INSERT INTO `earea` (`避難所番号`, `位置`, `名称`, `住所`, `海抜`, `施設の種類`, `収容人数`, `地震災害`, `暴風災害`, `水害`, `その他`, `津波災害`, `備考`) VALUES
(1, '\0\0\0\0\0\0\0FzQ��@@�f����`@', '佐岡体育館', '高知県香美市土佐山田町本村351', 76, NULL, 144, 1, 1, 1, 1, 0, NULL),
(2, '\0\0\0\0\0\0\0�����@@����̶`@', '森林総合センター', '高知県香美市土佐山田町大平80', 105, NULL, 47, 1, 1, 1, 1, 0, NULL),
(3, '\0\0\0\0\0\0\0ݚt["�@@*��Y��`@', '片地小学校（体育館）', '高知県香美市土佐山田町宮ノ口9', 60, NULL, 112, 1, 1, 1, 1, 0, NULL),
(4, '\0\0\0\0\0\0\0��,�"�@@�����`@', '片地地区多目的集会所', '高知県香美市土佐山田町宮ノ口1-2', 57, NULL, 36, 1, 1, 1, 1, 0, NULL),
(5, '\0\0\0\0\0\0\06�\n�r�@@s�w��`@', '高知工科大学（体育館）', '高知県香美市土佐山田町宮ノ口185', 65, '\r\n', 437, 1, 1, 1, 1, 0, NULL),
(6, '\0\0\0\0\0\0\0��W:�@@�r�	�`@', '香美農林合同庁舎', '高知県香美市土佐山田町加茂777', 56, NULL, 26, 1, 1, 1, 1, 0, NULL),
(7, '\0\0\0\0\0\0\0`�����@@�u�`@', '楠目小学校（体育館）', '高知県香美市土佐山田町楠目391-2', 48, NULL, 230, 1, 1, 1, 1, 0, NULL),
(8, '\0\0\0\0\0\0\0	5C�(�@@�(&o��`@', '楠目地区老人憩の家', '高知県香美市土佐山田町楠目1045', 59, NULL, 51, 0, 1, 1, 1, 0, NULL),
(9, '\0\0\0\0\0\0\0��+d�@@�-u�W�`@', '鏡野中学校（体育館）', '高知県香美市土佐山田町楠目1973', 67, NULL, 172, 1, 1, 1, 1, 0, NULL),
(10, '\0\0\0\0\0\0\0P��5�@@����L�`@', '市民グラウンド', '高知県香美市土佐山田町楠目831', 54, NULL, 172, 1, 0, 0, 0, 0, NULL),
(11, '\0\0\0\0\0\0\0遏���@@\n/���`@', '山田高等学校（体育館）', '高知県香美市土佐山田町旭町3-1-3', 47, NULL, 446, 1, 1, 1, 1, 0, NULL),
(12, '\0\0\0\0\0\0\0��yȔ�@@]�z�`@', '山田小学校（体育館）', '高知県香美市土佐山田町西本町2-4-5', 43, NULL, 189, 1, 1, 1, 1, 0, NULL),
(13, '\0\0\0\0\0\0\0��C��@@(d�m�`@', '宝町体育館', '高知県香美市土佐山田町宝町2-7-15', 43, NULL, 325, 1, 1, 1, 1, 1, NULL),
(14, '\0\0\0\0\0\0\0m�i�*�@@/�$�`@', '地域福祉センター土佐山田（プラザ八王子）', '高知県香美市土佐山田町262-1', 48, NULL, 81, 1, 1, 1, 1, 0, NULL),
(15, '\0\0\0\0\0\0\0Ĳ�CR�@@{/��`@', '中央公民館', '高知県香美市土佐山田町宝町2-1-27', 43, NULL, 130, 1, 1, 1, 1, 0, NULL),
(16, '\0\0\0\0\0\0\01%��e�@@���ο�`@', '秦山公園野球場（土佐山田スタジアム）', '高知県香美市土佐山田町植1252-2', 50, NULL, 17, 1, 1, 1, 1, 0, NULL),
(17, '\0\0\0\0\0\0\01%��e�@@���ο�`@', '秦山公園（ふれあい広場）', '高知県香美市土佐山田町植1252-2', 50, NULL, 17, 1, 0, 0, 0, 0, NULL),
(18, '\0\0\0\0\0\0\0�ڦx\\�@@����\r�`@', '舟入小学校（体育館）', '高知県香美市土佐山田町山田1218', 29, NULL, 180, 1, 1, 1, 1, 0, NULL),
(19, '\0\0\0\0\0\0\0\Z��]��@@ C�*�`@', '明治地区多目的集会所', '高知県香美市土佐山田町山田1385-1', 36, NULL, 40, 1, 1, 1, 1, 0, NULL),
(20, '\0\0\0\0\0\0\0�gz���@@E�k맵`@', '岩村地区老人憩の家', '高知県香美市土佐山田町神通寺370', 23, NULL, 36, 0, 0, 1, 1, 0, NULL),
(21, '\0\0\0\0\0\0\0�&M���@@S�Ʈ�`@', '香長小学校（体育館）', '高知県香美市土佐山田町須江32', 38, NULL, 182, 1, 1, 1, 1, 0, NULL),
(22, '\0\0\0\0\0\0\0{/�h��@@;�э��`@', '農山村コミュニティセンター', '高知県香美市土佐山田町須江36-1', 37, NULL, 39, 1, 1, 1, 1, 0, NULL),
(23, '\0\0\0\0\0\0\0�~T�@@��25	�`@', '新改北部構造改善センター', '高知県香美市土佐山田町平山484-1', 120, NULL, 47, 1, 1, 1, 1, 0, NULL),
(24, '\0\0\0\0\0\0\0Q�E��@@�3���`@', '繁藤地区コミュニティセンター', '高知県香美市土佐山田町繁藤3-1', 346, NULL, 60, 1, 1, 1, 1, 0, NULL),
(25, '\0\0\0\0\0\0\0ĖM��@@t&m�`@', '繁藤老人憩の家', '高知県香美市土佐山田町繁藤755-12', 357, NULL, 18, 1, 1, 1, 1, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `earea`
--
ALTER TABLE `earea`
  ADD PRIMARY KEY (`避難所番号`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `earea`
--
ALTER TABLE `earea`
  MODIFY `避難所番号` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
