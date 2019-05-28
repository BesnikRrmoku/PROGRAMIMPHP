<!-- Modal -->
<div class="modal fade" id="checkout_modal" role="dialog">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Mbyll</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-shopping-cart text-success fa-lg"></i> Porosia<small class='text-primary'> Te dhenat e porosise</small></h4>
      </div>
      <div class="modal-body">
        <form action="cart/data.php?q=checkout" method="POST">
            <div class="form-group">
                <label>Emri</label>
                <input type="text" name="fname" class="form-control" placeholder="(Emri)" required>
            </div>
            <div class="form-group">
                <label>Mbiemri</label>
                <input type="text" name="lname" class="form-control" placeholder="(Mbiemri)" required>
            </div>
            <div class="form-group">
                <label>Telefoni</label>
                <input type="text" name="contact" class="form-control" placeholder="(Telefoni)" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="(Email)" class="form-control">
            </div>
            <div class="form-group">
                <label>Adresa</label>
                <input type="text" name="address" class="form-control" placeholder="(Adresa)" required>
            </div>
            <div class="alert alert-info">
                Menyra e pageses: <strong>Paguaj pas pranimit</strong>
            </div>
            <div class="alert alert-warning">
                *** Prisni per thirrjen ose emailin tone per konfirmim. Faleminderit! ***
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
        <button type="submit" class="btn btn-success">Porosit</button>
          </form>
      </div>
    </div>
  </div>
</div>