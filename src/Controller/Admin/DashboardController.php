<?php

namespace App\Controller\Admin;

use App\Entity\Departement;
use App\Entity\Images;
use App\Entity\Message;
use App\Entity\Place;
use App\Entity\User;
use App\Entity\Vehicule;
use App\Entity\Ville;
use App\Entity\Voyage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BlablaSchuman - Administration')
            ->renderContentMaximized()
            ->setFaviconPath("{{ asset('assets/img/logo.ico') }}")
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Message', 'fas fa-envelope', Message::class);
        yield MenuItem::linkToCrud('Departement', 'fas fa-mountain', Departement::class);
        yield MenuItem::linkToCrud('Ville', 'fas fa-city', Ville::class);
        yield MenuItem::linkToCrud('Vehicule', 'fas fa-car', Vehicule::class);
        yield MenuItem::linkToCrud('Voyage', 'fas fa-plane', Voyage::class);
        yield MenuItem::linkToCrud('Place', 'fas fa-check', Place::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-image', Images::class);


    }
}
