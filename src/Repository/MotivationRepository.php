<?php

namespace App\Repository;

use App\Entity\Motivation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Motivation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Motivation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Motivation[]    findAll()
 * @method Motivation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotivationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Motivation::class);
    }

    // /**
    //  * @return Motivation[] Returns an array of Motivation objects
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
    public function findOneBySomeField($value): ?Motivation
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
