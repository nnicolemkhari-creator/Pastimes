-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2026 at 10:25 AM
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

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`adminID`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `tblaorder`
--

CREATE TABLE `tblaorder` (
  `orderID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `clothesID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaorder`
--

INSERT INTO `tblaorder` (`orderID`, `userID`, `clothesID`) VALUES
(1, 1, 1);

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

--
-- Dumping data for table `tblclothes`
--

INSERT INTO `tblclothes` (`clothesID`, `itemName`, `price`, `itemCondition`, `image`) VALUES
(1, 'Blue Hoodie', 399.99, 'Good', 'hoodie.jpg'),
(2, 'Black T-Shirt', 199.99, 'New', 'blackshirt.jpg'),
(3, 'Jeans', 499.99, 'Good', 'jeans.jpg'),
(4, 'Winter Jacket', 699.99, 'New', 'jacket.jpg'),
(5, 'Sneakers', 899.99, 'Good', 'sneakers.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblorderitems`
--

CREATE TABLE `tblorderitems` (
  `orderItemID` int(11) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `clothesID` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorderitems`
--

INSERT INTO `tblorderitems` (`orderItemID`, `orderID`, `clothesID`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 399.99);

-- --------------------------------------------------------

--
-- Table structure for table `tblsellerrequest`
--

CREATE TABLE `tblsellerrequest` (
  `requestID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `itemName` varchar(100) DEFAULT NULL,
  `itemDescription` text DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsellerrequest`
--

INSERT INTO `tblsellerrequest` (`requestID`, `userID`, `itemName`, `itemDescription`, `brand`, `image`, `status`) VALUES
(1, 1, 'Red Dress', 'Second-hand red dress in good condition', 'Zara', 'reddress.jpg', 'Pending');

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
  `isVerified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userID`, `fullName`, `email`, `username`, `password`, `isVerified`) VALUES
(1, 'Nicole Mkhari', 'nicole@gmail.com', 'nicole', '123456', 1),
(2, 'Lerato Mokoena', 'lerato@gmail.com', 'lerato', '123456', 1);

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
  ADD KEY `FK_Order_User` (`userID`),
  ADD KEY `FK_Order_Clothes` (`clothesID`);

--
-- Indexes for table `tblclothes`
--
ALTER TABLE `tblclothes`
  ADD PRIMARY KEY (`clothesID`);

--
-- Indexes for table `tblorderitems`
--
ALTER TABLE `tblorderitems`
  ADD PRIMARY KEY (`orderItemID`),
  ADD KEY `FK_OrderItems_Order` (`orderID`),
  ADD KEY `FK_OrderItems_Clothes` (`clothesID`);

--
-- Indexes for table `tblsellerrequest`
--
ALTER TABLE `tblsellerrequest`
  ADD PRIMARY KEY (`requestID`),
  ADD KEY `FK_Seller_User` (`userID`);

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
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblaorder`
--
ALTER TABLE `tblaorder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblclothes`
--
ALTER TABLE `tblclothes`
  MODIFY `clothesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblorderitems`
--
ALTER TABLE `tblorderitems`
  MODIFY `orderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblsellerrequest`
--
ALTER TABLE `tblsellerrequest`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `FK_Order_Clothes` FOREIGN KEY (`clothesID`) REFERENCES `tblclothes` (`clothesID`),
  ADD CONSTRAINT `FK_Order_User` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`userID`),
  ADD CONSTRAINT `tblaorder_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`userID`),
  ADD CONSTRAINT `tblaorder_ibfk_2` FOREIGN KEY (`clothesID`) REFERENCES `tblclothes` (`clothesID`);

--
-- Constraints for table `tblorderitems`
--
ALTER TABLE `tblorderitems`
  ADD CONSTRAINT `FK_OrderItems_Clothes` FOREIGN KEY (`clothesID`) REFERENCES `tblclothes` (`clothesID`),
  ADD CONSTRAINT `FK_OrderItems_Order` FOREIGN KEY (`orderID`) REFERENCES `tblaorder` (`orderID`);

--
-- Constraints for table `tblsellerrequest`
--
ALTER TABLE `tblsellerrequest`
  ADD CONSTRAINT `FK_Seller_User` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`userID`);

--
-- Constraints for table `tbluserverification`
--
ALTER TABLE `tbluserverification`
  ADD CONSTRAINT `tbluserverification_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbluser` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
