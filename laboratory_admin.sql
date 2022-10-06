-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2022 at 03:09 PM
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
  `coa` tinyint(1) NOT NULL,
  `template` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analysis`
--

INSERT INTO `analysis` (`id_analysis`, `name_analysis`, `standart_price`, `coa`, `template`) VALUES
(2, 'Illumination', 1500000, 1, NULL),
(3, 'Odor', 2000000, 1, NULL),
(4, 'Heat Stress', 1000000, 0, NULL),
(5, 'Vibration', 1300000, 1, NULL),
(6, 'Wastewater', 2300000, 1, NULL),
(7, 'Non-Stationary Source Emission', 2500000, 1, NULL),
(8, 'Stationary Stack Source Emission', 800000, 1, NULL),
(9, 'Noise', 500000, 1, NULL),
(10, 'Workplace Air Quality', 4500000, 1, NULL),
(11, 'Ambient Outdoor Air Quality', 3200000, 1, NULL),
(12, 'Surface Water', 300000, 1, NULL),
(13, 'Clean Water', 450000, 1, NULL),
(14, 'Transportation', 200000, 0, NULL),
(15, 'Air Emission (Non-Isocinetic)', 100000, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assign_sampler`
--

CREATE TABLE `assign_sampler` (
  `id_assign` int(11) NOT NULL,
  `id_sampler` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `is_sampler` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_sampler`
--

INSERT INTO `assign_sampler` (`id_assign`, `id_sampler`, `id_sk`, `is_sampler`) VALUES
(3, 1, 2, 1),
(4, 12, 2, 1),
(5, 14, 2, 1),
(8, 13, 2, 1),
(9, 11, 2, 0);

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
  `method` int(11) NOT NULL,
  `category_params` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`id_coa`, `id_analysis`, `params`, `unit`, `reg_standart_1`, `reg_standart_2`, `reg_standart_3`, `reg_standart_4`, `method`, `category_params`) VALUES
(18, 13, 'Turbidity', 'NTU', 25, 0, 0, 0, 2, 'Physical'),
(19, 13, 'Color', 'Pt-Co', 50, 0, 0, 0, 6, 'Physical'),
(20, 13, 'Total Dissolve Solids (TDS)', 'mg/L', 1000, 0, 0, 0, 3, 'Physical'),
(21, 13, 'Temperature', '°C', 0, 0, 0, 0, 2, 'Physical'),
(22, 13, 'Iron (Fe)', 'mg/L', 1, 0, 0, 0, 18, 'Chemistry'),
(23, 13, 'Fluoride (F)', 'mg/L', 1.5, 0, 0, 0, 13, 'Chemistry'),
(24, 13, 'Total Hardness (CaCO3)', 'mg/L', 500, 0, 0, 0, 6, 'Chemistry'),
(25, 13, 'Total Coliform', 'CFU/100ml', 50, 0, 0, 0, 20, 'Microbiology'),
(26, 13, 'E-Coliform', 'CFU/100ml', 0, 0, 0, 0, 20, 'Microbiology'),
(27, 15, 'Ammonia (NH3)', 'mg/L', 0.5, 0, 0, 0, 2, 'Physical'),
(28, 15, 'Chlorine (CI2)', 'mg/L', 10, 0, 0, 0, 4, 'Chemistry'),
(29, 15, 'Hydrogen Chloride (HCl)', 'mg/L', 5, 0, 0, 0, 13, 'Chemistry'),
(30, 15, 'Hydrogen Fluoride (HF)', 'mg/L', 10, 0, 0, 0, 13, 'Chemistry'),
(31, 15, 'Nitrogen Dioxide (NO2)', 'mg/L', 1000, 0, 0, 0, 19, 'Chemistry'),
(32, 15, 'Opacity', '%', 30, 0, 0, 0, 18, 'Physical'),
(33, 15, 'Particulate', 'mg/L', 350, 0, 0, 0, 20, 'Chemistry'),
(34, 15, 'Sulfur Dioxide (SO2)*', 'mg/L', 800, 0, 0, 0, 18, 'Physical'),
(35, 15, 'Hydrogen Sulfide (H2S)', 'mg/L', 35, 0, 0, 0, 2, 'Physical'),
(36, 15, 'Mercury (Hg)', 'mg/L', 5, 0, 0, 0, 8, 'Physical'),
(37, 15, 'Arsenic (As)', 'mg/L', 8, 0, 0, 0, 8, 'Physical'),
(38, 15, 'Antimony (Sb)', 'mg/L', 8, 0, 0, 0, 8, 'Physical'),
(39, 15, 'Cadmium (Cd)', 'mg/L', 8, 0, 0, 0, 18, 'Physical'),
(40, 15, 'Zinc (Zn)', 'mg/L', 50, 0, 0, 0, 19, 'Physical'),
(41, 15, 'Lead (Pb)', 'mg/L', 12, 0, 0, 0, 18, 'Physical');

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `id_int` int(11) NOT NULL,
  `name_int` varchar(255) NOT NULL,
  `int_phone` varchar(255) NOT NULL,
  `int_email` varchar(255) NOT NULL,
  `int_address` varchar(255) NOT NULL,
  `name_cp` varchar(255) NOT NULL,
  `title_cp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id_int`, `name_int`, `int_phone`, `int_email`, `int_address`, `name_cp`, `title_cp`) VALUES
(3, 'PT. Matsuoka Industries Indonesia', '08967832', 'rosaria@gmail.com', 'Jl. Kali Sumber KM 117 RT 16 RW 05, Desa Ciberes, Kecamatan Patokbesi, Kabupaten Subang, Jawa Barat', 'Nurtarikasmalini,ST.,M.T', 'Direktur PT. Mentari Prima Karya'),
(4, 'PT. JGU Merdeka', '087632121', 'jgu@jgu.ac.id', 'JL Pegangsaan Timur', '', ''),
(5, 'PT. Nusantara Indah', '081385321716', 'nusantara26@gmail.com', 'JL Marzuki barat', '', ''),
(6, 'PT.Jaya indonesia', '08137569956', 'Jayaind17@gmail.com', 'JL Penus raya', '', ''),
(7, 'PT. Bettafish Indonesia', '8567641801', 'betafishrizq@gmail.com', 'Jl.H.M Jl. Moh. Sanun, RT.03/RW.08, Harapan Jaya, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16914', 'Ananda Rizq', 'CEO of PT. Bettafish Indonesia'),
(8, 'PT. Oasis Bogor', '081376838901', 'oasisbogor@gmail.com', 'Jl Lipi selatan', '', ''),
(9, 'PT. Jali Indonesia Utama', '0856956371', 'Jaliindonesia23@gmail.com', 'Jl Topaz nasution', '', ''),
(10, 'PT. Kingbarbar', '083819588819', 'kingbarbar@gmail.com', 'Jl. H,ahmad dahlan', '', ''),
(11, 'PT. Lentera Jiwa Project', '08858183202', 'Lenterajiwa@gmail.com', 'Jl. Pesat raya no 25 bogor', '', ''),
(12, 'PT. Big Mouse Korean', '0858939312', 'bigmousek@gmail.com', 'Jl. Kemang 2 jakarta barat', '', ''),
(13, 'PT. Zikna Soft', '8564789651', 'azkazikna.aal@gmail.com', 'Blablablabalba Bogor', 'Azkazikna Ageung Laksana', 'Direktur PT. Zikna Soft');

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
(20, 7, 3, '<p>Pemantauan Kualitas Emisi Sumber Tidak Bergerak:</p><ul><li>Cerobong Boiler 1</li><li>Cerobong Boiler 2</li></ul>', '<p>Permenlhk No. P.15/MENLHK/SETJEN/KUM.1/4/2019 tentang Baku Mutu Emisi Pembangkit Listrik Tenaga Termal <b>(NON ISOKINETIK)</b></p><p>Total Partikulat, SO2, NO2, CO</p>', 2, 2, 50000),
(22, 4, 5, '<p>Heat stress gaming yt</p>', '<p>asdasdasdas</p>', 12, 8, 100000),
(23, 13, 3, '<p>asdas</p>', '<p>asdasd</p>', 3, 2, 100000),
(29, 13, 7, '<p>dsfsdfsdf</p>', '<p>sdfsdffds</p>', 12, 9, 50000),
(30, 15, 7, '<p>dsfsd</p>', '<p>fsdfsdfsd</p>', 3, 9, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `result_coa`
--

CREATE TABLE `result_coa` (
  `id_result` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `id_coa` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `result` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result_coa`
--

INSERT INTO `result_coa` (`id_result`, `id_sk`, `id_coa`, `id_analysis`, `id_int`, `result`) VALUES
(14, 9, 18, 13, 7, 'berhasil mantap banget gg'),
(15, 9, 19, 13, 7, 'sdfsdfs'),
(16, 9, 20, 13, 7, 'hguygtuytuy'),
(17, 9, 21, 13, 7, 'asdsad'),
(18, 9, 22, 13, 7, 'sdfsdf'),
(19, 9, 23, 13, 7, 'sdfsdfsd'),
(20, 9, 24, 13, 7, ''),
(21, 9, 25, 13, 7, ''),
(22, 9, 26, 13, 7, ''),
(23, 9, 27, 15, 7, NULL),
(24, 9, 28, 15, 7, NULL),
(25, 9, 29, 15, 7, NULL),
(26, 9, 30, 15, 7, NULL),
(27, 9, 31, 15, 7, NULL),
(28, 9, 32, 15, 7, NULL),
(29, 9, 33, 15, 7, NULL),
(30, 9, 34, 15, 7, NULL),
(31, 9, 35, 15, 7, NULL),
(32, 9, 36, 15, 7, NULL),
(33, 9, 37, 15, 7, NULL),
(34, 9, 38, 15, 7, NULL),
(35, 9, 39, 15, 7, NULL),
(36, 9, 40, 15, 7, NULL),
(37, 9, 41, 15, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id_sample` int(11) NOT NULL,
  `name_sample` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`id_sample`, `name_sample`) VALUES
(1, 'Debu'),
(2, 'SO2'),
(3, 'NO2'),
(4, 'CO'),
(5, 'NH3'),
(6, 'H2S'),
(7, 'Suhu'),
(8, 'Kelembaban'),
(9, 'NOISE'),
(10, 'ISBB/Heat Stress'),
(11, 'Benzene'),
(12, 'Toluene'),
(13, 'Xylene (BTX)'),
(14, 'Partikulat'),
(15, 'Opasitas'),
(16, 'Laju Alir'),
(17, 'Pencahayaan'),
(18, 'Air Limbah Produksi'),
(19, 'Air Limbah Domestik');

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
(7, 'Akbar Maulana Febriansyah', 1, '0856973256', 'akbar@gmail.com'),
(8, 'Rezha Ikhwan Hidayat', 1, '054586325975', 'rezha@gmail.com'),
(9, 'Ananda Rizq', 1, '084569785236', 'nanda@gmail.com'),
(10, 'Atiyah Ummi Sholihat', 0, '085647521245', 'atiyah@gmail.com'),
(11, 'Deviyanti Kusumawati', 0, '085645857584', 'devi@gmail.com'),
(12, 'Pramdhanni Dwi Putra Bintang', 1, '085698741236', 'pramgebleg@gmail.com'),
(13, 'Annaufal Arifa Nasution Hidayatullah', 1, '083698755485', 'annaufal60@gmail.com'),
(14, 'Shevy Octavian', 0, '081210805647', 'shevygaming@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sampling_det`
--

CREATE TABLE `sampling_det` (
  `id_sampling` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `sample_desc` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `sample_type` varchar(255) DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sampling_det`
--

INSERT INTO `sampling_det` (`id_sampling`, `id_sk`, `sample_desc`, `location`, `sample_type`, `deadline`, `description`) VALUES
(8, 2, 'Debu, SO2, NO2, CO, NH3, H2S, Suhu, Kelembaban', '<ul><li>Halaman Depan Plant 1</li><li>Halaman Belakang Plant 2</li><li>Halaman Belakang Plant 3</li></ul>', 'Cair', '2022-10-14', 'gg gaming'),
(9, 2, 'Debu, SO2, NO2, CO, NH3, H2S, Suhu, Kelembaban', '<ul><li>Ruang Produksi Plant 1</li><li>Ruang Produksi Plant 2</li><li>Ruang Heat Treatment Plant 3</li><li>Ruang Produksi Plant 3</li><li>Ruang Heat Treatment Plant 3</li></ul>', 'Padat', '2022-10-13', 'mantap'),
(10, 2, 'NOISE', '<ul><li>Batas Pabrik Sebelah Utara</li><li>Batas Pabrik Sebelah Selatan</li><li>Batas Pabrik Sebelah Timur</li><li>Batas Pabrik Sebelah Barat</li></ul>', 'Gas', '2022-10-01', 'Ini deskripsi singkat'),
(11, 2, 'NOISE', '<ul><li>Ruang Produksi Plant 1</li><li>Area Barel Machine Plant 1</li><li>Ruang Produksi Plant 2</li><li>Ruang Heat Treatment Plant 2</li><li>Ruang Produksi Plant 3</li><li>Ruang Heat Treatment Plant 3</li></ul>', 'Gas', '2022-10-20', 'ini deskripsi sangat singkat.'),
(12, 2, 'ISBB/Heat Stress', '<ul><li>Ruang Heat Treatment Plant 2</li><li>Ruang Heat Treatment Plant 3</li></ul>', 'ghf', '2022-10-02', 'gfh'),
(13, 2, 'Benzene, Toluene, Xylene (BTX)', '<p>Area Platting Plant 1</p>', 'asdas', '2022-10-04', 'asd'),
(14, 2, 'SO2, NO2, CO, Partikulat, Opasitas, Laju Alir', '<ul><li>Cerobong Genset 800 kVA Plant 1</li><li>Cerobong Genset 600 kVA Plant 2</li></ul>', 'ads', '2022-10-19', 'asd'),
(15, 2, 'Pencahayaan', '<ul><li>Ruang Hear Treatment Plant 1</li><li>Ruang Produksi Plant 1</li><li>Ruang Heat Treatment Plant 2</li><li>Ruang Produksi Plant 2</li><li>Ruang Produksi Plant 3</li><li>Ruang Heat Treatment Plant 3</li></ul>', '', '', ''),
(16, 2, 'Opasitas', '<ul><li>Forklift (1 titik) Plant 1</li><li>Forklift 2,5 Ton (1 titik) Plant 2</li><li>Truck Hino Tahun 2005 (T 8102 L) Plant 3</li><li>Truck Hino Tahun 2004 (T 8228 K) Plant 3</li><li>Truck Isuzu Tahun 2002 (T 8047 FZ) Plant 3</li></ul>', '', '', ''),
(17, 2, 'Air Limbah Produksi', '<p>Servis Manhole</p>', '', '', ''),
(18, 2, 'Air Limbah Domestik', '<p>Servis Manhole</p>', '', '', ''),
(19, 7, 'Debu, SO2, NO2, CO, NH3, H2S', '<ul><li>Rumah Rezha</li><li>Rumah Pram</li></ul>', NULL, NULL, NULL),
(22, 6, 'SO2, NO2, CO', '<ul><li>GH Evos</li><li>GH RRQ</li></ul>', 'Cair', '2022-10-06', 'sedang dikerjakan'),
(23, 9, 'Debu, SO2, NO2, CO', '<p>dsfsdf</p>', 'Gas', '2022-10-06', 'fgfdgdfgdf');

-- --------------------------------------------------------

--
-- Table structure for table `sk_number`
--

CREATE TABLE `sk_number` (
  `id_sk` int(11) NOT NULL,
  `sk_quotation` varchar(255) NOT NULL,
  `sk_sample` varchar(255) NOT NULL,
  `sk_analysis` varchar(255) NOT NULL,
  `no_certificate` varchar(255) NOT NULL,
  `date_quotation` varchar(255) NOT NULL,
  `date_sample` varchar(255) NOT NULL,
  `date_analysis` varchar(255) NOT NULL,
  `date_report` varchar(255) NOT NULL,
  `id_int` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_number`
--

INSERT INTO `sk_number` (`id_sk`, `sk_quotation`, `sk_sample`, `sk_analysis`, `no_certificate`, `date_quotation`, `date_sample`, `date_analysis`, `date_report`, `id_int`) VALUES
(2, '1/2022/09/27/DIL/QTN', '2/2022/09/30/DIL/STPS', '2/2022/10/04/DIL/STP', '', '', '04/10/2022', '', '', 3),
(4, '3/2022/09/27/DIL/QTN', '', '', '', '', '', '', '', 4),
(5, '5/2022/09/27/DIL/QTN', '', '', '', '', '', '', '', 9),
(6, '6/2022/09/27/DIL/QTN', '6/2022/10/03/DIL/STPS', '6/2022/10/04/DIL/STP', '', '', '04/10/2022', '', '', 12),
(7, '7/2022/09/29/DIL/QTN', '7/2022/09/30/DIL/STPS', '', '', '', '', '', '', 10),
(8, '8/2022/10/03/DIL/QTN', '', '', '', '03/10/2022', '', '', '', 5),
(9, '9/2022/10/04/DIL/QTN', '9/2022/10/04/DIL/STPS', '9/2022/10/04/DIL/STP', 'DIL-20221004COA', '04/10/2022', '04/10/2022', '04/10/2022', '04/10/2022', 7);

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
  ADD PRIMARY KEY (`id_assign`),
  ADD KEY `id_sample` (`id_sampler`),
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
  ADD PRIMARY KEY (`id_result`),
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
  ADD PRIMARY KEY (`id_sampling`),
  ADD KEY `id_sk` (`id_sk`),
  ADD KEY `id_sample` (`sample_desc`);

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
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
  MODIFY `id_assign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coa`
--
ALTER TABLE `coa`
  MODIFY `id_coa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  MODIFY `id_quotation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `result_coa`
--
ALTER TABLE `result_coa`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id_sample` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sampler`
--
ALTER TABLE `sampler`
  MODIFY `id_sampler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sampling_det`
--
ALTER TABLE `sampling_det`
  MODIFY `id_sampling` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sk_number`
--
ALTER TABLE `sk_number`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
  ADD CONSTRAINT `assign_sampler_ibfk_1` FOREIGN KEY (`id_sampler`) REFERENCES `sampler` (`id_sampler`) ON DELETE CASCADE ON UPDATE CASCADE,
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
-- Constraints for table `sampling_det`
--
ALTER TABLE `sampling_det`
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
