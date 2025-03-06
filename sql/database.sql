-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Feb 2025 um 17:58
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `lernapp`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `bezahlt` tinyint(1) DEFAULT 0,
  `erstellt_von_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `username`, `password`, `role`, `bezahlt`, `erstellt_von_admin`) VALUES
(1, 'admin', 'AdminTest1234', 'admin', 1, 1),
(2, 'testuser', 'TestUser1234', 'user', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer_fortschritt`
--

CREATE TABLE `benutzer_fortschritt` (
  `id` int(11) NOT NULL,
  `benutzer_id` int(11) NOT NULL,
  `frage_id` int(11) NOT NULL,
  `status` enum('richtig','falsch','teilweise') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `benutzer_fortschritt`
--

INSERT INTO `benutzer_fortschritt` (`id`, `benutzer_id`, `frage_id`, `status`) VALUES
(1, 1, 1, 'richtig'),
(2, 1, 2, 'falsch'),
(3, 2, 3, 'teilweise');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fragen`
--

CREATE TABLE `fragen` (
  `id` int(11) NOT NULL,
  `frage` text NOT NULL,
  `antwort` varchar(255) NOT NULL,
  `kategorie` varchar(50) DEFAULT NULL,
  `schwierigkeitsgrad` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `fragen`
--

INSERT INTO `fragen` (`id`, `frage`, `antwort`, `kategorie`, `schwierigkeitsgrad`) VALUES
(1, 'Was bedeutet OOP?', 'Objektorientierte Programmierung', 'Programmierung', 1),
(2, 'Was ist ein Primary Key in MySQL?', 'Eindeutige ID für eine Tabelle', 'Datenbanken', 1),
(3, 'Welche HTTP-Methode sendet Daten?', 'POST', 'Webentwicklung', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indizes für die Tabelle `benutzer_fortschritt`
--
ALTER TABLE `benutzer_fortschritt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `benutzer_id` (`benutzer_id`),
  ADD KEY `frage_id` (`frage_id`);

--
-- Indizes für die Tabelle `fragen`
--
ALTER TABLE `fragen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `benutzer_fortschritt`
--
ALTER TABLE `benutzer_fortschritt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `fragen`
--
ALTER TABLE `fragen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `benutzer_fortschritt`
--
ALTER TABLE `benutzer_fortschritt`
  ADD CONSTRAINT `benutzer_fortschritt_ibfk_1` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `benutzer_fortschritt_ibfk_2` FOREIGN KEY (`frage_id`) REFERENCES `fragen` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
