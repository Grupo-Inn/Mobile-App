-- MySQL Script generated by MySQL Workbench
-- 02/28/16 00:28:00
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

-- -----------------------------------------------------
-- Schema grupo_inn_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema grupo_inn_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `grupo_inn_db` DEFAULT CHARACTER SET utf8 ;
USE `grupo_inn_db` ;

-- -----------------------------------------------------
-- Table `grupo_inn_db`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo_inn_db`.`User` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`username` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo_inn_db`.`Profile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo_inn_db`.`Profile` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `names` VARCHAR(45) NULL,
  `birthday` DATE NULL,
  `email` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `image` VARCHAR(45) NULL,
  `User_id` INT NOT NULL,
  PRIMARY KEY (`id`, `User_id`),
  INDEX `fk_Perfil_Usuario1_idx` (`User_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `idUser_UNIQUE` (`User_id` ASC),
  CONSTRAINT `fk_Perfil_Usuario1`
    FOREIGN KEY (`User_id`)
    REFERENCES `grupo_inn_db`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo_inn_db`.`Event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo_inn_db`.`Event` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `description` TINYTEXT NULL,
  `image` VARCHAR(45) NULL,
  `type` VARCHAR(45) NULL,
  `place` VARCHAR(45) NULL,
  `quota` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo_inn_db`.`Like`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo_inn_db`.`Like` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo_inn_db`.`Event_has_User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo_inn_db`.`Event_has_User` (
  `Event_id` INT NOT NULL,
  `User_id` INT NOT NULL,
  PRIMARY KEY (`Event_id`, `User_id`),
  INDEX `fk_Event_has_User_User1_idx` (`User_id` ASC),
  INDEX `fk_Event_has_User_Event1_idx` (`Event_id` ASC),
  CONSTRAINT `fk_Event_has_User_Event1`
    FOREIGN KEY (`Event_id`)
    REFERENCES `grupo_inn_db`.`Event` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Event_has_User_User1`
    FOREIGN KEY (`User_id`)
    REFERENCES `grupo_inn_db`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo_inn_db`.`User_has_Like`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo_inn_db`.`User_has_Like` (
  `User_id` INT NOT NULL,
  `Like_id` INT NOT NULL,
  PRIMARY KEY (`User_id`, `Like_id`),
  INDEX `fk_User_has_Like_Like1_idx` (`Like_id` ASC),
  INDEX `fk_User_has_Like_User1_idx` (`User_id` ASC),
  CONSTRAINT `fk_User_has_Like_User1`
    FOREIGN KEY (`User_id`)
    REFERENCES `grupo_inn_db`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Like_Like1`
    FOREIGN KEY (`Like_id`)
    REFERENCES `grupo_inn_db`.`Like` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

