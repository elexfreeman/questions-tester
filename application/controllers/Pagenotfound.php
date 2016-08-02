<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*контроллер главной страницы*/
class Pagenotfound extends CI_Controller {

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
    }

    public function index($user="")
    {

        /*переменные для языков описанны тут: \application\language\*/
        $this->data['page'] = '404';


        $this->data['auth'] = '';
        $this->data['user'] = '';

        $this->load->view('head', $this->data);

        /*шаблон страницы*/
        $this->load->view('errors/html/error_404', $this->data);
        $this->load->view('footer', $this->data);

    }




}
