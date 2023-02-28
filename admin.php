<?php
include_once("connect_db.php");
session_start();


?>

<!-- NAV ADMIN --------------------------------------- -->
<html>

 <?php include("nav_bar.php") ?>
<!-- END NAV ADMIN --------------------------------------- -->


<!-- DISPLAY PANEL / ACTION --------------------------------------------------------- -->
<div class="panel" >         
   <div><h1>ADMINISTRATION DESK</h1>
<p>Welcome on the admin panel, from here you are able to manage your user and product database </p></div>

<?php 


if (isset($_SESSION['uname']) && $_SESSION['admin'] == 0){
                      echo "<a href='admin.php'><div class='button_menu' >ADMIN</div></a>";
                      header('Location: index.php');
                    }


display_db_user($pdo);
function display_db_user($pdo){
$display_users = $pdo->query("SELECT * FROM users");
$resdisplay_users = $display_users->fetchAll(PDO::FETCH_ASSOC);

echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>";

foreach($resdisplay_users as $row)
{
echo "<tr>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['password'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['admin'] . "</td>";
echo "<td><button>update</button></td>";
echo "<td><button>delete</button></td>";
echo "</tr>";
}
echo "</table>";


}






 ?>

</div>  
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->





</div>          

</body>

</html>
