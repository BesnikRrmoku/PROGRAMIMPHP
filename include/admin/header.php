<?php include('db.php'); ?>

<?php
    $obj = new Admin();
    $p = isset($_GET['p']) ? $_GET['p'] : null;
    if($p == 'deliver'){
        $obj->deliver(); 
    }else if($p == 'paid'){
        $obj->paid();   
    }else if($p == 'delete'){
        $obj->delete();   
    }

    $db = Databasei::getInstance();
    $mysqli = $db->getConnection();
    
    class Admin {
        
        function getunpaidorders(){
                global $db;
                global $mysqli;

                $q = "SELECT * FROM giftshopdb.order where status='unconfirmed' order by dateOrdered desc";
                $result = $mysqli->query($q);
            
                return $result;
        }
        function getdeliveredorders(){
                global $db;
                global $mysqli;

                $q = "SELECT * FROM giftshopdb.order where status='delivered' order by dateDelivered desc";
                $result = $mysqli->query($q);
            
                return $result;
        }
        function getpaidorders(){
                global $db;
                global $mysqli;

                $q = "SELECT * FROM giftshopdb.order where status='confirmed' order by dateDelivered desc";
                $result = $mysqli->query($q);
            
                return $result;
        }
        
        function getorder(){
            global $db;
            global $mysqli;

            $id = $_GET['id'];
            $q = "SELECT * FROM giftshopdb.order where id=$id";
            $result = $mysqli->query($q);
            
            return $result;
        }
        
        function deliver(){
            $db = Databasei::getInstance();
            $mysqli = $db->getConnection();

            $date = date('m/d/y h:i:s A');
            $id = $_GET['id'];
            $q = "UPDATE giftshopdb.order set dateDelivered='$date', status='delivered' where id=$id";
            $mysqli->query($q);
            
            return true;
        }
        function paid(){
            global $db;
            global $mysqli;

            $id = $_GET['id'];
            $date = date('m/d/y h:i:s A');
            $q = "UPDATE giftshopdb.order set dateDelivered='$date', status='confirmed' where id=$id";
            $mysqli->query($q);
            
            return true;
        }
        
        function getcategory(){
            global $db;
            global $mysqli;

            $q = "SELECT * from giftshopdb.category order by title asc";
            $result = $mysqli->query($q);
            
            return $result;
        }
        function addcategory($cat){
            global $db;
            global $mysqli;

            $q = "INSERT INTO giftshopdb.category values('','$cat')";
            $mysqli->query($q);
            return true;
        }
        
        function delete(){
            $db = Databasei::getInstance();
            $mysqli = $db->getConnection();;

            $table = $_GET['table'];
            $id = $_GET['id'];            
            $q = "DELETE FROM giftshopdb.category where id = $id";
            $mysqli->query($q);            
            return true;
        }
        
        function getcategorybyid($id){
            global $db;
            global $mysqli;

            $q = "Select * from giftshopdb.category where id=$id";
            $result = $mysqli->query($q);
            if($row = mysqli_fetch_array($result)){
                $category = $row['title'];
            }
            return $category;
        }
        
        function updatecategory($cat,$id){
            global $db;
            global $mysqli;

            $q = "update giftshopdb.category set title='$cat' where id=$id";   
            $mysqli->query($q);
            return true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('session.php'); ?>

  <link rel="stylesheet" href="css/style1.css" type="text/css" media="screen" charset="utf-8">
  <script src="admin.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/application.js" type="text/javascript" charset="utf-8"></script>	
  <!-- pop up -->
  <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="src/facebox.js" type="text/javascript"></script> 
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
      })
    })
  </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gift Shop | Admin</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">       
    
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
					<div class="col-sm-12">
						<div class="logo pull-left">
							<a href="admin.php"><img src="images/home/header.jpg" alt="Gift Shop" class="img-responsive" /></a>
						</div>
		
					</div>
					
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
    