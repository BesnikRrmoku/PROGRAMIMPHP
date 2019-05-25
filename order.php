<?php include('include/admin/header.php'); ?>
<section>
		<div class="container">
			<div class="row">
                <?php include('include/admin/sidebar.php'); ?>
                <div class="col-sm-9 padding-right">
					<div class="features_items"><!--feature_items-->
						<h2 class="title text-center">Orders</h2>                                            					
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#data1" role="tab" data-toggle="tab">Porosite e paperfunduara</a></li>
  <li><a href="#data2" role="tab" data-toggle="tab">Porosite e derguara</a></li>
  <li><a href="#data3" role="tab" data-toggle="tab">Porostie e perfunduara</a></li>
</ul>



// ne tab panes
 // kemi mundesine qe te shfaqim 3 llojet e porosive
 // derguara
 // pranuara
 // paguara
 
// kur na shfaqen porosite ato e kane nje ID perkatese permes se ciles dhe statusit te porosise
// mund t`i shfqim detajet te cilat shfaqen ne faqen item.php 
 
<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="data1">
        <table class="table table-bordered">
            <thead class="bg-primary">
                <th>Data Porosise</th>
                <th>Klienti</th>
                <th>Detajet</th>
                <th>Statusi</th>
            </thead>
            <?php $unpaid = $obj->getunpaidorders(); ?>
            <?php while($row = mysqli_fetch_array($unpaid)){ ?>
                <tr>
                    <td class="text-center"><?php echo $row['dateOrdered']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td class="text-center"><a href="item.php?id=<?php echo $row['id']?>&&p=unconfirmed" target="_blank"><i class="fa fa-external-link"></i> Shfaq detajet</a></td>
                    <td class="text-center"><a href="order.php?p=deliver&&id=<?php echo $row['id']; ?>" class="btn btn-danger">Dergo</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="tab-pane" id="data2">
        <table class="table table-bordered">
            <thead class="bg-primary">
                <th>Data Dergimit</th>
                <th>Klienti</th>
                <th>Detajet</th>
                <th>Statusi</th>
            </thead>
            <?php $delivered = $obj->getdeliveredorders(); ?>
            <?php while($row = mysqli_fetch_array($delivered)){ ?>
                <tr>
                    <td class="text-center"><?php echo $row['dateDelivered']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td class="text-center"><a href="item.php?id=<?php echo $row['id']?>&&p=delivered" target="_blank"><i class="fa fa-external-link"></i> Shfaq detajet</a></td>
                    <td class="text-center"><a href="order.php?p=paid&&id=<?php echo $row['id']; ?>" class="btn btn-danger">Paguaj</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="tab-pane" id="data3">
        <table class="table table-bordered">
            <thead class="bg-primary">
                <th>Data Pageses</th>
                <th>Klienti</th>
                <th>Detajet</th>
            </thead>
            <?php $paid = $obj->getpaidorders(); ?>
            <?php while($row = mysqli_fetch_array($paid)){ ?>
                <tr>
                    <td class="text-center"><?php echo $row['dateDelivered']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td class="text-center"><a href="item.php?id=<?php echo $row['id']?>" target="_blank"><i class="fa fa-external-link"></i> Shfaq detajet</a></td>                    
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
</section>



<?php include('include/admin/footer.php'); ?>