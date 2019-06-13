
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- recipe
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `recipe`;

CREATE TABLE `recipe`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `image_url` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(1024) NOT NULL,
    `prep_time` INTEGER NOT NULL,
    `total_time` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- steps
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `steps`;

CREATE TABLE `steps`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `step_number` INTEGER NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `recipe_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `recipe_id` (`recipe_id`),
    CONSTRAINT `steps_ibfk_1`
        FOREIGN KEY (`recipe_id`)
        REFERENCES `recipe` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
