<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        /**
         * @var $movie Movie
         */
        $movie = $entityManager->getRepository(Movie::class)->findOneBy(['tconst'=>'tt0004447']);
        foreach ($movie->getCategories() as $category){
            dump($category);
        }
        echo $movie->getOriginalTitle();


        return new Response('pera');
    }
}
