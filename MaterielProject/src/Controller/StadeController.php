<?php

namespace App\Controller;

use App\Entity\Stade;
use App\Form\StadeType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stade")
 */
class StadeController extends AbstractController
{


    /**
     * @Route("/front", name="front_index", methods={"GET"})
     */
    public function front(EntityManagerInterface $entityManager): Response
    {
        $stades = $entityManager
            ->getRepository(Stade::class)
            ->findAll();

        return $this->render('stade/indexfront.html.twig', [
            'stades' => $stades,
        ]);
    }

    /**
     * @Route("/", name="stade_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager,Request $request, PaginatorInterface $paginator): Response
    {
        $donnees =  $entityManager
            ->getRepository(Stade::class)
            ->findAll();

        $stades =$paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            1// Nombre de résultats par page
        );
        return $this->render('stade/index.html.twig', [
            'stades' => $stades,
        ]);
    }

    /**
     * @Route("/new", name="stade_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stade = new Stade();
        $form = $this->createForm(StadeType::class, $stade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stade->getUploadFile();
            $entityManager->persist($stade);
            $entityManager->flush();

            return $this->redirectToRoute('stade_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('stade/new.html.twig', [
            'stade' => $stade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stade_show", methods={"GET"})
     */
    public function show(Stade $stade): Response
    {
        return $this->render('stade/show.html.twig', [
            'stade' => $stade,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="stade_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Stade $stade, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StadeType::class, $stade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('stade_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('stade/edit.html.twig', [
            'stade' => $stade,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/delete/{id}", name="stade_delete")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $stade = $em->getRepository(Stade::class)->find($id);
        $em->remove($stade);
        $em->flush();
        return $this->redirectToRoute('stade_index');
    }





}
