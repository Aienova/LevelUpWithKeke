<?php

namespace App\Repository;

use App\Entity\CMSmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSmail>
 *
 * @method CMSmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSmail[]    findAll()
 * @method CMSmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSmailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSmail::class);
    }

//    /**
//     * @return CMSmail[] Returns an array of CMSmail objects
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

//    public function findOneBySomeField($value): ?CMSmail
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
