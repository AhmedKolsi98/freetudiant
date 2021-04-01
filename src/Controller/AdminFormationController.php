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
     * @Route("/listformationad", name="listformationad")
     */
    public function listf(): Response
    {

        $repo=$this->getDoctrine()->getRepository(Formation::class);
        $form=$repo->findAll();

        return $this->render('admin_formation/afiiche.html.twig', ['formations' => $form,]);
    }
}
