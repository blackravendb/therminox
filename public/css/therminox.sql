-- phpMyAdmin SQL Dump
-- version 4.0.9deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Dez 2013 um 15:20
-- Server Version: 5.5.33-1
-- PHP-Version: 5.5.6-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `therminox`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `anrede`
--

CREATE TABLE IF NOT EXISTS `anrede` (
  `id` int(11) NOT NULL,
  `anrede` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `begriff`
--

CREATE TABLE IF NOT EXISTS `begriff` (
  `begriff` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `begrifferklaerung_id` int(11) NOT NULL,
  PRIMARY KEY (`begriff`),
  KEY `begrifferklaerung_id` (`begrifferklaerung_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `begrifferklaerung`
--

CREATE TABLE IF NOT EXISTS `begrifferklaerung` (
  `id` int(11) NOT NULL,
  `erklaerung` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE IF NOT EXISTS `benutzer` (
  `e-mail` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `passwort` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `berechtigung` blob NOT NULL,
  `anrede_id` int(11) NOT NULL,
  PRIMARY KEY (`e-mail`),
  KEY `anrede_id` (`anrede_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferadresse`
--

CREATE TABLE IF NOT EXISTS `lieferadresse` (
  `id` int(11) NOT NULL,
  `benutzer_e-mail` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plz` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anrede_id` (`anrede_id`),
  KEY `benutzer_e-mail` (`benutzer_e-mail`),
  KEY `plz` (`plz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plz2ort`
--

CREATE TABLE IF NOT EXISTS `plz2ort` (
  `plz` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `ort` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`plz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnungsadresse`
--

CREATE TABLE IF NOT EXISTS `rechnungsadresse` (
  `id` int(11) NOT NULL,
  `benutzer_e-mail` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plz` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anrede_id` (`anrede_id`),
  KEY `benutzer_e-mail` (`benutzer_e-mail`),
  KEY `plz` (`plz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `begriff`
--
ALTER TABLE `begriff`
  ADD CONSTRAINT `begriff_ibfk_2` FOREIGN KEY (`begrifferklaerung_id`) REFERENCES `begrifferklaerung` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD CONSTRAINT `benutzer_ibfk_1` FOREIGN KEY (`anrede_id`) REFERENCES `anrede` (`id`);

--
-- Constraints der Tabelle `lieferadresse`
--
ALTER TABLE `lieferadresse`
  ADD CONSTRAINT `lieferadresse_ibfk_3` FOREIGN KEY (`benutzer_e-mail`) REFERENCES `benutzer` (`e-mail`),
  ADD CONSTRAINT `lieferadresse_ibfk_1` FOREIGN KEY (`anrede_id`) REFERENCES `anrede` (`id`),
  ADD CONSTRAINT `lieferadresse_ibfk_2` FOREIGN KEY (`plz`) REFERENCES `plz2ort` (`plz`);

--
-- Constraints der Tabelle `rechnungsadresse`
--
ALTER TABLE `rechnungsadresse`
  ADD CONSTRAINT `rechnungsadresse_ibfk_3` FOREIGN KEY (`benutzer_e-mail`) REFERENCES `benutzer` (`e-mail`),
  ADD CONSTRAINT `rechnungsadresse_ibfk_1` FOREIGN KEY (`anrede_id`) REFERENCES `anrede` (`id`),
  ADD CONSTRAINT `rechnungsadresse_ibfk_2` FOREIGN KEY (`plz`) REFERENCES `plz2ort` (`plz`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
