<?php

declare(strict_types=1);
namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\Quiz;
use App\Form\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateQuizController extends AbstractController
{
    /**
     * @Route("/create/quiz", name="create_quiz")
     */
    public function index(Request $request)
    {
        $quiz = new Quiz();

        //Question 1
        $question1 = new Question();

        $answer11 = new Answer();
        $answer12 = new Answer();
        $answer13 = new Answer();

        $question1->addAnswer($answer11);
        $question1->addAnswer($answer12);
        $question1->addAnswer($answer13);

        //Question2
        $question2 = new Question();
        $answer21 = new Answer();
        $answer22 = new Answer();
        $answer23 = new Answer();

        $question2->addAnswer($answer21);
        $question2->addAnswer($answer22);
        $question2->addAnswer($answer23);

        //Question3
        $question3 = new Question();
        $answer31 = new Answer();
        $answer32 = new Answer();
        $answer33 = new Answer();

        $question3->addAnswer($answer31);
        $question3->addAnswer($answer32);
        $question3->addAnswer($answer33);


        //Add questions to quiz
        $quiz->addQuestion($question1);
        $quiz->addQuestion($question2);
        $quiz->addQuestion($question3);

        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $quiz->getQuiz();
            $em->persist($quiz);
            $em->flush();

            return $this->redirectToRoute("main");
        }

        return $this->render('create_quiz/quiz.html.twig',
            array('form' => $form->createView(),
            ));
    }
}
