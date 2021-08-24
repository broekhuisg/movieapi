<?php

namespace App\Controller\Actions;

use App\Repository\MovieRepository;

class GetFeaturedMoviesAction
{
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function __invoke() {
        return $this->movieRepository->getFeaturedMovies();
    }
}