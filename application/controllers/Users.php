<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*контроллер главной страницы*/
class Users extends CI_Controller {

    /*тут хранятся настройки, закгружаются в конструкторе*/
    public $settings;
    public $data;

    public function __construct()
    {
        parent::__construct();

        /*Загружаем  библиотеку сессий*/
        $this->load->library('session');
        $this->load->library('form_validation');
        /*Загружаем модели*/
        $this->load->model('auth_model');
        $this->load->model('tasks_model');
        /*Закгружаем хелперы*/
        $this->load->helper('form');
        $this->load->helper('url');
        $this->data['default_user_avatar'] = $this->config->item('default_user_avatar');
        $this->data['groups'] = $this->auth_model->GetGroups();

        $this->data['images_avatar'] = $this->config->item('images_avatar');
    }

    function login_check($user_login)
    {
        $user=$this->auth_model->GetUserByName($user_login);

        if (isset($user->login))
        {
            $this->form_validation->set_message('login_check', 'Такой пользователь существует!!!');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /*добавление юзера*/
    public function add()
    {
        $this->form_validation->set_rules('login', 'login', 'callback_login_check');
        $this->form_validation->set_rules('password1', 'password1', 'required');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password1]');
        $this->form_validation->set_rules('fio', 'fio', 'required');
        $this->form_validation->set_message('matches', 'Пароли не совпадают');
        $this->form_validation->set_message('login_check', 'Такой пользователь существует!!!');

        $this->data['page']='users';

        if(( $this->auth_model->IsLogin())and( $this->auth_model->IsAdmin()))
        {
            if ($this->form_validation->run() == TRUE)
            {
                $this->auth_model->InsertUser($_POST);
                header('Location: '.base_url('users'));
                exit;
            }
            else
            {

                $this->data['auth'] = $this->session->userdata('auth');
                $this->data['user_name'] = $this->data['auth']->login;

                $this->data['tasks'] = $this->tasks_model->Get();
                $this->load->view('head', $this->data);
                $this->load->view('navbar/navbar', $this->data);

                /*шаблон страницы*/
                $this->load->view('user/add', $this->data);
                $this->load->view('footer', $this->data);
            }

        }
    }

    public function Users()
    {
        /*выводим список пользователей*/
        $this->data['auth'] = $this->session->userdata('auth');
        $this->data['users'] = $this->auth_model->GetAllUsers();
        $this->data['tasks'] = $this->tasks_model->Get();

        $this->load->view('head', $this->data);
        $this->load->view('navbar/navbar', $this->data);


        /*шаблон страницы*/
        $this->load->view('user/users', $this->data);
        $this->load->view('footer', $this->data);
    }

    public function edit($user_name)
    {
        if((isset($_POST['action']))and($_POST['action']=='update'))
        {

            $user_id = $this->auth_model->GetUserByName($user_name);
            $user_id=$user_id->id;
            $error = $this->auth_model->UpdateUser($user_id,$_POST);
            if(count($error)>0)
            {
                $this->data['auth'] = $this->session->userdata('auth');
                $this->load->view('head', $this->data);
                $this->load->view('navbar/navbar', $this->data);
                $this->data['tasks'] = $this->tasks_model->Get();
                $this->data['user'] = $this->auth_model->GetUserByName($user_name);
                $this->data['error'] = $error;
                //$this->user

                /*шаблон страницы*/
                $this->load->view('user/edit', $this->data);
                $this->load->view('footer', $this->data);
            }
            else
            {
                header('Location: '.base_url('users'));
                exit;
            }
        }
        else
        {
            $this->data['auth'] = $this->session->userdata('auth');
            $this->load->view('head', $this->data);
            $this->load->view('navbar/navbar', $this->data);
            $this->data['tasks'] = $this->tasks_model->Get();
            $this->data['user'] = $this->auth_model->GetUserByName($user_name);
            $this->data['user_tasks'] = $this->auth_model->GetUserByName($user_name);
            //$this->user
            $this->data['default_user_avatar'] = $this->config->item('default_user_avatar');
            /*шаблон страницы*/
            $this->load->view('user/edit', $this->data);
            $this->load->view('footer', $this->data);
        }

    }


    public function user_page($user)
    {
        $this->data['auth'] = $this->session->userdata('auth');
        $this->data['user'] = $user;
        $this->data['user_name'] = $user->login;

        /*Проверяем юзера*/
        /*если админ*/
        if($this->auth_model->IsAdmin())
        {
            $this->load->view('head', $this->data);
            $this->load->view('navbar/navbar', $this->data);

            /*todo добавление курсов пользователю*/
            /*todo просмотр прогресса курса у этого юзера*/
            /*todo удаление курса у пользователя*/

            /*шаблон страницы*/
            $this->load->view('user/user_page', $this->data);
            $this->load->view('footer', $this->data);
        }
        elseif($this->data['auth']->login==$user->login)
        {
            $this->load->view('head', $this->data);
            $this->load->view('navbar/navbar', $this->data);

            /*шаблон страницы*/
            /*todo просмотр прогресса курса у этого юзера*/
            $this->load->view('user/user_page_user', $this->data);
            $this->load->view('footer', $this->data);
        }
        /*не даем переходить на стр юзера*/
        else
        {
            header('Location: '.base_url("users/".$this->session->userdata('auth')->login));
            exit;
        }
    }

	public function index($user_name="",$arg='')
	{

        /*переменные для языков описанны тут: \application\language\*/
        $this->data['page']='users';

        if( $this->auth_model->IsLogin())
        {
            $this->data['auth'] = $this->session->userdata('auth');
            /*Если юзер не прописан рндиректим на стр теуккущего юзера*/
            $user = $this->auth_model->GetUserByName($user_name);
            if($user_name=="")
            {
                if($this->auth_model->IsAdmin())
                {
                   $this->Users();
                }
                else
                {
                    header('Location: '.base_url("users/".$this->session->userdata('auth')->login));
                    exit;
                }
            }
            elseif($user_name=='add')
            {
                $this->add();
            }
            elseif($arg=='edit')
            {
                $this->edit($user_name);
            }
            elseif($user->login!='0')
            {
               $this->user_page($user);
            }
            else
            {
                $this->load->view('head', $this->data);
                show_404();
                $this->load->view('footer', $this->data);
            }

        }
        else
        {
            header('Location: '.base_url('auth'));
            exit;
        }
	}


}
