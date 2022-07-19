# Host: localhost  (Version 5.5.5-10.4.21-MariaDB)
# Date: 2022-03-09 23:17:44
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "t_user"
#


DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `user_pk` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) NOT NULL,
  `user_password` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_full_name` varchar(150) NOT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `user_tel` varchar(25) DEFAULT NULL,
  `user_profile_picture` varchar(45) DEFAULT NULL,
  `user_regis_date_time` datetime DEFAULT NULL,
  `user_sex` char(1) DEFAULT NULL,
  `user_bio` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`user_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "t_user"
#

INSERT INTO `t_user` VALUES (1,'rodrigo','$2y$10$/Hxttd42D5cIgfqk2liPb.u5xCE1KOqOBfj3AS25JE0kz1urEe5Y2','Rodrigo Guimarães','rod@email.net','7188888888','images/rod.jpg','2022-03-02 00:00:00','m','Web developer, freelance and longboard skater amateur'),(2,'usuario','$2y$10$1Wud8fG1b9LZnw9nDpzxjOYNsjo6E9LE.hDyRJzImUd2zzNce3GVG','Manolo da Silva ','user@email.net','799999999','images/manolo.jpg','2022-03-02 00:00:00','m','Usuario de testes'),(3,'rachel','$2y$10$2sk7JplCBR8Eg26xA6WnSee5V7CSdn1qePaY3USgIybAPvub3oi0q','Rachel Lawrence','rachel@email.net','796666666','images/rachel.jpg','2022-03-02 00:00:00','f','Filosofa, vegan e mutcho doida'),(4,'jessica','$2y$10$WgkaGC3OeDQdt9AU/oK1zOAqF7pDVIv0E5Hoc92FtLc/pqJ3lFwWu','Jessica Wauters','jessi@myemail.net','7177889900','images/jessica.jpg','2022-03-02 00:00:00','f','Nutricionista , que ama nutrição esportiva e viagens'),(5,'inna','$2y$10$FUtkrHLdkNMH/FhsePueueI1DoE74s.pbAkkIRwEZIim0knnfsO7i','Elena Alexandra ','inna@clubrokcers.com','7188997766','images/inna.jpg','2022-03-02 00:00:00','f','Cantora, compositora e skatistas nas horas vagas'),(6,'amanda','$2y$10$QMo909pbJrsJMMOcb4a8Weyn10Rr1wu.jzawnMZf0xvjdhjuYHRJq','Amanda Barbosa','amanda@email.com','989898989898','images/amanda.jpg','2022-03-02 00:00:00','f','Estilista, amante de crossfit');

#
# Structure for table "t_post"
#

