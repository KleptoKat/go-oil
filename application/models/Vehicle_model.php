<?php

  class vehicle_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }

    public function get_years()
    {
      $query = $this->db->query("SELECT DISTINCT car_year FROM amsoil_com;");

      return $query->result();
    }

    public function get_makes($year)
    {
      $query = $this->db->query("SELECT DISTINCT car_make FROM amsoil_com WHERE car_year = ".$year);
      // $query = $this->db->query("SELECT DISTINCT car_make FROM amsoil_com;");

      return $query->result();
    }

    public function get_models($make, $year)
    {
      $query = $this->db->query("SELECT DISTINCT car_model FROM amsoil_com WHERE car_make = '$make' AND car_year = '$year'");

      return $query->result();
    }

    public function get_engines($make, $model, $year)
    {
      $query = $this->db->query("SELECT DISTINCT SUBSTRING(`car_engine`, 1, 11) AS 'car_engine' FROM amsoil_com WHERE car_make = '$make' AND car_model = '$model' AND car_year = '$year'");

      return $query->result();
    }

    public function get_oil_weight($make, $model, $year, $engine)
    {
      $likeEngine = '%'.$engine.'%';

      $idQuery = $this->db->query("SELECT id FROM amsoil_com WHERE car_make = '$make' AND car_model = '$model' AND car_year = '$year' AND car_engine LIKE '$likeEngine'");

      $vehicleId = $idQuery->row();

      $query = $this->db->query("SELECT SUBSTR(`engine_oil`, (SELECT LOCATE('W-', `engine_oil`) FROM amsoil_com WHERE `id` =".$vehicleId->id.") -2, 6) AS 'weight' FROM `amsoil_com` WHERE `id` =".$vehicleId->id);

      return $query->row();
    }

    public function get_all_oil_weights()
    {
      $query = $this->db->query("SELECT `weight` FROM `oil`");

      return $query->result();
    }

    public function get_oil_types($weight)
    {
      $query = $this->db->query("SELECT `type` FROM `oil` WHERE `weight` ='$weight'");

      return $query->result();
    }

    public function get_oil_capacity($make, $model, $year, $engine)
    {

      $likeEngine = '%'.$engine.'%';

      $idQuery = $this->db->query("SELECT id FROM amsoil_com WHERE car_make = '$make' AND car_model = '$model' AND car_year = '$year' AND car_engine LIKE '$likeEngine'");

      $vehicleId = $idQuery->row();

      if($engine == ' ')
      {
        $engineSizeQuery = $this->db->query("SELECT SUBSTRING(`car_engine`, 1, 3) AS 'capacity' FROM `amsoil_com` WHERE `id` =".$vehicleId->id);

      return  $engineSizeQuery->row();

        // $likeOil = $this->db->query("SELECT ");
      }
      else
      {
        $query = $this->db->query("SELECT SUBSTR(`engine_oil`, (SELECT LOCATE('With filter', `engine_oil`) FROM amsoil_com WHERE `id` =".$vehicleId->id.") + 13, 3) AS 'capacity' FROM `amsoil_com` WHERE `id`=".$vehicleId->id);

        return $query->row();
      }
    }

    public function get_oil_price($type, $weight)
    {
      $query = $this->db->query("SELECT `cost` FROM `oil` WHERE `type` = '$type' AND `weight`= '$weight'");

      return $query->row();
    }

    public function get_priceID($type, $weight)
    {
      $query = $this->db->query("SELECT `priceID` FROM `oil` WHERE `type` = '$type' AND `weight` = '$weight'");

      return $query->row();
    }
  }

?>
