<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\PlaceRepository;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/profile", name="profile_")
 */
class ProfileDetailController extends AbstractController
{
    /**
     * @Route("/{slug}", name="user")
     */
    public function list(User $user, VoyageRepository $voyageRepository, PlaceRepository $placeRepository): Response
    {
        $place = $placeRepository->findBy([], ['voy'=>'asc'] );
        $voyage = $voyageRepository->findBy([], ['created_at' => 'asc']);
        $userVoyages = $user->getVoyageUser();
        return $this->render('profile_detail/profile.html.twig', compact('user','voyage', 'userVoyages', 'place'));
    }
}
