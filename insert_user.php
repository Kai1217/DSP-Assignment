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
/* PHP CODE IN PROCEDURAL/FUNCTIONAL PARADIGM AND OBJECT ORIENTED PARADIGM */
/* INCLUSION OF CONFIG.PHP */
require_once "config.php";

// DECLARATION OF VARIABLES AND PARAMETER VARIABLES
$firstname = $lastname = $password = $confirm_password = $email_address = $email_display = $checkbox = "";
$firstname_err = $lastname_err = $password_err = $email_err = $confirm_password_err = $checkbox_err = "";

// PROCESSING FORM DATA WHEN SUBMITTED BY CLIENT
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // VALIDATE FIRSTNAME
    if(empty(trim($_POST["firstname"])))
    {
        $firstname_err = "Please enter a firstname.";
    } else
    {
        // PREPARE THE SELECT STATEMENT
        $sql = "SELECT user_id FROM registered_users WHERE firstname = ?";

        if($stmt = mysqli_prepare($connect, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_firstname);

            $param_firstname = trim($_POST["firstname"]);

            // EXECUTE PREPARED STATEMENT
            if(mysqli_stmt_execute($stmt))
            {
                // STORE THE RESULT
                mysqli_stmt_store_result($stmt);

                $firstname = trim($_POST["firstname"]);
            }
        }
        $stmt->close();
    }
    // VALIDATE LASTNAME
    if(empty(trim($_POST["lastname"])))
    {
        $lastname_err = "Please enter a lastname.";
    } else
    {
        // PREPARE THE SELECT STATEMENT
        $sql = "SELECT user_id FROM registered_users WHERE lastname = ?";

        if($stmt = mysqli_prepare($connect, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_lastname);

            $param_lastname = trim($_POST["lastname"]);

            // EXECUTE PREPARED STATEMENT
            if(mysqli_stmt_execute($stmt))
            {
                // STORE THE RESULT
                mysqli_stmt_store_result($stmt);

                $lastname = trim($_POST["lastname"]);
            }
        }
    }
    $stmt->close();

    // EMAIL ADDRESS VALIDATION AND EMAIL DISPLAY VALIDATION

    if(empty(trim($_POST["email"])))
    {
        $email_err = "Please enter an email address.";
    } else
    {
        // PREPARE INSERT STATEMENT
        $sql = "SELECT user_id FROM registered_users WHERE email_address = ? AND email_display = ?";

        if($stmt = mysqli_prepare($connect, $sql))
        {
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_email_display);

            $param_email = trim($_POST["email"]);
            $param_email_display = trim($_POST["email"]);

            // EXECUTE PREPARED STATEMENT
            if(mysqli_stmt_execute($stmt))
            {
                // STORE THE RESULT
                mysqli_stmt_store_result($stmt);

                $email_address = trim($_POST["email"]);
                $email_display = trim($_POST["email"]);
            }
        }
    }
    $stmt->close();

    // VALIDATE PASSWORD
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password";
    } elseif(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have atleast 6 characters.";
    } else
    {
        $password = trim($_POST["password"]);
    }

    // VALIDATE CONFIRM PASSWORD
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm password.";
    } else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_pasword_err = "Password did not match!";
        }
    }

    // CHECK FOR INPUT ERRORS BEFORE INSERTING INTO THE DATABASE
    if(empty($firstname_err) && empty($lastname_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($checkbox_err))
    {
        // PREPARE THE INSERT STATEMENT
        $sql = "INSERT INTO registered_users (firstname, lastname, `password`, `email_address`, email_display, display_email) VALUES (?, ?, ?, ?, ?, ?)";

        if($stmt = $connect->prepare($sql))
        {
            mysqli_stmt_bind_param($stmt, "sssssi", $param_firstname, $param_lastname, $param_password, $param_email, $param_email_display, $param_checkbox);

            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email_address;
            $param_email_display = $email_display;
            // CREATES A PASSWORD HASH WITH BCRYPT HASHING ALGORITHM
            $param_password = password_hash($password, PASSWORD_BCRYPT);

            if($stmt->execute())
            {
                // REDIRECT TO THE LOGIN PAGE
                header("location: login.php");
            } else
            {
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    // CLOSE THE CONNECTION
    mysqli_close($connect);
}
?>
<!-- HTML CODE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- CASCADING STYLE SHEETS LIBRARY - BOOTSTRAP 3.3.7 THROUGH A CONTENT DELIVERY NETWORK -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!-- Local Styling -->    
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }
        .wrapper {
            width: 350px;
            padding: 20px;
        }
        footer {
            display: block;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create a user account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group" <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
            <label>Firstname</label>
            <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
            <span class="help-block"><?php echo $firstname_err; ?></span>
        </div>
        <div class="form-group" <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
            <label>Lastname</label>
            <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
            <span class="help-block"><?php echo $lastname_err; ?></span>
       </div>
       <div class="form-group" <?php echo(!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email Address</label>
            <input type="text" name="email" class="form-control" value="<?php echo $email_address; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
       <div class="form-group" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="text" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group" <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group" <?php echo (!empty($checkbox_err)) ? 'has-error' : ''; ?>">
            <label>Would you like to display your Email?</label><br>
            <input type="checkbox" name="checkbox" class="form-control" value="<?php echo $checkbox; ?>">
            <span class="help-block"><?php echo $checkbox_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Submit">
            <input type="reset" class="btn btn-danger" value="Reset">
        </div>
        <p>Already a registered user? <a href="login.php">Login here</a>.</p>
    </form>
</body>
<footer>
<p>Powered by <a href="https://getbootstrap.com/" target=_blank>Bootstrap.css </a> Under the MIT License</p>
</footer>
</html>
