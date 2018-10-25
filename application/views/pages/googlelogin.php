<script>
$(document).ready(function($){
  $("#google_login_redirect").ready(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"
      });
  });
});
</script>
<div class="jumbotron">
  <h1 class="display-3">Login</h1>
</div>
<?php if(isset($GoogleLog) && $GoogleLog == TRUE) :?>
  <?php unset($_SESSION['googleLogin']); ?>
    <?php $_SESSION['google'] = $google; ?>
  <div class="google_login_redirect" id="google_login_redirect">
    <p class="lead">Redirecting, please wait...</p>
    <meta http-equiv="refresh" content="3;url=<?php echo base_url(); ?>"></br>
  </div>
<?php endif ?>
