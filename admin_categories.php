<?php
include_once("connect_db.php");
session_start();
if (!isset($_SESSION['uname']) && $_SESSION['admin'] != 1) {

    header('Location: index.php');

}?>

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
  padding: 5px 20px;
  text-align: center;
  align-content: middle;
}

.sub {
 
  
  background-color: #96BBBB;
}
/* table.displaytable tr:nth-child(even) {
  background: #D0E4F5;
} */
/* table.displaytable thead {
  background: #2D82B7;
  background: -moz-linear-gradient(top, #bbbbbb 0%, #adadad 66%, #A4A4A4 100%);
  background: -webkit-linear-gradient(top, #bbbbbb 0%, #adadad 66%, #A4A4A4 100%);
  background: linear-gradient(to bottom, #bbbbbb 0%, #adadad 66%, #A4A4A4 100%);
  border-bottom: 2px solid #444444;
} */
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
<div><h1>CATEGORY PANEL</h1>
<p>Manage your category and sub via this CRUD </p></div>
<div>
<a class="create_admin_menu" href="admin_category_create.php">Add category</a>
</div>  


<div>

<?php 


if (isset($_SESSION['uname']) && $_SESSION['admin'] == 0){
                      echo "<a href='admin.php'><div class='button_menu' >ADMIN</div></a>";
                      header('Location: index.php');
                    }


display_db_category($pdo);
function display_db_category($pdo){
$display_category = $pdo->query("SELECT * FROM categories WHERE parent_id='0'");
$resdisplay_category = $display_category->fetchAll(PDO::FETCH_ASSOC);

echo "<table class='displaytable' >
<tr>
<th>id</th>
<th>name</th>
<th>parent_id</th>
<th>is_sub</th>
<th>update</th>
<th>delete</th>
</tr>";


foreach($resdisplay_category as $row)
{

    $id=$row['id'];
    
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
foreach($resdisplay_subcategory as $rowsub)

{

    $idsub=$rowsub['id'];
    
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
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->
     







</body>

</html>