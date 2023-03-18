<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use function Symfony\Component\String\u;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        $tracks = [
            ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['song' => 'Waterfalls', 'artist' => 'TLC'],
            ['song' => 'Creep', 'artist' => 'Radiohead'],
            ['song' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];

        return $this->render('home/index.html.twig', [
            'title' => 'PB & Jams',
            'tracks' => $tracks,
        ]);
    }

    #[Route('/pesquisar/{slug}', name: 'app_pesquisar')]
    public function pesquisar(string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        return $this->render('home/pesquisar.html.twig', [
            'genre' => $genre
        ]);
    }
}