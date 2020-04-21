<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\PDO_Manager;

class CityController extends AbstractController
{
    private $pdoManager;

    public function __construct( PDO_Manager $pdoManager)
    {
        $this->pdoManager = $pdoManager;
    }

    /**
     * @Route("/steden", name="app_steden")
     */
    public function view()
    {
        $cities = $this->pdoManager->GetData("select * from images INNER JOIN city ON cit_img_id=img_id");

        return $this->render('city/overzicht.html.twig', [
            'title' => 'Leuke plekken in Europa',
            'cities' => $cities
        ]);
    }

}
