/*
/////////////////////////////////////////////////////
//                                                 //
//  Made by Kai Matolat                            //     
//                                                 //
//                                                 //
//  Under the MIT License                          //
//                                                 //
/////////////////////////////////////////////////////

Copyright 2018 Kai Matolat

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
documentation files (the "Software"), to deal in the Software without restriction, including without 
limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial 
portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE 
WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, 
DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, 
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */
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
    /* FORGOT TO AND AN OPT-IN/OPT-OUT FUNCTION FOR EMAIL DISPLAY. ADDED IT ON 30/10/2018 */
    /* DID THE FOLLOWING 
    ALTER TABLE registered_users 
    ADD COLUMN display_email INT NOT NULL AFTER email_display;
    */
    display_email INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
/* REGISTERED USERS FRIENDS TABLE */
CREATE TABLE registered_users_friends (
    user_id INT NOT NULL FOREIGN KEY AUTO_INCREMENT,
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
VALUES (null, 'Indooroopilly State High School', '111 Ward Street');