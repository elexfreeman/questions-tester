<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*Модель логинов*/
/*
 Описание глобалов
^Test.VACUsers("admin","group")="administrator"
^Test.VACUsers("admin","password")="!1qazxsw2"
^Test.VACUsers("admin","fullname")="Администратор"


 * */

class Tasks_model extends CI_Model
{


    public $auth;

    public $TasksTable ;
    public $UserTasksTable;
    public $UsersTable;


    public function __construct()
    {
        $this->dbMySQL = $this->load->database('default', TRUE);
        $this->load->helper('url');
        $this->TasksTable=$this->config->item('TasksTable');
        $this->UsersTable=$this->config->item('UsersTable');
        $this->UserTasksTable=$this->config->item('UserTasksTable');
    }

    /*выдает ответственных задачи*/
    /*todo написать с join users*/
    public function GetTaskUsers($task_id)
    {
        $task_id=(int)$task_id;
        //добавил запрос на получение пользователей
        $sql="select u.id from ".$this->UserTasksTable."
        INNER JOIN "."$this->UsersTable"." as u ON user_id = u.id".
            " where task_id=".$task_id;
        $query = $this->dbMySQL->query($sql);

        $row = $query->result_array();
        $res=[];
        foreach($row as $r)
        {
            $res[]=$r['id'];
        }
        return $res;
    }

    /*выдает ответственных задачи с именами*/
    public function GetMoreTaskUsers($task_id)
    {
        $task_id=(int)$task_id;
        //добавил запрос на получение пользователей
        $sql="select u.login, u.fio from ".$this->UserTasksTable."
        INNER JOIN "."$this->UsersTable"." as u ON user_id = u.id".
            " where task_id=".$task_id;
        $query = $this->dbMySQL->query($sql);

        $row = $query->result_array();
        /*$res=[];
        foreach($row as $r)
        {
            $res[]=$r['id'];
        }*/
        return $row;
    }

    /*получает задания пользователя*/
    public function GetUserTasks($user_id)
    {
        $user_id=(int)$user_id;
        //добавил запрос на получение пользователей
        $sql="select t.task_id, ts.caption from ".$this->UserTasksTable." t
        INNER JOIN "."$this->UsersTable"." as u ON user_id = u.id
        JOIN ".$this->TasksTable." ts
        ON ts.id=t.task_id
        where u.id=".$user_id;
        $query = $this->dbMySQL->query($sql);

        return  $query->result_array();
    }

    /*выдает запись или все записи*/
    public function Get($id='')
    {
        if($id=='')
        {
            /*todo: сделать join юзеров*/
            $sql="select * from ".$this->TasksTable."  order by id";
            $query = $this->dbMySQL->query($sql);
            $row = $query->result_array();

            foreach($row as $key=>$value)
            {
                $row[$key]['users'] = $this->GetMoreTaskUsers($row[$key]['id']);
            }
            return $row;
        }
        else
        {
            $id=(int)$id;
            $sql="select * from ".$this->TasksTable." where id=".$id;
            $query = $this->dbMySQL->query($sql);
            $row =  $query->result_array();
            if(count($row)>0) return $row[0];else return false;
        }
    }

    /*Добавляет данные в модель*/
    public function add($arg)
    {
        $query = "INSERT INTO ".$this->TasksTable."(`id`,`caption`) VALUES (NULL,".$this->dbMySQL->escape($arg['caption']).")";

        $this->dbMySQL->query($query);

        $id = $this->dbMySQL->insert_id();

        foreach($arg['users'] as $user) {
            $sql[] = "INSERT INTO " . $this->UserTasksTable . "(user_id, task_id) VALUES(" . $user . "," . $this->dbMySQL->escape($id) . ")";
        }

        foreach ($sql as $s ) {
            $this->dbMySQL->query($s);
        }
    }

    /*Обновляет данные по модели*/
    public function update($arg)
    {
        $arg['task_id']=(int)$arg['task_id'];
        $sql=array();
        $sql[] = "DELETE FROM ".$this ->UserTasksTable." WHERE task_id = ".$arg['task_id'];
        //$this->dbMySQL->query($sql);

        foreach($arg['users'] as $user) {
            $sql[] = "INSERT INTO " . $this->UserTasksTable . "(user_id, task_id) VALUES(" . $user . "," . $this->dbMySQL->escape($arg['task_id']) . ")";
            //$this->dbMySQL->query($sql);
        }

        foreach ($sql as $s ) {
            $this->dbMySQL->query($s);
        }
    }




}