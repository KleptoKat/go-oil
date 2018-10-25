<?php
  ini_set('max_execution_time', 300);
  require 'vendor/autoload.php';
  use Mailgun\Mailgun;

    class Pages extends CI_Controller
    {
      public function __construct()
      {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('vehicle_model');
        $this->load->model('service_model');
        $this->load->model('vonigo_model');
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->library('encryption');
        $this->load->library('javascript');
        $this->load->library('table');
        $this->table->set_heading('Year', 'Make', 'Model');
        $this->load->library('pagination');
        // $this->load->library('customcalendar');
      }

      public function index()
      {
        $data['title'] = ucfirst('home');

        if(isset($_SESSION['userEmail']))
        {
          if(isset($_SESSION['googleLogin']) && $_SESSION['googleLogin'] == TRUE)
          {
            $_SESSION['firstLog'] = TRUE;

            $this->user_model->get_google_user();

            sleep(5);

            unset($_SESSION['googleLogin']);

            // if(isset($_SESSION['continueToBook']) && $_SESSION['continueToBook'] == TRUE)
            // {
            //   $this->_show_page('continue');
            // }
          }
          else if(isset($_SESSION['facebookLogin']) && $_SESSION['facebookLogin'] == TRUE)
          {
            $_SESSION['firstLog'] = TRUE;

            $this->user_model->get_facebook_user();

            sleep(5);

            unset($_SESSION['facebookLogin']);

            // if(isset($_SESSION['isLoggedIn']) && isset($_SESSION['continueToBook']) && $_SESSION['continueToBook'] == TRUE)
            // {
            //   $this->_show_page('continue');
            // }
          }

          $result = $this->user_model->get_firstname();
          $data['firstname'] = $result->firstname;
          $this->load->view('templates/header', $data);
        }
        else
        {
          $this->load->view('templates/header');
        }

        // $this->load->view('templates/header');
        $this->load->view('pages/home');
        $this->load->view('templates/footer');
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

      public function view($page = 'home')
      {
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
          show_404();
        }

        $data['title'] = ucfirst($page);

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

        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
      }

      public function _check_email($email)
      {
        if($this->user_model->email_exists($email))
        {
          $this->form_validation->set_message('_check_email','The email '.$email. ' already exists.');
          return FALSE;
        }
        else
        {
          return TRUE;
        }
      }

      public function _check_postal_code($postalCode)
      {
        if(preg_match("/^[ABCEGHJKLMNPRSTVXYabceghjklmnprstvxy]{1}\d{1}[A-Za-z]{1} *\d{1}[A-Za-z]{1}\d{1}$/", $postalCode))
        {
          return TRUE;
        }
        else
        {
          $this->form_validation->set_message('_check_postal_code','Please enter a valid Canadian postal code.');
          return FALSE;
        }
      }

      public function _check_phone_number($phoneNumber)
      {
        if(preg_match("/^[2-9]{1}[0-9]{9}$/", $phoneNumber))
        {
          return TRUE;
        }
        else
        {
          $this->form_validation->set_message('_check_phone_number', 'Please enter a 10 digit phone number.');
          return FALSE;
        }
      }

      public function _check_password_requirements($password)
      {
        if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?!.* ).{8,16}$/", $password))
        {
          return TRUE;
        }
        else
        {
          $this->form_validation->set_message('_check_password_requirements', 'Password must contain 8-16 characters with one uppercase, one lowercase');
          return FALSE;
        }
      }

      public function fleet()
      {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'phone', 'required|callback__check_phone_number');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('numberOfVehicles', 'number of vehicles', 'required');
        $this->form_validation->set_rules('typeOfBusiness', 'type of business', 'required');

        if($this->form_validation->run() === FALSE)
        {
          $this->_show_page('fleet');
        }
        else
        {
          $name = filter_var($this->input->post('name'), FILTER_SANITIZE_STRING);
          $email = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);
          $phone = filter_var($this->input->post('phone'), FILTER_SANITIZE_NUMBER_INT);
          $city = filter_var($this->input->post('city'), FILTER_SANITIZE_STRING);
          $numberOfVehicles = filter_var($this->input->post('numberOfVehicles'), FILTER_SANITIZE_NUMBER_INT);
          $typeOfBusiness = filter_var($this->input->post('typeOfBusiness'), FILTER_SANITIZE_STRING);
          $text = filter_var($this->input->post('message'), FILTER_SANITIZE_STRING);

          $mgClient = new Mailgun('key-c63dc2f1cea0b9fcfe299ab1f1b5898c');
          $domain = "www.gooil.ca";

          $result = $mgClient->sendMessage("$domain",
                    array('from'    => "$name".' <'.$email.'>',
                          'to'      => 'Go Oil Canada'.' <tyler@gooil.ca>',
                          'subject' => 'Fleet Services',
                          'text'    => "$name"."
City: "."$city"."
Phone: "."$phone"."
Number of Vehicles: "."$numberOfVehicles"."
Type of Business: "."$typeOfBusiness"."
Message: "."$text"));

         $resultConfirmation = $mgClient->sendMessage("$domain",
                   array('from'    => "Go Oil Canada".' <tyler@gooil.ca>',
                         'to'      => $name.'<'.$email.'>',
                         'subject' => 'Fleet Services',
                         'text'    => 'Hi '.$name.'

Thank you for your interest in Go Oil Fleet Services.

We will review your information and get back to you with a discount rate within one business day.

If you have any questions or urgent requests please contact Tyler at (204) 384-1127 or reply back to this email.

Thanks and have a great day,

Tyler Bergen
Business Development'));

          $this->_show_page('home');
        }
      }

      public function franchise()
      {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('firstname', 'first name', 'required');
        $this->form_validation->set_rules('lastname', 'last name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'phone', 'required|callback__check_phone_number');
        $this->form_validation->set_rules('city', 'city', 'required');
        if($this->form_validation->run() === FALSE)
        {
          $this->_show_page('franchise');
        }
        else
       {
         $firstname = filter_var($this->input->post('firstname'), FILTER_SANITIZE_STRING);
         $lastname = filter_var($this->input->post('lastname'), FILTER_SANITIZE_STRING);
         $email = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);
         $phone = filter_var($this->input->post('phone'), FILTER_SANITIZE_NUMBER_INT);
         $city = filter_var($this->input->post('city'), FILTER_SANITIZE_STRING);
         $text = filter_var($this->input->post('message'), FILTER_SANITIZE_STRING);

         $name = $firstname.' '.$lastname;
         $mgClient = new Mailgun('key-c63dc2f1cea0b9fcfe299ab1f1b5898c');
         $domain = "www.gooil.ca";

         $result = $mgClient->sendMessage("$domain",
                   array('from'    => "$name".' <'.$email.'>',
                         'to'      => 'Go Oil Canada'.' <john@gooil.ca>',
                         'subject' => 'Franchise',
                         'text'    => "$text"."

City I'm interested in: "."$city"."
Phone: "."$phone"));

        $resultConfirmation = $mgClient->sendMessage("$domain",
                  array('from'    => "Go Oil Canada".' <no-reply@gooil.ca>',
                        'to'      => $name.'<'.$email.'>',
                        'subject' => 'Franchise',
                        'text'    => 'Thank you for your interest in a franchise with Go Oil Canada.
Please fill in the Google form at https://goo.gl/forms/OihZYlCRdJT9uNgU2.
We will contact you soon.'));

         $this->_show_page('home');
       }
      }

      public function register()
      {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback__check_email');
        $this->form_validation->set_rules('password', 'Password', 'required|callback__check_password_requirements');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('securityQuestion','Security Question', 'required');
        $this->form_validation->set_rules('securityAnswer','Security Answer', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('postalCode', 'Postal Code', 'required|callback__check_postal_code');
        $this->form_validation->set_rules('phoneNumber', 'Phone Number', 'required|callback__check_phone_number');

        if($this->form_validation->run() === FALSE )
        {
          $this->_show_page('register');
        }
        else
        {
          $name = filter_var($this->input->post('name'), FILTER_SANITIZE_STRING);

          $parts = explode(" ", $name);
          $data['lastName'] = array_pop($parts);
          $data['firstName'] = implode(" ", $parts);

          $data['email'] = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);
          $data['city'] = filter_var($this->input->post('city'), FILTER_SANITIZE_STRING);
          $data['postalCode'] = filter_var($this->input->post('postalCode'), FILTER_SANITIZE_STRING);
          $data['phoneNumber'] = filter_var($this->input->post('phoneNumber'), FILTER_SANITIZE_NUMBER_INT);

          $hash = md5(rand(0,1000));

          $this->user_model->set_user($hash);

          $data['bool'] = TRUE;

          $name = filter_var($this->input->post('name'), FILTER_SANITIZE_STRING);
          $email = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);
          $phoneNumber = filter_var($this->input->post('phoneNumber'), FILTER_SANITIZE_NUMBER_INT);

          $postalCodeFirstLetter = substr(filter_var($this->input->post('postalCode'), FILTER_SANITIZE_STRING), 0, 1);

          if($postalCodeFirstLetter == 'A' || $postalCodeFirstLetter == 'a')
          {
            $data['province'] = 'NL'; // Newfoundland and Labrador
          }
          else if($postalCodeFirstLetter == 'B' || $postalCodeFirstLetter == 'b')
          {
            $data['province'] = 'NS'; // Nova Scotia
          }
          else if($postalCodeFirstLetter == 'C' || $postalCodeFirstLetter == 'c')
          {
            $data['province'] = 'PE'; // Prince Edward Islands
          }
          else if($postalCodeFirstLetter == 'E' || $postalCodeFirstLetter == 'e')
          {
            $data['province'] = 'NB'; // New Brunswick
          }
          else if($postalCodeFirstLetter == 'H' || $postalCodeFirstLetter == 'h' || $postalCodeFirstLetter == 'G' ||      $postalCodeFirstLetter == 'g' || $postalCodeFirstLetter == 'J' || $postalCodeFirstLetter == 'j' )
          {
            $data['province'] = 'QC'; // Québec
          }
          else if($postalCodeFirstLetter == 'K' || $postalCodeFirstLetter == 'k' || $postalCodeFirstLetter == 'L' || $postalCodeFirstLetter == 'l' || $postalCodeFirstLetter == 'M' || $postalCodeFirstLetter == 'm' || $postalCodeFirstLetter == 'N' || $postalCodeFirstLetter == 'n')
          {
            $data['province'] = 'ON'; // Ontario
          }
          else if($postalCodeFirstLetter == 'P' || $postalCodeFirstLetter == 'p')
          {
            $data['province'] = 'ON'; // Ontario
          }
          else if($postalCodeFirstLetter == 'R' || $postalCodeFirstLetter == 'r')
          {
            $data['province'] = 'MB'; // Manitoba
          }
          else if($postalCodeFirstLetter == 'S' || $postalCodeFirstLetter == 's')
          {
            $data['province'] = 'SK'; // Saskatchewan
          }
          else if($postalCodeFirstLetter == 'T' || $postalCodeFirstLetter == 't')
          {
            $data['province'] = 'AB'; // Alberta
          }
          else if($postalCodeFirstLetter == 'V' || $postalCodeFirstLetter == 'v')
          {
            $data['province'] = 'BC'; // British Columbia
          }
          else if($postalCodeFirstLetter == 'X' || $postalCodeFirstLetter == 'x')
          {
            $data['province'] = 'NU'; // Nunavut, supposed to have North West Territories
          }
          else if($postalCodeFirstLetter == 'Y' || $postalCodeFirstLetter == 'y')
          {
            $data['province'] = 'YT'; // Yukon
          }

          $mgClient = new Mailgun('key-c63dc2f1cea0b9fcfe299ab1f1b5898c');
          $domain = "www.gooil.ca";

          # Make the call to the client.
          $result = $mgClient->sendMessage("$domain",
                    array('from'    => 'Go Oil Canada'.'<no-reply@gooil.ca>',
                          'to'      => "$name".' <'.$email.'>',
                          'subject' => 'Go Oil Registration',
                          'text'    => 'Thanks for signing up!

                                        Please click this link to activate your account:
                                        https://www.gooil.ca/verify?email='.$email.'&hash='.$hash.''));

          $this->_show_page('registersuccess', $data);
        }
      }

      public function verify()
      {
        $email = $this->input->get('email');
        $hash = $this->input->get('hash');

        if($this->user_model->email_verify($email, $hash))
        {
          $this->user_model->activate_user($email);

          $this->_show_page('accountactivated');
        }
        else {
          show_404();
        }
      }

      public function history()
      {

        $clientID = $this->user_model->get_clientID($_SESSION['userEmail']);
        // $token = $this->user_model->get_token();
        $token = $this->user_model->get_security_token();

        $orders = '{
          "securityToken": "'.$token->token.'",
          "pageSize": "50",
          "pageNo": "1",
          "sortMode": "1",
          "sortDirection": "0",
          "clientID": "'.$clientID.'",
          "isCompleteObject": "true"
        }';

        $ch = curl_init('https://gooil.vonigo.com/api/v1/data/WorkOrders/');

        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $orders);

        $result = curl_exec($ch);

        $data['result'] = $result;

        $this->_show_page('history', $data);
      }

      public function _display_information($updatesuccess = FALSE)
       {
         $row = $this->user_model->get_account_information();
         $data['vehicles'] = $this->user_model->get_vehicle_information();
         $data['vehicleYears'] = $this->vehicle_model->get_years();
         $data['name'] = $row->name;
         $data['city'] = $row->city;
         $data['postalCode'] = $row->postalCode;
         $data['phoneNumber'] = $row->phoneNumber;

         $result = $this->user_model->get_firstname();
         $data['firstname'] = $result->firstname;

         $this->load->view('templates/header', $data);
         $this->load->view('pages/account', $data);

         if($updatesuccess == TRUE)
         {
             $this->load->view('pages/updatesuccess');
         }

         $this->load->view('templates/footer');

       }

      // public function login()
      // {
      //   $this->load->helper('form');
      //   $this->load->library('form_validation');
      //
      //   if(isset($_POST['login']))
      //   {
      //     if($this->user_model->get_user())
      //     {
      //       $this->_show_page('loginsuccess');
      //     }
      //     else
      //     {
      //       $data['errorMessage'] = 'email and/or password is incorrect.';
      //
      //       $this->_show_page('login', $data);
      //     }
      //   }
      //   else
      //   {
      //     $this->_show_page('login');
      //   }
      // }

      // public function googlelogin()
      // {
      //   // $CLIENT_ID = '336018181001-g487td00nhsvdfdffl2klomq7670j6l8.apps.googleusercontent.com';
      //   $CLIENT_ID = '336018181001-mgvnkdo0tf9k95ic9e1volelnn75kmq2.apps.googleusercontent.com';
      //   $id_token = $this->input->post('id_token');
      //
      //   $client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
      //   $payload = $client->verifyIdToken($id_token);
      //   if ($payload) {
      //     $userid = $payload['sub'];
      //     // If request specified a G Suite domain:
      //     //$domain = $payload['hd'];
      //   } else {
      //     // Invalid ID Token
      //   }
      // }

      public function logout()
      {
        $this->_show_page('logout');
      }

      public function account()
      {
        if(isset($_SESSION['vehicleId']))
        {
          unset($_SESSION['vehicleId']);
        }

        if(isset($_POST['save']))
        {
          $this->load->helper('form');
          $this->load->library('form_validation');

          $this->form_validation->set_rules('name', 'Name', 'required');
          $this->form_validation->set_rules('city', 'City', 'required');
          $this->form_validation->set_rules('postalCode', 'Postal Code', 'required|callback__check_postal_code');
          $this->form_validation->set_rules('phoneNumber', 'Phone Number', 'required|callback__check_phone_number');
          if($this->form_validation->run() === FALSE)
          {
            $this->_display_information();
          }
          else
          {
            $this->user_model->update_information();
            $this->_display_information(TRUE);
          }
        }
        else if(isset($_POST['delete']))
        {
          $vehicleId = $this->input->post('vehicleId');

          $this->user_model->delete_vehicle($vehicleId);

          $this->_display_information();
        }
        else
        {
          if(isset($_SESSION['isLoggedIn']))
          {
            $this->_display_information();
          }
          else
          {
            show_404();
          }
        }
      }

      public function addvehicle()
      {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('year', 'Year', 'callback__check_year');
        $this->form_validation->set_rules('make', 'Make', 'callback__check_make');
        $this->form_validation->set_rules('model', 'Model', 'callback__check_model');
        $this->form_validation->set_rules('engine', 'Engine', 'callback__check_Engine');
        $this->form_validation->set_rules('unit', 'Unit', 'integer');

        if(isset($_POST['addvehicleAccount']))
        {
          if($this->form_validation->run() === FALSE)
          {
            $this->_display_information();
          }
          else
          {
            $this->user_model->add_vehicle();

            $this->_show_page('updatesuccess');
          }

        }
        else if(isset($_POST['addvehicleBooking']))
        {

          if($this->form_validation->run() === FALSE)
          {
            $data['vehicleExists'] = TRUE;
            $data['vehicles'] = $this->user_model->get_vehicle_information();
            $data['vehicleYears'] = $this->vehicle_model->get_years();

            $this->_show_page('servicebooking', $data);
          }
          else
          {
            $this->user_model->add_vehicle();
            $data['vehicleExists'] = TRUE;
            $data['vehicles'] = $this->user_model->get_vehicle_information();

            $this->_show_page('addsuccess', $data);
          }
        }
        else
        {
          $this->error();
          // $data['vehicleYears'] = $this->vehicle_model->get_years();
          // $this->_show_page('addvehicle', $data);
        }
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

      public function forgotpassword()
      {
        if(isset($_POST['continue']))
        {
          if(empty($this->input->post('loginEmail')))
          {
            $data['errorMessage'] = 'Please enter an email address.';

            $this->_show_page('forgotpassword', $data);
          }
          else if($this->user_model->email_exists($this->input->post('loginEmail')))
          {
            $_SESSION['email'] = $this->input->post('loginEmail');

            $data['secureQuestion'] = $this->user_model->get_security_question($_SESSION['email']);

            $this->_show_page('securequestion', $data);
          }
          else
          {
            $data['errorMessage'] = 'No account found with the email provided.';

            $this->_show_page('forgotpassword', $data);
          }
        }
        else
        {
          $this->_show_page('forgotpassword');
        }
      }

      public function secureQuestion()
      {
        $row = $this->user_model->check_security_answer();

        $answer = $row->securityAnswer;

        $inputAnswer = $this->input->post('securityAnswer');

        if(password_verify($inputAnswer, $answer))
        {
          $this->_show_page('changepassword');
        }
        else
        {
          $data['errorMessage'] = "The answer is incorrect.";
          $data['secureQuestion'] = $this->user_model->get_security_question($_SESSION['email']);

          $this->_show_page('securequestion', $data);
        }
      }

      public function changepassword()
      {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('newPassword', 'New Password', 'required|callback__check_password_requirements');
        $this->form_validation->set_rules('confirmNewPassword', 'Confirm Password', 'required|matches[newPassword]');

        if(isset($_SESSION['userEmail']))
        {
          $this->form_validation->set_rules('currentPassword', 'Current Passowrd', 'callback__check_current_password');
          $this->_check_current_password();
        }

        if($this->form_validation->run() === FALSE)
        {
          $this->_show_page('changepassword');
        }
        else
        {
          $this->user_model->update_password();
          $this->_show_page('passwordchangesuccess');
        }
      }

      public function _check_current_password()
      {
        $row = $this->user_model->get_password();
        $currentDbPassword = $row->password;

        $inputPassword = $this->input->post('currentPassword');

        if(password_verify($inputPassword, $currentDbPassword))
        {
          return true;
        }
        else
        {
          $this->form_validation->set_message('_check_current_password','Please enter the correct password.');
          return false;
        }
      }

      public function schedule()
      {
        $this->load->view('templates/header');
        $this->load->view('pages/schedule');
        $this->load->view('templates/footer');
      }

      public function services()
      {
        if(isset($_POST['delete']))
        {
          $vehicleId = $this->input->post('vehicleId');

          $this->user_model->delete_vehicle($vehicleId);

          $this->_show_page('servicebooking');
        }
      }

      public function editvehicle()
      {
        $vehicleId = $this->input->get('id');
        $vehicleSlug = $this->input->get('vehicle');

        if(!isset($_SESSION['vehicleId']))
        {
          $_SESSION['vehicleId'] = $vehicleId;
        }

        $vehicle = $this->user_model->get_single_vehicle($_SESSION['vehicleId']);

        $formSubmit = $this->input->post('submit');

        if($formSubmit == 'delete')
        {
          $this->user_model->delete_vehicle($_SESSION['vehicleId']);

          unset($_SESSION['vehicleId']);

          $this->_display_information();
        }
        else if($formSubmit == 'save')
        {
          $this->user_model->update_vehicle();

          unset($_SESSION['vehicleId']);

          $this->_display_information();
        }
        else
        {
          if($this->user_model->user_vehicle_exists($vehicleId))
          {
            $data['vehicleYears'] = $this->vehicle_model->get_years();

            $data['year'] = $vehicle->year;
            $data['make'] = $vehicle->make;
            $data['model'] = $vehicle->model;
            $data['engine'] = $vehicle->engine;
            $data['unit'] = $vehicle->unit;

            $this->_show_page('editvehicle', $data);
          }
          else
          {
            show_404();
          }
        }
      }

      public function error()
      {
        $this->_show_page('error');
      }

      public function vonigo()
      {
        $formSubmit = $this->input->post('submit');

        if($formSubmit == 'submit')
        {
          $securityToken = $this->user_model->get_token();

          $query ='{
            "securityToken": "'.$securityToken.'",
            "isCompleteObject": "false",
            "searchPar": "Uminga"
                  }';

          $ch = curl_init('https://gooil.vonigo.com/api/v1/data/Clients/');

          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER,
                      array("Content-type: application/json"));
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $query);

          $result = curl_exec($ch);

          $clientId = json_decode($result, TRUE);

          $data['result'] = json_decode($result);

          $data['clientID'] = $clientId['Clients'][0]['objectID'];

          $this->_show_page('vonigo', $data);

        }
        else if($formSubmit == 'token')
        {
          // alert(Vonigo.Security.getToken());

          $token = $this->user_model->get_token();

          // $ch = curl_init('https://gooil.vonigo.com/api/v1/security/login/?appVersion=1&company=Vonigo&password=691620a6bbda8e42c3a96a8d6cfcc46d&userName=Winnipeg.Test');
          //
          // curl_setopt($ch, CURLOPT_HEADER, FALSE);
          // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          // curl_setopt($ch, CURLOPT_HTTPHEADER,
          //             array("Content-type: application/json", "Content-Length: 0"));
          // curl_setopt($ch, CURLOPT_POST, true);
          //
          // $result = curl_exec($ch);
          //
          // $token = json_decode($result, TRUE);
          //
          // $data['token_stuff'] = json_decode($result, TRUE);
          //
          // $data['token'] = $token['securityToken'];

          // $securityToken = $this->vonigo_model->get_security_token();

          $data['token'] = $token;


          $this->_show_page('vonigo', $data);
        }
        else if($formSubmit == 'contact')
        {
          // $securityToken = $this->user_model->get_token();
          // $id = $this->user_model->get_clientID($_SESSION['userEmail']);
          //
          // $contactParam = '{
          //   "securityToken": "'.$securityToken.'",
          //   "sortDirection": "0",
          //   "clientID": "'.$id.'",
          //   "sortMode": "1",
          //   "pageNo": "1",
          //   "pageSize": "50"
          // }';
          //
          // $contact_ch = curl_init('https://gooil.vonigo.com/api/v1/data/Contacts/');
          //
          // curl_setopt($contact_ch, CURLOPT_HEADER, FALSE);
          // curl_setopt($contact_ch, CURLOPT_RETURNTRANSFER, true);
          // curl_setopt($contact_ch, CURLOPT_HTTPHEADER,
          //             array("Content-type: application/json","Content-Length: 0"));
          // curl_setopt($contact_ch, CURLOPT_POST, true);
          // curl_setopt($contact_ch, CURLOPT_POSTFIELDS, $contactParam);
          //
          // $result = curl_exec($contact_ch);

          $data['contact'] = $this->user_model->get_contact($_SESSION['clientID']);

          $this->_show_page('vonigo', $data);
        }
        else if($formSubmit == 'priceList')
        {
          $securityToken = $this->user_model->get_token();


          $priceListParam = '{
                  "securityToken": "'.$securityToken.'",
                  "method": "1",
                  "priceListID": "124"
                }';

          $priceList_ch = curl_init('https://gooil.vonigo.com/api/v1/data/priceLists/');

          curl_setopt($priceList_ch, CURLOPT_HEADER, FALSE);
          curl_setopt($priceList_ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($priceList_ch, CURLOPT_HTTPHEADER,
                      array("Content-type: application/json","Content-Length: 0"));
          curl_setopt($priceList_ch, CURLOPT_POST, true);
          curl_setopt($priceList_ch, CURLOPT_POSTFIELDS, $priceListParam);

          $result = curl_exec($priceList_ch);

          $priceList = json_decode($result, TRUE);

          $data['priceList'] = $priceList;

          $this->_show_page('vonigo', $data);
        }
        else
        {
          $this->_show_page('vonigo');
        }
      }

      public function termsofservice()
      {
        $this->_show_page('termsofservice');
      }

      // public function bookingquotingtestpage()
      // {
      //   $this->_show_page('bookingquotingtestpage');
      // }

      // public function fleet()
      // {
      //   $this->_show_page('fleet');
      // }

      public function continuetobook()
      {
        $this->_show_page('Continue');
      }
    }
 ?>
