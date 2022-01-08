-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2021 at 04:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(111) NOT NULL,
  `username` varchar(111) NOT NULL,
  `fullname` varchar(111) NOT NULL,
  `adminemail` varchar(111) NOT NULL,
  `password` varchar(111) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `username`, `fullname`, `adminemail`, `password`, `pic`) VALUES
(1, 'admin', 'Tahmid', 'tahmid@gmail.com', 'admin', 'user2.png');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `authorid` int(111) NOT NULL,
  `authorname` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`authorid`, `authorname`) VALUES
(9, 'Bjarne Stroustrup'),
(11, 'Anthony Brun'),
(14, 'E. Balagurusamy'),
(15, 'Ken Liu'),
(16, 'A.G Riddle'),
(17, 'Rakib Hassan'),
(18, 'Rob Boffard'),
(19, 'Khaled Hosseini'),
(20, 'Sandra Block'),
(21, 'J.R.R. Tolkien'),
(22, 'William Goldman'),
(24, 'Md. Zafar Iqbal Hassan'),
(29, 'James Patterson');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookid` int(100) NOT NULL,
  `bookpic` varchar(500) NOT NULL,
  `bookname` varchar(100) NOT NULL,
  `authorid` int(100) NOT NULL,
  `categoryid` int(100) NOT NULL,
  `ISBN` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookid`, `bookpic`, `bookname`, `authorid`, `categoryid`, `ISBN`, `price`, `quantity`, `status`) VALUES
(20, 'cplus.jpg', 'C++', 11, 2, '27899', 200, 9, 'Available'),
(22, 'python2.jpg', 'Python Programming', 11, 2, '2456', 600, 5, 'Available'),
(28, 'c.jpg', 'C Programming in ANSI', 14, 2, '24512', 200, 8, 'Available'),
(29, 'sf1.jpg', 'Borken Stars', 15, 1, '2487', 300, 7, 'Available'),
(30, 'sf2.jpg', 'The Solar War', 16, 1, '27899', 200, 6, 'Available'),
(31, 'sf3.jpg', 'Star Wars', 17, 1, '254789', 600, 9, 'Available'),
(32, 'sf4.jpg', 'Adrift', 18, 1, '24569', 500, 8, 'Available'),
(33, 'nv1.jpg', 'The Kite Runner', 19, 3, '23658', 600, 8, 'Available'),
(34, 'nv2.jpg', 'The Girl Without a Name', 20, 3, '21569', 300, 7, 'Available'),
(35, 'nv3.jpg', 'The Hobbit', 21, 3, '21569', 600, 9, 'Available'),
(36, 'nv4.jpg', 'The Princess Bride', 22, 3, '21456', 500, 5, 'Available'),
(40, 'java.jpg', 'Java', 29, 2, '24512', 500, 8, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(111) NOT NULL,
  `categoryname` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categoryname`) VALUES
(1, 'Science FIction'),
(2, 'Computer Programming'),
(3, 'Novel'),
(4, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `stdid` int(100) NOT NULL,
  `rating` int(100) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`stdid`, `rating`, `comment`, `date`) VALUES
(1, 5, 'I just love it', '2021-04-23'),
(3, 4, 'I just like it', '2021-04-23'),
(4, 3, 'It is awesome. Overall good', '2021-04-23'),
(1, 2, 'I dont like it', '2021-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `issueinfo`
--

CREATE TABLE `issueinfo` (
  `studentid` int(100) NOT NULL,
  `bookid` int(100) NOT NULL,
  `issuedate` date NOT NULL,
  `returndate` date NOT NULL,
  `approve` varchar(200) NOT NULL,
  `fine` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issueinfo`
--

INSERT INTO `issueinfo` (`studentid`, `bookid`, `issuedate`, `returndate`, `approve`, `fine`) VALUES
(3, 20, '0000-00-00', '0000-00-00', '', 0),
(1, 22, '2021-04-19', '2021-04-21', '<p style=\"color:yellow; background-color:red;\">EXPIRED</p>', 20);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `username`, `message`, `status`, `sender`, `date`) VALUES
(2, 'Tahmid12', 'hello', 'yes', 'student', '04/20/2021 Tuesday, 05:08 PM'),
(3, 'Tahmid12', 'how are you??', 'yes', 'student', '04/20/2021 Tuesday, 05:08 PM'),
(4, 'Omur', 'I need a book. Can you help me??', 'yes', 'student', '04/23/2021 Friday, 12:27 PM'),
(5, 'Omur', 'Hello', 'no', 'admin', '04/23/2021 Friday, 12:58 PM'),
(6, 'Tahmid12', 'hello', 'yes', 'student', '04/23/2021 Friday, 01:00 PM'),
(7, 'Omur', 'how are you', 'no', 'admin', '04/23/2021 Friday, 02:00 PM'),
(8, 'Tahmid12', 'hello', 'yes', 'admin', '04/23/2021 Friday, 02:00 PM'),
(9, 'Tahmid12', 'hello', 'yes', 'student', '04/23/2021 Friday, 02:01 PM'),
(10, 'Tahmid12', 'how are you', 'yes', 'admin', '04/23/2021 Friday, 06:13 PM'),
(11, 'Tahmid12', 'hello i need a book', 'yes', 'student', '04/23/2021 Friday, 07:02 PM'),
(12, 'Tahmid12', 'hello', 'no', 'admin', '04/23/2021 Friday, 07:24 PM');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` int(111) NOT NULL,
  `student_username` varchar(111) NOT NULL,
  `FullName` varchar(111) NOT NULL,
  `Email` varchar(111) NOT NULL,
  `Password` varchar(111) NOT NULL,
  `PhoneNumber` varchar(111) NOT NULL,
  `studentpic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `student_username`, `FullName`, `Email`, `Password`, `PhoneNumber`, `studentpic`) VALUES
(1, 'Tahmid12', 'Nazre Imam Tahmid', 'tahmid@gmail.com', '12', '0152648790', 'tahmid.jpg'),
(3, 'Omur', 'Omur Faruk', 'omur@gmail.com', '123456', '029833356373', 'omur.jpg'),
(4, 'Pronob20', 'Pronob', 'pronob@gmail.com', '123456', '4344654865769', 'pronob.jpg'),
(22, 'Nabil24', 'Nasimul Haque', 'nabil123@gmail.com', '123', '01547896589', 'user2.png');

-- --------------------------------------------------------

--
-- Table structure for table `timer`
--

CREATE TABLE `timer` (
  `stdid` int(100) NOT NULL,
  `bid` int(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timer`
--

INSERT INTO `timer` (`stdid`, `bid`, `date`) VALUES
(1, 22, '2021-04-21 23:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `trendingbook`
--

CREATE TABLE `trendingbook` (
  `bookid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trendingbook`
--

INSERT INTO `trendingbook` (`bookid`) VALUES
(22),
(20),
(33),
(28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`authorid`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `authorid` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
