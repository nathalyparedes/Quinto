-- MySQL Script generated by MySQL Workbench
-- Sun Jul  7 17:00:09 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema ejercicio1
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ejercicio1
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ejercicio1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `ejercicio1` ;

-- -----------------------------------------------------
-- Table `ejercicio1`.`Clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ejercicio1`.`Clientes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NULL DEFAULT NULL,
  `apellido` VARCHAR(50) NULL DEFAULT NULL,
  `email` VARCHAR(100) NULL DEFAULT NULL,
  `telefono` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `ejercicio1`.`Productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ejercicio1`.`Productos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NULL DEFAULT NULL,
  `precio` DECIMAL(10,2) NULL DEFAULT NULL,
  `stock` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `ejercicio1`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ejercicio1`.`roles` (
  `RolesId` INT NOT NULL AUTO_INCREMENT,
  `detalle` VARCHAR(15) NULL DEFAULT NULL,
  PRIMARY KEY (`RolesId`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `ejercicio1`.`RolesUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ejercicio1`.`RolesUsuario` (
  `UsuariosRolesId` INT NOT NULL AUTO_INCREMENT,
  `IdRoles` INT NULL DEFAULT NULL,
  `IdUsuarios` INT NULL DEFAULT NULL,
  PRIMARY KEY (`UsuariosRolesId`),
  INDEX `IdRoles` (`IdRoles` ASC) VISIBLE,
  INDEX `IdUsuarios` (`IdUsuarios` ASC) VISIBLE,
  CONSTRAINT `rolesusuario_ibfk_1`
    FOREIGN KEY (`IdRoles`)
    REFERENCES `ejercicio1`.`roles` (`RolesId`),
  CONSTRAINT `rolesusuario_ibfk_2`
    FOREIGN KEY (`IdUsuarios`)
    REFERENCES `ejercicio1`.`Usuarios` (`UsuarioId`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `ejercicio1`.`Ventas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ejercicio1`.`Ventas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NULL DEFAULT NULL,
  `cliente_id` INT NULL DEFAULT NULL,
  `total` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `cliente_id` (`cliente_id` ASC) VISIBLE,
  CONSTRAINT `ventas_ibfk_1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `ejercicio1`.`Clientes` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `ejercicio1`.`VentasDetalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ejercicio1`.`VentasDetalle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `venta_id` INT NULL DEFAULT NULL,
  `producto_id` INT NULL DEFAULT NULL,
  `cantidad` INT NULL DEFAULT NULL,
  `precio` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `venta_id` (`venta_id` ASC) VISIBLE,
  INDEX `producto_id` (`producto_id` ASC) VISIBLE,
  CONSTRAINT `ventasdetalle_ibfk_1`
    FOREIGN KEY (`venta_id`)
    REFERENCES `ejercicio1`.`Ventas` (`id`),
  CONSTRAINT `ventasdetalle_ibfk_2`
    FOREIGN KEY (`producto_id`)
    REFERENCES `ejercicio1`.`Productos` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `ejercicio1`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ejercicio1`.`usuarios` (
  `UsuarioId` INT NOT NULL AUTO_INCREMENT,
  `Nombre` TEXT NOT NULL,
  `correo` TEXT NOT NULL,
  `password` TEXT NOT NULL,
  PRIMARY KEY (`UsuarioId`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
