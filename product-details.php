<?php include('include/home/header.php'); ?>

<?php
	//include("db.php");

	$db = Databasei::getInstance();
    $mysqli = $db->getConnection();
	
	$prodID = $_GET['prodid'];

	if(!empty($prodID)){
		$sqlSelectSpecProd = $mysqli->query("select * from products where id = '$prodID'") or die(mysql_error());
		$getProdInfo = mysqli_fetch_array($sqlSelectSpecProd);
		$prodname= $getProdInfo["Product"];
		$prodcat = $getProdInfo["Category"];
		$prodprice = $getProdInfo["Price"];
		$proddesc = $getProdInfo["Description"];
		$prodimage = $getProdInfo["imgUrl"];
	}
?>

	<section>
		<div class="container">
			<div class="row">
				<?php include('include/home/sidebar.php'); ?>
				
                
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
                            
						
							<img src="files/img/products/<?php echo $prodimage; ?>" />	
                                
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
							<h2 class="product"><?php echo $prodname; ?></h2>
								<p>Kategoria: <?php echo $prodcat; ?></p>
				
								<p>Cmimi: <span class="price"><?php echo $prodprice; ?></span></p>

                                <br>
                                
                                <a class="btn btn-default add-to-cart" id="add-to-cart"><i class="fa fa-shopping-cart"></i>Shto ne Shporte</a>
                                <p class="info hidethis" style="color:red;"><strong>Produkti u shtua ne shporte!</strong></p>
								<p><b>Pershkrimi: </b><?php echo $proddesc; ?></p>
								<p><b>Kontakti:</b> +37744810661</p>
								<p><b>Email:</b> giftshop@gmail.com</p>
								
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
				</div>
			</div>
		</div>
		</div>
	</section>
	
	<?php include('include/home/footer.php'); ?>