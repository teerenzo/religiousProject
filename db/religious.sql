-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2021 at 12:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `religious`
--

-- --------------------------------------------------------

--
-- Table structure for table `basic_churches`
--

CREATE TABLE `basic_churches` (
  `id` int(123) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sucursal_id` int(123) NOT NULL,
  `central_id` int(123) NOT NULL,
  `parish_id` int(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `basic_churches`
--

INSERT INTO `basic_churches` (`id`, `name`, `sucursal_id`, `central_id`, `parish_id`) VALUES
(1, 'akabatare', 0, 0, 0),
(2, 'akabatare', 0, 0, 0),
(3, 'akabutare2', 1, 0, 0),
(4, 'umurava', 2, 0, 0),
(5, 'K16 Kabaya', 0, 5, 2),
(6, 'K22 Kururembo', 2, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `believers`
--

CREATE TABLE `believers` (
  `believer_ID` int(123) NOT NULL,
  `fname` varchar(123) NOT NULL,
  `lname` varchar(123) NOT NULL,
  `father` varchar(255) NOT NULL,
  `mother` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `date_of_birth` varchar(123) NOT NULL,
  `email` varchar(123) NOT NULL,
  `tel` varchar(123) NOT NULL,
  `central_name` varchar(123) NOT NULL,
  `sucursal_name` varchar(123) NOT NULL,
  `basic_name` varchar(123) NOT NULL,
  `parish_id` int(123) NOT NULL,
  `log_id` int(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `believers`
--

INSERT INTO `believers` (`believer_ID`, `fname`, `lname`, `father`, `mother`, `id_number`, `date_of_birth`, `email`, `tel`, `central_name`, `sucursal_name`, `basic_name`, `parish_id`, `log_id`) VALUES
(2, 'kalisa', 'juma', '', '', '1234765476547654', '0101-01-01', 'niyontegedison@gmail.com', '0780640237', '', '', '', 1, 41711),
(3, 'carine', 'mwizerwa', 'Sibomana Andre', 'Mujawimana Rosine', '1234765432245678', '1999-01-01', 'renzahoemmanuel8@gmail.com', '0780640237', '', 'kibaza', 'ikigarama', 2, 30196),
(4, 'Jean', 'renzoteee', '', '', '2147483647786788', '1999-11-11', 'vivens.byiringiro@gmail.com', '0786772000', '', '', '', 3, 68236),
(6, 'Vivens', 'Byiringiro', 'S. MUSENGIMANA', 'Speciose MUHAWENIMANA', '1234567865432123', '2021-02-23', 'vivens.byiringiro77@gmail.com', '0786772668', 'Kigarama', 'None', 'K16 Kabaya', 2, 97413),
(7, 'kalisa', 'tee', 'Selverie MUSENGIMANA', 'S. MUHAWENIMANA', '5432765432654325', '2000-01-01', 'eskigarama@yahoo.com', '0788281906', 'Kigarama', 'None', 'K22 Kururembo', 2, 39468),
(8, 'Isabella', 'Smith', 'Lawson Smith', 'Linda Marieta', '1234567865432123', '2021-02-23', 'lindamarie@gmail.com', '0786772668', 'Kigarama', 'None', 'K16 Kabaya', 2, 17690);

-- --------------------------------------------------------

--
-- Table structure for table `centrals`
--

CREATE TABLE `centrals` (
  `id` int(123) NOT NULL,
  `parish_id` int(123) NOT NULL,
  `central_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `centrals`
--

INSERT INTO `centrals` (`id`, `parish_id`, `central_name`, `email`, `phone`) VALUES
(1, 1, 'kacyiru', 'renzo@gmail.com', '0780640237'),
(5, 2, 'Kigarama', 'kigaramacathol@yahoo.fr', '0788281906');

-- --------------------------------------------------------

--
-- Table structure for table `diocese`
--

CREATE TABLE `diocese` (
  `id` int(123) NOT NULL,
  `diocese_name` varchar(123) NOT NULL,
  `short_descriptions` varchar(123) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT 'systemtest@example.com',
  `phone` varchar(50) NOT NULL DEFAULT '+250788800090'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diocese`
--

INSERT INTO `diocese` (`id`, `diocese_name`, `short_descriptions`, `email`, `phone`) VALUES
(2, 'Kigali', '', 'kigali@net.com', '0780640237'),
(3, 'Byumba', '', 'byumba@gmailcom', '0786772000');

-- --------------------------------------------------------

--
-- Table structure for table `marriage`
--

CREATE TABLE `marriage` (
  `id` int(123) NOT NULL,
  `partner_1_ID` int(123) NOT NULL,
  `partner_2_ID` int(123) NOT NULL,
  `parish_id` int(123) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marriage`
--

INSERT INTO `marriage` (`id`, `partner_1_ID`, `partner_2_ID`, `parish_id`, `date`) VALUES
(2, 30196, 97413, 2, '2021-02-23 14:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `parishes`
--

CREATE TABLE `parishes` (
  `id` int(11) NOT NULL,
  `parish_name` varchar(112) NOT NULL,
  `diocese_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parishes`
--

INSERT INTO `parishes` (`id`, `parish_name`, `diocese_id`, `email`, `phone`) VALUES
(1, 'kacyiru', 1, 'alaintresor35@gmail.com', '0780640237'),
(2, 'kacyiru parish', 2, 'renzahoemmanuel8@gmail.com', '0786772000'),
(3, 'eden huye', 2, 'niyontegedison@gmail.com', '0786772876');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(123) NOT NULL,
  `believer_id` int(123) NOT NULL,
  `service_id` int(132) NOT NULL,
  `paid_date` date NOT NULL,
  `user_id` int(123) NOT NULL,
  `status` varchar(123) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) NOT NULL,
  `paid_amount` int(123) NOT NULL,
  `parish_id` int(123) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `believer_id`, `service_id`, `paid_date`, `user_id`, `status`, `payment_method`, `paid_amount`, `parish_id`) VALUES
(13, 30196, 2, '2021-02-24', 30196, 'paid', '../files/bank_recpt/eucharist30196.pdf', 500, 2),
(14, 30196, 3, '2021-02-24', 30196, 'paid', '../files/bank_recpt/sustenance30196.pdf', 500, 2),
(15, 30196, 1, '2021-02-24', 30196, 'paid', '../files/bank_recpt/sustenance30196.pdf', 500, 2),
(16, 97413, 2, '2021-02-24', 97413, 'paid', '../files/bank_recpt/eucharist9999.pdf', 500, 2),
(17, 97413, 3, '2021-02-24', 97413, 'paid', '../files/bank_recpt/sustenance30196.pdf', 500, 2),
(18, 97413, 1, '2021-02-24', 97413, 'paid', '../files/bank_recpt/sustenance30196.pdf', 500, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sacraments`
--

CREATE TABLE `sacraments` (
  `sacrament_id` int(123) NOT NULL,
  `sacrament_name` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sacraments`
--

INSERT INTO `sacraments` (`sacrament_id`, `sacrament_name`) VALUES
(1, 'Baptism'),
(2, 'Eucharist'),
(3, 'Sustenance'),
(4, 'Marriage');

-- --------------------------------------------------------

--
-- Table structure for table `sacrament_issuing`
--

CREATE TABLE `sacrament_issuing` (
  `id` int(123) NOT NULL,
  `issue` varchar(123) NOT NULL,
  `parish_id` int(123) NOT NULL,
  `believer_id` int(123) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sacrament_issuing`
--

INSERT INTO `sacrament_issuing` (`id`, `issue`, `parish_id`, `believer_id`, `date`) VALUES
(3, 'Eucharist', 1, 30196, '2021-02-20 14:31:04'),
(4, 'Sustenance', 1, 30196, '2021-02-20 14:33:36'),
(5, 'Baptism', 1, 41711, '2021-02-23 09:59:50'),
(6, 'Baptism', 2, 39468, '2021-02-23 10:18:19'),
(7, 'Baptism', 2, 97413, '2021-02-23 10:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `parish_id` int(123) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `payable_amount` int(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `parish_id`, `service_name`, `period`, `type`, `payable_amount`) VALUES
(1, 0, 'baptism', '1month', 'type', 500),
(2, 0, 'eucharist', 'once', 'eucharist', 500),
(3, 0, 'sustenance', '0nce', 'sustenance', 500);

-- --------------------------------------------------------

--
-- Table structure for table `sucursals`
--

CREATE TABLE `sucursals` (
  `id` int(123) NOT NULL,
  `central_id` int(123) NOT NULL,
  `parish_id` int(123) NOT NULL,
  `suc_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sucursals`
--

INSERT INTO `sucursals` (`id`, `central_id`, `parish_id`, `suc_name`, `email`, `phone`) VALUES
(1, 1, 1, 'ubumwe123', 'renzahoemmanuel8@gmail.com', '0780640237'),
(2, 5, 2, 'Mabare', 'vivens.byiringiro77@gmail.com', '0786772668'),
(3, 5, 2, 'Rubona', 'rwamaganam@gmail.com', '0788281906');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(123) NOT NULL,
  `username` varchar(123) NOT NULL,
  `password` varchar(123) NOT NULL,
  `user_type` varchar(123) NOT NULL,
  `user_id` int(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `user_id`) VALUES
(1, 'admin', '123456', 'admin', 0),
(25, '123', '123456', 'diocese', 5),
(26, 'butare123', '123456', 'diocese', 6),
(27, 'kacyiru12', '123456', 'central', 1),
(28, '37934', '123456', 'believer', 1),
(29, '41711', '123456', 'believer', 41711),
(30, '30196', '123456', 'believer', 30196),
(31, 'kacyiru123', '123456', 'parish', 1),
(32, 'kigali123', '123456', 'diocese', 2),
(33, 'byumba123', '123456', 'diocese', 3),
(34, 'kacyiru parish123', '123456', 'parish', 2),
(35, 'eden huye123', '123456', 'parish', 3),
(36, '68236', '123456', 'believer', 4),
(37, 'akabatare123', '123456', 'central', 4),
(38, 'kigarama123', '123456', 'central', 5),
(39, '15047', '123456', 'believer', 15047),
(40, '97413', '123456', 'believer', 97413),
(41, '39468', '123456', 'believer', 39468),
(42, '17690', '123456', 'believer', 17690);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basic_churches`
--
ALTER TABLE `basic_churches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `believers`
--
ALTER TABLE `believers`
  ADD PRIMARY KEY (`believer_ID`);

--
-- Indexes for table `centrals`
--
ALTER TABLE `centrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diocese`
--
ALTER TABLE `diocese`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marriage`
--
ALTER TABLE `marriage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parishes`
--
ALTER TABLE `parishes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sacraments`
--
ALTER TABLE `sacraments`
  ADD PRIMARY KEY (`sacrament_id`);

--
-- Indexes for table `sacrament_issuing`
--
ALTER TABLE `sacrament_issuing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sucursals`
--
ALTER TABLE `sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basic_churches`
--
ALTER TABLE `basic_churches`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `believers`
--
ALTER TABLE `believers`
  MODIFY `believer_ID` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `centrals`
--
ALTER TABLE `centrals`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `diocese`
--
ALTER TABLE `diocese`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marriage`
--
ALTER TABLE `marriage`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parishes`
--
ALTER TABLE `parishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sacraments`
--
ALTER TABLE `sacraments`
  MODIFY `sacrament_id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sacrament_issuing`
--
ALTER TABLE `sacrament_issuing`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sucursals`
--
ALTER TABLE `sucursals`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
