<!DOCTYPE HTML>

<head>
        <link rel="stylesheet" href="">
        <meta charset="UTF-8">
        <title>Wankers by Epitech</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="stylesheet.css" rel="stylesheet">
</head>


<?php
    include("connect_db.php");
    $host = "localhost";
    $username = "myshopadmin";
    $password = "branleurmyshop";
    $port = "3306";
    $db = "my_shop";
    $pdo = connect_db($host, $username, $password, $port, $db);
?>

<?php



$username = $_POST['username'];
$chk_username = $pdo->prepare("SELECT * FROM users WHERE username=?");
$chk_username->execute([$username]);
$username_verif = $chk_username->fetch();
$email = $_POST['email'];
$chk_email = $pdo->prepare("SELECT * FROM users WHERE email=?");
$chk_email->execute([$email]);
$email_verif = $chk_email->fetch();
if (($_POST['username']) == NULL || ($_POST['email']) == NULL || ($_POST['password']) == NULL || ($_POST['password_check']) == NULL) {
    echo "Something's missing, please check your informations - ";
} else if ($username_verif) {
    // username found
    echo "Username already exists - ";
} else if (($_POST['username']) == NULL) {
    echo "Please choose a username";
} else if ($email_verif) {
    // email found
    echo "email already exist - ";
} else if (($_POST['email'] == NULL)) {
    echo "Please fill in your email - ";
} else if (!filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format ! - ";
} else if (($_POST['password']) == NULL) {
    echo "Please check your password, something's missing ! - ";
} else if (($_POST['password']) !== ($_POST['password_check'])) {
    echo "Wrong password somewere, no match ! - ";
} else {
    $salt = uniqid(false);
    $hash = crypt($_POST['password'], $salt);
    $sql = $pdo->query("INSERT INTO users (username, password, email, admin) VALUES ('$_POST[username]', '$hash', '$_POST[email]', '0')");
    echo "Registration complete !" . PHP_EOL . "Welcome abord " . $_POST['username'] . "! - ";
    header("Location:http://localhost:8000/index.php");
}
?>



<body class="login">
    <form action="signup.php" method="post">
        <div class="login_title">SIGN UP</div>

        <label class="login_input_field">User Name</label>
        <div class="login_input_field"><input type="text" name="username" placeholder="User Name" class="validate"></div><br>

        <label class="login_input_field">Email</label>
        <div class="login_input_field"><input type="email" name="email" placeholder="Email" class="validate"></div><br>

        <label class="login_input_field">Password</label>
        <div class="login_input_field"><input type="password" name="password" placeholder="Password" class="validate"></div><br>

        <label class="login_input_field">Verify Password</label>
        <div class="login_input_field"><input type="password" name="password_check" placeholder="Password Check" class="validate"></div><br>

        <button class="second_button" type="submit">Register</button>
    </form>

      <script src="range.js"></script>

</body>