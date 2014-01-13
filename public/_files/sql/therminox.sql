-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 13. Jan 2014 um 02:14
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `adresse`
--

INSERT INTO `adresse` (`id`, `benutzer_email`, `firma`, `nachname`, `vorname`, `strasse`, `plz`, `ort`, `land`, `anrede_id`, `lieferadresse`) VALUES
(1, 'admin@therminox.de', 'Therminox', 'Min', 'Ad', 'Therminox-Gasse 2', '83098', 'Brannenburg', 'Deutschland', 1, 0),
(2, 'irgendein@kunde.de', 'BlubWare GmbH', 'Mustermann', 'Irgendein', 'Musterstraße 5', '83098', 'Brannenburg', 'Deutschland', 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Daten für Tabelle `artikelnummer`
--

INSERT INTO `artikelnummer` (`id`, `pufferspeicher_id`, `waermetauscher_id`) VALUES
(29, NULL, 18),
(30, NULL, 19),
(31, NULL, 20),
(32, NULL, 21),
(33, NULL, 22),
(34, 18, NULL),
(35, 19, NULL),
(36, 20, NULL),
(37, 21, NULL),
(38, 22, NULL);

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
('admin@therminox.de', 'Min', 'Ad', '99c13757f3c5a1f637afb7646a2a197da6758f7b', '9794c4f3eee28bb6ef9a11b2e72d127aa1056d82', 'Administrator', 1, 1),
('irgendein@kunde.de', 'Mustermann', 'Irgendein', '8e4b32a9bb0587aece8499fddc668ee6caaf66c7', '8953a6fa5f5a03e39cb7562420843d6c20b5e8db', 'Benutzer', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `link`
--

INSERT INTO `link` (`id`, `benutzer_email`, `hexaString`, `typ`) VALUES
(3, 'irgendein@kunde.de', '8e0324fbfb4c122ce4835d752aceadabed399b77', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Daten für Tabelle `pufferspeicher`
--

INSERT INTO `pufferspeicher` (`id`, `model`, `speicherinhalt`, `leergewicht`, `betriebsdruck`, `temperaturMax`) VALUES
(18, 'VVX200', 200, 50, 10, 95),
(19, 'VVX500', 500, 72, 10, 95),
(20, 'VVX3000', 3000, 390, 10, 95),
(21, 'LAS200', 200, 50, 15, 120),
(22, 'LAS500', 500, 95, 15, 120);

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
(18, 1),
(19, 1),
(21, 1),
(22, 1),
(22, 3),
(20, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pufferspeicherEinsatzgebiet`
--

CREATE TABLE IF NOT EXISTS `pufferspeicherEinsatzgebiet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `einsatzgebiet` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `pufferspeicherEinsatzgebiet`
--

INSERT INTO `pufferspeicherEinsatzgebiet` (`id`, `einsatzgebiet`) VALUES
(1, 'Einfacher Boiler'),
(3, 'Solaranlage'),
(4, 'Gebäude bis 500qm³');

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
(2, 'Edelstahl AISI 316 Mat. 1.4404'),
(4, 'Edelstahl AISI 316 Mat. 1.5407'),
(5, 'Edelstahl AISI 316 Mat. 1.8411');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Daten für Tabelle `waermetauscher`
--

INSERT INTO `waermetauscher` (`id`, `model`, `betriebsdruck`, `temperatur`, `stutzenmaterial_id`, `hoehe`, `breite`) VALUES
(18, 'BHD21', 30, 195, 1, 191, 73),
(19, 'BHM24', 30, 195, 1, 461, 89),
(20, 'BHM56 CFL', 45, 195, 5, 532, 271),
(21, 'BHM130', 25, 155, 4, 1092, 387),
(22, 'BHD30', 30, 220, 1, 315, 73);

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
(18, 1),
(18, 2),
(22, 2),
(18, 3),
(19, 3),
(22, 3),
(22, 7),
(20, 8),
(21, 8),
(20, 9),
(21, 9);

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
(18, 1),
(22, 1),
(19, 2),
(20, 4),
(21, 4),
(20, 5),
(20, 6),
(21, 6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscherAnschluss`
--

CREATE TABLE IF NOT EXISTS `waermetauscherAnschluss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anschluss` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `waermetauscherAnschluss`
--

INSERT INTO `waermetauscherAnschluss` (`id`, `anschluss`) VALUES
(1, '3/8" IG'),
(2, '1/2" AG'),
(3, '3/4" AG'),
(7, '1" AG'),
(8, '1 1/4" AG'),
(9, 'Compac Flansch DN 65');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscherEinsatzgebiet`
--

CREATE TABLE IF NOT EXISTS `waermetauscherEinsatzgebiet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `einsatzgebiet` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `waermetauscherEinsatzgebiet`
--

INSERT INTO `waermetauscherEinsatzgebiet` (`id`, `einsatzgebiet`) VALUES
(1, 'Umrüstung von PKW`s auf Rapsöl'),
(2, 'Umrüstung großerer Nutzfahrzeuge auf Rapsöl'),
(4, 'Fußbodenheizung'),
(5, 'Solaranlage'),
(6, 'Erdwärme via Erdbohrung');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Daten für Tabelle `waermetauscherUnterkategorie`
--

INSERT INTO `waermetauscherUnterkategorie` (`id`, `waermetauscher_id`, `platten`, `laenge`, `leergewicht`, `flaeche`, `inhaltPrimaer`, `inhaltSekundaer`) VALUES
(10, 18, 12, 27, 0, 0, NULL, NULL),
(11, 19, 10, 36, 2, 0, NULL, NULL),
(12, 20, 30, 84, 26.6, 3.64, NULL, NULL),
(13, 21, 120, 297, 103, 20, NULL, NULL),
(14, 22, 20, 45, 1.9, 0.46, NULL, NULL);

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
