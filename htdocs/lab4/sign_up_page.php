<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet"  type="text/css" href="style.css" media="all">

</head>


<body>

    <?php

    $_mysqli = mysqli_connect("localhost","root","root");
    mysqli_select_db($_mysqli, "artworks");
    if($_mysqli->connect_error){
        die("connection failed:".$_mysqli->error);
    }
//    $gigi = "gigi";
//    $email = "gybstasia@gmail.com";
//    $password = "pw1609PW";
//    $tel = 1103;
//    $balance = 9999;
//    $inset = "INSERT INTO users (name, email, password, tel, address, balance) VALUES ('".$gigi."', '".$email."', '".$password."', $tel, 'gigi road', 9999)";
//    $insert = mysqli_query($_mysqli, $inset);
    //echo"connected successfully";
    ?>
    <?php

    if(isset($_SESSION['username'])){
        $url = "Homepage.php";
        echo '<html><head><script>alert("you already logged in!" );</script></head></html>' .
            "<meta http-equiv=\"refresh\" content=\"0;url=" . $url . "\">";
    }
    ?>

<script src="someFunctions.js" type="text/javascript"></script>

    <video autoplay muted loop id = "bgv">
        <source src = "background/1.mp4" type="video/mp4">
    </video>

    <div class = container style = "position: absolute; top:0; right: 0">
        <?php
        if(empty($_SESSION['username'])&&empty($_SESSION['password'])) {
            if(isset($_SESSION['username']))
                echo "successfully logged in，" . $_SESSION['username'] . "<a href='LogOut.php' >log out</a>";
            else
                echo "You are not logged in,<a href='LogInPage.php'>go log in</a>";
        }else{
            echo "successfully logged in, welcome:".$_SESSION['username']."<a href='LogOut.php'>log out</a>";
        }

        ?>
    </div>

    <nav class = viewport_header>
        <ul>
            <li><a href = "Homepage.php">Home</a>
            </li>
            <li><a href = "search.php">Search</a>
                <span>
                                    </span>
            </li>
            <li><a href = "LogInPage.php">Sign_In</a>
                <span>
                                    </span>
            </li>
            <li><a href="sign_up_page.php">Sign_Up</a>
                <span>
                                    </span>
            </li>
            <?php
            if (isset($_SESSION['username'])&&isset($_SESSION['password'])){
                echo"<li><a href = favorites.php>Personal</a></li>";
            }
            ?>
        </ul>
    </nav>


    <form action = "sign_up_page.php" method = "POST" onsubmit="signUpValidate()" name = "signUpForm" >

        <section class="viewport_header" style = "padding-top: 100pt">
            <article style = "text-align: center">
                <br>USERNAME</br>
                <br><input type = "text" name = "username"></br>
                <br>EMAIL</br>
                <br><input type = "text" name = "email"></br>
                <br>PASSWORD</br>
                <br><input type = "password" name = "password"></br>
                <br>CONFIRM YOUR PASSWORD</br>
                <br><input type="password" name = "pwd_repeat"></br>
                <br>TEL</br>
                <br><input type = "tel" name = "tel"></br>
                <br>Address</br>
                <br><input type = 'text' name = "address"></br>
                <br><input type = "submit"></br>
                <br>ALREADY HAVE AN ACCOUNT?</br>
                <br><a href = LogInPage.php style = "color: dimgrey">LOG IN HERE</a></br>
                <br><a href = Homepage.php style = "color: dimgrey"> BACK TO HOME PAGE</a></br>
            </article>
        </section>
    </form>

    <?php

//    echo $_POST['username'];
//    echo $_POST['email'];
//    echo $_POST['password'];
//    echo $_POST['tel'];
//    echo $_POST['address'];
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])
    && isset($_POST['tel']) && isset($_POST['address'])) {
        //echo $_POST['address'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];
        if(empty($username)){
            echo '<html><script>alert("uname must be filled out" );</script></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=sign_up_page.php\">";
        }if( empty($email)){
            echo '<html><script>alert("email must be filled out" );</script></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=sign_up_page.php\">";
        }if( empty($password) ){
            echo '<html><script>alert("pwd must be filled out" );</script></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=sign_up_page.php\">";
        }if(empty($tel) ){
            echo '<html><script>alert("tel must be filled out" );</script></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=sign_up_page.php\">";
        }if(empty($address)){
            echo '<html><script>alert("address must be filled out" );</script></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=sign_up_page.php\">";
        }else{
        //echo $username, $password, $tel, $email, $address;
        $checkExistingUser = "SELECT * FROM users WHERE name='".$username."' OR email ='".$email."'OR tel=$tel;";
        $check = mysqli_query($_mysqli, $checkExistingUser);
        $result = mysqli_num_rows($check);
        $row = mysqli_fetch_assoc($check);
        if($check && $row){
            //echo '<script>alert("sql executed")</script>';
            echo '<script>alert("username/email/tel already used to create accounts, use a new one ;)")</script>';
        }else{
//            echo $checkExistingUser;
//            //echo '<script>alert("sql not executed")</script>';
//        }
//        if ($row['name']==$username || $row['email']==$email || $row['tel']==$tel) {
//
//        } else {
            $createUser = "INSERT INTO users (name, email, password, tel, address, balance) 
                           VALUES ('".$username."','".$email."','".$password."','".$tel."', '".$address."', 0);";
            $create = mysqli_query($_mysqli, $createUser);
            if($create){
                echo '<html><script>alert("account created!!" );</script></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=LogInPage.php\">";
            }else{
                echo '<script>alert("account is not created due to wrong input")</script>';

            }

        }}

    }else{
        //echo '<script>alert("3")</script>';
    }


    ?>

    <?php
    if(isset($_POST['signUpForm'])){
        $username = $_POST['signUpForm']['username'];
        $email = $_POST['signUpForm']['email'];
        $password = $_POST['signUpForm']['pwd'];
        $tel = $_POST['signUpForm']['tel'];
        $address = $_POST['signUpForm']['address'];
    }
    ?>
    <script src="someFunctions.js" type="text/javascript"></script>
</body>
</html>
