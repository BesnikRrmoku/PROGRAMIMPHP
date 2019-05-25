<?php include('include/home/header.php'); ?>	

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form--> 
						<div class="error"></div>
						<h2>Hapesira per Administratoret e Gift Shop</h2>
						  <form>
                            <input type="text" name="username" placeholder="Useri" id="username" required/>
                            <input type="password" name="password" placeholder="Paswordi" id="password" required/>
                            <button  type="button" name="submit" class="btn btn-danger" id="login">Kycu</button>
                        </form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form--> 
    
<?php include('include/home/footer.php'); ?>
