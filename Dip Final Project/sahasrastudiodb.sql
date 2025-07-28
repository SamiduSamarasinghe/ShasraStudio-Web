-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 03:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sahasrastudiodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `event_datetime` datetime NOT NULL,
  `crowd_quantity` int(11) NOT NULL,
  `photography_type` varchar(255) NOT NULL,
  `expected_cost` decimal(10,2) NOT NULL,
  `other_wantings` text DEFAULT NULL,
  `event_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending',
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `full_name`, `event_type`, `location`, `event_datetime`, `crowd_quantity`, `photography_type`, `expected_cost`, `other_wantings`, `event_description`, `created_at`, `status`, `image_url`) VALUES
(1, 'Dilmith', 'Birthday', 'Kottawa', '2024-12-03 09:00:00', 50, 'Birthday', '50000.00', 'Decoration', '21st Birthday', '2024-05-30 19:17:00', 'Confirmed', 'img/dmytro-ostapenko-NdfiqNqL7I8-unsplash.jpg'),
(2, 'Dilmith', 'Birthday', 'Kottawa', '2025-01-14 17:00:00', 100, 'Birthday', '100000.00', 'Be on time', '25th Birthday', '2024-05-30 19:19:25', 'Completed', NULL),
(3, 'Dilmith', 'Birthday', 'Colombo', '2027-01-01 10:00:00', 3, 'fff', '4667.00', 'fff', 'Type Here..ffff.', '2024-05-30 19:29:00', 'Pending', NULL),
(7, 'Devanga', 'Party', 'Home', '2027-02-01 21:02:00', 11, 'dd', '2234444.00', 'sssss', 'Type Here...sssss', '2024-05-30 19:41:10', 'Pending', NULL),
(18, 'Alice Johnson', 'Party', 'Sunset Beach', '2024-07-21 17:00:00', 100, 'Portrait', '1500.00', 'Extra lighting', 'Beach wedding', '2024-06-01 06:30:00', 'Confirmed', 'wedding1.jpg'),
(28, 'Alice Johnson', 'Birthday', 'Central Park', '2024-08-10 14:00:00', 50, 'Candid', '500.00', 'Balloon decorations', 'Outdoor birthday party', '2024-06-05 08:30:00', 'Pending', 'birthday1.jpg'),
(38, 'Bob Smith', 'Corporate Event', 'Downtown Hotel', '2024-09-15 09:00:00', 200, 'Event', '2500.00', 'Stage setup', 'Annual corporate meeting', '2024-06-10 03:30:00', 'Confirmed', 'corporate1.jpg'),
(81, 'Alice Johnson', 'Birthday', '123 Event Ave', '2023-03-10 18:00:00', 50, 'Portrait', '200.00', 'None', 'Alice\'s 30th birthday party', '2023-02-01 04:30:00', 'Completed', 'img1.jpg'),
(82, 'Alice Johnson', 'Conference', '456 Corporate Blvd', '2023-06-15 09:00:00', 200, 'Event', '500.00', 'Video recording', 'Tech conference for startups', '2023-05-20 06:30:00', 'Completed', 'img2.jpg'),
(83, 'Alice Johnson', 'Get Together', '789 Wedding St', '2023-09-21 15:00:00', 150, 'Wedding', '1000.00', 'Drone shots', 'Alice\'s sister\'s wedding', '2023-08-10 08:30:00', 'Completed', 'img3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `booking_identity`
--

CREATE TABLE `booking_identity` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `photo_type` varchar(255) NOT NULL,
  `photo_size` varchar(255) NOT NULL,
  `photo_quantity` int(11) NOT NULL,
  `booking_datetime` datetime NOT NULL,
  `special_requirements` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_cost` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_identity`
--

INSERT INTO `booking_identity` (`id`, `full_name`, `photo_type`, `photo_size`, `photo_quantity`, `booking_datetime`, `special_requirements`, `created_at`, `total_cost`, `status`, `image_url`) VALUES
(1, 'Dilmith', 'NIC', '111', 4, '2024-06-03 00:55:56', 'dddd', '2024-06-01 08:55:33', '4000.00', 'Pending', NULL),
(2, 'Alice Johnson', 'Visa', '3x4', 3, '2024-07-15 11:00:00', 'High resolution', '2024-06-05 09:30:00', '75.00', 'Pending', 'visa1.jpg'),
(3, 'Bob Smith', 'Driver License', '2x2', 4, '2024-08-01 09:00:00', 'Expedited processing', '2024-06-10 05:00:00', '120.00', 'Completed', 'driverlicense1.jpg'),
(4, 'Alice Johnson', 'Passport', '2x2', 5, '2024-07-01 10:00:00', 'None', '2024-06-01 07:00:00', '100.00', 'Completed', 'passport1.jpg'),
(17, 'Alice Johnson', 'Passport', '2x2', 2, '2023-01-05 10:00:00', 'None', '2023-01-01 03:30:00', '3000.00', 'Completed', 'id_img1.jpg'),
(27, 'Alice Johnson', 'Driver\'s License', '2x2', 1, '2023-04-12 11:00:00', 'None', '2023-04-01 04:30:00', '2000.00', 'Completed', 'id_img2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `booking_studio_outdoor`
--

CREATE TABLE `booking_studio_outdoor` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `request_type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `booking_datetime` datetime NOT NULL,
  `photography_type` varchar(255) NOT NULL,
  `expected_cost` decimal(10,2) NOT NULL,
  `special_requirements` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending',
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_studio_outdoor`
--

INSERT INTO `booking_studio_outdoor` (`id`, `full_name`, `request_type`, `location`, `booking_datetime`, `photography_type`, `expected_cost`, `special_requirements`, `created_at`, `status`, `image_url`) VALUES
(1, 'Alice Johnson', 'Outdoor', 'Mountain Trail', '2024-07-05 06:00:00', 'Landscape', '300.00', 'Early morning light', '2024-06-01 07:30:00', 'Confirmed', 'landscape1.jpg'),
(2, 'Devanga', 'Outdoor', 'Park', '2025-01-01 09:09:00', 'ddd', '1111.00', 'fff', '2024-06-01 13:48:42', 'Pending', NULL),
(3, 'Bob Smith', 'Outdoor', 'City Park', '2024-08-20 08:00:00', 'Candid', '350.00', 'Natural light', '2024-06-10 05:30:00', 'Pending', 'candid1.jpg'),
(4, 'Dilmith', 'Outdoor', 'Beach House', '2025-01-04 09:09:00', 'ddd', '1111.00', 'fff', '2024-06-01 13:59:04', 'Pending', NULL),
(5, 'Alice Johnson', 'Studio', 'Studio A', '2024-07-20 14:00:00', 'Portrait', '200.00', 'Softbox lighting', '2024-06-05 10:30:00', 'Confirmed', 'studio1.jpg'),
(6, 'Alice Johnson', 'Outdoor', 'Central Park', '2023-05-22 14:00:00', 'Landscape', '10500.00', 'None', '2023-05-01 04:30:00', 'Completed', 'studio_img1.jpg'),
(7, 'Alice Johnson', 'Studio', 'ABC Studio', '2023-08-11 16:00:00', 'Portrait', '5000.00', 'None', '2023-07-25 06:30:00', 'Completed', 'studio_img2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `booking_wedding`
--

CREATE TABLE `booking_wedding` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `event_datetime` datetime NOT NULL,
  `crowd_quantity` int(11) NOT NULL,
  `photography_type` varchar(255) NOT NULL,
  `expected_cost` decimal(10,2) NOT NULL,
  `other_wantings` text DEFAULT NULL,
  `event_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending',
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_wedding`
--

INSERT INTO `booking_wedding` (`id`, `full_name`, `event_type`, `location`, `event_datetime`, `crowd_quantity`, `photography_type`, `expected_cost`, `other_wantings`, `event_description`, `created_at`, `status`, `image_url`) VALUES
(1, 'Dimith', 'Wedding', 'Hilton', '2025-01-01 09:00:00', 1111, 'sss', '11111.00', 'ddd', 'Type Here...ddd', '2024-06-01 08:21:31', 'Pending', NULL),
(10, 'Alice Johnson', 'Wedding', 'Ocean View Resort', '2024-07-25 16:00:00', 150, 'Videography', '2000.00', 'Drone footage', 'Beachside wedding ceremony', '2024-06-01 08:30:00', 'Confirmed', 'wedding2.jpg'),
(20, 'Bob Smith', 'Wedding', 'Country Club', '2024-09-10 17:00:00', 180, 'Traditional', '1800.00', 'Extended video coverage', 'Elegant indoor wedding', '2024-06-10 06:30:00', 'Confirmed', 'wedding3.jpg'),
(100, 'Alice Johnson', 'Wedding', '456 Wedding Ln', '2023-11-11 14:00:00', 200, 'Wedding', '1200.00', 'Video recording, Drone shots', 'Friend\'s wedding', '2023-10-01 09:30:00', 'Completed', 'wedding_img1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `inquiry` text DEFAULT NULL,
  `customer_username` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `first_name`, `last_name`, `address`, `email`, `contact_no`, `inquiry`, `customer_username`, `status`, `date`) VALUES
(1, 'ddd', 'dddddd', 'ddd', 'dd@gmail.com', 'dd', 'dddd', 'dila', 'Completed', '2024-06-12 00:36:54'),
(2, 'frfr', 'rffr', 'rffr', 'cccc@gmail.com', '11111', 'rvfrrvrv', 'dila', 'Pending', '2024-06-12 00:36:54'),
(3, 'rffrf', 'rfrrf', 'rfrf', 'rfrf@gmail.com', '111111', 'rfrfrfrfrf', 'dila', 'Pending', '2024-06-12 00:36:54'),
(4, 'deeded', 'eddeed', 'ededed', 'chan@gmail.com', '1111', 'deedededed', 'dila', 'Pending', '2024-06-12 00:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Full_Name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Address` varchar(70) NOT NULL,
  `Phone_Number` int(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Full_Name`, `Username`, `Address`, `Phone_Number`, `Email`, `Password`) VALUES
('Alice Johnson', 'alicejohnson', '789 Pine Lane', 1122334455, 'alicejohnson@example.com', '123'),
('Alice Johnson', 'alice_j', '789 Pine Road', 555, 'alice.j@example.com', '123'),
('Alice Johnson', 'alice_johnson', '123 Maple Street', 123, 'alice@example.com', '123'),
('Bob Brown', 'bobbrown', '321 Maple Road', 2147483647, 'bobbrown@example.com', '123'),
('Bob Brown', 'bob_b', '101 Birch Lane', 555, 'bob.b@example.com', '123'),
('Bob Smith', 'bob_smith', '456 Oak Avenue', 234, 'bob@example.com', '123'),
('Carol White', 'carol_w', '234 Cedar Street', 555, 'carol.w@example.com', '123'),
('Charlie Davis', 'charliedavis', '654 Birch Boulevard', 2147483647, 'charliedavis@example.com', '123'),
('David Black', 'david_b', '567 Elm Avenue', 555, 'david.b@example.com', '123'),
('dev', 'dev', 'kottawa', 77, 'chan@gmail.com', '3953'),
('Devanga ', 'Devz', 'Kottawa', 1234567890, 'devz@gmail.com', '123'),
('dev', 'devzz', 'kottawa', 111, 'devzz@gmail.com', '123'),
('Dilmith', 'dila', '123/Temple Road, Colombo', 774444, 'dila123@gmail.com', '123'),
('Eve Adams', 'eve_a', '890 Fir Road', 555, 'eve.a@example.com', '123'),
('Frank Green', 'frank_g', '111 Ash Lane', 555, 'frank.g@example.com', '123'),
('Grace Lee', 'grace_l', '222 Poplar Street', 555, 'grace.l@example.com', '123'),
('Henry Moore', 'henry_m', '333 Willow Avenue', 555, 'henry.m@example.com', '123'),
('Jane Doe', 'janedoe', '456 Oak Avenue', 987654321, 'janedoe@example.com', '123'),
('Jane Smith', 'jane_smith', '456 Oak Avenue', 555, 'jane.smith@example.com', '123'),
('John Smith', 'johnsmith', '123 Elm Street', 1234567890, 'johnsmith@example.com', '123'),
('John Doe', 'john_doe', '123 Maple Street', 555, 'john.doe@example.com', '123'),
('Lanka', 'LankaJ', 'Kottawa', 12345, 'lanka@gmail.com', '123'),
('samidu', 'samidu', '1111', 111, 'aaa@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `employeelog`
--

CREATE TABLE `employeelog` (
  `Full_Name` varchar(255) NOT NULL,
  `Address` text DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Mobile_Number` varchar(15) DEFAULT NULL,
  `Gender` enum('Male','Female','Other') DEFAULT NULL,
  `Occupation` varchar(255) DEFAULT NULL,
  `ID_Number` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeelog`
--

INSERT INTO `employeelog` (`Full_Name`, `Address`, `Email`, `Mobile_Number`, `Gender`, `Occupation`, `ID_Number`, `Password`) VALUES
('Emily Davis', '789 Elm St, Metropolis, NY', 'emily.davis@example.com', '1234567895', 'Female', 'Photographer', 'EMP004', '123'),
('Jane Smith', '456 Elm St, Townsville', 'jane.smith@example.com', '555-5678', 'Female', 'Frame Maker', 'FM5678', '123'),
('John Doe', '123 Main St, Cityville', 'john.doe@example.com', '555-1234', 'Male', 'Photographer', 'PH1234', '123'),
('Michael Brown', '789 Oak St, Villagetown', 'michael.brown@example.com', '555-9012', 'Male', 'Crew Member', 'CM9012', '123');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE `employee_attendance` (
  `Attendance_ID` int(11) NOT NULL,
  `Employee_Full_Name` varchar(255) DEFAULT NULL,
  `Date` date NOT NULL,
  `Time_In` time DEFAULT NULL,
  `Time_Out` time DEFAULT NULL,
  `Remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_attendance`
--

INSERT INTO `employee_attendance` (`Attendance_ID`, `Employee_Full_Name`, `Date`, `Time_In`, `Time_Out`, `Remark`) VALUES
(1, 'John Doe', '2024-06-15', '09:00:00', '18:00:00', ''),
(2, 'Jane Smith', '2024-06-15', '08:30:00', '17:30:00', ''),
(3, 'Michael Brown', '2024-06-15', '10:00:00', '19:00:00', ''),
(4, 'John Doe', '2024-06-01', '09:00:00', '18:00:00', NULL),
(5, 'John Doe', '2024-06-02', '09:15:00', '18:00:00', NULL),
(6, 'Jane Smith', '2024-06-01', '08:45:00', '17:45:00', NULL),
(7, 'Jane Smith', '2024-06-02', '08:50:00', '17:45:00', NULL),
(8, 'Michael Brown', '2024-06-01', '10:00:00', '19:00:00', NULL),
(9, 'Michael Brown', '2024-06-02', '10:05:00', '19:00:00', NULL),
(10, 'John Doe', '2024-03-01', '09:00:00', '18:00:00', NULL),
(11, 'John Doe', '2024-03-02', '09:05:00', '18:00:00', NULL),
(12, 'John Doe', '2024-03-03', '09:00:00', '18:00:00', NULL),
(13, 'John Doe', '2024-04-01', '09:00:00', '18:00:00', NULL),
(14, 'John Doe', '2024-04-02', '09:15:00', '18:00:00', NULL),
(15, 'John Doe', '2024-05-01', '09:00:00', '18:00:00', NULL),
(16, 'John Doe', '2024-05-02', '09:10:00', '18:00:00', NULL),
(17, 'Jane Smith', '2024-03-01', '08:45:00', '17:45:00', NULL),
(18, 'Jane Smith', '2024-03-02', '08:50:00', '17:45:00', NULL),
(19, 'Jane Smith', '2024-03-03', '08:40:00', '17:45:00', NULL),
(20, 'Jane Smith', '2024-04-01', '08:45:00', '17:45:00', NULL),
(21, 'Jane Smith', '2024-04-02', '08:50:00', '17:45:00', NULL),
(22, 'Jane Smith', '2024-05-01', '08:45:00', '17:45:00', NULL),
(23, 'Jane Smith', '2024-05-02', '08:55:00', '17:45:00', NULL),
(24, 'Michael Brown', '2024-03-01', '10:00:00', '19:00:00', NULL),
(25, 'Michael Brown', '2024-03-02', '10:05:00', '19:00:00', NULL),
(26, 'Michael Brown', '2024-03-03', '10:10:00', '19:00:00', NULL),
(27, 'Michael Brown', '2024-04-01', '10:00:00', '19:00:00', NULL),
(28, 'Michael Brown', '2024-04-02', '10:15:00', '19:00:00', NULL),
(29, 'Michael Brown', '2024-05-01', '10:00:00', '19:00:00', NULL),
(30, 'Michael Brown', '2024-05-02', '10:20:00', '19:00:00', NULL),
(31, 'Emily Davis', '2024-01-01', '09:00:00', '17:00:00', NULL),
(32, 'Emily Davis', '2024-01-02', '09:05:00', '17:00:00', NULL),
(33, 'Emily Davis', '2024-01-03', '09:00:00', '17:00:00', NULL),
(34, 'Emily Davis', '2024-01-04', '09:15:00', '17:00:00', NULL),
(35, 'Emily Davis', '2024-01-05', '09:00:00', '17:00:00', NULL),
(36, 'Emily Davis', '2024-02-01', '09:00:00', '17:00:00', NULL),
(37, 'Emily Davis', '2024-02-02', '09:10:00', '17:00:00', NULL),
(38, 'Emily Davis', '2024-02-03', '09:00:00', '17:00:00', NULL),
(39, 'Emily Davis', '2024-02-04', '09:00:00', '17:00:00', NULL),
(40, 'Emily Davis', '2024-02-05', '09:20:00', '17:00:00', NULL),
(41, 'Emily Davis', '2024-03-01', '09:00:00', '17:00:00', NULL),
(42, 'Emily Davis', '2024-03-02', '09:05:00', '17:00:00', NULL),
(43, 'Emily Davis', '2024-03-03', '09:00:00', '17:00:00', NULL),
(44, 'Emily Davis', '2024-03-04', '09:00:00', '17:00:00', NULL),
(45, 'Emily Davis', '2024-03-05', '09:15:00', '17:00:00', NULL),
(46, 'John Doe', '2024-06-16', '08:30:00', '19:30:00', 'Mark'),
(47, 'John Doe', '2024-06-14', '07:45:00', '20:00:00', 'Mark'),
(48, 'Jane Smith', '2024-06-17', '08:30:00', '20:30:00', 'Mark');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leaves`
--

CREATE TABLE `employee_leaves` (
  `Leave_ID` int(11) NOT NULL,
  `Employee_Full_Name` varchar(255) DEFAULT NULL,
  `Date_From` date NOT NULL,
  `Date_To` date NOT NULL,
  `Duration` int(11) DEFAULT NULL,
  `Reason` text DEFAULT NULL,
  `Status` enum('Pending','Approved','Cancelled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_leaves`
--

INSERT INTO `employee_leaves` (`Leave_ID`, `Employee_Full_Name`, `Date_From`, `Date_To`, `Duration`, `Reason`, `Status`) VALUES
(1, 'John Doe', '2024-06-15', '2024-06-17', 3, 'Vacation leave', 'Pending'),
(2, 'Jane Smith', '2024-06-20', '2024-06-21', 2, 'Personal leave', 'Pending'),
(3, 'Michael Brown', '2024-06-25', '2024-06-26', 2, 'Sick leave', 'Pending'),
(4, 'John Doe', '2024-06-10', '2024-06-12', 3, 'Personal leave', 'Approved'),
(5, 'Jane Smith', '2024-06-15', '2024-06-16', 2, 'Vacation', 'Approved'),
(6, 'Michael Brown', '2024-06-20', '2024-06-21', 2, 'Sick leave', 'Pending'),
(7, 'Emily Davis', '2024-01-10', '2024-01-11', 2, 'Medical Leave', 'Approved'),
(8, 'Emily Davis', '2024-02-15', '2024-02-16', 2, 'Family Emergency', 'Approved'),
(9, 'John Doe', '2024-06-28', '2024-06-29', 2, 'Personal Leave', 'Pending'),
(13, 'John Doe', '2024-06-18', '2024-06-19', 2, 'Sick Leave', 'Pending'),
(14, 'John Doe', '2024-06-30', '2024-06-30', 1, 'Personal Leave', 'Pending'),
(16, 'John Doe', '2024-06-10', '2024-06-11', 2, 'Sick Leave', 'Pending'),
(17, 'Jane Smith', '2024-06-18', '2024-06-19', 2, 'Casual Leave', 'Pending'),
(18, 'Jane Smith', '2024-06-17', '2024-06-18', 2, 'Casual Leave', 'Pending'),
(19, 'Michael Brown', '2024-06-18', '2024-06-19', 2, 'Sick Leave', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `employee_messages`
--

CREATE TABLE `employee_messages` (
  `Message_ID` int(11) NOT NULL,
  `Employee_Full_Name` varchar(255) DEFAULT NULL,
  `Message_Subject` varchar(255) NOT NULL,
  `Message_Description` text DEFAULT NULL,
  `Received_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_messages`
--

INSERT INTO `employee_messages` (`Message_ID`, `Employee_Full_Name`, `Message_Subject`, `Message_Description`, `Received_Date`) VALUES
(1, 'John Doe', 'Meeting Schedule', 'Discuss upcoming photoshoot schedules.', '2024-06-13 11:12:09'),
(2, 'Jane Smith', 'Client Feedback', 'Received positive feedback from a recent frame order.', '2024-06-13 11:12:09'),
(3, 'Michael Brown', 'Project Update', 'Update on progress for the current photography project.', '2024-06-13 11:12:09');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary`
--

CREATE TABLE `employee_salary` (
  `Salary_ID` int(11) NOT NULL,
  `Employee_Full_Name` varchar(255) DEFAULT NULL,
  `Employee_Occupation` varchar(255) DEFAULT NULL,
  `Basic_Salary` decimal(10,2) NOT NULL,
  `Over_Time_Hours` int(11) NOT NULL,
  `Over_Time_Payment` decimal(10,2) GENERATED ALWAYS AS (`Over_Time_Hours` * 1000) VIRTUAL,
  `Net_Salary` decimal(10,2) GENERATED ALWAYS AS (`Basic_Salary` + `Over_Time_Payment`) VIRTUAL,
  `Status` enum('Pending','Completed') DEFAULT 'Pending',
  `Salary_Paid_Date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_salary`
--

INSERT INTO `employee_salary` (`Salary_ID`, `Employee_Full_Name`, `Employee_Occupation`, `Basic_Salary`, `Over_Time_Hours`, `Status`, `Salary_Paid_Date`) VALUES
(1, 'John Doe', 'Photographer', '5000.00', 5, 'Pending', NULL),
(2, 'Jane Smith', 'Frame Maker', '4500.00', 3, 'Pending', NULL),
(3, 'Michael Brown', 'Crew Member', '4000.00', 0, 'Pending', NULL),
(4, 'John Doe', 'Photographer', '5000.00', 10, 'Completed', '2024-05-31 18:30:00'),
(5, 'Jane Smith', 'Frame Maker', '4000.00', 5, 'Completed', '2024-05-31 18:30:00'),
(6, 'Michael Brown', 'Crew Member', '4500.00', 8, 'Pending', NULL),
(7, 'John Doe', 'Photographer', '5000.00', 12, 'Completed', '2024-02-29 18:30:00'),
(8, 'John Doe', 'Photographer', '5000.00', 15, 'Completed', '2024-03-31 18:30:00'),
(9, 'John Doe', 'Photographer', '5000.00', 10, 'Completed', '2024-04-30 18:30:00'),
(10, 'Jane Smith', 'Frame Maker', '4000.00', 5, 'Completed', '2024-02-29 18:30:00'),
(11, 'Jane Smith', 'Frame Maker', '4000.00', 7, 'Completed', '2024-03-31 18:30:00'),
(12, 'Jane Smith', 'Frame Maker', '4000.00', 8, 'Completed', '2024-04-30 18:30:00'),
(13, 'Michael Brown', 'Crew Member', '4500.00', 8, 'Completed', '2024-02-29 18:30:00'),
(14, 'Michael Brown', 'Crew Member', '4500.00', 10, 'Completed', '2024-03-31 18:30:00'),
(15, 'Michael Brown', 'Crew Member', '4500.00', 12, 'Completed', '2024-04-30 18:30:00'),
(16, 'Emily Davis', 'Photographer', '3000.00', 10, 'Completed', '2024-01-30 18:30:00'),
(17, 'Emily Davis', 'Photographer', '3000.00', 15, 'Completed', '2024-02-27 18:30:00'),
(18, 'Emily Davis', 'Photographer', '3000.00', 12, 'Completed', '2024-03-30 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_tasks`
--

CREATE TABLE `employee_tasks` (
  `Task_ID` int(11) NOT NULL,
  `Employee_Full_Name` varchar(255) DEFAULT NULL,
  `Task_Subject` varchar(255) NOT NULL,
  `Task_Description` text DEFAULT NULL,
  `Status` enum('Pending','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_tasks`
--

INSERT INTO `employee_tasks` (`Task_ID`, `Employee_Full_Name`, `Task_Subject`, `Task_Description`, `Status`) VALUES
(1, 'John Doe', 'Photoshoot at Park', 'Capture portraits of a family at the local park.', 'Completed'),
(2, 'Jane Smith', 'Create Custom Frames', 'Prepare custom frames for client\'s art pieces.', 'Completed'),
(3, 'Michael Brown', 'Set up Lighting Equipment', 'Prepare and set up lighting equipment for studio session.', 'Completed'),
(4, 'John Doe', 'Photo Shoot at Park', 'Complete the photo shoot at the central park by noon.', 'Completed'),
(5, 'Jane Smith', 'Frame Assembly', 'Assemble 50 picture frames by end of the day.', 'Completed'),
(6, 'Michael Brown', 'Equipment Setup', 'Setup photography equipment for the wedding shoot.', 'Pending'),
(7, 'John Doe', 'Photo Shoot at Park', 'Complete the photo shoot at the central park by noon.', 'Pending'),
(8, 'John Doe', 'Wedding Photography', 'Cover the wedding event at the Grand Hall.', 'Pending'),
(9, 'John Doe', 'Product Photography', 'Photograph new products for the catalog.', 'Pending'),
(10, 'Jane Smith', 'Frame Assembly', 'Assemble 50 picture frames by end of the day.', 'Pending'),
(11, 'Jane Smith', 'Custom Frame Design', 'Design custom frames for client orders.', 'Pending'),
(12, 'Jane Smith', 'Frame Quality Check', 'Ensure all frames meet quality standards.', 'Pending'),
(13, 'Michael Brown', 'Equipment Setup', 'Setup photography equipment for the wedding shoot.', 'Pending'),
(14, 'Michael Brown', 'Studio Maintenance', 'Maintain and organize studio equipment.', 'Pending'),
(15, 'Michael Brown', 'Event Assistance', 'Assist during the outdoor event photography.', 'Pending'),
(16, 'Emily Davis', 'Wedding Photoshoot', 'Photoshoot for John and Jane\'s wedding on 2024-01-12', 'Completed'),
(17, 'Emily Davis', 'Event Coverage', 'Cover the Metropolis Annual Gala on 2024-01-25', 'Completed'),
(18, 'Emily Davis', 'Portrait Session', 'Studio portrait session for the Brown family on 2024-02-05', 'Pending'),
(19, 'Emily Davis', 'Product Photography', 'Product shoot for ABC Corp. on 2024-02-15', 'Pending'),
(20, 'Emily Davis', 'Nature Photoshoot', 'Outdoor photoshoot at the National Park on 2024-03-10', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_bill`
--

CREATE TABLE `estimate_bill` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `crowd_quantity` int(11) NOT NULL,
  `photography_type` varchar(255) NOT NULL,
  `expected_cost` decimal(10,2) NOT NULL,
  `about_event` text NOT NULL,
  `estimated_cost` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estimate_bill`
--

INSERT INTO `estimate_bill` (`id`, `full_name`, `event_type`, `location`, `crowd_quantity`, `photography_type`, `expected_cost`, `about_event`, `estimated_cost`, `created_at`, `status`) VALUES
(1, 'Dilmith', 'Birthday', 'ddddddddddddddd', 111, 'photo', '4000.00', 'dedefefr', '4500.00', '2024-06-02 13:41:22', 'Completed'),
(2, 'Dilmith', 'Party', 'Colombo', 111, 'both', '4000.00', 'Party', NULL, '2024-06-02 13:41:49', 'Pending'),
(3, 'Dilmith', 'Engagement', 'Hilton Hotel', 111, 'video', '14000.00', 'Engagement Ceremony', NULL, '2024-06-02 13:41:52', 'Pending'),
(4, 'Alice Johnson', 'Wedding', 'New York', 100, 'Indoor', '5000.00', 'Traditional wedding ceremony', NULL, '2024-06-17 18:16:17', 'Pending'),
(5, 'Bob Brown', 'Corporate Event', 'Los Angeles', 200, 'Outdoor', '8000.00', 'Annual company conference', NULL, '2024-06-17 18:16:17', 'Pending'),
(6, 'Charlie Davis', 'Birthday', 'Chicago', 50, 'Indoor', '1500.00', 'Surprise party for 30th birthday', NULL, '2024-06-17 18:16:17', 'Pending'),
(7, 'Carol White', 'Anniversary', 'San Francisco', 80, 'Outdoor', '3000.00', '25th wedding anniversary celebration', NULL, '2024-06-17 18:16:17', 'Pending'),
(8, 'Eve Adams', 'Baby Shower', 'Miami', 30, 'Indoor', '1000.00', 'Celebrating the upcoming arrival', NULL, '2024-06-17 18:16:17', 'Pending'),
(9, 'David Black', 'Conference', 'Seattle', 150, 'Indoor', '6000.00', 'Annual tech industry conference', NULL, '2024-06-17 18:16:17', 'Pending'),
(10, 'Henry Moore', 'Family Reunion', 'Denver', 70, 'Outdoor', '2500.00', 'Gathering of extended family members', NULL, '2024-06-17 18:16:17', 'Pending'),
(11, 'John Smith', 'Graduation Ceremony', 'Boston', 300, 'Outdoor', '9000.00', 'University commencement event', NULL, '2024-06-17 18:16:17', 'Pending'),
(12, 'Frank Green', 'Charity Gala', 'Washington D.C.', 120, 'Indoor', '4000.00', 'Fundraising event for local charity', NULL, '2024-06-17 18:16:17', 'Pending'),
(13, 'Grace Lee', 'Music Concert', 'Las Vegas', 500, 'Outdoor', '12000.00', 'Live performance of famous artists', NULL, '2024-06-17 18:16:17', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `frames`
--

CREATE TABLE `frames` (
  `frame_number` int(11) NOT NULL,
  `frame_size` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frames`
--

INSERT INTO `frames` (`frame_number`, `frame_size`, `price`, `image_url`) VALUES
(1, 'Small', '500.00', NULL),
(2, 'Medium', '1000.00', NULL),
(3, 'Large', '1500.00', NULL),
(4, 'Small', '4000.00', 'img/1600w-CHFeHsw0J-.png');

-- --------------------------------------------------------

--
-- Table structure for table `frame_sublimation`
--

CREATE TABLE `frame_sublimation` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `frame_number` int(11) DEFAULT NULL,
  `sublimation_number` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `requested_date` date NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frame_sublimation`
--

INSERT INTO `frame_sublimation` (`id`, `full_name`, `service_type`, `frame_number`, `sublimation_number`, `quantity`, `requested_date`, `total_cost`, `created_at`, `status`) VALUES
(5, 'Dilmith', 'frame', 1, NULL, 5, '2024-02-02', '2500.00', '2024-06-01 16:44:22', 'Pending'),
(6, 'Dilmith', 'sublimation', NULL, 2, 5, '2024-02-02', '2000.00', '2024-06-01 16:45:27', 'Pending'),
(7, 'Devanga', 'both', 1, 1, 3, '2023-02-02', '2100.00', '2024-06-01 16:56:01', 'Pending'),
(8, 'Devanga', 'frame', 1, NULL, 3, '2023-02-02', '1500.00', '2024-06-01 16:56:16', 'Pending'),
(9, 'Dilmith', 'sublimation', NULL, 2, 5, '2023-02-02', '2000.00', '2024-06-01 16:56:33', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `identification_photography`
--

CREATE TABLE `identification_photography` (
  `id` int(11) NOT NULL,
  `photo_type` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `identification_photography`
--

INSERT INTO `identification_photography` (`id`, `photo_type`, `price`) VALUES
(1, 'NIC', '1000.00'),
(2, 'Passport', '2000.00');

-- --------------------------------------------------------

--
-- Table structure for table `managerlog`
--

CREATE TABLE `managerlog` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `managerlog`
--

INSERT INTO `managerlog` (`Username`, `Password`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `rent_items`
--

CREATE TABLE `rent_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_category` varchar(100) DEFAULT NULL,
  `per_night_price` decimal(10,2) NOT NULL,
  `item_description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rent_items`
--

INSERT INTO `rent_items` (`item_id`, `item_name`, `item_category`, `per_night_price`, `item_description`, `image_url`) VALUES
(1, 'Nikon Z 7II Mirrorless Digital Camera Body Only', 'Digital Cameras', '2500.00', 'Mirrorless digital camera body from Nikon.', 'nikon-z7-2.jpg'),
(2, 'Canon EF-S 55-250mm f/4-5.6 IS STM Lens', 'Lenses', '2500.00', 'Canon EF-S lens with 55-250mm focal length and STM technology.', 'rent-canon-stm-lens.jpg'),
(3, 'DJI Air 2S Drone', 'Drones', '5000.00', 'High-performance drone with advanced features from DJI.', 'rent-drone-DJI.jpg'),
(4, 'NiceFoto LR-480AII LED Ring Light with Light Stand', 'Lightning Items', '2500.00', 'LED ring light with adjustable stand for studio lighting.', 'rent-light.jpg'),
(5, 'Canon Speedlite 600EX II-RT', 'Digital Cameras', '2000.00', 'Canon Speedlite flash for advanced lighting in photography.', 'sony-zv.jpg'),
(6, 'Godox E-Sport ES30 LED Light Kit with Telescopic Desktop Stand', 'Lightning Items', '3000.00', 'Godox LED light kit with telescopic stand for versatile lighting setups.', 'rent-light-1.jpg'),
(7, 'Canon Speedlite 600EX II-RT', 'Flashes', '1500.00', 'Canon Speedlite flash for professional flash photography.', 'rent-flash-1.jpg'),
(8, 'DJI Mavic Mini Fly More Combo', 'Drones', '4000.00', 'Compact and powerful drone package from DJI.', 'rent-drone.jpg'),
(9, 'Godox TT685N Thinklite TTL Flash for Nikon Cameras', 'Flashes', '2500.00', 'Godox TTL flash compatible with Nikon cameras.', 'rent-flash.jpg'),
(10, 'Canon EF-S USM Lens', 'Lenses', '2500.00', 'Canon EF-S lens with USM technology.', 'rent-canon-usm-lens.jpg'),
(11, 'Canon EF-S USM Lens Sirui W-2004 Waterproof Aluminum Alloy Tripod', 'Tripods', '1500.00', 'Sirui waterproof tripod with aluminum alloy build.', 'rent-tripod-1.jpg'),
(12, 'Sirui ET-2004 Aluminum Tripod with E-20 Ball Head', 'Tripods', '2500.00', 'Sirui aluminum tripod with E-20 ball head for stability.', 'rent-tripod-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rent_order`
--

CREATE TABLE `rent_order` (
  `rent_id` int(11) NOT NULL,
  `customer_username` varchar(255) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `rent_days` int(11) NOT NULL,
  `rent_price` decimal(10,2) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `cvc` varchar(4) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `name_on_card` varchar(100) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `rent_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `rent_status` enum('Pending','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rent_order`
--

INSERT INTO `rent_order` (`rent_id`, `customer_username`, `item_id`, `rent_days`, `rent_price`, `email`, `card_number`, `cvc`, `payment_method`, `name_on_card`, `billing_address`, `city`, `postal_code`, `rent_date`, `rent_status`) VALUES
(1, 'johnsmith', 1, 3, '90.00', 'johnsmith@example.com', '4111111111111111', '123', 'Credit Card', 'John Smith', '123 Elm Street', 'Metropolis', '12345', '2024-01-11 18:30:00', 'Completed'),
(2, 'janedoe', 2, 5, '150.00', 'janedoe@example.com', '4111111111111111', '123', 'Credit Card', 'Jane Doe', '456 Oak Avenue', 'Gotham', '54321', '2024-02-17 18:30:00', 'Completed'),
(3, 'alicejohnson', 1, 7, '21000.00', 'alicejohnson@example.com', '4111111111111111', '123', 'Credit Card', 'Alice Johnson', '789 Pine Lane', 'Star City', '67890', '2024-03-04 18:30:00', 'Completed'),
(4, 'bobbrown', 3, 4, '160.00', 'bobbrown@example.com', '4111111111111111', '123', 'Credit Card', 'Bob Brown', '321 Maple Road', 'Central City', '09876', '2024-04-21 18:30:00', 'Completed'),
(5, 'charliedavis', 2, 2, '60.00', 'charliedavis@example.com', '4111111111111111', '123', 'Credit Card', 'Charlie Davis', '654 Birch Boulevard', 'Coast City', '56789', '2024-05-27 18:30:00', 'Completed'),
(6, 'johnsmith', 4, 6, '180.00', 'johnsmith@example.com', '4111111111111111', '123', 'Credit Card', 'John Smith', '123 Elm Street', 'Metropolis', '12345', '2024-06-02 18:30:00', 'Pending'),
(7, 'janedoe', 1, 1, '30.00', 'janedoe@example.com', '4111111111111111', '123', 'Credit Card', 'Jane Doe', '456 Oak Avenue', 'Gotham', '54321', '2024-06-11 18:30:00', 'Pending'),
(88, 'john_doe', 1, 5, '12500.00', 'john.doe@example.com', '1234567812345678', '123', 'Credit Card', 'John Doe', '123 Maple Street', 'Springfield', '12345', '2024-01-04 18:30:00', 'Completed'),
(89, 'jane_smith', 2, 3, '7500.00', 'jane.smith@example.com', '2345678923456789', '234', 'Credit Card', 'Jane Smith', '456 Oak Avenue', 'Springfield', '23456', '2024-01-09 18:30:00', 'Completed'),
(90, 'alice_j', 3, 7, '17500.00', 'alice.j@example.com', '3456789034567890', '345', 'Credit Card', 'Alice Johnson', '789 Pine Road', 'Springfield', '34567', '2024-02-14 18:30:00', 'Completed'),
(108, 'bob_b', 4, 4, '20000.00', 'bob.b@example.com', '4567890145678901', '456', 'Credit Card', 'Bob Brown', '101 Birch Lane', 'Springfield', '45678', '2024-02-19 18:30:00', 'Completed'),
(109, 'carol_w', 5, 6, '15000.00', 'carol.w@example.com', '5678901256789012', '567', 'Credit Card', 'Carol White', '234 Cedar Street', 'Springfield', '56789', '2024-03-07 18:30:00', 'Completed'),
(110, 'david_b', 6, 2, '6000.00', 'david.b@example.com', '6789012367890123', '678', 'Credit Card', 'David Black', '567 Elm Avenue', 'Springfield', '67890', '2024-03-11 18:30:00', 'Completed'),
(111, 'eve_a', 7, 5, '12500.00', 'eve.a@example.com', '7890123478901234', '789', 'Credit Card', 'Eve Adams', '890 Fir Road', 'Springfield', '78901', '2024-04-17 18:30:00', 'Completed'),
(112, 'frank_g', 8, 3, '7500.00', 'frank.g@example.com', '8901234589012345', '890', 'Credit Card', 'Frank Green', '111 Ash Lane', 'Springfield', '89012', '2024-04-21 18:30:00', 'Completed'),
(113, 'grace_l', 9, 7, '17500.00', 'grace.l@example.com', '9012345690123456', '901', 'Credit Card', 'Grace Lee', '222 Poplar Street', 'Springfield', '90123', '2024-05-04 18:30:00', 'Completed'),
(114, 'henry_m', 10, 4, '10000.00', 'henry.m@example.com', '0123456701234567', '012', 'Credit Card', 'Henry Moore', '333 Willow Avenue', 'Springfield', '01234', '2024-05-09 18:30:00', 'Completed'),
(121, 'john_doe', 1, 5, '12500.00', 'john.doe@example.com', '1234567812345678', '123', 'Credit Card', 'John Doe', '123 Maple Street', 'Springfield', '12345', '2024-06-14 18:30:00', 'Pending'),
(122, 'jane_smith', 2, 3, '7500.00', 'jane.smith@example.com', '2345678923456789', '234', 'Credit Card', 'Jane Smith', '456 Oak Avenue', 'Springfield', '23456', '2024-06-15 18:30:00', 'Pending'),
(123, 'alice_j', 3, 7, '17500.00', 'alice.j@example.com', '3456789034567890', '345', 'Credit Card', 'Alice Johnson', '789 Pine Road', 'Springfield', '34567', '2024-06-16 18:30:00', 'Pending'),
(124, 'bob_b', 4, 4, '20000.00', 'bob.b@example.com', '4567890145678901', '456', 'Credit Card', 'Bob Brown', '101 Birch Lane', 'Springfield', '45678', '2024-06-17 18:30:00', 'Pending'),
(125, 'carol_w', 5, 6, '15000.00', 'carol.w@example.com', '5678901256789012', '567', 'Credit Card', 'Carol White', '234 Cedar Street', 'Springfield', '56789', '2024-06-18 18:30:00', 'Pending'),
(126, 'david_b', 6, 2, '6000.00', 'david.b@example.com', '6789012367890123', '678', 'Credit Card', 'David Black', '567 Elm Avenue', 'Springfield', '67890', '2024-06-19 18:30:00', 'Pending'),
(127, 'eve_a', 7, 5, '12500.00', 'eve.a@example.com', '7890123478901234', '789', 'Credit Card', 'Eve Adams', '890 Fir Road', 'Springfield', '78901', '2024-06-20 18:30:00', 'Pending'),
(128, 'frank_g', 8, 3, '7500.00', 'frank.g@example.com', '8901234589012345', '890', 'Credit Card', 'Frank Green', '111 Ash Lane', 'Springfield', '89012', '2024-06-21 18:30:00', 'Pending'),
(129, 'grace_l', 9, 7, '17500.00', 'grace.l@example.com', '9012345690123456', '901', 'Credit Card', 'Grace Lee', '222 Poplar Street', 'Springfield', '90123', '2024-06-22 18:30:00', 'Pending'),
(130, 'henry_m', 2, 4, '10000.00', 'henry.m@example.com', '0123456701234567', '012', 'Credit Card', 'Henry Moore', '333 Willow Avenue', 'Springfield', '01234', '2024-06-23 18:30:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `shop_filter`
--

CREATE TABLE `shop_filter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_filter`
--

INSERT INTO `shop_filter` (`id`, `name`, `category`, `price`, `description`, `quantity`, `image_url`) VALUES
(1, 'Canon EOS M50 Mark II Mirrorless Digital Camera with 15-45mm Lens', 'canon camera', '244500.00', 'A versatile and compact camera.', 10, 'canon_eos_m50.jpg'),
(2, 'Canon EOS R6 Mirrorless Digital Camera', 'canon camera', '659500.00', 'A high-performance full-frame camera.', 5, 'canon_eos_r6_.jpg'),
(3, 'Nikon Z5 Mirrorless Camera with 24-50mm Lens', 'nikon', '499500.00', 'An entry-level full-frame mirrorless camera.', 7, 'nikon-z5-lens.jpg'),
(4, 'Sony FX3 Full-Frame Cinema Camera', 'sony', '1150000.00', 'A professional full-frame cinema camera.', 3, 'sony-fx3.jpg'),
(5, 'Sony FX6 Full-Frame Cinema Camera (Body Only)', 'sony', '1799500.00', 'A high-end full-frame cinema camera.', 2, 'sony-fx6.jpg'),
(6, 'Canon EOS R Mirrorless Digital Camera', 'canon camera', '512500.00', 'A powerful full-frame mirrorless camera.', 4, 'canon_EOS-R.jpg'),
(7, 'Nikon Z5 Mirrorless Camera', 'nikon', '359999.00', 'A compact and lightweight mirrorless camera.', 6, 'nikon-z5-mirrorless.jpg'),
(8, 'Canon EOS M200 Mirrorless Digital Camera with 15-45mm Lens', 'canon camera', '172000.00', 'A compact and lightweight mirrorless camera.', 8, 'canon_m200.jpg'),
(9, 'Sony a6700 Mirrorless Camera', 'sony', '469500.00', 'A versatile and powerful mirrorless camera.', 5, 'sony-a6700.jpg'),
(10, 'Nikon Z 5 Mirrorless Digital Camera with Nikon FTZ Mount Adapter', 'nikon', '329500.00', 'A versatile and affordable mirrorless camera.', 4, 'nikon-z5.jpg'),
(11, 'Sony a6700 Mirrorless Camera with 16-50mm Lens', 'sony', '515500.00', 'A powerful and versatile mirrorless camera.', 3, 'sony-a6700-lens.jpg'),
(12, 'Nikon Z 6II Mirrorless Digital Camera Body Only', 'nikon', '499000.00', 'A high-performance mirrorless camera.', 6, 'nikon-z6-2.jpg'),
(13, 'Canon EOS R3 Mirrorless Camera', 'canon', '1649500.00', 'A high-end full-frame mirrorless camera.', 2, 'canon-eos-r3.jpg'),
(14, 'Canon EOS R5 Mirrorless Digital Camera', 'canon', '979500.00', 'A versatile and high-resolution mirrorless camera.', 3, 'canon-eos-r5.jpg'),
(15, 'Sony a7CR Mirrorless Camera', 'sony', '969500.00', 'A compact and powerful mirrorless camera.', 4, 'sony-a7cr.jpg'),
(16, 'Sony Alpha a7R IV Mirrorless Digital Camera (Body Only)', 'sony', '929500.00', 'A high-resolution full-frame mirrorless camera.', 2, 'sony-a7r-4.jpg'),
(17, 'Nikon Z 6 Mirrorless Digital Camera Body with Adapter', 'nikon', '345500.00', 'A versatile and powerful mirrorless camera.', 5, 'nikon-z6.jpg'),
(18, 'Nikon Z 6 Mirrorless Digital Camera with 24-70mm Lens', 'nikon', '510000.00', 'A powerful and versatile mirrorless camera.', 4, 'nikon-z6-lens.jpg'),
(19, 'Canon EOS R8 Mirrorless Camera', 'canon', '445500.00', 'A compact and high-performance mirrorless camera.', 3, 'canon-eos-r8-.jpg'),
(20, 'Nikon Z 7II Mirrorless Digital Camera Body Only', 'nikon', '749000.00', 'A high-end full-frame mirrorless camera.', 2, 'nikon-z7-2.jpg'),
(21, 'Canon EOS M200 Mirrorless Digital Camera with 15-45mm Lens', 'sony', '599500.00', 'A compact and versatile mirrorless camera.', 3, 'sony-a7c.jpg'),
(22, 'Sony Alpha a1 Mirrorless Digital Camera (Body Only)', 'sony', '2250000.00', 'A high-end full-frame mirrorless camera.', 1, 'sony-alpha.jpg'),
(23, 'Nikon Z9 Mirrorless Camera (Body Only)', 'nikon', '1639500.00', 'A high-end professional mirrorless camera.', 2, 'nikon-z9.jpg'),
(24, 'Sony ZV-E1 Mirrorless Camera with 28-60mm Lens', 'sony', '839000.00', 'A compact and versatile mirrorless camera.', 4, 'sony-zv.jpg'),
(25, 'Sony a7C II Mirrorless Camera', 'sony', '699500.00', 'A compact and powerful mirrorless camera.', 3, 'sony-a7c-2.jpg'),
(26, 'Sony a7R V Mirrorless Camera', 'sony', '900000.00', 'A high-resolution full-frame mirrorless camera.', 2, 'sony-a7r-5.jpg'),
(27, 'Nikon Z8 Mirrorless Camera with FTZ II Mount Adapter', 'nikon', '1129000.00', 'A high-end full-frame mirrorless camera.', 2, 'nikon-z8.jpg'),
(28, 'Nikon Z50 Mirrorless Camera', 'nikon', '229500.00', 'A compact and versatile mirrorless camera.', 4, 'nikon-z50.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shop_order`
--

CREATE TABLE `shop_order` (
  `order_id` int(11) NOT NULL,
  `customer_username` varchar(255) DEFAULT NULL,
  `product_ids` varchar(255) DEFAULT NULL,
  `product_quantities` varchar(255) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `cvc` varchar(3) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `name_on_card` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_order`
--

INSERT INTO `shop_order` (`order_id`, `customer_username`, `product_ids`, `product_quantities`, `total_price`, `email`, `card_number`, `cvc`, `payment_method`, `name_on_card`, `billing_address`, `city`, `postal_code`, `order_date`, `status`) VALUES
(1, 'johnsmith', '1,2', '2,1', '150.00', 'johnsmith@example.com', '4111111111111111', '123', 'Credit Card', 'John Smith', '123 Elm Street', 'Metropolis', '12345', '2024-01-14 18:30:00', 'Completed'),
(2, 'janedoe', '2,3', '1,3', '200.00', 'janedoe@example.com', '4111111111111111', '123', 'Credit Card', 'Jane Doe', '456 Oak Avenue', 'Gotham', '54321', '2024-02-19 18:30:00', 'Completed'),
(3, 'alicejohnson', '1', '5', '250000.00', 'alicejohnson@example.com', '4111111111111111', '123', 'Credit Card', 'Alice Johnson', '789 Pine Lane', 'Star City', '67890', '2024-03-09 18:30:00', 'Completed'),
(4, 'bobbrown', '3,4', '2,1', '180.00', 'bobbrown@example.com', '4111111111111111', '123', 'Credit Card', 'Bob Brown', '321 Maple Road', 'Central City', '09876', '2024-04-24 18:30:00', 'Completed'),
(5, 'charliedavis', '2', '3', '120.00', 'charliedavis@example.com', '4111111111111111', '123', 'Credit Card', 'Charlie Davis', '654 Birch Boulevard', 'Coast City', '56789', '2024-05-29 18:30:00', 'Completed'),
(6, 'johnsmith', '1,4', '1,2', '170.00', 'johnsmith@example.com', '4111111111111111', '123', 'Credit Card', 'John Smith', '123 Elm Street', 'Metropolis', '12345', '2024-06-04 18:30:00', 'Pending'),
(7, 'janedoe', '3', '2', '110.00', 'janedoe@example.com', '4111111111111111', '123', 'Credit Card', 'Jane Doe', '456 Oak Avenue', 'Gotham', '54321', '2024-06-09 18:30:00', 'Pending'),
(22, 'dev', '4,3,1', '{\"1\":1,\"3\":\"1\",\"4\":\"1\"}', '1894000.00', 'ffff', 'fff', 'fff', 'card', 'fff', 'Central City', 'Central City', 'fffffffffffffffff', '2024-06-11 14:41:22', 'Pending'),
(23, 'dev', '1,2,7', '{\"1\":\"1\",\"2\":\"1\",\"7\":1}', '1263999.00', 'frfr', 'rfrf', 'rff', 'card', 'rfrf', 'Central City', 'Central City', 'rfrf', '2024-06-11 14:55:58', 'Pending'),
(24, 'dila', '2,3,4,8', '{\"2\":\"4\",\"3\":\"3\",\"4\":\"1\",\"8\":1}', '5458500.00', 'qqqqqqqqqq', 'qqqqqqqqqq', 'qqq', 'card', 'qqqqqqqqqqqq', 'Central City', 'Central City', 'qqqqqqqqqqqqqqq', '2024-06-11 16:31:48', 'Completed'),
(25, 'dila', '3,4,8', '{\"3\":\"2\",\"4\":\"3\",\"8\":1}', '4621000.00', 'ffrfrr', 'rfrfrf', 'frr', 'card', 'rfrfrf', 'Central City', 'Central City', 'rfrffr', '2024-06-11 16:40:14', 'Pending'),
(28, 'dila', '3,4', '{\"3\":\"1\",\"4\":\"1\"}', '7500.00', 'frfrfrfr', '111111111', '111', 'card', 'rrrgr', 'Central City', 'Central City', '11111111111111', '2024-06-13 18:14:44', 'Pending'),
(32, 'dila', '2,3', '{\"2\":\"1\",\"3\":\"1\"}', '7500.00', 'ff', 'ff', 'ff', 'card', 'ff', 'Central City', 'Central City', 'ff', '2024-06-13 18:32:22', 'Pending'),
(33, 'john_doe', '1,2', '1,1', '904000.00', 'john.doe@example.com', '1234567812345678', '123', 'Credit Card', 'John Doe', '123 Maple Street', 'Springfield', '12345', '2024-01-14 18:30:00', 'Completed'),
(34, 'jane_smith', '3,4', '1,1', '1649500.00', 'jane.smith@example.com', '2345678923456789', '234', 'Credit Card', 'Jane Smith', '456 Oak Avenue', 'Springfield', '23456', '2024-02-09 18:30:00', 'Completed'),
(35, 'alicejohnson', '5,6', '1,1', '2312000.00', 'alice.j@example.com', '3456789034567890', '345', 'Credit Card', 'Alice Johnson', '789 Pine Road', 'Springfield', '34567', '2024-03-04 18:30:00', 'Completed'),
(36, 'bob_b', '7,8', '1,1', '531999.00', 'bob.b@example.com', '4567890145678901', '456', 'Credit Card', 'Bob Brown', '101 Birch Lane', 'Springfield', '45678', '2024-04-19 18:30:00', 'Completed'),
(37, 'carol_w', '9,10', '1,1', '799000.00', 'carol.w@example.com', '5678901256789012', '567', 'Credit Card', 'Carol White', '234 Cedar Street', 'Springfield', '56789', '2024-05-14 18:30:00', 'Completed'),
(38, 'david_b', '11,12', '1,1', '1014500.00', 'david.b@example.com', '6789012367890123', '678', 'Credit Card', 'David Black', '567 Elm Avenue', 'Springfield', '67890', '2024-05-31 18:30:00', 'Pending'),
(39, 'eve_a', '13,14', '1,1', '2629000.00', 'eve.a@example.com', '7890123478901234', '789', 'Credit Card', 'Eve Adams', '890 Fir Road', 'Springfield', '78901', '2024-06-01 18:30:00', 'Pending'),
(40, 'frank_g', '15,16', '1,1', '1899500.00', 'frank.g@example.com', '8901234589012345', '890', 'Credit Card', 'Frank Green', '111 Ash Lane', 'Springfield', '89012', '2024-06-02 18:30:00', 'Pending'),
(41, 'grace_l', '17,18', '1,1', '855500.00', 'grace.l@example.com', '9012345690123456', '901', 'Credit Card', 'Grace Lee', '222 Poplar Street', 'Springfield', '90123', '2024-06-03 18:30:00', 'Pending'),
(42, 'henry_m', '19,20', '1,1', '2195000.00', 'henry.m@example.com', '0123456701234567', '012', 'Credit Card', 'Henry Moore', '333 Willow Avenue', 'Springfield', '01234', '2024-06-04 18:30:00', 'Pending'),
(43, 'john_doe', '21,22', '1,1', '2849500.00', 'john.doe@example.com', '1234567812345678', '123', 'Credit Card', 'John Doe', '123 Maple Street', 'Springfield', '12345', '2024-01-19 18:30:00', 'Completed'),
(44, 'jane_smith', '23,24', '1,1', '2478500.00', 'jane.smith@example.com', '2345678923456789', '234', 'Credit Card', 'Jane Smith', '456 Oak Avenue', 'Springfield', '23456', '2024-02-14 18:30:00', 'Completed'),
(45, 'alicejohnson', '25,26', '1,1', '1599500.00', 'alice.j@example.com', '3456789034567890', '345', 'Credit Card', 'Alice Johnson', '789 Pine Road', 'Springfield', '34567', '2024-03-09 18:30:00', 'Completed'),
(46, 'bob_b', '27,28', '1,1', '1368500.00', 'bob.b@example.com', '4567890145678901', '456', 'Credit Card', 'Bob Brown', '101 Birch Lane', 'Springfield', '45678', '2024-04-24 18:30:00', 'Completed'),
(47, 'carol_w', '1,2', '1,1', '904000.00', 'carol.w@example.com', '5678901256789012', '567', 'Credit Card', 'Carol White', '234 Cedar Street', 'Springfield', '56789', '2024-05-19 18:30:00', 'Completed'),
(48, 'david_b', '3,4', '1,1', '1649500.00', 'david.b@example.com', '6789012367890123', '678', 'Credit Card', 'David Black', '567 Elm Avenue', 'Springfield', '67890', '2024-06-05 18:30:00', 'Pending'),
(49, 'eve_a', '5,6', '1,1', '2312000.00', 'eve.a@example.com', '7890123478901234', '789', 'Credit Card', 'Eve Adams', '890 Fir Road', 'Springfield', '78901', '2024-06-06 18:30:00', 'Pending'),
(50, 'frank_g', '7,8', '1,1', '531999.00', 'frank.g@example.com', '8901234589012345', '890', 'Credit Card', 'Frank Green', '111 Ash Lane', 'Springfield', '89012', '2024-06-07 18:30:00', 'Pending'),
(51, 'grace_l', '9,10', '1,1', '799000.00', 'grace.l@example.com', '9012345690123456', '901', 'Credit Card', 'Grace Lee', '222 Poplar Street', 'Springfield', '90123', '2024-06-08 18:30:00', 'Pending'),
(52, 'henry_m', '11,12', '1,1', '1014500.00', 'henry.m@example.com', '0123456701234567', '012', 'Credit Card', 'Henry Moore', '333 Willow Avenue', 'Springfield', '01234', '2024-06-09 18:30:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `sublimations`
--

CREATE TABLE `sublimations` (
  `sublimation_number` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sublimations`
--

INSERT INTO `sublimations` (`sublimation_number`, `size`, `price`) VALUES
(1, 'Small', '200.00'),
(2, 'Medium', '400.00'),
(3, 'Large', '600.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `booking_identity`
--
ALTER TABLE `booking_identity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_studio_outdoor`
--
ALTER TABLE `booking_studio_outdoor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_wedding`
--
ALTER TABLE `booking_wedding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_username` (`customer_username`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `employeelog`
--
ALTER TABLE `employeelog`
  ADD PRIMARY KEY (`Full_Name`);

--
-- Indexes for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD PRIMARY KEY (`Attendance_ID`),
  ADD KEY `Employee_Full_Name` (`Employee_Full_Name`);

--
-- Indexes for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  ADD PRIMARY KEY (`Leave_ID`),
  ADD KEY `Employee_Full_Name` (`Employee_Full_Name`);

--
-- Indexes for table `employee_messages`
--
ALTER TABLE `employee_messages`
  ADD PRIMARY KEY (`Message_ID`),
  ADD KEY `Employee_Full_Name` (`Employee_Full_Name`);

--
-- Indexes for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD PRIMARY KEY (`Salary_ID`),
  ADD KEY `Employee_Full_Name` (`Employee_Full_Name`);

--
-- Indexes for table `employee_tasks`
--
ALTER TABLE `employee_tasks`
  ADD PRIMARY KEY (`Task_ID`),
  ADD KEY `Employee_Full_Name` (`Employee_Full_Name`);

--
-- Indexes for table `estimate_bill`
--
ALTER TABLE `estimate_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frames`
--
ALTER TABLE `frames`
  ADD PRIMARY KEY (`frame_number`);

--
-- Indexes for table `frame_sublimation`
--
ALTER TABLE `frame_sublimation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frame_number` (`frame_number`),
  ADD KEY `sublimation_number` (`sublimation_number`);

--
-- Indexes for table `identification_photography`
--
ALTER TABLE `identification_photography`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent_items`
--
ALTER TABLE `rent_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `rent_order`
--
ALTER TABLE `rent_order`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `customer_username` (`customer_username`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `shop_filter`
--
ALTER TABLE `shop_filter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_order`
--
ALTER TABLE `shop_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_username` (`customer_username`);

--
-- Indexes for table `sublimations`
--
ALTER TABLE `sublimations`
  ADD PRIMARY KEY (`sublimation_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `booking_identity`
--
ALTER TABLE `booking_identity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `booking_studio_outdoor`
--
ALTER TABLE `booking_studio_outdoor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `booking_wedding`
--
ALTER TABLE `booking_wedding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `Attendance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  MODIFY `Leave_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `employee_messages`
--
ALTER TABLE `employee_messages`
  MODIFY `Message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_salary`
--
ALTER TABLE `employee_salary`
  MODIFY `Salary_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `employee_tasks`
--
ALTER TABLE `employee_tasks`
  MODIFY `Task_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `estimate_bill`
--
ALTER TABLE `estimate_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `frames`
--
ALTER TABLE `frames`
  MODIFY `frame_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `frame_sublimation`
--
ALTER TABLE `frame_sublimation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `identification_photography`
--
ALTER TABLE `identification_photography`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rent_items`
--
ALTER TABLE `rent_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rent_order`
--
ALTER TABLE `rent_order`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `shop_filter`
--
ALTER TABLE `shop_filter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `shop_order`
--
ALTER TABLE `shop_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `sublimations`
--
ALTER TABLE `sublimations`
  MODIFY `sublimation_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`Username`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `shop_filter` (`id`);

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_us_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customer` (`Username`) ON DELETE CASCADE;

--
-- Constraints for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD CONSTRAINT `employee_attendance_ibfk_1` FOREIGN KEY (`Employee_Full_Name`) REFERENCES `employeelog` (`Full_Name`);

--
-- Constraints for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  ADD CONSTRAINT `employee_leaves_ibfk_1` FOREIGN KEY (`Employee_Full_Name`) REFERENCES `employeelog` (`Full_Name`);

--
-- Constraints for table `employee_messages`
--
ALTER TABLE `employee_messages`
  ADD CONSTRAINT `employee_messages_ibfk_1` FOREIGN KEY (`Employee_Full_Name`) REFERENCES `employeelog` (`Full_Name`);

--
-- Constraints for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD CONSTRAINT `employee_salary_ibfk_1` FOREIGN KEY (`Employee_Full_Name`) REFERENCES `employeelog` (`Full_Name`);

--
-- Constraints for table `employee_tasks`
--
ALTER TABLE `employee_tasks`
  ADD CONSTRAINT `employee_tasks_ibfk_1` FOREIGN KEY (`Employee_Full_Name`) REFERENCES `employeelog` (`Full_Name`);

--
-- Constraints for table `frame_sublimation`
--
ALTER TABLE `frame_sublimation`
  ADD CONSTRAINT `frame_sublimation_ibfk_1` FOREIGN KEY (`frame_number`) REFERENCES `frames` (`frame_number`),
  ADD CONSTRAINT `frame_sublimation_ibfk_2` FOREIGN KEY (`sublimation_number`) REFERENCES `sublimations` (`sublimation_number`);

--
-- Constraints for table `rent_order`
--
ALTER TABLE `rent_order`
  ADD CONSTRAINT `rent_order_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customer` (`Username`),
  ADD CONSTRAINT `rent_order_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `rent_items` (`item_id`);

--
-- Constraints for table `shop_order`
--
ALTER TABLE `shop_order`
  ADD CONSTRAINT `shop_order_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customer` (`Username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
