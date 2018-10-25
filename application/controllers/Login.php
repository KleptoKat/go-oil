<?php
  ini_set('max_execution_time', 300);
  require 'vendor/autoload.php';

  class Login extends CI_Controller
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
      $this->load->helper('form');
      $this->load->library('form_validation');
      // $this->load->library('customcalendar');

      //load google login library
      $this->load->library('google');

      //load user model
      $this->load->model('Google_user_model');

      // Load facebook library
      $this->load->library('facebook');

      //Load user model
      $this->load->model('Facebook_user_model');
    }

    public function index()
    {
      // // Get logout URL
      // $data['logoutURL'] = $this->facebook->logout_url();
      // }else{
      // // Get login URL
      // $data['authURL'] =  $this->facebook->login_url();
      // }

      $data['authURL'] =  $this->facebook->login_url();

      $data['logoutURL'] = $this->facebook->logout_url();

      // // Load login & profile view
      // $this->load->view('user_authentication/index',$data);



      $this->load->helper('form');
      $this->load->library('form_validation');

      $googleLogin = $this->input->get('google');


      if(isset($_GET['code'])){
          //authenticate user
          $this->google->getAuthenticate();

          //get user info from google
          $gpInfo = $this->google->getUserInfo();

          //preparing data for database insertion
          $userData['oauth_provider'] = 'google';
          $userData['oauth_uid']      = $gpInfo['id'];
          $userData['first_name']     = $gpInfo['given_name'];
          $userData['last_name']      = $gpInfo['family_name'];
          $userData['email']          = $gpInfo['email'];
          $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
          $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
          $userData['profile_url']    = !empty($gpInfo['link'])?$gpInfo['link']:'';
          $userData['picture_url']    = !empty($gpInfo['picture'])?$gpInfo['picture']:'';

          $_SESSION['googleFirstName'] = $gpInfo['given_name'];
          $_SESSION['googleFamilyName'] = $gpInfo['family_name'];
          $_SESSION['googleEmail'] = $gpInfo['email'];

          //insert or update user data to the database
          $userID = $this->Google_user_model->checkUser($userData);

          //store status & user info in session
          $this->session->set_userdata('loggedIn', true);
          $this->session->set_userdata('userData', $userData);

          if($this->user_model->email_exists($gpInfo['email']))
          {
            //redirect to profile page
            $_SESSION['userEmail'] = $gpInfo['email'];
            $_SESSION["isLoggedIn"] = TRUE;
            $_SESSION['inComplete'] == FALSE;

            $this->user_model->get_google_user();

            redirect('login');
          }
          else
          {
            // $_SESSION['userEmail'] = $gpInfo['email'];

            $data['inComplete'] = TRUE;
            $_SESSION['inComplete'] = TRUE;
            $_SESSION['googlelogin'] = TRUE;
            $this->_show_page('login', $data);
          }

      }

      //google login url
      $data['loginURL'] = $this->google->loginURL();

      // //load google login view
      // $this->_show_page('login',$data);

      if(isset($_POST['login']))
      {
        if($this->user_model->get_user())
        {
          // if(isset($_SESSION['continueToBook']) && $_SESSION['continueToBook'] == TRUE)
          // {
          //   $this->_show_page('continue');
          // }
          // else
          // {
          //   $this->_show_page('loginsuccess');
          // }
          $this->_show_page('loginsuccess');
          
        }
        else
        {
          $data['errorMessage'] = 'email and/or password is incorrect.';
          $data['loginURL'] = $this->google->loginURL();

          $this->_show_page('login', $data);
        }
      }
      else if(isset($_POST['login2']))
      {
        $this->form_validation->set_rules('postalCode', 'Postal Code', 'required|callback__check_postal_code');
        $this->form_validation->set_rules('phoneNumber', 'Phone Number', 'required|callback__check_phone_number');
        $this->form_validation->set_rules('city', 'City', 'required');

        $code = $this->input->get('code');

        if($this->form_validation->run() === FALSE )
        {
          $data['inComplete'] = TRUE;

          $this->_show_page('login', $data);
        }
        else
        {
           $this->user_model->set_google_user();
           $_SESSION['inComplete'] = FALSE;
           $_SESSION['userEmail'] = $_SESSION['googleEmail'];

           $city = filter_var($this->input->post('city'), FILTER_SANITIZE_STRING);
           $postalCode = filter_var($this->input->post('postalCode'), FILTER_SANITIZE_STRING);
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

           $data['phoneNumber'] = $phoneNumber;
           $data['city'] = $city;
           $data['postalCode'] = $postalCode;

           $data['bool'] = TRUE;
           $this->_show_page('loginsuccess', $data);

        }
      }
      else
      {
        if(!isset($_SESSION['googlelogin']))
        {
          $data['loginURL'] = $this->google->loginURL();

          $this->_show_page('login', $data);
        }
      }
    }


    // TODO: FIX FACEBOOK LOGIN AND CLEAN UP YOUR CODE BOYY

    public function facebook()
    {

      $data['authURL'] =  $this->facebook->login_url();

      if(isset($_GET['code']))
      {
        $userData = array();

        // Check if user is logged in
        if($this->facebook->is_authenticated())
        {
          // Get user facebook profile details
          // $fbUserProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,locale,cover,picture');

          $fbUserProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email');

          // Preparing data for database insertion
           $userData['oauth_provider'] = 'facebook';
           $userData['oauth_uid'] = $fbUserProfile['id'];
           $userData['first_name'] = $fbUserProfile['first_name'];
           $userData['last_name'] = $fbUserProfile['last_name'];
           $userData['email'] = $fbUserProfile['email'];
           // $userData['gender'] = $fbUserProfile['gender'];
           // $userData['locale'] = $fbUserProfile['locale'];
           // $userData['cover'] = $fbUserProfile['cover']['source'];
           // $userData['picture'] = $fbUserProfile['picture']['data']['url'];
           // $userData['link'] = $fbUserProfile['link'];

           $_SESSION['facebookFirstName'] = $fbUserProfile['first_name'];
           $_SESSION['facebookLastName'] = $fbUserProfile['last_name'];
           $_SESSION['facebookEmail'] = $fbUserProfile['email'];

           // Insert or update user data
          $userID = $this->Facebook_user_model->checkUser($userData);

          // Check user data insert or update status
          if(!empty($userID))
          {
              $data['userData'] = $userData;
              $this->session->set_userdata('userData',$userData);
          }
          else
          {
             $data['userData'] = array();
          }

          if($this->user_model->email_exists($fbUserProfile['email']))
          {
            //redirect to profile page
            $_SESSION['userEmail'] = $fbUserProfile['email'];
            $_SESSION["isLoggedIn"] = TRUE;
            $_SESSION['inComplete'] = FALSE;

            $this->user_model->get_facebook_user();

            // redirect('login');
          }
          else
          {
            // $_SESSION['userEmail'] = $gpInfo['email'];
            $data['inCompleteFacebook'] = TRUE;
            $_SESSION['inComplete'] = TRUE;
            $_SESSION['facebooklogin'] = TRUE;
            $this->_show_page('login', $data);
          }
        }
      }

      if(isset($_POST['login']))
      {
        if($this->user_model->get_user())
        {
          $this->_show_page('loginsuccess');
        }
        else
        {
          $data['errorMessage'] = 'email and/or password is incorrect.';
          $data['loginURL'] = $this->google->loginURL();

          $this->_show_page('login', $data);
        }
      }
      else if(isset($_POST['login2']))
      {
        $this->form_validation->set_rules('postalCode', 'Postal Code', 'required|callback__check_postal_code');
        $this->form_validation->set_rules('phoneNumber', 'Phone Number', 'required|callback__check_phone_number');
        $this->form_validation->set_rules('city', 'City', 'required');

        $code = $this->input->get('code');

        if($this->form_validation->run() === FALSE )
        {
          $data['inCompleteFacebook'] = TRUE;

          $this->_show_page('login', $data);
        }
        else
        {
           $this->user_model->set_facebook_user();
           $_SESSION['inComplete'] = FALSE;
           $_SESSION['userEmail'] = $_SESSION['facebookEmail'];

           $city = filter_var($this->input->post('city'), FILTER_SANITIZE_STRING);
           $postalCode = filter_var($this->input->post('postalCode'), FILTER_SANITIZE_STRING);
           $phoneNumber = filter_var($this->input->post('phoneNumber'), FILTER_SANITIZE_NUMBER_INT);

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

           $data['phoneNumber'] = $phoneNumber;
           $data['city'] = $city;
           $data['postalCode'] = $postalCode;

           $data['boolFacebook'] = TRUE;
           $this->_show_page('loginsuccess', $data);

        }
      }
      else
      {
        if(!isset($_SESSION['facebookLogin']))
        {
          $data['loginURL'] = $this->google->loginURL();

          $this->_show_page('login', $data);
        }
      }
  }

    public function profile(){
        //redirect to login page if user not logged in
        if(!$this->session->userdata('loggedIn')){
            redirect('/login/');
        }

        //get user info from session
        $data['userData'] = $this->session->userdata('userData');

        //load user profile view
        $this->_show_page('profile',$data);
    }

    public function logout(){
        //delete login status & user info from session
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();

        //redirect to login page
        redirect('/login/');
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

  }

?>
