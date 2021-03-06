
CREATE SCHEMA IF NOT EXISTS `b18_21086667_ManagementScore` DEFAULT CHARACTER SET utf8 ;
USE `b18_21086667_ManagementScore` ;

CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Permission` (
  `position` VARCHAR(200) NOT NULL,
  `power` VARCHAR(100) NULL,
  `selected` INT NOT NULL,
  PRIMARY KEY (`position`, `power`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Account` (
  `idAccount` VARCHAR(10) NOT NULL,
  `accountName` VARCHAR(45) NULL,
  `birthday` DATE NULL,
  `address` VARCHAR(100) NULL,
  `sex` VARCHAR(4) NULL,
  `phone` INT NULL,
  `email` VARCHAR(256) NULL,
  `password` VARCHAR(50) NULL,
  `Permission_position` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idAccount`),
  INDEX `fk_Account_Permission1_idx` (`Permission_position` ASC),
  CONSTRAINT `fk_Account_Permission1`
    FOREIGN KEY (`Permission_position`)
    REFERENCES `b18_21086667_ManagementScore`.`Permission` (`position`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Academy` (
  `idAcademy` VARCHAR(10) NOT NULL,
  `academyName` VARCHAR(256) NULL,
  PRIMARY KEY (`idAcademy`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Class` (
  `idClass` VARCHAR(10) NOT NULL,
  `className` VARCHAR(70) NULL,
  `schoolYear` VARCHAR(2) NULL,
  `Academy_idAcademy` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idClass`),
  INDEX `fk_Class_Academy1_idx` (`Academy_idAcademy` ASC),
  CONSTRAINT `fk_Class_Academy1`
    FOREIGN KEY (`Academy_idAcademy`)
    REFERENCES `b18_21086667_ManagementScore`.`Academy` (`idAcademy`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Branch` (
  `idBranch` VARCHAR(10) NOT NULL,
  `branchName` VARCHAR(256) NULL,
  `city` VARCHAR(256) NULL,
  PRIMARY KEY (`idBranch`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`PractiseScores` (
  `scores` INT NOT NULL,
  `semester` VARCHAR(2) NOT NULL,
  `years` VARCHAR(11) NOT NULL,
  `Account_idAccount` VARCHAR(10) NOT NULL,
  `beginDate` DATE NULL,
  `endDate` DATE NULL,
  PRIMARY KEY (`Account_idAccount`, `semester`, `years`),
  INDEX `fk_PractiseScores_Account1_idx` (`Account_idAccount` ASC),
  CONSTRAINT `fk_PractiseScores_Account1`
    FOREIGN KEY (`Account_idAccount`)
    REFERENCES `b18_21086667_ManagementScore`.`Account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`CalendarScoring` (
  `openDate` DATE NOT NULL,
  `closeDate` DATE NOT NULL,
  `Permission_position` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`Permission_position`, `openDate`, `closeDate`),
  INDEX `fk_CalendarScoring_Permission1_idx` (`Permission_position` ASC),
  CONSTRAINT `fk_CalendarScoring_Permission1`
    FOREIGN KEY (`Permission_position`)
    REFERENCES `b18_21086667_ManagementScore`.`Permission` (`position`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Structure` (
  `idItem` VARCHAR(10) NOT NULL,
  `itemName` VARCHAR(512) NULL,
  `scores` INT NULL,
  `describe` VARCHAR(512) NULL,
  `IDParent` VARCHAR(10) NULL,
  `scoresDefault` INT NULL,
  PRIMARY KEY (`idItem`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Account_has_Branch` (
  `Account_idAccount` VARCHAR(10) NOT NULL,
  `Branch_idBranch` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`Account_idAccount`, `Branch_idBranch`),
  INDEX `fk_Account_has_Branch_Branch1_idx` (`Branch_idBranch` ASC),
  INDEX `fk_Account_has_Branch_Account1_idx` (`Account_idAccount` ASC),
  CONSTRAINT `fk_Account_has_Branch_Account1`
    FOREIGN KEY (`Account_idAccount`)
    REFERENCES `b18_21086667_ManagementScore`.`Account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Account_has_Branch_Branch1`
    FOREIGN KEY (`Branch_idBranch`)
    REFERENCES `b18_21086667_ManagementScore`.`Branch` (`idBranch`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Transcript` (
  `idItem` VARCHAR(10) NOT NULL,
  `Account_idAccount` VARCHAR(10) NOT NULL,
  `itemName` VARCHAR(512) NULL,
  `scores` INT NULL,
  `describe` VARCHAR(512) NULL,
  `IDParent` VARCHAR(10) NULL,
  `scoresDefault` INT NULL,
  `scoresMax` INT NULL,
  `scoresStudent` INT NULL,
  `scoresTeacher` INT NULL,
  PRIMARY KEY (`idItem`, `Account_idAccount`),
  INDEX `fk_Transcript_has_Account_Account1_idx` (`Account_idAccount` ASC),
  CONSTRAINT `fk_Transcript_has_Account_Account1`
    FOREIGN KEY (`Account_idAccount`)
    REFERENCES `b18_21086667_ManagementScore`.`Account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`ScoresAdd` (
  `idScore` VARCHAR(10) NOT NULL,
  `scoreName` VARCHAR(255) NULL,
  `scores` INT NULL,
  `describe` VARCHAR(512) NULL,
  `Transcript_idItem` VARCHAR(10) BINARY NOT NULL,
  `idAccountManage` VARCHAR(10) NULL,
  PRIMARY KEY (`idScore`),
  INDEX `fk_ScoresAdd_Transcript1_idx` (`Transcript_idItem` ASC),
  CONSTRAINT `fk_ScoresAdd_Transcript1`
    FOREIGN KEY (`Transcript_idItem`)
    REFERENCES `b18_21086667_ManagementScore`.`Transcript` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Image` (
  `Image` VARCHAR(200) NOT NULL,
  `Account_idAccount` VARCHAR(10) NOT NULL,
  `Transcript_idItem` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`Image`, `Account_idAccount`),
  INDEX `fk_Image_Account1_idx` (`Account_idAccount` ASC),
  INDEX `fk_Image_Transcript1_idx` (`Transcript_idItem` ASC),
  CONSTRAINT `fk_Image_Account1`
    FOREIGN KEY (`Account_idAccount`)
    REFERENCES `b18_21086667_ManagementScore`.`Account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Image_Transcript1`
    FOREIGN KEY (`Transcript_idItem`)
    REFERENCES `b18_21086667_ManagementScore`.`Transcript` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Account_has_Class` (
  `Account_idAccount` VARCHAR(10) NOT NULL,
  `Class_idClass` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`Account_idAccount`, `Class_idClass`),
  INDEX `fk_Account_has_Class_Class1_idx` (`Class_idClass` ASC),
  INDEX `fk_Account_has_Class_Account1_idx` (`Account_idAccount` ASC),
  CONSTRAINT `fk_Account_has_Class_Account1`
    FOREIGN KEY (`Account_idAccount`)
    REFERENCES `b18_21086667_ManagementScore`.`Account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Account_has_Class_Class1`
    FOREIGN KEY (`Class_idClass`)
    REFERENCES `b18_21086667_ManagementScore`.`Class` (`idClass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Account_has_Academy` (
  `Account_idAccount` VARCHAR(10) NOT NULL,
  `Academy_idAcademy` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`Account_idAccount`, `Academy_idAcademy`),
  INDEX `fk_Account_has_Academy_Academy1_idx` (`Academy_idAcademy` ASC),
  INDEX `fk_Account_has_Academy_Account1_idx` (`Account_idAccount` ASC),
  CONSTRAINT `fk_Account_has_Academy_Account1`
    FOREIGN KEY (`Account_idAccount`)
    REFERENCES `b18_21086667_ManagementScore`.`Account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Account_has_Academy_Academy1`
    FOREIGN KEY (`Academy_idAcademy`)
    REFERENCES `b18_21086667_ManagementScore`.`Academy` (`idAcademy`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`ScoresAdd_has_Account` (
  `ScoresAdd_idScore` VARCHAR(10) NOT NULL,
  `Account_idAccount` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`ScoresAdd_idScore`, `Account_idAccount`),
  INDEX `fk_ScoresAdd_has_Account_Account1_idx` (`Account_idAccount` ASC),
  INDEX `fk_ScoresAdd_has_Account_ScoresAdd1_idx` (`ScoresAdd_idScore` ASC),
  CONSTRAINT `fk_ScoresAdd_has_Account_ScoresAdd1`
    FOREIGN KEY (`ScoresAdd_idScore`)
    REFERENCES `b18_21086667_ManagementScore`.`ScoresAdd` (`idScore`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ScoresAdd_has_Account_Account1`
    FOREIGN KEY (`Account_idAccount`)
    REFERENCES `b18_21086667_ManagementScore`.`Account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `b18_21086667_ManagementScore`.`Years_semester` (
  `semester` VARCHAR(2) NOT NULL,
  `years` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`semester`, `years`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
