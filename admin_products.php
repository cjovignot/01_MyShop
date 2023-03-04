<?php
  include_once("connect_db.php");
  session_start();
  if ($_SESSION['admin'] != 1) {
    header('Location: index.php');
  }
?>

<html>

<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <title>Wankers by Epitech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
</head>

<!-- NAV ADMIN --------------------------------------- -->
<?php include("nav_bar.php") ?>
<!-- END NAV ADMIN --------------------------------------- -->
<!-- DISPLAY PANEL / ACTION --------------------------------------------------------- -->
<div id="container">
  <div id="admin_menu_left">
      <div id="title_menu">DISPLAY BY</div>
      <div id="admin_sub_menu_left">
          <a class="link_admin_menu" href="admin_products.php">PRODUCTS</a>
          <a class="link_admin_menu" href="admin_users.php">USERS</a>  
          <a class="link_admin_menu" href="admin_categories.php">CATEGORIES</a>
      </div>
  </div>
  <div class="panel">
    <div>
      <h1>PRODUCT PANEL</h1>
      <p>Manage your products via this CRUD </p>
    </div>
    <div>
      <a class="create_admin_menu" href="admincreateproducts.php">Add product</a>
    </div>


    <div>
      <?php
        if (isset($_SESSION['uname']) && $_SESSION['admin'] == 0) {
          echo "<a href='admin.php'><div class='button_menu' >ADMIN</div></a>";
          header('Location: index.php');
        }


        display_db_product($pdo);
        function display_db_product($pdo) { //generate product table
          $display_products = $pdo->query("SELECT * FROM products");
          $resdisplay_products = $display_products->fetchAll(PDO::FETCH_ASSOC);


          echo "<table class='displaytable' >
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Picture</th>
                <th>category_id</th>
                <th>Category</th>
                <th>Sub category</th>
                </tr>";


          foreach ($resdisplay_products as $row) {
            // generate category association
            $catid = $row['category_id'];
            //get cateory name by id
            $display_categories = $pdo->query("SELECT name FROM categories where id = '$catid' ");
            $resdisplay_categories = $display_categories->fetch(PDO::FETCH_ASSOC);
            //get parent id by prod id
            $parentcategoriesid = $pdo->query("SELECT parent_id FROM categories where id = '$catid' ");
            $res_parentcategoriesid = $parentcategoriesid->fetch(PDO::FETCH_ASSOC);
            $parentidcat = $res_parentcategoriesid['parent_id'];

            //get category name by parentid
            $parentcategories = $pdo->query("SELECT name FROM categories where id = '$parentidcat' ");
            $res_parentcategories = $parentcategories->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];

            if ($resdisplay_categories['name'] == true && $res_parentcategories['name'] == null) {
              $res_parentcategories['name'] = $resdisplay_categories['name'];
              $resdisplay_categories['name'] = null;
            }

            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['price'] . "€" . "</td>";
            echo "<td>" . $row['image_path'] . "</td>";
            echo "<td>" . $row['category_id'] . "</td>";
            echo "<td>" . $res_parentcategories['name'] . "</td>";
            echo "<td>" . $resdisplay_categories['name'] . "</td>";
            echo "<td><form class='form' method='GET' action='adminupdateproducts.php'>
                  <input type = 'hidden' name = 'id' value = '$id' />
                  <input class='input_update'type='submit' value='UPDT' >  </form></td>";
            echo "<td><form class='form' method='GET' action='admin_delete.php'>
                  <input type = 'hidden' name = 'id' value = '$id' />
                  <input type = 'hidden' name = 'table' value = products />
                  <input class='input_delete'type='submit' value='X' >  </form></td>";
          }
          echo "</table>";
        }
      ?>
    </div>
  </div>
</div>
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->

</html>