<?php

namespace App\Repository;

use App\Entity\IdentityType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IdentityType>
 *
 * @method IdentityType|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdentityType|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdentityType[]    findAll()
 * @method IdentityType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentityTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdentityType::class);
    }

//    /**
//     * @return IdentityType[] Returns an array of IdentityType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IdentityType
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
