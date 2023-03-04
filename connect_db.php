<?php
    define("ERROR_LOG_FILE", "error_log.txt");

    $host = "localhost";
    $username = "myshopadmin";
    $password = "branleurmyshop";
    $port = "3306";
    $db = "my_shop";
    $pdo = connect_db($host, $username, $password, $port, $db);

    function connect_db($host, $username, $password, $port, $db) {
        $dsn = "mysql:host=$host;port=$port;dbname=$db";
        try {
            $pdo = new PDO($dsn, $username, $password);
            // echo "Connexion established for " . $username . "!" . PHP_EOL;
            return $pdo;
        } catch (PDOException $e) {
            $error = $e->getMessage();
            $log_message = "PDO ERROR: $error storage in " . ERROR_LOG_FILE . "\n";
            file_put_contents(ERROR_LOG_FILE, $log_message, FILE_APPEND);
            // echo "Connexion failed !" . PHP_EOL;
            return false;
        }
    }
?>