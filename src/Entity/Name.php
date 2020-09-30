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
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="string", length=255)
     */
    private $nconst;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Profession" , mappedBy="names" )
     */
    private $professions;

    public function __construct()
    {
        $this->professions = new ArrayCollection();
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

    public function getNconst(): ?string
    {
        return $this->nconst;
    }

    public function setNconst(string $nconst): self
    {
        $this->nconst = $nconst;

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
}
