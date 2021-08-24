<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"movie"="Movie", "episode"="TvShowEpisode"})
 */
abstract class Media
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "user"})
     */
    private ?string $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private ?string $posterPath;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "write"})
     */
    private ?string $heroPath;

    /**
     * @ORM\OneToMany(targetEntity=Cast::class, mappedBy="media")
     */
    private $persons;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="watchedMedia")
     */
    private $usersWatchedThis;

    /**
     * @ORM\Column(type="boolean")
     */
    private $featured;

    public function __construct()
    {
        $this->persons = new ArrayCollection();
        $this->usersWatchedThis = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getUsersWatchedThis(): Collection
    {
        return $this->usersWatchedThis;
    }

    public function addUsersWatchedThis(User $usersWatchedThis): self
    {
        if (!$this->usersWatchedThis->contains($usersWatchedThis)) {
            $this->usersWatchedThis[] = $usersWatchedThis;
            $usersWatchedThis->addWatchedMedium($this);
        }

        return $this;
    }

    public function removeUsersWatchedThis(User $usersWatchedThis): self
    {
        if ($this->usersWatchedThis->removeElement($usersWatchedThis)) {
            $usersWatchedThis->removeWatchedMedium($this);
        }

        return $this;
    }

    public function getHeroPath(): ?string
    {
        return $this->heroPath;
    }

    public function setHeroPath(?string $heroPath): self
    {
        $this->heroPath = $heroPath;

        return $this;
    }

    public function getFeatured(): ?bool
    {
        return $this->featured;
    }

    public function setFeatured(bool $featured): self
    {
        $this->featured = $featured;

        return $this;
    }
}
