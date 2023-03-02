
<?php
include_once("connect_db.php");
include_once("product_list.php");
session_start();
?>
<html>

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
                    <a href=""><div class="button_menu">HOME</div></a>
                    <a href=""><div class="button_menu">SHOP</div></a>
                    <a href=""><div class="button_menu">MAGAZINE</div></a>
                    
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
                        <form id="search_bar" action="">
                            <input id="search_input" type="text" name="query" placeholder="Search...">
                            <button hidden type="submit"></button>
                        </form>
                        <!-- Best match déroulant -->
                        <!-- <nav id="best_match">
                            <ul>
                              <li class="scrolling_menu"><a href="#">Best match &ensp;</a>
                                <ul class="sub_menu">
                                  <li><a href="#">Match #1</a></li>
                                  <li><a href="#">Match #2</a></li>
                                  <li><a href="#">Match #3</a></li>
                                </ul>
                              </li>
                            </ul>
                        </nav> -->
                    </div>
            </div>
        </div>
    </header>

    <body>
        <div id="infos_filter">
            <?php
                if ($_GET) {
                    echo "Active filters : " . "collection = " . $_GET['collection'] . " / " . "Color = " . $_GET['color'] . " / " . "Category = " . $_GET['category'] . " / " . "MIN Price = " . $_GET['min_range'] . " €" . " / " . "MAX Price = " . $_GET['max_range'] . " €";
                }
            ?>
        </div>
        <div id="container">
        <?php
        include_once("active_filter.php");
        ?>
<!--         
            <div class="item"><button type="button" id="filter_collapse">Filters</button>   
                <div id="body_filter_title">FILTER BY</div>
                <button type="button" class="match_collapse">Best match</button> 
                <button type="button" class="filter_collapse">Filters</button>
                <div class="filter_item_collapse">
                    <select class="body_filter_item">
                        <option value="">-- Choose a collection --</option>
                        <option value="0">Collection</option>
                        <option value="1" class="body_filter_item_option">Collection 1</option>
                    </select>
                </div>
                <div class="filter_item_collapse">
                    <select class="body_filter_item">
                        <option value="">-- Choose a color --</option>
                        <option value="0">Color</option>
                        <option value="1" class="body_filter_item_option">Color 2</option>
                    </select>
                </div>
                <div class="filter_item_collapse">
                    <select class="body_filter_item">
                        <option value="">-- Choose a category --</option>
                        <option value="0" class="body_filter_item_option">Category</option>
                        <option value="1" class="body_filter_item_option">Category 1</option>
                    </select>
                </div>
                <div class="filter_item_collapse">
                    <div id="body_filter_range_title">Price range</div>
                    <div class="body_filter_range">
                        <input id="minV" type="range" class="min-price"  value="50" min="50" max="10000" step="50">
                        <input id="maxV" type="range" class="max-price" value="10000" min="50" max="10000" step="50">
                    </div>
                    <div class="price-content">
                        <div>
                            <p id="min-value">$50</p>
                        </div>
                        <div >
                            <p id="max-value">$10000</p>
                        </div>
                    </div>
                </div>
            </div> -->

            <?php
            index_display_products($pdo);
            ?>
        </div>

        <script src="range.js"></script>
    </body>

    <footer>
        <?php
            include("create_page.php");
        ?>
    </footer>

</html>