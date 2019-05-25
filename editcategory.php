<?php include('include/admin/header.php'); ?>
<?php
    $categoryvalue = '';
    $categoryID = isset($_GET['id']) ? $_GET['id'] : null;
    if(isset($_POST['editcategory'])){
        $category = $_POST['category']; 
        $id = $_GET['id'];
        $obj->updatecategory($category,$id);
    }

     if(isset($_GET['id'])){
        $id = $_GET['id'];
        $categoryvalue = $obj->getcategorybyid($id);
    }
?>
<section>
		<div class="container">
			<div class="row">
                <?php include('include/admin/sidebar.php'); ?>
                <div class="col-sm-9 padding-right">
					<div class="features_items"><!--feature_items-->
						<h2 class="title text-center">Kategorite</h2>                      
                        <form method="POST" action="editcategory.php?id=<?php echo $categoryID;?>">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">Emri Kategorise:</div>
                                    <input name="category" value="<?php echo $categoryvalue; ?>" class="form-control" type="text" placeholder="emri kategorise">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn" name="editcategory">Perditeso</button>
                                <a href="admincategory.php" class="btn btn-success">Shto Kategori</a>
                            </div>
                        </form>
                       <hr />
                        <table class="table table-bordered">
                            <thead class="bg-primary">
                                <th>Emri</th>
                                <th colspan="2">Edito</th>
                            </thead>
                            <tbody>
                            
                        <?php $category = $obj->getcategory();?>
                        <?php while($row = mysqli_fetch_array($category)):?>
                            <tr>
                                <td><?php echo $row['title'];?></td>    
                                <td><a href="editcategory.php?p=edit&&id=<?php echo $row['id']; ?>"><i class="fa fa-edit fa-lg text-success"></i><small>Edito</small></a></td>    
                                <td><a href="admincategory.php?p=delete&&table=category&&id=<?php echo $row['id']; ?>" class="confirm"><i class="fa fa-times-circle fa-lg text-danger"></i> <small>Fshij</small></a></td>    
                            </tr>
                        <?php endwhile; ?>
                            </tbody>
                        </table>

              </section>



<?php include('include/admin/footer.php'); ?>