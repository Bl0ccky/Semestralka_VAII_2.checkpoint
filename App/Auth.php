<?php

namespace App;

use App\Models\JoinedTour;
use App\Models\User;

class Auth
{

    public static function findIdByEmail($email)
    {
        foreach (User::getAll() as $user)
        {
            if($user->getEmail() == $email)
            {
                return $user->getId();
            }
        }
        return 0;
    }
    
    public static function login($email, $password)
    {
        $id= self::findIdByEmail($email);
        if($id != 0)
        {
            $user = User::getOne($id);
            if($user->getEmail() == $email && $user->getPassword() == $password)
            {

                $_SESSION['id_user'] = $id;
                $_SESSION['email'] = $email;
                return true;
            }
            else
            {
                return false;
            }
        }

    }

    public static function logout()
    {
        unset($_SESSION['email']);   //zrusim session, nebudem prihlaseny
        session_destroy();
    }

    public static function isLogged()
    {
        return isset($_SESSION['email']);
    }

    public static function isAdmin($email)
    {
        $id= self::findIdByEmail($email);
        if($id != 0)
        {
            if(User::getOne($id)->getAuthorization() == 'admin')
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    }

    public static function getId()
    {
        return (Auth::isLogged() ? $_SESSION['id_user'] : "");
    }

    public static function alreadyBookedTour($id_tour)
    {
        $id_user = self::getId();
        foreach (JoinedTour::getAll() as $joinedTour)
        {
            if($joinedTour->getIdUser() == $id_user && $joinedTour->getIdTour() == $id_tour)
            {
                return true;
            }
        }
        return false;
    }


}