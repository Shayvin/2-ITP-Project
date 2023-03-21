-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 21. Mrz 2023 um 13:08
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webshop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accounts`
--

CREATE TABLE `accounts` (
  `VORNAME` varchar(50) DEFAULT NULL,
  `NACHNAME` varchar(50) DEFAULT NULL,
  `ADRESSE` varchar(100) DEFAULT NULL,
  `PLZ` int(10) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PASSWORT` varchar(255) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `AKTIV` int(1) NOT NULL DEFAULT 1,
  `ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` (`VORNAME`, `NACHNAME`, `ADRESSE`, `PLZ`, `EMAIL`, `PASSWORT`, `USERNAME`, `AKTIV`, `ID`) VALUES
('test', 'test', 'test 54', 1210, 'dominik@test.at', '$2y$10$/h0YxWzjBBrYswvuBTsa6us.l4Ee8HfW1MxTyIw1FtYtZRTMeLNYe', 'test', 1, 1),
('Dominik', 'Leitner', 'leitner5/6/6', 1220, 'dominik.test@test.at', '$2y$10$ZOpP74KNpkGRyliMxXfvsu.SHz3vOhP3Mf0.IZyOvE2tTuBxRuQF.', 'test2', 1, 2);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;