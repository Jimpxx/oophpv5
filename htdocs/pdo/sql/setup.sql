-- Ensure its UTF8 on the database connection
SET NAMES utf8;
-- SET NAMES utf8mb4;

--
-- Create table for my own movie database
--
DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie`
(
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `title` VARCHAR(100) NOT NULL,
    `director` VARCHAR(100),
    `length` INT DEFAULT NULL,            -- Length in minutes
    `year` INT NOT NULL DEFAULT 1900,
    `plot` TEXT,                          -- Short intro to the movie
    `image` VARCHAR(100) DEFAULT NULL,    -- Link to an image
    `subtext` CHAR(3) DEFAULT NULL,       -- swe, fin, en, etc
    `speech` CHAR(3) DEFAULT NULL,        -- swe, fin, en, etc
    `quality` CHAR(3) DEFAULT NULL,
    `format` CHAR(3) DEFAULT NULL         -- mp4, divx, etc
)
ENGINE INNODB
CHARSET utf8
COLLATE utf8_swedish_ci
-- CHARSET utf8mb4
-- COLLATE utf8mb4_swedish_ci
;

DELETE FROM `movie`;
INSERT INTO `movie` (`title`, `year`, `image`) VALUES
    ('Avengers: Endgame', 2019, 'img/avengers_endgame.jpg'),
    ('Inception', 2010, 'img/inception.jpg'),
    ('Interstellar', 2014, 'img/interstellar.jpg'),
    ('Spider-Man: Homecoming', 2017, 'img/spiderman.jpg'),
    ('Instant Family', 2018, 'img/instant_family.jpg')
;

SELECT * FROM `movie`;
