<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="string")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $primaryTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $originalTitle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isAdult;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $startYear;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $endYear;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $runtimeMinutes;



    /**
     * @ORM\ManyToMany (targetEntity="Genre" ,inversedBy="movies")
     */
    private $genres;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MovieNameProfession", mappedBy="movie")
     */
    private $crew;


    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->crew = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPrimaryTitle(): ?string
    {
        return $this->primaryTitle;
    }

    public function setPrimaryTitle(string $primaryTitle): self
    {
        $this->primaryTitle = $primaryTitle;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getIsAdult(): ?bool
    {
        return $this->isAdult;
    }

    public function setIsAdult(?bool $isAdult): self
    {
        $this->isAdult = $isAdult;

        return $this;
    }

    public function getStartYear(): ?string
    {
        return $this->startYear;
    }

    public function setStartYear(?string $startYear): self
    {
        $this->startYear = $startYear;

        return $this;
    }

    public function getEndYear(): ?string
    {
        return $this->endYear;
    }

    public function setEndYear(?string $endYear): self
    {
        $this->endYear = $endYear;

        return $this;
    }

    public function getRuntimeMinutes(): ?string
    {
        return $this->runtimeMinutes;
    }

    public function setRuntimeMinutes(?string $runtimeMinutes): self
    {
        $this->runtimeMinutes = $runtimeMinutes;

        return $this;
    }

    public function getGenres(): ?string
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre){
        if(!$this->genres->contains($genre)){
            $this->genres->add($genre);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getCrew(): ArrayCollection
    {
        return $this->crew;
    }

    public function addCrew(MovieNameProfession $movieNameProfession)
    {
        if(!$this->crew->contains($movieNameProfession)){
            $this->crew->add($movieNameProfession);
        }
    }
}
