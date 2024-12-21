<?php

namespace App\Repository;

use App\Entity\CMSTheme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSTheme>
 *
 * @method CMSTheme|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSTheme|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSTheme[]    findAll()
 * @method CMSTheme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSThemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSTheme::class);
    }

//    /**
//     * @return CMSTheme[] Returns an array of CMSTheme objects
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

//    public function findOneBySomeField($value): ?CMSTheme
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
