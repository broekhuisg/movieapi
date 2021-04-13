<?php

namespace App\Entity;

use App\Repository\TvShowRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TvShowRepository::class)
 */
class TvShow extends Media
{
}
