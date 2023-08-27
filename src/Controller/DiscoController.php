<?php

namespace App\Controller;

use App\Entity\DiscoVinil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscoController extends AbstractController
{
    #[Route('/disco/novo')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        
    }

    #[Route('/disco/{slug}', name: 'app_disco_show')]
    public function show(DiscoVinil $disco): Response
    {
        return $this->render('disco/show.html.twig', [
            'disco' => $disco,
        ]);
    }

    #[Route('/disco/{id}/voto', name: 'app_disco_voto', methods: ['POST'])]
    public function voto(DiscoVinil $disco, Request $request, EntityManagerInterface $entityManager): Response
    {
        $direction = $request->request->get('direction', 'up');
        if($direction === 'up'){
            $disco->upVoto();
        }else{
            $disco->downVoto();
        }
        
        $entityManager->flush();

        $this->addFlash('sucesso', 'Voto enviado!');

        return $this->redirectToRoute('app_disco_show', [
            'slug' => $disco->getSlug()
        ]);
    }
}