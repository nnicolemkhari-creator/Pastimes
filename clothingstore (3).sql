-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2026 at 04:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothingstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `adminID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblaorder`
--

CREATE TABLE `tblaorder` (
  `orderID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `clothesID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblclothes`
--

CREATE TABLE `tblclothes` (
  `clothesID` int(11) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `itemCondition` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblmessages`
--

CREATE TABLE `tblmessages` (
  `messageID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `messageText` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `productID` int(11) NOT NULL,
  `sellerID` int(11) NOT NULL,
  `productName` varchar(150) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `productDescription` text NOT NULL,
  `productCondition` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`productID`, `sellerID`, `productName`, `brand`, `category`, `productDescription`, `productCondition`, `price`, `image`, `status`, `dateAdded`) VALUES
(1, 18, 'Viscosi', 'Gucci', 'Hoodies', 'It\'s still in okay condition', 'Fair', 560.00, '1781781784_hoodie1.jpg', 'Approved', '2026-06-18 11:23:04'),
(2, 18, 'H&M Jacket', 'H&M', 'Tops', 'Testing if it works', 'Brand New', 670.00, '1781783304_model.jpg', 'Approved', '2026-06-18 11:48:24'),
(3, 16, 'Item number 5', 'Gucci', 'Accessories', 'Still in great condition', 'Brand New', 50000.00, '1781791023_jacket.jpg', 'Approved', '2026-06-18 13:57:03'),
(4, 20, 'New', 'New balance', 'Jeans', 'testing if it works', 'Good', 500.00, '1781792435_jeans1.jpg', 'Approved', '2026-06-18 14:20:35'),
(5, 20, 'few', 'fre', 'Tops', '', 'Brand New', 450.00, '1781792508_bag.jpg', 'Approved', '2026-06-18 14:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userID` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isVerified` tinyint(1) DEFAULT 0,
  `role` varchar(20) DEFAULT 'user',
  `accountStatus` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userID`, `fullName`, `email`, `username`, `password`, `isVerified`, `role`, `accountStatus`) VALUES
(12, 'Tom Stone', 'TGiggle@gmail.com', 'TGigg', '$2y$10$zJnO9Hx.jSsQDxSt.Xkyhe73heYbko.pFEijZtJjD9.C5cEBubN1S', 1, 'user', 'Pending'),
(13, 'Scott Manson', 'SManson@gmail.com', 'ScottM', '$2y$10$pvfRwjH0zRzq9KhPzITt4u3GDMgOmR6Nr/aZg7a2Vfa6A0YMLkeRq', 1, 'admin', 'Approved'),
(15, 'John', 'John03@gmail.com', 'Marson', '$2y$10$Oy65xosOQLtuSzRkJhVasuYaAra0Ze88lEtFH5fNRx1C6SOexDcMW', 0, 'user', 'Pending'),
(16, 'Tim Gordon', 'TimG@gmail.com', 'Tim', '$2y$10$zxkbTO3nz47ibiK8Zs8D2eZmD72rb.oIV8MABf2BPyWHkOLUh0Sem', 0, 'user', 'Approved'),
(18, 'Marcus Conner', 'MarkC@gmail.com', '', '$2y$10$IA4SsSlfwpSAtl5AMZYH5e4ZVEThba65agR66hmM/51YrtDLP1gMu', 1, 'user', 'Approved'),
(19, 'New', 'NewUser@gmail.com', 'Username', '$2y$10$/3YHJNFT4sfAkZX5Lsx4o.kmDlRSwVb7n/NodksVmeq8lIzOMsHiy', 0, 'user', 'Approved'),
(20, 'Test', 'Test@gmail.com', 'Testing', '$2y$10$HakcxojzL24e3yqNGJ5rVO0jg/Mdu.tFC3wmYhwSLjLgDQissFpUu', 0, 'user', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tbluserverification`
--

CREATE TABLE `tbluserverification` (
  `verificationID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `status` enum('pending','verified') DEFAULT 'pending',
  `verificationDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tblaorder`
--
ALTER TABLE `tblaorder`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `clothesID` (`clothesID`);

--
-- Indexes for table `tblclothes`
--
ALTER TABLE `tblclothes`
  ADD PRIMARY KEY (`clothesID`);

--
-- Indexes for table `tblmessages`
--
ALTER TABLE `tblmessages`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `senderID` (`senderID`),
  ADD KEY `receiverID` (`receiverID`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `sellerID` (`sellerID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbluserverification`
--
ALTER TABLE `tbluserverification`
  ADD PRIMARY KEY (`verificationID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblaorder`
--
ALTER TABLE `tblaorder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblclothes`
--
ALTER TABLE `tblclothes`
  MODIFY `clothesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblmessages`
--
ALTER TABLE `tblmessages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbluserverification`
--
ALTER TABLE `tbluserverification`
  MODIFY `verificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblaorder`
--
ALTER TABLE `tblaorder`
  ADD CONSTRAINT `tblaorder_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`userID`),
  ADD CONSTRAINT `tblaorder_ibfk_2` FOREIGN KEY (`clothesID`) REFERENCES `tblclothes` (`clothesID`);

--
-- Constraints for table `tblmessages`
--
ALTER TABLE `tblmessages`
  ADD CONSTRAINT `tblmessages_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `tblproducts` (`productID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tblmessages_ibfk_2` FOREIGN KEY (`senderID`) REFERENCES `tbluser` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tblmessages_ibfk_3` FOREIGN KEY (`receiverID`) REFERENCES `tbluser` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD CONSTRAINT `tblproducts_ibfk_1` FOREIGN KEY (`sellerID`) REFERENCES `tbluser` (`userID`);

--
-- Constraints for table `tbluserverification`
--
ALTER TABLE `tbluserverification`
  ADD CONSTRAINT `tbluserverification_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
