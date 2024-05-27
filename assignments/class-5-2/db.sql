CREATE DATABASE IF NOT EXISTS `mojaBaza`;
USE `mojaBaza`;
CREATE TABLE IF NOT EXISTS `samochody` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `marka` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `rok_produkcji` int(4) NOT NULL,
  `opis` varchar(255) NOT NULL
);

TRUNCATE TABLE `samochody`;

INSERT INTO `samochody` (`marka`, `model`, `cena`, `rok_produkcji`, `opis`) VALUES
('Audi', 'A4', '50000.00', '2010', 'Audica jak nowa, bezwypadkowy z pełną historią przebiegu. Cena do negocjacji, przebieg do negocjacji.'),
('BMW', 'X5', '100000.00', '2015', 'Beta jak nowa, bezwypadkowy z pełną historią przebiegu. Cena do negocjacji, przebieg do negocjacji.'),
('Mercedes', 'E220', '80000.00', '2012', 'Merc jak nowy, bezwypadkowy z pełną historią przebiegu. Cena do negocjacji, przebieg do negocjacji.'),
('Volkswagen', 'Passat', '40000.00', '2010', 'Pasacik jak nowy, bezwypadkowy z pełną historią przebiegu. Cena do negocjacji, przebieg do negocjacji.'),
('Toyota', 'Supra', '95000.00', '2008', 'Supra jak nowa, bezwypadkowy z pełną historią przebiegu. Cena do negocjacji, przebieg do negocjacji.');