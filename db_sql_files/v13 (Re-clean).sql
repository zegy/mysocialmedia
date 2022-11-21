-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2022 at 07:56 AM
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
-- Database: `mysocialmedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_comment`
--

DROP TABLE IF EXISTS `t_comment`;
CREATE TABLE `t_comment` (
  `comment_pk` int(11) NOT NULL,
  `comment_fk_user` int(11) DEFAULT NULL,
  `comment_fk_post` int(11) DEFAULT NULL,
  `comment_text` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `comment_date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_like`
--

DROP TABLE IF EXISTS `t_like`;
CREATE TABLE `t_like` (
  `like_pk` int(11) NOT NULL,
  `like_fk_user` int(11) DEFAULT NULL,
  `like_fk_comment` int(11) DEFAULT NULL,
  `like_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_post`
--

DROP TABLE IF EXISTS `t_post`;
CREATE TABLE `t_post` (
  `post_pk` int(11) NOT NULL,
  `post_fk_user` int(11) DEFAULT NULL,
  `post_title` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `post_text` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `post_date_time` datetime DEFAULT NULL,
  `post_type` varchar(250) DEFAULT NULL,
  `post_img` varchar(250) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `user_pk` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_password` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_full_name` varchar(250) NOT NULL,
  `user_email` varchar(250) DEFAULT NULL,
  `user_tel` varchar(250) DEFAULT NULL,
  `user_profile_picture` varchar(250) DEFAULT NULL,
  `user_regis_date_time` datetime DEFAULT NULL,
  `user_sex` char(1) DEFAULT NULL,
  `user_bio` varchar(250) DEFAULT NULL,
  `user_token` varchar(250) NOT NULL,
  `user_role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_pk`, `user_name`, `user_password`, `user_full_name`, `user_email`, `user_tel`, `user_profile_picture`, `user_regis_date_time`, `user_sex`, `user_bio`, `user_token`, `user_role`) VALUES
(
    1,
    'un_admin',
    '$2y$10$ZIihFAngpR/e0pJ1RxuovumCtdZzPSSs4UNNCmtE.BKQ7Vqprm7m6',
    'ufn_admin',
    'admin@gmail.com',
    '111111111',
    'images/admin.jpg',
    '2022-01-01 00:00:00',
    'm',
    'bio_admin',
    '',
    'admin'
),
(
    2,
    'un_dosen',
    '$2y$10$NptHyXZ9Xg17Vpcd9Xqq0OZA1q/0Kvdn64YHm3jaRPmsjavSrkBXG',
    'ufn_dosen',
    'dosen@gmail.com',
    '222222222',
    'images/dosen.jpg',
    '2022-01-01 00:00:00',
    'm',
    'bio_dosen',
    '',
    'dosen'
),
(
    3,
    'un_mahasiswa',
    '$2y$10$GnjKCxCSsKCHTotJYK2Nb.KOaVJIgJk2tLTpux8SU7lCXFKpAPj1y',
    'ufn_mahasiswa',
    'mahasiswa@gmail.com',
    '333333333',
    'images/mahasiswa.jpg',
    '2022-01-01 00:00:00',
    'm',
    'bio_mahasiswa',
    '',
    'mahasiswa'
);
-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_comment`
--
ALTER TABLE `t_comment`
  ADD PRIMARY KEY (`comment_pk`),
  ADD KEY `com_fk_user_idx` (`comment_fk_user`),
  ADD KEY `com_fk_post_idx` (`comment_fk_post`);

--
-- Indexes for table `t_like`
--
ALTER TABLE `t_like`
  ADD PRIMARY KEY (`like_pk`),
  ADD KEY `like_fk_user_idx` (`like_fk_user`),
  ADD KEY `like_fk_com_idx` (`like_fk_comment`);

--
-- Indexes for table `t_post`
--
ALTER TABLE `t_post`
  ADD PRIMARY KEY (`post_pk`),
  ADD KEY `post_fk_user_idx` (`post_fk_user`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_pk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_comment`
--
ALTER TABLE `t_comment`
  MODIFY `comment_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `t_like`
--
ALTER TABLE `t_like`
  MODIFY `like_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `t_post`
--
ALTER TABLE `t_post`
  MODIFY `post_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_comment`
--
ALTER TABLE `t_comment`
  ADD CONSTRAINT `comment_fk_post` FOREIGN KEY (`comment_fk_post`) REFERENCES `t_post` (`post_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_fk_user` FOREIGN KEY (`comment_fk_user`) REFERENCES `t_user` (`user_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_like`
--
ALTER TABLE `t_like`
  ADD CONSTRAINT `like_fk_user` FOREIGN KEY (`like_fk_user`) REFERENCES `t_user` (`user_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `like_fk_comment` FOREIGN KEY (`like_fk_comment`) REFERENCES `t_comment` (`comment_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_post`
--
ALTER TABLE `t_post`
  ADD CONSTRAINT `post_fk_user` FOREIGN KEY (`post_fk_user`) REFERENCES `t_user` (`user_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;