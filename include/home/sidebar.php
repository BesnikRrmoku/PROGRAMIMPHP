<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Kategorite</h2>
                    <!-- kategorite -->
                    <div class="list-group">
                        
                        <?php
                            $db = Databasei::getInstance();
                            $mysqli = $db->getConnection(); 

                            $q = "Select * from category order by title";
                            $r = $mysqli->query($q);

                            $categories = array();

                            
                            // mirren kategorite nga databaza.
                            if($r){
                                while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){                                    
                                    $categories[$row["id"]] = $row["title"];                                   
                                }

                                arsort($categories);

                            }
                            
                            //produktet shfaqen ne kete pjese
                            foreach ($categories as $cat) {
                                // echo $cat . "<br />";

                                echo '<a href="category.php?filter='.$cat.'" class="list-group-item">'.$cat.'</a>';
                            }
                        ?>                      
                    </div> 
                    <!--/category-products-->
                </div>
            </div>
            