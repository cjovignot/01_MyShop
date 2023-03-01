<!DOCTYPE HTML>
<head>
        <link rel="stylesheet" href="">
        <meta charset="UTF-8">
        <title>Wankers by Epitech</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="stylesheet.css" rel="stylesheet">
</head>

<?php
include_once("connect_db.php");
session_start();
?>


  <?php            
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$productname = $_POST["name"];
	// gestion si name existe deja : pas utile pour le moment
	//$chk_product = $pdo->prepare("SELECT * FROM products WHERE name=?");
	//$chk_product->execute([$productname]);
	//$product_verif = $chk_product->fetch();
	$price = $_POST["price"];
	$description = $_POST["description"];
	
	// Handle file upload
	$picture_name = $_FILES["picture"]["name"];
	$picture_tmp_name = $_FILES['picture']['tmp_name'];
	$picture_error = $_FILES['picture']['error'];
	
	if ($description == NULL) {
		$errordescription = "Description is missing, please check your informations - "; 
		$reload = true;
	
	}
	
	if ($productname == NULL) {
		$errorname = "Name is missing, please check your informations - "; 
		$reload = true;
	
	}
	// gestion si name existe deja : pas utile pour le moment
	// if ($product_verif) {
	// 	// username found
	// 	$doubleproduct = "Product already exists - ";
	// 	$reload = true;
	// }

	if ($picture_error === UPLOAD_ERR_OK) {
		 //Move uploaded file to desired directory
		move_uploaded_file($picture_tmp_name, 'uploads/' . $picture_name);
		$image_path = 'uploads/' . $picture_name;
  	} else {
		// Handle upload error
		$image_path = null;
	
	}

	if ($image_path == NULL) {
		$errorimage = "Wrong size or format";
		$reload = true;

		
	}

	if (!$reload){
		header('Location: admin_products.php');
  //var_dump($image_path);
	// Insert product into database
	$createProduct = $pdo->prepare("INSERT INTO products (name, price, description, image_path) VALUES (:name, :price, :description, :image_path)");
	$createProduct->bindParam(':name', $productname);
	$createProduct->bindParam(':price', $price);
	$createProduct->bindParam(':description', $description);
	$createProduct->bindParam(':image_path', $image_path);
	$createProduct->execute();
	
}
}

	?>
<!DOCTYPE HTML>

<body class="login">
	
<form action="admincreateproducts.php" method="post" enctype="multipart/form-data">

<h2 class="login_title">CREATE PRODUCTS</h2>

<!-- //  if (isset($_GET['error'])) { 
	// <p class="error"> echo $_GET['error'];</p>
-->
<label class="login_input_field">Product Name</label>

<div class="login_input_field"><input type="text" name="name" placeholder="Product Name" class="validate"><?php echo $errorname; ?></div><br>

<label class="login_input_field">Product Price</label>

<div class="login_input_field"><input type="number" name="price" placeholder="Product Price" required class="validate"></div><br>

<label class="login_input_field">Description</label>

<div class="login_input_field"><input type="text" name="description" placeholder="description" class="validate"><?php echo $errordescription; ?></div><br> 

<label for="picture" class="login_input_field">Upload a Picture:</label>

<div class="login_input_field"><input type="file" name="picture" class="validate"><?php echo $errorimage; ?></div><br> 

<button type="submit">ADD</button>


</form>

<form action="admin_products.php" method="post">
                <div class="form_buttons">
                    <button class="form_button" type="submit" name="cancel">Cancel</button>
                </div>
            </form>
            </div>

</div>  

</body>
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->





          

</body>

</html>
