CREATE TABLE `models` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(30) NOT NULL COMMENT 'Имя модели',
    `telegram` VARCHAR(30) NOT NULL COMMENT 'Телеграм модели',
    `phone` VARCHAR(15) NOT NULL COMMENT 'Номер телефона модели',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;