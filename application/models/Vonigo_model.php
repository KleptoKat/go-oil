<?php
    class vonigo_model extends CI_Model
    {
      public function __construct()
      {
        $this->load->database();
      }

      public function get_security_token()
      {

        // return call_method(get($Vonigo, "Security"), "getToken");
      }
    }
 ?>
