<?php

namespace App\Controller;

use App\Entity\Mark;
use App\Entity\Place;
use App\Entity\User;
use App\Form\MarkType;
use App\Repository\MarkRepository;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/marks", name="marks_")
 */
class MarksController extends AbstractController
{
    
    
    /**
     * @Route("/add/{id_user}/{id_place}", name="add")
     * @ParamConverter("place", options={"id" = "id_place"})
     * @ParamConverter("user", options={"id" = "id_user"})
     */

     public function markTravel(Place $place,User $user, Request $request, MarkRepository $markRepository, EntityManagerInterface $manager): Response
     {

        $mark = new Mark;

        $form = $this->createForm(MarkType::class, $mark);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mark->setUserMark($this->getUser())
                 ->setReceiveMark($user)
                 ->setPlaces($place)
                 ;
                
            $existingMark = $markRepository->findOneBy([
                 'user_mark' => $this->getUser(),
                 'receive_mark' => $user
            ]);

            if (!$existingMark) {
                $manager->persist($mark);
            } else {
                $existingMark->setMark(
                    $form->getData()->getMark()
                );
            }

            $manager->flush();
            $this->addFlash("message", "Votre avis à été prit en compte.");

            return $this->redirectToRoute("app_home");
        }
        return $this->render("marks/add_marks.html.twig", [
            'user' => $user,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/lst", name="list")
     */
    public function lstMarks(Security $security): Response
    {
        $user = $security->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_home');
        }

        $userReceivedMark = $user->getReceiveMarks();
        return $this->render('marks/lst_mark.html.twig', [
            'userReceivedMark' => $userReceivedMark,
        ]);
    }
}
