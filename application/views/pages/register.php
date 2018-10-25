<?php if(isset($_SESSION['isLoggedIn'])) :?>
  <?php
    // header("Location: base_url()");
    show_404();
   ?>
<?php else :?>
  <?php echo form_open('register','id="registerForm"'); ?>
    <div class="jumbotron">
      <h1 class="display-3">Register</h1>
    </div>
    <div id="GoogleOrFacebook">
      <p>Click <a href="<?php echo base_url() ?>login">here</a>  if you would like to register using Google or Facebook.</p>

    </div>
    <div class="form_register">
      <div id="loginInfo">
        <h3>Log in information</h3><br>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input name="email" type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="eg. johndoe@example.com" value="<?php echo set_value('email'); ?>">
          <div id="email_reg" class="error">
            <small> <?= form_error('email') ?> </small>
          </div>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="Password">
          <div class="error">
            <small id="password_reg"> <?= form_error('password') ?> </small>
          </div>
        </div>
        <div class="collapse" id="passwordCollapse">
          <div class="error">
            <small>Password must contain: <br>
            <ul>
              <li>8-16 characters</li>
              <li>one uppercase</li>
              <li>one lowercase</li>
            </ul></small>
          </div>
         </div>

         <div class="form-group">
           <label for="confirmPassword">Confirm Password</label>
           <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
           <div id="confirmPassword_reg" class="error">
             <small> <?= form_error('confirmPassword') ?> </small>
           </div>
         </div>
         <div class="collapse" id="confirmPasswordCollapse">
           <div class="error">
             <small>Passwords do not match</small>
           </div>
         </div>

         <div class="form-group">
           <label for="securityQuestion">Security Question</label>
           <br>
           <select name="securityQuestion" class="custom-select" id="securityQuestion">
             <option value="What is the first name of the person you first kissed?">What is the first name of the person you first kissed?</option>
             <option value="What is the last name of the teacher who gave you your first failing grade?">What is the last name of the teacher who gave you your first failing grade?</option>
             <option value="What was your childhood nickname?">What was your childhood nickname?</option>
             <option value="What is the middle name of your oldest child?">What is the middle name of your oldest child?</option>
             <option value="What was the name of the hospital where you were born?">What was the name of the hospital where you were born?</option>
             <option value="What was the last name of your third grade teacher?">What was the last name of your third grade teacher?</option>
             <option value="What was the name of the company where you had your first job?">What was the name of the company where you had your first job?</option>
             <option value="In what town was your first job?">In what town was your first job?</option>
           </select>
           <div class="error">
             <small> <?= form_error('securityQuestion') ?> </small>
           </div>
         </div>

         <div class="form-group">
           <label for="securityAnswer">Security Answer</label>
           <input name="securityAnswer" type="text" class="form-control" id="securityAnswer">
           <div id="securityAnswer_reg" class="error">
             <small> <?= form_error('securityAnswer') ?> </small>
           </div>
         </div>
      </div>

      <div id="accountInfo">
        <h3>Account information</h3><br>
        <div class="form-group">
          <label for="name">Full Name:</label>
          <input name="name" type="text" class="form-control" id="name" placeholder="eg. Grant Ward" value="<?php echo set_value('name'); ?>">
          <div id="name_reg"class="error">
            <small> <?= form_error('name') ?> </small>
          </div>
        </div>

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
       <input id="register_button" type="submit" class="btn btn-primary" value="submit"/>
       <!-- <script type="text/javascript">
         $('#$register_button').click(function(){
           fbq('track', 'CompleteRegistration');
         })
       </script> -->
     </div>
    </div>
  </form>

<?php endif ?>
