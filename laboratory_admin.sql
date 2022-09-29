-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2022 at 05:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laboratory_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis`
--

CREATE TABLE `analysis` (
  `id_analysis` int(11) NOT NULL,
  `name_analysis` varchar(255) NOT NULL,
  `standart_price` int(11) NOT NULL,
  `coa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analysis`
--

INSERT INTO `analysis` (`id_analysis`, `name_analysis`, `standart_price`, `coa`) VALUES
(2, 'Illumination', 1500000, 1),
(3, 'Odor', 2000000, 1),
(4, 'Heat Stress', 1000000, 0),
(5, 'Vibration', 1300000, 1),
(6, 'Wastewater', 2300000, 1),
(7, 'Non-Stationary Source Emission', 2500000, 1),
(8, 'Stationary Stack Source Emission', 800000, 1),
(9, 'Noise', 500000, 1),
(10, 'Workplace Air Quality', 4500000, 1),
(11, 'Ambient Outdoor Air Quality', 3200000, 1),
(12, 'Surface Water', 300000, 1),
(13, 'Clean Water', 450000, 1),
(14, 'Transportation', 200000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assign_sampler`
--

CREATE TABLE `assign_sampler` (
  `id_sample` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `id_coa` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `params` varchar(255) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `reg_standart_1` double NOT NULL,
  `reg_standart_2` double DEFAULT NULL,
  `reg_standart_3` double DEFAULT NULL,
  `reg_standart_4` double DEFAULT NULL,
  `method` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`id_coa`, `id_analysis`, `params`, `unit`, `reg_standart_1`, `reg_standart_2`, `reg_standart_3`, `reg_standart_4`, `method`) VALUES
(12, 12, 'Nitrogen Dioxide (NO2)', '°C', 1000, 1400, 300, 500, 2);

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `id_int` int(11) NOT NULL,
  `name_int` varchar(255) NOT NULL,
  `int_phone` varchar(255) NOT NULL,
  `int_email` varchar(255) NOT NULL,
  `int_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id_int`, `name_int`, `int_phone`, `int_email`, `int_address`) VALUES
(3, 'PT. Matsuoka Industries Indonesia', '08967832', 'rosaria@gmail.com', 'Jl. Kali Sumber KM 117 RT 16 RW 05, Desa Ciberes, Kecamatan Patokbesi, Kabupaten Subang, Jawa Barat'),
(4, 'PT. Jgu merdeka', '087632121', 'jgu@jgu.ac.id', 'JL Pegangsaan Timur'),
(5, 'PT. Nusanatara Indah', '081385321716', 'nusantara26@gmail.com', 'JL Marzuki barat'),
(6, 'PT.Jaya indonesia', '08137569956', 'Jayaind17@gmail.com', 'JL Penus raya'),
(7, 'PT. Betafish rizki', '08567641801', 'betafishrizq@gmail.com', 'Jl Mandor Sanun'),
(8, 'PT. Oasis Bogor', '081376838901', 'oasisbogor@gmail.com', 'Jl Lipi selatan'),
(9, 'PT. Jali Indonesia Utama', '0856956371', 'Jaliindonesia23@gmail.com', 'Jl Topaz nasution'),
(10, 'PT. Kingbarba', '083819588819', 'kingbarbar@gmail.com', 'Jl. H,ahmad dahlan'),
(11, 'PT. Lentera Jiwa Project', '08858183202', 'Lenterajiwa@gmail.com', 'Jl. Pesat raya no 25 bogor'),
(12, 'PT. Big mouse korean', '0858939312', 'bigmousek@gmail.com', 'Jl. Kemang 2 jakarta barat'),
(13, 'PT. Zikna Soft', '8564789651', 'azkazikna.aal@gmail.com', 'Blablablabalba Bogor');

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `id_method` int(11) NOT NULL,
  `name_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `method`
--

INSERT INTO `method` (`id_method`, `name_method`) VALUES
(2, 'SNI 06-6989.23-2005'),
(3, 'SNI 6989.27:2019'),
(4, 'SNI 6989.3:2019'),
(5, 'SNI 6989.11:2019'),
(6, 'SM 23rd 3210B - 2017'),
(7, 'SNI 6989.71:2009'),
(8, 'Atomic Fluorescence Spectrophotometry'),
(9, 'SNI 6989.77:2011'),
(10, 'SNI 06-6989.29-2005'),
(11, 'APHA 23rd-4500 2017'),
(12, 'SNI 06-6989.30-2005'),
(13, 'SNI 6989.79:2011'),
(14, 'SNI 06-6989.9-2004'),
(15, 'SNI 6989.72:2009'),
(16, 'SNI 6989.2:2019'),
(17, 'SNI 06-6989.51-2005'),
(18, 'SNI 06-6989.21-2004'),
(19, 'SNI 6989.10:2011'),
(20, 'SM 23rd 9221B-2017');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id_quotation` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `spec` text NOT NULL,
  `qty` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `add_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id_quotation`, `id_analysis`, `id_int`, `remarks`, `spec`, `qty`, `id_sk`, `add_price`) VALUES
