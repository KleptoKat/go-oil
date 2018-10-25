<?php if(isset($_SESSION['isLoggedIn'])) :?>
  <meta http-equiv="refresh" content="0.75;url=<?php echo base_url(); ?>"></br>

  <div class="loading">
    <p class="lead">Logging in...</p>
    <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
    </div>
  </div>
<?php elseif(isset($inComplete) && ($inComplete) == TRUE ) :?>
  <div class="jumbotron">
    <h1 class="display-3">Login</h1>
  </div>
<?php echo form_open('login') ?>
  <div class="form_login">
    <p>Enter your City, Postal Code and Phone Number to complete the registation.</p>

    <div class="form-group">
      <label for="city">City:</label>
      <input name="city" type="text" class="form-control" id="city" placeholder="eg. Winnipeg" value="<?php echo set_value('city'); ?>">
      <div id="city_reg" class="error">
        <small> <?= form_error('city') ?> </small>
      </div>
    </div>

    <div class="form-group">
      <label for="postalCode">Postal Code:</label>
      <input name="postalCode" type="text" class="form-control" id="postalCode" placeholder="eg. R3Z 9D2" value="<?php echo set_value('postalCode'); ?>">
      <div id="postal_reg" class="error">
        <small> <?= form_error('postalCode') ?> </small>
      </div>
    </div>

    <div class="form-group">
      <label for="phoneNumber">Phone Number:</label>
      <input name="phoneNumber" type="tel" class="form-control" id="phoneNumber" placeholder="eg. 2041234567" value="<?php echo set_value('phoneNumber'); ?>">
      <div id="phone_reg" class="error">
        <small> <?= form_error('phoneNumber') ?> </small>
      </div>
    </div>
    <input id="login_button" type="submit" name="login2" class="btn btn-primary" value="Continue with Google"/><br>
    <a href="<?php echo base_url().'login/logout'; ?>">Back</a>

  </div>
</form>
<?php elseif(isset($inCompleteFacebook) && ($inCompleteFacebook) == TRUE) :?>
  <div class="jumbotron">
    <h1 class="display-3">Login</h1>
  </div>
<?php echo form_open('login/facebook') ?>
  <div class="form_login">
    <p>Enter your City, Postal Code and Phone Number to complete the registation.</p>
    <div class="form-group">
      <label for="city">City:</label>
      <input name="city" type="text" class="form-control" id="city" placeholder="eg. Winnipeg" value="<?php echo set_value('city'); ?>">
      <div id="city_reg" class="error">
        <small> <?= form_error('city') ?> </small>
      </div>
    </div>

    <div class="form-group">
      <label for="postalCode">Postal Code:</label>
      <input name="postalCode" type="text" class="form-control" id="postalCode" placeholder="eg. R3Z 9D2" value="<?php echo set_value('postalCode'); ?>">
      <div id="postal_reg" class="error">
        <small> <?= form_error('postalCode') ?> </small>
      </div>
    </div>

    <div class="form-group">
      <label for="phoneNumber">Phone Number:</label>
      <input name="phoneNumber" type="tel" class="form-control" id="phoneNumber" placeholder="eg. 2041234567" value="<?php echo set_value('phoneNumber'); ?>">
      <div id="phone_reg" class="error">
        <small> <?= form_error('phoneNumber') ?> </small>
      </div>
    </div>
    <input id="login_button" type="submit" name="login2" class="btn btn-primary" value="Continue with Facebook"/><br>
    <a href="<?php echo base_url().'login/logout'; ?>">Back</a>
  </div>
</form>
<?php else : ?>
  <div class="jumbotron">
    <h1 class="display-3">Login</h1>
  </div>

  <?php echo form_open('login'); ?>
    <div class="form_login">
      <?php if (isset($errorMessage)) :?>
        <div class="errorMessage">
          <p><?=$errorMessage ?></p>
        </div>
      <?php endif ?>
      <div class="form-group">
        <i class="fa fa-user"></i>
        <label for="loginEmail">Email Address</label>
        <input name="loginEmail" type="text" class="form-control" id="loginEmail" aria-describedby="emailHelp" value="<?php echo set_value('loginEmail'); ?>">
      </div>

      <div class="form-group">
        <i class="fa fa-lock"></i>
        <label for="loginPassword">Password</label>
        <input name="loginPassword" type="password" class="form-control" id="loginPassword">
        <small class="register_link"><a href="<?php echo base_url(); ?>register">Register</a></small>
        <small class="forgotpassword_link"><a href="<?php echo base_url();?>forgotpassword">Forgot your password?<a></small>
      </div>
      <input id="login_button" type="submit" name="login" class="btn btn-primary" value="Login"/><br>
      <!-- <div id="my-signin2"></div> -->
      <a href="<?php echo $loginURL; ?>"><img style="width:300px;" src="<?php echo base_url().'assets/img/glogin.png'; ?>" /></a><br>
      <a href="<?php echo $authURL; ?>"><img style="width:300px;" src="<?php echo base_url().'assets/img/flogin.png' ?>"/></a>
    </div>
  </form>
<?php endif ?>
