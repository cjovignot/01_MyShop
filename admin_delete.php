<?php
include_once("connect_db.php");
session_start();

if (isset($_SESSION['uname']) && $_SESSION['admin'] == 0){
    echo "<a href='admin.php'><div class='button_menu' >ADMIN</div></a>";
    header('Location: index.php');
  }
?>

<?php 

delete($pdo);
function delete($pdo){
    $table = $_GET['table'];
    $id = $_GET['id'];

 
 $pdo->query("DELETE FROM $table WHERE id = $id");
 if ($table == 'users') {
    header('Location: admin_users.php');

 } else if ($table == 'products') {
    header('Location: admin_products.php');


} else if ($table == 'categories') {
    header('Location: admin_categories.php');
}

}
?>

