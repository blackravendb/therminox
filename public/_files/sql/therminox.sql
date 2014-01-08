-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Jan 2014 um 16:27
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
  `ort` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `land` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anrede_id` int(11) NOT NULL,
  `lieferadresse` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anrede_id` (`anrede_id`),
  KEY `benutzer_e-mail` (`benutzer_email`),
  KEY `plz` (`plz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=68 ;

--
-- Daten für Tabelle `adresse`
--

INSERT INTO `adresse` (`id`, `benutzer_email`, `firma`, `nachname`, `vorname`, `strasse`, `plz`, `ort`, `land`, `anrede_id`, `lieferadresse`) VALUES
(1, 'test@test.de', 'Test LTD', 'Mustermann', 'Max', 'testgasse 5', '12345', '', 'Deutschland', 3, 0),
(66, '11dennis.brandmueller@stud.fh-rosenheim.de', 'Blubware', 'Brandmüller', 'Dennis', 'Martin-Greif-Str. 24', '83080', 'Oberaudorf', 'Deutschland', 1, 1),
(67, 'dennis.brandmueller@stud.fh-rosenheim.de', 'Blubware', 'Brandmüller', 'Dennis', 'Sankt-Joseph-Spitalstr. 5', '83080', 'Oberaudorf', 'Deutschland', 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebot`
--

CREATE TABLE IF NOT EXISTS `angebot` (
  `artikelnummer_id` int(11) NOT NULL,
  `angebotskorb_id` int(11) NOT NULL,
  `angebotStatus_id` int(11) NOT NULL,
  PRIMARY KEY (`angebotskorb_id`,`artikelnummer_id`),
  KEY `angebotStatus_id` (`angebotStatus_id`),
  KEY `artikelnummer_id` (`artikelnummer_id`),
  KEY `angebotskorb_id` (`angebotskorb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `angebot`
--

INSERT INTO `angebot` (`artikelnummer_id`, `angebotskorb_id`, `angebotStatus_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebotskorb`
--

CREATE TABLE IF NOT EXISTS `angebotskorb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `benutzer_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `benutzer_email` (`benutzer_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `angebotskorb`
--

INSERT INTO `angebotskorb` (`id`, `benutzer_email`) VALUES
(1, 'test@test.de');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebotStatus`
--

CREATE TABLE IF NOT EXISTS `angebotStatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `angebotStatus`
--

INSERT INTO `angebotStatus` (`id`, `status`) VALUES
(1, 'In Bearbeitung');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `artikelnummer`
--

INSERT INTO `artikelnummer` (`id`, `pufferspeicher_id`, `waermetauscher_id`) VALUES
(1, NULL, 2),
(2, 1, NULL),
(3, NULL, 3),
(4, NULL, 6);

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
('10dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', '01ace061a27637224abe1388e658fdcda7d197a3', '61b0d56728fce0eb218d6d316e34223678693366', 'Administrator', 1, 1),
('11dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', 'ce8443efe084789b1b1914a5ab2b2f9e5647f8b4', 'b025738c5ab56c4e58901e5fe9aa4332e1f27668', 'Administrator', 1, 1),
('2dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', 'be83fd16834c2c644b422fa187403138bf7510ee', 'c78a4daebf260cfb995b850abad6d8d6196d6632', 'Administrator', 1, 1),
('3dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', 'b16930e9ca337a10d7f24f1701e8761474dfac84', '8b0e3e88ccc9a0a207d2dd8888feb18e9704fff7', 'Administrator', 1, 1),
('4dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', '163fc10efc503829f64650e1c9e15bd4995bd024', '08722d477d308d9c93a18885998eb2e7c13e471a', 'Administrator', 1, 1),
('5dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', 'f587dcbee469a5776ea58c308a051ad2fee07440', '7a45459492ed1408132404aded1b9d7ae17a63c9', 'Administrator', 1, 1),
('6dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', 'eeb7679573550bc93bb2871eb3a98c9ee05a204e', 'f9d4bd0f5a2488aed12732b79e7a6bec6775cf66', 'Administrator', 1, 1),
('7dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', 'bb3318ecf9740e00efdad07f40c49aa211186a77', '64c0cc3ccc4946d016cc9c66a7c76a4cb4d4446d', 'Administrator', 1, 1),
('8dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', 'e0285d14c8c16064d69ab74af744530924ba81e7', 'e078bf6996b958e772180017cd1105ac1cf89473', 'Administrator', 1, 1),
('9dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', '515988c76778a4376fce45720ad0a80cedf121fc', 'acb50adec11a49e53ec4e619d9e00d44d65e9901', 'Administrator', 1, 1),
('admin@test.de', 'min', 'ad', '1', '', 'Administrator', 1, 0),
('asldfj@alsdf.de', 'adfjklö', 'aldfjs', 'c6e4d6427c3a2687f44bb2fb8e512f200335bc6a', 'e5cec537676548c49fdcf11026939baf82c2c6e6', 'Benutzer', 1, 1),
('aslsdfj@alsdf.de', 'adfjklö', 'aldfjs', 'ba8406723811af6772b94b8f6591eb22e0a56408', '2cd52138b8ecfff33d0c74eb548f1fd453f59640', 'Benutzer', 1, 1),
('asslsdfj@alsdf.de', 'adfjklö', 'aldfjs', 'b174e8b0cc426db7fa6ba77c696f9b7c81e4c056', '34e6c718ef4e2a697bcf9f49a15924fbdeaa48d5', 'Benutzer', 1, 1),
('bob.maier2@email.de', 'Maier', 'Bob', 'd95968b31c9bcb8434a62dd107b04002db66da95', '71550502fdd95d02dbfd356b4fa067fe4c7c1f68', 'Benutzer', 2, 0),
('dennis.brandmueller@stud.fh-rosenheim.de', 'Brandmüller', 'Dennis', '61d8f332dbfe53708316081957abf5bd4108c72a', '914fe439224eeb9c7149d8361346f8d76adf221c', 'Administrator', 1, 1),
('max.mustermann@test.de', 'Mustermann', 'Max', '2', '', 'Benutzer', 1, 0),
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

--
-- Daten für Tabelle `link`
--

INSERT INTO `link` (`id`, `benutzer_email`, `hexaString`, `typ`) VALUES
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
  UNIQUE KEY `model` (`model`),
  KEY `stutzenmaterial_id` (`stutzenmaterial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `waermetauscher`
--

INSERT INTO `waermetauscher` (`id`, `model`, `betriebsdruck`, `temperatur`, `stutzenmaterial_id`, `hoehe`, `breite`) VALUES
(2, 'BHD21', 30, 195, 1, 191, 73),
(3, 'BHD30', 30, 195, 2, 315, 73),
(6, 'BHM21', 30, 195, 1, 203, 73);

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
-- Constraints der Tabelle `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`anrede_id`) REFERENCES `anrede` (`id`),
  ADD CONSTRAINT `adresse_ibfk_3` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`);

--
-- Constraints der Tabelle `angebot`
--
ALTER TABLE `angebot`
  ADD CONSTRAINT `angebot_ibfk_1` FOREIGN KEY (`artikelnummer_id`) REFERENCES `artikelnummer` (`id`),
  ADD CONSTRAINT `angebot_ibfk_2` FOREIGN KEY (`angebotskorb_id`) REFERENCES `angebotskorb` (`id`),
  ADD CONSTRAINT `angebot_ibfk_3` FOREIGN KEY (`angebotStatus_id`) REFERENCES `angebotStatus` (`id`);

--
-- Constraints der Tabelle `angebotskorb`
--
ALTER TABLE `angebotskorb`
  ADD CONSTRAINT `angebotskorb_ibfk_1` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`);

--
-- Constraints der Tabelle `artikelnummer`
--
ALTER TABLE `artikelnummer`
  ADD CONSTRAINT `artikelnummer_ibfk_1` FOREIGN KEY (`pufferspeicher_id`) REFERENCES `pufferspeicher` (`id`),
  ADD CONSTRAINT `artikelnummer_ibfk_2` FOREIGN KEY (`waermetauscher_id`) REFERENCES `waermetauscher` (`id`);

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
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`benutzer_email`) REFERENCES `benutzer` (`email`);

--
-- Constraints der Tabelle `pufferspeicher2pufferspeicherEinsatzgebiet`
--
ALTER TABLE `pufferspeicher2pufferspeicherEinsatzgebiet`
  ADD CONSTRAINT `pufferspeicher2pufferspeicherEinsatzgebiet_ibfk_1` FOREIGN KEY (`pufferspeicher_id`) REFERENCES `pufferspeicher` (`id`),
  ADD CONSTRAINT `pufferspeicher2pufferspeicherEinsatzgebiet_ibfk_2` FOREIGN KEY (`pufferspeicherEinsatzgebiet_id`) REFERENCES `pufferspeicherEinsatzgebiet` (`id`);

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
