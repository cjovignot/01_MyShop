<?php
include_once("connect_db.php");
session_start();

if (isset($_SESSION['uname']) && $_SESSION['admin'] == 0) {
    echo "<a href='admin.php'><div class='button_menu' >ADMIN</div></a>";
    header('Location: index.php');
}
$table = $_GET['table'];
$id = $_GET['id'];
//var_dump($table);
if ($table == 'categories') {
    $check_sub = $pdo->query("SELECT name from categories where parent_id = '$id'");
    $res_check_sub = $check_sub->fetch(PDO::FETCH_ASSOC);





    if ($res_check_sub == true) {
        $SUBERROR = "WARNING: YOU are trying to delete a category that has sub categories. Please don't...";
    }
}
function delete($pdo)
{
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

<?php

if (isset($_POST['confirm'])) {
    delete($pdo);
    header('Location: admin_' . $table . '.php');
} else if ($_POST['cancel']) {
    header('Location: admin_' . $table . '.php');
}












?>




<!DOCTYPE html>
<html>
<style>
    .action_button {
        width: 400px;
        text-align: center;
        display: flex;
        justify-content: center;
        margin: 5px;

    }

    .buttonconfirm {
        margin: 5px;
    }

    .cancel {
        background-color: #F6511D;
        font-weight: bold;
        padding: 10px;
        margin: 20px;
    }

    .confirm {
        background-color: #7FB800;
        font-weight: bold;
        padding: 10px;
        margin: 20px;

    }

    .resultdelete {
        margin: 10px;
        font-weight: bold;
        font-size: 20px;
    }

    .alert {
        font-weight: bold;
        font-size: 18px;
        color: red;
    }
</style>

<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <title>Wankers by Epitech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
</head>

<body class="login">
    <div class=“popup” id=“popup-1”>


        ×</div>

    <div class=“content”>





        <div>
            <div class="login_title">ARE YOU SURE?</div>

            <p>You are about to delete the <?php echo $table ?>: </p>
            <div class="resultdelete"> <?php $deleteselect = $pdo->query("SELECT * FROM $table WHERE id = $id");
                                        $resdelete = $deleteselect->fetch(PDO::FETCH_ASSOC);
                                        if ($table == "users") {
                                            echo $resdelete['username'];
                                        } else if ($table == 'categories') {
                                            echo $resdelete['name'];
                                        } else if ($table == 'products') {
                                            echo $resdelete['name'];
                                        }





                                        ?>
            </div>
            <div class="alert"> <?php echo $SUBERROR ?></div>
            <div class="action_button">

                <form action="admin_<?php echo $_GET["table"]; ?>.php" method="post">

                    <button class=cancel type="submit" name="cancel">Cancel</button>

                </form>



                <form action="admin_delete.php?id=<?php echo $_GET["id"]; ?>&table=<?php echo $_GET["table"]; ?>" method="post">

                    <button class=confirm type="submit" name="confirm">Confirm</button>

                </form>
            </div>



        </div>
























    </div>

    </div>



    <script src="range.js"></script>

</body>

</html>