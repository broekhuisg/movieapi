<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TvShowSeasonController extends AbstractController
{
    #[Route('/tv/show/season', name: 'tv_show_season')]
    public function index(): Response
    {
        return $this->render('tv_show_season/index.html.twig', [
            'controller_name' => 'TvShowSeasonController',
        ]);
    }

    public function __invoke()
    {
        return 'dit is helemaal mooi';
    }
}
