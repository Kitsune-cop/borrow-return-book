-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2022 at 11:08 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookID` varchar(5) NOT NULL,
  `bookIMG` varchar(255) NOT NULL,
  `bookName` varchar(255) NOT NULL,
  `bookTypeID` varchar(255) NOT NULL,
  `bookDescript` varchar(500) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `bstatusID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookID`, `bookIMG`, `bookName`, `bookTypeID`, `bookDescript`, `author`, `publisher`, `bstatusID`) VALUES
('m0001', 'book1.jpg', 'Blue Box (Ao no Hako)', 'MG001', 'แม่มดคนนั้นเป็นนักเดินทาง เธอออกเดินทางไกลไปเรื่อยตามใจปรารถนา ราวกับสายลมพัดพาโดยไร้จุดหมาย พร้อมกับพบพานผู้คนและอาณาจักรต่างๆ มากมาย', 'Jougi Shiraishi (โจกิ ชิราอิชิ)', 'อนิแม็ก, สนพ.', 'b0000'),
('m0003', 'book3.jpg', 'Dandadan ', 'MG001', 'อายาเซะ โมโมะ เด็กสาวผู้เชื่อในผีสาง และชอบชายหนุ่มล่ำบึก ต้องมาพบกับเด็กหนุ่มเนิร์ดผู้เชื่อในสิ่งเล้นลับนอกโลก ufo และ เอเลียน ด้วยความเชื่อและความหลงไหลที่แตกต่างกันทำให้ทั้งสองท้าพิสูจน์ทั้งสองฝั่งว่า สิ่งลี้ลับไหนจะเป็นความจริง และเมื่อทั้งคู่แยกกันไปพิสูจน์สิ่งลี้ลับของอีกฝ่ายทำให้ทั้งคู่ได้พบเจอกับสิ่งแปลกประหลาดเกิดขึ้น เรื่องราวของทั้งคู่จะเป็นเช่นไร สิ่งลี้ลับไหนจะเป็นความจริง ติดตามได้ในเรื่อง Dandadan', 'Yukinobu Tatsu', ' สยามอินเตอร์คอมิกส์, สนพ.', 'b0000');

-- --------------------------------------------------------

--
-- Table structure for table `booktype`
--

CREATE TABLE `booktype` (
  `bookTypeID` varchar(255) NOT NULL,
  `bookTypeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booktype`
--

INSERT INTO `booktype` (`bookTypeID`, `bookTypeName`) VALUES
('', ''),
('FR001', 'Fairy Tail'),
('MG001', 'Manga'),
('SC001', 'Science'),
('SL001', 'Social Life');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borrowID` int(5) NOT NULL,
  `bookID` varchar(5) NOT NULL,
  `memberID` int(5) NOT NULL,
  `dateBorrow` date NOT NULL,
  `dateRet` date NOT NULL,
  `retDate` date NOT NULL,
  `statusID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrowID`, `bookID`, `memberID`, `dateBorrow`, `dateRet`, `retDate`, `statusID`) VALUES
(21, 'm0001', 14, '2022-10-19', '2022-11-18', '2022-10-19', 'b0002'),
(22, 'm0001', 14, '2022-10-20', '2022-11-19', '2022-10-20', 'b0002'),
(29, 'm0003', 14, '2022-10-20', '2022-11-19', '0000-00-00', 'b0002'),
(30, 'm0003', 14, '2022-10-20', '2022-11-19', '2022-10-20', 'b0002'),
(31, 'm0001', 15, '2022-10-20', '2022-11-19', '2022-10-20', 'b0002'),
(32, 'm0003', 15, '2022-10-20', '2022-11-19', '2022-10-20', 'b0002'),
(33, 'm0001', 15, '2022-10-20', '2022-11-19', '2022-10-20', 'b0002'),
(34, 'm0001', 14, '2022-10-20', '2022-11-19', '2022-10-20', 'b0002');

-- --------------------------------------------------------

--
-- Table structure for table `borrowstatus`
--

CREATE TABLE `borrowstatus` (
  `bstatusID` varchar(5) NOT NULL,
  `bName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowstatus`
--

INSERT INTO `borrowstatus` (`bstatusID`, `bName`) VALUES
('b0000', 'ว่าง'),
('b0001', 'ถูกยืม'),
('b0002', 'คืนแล้ว'),
('b0003', 'กำลังยืม');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberID` int(5) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `BirthDate` date NOT NULL,
  `Tel` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `statusmem` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `Firstname`, `Lastname`, `Gender`, `BirthDate`, `Tel`, `Username`, `Password`, `Email`, `statusmem`) VALUES
(10, 'admin', 'admin', '', '0000-00-00', '(+66)', 'admin', 'admin1234', 'admin@example.com', 'ADMIN'),
(14, 'Nuna', 'nungning', '', '1999-12-07', '0652316455', 'nuna', 'nu1234', 'nuna@gmail.com', 'MEMBER'),
(15, 'mang', 'yak', 'Male', '2022-10-20', '0946340735', 'mak', '1234', 'makyak@email.com', 'MEMBER'),
(16, 'สมศรี', 'มียาดม', 'Female', '2022-09-26', '0123456789', 'som', '123456', 'somsri@mail.com', 'MEMBER'),
(17, 'Worapat', 'Mangmee', 'Male', '2002-06-04', '0526548796', 'wora', 'woo12345', 'worapat@email.com', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `booktype`
--
ALTER TABLE `booktype`
  ADD PRIMARY KEY (`bookTypeID`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrowID`,`bookID`,`memberID`);

--
-- Indexes for table `borrowstatus`
--
ALTER TABLE `borrowstatus`
  ADD PRIMARY KEY (`bstatusID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrowID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
