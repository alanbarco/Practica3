<?php

namespace App\Controller;

use App\Entity\Incidente;
use App\Form\GerenteIncidentesType;
use App\Form\UpdateIncidenteType;
use App\Repository\IncidenteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GerenteDashboardController extends AbstractController
{
    #[Route('/gerente/dashboard', name: 'app_gerente_dashboard')]
    public function index(IncidenteRepository $incRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_GERENTE');
        $incidentes = $incRepo->findAll();
        return $this->render('gerente_dashboard/index.html.twig', [
            'listaIncidentes' => $incidentes,
        ]);
    }
    #[Route('/gerente/dashboard/edit/{id}', name: 'app_incidente_edit_gerente')]
    public function edit(Incidente $incidente, Request $request, ManagerRegistry $doctrine,): Response{
        $this->denyAccessUnlessGranted('ROLE_GERENTE');
        $form = $this->createForm(GerenteIncidentesType::class, $incidente);
        $form->handleRequest($request);
        $descripcion = $incidente->getIdTipo()->getDescripcion();
        $solucion = $incidente->getSolucion();
        $estado = $incidente->getEstado();
        if($form->isSubmitted()&& $form->isValid())
        {
            $incidente= $form->getData();
            $em = $doctrine->getManager(); //objeto que administra las entidades y BD
            $em->persist($incidente);
            $em->flush();
            return $this->redirectToRoute('app_gerente_dashboard');
        };
        return $this->render('gerente_dashboard/actualizar.html.twig', [
            'formulario' => $form,
            'descripcion' => $descripcion,
            'solucion' => $solucion,
            'estado' => $estado
        ]);
    }
    #[Route('/gerente/dashboard/delete/{id}', name: 'app_incidente_delete')]
    public function delete(Incidente $incidente, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $em->remove($incidente);
        $em->flush();

        return $this->redirectToRoute('app_gerente_dashboard');
    }
}   
