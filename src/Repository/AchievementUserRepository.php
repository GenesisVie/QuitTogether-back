<?php

namespace App\Repository;

use App\Entity\AchievementUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AchievementUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AchievementUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AchievementUser[]    findAll()
 * @method AchievementUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchievementUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AchievementUser::class);
    }

    // /**
    //  * @return AchievementUser[] Returns an array of AchievementUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AchievementUser
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
