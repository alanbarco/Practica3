<?php

namespace App\Controller;

use App\Entity\Incidente;
use App\Form\IncidenteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/incidente/crud')]
class IncidenteCrudController extends AbstractController
{
    #[Route('/', name: 'app_incidente_crud_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $incidentes = $entityManager
            ->getRepository(Incidente::class)
            ->findAll();

        return $this->render('incidente_crud/index.html.twig', [
            'incidentes' => $incidentes,
        ]);
    }

    #[Route('/new', name: 'app_incidente_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $incidente = new Incidente();
        $form = $this->createForm(IncidenteType::class, $incidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($incidente);
            $entityManager->flush();

            return $this->redirectToRoute('app_incidente_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('incidente_crud/new.html.twig', [
            'incidente' => $incidente,
            'form' => $form,
        ]);
    }

    #[Route('/{idIncidente}', name: 'app_incidente_crud_show', methods: ['GET'])]
    public function show(Incidente $incidente): Response
    {
        return $this->render('incidente_crud/show.html.twig', [
            'incidente' => $incidente,
        ]);
    }

    #[Route('/{idIncidente}/edit', name: 'app_incidente_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Incidente $incidente, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IncidenteType::class, $incidente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_incidente_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('incidente_crud/edit.html.twig', [
            'incidente' => $incidente,
            'form' => $form,
        ]);
    }

    #[Route('/{idIncidente}', name: 'app_incidente_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Incidente $incidente, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$incidente->getIdIncidente(), $request->request->get('_token'))) {
            $entityManager->remove($incidente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_incidente_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
