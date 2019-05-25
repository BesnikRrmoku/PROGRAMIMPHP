<?php

include('db.php');

$db = Databasei::getInstance();
$mysqli = $db->getConnection(); 

if($_GET['id'])
{
	 $id=$_GET['id'];
	 $sql = "delete from products where id='$id'";
	 $mysqli->query($sql);
}

?>