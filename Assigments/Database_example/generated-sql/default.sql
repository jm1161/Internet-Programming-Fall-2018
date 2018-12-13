
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- person
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `person`;

CREATE TABLE `person`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- phone_numbers
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `phone_numbers`;

CREATE TABLE `phone_numbers`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `number` VARCHAR(128) NOT NULL,
    `person_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `person_id` (`person_id`),
    CONSTRAINT `phone_numbers_ibfk_1`
        FOREIGN KEY (`person_id`)
        REFERENCES `person` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
