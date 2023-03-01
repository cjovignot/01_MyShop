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


<?php
include_once("connect_db.php");
?>
<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <title>Wankers by Epitech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
</head>
<?php
        
        function display_db_products($pdo, $var_offset){ //CHANGE NAME
            $display_products = $pdo->query("SELECT * FROM products");
            $resdisplay_products = $display_products->fetchAll(PDO::FETCH_ASSOC);

            foreach($resdisplay_products as $row) {
                $id=$row['id'];
                $table=$row['table'];
                ?>
                    <div class="item">
                        <a href="" class="item_picture"><img src="<?php echo $row['image_path'];?>" alt="<?php echo $row['name'];?>"></a>
                        <div class="item_description">
                            <div class="item_left_description">
                                <div class="item_name"><?php echo $row['name'];?></div>
                                <div class="item_details"><?php echo strtoupper($row['description']);?></div>
                                <div class="ranking">
                                    <img src="img_source/img_website/Star - On.png" alt="">
                                    <img src="img_source/img_website/Star - On.png" alt="">
                                    <img src="img_source/img_website/Star - On.png" alt="">
                                    <img src="img_source/img_website/Star.png" alt="">
                                    <img src="img_source/img_website/Star.png" alt="">
                                </div>
                            </div>
                            <div class="item_right_description">
                                <div class="price"><?php echo $row['price'] . " €";?></div>
                                <a href=""><div class="item_cart_plus"></div></a>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }
?>
