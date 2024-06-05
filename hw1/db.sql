DROP DATABASE IF EXISTS hw1;
CREATE DATABASE hw1;
USE hw1;

CREATE TABLE users (
    id INT AUTO_INCREMENT,
    username VARCHAR(16) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    birthday DATE NOT NULL, 
    email VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE film (
    id INT AUTO_INCREMENT,
    img MEDIUMBLOB NOT NULL, 
    link VARCHAR(255) NOT NULL, 
    titolo VARCHAR(255) NOT NULL,   
    PRIMARY KEY(id)
) ENGINE = InnoDB;

CREATE TABLE favorites (
    user INT,
    film INT,
    PRIMARY KEY(user, film),
    FOREIGN KEY(user) REFERENCES users(id),
    FOREIGN KEY(film) REFERENCES film(id)
) ENGINE= InnoDB;

CREATE TABLE character_search (
    id INT AUTO_INCREMENT,
    user INT,
    name VARCHAR(255) NOT NULL,
    imageUrl VARCHAR(255),
    films TEXT,
    tvShows TEXT,
    videoGames TEXT,
    parkAttractions TEXT,
    PRIMARY KEY(id),
    FOREIGN KEY(user) REFERENCES users(id)
) ENGINE = InnoDB;
