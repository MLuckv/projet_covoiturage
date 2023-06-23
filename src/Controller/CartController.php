<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Voyage;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart", name="cart_")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SessionInterface $session, VoyageRepository $voyageRepository): Response
    {
        $panier = $session->get("panier", []);

        //recup donnée de panier
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $nbPlace)
        {
            $voyage = $voyageRepository->find($id);
            $dataPanier[] = [
                "voyage" => $voyage,
                "nbPlace" => $nbPlace
            ];
            $total += $voyage->getPrix() * $nbPlace;
        }

        return $this->render('cart/index.html.twig', compact("dataPanier", "total"));
    }

    /**
     * @Route("/add/{id}", name="add")
     */
    public function add(Voyage $voyage, SessionInterface $session)
    {
        //recup panier actuel
        $panier = $session->get("panier", []);

        $id = $voyage->getId();

        if(!empty($panier[$id])){
            $panier[$id]++;
        }
        else{
            $panier[$id]=1;
        }

        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    
    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Voyage $voyage, SessionInterface $session)
    {
        //recup panier actuel
        $panier = $session->get("panier", []);

        $id = $voyage->getId();

        if(!empty($panier[$id])){
            if($panier[$id]>1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }

        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Voyage $voyage, SessionInterface $session)
    {
        //recup panier actuel
        $panier = $session->get("panier", []);

        $id = $voyage->getId();

        if(!empty($panier[$id]))
        {
            unset($panier[$id]);
        }

        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/purchase", name="purchase")
     */
    public function purchase(SessionInterface $session)
    {
        $panier = $session->get("panier", []);
        $em = $this->getDoctrine()->getManager();

        foreach ($panier as $voyageId => $nbPlace) {
            $voyage = $this->getDoctrine()->getRepository(Voyage::class)->find($voyageId);
        
            if ($voyage) {
                // Vérifier si le nombre de places demandées dépasse la disponibilité
                if ($nbPlace > $voyage->getNbPlace()) {
                    $session->set("panier", []); // Vider le panier
                    $this->addFlash("error", "La quantité demandée pour le voyage ". $voyage->getVilleDepart() . " - ". $voyage->getVilleArrive() ." dépasse la disponibilité. Votre panier a été vidé.");
                    return $this->redirectToRoute("cart_index"); 
                }

                $place = new Place();
                $place->setNumPlace($nbPlace);
                $place->setUser($this->getUser());
                $place->setVoy($voyage);
                    
                $em->persist($place);
            
                $voyage->setNbPlace($voyage->getNbPlace() - $nbPlace);
                $em->persist($voyage);
            
                unset($panier[$voyageId]);
            }
        }
    
        $em->flush();
    
        $session->set("panier", $panier);
    
        $this->addFlash("message", "Achat réalisé avec succès");
    
        return $this->redirectToRoute("cart_index");
    }



}
