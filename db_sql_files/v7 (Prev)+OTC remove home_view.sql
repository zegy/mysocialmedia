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

-- Stand-in structure for view `home_view` (See below for the actual view) --
DROP VIEW IF EXISTS `home_view`;
CREATE TABLE `home_view` (
`pid` int(11)
,`texto` varchar(250)
,`type` varchar(10)
,`data` datetime
,`qtdcom` bigint(21)
,`uid` int(11)
,`nome` varchar(150)
,`un` varchar(150)
,`image` varchar(45)
,`role` varchar(250)
);

-- Table structures --
DROP TABLE IF EXISTS `t_comment`;
CREATE TABLE `t_comment` (
  `comment_pk` int(11) NOT NULL,
  `comment_fk_user` int(11) DEFAULT NULL,
  `comment_fk_post` int(11) DEFAULT NULL,
  `comment_text` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `comment_date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

DROP TABLE IF EXISTS `t_post`;
CREATE TABLE `t_post` (
  `post_pk` int(11) NOT NULL,
  `post_fk_user` int(11) DEFAULT NULL,
  `post_text` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `post_date_time` datetime DEFAULT NULL,
  `post_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `user_pk` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `user_password` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_full_name` varchar(150) NOT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `user_tel` varchar(25) DEFAULT NULL,
  `user_profile_picture` varchar(45) DEFAULT NULL,
  `user_regis_date_time` datetime DEFAULT NULL,
  `user_sex` char(1) DEFAULT NULL,
  `user_bio` varchar(250) DEFAULT NULL,
  `user_token` varchar(250) NOT NULL,
  `user_role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for tables --
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

-- Structure for view `home_view` --
DROP TABLE IF EXISTS `home_view`;
DROP VIEW IF EXISTS `home_view`;
CREATE OR REPLACE VIEW `home_view`
    AS
    SELECT `post_pk` AS `pid`,
        `post_text` AS `texto`,
        `post_type` AS `type`,
        `post_date_time` AS `data`,
        (select count(0) from `t_comment` where `comment_fk_post` = `post_pk`) AS `qtdcom`,
        `user_pk` AS `uid`,
        `user_full_name` AS `nome`,
        `user_name` AS `un`,
        `user_role` AS `role`,
        `user_profile_picture` AS `image` 
    FROM (`t_post` left join `t_user` on(`post_fk_user` = `user_pk`))
    ORDER BY `post_date_time` DESC;

-- Indexes for tables --
ALTER TABLE `t_comment`
  ADD PRIMARY KEY (`comment_pk`),
  ADD KEY `FK_USER` (`comment_fk_user`),
  ADD KEY `FK_POST` (`comment_fk_post`);

ALTER TABLE `t_post`
  ADD PRIMARY KEY (`post_pk`),
  ADD KEY `FK_USER` (`post_fk_user`);

ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_pk`);

-- AUTO_INCREMENT for tables --
ALTER TABLE `t_comment`
  MODIFY `comment_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `t_post`
  MODIFY `post_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `t_user`
  MODIFY `user_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- Constraints for tables --
ALTER TABLE `t_comment`
  ADD CONSTRAINT `comment_fk_post` FOREIGN KEY (`comment_fk_post`) REFERENCES `t_post` (`post_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_fk_user` FOREIGN KEY (`comment_fk_user`) REFERENCES `t_user` (`user_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `t_post`
  ADD CONSTRAINT `post_fk_user` FOREIGN KEY (`post_fk_user`) REFERENCES `t_user` (`user_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;