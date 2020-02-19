<?php
    session_start();
    //echo $_SESSION["username"];
    $con = mysqli_connect("localhost","root","","predictor");
    if(!$con)
         die("Connection error:- " + mysqli_connect_error());
    $flag = false;
    if(isset($_SESSION["username"]))
    {
        $s1 = "SELECT * FROM login";
        $result = $con->query($s1);
        if($result->num_rows > 0)
        {
            while($row = mysqli_fetch_row($result))
            {
                if(($row[1] == $_SESSION["username"] || $row[2] == $_SESSION["username"]) && $row[3] == $_SESSION["password"])
                {
                    $flag = true;
                }
            }
        }
    }    
    if($flag == false)
    {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title> Index </title>
    <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="resources/css/styledash.css"> 
    <link rel="stylesheet" type="text/css" href="vendors/css/grid.css" >
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400&display=swap" rel="stylesheet">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <header>
        <!--
            1. Navbar
            2. Font
        -->
    </header>
    <div class="dash">
        <div class="profile">
            <h1>YOUR PROFILE DASHBOARD</h1>
            <h2>Profile</h2>
            <div class="per_info">
                <img src="resources/img/profile_img.jpg" class="img_profile">
                <p>example@mail.com</p>
                <a href="#update">Update Account Information</a>
            </div>
          <div>
                <p>Name: Hugh Gregory</p><hr>
                <p>Birth Date: 07/09/1987</p><hr>
                <p>Contact: 850-009-1759</p><hr>
                <p>Ukraine</p><hr>
          </div> 
        </div>
        <div class="activity">
            <h1>Your Activity</h1>
            <div>
               <!-- <table>
                <tr height="50px">
                    <td rowspan="2"><h3>November 2019</h3></td>
                </tr>
                <tr height="120px">
                    <td><div class="vertical"></div></td>
                    <td><div class="act_content">
                        qwertyuiopppasdfghjklzxcvbnm
                    </div></td>
                </tr>
                <tr height="100px">    
                    <td rowspan="2"><h3>December 2019</h3></td>
                </tr>
                <tr height="130px">
                    <td><div class="vertical"></div></td>
                    <td><div class="act_content">
                        zxcvbnmasdfghjklqwertyuiopzxcvbnmasdfghj<br>
                        qwertyuiopasdfghjklmnbvcxzlkjhgfdsapoiuytrewq
                    </div></td>
                </tr>
                <tr>
                    <td rowspan="2"><h3>January 2020</h3></td>
                </tr>
                </table>-->
                <h3>October 2019</h3>
                <div class="vertical">asdfghjklpoiuytrewqzxcvbnm</div>
                <h3>November 2019</h3>
                <div class="vertical">qwertyuiiopasdfghjklzxcvbnm<br>
                    asdfghjklzxcvbnmqwertyuiop
                </div>
                <h3>December 2019</h3>
                <hr>
                <h2>Suggested Companies <a href="#" class="Companies"><small>View all &gt;</small></a></h2>

            </div>
        </div>
    </div>
</body>
</html>