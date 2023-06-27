-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 27. Jun 2023 um 12:06
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
  `ID` int(255) NOT NULL,
  `IMAGE` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `ROLE` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` (`VORNAME`, `NACHNAME`, `ADRESSE`, `PLZ`, `EMAIL`, `PASSWORT`, `USERNAME`, `AKTIV`, `ID`, `IMAGE`, `ROLE`) VALUES
('test6', 'test', 'Test5', 1210, 'dominik@test.at', '$2y$10$/h0YxWzjBBrYswvuBTsa6us.l4Ee8HfW1MxTyIw1FtYtZRTMeLNYe', 'test', 1, 1, 'test.jpg', 1),
('Dominik', 'Leitner', 'leitner5/6/6', 1220, 'dominik.test@test.at', '$2y$10$ZOpP74KNpkGRyliMxXfvsu.SHz3vOhP3Mf0.IZyOvE2tTuBxRuQF.', 'test2', 1, 2, 'default.jpg', 0),
('chrisi', 'simi', 'ulli', 1220, 'baumversteher@gmail.com', '$2y$10$9Z6.MY27k2ztM1AIxsq70OzVinhfKvILsKpknHf7W9CnB3UahACr.', 'krunschy', 1, 5, 'default.jpg', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel_bestellungen`
--

