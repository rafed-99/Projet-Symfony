<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request,\Swift_Mailer $mailer): Response
    {
        $form=$this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $contact =$form->getData();
            //l'envoie du mail:
            $message =(new \Swift_Message('Nouveau contact '))
                //on attribue l'expediteur
                ->setFrom($contact['email'])
                //on attribue le destinataire
                ->setTo('votre@esprit.tn')
                //on cree le contenue du message avec la vue twig
                ->setBody(
                    $this->renderView('emails/contact.html.twig',compact('contact')
                    )
                );
            //on envoie le message
            $mailer->send($message);
            $this->addFlash('message','le message a ete envoye');
            return $this->redirectToRoute('contact');

        }
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}