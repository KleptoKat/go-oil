<?php
    require 'vendor/autoload.php';
    use Mailgun\Mailgun;

  class Quoting extends CI_Controller
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('vehicle_model');
      $this->load->model('service_model');
      $this->load->helper('url');
      $this->load->helper('security');
      $this->load->helper('form');
      $this->load->database();
      $this->load->library('form_validation');
    }

    public function _show_page($page, $data = NULL)
    {
      if(isset($_SESSION['userEmail']))
      {
        $result = $this->user_model->get_firstname();
        $data['firstname'] = $result->firstname;
        $this->load->view('templates/header', $data);
      }
      else
      {
        $this->load->view('templates/header');
      }

      if($data != NULL)
      {
        $this->load->view('pages/'.$page, $data);
      }
      else
      {
        $this->load->view('pages/'.$page);
      }

      $this->load->view('templates/footer');
    }

    public function _check_year()
    {
      if($this->input->post('vehicleYear') == '')
      {
        $this->form_validation->set_message('_check_year', 'Please select a year.');
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }

    public function _check_make()
    {
      if($this->input->post('vehicleMake') == '')
      {
        $this->form_validation->set_message('_check_make', 'Please select a make.');
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }

    public function _check_model()
    {
      if($this->input->post('vehicleModel') == '')
      {
        $this->form_validation->set_message('_check_model', 'Please select a model.');
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }

    public function _check_engine()
    {
      if($this->input->post('vehicleEngine') == '')
      {
        $this->form_validation->set_message('_check_Engine', 'Please select an engine.');
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }

    public function servicequoting()
    {
        unset($_SESSION['vehicleId']);

        $this->load->helper('form');
        $this->load->library('form_validation');

        $formSubmit = $this->input->post('step');

          if($formSubmit == 'stepOne' || $formSubmit == 'previousThree')
          {
            if($this->input->post('vehicleType') == 'car_light_truck' || $formSubmit == 'previousThree')
            {
              $_SESSION['serviceTypeID'] = 11;
              $_SESSION['clientTypeID'] = 1;
              $_SESSION['assetID'] = 1;
              $data['vehicleYears'] = $this->vehicle_model->get_years();

              $data['serviceStep'] = 2;

              $this->_show_page('servicequoting', $data);
            }
          }
          else if($formSubmit == 'stepTwo')
          {
            $this->form_validation->set_rules('year', 'Year', 'callback__check_year');
            $this->form_validation->set_rules('make', 'Make', 'callback__check_make');
            $this->form_validation->set_rules('model', 'Model', 'callback__check_model');
            $this->form_validation->set_rules('engine', 'Engine', 'callback__check_Engine');


            $this->form_validation->set_rules('terms', 'Terms', 'required', array('required' => 'You must agree to our terms of service.'));

            if($this->form_validation->run() === FALSE )
            {
              $data['serviceStep'] = 2;

              $data['vehicleYears'] = $this->vehicle_model->get_years();

              $this->_show_page('servicequoting', $data);
            }
            else
            {
              $year = $this->input->post('vehicleYear');
              $make = $this->input->post('vehicleMake');
              $model = $this->input->post('vehicleModel');
              $engine = $this->input->post('vehicleEngine');

              $data['vehicle'] = $year. ' ' .$make. ' ' .$model;


              $_SESSION['oil_weight'] = $this->input->post('oil_weight');
              $_SESSION['oil_capacity'] = $this->input->post('oil_capacity');

              $data['serviceStep'] = 3;

              $data['bool'] = TRUE;

              if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == TRUE)
              {
                $this->user_model->book_add_vehicle();
              }
              else
              {
                $_SESSION['continueToBook'] =  TRUE;
                $_SESSION['continueToBookVehicle'] = $year. ' ' .$make. ' ' .$model;
                $_SESSION['continueToBookVehicleYear'] = $year;
                $_SESSION['continueToBookVehicleMake'] = $make;
                $_SESSION['continueToBookVehicleModel'] = $model;
                $_SESSION['continueToBookVehicleEngine'] = $engine;
              }

              $this->_show_page('servicequoting', $data);
            }
          }
          else if($formSubmit == 'stepThree')
          {
            $data['serviceStep'] = 4;

            $this->_show_page('servicequoting', $data);
          }
          else if($formSubmit == 'stepHeavyTruck')
          {
            $data['serviceStep'] = 'heavyduty';

            $this->_show_page('servicequoting', $data);
          }
          else if($formSubmit == 'stepEquipment')
          {
            $data['serviceStep'] = 'equipment';

            $this->_show_page('servicequoting', $data);
          }
          else if($formSubmit == 'submitHeavyTruck')
          {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('heavy_truck', 'Description', 'required');

            if($this->form_validation->run() === FALSE )
            {
              $data['serviceStep'] = 'heavyduty';

              $this->_show_page('servicequoting', $data);
            }
            else
            {
              $name = $this->input->post('name');
              $email = $this->input->post('email');
              $message = $this->input->post('heavy_truck');

              # Instantiate the client.
              $mgClient = new Mailgun('key-c63dc2f1cea0b9fcfe299ab1f1b5898c');
              $domain = "www.gooil.ca";

              $gooilEmail = 'john@gooil.ca';

              # Make the call to the client.
              $result = $mgClient->sendMessage("$domain",
                        array('from'    => $name.'<'.$email.'>',
                              'to'      => 'Go Oil <'.$gooilEmail.'>',
                              'subject' => 'New Quote Request',
                              'text'    => 'Name: '.$name. "\r\r\n" .
                                           'Email: '.$email. "\r\r\n" .
                                           'Message: '.$message));

             $this->_show_page('home');
            }
          }
          else
          {
            $data['serviceStep'] = 1;
            $this->_show_page('servicequoting', $data);
            
          }
    }

    public function get_vehicle_makes()
    {
      $selectedVehicleYear = $this->input->post('car_year');

      $carMakes = $this->vehicle_model->get_makes($selectedVehicleYear);

      if(count($carMakes) > 0)
      {
        $make_select_box = '';
        $make_select_box .= '<option value="">Select Make</option>';

        foreach($carMakes as $make)
        {
          $make_select_box .='<option value="'.$make->car_make.'">'.$make->car_make.'</option>';
        }

        echo json_encode($make_select_box);
      }
    }

    public function get_vehicle_models()
    {
      $selectedVehicleMake = $this->input->post('car_make');
      $selectedVehicleYear = $this->input->post('car_year');

      $carModels = $this->vehicle_model->get_models($selectedVehicleMake, $selectedVehicleYear);

      if(count($carModels) > 0)
      {
        $model_select_box = '';
        $model_select_box .='<option value="">Select Model</option>';

        foreach($carModels as $model)
        {
          $model_select_box .= '<option value="'.$model->car_model.'">'.$model->car_model.'</option>';
        }

        echo json_encode($model_select_box);
      }
    }

    public function get_vehicle_engines()
    {
      $selectedVehicleMake = $this->input->post('car_make');
      $selectedVehicleModel = $this->input->post('car_model');
      $selectedVehicleYear = $this->input->post('car_year');

      $carEngines = $this->vehicle_model->get_engines($selectedVehicleMake, $selectedVehicleModel, $selectedVehicleYear);

      if(count($carEngines) > 0)
      {
        $engine_select_box = '';
        $engine_select_box .= '<option value="">Select Engine</option>';
        $engine_select_box .= "<option value=' '>I don't know</option>";

        foreach($carEngines as $engine)
        {
          if($engine->car_engine != '0')
          {
            $engine_select_box .= '<option value="'.$engine->car_engine.'">'.$engine->car_engine.'</option>';
          }
        }
        echo json_encode($engine_select_box);
      }
    }

    public function get_oil_weight()
    {
      $selectedVehicleMake = $this->input->post('car_make');
      $selectedVehicleModel = $this->input->post('car_model');
      $selectedVehicleYear = $this->input->post('car_year');
      $selectedVehicleEngine = $this->input->post('car_engine');

      $oilWeight = $this->vehicle_model->get_oil_weight($selectedVehicleMake, $selectedVehicleModel, $selectedVehicleYear, $selectedVehicleEngine);

      $character_mask = ' .';

      $noWeightDefault = '0W-40';
      $currentWeight = trim($oilWeight->weight, $character_mask);

      $allCurrentOilWeights = $this->vehicle_model->get_all_oil_weights();

      foreach($allCurrentOilWeights as $weight)
      {
        $weights_array[] = $weight->weight;
      }

      if(in_array($currentWeight, $weights_array))
      {
        echo json_encode($currentWeight);
      }
      else
      {
        echo json_encode($noWeightDefault);
      }
    }

    public function get_oil_types()
    {
      $oilWeight = $this->input->post('oil_weight');

      $currentTypes = $this->vehicle_model->get_oil_types($oilWeight);

      $typeSelectBox = '';
      $typeSelectBox .= '<option value="">Select Oil Type</option>';

      foreach($currentTypes as $type)
      {
        $upperCaseTypes = implode('-', array_map('ucfirst', explode('-', $type->type)));

        $typeSelectBox .= '<option value="'.$type->type.'">'.$upperCaseTypes.'</option>';
      }
      echo json_encode($typeSelectBox);

    }

    public function get_oil_capacity()
    {
      $selectedVehicleMake = $this->input->post('car_make');
      $selectedVehicleModel = $this->input->post('car_model');
      $selectedVehicleYear = $this->input->post('car_year');
      $selectedVehicleEngine = $this->input->post('car_engine');

      $oilCapacity = $this->vehicle_model->get_oil_capacity($selectedVehicleMake, $selectedVehicleModel, $selectedVehicleYear, $selectedVehicleEngine);

      $minimumCapacity = 5;

      if(preg_match("/[a-z]/i", $oilCapacity->capacity))
      {
        $capacity = substr($oilCapacity->capacity, -3, 1);

        if($capacity < $minimumCapacity)
        {
          echo json_encode($minimumCapacity);
        }
        else
        {
          echo json_encode(ceil(trim($capacity, ' ')));
        }
      }
      else if(empty($oilCapacity->capacity))
      {
        echo json_encode($minimumCapacity);

      }
      else
      {
        $capacity = ($oilCapacity->capacity);

        if($capacity < $minimumCapacity)
        {
          echo json_encode($minimumCapacity);
        }
        else
        {
          echo json_encode(ceil(trim($capacity, ' ')));
        }
      }

    }

    public function get_oil_price()
    {
      $oilType = $this->input->post('oil_type');
      $oilWeight = $this->input->post('oil_weight');
      $oilCap = $this->input->post('oil_cap');

      $cost = $this->vehicle_model->get_oil_price($oilType, $oilWeight);

      echo json_encode(number_format($cost->cost * $oilCap, 2));
    }

    public function get_priceID()
    {
      $oilType = $this->input->post('oil_type');
      $oilWeight = $this->input->post('oil_weight');

      $priceID = $this->vehicle_model->get_priceID($oilType, $oilWeight);

      $postal = $this->user_model->get_account_information();

      $postalCode = $postal->postalCode;

      if($priceID == null)
      {
        echo json_encode('nope');
      }
      else
      {
        $vonigoParameters = '<input type="hidden" name="serviceTypeID" value="'.$_SESSION['serviceTypeID'].'"/>
                            <input type="hidden" name="clientTypeID" value="'.$_SESSION['clientTypeID'].'"/>
                            <input type="hidden" name="clientID" value="'.$_SESSION['clientID'].'"/>
                            <input type="hidden" name="assetID" value="'.$_SESSION['assetID'].'"/>
                            <input type="hidden" name="locationID" value="'.$_SESSION['locationID'].'"/>
                            <input type="hidden" name="contactID" value="'.$_SESSION['contactID'].'"/>
                            <input type="hidden" name="zip" value="'.$postalCode.'"/>
                            <input type="hidden" name="priceItemID1" value="'.$priceID->priceID.'"/>
                            <input type="hidden" name="priceItemQty1" value="'.$_SESSION['oil_capacity'].'"/>';

        echo json_encode($vonigoParameters);
      }
    }

    public function get_all_services()
    {
      $services = $this->service_model->get_all_services();

      $serviceCheckBoxes = '';

      foreach($services as $service)
      {
        $price = $this->service_model->get_service_price($service->name);

        $serviceCheckBoxes .= '<input id="'.$service->name.'" class="serviceBoxes" type="checkbox" name="addService" value="'.$service->name.'">';
        $serviceCheckBoxes .= '<label for ="'.$service->name.'" name="addService">'.$service->service.'         $'.$price->cost.'</label><br>';
      }

      echo json_encode($serviceCheckBoxes);
    }

    public function get_service_price()
    {
      $serviceName = $this->input->post('serviceName');

      $servicePrice = $this->service_model->get_service_price($serviceName);

      $cost = number_format($servicePrice->cost, 2);

      if(null !== ($this->input->post('isSingle')) && $this->input->post('isSingle') == TRUE)
      {
        $addServices = '';
        $addServices .= '<p id="'.$serviceName.'" style = "font-size: 13px;">'.$servicePrice->service.':   '.$cost.' </p>';

        echo json_encode($addServices);
      }
      else
      {
        echo json_encode(number_format($servicePrice->cost, 2));
      }
    }

  }
 ?>
