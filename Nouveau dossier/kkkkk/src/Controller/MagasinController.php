<?php

namespace App\Controller;

use App\Entity\Magasin;
use App\Form\MagasinFormType;
use App\Repository\MagasinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MagasinController extends AbstractController
{
    /**
     * @Route("/magasins", name="magasins")
     */
    public function index(): Response
    {
        $magasins = $this->getDoctrine()->getRepository(Magasin::class)->findAll();

        return $this->render('magasin/index.html.twig', [
            "magasins" => $magasins,
        ]);
    }

    /**
     * @Route("/magasins1", name="magasins1")
     */
    public function index1(): Response
    {
        $magasins = $this->getDoctrine()->getRepository(Magasin::class)->findAll();

        return $this->render('magasin/affiche.html.twig', [
            "magasins" => $magasins,
        ]);
    }


    /**
     * @Route("/add-magasin", name="addMagasin")
     */

    public function addMagasin(Request $request): Response
    {

        $magasin = new Magasin();
        $form=$this->createForm(MagasinFormType::class,$magasin);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($magasin);
            $entityManager->flush();
            return $this->redirect('magasins1');
        }

        return $this->render("magasin/ajouter.html.twig", [
            "form" => $form->createView(),
        ]);
    }



    /**
     * @Route("/modify-magasin/{id}", name="modifiermagasin")
     */

    public function modifyMagasin(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $magasin = $entityManager->getRepository(Magasin::class)->find($id);
        $form = $this->createForm(MagasinFormType::class, $magasin);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            return $this->redirectToRoute('magasins', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render("magasin/form.html.twig", [
            "form_title" => "Modify Magasin",
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete-magasin/{id}", name="supprimermagasin")
     */

    public function deleteMagasin(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $magasin = $entityManager->getRepository(Magasin::class)->find($id);
        $entityManager->remove($magasin);
        $entityManager->flush();

        return $this->redirectToRoute("magasins");
    }
    /**
     * @Route("recherchermag", name="recherchermag")
     */
    public function RechercheNom(Request $request ,MagasinRepository $repository)
    {
        $nommagasin=$request->get('search');
        $magasins = $repository->RechercheNom($nommagasin );

        return $this->render('magasin/affiche.html.twig', array("magasins" => $magasins));
    }
}
