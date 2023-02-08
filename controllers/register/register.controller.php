<?php
session_start();
require "database/database.php";
require "models/users.model.php";

    // variable get post
    // if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // variable get post
    // $first_name = $_POST['first_name'];
    // $last_name = $_POST['last_name'];
    // $email = $_POST['email'];
    // $password = $_POST['password'];
    // $verify_pass = $_POST['verify_pass'];


    // variable get post
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // variable get post
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $verify_pass = $_POST['verify_pass'];
        $errors = [];
        // firstname validatiion
        if(empty($first_name)) {
            $errors['first_name'] = 'Please enter a first name';
        };
        // check if name only contains letters and whitespace  
        if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {  
            $errors['first_name'] = "Only alphabets and white space are allowed";  
        };
        // last name validation 
        if(empty($last_name)) {
            $errors['last_name'] = 'Please enter a last name';
        };
        // check if name only contains letters and whitespace  
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST['first_name'])) {  
            $errors['last_name'] = "Only alphabets and white space are allowed";  
        };
        // email validation
        if(empty($email)) {
            $errors['email'] = 'Please enter an email address';
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){  
            $errors['email'] = "Invalid email format";  
        }
        // password validation
        if(empty($password)) {
            $errors['password'] = 'Please enter a password';
        }
        $specialChars = preg_match('@[^\w]@', $password);
        if(strlen($password) <= 8 || !$specialChars){
            $errors['password'] = 'Password must be at least 8 characters and one special character';
        }

        if (empty($errors['verify_pass']) && empty($errors['password']) && empty($errors['email']) && empty($errors['last_name']) && empty($errors['first_name'])){
            // verify password validation
            if(empty($verify_pass)) {
                $errors['verify_pass'] = 'please enter a your verify password';
            }
            if ($verify_pass !== $password) {
                $errors['verify_pass'] = "your password is not match";
            }
            if (empty($errors['verify_pass']) && empty($errors['password']) && empty($errors['email']) && empty($errors['last_name']) && empty($errors['first_name'])) {
                $users = getUser();
                foreach($users as $user){
                    if($email == $user['email']){
                        $errors['email'] = "Your enter already exist user";
                    }
                }
                if(empty($errors['password']) && empty($errors['email'])){
                    createUser($first_name, $last_name, $email,$password);
                    header('Location: /');
                }
        }
    }
}









//   if complete all true
//         if(!empty($first_name) && !empty($last_name) && !empty($email)&& !empty($password)){
//         createUser($first_name, $last_name, $email,$password);
//     header('Location: /');
// }

    // $errors = [];
// firstname validatiion
    // if(empty($first_name)) {
    //     $errors['first_name'] = 'Please enter a first name';
    // }else{
// check if name only contains letters and whitespace  
    //     if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {  
    //         $errors['first_name'] = "Only alphabets and white space are allowed";  
    //     };
    // }
// last name validatiion 
    // if(empty($_POST['last_name'])) {
    //     $errors['last_name'] = 'Please enter a last name';
    // }else{
// check if name only contains letters and whitespace  
    //     if (!preg_match("/^[a-zA-Z ]*$/",$_POST['first_name'])) {  
    //         $errors['last_name'] = "Only alphabets and white space are allowed";  
    //     };
    // }
// email validation
    // if(empty($_POST['email'])) {
    //     $errors['email'] = 'Please enter an email address';
    // }else{
    //     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){  
    //     $errors['email'] = "Invalid email format";  
    // }
    // }
// password validation
    // if(empty($_POST['password'])) {
    //     $errors['password'] = 'Please enter a password';
    // }
// verify password validation
//     if(empty($_POST['verify_pass'])) {
//         $errors['verify_pass'] = 'please enter a your verify password';
//     }else{
//         if ($_POST['verify_pass'] !== $_POST['password']) {
//             $errors['verify_pass'] = "your password is not match";
//         }
//     }       
// }

require "views/register/register.view.php";