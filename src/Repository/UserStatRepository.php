<?php

namespace App\Repository;

use App\Entity\UserStat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserStat|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserStat|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserStat[]    findAll()
 * @method UserStat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserStatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserStat::class);
    }


    /*
    public function findOneBySomeField($value): ?UserStat
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
