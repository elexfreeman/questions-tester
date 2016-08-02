<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*Модель логинов*/


class Questions_model extends CI_Model
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
        $this->LecturesTable=$this->config->item('LecturesTable');
    }



    /*Добавляет данные в модель*/
    public function add($arg)
    {
        if(isset($arg['date_start']))
        {
            $arg['date_start'] = strtotime( $arg['date_start'] );
            $arg['date_start'] = date( 'Y-m-d H:i:s', $arg['date_start'] );
        }

        $video='';

        if(((isset($_FILES['video']['name'])))and($_FILES['video']['name']!=''))
        {
            $rnd=$this->elex->PassGen();
            $uploadfile = $this->config->item('video_dir') . $rnd.'_'.basename($_FILES['video']['name']);

            $video = $rnd.'_'.basename($_FILES['video']['name']);

            if (move_uploaded_file($_FILES['video']['tmp_name'],$uploadfile))
            {
                /*здесь можно сжать видос*/
            }
            else
            {
                //error
            }
        }

        $arg['course_id']=(int)$arg['course_id'];
        $arg['order_number']=(int)$arg['order_number'];

        $query = "INSERT INTO ".$this->LecturesTable."(`id`,`caption`,`description`,`date_start`,`video`,`course_id`,`order_number`)
        VALUES
        (NULL
        ,".$this->dbMySQL->escape($arg['caption'])."

        ,".$this->dbMySQL->escape($arg['description'])."
        ,'".$arg['date_start']."'
        ,'".$video."'
        ,".$this->dbMySQL->escape($arg['course_id'])."
        ,'".$arg['order_number']."'
        )";

        $this->dbMySQL->query($query);

        return $this->dbMySQL->insert_id();


    }

    /*Обновляет данные по модели*/
    public function update($arg)
    {
        $sql=array();

        if(isset($arg['caption']))
        {
            $sql[]="UPDATE ".$this->LecturesTable." SET caption =".$this->dbMySQL->escape($arg['caption'])
                ." where (id=".((int)$arg['lecture_id']).")and(course_id=".((int)$arg['course_id']).");";
        }
        if(isset($arg['description']))
        {
            $sql[]="UPDATE ".$this->LecturesTable." SET description =".$this->dbMySQL->escape($arg['description'])
                ." where (id=".((int)$arg['lecture_id']).")and(course_id=".((int)$arg['course_id']).");";
        }
        if(isset($arg['date_start']))
        {
            $arg['date_start'] = strtotime( $arg['date_start'] );
            $arg['date_start'] = date( 'Y-m-d H:i:s', $arg['date_start'] );
            $sql[]="UPDATE ".$this->LecturesTable." SET date_start =".$this->dbMySQL->escape($arg['date_start'])
                ." where (id=".((int)$arg['lecture_id']).")and(course_id=".((int)$arg['course_id']).");";
        }
        if(isset($arg['video']))
        {
            $sql[]="UPDATE ".$this->LecturesTable." SET video =".$this->dbMySQL->escape($arg['video'])
                ." where (id=".((int)$arg['lecture_id']).")and(course_id=".((int)$arg['course_id']).");";
        }

        if(isset($arg['order_number']))
        {
            $sql[]="UPDATE ".$this->LecturesTable." SET order_number =".$this->dbMySQL->escape($arg['order_number'])
                ." where (id=".((int)$arg['lecture_id']).")and(course_id=".((int)$arg['course_id']).");";
        }

        $video='';

        if(((isset($_FILES['video']['name'])))and($_FILES['video']['name']!=''))
        {
            $rnd=$this->elex->PassGen();
            $uploadfile = $this->config->item('video_dir') . $rnd.'_'.basename($_FILES['video']['name']);

            $video = $rnd.'_'.basename($_FILES['video']['name']);


            if (move_uploaded_file($_FILES['video']['tmp_name'],$uploadfile))
            {
                /*здесь можно сжать видос*/
                $sql[]="UPDATE ".$this->LecturesTable." SET video =".$this->dbMySQL->escape($video)
                    ." where (id=".((int)$arg['lecture_id']).")and(course_id=".((int)$arg['course_id']).");";
            }
            else
            {
                //error
            }
        }

        foreach ($sql as $s ) {
            $this->dbMySQL->query($s);
        }
    }

    public function Get($course_id,$lecture_id="")
    {
        $course_id=(int)$course_id;
        if($lecture_id=="")
        {
            $sql = "select * from ".$this->LecturesTable." where course_id=".$course_id." order by order_number,id";
            $query = $this->dbMySQL->query($sql);
            return $query->result_array();
        }
        else
        {
            $id=(int)$lecture_id;
            $sql="select * from ".$this->LecturesTable." where (course_id=".$course_id.")and(id=".$lecture_id.")";

            $query = $this->dbMySQL->query($sql);
            $row =  $query->result_array();

            if(count($row)>0) return $row[0];else return false;
        }
    }

}