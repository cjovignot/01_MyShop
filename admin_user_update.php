<!DOCTYPE HTML>
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
    <div class="user_array">
                <h2>USER INFORMATIONS UPDATE</h2>
                <?php

                    $id = $_GET['id'];
                    $stmt = $pdo->query("SELECT * FROM users WHERE id = $id"); // fetch data
                    $rows = $stmt->fetchAll();
                    var_dump($_GET);
                    // var_dump($rows);
                    if ($id) {
                        foreach($rows as $row) {
                            // var_dump($row);
                            $user_username = $row['username'];
                            $user_email = $row['email'];
                            $user_password = $row['password'];      
                        }
                    } else {
                        echo "No user found";
                    }
                ?>
    </div>

            <div>
                <form class="admin_form" action="admin_users.php" method="post">
                        <label class="update_form_field"></label>
                            <div class="display">
                                <?php echo "Old username : " . $user_username;?>
                            </div>
                            <div class="input_admin_form">
                                <input type="text" name="new_username" placeholder="New username" class="validate">
                            </div>

                        <label class="update_form_field"></label>
                            <div class="display">
                                <?php echo "Old email : " . $user_email;?>
                            </div>
                            <div class="input_admin_form">
                                <input type="email" name="new_email" placeholder="New email" class="validate">
                            </div>

                            <div class="title_with_field">
                                <label class="update_form_field"></label>
                                <div class="display">
                                    <?php echo "Old password : " . $user_password;?>
                                </div>
                                <div class="input_admin_form">
                                    <input type="password" name="new_password" placeholder="New password" class="validate">
                                </div>
                            </div>

                        <label class="update_form_field">Verify Password</label>
                            <div class="input_admin_form">
                                <input type="password" name="password_check" placeholder="New password Check" class="validate">
                            </div>
                        <div class="form_buttons">
                            <button class="form_button" type="submit">Discard changes</button>
                            <button class="form_button" type="submit">Update</button>
                        </div>
                </form>
            </div>

</div>  
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->





          

</body>

</html>
