<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*контроллер главной страницы*/
class Courses extends CI_Controller {

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
        $this->load->model('courses_model');
        $this->load->model('lectures_model');

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
                $course_id = $this->courses_model->add($_POST);
                header('Location: '.base_url('courses/ '.$course_id));
                exit;
            }
            else
            {
                $this->data['page']='courses';
                $this->load->view('head', $this->data);
                $this->load->view('navbar/navbar', $this->data);
                $this->load->view('courses/add', $this->data);
                $this->load->view('footer', $this->data);
            }

        }
    }

    public function edit($id)
    {
        if((isset($_POST['action']))and($_POST['action']=='update'))
        {
            print_r($_POST);
            $this->courses_model->update($_POST);
            header('Location: '.base_url('courses'));
            exit;
        }
        else
        {

            $this->load->view('head', $this->data);

            $this->load->view('navbar/navbar', $this->data);
            $this->data['course'] = $this->courses_model->Get($id);

            $this->data['course_id'] = $id;
            /*шаблон страницы*/
            $this->load->view('courses/edit', $this->data);
            $this->load->view('footer', $this->data);
        }
    }

    public function courses_user()
    {
        /*выводим список задач*/
        $this->data['tasks'] = $this->courses_model->Get();

        $this->load->view('head', $this->data);
        $this->data['users'] = $this->auth_model->GetAllUsers();
        $this->load->view('navbar/navbar_user', $this->data);
        $this->load->view('tasks/tasks_user', $this->data);
        $this->load->view('footer', $this->data);
    }

    public function courses_admin()
    {
        /*выводим список задач*/
        $this->data['courses'] = $this->courses_model->Get();

        $this->load->view('head', $this->data);
        $this->data['users'] = $this->auth_model->GetAllUsers();
        $this->load->view('navbar/navbar', $this->data);
        $this->load->view('courses/index', $this->data);
        $this->load->view('footer', $this->data);
    }




    public function lecture_view($course_id,$lecture_id)
    {
        $this->load->view('head', $this->data);

        $this->load->view('navbar/navbar', $this->data);
        $this->data['course'] = $this->courses_model->Get($course_id);

        $this->data['course_id'] = $course_id;
        /*шаблон страницы*/
        $this->load->view('lecture/add', $this->data);
        $this->load->view('footer', $this->data);
    }

    public function lecture_view_user($course_id,$lecture_id)
    {

    }

    public function lecture_add($course_id)
    {
        if((isset($_POST['action']))and($_POST['action']=='lecture_add'))
        {
            $this->lectures_model->add($_POST);
            header('Location: '.base_url('courses/'.$course_id));
            exit;
        }
        else
        {
            $this->load->view('head', $this->data);

            $this->load->view('navbar/navbar', $this->data);
            $this->data['course'] = $this->courses_model->Get($course_id);

            $this->data['course_id'] = $course_id;
            /*шаблон страницы*/
            $this->load->view('lecture/add', $this->data);
            $this->load->view('footer', $this->data);
        }

    }

    public function lecture_edit($course_id,$lecture_id)
    {
        if((isset($_POST['action']))and($_POST['action']=='lecture_update'))
        {
            $this->lectures_model->update($_POST);
            header('Location: '.base_url('courses/'.$course_id));
            exit;
        }
        else
        {
            $this->load->view('head', $this->data);

            $this->load->view('navbar/navbar', $this->data);
            $this->data['course'] = $this->courses_model->Get($course_id);
            $this->data['lecture'] = $this->lectures_model->Get($course_id,$lecture_id);

            $this->data['course_id'] = $course_id;
            /*шаблон страницы*/
            $this->load->view('lecture/edit', $this->data);
            $this->load->view('footer', $this->data);
        }
    }


    /*Добавление вопроса тестирования к лекции*/
    function QuestionAdd($lecture_id)
    {
        $this->data['lecture_id']=$lecture_id;
        $this->load->view('head', $this->data);

        $this->load->view('navbar/navbar', $this->data);

        /*шаблон страницы*/
        $this->load->view('questions/add', $this->data);
        $this->load->view('footer', $this->data);
    }

    /*редактирование вопроса тестирования*/
    function QuestionEdit($lecture_id,$question_id)
    {

    }


	public function index($id="",$lecture_id="",$question_id="")
	{
        /*переменные для языков описанны тут: \application\language\*/
        $this->data['page']='courses';
        if( $this->auth_model->IsLogin())
        {
            if($id=="")
            {
                /*Ждя админа*/
                if($this->auth_model->IsAdmin())
                {
                    $this->courses_admin();
                }
                /*Для юзера*/
                else
                {
                   $this->courses_user();
                }
            }
            /*добавление задачи*/
            elseif($id=='add')
            {
                if($this->auth_model->IsAdmin()) $this->add();
                else
                {
                    header('Location: '.base_url('courses'));
                    exit;
                }
            }
            else
            {
                /*если нет такой задачи то 404*/
                $this->data['course']=$this->courses_model->Get($id);
                if($this->data['course']==false)
                {
                    $this->load->view('head', $this->data);
                    show_404();
                    $this->load->view('footer', $this->data);
                }
                else
                {
                    /*Если есть лекции в урле*/
                    if((isset($lecture_id))and($lecture_id!=''))
                    {
                        if($lecture_id=='add')
                        {
                            /*Для админа это редактирование таска*/
                            if($this->auth_model->IsAdmin())
                            {
                                $this->lecture_add($id);
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
                            /*Если есть инфа по вопросам*/
                            if((isset($question_id))and($question_id!=''))
                            {
                                /*Для админа это редактирование вопроса*/
                                if($this->auth_model->IsAdmin())
                                {
                                    if($question_id=='add')
                                    {
                                        $this->QuestionAdd($lecture_id);
                                    }
                                    else
                                    {
                                        $this->QuestionEdit($lecture_id,$question_id);
                                    }
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
                                /*Для админа это редактирование таска*/
                                if($this->auth_model->IsAdmin())
                                {
                                    $this->lecture_edit($id,$lecture_id);
                                }
                                else
                                {
                                    $this->lecture_view_user($id,$lecture_id);
                                }
                            }

                        }

                    }
                    else
                    {
                        /*Редактирование курса и добавление лекций*/
                        /*Для админа это редактирование таска*/
                        if($this->auth_model->IsAdmin())
                        {
                            $this->data['lectures'] = $this->lectures_model->Get($id);
                            $this->edit($id);
                        }
                        else
                        {

                        }
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
