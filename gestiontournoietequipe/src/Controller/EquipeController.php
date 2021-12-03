<?php

namespace App\Controller;

use App\Repository\EquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Equipe;
use App\Entity\PSearch;
use App\Form\PSearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\EquipeType;
use Dompdf\Dompdf;
use Dompdf\Options;

class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe", name="equipe")
     */
    public function index(): Response
    {
        return $this->render('equipe/index.html.twig', [
            'controller_name' => 'EquipeController',
        ]);
    }
    /**
     * @param EquipeRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @route("/AfficheE",name="AfficheE")
     */
    public function affiche(EquipeRepository $repository){
        $equipe=$repository->findAll();
        return $this->render('equipe/Affiche.html.twig',
        ['equipe'=> $equipe]);
    }

/**
     * @param EquipeRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/ListE",name="ListE")
     */
    public function OrderByNbrEffectif(EquipeRepository $repository){
        $equipe=$repository->OrderByNbrEffectif();
        return $this->render('equipe/Affiche.html.twig',
        ['equipe'=> $equipe]);


    }


    /**
     * @param EquipeRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @route("/AfficheE1",name="AfficheE1")
     */
    public function affiche1(EquipeRepository $repository){
        $equipe=$repository->findAll();
        return $this->render('equipe/Affiche1.html.twig',
        ['equipe'=> $equipe]);
    }

    /**
     * @param EquipeRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/ListE1",name="ListE1")
     */
    public function OrderByNbrEffectif1(EquipeRepository $repository){
        $equipe=$repository->OrderByNbrEffectif();
        return $this->render('equipe/Affiche1.html.twig',
        ['equipe'=> $equipe]);


    }

    /**
     * @param EquipeRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @route("/AfficheEPDF",name="AfficheEPDF")
     */
    public function affiche2(EquipeRepository $repository){
        $equipe=$repository->findAll();
        return $this->render('equipe/pdfequipe.html.twig',
        ['equipe'=> $equipe]);
    }

    /**
     * @param EquipeRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/listpdfe", name="listpdfe", methods={"GET"})
     */ public function listeeq(EquipeRepository $repository): Response
     {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $equipe= $repository->findAll(); 
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('equipe/pdfequipe.html.twig', [
            'equipe'=> $equipe,
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
     * @Route("/Supp/{idequipe}",name="delete")
     */
    function Delete($idequipe ,EquipeRepository $repository){
        $equipe=$repository->find($idequipe);
        $em=$this->getDoctrine()->getManager();
        $em->remove($equipe);
        $em->flush();
        $this->addFlash('success', 'Suppression faite avec success!');
        return $this->redirectToRoute('AfficheE');
    }
    /**
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response;
     * @Route("/equipe/Add",name="ajout1")
     */
    function Add(Request $request){
        $equipe=new Equipe();
        $form=$this->createForm(EquipeType::class,$equipe);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $em->persist($equipe);
        $em->flush();
        $this->addFlash('success', 'Equipe Ajoute!');
        return $this->redirectToRoute('AfficheE1');
    }
    return $this->render('equipe/Add.html.twig',[
        'form'=> $form->createView()
    ]); 
}
    /**
     * @Route("/Update/{idequipe}",name="majour")
     */
    function Update(EquipeRepository $repository,$idequipe ,Request $request){
        $equipe=$repository->find($idequipe);
        $form=$this->createForm(EquipeType::class,$equipe);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($equipe);
            $em->flush();
            $this->addFlash('success', 'Donnees Equipe Modifies!');
            return $this->redirectToRoute('AfficheE');
        }
        return $this->render('equipe/Update.html.twig',[
            'fo'=> $form->createView()
        ]); 
     }
    
     /**
    *@Route("/rechercherE",name="rechercheE")
    */
  public function home(Request $request)
  {
    $PSearch = new PSearch();
    $form = $this->createForm(PSearchType::class,$PSearch);
    $form->handleRequest($request);
    $equipe= [];
    
   if($form->isSubmitted() && $form->isValid()) {
    $nomequipe = $PSearch->getNomequipe();   
    if ($nomequipe!="") 
      $equipe= $this->getDoctrine()->getRepository(Equipe::class)->findBy(['nomequipe' => $nomequipe] );
    else   
      $equipe= $this->getDoctrine()->getRepository(equipe::class)->findAll();
   }
    return  $this->render('equipe/liste.html.twig',[ 'fce' =>$form->createView(), 'equipe' => $equipe]);  
  }
}
