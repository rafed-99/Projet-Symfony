<?php

namespace App\Controller;

use App\Repository\TournoiRepository;
use App\Form\TournoiType;
use App\Entity\Tournoi;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Dompdf\Dompdf;
use Dompdf\Options;

class TournoiController extends AbstractController
{
    /**
     * @Route("/tournoi", name="tournoi")
     */
    public function index(): Response
    {
        return $this->render('tournoi/index.html.twig', [
            'controller_name' => 'TournoiController',
        ]);
    }
    /**
     * @param TournoiRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @route("/AfficheT",name="AfficheT")
     */
    public function affiche(TournoiRepository $repository){
        $tournoi=$repository->findAll();
        return $this->render('tournoi/Affiche.html.twig',
        ['tournoi'=> $tournoi]);
    }

    /**
     * @param TournoiRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/ListT",name="ListT")
     */
    public function OrderByNbrEquipes(TournoiRepository $repository){
        $tournoi=$repository->OrderByNbrEquipes();
        return $this->render('tournoi/Affiche.html.twig',
        ['tournoi'=> $tournoi]);


    }

    /**
     * @param TournoiRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @route("/AfficheT1",name="AfficheT1")
     */
    public function affiche1(TournoiRepository $repository){
        $tournoi=$repository->findAll();
        return $this->render('tournoi/Affiche1.html.twig',
        ['tournoi'=> $tournoi]);
    }

    

/**
     * @param TournoiRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/ListT1",name="ListT1")
     */
    public function OrderByNbrEquipes1(TournoiRepository $repository){
        $tournoi=$repository->OrderByNbrEquipes();
        return $this->render('tournoi/Affiche1.html.twig',
        ['tournoi'=> $tournoi]);


    }

    /**
     * @param TournoiRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @route("/AfficheTPDF",name="AfficheTPDF")
     */
    public function affiche2(TournoiRepository $repository){
        $tournoi=$repository->findAll();
        return $this->render('tournoi/pdftournoi.html.twig',
        ['tournoi'=> $tournoi]);
    }

    /**
     * @param TournoiRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/listpdf", name="listpdf", methods={"GET"})
     */ public function listetr(TournoiRepository $repository): Response
     {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $tournoi= $repository->findAll(); 
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('tournoi/pdftournoi.html.twig', [
            'tournoi'=> $tournoi,
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }


    /**
     * @Route("/Supp1/{idtournoi}",name="del")
     */
    function Delete($idtournoi ,TournoiRepository $repository){
        
        $tournoi=$repository->find($idtournoi);
        $em=$this->getDoctrine()->getManager();
        $em->remove($tournoi);
        $em->flush();
        $this->addFlash('success', 'Suppression faite avec success!');
        return $this->redirectToRoute('AfficheT');
    }
    /**
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response;
     * @Route("/tournoi/Add",name="ajout")
     */
    function Add(Request $request){
        $tournoi=new Tournoi();
        $form=$this->createForm(TournoiType::class,$tournoi);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($tournoi);
            $em->flush();
            $this->addFlash('success', 'Tournoi Ajoute!');
            return $this->redirectToRoute('AfficheT1');
           

        }
        return $this->render('tournoi/Add.html.twig',[
        'forme'=> $form->createView()
    ]); 
    }
    /**
     * @Route("/Update1/{idtournoi}",name="maja")
     */
    function Update(TournoiRepository $repository,$idtournoi ,Request $request){
        $tournoi=$repository->find($idtournoi);
        $form=$this->createForm(TournoiType::class,$tournoi);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($tournoi);
            $em->flush();
            $this->addFlash('success', 'Donnees Tournois Modifies!');
            return $this->redirectToRoute('AfficheT');
        }
        return $this->render('tournoi/Update1.html.twig',[
            'f1'=> $form->createView()
        ]); 
    }

    /**
    *@Route("/rechercherT",name="rechercheT")
    */
  public function home(Request $request)
  {
    $PropertySearch = new PropertySearch();
    $form = $this->createForm(PropertySearchType::class,$PropertySearch);
    $form->handleRequest($request);
    $tournoi= [];
    
   if($form->isSubmitted() && $form->isValid()) {
    $nomtournoi = $PropertySearch->getNomtournoi();   
    if ($nomtournoi!="") 
      $tournoi= $this->getDoctrine()->getRepository(Tournoi::class)->findBy(['nomtournoi' => $nomtournoi] );
    else   
      $tournoi= $this->getDoctrine()->getRepository(tournoi::class)->findAll();
   }
    return  $this->render('tournoi/listt.html.twig',[ 'fc' =>$form->createView(), 'tournoi' => $tournoi]);  
  }
}
