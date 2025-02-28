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

-- Fragen
CREATE TABLE fragen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    frage TEXT NOT NULL,
    antwort VARCHAR(255) NOT NULL,
    kategorie VARCHAR(50),
    schwierigkeitsgrad INT DEFAULT 1,
    quelle VARCHAR(255)
);

-- Benutzerfortschritt
CREATE TABLE benutzer_fortschritt (
    id INT AUTO_INCREMENT PRIMARY KEY,
    benutzer_id INT NOT NULL,
    frage_id INT NOT NULL,
    status ENUM('richtig', 'falsch', 'teilweise') NOT NULL,
    FOREIGN KEY (benutzer_id) REFERENCES benutzer(id),
    FOREIGN KEY (frage_id) REFERENCES fragen(id)
);