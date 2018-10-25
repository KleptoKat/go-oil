<?php echo form_open('forgotpassword'); ?>
  <div class="jumbotron">
    <h1 class="display-3">Email</h1>
  </div>
  <div class="form_forgot">
    <?php if (isset($errorMessage)) :?>
      <div class="errorMessage">
        <p><?=$errorMessage ?></p>
      </div>
    <?php endif ?>
    <div class="form-group">
      <label for="loginEmail">Enter the email address associated with the account.</label>
      <input name="loginEmail" type="email" class="form-control" id="forgotEmail" aria-describedby="emailHelp">
    </div>
    <div class="button-group">
       <input type="submit" name="continue" class="btn btn-primary" id="forgotSubmit" value="Continue..."/>
    </div>
  </div>
</form>
