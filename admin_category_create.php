<?php
include_once("connect_db.php");
session_start();
if (!isset($_SESSION['uname']) && $_SESSION['admin'] != 1) {

    header('Location: index.php');

}?>


<?php 


if (isset($_POST['name']) == true){
    $catname_set = $_POST['name'];
    $parent_id_set = $_POST['parent_id'];
    $is_sub_set = 0;
    $createstatus = true;
    if ($catname_set == NULL){
        $createstatus = false;
       // header('location: admin_category_create.php');
        echo "a cat needs a name";
    }
    if ($parent_id_set == true){
        $is_sub_set = 1;
    }

    $verif_cat = $pdo->query("SELECT * FROM categories WHERE name = '$catname_set'");
    $res_cat = $verif_cat->fetchAll(PDO::FETCH_ASSOC);
    var_dump($res_cat);
    if ($catname_set != false && $res_cat == true){
        $createstatus = false;
        // header('location: admin_category_create.php');
        echo "cat already exist";
       // header('location: admin_category_create.php');
    }

    if($createstatus == true){
     create_categories($pdo,$catname_set,$parent_id_set,$is_sub_set);
     header('location: admin_categories.php');
    }
    }


    






//feed select menu
 function getcat($pdo)
 {
    $cat_db = $pdo->query("SELECT * FROM categories WHERE parent_id = '0'");
    $res_cat = $cat_db->fetchAll(PDO::FETCH_ASSOC);
  


    foreach($res_cat as $cat){
        echo " <option name=". $cat['id'] ." value='". $cat['id'] ."'>".$cat['name'] ."</option>";
    }
    
}

//create the category
 function create_categories($pdo,$catname_set,$parent_id_set = 0,$is_sub_set = 0)
{

   $pdo->query("INSERT INTO categories (name,parent_id,is_sub) VALUES ('$catname_set','$parent_id_set','$is_sub_set')");
   
}


?>


<!DOCTYPE HTML>
<form action="admin_category_create.php" method="post" enctype="multipart/form-data">
    <h2>CREATE CATEGORY</h2>
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