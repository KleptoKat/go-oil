<div class="jumbotron">
  <h1 class="display-3">Service Booking</h1>
</div>

<?php echo form_open('continuetobook') ?>
<div id="continueForm">
  <h1>Continue to book for <strong> <?php echo $_SESSION['continueToBookVehicle'] ?>? </strong></h1>
  <h2>Subtotal: $199.00</h2>
  <div id="continueFormButtons">
    <input class="btn btn-primary" type="button" name="yes" value="Yes">
    <input class="btn btn-primary" type="button" name="no" value="No">
  </div>
</div>

</form>
