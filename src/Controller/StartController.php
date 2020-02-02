<?php

declare(strict_types=1);
namespace App\Controller;

use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StartController extends AbstractController
{
    /**
     * @Route("start/{id}", name="start")
     */
    public function index($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $quiz = $em->getRepository(Quiz::class)->find($id);

        if (!$quiz) {
            throw $this->createNotFoundException(
                'No quiz found for id '.$id
            );
        }

        return $this->render('start/index.html.twig', [
            'quiz' => $quiz,
        ]);
    }
}