
<?php
include_once("connect_db.php");
session_start();
?>

<?php
    create_product_page($pdo);

    function create_product_page($pdo){
        $count_product = $pdo->query("SELECT COUNT(*) FROM products");
        $nb_product = $count_product->fetch(PDO::FETCH_NUM);
        $total_product = $nb_product[0];
        $nb_page = round($total_product / 7);

        $page_product = 0;
        $var_offset = -7;
        while ($page_product < $nb_page) {
            $page_product++;
            $var_offset += 7;
            ?>
                <form action="index.php" method="get">
                    <input type="submit" name="page" value=<?php echo $page_product ?>>
                    <input type="hidden" name="offset" value=<?php echo $var_offset ?>>
                </form>
            <?php
        }
    }
?>