<!-- NAV ADMIN --------------------------------------- -->
<html>
    <?php include("nav_bar.php") ?>
    <!-- END NAV ADMIN --------------------------------------- -->
 <!-- DISPLAY PANEL / ACTION --------------------------------------------------------- -->
 <div class="panel" >         
        <div class="user_array">
            <h2>PRODUCT UPDATE</h2>
			<h4>Product info will remain the same if untouched</h4>

<?php

include_once ("connect_db.php");
session_start();
if (!isset($_SESSION['uname']) && $_SESSION['admin'] != 1) {

    header('Location: index.php');

}
// $new_productname = $_POST['name'];
// $new_price = $_POST['price'];
// $new_description = $_POST['description'];
// $_SESSION['idupdate'] = $_GET['id'];

echo $_POST['id'];

$productname = $_POST["name"];
$price = $_POST["price"];
$description = $_POST["description"];
$image = $_POST["image_path"];
$idprod = $_POST['id'];

$id = $_GET['id'];
$stmt = $pdo->query("SELECT * FROM products WHERE id = '$id'"); // fetch data recupere les infos de la ligne product avec l'id 
$rows = $stmt->fetchAll(); // $rows devient un tableau associatif avec les valeurs recupérée par la query 

	if ($id) {                  // si id existe
        foreach($rows as $row) {
			// var_dump($row);
			$_SESSION['old_productname'] = $row['name']; //rentre ds les infos de session les valeurs de l'user avec l'id
			$_SESSION['old_description'] = $row['description'];
			$_SESSION['old_price'] = $row['price'];
			$_SESSION['old_image'] = $row['image_path'];
			
			//var_dump($_SESSION);
			// var_dump($_SESSION['old_password']);
		}
	} else {
		echo "No product found";
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if ($productname == NULL) {
		$productname = $_SESSION['old_productname'];
	} 

	if ($description == NULL) {
		$description = $_SESSION['old_description'];
	} 

	if ($price == NULL) {
		$price = $_SESSION['old_price'];
	} 
	
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
  
	if ($image_path == NULL) {
		$image_path = $_SESSION['old_image'];
	} 
  
	$updateProduct = $pdo->prepare("UPDATE products SET name = :name, price = :price, description = :description, image_path = :image_path WHERE id = '$idprod' ");
	var_dump($updateProduct);
	$updateProduct->bindParam(':name', $productname);
	$updateProduct->bindParam(':price', $price);
	$updateProduct->bindParam(':description', $description);
	$updateProduct->bindParam(':image_path', $image_path);
	$updateProduct->execute();
	header('Location: admin_products.php');
	
}
//var_dump($_SESSION);

	?>
<!DOCTYPE HTML>
<form class="admin_form" action="adminupdateproducts.php" method="post" enctype="multipart/form-data">
<label class="update_form_field"></label>


<!-- //  if (isset($_GET['error'])) { 
	// <p class="error"> echo $_GET['error'];</p>
-->
<label>Product Name</label>
<div class="input_admin_form">
<input type="text" name="name" placeholder="Enter new product Name"><br>
</div>

<label>Product Price</label>
<div class="input_admin_form">
<input type="number" name="price" placeholder="Enter new product Price"><br>
</div>

<label>Description</label>
<div class="input_admin_form">
<input type="text" name="description" placeholder="Enter new description"><br> 
</div>

<label for="picture">Upload a new Picture:</label>
<div class="input_admin_form">
<input type="file" name="picture"><br> 
</div>
<input type="hidden" name="id" value='<?php echo $_GET['id'];?>' ><br> 
<button class="form_button" type="submit">Update</button>

</form>

<form action="admin_products.php" method="post">
                <div class="form_buttons">
                    <button class="form_button" type="submit" name="cancel">Cancel</button>
                </div>
            </form>
