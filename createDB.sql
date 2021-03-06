CREATE DATABASE testdb;
USE testdb;

CREATE TABLE IF NOT EXISTS posts (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`userId` INT,
	`title` VARCHAR(255) NOT NULL,
	`body` TEXT
);

CREATE TABLE IF NOT EXISTS comments (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`postId` INT,
	`name` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`body` TEXT,
	FOREIGN KEY (postId) REFERENCES posts (id)
) ;