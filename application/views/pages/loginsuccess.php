<?php
  $_SESSION["isLoggedIn"] = TRUE;
?>
<?php if(isset($bool) && $bool == TRUE) :?>
  <?php
    $_SESSION["isLoggedIn"] = FALSE;
    $_SESSION["googleLogin"] = TRUE;
  ?>
  <script>
      var googleLogin = true
      var redirectURL = "/";

      function submitForm() {
          var InputData = {
              firstName: "<?php echo $_SESSION['googleFirstName'] ?>",
              lastName: "<?php echo $_SESSION['googleFamilyName'] ?>",
              phoneNo: "<?php echo $phoneNumber ?>",
              email: "<?php echo $_SESSION['googleEmail'] ?>",
              province: "<?php echo $province ?>",
              city: "<?php echo $city ?>",
              postalCode: "<?php echo $postalCode ?>",
              streetAddress: "",
          }
          Vonigo.init(InputData)
      }

      window.onload = function(){

        submitForm();
      }

      // TODO GET VONIGO SHIT AFTER FIRST USER LOGS IN WITH GOOGLE FOR THE FIRST TIME

  </script>
<?php elseif(isset($boolFacebook) && $boolFacebook == TRUE) :?>
  <?php
    $_SESSION["isLoggedIn"] = FALSE;
    $_SESSION["facebookLogin"] = TRUE;
  ?>
  <script>
      var googleLogin = true
      var redirectURL = "/";

      function submitForm() {
          var InputData = {
              firstName: "<?php echo $_SESSION['facebookFirstName'] ?>",
              lastName: "<?php echo $_SESSION['facebookLastName'] ?>",
              phoneNo: "<?php echo $phoneNumber ?>",
              email: "<?php echo $_SESSION['facebookEmail'] ?>",
              province: "<?php echo $province ?>",
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
<?php else :?>
  <meta http-equiv="refresh" content="1;url=<?php echo base_url(); ?>booking"></br>
<?php endif ?>

<!-- <div class="loading">
  <p class="lead">Logging in...</p>
  <div class="progress">
    <div id="progressLoad" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
  </div>
</div> -->
