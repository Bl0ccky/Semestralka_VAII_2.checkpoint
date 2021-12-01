<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Models\Tour;

class AdminController extends AControllerRedirect
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

    public function addTourForm()
    {
        return $this->html(
            [
                'active' => 'addTour'
            ]);
    }

    public function addTour()
    {
        $tour = new Tour();
        $tour->setName($this->request()->getValue('tour_name'));
        $tour->setPrice($this->request()->getValue('tour_price'));
        $tour->setDate($this->request()->getValue('tour_date'));
        $tour->setInfo($this->request()->getValue('tour_info'));
        $tour->setNumberOfOrders(0);
        $tour->setCapacity($this->request()->getValue('tour_capacity'));

        if (isset($_FILES['tour_image'])) {       //Ak mi prisiel nejaky subor
            if ($_FILES['tour_image']['error'] == UPLOAD_ERR_OK) {
                $name = $_FILES['tour_image']['name'];     //Vytvorim si meno suboru
                move_uploaded_file($_FILES['tour_image']['tmp_name'], Configuration::UPLOAD_DIR . "$name");   //movnem to z tmp priecinka do mojho priecinka v premennej UPLOAD_DIR
                $tour->setImage($name);
            }
        }
        $tour->save();
        $this->redirect('home', 'tours', ['message' => 'Zájazd úspešne pridaný!']);
    }


}