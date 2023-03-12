<?php

namespace App\Controller;

use App\Entity\Incidente;
use App\Form\UpdateIncidenteType;
use App\Repository\IncidenteRepository;
use App\Repository\TipoIncidenteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuardiaDashboardController extends AbstractController
{
    #[Route('/guardia/dashboard', name: 'app_guardia_dashboard')]
    public function index(IncidenteRepository $incRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_GUARDIA');
        $incidentes = $incRepo->findAll();
        return $this->render('guardia_dashboard/index.html.twig', [
            'listaIncidentes' => $incidentes,
        ]);
    }
    #[Route('/guardia/dashboard/edit/{id}', name: 'app_incidente_edit')]
    public function edit(Incidente $incidente, Request $request, ManagerRegistry $doctrine,): Response{
        $this->denyAccessUnlessGranted('ROLE_GUARDIA');
        $form = $this->createForm(UpdateIncidenteType::class, $incidente);
        $form->handleRequest($request);
        $descripcion = $incidente->getIdTipo()->getDescripcion();
        if($form->isSubmitted()&& $form->isValid())
        {
            $incidente= $form->getData();
            $em = $doctrine->getManager(); //objeto que administra las entidades y BD
            $em->persist($incidente);
            $em->flush();
            return $this->redirectToRoute('app_guardia_dashboard');
        };
        return $this->render('guardia_dashboard/actualizar.html.twig', [
            'formulario' => $form,
            'descripcion' => $descripcion
        ]);
    }
}
