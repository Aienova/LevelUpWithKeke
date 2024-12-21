<?php

namespace App\Repository;

use App\Entity\CMSsocialmediaType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSsocialmediaType>
 *
 * @method CMSsocialmediaType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSsocialmediaType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSsocialmediaType[]    findAll()
 * @method CMSsocialmediaType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSsocialmediaTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSsocialmediaType::class);
    }

//    /**
//     * @return CMSsocialmediaType[] Returns an array of CMSsocialmediaType objects
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

//    public function findOneBySomeField($value): ?CMSsocialmediaType
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
