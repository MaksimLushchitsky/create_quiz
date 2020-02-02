<?php

declare(strict_types=1);
namespace App\Controller;

use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $quizes = $em->getRepository(Quiz::class)->findAll();

        return $this->render('home/index.html.twig', [
            'quizes' => $quizes
        ]);
    }
}
