<?php

namespace App\Repository;

use App\Entity\CMSstat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSstat>
 *
 * @method CMSstat|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSstat|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSstat[]    findAll()
 * @method CMSstat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSstatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSstat::class);
    }

//    /**
//     * @return CMSstat[] Returns an array of CMSstat objects
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

//    public function findOneBySomeField($value): ?CMSstat
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findByYear($year): ?CMSstat
   {
       return $this->createQueryBuilder('c')
           ->andWhere('c.year = :year')
            ->setParameter('year', $year)
          ->getQuery()
          ->getOneOrNullResult()
      ;
   }


}
