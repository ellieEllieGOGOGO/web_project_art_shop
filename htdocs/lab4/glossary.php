<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  type="text/css" href="style.css" media="all">
    <script type = "text/javascript" href="someFunctions.js" media = all></script>
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
    echo"connected successfully";
    ?>


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



    <section>

        <div class = viewport_header style = "padding-top: 100pt; padding-left: 130pt; text-align: center">
            <?php
            $artworkID = "".$_GET['artworkID'];

            $sql = "SELECT * FROM artworks WHERE artworkID=".$artworkID;
            //$result = $GLOBALS['_mysql']->query($sql);
            //echo $sql;
            $result = mysqli_query($_mysqli, $sql);
            $row= mysqli_fetch_assoc($result);
            if(mysqli_num_rows($result)==0){
                echo"no item found";
            }else {
                $title = $row['title'];
                //echo $title;
                $artist = $row['artist'];
                $fileName = $row['imageFileName'];
                $yearOfWork = $row['yearOfWork'];
                $genre = $row['genre'];
                $view = $row['view'] + 1;


                $updateView = "UPDATE artworks SET view = $view WHERE artworkID= $artworkID;";
                $updateResult = mysqli_query($_mysqli, $updateView);
                //echo $view;
            }

            ?>

            <img src="img/<?php echo "$artworkID" ?>.jpg" style = "width: 40%; height: 40%; float:left">

            <table style="text-align: left; font-weight: bold">
                <style>
                    td{
                        font-size: 12pt;
                        color: black;
                    }
                    td:hover{
                        font-size: larger;
                        transition-duration: .5s;
                    }
                </style>
                <tr>
                    <td>artist: </td>
                    <td><?php echo "$artist"?></td>

                </tr>
                <tr>
                    <td>Title:</td>
                    <td><?php echo "$title"?></td>
                </tr>
                <tr>
                    <td>Time created: </td>
                    <td><?php echo "$yearOfWork"?></td>
                </tr>
                <tr>
                    <td>Genre: </td>
                    <td><?php echo "$genre"?></td>
                </tr>
                <tr>
                    <td>Views:</td>
                    <td><?php echo "$view"?></td>
                </tr>
                <tr>
                    <td  >
                        <form method="post">
                            <input type="submit" name="addFavs()"
                                   class="button" value="addFavs()"/>
                        </form>

                        <script>
                            function addFavs(){
                                alert("successfuly added to your favs");
                            }
                        </script>
                    </input></td>
                <tr>
                    <?php
                        $checkExistenceSQL = "SELECT * FROM wishlist WHERE artworkID = $artworkID AND userID = ".$_SESSION['uid'].";";
                        $check = mysqli_query($_mysqli, $checkExistenceSQL);
                        if($check){
                            if($row = mysqli_fetch_assoc($check)){
                                echo"<td> this item is already in your fav list~</td>";
                            }
                        }else{
                            echo'<script>alert("sql not executed")</script>';
                        }
                    ?>
                </tr>
            </table>
        </div>
    </section>


    <?php //This PHP is for addCarts() only.
    if(isset($_POST['addFavs()'])) {
        // NEED AN IF STATEMENT
        if(!$_SESSION['username']){
            echo '<script>alert("go log in first~")</script>';
        }
        if ($_SESSION['username'] && $_SESSION['password']) {
            //已经登陆了
            //If ->不能重复添加元素
            //echo '<script>alert("reached here")</script>';
            $uid = $_SESSION['uid'];
            //echo $uid;
            $record = "SELECT * FROM wishlist WHERE userID = $uid AND artworkID = $artworkID;";
            //echo $record;
            $getRecord = mysqli_query($_mysqli, $record);
            $numOfR = mysqli_num_rows($getRecord);
            if ($getRecord) {
                if ($numOfR == 0) {
                    $addToWishlist = "INSERT INTO wishlist (userID, artworkID) VALUES ($uid, $artworkID);";
                    $add = mysqli_query($_mysqli, $addToWishlist);
                    if($add){
                        echo '<script>alert("successfully added")</script>';
                    }else{
                        echo '<script>alert("record = 0 but didnt add")</script>';
                    }
                } else {

                    echo '<html><head><script>alert("item already in favs~" );</script></head></html>' .
                        "<meta http-equiv=\"refresh\" content=\"0;url=favorites.php\">";
                }
                }
             else {
                echo '<script>alert("the query has not been executed")';
            }
        }else{
            echo '<script>alert("you need to log in")';
        }
    }

    ?>

<!--        <img src="img/59.jpg" style = "resize: both; height: 320px; width: 272px;position: relative; left: 150px">-->

<!--        <p><t1>randomly generated text</t1></p>-->



    <footer>
        <div style="color: whitesmoke">Website created by Yanbing Gong. All rights reserved.</div>
    </footer>

</body>
</html>
