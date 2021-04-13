<?php

namespace App\Repository;

use App\Entity\TvShowSeason;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TvShowSeason|null find($id, $lockMode = null, $lockVersion = null)
 * @method TvShowSeason|null findOneBy(array $criteria, array $orderBy = null)
 * @method TvShowSeason[]    findAll()
 * @method TvShowSeason[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TvShowSeasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TvShowSeason::class);
    }

    // /**
    //  * @return TvShowSeason[] Returns an array of TvShowSeason objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TvShowSeason
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
