<?php

namespace App\Controller;


use App\Form\TicketType;
use App\Form\SearchType;

use App\Repository\TicketRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Ticket;
use App\Services\QrcodeService;
class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="ticket")
     */
    public function index(): Response
    {
        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
        ]);
    }
    /**
     * @param TicketRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/afficheT" , name="afficheT" )
     */

    public function Affiche(TicketRepository $repository)
    {
        //$repo= $this->getDoctrine()->getRepository(Reservation::class);
        $ticket = $repository->findAll();
        return $this->render('ticket/Affiche.html.twig',
            ['ticket' => $ticket]);
    }
    /**
     * @param Request $request
     * @return Response
     * @Route("/ticket/Add", name="ticket/Add" )
     */
    function Add(Request $request){
        $ticket=new Ticket();
        $form=$this->createForm(TicketType::class,$ticket);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();
            return $this->redirectToRoute('afficheT');
        }
        return $this->render( 'ticket/Add.html.twig',
            ['form'=>$form->createView()]);


    }
    /**
     * @Route("ticket/update{num_ticket}",name="updatet")
     */
    function update(TicketRepository $repository,$num_ticket,Request $request)
    {
        $ticket = $repository->find($num_ticket);
        $form = $this->createForm(TicketType::class, $ticket);
        $form->add('update',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("afficheT");
        }
        return $this->render('ticket/update.html.twig',
            [
                'ft' => $form->createView()
            ]);
    }
    /**
     * @Route ("/supp1/{num_ticket}",name="dt")
     */
    function Delete($ticket,TicketRepository $repository){

        $ticket = $repository->find($ticket);
        $em = $this->getDoctrine()->getManager();
        $em->remove($ticket);
        $em->flush();
        return $this->redirectToRoute('afficheT' );
    }


    /**
     * @Route("/qr", name="homepage")
     * @param Request $request
     * @param QrcodeService $qrcodeService
     * @return Response
     */
    public function Qrcode(Request $request, QrcodeService $qrcodeService): Response
    {
        $qrCode = null;

        $form = $this->createForm(SearchType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $qrCode = $qrcodeService->qrcode($data['name']);

        }

        return $this->render('ticket/qrcode.html.twig', [
            'form' => $form->createView(),
            'qrCode' => $qrCode

        ]);
    }



}
