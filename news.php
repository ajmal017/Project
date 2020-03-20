<?php
include 'database.php';
if(isset($_SESSION["username"]))
{
    $s1 = "SELECT * FROM login WHERE (Username = '" . $_SESSION["username"] . "' OR Email='" . $_SESSION["username"] . "')" . " AND Password='" . $_SESSION["password"] . "';";
    $result = $con->query($s1);
    $num_rows = mysqli_num_rows($result);
    if($num_rows != 1)
    {
        $ss1 = "<li><a href='login.php'>Sign In</a></li>";
    }
    else
    {
        $ss1 = '<li><a href="logout.php">Sign Out</a></li>';
    }
}
else
{
    $ss1 = "<li><a href='login.php'>Sign In</a></li>";
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>News Api</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="vendors/css/materialize.min.css">
    <style type="text/css">
		#loader {
			height: 100vh;
			align-items: center;
			display: flex;
			justify-content: center;

		}
                *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        html {
            font-weight: 300;
            font-size: 20px;
            text-rendering: optimizeLegibility;
            font-family: 'Raleway','Arial',sans-serif;
        }
        nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            min-height: 8vh;
            background-color:  #1abc9c;
        }

        .logo {
            color: aliceblue;
            text-transform: uppercase;
            letter-spacing: 5px;
            font-size: 20px;
        }
        .nav-links {
            display: flex;
            justify-content: space-around;  
            width: 25%;  
            list-style: none;
        }
        .nav-links a {
            color: aliceblue;
            text-decoration: none;
            letter-spacing: 3px;
            font-weight: bold;
            font-size: 14px;
        }
        .burger {
            display: none;
        }
        .burger div{
            width: 25px;
            height: 3px;
            background-color: rgb(226,226,226);
            margin: 5px;
            transition: all 0.3s ease;
        }
        @media screen and (max-width:1024px) {
            .nav-links {
                width: 40%;  
            }
        }
        @media screen and (max-width:768px) {
            body {
                overflow: hidden;
                cursor: pointer;
            }
            .nav-links {
                position: absolute;
                right: 0px;
                height: 92vh;
                top: 8vh;
                background-color:  #1abc9c;
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 50%;
                transform: translateX(100%);
                transition: transform 0.5s ease-in;
            }
            .nav-links li {
                opacity: 0;
            }
            .burger {
                display: block;
            }
        }
        .nav-active{
            transform: translateX(0%);
        }
        @keyframes navLinkFade {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0px);
            }
        }
        .toggle .line1 {
            transform: rotate(-45deg) translate(-5px,6px);
        }
        .toggle .line2 {
            opacity: 0;
        }
        .toggle .line3 {
            transform: rotate(45deg) translate(-5px,-6px);
        }
        .nav-links li a:hover,
        .nav-links li a:active{
            border-bottom: 2px solid #169e83;
            color: #26138e;
}
		.progress {
			display: none;
		}

		.errorMsg {
			font-size: 34px;
			height: 100vh;
			align-items: center;
			display: flex;
			justify-content: center;
		}
	</style>
</head>

<body>
    <nav>
        <div class="logo">
            <i>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path d="M24 3.055l-6 1.221 1.716 1.708-5.351 5.358-3.001-3.002-7.336 7.242 1.41 1.418 5.922-5.834 2.991 2.993 6.781-6.762 1.667 1.66 1.201-6.002zm-16.69 6.477l-3.282-3.239 1.41-1.418 3.298 3.249-1.426 1.408zm15.49 3.287l1.2 6.001-6-1.221 1.716-1.708-2.13-2.133 1.411-1.408 2.136 2.129 1.667-1.66zm1.2 8.181v2h-24v-22h2v20h22z"/></svg>
            </i>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="news.html">News</a></li>
            <li><a href="#"><?php echo $ss1; ?></a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
        
    <div class="container">
      
        <!-- <h3 class="center" style="margin-bottom:20px;"><i class="material-icons medium hide-on-small-only" id="icons"></i></h3> -->
        
        <form>
            <div class="input-field">
                <i class="material-icons prefix">public</i>
                <input type="text" id="searchquery">
                <label>Find what's happening in the India......</label>
            </div>
            
            <div class="row">
               <input type="submit" id="searchbtn" class="btn col m2 s12" value="search">
               <input type="reset" id="searchbtn" class="btn col m2 s12 red right" value="clear"  style="margin-top:6px;">
            </div>
            
        </form>
        
        <div id="loader" style="display:none;">
          <div class="progress">
            <div class="indeterminate"></div>
          </div>
        </div>
        
        <div class="row">
           <div id="newsResults"></div>
        </div>      
     </div>
  
	<div class="container">
        <div class="row">
            <div id="newsResults"></div>
		</div>
        
		<div id="loader">
            <div class="progress">
                <div class="indeterminate"></div>
			</div>
		</div>
        
	</div>
    
	<script src="vendors/js/jquery-3.3.1.min.js"></script>
	<script src="vendors/js/materialize.min.js"></script>
	<script src="resources/js/newsapp.js"></script>
    <script src="resources/css/nse.js"></script>
</body>

</html>