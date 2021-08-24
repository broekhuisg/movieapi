<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie extends Media
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $duration;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $inTheaterStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $inTheaterEnd;

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getInTheaterStart(): ?\DateTimeInterface
    {
        return $this->inTheaterStart;
    }

    public function setInTheaterStart(?\DateTimeInterface $inTheaterStart): self
    {
        $this->inTheaterStart = $inTheaterStart;

        return $this;
    }

    public function getInTheaterEnd(): ?\DateTimeInterface
    {
        return $this->inTheaterEnd;
    }

    public function setInTheaterEnd(?\DateTimeInterface $inTheaterEnd): self
    {
        $this->inTheaterEnd = $inTheaterEnd;

        return $this;
    }
}
