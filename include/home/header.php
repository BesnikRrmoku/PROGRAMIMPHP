<?php include('db.php'); ?>
<?php session_start(); ?>

<?php date_default_timezone_set('Europe/Tirane'); ?>

<?php
    $obj = new Data();
    //$countproduct = $obj->countproduct();
    
    $cat = $obj->getcategory();
    
    
    
    // klasa Data ka dy funksione:
    // countproduct()
    //      -
    //   dhe
    // getcategory() 
    //      -mirret lista e kategorive perkatese qe jane te regjistruara ne databaze
    class Data {
        
        //e implementuar diku tjeter.
//        function countproduct(){
//            $count = 0;
//            $cart = isset($_SESSION['cart']) ? $_SESSION['cart']:array();
//            foreach($cart as $row){
//                if($row['qty']!=0){
//                    $count = $count + 1;
//                }
//            }
//            
//            return $count;
//        }
        
        function getcategory(){
        	$db = Databasei::getInstance();
    		$mysqli = $db->getConnection();

            $result = $mysqli->query("SELECT * FROM category");
            return $result;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gift Shop</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">     

</head><!--/head-->

<body>
<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +37744810661</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> giftshop@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="logo pull-left">
							<center><a href="index.php"><img src="images/home/header.jpg" alt="Gift Shop" class="img-responsive" width="100%"  /></a></center>
						</div>		
					</div>					
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom navbar navbar-inverse no-radius"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header navbar-default">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Ballina</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <?php
                                                $cat = $obj->getcategory();
                                            while($row = mysqli_fetch_array($cat)){
                                                echo '<li><a href="category.php?filter='.$row['title'].'">'.$row['title'].'</a></li>';
                                            }
                                        ?>    
                                    </ul>
                                </li> 
								<li><a href="about.php">Rreth Nesh</a></li> 
								<li><a href="contact.php">Kontakti</a></li>
								<li><a href="cart.php">Shporta <span class="badge"></span></a></li>
								<li><a href="login.php">Kycu</a></li>
							</ul>
						</div>
					</div>
                    <div class="col-sm-3">
						<div class="search_box pull-right">
                            <form action="index.php" method="post">
							     <input type="text" placeholder="Kerko" name="filter" />
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
</header><!--/header-->
    