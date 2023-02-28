<head>
        <link rel="stylesheet" href="">
        <meta charset="UTF-8">
        <title>Wankers by Epitech</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="stylesheet.css" rel="stylesheet">
    </head>

    <header>
        <div id="header_left">
            <div id="home_logo"></div>
            <div id="search_logo"></div>
        </div>
        <div id="header_right">
            <div id="header_right_top">
                <div id="buttons_menu">
                    <a href=""><div class="button_menu">CLIENT</div></a>
                    <a href=""><div class="button_menu">USERS</div></a>
                    <a href=""><div class="button_menu">PRODUCTS</div></a>
                    
                    <?php if (isset($_SESSION['uname'])){
                    echo "<div class='profile' >HELLO ". $_SESSION['uname'] . "</div>";
                    echo "<a href='logout.php'><div class='button_menu' >LOGOUT</div></a>";
                    }
                    ?>
                     <?php if (isset($_SESSION['uname']) && $_SESSION['admin'] == 1){
                      echo "<a href='admin.php'><div class='button_menu' >ADMIN</div></a>";
                    }
                    ?>
                </div>
                <div id="cart_login">
                    <a href=""><div id="cart_logo"></div></a>
                    <!-- <button href="signin.php" onclick="togglePopup()"> <div class="button_menu">LOGIN</div></button> -->
                    <a href="signin.php"><div class="button_menu">LOGIN</div></a>
                     
                    
                    <a href="#"  id="menu_hamburger"></a>
                </div>
            </div>
            <div id="header_right_bottom">
                    <div id="nav_bar_search">
                        <input id="search_input" type="text" placeholder="Search...">
                        <!-- Best match déroulant -->
                        <nav id="best_match">
                            <ul>
                              <li class="scrolling_menu"><a href="#">Best match &ensp;</a>
                                <ul class="sub_menu">
                                  <li><a href="#">Match #1</a></li>
                                  <li><a href="#">Match #2</a></li>
                                  <li><a href="#">Match #3</a></li>
                                </ul>
                              </li>
                            </ul>
                        </nav>
                    </div>
            </div>
        </div>
    </header>


<body>
<div id="container">





            <div class="item"><button type="button" id="filter_collapse">Filters</button>   
                <div id="body_filter_title">
                      DISPLAY BY
                </div>
               
                <a class="menu_admin_a" href="admin_products.php"><div class="menu_admin">PRODUCTS</div></a>
                <a class="menu_admin_a" href="admin_user.php"><div class="menu_admin">USERS</div></a>  
                <a class="menu_admin_a" href=""><div class="menu_admin">CATEGORYs</div></a>
                    
                    
         
                   
                </div>



                