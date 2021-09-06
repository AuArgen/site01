-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.50 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных kundo
CREATE DATABASE IF NOT EXISTS `kundo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kundo`;


-- Дамп структуры для таблица kundo.baa
CREATE TABLE IF NOT EXISTS `baa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pupil_aty` varchar(255) NOT NULL DEFAULT '0',
  `predmet_aty` varchar(255) NOT NULL DEFAULT '0',
  `klass_aty` varchar(255) NOT NULL DEFAULT '0',
  `bal` int(3) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_baa_predmet` (`predmet_aty`),
  KEY `FK_baa_klass` (`klass_aty`),
  KEY `FK_baa_pupil` (`pupil_aty`),
  CONSTRAINT `FK_baa_pupil` FOREIGN KEY (`pupil_aty`) REFERENCES `pupil` (`fio`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.baa: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `baa` DISABLE KEYS */;
INSERT INTO `baa` (`id`, `pupil_aty`, `predmet_aty`, `klass_aty`, `bal`, `date`) VALUES
	(7, 'Раманова Бермет', 'Информатика', '9(А)-класс', 4, '2020-04-06');
/*!40000 ALTER TABLE `baa` ENABLE KEYS */;


-- Дамп структуры для таблица kundo.cheirek
CREATE TABLE IF NOT EXISTS `cheirek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ch_1` varchar(50) NOT NULL,
  `ch_2` varchar(50) NOT NULL,
  `ch_3` varchar(50) NOT NULL,
  `ch_4` varchar(50) NOT NULL,
  `predmet_aty` varchar(250) NOT NULL,
  `teacher_aty` varchar(250) NOT NULL,
  `pipul_aty` varchar(250) NOT NULL,
  `klass_aty` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cheirek_predmet` (`predmet_aty`),
  KEY `FK_cheirek_teacher` (`teacher_aty`),
  KEY `FK_cheirek_pupil` (`pipul_aty`),
  KEY `FK_cheirek_klass` (`klass_aty`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.cheirek: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `cheirek` DISABLE KEYS */;
INSERT INTO `cheirek` (`id`, `ch_1`, `ch_2`, `ch_3`, `ch_4`, `predmet_aty`, `teacher_aty`, `pipul_aty`, `klass_aty`) VALUES
	(14, '5', '5', '5', '0', 'Информатика', 'Камалов Султанбек', 'Раманова Бермет', '9(А)-класс');
/*!40000 ALTER TABLE `cheirek` ENABLE KEYS */;


-- Дамп структуры для таблица kundo.klass
CREATE TABLE IF NOT EXISTS `klass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aty` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`aty`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.klass: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `klass` DISABLE KEYS */;
INSERT INTO `klass` (`id`, `aty`) VALUES
	(5, '10-класс'),
	(6, '11-класс'),
	(3, '8(А)-класс'),
	(1, '8(Б)-класс'),
	(4, '9(А)-класс'),
	(2, '9(Б)-класс');
/*!40000 ALTER TABLE `klass` ENABLE KEYS */;


-- Дамп структуры для таблица kundo.kun
CREATE TABLE IF NOT EXISTS `kun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aty` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aty` (`aty`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.kun: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `kun` DISABLE KEYS */;
INSERT INTO `kun` (`id`, `aty`) VALUES
	(7, 'Воскресенье'),
	(2, 'Вторник'),
	(1, 'Понидельник'),
	(5, 'Пятница'),
	(3, 'Среда'),
	(6, 'Суббота'),
	(4, 'Четверг');
/*!40000 ALTER TABLE `kun` ENABLE KEYS */;


-- Дамп структуры для таблица kundo.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.news: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `news_text`) VALUES
	(2, 'Урматтуу окуучулар бүгүн информатика предметинен онлайн сабак өтөбүз саат 12:00'),
	(3, 'цхплцхки ЦУПЛИЪ укизЬ уъки ь'),
	(4, 'сспоа вякнкы ыкгкы вкнк вкк аео');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- Дамп структуры для таблица kundo.predmet
CREATE TABLE IF NOT EXISTS `predmet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aty` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`aty`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.predmet: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `predmet` DISABLE KEYS */;
INSERT INTO `predmet` (`id`, `aty`) VALUES
	(7, 'Информатика'),
	(8, 'Математика'),
	(9, 'Физика');
/*!40000 ALTER TABLE `predmet` ENABLE KEYS */;


-- Дамп структуры для таблица kundo.pupil
CREATE TABLE IF NOT EXISTS `pupil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(250) NOT NULL,
  `klass_aty` varchar(250) NOT NULL,
  `login` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fio` (`fio`),
  KEY `FK_pupil_klass` (`klass_aty`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.pupil: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `pupil` DISABLE KEYS */;
INSERT INTO `pupil` (`id`, `fio`, `klass_aty`, `login`, `password`) VALUES
	(7, 'Раманова Бермет', '9(А)-класс', 'bermet', '12345');
/*!40000 ALTER TABLE `pupil` ENABLE KEYS */;


-- Дамп структуры для таблица kundo.rospisanie
CREATE TABLE IF NOT EXISTS `rospisanie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `predmet_aty` varchar(250) DEFAULT '0',
  `teacher_aty` varchar(250) DEFAULT '0',
  `kun_aty` varchar(250) DEFAULT '0',
  `klass_aty` varchar(250) DEFAULT '0',
  `sort` varchar(250) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_rospisanie_predmet` (`predmet_aty`),
  KEY `FK_rospisanie_teacher` (`teacher_aty`),
  KEY `FK_rospisanie_kun` (`kun_aty`),
  KEY `FK_rospisanie_klass` (`klass_aty`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.rospisanie: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `rospisanie` DISABLE KEYS */;
INSERT INTO `rospisanie` (`id`, `predmet_aty`, `teacher_aty`, `kun_aty`, `klass_aty`, `sort`) VALUES
	(8, 'Информатика', 'Камалов Султанбек', 'Пятница', '9(А)-класс', 'Сабак'),
	(9, 'Информатика', 'Камалов Султанбек', 'Вторник', '10-класс', 'Сабак'),
	(10, 'Информатика', 'Камалов Султанбек', 'Вторник', '8(А)-класс', 'Сабак'),
	(11, 'Информатика', 'Камалов Султанбек', 'Пятница', '9(А)-класс', 'Сабак'),
	(12, 'Информатика', 'Камалов Султанбек', 'Вторник', '9(А)-класс', 'Сабак'),
	(13, 'Математика', 'Камалов Султанбек', 'Вторник', '9(А)-класс', 'Ийрим'),
	(14, 'Математика', 'Сактанова Элиза', 'Вторник', '9(А)-класс', 'Сабак'),
	(15, 'Физика', 'Пакал уулу Долонбек', 'Вторник', '9(А)-класс', 'Сабак'),
	(16, 'Информатика', 'Камалов Султанбек', 'Понидельник', '9(А)-класс', 'Сабак');
/*!40000 ALTER TABLE `rospisanie` ENABLE KEYS */;


-- Дамп структуры для таблица kundo.tapshyrma
CREATE TABLE IF NOT EXISTS `tapshyrma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `klass_aty` varchar(250) NOT NULL,
  `teacher_aty` varchar(250) NOT NULL,
  `predmet_aty` varchar(250) NOT NULL,
  `tema` varchar(250) NOT NULL,
  `sulka` text,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tapshyrma_klass` (`klass_aty`),
  KEY `FK_tapshyrma_teacher` (`teacher_aty`),
  KEY `FK_tapshyrma_predmet` (`predmet_aty`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.tapshyrma: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `tapshyrma` DISABLE KEYS */;
INSERT INTO `tapshyrma` (`id`, `klass_aty`, `teacher_aty`, `predmet_aty`, `tema`, `sulka`, `date`) VALUES
	(4, '9(А)-класс', 'Камалов Султанбек', 'Информатика', 'C# массив', 'https://www.youtube.com/watch?v=sTGnuX0NWGk&t=7s', '2020-04-06');
/*!40000 ALTER TABLE `tapshyrma` ENABLE KEYS */;


-- Дамп структуры для таблица kundo.teacher
CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(250) NOT NULL,
  `login` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fio` (`fio`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.teacher: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` (`id`, `fio`, `login`, `pass`) VALUES
	(10, 'Камалов Султанбек', 'sultan', '12345'),
	(11, 'Сактанова Элиза', 'admin', '12345'),
	(12, 'Пакал уулу Долонбек', 'dolon', '96321');
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;


-- Дамп структуры для таблица kundo.test
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_aty` varchar(250) NOT NULL DEFAULT '0',
  `predmet_aty` varchar(250) NOT NULL DEFAULT '0',
  `klass_aty` varchar(250) NOT NULL DEFAULT '0',
  `sulka_test` text,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kundo.test: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` (`id`, `teacher_aty`, `predmet_aty`, `klass_aty`, `sulka_test`, `date`) VALUES
	(2, 'Камалов Султанбек', 'Информатика', '9(А)-класс', 'https://multiurok.ru/tests/91289/', '2020-04-06');
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