DROP TABLE IF EXISTS `t_post`;
CREATE TABLE `t_post` (
  `post_pk` int(11) NOT NULL AUTO_INCREMENT,
  `post_fk_user` int(11) DEFAULT NULL,
  `post_text` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `post_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`post_pk`),
  KEY `pst_fk_usu_idx` (`post_fk_user`),
  CONSTRAINT `post_fk_user` FOREIGN KEY (`post_fk_user`) REFERENCES `t_user` (`user_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# Data for table "t_post"
#

INSERT INTO `t_post` VALUES (5,3,'Bom dia queridossss =)) S2 S2','2022-03-02 14:36:34'),(6,1,'  Fala gatenhas! XD ','2022-03-02 14:39:35'),(9,2,' Oia eu aqui pra fazer manolagem! =P','2022-03-02 02:04:58'),(10,5,'  To na area! Kisses =****','2022-03-02 02:06:03'),(11,4,'E ai gente como foi o evento ontem? ^^','2022-03-02 02:07:00'),(24,2,'Oia! Eu aqui de novo! ^^ ','2022-03-09 21:37:52'),(25,6,'Oiii genteee! =)))','2022-03-09 22:35:59'),(26,1,'Fala! Amanda =*','2022-03-09 22:41:11'),(27,3,'Ola, People! XD  #Sextou!','2022-03-09 23:07:53');

#
# Structure for table "t_comment"
#

DROP TABLE IF EXISTS `t_comment`;
CREATE TABLE `t_comment` (
  `comment_pk` int(11) NOT NULL AUTO_INCREMENT,
  `comment_fk_user` int(11) DEFAULT NULL,
  `comment_fk_post` int(11) DEFAULT NULL,
  `comment_text` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `comment_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`comment_pk`),
  KEY `com_fk_usu_idx` (`comment_fk_user`),
  KEY `com_fk_pst_idx` (`comment_fk_post`),
  CONSTRAINT `comment_fk_post` FOREIGN KEY (`comment_fk_post`) REFERENCES `t_post` (`post_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_fk_user` FOREIGN KEY (`comment_fk_user`) REFERENCES `t_user` (`user_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# Data for table "t_comment"
#

INSERT INTO `t_comment` VALUES (38,1,11,'Otimo! =)','2022-03-02 13:13:39'),(39,1,10,'=)))','2022-03-02 16:36:08'),(46,1,5,'OI! =)','2022-03-02 15:47:28'),(48,4,6,'OI!','2022-03-07 23:18:59');

#
# Structure for table "t_like"
#

DROP TABLE IF EXISTS `t_like`;
CREATE TABLE `t_like` (
  `like_pk` int(11) NOT NULL AUTO_INCREMENT,
  `like_fk_post` int(11) DEFAULT NULL,
  `like_fk_user` int(11) DEFAULT NULL,
  `like_fk_comment` int(11) DEFAULT NULL,
  PRIMARY KEY (`like_pk`),
  KEY `lik_fk_post_idx` (`like_fk_post`),
  KEY `lik_fk_usu_idx` (`like_fk_user`),
  KEY `lik_fk_com_idx` (`like_fk_comment`),
  CONSTRAINT `like_fk_comment` FOREIGN KEY (`like_fk_comment`) REFERENCES `t_comment` (`comment_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `like_fk_post` FOREIGN KEY (`like_fk_post`) REFERENCES `t_post` (`post_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `like_fk_user` FOREIGN KEY (`like_fk_user`) REFERENCES `t_user` (`user_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# Data for table "t_like"
#

INSERT INTO `t_like` VALUES (85,6,3,NULL),(86,5,4,NULL),(87,6,1,NULL),(88,5,1,NULL),(91,10,1,NULL),(96,5,5,NULL),(97,11,1,NULL),(98,9,1,NULL),(99,9,2,NULL),(100,6,2,NULL),(101,5,2,NULL),(102,11,2,NULL),(105,NULL,1,38),(108,NULL,1,46),(111,11,4,NULL),(112,NULL,4,48),(117,24,2,NULL),(118,24,1,NULL),(119,25,6,NULL);

#
# View "home_view"
#

DROP VIEW IF EXISTS `home_view`;
CREATE
  ALGORITHM = UNDEFINED
  VIEW `home_view`
  AS
  SELECT
    `p`.`post_pk` AS 'pid',
    `p`.`post_text` AS 'texto',
    `p`.`post_date_time` AS 'data',
    (SELECT COUNT(0) FROM `t_like` l2 WHERE `l2`.`like_fk_post` = `p`.`post_pk`) AS 'qtdlike',
    (SELECT COUNT(0) FROM `t_comment` c2 WHERE `c2`.`comment_fk_post` = `p`.`post_pk`) AS 'qtdcom',
    `u`.`user_pk` AS 'uid',
    `u`.`user_full_name` AS 'nome',
    `u`.`user_profile_picture` AS 'image'
  FROM
    (`t_post` p
      LEFT JOIN `t_user` u ON (`p`.`post_fk_user` = `u`.`user_pk`))
  ORDER BY `p`.`post_date_time` DESC;
