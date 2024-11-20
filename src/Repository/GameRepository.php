<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function findLastGameByTeam(int $teamId): ?Game
    {
        return $this->createQueryBuilder('g')
            ->where('g.TeamHome = :teamId OR g.TeamAway = :teamId')
            ->andWhere('g.ScoreHome IS NOT NULL')
            ->andWhere('g.ScoreAway IS NOT NULL')
            ->setParameter('teamId', $teamId)
            ->orderBy('g.date', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

    }

    public function findNextGamesByTeam(int $teamId, int $limit = 5): array
    {
        return $this->createQueryBuilder('g')
            ->where('g.TeamHome = :teamId OR g.TeamAway = :teamId')
            ->setParameter('teamId', $teamId)
            ->andWhere('g.date > :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('g.date', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
    public function findByApiId(int $id): ?Game
    {
        return $this->createQueryBuilder('g')
            ->where('g.apiMatchId = :apiMatchId')
            ->setParameter('apiMatchId', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Game[] Returns an array of Game objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Game
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
