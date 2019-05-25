<?php include('include/home/header.php'); ?>
	 
	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Kontakti</h2>    			    				    				
					
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Abonohu</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" action="sendmail/send.php" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control frm-hover" required placeholder="Emri dhe mbiemri">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control frm-hover" required placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control frm-hover" required placeholder="Titulli">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required class="form-control frm-hover" rows="8" placeholder="Mesazhi"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right btn-send" value="Dergo">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Gift Shop Info</h2>
	    				<address>
	    					<p>Gift Shop 24h mbeshtetje online .</p>
							<p>Mobile: +37744810661</p>
							<p>Fax: +37744810661</p>
							<p>Email: giftshop@gmail.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Na ndiqni ne</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook social-hover"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter social-hover"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus social-hover"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube social-hover"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
	
<?php include('include/home/footer.php'); ?>