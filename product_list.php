<?php
include_once("connect_db.php");
session_start();
?>

<head>
    <link rel="stylesheet" href="">
    <meta charset="UTF-8">
    <title>Wankers by Epitech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
</head>

        <?php
        display_db_products($pdo);
        function display_db_products($pdo){
            $display_products = $pdo->query("SELECT * FROM products");
            $resdisplay_products = $display_products->fetchAll(PDO::FETCH_ASSOC);
                echo "<table border='3' style='width: 80%; height: 30px; margin: auto' class='displaytable' >
                <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image_path</th>
                <th>Category_id</th>
                </tr>";

            foreach($resdisplay_products as $row) {
                $id=$row['id'];
                $table=$row['table'];
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['image_path'] . "</td>";
                    echo "<td>" . $row['category_id'] . "</td>";
            }
            echo "</table>";
        }
    ?>