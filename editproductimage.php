<?php
	include('db.php');

	$db = Databasei::getInstance();
    $mysqli = $db->getConnection();

	$id=$_GET['id'];
	$result = $mysqli->query("SELECT * FROM products where ID='$id'");
		while($row = mysqli_fetch_array($result))
			{
				$image=$row['imgUrl'];
			}
?>
<img src="files/img/products/<?php echo $image ?>">
<form action="editpicexec.php" method="post" enctype="multipart/form-data">
	<br>
	<input type="hidden" name="prodid" value="<?php echo $id=$_GET['id']; ?>">
	Zgjidh Foton
	<br>
	<input type="file" name="image"><br>
	<input type="submit" value="Ngarko">
</form>