<?php

namespace App\Controller;

use App\Entity\Hopitaux;
use App\Form\HopitauxType;
use App\Repository\HopitauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hopitaux")
 */
class HopitauxController extends AbstractController
{
    /**
     * @Route("/", name="hopitaux_index", methods={"GET"})
     */
    public function index(HopitauxRepository $hopitauxRepository): Response
    {
        return $this->render('hopitaux/index.html.twig', [
            'hopitauxes' => $hopitauxRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="hopitaux_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hopitaux = new Hopitaux();
        $form = $this->createForm(HopitauxType::class, $hopitaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hopitaux);
            $entityManager->flush();

            return $this->redirectToRoute('hopitaux_index');
        }

        return $this->render('hopitaux/new.html.twig', [
            'hopitaux' => $hopitaux,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hopitaux_show", methods={"GET"})
     */
    public function show(Hopitaux $hopitaux): Response
    {
        return $this->render('hopitaux/show.html.twig', [
            'hopitaux' => $hopitaux,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hopitaux_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hopitaux $hopitaux): Response
    {
        $form = $this->createForm(HopitauxType::class, $hopitaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hopitaux_index');
        }

        return $this->render('hopitaux/edit.html.twig', [
            'hopitaux' => $hopitaux,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hopitaux_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Hopitaux $hopitaux): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hopitaux->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hopitaux);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hopitaux_index');
    }
}
