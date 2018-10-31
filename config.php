<?php
/////////////////////////////////////////////////////
//                                                 //
//  Made by Kai Matolat                            //     
//                                                 //
//                                                 //
//  Under the BSD-3 License                        //
//                                                 //
/////////////////////////////////////////////////////

/* BSD 3-Clause License

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

/* CONFIG FOR DATABASE CONNECTION IN PHP.

DATABASE CREDENTIALS USING ROOT USER AND ROOT PASSWORD - SHOULD NEVER BE PUSHED
TO PRODUCTION UNDER ANY CIRCUMSTANCES. */

// VARIABLES FOR SERVER, USERNAME, PASSWORD & NAME OF DB
$db_server = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'circle_of_friends';

// CONNECT VARIABLE -> TO CONNECT TO THE DATABASE
$connect = mysqli_connect($db_server, $db_username, $db_password, $db_name);

// FOR WHEN ERROR OCCURS CONNECTING TO THE DATABASE
if ($connect == FALSE)
{
    die("Error, could not connect to the MySQL Database, please try again later. " . mysqli_connect_error());
}
?>