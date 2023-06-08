<?php

namespace App\Controller;

use App\Entity\Conducteur;
use App\Form\ConducteurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConducteurController extends AbstractController
{
    /**
     * @Route("/driver/become", name="app_driver")
     */
    public function become_driver(Request $request) : Response
    {
        $conducteur = new Conducteur;
        $form = $this->createForm(ConducteurType::class, $conducteur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $conducteur->setUser($this->getUser());


            $em = $this->getDoctrine()->getManager();
            $em->persist($conducteur);
            $em->flush();

            $user = $this->getUser();
            $user->setIsDriver(true);
                
            $em->persist($user);
            $em->flush();

            $this->addFlash("message", "Vous êtes devenu un conducteur !");
            return $this->redirectToRoute("app_home");
        }

        return $this->render("conducteur/index.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
