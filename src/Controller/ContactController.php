<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Secur;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     * @Secur("is_granted('ROLE_USER')")
     */
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        $contact = new Contact;

        if($this->getUser())
        {
            $contact->setLastname($this->getUser()->getLastname())
                ->setFirstname($this->getUser()->getFirstname())
                ->setEmail($this->getUser()->getEmail());
        }

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            //email
            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('admin@blablaSchuma.fr')
                ->subject($contact->getSubject())
                ->htmlTemplate('emails/contact.html.twig')

                ->context([
                    'contact' => $contact,
                ])
                ;

            $mailer->send($email);

            $this->addFlash("message", "Votre demande à était pris en compte");
            return $this->redirectToRoute("app_home");
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
