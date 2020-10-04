<?php

namespace App\Entity;

use App\Repository\NameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NameRepository::class)
 */
class Name
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $birthYear;

    /**
     * @ORM\Column(type="integer")
     */
    private $deathYear;




    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Profession" , mappedBy="names" )
     */
    private $professions;

    /**
     * @ORM\OneToMany (targetEntity="App\Entity\MovieNameProfession", mappedBy="name")
     */
    private $movieRoles;


    public function __construct()
    {
        $this->professions = new ArrayCollection();
        $this->movieRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthYear(): ?int
    {
        return $this->birthYear;
    }

    public function setBirthYear(int $birthYear): self
    {
        $this->birthYear = $birthYear;

        return $this;
    }

    public function getDeathYear(): ?int
    {
        return $this->deathYear;
    }

    public function setDeathYear(int $deathYear): self
    {
        $this->deathYear = $deathYear;

        return $this;
    }


    /**
     * @return ArrayCollection
     */
    public function getProfessions(): ArrayCollection
    {
        return $this->professions;
    }

    public function addProfession(Profession $profession)
    {
        if(!$this->professions->contains($profession)){
            $this->professions->add($profession);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getMovieRoles(): ArrayCollection
    {
        return $this->movieRoles;
    }

    public function addMovieRole(MovieNameProfession $movieNameProfession){
        if(!$this->movieRoles->contains($movieNameProfession)){
            $this->movieRoles->add($movieNameProfession);
        }
    }
}
