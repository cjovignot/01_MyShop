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
      <h1>USER PANEL</h1>
      <p>Manage your User via this CRUD </p>
    </div>
    <div>
      <a class="create_admin_menu" href="signup.php">Add user</a>
    </div>

    <div>
      <?php
        if (isset($_SESSION['uname']) && $_SESSION['admin'] == 0) {
          echo "<a href='admin.php'><div class='button_menu' >ADMIN</div></a>";
          header('Location: index.php');
        }


        display_db_user($pdo);
        function display_db_user($pdo) {
          $display_users = $pdo->query("SELECT * FROM users");
          $resdisplay_users = $display_users->fetchAll(PDO::FETCH_ASSOC);

          echo "<table class='displaytable' >
                <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Password</th>
                <th>Email</th>
                <th>Admin</th>
                </tr>";

          foreach ($resdisplay_users as $row) {

            $id = $row['id'];
            $table = $row['table'];
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['admin'] . "</td>";
            echo "<td><form class='form' method='GET' action='admin_user_update.php'>
                  <input type = 'hidden' name = 'id' value = '$id' />
                  <input class='input_update'type='submit' value='UPDT' >  </form></td>";
            echo "<td><form class='form' method='GET' action='admin_delete.php'>
                  <input type = 'hidden' name = 'id' value = '$id' />
                  <input type = 'hidden' name = 'table' value = users />
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