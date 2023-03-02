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
        <table>

            <tr>
                <td>
                    <p>USERS:</p>
                </td>
                <td>
                    <h1><?php echo $res_countadmin['Count(id)']; ?></h1>
                </td>
            </tr>

            <tr>
                <td>
                    <p>ADMIN:</p>
                </td>
                <td>
                    <h1><?php echo $res_countadmin['Count(id)']; ?></h1>
                </td>
            </tr>

            <tr>
                <td>
                    <p>PRODUCTS:</p>
                </td>
                <td>
                    <h1><?php echo $res_countproduct['Count(id)']; ?></h1>
                </td>
            </tr>

            <tr>
                <td>
                    <p>CATEGORIES:</p>
                </td>
                <td>
                    <h1><?php echo $res_countcategory['Count(id)']; ?></h1>
                </td>
            </tr>

            <tr>
                <td>
                    <p>SUB CATEGORIES:</p>
                </td>
                <td>
                    <h1><?php echo $res_countsub['Count(id)']; ?></h1>
                </td>
            </tr>



        </table>



    </div>

</div>
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->







</body>

</html>