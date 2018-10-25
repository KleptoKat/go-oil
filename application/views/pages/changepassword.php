<div class="form_change_password">
 <?php if (isset($errorMessage)) :?>
   <div class="errorMessage">
     <p><?=$errorMessage ?></p>
   </div>
 <?php endif ?>
 <?php echo form_open('changepassword') ?>
   <?php if(isset($_SESSION['userEmail'])) :?>
     <div class="form-group">
        <label for="currentPassword">Current Password:</label>
        <input name="currentPassword" type="password" class="form-control" id="currentPassword">
        <div class="error">
          <small> <?= form_error('currentPassword') ?> </small>
        </div>
     </div>
   <?php endif ?>
   <div class="form-group">
     <label for="newPassword">New Password:</label>
     <input name="newPassword" type="password" class="form-control" id="newPassword">
     <div class="error">
       <small> <?= form_error('newPassword') ?> </small>
     </div>
   </div>

   <div class="form-group">
     <label for="confirmNewPassword">Confirm Password:</label>
     <input name="confirmNewPassword" type="password" class="form-control" id="confirmNewPassword">
     <div class="error">
       <small> <?= form_error('confirmNewPassword') ?> </small>
     </div>
   </div>
   <input id="confirmChange" type="button" class="btn btn-primary" value="Confirm Change"/>

   <div class="modal fade" id="youSureModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h2 class="modal-title" id="modalLabel">Change password?</h2>
         </div>
         <div class="modal-footer">
           <button  id="noSave" type="button" class="btn btn-default">No</button>
           <input name="save" type="submit" class="btn btn-primary" value="Yes">
         </div>
       </div>
     </div>
   </div>

 </form>
</div>
