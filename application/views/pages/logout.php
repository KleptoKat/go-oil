<?php if(isset($_SESSION['isLoggedIn'])) :?>
  <?php
    session_destroy();
  ?>
  <script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      // console.log('User signed out.');
    });
  }

  window.onload = function(){

    signOut();
  }
</script>

  <meta http-equiv="refresh" content="0.25;url=<?php echo base_url(); ?>"></br>
<?php else : ?>

  <?php show_404(); ?>
<?php endif ?>
