/*
/////////////////////////////////////////////////////
//                                                 //
//  Made by Kai Matolat                            //     
//                                                 //
//                                                 //
//  Under the BSD-3 License                        //
//                                                 //
/////////////////////////////////////////////////////

BSD 3-Clause License

Copyright (c) 2018, Kai Matolat
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.

* Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
  and/or other materials provided with the distribution.

* Neither the name of the copyright holder nor the names of its
  contributors may be used to endorse or promote products derived from
  this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. */
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
    user_id INT NOT NULL FOREIGN KEY,
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