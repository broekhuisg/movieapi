<?php

namespace App\Repository;

use App\Entity\TvShowEpisode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TvShowEpisode|null find($id, $lockMode = null, $lockVersion = null)
 * @method TvShowEpisode|null findOneBy(array $criteria, array $orderBy = null)
 * @method TvShowEpisode[]    findAll()
 * @method TvShowEpisode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TvShowEpisodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TvShowEpisode::class);
    }

    // /**
    //  * @return TvShowEpisode[] Returns an array of TvShowEpisode objects
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
    public function findOneBySomeField($value): ?TvShowEpisode
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
