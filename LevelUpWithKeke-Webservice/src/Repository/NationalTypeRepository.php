<?php

namespace App\Repository;

use App\Entity\NationalType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NationalType>
 *
 * @method NationalType|null find($id, $lockMode = null, $lockVersion = null)
 * @method NationalType|null findOneBy(array $criteria, array $orderBy = null)
 * @method NationalType[]    findAll()
 * @method NationalType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NationalTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NationalType::class);
    }

//    /**
//     * @return NationalType[] Returns an array of NationalType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NationalType
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
