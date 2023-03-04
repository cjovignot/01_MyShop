<!DOCTYPE HTML>
<!-- NAV ADMIN --------------------------------------- -->
<html>
	<?php include("nav_bar.php") ?>
	<!-- END NAV ADMIN --------------------------------------- -->
	<!-- DISPLAY PANEL / ACTION --------------------------------------------------------- -->
	<?php
		include_once("connect_db.php");
		session_start();
		if (!isset($_SESSION['uname']) && $_SESSION['admin'] != 1) {

			header('Location: index.php');
		}
		// $new_productname = $_POST['name'];
		// $new_price = $_POST['price'];
		// $new_description = $_POST['description'];
		// $_SESSION['idupdate'] = $_GET['id'];
		function getcat($pdo)
		{
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


		$productname = $_POST["name"];
		$price = $_POST["price"];
		$cat_id = $_POST["cat_id"];
		$description = $_POST["description"];
		$image = $_POST["image_path"];
		$idprod = $_POST['id'];

		$id = $_GET['id'];
		//var_dump($id);
		$stmt = $pdo->query("SELECT * FROM products WHERE id = '$id'"); // fetch data recupere les infos de la ligne product avec l'id 
		$rows = $stmt->fetchAll(); // $rows devient un tableau associatif avec les valeurs recupérée par la query 
		//var_dump($rows);
		if ($id) {                  // si id existe
			foreach ($rows as $row) {
				// var_dump($row);
				$_SESSION['old_productname'] = $row['name']; //rentre ds les infos de session les valeurs de l'user avec l'id
				$_SESSION['old_description'] = $row['description'];
				$_SESSION['old_price'] = $row['price'];
				$_SESSION['old_image'] = $row['image_path'];
				$_SESSION['old_cat'] = $row['category_id'];

				//var_dump($_SESSION);
				// var_dump($_SESSION['old_password']);
			}
		} else {
			echo "No product found";
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if ($cat_id == NULL) {
				$cat_id = $_SESSION['old_cat'];
			}

			if ($productname == NULL) {
				$productname = $_SESSION['old_productname'];
			}

			if ($description == NULL) {
				$description = $_SESSION['old_description'];
			}

			if ($price == NULL) {
				$price = $_SESSION['old_price'];
			}
			$formaterror = false;
			//var_dump($_FILES);
			// Handle file upload
			$picture_name = $_FILES["picture"]["name"];
			$picture_tmp_name = $_FILES['picture']['tmp_name'];
			$picture_error = $_FILES['picture']['error'];
			//var_dump($_FILES['picture']['tmp_name']);
			//var_dump(empty($_FILES["picture"]["name"]));
			if (empty($_FILES["picture"]["name"]) == false) {


				if ($_FILES["picture"]["type"] !== "image/png") {

					$errormsg = "Wrong format: must be .png";

					$formaterror = true;
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
					$errormsg2 = "Wrong size must be 800 x 600....no more no less.";
					$formaterror = true;
					//header('Location: adminupdateproducts.php?id=' . $_GET['id']);
				}
				
				if ($picture_error === UPLOAD_ERR_OK) {
					//Move uploaded file to desired directory
					move_uploaded_file($picture_tmp_name, 'uploads/' . $picture_name);
					$image_path = 'uploads/' . $picture_name;
				} else {
					// Handle upload error
					$image_path = null;
				}
			}
			if ($image_path == NULL) {
				$image_path = $_SESSION['old_image'];
			}
			if ($formaterror == false) {
				var_dump($cat_id);
				var_dump($formaterror);
				$updateProduct = $pdo->prepare("UPDATE products SET name = :name, price = :price, category_id = :category_id, description = :description, image_path = :image_path WHERE id = '$idprod' ");
				//var_dump($updateProduct);
				$updateProduct->bindParam(':name', $productname);
				$updateProduct->bindParam(':price', $price);
				$updateProduct->bindParam(':category_id', $cat_id);
				$updateProduct->bindParam(':description', $description);
				$updateProduct->bindParam(':image_path', $image_path);
				$updateProduct->execute();
				//var_dump($_FILES);
				header('Location: admin_products.php');
			}
		}
		//var_dump($_SESSION);

	?>

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
			<h2 class="login_title">PRODUCT UPDATE</h2>
			<h4>Product info will remain the same if untouched</h4>

			<form action="adminupdateproducts.php?id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
				<label class="update_form_field"></label>
				<!-- //  if (isset($_GET['error'])) { 
					// <p class="error"> echo $_GET['error'];</p> -->
				<label class="login_input_field">Product Name</label>
				<div class="login_input_field">
					<input class="validate" type="text" name="name" placeholder="Enter new product Name"><br>
				</div>

				<label class="login_input_field">Product Price</label>
				<div class="login_input_field">
					<input class="validate"  type="number" name="price" placeholder="Enter new product Price"><br>
				</div>

				<label class="login_input_field">Description</label>
				<div class="login_input_field">
					<input class="validate"  type="text" name="description" placeholder="Enter new description"><br>
				</div>

				<label class="login_input_field">Select a category</label>
				<div class="login_input_field">
					<select name="cat_id">
						<option name="isparent" value='0'></option>
						<?php getcat($pdo) ?>
					</select><br>
				</div>

				<label class="login_input_field" for="picture">Upload a new Picture:</label>
				<div class="login_input_field">
					<input class="validate"  type="file" name="picture"><br>
					<p class="alert"> <?php echo $errormsg . " " . $errormsg2 ?></p>
				</div>
				<input type="hidden" name="id" value='<?php echo $_GET['id']; ?>'><br>
				<button class="admin_button" type="submit">Update product</button>

			</form>

			<form action="admin_products.php" method="post">
				<div class="form_buttons">
					<button class="admin_button" type="submit" name="cancel">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</html>