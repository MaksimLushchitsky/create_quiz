<?php

declare(strict_types=1);
namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\Quiz;
use App\Form\EditAnswerType;
use App\Form\EditQuestionType;
use App\Form\EditQuizType;
use App\Form\QuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditQuizController extends AbstractController
{
    /**
     * @Route("/edit", name="edit")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var Quiz $quiz */

        $quizes = $em->getRepository(Quiz::class)->findAll();

        return $this->render('show_quiz/index.html.twig', [
            'controller_name' => 'EditQuizController',
            'quizes' => $quizes,
        ]);
    }

    /**
     * @Route("delete/{quiz}", name="delete")
     */
    public function removeQuiz(Quiz $quiz, Request $request){
        {
            $em = $this->getDoctrine()->getManager();

            $em->remove($quiz);
            $em->flush();

            return $this->redirectToRoute("edit");
        }
    }

    /**
     * @Route("quiz/edit{quiz}", name="quiz_edit")
     */
    public function editQuiz(Quiz $quiz, Request $request)
    {
        {
            $em = $this->getDoctrine()->getManager();

            $form = $this->createForm(EditQuizType::class, $quiz);
            $form -> handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                $quiz = $form->getData();

                $em->persist($quiz);
                $em->flush();

                return $this->redirectToRoute("edit");
            }

            return $this->render('edit/quiz_edit.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }


    /**
     * @Route("show/{id}", name="show")
     */
    public function showQuiz($id)
    {
        {
            $quiz = $this->getDoctrine()->getRepository(Quiz::class)->find($id);

            $questions = $quiz->getQuestions();


            if (!$quiz) {
                throw $this->createNotFoundException(
                    'No quiz found for id '.$id
                );
            }

            return $this->render('show_quiz/show.html.twig', [
                'controller_name' => 'EditQuizController',
                'quiz' => $quiz,
                'questions' => $questions,
            ]);
        }
    }

    /**
     * @Route("add/question/{id}", name="add_question")
     */
    public function addQuestion($id, Request $request){
        {
            $quiz = $this->getDoctrine()->getRepository(Quiz::class)->find($id);

            $question = new Question();
            $answer1 = new Answer();
            $answer2 = new Answer();
            $answer3 = new Answer();

            $quiz->addQuestion($question);
            $question->addAnswer($answer1);
            $question->addAnswer($answer2);
            $question->addAnswer($answer3);

            $form = $this->createForm(QuestionType::class, $question);
            $form -> handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){

                $em = $this->getDoctrine()->getManager();

                $question = $form->getData();

                $em->persist($question);
                $em->flush();

                return $this->redirectToRoute("edit");
            }

            return $this->render('edit/add_question.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("question/edit{question}", name="question_edit")
     */
    public function editQuestion(Question $question, Request $request)
    {
        {
            $em = $this->getDoctrine()->getManager();

            $form = $this->createForm(EditQuestionType::class, $question);
            $form -> handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()){
                $question = $form->getData();

                $em->persist($question);
                $em->flush();

                return $this->redirectToRoute("edit");
            }

            return $this->render('edit/question_edit.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("delete_question/{question}", name="delete_question")
     */
    public function removeQuestion(Question $question, Request $request){
        {
            $em = $this->getDoctrine()->getManager();

            $em->remove($question);
            $em->flush();

            return $this->redirectToRoute("edit");
        }
    }

    /**
     * @Route("show/questions/{quiz_id}", name="show_questions")
     */
    public function showQuestions($quiz_id){
        {
            $questions = $this->getDoctrine()->getRepository(Question::class)->find($quiz_id);

            $answers = $questions->getAnswers();

            if (!$questions) {
                throw $this->createNotFoundException(
                    'No quiz found for id '.$quiz_id
                );
            }

            $em = $this->getDoctrine()->getManager();

            return $this->render('show_quiz/show_questions.html.twig', [
                'answers' => $answers,
            ]);
        }
    }

    /**
     * @Route("answer/edit{answer}", name="answer_edit")
     */
    public function editAnswer(Answer $answer, Request $request)
    {
        {
            $em = $this->getDoctrine()->getManager();

            $form = $this->createForm(EditAnswerType::class, $answer);
            $form -> handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $answer = $form->getData();

                $em->persist($answer);
                $em->flush();

                return $this->redirectToRoute("edit");
            }

            return $this->render('edit/answer_edit.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

}
