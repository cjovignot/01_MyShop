<!DOCTYPE HTML>
<?php
include_once("connect_db.php");
session_start();
if (!isset($_SESSION['uname']) && $_SESSION['admin'] != 1) {

    header('Location: index.php');

}
$new_username = $_POST['new_username'];
$new_email = $_POST['new_email'];
$new_password = $_POST['new_password'];
$new_admin = $_POST['admin_check'];
$_SESSION['idupdate'] = $_GET['id'];
?>
<!-- NAV ADMIN --------------------------------------- -->
<html>
    <?php include("nav_bar.php") ?>
    <!-- END NAV ADMIN --------------------------------------- -->
    <!-- DISPLAY PANEL / ACTION --------------------------------------------------------- -->
    <div class="panel" >         
        <div class="user_array">
            <h2>USER INFORMATIONS UPDATE</h2>
            <h4>User info will remain the same if untouched</h4>
            <?php
                $id = $id = $_GET['id'];
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
                        $_SESSION['adminstatus'] = $row['admin'];
                        // var_dump($_SESSION);
                        // var_dump($_SESSION['old_password']);
                    }
                } else {
                    echo "No user found";
                }
          
                function update_user($pdo, $new_username, $new_email, $new_password, $new_admin) {
                    $id = $_POST['id'];
                    $chk_username = $pdo->query("SELECT username FROM users WHERE username = '$new_username'");
                    $verif_uname = $chk_username->fetch(PDO::FETCH_ASSOC);
                 
                    if ($new_username == NULL) {
                        $new_username = $_SESSION['old_username'];
                    } 

                    if ($new_username == $verif_uname['username']){
                        echo "User already exist";
                        $func_return = false;  
                        return $func_return;      
                    }
                 
                    if ($new_email == NULL) {
                      $new_email= $_SESSION['old_email'];
                    }
                    if ($new_admin == NULL) {
                        $new_admin = $_SESSION['adminstatus'];
                      }
                    if ($new_password == NULL) {
                        $new_password= $_SESSION['old_password'];
                    } else {
                        $salt = uniqid(false);
                        $hash = crypt($new_password, $salt);
                        $new_password= $hash;
                    }

                    
                    //var_dump($_SESSION);
                    $query = $pdo->query("UPDATE users SET username = '$new_username', email = '$new_email', password = '$new_password' , admin = '$new_admin'
                    WHERE id = '$id'");
                     
                    $func_return = true;
                    return $func_return;
                    var_dump($func_return);
                }
                
            
                
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $test = update_user($pdo, $new_username, $new_email, $new_password, $new_admin);
               
             }
             if ($test){
                header('Location: admin_users.php');
             }
           
               
              

            ?>



<form class="admin_form" action="admin_user_update.php?id=<?php echo $_GET["id"]; ?>" method="post">
                <label class="update_form_field"></label>
                    <div class="display">
                        <?php echo "Old username";?>
                    </div>
                    <div class="input_admin_form">
                        <input type="text" name="new_username" placeholder="<?php echo $user_username;?>" class="validate"> <?php echo $user_exist;?>
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
                <label class="update_form_field">is admin</label>
                    <div class="input_admin_form">
                        <input type="radio" name="admin_check" value="1" > <label class="update_form_field">Yes</label>
                        <input type="radio" name="admin_check" value="0" > <label class="update_form_field">No</label>
                    </div>
                <input type="hidden" name="id" value='<?php echo $_SESSION['idupdate'];?>'>
                <button class="form_button" type="submit">Update</button>
            </form>
            <form action="admin_users.php" method="post">
                <div class="form_buttons">
                    <button class="form_button" type="submit" name="cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>  
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->

</html>
