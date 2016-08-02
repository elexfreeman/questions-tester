<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*Модель логинов*/
/*
 Описание глобалов
^Test.VACUsers("admin","group")="administrator"
^Test.VACUsers("admin","password")="!1qazxsw2"
^Test.VACUsers("admin","fullname")="Администратор"


 * */

class Courses_model extends CI_Model
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
        $this->CoursesTable=$this->config->item('CoursesTable');
    }



    /*Добавляет данные в модель*/
    public function add($arg)
    {
        $query = "INSERT INTO ".$this->CoursesTable."(`id`,`caption`) VALUES (NULL,".$this->dbMySQL->escape($arg['caption']).")";

        $this->dbMySQL->query($query);

        return $this->dbMySQL->insert_id();


    }

    /*Обновляет данные по модели*/
    public function update($arg)
    {
        $sql=array();

        if(isset($arg['caption']))
        {
            $sql[]="UPDATE ".$this->CoursesTable." SET caption =".$this->dbMySQL->escape($arg['caption'])
                ." where (id=".((int)$arg['id']).");";
        }

        foreach ($sql as $s ) {
            $this->dbMySQL->query($s);
        }
    }

    public function Get($id="")
    {
        if($id=="")
        {
            $sql = "select * from ".$this->CoursesTable;
            $query = $this->dbMySQL->query($sql);
            return $query->result_array();
        }
        else
        {
            $id=(int)$id;
            $sql="select * from ".$this->CoursesTable." where id=".$id;

            $query = $this->dbMySQL->query($sql);
            $row =  $query->result_array();

            if(count($row)>0) return $row[0];else return false;
        }
    }

}