<?php
/////////////////////////////////////////////////////
//                                                 //
//  Made by Kai Matolat                            //     
//                                                 //
//  Under the MIT License                          //
//                                                 //
//                                                 //
/////////////////////////////////////////////////////

/* Copyright 2018 Kai Matoalt

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

/* CONFIG FOR DATABASE CONNECTION IN PHP.

DATABASE CREDENTIALS USING ROOT USER AND ROOT PASSWORD - SHOULD NEVER BE PUSHED
TO PRODUCTION UNDER ANY CIRCUMSTANCES. */
$db_server = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'circle_of_friends';

$connect = mysqli_connect($db_server, $db_username, $db_password, $db_name);

if ($connect == FALSE)
{
    die("Error, could not connect to the MySQL Database, please try again later. " . mysqli_connect_error());
}
?>