<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Entity\Conducteur;
use App\Form\VehiculeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

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
     * @Route("/liste_vehicule", name="list")
     */
    public function lstVehicule(Security $security): Response
    {
        $user = $security->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_home');
        }

        $userVehicules = $user->getDriver();
        $userVehicules = $userVehicules->getVehiculeUser();
        return $this->render('vehicule/list_car.html.twig', [
            'userVehicules' => $userVehicules,
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function vehicule_add(Request $request): Response
    {
        $vehicule = new Vehicule;
        $form = $this->createForm(VehiculeType::class, $vehicule);

        $user = $this->getUser();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicule->setConducteur($user->getDriver());

            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicule);
            $em->flush();

            $this->addFlash("message", "Véhicule ajouté avec succès.");
            return $this->redirectToRoute("car_index");
        }

        return $this->render("vehicule/add_car.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Vehicule $vehicule): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($vehicule);
        $em->flush();
        return $this->redirectToRoute("car_list");
    }


}
