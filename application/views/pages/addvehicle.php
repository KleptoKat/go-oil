<?php if(isset($_SESSION['isLoggedIn'])) :?>
  <div class="form_add_vehicle">
   <?php if (isset($errorMessage)) :?>
     <div class="errorMessage">
       <p><?=$errorMessage ?></p>
     </div>
   <?php endif ?>
   <?php echo form_open('addvehicle', 'class="add_vehicle"') ?>

     <legend>Vehicle:</legend>
     <div class="form-group">
       <select id="vehicleYearDropDown" name="vehicleYear" class="custom-select">
         <option value="" selected="">Select Year</option>
         <?php foreach($vehicleYears as $year) : ?>
           <option value="<?php echo $year->car_year ?>"><?php echo $year->car_year ?></option>
         <?php endforeach ?>
       </select>
       <div class="error">
         <small> <?= form_error('year') ?> </small>
       </div>
     </div>
     <div class="form-group">
       <select id="vehicleMakeDropDown" name="vehicleMake" class="custom-select">
         <option selected="">Select Make</option>
       </select>
       <div class="error">
         <small> <?= form_error('make') ?> </small>
       </div>
     </div>
     <div class="form-group">
       <select id="vehicleModelDropDown" name="vehicleModel" class="custom-select">
         <option selected="">Select Model</option>
       </select>
       <div class="error">
         <small> <?= form_error('model') ?> </small>
       </div>
     </div>
     <div class="form-group">
       <i id="engineInfoModal" class="fa fa-info-circle" style="font-size:24px; outline:none;"></i>
       
       <select id="vehicleEngineDropDown" name="vehicleEngine" class="custom-select">
         <option selected="">Select Engine</option>
       </select>
       <div class="error">
         <small> <?= form_error('engine') ?> </small>
       </div>
     </div>

     <div class="form-group">
       <label for="unit">Unit:</label>
       <input name="unit" type="text" class="form-control" id="unit">
       <div class="error">
         <small> <?= form_error('unit') ?> </small>
       </div>
     </div>
     <input name="addvehicle" type="submit" class="btn btn-primary" value="Confirm"/>
   </form>
  </div>

  <div class="modal animated fade" id="engineModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="modalLabel">Don't know your engine type?</h2>
        </div>
        <div class="modal-body">
          <ol>
            <li>Look in your owner's manual.</li><br>
            <li>Check your vehicle's registration documents.</li><br>
            <li>Find the decal/sticker on the underside of your vehicle's hood.</li><br>
            <li>Select the "I don't know" option.</li>
          </ol>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<?php else :?>
  <?php show_404() ;?>
<?php endif ?>
