<?php

namespace App\Controllers;

use App\Auth;
use App\Models\JoinedTour;
use App\Models\Review;
use App\Models\Tour;
use App\Models\User;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerRedirect
{

    public function index()
    {
        return $this->html(
            [
                'active' => 'home'
            ]);
    }

    public function about()
    {
        return $this->html(
            [
                'active' => 'about'
            ]
        );
    }

    public function tours()
    {
        $tours = Tour::getAll();
        return $this->html(
            [
                'active' => 'tours',
                'tours' => $tours,
                'message' => $this->request()->getValue('message')
            ]
        );
    }

    public function specificTour()
    {
        return $this->html(
            [
                'active' => 'tours',
                'id_tour' => $this->request()->getValue('id_tour'),
                'message' => $this->request()->getValue('message')
            ]
        );
    }

    public function specificTourForm()
    {
        $id_tour = $this->request()->getValue('id_tour');
        $this->redirect('home', 'specificTour',['id_tour' => $id_tour]);
    }

    public function addReview()
    {
        $id_user = $_SESSION['id_user'];
        $id_tour = $this->request()->getValue('id_tour');
        $review = new Review();
        $review->setText($this->request()->getValue('review'));
        $review->setIdUser($id_user);
        $review->setIdTour($id_tour);
        $review->save();
        $this->redirect('home', 'specificTour', ['id_tour' => $id_tour]);
    }


    public function joinTour()
    {
        $id_user = $_SESSION['id_user'];
        $id_tour = $this->request()->getValue('id_tour');
        if(Auth::isLogged())
        {
            if($id_user != null && $id_tour != null && !Auth::alreadyBookedTour($id_tour))
            {
                $joined_tour = new JoinedTour();
                $joined_tour->setIdUser($id_user);
                $joined_tour->setIdTour($id_tour);
                $joined_tour->save();

                $tour = Tour::getOne($id_tour);
                $tour->addTourMember();
                $tour->save();
            }

            $this->redirect('home', 'specificTour', ['message' => 'Zájazd ste si úspěsne objednali!', 'id_tour' => $id_tour]);
        }
        else
        {
            $this->redirect('auth', 'loginForm', ['error' => 'Na objednanie zájazdu sa musíte prihlásiť!']);
        }



    }

    public function leaveTour()
    {
        if(isset($_SESSION['id_user']) && $this->request()->getValue('id_tour') != null)
        {
            $id_user = $_SESSION['id_user'];
            $id_tour = $this->request()->getValue('id_tour');
            $removed_tour = null;

            foreach (JoinedTour::getAll() as $joined_tour)
            {
                if ($joined_tour->getIdTour() == $id_tour && $joined_tour->getIdUser() == $id_user)
                {
                    $removed_tour = JoinedTour::getOne($joined_tour->getId());
                }
            }

            if($removed_tour != null)
            {
                $removed_tour->delete();

                $tour = Tour::getOne($id_tour);
                $tour->removeTourMember();
                $tour->save();
            }

        }

        $this->redirect('auth', 'profile', ['message' => 'Zájazd ste si úspešne odhlásili!']);
    }

}