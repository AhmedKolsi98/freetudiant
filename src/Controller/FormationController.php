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
use App\Entity\Notificationf;


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
     * @Route("/listformation", name="listformation")
     */
    public function listf(): Response
    {

        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $form=$repo->findAll();

        return $this->render('formation/listformation.html.twig', ['formations' => $form,]);
    }
    /**
     * @Route("/notificationf", name="notificationf")
     */
    public function notificationf(): Response
    {

        $rep=$this->getDoctrine()->getRepository(Notificationf::class);
        $notif=$rep->findAll();


        return $this->render('formation/notificationf.html.twig', [
                'notif' => $notif,
            ]
        );

    }
    /**
     * @Route("/delformation/{id}", name="deleteformation")
     */
    public function deleteformation(int $id): Response
    {

        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository(Formation::class)->find($id);
        $em->remove($formation);
        $title = $formation->getTitle();
        $notif= new Notificationf();
        $notif->setNotif('formation '.$title.'Deleted');
        $em->persist($notif);
        $em->flush();



        return $this->redirectToRoute("listformation");
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/addformation",name="addformation")
     */
    function add(Request $request){
        $formation=new Formation();
        $form=$this->createForm(FormationType::class,$formation);
        $form->add('Add',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $notif = new Notificationf();
            $notif->setNotif('New formation');
            $em->persist($notif);
            $em->persist($formation);
            $em->flush();



            //end mailing
            return $this->redirectToRoute('listformation');
        }
        return $this->render("formation/addformation.html.twig",array('form'=>$form->createView()));

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
     * @param Request $request
     * @return Response
     * @Route ("/searchrdv",name="searchrdv")
     */
    public function searchrdv(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Formation::class);
        $requestString=$request->get('searchValue');
        $rdv = $repository->findrdvBydate($requestString);
        return $this->render('formation/formationajax.html.twig' ,[
            "formations"=>$rdv
        ]);
    }
    /**
     * @return Response
     * @Route ("/order",name="order")
     */
    public function orderbymail(FormationRepository $repository){
        $rendezvous=$repository->orderbytitle();
        return $this->render('formation/listformation.html.twig',array("formations"=>$rendezvous));
    }

}
