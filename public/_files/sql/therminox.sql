-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 12. Jan 2014 um 14:27
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
-- Tabellenstruktur für Tabelle `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benutzer_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `firma` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plz` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ort` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  `lieferadresse` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anrede_id` (`anrede_id`),
  KEY `benutzer_e-mail` (`benutzer_email`),
  KEY `plz` (`plz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

--
-- Daten für Tabelle `adresse`
--

INSERT INTO `adresse` (`id`, `benutzer_email`, `firma`, `nachname`, `vorname`, `strasse`, `plz`, `ort`, `land`, `anrede_id`, `lieferadresse`) VALUES
(77, 'dennis.brandmueller@gmx.de', 'BlubWare', 'Brandmüller', 'Dennis', 'Blubstraße 1', '83080', 'Oberaudorf', 'Deutschland', 1, 0),
(78, 'blackravendb@gmx.net', 'blub', 'bl', 'bl', 'l', '55555', 'asdf', 'Deutschland', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebot`
--

CREATE TABLE IF NOT EXISTS `angebot` (
  `artikelnummer_id` int(11) NOT NULL,
  `angebotskorb_id` int(11) NOT NULL,
  `angebotStatus_id` int(11) NOT NULL,
  `bemerkung` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`angebotskorb_id`,`artikelnummer_id`),
  KEY `angebotStatus_id` (`angebotStatus_id`),
  KEY `artikelnummer_id` (`artikelnummer_id`),
  KEY `angebotskorb_id` (`angebotskorb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `angebot`
--

INSERT INTO `angebot` (`artikelnummer_id`, `angebotskorb_id`, `angebotStatus_id`, `bemerkung`) VALUES
(1, 1, 3, NULL),
(1, 24, 2, 'asdfasdf'),
(3, 25, 2, 'sdfksdfjlsdfsdflsdfsdf'),
(3, 26, 2, 'sdsdfsdfasdfsdfsdfsdf'),
(14, 26, 2, 'asdsdsdfasdfsdfsdfsdf');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebotskorb`
--

CREATE TABLE IF NOT EXISTS `angebotskorb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benutzer_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `erstelldatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `benutzer_email` (`benutzer_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Daten für Tabelle `angebotskorb`
--

INSERT INTO `angebotskorb` (`id`, `benutzer_email`, `erstelldatum`) VALUES
(1, 'test@test.de', '2014-12-01 13:25:10'),
(24, 'dennis.brandmueller@gmx.de', '2014-12-01 13:25:10'),
(25, 'blackravendb@gmx.net', '2014-12-01 13:25:10'),
(26, 'dennis.brandmueller@gmx.de', '2014-12-01 13:25:10');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebotStatus`
--

CREATE TABLE IF NOT EXISTS `angebotStatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `angebotStatus`
--

INSERT INTO `angebotStatus` (`id`, `status`) VALUES
(1, 'In Bearbeitung'),
(2, 'Offen'),
(3, 'Abgeschlossen');

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
-- Tabellenstruktur für Tabelle `artikelnummer`
--

CREATE TABLE IF NOT EXISTS `artikelnummer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pufferspeicher_id` int(11) DEFAULT NULL,
  `waermetauscher_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pufferspeicher_id` (`pufferspeicher_id`),
  UNIQUE KEY `waermetauscher_id` (`waermetauscher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Daten für Tabelle `artikelnummer`
--

INSERT INTO `artikelnummer` (`id`, `pufferspeicher_id`, `waermetauscher_id`) VALUES
(1, NULL, 2),
(2, 1, NULL),
(3, NULL, 3),
(4, NULL, 6),
(13, 13, NULL),
(14, NULL, 7);

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
('admin@therminox.de', 'min', 'ad', 'b0014d0e690fa1080574f2f6096b532eb4880cc6', '6f00afc6550ad5c19d20288ab7545771b4a66c10', 'Administrator', 1, 1),
('blackravendb@gmx.net', 'bl', 'bl', 'b9da0fee29ef5efb24e66ce7a22b31a1da4b2494', '5e2b15f5a51ca2e408244d46da2ed9fa03d3aab9', 'Benutzer', 1, 1),
('dennis.brandmueller@gmx.de', 'Brandmüller', 'Dennis', '25ee9f5cd40b1b84cd492c3af106d7ed2477c7c8', 'd072d3a7e267d42c25dca6ad281c668a6ed84ae0', 'Benutzer', 1, 1),
('test@test.de', 'test', 'test', 'b0014d0e690fa1080574f2f6096b532eb4880cc6', '6f00afc6550ad5c19d20288ab7545771b4a66c10', 'Benutzer', 2, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benutzer_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `hexaString` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `typ` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `benutzer_email` (`benutzer_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pufferspeicher`
--

CREATE TABLE IF NOT EXISTS `pufferspeicher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `speicherinhalt` int(11) NOT NULL,
  `leergewicht` int(11) NOT NULL,
  `betriebsdruck` int(11) NOT NULL,
  `temperaturMax` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `pufferspeicher`
--

INSERT INTO `pufferspeicher` (`id`, `model`, `speicherinhalt`, `leergewicht`, `betriebsdruck`, `temperaturMax`) VALUES
(1, 'VVX200', 200, 50, 500, 95),
(13, 'blub3', 2000, 100, 5000, 100);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pufferspeicher2pufferspeicherEinsatzgebiet`
--

CREATE TABLE IF NOT EXISTS `pufferspeicher2pufferspeicherEinsatzgebiet` (
  `pufferspeicher_id` int(11) NOT NULL,
  `pufferspeicherEinsatzgebiet_id` int(11) NOT NULL,
  PRIMARY KEY (`pufferspeicher_id`,`pufferspeicherEinsatzgebiet_id`),
  KEY `pufferspeicherEinsatzgebiet_id` (`pufferspeicherEinsatzgebiet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `pufferspeicher2pufferspeicherEinsatzgebiet`
--

INSERT INTO `pufferspeicher2pufferspeicherEinsatzgebiet` (`pufferspeicher_id`, `pufferspeicherEinsatzgebiet_id`) VALUES
(1, 1),
(13, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pufferspeicherEinsatzgebiet`
--

CREATE TABLE IF NOT EXISTS `pufferspeicherEinsatzgebiet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `einsatzgebiet` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `pufferspeicherEinsatzgebiet`
--

INSERT INTO `pufferspeicherEinsatzgebiet` (`id`, `einsatzgebiet`) VALUES
(1, 'Einfacher Boiler');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stutzenmaterial`
--

CREATE TABLE IF NOT EXISTS `stutzenmaterial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `stutzenmaterial`
--

INSERT INTO `stutzenmaterial` (`id`, `name`) VALUES
(1, 'Edelstahl AISI 304 Mat. 1.4301'),
(2, 'Edelstahl AISI 316 Mat. 1.4404');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscher`
--

CREATE TABLE IF NOT EXISTS `waermetauscher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `betriebsdruck` int(11) NOT NULL,
  `temperatur` int(11) NOT NULL,
  `stutzenmaterial_id` int(11) NOT NULL,
  `hoehe` int(11) NOT NULL,
  `breite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stutzenmaterial_id` (`stutzenmaterial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `waermetauscher`
--

INSERT INTO `waermetauscher` (`id`, `model`, `betriebsdruck`, `temperatur`, `stutzenmaterial_id`, `hoehe`, `breite`) VALUES
(2, 'BHD21', 30, 195, 1, 191, 73),
(3, 'BHD30', 30, 195, 2, 315, 73),
(6, 'BHM21', 30, 195, 1, 203, 73),
(7, 'blubWT2', 10, 10, 2, 10, 10);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscher2waermetauscherAnschluss`
--

CREATE TABLE IF NOT EXISTS `waermetauscher2waermetauscherAnschluss` (
  `waermetauscher_id` int(11) NOT NULL,
  `waermetauscherAnschluss_id` int(11) NOT NULL,
  PRIMARY KEY (`waermetauscher_id`,`waermetauscherAnschluss_id`),
  KEY `waermetauscherAnschluss_id` (`waermetauscherAnschluss_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `waermetauscher2waermetauscherAnschluss`
--

INSERT INTO `waermetauscher2waermetauscherAnschluss` (`waermetauscher_id`, `waermetauscherAnschluss_id`) VALUES
(2, 1),
(2, 2),
(7, 2),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscher2waermetauscherEinsatzgebiet`
--

CREATE TABLE IF NOT EXISTS `waermetauscher2waermetauscherEinsatzgebiet` (
  `waermetauscher_id` int(11) NOT NULL,
  `waermetauscherEinsatzgebiet_id` int(11) NOT NULL,
  PRIMARY KEY (`waermetauscher_id`,`waermetauscherEinsatzgebiet_id`),
  KEY `waermetauscherEinsatzgebiet_id` (`waermetauscherEinsatzgebiet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `waermetauscher2waermetauscherEinsatzgebiet`
--

INSERT INTO `waermetauscher2waermetauscherEinsatzgebiet` (`waermetauscher_id`, `waermetauscherEinsatzgebiet_id`) VALUES
(2, 1),
(7, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscherAnschluss`
--

CREATE TABLE IF NOT EXISTS `waermetauscherAnschluss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anschluss` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `waermetauscherAnschluss`
--

INSERT INTO `waermetauscherAnschluss` (`id`, `anschluss`) VALUES
(1, '3/8" IG'),
(2, '1/2" AG'),
(3, '3/4" AG');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscherEinsatzgebiet`
--

CREATE TABLE IF NOT EXISTS `waermetauscherEinsatzgebiet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `einsatzgebiet` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `waermetauscherEinsatzgebiet`
--

INSERT INTO `waermetauscherEinsatzgebiet` (`id`, `einsatzgebiet`) VALUES
(1, 'Umrüstung von PKW`s auf Rapsöl'),
(2, 'Umrüstung großerer Nutzfahrzeuge auf Rapsöl');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscherUnterkategorie`
--

CREATE TABLE IF NOT EXISTS `waermetauscherUnterkategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waermetauscher_id` int(11) NOT NULL,
  `platten` int(11) NOT NULL,
  `laenge` int(11) NOT NULL,
  `leergewicht` float NOT NULL,
  `flaeche` float NOT NULL,
  `inhaltPrimaer` float DEFAULT NULL,
  `inhaltSekundaer` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `waermetauscherGeloetet_id` (`waermetauscher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `waermetauscherUnterkategorie`
--

INSERT INTO `waermetauscherUnterkategorie` (`id`, `waermetauscher_id`, `platten`, `laenge`, `leergewicht`, `flaeche`, `inhaltPrimaer`, `inhaltSekundaer`) VALUES
(1, 2, 12, 27, 0.9, 0.14, NULL, NULL),
(2, 2, 20, 45, 1.2, 0.24, NULL, NULL),
(3, 2, 30, 67, 1.4, 0.36, NULL, NULL),
(4, 3, 20, 45, 1.9, 0.46, NULL, NULL),
(5, 3, 30, 65, 2.7, 0.64, NULL, NULL),
(6, 3, 40, 90, 3.8, 0.92, NULL, NULL),
(7, 7, 10, 10, 10, 10, 10, 10);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`anrede_id`) REFERENCES `anrede` (`id`),
  ADD CONSTRAINT `adresse_ibfk_4` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `angebot`
--
ALTER TABLE `angebot`
  ADD CONSTRAINT `angebot_ibfk_1` FOREIGN KEY (`artikelnummer_id`) REFERENCES `artikelnummer` (`id`),
  ADD CONSTRAINT `angebot_ibfk_3` FOREIGN KEY (`angebotStatus_id`) REFERENCES `angebotStatus` (`id`),
  ADD CONSTRAINT `angebot_ibfk_4` FOREIGN KEY (`angebotskorb_id`) REFERENCES `angebotskorb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `angebotskorb`
--
ALTER TABLE `angebotskorb`
  ADD CONSTRAINT `angebotskorb_ibfk_2` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `artikelnummer`
--
ALTER TABLE `artikelnummer`
  ADD CONSTRAINT `artikelnummer_ibfk_3` FOREIGN KEY (`waermetauscher_id`) REFERENCES `waermetauscher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artikelnummer_ibfk_4` FOREIGN KEY (`pufferspeicher_id`) REFERENCES `pufferspeicher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints der Tabelle `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_2` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `pufferspeicher2pufferspeicherEinsatzgebiet`
--
ALTER TABLE `pufferspeicher2pufferspeicherEinsatzgebiet`
  ADD CONSTRAINT `pufferspeicher2pufferspeicherEinsatzgebiet_ibfk_2` FOREIGN KEY (`pufferspeicherEinsatzgebiet_id`) REFERENCES `pufferspeicherEinsatzgebiet` (`id`),
  ADD CONSTRAINT `pufferspeicher2pufferspeicherEinsatzgebiet_ibfk_3` FOREIGN KEY (`pufferspeicher_id`) REFERENCES `pufferspeicher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `waermetauscher`
--
ALTER TABLE `waermetauscher`
  ADD CONSTRAINT `waermetauscher_ibfk_3` FOREIGN KEY (`stutzenmaterial_id`) REFERENCES `stutzenmaterial` (`id`);

--
-- Constraints der Tabelle `waermetauscher2waermetauscherAnschluss`
--
ALTER TABLE `waermetauscher2waermetauscherAnschluss`
  ADD CONSTRAINT `waermetauscher2waermetauscherAnschluss_ibfk_2` FOREIGN KEY (`waermetauscherAnschluss_id`) REFERENCES `waermetauscherAnschluss` (`id`),
  ADD CONSTRAINT `waermetauscher2waermetauscherAnschluss_ibfk_3` FOREIGN KEY (`waermetauscher_id`) REFERENCES `waermetauscher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `waermetauscher2waermetauscherEinsatzgebiet`
--
ALTER TABLE `waermetauscher2waermetauscherEinsatzgebiet`
  ADD CONSTRAINT `waermetauscher2waermetauscherEinsatzgebiet_ibfk_2` FOREIGN KEY (`waermetauscherEinsatzgebiet_id`) REFERENCES `waermetauscherEinsatzgebiet` (`id`),
  ADD CONSTRAINT `waermetauscher2waermetauscherEinsatzgebiet_ibfk_3` FOREIGN KEY (`waermetauscher_id`) REFERENCES `waermetauscher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `waermetauscherUnterkategorie`
--
ALTER TABLE `waermetauscherUnterkategorie`
  ADD CONSTRAINT `waermetauscherUnterkategorie_ibfk_2` FOREIGN KEY (`waermetauscher_id`) REFERENCES `waermetauscher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
