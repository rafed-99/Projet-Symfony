<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    /**
     * @Route("/affiche", name="affiche")
     */
    public function affiche()
    { return new Response('bonjour les amis');}
    /**
     * @Route("/affiche2/{nom}", name="affiche2")
     */
    public function affiche2( $nom)
    {return new Response('bonjour les amis'.$nom);}
    /**
     * @Route("/affiche3/{nom}", name="affiche3")
     */
    public function affiche3($nom)
    {return $this->render('student/index.html.twig', ['n' => $nom]);}

    /**
     * @Route("/liste", name="liste")
     */
public function liste()
{

    $listTalbleau = array(
        array('ref' => 'form124', 'titre' => 'formation'),
        array('ref' => 'kk55', 'titre' => 'fhkk'),
        array('ref' => 'fff65', 'titre' => 'llll'));
    return $this->render('student/index.html.twig',['liste' => $listTalbleau]);

}

}
