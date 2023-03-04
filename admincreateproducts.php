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
	include("nav_bar.php");
	session_start();

	function getcat($pdo) {
		$cat_db = $pdo->query("SELECT * FROM categories WHERE parent_id = '0'");
		$res_cat = $cat_db->fetchAll(PDO::FETCH_ASSOC);

		$catsub_db = $pdo->query("SELECT * FROM categories WHERE parent_id > '0'");
		$res_catsub = $catsub_db->fetchAll(PDO::FETCH_ASSOC);

		foreach ($res_cat as $cat) {
			echo " <option style='background-color: #F9C22E;' name=" . $cat['id'] . " value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";

			$parentid = $cat['id'];
			$catsub_db = $pdo->query("SELECT * FROM categories WHERE parent_id = '$parentid'");
			$res_catsub = $catsub_db->fetchAll(PDO::FETCH_ASSOC);

			$catparent_db = $pdo->query("SELECT * FROM categories WHERE id = '$parentid'");
			$res_catparent = $catparent_db->fetchAll(PDO::FETCH_ASSOC);

			foreach ($res_catsub as $catsub) {
				echo " <option  name=" . $catsub['id'] . " value='" . $catsub['id'] . "'>" . $catsub['name'] . "</option>";
			}
		}
	}
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
		$cat_id = $_POST['cat_id'];

		// Handle file upload
		$picture_name = $_FILES["picture"]["name"];
		$picture_tmp_name = $_FILES['picture']['tmp_name'];
		$picture_error = $_FILES['picture']['error'];

		if ($description == NULL) {
			$errordescription = "Description is missing, please check your informations - ";
			$reload = true;
		}

		if ($cat_id == NULL) {
			$errordescription = "Category is missing, please select a category - ";
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






		if ($_FILES["picture"]["type"] !== "image/png") {
			$errorimage = "format";
			$reload = true;
		}

		$image_info = getimagesize($_FILES["picture"]["tmp_name"]);
		//var_dump($image_info);
		$width = $image_info[0];
		$height = $image_info[1];
		//var_dump($width);
		//var_dump($height);
		//var_dump($width);
		if ($width != 800 && $height != 600) {
			// echo "coucou".$width;
			// echo "coucou".$height;
			$errorimage = "Wrong size";

			$reload = true;
		}

		if ($picture_error === UPLOAD_ERR_OK) {
			//Move uploaded file to desired directory
			move_uploaded_file($picture_tmp_name, 'uploads/' . $picture_name);
			$image_path = 'uploads/' . $picture_name;
		} else {
			// Handle upload error
			$image_path = null;
		}

		if ($image_path == NULL) {
			$errorimage = "upload pbl";
			$reload = true;
		}


		// move uploaded file to desired location
		//move_uploaded_file($_FILES["image"]["tmp_name"], "/path/to/uploaded/image.png");

		if (!$reload) {


			// Insert product into database
			$createProduct = $pdo->prepare("INSERT INTO products (name, price,category_id, description, image_path) VALUES (:name, :price, :category_id, :description, :image_path)");
			$createProduct->bindParam(':name', $productname);
			$createProduct->bindParam(':price', $price);
			$createProduct->bindParam(':category_id', $cat_id);
			$createProduct->bindParam(':description', $description);
			$createProduct->bindParam(':image_path', $image_path);
			$createProduct->execute();
			header('Location: admin_products.php');
		}
	}
?>

<!DOCTYPE HTML>
<div id="container">
	<div id="admin_menu_left">
		<div id="title_menu">DISPLAY BY</div>
		<div id="admin_sub_menu_left">
			<a class="link_admin_menu" href="admin_products.php">PRODUCTS</a>
			<a class="link_admin_menu" href="admin_users.php">USERS</a>  
			<a class="link_admin_menu" href="admin_categories.php">CATEGORIES</a>
		</div>
	</div>
	<div class="panel">
		<form action="admincreateproducts.php" method="post" enctype="multipart/form-data">

			<h2 class="login_title">CREATE PRODUCTS</h2>

			<!-- //  if (isset($_GET['error'])) { 
			// <p class="error"> echo $_GET['error'];</p> -->
			<label class="login_input_field">Product Name</label>
			<div class="login_input_field"><input type="text" name="name" placeholder="Product Name" class="validate"><?php echo $errorname; ?></div><br>

			<label class="login_input_field">Product Price</label>
			<div class="login_input_field"><input type="number" name="price" placeholder="Product Price" required class="validate"></div><br>

			<label class="login_input_field">Description</label>
			<div class="login_input_field"><input type="text" name="description" placeholder="description" class="validate"><?php echo $errordescription; ?></div><br>

			<label>Select a category</label>
			<div class="login_input_field">
				<select name="cat_id">
					<option name="isparent" value='0'></option>
					<?php getcat($pdo) ?>
				</select><br>
			</div>

			<label for="picture" class="login_input_field">Upload a Picture:</label>
			<div class="login_input_field"><input type="file" name="picture" class="validate" accept="image/png" required><?php echo $errorimage . $width . $height; ?></div><br>

			<button class="admin_button" type="submit">Add new product</button>
		</form>

		<form action="admin_products.php" method="post">
			<div class="form_buttons">
				<button class="admin_button" type="submit" name="cancel">Cancel</button>
			</div>
		</form>
	</div>
</div>
<!-- END DISPLAY PANEL / ACTION --------------------------------------------------------- -->

</html>