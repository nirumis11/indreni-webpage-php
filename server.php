<?php
session_start();

// initializing variables
$firstname = "";
$lastname = "";
$phone = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'glassgoverance');

// REGISTER USER
if (isset($_POST['reg_user'])) {

    // receive all input values from the form
    $firstname = mysqli_real_escape_string($db, $_POST['First_Name']);
    $lastname = mysqli_real_escape_string($db, $_POST['Last_Name']);
    $phone = mysqli_real_escape_string($db, $_POST['Phone']);
    $password_1 = mysqli_real_escape_string($db, $_POST['Password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['Password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($firstname)) {
        array_push($errors, "First_Name is required");
    }
    if (empty($lastname)) {
        array_push($errors, "Last_Name is required");
    }
    if (empty($phone)) {
        array_push($errors, "Phone is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password_1 is required");
    }
    if (empty($password_2)) {
        array_push($errors, "Password_2 is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE phone='$phone' LIMIT 1";
    //echo $user_check_query;
    $result = mysqli_query($db, $user_check_query);

    if ($result->num_rows>0) { // if user exists

        array_push($errors, "User already exists");

    }
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {

        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO users (first_name,last_name,phone,password, is_active, creation_date)
 			  VALUES('$firstname','$lastname', '$phone', '$password','1', CURRENT_TIMESTAMP)";

        mysqli_query($db, $query);
        $_SESSION['Phone'] = $phone;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }

}
// LOGIN USER
    if (isset($_POST['login_user'])) {
        $phone = mysqli_real_escape_string($db, $_POST['Phone']);
        $password = mysqli_real_escape_string($db, $_POST['Password']);

        if (empty($phone)) {
            array_push($errors, "Phone is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE phone= '$phone' AND password= '$password'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['Phone'] = $phone;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
            } else {
                array_push($errors, "Wrong phone/password combination");
            }
        }
    }



