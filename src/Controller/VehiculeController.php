<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/car", name="car_")
 */

class VehiculeController extends AbstractController
{
    /**
     * @Route("/home", name="index")
     */
    public function index(): Response
    {
        return $this->render('vehicule/index.html.twig');
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(): Response
    {
        return $this->render('vehicule/index.html.twig');
    }
}
