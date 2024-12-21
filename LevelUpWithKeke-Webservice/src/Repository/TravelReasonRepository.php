<?php

namespace App\Repository;

use App\Entity\TravelReason;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TravelReason>
 *
 * @method TravelReason|null find($id, $lockMode = null, $lockVersion = null)
 * @method TravelReason|null findOneBy(array $criteria, array $orderBy = null)
 * @method TravelReason[]    findAll()
 * @method TravelReason[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TravelReasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TravelReason::class);
    }

//    /**
//     * @return TravelReason[] Returns an array of TravelReason objects
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

//    public function findOneBySomeField($value): ?TravelReason
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
