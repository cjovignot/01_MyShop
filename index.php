
<?php
include_once("connect_db.php");
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
                      FILTER BY
                </div>
                <button type="button" class="match_collapse">Best match</button> 
                <button type="button" class="filter_collapse">Filters</button> 
                    <div class="filter_item_collapse">
                            <select class="body_filter_item">
                                <option value="0">Collection</option>
                                <option value="1" class="body_filter_item_option">Collection 1</option>
                            </select>
                    </div>
                    <div class="filter_item_collapse">
                            <select class="body_filter_item">
                                <option value="0">Color</option>
                                <option value="1" class="body_filter_item_option">Color 2</option>
                            </select>
                    </div>
                    <div class="filter_item_collapse">
                            <select class="body_filter_item">
                                <option value="0" class="body_filter_item_option">Category</option>
                                <option value="1" class="body_filter_item_option">Category 1</option>
                            </select>
                    </div>
                    <div class="filter_item_collapse">
                        <div id="body_filter_range_title">
                            Price range
                        </div>
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
                </div>







            <div class="item">
                <a href="" class="item_picture"><img src="img_source/img_wankers/arthur.png" alt="Arthur ASSELIN"></a>
                <div class="item_description">
                    <div class="item_left_description">
                        <div class="item_name">Arthur ASSELIN</div>
                        <div class="item_details">GUIDE TOURISTIQUE DECADENT</div>
                        <div class="ranking">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                        </div>
                    </div>
                    <div class="item_right_description">
                        <div class="price">$ 5200</div>
                        <a href=""><div class="item_cart_plus"></div></a>
                    </div>
                </div>
            </div>

            <div class="item">
                <a href="" class="item_picture"><img src="img_source/img_wankers/images_resized/wanker_baptiste.png" alt="Baptiste MERIENNE"></a>
                <div class="item_description">
                    <div class="item_left_description">
                        <div class="item_name">Baptiste Merienne</div>
                        <div class="item_details">SKATER DE LA MORT</div>
                        <div class="ranking">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                        </div>
                    </div>
                    <div class="item_right_description">
                        <div class="price">$ 5200</div>
                        <a href=""><div class="item_cart_plus"></div></a>
                    </div>
                </div>
            </div>

            <div class="item">
                <a href="" class="item_picture"><img src="img_source/img_wankers/images_resized/wanker_cosme.png" alt="Cosme JOVIGNOT"></a>
                <div class="item_description">
                    <div class="item_left_description">
                        <div class="item_name">Cosme JOVIGNOT</div>
                        <div class="item_details">DU MUSCLE PAR PALETTES</div>
                        <div class="ranking">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                        </div>
                    </div>
                    <div class="item_right_description">
                        <div class="price">$ 1,50</div>
                        <a href=""><div class="item_cart_plus"></div></a>
                    </div>
                </div>
            </div>

            <div class="item">
                <a href="" class="item_picture"><img src="img_source/img_wankers/images_resized/wanker_dino.png" alt="Dino Balletti"></a>
                <div class="item_description">
                    <div class="item_left_description">
                        <div class="item_name">Dino BALLETTI</div>
                        <div class="item_details">CHEF MONTEUR IKEA</div>
                        <div class="ranking">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                        </div>
                    </div>
                    <div class="item_right_description">
                        <div class="price">$ 10 000</div>
                        <a href=""><div class="item_cart_plus"></div></a>
                    </div> 
                </div>  
            </div>

            <div class="item">
                <a href="" class="item_picture"><img src="img_source/img_wankers/images_resized/wanker_jean.png" alt="Jean GOUTTIER"></a>
                <div class="item_description">
                    <div class="item_left_description">
                        <div class="item_name">Jean GOUTTIER</div>
                        <div class="item_details">CLOWN D'ANNIVERSAIRE</div>
                        <div class="ranking">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                        </div>
                    </div>
                    <div class="item_right_description">
                        <div class="price">$ 158</div>
                        <a href=""><div class="item_cart_plus"></div></a>
                    </div> 
                </div>  
            </div>

            <div class="item">
                <a href="" class="item_picture"><img src="img_source/img_wankers/images_resized/wanker_lorie.png" alt="Lorie OHANYAN"></a>
                <div class="item_description">
                    <div class="item_left_description">
                        <div class="item_name">Lorie OHANYAN</div>
                        <div class="item_details">DEV EN DEVENIR</div>
                        <div class="ranking">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star.png" alt="">
                        </div>
                    </div>
                    <div class="item_right_description">
                        <div class="price">$ 1005</div>
                        <a href=""><div class="item_cart_plus"></div></a>
                    </div> 
                </div>  
            </div>

            <div class="item">
                <a href="" class="item_picture"><img src="img_source/img_wankers/images_resized/wanker_nicolas.png" alt="Nicolas ROCAGEL"></a>
                <div class="item_description">
                    <div class="item_left_description">
                        <div class="item_name">Nicolas ROCAGEL</div>
                        <div class="item_details">ESCORT BOY</div>
                        <div class="ranking">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                            <img src="img_source/img_website/Star - On.png" alt="">
                        </div>
                    </div>
                    <div class="item_right_description">
                        <div class="price">$ 250</div>
                        <a href=""><div class="item_cart_plus"></div></a>
                    </div> 
                </div>  
            </div>


        </div>

        <script src="range.js"></script>
    </body>

    <footer>
        <a href="#" class="page">1</a>
        <a href="#" class="page">2</a>
        <a href="#" class="page">3</a>
        <a href="#" class="page">4</a>
        <a href="#" class="page_responsive">5</a>
        <a href="#" class="page_responsive">6</a>
        <a href="#" class="page_responsive">7</a>
        <a href="#" class="page_responsive">8</a>
        <a href="#" class="page_responsive">9</a>
        <a href="#" class="page_responsive">10</a>
        <a href="#" class="page">></a>
    </footer>

</html>