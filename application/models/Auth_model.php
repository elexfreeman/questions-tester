<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*Модель логинов*/
/*
 Описание глобалов
^Test.VACUsers("admin","group")="administrator"
^Test.VACUsers("admin","password")="!1qazxsw2"
^Test.VACUsers("admin","fullname")="Администратор"


 * */

class Auth_model extends CI_Model
{


    public $auth;


    public $GroupsTable = 'groups';


    public function __construct()
    {
        $this->TasksTable=$this->config->item('TasksTable');
        $this->UsersTable=$this->config->item('UsersTable');
        $this->UserTasksTable=$this->config->item('UsersTable');


        $this->load->library('elex');
        $this->dbMySQL = $this->load->database('default', TRUE);
        $this->load->helper('url');
        if($this->session->has_userdata('auth'))
        {
            $auth = $this->session->has_userdata('auth');
        }
        else
        {
            $auth=false;
        }
    }


//генератор паролей
    public function PassGen($max=10)
    {
        // Символы, которые будут использоваться в пароле.
        $chars="qazxswedcvfrtgbnhyujmkip23456789QAZXSWEDCVFRTGBNHYUJMKLP";
        // Количество символов в пароле.

        // Определяем количество символов в $chars
        $size=StrLen($chars)-1;

        // Определяем пустую переменную, в которую и будем записывать символы.
        $password=null;

        // Создаём пароль.
        while($max--)
            $password.=$chars[rand(0,$size)];

        // Выводим созданный пароль.
        return $password;
    }

    /*Проверка на существование юзера*/
    function IsUserExist($login)
    {
        $login=$this->security->xss_clean($login);
        $sql="select count(*) cc from ".$this->UsersTable." where login='".$login."'";

        $query = $this->dbMySQL->query($sql);
        $row=$query->result_array();
        $row = $row[0];
        if((int)$row['cc']>0) return true; else return false;
    }

    /*Вставляет юзера с рандомным паролем*/
    public function AddUser($login)
    {
        if(!$this->IsUserExist($login))
        {
            $login=$this->security->xss_clean($login);
            $data = array('login' => $login, 'password' => $this->PassGen());
            return $this->dbMySQL->query($this->dbMySQL->insert_string($this->UsersTable, $data));
        }
        else return false;
    }



    public function GetAllUsers()
    {
        $sql="select * from ".$this->UsersTable."  order by login";
        $query = $this->dbMySQL->query($sql);
        return $query->result_array();
    }

    public function UserInfo()
    {
        return $this->auth;
    }

    public function IsLogin()
    {
        if($this->session->has_userdata('auth'))
        {
            return true;
        }
        else return false;
    }



    /*Проверка на существование юзера*/
    public function  GetUserByNameAndPass($username,$password)
    {
        $res = new stdClass();
        $res->login = '0';
        $res->password = 0;

        $username=$this->security->xss_clean($username);
        $password=$this->security->xss_clean($password);
        $sql="select * from ".$this->UsersTable." where (login='$username') and (password='$password')";
      
        $query = $this->dbMySQL->query($sql);
        $row=$query->result();
        if(count($row)>0) return $row[0];else return $res;
    }


    /*Проверка на существование юзера*/
    public function  GetUserByName($username)
    {
        $res = new stdClass();


        $username=$this->security->xss_clean($username);
        $sql="select * from ".$this->UsersTable." where (login=".$this->dbMySQL->escape($username).")";

        $query = $this->dbMySQL->query($sql);
        $row=$query->result();
        if(count($row)>0) $res = $row[0];

        return $res;
    }

    /*выдает имя зареганого пользователя*/
    function GetloginUser()
    {
        if($this->IsLogin())
        {
            return $this->session->username;
        }
        else return false;
    }

    function GetLogoutUrl()
    {
        return base_url('auth/logout');
    }

    public function GetUserByID($user_id)
    {
        $user_id=(int)$user_id;
        $sql="select * from ".$this->UsersTable." where (id='$user_id')";

        $query = $this->dbMySQL->query($sql);
        $row=$query->result_array();
        if(count($row>0))
        {
            $res = $row[0];
            $res['users_roots'] = array();
            $sql="select * from users_roots where user_root_id = ".$user_id;
            $query = $this->dbMySQL->query($sql);
            foreach($query->result_array() as $r)
            {
                $res['users_roots'][]=$r['user_id'];
            }
            return $res;
        }

        else return false;
    }



