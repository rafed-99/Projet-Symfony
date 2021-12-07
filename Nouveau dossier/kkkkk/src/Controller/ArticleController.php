<?php

namespace App\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use App\Repository\MagasinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articlesback", name="articlesback")
     */
    public function AfficheArticle(): Response
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('article/index.html.twig', [
            "articles" => $articles,
        ]);
    }

    /**
     * @Route("/articlesrecherche", name="articlesrecherche")
     */
    public function AfficheArticle2(): Response
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('article/rechercher.html.twig', [
            "articles" => $articles,
        ]);
    }

    /**
     * @Route("/articles1", name="articles1")
     */
    public function index1(): Response
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('article/affiche.html.twig', [
            "articles" => $articles,
        ]);
    }

    /**
     * @Route("/articles3", name="articles3")
     */
    public function AfficheArticlePDF(): Response
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('article/listePDF.html.twig', [
            "articles" => $articles,
        ]);
    }

    /**
     * @Route("/listA", name="listA", methods={"GET"})
     */
    public function listeA(ArticleRepository $articleRepository): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $article = $articleRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('article/listePDF.html.twig', [
            'article' => $article,
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
     * @Route("/add-article", name="addArticle")
     */

    public function addArticle(Request $request): Response
    {

        $article = new Article();
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirect('articles1');
        }

        return $this->render("article/ajouter.html.twig", [
            "form" => $form->createView(),
        ]);
    }


    /**
     * @Route("/modify-article/{id}", name="modifierarticle")
     */

    public
    function modifyArticle(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $article = $entityManager->getRepository(Article::class)->find($id);
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('articles', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render("article/form.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete-article/{id}", name="supprimerarticle")
     */

    public
    function deleteArticle(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Article::class)->find($id);
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute("articles");
    }

    /**
     * @param ArticleRepository $repository
     * @return Response
     * @Route ("/listeQB",name="listeQB")
     */
    public function OrderByPrix(ArticleRepository $repository)
    {
        $article = $repository->OrderByPrixQB();
        return $this->render('article/affiche.html.twig',
            ['articles' => $article]);


    }

    /**
     * @Route("rechercherart", name="rechercherart")
     */
    public function RechercheNom(Request $request, ArticleRepository $repository)
    {
        $nomarticle = $request->get('search');
        $articles = $repository->RechercheNomArt($nomarticle);

        return $this->render('article/rechercher.html.twig', array("articles" => $articles));
    }
}


