<?php

namespace App\Repository;

use App\Entity\MovieNameProfession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MovieNameProfession|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieNameProfession|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieNameProfession[]    findAll()
 * @method MovieNameProfession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieNameProfessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieNameProfession::class);
    }

    // /**
    //  * @return MovieNameProfession[] Returns an array of MovieNameProfession objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MovieNameProfession
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
