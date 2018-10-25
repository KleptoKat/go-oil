<?php

  class service_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }

    public function get_all_services()
    {
      $query = $this->db->query("SELECT * FROM `service`");

      return $query->result();
    }

    public function get_service_price($name)
    {
      $query = $this->db->query("SELECT `cost`, `service` FROM `service` WHERE `name` ='$name'");

      return $query->row();
    }

    public function get_service_priceID($name)
    {
      $query = $this->db->query("SELECT `priceID` FROM `service` WHERE `name` ='$name'");

      return $query->row();
    }

    public function get_price_per($name)
    {
      $query = $this->db->query("SELECT `pricePer`, `service` FROM `service` WHERE `name` ='$name'");

      return $query->row();
    }
  }
 ?>
