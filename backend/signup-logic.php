<?php
require 'config/database.php';

//get signup form data if signup button was clicked
if (isset($_POST['submit'])) {
     $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $avatar = $_FILES['avatar'];
      

     //validate input values
     if (!$firstname) {
        $_SESSION['signup'] = "Please enter your First Name";
     } elseif (!$lastname) {
        $_SESSION['signup'] = "Please enter your Last Name";
     } elseif (!$username) {
        $_SESSION['signup'] = "Please enter your User Name";
     } elseif (!$email) {
        $_SESSION['signup'] = "Please enter your a valid email";
     } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should be 8+ characters";
     } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Please add avatar";
     } else {
        //check if passwords don't match
        if($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Passwords don't match";
        } else {
            // hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
        echo $createpassword . '<br/>';
        echo $hashed_password;
        
        }
     }



    } else {
    // if button wasn't clicked, bounce back to signup page
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
