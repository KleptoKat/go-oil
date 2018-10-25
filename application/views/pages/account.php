<?php if(isset($_SESSION['isLoggedIn'])) :?>
  <div class="jumbotron">
    <h1 class="display-3">Account</h1>
  </div>
  <?php echo form_open('account', 'class="account"'); ?>
   <div class="form_account">
     <div class="person_info">
       <div class="form-group">
         <label for="name">Name:</label>
         <div class="input_icon">
           <input name="name" type="text" class="form-control" id="name" value="<?php echo $name ?>" readOnly>
              <i tabindex="0" id="edit_name" class="fa fa-edit" style="font-size:24px; outline:none;"></i>
         </div>
         <div class="error">
           <small> <?= form_error('name') ?> </small>
         </div>
         <div class="collapse" id="fieldRequired0">
           <div class="error">
             <small>This field is required.</small>
           </div>
         </div>
       </div>

       <div class="form-group">
         <label for="city">City:</label>
         <div class="input_icon">
           <input name="city" type="text" class="form-control" id="city" value="<?php echo $city ?>" readOnly>
              <i tabindex="0" id="edit_city" class="fa fa-edit" style="font-size:24px; outline:none;"></i>
         </div>

         <div class="error">
           <small> <?= form_error('city') ?> </small>
         </div>
         <div class="collapse" id="fieldRequired1">
           <div class="error">
             <small>This field is required.</small>
           </div>
         </div>
       </div>

       <div class="form-group">
         <label for="postalCode">Postal Code:</label>
         <div class="input_icon">
           <input name="postalCode" type="text" class="form-control" id="postalCode" value="<?php echo $postalCode ?>" readOnly>
              <i tabindex="0" id="edit_postalCode" class="fa fa-edit" style="font-size:24px; outline:none;"></i>
         </div>
         <div class="error">
           <small> <?= form_error('postalCode') ?> </small>
         </div>
         <div class="collapse" id="fieldRequired2">
           <div class="error">
             <small>This field is required.</small>
           </div>
         </div>
       </div>

       <div class="form-group">
         <label for="phoneNumber">Phone Number:</label>
         <div class="input_icon">
           <input name="phoneNumber" type="tel" class="form-control" id="phoneNumber" value="<?php echo $phoneNumber ?>" readOnly>
             <i tabindex="0" id="edit_phoneNumber" class="fa fa-edit" style="font-size:24px; outline:none;"></i>
         </div>
         <div class="error">
           <small> <?= form_error('phoneNumber') ?> </small>
         </div>
         <div class="collapse" id="fieldRequired3">
           <div class="error">
             <small>This field is required.</small>
           </div>
         </div>
       </div>
       <?php if(isset($_SESSION['isLoggedInGoogleFacebook']) && $_SESSION['isLoggedInGoogleFacebook'] == TRUE) :?>
     <?php else :?>
       <a id="changepassword_button" class="btn btn-primary" href="changepassword">Change Password</a>
     <?php endif ?>
     </div>

     <div class="vehicle_info">
       <div class="form-group" id="form-group-vehicle">
         <table class="vehicle_account">
           <label for="vehicle">Vehicle:</label>
           <thead>
             <th class="colYear">Year</th>
             <th class="colMake">Make</th>
             <th class="colModel">Model</th>
           </thead>
           <tbody>
             <?php foreach($vehicles['result'] as $row) :?>
               <?php echo form_open('account') ?>
               <tr>
                 <input type="hidden" name="vehicleId" value="<?php echo $row->id ?>">
                 <td><?php echo $row->year; ?></td>
                 <td><?php echo $row->make; ?></td>
                 <td><?php echo $row->model; ?></td>
                 <!-- <td><button id="deleteVehicle_<?php echo $row->id ?>" type="button"  value="delete">Delete</button></td> -->
                 <td><i id="deleteVehicle_<?php echo $row->id ?>" class="fa fa-close" style="font-size:24px"></i></td>
               </tr>
               <div class="modal fade" id="deleteVehicleModal_<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h2 class="modal-title" id="modalLabel"> Are you sure?</h2>
                     </div>
                     <div class="modal-body">
                       <p>Delete <strong><?php echo $row->year.' '.$row->make.' '.$row->model ?></strong>  </p>
                     </div>
                     <div class="modal-footer">
                       <button  id="noSave_<?php echo $row->id ?>" type="button" class="btn btn-default">No</button>
                       <input id="modalDeleteButton" style="height: 35px;" name="delete" type="submit" class="btn btn-primary" value="Delete">
                     </div>
                   </div>
                 </div>
               </div>
             </form>
             <?php endforeach ?>
           </tbody>
         </table>
       </div>

      <button id="addvehicle_button" class="btn btn-primary" type="button" name="button">Add Vehicle</button>

       <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h2 class="modal-title" id="modalLabel">Confirm Changes?</h2>
             </div>
             <div class="modal-footer">
               <button  id="noSave" type="button" class="btn btn-default">No</button>
               <input id="confSave" name="save" type="submit" class="btn btn-primary" value="Yes">
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
  </form>

  <div class="modal animated fade" id="addVehicleModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="modalLabel">Add Vehicle</h2>
        </div>
        <div class="modal-body" id="addVehicleContent">
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
                 <select style="width: 269px;" id="vehicleEngineDropDown" name="vehicleEngine" class="custom-select">
                   <option selected="">Select Engine</option>
                 </select>
                 <i id="engineInfoModal" class="fa fa-info-circle" style="font-size:24px; outline:none;"></i>

                 <div class="error">
                   <small> <?= form_error('engine') ?> </small>
                 </div>
               </div>

               <div class="form-group">
                 <input id="vehicleUnit" type="text" name="unit" placeholder="Unit Number" class="custom-select">
                    <i id="vehicleUnitInfoModal" class="fa fa-info-circle" style="font-size:24px; outline:none;"></i>
                    <div class="error">
                      <small> <?= form_error('unit') ?> </small>
                    </div>
               </div>

               <div class="form-group">
                 <input id="vehicleKilometers" type="number" name="kilometers" placeholder="Kilometers" class="custom-select">
                    <div class="error">
                      <small> <?= form_error('kilometers') ?> </small>
                    </div>
               </div>

               <div id="oilInfo">

               </div>

               <input id="confirm_addVehicle" name="addvehicleAccount" type="submit" class="btn btn-primary" value="Confirm"/>
             </form>
            </div>
          <?php else :?>
            <?php show_404() ;?>
          <?php endif ?>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
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

  <div class="modal animated fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="modalLabel">Unit Number?</h2>
        </div>
        <div class="modal-body">
          <p>If you have more than one of the same vehicle.</p>
          <p>For example, enter '02' if this is the second vehicle of the same kind. '03' for the third etc.</p>
          <p>Leave blank if no other same vehicles</p>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<?php else :?>
  <?php show_404() ?>
<?php endif ?>
