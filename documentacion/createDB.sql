SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `dbArreglosExpress` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `dbArreglosExpress` ;

-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cCliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cCliente` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cCliente` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dsNombre` VARCHAR(150) NULL ,
  `dsApellidoPaterno` VARCHAR(100) NULL ,
  `dsApellidoMaterno` VARCHAR(100) NULL ,
  `feNacimiento` DATE NULL ,
  `dsEmail` VARCHAR(100) NULL ,
  `dsPassword` VARCHAR(100) NULL ,
  `cnActivo` BIT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cDireccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cDireccion` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cDireccion` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dsCalle` VARCHAR(100) NULL ,
  `dsColonia` VARCHAR(100) NULL ,
  `dsCodigoPostal` VARCHAR(15) NULL ,
  `dsCiudad` VARCHAR(100) NULL ,
  `dsTelefono` VARCHAR(100) NULL ,
  `dsTelefonoMobile` VARCHAR(100) NULL ,
  `idCliente` INT NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cDireccion_cCliente1_idx` (`idCliente` ASC) ,
  CONSTRAINT `fk_cDireccion_cCliente1`
    FOREIGN KEY (`idCliente` )
    REFERENCES `dbArreglosExpress`.`cCliente` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cMoneda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cMoneda` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cMoneda` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dsSimbolo` VARCHAR(45) NULL ,
  `dsNombre` VARCHAR(45) NULL ,
  `noValor` FLOAT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`CarroCompra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`CarroCompra` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`CarroCompra` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `feRegistro` DATETIME NULL ,
  `idCliente` INT NOT NULL ,
  `idDireccion` INT NOT NULL ,
  `idMoneda` INT NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_CarroCompra_cCliente1_idx` (`idCliente` ASC) ,
  INDEX `fk_CarroCompra_cDireccion1_idx` (`idDireccion` ASC) ,
  INDEX `fk_CarroCompra_cMoneda1_idx` (`idMoneda` ASC) ,
  CONSTRAINT `fk_CarroCompra_cCliente1`
    FOREIGN KEY (`idCliente` )
    REFERENCES `dbArreglosExpress`.`cCliente` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CarroCompra_cDireccion1`
    FOREIGN KEY (`idDireccion` )
    REFERENCES `dbArreglosExpress`.`cDireccion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CarroCompra_cMoneda1`
    FOREIGN KEY (`idMoneda` )
    REFERENCES `dbArreglosExpress`.`cMoneda` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cEstatusVenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cEstatusVenta` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cEstatusVenta` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dsEstatusVenta` VARCHAR(45) NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cIdioma`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cIdioma` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cIdioma` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dsIdioma` VARCHAR(45) NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cOrden`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cOrden` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cOrden` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `mnTransaccion` FLOAT NULL ,
  `noTipoCambio` FLOAT NULL ,
  `idCarroCompra` INT NOT NULL ,
  `idCliente` INT NOT NULL ,
  `idEstatusVenta` INT NOT NULL ,
  `idIdioma` INT NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cOrden_CarroCompra1_idx` (`idCarroCompra` ASC) ,
  INDEX `fk_cOrden_cCliente1_idx` (`idCliente` ASC) ,
  INDEX `fk_cOrden_cEstatusVenta1_idx` (`idEstatusVenta` ASC) ,
  INDEX `fk_cOrden_cIdioma1_idx` (`idIdioma` ASC) ,
  CONSTRAINT `fk_cOrden_CarroCompra1`
    FOREIGN KEY (`idCarroCompra` )
    REFERENCES `dbArreglosExpress`.`CarroCompra` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cOrden_cCliente1`
    FOREIGN KEY (`idCliente` )
    REFERENCES `dbArreglosExpress`.`cCliente` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cOrden_cEstatusVenta1`
    FOREIGN KEY (`idEstatusVenta` )
    REFERENCES `dbArreglosExpress`.`cEstatusVenta` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cOrden_cIdioma1`
    FOREIGN KEY (`idIdioma` )
    REFERENCES `dbArreglosExpress`.`cIdioma` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cProducto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cProducto` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cProducto` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dsNombre` VARCHAR(100) NULL ,
  `dsDescripcion` TEXT NULL ,
  `noPrecio` FLOAT NULL ,
  `noStock` INT NULL ,
  `cnActivo` BIT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cProductoImagen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cProductoImagen` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cProductoImagen` (
  `id` INT NOT NULL ,
  `dsRuta` VARCHAR(45) NULL ,
  `cnVisible` BIT NULL ,
  `idProducto` INT NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cProductoImagen_cProducto1_idx` (`idProducto` ASC) ,
  CONSTRAINT `fk_cProductoImagen_cProducto1`
    FOREIGN KEY (`idProducto` )
    REFERENCES `dbArreglosExpress`.`cProducto` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`MensajeContacto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`MensajeContacto` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`MensajeContacto` (
  `id` INT NOT NULL ,
  `dsContenido` TEXT NULL ,
  `dsNombre` VARCHAR(100) NULL ,
  `dsApellido` VARCHAR(80) NULL ,
  `dsEmail` VARCHAR(80) NULL ,
  `dsTelefono` VARCHAR(60) NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`CarroCompraProducto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`CarroCompraProducto` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`CarroCompraProducto` (
  `noCantidad` INT NULL ,
  `idProducto` INT NOT NULL ,
  `idCarroCompra` INT NOT NULL ,
  `id` INT NOT NULL AUTO_INCREMENT ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  INDEX `fk_CarroCompraProducto_cProducto1_idx` (`idProducto` ASC) ,
  INDEX `fk_CarroCompraProducto_CarroCompra1_idx` (`idCarroCompra` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_CarroCompraProducto_cProducto1`
    FOREIGN KEY (`idProducto` )
    REFERENCES `dbArreglosExpress`.`cProducto` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CarroCompraProducto_CarroCompra1`
    FOREIGN KEY (`idCarroCompra` )
    REFERENCES `dbArreglosExpress`.`CarroCompra` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cTipoUsuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cTipoUsuario` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cTipoUsuario` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dsTipoUsuario` VARCHAR(45) NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cUsuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cUsuario` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cUsuario` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dsNombre` VARCHAR(45) NULL ,
  `dsApellidoPaterno` VARCHAR(45) NULL ,
  `dsApellidoMaterno` VARCHAR(45) NULL ,
  `dsEmail` VARCHAR(45) NULL ,
  `dsUsuario` VARCHAR(45) NULL ,
  `dsPassword` VARCHAR(45) NULL ,
  `idTipoUsuario` INT NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cUsuario_cTipoUsuario1_idx` (`idTipoUsuario` ASC) ,
  CONSTRAINT `fk_cUsuario_cTipoUsuario1`
    FOREIGN KEY (`idTipoUsuario` )
    REFERENCES `dbArreglosExpress`.`cTipoUsuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`cEstatusPago`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`cEstatusPago` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`cEstatusPago` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dsEstatusPago` VARCHAR(45) NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbArreglosExpress`.`Pago`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbArreglosExpress`.`Pago` ;

CREATE  TABLE IF NOT EXISTS `dbArreglosExpress`.`Pago` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `noImporte` FLOAT NULL ,
  `dsIdentificadorPagoPaypal` VARCHAR(60) NULL ,
  `dsMonedaPago` VARCHAR(45) NULL ,
  `dsCorreoComprador` VARCHAR(100) NULL ,
  `idMoneda` INT NOT NULL ,
  `idOrden` INT NOT NULL ,
  `idEstatusPago` INT NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Pago_cMoneda1_idx` (`idMoneda` ASC) ,
  INDEX `fk_Pago_cOrden1_idx` (`idOrden` ASC) ,
  INDEX `fk_Pago_cEstatusPago1_idx` (`idEstatusPago` ASC) ,
  CONSTRAINT `fk_Pago_cMoneda1`
    FOREIGN KEY (`idMoneda` )
    REFERENCES `dbArreglosExpress`.`cMoneda` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pago_cOrden1`
    FOREIGN KEY (`idOrden` )
    REFERENCES `dbArreglosExpress`.`cOrden` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pago_cEstatusPago1`
    FOREIGN KEY (`idEstatusPago` )
    REFERENCES `dbArreglosExpress`.`cEstatusPago` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `dbArreglosExpress` ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
