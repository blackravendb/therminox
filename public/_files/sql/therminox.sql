-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 16. Dez 2013 um 10:24
-- Server Version: 5.5.34
-- PHP-Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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

--
-- Daten für Tabelle `anrede`
--

INSERT INTO `anrede` (`id`, `anrede`) VALUES
(1, 'Herr');

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `erklaerung` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE IF NOT EXISTS `benutzer` (
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `passwort` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `berechtigung` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  PRIMARY KEY (`email`),
  KEY `anrede_id` (`anrede_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`email`, `nachname`, `vorname`, `passwort`, `berechtigung`, `anrede_id`) VALUES
('admin@test.de', 'min', 'ad', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 1),
('max.mustermann@test.de', 'Mustermann', 'Max', '906072001efddf3e11e6d2b5782f4777fe038739', 'Benutzer', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferadresse`
--

CREATE TABLE IF NOT EXISTS `lieferadresse` (
  `id` int(11) NOT NULL,
  `benutzer_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plz` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anrede_id` (`anrede_id`),
  KEY `benutzer_e-mail` (`benutzer_email`),
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
  `benutzer_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plz` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anrede_id` (`anrede_id`),
  KEY `benutzer_e-mail` (`benutzer_email`),
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
  ADD CONSTRAINT `lieferadresse_ibfk_1` FOREIGN KEY (`anrede_id`) REFERENCES `anrede` (`id`),
  ADD CONSTRAINT `lieferadresse_ibfk_2` FOREIGN KEY (`plz`) REFERENCES `plz2ort` (`plz`),
  ADD CONSTRAINT `lieferadresse_ibfk_3` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`);

--
-- Constraints der Tabelle `rechnungsadresse`
--
ALTER TABLE `rechnungsadresse`
  ADD CONSTRAINT `rechnungsadresse_ibfk_1` FOREIGN KEY (`anrede_id`) REFERENCES `anrede` (`id`),
  ADD CONSTRAINT `rechnungsadresse_ibfk_2` FOREIGN KEY (`plz`) REFERENCES `plz2ort` (`plz`),
  ADD CONSTRAINT `rechnungsadresse_ibfk_3` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
