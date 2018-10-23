/* CREATES DATABASE */
CREATE DATABASE circle_of_friends;

/* TABLE CREATION */
/* REGISTERED USERS TABLE */
CREATE TABLE registered_users (
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(20) NOT NULL,
    lastname VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email_address VARCHAR(255) NOT NULL,
    email_display VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
/* REGISTERED USERS FRIENDS TABLE */
CREATE TABLE registered_users_friends (
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(20) NOT NULL,
    lastname VARCHAR(20) NOT NULL,
    friends_with INT NOT NULL,
);
/* SCHOOL INFORMATION TABLE */
CREATE TABLE school_information (
    school_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    school_name VARCHAR(50) NOT NULL,
    location VARCHAR(50) NOT NULL
);

/* INSERTING DATA INTO SCHOOL INFORMATION TABLE EXAMPLE */
INSERT INTO school_information (school_id, school_name, location) 
VALUES (null, 'Indooroopilly State High School', '11 Ward Street');