<?php if(isset($_SESSION['email'])) :?>
  <?php session_destroy(); ?>
  <div class="password_change">
    <meta http-equiv="refresh" content="2;url=<?php echo base_url(); ?>login">
    <p class="lead">Password change successful! You may now log in.</p>
  </div>
<?php elseif(isset($_SESSION['userEmail'])) :?>
  <div class="password_change">
    <meta http-equiv="refresh" content="2;url=<?php echo base_url(); ?>account">
    <p class="lead">Password change successful!</p>
  </div>
<?php endif ?>
