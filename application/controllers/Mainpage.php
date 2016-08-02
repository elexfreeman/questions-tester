<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*контроллер главной страницы*/
class Mainpage extends CI_Controller {

    /*тут хранятся настройки, закгружаются в конструкторе*/
    public $settings;
    public $data;

    public function __construct()
    {
        parent::__construct();

        parent::__construct();
        /*Загружаем  библиотеку сессий*/
        $this->load->library('session');

        /*Загружаем модели*/

        /*Закгружаем хелперы*/
        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->model('auth_model');

    }

	public function index()
	{
        /*переменные для языков описанны тут: \application\language\*/
        $this->data['page']='main';
        /*если залогинен*/
        if( $this->auth_model->IsLogin())
        {

                header('Location: '.base_url("users/".$this->session->userdata('auth')->login));
                exit;
        }
        else
        {
            header('Location: '.base_url('auth'));
            exit;
        }
	}




}
