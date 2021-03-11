<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFormationController extends AbstractController
{
    /**
     * @Route("/admin/formation", name="admin_formation")
     */
    public function index(): Response
    {
        return $this->render('admin_formation/index.html.twig', [
            'controller_name' => 'AdminFormationController',
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
    /**
     * @Route("/listformation", name="listformation")
     */
    public function listf(): Response
    {

        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $form=$repo->findAll();

        return $this->render('formation/listformation.html.twig', ['formations' => $form,]);
    }
}