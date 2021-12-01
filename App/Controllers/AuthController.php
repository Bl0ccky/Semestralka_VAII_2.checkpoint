<?php

namespace App\Controllers;

use App\Auth;
use App\Config\Configuration;
use App\Models\JoinedTour;
use App\Models\Tour;
use App\Models\User;

class AuthController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->html(
            [
                'active' => 'home'
            ]);
    }

    public function loginForm()
    {
        return $this->html(
            [
                'active' => 'login',
                'error' => $this->request()->getValue('error'),
                'message' => $this->request()->getValue('message'),
                'message2' => $this->request()->getValue('message2')
            ]
        );
    }

    public function registrationForm()
    {
        return $this->html(
            [
                'active' => 'registration',
                'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function registration()
    {

        $email = $this->request()->getValue('email');
        if(Auth::findIdByEmail($email) == 0)
        {
            $user = new User();
            $user->setName($this->request()->getValue('name'));
            $user->setLastName($this->request()->getValue('last_name'));
            $user->setDate($this->request()->getValue('date'));
            $user->setLogin($this->request()->getValue('login'));
            $user->setEmail($this->request()->getValue('email'));
            $user->setPassword($this->request()->getValue('password'));
            $user->save();
            $this->redirect('auth', 'loginForm', ['message' => 'Úspešná registrácia!', 'message2' => 'Môžete sa prihlásiť']);
        }
        else
        {
            $this->redirect('auth', 'registrationForm', ['error' => 'Užívateľ s takýmto emailom už existuje!']);
        }

    }
    
    public function login()
    {
        $login = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');

        $logged = Auth::login($login, $password); //skontroluje ci som prihlaseny ak ano vrati true

        if($logged)
        {
            $this->redirect('home');
        }
        else
        {
            $this->redirect('auth', 'loginForm', ['error' => 'Zlé meno alebo heslo!']);
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('home');
    }

    public function profile()
    {
        $tours = Tour::getAll();
        $joined_tours = JoinedTour::getAll();
        return $this->html(
            [
                'active' => 'profile',
                'tours' => $tours,
                'joined_tours' => $joined_tours,
                'message' => $this->request()->getValue('message')
            ]
        );
    }

    public function editProfileForm()
    {
        return $this->html(
            [
                'active' => 'profile',
                'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function editProfile()
    {
        $id = $_SESSION['id_user'];
        if($id != 0)
        {
            $newEmail = $this->request()->getValue('email');
            if(Auth::findIdByEmail($newEmail) == 0 || Auth::findIdByEmail($newEmail) == $id)
            {
                $user = User::getOne($id);
                $user->setName($this->request()->getValue('name'));
                $user->setLastName($this->request()->getValue('last_name'));
                $user->setDate($this->request()->getValue('date'));
                $user->setLogin($this->request()->getValue('login'));
                $user->setEmail($this->request()->getValue('email'));
                $user->setPassword($this->request()->getValue('password'));
                if (isset($_FILES['profile_image'])) {       //Ak mi prisiel nejaky subor
                   if ($_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
                        $name = $_FILES['profile_image']['name'];     //Vytvorim si meno suboru
                        move_uploaded_file($_FILES['profile_image']['tmp_name'], Configuration::PROFILE_IMAGE_DIR . "$name");   //movnem to z tmp priecinka do mojho priecinka v premennej UPLOAD_DIR
                       $user->setImage($name);
                    }
                }
                $_SESSION['email'] = $newEmail;   //zrusim session, nebudem prihlaseny
                $user->save();
                $this->redirect('auth', 'profile', ['message' => 'Zmeny sa vykonali!']);
            }
            else
            {
                $this->redirect('auth', 'editProfileForm', ['error' => 'Užívateľ s takýmto emailom už existuje!']);
            }
        }
    }

}