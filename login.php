<?php 
/////////////////////////////////////////////////////
//                                                 //
//  Made by Kai Matolat                            //     
//                                                 //
//                                                 //
//  Under the MIT License                          //
//                                                 //
/////////////////////////////////////////////////////

/* Copyright 2018 Kai Matolat

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

$firstname = $lastname = $password = "";
$password_err = $firstname_err = $lastname_err = "";

// VALIDATE FIRSTNAME
if(isset($_POST['firstname']))
{
    $firstname = $_POST['firstname'];  
} else
{
    $firstname_err = "Please enter a valid firstname.";
}

// VALIDATE LASTNAME
if(empty($_POST['lastname']))
{
    $lastname_err = "Please enter a valid lastname.";
} else
{
    $lastname = $_POST['lastname'];
}

// VALIDATE PASSWORD
if(empty($_POST["password"]))
{
    $password_err = "Please enter a password.";
} else
{
    $password = $_POST["password"];
}

// VALIDATE CREDENTIALS
if(empty($firstname_err) && empty($lastname_err) && empty($password_err))
{
    // PREPARE SELECT STATEMENT
    $sql = "SELECT `user_id`, firstname, lastname, `password` FROM registered_users WHERE firstname = ? AND lastname = ?";

    if($stmt = mysqli_prepare($connect, $sql))
    {
        // BIND VARIABLES TO PARAMETERS
        mysqli_stmt_bind_param($stmt, "ss", $param_firstname, $param_lastname);

        // SET THE PARAMETERS
        $param_firstname = $firstname;
        $param_lastname = $lastname;

        // EXECUTE THE STATEMENT
        if(mysqli_stmt_execute($stmt))
        {
            // STORE THE RESULT
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                // BIND THE RESULT VARIABLES
                mysqli_stmt_bind_result($stmt, $user_id, $firstname, $lastname, $hashed_password);
            
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
                        // PASSWORD IS CORRECT, START NEW SESSION
                        session_start();

                        // STORE DATA IN THE SESSION VARIABLE
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $user_id;
                        $_SESSION["firstname"] = $firstname;
                        $_SESSION["lastname"] = $lastname;

                        // REDIRECT TO WELCOME PAGE
                        header("location: welcome.php");
                    } else
                    {
                        $password_err = "The password you have entered was not valid.";
                    }
                }
            } else
            {
                $firstname_err = "No Account found with that firstname";
                $lastname_err = "No Account found with that lastname";
            }
        } else
        {
            echo "Something went wrong. Please try again later.";
        }
        // CLOSE THE STATEMENT
        mysqli_stmt_close();
    }
    // CLOSE THE CONNECTION
    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (isset($_POST["firstname"])) ? 'has-error' : ''; ?>">
                <label>Firstname</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php if(empty($_POST["firstname"])) {echo $firstname_err;} ?></span>
            </div>
            <div class="form-group <?php echo (empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Lastname</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php if(!empty($lastname_err)) { echo $lastname_err; } ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="insert_user.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>