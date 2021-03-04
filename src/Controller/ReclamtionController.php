<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Reclamation;
use App\Form\RecllamationformType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamtionController extends AbstractController
{
    /**
     * @Route("/reclamtion", name="reclamtion")
     */
    public function reclamation(): Response
    {
        return $this->render('reclamtion/reclamation.html.twig', [
            'controller_name' => 'ReclamtionController',
        ]);
    }
    /**
     * @Route("/affichereclamation", name="affichereclamation")
     */
    public function index(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Reclamation::class);
        $reclamation = $rep->findAll();
        return $this->render('reclamtion/affichereclamation.html.twig', ['reclamation' => $reclamation,]);

    }

    /**
     * @Route("/addReclamation", name="addReclamation")
     */
    public function addReclamation(Request $request)
    {
        $Reclamation= new Reclamation();
        $form=$this->createForm(RecllamationformType::class , $Reclamation);
        $form->add('Add',submittype::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($Reclamation);
            $em->flush();

            return $this->redirectToRoute("affichereclamation");

        }
        return $this->render('Reclamtion/addReclamation.html.twig',['form'=> $form->createView()]);



}


    /**
     * @Route("/delReclamation/{id}", name="delformation")
     */
    public function deleteReclamation(int $id): Response
    {

        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository(Reclamation::class)->find($id);
        $em->remove($reclamation);
        $em->flush();



        return $this->redirectToRoute("affichereclamation");
    }

    /**
     * @Route("/listReclamation", name="listReclamation")
     */
    public function listRec(): Response
    {

        $repo=$this->getDoctrine()->getRepository(Reclamation::class);
        $Reclamation=$repo->findAll();

        return $this->render('reclamation/listReclamation.html.twig', [
            'Reclamation' => $Reclamation,]);
    }

}

