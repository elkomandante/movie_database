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
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tconst;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genres;


    /**
     * @ORM\ManyToMany (targetEntity="App\Entity\Category" ,inversedBy="movies")
     */
    private $categories;


    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTconst(): ?string
    {
        return $this->tconst;
    }

    public function setTconst(string $tconst): self
    {
        $this->tconst = $tconst;

        return $this;
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

    public function setGenres(?string $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function addCategory(Category $category){
        if(!$this->categories->contains($category)){
            $this->categories->add($category);
        }
    }
}