    public function InsertUser($arg)
    {

        /*проверяем сущ юзера*/
        $user=$this->GetUserByName($arg['login']);
        $avatar='';

            /*нету добвляем*/
            if(((isset($_FILES['avatar']['name'])))and($_FILES['avatar']['name']!='')) {

                $rnd = $this->elex->PassGen();
                $uploadfile = $this->config->item('images_avatar_dir') . $rnd . '_' . basename($_FILES['avatar']['name']);

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)) {
                    /*Делаем превью*/
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $uploadfile;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 512;

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();
                    $avatar=$this->dbMySQL->escape($rnd . '_' . basename($_FILES['avatar']['name']));
                } else {
                    //error
                }
            }


            $sql = "INSERT INTO ".$this->UsersTable."
            (`id`,`login`,`password`,
            `otd`,`post`,`phone`,`group`,`fio`,`avatar`)
            VALUES (null
            ,".$this->dbMySQL->escape($arg['login'])."
            ,".$this->dbMySQL->escape($arg['password1'])."
            ,".$this->dbMySQL->escape($arg['otd'])."
            ,".$this->dbMySQL->escape($arg['post'])."
            ,".$this->dbMySQL->escape($arg['phone'])."
            ,".$this->dbMySQL->escape($arg['group'])."
            ,".$this->dbMySQL->escape($arg['fio'])."
            ,".$avatar."

            )";
            echo $sql;
            $this->dbMySQL->query($sql);

    }

    public function UpdateUser($user_id,$arg)
    {
        $error = array();
        $sql=array();

        if ((isset($arg['password1']))and(isset($arg['password2']))
            and($arg['password1']==$arg['password2'])) {
            $sql[] = "UPDATE " . $this->UsersTable . " SET password =" . $this->dbMySQL->escape($arg['password1'])
                . " where (id=" . ((int)($user_id)) . ")";
        }
        else $error['password']=1;

        if (isset($arg['fio'])) {
            $sql[] = "UPDATE " . $this->UsersTable . " SET fio =" . $this->dbMySQL->escape($arg['fio'])
                . " where (id=" . ((int)($user_id)) . ")";
        }

        if (isset($arg['otd'])) {
            $sql[] = "UPDATE " . $this->UsersTable . " SET otd =" . $this->dbMySQL->escape($arg['otd'])
                . " where (id=" . ((int)($user_id)) . ")";
        }
        if (isset($arg['post'])) {
            $sql[] = "UPDATE " . $this->UsersTable . " SET post =" . $this->dbMySQL->escape($arg['post'])
                . " where (id=" . ((int)($user_id)) . ")";
        }
        if (isset($arg['phone'])) {
            $sql[] = "UPDATE " . $this->UsersTable . " SET phone =" . $this->dbMySQL->escape($arg['phone'])
                . " where (id=" . ((int)($user_id)) . ")";
        }
        if (isset($arg['group'])) {
            $sql[] = "UPDATE " . $this->UsersTable . " SET `group` =" . $this->dbMySQL->escape($arg['group'])
                . " where (id=" . ((int)($user_id)) . ")";
        }

        if(((isset($_FILES['avatar']['name'])))and($_FILES['avatar']['name']!='')) {

            $rnd = $this->elex->PassGen();
            $uploadfile = $this->config->item('images_avatar_dir') . $rnd . '_' . basename($_FILES['avatar']['name']);

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)) {
                /*Делаем превью*/
                $config['image_library'] = 'gd2';
                $config['source_image'] = $uploadfile;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 512;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                /*ЗАписываем в базу*/
                $sql[] = "UPDATE " . $this->UsersTable . " SET avatar =" . $this->dbMySQL->escape($rnd . '_' . basename($_FILES['avatar']['name']))
                    . " where id=" . ((int)($user_id));
            } else {
                //error
            }
        }

        /*если есть ошибки выдаеи и не сохр*/
        if (count($error)>0) return $error; else
        {
            foreach($sql as $s)
            {
                $this->dbMySQL->query($s);

            }
        }
        return $error;
    }

    public function IsAdmin()
    {
        if($this->session->userdata('auth')->group=='1') return true;else return false;
    }

    public function GetLoginUserGroup()
    {
        $sql="select * from ".$this->UsersTable." where (id='".$this->session->userdata('auth')->id."')";

        $query = $this->dbMySQL->query($sql);
        $row=$query->result_array();
        $row = $row[0];
        return $row['group'];
    }

    public function GetGroups()
    {
        $sql = "select * from ".$this->GroupsTable." order by caption";
        $query = $this->dbMySQL->query($sql);
        return $query->result_array();

    }


}