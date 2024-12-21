<?php

namespace App\Repository;

use App\Entity\CMSgraphicsType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSgraphicsType>
 *
 * @method CMSgraphicsType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSgraphicsType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSgraphicsType[]    findAll()
 * @method CMSgraphicsType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSgraphicsTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSgraphicsType::class);
    }

//    /**
//     * @return CMSgraphicsType[] Returns an array of CMSgraphicsType objects
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

//    public function findOneBySomeField($value): ?CMSgraphicsType
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
