<?php
include('db.php');

	$db = Databasei::getInstance();
    $mysqli = $db->getConnection(); 
    
   $mysqli->query($sql_query);

	if (!isset($_FILES['image']['tmp_name'])) {
		echo "";
	}else{
	$file=$_FILES['image']['tmp_name'];
	$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
	$image_size= getimagesize($_FILES['image']['tmp_name']);

	
		if ($image_size==FALSE) {
		
			echo "Nuk keni zgjedhur foto!";
			
		} else {
			
			move_uploaded_file($_FILES["image"]["tmp_name"],"files/img/products/" . $_FILES["image"]["name"]);
			
			$location=$_FILES["image"]["name"];
			$pname=$_POST['pname'];
			$desc=$_POST['desc'];
			$price=$_POST['price'];
			$cat=$_POST['cat'];	
			
			$update=$mysqli->query("INSERT INTO products (imgUrl, product, Description, Price, Category)
								VALUES('$location','$pname','$desc','$price','$cat')");
			
			header("location: admin.php");
			exit();										
		}
	}


?>
