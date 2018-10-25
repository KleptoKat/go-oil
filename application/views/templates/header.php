<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-101077416-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-101077416-1');
</script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Oil Change | Winnipeg | Go Oil Canada</title>

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url().'/assets/vendor/bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'/assets/vendor/font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url().'/assets/vendor/magnific-popup/magnific-popup.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'/assets/css/creative.min.css'; ?>" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/gStyle.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="336018181001-mgvnkdo0tf9k95ic9e1volelnn75kmq2.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>

    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;

      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window,document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
       fbq('init', '1724110397881458');
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1"
      src="https://www.facebook.com/tr?id=1724110397881458&ev=PageView
      &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?php echo base_url(); ?>"><img style="width: 110px; height: 40px" src="<?php echo base_url() ?>/assets/img/gooil.png" alt="#"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <?php
            $homePage = "/";
            $currentPage = $_SERVER['REQUEST_URI'];

           if($homePage == $currentPage) :?>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item" data-toggle="collapse" data-target="#navbarResponsive">
                <a class="nav-link js-scroll-trigger" href="#about" >About</a>
              </li>
              <li class="nav-item" data-toggle="collapse" data-target="#navbarResponsive">
                <a class="nav-link js-scroll-trigger" href="#services">Services</a>
              </li>
              <li class="nav-item" data-toggle="collapse" data-target="#navbarResponsive">
                <a class="nav-link js-scroll-trigger" href="<?php echo base_url() ?>quoting">Pricing</a>
              </li>
              <li class="nav-item" data-toggle="collapse" data-target="#navbarResponsive">
                <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
              </li>
              <li class="nav-item" data-toggle="collapse" data-target="#navbarResponsive">
                <a class="nav-link js-scroll-trigger" href="#review">Reviews</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>fleet">Fleet</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>franchise">Franchise</a>
              </li>
          <?php else :?>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>#about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>#services">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>#pricing">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>#contact">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>#review">Reviews</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>fleet">Fleet</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>franchise">Franchise</a>
              </li>
          <?php endif ?>
          <?php if(isset($_SESSION["isLoggedIn"])) :?>

            <li class="nav-item">
              <a id="nav_book" class="nav-link" href="<?php echo base_url(); ?>booking">Book</a>
            </li>
          <div class="btn-group">
            <a id="user_profile" style="width:150px; overflow:hidden;" class="btn btn-primary"  href="<?php echo base_url(); ?>account"><i id="account_icon" class="fa fa-user"></i>Hi, <?= $firstname ?></a>
            <div class="btn-group">
              <button id="navButtonBoy" type="button" class="btn btn-primary dropdown-toggle"></button>
              <div id="myDropdown" class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo base_url(); ?>account">Account</a>
                <a id="bookingHistoryButton" class="dropdown-item" href="<?php echo base_url(); ?>history">Booking History</a>
                <a id="logoutButton"class="dropdown-item" href="<?php echo base_url(); ?>logout">Logout</a>
            </div>
          <?php else :?>
            <li class="nav-item">
              <a id="nav_register" class="nav-link" href="<?php echo base_url(); ?>register">Register</a>
            </li>
            <?php if(isset($_SESSION['inComplete']) && $_SESSION['inComplete'] == TRUE) :?>
              <li class="nav-item">
                <a id="nav_login" class="nav-link" href="<?php echo base_url().'login/logout'; ?>">Login</a>
              </li>
            <?php else :?>
            <li class="nav-item">
              <a id="nav_login" class="nav-link" href="<?php echo base_url(); ?>login">Login</a>
            </li>
          <?php endif ?>
          <?php endif ?>
            </ul>
      </div>
    </nav>
    <div id="container">
