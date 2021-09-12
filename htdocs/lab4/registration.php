

<?php

//echo "this page is referenced";



session_start();

$username = "";
$pw = "";
$pw_repeat = "";
$email = "";
$errors = array();




$dbconnection = "mysql: host=localhost; database=artworks";
$user = "root";
$password = "root";


$_mysqli = mysqli_connect("localhost","root","root");
mysqli_select_db($_mysqli,"artworks");

//
////register users
//$username = mysqli_real_escape_string($_mysqli, $HTTP_POST_VARS['username']);
//$pw = mysqli_real_escape_string($_mysqli, $HTTP_POST_VARS['pw']);
//$pw_repeat = mysqli_real_escape_string($_mysqli, $HTTP_POST_VARS['pw_repeat']);
//
////form validation
//if(empty($username)){
//    array_push($errors, "username is required");
//}
//if(empty($email)){
//    array_push($errors, "email is required");
//}
//if(empty($pw)){
//    array_push($errors, "pw is required");
//}
//if(pw != $pw_repeat){
//    array_push($errors, "passwords do not match each other");
//}
//
////check db for existing user with the same username
//
//$user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
//$results = mysql_query($_mysqli, $user_check_query);
//$user = mysqli_fetch_assoc($results);
//
//if($user){
//    if($user['username']== $username){
//        array_push($errors, "username already exists");
//    }
//}
//
//if(count($errors)==0){
//    $password = mdS($pw);
//    $user_register_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
//}
//
//mysqli_query($_mysqli, $user_register_query);
//$_SESSION['username'] = $username;
//$_SESSION['success'] = "You are successfully logged in";
//
//header('location: index.php');
//
//
