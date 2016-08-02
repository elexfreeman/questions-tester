<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.05.2016
 * Time: 17:38
 */
class Elex
{

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



    /*выдает tmb картинки по имени*/
    public function GetImgTmb($image)
    {
        if($image!='')
        {
            $avatar = pathinfo($image);
            $avatar_name = basename($image,'.'.$avatar['extension']);
            $avatar_ext = $avatar['extension'];
            return $avatar_name."_thumb.".$avatar_ext;;
        }
        else
            return '';


    }



}