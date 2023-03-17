<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    #[Route('/')]
    public function carregarHome(): Response
    {
        return new Response(
            '<html><body>Primeira página em symfony!</body></html>'
        );
    }

    #[Route('/pesquisar/{slug}')]
    public function pesquisar(string $slug = null): Response
    {
        return new Response('Pesquisando por: '.$slug);
    }
}