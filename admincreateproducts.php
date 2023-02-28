<?php

include_once ("connect_db.php");


$PDO_connection = connect_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$productname = $_POST["name"];
	$price = $_POST["price"];
	$description = $_POST["description"];
	
	// Handle file upload
	$picture_name = $_FILES["picture"]["name"];
	$picture_tmp_name = $_FILES['picture']['tmp_name'];
	$picture_error = $_FILES['picture']['error'];
	
	if ($picture_error === UPLOAD_ERR_OK) {
		 //Move uploaded file to desired directory
		move_uploaded_file($picture_tmp_name, 'uploads/' . $picture_name);
		$image_path = 'uploads/' . $picture_name;
  } else {
		// Handle upload error
		$image_path = null;
	}
  
  //var_dump($image_path);
	// Insert product into database
	$createProduct = $PDO_connection->prepare("INSERT INTO products (name, price, description, image_path) VALUES (:name, :price, :description, :image_path)");
	$createProduct->bindParam(':name', $productname);
	$createProduct->bindParam(':price', $price);
	$createProduct->bindParam(':description', $description);
	$createProduct->bindParam(':image_path', $image_path);
	$createProduct->execute();
}

	?>
<!DOCTYPE HTML>
<form action="adminproducts.php" method="post" enctype="multipart/form-data">

<h2>CREATE PRODUCTS</h2>

<!-- //  if (isset($_GET['error'])) { 
	// <p class="error"> echo $_GET['error'];</p>
-->
<label>Product Name</label>

<input type="text" name="name" placeholder="Product Name"><br>

<label>Product Price</label>

<input type="int" name="price" placeholder="Product Price"><br>

<label>Description</label>

<input type="text" name="description" placeholder="description"><br> 

<label for="picture">Upload a Picture:</label>

<input type="file" name="picture"><br> 

<button type="submit">ADD</button>


</form>


