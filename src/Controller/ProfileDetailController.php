<?php

namespace App\Controller;

use App\Entity\User;
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
    public function list(User $user): Response
    {
        return $this->render('profile_detail/profile.html.twig', compact('user'));
    }
}
