<?php namespace App\Controllers;

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    //Exibir informaçoes sobre o sistema
    public function index(){

          $this->load->model('Banner_model');
          $dados['banner'] = $this->Banner_model->get_banner();
          $this->load->view('index',$dados);


    }


}
