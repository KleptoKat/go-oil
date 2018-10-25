<?php

  class Ajax extends CI_Controller
  {
    public function __construct()
    {
      parent::__construct();
    }

    index()
    {
      public function token_receiver()
      {
        $token = $_POST['tok'];

        echo $token;
      }
    }

  }
?>
