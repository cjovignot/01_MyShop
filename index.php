
<?php
include_once("connect_db.php");
include_once("product_list.php");
session_start();
?>

<html lang="en">
<html>
<?php
include_once("nav_bar.php");
?>
<body>
    <?php
    if ($_GET['category'] == true || $_GET['min_range'] == true || $_GET['max_range'] == true) {
            echo "
            <div id='infos_filter'>
                <div id='active_filter_title'>Active filters</div>
                <div class='filter_column'>Category
                    <div class='detail_filter'>
                        $_GET[category]
                    </div>
                </div>
                <div class='filter_column'>MIN 
                    <div class='detail_filter'>
                        $_GET[min_range] €
                    </div>
                </div>
                <div class='filter_column'>MAX 
                    <div class='detail_filter'>
                        $_GET[max_range] €
                    </div>
                </div>
            </div>";
        }
    ?>
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