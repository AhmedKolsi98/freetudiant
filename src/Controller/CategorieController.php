<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategorieController extends AbstractController
{
    /**
     * @Route("/home/categorie", name="categorie_index_front", methods={"GET"})
     */
    public function indexFront(CategorieRepository $categorieRepository): Response
    {
        return $this->render('FrontOffice/categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

     /**
     * @Route("/admin/categorie", name="categorie_index_back", methods={"GET"})
     */
    public function indexBack(CategorieRepository $categorieRepository): Response
    {
        return $this->render('BackOffice/categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }


    /**
     * @Route("/home/categorie/new", name="categorie_new_front", methods={"GET","POST"})
     */
    public function newFront(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_index_front');
        }

        return $this->render('FrontOffice/categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/categorie/new", name="categorie_new_back", methods={"GET","POST"})
     */
    public function newBack(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            $this->addFlash(
                'info',
                'Une nouvelle catégorie est ajouté avec succès'
            );

            return $this->redirectToRoute('categorie_index_back');
        }

        return $this->render('BackOffice/categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/home/categorie/{id}", name="categorie_show_front", methods={"GET"})
     */
    public function showFront(Categorie $categorie): Response
    {
        return $this->render('FrontOfficecategorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }
    /**
     * @Route("/admin/categorie/{id}", name="categorie_show_back", methods={"GET"})
     */
    public function showBack(Categorie $categorie): Response
    {
        return $this->render('BackOffice/categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/home/categorie/{id}/edit", name="categorie_edit_front", methods={"GET","POST"})
     */
    public function editFront(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_index_front');
        }

        return $this->render('FrontOffice/categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/categorie/{id}/edit", name="categorie_edit_back", methods={"GET","POST"})
     */
    public function editBack(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_index_back');
        }

        return $this->render('BackOffice/categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/home/categorie/{id}", name="categorie_delete_front", methods={"DELETE"})
     */
    public function deleteFront(Request $request, Categorie $categorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_index_front');
    }
    /**
     * @Route("/categorie/{id}", name="categorie_delete_back", methods={"DELETE"})
     */
    public function deleteBack(Request $request, Categorie $categorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_index_back');
    }
}
