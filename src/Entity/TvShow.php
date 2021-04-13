<?php

namespace App\Entity;

use App\Repository\TvShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TvShowRepository::class)
 */
class TvShow extends Media
{
    /**
     * @ORM\OneToMany(targetEntity=TvShowSeason::class, mappedBy="tvShow")
     */
    private $seasons;

    public function __construct()
    {
        parent::__construct();
        $this->seasons = new ArrayCollection();
    }

    /**
     * @return Collection|TvShowSeason[]
     */
    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(TvShowSeason $season): self
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons[] = $season;
            $season->setTvShow($this);
        }

        return $this;
    }

    public function removeSeason(TvShowSeason $season): self
    {
        if ($this->seasons->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getTvShow() === $this) {
                $season->setTvShow(null);
            }
        }

        return $this;
    }
}
