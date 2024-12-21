<?php

namespace App\Repository;

use App\Entity\CMSmailType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSmailType>
 *
 * @method CMSmailType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSmailType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSmailType[]    findAll()
 * @method CMSmailType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSmailTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSmailType::class);
    }

//    /**
//     * @return CMSmailType[] Returns an array of CMSmailType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CMSmailType
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
