<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
    
/**
 * @Route("/detail", name="detail_")
 */
class TravelDetailController extends AbstractController
{
    /**
     * @Route("/{slug}", name="list")
     */
    public function list(Voyage $voyage, PlaceRepository $placeRepository): Response
    {
        $place = $placeRepository->findBy([], ['voy'=>'asc'] );
        return $this->render('travel_details/list.html.twig', compact('voyage', 'place'));
    }
}
