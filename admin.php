<?php
include_once("connect_db.php");
session_start();
if (!isset($_SESSION['uname']) && $_SESSION['admin'] != 1) {

    header('Location: index.php');
}



$countuser = $pdo->query("SELECT Count(id) from users where admin = '0'");
$res_countuser = $countuser->fetch(PDO::FETCH_ASSOC);
$countadmin = $pdo->query("SELECT Count(id) from users where admin = '1'");
$res_countadmin = $countadmin->fetch(PDO::FETCH_ASSOC);
$countproduct = $pdo->query("SELECT Count(id) from products ");
$res_countproduct = $countproduct->fetch(PDO::FETCH_ASSOC);
$countcategory = $pdo->query("SELECT Count(id) from categories where parent_id = '0'");
$res_countcategory = $countcategory->fetch(PDO::FETCH_ASSOC);
$countsub = $pdo->query("SELECT Count(id) from categories where parent_id > '0'");
$res_countsub = $countsub->fetch(PDO::FETCH_ASSOC);



?>



<!-- NAV ADMIN --------------------------------------- -->
<html>
<?php include("nav_bar.php") ?>
<!-- END NAV ADMIN --------------------------------------- -->
<!-- DISPLAY PANEL / ACTION --------------------------------------------------------- -->
<div class="panel">
    <div>
        <h1>ADMINISTRATION DESK</h1>
        <p>Welcome on the admin panel, from here you are able to manage your user and product database </p>
    </div>
    <div>
        <div id="infos_admin">
            <div class="filter_column">USERS
                <div class="detail_filter"><?php echo $res_countuser['Count(id)']; ?></div>
            </div>
            <div class="filter_column">ADMIN 
                <div class="detail_filter"><?php echo $res_countadmin['Count(id)']; ?></div>
            </div>
            <div class="filter_column">PRODUCTS 
                <div class="detail_filter"><?php echo $res_countproduct['Count(id)']; ?></div>
            </div>
            <div class="filter_column">CATEGORIES 
                <div class="detail_filter"><?php echo $res_countcategory['Count(id)']; ?></div>
            </div>
            <div class="filter_column">SUB CATEGORIES 
                <div class="detail_filter"><?php echo $res_countsub['Count(id)']; ?></div>
            </div>
        </div>
    </div>

</div>
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->


</body>

</html>