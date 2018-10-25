<div class="form_add_vehicle">
 <?php if (isset($errorMessage)) :?>
   <div class="errorMessage">
     <p><?=$errorMessage ?></p>
   </div>
 <?php endif ?>
 <!-- <?php echo form_open('editvehicle') ?>
   <div class="form-group">
      <label for="year">Year:</label>
      <input name="year" type="number" class="form-control" id="year" value="<?php echo $year ?>">

      <div class="error">
        <small> <?= form_error('year') ?> </small>
      </div>
   </div>

   <div class="form-group">
     <label for="make">Make:</label>
     <input name="make" type="text" class="form-control" id="make" value="<?php echo $make ?>">
     <div class="error">
       <small> <?= form_error('make') ?> </small>
     </div>
   </div>

   <div class="form-group">
     <label for="model">Model:</label>
     <input name="model" type="text" class="form-control" id="model" value="<?php echo $model ?>">
     <div class="error">
       <small> <?= form_error('model') ?> </small>
     </div>
   </div>

   <div class="form-group">
     <label for="engine">Engine:</label>  <i id="engineInfoModal" class="fa fa-info-circle" style="font-size:24px; outline:none;"></i>
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

     <input name="engine" type="text" class="form-control" id="engine" value="<?php echo $engine ?>">
     <div class="error">
       <small> <?= form_error('engine') ?> </small>
     </div>
   </div> -->

<?php echo form_open('editvehicle') ?>
   <legend>Vehicle:</legend>
   <div class="form-group">
     <select id="vehicleYearDropDown" name="vehicleYear" class="custom-select">
       <option value="" selected="">Select Year</option>
       <?php foreach($vehicleYears as $yearSelect) : ?>
         <option value="<?php echo $yearSelect->car_year ?>"><?php echo $yearSelect->car_year ?></option>
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
     <select id="vehicleEngineDropDown" name="vehicleEngine" class="custom-select">
       <option selected="">Select Engine</option>
     </select>

     <div class="error">
       <small> <?= form_error('engine') ?> </small>
     </div>
   </div>

   <div class="form-group">
     <label for="unit">Unit:</label>
     <input name="unit" type="text" class="form-control" id="unit" value="<?php echo $unit ?>">
     <div class="error">
       <small> <?= form_error('unit') ?> </small>
     </div>
   </div>
   <button type="submit" name="submit" class="btn btn-primary" value="save">Save</button>
   <button id="deleteVehicle" type="button" class="btn btn-primary" value="delete">Delete</button>

   <div class="modal fade" id="deleteVehicleModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h2 class="modal-title" id="modalLabel"> Are you sure?</h2>
         </div>
         <div class="modal-body">
           <p>Delete <strong><?php echo $year.' '.$make.' '.$model ?></strong>  </p>
         </div>
         <div class="modal-footer">
           <button  id="noSave" type="button" class="btn btn-default">No</button>
          <button type="submit" name="submit" class="btn btn-primary" value="delete">Delete</button>
         </div>
       </div>
     </div>
   </div>
 </form>
</div>
