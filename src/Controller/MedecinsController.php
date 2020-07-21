<?php

namespace App\Controller;

use App\Entity\Medecins;
use App\Form\MedecinsType;
use App\Repository\MedecinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/medecins")
 */
class MedecinsController extends AbstractController
{
    /**
     * @Route("/", name="medecins_index", methods={"GET"})
     */
    public function index(MedecinsRepository $medecinsRepository): Response
    {
        return $this->render('medecins/index.html.twig', [
            'medecins' => $medecinsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="medecins_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $medecin = new Medecins();
        $form = $this->createForm(MedecinsType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medecin);
            $entityManager->flush();

            return $this->redirectToRoute('medecins_index');
        }

        return $this->render('medecins/new.html.twig', [
            'medecin' => $medecin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medecins_show", methods={"GET"})
     */
    public function show(Medecins $medecin): Response
    {
        return $this->render('medecins/show.html.twig', [
            'medecin' => $medecin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medecins_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Medecins $medecin): Response
    {
        $form = $this->createForm(MedecinsType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medecins_index');
        }

        return $this->render('medecins/edit.html.twig', [
            'medecin' => $medecin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medecins_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Medecins $medecin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medecin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medecin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medecins_index');
    }
}
