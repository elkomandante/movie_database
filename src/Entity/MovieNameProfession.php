<?php

namespace App\Entity;

use App\Repository\MovieNameProfessionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieNameProfessionRepository::class)
 */
class MovieNameProfession
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Movie", inversedBy="crew")
     */
    private $movie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Name", inversedBy="movieRoles")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profession", inversedBy="moviesAndNames")
     */
    private $profession;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param mixed $movie
     */
    public function setMovie($movie): void
    {
        $this->movie = $movie;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param mixed $profession
     */
    public function setProfession($profession): void
    {
        $this->profession = $profession;
    }

}
