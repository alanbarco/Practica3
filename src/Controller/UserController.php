<?php

namespace App\Controller;

use App\Entity\Incidente;
use App\Form\ReporteIncidenteType;
use App\Repository\IncidenteRepository;
use App\Repository\TipoIncidenteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(IncidenteRepository $incRepo): Response
    {
        $residente = $this->getUser()->getIdUsuario();
        $incidentes = $incRepo->findBy(["idUsuario"=>$residente]);
        $this->denyAccessUnlessGranted('ROLE_RESIDENTE');
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'lista' => $incidentes
        ]);
    }
    #[Route('/user/incidente', name: 'app_residente_incidente')]
    public function incidente(Request $request,ManagerRegistry $doctrine,TipoIncidenteRepository $tipoRepo):Response
    {
        $this->denyAccessUnlessGranted('ROLE_RESIDENTE');
        $usuario = $this->getUSer();//se pasa el objeto usuario al incidente
        $incidente = new Incidente();
        $tipos = $tipoRepo->findAll();
        $form = $this->createForm(ReporteIncidenteType::class, $incidente,['arrayIncidentes'=>$tipos]);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $idTipo = $form['tipo']->getData();//se pasa el objeto tipoIncidente al incidente
            $incidente->setEstado('A');
            $incidente->setIdUsuario($usuario);
            $incidente->setIdTipo($idTipo);
            $incidente->setEstadoIncidente("");
            $em = $doctrine->getManager();
            $em->persist($incidente);
            $em->flush();
            return $this->redirectToRoute('app_user');
        }
        return $this->render('user/incidente.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
