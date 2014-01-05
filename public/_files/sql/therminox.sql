-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 04. Jan 2014 um 17:40
-- Server Version: 5.5.34
-- PHP-Version: 5.3.10-1ubuntu3.9

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
(1, 'Herr'),
(2, 'Frau'),
(3, 'Firma');

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
  `salt` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `berechtigung` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  `bestaetigt` tinyint(1) NOT NULL,
  PRIMARY KEY (`email`),
  KEY `anrede_id` (`anrede_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`email`, `nachname`, `vorname`, `passwort`, `salt`, `berechtigung`, `anrede_id`, `bestaetigt`) VALUES
('admin@test.de', 'min', 'ad', '1', '', 'Administrator', 1, 0),
('bob.maier2@email.de', 'Maier', 'Bob', 'blub123', '', 'Benutzer', 2, 0),
('max.mustermann@test.de', 'Mustermann', 'Max', '2', '', 'Benutzer', 1, 0),
('test@test.de', 'test', 'test', 'maeh', 'abcd', 'Benutzer', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferadresse`
--

CREATE TABLE IF NOT EXISTS `lieferadresse` (
  `id` int(11) NOT NULL,
  `benutzer_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `firma` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plz` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anrede_id` (`anrede_id`),
  KEY `benutzer_e-mail` (`benutzer_email`),
  KEY `plz` (`plz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `hexaString` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `typ` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `link`
--

INSERT INTO `link` (`id`, `email`, `hexaString`, `typ`) VALUES
(1, 'max.mustermann@test.de', 'asdfasdfsd54f4sdaf564sd6f', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnungsadresse`
--

CREATE TABLE IF NOT EXISTS `rechnungsadresse` (
  `id` int(11) NOT NULL,
  `benutzer_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `firma` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plz` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anrede_id` (`anrede_id`),
  KEY `benutzer_e-mail` (`benutzer_email`),
  KEY `plz` (`plz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stutzenmaterial`
--

CREATE TABLE IF NOT EXISTS `stutzenmaterial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `stutzenmaterial`
--

INSERT INTO `stutzenmaterial` (`id`, `name`) VALUES
(1, 'Edelstahl AISI 304 Mat. 1.4301');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscherGeloetet`
--

CREATE TABLE IF NOT EXISTS `waermetauscherGeloetet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `betriebsdruck` int(11) NOT NULL,
  `temperatur` int(11) NOT NULL,
  `stutzenmaterial_id` int(11) NOT NULL,
  `hoehe` int(11) NOT NULL,
  `breite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stutzenmaterial_id` (`stutzenmaterial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `waermetauscherGeloetet`
--

INSERT INTO `waermetauscherGeloetet` (`id`, `model`, `betriebsdruck`, `temperatur`, `stutzenmaterial_id`, `hoehe`, `breite`) VALUES
(2, 'BHD21', 30, 195, 1, 191, 73);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscherGeloetetUnterkategorie`
--

CREATE TABLE IF NOT EXISTS `waermetauscherGeloetetUnterkategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waermetauscherGeloetet_id` int(11) NOT NULL,
  `platten` int(11) NOT NULL,
  `laenge` int(11) NOT NULL,
  `leergewicht` float NOT NULL,
  `flaeche` float NOT NULL,
  `inhaltPrimaer` float DEFAULT NULL,
  `inhaltSekundaer` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `waermetauscherGeloetet_id` (`waermetauscherGeloetet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `waermetauscherGeloetetUnterkategorie`
--

INSERT INTO `waermetauscherGeloetetUnterkategorie` (`id`, `waermetauscherGeloetet_id`, `platten`, `laenge`, `leergewicht`, `flaeche`, `inhaltPrimaer`, `inhaltSekundaer`) VALUES
(1, 2, 12, 27, 0.9, 0.14, NULL, NULL),
(2, 2, 20, 45, 1.2, 0.24, NULL, NULL),
(3, 2, 30, 67, 1.4, 0.36, NULL, NULL);

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
  ADD CONSTRAINT `lieferadresse_ibfk_3` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`);

--
-- Constraints der Tabelle `rechnungsadresse`
--
ALTER TABLE `rechnungsadresse`
  ADD CONSTRAINT `rechnungsadresse_ibfk_1` FOREIGN KEY (`anrede_id`) REFERENCES `anrede` (`id`),
  ADD CONSTRAINT `rechnungsadresse_ibfk_3` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`);

--
-- Constraints der Tabelle `waermetauscherGeloetet`
--
ALTER TABLE `waermetauscherGeloetet`
  ADD CONSTRAINT `waermetauscherGeloetet_ibfk_1` FOREIGN KEY (`stutzenmaterial_id`) REFERENCES `stutzenmaterial` (`id`);

--
-- Constraints der Tabelle `waermetauscherGeloetetUnterkategorie`
--
ALTER TABLE `waermetauscherGeloetetUnterkategorie`
  ADD CONSTRAINT `waermetauscherGeloetetUnterkategorie_ibfk_1` FOREIGN KEY (`waermetauscherGeloetet_id`) REFERENCES `waermetauscherGeloetet` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
