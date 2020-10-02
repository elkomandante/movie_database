<?php

namespace App\Entity;

use App\Repository\ProffessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProffessionRepository::class)
 */
class Profession
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
     * @ORM\ManyToMany (targetEntity="App\Entity\Name", inversedBy="professions")
     */
    private $names;

    /**
     * @ORM\OneToMany (targetEntity="App\Entity\MovieNameProfession" , mappedBy="profession")
     */
    private $moviesAndNames;

    public function __construct()
    {
        $this->names = new ArrayCollection();
        $this->moviesAndNames = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getNames()
    {
        return $this->names;
    }

    public function addName(Name $name)
    {
        if(!$this->names->contains($name)){
            $this->names->add($name);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getMoviesAndNames(): ArrayCollection
    {
        return $this->moviesAndNames;
    }

    public function addMoviesAndNames(MovieNameProfession $movieNameProfession){
        if(!$this->moviesAndNames->contains($movieNameProfession)){
            $this->moviesAndNames->add($movieNameProfession);
        }
    }

}
