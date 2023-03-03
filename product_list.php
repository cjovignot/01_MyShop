<?php
include_once("connect_db.php");
session_start();
?>

<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <title>Wankers by Epitech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
</head>

<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <title>Wankers by Epitech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
</head>
<?php
    function index_display_products($pdo){
        if ($_GET['min_range'] == true || $_GET['max_range'] == true && $_SESSION['query'] != "") {
            $display_products = $pdo->query("SELECT * FROM products WHERE price >= $_GET[min_range] AND price <= $_GET[max_range] AND name LIKE '%$_SESSION[query]%' LIMIT 7");
            $resdisplay_products = $display_products->fetchAll(PDO::FETCH_ASSOC);

            foreach($resdisplay_products as $row) {
                $id=$row['id'];
                // $table=$row['table'];
                ?>
                    <div class="item">
                        <a href="" class="item_picture"><img src="<?php echo $row['image_path'];?>" alt="<?php echo $row['name'];?>"></a>
                        <div class="item_description">
                            <div class="item_left_description">
                                <div class="item_name"><?php echo $row['name'];?></div>
                                <div class="item_details"><?php echo strtoupper($row['description']);?></div>
                                <div class="ranking">
                                    <img src="img_source/img_website/Star - OnW.png" alt="">
                                    <img src="img_source/img_website/Star - OnW.png" alt="">
                                    <img src="img_source/img_website/Star - OnW.png" alt="">
                                    <img src="img_source/img_website/StarW.png" alt="">
                                    <img src="img_source/img_website/StarW.png" alt="">
                                </div>
                            </div>
                            <div class="item_right_description">
                                <div class="price"><?php echo $row['price'] . " €";?></div>
                                <a href="" aria-label="Add to shopping cart"><div class="item_cart_plus"></div></a>
                            </div>
                        </div>
                    </div>
                <?php
            }
        } else if ($_GET['offset']) {
            $display_products = $pdo->query("SELECT * FROM products LIMIT 7 OFFSET $_GET[offset]");
            $resdisplay_products = $display_products->fetchAll(PDO::FETCH_ASSOC);

            foreach($resdisplay_products as $row) {
                $id=$row['id'];
                // $table=$row['table'];
                ?>
                    <div class="item">
                        <a href="" class="item_picture" aria-label="Item picture"><img src="<?php echo $row['image_path'];?>" alt="<?php echo $row['name'];?>"></a>
                        <div class="item_description">
                            <div class="item_left_description">
                                <div class="item_name"><?php echo $row['name'];?></div>
                                <div class="item_details"><?php echo strtoupper($row['description']);?></div>
                                <div class="ranking">
                                    <img src="img_source/img_website/Star - OnW.png" alt="filled star">
                                    <img src="img_source/img_website/Star - OnW.png" alt="filled star">
                                    <img src="img_source/img_website/Star - OnW.png" alt="filled star">
                                    <img src="img_source/img_website/StarW.png" alt="empty star">
                                    <img src="img_source/img_website/StarW.png" alt="empty star">
                                </div>
                            </div>
                            <div class="item_right_description">
                                <div class="price"><?php echo $row['price'] . " €";?></div>
                                <a href="" aria-label="Add to shopping cart"><div class="item_cart_plus"></div></a>
                            </div>
                        </div>
                    </div>
                <?php
            }
        } else {
            $query = $_GET["query"] === NULL ? "" : $_GET["query"];
            $_SESSION['query'] = $query;
            $display_products = $pdo->query("SELECT * FROM products WHERE name LIKE '%$query%' LIMIT 7");
            $resdisplay_products = $display_products->fetchAll(PDO::FETCH_ASSOC);

            foreach($resdisplay_products as $row) {
                $id=$row['id'];
                // $table=$row['table'];
                ?>
                    <div class="item">
                        <a href="" class="item_picture"><img src="<?php echo $row['image_path'];?>" alt="people doing things"<?php echo $row['name'];?>"></a>
                        <div class="item_description">
                            <div class="item_left_description">
                                <div class="item_name"><?php echo $row['name'];?></div>
                                <div class="item_details"><?php echo strtoupper($row['description']);?></div>
                                <div class="ranking">
                                    <img src="img_source/img_website/Star - OnW.png" alt="filled star">
                                    <img src="img_source/img_website/Star - OnW.png" alt="filled star">
                                    <img src="img_source/img_website/Star - OnW.png" alt="filled star">
                                    <img src="img_source/img_website/StarW.png" alt="empty star">
                                    <img src="img_source/img_website/StarW.png" alt="empty star">
                                </div>
                            </div>
                            <div class="item_right_description">
                                <div class="price"><?php echo $row['price'] . " €";?></div>
                                <a href=""aria-label="Add to shopping cart"><div class="item_cart_plus"></div></a>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }
        
    }
?>
<footer>
    <?php
        // create_product_page($pdo);
    ?>
</footer>