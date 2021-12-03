<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\MatchFootType;
use App\Form\ReservationType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\MatchFootRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MatchFoot;
class MatchFootController extends AbstractController
{
    /**
     * @Route("/match/foot", name="match_foot")
     */
    public function index(): Response
    {
        return $this->render('match_foot/index.html.twig', [
            'controller_name' => 'MatchFootController',
        ]);
    }
    /**
     * @param MatchFootRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/afficheM" , name="afficheM" )
     */

    public function Affiche(MatchFootRepository $repository)
    {
        //$repo= $this->getDoctrine()->getRepository(Reservation::class);
        $match_foot = $repository->findAll();
        return $this->render('match_foot/Affiche.html.twig',
            ['match_foot' => $match_foot]);
    }
    /**
     * @Route ("/supp/{ref_match}",name="dm")
     */
    function Delete($ref_match,MatchFootRepository $repository){

        $match_foot = $repository->find($ref_match);
        $em = $this->getDoctrine()->getManager();
        $em->remove($match_foot);
        $em->flush();
        return $this->redirectToRoute('afficheM' );
    }
    /**
     * @param Request $request
     * @return Response
     * @Route("/match/Add",name="match/Add")
     */
    function Add(Request $request){
        $match_foot=new MatchFoot();
        $form=$this->createForm(MatchFootType::class,$match_foot);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($match_foot);
            $em->flush();
            return $this->redirectToRoute('afficheM');
        }
        return $this->render( 'match_foot/Add.html.twig',
            ['form'=>$form->createView()]);


    }
    /**
     * @Route("/update/{ref_match}",name="update1")
     */
    function update(MatchFootRepository $repository,$ref_match,Request $request)
    {
        $match_foot = $repository->find($ref_match);
        $form = $this->createForm(MatchFootType::class, $match_foot);
        $form->add('update',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("afficheM");
        }
        return $this->render('match_foot/update.html.twig',
            [
                'f' => $form->createView()
            ]);
    }

    /**
     *@Route("/searchM",name="searchM")
     */
    public function search(Request $request)
    {
        $PropertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$PropertySearch);
        $form->handleRequest($request);

        $match_foot= [];

        if($form->isSubmitted() && $form->isValid()) {

            $ref_match = $PropertySearch->getRefmatch();
            if ($ref_match!="")

                $match_foot= $this->getDoctrine()->getRepository(MatchFoot::class)->findBy(['ref_match' => $ref_match] );
            else

                $match_foot= $this->getDoctrine()->getRepository(MatchFoot::class)->findAll();
        }
        return  $this->render('match_foot/listm.html.twig',[ 'fc' =>$form->createView(), 'match_foot' => $match_foot]);
    }
    /**
     * @param MatchFootRepository $repository
     * @return Response
     * @Route ("/ListQB",name="ListQB")
     */
    public function OrderByNbrSpectateurQB(MatchFootRepository $repository){
        $match_foot=$repository->OrderByNbrSpectateurQB();
        return $this->render('match_foot/Affiche.html.twig',
            ['match_foot' => $match_foot]);


    }




}
