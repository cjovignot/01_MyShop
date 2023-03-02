
<div class="item">
    <label id="filter_test_label" for="filter_test">FILTER BY</label>

    <form class="form_test" method="get">
        <select name="category" class="field">
            <option value="none">
                <?php
                    if ($_GET['category']) {
                        echo $_GET['category'];
                    } else {
                        echo "-- Choose a category --";
                    }
                ?>
            </option>
            <option value="Action">Action</option>
            <option value="Chill">Chill</option>
            <option value="Trip">Trip</option>
        </select>

        <div id="range_test">
            <label id="range_test_label" for="filter_test">Price range</label>
            <input id="minV" type="range" class="min-price" name="min_range" value="50" min="50" max="10000" step="50">
            <input id="maxV" type="range" class="max-price" name="max_range" value="10000" min="50" max="10000" step="50">
                <div id="price_content_test">
                    <div>
                        <p id="min-value">$50</p>
                    </div>
                    <div >
                        <p id="max-value">$10000</p>
                    </div>
                </div>
        </div>
        <input type="submit" value="Filter">
    </form>



    <!-- <form class="form_test">
            <select name="collection" class="field" method="get" onchange='if(this.value != 0) { this.form.submit(); }'>
                <option value="0">-- Choose a collection --</option>
                <option value='1'>Collection 1</option>
                <option value='2'>Collection 2</option>
                <option value='3'>Collection 3</option>
            </select>
    </form>
    <form class="form_test">
            <select name="color" class="field" method="post" onchange='if(this.value != 0) { this.form.submit(); }'>
                <option value="">-- Choose a color --</option>
                <option value="Black">Black</option>
                <option value="White">White</option>
                <option value="Yellow">Yellow</option>
            </select>
    </form>
    <form class="form_test">
            <select name="category" class="field" method="post" onchange='if(this.value != 0) { this.form.submit(); }'>
                <option value="">-- Choose a category --</option>
                <option value="Action">Action</option>
                <option value="Category 2">Category 2</option>
                <option value="Category 3">Category 3</option>
            </select>
    </form>
    <div id="range_test">
        <label id="range_test_label" for="filter_test">Price range</label>
        <form class="form_test" method="post" onchange='if(this.value != 0) { this.form.submit(); }'>
                <input id="minV" type="range" class="min-price"  value="50" min="50" max="10000" step="50">
                <input id="maxV" type="range" class="max-price" value="10000" min="50" max="10000" step="50">
        </form>
        <div id="price_content_test">
            <div>
                <p id="min-value">$50</p>
            </div>
            <div >
                <p id="max-value">$10000</p>
            </div>
        </div>
    </div> -->
</div>