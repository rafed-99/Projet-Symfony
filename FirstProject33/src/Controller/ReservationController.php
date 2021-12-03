<?php

namespace App\Controller;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    /**
     * @param ReservationRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/afficheR" , name="afficheR" )
     */

        public function Affiche(ReservationRepository $repository)
        {
            //$repo= $this->getDoctrine()->getRepository(Reservation::class);
            $reservation = $repository->findAll();
            return $this->render('reservation/Affiche.html.twig',
                ['reservation' => $reservation]);
        }
    /**
     * @param ReservationRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/afficheR1" , name="afficheR1" )
     */

    public function Affiche1(ReservationRepository $repository)
    {
        //$repo= $this->getDoctrine()->getRepository(Reservation::class);
        $reservation = $repository->findAll();
        return $this->render('reservation/Affiche1.html.twig',
            ['reservation' => $reservation]);
    }

    /**
     * @Route ("/supp2/{id_reservation}",name="d")
     */
    function Delete($id_reservation,ReservationRepository $repository,Reservation $reservation ){

        $reservation = $repository->find($id_reservation);
        $em = $this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('afficheR' );
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/reservation/Add" ,name="reservation/Add")
     */
 function Add(Request $request){
        $reservation=new Reservation();
   $form=$this->createForm(ReservationType::class,$reservation);
     $form->add('Ajouter',SubmitType::class);
   $form->handleRequest($request);

  if($form->isSubmitted() && $form->isValid()){
      $em=$this->getDoctrine()->getManager();
      $em->persist($reservation);
      $em->flush();
      return $this->redirectToRoute('afficheR');
  }
  return $this->render( 'reservation/Add.html.twig',
      ['form'=>$form->createView()]);


 }
    /**
     * @Route("/update{id_reservation}",name="updater")
     */
    function update(ReservationRepository $repository,$id_reservation,Request $request)
    {
        $reservation = $repository->find($id_reservation);
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->add('update',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("afficheR");
        }
        return $this->render('reservation/update.html.twig',
            [
                'fr' => $form->createView()
            ]);
    }

}
