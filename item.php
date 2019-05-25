<?php include('include/admin/header.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <?php include('include/admin/sidebar.php'); ?>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--feature_items-->



                    // kur hina ne kete faqe atehere ne baze te parametrit te porosise
                    // dhe ne baze te id se porosise behet kerkimi per ate porosi ne databaze
                    // kerkimi behet permes funksionit getorder() te kalses Admin() qe gjendet ne faqen header.php
                    // pasi mirret produkti nga db shfaqet ne faqe ne forme tabele.
                    <?php $item = $obj->getorder(); ?>
                    <?php while ($row = mysqli_fetch_array($item)): ?>
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">DETAJET E POROSISE</h3>

                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <td class="text-right"><strong>Klienti :</strong></td>
                                            <td class="text-info"><strong><?php echo $row['name']; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>Telefoni :</strong></td>
                                            <td class="text-info"><strong><?php echo $row['contact']; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>Adresa :</strong></td>
                                            <td class="text-info"><strong><?php echo $row['address']; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>Email :</strong></td>
                                            <td class="text-info"><strong><?php echo $row['email']; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>Data Porosise :</strong></td>
                                            <td class="text-info"><strong><?php echo $row['dateOrdered']; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>Totali :</strong></td>
                                            <td class="text-danger"><strong><?php echo $row['amount']; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>Produktet :</strong></td>
                                            <td class="text-primary"><strong><?php echo $row['item']; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <?php if ($p == 'unconfirmed') { ?>
                                                <td class="text-right" colspan="2"><a href="order.php?p=deliver&&id=<?php echo $row['id']; ?>" class="btn btn-danger">Dergo</a></td>
                                            <?php } else if ($p == 'delivered') { ?>
                                                <td class="text-right" colspan="2"><a href="order.php?p=paid&&id=<?php echo $row['id']; ?>" class="btn btn-danger">Paguaj</a></td>
                                            <?php } ?>

                                        </tr>
                                    </table>
                                </div>
                            </div>

                        <?php endwhile; ?>
                        </section>



                        <?php include('include/admin/footer.php'); ?>