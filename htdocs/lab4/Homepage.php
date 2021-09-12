<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">-->

    <link rel="stylesheet"  type="text/css" href="style.css" media="all">
    <style>
    </style>

</head>


<body>

    <?php

    $_mysqli = mysqli_connect("localhost","root","root");
    mysqli_select_db($_mysqli, "artworks");
    if($_mysqli->connect_error){
        die("connection failed:".$_mysqli->error);
    }
    //echo"connected successfully";
    ?>



    <video autoplay muted loop id = "bgv">
        <source src = "background/1.mp4" type="video/mp4">
    </video>

    <header class = "viewport_header">
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
        <h1 style = "padding-top: 200pt" id = "hph1">Art Store
        <span id="motto"> tranquility is right under your feet</span></h1>
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



        </nav>
    </header>


    <section class = viewport_header>
        <style>
            section{background: black; filter: opacity(.66)}
        </style>


<!--        头图-->
        <div class = hottest_art_gallery>

            <article style="padding-top: 100pt; padding-left: 100pt; padding-right:100pt;text-align: left; color: whitesmoke">

<!--                --><?php
//                    $sql = "SELECT * FROM artworks ORDER BY view DESC LIMIT 3;";
//                    $result = mysqli_query($_mysqli,$sql);
//
//                    $total = mysqli_num_rows($result);
//                    "<div name = carousel_container style='padding-bottom: 0'>
//                        <button name = carousel_left></button>
//                        <div name = carousel_track_container>
//                            <ul name = carousel_track>
//                                <li name = carousel_slide>
//                                    <img src='img/299.jpg'>
//                                </li>
//                            </ul>
//                        </div>
//
//                        <button name = carousel_right></button>
//                    </div>
//                    ";
//                    for($i = 0; $i<3; $i++){
//                        if($i==0){
//                            $row = mysqli_fetch_assoc($result);
//                            $title[] = $row['title'];
//                            $artist[] = $row['artist'];
//                            $date[] = $row['yearOfWork'];
//                            $genre[] = $row['genre'];
//                            $description[] = $row['description'];
//                            $fileName[] = $row['imageFileName'];
//                            echo"
//                            <img style = float:left; padding-left=0pt; width='60%'; class = hottest; src = img/".$fileName[0].">
//                            <a href='glossary.php'></a>
//                            </img>
//                                <table style = padding-left = 70pt; text-align=right; float= right; font-weight=normal; border-spacing= 30pt;>
//                                <tr>
//                                    <th>Title
//                                    </th>
//                                    <th>".$title[0]."
//                                    </th>
//                                </tr>
//                                <tr>
//                                    <td>Artist
//                                    </td>
//                                    <td>".$artist[0]."
//                                    </td>
//                                </tr>
//                                <tr>
//                                    <td>YearCreated
//                                    </td>
//                                    <td>".$date[0]."
//                                    </td>
//                                </tr>
//                                <tr>
//                                    <td>Genre
//                                    </td>
//                                    <td>".$genre[0]."
//                                    </td>
//                                </tr>
//                                <tr>
//                                    <td>Story behind
//                                    </td>
//                                    <td style=overflow: scroll> ".$description[0]."
//                                    </td>
//                                </tr>
//                            </table>
//                         ";
//
//                        }
//                    }
//                ?>
                <?php
                    $sql = "SELECT * FROM artworks ORDER BY view DESC LIMIT 3;";
                    $result = mysqli_query($_mysqli,$sql);
                    for($i = 0; $i<3; $i++){
                        $row = mysqli_fetch_assoc($result);
                        $artworkID[]=$row['artworkID'];
                        $title[] = $row['title'];
                        $artist[] = $row['artist'];
                        $date[] = $row['yearOfWork'];
                        $genre[] = $row['genre'];
                        $description[] = $row['description'];
                        $fileName[] = $row['imageFileName'];
                    }
                    ?>


                <div class="slideshow">
                    <style>
                        .slides{
                            text-align: center;
                            padding-top: 70px;
                        }
                        .previous{
                            position: absolute;
                            top: 450px;
                        }
                        .description{
                            visibility: hidden;
                            text-align: center;
                        }
                        .description:hover{
                            visibility: visible;
                            transition-duration: 1s;
                        }
                        .hottest:hover{
                            opacity: 30%;
                            transition-duration: 3s;
                        }

                    </style>
                    <a class = "previous" onclick="plusSlides(-1)">&#10094;</a>

                    <div class="slides">
                        <a href="glossary.php?artworkID=<?php echo"$artworkID[0]"?>"><img class = hottest src="img/<?php echo"$artworkID[0]"?>.jpg" style="width: 70%"></a>
                    </div>
                    <div class="slides">
                        <a href="glossary.php?artworkID=<?php echo"$artworkID[1]"?>"><img class = hottest src="img/<?php echo"$artworkID[1]"?>.jpg" style="width: 70%"></a>
                    </div>
                    <div class="slides">
                        <a href="glossary.php?artworkID=<?php echo"$artworkID[2]"?>"><img class = hottest src="img/<?php echo"$artworkID[2]"?>.jpg" style="width: 70%">
