-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projetophp_professora
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projetophp_professora
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projetophp_professora` DEFAULT CHARACTER SET utf8 ;
USE `projetophp_professora` ;

-- -----------------------------------------------------
-- Table `projetophp_professora`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp_professora`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `senha` TEXT NOT NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetophp_professora`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp_professora`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `nome_categoria` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetophp_professora`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp_professora`.`produto` (
  `idproduto` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NOT NULL,
  `valor` DECIMAL(8,2) NOT NULL,
  `categoria_idcategoria` INT NOT NULL,
  PRIMARY KEY (`idproduto`),
  INDEX `fk_produto_categoria_idx` (`categoria_idcategoria` ASC),
  CONSTRAINT `fk_produto_categoria`
    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `projetophp_professora`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
