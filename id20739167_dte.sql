-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2024 at 05:14 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20739167_dte`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `accountID` int(11) NOT NULL,
  `personID` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `level` varchar(50) DEFAULT 'Customer',
  `User name` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`accountID`, `personID`, `password`, `status`, `level`, `User name`) VALUES
(12315, 15, '$2y$10$cbHaFZTJq1cHP/bK4A4M0ORALkdfmWXR1WvS0Yp.hEcBoviqy/Gzm', 'Active', 'Customer', 'Bra'),
(12314, 14, '$2y$10$F8CbqaZo.9t6ZW1Ds.ks/eeJkCEgNt1zvxDRb6EV2R7ByMva7H7m2', 'Active', 'Customer', 'Lama'),
(12312, 12, '$2a$12$IN.TWn5keQ.DjNPCjNEZteV.WBkzv3DHlrAKhYKjUnONqrDaTjnJO', 'Active', 'Admin', 'TamerAD'),
(12317, 17, '$2y$10$KzXiESh2ftXDWA4OZmRBnupECFl63EhIYsmCyMpNM99u0ma7UcfD6', 'Active', 'Customer', 'Ibrahim');

-- --------------------------------------------------------

--
-- Table structure for table `Aircraft`
--

CREATE TABLE `Aircraft` (
  `aircraftID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `manufacturingYear` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `Aircraft`
--

INSERT INTO `Aircraft` (`aircraftID`, `name`, `model`, `manufacturingYear`) VALUES
(2, 'Airbus A380', 'A380-800', 2005),
(1, 'Boeing 747', '747-400', 1991),
(3, 'Boeing 777', '777-300ER', 2003),
(4, 'Airbus A350', 'A350-900', 2014),
(5, 'Boeing 737', '737-800', 1998);

-- --------------------------------------------------------

--
-- Table structure for table `Airport`
--

