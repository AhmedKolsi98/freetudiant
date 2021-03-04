<?php

namespace App\Controller;

use App\Entity\Question  ;
use App\Entity\Reclamation;
use App\Form\FormationType;
use App\Form\QuestionformType;
use App\Form\RecllamationformType;
use App\Repository\FormationRepository;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/question", name="question")
     */
    public function question(): Response
    {
        return $this->render('question/question.html.twig', [
            'controller_name' => 'QuestionController',
        ]);
    }
    /**
     * @Route("/affichequestion", name="affichequestion")
     */
    public function index(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Question::class);
        $question = $rep->findAll();
        return $this->render('question/affichequestion.html.twig', ['question' => $question,]);

    }
    /**
     * @Route("/addquestion", name="addquestion")
     */
    public function addquestion(Request $request)
    {
        $question= new Question() ;
        $form=$this->createForm(QuestionformType::class , $question);
        $form->add('Add',submittype::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute("affichequestion");

        }
        return $this->render('Question/addquestion.html.twig',['form'=> $form->createView()]);

    }


}
