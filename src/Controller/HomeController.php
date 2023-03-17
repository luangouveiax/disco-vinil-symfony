<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        $title = "Blog com Symfony";
        $posts = [
            [
                'title' => 'Exemplo de titulo do post 1',
                'body' => 'Texto do post'
            ],
            [
                'title' => 'Exemplo de titulo do post 2',
                'body' => 'Texto do post'
            ],
            [
                'title' => 'Exemplo de titulo do post 3',
                'body' => 'Texto do post'
            ],
            [
                'title' => 'Exemplo de titulo do post 4',
                'body' => 'Texto do post'
            ],
        ];

        return $this->render('home/index.html.twig', [
            'title' => $title,
            'posts' => $posts
        ]);
    }

    #[Route('/pesquisar/{slug}')]
    public function pesquisar(string $slug = null): Response
    {
        return new Response('Pesquisando por: '.$slug);
    }
}