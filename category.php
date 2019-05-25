<?php include('include/home/header.php'); ?>

    	<section>
		<div class="container">
			<div class="row">
				<?php include('include/home/sidebar.php'); ?>
                <?php $filter = isset($_GET['filter']) ? $_GET['filter'] : '';?>
                    
    <div class="col-sm-9 padding-right">
					<div class="features_items"><!--feature_items-->
						<h2 class="title text-center">Kategoria <?php echo $filter;?></h2><br>
	
<!--php starts here-->
<?php	
	$db = Databasei::getInstance();
    $mysqli = $db->getConnection(); 

	$result = $mysqli->query("SELECT * FROM products where Product like '%$filter%' or Description like '%$filter%' or Category like '%$filter%'");

	if($result){
		while($row=mysqli_fetch_array($result)){					
                            $prodID = $row["ID"];	
			echo '<ul class="col-sm-4">';
			echo '<div class="product-image-wrapper">
				  <div class="single-products">
				  <div class="productinfo text-center">
			<a href="product-details.php?prodid='.$prodID.'" rel="bookmark" title="'.$row['Product'].'"><img src="files/img/products/'.$row['imgUrl'].'" alt="'.$row['Product'].'" title="'.$row['Product'].'" width="150" height="150" />
            </a>
			
			<h2><a href="product-details.php?prodid='.$prodID.'" rel="bookmark" title="'.$row['Product'].'">'.$row['Product'].'</a></h2>
			<h2>'.$row['Price'].'</h2>
			<p>Kategoria: '.$row['Category'].'</p>
			
			<a href="product-details.php?prodid='.$prodID.'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Shfleto Detajet</a>
			</div>';		
			echo '</ul>';			
		}
	}
?>

<!--php ends here-->
		</div>
        </div>
</div>
</div>
</div>
</section>

<?php include('include/home/footer.php'); ?>