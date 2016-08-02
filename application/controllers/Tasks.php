<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*контроллер главной страницы*/
class Tasks extends CI_Controller {

    /*тут хранятся настройки, закгружаются в конструкторе*/
    public $settings;
    public $data;

    public function __construct()
    {

        parent::__construct();
        /*Загружаем  библиотеку сессий*/
        $this->load->library('session');

        /*Загружаем модели*/

        /*Закгружаем хелперы*/
        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->model('auth_model');
        $this->load->model('tasks_model');

        $this->data=array();
        $this->data['auth'] = $this->session->userdata('auth');

    }

    public function add()
    {
        if(($this->auth_model->IsLogin())and($this->auth_model->IsAdmin()))
        {
            If((isset($_POST['action'])and($_POST['action']=='add')))
            {
                print_r($_POST);
                $this->tasks_model->add($_POST);
                header('Location: '.base_url('tasks'));
                exit;
            }
            else
            {
                $this->data['users'] = $this->auth_model->GetAllUsers();
                $this->data['page']='tasks';
                $this->load->view('head', $this->data);
                $this->load->view('navbar/navbar', $this->data);
                $this->load->view('tasks/add', $this->data);
                $this->data['users'] = $this->auth_model->GetAllUsers();

                $this->load->view('footer', $this->data);
            }

        }
    }

    public function edit($id)
    {
        if((isset($_POST['action']))and($_POST['action']=='task-update'))
        {
            print_r($_POST);
            $this->tasks_model->update($_POST);
            header('Location: '.base_url('tasks'));
            exit;
        }
        else
        {
            $this->data['users'] = $this->auth_model->GetAllUsers();
            $this->load->view('head', $this->data);

            $this->load->view('navbar/navbar', $this->data);
            $this->data['task'] = $this->tasks_model->Get($id);
            $this->data['task_users'] = $this->tasks_model->GetTaskUsers($id);
            $this->data['task_id'] = $id;
            /*шаблон страницы*/
            $this->load->view('tasks/edit', $this->data);
            $this->load->view('footer', $this->data);
        }
    }

    public function tasks_user()
    {
        /*выводим список задач*/
        $this->data['tasks'] = $this->tasks_model->Get();
        $ut = $this->tasks_model-> GetTaskUsers(1);
        $this->load->view('head', $this->data);
        $this->data['users'] = $this->auth_model->GetAllUsers();
        $this->load->view('navbar/navbar_user', $this->data);
        $this->load->view('tasks/tasks_user', $this->data);
        $this->load->view('footer', $this->data);
    }

    public function tasks_admin()
    {
        /*выводим список задач*/
        $this->data['tasks'] = $this->tasks_model->Get();
        $ut = $this->tasks_model-> GetTaskUsers(1);
        $this->load->view('head', $this->data);
        $this->data['users'] = $this->auth_model->GetAllUsers();
        $this->load->view('navbar/navbar', $this->data);
        $this->load->view('tasks/tasks', $this->data);
        $this->load->view('footer', $this->data);
    }


    public function task_tikets($task_id)
    {
        $this->data['task'] = $this->tasks_model->Get($task_id);

        $this->load->view('head', $this->data);
        $this->load->view('navbar/navbar_user', $this->data);
        $this->load->view('tasks/head', $this->data);
        $this->load->view('tasks/task_tikets', $this->data);
        $this->load->view('footer', $this->data);
    }

	public function index($id="")
	{
        /*переменные для языков описанны тут: \application\language\*/
        $this->data['page']='tasks';
        if( $this->auth_model->IsLogin())
        {
            if($id=="")
            {
                /*Ждя админа*/
                if($this->auth_model->IsAdmin())
                {
                    $this->tasks_admin();
                }
                /*Для юзера*/
                else
                {
                   $this->tasks_user();
                }

            }
            /*добавление задачи*/
            elseif($id=='add')
            {
                if($this->auth_model->IsAdmin()) $this->add();
                else
                {
                    header('Location: '.base_url('tasks'));
                    exit;
                }
            }
            else
            {
                /*если нет такой задачи то 404*/
                if($this->tasks_model->Get($id)==false)
                {
                    $this->load->view('head', $this->data);
                    show_404();
                    $this->load->view('footer', $this->data);
                }
                else
                {
                    /*Для админа это редактирование таска*/
                    if($this->auth_model->IsAdmin())
                    {
                       $this->edit($id);
                    }
                    else
                    {
                        /*Для бзера просмотр тикетов задачи*/
                        $this->task_tikets($id);
                    }
                }
            }
        }
        else
        {
            header('Location: '.base_url('auth'));
            exit;
        }
	}


}
