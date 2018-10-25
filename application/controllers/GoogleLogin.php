<?php

  class GoogleLogin extends CI_Controller
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
    }


    public function index()
    {
      if(isset($_SESSION['googleLogin']) && $_SESSION['googleLogin'] == TRUE)
      {
        // $data['GoogleLog'] = TRUE;
        // $data['google'] = TRUE;
        //
        // $this->_show_page('googlelogin', $data);

        $this->_show_page('servicebooking');

      }
      else if(isset($_SESSION['google']) && $_SESSION['google'] == TRUE)
      {
        $this->_show_page('googleloginredirect');
      }
      else
      {
        show_404();
      }
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

  }
?>
