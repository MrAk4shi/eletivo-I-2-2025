-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projetophp
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projetophp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projetophp` DEFAULT CHARACTER SET utf8 ;
USE `projetophp` ;

-- -----------------------------------------------------
-- Table `projetophp`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp`.`cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cpf` VARCHAR(14) NULL,
  `telefone` VARCHAR(15) NULL,
  `endereco` VARCHAR(100) NULL,
  `email` VARCHAR(100) NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetophp`.`profissionais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp`.`profissionais` (
  `idProfissionais` INT NOT NULL AUTO_INCREMENT,
  `nomeProfissional` VARCHAR(100) NOT NULL,
  `telefoneProfissional` VARCHAR(15) NULL,
  `emailProfissional` VARCHAR(100) NULL,
  `especialidade` VARCHAR(420) NULL,
  PRIMARY KEY (`idProfissionais`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetophp`.`agendamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp`.`agendamento` (
  `idAgendamento` INT NOT NULL AUTO_INCREMENT,
  `dataAgendamento` DATE NOT NULL,
  `inicioServico` DATETIME NOT NULL,
  `fimServico` DATETIME NOT NULL,
  `status` VARCHAR(45) NULL,
  `observacoes` TEXT NULL,
  `cliente_idCliente` INT NOT NULL,
  `profissionais_idProfissionais` INT NOT NULL,
  `servicos_idServico` INT NOT NULL,
  PRIMARY KEY (`idAgendamento`, `cliente_idCliente`, `profissionais_idProfissionais`, `servicos_idServico`),
  INDEX `fk_agendamento_cliente_idx` (`cliente_idCliente` ASC),
  INDEX `fk_agendamento_profissionais1_idx` (`profissionais_idProfissionais` ASC),
  INDEX `fk_agendamento_servicos1_idx` (`servicos_idServico` ASC),
  CONSTRAINT `fk_agendamento_cliente`
    FOREIGN KEY (`cliente_idCliente`)
    REFERENCES `projetophp`.`cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_agendamento_profissionais1`
    FOREIGN KEY (`profissionais_idProfissionais`)
    REFERENCES `projetophp`.`profissionais` (`idProfissionais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_agendamento_servicos1`
    FOREIGN KEY (`servicos_idServico`)
    REFERENCES `projetophp`.`servicos` (`idServico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `projetophp`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp`.`usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nomeUsuario` VARCHAR(100) NOT NULL,
  `emailUsuario` VARCHAR(100) NOT NULL UNIQUE,
  `senhaHash` VARCHAR(255) NOT NULL,
  `dataCriacao` DATETIME DEFAULT CURRENT_TIMESTAMP)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

