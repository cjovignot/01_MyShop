<?php
include_once("connect_db.php");
?>

<div class="item">
    <label id="filter_test_label" for="filter_test">FILTER BY</label>

    <form class="form_test" method="get">
        <select id="category_field" name="category" class="field">
                <?php
                    if ($_GET['category']) {
                        echo $_GET['category'];
                    } else {
                        echo "<option value='none'>-- Choose a category --</option>";
                    }
                ?>
            </option>
            <?php
                fetch_categories($pdo);
                function fetch_categories($pdo) {
                    $fetch_category = $pdo->query("SELECT * FROM categories WHERE parent_id=0 OR is_sub=1;");
                    $fetch_category = $fetch_category->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach($fetch_category as $option) {
                        if ($option['is_sub'] == '1') {
                            echo "<option style='color: black' value=" . $option['name'] . ">➜ " . $option['name'] . "</option>";
                        } else {
                            echo "<option style='color: black' value=" . $option['name'] . ">" . $option['name'] . "</option>";
                        }
                    }
                }
            ?>
        </select>

        <div id="range_test">
            <label id="range_test_label" for="filter_test">Price range</label>
            <input id="minV" type="range" class="min-price" name="min_range" value="50" min="50" max="10000" step="50" aria-label="minimum price">
            <input id="maxV" type="range" class="max-price" name="max_range" value="10000" min="50" max="10000" step="50" aria-label="maximum price">
            
            <input hidden type="text" name="search" value="$_SESSION[query]">

                <div id="price_content_test">
                    <div>
                        <p id="min-value">$50</p>
                    </div>
                    <div >
                        <p id="max-value">$10000</p>
                    </div>
                </div>
        </div>
        <div id="buttons_filter">
            <input type="submit" value="Filter">
            <a href="index.php"><input type="button" value="Reset"></a>
        </div>
    </form>
</div>

