SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `cfdifacturacion` DEFAULT CHARACTER SET utf8 ;
USE `cfdifacturacion` ;

-- -----------------------------------------------------
-- Table `cfdifacturacion`.`tipos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cfdifacturacion`.`tipos` ;

CREATE  TABLE IF NOT EXISTS `cfdifacturacion`.`tipos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cfdifacturacion`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cfdifacturacion`.`usuarios` ;

CREATE  TABLE IF NOT EXISTS `cfdifacturacion`.`usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_tipo` INT(1) NOT NULL ,
  `nombre` CHAR(50) NULL DEFAULT NULL ,
  `apellido_paterno` CHAR(50) NULL DEFAULT NULL ,
  `apellido_materno` CHAR(50) NULL DEFAULT NULL ,
  `fecha_nacimiento` DATE NULL DEFAULT NULL ,
  `email` VARCHAR(100) NULL DEFAULT NULL ,
  `usuario` VARCHAR(45) NULL DEFAULT NULL ,
  `clave` VARCHAR(100) NULL DEFAULT NULL ,
  `rfc` VARCHAR(15) NULL DEFAULT NULL ,
  `fecha_alta` DATE NULL DEFAULT NULL ,
  `clave_interna` VARCHAR(45) NULL DEFAULT NULL ,
  `img` VARCHAR(100) NULL DEFAULT NULL ,
  `status` INT(11) NULL DEFAULT '2' COMMENT '0=inactivo,1=activo,2=registro incompleto' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usuarios_1` (`id_tipo` ASC) ,
  CONSTRAINT `fk_usuarios_1`
    FOREIGN KEY (`id_tipo` )
    REFERENCES `cfdifacturacion`.`tipos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cfdifacturacion`.`empresas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cfdifacturacion`.`empresas` ;

CREATE  TABLE IF NOT EXISTS `cfdifacturacion`.`empresas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_usuario` INT NULL ,
  `fecha_alta` DATE NULL ,
  `rfc` VARCHAR(15) NULL ,
  `razon_social` TEXT NULL ,
  `contacto` VARCHAR(100) NULL ,
  `telefono` INT(20) NULL ,
  `email` VARCHAR(50) NULL ,
  `pais` INT NULL ,
  `estado` CHAR(50) NULL ,
  `municipio` VARCHAR(100) NULL ,
  `colonia` TEXT NULL ,
  `localidad` TEXT NULL ,
  `calle` VARCHAR(45) NULL ,
  `numero_interior` VARCHAR(45) NULL ,
  `numero_exterior` VARCHAR(45) NULL ,
  `status` TINYINT NULL COMMENT '0=inactivo,1=activo' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_empresas_1` (`id_usuario` ASC) ,
  CONSTRAINT `fk_empresas_1`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `cfdifacturacion`.`usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
