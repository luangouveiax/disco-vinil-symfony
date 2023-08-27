<?php

namespace App\Controller;

use App\Repository\DiscoVinilRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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
    public function pesquisar(DiscoVinilRepository $discoRepository, Request $request, string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        $queryBuilder = $discoRepository->createOrderedByVotesQueryBuilder($slug);
        $adapter = new QueryAdapter($queryBuilder);
        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            9
        );

        return $this->render('home/pesquisar.html.twig', [
            'genre' => $genre,
            'pager' => $pagerfanta
        ]);
    }
}