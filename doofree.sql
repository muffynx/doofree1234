-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 08:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doofree`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `comment` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`, `comment`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `no` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `enabled` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`no`, `name`, `enabled`) VALUES
(1, 'หนังฝรั่ง', 1),
(2, 'หนังไทย', 1),
(3, 'หนังญี่ปุ่น', 1),
(4, '18+', 1),
(5, 'การ์ตูน', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `no` int(10) NOT NULL,
  `date` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL,
  `category` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `pic` text NOT NULL,
  `hd` text NOT NULL DEFAULT 'HD',
  `year` int(100) NOT NULL,
  `imdb` float(10,1) NOT NULL,
  `story` text NOT NULL,
  `youtube` text NOT NULL,
  `video` text NOT NULL,
  `view` int(255) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`no`, `date`, `time`, `category`, `name`, `pic`, `hd`, `year`, `imdb`, `story`, `youtube`, `video`, `view`) VALUES
(1, '2020-03-13', '17.25', 1, 'Sonic the Hedgehog - โซนิค เดอะ เฮ็ดจ์ฮอก ', 'https://lh3.googleusercontent.com/94tqbPlQPlq9UNzCgykxnyiNjcnAG2LFwhW6ZQLHhvDMrDHwo-8AufmQ4QGRDf0nT27BD0T48aWR9CKte3JB=s0', 'HD', 2020, 8.5, '<p>จากวิดีโอเกมสุดฮิตโดยเซก้า สู่ภาพยนตร์ไลฟ์แอ็คชั่น Sonic The Hedgehog โซนิค เดอะ เฮดจ์ฮอก คือผลงานของผู้สร้างแฟรนไชส์ Fast &amp; Furious ที่ผนึกกำลังกับผู้สร้าง Deadpool ภาพยนตร์เป็นเรื่องราวของเจ้าเม่นสายฟ้าโซนิค (ให้เสียงพากย์โดยเบน ชวาร์ตซ์ ที่ต้องร่วมมือกับทอม (เจมส์ มาร์สเดน) เพื่อต่อสู้กับวายร้ายอย่าง ดร.โรบ็อทนิก (จิม แคร์รี่) เตรียมพบกับ Sonic The Hedgehog โซนิค เดอะ เฮดจ์ฮอก ความเกรียนแบบเร็ว..แรงทะลุนรก</p>', 'https://www.youtube.com/embed/gE747H-QEUU', 'https://main.77player.xyz/?id=aca054bf8a5ad822d18e1eaa', 288),
(2, '2020-03-13', '17.30', 1, 'Jumanji The Next Level 2019 - เกมดูดโลก ตะลุยด่านมหัศจรรย์', 'https://s359.kapook.com/pagebuilder/47cf61aa-5880-4c88-ada6-d5acdc329085.jpg', 'HD', 2019, 7.0, '', 'https://www.youtube.com/embed/rBxcF-r9Ibs', '//meplayer.co/embed/?VU9Hand1RmJ5bFhyWE1uSG1uL3RLSU5obm9kVEZGb0dMSXB6UzhHd2Z5OWdtbXVDL3l1VEVOTnlXeVhUSFZNdHBPWU0zL0FzWGxNRERhTEIraENPVFE9PTo67TeVFDuErRMp%2BXMO79N%2FPQ%3D%3D', 1064),
(3, '2022-03-10', '02:37 น.', 4, 'The Witcher Season 1 (2019) เดอะ วิทเชอร์ นักล่าจอมอสูร', 'https://m.media-amazon.com/images/M/MV5BN2FiOWU4YzYtMzZiOS00MzcyLTlkOGEtOTgwZmEwMzAxMzA3XkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg', 'HD', 2019, 8.6, '<p>เดอะ วิทเชอร์ นักล่าจอมอสูร (The Witcher) สร้างจากหนังสือชุดแนวแฟนตาซีขายดีที่บอกเล่าเรื่องราวอันยิ่งใหญ่ของโชคชะตาและครอบครัว เกรอลท์แห่งริเวียคือนักล่าอสูรผู้โดดเดี่ยวและหาหนทางที่จะมีที่ยืนในโลกซึ่งมนุษย์นั้นร้ายกาจเสียยิ่งกว่าอสูร แต่เมื่อโชคชะตานำพาให้เขามาเจอกับแม่มดทรงพลังและเจ้าหญิงที่กุมความลับสุดอันตราย ทั้งสามจะต้องออกเดินทางฟันฝ่าในมหาทวีปที่ผันผวนมากขึ้นไปทุกที</p>', 'https://www.youtube.com/embed/BetCJCI53KU', 'https://meplayer.co/embed/85ea2068-d3f5-43f0-963f-09bdb1407ed4', 114);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `no` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `logo` text NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `slide1_img` text DEFAULT NULL,
  `slide1_link` text DEFAULT NULL,
  `slide2_img` text DEFAULT NULL,
  `slide2_link` text DEFAULT NULL,
  `slide3_img` text DEFAULT NULL,
  `slide3_link` text DEFAULT NULL,
  `movie_hot1` int(255) NOT NULL,
  `movie_hot2` int(255) NOT NULL,
  `movie_hot3` int(255) NOT NULL,
  `movie_hot4` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`no`, `title`, `domain`, `logo`, `keywords`, `description`, `slide1_img`, `slide1_link`, `slide2_img`, `slide2_link`, `slide3_img`, `slide3_link`, `movie_hot1`, `movie_hot2`, `movie_hot3`, `movie_hot4`) VALUES
(1, 'MyVideoSite.com - ดูหนังออนไลน์ ดูหนังใหม่ชนโรง ดูหนัง Master HD', 'MyVideoSite.com', 'img/logo.png', 'ดูหนัง, ดูหนังออนไลน, หนังใหม้ชนโรง, หนังใหม่ HD, หนังใหม่ Master', 'ดูหนัง, ดูหนังออนไลน, หนังใหม้ชนโรง, หนังใหม่ HD, หนังใหม่ Master', 'https://cdni.bugaboo.tv/i/mg/8/7/f/87f83de9a45a1b9a28626aecc244baf3_banner_movie.jpg', '', 'https://placeit-assets0.s3-accelerate.amazonaws.com/custom-pages/make-a-twitch-banner2/Purple-Twitch-Banner-1024x324.png', '', 'https://cdni.bugaboo.tv/i/mg/8/7/f/87f83de9a45a1b9a28626aecc244baf3_banner_movie.jpg', '', 3, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
