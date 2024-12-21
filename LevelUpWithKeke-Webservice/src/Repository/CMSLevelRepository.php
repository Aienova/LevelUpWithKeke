<?php

namespace App\Repository;

use App\Entity\CMSLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSLevel>
 *
 * @method CMSLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSLevel[]    findAll()
 * @method CMSLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSLevel::class);
    }

//    /**
//     * @return CMSLevel[] Returns an array of CMSLevel objects
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

//    public function findOneBySomeField($value): ?CMSLevel
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
