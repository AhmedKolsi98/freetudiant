<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Formation;
use App\Form\FormationType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;


class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function index(): Response
    {
        return $this->render('formation/index.html.twig', [
            'controller_name' => 'FormationController',
        ]);

    }



    /**
     * @Route("/addformation", name="addformation")
     */
    public function addformation(Request $request)
    {
        $formation= new formation();
        $form=$this->createForm(FormationType::class , $formation);
        $form->add('Add', submittype::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute("listformation");

        }

        return $this->render('formation/addformation.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/delformation/{id}", name="delformation")
     */
    public function deleteformation(int $id): Response
    {

        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository(Formation::class)->find($id);
        $em->remove($formation);
        $em->flush();



        return $this->redirectToRoute("listformation");
    }

    /**
     * @Route("/updateformation{id}",name="updateformation")
     */
    function Update(FormationRepository $repository,$id,Request $request){
        $formation=$repository->find($id);
        $form=$this->createForm(FormationType::class,$formation);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listformation');
        }
        return $this->render("formation/updateformation.html.twig",array('f'=>$form->createView()));

    }


}
