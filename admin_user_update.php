<!DOCTYPE HTML>
<?php
include_once("connect_db.php");
session_start();
$new_username = $_POST['new_username'];
$new_email = $_POST['new_email'];
$new_password = $_POST['new_password'];
?>
<!-- NAV ADMIN --------------------------------------- -->
<html>
    <?php include("nav_bar.php") ?>
    <!-- END NAV ADMIN --------------------------------------- -->
    <!-- DISPLAY PANEL / ACTION --------------------------------------------------------- -->
    <div class="panel" >         
        <div class="user_array">
            <h2>USER INFORMATIONS UPDATE</h2>
            <?php
                $id = $_GET['id'];
                $stmt = $pdo->query("SELECT * FROM users WHERE id = '$id'"); // fetch data
                $rows = $stmt->fetchAll();
                // var_dump($_GET);
                // var_dump($rows);
                if ($id) {
                    foreach($rows as $row) {
                        // var_dump($row);
                        $_SESSION['old_password'] = $row['password'];
                        $_SESSION['old_email'] = $row['email'];
                        $_SESSION['old_username'] = $row['username'];
                        // var_dump($_SESSION);
                        // var_dump($_SESSION['old_password']);
                    }
                } else {
                    echo "No user found";
                }
            ?>
            
            <form class="admin_form" action="admin_user_update.php" method="post">
                <label class="update_form_field"></label>
                    <div class="display">
                        <?php echo "Old username";?>
                    </div>
                    <div class="input_admin_form">
                        <input type="text" name="new_username" placeholder="<?php echo $user_username;?>" class="validate">
                    </div>

                <label class="update_form_field"></label>
                    <div class="display">
                        <?php echo "Old email";?>
                    </div>
                    <div class="input_admin_form">
                        <input type="email" name="new_email" placeholder="<?php echo $user_email;?>" class="validate">
                    </div>

                    <div class="title_with_field">
                        <label class="update_form_field"></label>
                        <div class="display">
                            <?php echo "Old password";?>
                        </div>
                        <div class="input_admin_form">
                            <input type="password" name="new_password" placeholder="<?php echo $user_password;?>" class="validate">
                        </div>
                    </div>

                <label class="update_form_field">Verify Password</label>
                    <div class="input_admin_form">
                        <input type="password" name="password_check" placeholder="<?php echo "Confirm password";?>" class="validate">
                    </div>
                <input type="hidden" name="id" value='<?php echo $_GET['id'];?>'>
                <button class="form_button" type="submit">Update</button>
            </form>
            <form action="admin_users.php" method="post">
                <div class="form_buttons">
                    <button class="form_button" type="submit" name="cancel">Cancel</button>
                </div>
            </form>

            <?php
                function update_user($pdo, $new_username, $new_email, $new_password) {
                    $id = $_POST['id'];
                    $update_user = $pdo->query("UPDATE users SET username = '$new_username', email = '$new_email', password = '$new_password'
                    WHERE id = '$id'");
                    if ($_POST['username'] == NULL) {
                        $_POST['username'] = $user_username;
                    }
                }
                update_user($pdo, $new_username, $new_email, $new_password);
                header('Location:admin_users.php');
            ?>
        </div>
    </div>  
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->

</html>
