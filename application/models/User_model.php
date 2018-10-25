<?php
  class user_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }

    private function get_pass($email)
    {
      $this->db->select('password');
      $this->db->where('email',$email);
      $query = $this->db->get('user');

      if($query->num_rows() > 0)
      {
        return $pass = $query->row('password');
      }
    }

    private function is_active($email)
    {
      $this->db->select('active');
      $this->db->where('email', $email);
      $query = $this->db->get('user');

      if($query->num_rows() > 0)
      {
        $active = $query->row('active');

        if($active == '0')
        {
          return FALSE;
        }
        else
        {
          return TRUE;
        }
      }
    }

    public function email_exists($email)
    {
      $this->db->select('email');
      $this->db->where('email', $email);
      $query = $this->db->get('user');

      if($query->num_rows() > 0)
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }


    public function get_token()
    {
    //  Where we dynamically create and retreive security token
      $ch = curl_init('https://gooil.vonigo.com/api/v1/security/login/?appVersion=1&company=GoOilCanada&password=5f921394fafab524ba41179b3e17dbdd&userName=Jonathan.Sparrow');

      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER,
                  array("Content-type: application/json", "Content-Length: 0"));
      curl_setopt($ch, CURLOPT_POST, true);

      $result = curl_exec($ch);

      $token = json_decode($result, TRUE);

      $securityToken = $token['securityToken'];

      $data = array('token' => $securityToken);

      $this->db->where('id', 1);
      $this->db->update('token', $data);

      return $securityToken;
    }

    public function get_security_token()
    {
      $this->db->select('token');
      $query = $this->db->get('token');

      return $query->row();
    }

    public function get_clientID($email)
    {
      // $securityToken = $this->get_token();
      $securityToken = $this->get_security_token();

      // Get ClientID
      $getClientID ='{
        "securityToken": "'.$securityToken->token.'",
        "isCompleteObject": "false",
        "searchPar": "'.$email.'"
              }';

      $ch = curl_init('https://gooil.vonigo.com/api/v1/data/Clients/');

      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER,
                  array("Content-type: application/json"));
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $getClientID);

      $result = curl_exec($ch);

      $clientId = json_decode($result, TRUE);

      $id = $clientId['Clients'][0]['objectID'];

      return $id;
    }

    public function set_user($hash)
    {
      $this->load->helper('url');

      $email = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);
      $password = filter_var($this->input->post('password'), FILTER_SANITIZE_STRING);
      $securityQuestion = filter_var($this->input->post('securityQuestion'), FILTER_SANITIZE_STRING);
      $securityAnswer = filter_var($this->input->post('securityAnswer'), FILTER_SANITIZE_STRING);
      $name = filter_var($this->input->post('name'), FILTER_SANITIZE_STRING);
      $city = filter_var($this->input->post('city'), FILTER_SANITIZE_STRING);
      $postalCode = filter_var($this->input->post('postalCode'), FILTER_SANITIZE_STRING);
      $phoneNumber = filter_var($this->input->post('phoneNumber'), FILTER_SANITIZE_NUMBER_INT);


      $data = array('email' => html_escape($email),
                    'password' => password_hash(html_escape($password), PASSWORD_BCRYPT),
                    'securityQuestion' => html_escape($securityQuestion),
                    'securityAnswer' => password_hash(html_escape($securityAnswer), PASSWORD_BCRYPT),
                    'name' => html_escape($name),
                    'city' => html_escape($city),
                    'postalCode' => html_escape($postalCode),
                    'phoneNumber' => html_escape($phoneNumber),
                    'hash' => html_escape($hash));

      $parts = explode(" ", $name);
      $lastname = array_pop($parts);
      $firstname = implode(" ", $parts);

      $this->db->insert('user', $data);
    }

    public function set_google_user()
    {
      $this->load->helper('url');

      $city = filter_var($this->input->post('city'), FILTER_SANITIZE_STRING);
      $postalCode = filter_var($this->input->post('postalCode'), FILTER_SANITIZE_STRING);
      $phoneNumber = filter_var($this->input->post('phoneNumber'), FILTER_SANITIZE_NUMBER_INT);
      $hash = md5(rand(0,1000));

      $data = array('email' => $_SESSION['googleEmail'],
                   'password' => password_hash($hash, PASSWORD_BCRYPT),
                   'securityQuestion' => 'This account is registered through Google.',
                   'securityAnswer' => password_hash($hash, PASSWORD_BCRYPT),
                   'name' => $_SESSION['googleFirstName'] . ' ' .$_SESSION['googleFamilyName'],
                   'city' => html_escape($city),
                   'postalCode' => html_escape($postalCode),
                   'phoneNumber' => html_escape($phoneNumber),
                   'active' => '1');

      $this->db->insert('user', $data);
    }

    public function set_facebook_user()
    {
      $this->load->helper('url');

      $city = filter_var($this->input->post('city'), FILTER_SANITIZE_STRING);
      $postalCode = filter_var($this->input->post('postalCode'), FILTER_SANITIZE_STRING);
      $phoneNumber = filter_var($this->input->post('phoneNumber'), FILTER_SANITIZE_NUMBER_INT);
      $hash = md5(rand(0,1000));

      $data = array('email' => $_SESSION['facebookEmail'],
                   'password' => password_hash($hash, PASSWORD_BCRYPT),
                   'securityQuestion' => 'This account is registered through Facebook.',
                   'securityAnswer' => password_hash($hash, PASSWORD_BCRYPT),
                   'name' => $_SESSION['facebookFirstName'] . ' ' .$_SESSION['facebookLastName'],
                   'city' => html_escape($city),
                   'postalCode' => html_escape($postalCode),
                   'phoneNumber' => html_escape($phoneNumber),
                   'active' => '1');

      $this->db->insert('user', $data);
    }

    public function set_contact($id, $first,$email, $last, $phone)
    {
      $securityToken = $this->get_token();

      $setContact ='{
        "securityToken": "'.$securityToken.'",
        "method": "3",
        "clientID": "'.$id.'",
        "Fields": [
          {
            "fieldID": 1090,
            "fieldValue": ""
          },
          {
            "fieldID": 96,
            "fieldValue": ""
          },
          {
            "fieldID": 211,
            "fieldValue": ""
          },
          {
            "fieldID": 125,
            "fieldValue": ""
          },
          {
            "fieldID": 127,
            "fieldValue": "'.$first.'"
          },
          {
            "fieldID": 10322,
            "fieldValue": "'.$email.'"
          },
          {
            "fieldID": 1088,
            "fieldValue": "'.$phone.'"
          },
          {
            "fieldID": 134,
            "optionID": ""
          },
          {
            "fieldID": 9795,
            "fieldValue": ""
          },
          {
            "fieldID": 128,
            "fieldValue": "'.$last.'"
          }
        ]
      }';

      $ch_contact = curl_init('https://gooil.vonigo.com/api/v1/data/Contacts/');

      curl_setopt($ch_contact, CURLOPT_HEADER, FALSE);
      curl_setopt($ch_contact, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch_contact, CURLOPT_HTTPHEADER,
                  array("Content-type: application/json"));
      curl_setopt($ch_contact, CURLOPT_POST, true);
      curl_setopt($ch_contact, CURLOPT_POSTFIELDS, $setContact);

      $result_contact = curl_exec($ch_contact);
    }

    public function get_contact($id)
    {
      // $securityToken = $this->get_token();
      $securityToken = $this->get_security_token();

      $getContact ='{
                      "securityToken": "'.$securityToken->token.'",
                      "method": 1,
                      "clientID": "'.$id.'"
                    }';

      $ch_contact = curl_init('https://gooil.vonigo.com/api/v1/data/Clients/');

      curl_setopt($ch_contact, CURLOPT_HEADER, FALSE);
      curl_setopt($ch_contact, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch_contact, CURLOPT_HTTPHEADER,
                  array("Content-type: application/json"));
      curl_setopt($ch_contact, CURLOPT_POST, true);
      curl_setopt($ch_contact, CURLOPT_POSTFIELDS, $getContact);

      $result_contact = curl_exec($ch_contact);

      $contact = json_decode($result_contact, TRUE);

      return $contact['Relations'][0]['objectID'];
    }

    public function get_location($id)
    {
      // $securityToken = $this->get_token();
      $securityToken = $this->get_security_token();

      $getLocation ='{
                      "securityToken": "'.$securityToken->token.'",
                      "method": 1,
                      "clientID": "'.$id.'"
                    }';

      $ch_location = curl_init('https://gooil.vonigo.com/api/v1/data/Clients/');

      curl_setopt($ch_location, CURLOPT_HEADER, FALSE);
      curl_setopt($ch_location, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch_location, CURLOPT_HTTPHEADER,
                  array("Content-type: application/json"));
      curl_setopt($ch_location, CURLOPT_POST, true);
      curl_setopt($ch_location, CURLOPT_POSTFIELDS, $getLocation);

      $result_location = curl_exec($ch_location);

      $contact = json_decode($result_location, TRUE);

      return $contact['Relations'][1]['objectID'];
    }

    public function get_user()
    {
      $loginEmail_sanitize = filter_var($this->input->post('loginEmail'), FILTER_SANITIZE_EMAIL);
      $loginpass_sanitize = filter_var($this->input->post('loginPassword'), FILTER_SANITIZE_STRING);

      $loginEmail = html_escape($loginEmail_sanitize);
      $loginpass = html_escape($loginpass_sanitize);

      $isActive = $this->is_active($loginEmail);

      if(password_verify($loginpass, $this->get_pass($loginEmail)) && $isActive == '1')
      {
        $_SESSION['userEmail'] = $loginEmail;

        $result = $this->get_firstname();
        $firstname = $result->firstname;

        $result = $this->get_lastname();
        $lastname = $result->lastname;

        $result = $this->get_phonenumber();
        $phone = $result->phoneNumber;

        $postal = $this->user_model->get_account_information();

        $postalCode = $postal->postalCode;

        $this->get_token();

        $_SESSION['postalCode'] = $postalCode;
        $_SESSION['clientID'] = $this->user_model->get_clientID($_SESSION['userEmail']);
        $_SESSION['contactID'] = $this->user_model->get_contact($_SESSION['clientID']);
        $_SESSION['locationID'] = $this->user_model->get_location($_SESSION['clientID']);


        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }

    public function get_google_user()
    {
      $postal = $this->user_model->get_account_information();

      $postalCode = $postal->postalCode;

      $this->get_token();

      $_SESSION['isLoggedInGoogleFacebook'] = TRUE;


      // TODO: FIX WHERE LOG IN NEW TIME GET VALUE SHIT
      $_SESSION['postalCode'] = $postalCode;

      if(isset($_SESSION['firstLog']) && $_SESSION['firstLog'] == TRUE)
      {
        $_SESSION['clientID'] = $_COOKIE['clientID'];
        $_SESSION['contactID'] = $_COOKIE['contactID'];
        $_SESSION['locationID'] = $_COOKIE['locationID'];

        unset($_SESSION['firstLog']);
      }
      else
      {
        $_SESSION['clientID'] = $this->user_model->get_clientID($_SESSION['userEmail']);
        $_SESSION['contactID'] = $this->user_model->get_contact($_SESSION['clientID']);
        $_SESSION['locationID'] = $this->user_model->get_location($_SESSION['clientID']);
      }
    }

    public function get_facebook_user()
    {
      $postal = $this->user_model->get_account_information();

      $postalCode = $postal->postalCode;

      $this->get_token();

      $_SESSION['isLoggedInGoogleFacebook'] = TRUE;

      // TODO: FIX WHERE LOG IN NEW TIME GET VALUE SHIT
      $_SESSION['postalCode'] = $postalCode;

      if(isset($_SESSION['firstLog']) && $_SESSION['firstLog'] == TRUE)
      {
        $_SESSION['clientID'] = $_COOKIE['clientID'];
        $_SESSION['contactID'] = $_COOKIE['contactID'];
        $_SESSION['locationID'] = $_COOKIE['locationID'];

        unset($_SESSION['firstLog']);
      }
      else
      {
        $_SESSION['clientID'] = $this->user_model->get_clientID($_SESSION['userEmail']);
        $_SESSION['contactID'] = $this->user_model->get_contact($_SESSION['clientID']);
        $_SESSION['locationID'] = $this->user_model->get_location($_SESSION['clientID']);
      }
    }

    public function get_vonigo_client($email, $clientID)
    {

    }

    public function get_user_info()
    {
      $this->db->select('name, email, phoneNumber, hash');
      $this->db->where('email', $_SESSION['userEmail']);
      $query = $this->db->get('user');

      return $query->row();
    }

    public function email_verify($email, $hash)
    {
      $this->db->select('email', 'hash');
      $this->db->where('email', $email);
      $this->db->where('hash', $hash);
      $query = $this->db->get('user');

      if($query->num_rows() > 0)
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }

    public function activate_user($email)
    {

      $data = array('active' => '1');

      $this->db->where('email', $email);
      return $this->db->update('user', $data);
    }

    public function get_account_information()
     {
       $this->db->select('name, city, postalCode, phoneNumber');
       $this->db->where('email', $_SESSION['userEmail']);
       $query = $this->db->get('user');

       return $query->row();
     }

     public function get_user_id()
     {
       $this->db->select('id');
       $this->db->where('email', $_SESSION['userEmail']);
       $query = $this->db->get('user');

       return $query->row();
     }

     public function get_vehicle_information()
     {
       $row = $this->get_user_id();

       $userId = $row->id;

       $this->db->select('id, year, make, model, engine, unit');
       $this->db->where('userid', $userId);
       $query = $this->db->get('vehicle');

       $result = $query->result();
       $metaData = $query->field_data();

       return array('result'=>$result, 'metaData'=>$metaData);
     }

     public function get_single_vehicle($id)
     {
       $this->db->select('year, make, model, engine, unit, oil_capacity, oil_weight');
       $this->db->where('id', $id);
       $query = $this->db->get('vehicle');

       return $query->row();
     }

     public function add_vehicle()
     {
       $this->load->helper('url');

       $row = $this->get_user_id();

       $userId = $row->id;

       $year = filter_var($this->input->post('vehicleYear'), FILTER_SANITIZE_NUMBER_INT);
       $make = filter_var($this->input->post('vehicleMake'), FILTER_SANITIZE_STRING);
       $model = filter_var($this->input->post('vehicleModel'), FILTER_SANITIZE_STRING);
       $engine = filter_var($this->input->post('vehicleEngine'), FILTER_SANITIZE_STRING);
       $unit = filter_var($this->input->post('unit'), FILTER_SANITIZE_NUMBER_INT);
       $kilometers = filter_var($this->input->post('kilometers'), FILTER_SANITIZE_NUMBER_FLOAT);

       if($unit == 0)
       {
         $unit = 1;
       }

       if($kilometers == 0)
       {
         $kilometers = 0;
       }

       $oil_weight = $this->input->post('oil_weight');
       $oil_capacity = $this->input->post('oil_capacity');

       $slug = $year.'-'.strtolower($make).'-'.strtolower($model);

       $data = array('year' => html_escape($year),
                      'make' => html_escape($make),
                      'model' => html_escape($model),
                      'engine' => html_escape($engine),
                      'userid' => $userId,
                      'slug' => $slug,
                      'unit' => $unit,
                      'kilometers' => $kilometers,
                      'oil_weight' => html_escape($oil_weight),
                      'oil_capacity' => html_escape($oil_capacity));

        $clientID = $this->get_clientID($_SESSION['userEmail']);

        $securityToken = $this->get_token();

        $vehicleParams = '{
                            "securityToken": "'.$securityToken.'",
                            "method": "3",
                            "clientID": "'.$clientID.'",
                            "Fields": [
                              {
                                "fieldID": 10237,
                                "fieldValue": "'.$year.'"
                              },
                              {
                                "fieldID": 10235,
                                "fieldValue": "'.$make.'"
                              },
                              {
                                "fieldID": 10236,
                                "fieldValue": "'.$model.'"
                              },
                              {
                                "fieldID": 10319,
                                "fieldValue": "'.$engine.'"
                              },
                              {
                                "fieldID": 10323,
                                "fieldValue": "'.$kilometers.'"
                              },
                              {
                                "fieldID": 10325,
                                "fieldValue": "'.$unit.'"
                              }
                            ]
                          }';

        $addVehicle_ch = curl_init('https://gooil.vonigo.com/api/v1/data/Assets/');

        curl_setopt($addVehicle_ch, CURLOPT_HEADER, FALSE);
        curl_setopt($addVehicle_ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($addVehicle_ch, CURLOPT_HTTPHEADER,
                    array("Content-type: application/json"));
        curl_setopt($addVehicle_ch, CURLOPT_POST, true);
        curl_setopt($addVehicle_ch, CURLOPT_POSTFIELDS, $vehicleParams);

        $result = curl_exec($addVehicle_ch);

        return $this->db->insert('vehicle', $data);
     }

     public function book_add_vehicle()
     {
       $this->load->helper('url');

       $row = $this->get_user_id();

       $userId = $row->id;

       $year = filter_var($this->input->post('vehicleYear'), FILTER_SANITIZE_NUMBER_INT);
       $make = filter_var($this->input->post('vehicleMake'), FILTER_SANITIZE_STRING);
       $model = filter_var($this->input->post('vehicleModel'), FILTER_SANITIZE_STRING);
       $engine = filter_var($this->input->post('vehicleEngine'), FILTER_SANITIZE_STRING);
       $unit = filter_var($this->input->post('unit'), FILTER_SANITIZE_NUMBER_INT);
       $kilometers = filter_var($this->input->post('kilometers'), FILTER_SANITIZE_NUMBER_FLOAT);

       if($unit == 0)
       {
         $unit = 1;
       }

       $oil_weight = $this->input->post('oil_weight');
       $oil_capacity = $this->input->post('oil_capacity');

       $slug = $year.'-'.strtolower($make).'-'.strtolower($model);

       $data = array('year' => html_escape($year),
                      'make' => html_escape($make),
                      'model' => html_escape($model),
                      'engine' => html_escape($engine),
                      'userid' => $userId,
                      'slug' => $slug,
                      'oil_weight' => html_escape($oil_weight),
                      'oil_capacity' => html_escape($oil_capacity));

        $clientID = $this->get_clientID($_SESSION['userEmail']);

        $securityToken = $this->get_token();

        $vehicleParams = '{
                            "securityToken": "'.$securityToken.'",
                            "method": "3",
                            "clientID": "'.$clientID.'",
                            "Fields": [
                              {
                                "fieldID": 10237,
                                "fieldValue": "'.$year.'"
                              },
                              {
                                "fieldID": 10235,
                                "fieldValue": "'.$make.'"
                              },
                              {
                                "fieldID": 10236,
                                "fieldValue": "'.$model.'"
                              },
                              {
                                "fieldID": 10319,
                                "fieldValue": "'.$engine.'"
                              }
                            ]
                          }';

        $addVehicle_ch = curl_init('https://gooil.vonigo.com/api/v1/data/Assets/');

        curl_setopt($addVehicle_ch, CURLOPT_HEADER, FALSE);
        curl_setopt($addVehicle_ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($addVehicle_ch, CURLOPT_HTTPHEADER,
                    array("Content-type: application/json"));
        curl_setopt($addVehicle_ch, CURLOPT_POST, true);
        curl_setopt($addVehicle_ch, CURLOPT_POSTFIELDS, $vehicleParams);

        $result = curl_exec($addVehicle_ch);

         return $this->db->insert('vehicle', $data);
     }

     public function get_vehicleVonigoID($id)
     {
       $this->db->select('model');
       $this->db->where('id', $id);
       $query = $this->db->get('vehicle');
       $model = $query->row()->model;

       $clientID = $this->get_clientID($_SESSION['userEmail']);

       $this->db->select('id');
       $this->db->where('email', $_SESSION['userEmail']);
       $query3 = $this->db->get('user');
       $userid = $query3->row()->id;

       $this->db->select('*');
       $this->db->where('userid', $userid);
       $query2 = $this->db->get('vehicle');
       $numberOfVehicle = $query2->num_rows();

       $securityToken = $this->get_token();

       $assetsParams = '{
                          "securityToken": "'.$securityToken.'",
                          "sortDirection": "1",
                          "pageSize": "50",
                          "sortMode": "1",
                          "pageNo": "1",
                          "clientID": "'.$clientID.'"
                        }';

       $listOfAsset_ch = curl_init('https://gooil.vonigo.com/api/v1/data/Assets/');

       curl_setopt($listOfAsset_ch, CURLOPT_HEADER, FALSE);
       curl_setopt($listOfAsset_ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($listOfAsset_ch, CURLOPT_HTTPHEADER,
                  array("Content-type: application/json"));
       curl_setopt($listOfAsset_ch, CURLOPT_POST, true);
       curl_setopt($listOfAsset_ch, CURLOPT_POSTFIELDS, $assetsParams);

       $result = curl_exec($listOfAsset_ch);

       $a = json_decode($result, TRUE);

       $i = 0;
       while($i < $numberOfVehicle)
       {
         if($a['Assets'][$i]['name'] == $model)
         {
           return $a['Assets'][$i]['objectID'];
         }
         $i++;
       }
     }

     public function delete_vehicle($id)
     {
       $objectID = $this->get_vehicleVonigoID($id);

       $securityToken = $this->get_token();

       $vehicleParams = '{
                          "securityToken": "'.$securityToken.'",
                          "method": "4",
                          "objectID": "'.$objectID.'"
                        }';

       $deleteVehicle_ch = curl_init('https://gooil.vonigo.com/api/v1/data/Assets/');

       curl_setopt($deleteVehicle_ch, CURLOPT_HEADER, FALSE);
       curl_setopt($deleteVehicle_ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($deleteVehicle_ch, CURLOPT_HTTPHEADER,
                  array("Content-type: application/json"));
       curl_setopt($deleteVehicle_ch, CURLOPT_POST, true);
       curl_setopt($deleteVehicle_ch, CURLOPT_POSTFIELDS, $vehicleParams);

       $result = curl_exec($deleteVehicle_ch);

       $this->db->where('id', $id);
       $this->db->delete('vehicle');
     }

     public function get_security_question($email)
     {
       $this->db->select('securityQuestion');
       $this->db->where('email', $email);
       $query = $this->db->get('user');

       if($query->num_rows() > 0)
       {
         return $securityQuestion = $query->row('securityQuestion');
       }
     }

     public function check_security_answer()
     {
       $this->db->select('securityAnswer');
       $this->db->where('email', $_SESSION['email']);
       $query = $this->db->get('user');

       return $query->row();
     }

     public function update_password()
    {
      $this->load->helper('url');

      $newPassword = filter_var($this->input->post('newPassword'), FILTER_SANITIZE_STRING);

      $data = array('password' => password_hash(html_escape($newPassword), PASSWORD_BCRYPT));

      if(isset($_SESSION['email']))
      {
        $this->db->where('email', $_SESSION['email']);
        return $this->db->update('user', $data);
      }
      else if(isset($_SESSION['userEmail']))
      {
        $this->db->where('email', $_SESSION['userEmail']);
        return $this->db->update('user', $data);
      }
    }

    public function get_password()
    {
      $this->db->select('password');
      $this->db->where('email', $_SESSION['userEmail']);
      $query = $this->db->get('user');

      return  $query->row();
    }

    public function update_information()
    {
      $this->load->helper('url');

      $name = filter_var($this->input->post('name'), FILTER_SANITIZE_STRING);
      $city = filter_var($this->input->post('city'), FILTER_SANITIZE_STRING);
      $postalCode = filter_var($this->input->post('postalCode'), FILTER_SANITIZE_STRING);
      $phoneNumber = filter_var($this->input->post('phoneNumber'), FILTER_SANITIZE_NUMBER_INT);

      unset($_SESSION['postalCode']);

      $_SESSION['postalCode'] = $postalCode;

      $data = array('name' => html_escape($name),
                     'city' => html_escape($city),
                     'postalCode' => html_escape($postalCode),
                     'phoneNumber' => html_escape($phoneNumber));

      $indexOfSpace = strrpos($name, ' ', 0);
      $length = strlen($name);

      $parts = explode(" ", $name);
      $lastname = array_pop($parts);
      $firstname = implode(" ", $parts);


        // TODO: Update Lead

        $clientID = $this->user_model->get_clientID($_SESSION['userEmail']);
        $token = $this->user_model->get_security_token();


        $updateLocation = '{
                "securityToken": "'.$token->token.'",
                "method": "2",
                "objectID": "'.$_SESSION['locationID'].'",
                "Fields": [
                  {
                    "fieldID": 779,
                    "optionID": "9907"
                  },
                  {
                    "fieldID": 778,
                    "optionID": "9833"
                  },
                  {
                    "fieldID": 776,
                    "fieldValue": "'.$city.'"
                  },
                  {
                    "fieldID": 773,
                    "fieldValue": ""
                  },
                  {
                    "fieldID": 775,
                    "fieldValue": "'.$postalCode.'"
                  },
                  {
                    "fieldID": 774,
                    "fieldValue": ""
                  },
                  {
                    "fieldID": 9714,
                    "fieldValue": ""
                  },
                  {
                    "fieldID": 9713,
                    "fieldValue": ""
                  }
                ]
              }';

        $updateLocation_ch = curl_init('https://gooil.vonigo.com/api/v1/data/Locations/');

        curl_setopt($updateLocation_ch, CURLOPT_HEADER, FALSE);
        curl_setopt($updateLocation_ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($updateLocation_ch, CURLOPT_HTTPHEADER,
                    array("Content-type: application/json"));
        curl_setopt($updateLocation_ch, CURLOPT_POST, true);
        curl_setopt($updateLocation_ch, CURLOPT_POSTFIELDS, $updateLocation);

        $result = curl_exec($updateLocation_ch);


         $existingCustomer = '{
             "securityToken": "'.$token->token.'",
             "method": "2",
             "objectID": "'.$clientID.'",
             "Fields": [
                {
                  "fieldID": 1081,
                  "fieldValue": ""
                },
                {
                  "fieldID": 1082,
                  "fieldValue": ""
                },
                {
                  "fieldID": 1091,
                  "fieldValue": "'.$_SESSION['userEmail'].'"
                },
                {
                  "fieldID": 130,
                  "fieldValue": ""
                },
                {
                  "fieldID": 795,
                  "optionID": "10158"
                },
                {
                  "fieldID": 10014,
                  "fieldValue": ""
                },
                {
                  "fieldID": 122,
                  "optionID": "62"
                },
                {
                  "fieldID": 126,
                  "fieldValue": "'.$lastname.','.$firstname.'"
                },
                {
                  "fieldID": 1080,
                  "fieldValue": ""
                },
                {
                  "fieldID": 129,
                  "fieldValue": ""
                },
                {
                  "fieldID": 111,
                  "fieldValue": ""
                },
                {
                  "fieldID": 112,
                  "fieldValue": "'.$phoneNumber.'"
                },
                {
                  "fieldID": 123,
                  "optionID": "65"
                },
                {
                  "fieldID": 121,
                  "optionID": "59"
                }
             ]
           }';

         $update_ch = curl_init('https://gooil.vonigo.com/api/v1/data/Clients/');

         curl_setopt($update_ch, CURLOPT_HEADER, FALSE);
         curl_setopt($update_ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($update_ch, CURLOPT_HTTPHEADER,
                     array("Content-type: application/json"));
         curl_setopt($update_ch, CURLOPT_POST, true);
         curl_setopt($update_ch, CURLOPT_POSTFIELDS, $existingCustomer);

         $result = curl_exec($update_ch);


       $this->db->where('email', $_SESSION['userEmail']);
       $this->db->update('user', $data);

    }

    public function update_vehicle()
    {
      $year = filter_var($this->input->post('vehicleYear'), FILTER_SANITIZE_NUMBER_INT);
      $make = filter_var($this->input->post('vehicleMake'), FILTER_SANITIZE_STRING);
      $model = filter_var($this->input->post('vehicleModel'), FILTER_SANITIZE_STRING);
      $engine = filter_var($this->input->post('vehicleEngine'), FILTER_SANITIZE_STRING);
      $unit = filter_var($this->input->post('unit'), FILTER_SANITIZE_NUMBER_INT);
      $slug = $year.'-'.strtolower($make).'-'.strtolower($model);

      $data = array('year' => html_escape($year),
                    'make' => html_escape($make),
                    'model' => html_escape($model),
                    'engine' => html_escape($engine),
                    'slug' => $slug,
                    'unit' => html_escape($unit));

      $this->db->where('id', $_SESSION['vehicleId']);

      return $this->db->update('vehicle', $data);
    }

    public function user_equipment_exists()
    {
      $row = $this->get_user_id();
      $userId = $row->id;

      $this->db->select('*');
      $this->db->where('userId',$userId);
      $query = $this->db->get('vehicle');

      if($query->num_rows() >= 1)
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }

    public function user_vehicle_exists($vehicleId)
    {
      $row = $this->get_user_id();
      $userId = $row->id;

      $this->db->where('userid', $userId);
      $this->db->where('id', $vehicleId);
    	$query = $this->db->get('vehicle');

    	if($query->num_rows() == 1)
    	{
      	return TRUE;
    	}
      else
      {
        return FALSE;
      }
    }

    public function get_slug($vehicleId)
    {
      $row = $this->get_user_id();
      $userId = $row->id;

      $this->db->select('slug');
      $this->db->where('userid', $userId);
      $this->db->where('id', $vehicleId);
    }

    public function get_firstname()
    {
      $row = $this->get_user_id();
      $userId = $row->id;

      $this->db->select("SUBSTRING_INDEX(name, ' ', 1) AS firstname");
      $this->db->where('id', $userId);
      $query = $this->db->get('user');

      return $query->row();
    }

    public function get_lastname()
    {
      $row = $this->get_user_id();
      $userId = $row->id;

      $this->db->select("SUBSTRING_INDEX(name, ' ', -1) AS lastname");
      $this->db->where('id', $userId);
      $query = $this->db->get('user');

      return $query->row();
    }

    public function get_phonenumber()
    {
      $row = $this->get_user_id();
      $userId = $row->id;

      $this->db->select('phoneNumber');
      $this->db->where('id', $userId);
      $query = $this->db->get('user');

      return $query->row();
    }
  }
 ?>
