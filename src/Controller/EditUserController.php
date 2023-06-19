<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Secur;

class EditUserController extends AbstractController
{
    /**
     * @Route("/edit/user", name="app_edit_user")
     */
    public function index(): Response
    {
        return $this->render('edit_user/index.html.twig', [
            'controller_name' => 'EditUserController',
        ]);
    }

     /**
     * @Route("/{id}/edit/user", name="edit_user")
     * @Secur("is_granted('ROLE_USER') and user === users")
     */
    public function edit(Request $request, User $users, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EditUserType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($users->getProfilePicture() == null){
                if($form->get('profile_picture')->getData() != null){
                    //reccup img 
                    $images = $form->get('profile_picture')->getData();
                    //boucle sur les images

                       //genere un nom de fichier 
                       $fichier = md5(uniqid()) . '.' . $images->guessExtension();

                       //on copie le dichier dans le dossier uploads
                       $images->move(
                            $this->getParameter('image_directory'),
                            $fichier
                       );

                       //stock img dans bdd (son nom)
                       $img = new Images();
                       $img->setName($fichier);
                       $img->setUserPicture($users);
                       //$user->setProfilePicture($img);
                   
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($img);
                    $em->flush();
                    $this->addFlash("message", "image ajouter avec succès");
                }
            }

            //hash le password
            $users->setPassword(
                $userPasswordHasher->hashPassword(
                    $users,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($users);
            $entityManager->flush();

            $userRepository->add($users, true);
            $this->addFlash("message", "modification effectué avec succès");

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
            
        }

        return $this->renderForm('edit_user/edit.html.twig', [
            'user' => $users,
            'form' => $form,
        ]);
    }

}
