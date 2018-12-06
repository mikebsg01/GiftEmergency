-- MySQL Script generated by MySQL Workbench
-- lun 03 dic 2018 17:10:27 CST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema db_giftemergency
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_giftemergency
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_giftemergency` DEFAULT CHARACTER SET utf8 ;
USE `db_giftemergency` ;

-- -----------------------------------------------------
-- Table `db_giftemergency`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_giftemergency`.`images` (
  `id` INT(13) NOT NULL AUTO_INCREMENT,
  `file_path` TEXT NOT NULL,
  `file_name` TEXT NOT NULL,
  `file_extension` TEXT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_giftemergency`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_giftemergency`.`users` (
  `id` INT(13) NOT NULL AUTO_INCREMENT,
  `is_admin` TINYINT(1) NOT NULL,
  `first_name` VARCHAR(25) NOT NULL,
  `last_name` VARCHAR(25) NOT NULL,
  `full_name` VARCHAR(51) NOT NULL,
  `phone_number` VARCHAR(10) NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` TEXT NOT NULL,
  `photo_id` INT(13) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_users_images_idx` (`photo_id` ASC),
  CONSTRAINT `fk_users_images`
    FOREIGN KEY (`photo_id`)
    REFERENCES `db_giftemergency`.`images` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_giftemergency`.`questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_giftemergency`.`questions` (
  `id` INT(13) NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(40) NOT NULL,
  `label` VARCHAR(240) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_giftemergency`.`stereotypes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_giftemergency`.`stereotypes` (
  `id` INT(13) NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(40) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_giftemergency`.`answers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_giftemergency`.`answers` (
  `id` INT(13) NOT NULL AUTO_INCREMENT,
  `question_id` INT(13) NOT NULL,
  `slug` VARCHAR(40) NOT NULL,
  `content` VARCHAR(240) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_answers_questions1_idx` (`question_id` ASC),
  CONSTRAINT `fk_answers_questions1`
    FOREIGN KEY (`question_id`)
    REFERENCES `db_giftemergency`.`questions` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_giftemergency`.`answers_stereotypes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_giftemergency`.`answers_stereotypes` (
  `id` INT(13) NOT NULL AUTO_INCREMENT,
  `answer_id` INT(13) NOT NULL,
  `stereotype_id` INT(13) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_answers_has_stereotypes_stereotypes1_idx` (`stereotype_id` ASC),
  INDEX `fk_answers_has_stereotypes_answers1_idx` (`answer_id` ASC),
  CONSTRAINT `fk_answers_has_stereotypes_answers1`
    FOREIGN KEY (`answer_id`)
    REFERENCES `db_giftemergency`.`answers` (`question_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answers_has_stereotypes_stereotypes1`
    FOREIGN KEY (`stereotype_id`)
    REFERENCES `db_giftemergency`.`stereotypes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_giftemergency`.`gifts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_giftemergency`.`gifts` (
  `id` INT(13) NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(40) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `stereotype_id` INT(13) NOT NULL,
  `gender` TINYINT(1) NOT NULL,
  `price` DECIMAL(8,2) NOT NULL,
  `image_id` INT(13) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_gifts_stereotypes1_idx` (`stereotype_id` ASC),
  INDEX `fk_gifts_images1_idx` (`image_id` ASC),
  CONSTRAINT `fk_gifts_stereotypes1`
    FOREIGN KEY (`stereotype_id`)
    REFERENCES `db_giftemergency`.`stereotypes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gifts_images1`
    FOREIGN KEY (`image_id`)
    REFERENCES `db_giftemergency`.`images` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_giftemergency`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_giftemergency`.`orders` (
  `id` INT(13) NOT NULL,
  `quantity` INT(4) NOT NULL,
  `subtotal` DECIMAL(8,2) NOT NULL,
  `iva` DECIMAL(4,2) NOT NULL,
  `total` DECIMAL(8,2) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_giftemergency`.`answers_stereotypes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_giftemergency`.`answers_stereotypes` (
  `id` INT(13) NOT NULL AUTO_INCREMENT,
  `answer_id` INT(13) NOT NULL,
  `stereotype_id` INT(13) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_answers_has_stereotypes_stereotypes1_idx` (`stereotype_id` ASC),
  INDEX `fk_answers_has_stereotypes_answers1_idx` (`answer_id` ASC),
  CONSTRAINT `fk_answers_has_stereotypes_answers1`
    FOREIGN KEY (`answer_id`)
    REFERENCES `db_giftemergency`.`answers` (`question_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answers_has_stereotypes_stereotypes1`
    FOREIGN KEY (`stereotype_id`)
    REFERENCES `db_giftemergency`.`stereotypes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- ***** INITIAL VALUES *****

-- Seeding "Images" by default:
INSERT INTO `db_giftemergency`.`images` (`id`, `file_path`, `file_name`, `file_extension`)
		VALUES (1, '/public/users/img_profile', 'img_default', 'png'),
           (2, '/public/gifts/img', 'img_default', 'png');

-- Seeding "Gift Images":
INSERT INTO `images` 
  VALUES (3,'/public/gifts/img','gift-fragancia-channel','jpg','2018-12-06 09:52:09','2018-12-06 09:52:09'),
         (4,'/public/gifts/img','gift-reloj-hugo-boss','jpg','2018-12-06 09:54:59','2018-12-06 09:54:59'),
         (5,'/public/gifts/img','gift-smartwatch','jpeg','2018-12-06 09:56:54','2018-12-06 09:56:54'),
         (6,'/public/gifts/img','gift-sudadera','jpg','2018-12-06 09:58:06','2018-12-06 09:58:06'),
         (7,'/public/gifts/img','gift-esferas-del-dragon','jpg','2018-12-06 09:59:06','2018-12-06 09:59:06'),
         (8,'/public/gifts/img','gift-death-note','jpg','2018-12-06 10:00:47','2018-12-06 10:00:47'),
         (9,'/public/gifts/img','gift-tupper','jpg','2018-12-06 10:02:29','2018-12-06 10:02:29'),
         (10,'/public/gifts/img','gift-tacones','jpg','2018-12-06 10:04:37','2018-12-06 10:04:37'),
         (11,'/public/gifts/img','gift-playera-metallica','jpg','2018-12-06 10:06:00','2018-12-06 10:06:00'),
         (12,'/public/gifts/img','gift-playera-de-guns-n-rosses','jpg','2018-12-06 10:07:13','2018-12-06 10:07:13'),
         (13,'/public/gifts/img','gift-disco-de-katty-perry','jpeg','2018-12-06 10:09:25','2018-12-06 10:09:25'),
         (14,'/public/gifts/img','gift-nutella','jpg','2018-12-06 10:10:43','2018-12-06 10:10:43'),
         (15,'/public/gifts/img','gift-taza-mon-laferte','jpg','2018-12-06 10:15:31','2018-12-06 10:15:31'),
         (16,'/public/gifts/img','gift-plantita-de-cactus','jpg','2018-12-06 10:16:12','2018-12-06 10:16:12'),
         (17,'/public/gifts/img','gift-camisa-bordada-por-yucatecos','jpg','2018-12-06 10:18:27','2018-12-06 10:18:27'),
         (18,'/public/gifts/img','gift-muneca-maria','jpg','2018-12-06 10:19:18','2018-12-06 10:19:18'),
         (19,'/public/gifts/img','gift-mochila-de-gimnasio','jpg','2018-12-06 10:21:29','2018-12-06 10:21:29'),
         (20,'/public/gifts/img','gift-mochila-de-gimnasio-rosa','jpg','2018-12-06 10:22:20','2018-12-06 10:22:20'),
         (21,'/public/gifts/img','gift-cinturon-gucci','jpg','2018-12-06 10:23:03','2018-12-06 10:23:03'),
         (22,'/public/gifts/img','gift-gorra-de-visera-redonda','jpeg','2018-12-06 10:26:08','2018-12-06 10:26:08');

-- Seeding "Admin Users":
INSERT INTO `db_giftemergency`.`users` 
	(`is_admin`,`first_name`, `last_name`, `full_name`, `photo_id`, `phone_number`, `email`, `password`)
    VALUES (1, 'Michael Brandon', 'Serrato Guerrero', 'Michael Brandon Serrato Guerrero', 1, '4422332139', 'mikebsg01@gmail.com', SHA2('hola1234', 256));

-- Seeding "Stereotypes":
INSERT INTO `stereotypes` VALUES (1,'3f411130eb77f5e46e09fb9927742aa8240bb16c','Fresa','2018-12-05 21:00:27','2018-12-05 21:00:27'),
                                 (2,'0b3216323c6b9fe84b9feda8c9ed2eb16f4cbf4d','Geek','2018-12-05 21:00:34','2018-12-05 21:00:34'),
                                 (3,'7a53a003b97b2ab7344ca3ba25b6739e51121f7f','Otaku','2018-12-05 21:05:44','2018-12-05 21:05:44'),
                                 (4,'00961f174ff7249fd5bb0ddad65a4f732caa8822','Godín','2018-12-05 21:05:55','2018-12-05 21:05:55'),
                                 (5,'707471d4ae78a835237a4ef5b8a11ce3b13896aa','Metalero','2018-12-05 21:06:02','2018-12-05 21:06:02'),
                                 (6,'65c3ae5c471648e4eae50a2d7e872e0c9ada1d7c','Popero','2018-12-05 21:06:10','2018-12-05 21:06:10'),
                                 (7,'aef2271fea11635894e933cc5c0ce0a0751e9b6a','Hipster','2018-12-05 21:06:19','2018-12-05 21:06:19'),
                                 (8,'9468a49ac9d02099c0c9e2ae2e0c4286ceff18fb','Hippie','2018-12-05 21:06:52','2018-12-05 21:06:52'),
                                 (9,'cd2a0cdd990ef151c5991060126cba1d7d60a152','Deportista','2018-12-05 21:09:28','2018-12-05 21:09:28'),
                                 (10,'b68c9a4ec5e6a923b83dab68ad50227e24256fa4','Buchón','2018-12-05 21:09:35','2018-12-05 21:09:35');

-- Seeding "Gifts":
INSERT INTO `gifts` 
  VALUES (6,'7761de028fbd17f5220bd996881cdfc84221aa0d','Fragancia Channel',1,0,1650.00,3,'2018-12-06 09:52:08','2018-12-06 09:52:08'),
         (7,'e8cf1cc6cbeb94fa24221f213e1e855bfb356d47','Reloj Hugo Boss',1,1,8444.91,4,'2018-12-06 09:54:58','2018-12-06 09:54:58'),
         (8,'1b6b90a131bb080f3fbe210a8b6a5ce84e1180d7','Smartwatch',2,1,4199.00,5,'2018-12-06 09:56:54','2018-12-06 09:56:54'),
         (9,'df8874c576281ce995946e88094350f71f906829','Sudadera',2,0,571.43,6,'2018-12-06 09:58:06','2018-12-06 09:58:06'),
         (10,'aa2e17d0ef6b1cc08140a4316e181829a158e5e4','Esferas del dragón',3,1,945.22,7,'2018-12-06 09:59:06','2018-12-06 09:59:06'),
         (11,'a1c264ad28e511c4cdc6e11776d3db81d3ff4566','Death Note',3,0,359.00,8,'2018-12-06 10:00:46','2018-12-06 10:00:46'),
         (12,'c4e3303fe49efb86016e46759252bce3e812c6d1','Tupper',4,1,149.00,9,'2018-12-06 10:02:29','2018-12-06 10:02:29'),
         (13,'d1c91321ecbd89b949ffda29c1b0ee6e963b2cac','Tacones',4,0,1499.00,10,'2018-12-06 10:04:37','2018-12-06 10:04:37'),
         (14,'2c5f628e08f2b09709cdd87d56dbcbf9d0e53933','Playera Metallica',5,1,1056.52,11,'2018-12-06 10:06:00','2018-12-06 10:06:00'),
         (15,'1ecf31d63a352a7dded13c7d07f5b4eae2cb8ff0','Playera de Guns N’ Rosses',5,0,1100.00,12,'2018-12-06 10:07:13','2018-12-06 10:07:13'),
         (16,'ce9344f667190e5cd207b91361198d48490a03bb','Disco de Katty Perry',6,1,1350.00,13,'2018-12-06 10:09:25','2018-12-06 10:09:25'),
         (17,'4986de5eef00cc0f314e9bd17fdac73547891014','Nutella',6,0,59.00,14,'2018-12-06 10:10:43','2018-12-06 10:10:43'),
         (18,'f80a92beeda2fafdbadf7a6323af4f9a806d75cd','Taza Mon Laferte',7,1,150.00,15,'2018-12-06 10:15:31','2018-12-06 10:15:31'),
         (19,'3f62c3b6d772b1354de563926fcaf963b6cef19c','Plantita de Cactus',7,0,228.31,16,'2018-12-06 10:16:12','2018-12-06 10:16:12'),
         (20,'9f91fc81a0b39c000dee9077862e6c07756cbe56','Camisa bordada por yucatecos',8,1,479.00,17,'2018-12-06 10:18:27','2018-12-06 10:18:27'),
         (21,'5e82015e22d56752ce694c4fd47e2828035d6825','Muñeca María',8,0,150.00,18,'2018-12-06 10:19:18','2018-12-06 10:19:18'),
         (22,'7fccc321ec368576537babf8e0de25e3967347e7','Mochila de gimnasio',9,1,1500.00,19,'2018-12-06 10:21:29','2018-12-06 10:21:29'),
         (23,'ed02f342a979458c645b85e32c222c0c48e2c8c5','Mochila de gimnasio rosa',9,0,1299.00,20,'2018-12-06 10:22:20','2018-12-06 10:22:20'),
         (24,'bfa757e66ed441d0caa5fb5fd9bd709f31f7c2be','Cinturon Gucci',10,1,550.00,21,'2018-12-06 10:23:03','2018-12-06 10:23:03'),
         (25,'5cdf379f474badb80a0c56485e61a9df880a3e6b','Gorra de Visera Redonda',10,0,695.00,22,'2018-12-06 10:26:08','2018-12-06 10:26:08');