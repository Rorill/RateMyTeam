<?php

namespace App\Repository;

use App\Entity\Ligue1Teams;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ligue1Teams>
 */
class TeamsRepository extends ServiceEntityRepository
{
    private mixed $Ligue1Teams;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ligue1Teams::class);
    }

    public function findTeamsByIds(array $teamIds): array
    {
        return $this->createQueryBuilder('t')
            ->where('t.id IN (:ids)')
            ->setParameter('ids', $teamIds)
            ->getQuery()
            ->getResult();
    }

    private function getTeamByApiId(int $apiId): ?Ligue1Teams
    {
        return $this->Ligue1Teams->findOneBy(['apiId' => $apiId]);
    }


    public function findTeamByApiId(int $apiId): ?Ligue1Teams
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.ApiId = :ApiId')
            ->setParameter('ApiId', $apiId)
            ->getQuery()
            ->getOneOrNullResult();
    }


    //    /**
    //     * @return Ligue1Teams[] Returns an array of Ligue1Teams objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Ligue1Teams
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
