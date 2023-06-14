<?php

namespace App\Controller\Admin;

use App\Entity\Voyage;
use App\Form\Admin\AdminVoyageType;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/voyage")
 */
class AdminVoyageController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_voyage_index", methods={"GET"})
     */
    public function index(VoyageRepository $voyageRepository): Response
    {
        return $this->render('admin/admin_voyage/index.html.twig', [
            'voyages' => $voyageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_voyage_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VoyageRepository $voyageRepository): Response
    {
        $voyage = new Voyage();
        $form = $this->createForm(AdminVoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voyageRepository->add($voyage, true);

            return $this->redirectToRoute('app_admin_voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_voyage/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_voyage_show", methods={"GET"})
     */
    public function show(Voyage $voyage): Response
    {
        return $this->render('admin/admin_voyage/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_voyage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Voyage $voyage, VoyageRepository $voyageRepository): Response
    {
        $form = $this->createForm(AdminVoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voyageRepository->add($voyage, true);

            return $this->redirectToRoute('app_admin_voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/admin_voyage/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_voyage_delete", methods={"POST"})
     */
    public function delete(Request $request, Voyage $voyage, VoyageRepository $voyageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
            $voyageRepository->remove($voyage, true);
        }

        return $this->redirectToRoute('app_admin_voyage_index', [], Response::HTTP_SEE_OTHER);
    }
}
