<?php
include_once("connect_db.php");
session_start();
if (!isset($_SESSION['uname']) && $_SESSION['admin'] != 1) {

    header('Location: index.php');
} ?>


<?php
$id = $_GET['id'];
//var_dump($id);
$cat_id = $pdo->query("SELECT * FROM categories WHERE id = '$id'");
$cat_name = $cat_id->fetch(PDO::FETCH_ASSOC);
//var_dump($cat_name);
if (isset($_POST['name']) == true) {
    $catname_set = $_POST['name'];
    $parent_id_set = $_POST['parent_id'];
    $is_sub_set = 0;
    $createstatus = true;

    if ($catname_set == NULL) {

        // header('location: admin_category_create.php');
        $catname_set = $cat_name['name'];
    }

    if ($_POST['parent_id'] === $id) {


        // header('location: admin_category_create.php');
        echo "You must select a different category";
        $createstatus = false;
        // header('location: admin_category_create.php');
    }
    if ($parent_id_set == true) {
        $is_sub_set = 1;
    }

    $verif_cat = $pdo->query("SELECT * FROM categories WHERE name = '$catname_set'");
    $res_cat = $verif_cat->fetchAll(PDO::FETCH_ASSOC);

    if ($_POST['name'] != false && $res_cat == true) {
        $createstatus = false;
        // header('location: admin_category_create.php');
        echo "cat already exist";
        // header('location: admin_category_create.php');
    }
}
var_dump($createstatus);
if ($createstatus == true) {
    update_categories($pdo, $catname_set, $parent_id_set, $is_sub_set, $id);
    header('location: admin_categories.php');
}







//feed select menu
function getcat($pdo)
{
    $cat_db = $pdo->query("SELECT * FROM categories WHERE parent_id = '0'");
    $res_cat = $cat_db->fetchAll(PDO::FETCH_ASSOC);



    foreach ($res_cat as $cat) {
        echo " <option name=" . $cat['id'] . " value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";
    }
}

//create the category
function update_categories($pdo, $catname_set, $parent_id_set = 0, $is_sub_set = 0, $id)
{


    var_dump($catname_set);
    var_dump($parent_id_set);
    var_dump($is_sub_set);
    var_dump($id);

    $pdo->query("UPDATE categories SET name = '$catname_set', parent_id = '$parent_id_set', is_sub = '$is_sub_set' WHERE id ='$id'");
}


?>


<!DOCTYPE HTML>
<form action="admin_category_update.php?id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
    <h2>UPDATE CATEGORY: <?php echo $cat_name['name'];  ?></h2>
    <label>Category name</label>

    <input type="text" name="name" placeholder="Category Name"><br>

    <label>Select a parent if it's a sub category:</label>

    <select name="parent_id">
        <option name="isparent" value='0'></option>
        <?php getcat($pdo) ?>
    </select><br>

    <button type="submit">ADD</button>
</form>

<form action="admin_categories.php">


    <button type="submit">CANCEL</button>
</form>