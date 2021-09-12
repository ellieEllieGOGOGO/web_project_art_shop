<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet"  type="text/css" href="style.css" media="all">
</head>
<body>

    <video autoplay muted loop id = "bgv">
        <source src = "background/1.mp4" type="video/mp4">
    </video>

    <?php

    $_mysqli = mysqli_connect("localhost","root","root");
    mysqli_select_db($_mysqli, "artworks");

    ?>

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

    <section class = 'viewport_header'>
        <div style = "text-align: center; padding-top: 180pt; font-size: 20pt">
            <ul id = "menu">
                <li><a href = "#info">
                    info</a>
                </li>
                <li style = "padding-top: 10pt"><a href = #favorites>
                    favorites</a>
                </li>
            </ul>
        </div>
    </section>

    <section class = viewport_header id = "info">
        <style>
            #info{
                background-color: black;
                filter:opacity(.66);
            }
            div{
                text-align: center;
            }
        </style>

        <div class = viewport_header style = "text-align: center;padding-top: 260pt; color: white">
            <h3>Personal info</h3>
            <?php
            echo "<br>name: ".$_SESSION['username']."</br>";
            ?>
            <?php
            $getBalanceSQL="SELECT * FROM users WHERE name = '".$_SESSION['username']."';";
            $get = mysqli_query($_mysqli, $getBalanceSQL);
            $userResult = mysqli_fetch_assoc($get);
            $balance = $userResult['balance'];
            echo "<br>balance: ".$balance."</br>";
            ?>
            <br>payment method: visa card</br>
        </div>
    </section>

    <section class = viewport_header id = "favorites">
        <style>
            #info{
                background-color: black;
                filter:opacity(.78);
            }
            div{
                text-align: center;
            }
            .image{
                height:auto;
                width: 90%;
            }
        </style>

        <div class = viewport_header style = "text-align: center;padding-top: 260pt; color: black">
            <form name = "favs" action = "favoritespages.php" method = "get">
            <table style = "padding-top: 0pt; text-align: center">
                <tr id = "tr1">
                    <th>arts</th>
                    <th>name</th>
                    <th>artists</th>
                    <th>description</th>
                    <th>operations</th>
                </tr>

                <?php
                    $uid = $_SESSION['uid'];
                    $getFavsSQL = "SELECT * FROM wishlist WHERE userID = $uid;";
                    $getFavs = mysqli_query($_mysqli, $getFavsSQL);
                    while ($row = mysqli_fetch_assoc($getFavs)){
                        $i = 0;
                        //$imageFileName = $row['imageFileName'];
                        //$artist = $row['artist'];
                        //echo " <img src=img/".$row['artworkID'].".jpg>";
                        $aid = $row['artworkID'];
                        $getEachSQL = "SELECT * FROM artworks WHERE artworkID =$aid;";
                        $getEach = mysqli_query($_mysqli, $getEachSQL);
                        if($getEach){
                            $rowinrow = mysqli_fetch_assoc($getEach);
                        }else{
                            echo '<script>alert("SQL not executed")</script>';
                        }
                        echo "<tr>
                                <td><img class = 'image' src=img/".$row['artworkID'].".jpg></td>
                                <td>".$rowinrow['title']."</td>
                                <td>".$rowinrow['artist']."</td>
                                <td>".$rowinrow['description']."</td>
                                <td><form action = 'favorites.php' method = 'POST' name  = 'delete'><input name = 'delete' type='button' value='delete'></input></td>
                                </tr>";
                        $i++;
                    }
                ?>
            </table>
            </form>

        </div>
    </section>



    <footer>
        <div style="color: whitesmoke">Website created by Yanbing Gong. All rights reserved.</div>
    </footer>
    <script src="someFunctions.js" type="text/javascript"></script>
</body>
</html>
