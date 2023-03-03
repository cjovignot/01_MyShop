<head>
        <link rel="stylesheet" href="">
        <meta charset="UTF-8">
        <title>Wankers by Epitech</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="stylesheet.css" rel="stylesheet">
    </head>

    <header>
        <div id="header_left">
            <a href="index.php"><div id="home_logo"></div></a>
        </div>
        <div id="header_right">
            <div id="header_right_top">
                <div id="buttons_menu">
                    <a href="index.php"><div class="button_menu">CLIENT</div></a>
                    <?php if (isset($_SESSION['uname']) && $_SESSION['admin'] == 1){
                      echo "<a href='admin.php'><div class='button_menu' >ADMIN</div></a>";
                    }
                    ?>
                    
                    <?php if (isset($_SESSION['uname'])){
                    echo "<div class='profile' >HELLO ". $_SESSION['uname'] . "</div>";
                    echo "<a href='logout.php'><div class='button_menu' >LOGOUT</div></a>";
                    }
                    ?>
                    
                </div>
                <div id="cart_login">
                    <a href=""><div id="cart_logo"></div></a>
                    <a href="signin.php"><div class="button_menu">LOGIN</div></a>
                     
                    
                    <a href="#"  id="menu_hamburger"></a>
                </div>
            </div>
        </div>
    </header>


<body>
<div id="container">


            <div id="admin_menu_left"><button type="button" id="filter_collapse">Filters</button>   
                <div id="title_menu">DISPLAY BY</div>
                <div id="admin_sub_menu_left">
                    <a class="link_admin_menu" href="admin_products.php">PRODUCTS</a>
                    <a class="link_admin_menu" href="admin_users.php">USERS</a>  
                    <a class="link_admin_menu" href="admin_categories.php">CATEGORIES</a>
                </div>
            </div>