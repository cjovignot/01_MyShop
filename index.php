
<?php
include_once("connect_db.php");
include_once("product_list.php");
session_start();
?>
<html lang="en">
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
            <a href="index.php" aria-label="Main menu"><div id="home_logo"></div></a>
            <div id="search_logo"></div>
        </div>
        <div id="header_right">
            <div id="header_right_top">
                <div id="buttons_menu">
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
                    <a href="" aria-label="shopping cart icon"><div id="cart_logo"></div></a>
                    <?php if (!isset($_SESSION['uname'])){
                        echo "<a href='signin.php'><div class='button_menu'>LOGIN</div></a>";
                        }
                    ?>
                    
                     
                    
                    <!-- <a href="#"  id="menu_hamburger"></a> -->
                    <input type="checkbox" id="hamburger-input" class="burger-shower" />
                    <label id="hamburger-menu" for="hamburger-input">
                        <nav id="sidebar-menu">
                            <h3>Menu</h3>
                            <ul>
                            <li><?php if (isset($_SESSION['uname'])){
                                echo "HELLO ". $_SESSION['uname'];?><br><?php
                                echo "<a href='logout.php'>LOGOUT</a>";
                                }
                                ?>
                            </li>
                            <li>
                                <?php if (isset($_SESSION['uname']) && $_SESSION['admin'] == 1){
                                echo "<a href='admin.php'>ADMIN</a>";
                                }
                                ?>
                            </li>
                            <li><a href="index.php">Home</a></li>
                            <li>
                                <?php if (!isset($_SESSION['uname'])){
                                echo "<a href='signin.php'>Login</a>";
                                }
                                ?></li>
                            </ul>
                        </nav>
                    </label>
                    <div class="overlay"></div>
                </div>
            </div>
            <div id="header_right_bottom">
                    <div id="nav_bar_search">
                        <form id="search_bar" action="">
                            <input id="search_input" type="text" name="query" value="<?php echo $_SESSION['query'] ?>" placeholder="Search...">
                            <button hidden type="submit"></button>
                        </form>
                    </div>
            </div>
        </div>
    </header>

    <body>
        <div id="infos_filter">
            <div id="active_filter_title">Active filters</div>
            <div class="filter_column">Category
                <div class="detail_filter"><?php if ($_GET) { echo $_GET['category']; } ?></div>
            </div>
            <div class="filter_column">MIN 
                <div class="detail_filter"><?php if ($_GET) { echo $_GET['min_range'] . " €"; } ?></div>
            </div>
            <div class="filter_column">MAX 
                <div class="detail_filter"><?php if ($_GET) { echo $_GET['max_range'] . " €"; } ?></div>
            </div>
        </div>
        <div id="container">
        <?php
        include_once("active_filter.php");
        ?>
        
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