<?php

namespace App\Repository;

use App\Entity\VisaType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VisaType>
 *
 * @method VisaType|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisaType|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisaType[]    findAll()
 * @method VisaType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisaTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisaType::class);
    }

//    /**
//     * @return VisaType[] Returns an array of VisaType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VisaType
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