CREATE TABLE `Airport` (
  `airportID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `Airport`
--

INSERT INTO `Airport` (`airportID`, `name`, `address`) VALUES
(1001, 'John F. Kennedy International Airport', 'Queens, NY 11430, United States'),
(1023, 'Los Angeles International Airport', '1 World Way, Los Angeles, CA 90045, United States'),
(1045, 'O\'Hare International Airport', '10000 W O\'Hare Ave, Chicago, IL 60666, United States'),
(1076, 'London Heathrow Airport', 'Longford TW6, United Kingdom'),
(1098, 'Tokyo Haneda Airport', 'Hanedakuko, Ota City, Tokyo 144-0041, Japan'),
(1120, 'Dubai International Airport', 'Al Garhoud, Dubai, United Arab Emirates'),
(1142, 'Beijing Capital International Airport', 'Shunyi, Beijing, China'),
(1164, 'Sydney Airport', 'Mascot NSW 2020, Australia'),
(1186, 'Paris Charles de Gaulle Airport', '95700 Roissy-en-France, France'),
(1208, 'Frankfurt Airport', '60547 Frankfurt, Germany'),
(1230, 'Singapore Changi Airport', 'Airport Blvd, Singapore'),
(1252, 'Toronto Pearson International Airport', '6301 Silver Dart Dr, Mississauga, ON L5P 1B2, Canada'),
(1274, 'S?o Paulo?Guarulhos International Airport', 'Rod. H?lio Smidt, s/n? - Cumbica, Guarulhos - SP, 07190-100, Brazil'),
(1296, 'Cape Town International Airport', 'Matroosfontein, Cape Town, 7490, South Africa'),
(1318, 'Moscow Sheremetyevo International Airport', 'Khimki, Moscow Oblast, Russia'),
(1340, 'Mumbai Chhatrapati Shivaji Maharaj International Airport', 'Mumbai, Maharashtra 400099, India'),
(1362, 'Istanbul Airport', 'Tayakad?n, Terminal Cd No:1, 34283 Arnavutk?y/?stanbul, Turkey'),
(1384, 'Mexico City International Airport', 'Av. Capit?n Carlos Le?n S/N, Pe??n de los Ba?os, Venustiano Carranza, 15620 Ciudad de M?xico, CDMX, Mexico'),
(1406, 'Bangkok Suvarnabhumi Airport', '999 Soi Mu Ban Nakhon Thong 1, Nong Prue, Bang Phli District, Samut Prakan 10540, Thailand'),
(1428, 'Kuala Lumpur International Airport', '64000 Sepang, Selangor, Malaysia');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `CustomerID` int(11) NOT NULL,
  `accountID` int(11) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `PostalCode` varchar(20) DEFAULT NULL,
  `SpecialNeeds` tinyint(1) DEFAULT NULL,
  `Points` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`CustomerID`, `accountID`, `FirstName`, `LastName`, `DOB`, `Age`, `Email`, `Password`, `Address`, `PhoneNumber`, `City`, `Country`, `PostalCode`, `SpecialNeeds`, `Points`) VALUES
(10, 12317, 'Brahim', 'Cotob', '2003-12-20', 19, 'brahim.cotob@lau.edu', '$2y$10$KzXiESh2ftXDWA4OZmRBnupECFl63EhIYsmCyMpNM99u0ma7UcfD6', 'asas', '0497735075', 'Gent', 'Belgium', '9000', 1, 0),
(9, 12316, 'Brahim', 'Cotob', '2003-12-04', 19, 'brahim.cotob@lau.edu', '$2y$10$Z7MeqbY9fK0GA5ZaTjv3m.bwxIaLY2HJZJ04zKN5wkoJHYC6o1dnK', 'asas', '0497735075', 'Gent', 'Belgium', '9000', 0, 0),
(7, 12314, 'lama', 'al sheikh', '2003-04-01', 20, 'Lama.alsheikh', '$2y$10$F8CbqaZo.9t6ZW1Ds.ks/eeJkCEgNt1zvxDRb6EV2R7ByMva7H7m2', 'horsh', '076571403', 'Beirut', 'Lebanon', '88869', 1, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `Flight`
--

CREATE TABLE `Flight` (
  `flightID` int(11) NOT NULL,
  `departureAirportID` int(11) DEFAULT NULL,
  `arrivalAirportID` int(11) DEFAULT NULL,
  `departureTime` datetime DEFAULT NULL,
  `returnTime` datetime DEFAULT NULL,
  `gate` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `aircraftID` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `Flight`
--

INSERT INTO `Flight` (`flightID`, `departureAirportID`, `arrivalAirportID`, `departureTime`, `returnTime`, `gate`, `status`, `aircraftID`, `price`) VALUES
(34567, 1045, 1076, '2023-05-17 00:00:00', '2023-05-18 02:00:00', 'C', 'Active', 3, 600),
(125361, 1001, 1076, '2023-05-18 00:00:00', '2023-05-19 00:00:00', 'J', 'Active', 88956, 100),
(13579, 1023, 1045, '2023-05-13 00:00:00', '2023-05-14 00:00:00', 'F', 'Active', 1, 900),
(55468, 1045, 1076, '2023-05-16 20:00:00', '2023-05-17 22:00:00', 'O', 'Active', 5, 1800),
(64579, 1076, 1001, '2023-05-17 08:00:00', '2023-05-17 12:00:00', 'P', 'Active', 1, 1900),
(73680, 1076, 1001, '2023-05-17 14:00:00', '2023-05-17 16:26:18', 'Q', 'Active', 2, 2000),
(82791, 1076, 1001, '2023-05-17 20:00:00', '2023-05-17 22:00:00', 'R', 'Active', 3, 2100),
(91802, 1076, 1001, '2023-05-17 08:30:00', '2023-05-17 12:34:08', 'S', 'Active', 4, 2200),
(10913, 1076, 1001, '2023-05-18 14:00:00', '2023-05-18 18:00:00', 'T', 'Active', 5, 2300);

-- --------------------------------------------------------

--
-- Table structure for table `Flightreservation`
--

CREATE TABLE `Flightreservation` (
  `reservationNumber` int(11) NOT NULL,
  `meals` varchar(255) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `flightID` int(11) DEFAULT NULL,
  `payment Amount` int(11) DEFAULT NULL,
  `reservation` datetime DEFAULT NULL,
  `SeatID` varchar(25) NOT NULL,
  `Accomodation` varchar(25) DEFAULT 'None'
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `Flightreservation`
--

INSERT INTO `Flightreservation` (`reservationNumber`, `meals`, `CustomerID`, `flightID`, `payment Amount`, `reservation`, `SeatID`, `Accomodation`) VALUES
(15, 'vegetarian', 10, 82791, 2100, '2023-05-17 20:00:00', '231', 'Pregnant Seat');

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `personID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`personID`, `name`, `address`, `email`, `phone`) VALUES
(14, 'lama al sheikh', 'horsh', 'Lama.alsheikh', '076571403'),
(16, 'Brahim Cotob', 'asas', 'brahim.cotob@lau.edu', '0497735075'),
(12, 'Tamer Kobba', 'Borj el barajneh, Beirut', 'Tamer_kobba@hotmail.com', '76571403'),
(17, 'Brahim Cotob', 'asas', 'brahim.cotob@lau.edu', '0497735075');

