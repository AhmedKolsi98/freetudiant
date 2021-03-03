<?php

namespace App\Controller;

use App\Entity\ParticipantF;
use App\Form\ParticipantfType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantfController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function participant(): Response
    {
        return $this->render('participantf/index.html.twig', [
            'controller_name' => 'ParticipantfController',
        ]);
    }

    /**
     * @Route("/participantf{id}", name="participantf")
     */
    public function index(Request $request,$id): Response
    {
        $formation= new Participantf();
        $form=$this->createForm(ParticipantfType::class , $formation);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();
            $participf= new Participantf();
            $participf->setIdFormation($id)
                ->setIdParticipantf($formation->getId());
            $em->persist($participf);
            $em->flush();
            return $this->redirectToRoute("afficheformation");
        }

        return $this->render('participantf/index.html.twig', ['form' => $form->createView(),]);

    }
}
