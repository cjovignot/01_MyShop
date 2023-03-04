<?php
include_once("connect_db.php");
session_start();

if ($_SESSION['admin'] != 1) {
  header('Location: index.php');
}
?>

<!-- NAV ADMIN --------------------------------------- -->
<html>
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
        <h1>CATEGORY PANEL</h1>
        <p>Manage your category and sub via this CRUD </p>
      </div>
      <div>
        <a class="create_admin_menu" href="admin_category_create.php">Add category</a>
      </div>
      <div>
        <?php
          if (isset($_SESSION['uname']) && $_SESSION['admin'] == 0) {
            echo "<a href='admin.php'><div class='button_menu' >ADMIN</div></a>";
            header('Location: index.php');
          }

          display_db_category($pdo);
          function display_db_category($pdo) {
            $display_category = $pdo->query("SELECT * FROM categories WHERE parent_id='0'");
            $resdisplay_category = $display_category->fetchAll(PDO::FETCH_ASSOC);

            echo "<table class='displaytable' >
                  <tr>
                  <th>ID</th>
                  <th>NAME</th>
                  <th>PARENT</th>
                  <th>TYPE</th>
                  <th>UPDATE</th>
                  <th>DELETE</th>
                  </tr>";


            foreach ($resdisplay_category as $row) {
              $id = $row['id'];

              echo "<tr>";
              echo "<td>" . $row['id'] . "</td>";
              echo "<td>" . $row['name'] . "</td>";
              echo "<td></td>";
              echo "<td>Category</td>";

              echo "<td><form class='form' method='GET' action='admin_category_update.php'>
                    <input type = 'hidden' name = 'id' value = '$id' />
                    <input class='input_update'type='submit' value='UPDT' >  </form></td>";
              echo "<td><form class='form' method='GET' action='admin_delete.php'>
                    <input type = 'hidden' name = 'id' value = '$id' />
                    <input type = 'hidden' name = 'table' value = categories />
                    <input class='input_delete'type='submit' value='X' >  </form></td>";

              $display_subcategory = $pdo->query("SELECT * FROM categories WHERE parent_id = '$id' ");
              $resdisplay_subcategory = $display_subcategory->fetchAll(PDO::FETCH_ASSOC);

              foreach ($resdisplay_subcategory as $rowsub) {
                $idsub = $rowsub['id'];

                echo "<tr>";
                echo "<td class='sub'>" . $rowsub['id'] . "</td>";
                echo "<td class='sub'>" . $rowsub['name'] . "</td>";
                echo "<td class='sub'>" . $row['name'] . "</td>";
                echo "<td class='sub'>Sub category</td>";

                echo "<td><form class='form' method='GET' action='admin_category_update.php'>
                      <input type = 'hidden' name = 'id' value = '$idsub' />
                      <input class='input_update'type='submit' value='UPDT' >  </form></td>";
                echo "<td><form class='form' method='GET' action='admin_delete.php'>
                      <input type = 'hidden' name = 'id' value = '$idsub' />
                      <input type = 'hidden' name = 'table' value = categories />
                      <input class='input_delete'type='submit' value='X' >  </form></td>";
              }
            }

            echo "</table>";
          }
        ?>
      </div>
    </div>
  </div>
  <!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->
</html>