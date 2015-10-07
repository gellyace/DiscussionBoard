--
-- Create database
--
CREATE DATABASE IF NOT EXISTS board;
GRANT SELECT, INSERT, UPDATE, DELETE ON board.* TO 'root'@'localhost' IDENTIFIED BY 'root';
FLUSH PRIVILEGES;

					
--
-- Create tables
--

					
USE board;
					
CREATE TABLE IF NOT EXISTS thread (
id                      INT UNSIGNED NOT NULL AUTO_INCREMENT,
user_id					INT UNSIGNED NOT NULL,
title                   VARCHAR(50) NOT NULL,
category 				VARCHAR(50) NOT NULL,
created              	DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES user(id)
)ENGINE=InnoDB;

					
CREATE TABLE IF NOT EXISTS comment (
id                      INT UNSIGNED NOT NULL AUTO_INCREMENT,
thread_id               INT UNSIGNED NOT NULL,
user_id                 INT UNSIGNED NOT NULL,
body                    TEXT NOT NULL,
created                 DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id),
INDEX (thread_id, created),
FOREIGN KEY (thread_id) REFERENCES thread(id),
FOREIGN KEY (user_id) REFERENCES user(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS user (
id                      INT UNSIGNED NOT NULL AUTO_INCREMENT,
username                VARCHAR(50) NOT NULL,
firstname               VARCHAR(50) NOT NULL,
lastname                VARCHAR(50) NOT NULL,
email                   VARCHAR(50) NOT NULL,
password                VARCHAR(50) NOT NULL,
status					VARCHAR(50) NOT NULL,
created                 DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS liked (
id                      INT UNSIGNED NOT NULL AUTO_INCREMENT,
user_id					INT UNSIGNED NOT NULL,
comment_id				INT UNSIGNED NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES user(id),
FOREIGN KEY (comment_id) REFERENCES comment(id)
)ENGINE=InnoDB;

