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

// INITIALISE THE SESSION
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: welcome.php");
    exit;
}
// IMPORTING CONFIG.PHP
require_once "config.php";

$firstname = $lastname = "";
$password = $password_err = "";

// VALIDATE FIRSTNAME
if(empty(trim($_POST["firstname"])))
{
    $firstname_err = "Please enter a first name.";
} else
{
    $firstname = trim($_POST["firstname"]);
}

// VALIDATE LASTNAME
if(empty(trim($_POST["lastname"])))
{
    $lastname_err = "Please enter a last name.";
} else
{
    $lastname = trim($_POST["lastname"]);
}

// VALIDATE PASSWORD
if(empty(trim($_POST["password"])))
{
    $password_err = "Please enter a password.";
} else
{
    $password = trim($_POST["password"]);
}