-- --------------------------------------------------------

--
-- Table structure for table `Seat`
--

CREATE TABLE `Seat` (
  `seatID` int(11) NOT NULL,
  `flightID` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'None',
  `seatClass` varchar(50) DEFAULT NULL,
  `occupied` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `Seat`
--

INSERT INTO `Seat` (`seatID`, `flightID`, `type`, `seatClass`, `occupied`) VALUES
(123, 34567, 'None', 'Economy', 0),
(456, 34567, 'Wheel Chair Seat', 'Business', 0),
(789, 34567, 'Pregnant Seat', 'First Class', 0),
(321, 10913, 'None', 'Premium Economy', 0),
(654, 73680, 'None', 'Business', 0),
(987, 10913, 'None', 'Economy', 0),
(231, 82791, 'Pregnant Seat', 'Business', 1),
(564, 82791, 'Wheel Chair Seat', 'First Class', 0),
(897, 23456, 'None', 'Premium Economy', 0),
(132, 23456, 'None', 'Business', 0),
(465, 73680, 'None', 'Economy', 0),
(798, 34567, 'Wheel Chair Seat', 'Business', 0),
(213, 13579, 'Pregnant Seat', 'First Class', 0),
(546, 64579, 'None', 'Premium Economy', 0),
(879, 55468, 'None', 'Business', 0),
(312, 55468, 'None', 'Economy', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`accountID`),
  ADD KEY `personID` (`personID`);

--
-- Indexes for table `Aircraft`
--
ALTER TABLE `Aircraft`
  ADD PRIMARY KEY (`aircraftID`);

--
-- Indexes for table `Airport`
--
ALTER TABLE `Airport`
  ADD PRIMARY KEY (`airportID`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `Flight`
--
ALTER TABLE `Flight`
  ADD PRIMARY KEY (`flightID`),
  ADD KEY `departureAirportID` (`departureAirportID`),
  ADD KEY `arrivalAirportID` (`arrivalAirportID`),
  ADD KEY `aircraftID` (`aircraftID`);

--
-- Indexes for table `Flightreservation`
--
ALTER TABLE `Flightreservation`
  ADD PRIMARY KEY (`reservationNumber`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `flightID` (`flightID`),
  ADD KEY `paymentID` (`payment Amount`),
  ADD KEY `fk_SeatID` (`SeatID`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`personID`);

--
-- Indexes for table `Seat`
--
ALTER TABLE `Seat`
  ADD PRIMARY KEY (`seatID`),
  ADD KEY `flightID` (`flightID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Account`
--
ALTER TABLE `Account`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12318;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Flight`
--
ALTER TABLE `Flight`
  MODIFY `flightID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125362;

--
-- AUTO_INCREMENT for table `Flightreservation`
--
ALTER TABLE `Flightreservation`
  MODIFY `reservationNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Person`
--
ALTER TABLE `Person`
  MODIFY `personID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
