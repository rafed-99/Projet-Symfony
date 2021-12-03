<?php

namespace App\Controller;

use App\Entity\Materielles;
use App\Form\MateriellesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/materielles")
 */
class MateriellesController extends AbstractController
{
    /**
     * @Route("/", name="materielles_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $materielles = $entityManager
            ->getRepository(Materielles::class)
            ->findAll();

        return $this->render('materielles/index.html.twig', [
            'materielles' => $materielles,
        ]);
    }

    /**
     * @Route("/new", name="materielles_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $materielle = new Materielles();
        $form = $this->createForm(MateriellesType::class, $materielle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materielle->getUploadFile();
            $entityManager->persist($materielle);
            $entityManager->flush();

            return $this->redirectToRoute('materielles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('materielles/new.html.twig', [
            'materielle' => $materielle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="materielles_show", methods={"GET"})
     */
    public function show(Materielles $materielle): Response
    {
        return $this->render('materielles/show.html.twig', [
            'materielle' => $materielle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="materielles_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Materielles $materielle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MateriellesType::class, $materielle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('materielles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('materielles/edit.html.twig', [
            'materielle' => $materielle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="materielle_delete")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $stade = $em->getRepository(Materielles::class)->find($id);
        $em->remove($stade);
        $em->flush();
        return $this->redirectToRoute('materielles_index');
    }
}
