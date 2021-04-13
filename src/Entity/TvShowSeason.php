<?php

namespace App\Entity;

use App\Repository\TvShowSeasonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TvShowSeasonRepository::class)
 */
class TvShowSeason
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $seasonNumber;

    /**
     * @ORM\ManyToOne(targetEntity=TvShow::class, inversedBy="seasons")
     */
    private $tvShow;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeasonNumber(): ?int
    {
        return $this->seasonNumber;
    }

    public function setSeasonNumber(int $seasonNumber): self
    {
        $this->seasonNumber = $seasonNumber;

        return $this;
    }

    public function getTvShow(): ?TvShow
    {
        return $this->tvShow;
    }

    public function setTvShow(?TvShow $tvShow): self
    {
        $this->tvShow = $tvShow;

        return $this;
    }
}
