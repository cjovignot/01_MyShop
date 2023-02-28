<?php
include_once("connect_db.php");
session_start();
?>
<!-- NAV ADMIN --------------------------------------- -->
<html>

<style>
    .form {
        padding:0px;
        margin:0px;
    }
    .input_update{
        text-decoration: none;
        background-color: #F3DFBF;
        padding:5px;
        border:none;
        border-radius: 2px;
        font-weight: bold;

    }

    .input_delete{
        text-decoration: none;
        background-color: #EB8A90;
        padding:5px;
        border:none;
        border-radius: 2px;
        font-weight: bold;
        color:white;

    }

 table.displaytable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  text-align: left;
  border-collapse: collapse;
}
table.displaytable td, table.displaytable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
  text-align: center;
  align-content: middle;
}
table.displaytable tbody td {
  font-size: 13px;
  padding:5px;
  text-align: center;
  align-content: middle;
}
table.displaytable tr:nth-child(even) {
  background: #D0E4F5;
}
table.displaytable thead {
  background: #2D82B7;
  background: -moz-linear-gradient(top, #bbbbbb 0%, #adadad 66%, #A4A4A4 100%);
  background: -webkit-linear-gradient(top, #bbbbbb 0%, #adadad 66%, #A4A4A4 100%);
  background: linear-gradient(to bottom, #bbbbbb 0%, #adadad 66%, #A4A4A4 100%);
  border-bottom: 2px solid #444444;
}
table.displaytable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.displaytable thead th:first-child {
  border-left: none;
}

table.displaytable tfoot td {
  font-size: 14px;
  text-align: center;
  align-content: middle;
}
table.displaytable tfoot .links {
  text-align: right;
}
table.displaytable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}

.create_admin_menu {
    width: 100%;
    height: 30px;
    display: flex;
    justify-content: center;
    text-decoration: none;
    align-items: center;
    color: #1b1b1b;
    transition: 0.2s;
    border-radius: 5px;
    border: 1px black solid;
    padding: 5px;
    margin: 5px;
    background-color: #bbbbbb;
}
.create_admin_menu:hover {
    background-color: #1b1b1b;
    color: white;
    transition: 0.2s;
}




    </style>
 <?php include("nav_bar.php") ?>
<!-- END NAV ADMIN --------------------------------------- -->
<!-- DISPLAY PANEL / ACTION --------------------------------------------------------- -->
<div class="panel" >         
<div><h1>PRODUCT PANEL</h1>
<p>Manage your products via this CRUD </p></div>
<div>
<a class="create_admin_menu" href="admincreateproducts.php">Add product</a>
</div>  


<div>

<?php 


if (isset($_SESSION['uname']) && $_SESSION['admin'] == 0){
                      echo "<a href='admin.php'><div class='button_menu' >ADMIN</div></a>";
                      header('Location: index.php');
                    }


display_db_product($pdo);
function display_db_product($pdo){
$display_products = $pdo->query("SELECT * FROM products");
$resdisplay_products = $display_products->fetchAll(PDO::FETCH_ASSOC);

echo "<table class='displaytable' >
<tr>
<th>id</th>
<th>name</th>
<th>description</th>
<th>price</th>
<th>picture</th>
<th>category_id</th>
</tr>";


foreach($resdisplay_products as $row)
{

    $id=$row['id'];
    
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['description'] . "</td>";
echo "<td>" . $row['price'] . "€"."</td>";
echo "<td>" . $row['image_path'] . "</td>";
echo "<td>" . $row['category_id'] . "</td>";
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
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->
     







</body>

</html>