(8, 2, 4, '<p>asd12</p>', '<p>asdasd</p>', 12, 4, 12312312),
(10, 14, 4, '<p>dsfsd</p>', '<p>sdfsd</p>', 12, 4, 12312),
(11, 12, 9, '<p>fdsdfsd</p>', '<p>sfddsfds</p>', 12, 5, 1423432),
(13, 2, 12, '<p>123432</p>', '<p>32432</p>', 123123, 6, 234234),
(14, 14, 12, '<p>weewrwe</p>', '<p>ewrwer</p>', 12, 6, 12421423),
(15, 14, 3, '<p>Transportasi dan akomodasi sampling (Lokasi SUBANG, Jawa Barat)</p>', '<p>Paket, 2 Teknisi</p>', 1, 2, 50000),
(16, 11, 3, '<p>Pemantauan Kualitas Udara Ambient Outdoor untuk Area:</p><ul><li>Area Upwind</li><li>Area Down wind</li></ul>', '<p>Lampiran VII Peraturan Pemerintah No. 22 Tahun 2021</p><p><b>Sesaat: </b>SO2, CO, NO2, O3, HC, TSP, Pb</p>', 2, 2, 100000),
(17, 9, 3, '<p>Udara Kualitas Kebisingan (Noise) Ambient Sesaat</p><ul><li>Area Upwind</li><li>Area Down wind</li></ul>', '<p>Keputusan Menteri Negara Lingkungan Hidup KEP-48/MENLH/11/1996</p>', 2, 2, 20000),
(18, 10, 3, '<p>Pemantauan Kualitas Udara Kerja Produksi</p><ul><li>Ruang Produksi</li></ul>', '<p>Permenaker No. 5 Tahun 2018</p><p>CO, NO2, SO2, TSP, NOISE</p>', 1, 2, 10000),
(19, 6, 3, '<p>Pemantauan Kualitas Air Limbah</p><ul><li>Biotank</li></ul>', '<p>Permenlhk No. P.68/Menlhk/Setjen/Kum.1/8/2016</p>', 1, 2, 50000),
(20, 7, 3, '<p>Pemantauan Kualitas Emisi Sumber Tidak Bergerak:</p><ul><li>Cerobong Boiler 1</li><li>Cerobong Boiler 2</li></ul>', '<p>Permenlhk No. P.15/MENLHK/SETJEN/KUM.1/4/2019 tentang Baku Mutu Emisi Pembangkit Listrik Tenaga Termal <b>(NON ISOKINETIK)</b></p><p>Total Partikulat, SO2, NO2, CO</p>', 2, 2, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `result_coa`
--

CREATE TABLE `result_coa` (
  `id_coa` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `result` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id_sample` int(11) NOT NULL,
  `name_sample` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sampler`
--

CREATE TABLE `sampler` (
  `id_sampler` int(11) NOT NULL,
  `name_smp` varchar(255) NOT NULL,
  `gender_smp` tinyint(1) NOT NULL,
  `phone_smp` varchar(255) NOT NULL,
  `email_smp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sampler`
--

INSERT INTO `sampler` (`id_sampler`, `name_smp`, `gender_smp`, `phone_smp`, `email_smp`) VALUES
(1, 'Azkazikna Ageung Laksana', 1, '081314697305', 'azkazikna.aal@gmail.com'),
(2, 'Muhammad Raihan Alfaiz', 1, '081210805647', 'raihan.aal@gmail.com'),
(7, 'Akbar Maulana Febriansyah', 1, '0856973256', 'akbar@gmail.com'),
(8, 'Rezha Ikhwan Hidayat', 1, '054586325975', 'rezha@gmail.com'),
(9, 'Ananda Rizq', 1, '084569785236', 'nanda@gmail.com'),
(10, 'Atiyah Ummi Sholihat', 0, '085647521245', 'atiyah@gmail.com'),
(11, 'Deviyanti Kusumawati', 0, '085645857584', 'devi@gmail.com'),
(12, 'Pramdhanni Dwi Putra Bintang', 1, '085698741236', 'pramgebleg@gmail.com'),
(13, 'Annaufal Arifa Nasution Hidayatullah', 1, '083698755485', 'annaufal60@gmail.com'),
(14, 'Shevy Octavian', 1, '081210805647', 'shevygaming@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sampling_det`
--

CREATE TABLE `sampling_det` (
  `id_sk` int(11) NOT NULL,
  `id_sample` int(11) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sk_number`
--

CREATE TABLE `sk_number` (
  `id_sk` int(11) NOT NULL,
  `sk_quotation` varchar(255) NOT NULL,
  `sk_sample` varchar(255) NOT NULL,
  `sk_analysis` varchar(255) NOT NULL,
  `id_int` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_number`
--

INSERT INTO `sk_number` (`id_sk`, `sk_quotation`, `sk_sample`, `sk_analysis`, `id_int`) VALUES
(2, '1/2022/27/DIL/QTN', '', '', 3),
(4, '3/2022/27/DIL/QTN', '', '', 4),
(5, '5/2022/27/DIL/QTN', '', '', 9),
(6, '6/2022/27/DIL/QTN', '', '', 12),
(7, '7/2022/29/DIL/QTN', '', '', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis`
--
ALTER TABLE `analysis`
  ADD PRIMARY KEY (`id_analysis`);

--
-- Indexes for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
  ADD KEY `id_sample` (`id_sample`),
  ADD KEY `id_sk` (`id_sk`);

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`id_coa`),
  ADD KEY `id_analysis` (`id_analysis`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`id_int`);

--
-- Indexes for table `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id_method`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`id_quotation`),
  ADD KEY `id_int` (`id_int`),
  ADD KEY `id_analysis` (`id_analysis`);

--
-- Indexes for table `result_coa`
--
ALTER TABLE `result_coa`
  ADD KEY `id_coa` (`id_coa`),
  ADD KEY `id_analysis` (`id_analysis`),
  ADD KEY `id_int` (`id_int`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
  ADD PRIMARY KEY (`id_sample`);

--
-- Indexes for table `sampler`
--
ALTER TABLE `sampler`
  ADD PRIMARY KEY (`id_sampler`);

--
-- Indexes for table `sampling_det`
--
ALTER TABLE `sampling_det`
  ADD KEY `id_sk` (`id_sk`),
  ADD KEY `id_sample` (`id_sample`);

--
-- Indexes for table `sk_number`
--
ALTER TABLE `sk_number`
  ADD PRIMARY KEY (`id_sk`),
  ADD KEY `id_int` (`id_int`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `coa`
--
ALTER TABLE `coa`
  MODIFY `id_coa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `id_int` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `method`
--
ALTER TABLE `method`
  MODIFY `id_method` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id_quotation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id_sample` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sampler`
--
ALTER TABLE `sampler`
  MODIFY `id_sampler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sk_number`
--
ALTER TABLE `sk_number`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
  ADD CONSTRAINT `assign_sampler_ibfk_1` FOREIGN KEY (`id_sample`) REFERENCES `sampler` (`id_sampler`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assign_sampler_ibfk_2` FOREIGN KEY (`id_sk`) REFERENCES `sk_number` (`id_sk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coa`
--
ALTER TABLE `coa`
  ADD CONSTRAINT `coa_ibfk_1` FOREIGN KEY (`id_analysis`) REFERENCES `analysis` (`id_analysis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quotation`
--
ALTER TABLE `quotation`
  ADD CONSTRAINT `quotation_ibfk_2` FOREIGN KEY (`id_int`) REFERENCES `institution` (`id_int`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quotation_ibfk_3` FOREIGN KEY (`id_analysis`) REFERENCES `analysis` (`id_analysis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `result_coa`
--
ALTER TABLE `result_coa`
  ADD CONSTRAINT `result_coa_ibfk_2` FOREIGN KEY (`id_coa`) REFERENCES `coa` (`id_coa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_coa_ibfk_3` FOREIGN KEY (`id_analysis`) REFERENCES `quotation` (`id_analysis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_coa_ibfk_4` FOREIGN KEY (`id_int`) REFERENCES `quotation` (`id_int`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sampling_det`
--
ALTER TABLE `sampling_det`
  ADD CONSTRAINT `sampling_det_ibfk_1` FOREIGN KEY (`id_sample`) REFERENCES `sample` (`id_sample`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sampling_det_ibfk_2` FOREIGN KEY (`id_sk`) REFERENCES `sk_number` (`id_sk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sk_number`
--
ALTER TABLE `sk_number`
  ADD CONSTRAINT `sk_number_ibfk_1` FOREIGN KEY (`id_int`) REFERENCES `institution` (`id_int`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
