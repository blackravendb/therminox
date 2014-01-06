-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 06. Jan 2014 um 04:17
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
('asldfj@alsdf.de', 'adfjklö', 'aldfjs', 'c6e4d6427c3a2687f44bb2fb8e512f200335bc6a', 'e5cec537676548c49fdcf11026939baf82c2c6e6', 'Benutzer', 1, 1),
('aslsdfj@alsdf.de', 'adfjklö', 'aldfjs', 'ba8406723811af6772b94b8f6591eb22e0a56408', '2cd52138b8ecfff33d0c74eb548f1fd453f59640', 'Benutzer', 1, 1),
('asslsdfj@alsdf.de', 'adfjklö', 'aldfjs', 'b174e8b0cc426db7fa6ba77c696f9b7c81e4c056', '34e6c718ef4e2a697bcf9f49a15924fbdeaa48d5', 'Benutzer', 1, 1),
('bob.maier2@email.de', 'Maier', 'Bob', 'd95968b31c9bcb8434a62dd107b04002db66da95', '71550502fdd95d02dbfd356b4fa067fe4c7c1f68', 'Benutzer', 2, 0),
('max.mustermann@test.de', 'Mustermann', 'Max', '2', '', 'Benutzer', 1, 0),
('test@test.de', 'test', 'test', 'b0014d0e690fa1080574f2f6096b532eb4880cc6', '6f00afc6550ad5c19d20288ab7545771b4a66c10', 'Benutzer', 2, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferadresse`
--

CREATE TABLE IF NOT EXISTS `lieferadresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benutzer_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `firma` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plz` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ort` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anrede_id` (`anrede_id`),
  KEY `benutzer_e-mail` (`benutzer_email`),
  KEY `plz` (`plz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `lieferadresse`
--

INSERT INTO `lieferadresse` (`id`, `benutzer_email`, `firma`, `nachname`, `vorname`, `strasse`, `plz`, `ort`, `land`, `anrede_id`) VALUES
(1, 'test@test.de', 'Test LTD', 'Mustermann', 'Max', 'testgasse 5', '12345', '', 'Deutschland', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `hexaString` char(40) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `pufferspeicher`
--

INSERT INTO `pufferspeicher` (`id`, `model`, `speicherinhalt`, `leergewicht`, `betriebsdruck`, `temperaturMax`) VALUES
(1, 'VVX200', 200, 50, 10, 95);

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
(1, 1);

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
-- Tabellenstruktur für Tabelle `rechnungsadresse`
--

CREATE TABLE IF NOT EXISTS `rechnungsadresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benutzer_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `firma` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `strasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plz` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ort` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anrede_id` (`anrede_id`),
  KEY `benutzer_e-mail` (`benutzer_email`),
  KEY `plz` (`plz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `rechnungsadresse`
--

INSERT INTO `rechnungsadresse` (`id`, `benutzer_email`, `firma`, `nachname`, `vorname`, `strasse`, `plz`, `ort`, `land`, `anrede_id`) VALUES
(1, 'test@test.de', 'Test LTD', 'Mustermann', 'Max', 'testgasse 5', '12345', '', 'Deutschland', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stutzenmaterial`
--

CREATE TABLE IF NOT EXISTS `stutzenmaterial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

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
  UNIQUE KEY `stutzenmaterial_id` (`stutzenmaterial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `waermetauscher`
--

INSERT INTO `waermetauscher` (`id`, `model`, `betriebsdruck`, `temperatur`, `stutzenmaterial_id`, `hoehe`, `breite`) VALUES
(2, 'BHD21', 30, 195, 1, 191, 73),
(3, 'BHD30', 30, 195, 2, 315, 73);

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
(3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscherAnschluss`
--

CREATE TABLE IF NOT EXISTS `waermetauscherAnschluss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anschluss` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `waermetauscherAnschluss`
--

INSERT INTO `waermetauscherAnschluss` (`id`, `anschluss`) VALUES
(1, '3/8" IG'),
(2, ' 1/2" AG'),
(3, '3/4" AG');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `waermetauscherEinsatzgebiet`
--

CREATE TABLE IF NOT EXISTS `waermetauscherEinsatzgebiet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `einsatzgebiet` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `waermetauscherUnterkategorie`
--

INSERT INTO `waermetauscherUnterkategorie` (`id`, `waermetauscher_id`, `platten`, `laenge`, `leergewicht`, `flaeche`, `inhaltPrimaer`, `inhaltSekundaer`) VALUES
(1, 2, 12, 27, 0.9, 0.14, NULL, NULL),
(2, 2, 20, 45, 1.2, 0.24, NULL, NULL),
(3, 2, 30, 67, 1.4, 0.36, NULL, NULL),
(4, 3, 20, 45, 1.9, 0.46, NULL, NULL),
(5, 3, 30, 65, 2.7, 0.64, NULL, NULL),
(6, 3, 40, 90, 3.8, 0.92, NULL, NULL);

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
-- Constraints der Tabelle `pufferspeicher2pufferspeicherEinsatzgebiet`
--
ALTER TABLE `pufferspeicher2pufferspeicherEinsatzgebiet`
  ADD CONSTRAINT `pufferspeicher2pufferspeicherEinsatzgebiet_ibfk_2` FOREIGN KEY (`pufferspeicherEinsatzgebiet_id`) REFERENCES `pufferspeicherEinsatzgebiet` (`id`),
  ADD CONSTRAINT `pufferspeicher2pufferspeicherEinsatzgebiet_ibfk_1` FOREIGN KEY (`pufferspeicher_id`) REFERENCES `pufferspeicher` (`id`);

--
-- Constraints der Tabelle `rechnungsadresse`
--
ALTER TABLE `rechnungsadresse`
  ADD CONSTRAINT `rechnungsadresse_ibfk_1` FOREIGN KEY (`anrede_id`) REFERENCES `anrede` (`id`),
  ADD CONSTRAINT `rechnungsadresse_ibfk_3` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`);

--
-- Constraints der Tabelle `waermetauscher`
--
ALTER TABLE `waermetauscher`
  ADD CONSTRAINT `waermetauscher_ibfk_3` FOREIGN KEY (`stutzenmaterial_id`) REFERENCES `stutzenmaterial` (`id`);

--
-- Constraints der Tabelle `waermetauscher2waermetauscherAnschluss`
--
ALTER TABLE `waermetauscher2waermetauscherAnschluss`
  ADD CONSTRAINT `waermetauscher2waermetauscherAnschluss_ibfk_1` FOREIGN KEY (`waermetauscher_id`) REFERENCES `waermetauscher` (`id`),
  ADD CONSTRAINT `waermetauscher2waermetauscherAnschluss_ibfk_2` FOREIGN KEY (`waermetauscherAnschluss_id`) REFERENCES `waermetauscherAnschluss` (`id`);

--
-- Constraints der Tabelle `waermetauscher2waermetauscherEinsatzgebiet`
--
ALTER TABLE `waermetauscher2waermetauscherEinsatzgebiet`
  ADD CONSTRAINT `waermetauscher2waermetauscherEinsatzgebiet_ibfk_1` FOREIGN KEY (`waermetauscher_id`) REFERENCES `waermetauscher` (`id`),
  ADD CONSTRAINT `waermetauscher2waermetauscherEinsatzgebiet_ibfk_2` FOREIGN KEY (`waermetauscherEinsatzgebiet_id`) REFERENCES `waermetauscherEinsatzgebiet` (`id`);

--
-- Constraints der Tabelle `waermetauscherUnterkategorie`
--
ALTER TABLE `waermetauscherUnterkategorie`
  ADD CONSTRAINT `waermetauscherUnterkategorie_ibfk_1` FOREIGN KEY (`waermetauscher_id`) REFERENCES `waermetauscher` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
