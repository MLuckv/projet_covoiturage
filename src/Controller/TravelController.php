<?php

namespace App\Controller;

use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TravelController extends AbstractController
{
    /**
     * @Route("/travel", name="app_travel")
     */
    public function index(VoyageRepository $voyageRepository): Response
    {
        //'controller_name' => 'TravelController',
        return $this->render('travel/index.html.twig', [
            'voyage'=> $voyageRepository->findBy([], ['created_at'=>'asc']),
        ]);
    }
}
