<?php

namespace App\Controller;

use App\Entity\DiscoVinil;
use App\Repository\DiscoVinilRepository;
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
        $disco = new DiscoVinil();
        $disco->setTitulo('Felipe Boladão');
        $disco->setDescricao('Playlist boladão');
        $generos = ['funk', 'rock'];
        $disco->setGenero($generos[array_rand($generos)]);
        $disco->setContaFaixas(rand(5, 20));
        $disco->setVotos(rand(-50, 50));
        
        $entityManager->persist($disco);
        $entityManager->flush();

        return new Response(sprintf(
            'Disco %d tem %d faixas',
            $disco->getId(),
            $disco->getContaFaixas()
        ));
    }

    #[Route('/disco/{id}', name: 'app_disco_show')]
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
            'id' => $disco->getId()
        ]);
    }
}