<script>
    fbq('track', 'CompleteRegistration');
</script>
<?php if(isset($bool) && $bool == TRUE) :?>
  <script>
      function submitForm() {
          var InputData = {
              firstName: "<?php echo $firstName ?>",
              lastName: "<?php echo $lastName ?>",
              phoneNo: "<?php echo $phoneNumber ?>",
              email: "<?php echo $email ?>",
              province: "MB",
              city: "<?php echo $city ?>",
              postalCode: "<?php echo $postalCode ?>",
              streetAddress: "",
          }
          Vonigo.init(InputData)
      }

      window.onload = function(){
        submitForm();
      }
  </script>

  <div class="register_success">
    <p class="lead">Registration Succesful! Please check your email to activate your account.</p>
  </div>
<?php else : ?>
  <?php show_404() ?>
<?php endif ?>
