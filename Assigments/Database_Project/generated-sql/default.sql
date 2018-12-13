
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- certifications
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `certifications`;

CREATE TABLE `certifications`
(
    `certification_id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `certification_number` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`certification_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- incident
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `incident`;

CREATE TABLE `incident`
(
    `incident_id` INTEGER NOT NULL AUTO_INCREMENT,
    `date` INTEGER NOT NULL,
    `incident_type` VARCHAR(255) NOT NULL,
    `location` INTEGER NOT NULL,
    `station_id` INTEGER NOT NULL,
    PRIMARY KEY (`incident_id`),
    INDEX `station_id` (`station_id`),
    CONSTRAINT `incident_ibfk_1`
        FOREIGN KEY (`station_id`)
        REFERENCES `station` (`station_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- inventory
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory`
(
    `inventory_id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `brand` VARCHAR(255) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `item_condition` VARCHAR(255) NOT NULL,
    `quantity` INTEGER NOT NULL,
    `station_id` INTEGER NOT NULL,
    PRIMARY KEY (`inventory_id`),
    INDEX `station_id` (`station_id`),
    CONSTRAINT `inventory_ibfk_1`
        FOREIGN KEY (`station_id`)
        REFERENCES `station` (`station_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- involved_party
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `involved_party`;

CREATE TABLE `involved_party`
(
    `involved_party_id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `driver_license` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(255) NOT NULL,
    `insurance_number` VARCHAR(255) NOT NULL,
    `incident_id` INTEGER NOT NULL,
    PRIMARY KEY (`involved_party_id`),
    INDEX `incident_id` (`incident_id`),
    CONSTRAINT `involved_party_ibfk_1`
        FOREIGN KEY (`incident_id`)
        REFERENCES `incident` (`incident_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- jurisdiction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `jurisdiction`;

CREATE TABLE `jurisdiction`
(
    `jurisdiction_id` INTEGER NOT NULL AUTO_INCREMENT,
    `zone_name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`jurisdiction_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- personnel
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `personnel`;

CREATE TABLE `personnel`
(
    `personnel_id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `height` VARCHAR(255) NOT NULL,
    `weight` INTEGER NOT NULL,
    `ssn` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(255) NOT NULL,
    `shift_id` INTEGER NOT NULL,
    `certification_id` INTEGER NOT NULL,
    `station_id` INTEGER NOT NULL,
    PRIMARY KEY (`personnel_id`),
    INDEX `shift_id` (`shift_id`),
    INDEX `certification_id` (`certification_id`),
    INDEX `station_id` (`station_id`),
    CONSTRAINT `personnel_ibfk_1`
        FOREIGN KEY (`shift_id`)
        REFERENCES `shift` (`shift_id`),
    CONSTRAINT `personnel_ibfk_2`
        FOREIGN KEY (`certification_id`)
        REFERENCES `certifications` (`certification_id`),
    CONSTRAINT `personnel_ibfk_3`
        FOREIGN KEY (`station_id`)
        REFERENCES `station` (`station_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- personnel_equipment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `personnel_equipment`;

CREATE TABLE `personnel_equipment`
(
    `personnel_equipment_id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `brand` VARCHAR(255) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `equipment_condition` VARCHAR(255) NOT NULL,
    `serial_number` VARCHAR(255) NOT NULL,
    `personnel_id` INTEGER NOT NULL,
    PRIMARY KEY (`personnel_equipment_id`),
    INDEX `personel_id` (`personnel_id`),
    CONSTRAINT `personnel_equipment_ibfk_1`
        FOREIGN KEY (`personnel_id`)
        REFERENCES `personnel` (`personnel_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shift
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shift`;

CREATE TABLE `shift`
(
    `shift_id` INTEGER NOT NULL AUTO_INCREMENT,
    `shift_name` VARCHAR(255) NOT NULL,
    `station_id` INTEGER NOT NULL,
    PRIMARY KEY (`shift_id`),
    INDEX `station_id` (`station_id`),
    CONSTRAINT `shift_ibfk_2`
        FOREIGN KEY (`station_id`)
        REFERENCES `station` (`station_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- station
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `station`;

CREATE TABLE `station`
(
    `station_id` INTEGER NOT NULL AUTO_INCREMENT,
    `station_name` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `jurisdiction_id` INTEGER NOT NULL,
    PRIMARY KEY (`station_id`),
    INDEX `jurisdiction_id` (`jurisdiction_id`),
    CONSTRAINT `station_ibfk_3`
        FOREIGN KEY (`jurisdiction_id`)
        REFERENCES `jurisdiction` (`jurisdiction_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- supervisors
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `supervisors`;

CREATE TABLE `supervisors`
(
    `supervisor_id` INTEGER NOT NULL AUTO_INCREMENT,
    `rank` INTEGER NOT NULL,
    `personnel_id` INTEGER NOT NULL,
    PRIMARY KEY (`supervisor_id`),
    INDEX `personnel_id` (`personnel_id`),
    CONSTRAINT `supervisors_ibfk_1`
        FOREIGN KEY (`personnel_id`)
        REFERENCES `personnel` (`personnel_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `user_id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_name` VARCHAR(255) NOT NULL,
    `user_password` VARCHAR(255) NOT NULL,
    `station_id` INTEGER NOT NULL,
    `admin` TINYINT(1) NOT NULL,
    PRIMARY KEY (`user_id`),
    INDEX `station_id` (`station_id`),
    CONSTRAINT `user_ibfk_1`
        FOREIGN KEY (`station_id`)
        REFERENCES `station` (`station_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vehicles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles`
(
    `vehicle_id` INTEGER NOT NULL AUTO_INCREMENT,
    `make` VARCHAR(255) NOT NULL,
    `model` VARCHAR(255) NOT NULL,
    `year` INTEGER NOT NULL,
    `vin` VARCHAR(255) NOT NULL,
    `mileage` INTEGER NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `license_plate` VARCHAR(255) NOT NULL,
    `station_id` INTEGER NOT NULL,
    `in_service` TINYINT(1) NOT NULL,
    PRIMARY KEY (`vehicle_id`),
    INDEX `station_id` (`station_id`),
    CONSTRAINT `vehicles_ibfk_2`
        FOREIGN KEY (`station_id`)
        REFERENCES `station` (`station_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