<!--                        <table class = description>-->
<!--                            <tr>-->
<!--                                <th>Name</th-->
<!--                                <th>--><?php //echo".$title[2]." ?><!--</th>-->
<!--                            </tr>-->
<!---->
<!--                        </table></img>-->
                        </a>
                    </div>

                    <a class = "next" onclick="plusSlides(1)">&#10095;</a>


                </div>

            </article>
        </div>
    </section>


    <section class = viewport_header style="filter:opacity(.80); color: whitesmoke">

        <?php

            $findRecentSQL = "SELECT * FROM artworks ORDER BY timeReleased DESC LIMIT 3";
            $find = mysqli_query($_mysqli, $findRecentSQL);
            for($i = 0; $i < 1; $i++){
                $each = mysqli_fetch_assoc($find);
                $recentID[] = $each['artworkID'];
                $recentFile[] = $each['imageFileName'];
            }
        ?>
        <div class="slideshow">
            <style>
                .slides{
                    text-align: center;
                    padding-top: 70px;
                }
                .previous{
                    position: absolute;
                    top: 450px;
                }
                .description{
                    visibility: hidden;
                    text-align: center;
                }
                .description:hover{
                    visibility: visible;
                    transition-duration: 1s;
                }
                .hottest:hover{
                    opacity: 30%;
                    transition-duration: 3s;
                }

            </style>
            <a class = "previous" onclick="plusSlides(-1)">&#10094;</a>

            <div class="slides">
                <a href="glossary.php?artworkID=<?php echo"$recentID[0]"?>"><img class = hottest src="img/<?php echo"$recentID[0]"?>.jpg" style="width: 70%"></a>
            </div>
            <div class="slides">
                <a href="glossary.php?artworkID=<?php echo"$recentID[1]"?>"><img class = hottest src="img/<?php echo"$recentID[1]"?>.jpg" style="width: 70%"></a>
            </div>
            <div class="slides">
                <a href="glossary.php?artworkID=<?php echo"$recentID[2]"?>"><img class = hottest src="img/<?php echo"$recentID[2]"?>.jpg" style="width: 70%">
                    <!--                        <table class = description>-->
                    <!--                            <tr>-->
                    <!--                                <th>Name</th-->
                    <!--                                <th>--><?php //echo".$title[2]." ?><!--</th>-->
                    <!--                            </tr>-->
                    <!---->
                    <!--                        </table></img>-->
                </a>
            </div>

            <a class = "next" onclick="plusSlides(1)">&#10095;</a>


        </div>



    </section>

    <script>
        src="SharedMethod.js";

        arrayID = <?php echo json_encode($artworkID); ?>;
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n){
            showSlides(slideIndex+=n);
        }
        function showSlides(n){
            let i;
            let slides = document.getElementsByClassName("slides");
            if(n>slides.length){slideIndex = 1}
            if(n<1){slideIndex = slides.length}
            for(i=0;i<slides.length;i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex-1].style.display = "block";
        }
    </script>

    <footer>
        <div style="color: whitesmoke">Website created by Yanbing Gong. All rights reserved.</div>
    </footer>
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>-->
</body>

</html>
