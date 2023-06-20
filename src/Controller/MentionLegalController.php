<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mention/legal", name="mention_legal")
 */
class MentionLegalController extends AbstractController
{

    /**
     * @Route("/CGU", name="_CGU")
     */
    public function cgu(): Response
    {
        return $this->render('mention_legal/cgu.html.twig');
    }

    /**
     * @Route("/politique/cookies", name="_cookies")
     */
    public function cookies(): Response
    {
        return $this->render('mention_legal/cookies.html.twig');
    }

    /**
     * @Route("/politique/confidentialite", name="_confidentialite")
     */
    public function confidentialite(): Response
    {
        return $this->render('mention_legal/politique_confidentialite.html.twig');
    }
}
