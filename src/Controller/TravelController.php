<?php

namespace App\Controller;

use App\Repository\VilleRepository;
use App\Repository\VoyageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TravelController extends AbstractController
{
    /**
     * @Route("/travel", name="app_travel")
     */
    public function index(VoyageRepository $voyageRepository, Request $request, PaginatorInterface $paginator, VilleRepository $villeRepository): Response
    {
        //$voyage = $voyageRepository->findBy([], ['created_at'=>'asc']);
        
        $ville = $villeRepository->findBy([], ['nom_ville'=>'asc'] );        

        $pagination = $paginator->paginate(
            $voyageRepository->paginationQuery(),
            $request->query->get('page', 1),
            5 //changer ce nombre correspond au nombre de voyage dans la page 
        ); 
        
        return $this->render('travel/index.html.twig', [
            'pagination' => $pagination, 'ville' => $ville
        ]);
    }
}
