<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, UserAuthenticatorInterface $userAuthenticatorInterface, LoginAuthenticator $loginAuthenticator): Response
    {

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            
            // encode the plain password    
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            //reccup l'image
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
                   $user->setProfilePicture($img);
               
                $em = $this->getDoctrine()->getManager();
                $em->persist($img);
                $em->flush();
                $this->addFlash("message", "image ajouter avec succès");
            }

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticatorInterface->authenticateUser($user, $loginAuthenticator, $request);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