CREATE TABLE `artikel_bestellungen` (
  `bestellung_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `menge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `artikel_bestellungen`
--

INSERT INTO `artikel_bestellungen` (`bestellung_id`, `artikel_id`, `menge`) VALUES
(20, 20, 1),
(21, 21, 1),
(22, 21, 1),
(23, 20, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellungen`
--

CREATE TABLE `bestellungen` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `bestellungen`
--

INSERT INTO `bestellungen` (`ID`, `user_id`, `datum`) VALUES
(20, 1, '2023-06-14 15:06:22'),
(21, 1, '2023-06-14 15:07:05'),
(22, 1, '2023-06-14 15:08:32'),
(23, 1, '2023-06-15 12:50:45');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bewertungen`
--

CREATE TABLE `bewertungen` (
  `user_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `bewertung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `bewertungen`
--

INSERT INTO `bewertungen` (`user_id`, `artikel_id`, `bewertung`) VALUES
(2, 14, 3),
(2, 14, 5),
(5, 14, 5),
(5, 6, 5),
(5, 10, 4),
(5, 7, 5),
(5, 20, 4),
(5, 9, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kommentare`
--

CREATE TABLE `kommentare` (
  `user_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte`
--

CREATE TABLE `produkte` (
  `NAME` varchar(255) DEFAULT NULL,
  `IMAGE` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `ARTNR` int(255) DEFAULT NULL,
  `BRUTTO` double(6,2) DEFAULT NULL,
  `BESCHREIBUNG` varchar(255) DEFAULT NULL,
  `BESTAND` int(255) DEFAULT NULL,
  `ID` int(255) NOT NULL,
  `MARKE` varchar(255) DEFAULT NULL,
  `KATEGORIE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `produkte`
--

INSERT INTO `produkte` (`NAME`, `IMAGE`, `ARTNR`, `BRUTTO`, `BESCHREIBUNG`, `BESTAND`, `ID`, `MARKE`, `KATEGORIE`) VALUES
('AMD Ryzen 7 7800X3D, 8C/16T, 4.20-5.00GHz', 'AMD_Ryzen_7_7800X3D.jpg', 1, 540.00, 'Erleben Sie als einer der ersten einen AMD Ryzen 7 Prozessor - unglaublich leistungsstarke Multi - Core - Verarbeitung für ultimative Performance.', 13, 1, 'AMD', 'Prozessor'),
('AMD Ryzen 7 5800X3D, 8C/16T, 3.40-4.50GHz', 'AMD_Ryzen_7_5800X3D.jpg', 2, 336.00, 'Bis zu 15 % mehr Performance mit AMD Ryzen™ 7 5800X3D, dem einzigen Prozessor mit AMD 3D V-Cache™-Technologie.1', 12, 2, 'AMD', 'Prozessor'),
('Intel Core i7-13700K, 8C+8c/24T, 3.40-5.40GHz', 'Intel_Core_i7-13700K.jpg', 3, 456.00, 'Enhanced SpeedStep technology, Hyper-Threading-Technologie, Unterstützung für Execute Disable Bit, Intel Virtualization Technology, Intel 64 Technology, Streaming-SIMD-Erweiterungen 4.1 und viele weitere Features', 10, 3, 'Intel', 'Prozessor'),
('Intel Core i5-13600K, 6C+8c/20T, 3.50-5.10GHz', 'Intel_Core_i5-13600K.jpg', 4, 336.00, 'Enhanced SpeedStep technology, Hyper-Threading-Technologie, Unterstützung für Execute Disable Bit, Intel Virtualization Technology, Intel 64 Technology, Intel Trusted Execution Technology, Streaming-SIMD-Erweiterungen 4.1 und viele weitere Features', 8, 4, 'Intel', 'Prozessor'),
('AMD Ryzen 5 7600, 6C/12T, 3.80-5.10GHz', 'AMD_Ryzen_5_7600.jpg', 5, 72.00, 'Leistungsstarkes Gaming beginnt hier: Dieser übertaktbare Prozessor ist für intensives Gaming ausgelegt und wird mit einem flachen AMD Wraith Stealth Cooler geliefert.', 9, 5, 'AMD', 'Prozessor'),
('Samsung SSD 980 PRO 2TB, M.2', 'Samsung_SSD_980_PRO.jpg', 6, 156.00, 'Samsung MZ-V8P2T0BW. SSD Speicherkapazität: 2000 GB, SSD-Formfaktor: M.2, Lesegeschwindigkeit: 7000 MB/s, Schreibgeschwindigkeit: 5100 MB/s', 7, 6, 'Samsung', 'SSD'),
('Kingston NV2 NVMe PCIe 4.0 SSD 2TB, M.2', 'Kingston NV2 NVMe PCIe 4.0.jpg', 7, 90.00, 'Moderne SSD mit PCIe 4.0-Schnittstelle\r\n3.500 MB/s Lesegeschwindigkeit und 2.800 MB/s Schreibgeschwindigkeit', 10, 7, 'Kingston', 'SSD'),
('Samsung SSD 870 EVO 1TB, SATA', 'Samsung SSD 870 EVO 1TB, SATA.jpg', 8, 72.00, 'Solid State Drive (SSD) für eine verbesserte PC-Leistung im täglichen Einsatz, gut geeignet als Alternative zur HDD (Festplatte)', 9, 8, 'Samsung', 'SSD'),
('Kingston KC3000 PCIe 4.0 NVMe SSD 1TB, M.2', 'Kingston KC3000 PCIe 4.0.jpg', 9, 72.00, 'PCIe 4.0 NVMe High-Performance\nKompakter M.2-2280-Formfaktor\nLow Profile Graphen-Aluminium-Kühlkörper', 16, 9, 'Kingston', 'SSD'),
('Seagate Exos X - X20 20TB, 512e/4Kn, SATA 6Gb/s', 'Seagate Exos X - X20 20TB.jpg', 10, 324.00, 'Höchste 20-TB-Festplattenleistung mit verbessertem Caching, ideal für Cloud-Rechenzentren und große Scale-out-Anwendungen in Rechenzentren.', 9, 10, 'Seagate', 'HDD'),
('Seagate IronWolf NAS HDD +Rescue 4TB, SATA 6Gb/s', 'Seagate IronWolf NAS HDD.jpg', 11, 90.00, 'Seagate IronWolf ST4000VN006 - Festplatte - 4 TB - intern - SATA 6Gb/s - 5400 rpm - Puffer: 256 MB - mit 3 Jahre Seagate Rescue Datenwiederherstellung', 11, 11, 'Seagate', 'HDD'),
('Toshiba Cloud-Scale Capacity MG10ACA 20TB, 512e, SATA 6Gb/s', 'Toshiba Cloud-Scale Capacity MG10ACA.jpg', 12, 336.00, 'Toshiba MG10 Series MG10ACA20TE - Festplatte - Enterprise - 20 TB - intern - 3.5\" (8.9 cm) - SATA 6Gb/s - 7200 rpm - Puffer: 512 MB', 5, 12, 'Toshiba', 'HDD'),
('MSI GeForce RTX 4070 Ventus 3X 12G OC, 12GB GDDR6X, HDMI, 3x DP', 'MSI GeForce RTX 4070 Ventus.jpg', 13, 720.00, 'Grafikkarte, NVIDIA GeForce RTX 4070 Overclocked (Core clock 1920 MHz / Boost clock 2520 MHz), 5888 CUDA Kerne, 12 GB GDDR6X (Memory clock 21 GHz) - 192-bit und viele weitere Features', 2, 13, 'MSI', 'PCIe'),
('ASUS TUF Gaming GeForce RTX 4070 Ti, TUF-RTX4070TI-12G-GAMING', 'ASUS TUF Gaming GeForce RTX 4070 Ti.jpg', 14, 960.00, 'ASUS TUF Gaming GeForce RTX 4070 Ti 12GB - Grafikkarten - GeForce RTX 4070 Ti - 12 GB GDDR6X - PCIe 4.0 - 2 x HDMI, 3 x DisplayPort', 4, 14, 'ASUS', 'PCIe'),
('PowerColor AMD Radeon RX 7900 XT, 20GB GDDR6, HDMI, 2x DP, USB-C', 'PowerColor AMD Radeon RX 7900 XT.jpg', 15, 860.00, 'Grafikkarte - 20 GB GDDR6 (20000 MHz ), AMD Radeon, RDNA 3.0 (Navi 31, 1500 MHz), Boost 2400 MHz, PCI Express x16 4.0 , 320Bit, HDMI 2.1, USB-C und DisplayPort 2.1', 6, 15, 'Powercolor', 'PCIe'),
('Gainward GeForce RTX 4070 Ghost, 12GB GDDR6X, HDMI, 3x DP', 'Gainward GeForce RTX 4070 Ghost.jpg', 16, 650.00, 'Grafikkarte - 12 GB GDDR6X (21000 MHz ), NVIDIA GeForce, Ada Lovelace (AD104, 1920 MHz), Boost 2475 MHz, PCI Express x16 4.0 , 192Bit, DisplayPort 1.4a und HDMI 2.1a, DLSS 3.0', 5, 16, 'Gainward', 'PCIe'),
('Sapphire Pulse Radeon RX 6800, 16GB GDDR6, HDMI, 3x DP, lite retail', 'Sapphire Pulse Radeon RX 6800.jpg', 17, 540.00, 'High - End - Gaming - Grafikkarte, Radeon RX 6800 im Custom - Design, max. 2,170 MHz GPU - Boost - Takt, 16 GB GDDR 6 - Speicher mit 128 MB AMD Infinity Cache, 3x DisplayPort 1,4 a, 1x HDMI 2,1, Triple - Fan - Kühlerdesign', 4, 17, 'Sapphire', 'PCIe'),
('be quiet! Pure Power 12 M 850W ATX 3.0', 'Pure Power 12 M 850W.jpg', 18, 150.00, 'Pure Power 12 M 850W ist ATX 3.0 und PCIe 5.0 kompatibel und bietet unvergleichliche Zuverlässigkeit mit erstklassigen Features. Pure Power 12 M 850W bietet die bestmögliche Kombination von Features mit herausragender Kompatibilität.', 4, 18, 'be quiet!', 'Netzteil'),
('be quiet! Pure Power 12 M 750W ATX 3.0', 'Pure Power 12 M 750W.jpg', 19, 115.00, '750 Watt, Hervorragende Effizienz (bis zu 92,6%)\r\nPCIe 5.0, ATX 3.0\r\nSilence-optimized be quiet! Lüfter - 120mm\r\nStarke 12V Leitungen, benutzerfreundliche modulare Kabel\r\nunvergleichliche Zuverlässigkeit und erstklassige Features', 7, 19, 'be quiet!', 'Netzteil'),
('MSI MPG A850G PCIE5 850W ATX 3.0', 'MSI MPG A850G PCIE5 850W.jpg', 20, 138.00, 'MSI MPG A850G PCIE5 - Netzteil (intern) - ATX12V / EPS12V - 80 PLUS Gold - Wechselstrom 100-240 V - 850 Watt - aktive PFC', 10, 20, 'MSI', 'Netzteil'),
('Corsair RMx SHIFT Series RM1200x 1200W ATX 3.0', 'Corsair RMx SHIFT Series RM1200x 1200W.jpg', 21, 255.00, 'PC-Netzteil 1200W, ATX, 80 PLUS Gold, Effizienz 90%, 8 Stk. PCIe (8-pin / 6+2-pin), 16 × SATA, abnehmbare Kabel, thermische Geschwindigkeitsregelung, Netzschalter, Zero RPM mode und PCIe 5,0 12-pin, 140 mm Lüfter, Modularität: vollständig, Tiefe: 86 mm', -1, 21, 'Corsair', 'Netzteil'),
('ASUS ROG Strix B650E-F Gaming WIFI', 'ASUS ROG Strix B650E-F.jpg', 22, 300.00, 'Motherboard - ATX - Socket AM5 - AMD B650 Chipsatz - USB 3.2 Gen 1, USB 3.2 Gen 2, USB-C 3.2 Gen2, USB-C 3.2 Gen 2x2 - 2.5 Gigabit LAN, Wi-Fi 6, Bluetooth - Onboard-Grafik (CPU erforderlich)', 9, 22, 'ASUS', 'Mainboard'),
('ASUS TUF Gaming X670E-Plus', 'ASUS TUF Gaming X670E-Plus.jpg', 23, 300.00, 'Motherboard - ATX - Socket AM5 - AMD X670 Chipsatz - USB 3.2 Gen 1, USB 3.2 Gen 2, USB-C Gen 2x2, USB-C 3.2 Gen2 - 2.5 Gigabit LAN - Onboard-Grafik (CPU erforderlich)', 8, 23, 'ASUS', 'Mainboard'),
('GIGABYTE B550 Gaming X V2', 'GIGABYTE B550 Gaming X V2.jpg', 24, 114.00, 'Gigabyte B550 Gaming X V2 - AMD - Socket AM4 - AMD Ryzen 3 3rd Gen - 3rd Generation AMD Ryzen 5 - 3rd Generation AMD Ryzen 7 - 3rd Generation AMD - DDR4-SDRAM - 128 GB - DIMM\r\n', 7, 24, 'Gigabyte', 'Mainboard'),
('ASUS ROG Strix B650E-I Gaming WIFI', 'ASUS ROG Strix B650E-I.jpg', 25, 285.00, 'Motherboard - Mini-ITX - Socket AM5 - AMD B650 Chipsatz - USB 3.2 Gen 1, USB 3.2 Gen 2, USB-C 3.2 Gen2, USB-C 3.2 Gen 2x2 - 2.5 Gigabit LAN, Wi-Fi - Onboard-Grafik (CPU erforderlich)', 4, 25, 'ASUS', 'Mainboard'),
('be quiet! Dark Rock Pro 4', 'Dark Rock Pro 4.jpg', 26, 84.00, 'Prozessor-Luftkühler - (für: LGA1156, AM2, AM2+, LGA1366, AM3, LGA1155, AM3+, FM1, FM2, LGA1150, FM2+, LGA1151, LGA2011 (Square ILM)', 15, 26, 'be quiet!', 'CPU-Kühler'),
('Noctua NH-D15 chromax.black', 'Noctua NH-D15 chromax.black.jpg', 27, 110.00, 'Der NH-D15 chromax.black ist eine komplett in Schwarz gehaltene Version von Noctuas vielfach ausgezeichnetem Flaggschiff-Modell NH-D15. Hervorragende Laufruhe in Verbindung mit einer Kühlleistung, die durchaus mit Komplett-Wasserkühlungen konkurriert.', 11, 27, 'Noctua', 'CPU-Kühler'),
('be quiet! Pure Rock 2 FX', 'Pure Rock 2 FX.jpg', 28, 45.00, 'Mit einem Light Wings 120mm PWM high-speed Lüfter, 150W TDP Kühlleistung, vier 6mm Hochleistungs-Heatpipes und der Möglichkeit, den Kühler mühelos von oben zu verbauen.', 15, 28, 'be quiet!', 'CPU-Kühler');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `warenkorb`
--

CREATE TABLE `warenkorb` (
  `user_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `menge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `warenkorb`
--

INSERT INTO `warenkorb` (`user_id`, `artikel_id`, `menge`) VALUES
(1, 21, 1),
(1, 13, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `artikel_id`) VALUES
(1, 21),
(1, 13);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `artikel_bestellungen`
--
ALTER TABLE `artikel_bestellungen`
  ADD KEY `ab_bestellung_fk` (`bestellung_id`),
  ADD KEY `ab_artikel_fk` (`artikel_id`);

--
-- Indizes für die Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `bst_user_fk` (`user_id`);

--
-- Indizes für die Tabelle `bewertungen`
--
ALTER TABLE `bewertungen`
  ADD KEY `b_user_fk` (`user_id`),
  ADD KEY `b_artikel_fk` (`artikel_id`);

--
-- Indizes für die Tabelle `kommentare`
--
ALTER TABLE `kommentare`
  ADD KEY `kom_user_fk` (`user_id`),
  ADD KEY `kom_artikel_fk` (`artikel_id`);

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `warenkorb`
--
ALTER TABLE `warenkorb`
  ADD KEY `user_fk` (`user_id`),
  ADD KEY `artikel_fk` (`artikel_id`);

--
-- Indizes für die Tabelle `wishlist`
--
ALTER TABLE `wishlist`
  ADD KEY `wl_artikel_fk` (`artikel_id`),
  ADD KEY `wl_user_fk` (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `artikel_bestellungen`
--
ALTER TABLE `artikel_bestellungen`
  ADD CONSTRAINT `ab_artikel_fk` FOREIGN KEY (`artikel_id`) REFERENCES `produkte` (`ID`),
  ADD CONSTRAINT `ab_bestellung_fk` FOREIGN KEY (`bestellung_id`) REFERENCES `bestellungen` (`ID`);

--
-- Constraints der Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD CONSTRAINT `bst_user_fk` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`ID`);

--
-- Constraints der Tabelle `bewertungen`
--
ALTER TABLE `bewertungen`
  ADD CONSTRAINT `b_artikel_fk` FOREIGN KEY (`artikel_id`) REFERENCES `produkte` (`ID`),
  ADD CONSTRAINT `b_user_fk` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`ID`);

--
-- Constraints der Tabelle `kommentare`
--
ALTER TABLE `kommentare`
  ADD CONSTRAINT `kom_artikel_fk` FOREIGN KEY (`artikel_id`) REFERENCES `produkte` (`ID`),
  ADD CONSTRAINT `kom_user_fk` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`ID`);

--
-- Constraints der Tabelle `warenkorb`
--
ALTER TABLE `warenkorb`
  ADD CONSTRAINT `artikel_fk` FOREIGN KEY (`artikel_id`) REFERENCES `produkte` (`ID`),
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`ID`);

--
-- Constraints der Tabelle `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wl_artikel_fk` FOREIGN KEY (`artikel_id`) REFERENCES `produkte` (`ID`),
  ADD CONSTRAINT `wl_user_fk` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
