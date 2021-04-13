<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TvShowEpisodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TvShowEpisodeRepository::class)
 */
#[ApiResource]
class TvShowEpisode extends Media
{
    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity=TvShowSeason::class, inversedBy="episodes")
     */
    private $season;

    /**
     * @ORM\Column(type="integer")
     */
    private $episodeNumber;

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getSeason(): ?TvShowSeason
    {
        return $this->season;
    }

    public function setSeason(?TvShowSeason $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getEpisodeNumber(): ?int
    {
        return $this->episodeNumber;
    }

    public function setEpisodeNumber(int $episodeNumber): self
    {
        $this->episodeNumber = $episodeNumber;

        return $this;
    }
}
