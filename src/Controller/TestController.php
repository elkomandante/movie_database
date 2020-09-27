<?php

namespace App\Controller;

use App\Entity\Category;
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
        $category = new Category();
        $category->setName('zika');
        $entityManager->persist($category);
        $entityManager->flush();
        $res =$entityManager->getRepository(Category::class)->findOneBy(['name'=>'zika']);

        return new Response($res->getName());
    }
}
