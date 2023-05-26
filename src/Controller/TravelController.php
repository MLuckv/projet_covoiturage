<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
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
    public function index(VoyageRepository $voyageRepository, Request $request, /*PaginatorInterface $paginator,*/ VilleRepository $villeRepository): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);


        $voyage = $voyageRepository->findSearch($data);
        
        $ville = $villeRepository->findBy([], ['nom_ville'=>'asc'] );        

        return $this->render('travel/index.html.twig',[
            'voyage' => $voyage,
            'form' => $form->createView()
            ]);
    }
}
