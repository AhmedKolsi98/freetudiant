<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\RecllamationformType;
use App\Form\ReponseformType;
use App\Repository\ReclamationRepository;
use App\Repository\ReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReponseController extends AbstractController
{
    /**
     * @Route("/reponse", name="reponse")
     */
    public function reponse(): Response
    {
        return $this->render('reponse/reponse.html.twig', [
            'controller_name' => 'ReponseController',
        ]);
    }
    /**
     * @Route("/affichereponse", name="affichereponse")
     */
    public function index(): Response
    {
        $rep = $this->getDoctrine()->getRepository(reponse::class);
        $reponse = $rep->findAll();
        return $this->render('reponse/affichereponse.html.twig', ['reponse' => $reponse,]);

    }
    /**
     * @Route("/addReponse", name="addReponse")
     */
    public function addReponse(Request $request)
    {
        $Reponse= new Reponse();
        $form=$this->createForm(ReponseformType::class , $Reponse);
        $form->add('Add',submittype::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($Reponse);
            $em->flush();

            return $this->redirectToRoute("affichereponse");

        }
        return $this->render('Reponse/addReponse.html.twig',['form'=> $form->createView()]);

    }
    /**
     * @Route("/updaterponse{id}",name="update")
     */
    function Update(ReponseRepository $repository,$id,Request $request){
        $reponse=$repository->find($id);
        $form=$this->createForm(ReponseformType::class,$reponse);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('affichereponse');
        }
        return $this->render("reponse/updaterponse.html.twig",array('form'=>$form->createView()));

    }

}
