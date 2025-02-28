CREATE DATABASE lernapp;
USE lernapp;

-- Benutzer
CREATE TABLE benutzer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    bezahlt BOOLEAN DEFAULT 0,
    erstellt_von_admin BOOLEAN DEFAULT 0
);

-- Testnutzer & Admin anlegen
INSERT INTO benutzer (username, password, role, bezahlt, erstellt_von_admin) VALUES
('admin', '$2y$10$zKE8a/ZLsP8mTQ0xBYZP/u', 'admin', 1, 1),  -- Passwort: admin123
('testuser', '$2y$10$zKE8a/ZLsP8mTQ0xBYZP/u', 'user', 1, 0);  -- Passwort: test123

-- Fragen
CREATE TABLE fragen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    frage TEXT NOT NULL,
    antwort VARCHAR(255) NOT NULL,
    kategorie VARCHAR(50),
    schwierigkeitsgrad INT DEFAULT 1
);

-- Beispiel-Fragen
INSERT INTO fragen (frage, antwort, kategorie) VALUES
('Was bedeutet OOP?', 'Objektorientierte Programmierung', 'Programmierung'),
('Was ist ein Primary Key in MySQL?', 'Eindeutige ID für eine Tabelle', 'Datenbanken'),
('Welche HTTP-Methode sendet Daten?', 'POST', 'Webentwicklung');

-- Benutzer-Fortschritt
CREATE TABLE benutzer_fortschritt (
    id INT AUTO_INCREMENT PRIMARY KEY,
    benutzer_id INT NOT NULL,
    frage_id INT NOT NULL,
    status ENUM('richtig', 'falsch', 'teilweise') NOT NULL,
    FOREIGN KEY (benutzer_id) REFERENCES benutzer(id) ON DELETE CASCADE,
    FOREIGN KEY (frage_id) REFERENCES fragen(id) ON DELETE CASCADE
);
