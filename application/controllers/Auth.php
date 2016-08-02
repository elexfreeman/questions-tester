<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


    public $data;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('auth_model');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index()
    {
        if($this->auth_model->IsLogin())
        {
            header('Location: '.base_url());
            exit;
        }
        else
        {
            $this->data['error']='1';
            $this->load->view('head');
            $this->load->view('auth/login',$this->data);
            $this->load->view('footer');
       }
    }


    /*Событие входа пользователя*/
    public function login()
    {
        $auth=$this->auth_model->GetUserByNameAndPass($_POST['username'],$_POST['password']);

       if(strcmp($auth->login,$_POST['username'])==0)
        {

          $this->session->set_userdata('auth', $auth);
           header('Location: '.base_url("users/".$this->session->userdata('auth')->login));
           exit;

        }
        else
        {
            header('Location: '.base_url('auth'));
            exit;
        }
    }

    public function users($user_id='')
    {
        $this->data['page']='users';
        if( $this->auth_model->IsLogin())
        {
            if($user_id=='')
            {
                $this->data['auth']=$this->session->userdata('auth');
                $this->load->view('nf_head',$this->data);
                $this->load->view('navbar/nf_admin_topnav',$this->data);

                if($this->session->userdata('auth')->login=='admin')
                {
                    $this->data['users'] = $this->auth_model->GetAllUsers();
                }
                else
                {
                    header('Location: '.base_url('auth'));
                    exit;
                }

                /*шаблон страницы*/
                $this->data['users']=$this->auth_model->GetAllUsers();
                $this->load->view('auth/users',$this->data);
                $this->load->view('navbar/nf_admin',$this->data);
                $this->load->view('nf_footer',$this->data);
            }
            else
            {
                if(!empty($_POST))
                {
                    $this->auth_model->UpdateUser($user_id,$_POST);
                    header('Location: '.base_url('auth/users'));
                    exit;
                }
                else
                {
                    $this->data['auth']=$this->session->userdata('auth');
                    $this->load->view('nf_head',$this->data);
                    $this->load->view('navbar/nf_admin_topnav',$this->data);
                    $this->data['user'] = $this->auth_model->GetUserByID($user_id);

                    /*Загруаем пациентов под ЛПУ*/
                    if($this->session->userdata('auth')->login=='admin')
                    {
                        $this->data['users'] = $this->auth_model->GetAllUsers();
                    }
                    else
                    {
                        header('Location: '.base_url('auth'));
                        exit;
                    }

                    /*шаблон страницы*/
                    $this->data['users']=$this->auth_model->GetAllUsers();
                    $this->load->view('user_edit_form',$this->data);
                    $this->load->view('navbar/nf_admin',$this->data);
                    $this->load->view('nf_footer',$this->data);
                }

            }
        }
        else
        {
            header('Location: '.base_url('auth'));
            exit;
        }
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        header('Location: '.base_url('auth'));
        exit;
    }
}
