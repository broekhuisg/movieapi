<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"movie"="Movie", "tvshow"="TvShow", "episode"="TvShowEpisode"})
 */
abstract class Media
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $posterPath;

    /**
     * @ORM\OneToMany(targetEntity=Cast::class, mappedBy="media")
     */
    private $persons;

    public function __construct()
    {
        $this->persons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    public function setPosterPath(string $posterPath): self
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    /**
     * @return Collection|Cast[]
     */
    public function getPersons(): Collection
    {
        return $this->persons;
    }

    public function addPerson(Cast $person): self
    {
        if (!$this->persons->contains($person)) {
            $this->persons[] = $person;
            $person->setMedia($this);
        }

        return $this;
    }

    public function removePerson(Cast $person): self
    {
        if ($this->persons->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getMedia() === $this) {
                $person->setMedia(null);
            }
        }

        return $this;
    }
}
