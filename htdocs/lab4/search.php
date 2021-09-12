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

?>
    <video autoplay muted loop id = "bgv">
        <source src = "background/1.mp4" type="video/mp4">
    </video>

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
        <li><a href="search.php">Search</a>
        </li>
    </ul>
</nav>

        <div class = 'viewport_header' style = "text-align: center; padding-top: 0pt" class = 'search'>
            <form method = 'POST'>
                <input class = 'search' name = 'search' type = "text" placeholder="Search..." style = "border-radius: 10px" >
                <?php
                    $keyword=$_POST['search'];
                    if(isset($keyword)){
                        $sql = "SELECT * FROM artworks WHERE artist like '%{$keyword}%' OR title like '%{$keyword}%' OR genre like '%{$keyword}%'";
                        $searchResult=mysqli_query($_mysqli, $sql);
                        $numOfRow = mysqli_num_rows($searchResult);
                        while($row =$searchResult->fetch_assoc()){
                            echo "<div> artwork id is:".$row['artworkID']." <button action = 'glossary.php' method = 'POST'> <a href='glossary.php?artworkID=".$row['artworkID']."'> more </a></button>";
                        }

                    }
                ?>

            </form>
            <p style = 'padding-bottom: 0pt'>
                search here
            </p>
        </div>



    <footer>
        <div style="color: whitesmoke">Website created by Yanbing Gong. All rights reserved.</div>
    </footer>
</body>
</html>
