<?php

declare(strict_types=1);
namespace App\Controller;

use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');



        $quizes = $em->getRepository(Quiz::class)->findAll();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'quizes' => $quizes
        ]);
    }
}