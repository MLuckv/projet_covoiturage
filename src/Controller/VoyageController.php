<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Voyage;
use App\Form\VoyageType;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Secur;
use Symfony\Component\Security\Core\Security;

class VoyageController extends AbstractController
{
    /**
     * @Route("/voyage", name="app_voyage")
     */
    public function index(): Response
    {
        return $this->render('voyage/index.html.twig');
    }

    /**
     * @Route("/voyage/liste_voyage", name="list_voyage")
     */
    public function lstVoyage(Security $security): Response
    {
        $user = $security->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_home');
        }

        $userVoyages = $user->getVoyageUser();
        return $this->render('voyage/list_voyage.html.twig',[
            'userVoyages' => $userVoyages,
        ]);
    }

    /**
     * @Route("/voyage/add", name="add_voyage")
     */
    public function travel_add(Request $request) : Response
    {
        $voyage = new Voyage;
        $form = $this->createForm(VoyageType::class, $voyage);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $voyage->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($voyage);
            $em->flush();

            $this->addFlash("message", "Voyage ajouter avec succès.");
            return $this->redirectToRoute("app_voyage");
        }

        return $this->render("voyage/add_voyage.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/voyage/delete/{id}", name="delete_voy")
     * @Secur("is_granted('ROLE_USER') and user === voyage.getUser()")
     */
    public function delete(Voyage $voyage): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($voyage);
        $em->flush();
        
        $this->addFlash("message", "Voyage supprimer.");
        return $this->redirectToRoute("list_voyage");
    }

    /**
     * @Route("/voyage/history", name="history_voy")
     */
    public function history(Security $security, VoyageRepository $voyageRepository): Response
    {
        $user = $security->getUser();
        $voyage = $voyageRepository->findBy([], ['created_at' => 'asc']);
        $userVoyages = $user->getVoyageUser();
        return $this->render('voyage/history_voyage.html.twig', compact('user', 'voyage', 'userVoyages'));
    }



    /**
     * @Route("/voyage/edit/{id}", name="edit_voy")
     * @Secur("is_granted('ROLE_USER') and user === voyage.getUser()")
     */
    public function edit(Voyage $voyage, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash("message", "Modification effectuée avec succès");
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('voyage/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }
}
