-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 16 Sty 2014, 22:57
-- Wersja serwera: 5.5.27
-- Wersja PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `mapy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Nazwa` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `IloscGalerii` int(255) DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Nazwa` (`Nazwa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`Id`, `Nazwa`, `IloscGalerii`) VALUES
(1, 'Zabytki', 1),
(2, 'Miejsca', 4),
(3, 'Osoby', 1),
(4, 'Zwierzęta', 1),
(5, 'Bez kategorii', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `galery`
--

CREATE TABLE IF NOT EXISTS `galery` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Autor` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Nazwa` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Ilosc` int(20) DEFAULT NULL,
  `Folder` varchar(40) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Data` date NOT NULL,
  `Kategoria` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Folder` (`Folder`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Zrzut danych tabeli `galery`
--

INSERT INTO `galery` (`Id`, `Autor`, `Nazwa`, `Ilosc`, `Folder`, `Data`, `Kategoria`) VALUES
(2, 'admin', 'przykladowa', 6, 'admin/przykladowa2014-01-05', '2014-01-05', 'Bez kategorii'),
(81, 'Naire', 'Fotki', 2, 'Naire/Fotki2014-01-06', '2014-01-06', 'Miejsca'),
(82, 'Naire', 'Galeria1', 2, 'Naire/Galeria12014-01-07', '2014-01-07', 'Miejsca'),
(87, 'Aga', 'Moja-galeria1', 5, 'Aga/Moja-galeria12014-01-09', '2014-01-09', 'Bez kategorii'),
(88, 'Aga', 'Galeria2', 3, 'Aga/Galeria22014-01-09', '2014-01-09', 'Miejsca'),
(89, 'User', 'User1', 1, 'User/User12014-01-09', '2014-01-09', 'Osoby'),
(90, 'User', 'Zabytki', 3, 'User/Zabytki2014-01-09', '2014-01-09', 'Zabytki'),
(92, 'User', 'Zwierzaki', 1, 'User/Zwierzaki2014-01-09', '2014-01-09', 'Zwierzęta'),
(93, 'admin', 'Admin', 2, 'admin/Admin2014-01-09', '2014-01-09', 'Bez kategorii'),
(95, 'Agnieszka', 'Moje1', 10, 'Agnieszka/Moje12014-01-16', '2014-01-16', 'Miejsca');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `Login` varchar(15) COLLATE utf8_bin NOT NULL,
  `Password` varchar(100) COLLATE utf8_bin NOT NULL,
  `Mail` varchar(30) COLLATE utf8_bin NOT NULL,
  `NoGaleries` int(50) NOT NULL,
  `Birthday` date NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Login` (`Login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `Login`, `Password`, `Mail`, `NoGaleries`, `Birthday`) VALUES
(2, 'Aga', '47b3af9da9b3132ba7a10479a787862f50e1928b', 'aga.p16@wp.pl', 2, '1991-12-30'),
(5, 'Naire', '7436d64ac734521ddf8097238d2615c6ddc8c96c', 'naire.naire@gmail.com', 2, '1991-12-30'),
(6, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.pl', 2, '1991-11-11'),
(7, 'User', '12dea96fec20593566ab75692c9949596833adc9', 'user@wp.pl', 3, '1991-04-02'),
(8, 'Agnieszka', '8d5408fef038965d726a87069ae3cfd721d4a002', 'agnieszka@wp.pl', 1, '1991-11-11');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecie`
--

CREATE TABLE IF NOT EXISTS `zdjecie` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Nazwa` varchar(30) CHARACTER SET latin1 NOT NULL,
  `Galeria` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Lokalizacja` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Autor` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=134 ;

--
-- Zrzut danych tabeli `zdjecie`
--

INSERT INTO `zdjecie` (`Id`, `Nazwa`, `Galeria`, `Lokalizacja`, `Autor`) VALUES
(60, '21072013439.jpg', 'przykladowa', 'krakow', 'admin'),
(61, 'IMG_0020.JPG', 'przykladowa', 'paryz', 'admin'),
(62, 'IMG_0040.JPG', 'przykladowa', 'zakopane', 'admin'),
(63, 'IMG_0077.JPG', 'przykladowa', 'zakopane', 'admin'),
(64, 'IMG_0092.JPG', 'przykladowa', 'paryz', 'admin'),
(65, 'IMG_0245.JPG', 'przykladowa', 'zakopane', 'admin'),
(68, 'IMG_0020.JPG', 'Fotki', 'paryz', 'Naire'),
(69, 'IMG_0092.JPG', 'Fotki', 'paryz', 'Naire'),
(77, 'IMG_0002.JPG', 'Moja-galeria1', 'paryz', 'Aga'),
(78, 'IMG_0004.JPG', 'Moja-galeria1', 'paryz', 'Aga'),
(79, 'IMG_0009.JPG', 'Moja-galeria1', 'paryz', 'Aga'),
(80, 'IMG_0038.JPG', 'Moja-galeria1', 'paryz', 'Aga'),
(81, 'IMG_0092.JPG', 'Moja-galeria1', 'paryz', 'Aga'),
(82, 'IMG_0099.JPG', 'Galeria2', 'paryz', 'Aga'),
(83, 'IMG_0103.JPG', 'Galeria2', 'paryz', 'Aga'),
(84, 'IMG_0106.JPG', 'Galeria2', 'paryz', 'Aga'),
(85, '21072013439.jpg', 'Galeria1', 'krakow', 'Naire'),
(86, '24082013469.jpg', 'Galeria1', 'krasnobrod', 'Naire'),
(88, '24082013457.jpg', 'User1', 'krasnobrod', 'User'),
(89, 'IMG_0026.JPG', 'User1', 'krakow', 'User'),
(90, 'IMG_0139.JPG', 'Zabytki', 'paryz', 'User'),
(91, 'IMG_0167.JPG', 'Zabytki', 'paryz', 'User'),
(92, 'IMG_0381.JPG', 'Zabytki', 'paryz', 'User'),
(96, '24082013458.jpg', 'Zwierzaki', 'krasnobrod', 'User'),
(97, 'cute-puppies-with-worms.jpg', 'Zwierzaki', 'tarnow', 'User'),
(98, 'kotek.jpg', 'Zwierzaki', 'miechow', 'User'),
(99, 'sea turtle.jpg', 'Zwierzaki', 'gdansk', 'User'),
(100, 'admin.png', 'Admin', 'wroclaw', 'admin'),
(101, 'admin2.png', 'Admin', 'lodz', 'admin'),
(114, 'IMG_0092.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(118, 'IMG_0103.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(119, 'IMG_0106.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(121, 'IMG_0454.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(122, 'IMG_0004.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(123, 'IMG_0009.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(124, 'IMG_0034.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(125, 'IMG_0038.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(126, 'IMG_0049.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(127, 'IMG_0081.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(128, 'IMG_0099.JPG', 'Moje1', 'paryz', 'Agnieszka'),
(129, 'IMG_0406.JPG', 'Moje1', 'paryz', 'Agnieszka');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
