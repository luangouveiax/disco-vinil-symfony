<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Service\VinilRepository;

use function Symfony\Component\String\u;

class VinilController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        $tracks = [
            ['id' => 1, 'song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['id' => 2, 'song' => 'Waterfalls', 'artist' => 'TLC'],
            ['id' => 3, 'song' => 'Creep', 'artist' => 'Radiohead'],
            ['id' => 4, 'song' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['id' => 5, 'song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['id' => 6, 'song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];

        return $this->render('home/index.html.twig', [
            'title' => 'PB & Jams',
            'tracks' => $tracks,
        ]);
    }

    #[Route('/pesquisar/{slug}', name: 'app_pesquisar')]
    public function pesquisar(VinilRepository $vinilRepository, string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        $discos = $vinilRepository->findAll();

        return $this->render('home/pesquisar.html.twig', [
            'genre' => $genre,
            'discos' => $discos
        ]);
    }
}