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
	// update product into database
	$updateProduct = $PDO_connection->prepare("UPDATE products SET name = :name, price = :price, description = :description, image_path = :image_path");

	$updateProduct->bindParam(':name', $productname);
	$updateProduct->bindParam(':price', $price);
	$updateProduct->bindParam(':description', $description);
	$updateProduct->bindParam(':image_path', $image_path);
	$updateProduct->execute();
}

	?>
<!DOCTYPE HTML>
<form action="adminupdateproducts.php" method="post" enctype="multipart/form-data">

<h2>UPDATE PRODUCTS</h2>

<!-- //  if (isset($_GET['error'])) { 
	// <p class="error"> echo $_GET['error'];</p>
-->
<label>Product Name</label>

<input type="text" name="name" placeholder="Enter new product Name"><br>

<label>Product Price</label>

<input type="int" name="price" placeholder="Enter new product Price"><br>

<label>Description</label>

<input type="text" name="description" placeholder="Enter new description"><br> 

<label for="picture">Upload a new Picture:</label>

<input type="file" name="picture"><br> 

<button type="submit">ADD</button>


</form>
