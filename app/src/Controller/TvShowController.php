<?php

namespace App\Controller;

use App\Entity\TvShow;
use App\Repository\TvShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TvShowController extends AbstractController
{
    #[Route('/tv/show', name: 'tv_show')]
    public function index(): Response
    {
        return $this->render('tv_show/index.html.twig', [
            'controller_name' => 'TvShowController',
        ]);
    }

//    public function __invoke(TvShow $data)
//    {
//        return $this->getDoctrine()->getRepository(TvShow::class)->findTvShowWithSeasonsAndEpisodes($data->getId());
//    }
}
