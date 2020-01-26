-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: 178.32.219.12
-- Czas wygenerowania: 14 Maj 2018, 13:46
-- Wersja serwera: 5.6.12
-- Wersja PHP: 5.6.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `22988596_0000001`
--
USE `22988596_0000001`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `FLOTA`
--

CREATE TABLE IF NOT EXISTS `FLOTA` (
  `ID_F` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Gracza` int(11) NOT NULL,
  `Status` text COLLATE utf8_unicode_ci NOT NULL,
  `ID_Lokalizacja_Start` int(11) NOT NULL,
  `ID_Lokalizacja_Stop` int(11) NOT NULL,
  `Mysliwiec` int(11) NOT NULL,
  `Niszczyciel_Barakuda` int(11) NOT NULL,
  `Niszczyciel_Manta` int(11) NOT NULL,
  `Krazownik_Orka` int(11) NOT NULL,
  `Krazownik_Merlin` int(11) NOT NULL,
  `Krazownik_Krab` int(11) NOT NULL,
  `Pancernik` int(11) NOT NULL,
  `Tim_stamp_Start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Tim_stamp_Stop` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Bonus_Pkt_Atak` int(11) NOT NULL DEFAULT '0',
  `Bonus_Pkt_Zycia` int(11) NOT NULL DEFAULT '0',
  `Rabunek_Wodor` int(11) NOT NULL DEFAULT '0',
  `Rabunek_Metal` int(11) NOT NULL DEFAULT '0',
  `Rabunek_Uran` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_F`),
  UNIQUE KEY `ID_F` (`ID_F`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `FLOTA`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `GRACZ`
--

CREATE TABLE IF NOT EXISTS `GRACZ` (
  `ID_G` int(11) NOT NULL AUTO_INCREMENT,
  `Email` text COLLATE utf8_unicode_ci NOT NULL,
  `Nazwa_Gracza` text COLLATE utf8_unicode_ci NOT NULL,
  `Haslo` text COLLATE utf8_unicode_ci NOT NULL,
  `WspX` int(11) NOT NULL,
  `WspY` int(11) NOT NULL,
  `Galaktyka` int(11) NOT NULL,
  `Ostatnia_Wizyta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Punkty_Rankingu` int(11) NOT NULL,
  PRIMARY KEY (`ID_G`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `GRACZ`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `PLANETA`
--

CREATE TABLE IF NOT EXISTS `PLANETA` (
  `ID_P` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Gracza` int(11) NOT NULL,
  `Stacja_Elektrolizy` int(11) NOT NULL,
  `Kopalnia` int(11) NOT NULL,
  `Elektrownia` int(11) NOT NULL,
  `Zaklad_Konwersji_Uranu` int(11) NOT NULL,
  `Gwiezdna_Stocznia` int(11) NOT NULL,
  `Wodor` int(11) NOT NULL,
  `Metal` int(11) NOT NULL,
  `Energia` int(11) NOT NULL,
  `Uran` int(11) NOT NULL,
  `Wsp_X_Planety` int(11) NOT NULL,
  `Wsp_Y_Planety` int(11) NOT NULL,
  `Galaktyka_Planety` int(11) NOT NULL,
  `Tim_stamp_Ost_Bud` datetime NOT NULL,
  `Tim_stamp_Akt_Sur` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID_P`),
  UNIQUE KEY `ID_P` (`ID_P`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `PLANETA`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
